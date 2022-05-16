<?php

namespace App\Http\Controllers;

use App\Models\RetsPropertyDataImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    //
    public function importImages() {
        $all_mls = config('mls_config.mls_login_parameter');
        $cron_tablename = "properties_cron_log";
        $file_name = "imagesListing";
        $image_table_name       = "rets_property_data_image";
        /************ Entry in DB for This Cron Run time **********/
        $curr_date = date('Y-m-d H:i:s');
        // For all MLSs - Starts
        $txt = "<table>";
        foreach ($all_mls as $curr_mls_id => $curr_mls) {
            Log::info("Images Cron Now Started = ".date("Y-m-d"));
            $curr_mls_name = $curr_mls['mls_name'];
            echo "\n Started for " . $curr_mls_name;
            $property_resource = config('mls_config.rets_query_array.' . $curr_mls_id . '.property_resource');
            $property_class = config('mls_config.rets_query_array.' . $curr_mls_id . '.property_classes');
            //$txt .= "<td>Started for " . $curr_mls_name . "</td>";
            foreach ($property_class as $className => $classconfig) {
                echo "\n ClassName = ".$className;
                #if ($className == "RES") continue;
                $curr_date = date('Y-m-d H:i:s');
                echo "\n $className";
                //$txt .= "<td>$className</td>";
                $login_parameters = config('mls_config.mls_login_parameter');
                // curr_mls_id
                $login_parameter = $login_parameters[$curr_mls_id];
                $property_data_mapping = $classconfig['property_data_mapping'][$className];
                $property_table_name = $classconfig['property_table_name'];
                $key_field = $classconfig['key_field'];
                //Helper for login
                $rets = mls_login($login_parameter);
                $txt .= "<tr>
                            <th style='border:1px solid black'>Table Name</th>
                            <th style='border:1px solid black'>Action</th>
                            <th style='border:1px solid black'>ListingId</th>
                            <th style='border:1px solid black'>Image name</th>
                            <th style='border:1px solid black'>S3 Url </th
                            <th style='border:1px solid black'>Images Url</th>
                         </tr>";
                $properties_data = DB::table($property_table_name)->where("IMAGEDOWNLOADED","=",0)->where("IMAGEDOWNLOADEDTRIED","=",0)->limit(100)->get();
                foreach ($properties_data as $key => $property_data) {
                    $txt .= "<tr>";
                    $mlsId = $property_data->LISTINGID;
                    $image_download_tried = $property_data->IMAGEDOWNLOADEDTRIED;
                    if ($image_download_tried == ""){
                        $image_download_tried = 0;
                    }
                    $curr_date = date('Y-m-d H:i:s');
                    $img_found = 0;
                    //$mlsId = "3756775";
                    $photos = $rets->GetObject("Property", 'Photo', $mlsId, "*");
                    $showS3 = "";
                    $showFile = "";
                    $photo_count = collect($photos)->count();
                    echo "\n Photo Count = ==".$photo_count;
                    if (count($photos) > 0) {
                        $file = "";
                        $upload_dir = "/mls_images/";
                        $img_found = 1;
                        $photoArray = array();
                        $s3photoArray = array();
                        echo "\n $property_table_name";
                        foreach ($photos as $key => $photo) {
                            if ($photo->getObjectId() > 0 ) {
                                $img_found = 1;
                                $upload_dir_img = storage_path() . $upload_dir;
                                if (!File::exists($upload_dir_img)) {
                                    Log::info("Creating directory for image [mls_images]");
                                    File::makeDirectory($upload_dir_img, 0755, true, true);
                                }
                                $img_dir = "mls_images/".$className."/Photo-". $mlsId . "_" . $key . ".jpeg";
                                $file = $upload_dir_img . $img_dir;
                                //$dir_name = $upload_dir . $img_dir;
                                $dir_name = $img_dir;
                                $img_n = $photo->getContent();
                                //$success = file_put_contents($file, $img_n);
                                Storage::disk('public')->put($img_dir,$img_n,'public');
                                $fileUrl = Storage::disk('public')->url( $img_dir);
                                echo "\n This is the file URL = ".$fileUrl;
                                $update_data = array(
                                    "mls_no" => $curr_mls_id,
                                    "listingID" => $mlsId,
                                    "image_directory" => $upload_dir,
                                    "image_path" => $upload_dir,
                                    "image_url" => $dir_name,
                                    "s3_image_url" => $fileUrl,
                                    "image_name" => $dir_name,
                                    "downloaded_time" => $curr_date,
                                    "is_download" => 1,
                                    "is_resized1" => 0,
                                    "is_resized2" => 0,
                                    "is_resized3" => 0,
                                    "mls_order" => $curr_mls_id,
                                    "updated_time" => $curr_date,
                                    "image_last_tried_time" => $curr_date,
                                    "property_id" => $property_data->id
                                );
                                if ($img_found) {
                                    $txt .= "<td style='border:1px solid black'>$property_table_name</td>";
                                    $txt .= "<td style='border:1px solid black'><span style='color:green;'> Images Inserted </span></td>";
                                    $txt .= "<td style='border:1px solid black'>".$update_data['listingID']."</td>";
                                    $txt .= "<td style='border:1px solid black'>".$file_name."</td>";
                                    $txt .= "<td style='border:1px solid black'>".$fileUrl."</td>";
                                    $txt .= "<td style='border:1px solid black'>".$update_data['image_url']."</td>";
                                    //$properties_data = DB::table($property_table_name)->where($key_field, $mlsId)->update(['image_downloaded' => DB::raw('image_downloaded+1'), "property_last_updated" => $curr_date, "image_downloaded_time" => $curr_date]);
                                    $properties_data = DB::table($property_table_name)->where("LISTINGID", $mlsId)->update(['IMAGEDOWNLOADED' => 1,   "IMAGEDOWNLOADEDTIME" => $curr_date]);
                                } else {
                                    $txt .= "<td style='border:1px solid black'><span style='color:red;'>Not Uploaded </span>" . $mlsId."</td>";
                                    $update_data["is_download"] = 0;
                                    $properties_data = DB::table($property_table_name)->where($key_field, $mlsId)->update(['IMAGEDOWNLOADED' => 0,'IMAGEDOWNLOADEDTRIED' => $image_download_tried+1,  "IMAGEDOWNLOADEDTIME" => $curr_date]);
                                }
                                RetsPropertyDataImage::create($update_data);
                                $txt .= "</tr>";
                            } else {
                                Log::warning("No image data found for listing id => ".$mlsId);
                                $properties_data = DB::table($property_table_name)->where($key_field, $mlsId)->update(['IMAGEDOWNLOADED' => 0,'IMAGEDOWNLOADEDTRIED' => $image_download_tried+1,  "IMAGEDOWNLOADEDTIME" => $curr_date]);
                            }
                        }
                        //RetsPropertyDataImageMongo::updateOrCreate(["listingID" => $mlsId], $update_data);
                    } else {
                        Log::warning("No image data found for Listing id = ".$mlsId);
                    }

                }
                // exit;
            }
            $subject = "Images Insertion";
            //sendEmail("SMTP",env('SUPERBBROKERFROM'),env('SUPERBBROKERTO'),env('ALERT_CC_EMAIL_ID'),env('ALERT_BCC_EMAIL_ID'), $subject,$txt);
            echo $txt;
        }
    }
}
