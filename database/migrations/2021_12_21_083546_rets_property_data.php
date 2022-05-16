<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RetsPropertyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rets_property_data', function (Blueprint $table) {

            $table->integer('id',11);
            $table->string('LISTINGID');
            $table->string('ADDRESSINCLUDED',255)->nullable();
            $table->string('AGENTFIRSTNAME',255)->nullable()->default('NULL');
            $table->string('AGENTID',255)->nullable()->default('NULL');
            $table->string('AGENTLASTNAME',255)->nullable()->default('NULL');
            $table->string('AGENTOFFICEFEED',255)->nullable()->default('NULL');
            $table->string('AGENTOFFICEPHONE',255)->nullable()->default('NULL');
            $table->string('BATHS',255)->nullable()->default('NULL');
            $table->string('BATHSDESC',255)->nullable()->default('NULL');
            $table->string('BATHSFULL',255)->nullable()->default('NULL');
            $table->string('BATHSHALF',255)->nullable()->default('NULL');
            $table->string('BEDS',255)->nullable()->default('NULL');
            $table->string('COUNTY',255)->nullable()->default('NULL');
            $table->string('COUNTYCODE',255)->nullable()->default('NULL');
            $table->string('GARAGE',255)->nullable()->default('NULL');
            $table->string('GARAGEDESC',255)->nullable()->default('NULL');
            $table->string('YEARBUILT',255)->nullable()->default('NULL');
            $table->string('YEARBUILTDESC',255)->nullable()->default('NULL');
            $table->string('ZIPCODETAX',255)->nullable()->default('NULL');
            $table->string('CLASSNAME',255)->nullable()->default('NULL');
            $table->string('LONGITUDE',255)->nullable()->default('NULL');
            $table->string('LATITUDE',255)->nullable()->default('NULL');
            $table->string('LSTNGSYSID',255)->nullable()->default('NULL');
            $table->string('POSTALCODE',255)->nullable()->default('NULL');
            $table->string('UNITNUMBER',255)->nullable()->default('NULL');
            $table->string('LISTPRICE',255)->nullable()->default('NULL');
            $table->string('ORIGINALLISTPRICE',255)->nullable()->default('NULL');
            $table->string('CITY',255)->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('rets_property_data');
    }
}
