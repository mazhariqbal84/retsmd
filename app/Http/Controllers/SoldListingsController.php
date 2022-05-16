<?php

namespace App\Http\Controllers;

use App\Models\RetsPropertyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SoldListingsController extends Controller
{
    //
    public function importListing() {
        $all_mls = config('mls_config.mls_login_parameter');
        $cron_tablename = "properties_cron_log";
        $file_name = "sold_listings_controller";
        $curr_date = date('Y-m-d H:i:s');
        $cron_data = array(
            'cron_file_name' => $file_name,
            'cron_start_time' => $curr_date,
            'steps_completed' => 1
        );
        foreach ($all_mls as $curr_mls_id => $curr_mls){
            Log::info("Sold Listings Cron Now Started = ".date("Y-m-d"));
            $curr_mls_name = $curr_mls['mls_name'];
            echo "<hr><h3><b>Started for " . $curr_mls_name . "</b></h3>";
            $property_resource = config('mls_config.rets_query_array.' . $curr_mls_id . '.property_resource');
            $property_class = config('mls_config.rets_query_array.' . $curr_mls_id . '.property_classes');
            $is_run = 0;
            foreach ($property_class as $className => $classconfig) {
                $is_run++;
                $curr_date = date('Y-m-d H:i:s');
                $properties_inserted_in_db = 0;
                $insertion_prop = 0;
                $update_prop = 0;
                $login_parameters = config('mls_config.mls_login_parameter');
                $login_parameter = $login_parameters[$curr_mls_id];
                $config = new \PHRETS\Configuration;
                $config->setLoginUrl($login_parameter["rets_login_url"]);
                $config->setUsername($login_parameter["rets_username"]);
                $config->setPassword($login_parameter["rets_password"]);
                $config->setRetsVersion('1.8'); // see constants from \PHRETS\Versions\RETSVersion
                $config->setUserAgent('EZRealEstateCE/1.0');
                $config->setUserAgentPassword($login_parameter["rets_agent_password"]); // string password, if given
                $config->setHttpAuthenticationMethod('digest'); // or 'basic' if required
                $config->setOption('use_post_method', false); // boolean
                $config->setOption('disable_follow_location', false); // boolean
                $config->setOption('offset_support', false); // boolean
                $rets = new \PHRETS\Session($config);
                $connect = $rets->Login();
                if ($connect) {
                    //echo "<h3 style='color:green'>Connected.....</h3>";
                    echo "\n Connected.....";
                }
                if (!$connect) {
                    $error_details = $rets->Error();
                    $error_text    = strip_tags($error_details['text']);
                    $error_type    = strtoupper($error_details['type']);
                    echo "<center><span style='color:red;font-weight:bold;'>{$error_type} ({$error_details['code']}) {$error_text}</span></center>";
                    //echo "<center><span style='color:red;font-weight:bold;'>{$error_type} ({$error_details['code']}) {$error_text}</span></center>";
                }
                $curr_date_end_time = $curr_date;
                $cron_data = array(
                    'cron_file_name' => $file_name,
                    'cron_start_time' => $curr_date,
                    'property_class' => $className,
                    'mls_no' => $curr_mls_id,
                    'steps_completed' => 1
                );
                // inserting the cron start time in property data
                $this_cron_log_id = DB::table($cron_tablename)->insertGetId($cron_data);
                $timestamp_field = $classconfig['timestamp_field'];
                $status_field = $classconfig['status_field'];
                $status_field_val = $classconfig['status_field_val'];
                $property_data_mapping = $classconfig['property_data_mapping'][$className];
                $property_table_name = $classconfig["property_table_name"];
                $purged_property_table_name = $classconfig["purged_property_table_name"];
                $rets_property_data = $classconfig["rets_property_data"];
                $key_field = $classconfig['key_field'];
                $class_type = (isset($classconfig['class_type']) && !empty($classconfig['class_type'])) ? ',' . $classconfig['class_type'] : '';
                $complete_pull = false;
                $property_query_start_time = get_start_time_for_cron($cron_tablename, $file_name, $className, $curr_mls_id);
                if (isset($property_query_start_time) && $property_query_start_time['status'] == 'start') {
                    $complete_pull = true;
                }
                $date_time = explode(' ', $property_query_start_time['time']);
                $property_query_start_time = $date_time[0] . 'T' . $date_time[1];
                $date_query = "($timestamp_field=$property_query_start_time+)";
                $batables = array();
                $curr_timestamp = time();
                $old_timestamp = strtotime($property_query_start_time);
                $diff = ($curr_timestamp - $old_timestamp);
                $new_starttime = 0;
                if ($diff > 3600 * 24 * 1) {
                    $new_starttime = strtotime("+1 day", $old_timestamp);
                }
                if ($new_starttime > 0 && $new_starttime < time()) {
                    $time_range1 = $property_query_start_time;
                    $time_range2 = date('Y-m-d H:i:s', $new_starttime);
                    $curr_date_end_time = $time_range2;
                    $date_time2 = explode(' ', $time_range2);
                    $datetime_range2 = $date_time2[0] . 'T' . $date_time2[1];
                    $date_query = "($timestamp_field=$time_range1-$datetime_range2)";
                    $property_end_time = $time_range2;
                } else {
                    $property_end_time = $curr_date;
                    $date_query = "($timestamp_field=$property_query_start_time+)";
                }

                echo "\n Class : " . $className;
                echo "\n date_query : " . $date_query;
                $last_date = $property_query_start_time;
                $rets_cond = "(($status_field=$status_field_val))";
                $rets_query = $date_query.",(MLSTATUS=S)";
                //$rets_query = "(MLSTATUS=S)";
                $cron_update_data = array(
                    'properties_download_start_time' => $property_query_start_time,
                    'steps_completed' => 2,
                    'rets_query' => $rets_query
                );
                $cron_cond = array(
                    'id' => $this_cron_log_id
                );
                // update the cron table
                // for testing
                $res = DB::table($cron_tablename)->where('id', $this_cron_log_id)->update($cron_update_data);
                $search = $rets->Search($property_resource,
                    $className, $rets_query,
                    array(
                        'QueryType' => 'DMQL2',
                        'Count' => 2, // count and records
                        'Format' => 'COMPACT-DECODED',
                        'StandardNames' => 0,
                        'Limit' => 100,
                        'Offset' => 2
                    )
                );
                //array('Count' => 1, 'Format' => 'COMPACT-DECODED', 'QueryType' => 'DMQL2');
                $total_property_count = $search->getTotalResultsCount();
                echo "total property count of class = ".$className."count details = ".$total_property_count;
                if ($total_property_count > 0) {
                    echo "\n Count :: $total_property_count";
                    // Update total property found from MLSu
                    $cron_update_data = array(
                        'properties_count_from_mls' => $total_property_count,
                        'steps_completed' => 3
                    );
                    $cron_cond    = array('id' => $this_cron_log_id);
                    $res = DB::table($cron_tablename)->where('id', $this_cron_log_id)->update($cron_update_data);
                    //$record = $search;
                    $limit = 100;
                    $start_index = 1;
                    $lc = (($total_property_count - $start_index) / $limit);
                    for ($lcp = 0; $lcp <= $lc; $lcp++) {
                        $offset = $start_index + $lcp * $limit;
                        echo "\n --" . $offset . " Limit " . $limit . "\n";
                        //$search_chunks       = $rets->Searchquery($property_resource, $className, $rets_query, array('Format' => 'COMPACT-DECODED', 'Count' => 1, "UsePost" => 1,'Select'=>'Ml_num,Lp_dol'));
                        $search = $rets->Search($property_resource,
                            $className, $rets_query,
                            array(
                                'QueryType' => 'DMQL2',
                                'Count' => 1, // count and records
                                'Format' => 'COMPACT-DECODED',
                                'StandardNames' => 0,
                                'Limit' => 100,
                                'Offset' => $offset
                            )
                        );
                        foreach ($search as $record) {
                            $properties_inserted_in_db++;
                            //echo $record[$mls_key];
                            echo "\n Properties db" . $properties_inserted_in_db;
                            $property_data = array();
                            $rets_property_data_value = array();
                            $main_data = array();
                            foreach ($property_data_mapping as $db_key => $mls_key) {
                                if (in_array($mls_key, $rets_property_data)) {
                                    $rets_property_data[$db_key] = $record[$mls_key];
                                }
                                if (isset($record[$mls_key]))
                                    $property_data[$db_key] = $record[$mls_key];
                                else
                                    $property_data[$db_key] = '';
                            }
                            $rets_data = DB::table($property_table_name)->where($key_field, $record[$key_field])->get();
                            if (count($rets_data) > 0) {
                                // delete code
                                DB::table($property_table_name)->where($key_field, $record[$key_field])->delete();
                                // insert data into purged
                                $rets_purged_data = DB::table($purged_property_table_name)->where($key_field, $record[$key_field])->get();
                                if (count($rets_purged_data) > 0) {
                                    $rets_purged = DB::table($purged_property_table_name)->where($key_field, $record[$key_field])->update($property_data);
                                }else{
                                    DB::table($purged_property_table_name)->insertGetId($property_data);
                                }
                                $update_prop++;
                            } else {
                                $insertion_prop++;
                                $rets_purged_data = DB::table($purged_property_table_name)->where($key_field, $record[$key_field])->get();
                                if (count($rets_purged_data) > 0) {
                                    $rets_purged = DB::table($purged_property_table_name)->where($key_field, $record[$key_field])->update($property_data);
                                }else{
                                    DB::table($purged_property_table_name)->insertGetId($property_data);
                                }
                            }
                            if ($className == "RES") {
                                $property_data["CLASSNAME"] = "Residential";
                            }
                            if ($className == "COM") {
                                $property_data["CLASSNAME"] = "Commercial";
                            }
                            if ($className == "RNT") {
                                $property_data["CLASSNAME"] = "Rentals";
                            }
                            if ($className == "MUL") {
                                $property_data["CLASSNAME"] = "MultiFamily";
                            }
                            if ($className == "LND") {
                                $property_data["CLASSNAME"] = "Land";
                            }
                            if ($className == "BUS") {
                                $property_data["CLASSNAME"] = "Bus";
                            }
                            $result = DB::table("rets_property_data")->where($key_field, $record[$key_field])->delete();
                            //$result = RetsPropertyData::destroy([$record[$key_field]]);
                            echo "\n property inserted" . $properties_inserted_in_db;
                        }
                        $cron_update_data = array(
                            'cron_end_time' => date('Y-m-d H:i:s'),
                            'steps_completed' => 4,
                            'properties_count_actual_downloaded' => $properties_inserted_in_db,
                            'property_inserted' => $insertion_prop,
                            'property_updated' => $update_prop,
                            'properties_download_end_time' => $curr_date_end_time,
                            'success' => 1
                        );
                        // update the cron table
                        $res = DB::table($cron_tablename)->where('id', $this_cron_log_id)->update($cron_update_data);
                        //echo "<br>";
                        echo "\n total_property_fetched :: $properties_inserted_in_db";
                        echo "\n total_property_inserted :: $insertion_prop";
                        echo "\n todal_property_updated :: $update_prop";
                    }
                }else {
                    echo "\n no data...";
                    $cron_update_data = array(
                        'cron_end_time' => date('Y-m-d H:i:s'),
                        'steps_completed' => 4,
                        'properties_count_actual_downloaded' => $properties_inserted_in_db,
                        'property_inserted' => $insertion_prop,
                        'property_updated' => $update_prop,
                        'properties_download_end_time' => $curr_date_end_time,
                        'success' => 1
                    );
                    // update the cron table
                    $res = DB::table($cron_tablename)->where('id', $this_cron_log_id)->update($cron_update_data);
                }
            }
        }
    }

    public function create_table_sql_from_metadata($table_name, $rets_metadata, $key_field, $field_prefix = "")
    {
        $sql_query = "CREATE TABLE {$table_name} (\n";
        foreach ($rets_metadata as $field) {
//            if ($field["StandardName"] == "") {
//                $systemName = $field["SystemName"];
//            }else {
//                $systemName = $field["StandardName"];
//            }
            $systemName = $field["SystemName"];
            $field['SystemName'] = "`{$field_prefix}{$systemName}`";
            $cleaned_comment = addslashes($field['LongName']);
            $sql_make = "{$systemName} ";
            if ($field['Interpretation'] == "LookupMulti") {
                $sql_make .= "TEXT";
            } elseif ($field['Interpretation'] == "Lookup") {
                $sql_make .= "VARCHAR(50)";

            } elseif ($field['DataType'] == "Int" || $field['DataType'] == "Small" || $field['DataType'] == "Tiny") {

                $sql_make .= "INT({$field['MaximumLength']})";

            } elseif ($field['DataType'] == "Long") {

                $sql_make .= "BIGINT({$field['MaximumLength']})";

            } elseif ($field['DataType'] == "DateTime") {

                $sql_make .= "DATETIME default '0000-00-00 00:00:00' not null";

            } elseif ($field['DataType'] == "Character" && $field['MaximumLength'] <= 255) {

                $sql_make .= "VARCHAR({$field['MaximumLength']})";

            } elseif ($field['DataType'] == "Character" && $field['MaximumLength'] > 255) {

                $sql_make .= "TEXT";

            } elseif ($field['DataType'] == "Decimal") {

                $pre_point = ($field['MaximumLength'] - $field['Precision']);

                $post_point = !empty($field['Precision']) ? $field['Precision'] : 0;

                $sql_make .= "DECIMAL({$field['MaximumLength']},{$post_point})";

            } elseif ($field['DataType'] == "Boolean") {

                $sql_make .= "CHAR(1)";

            } elseif ($field['DataType'] == "Date") {

                $sql_make .= "DATE default '0000-00-00' not null";

            } elseif ($field['DataType'] == "Time") {

                $sql_make .= "TIME default '00:00:00' not null";

            } else {

                $sql_make .= "VARCHAR(255)";

            }


            $sql_make .= " COMMENT '{$cleaned_comment}'";

            $sql_make .= ",\n";


            $sql_query .= $sql_make;

        }



        $sql_query .= "PRIMARY KEY(`{$field_prefix}{$key_field}`) )";


        return $sql_query;


    }
    public function createMapping($rets_metadata)
    {
        foreach ($rets_metadata as $field) {
            $array[$field["SystemName"]] = $field["SystemName"].",";
        }
        return $array;
    }
}
