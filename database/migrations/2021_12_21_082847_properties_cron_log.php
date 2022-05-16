<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertiesCronLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('properties_cron_log', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->string('cron_file_name',50)->nullable()->default('NULL');
            $table->string('property_class',50)->nullable()->default('NULL');
            $table->string('rets_query',300)->nullable()->default('NULL');
            $table->datetime('cron_start_time')->nullable() ;
            $table->datetime('cron_end_time')->nullable() ;
            $table->datetime('properties_download_start_time')->nullable() ;
            $table->datetime('properties_download_end_time')->nullable() ;
            $table->integer('properties_count_from_mls')->default('0');
            $table->integer('properties_count_actual_downloaded')->default('0');
            $table->string('property_inserted',50)->nullable()->default('NULL');
            $table->string('property_updated',50)->nullable()->default('NULL');
            $table->string('steps_completed')->default('0');
            $table->integer('mls_no')->nullable();
            $table->tinyInteger('success')->default('0');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('properties_cron_log');
    }
}
