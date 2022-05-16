<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RetsPropertyDataResi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rets_property_data_resi', function (Blueprint $table) {
            $table->integer('id',11);
            $table->decimal('ACRES', 9, 2)->nullable();
            $table->string('ACRESTAX', 14)->nullable()->default('NULL');
            $table->string('ADDRESSINCLUDED', 14)->nullable()->default('NULL');
            $table->string('AGENT2LISTFIRSTNAME', 50)->nullable()->default('NULL');
            $table->string('AGENT2LISTLASTNAME', 50)->nullable()->default('NULL');
            $table->string('AGENT2LISTOFFICEPHONE', 16)->nullable()->default('NULL');
            $table->string('AGENT2LISTPAGER', 16)->nullable()->default('NULL');
            $table->string('AGENT2LISTPHONE', 16)->nullable()->default('NULL');
            $table->string('AGENTCOLIST', 20)->nullable()->default('NULL');
            $table->string('AGENTCOSELL', 20)->nullable()->default('NULL');
            $table->string('AGENTFIRSTNAME', 50)->nullable()->default('NULL');
            $table->string('AGENTID', 20)->nullable()->default('NULL');
            $table->string('AGENTLASTNAME', 50)->nullable()->default('NULL');
            $table->string('AGENTOFFICEFEED', 14)->nullable()->default('NULL');
            $table->string('AGENTOFFICEPHONE', 16)->nullable()->default('NULL');
            $table->string('AGENTPAGER', 16)->nullable()->default('NULL');
            $table->string('AGENTPHONE', 16)->nullable()->default('NULL');
            $table->string('AGENTSELL', 20)->nullable()->default('NULL');
            $table->date('ANTICCLOSEDDATE');
            $table->decimal('APPFEE', 6, 0)->nullable();
            $table->text('APPLIANCES')->nullable();
            $table->string('ARIP', 14)->nullable()->default('NULL');
            $table->integer('ASSESSAMOUNTBLDG')->nullable();
            $table->string('ASSESSAMOUNTBLDGTAX', 14)->nullable()->default('NULL');
            $table->integer('ASSESSAMOUNTLAND')->nullable();
            $table->string('ASSESSAMOUNTLANDTAX', 14)->nullable()->default('NULL');
            $table->text('ASSESSFARMp')->nullable();
            $table->string('ASSESSTOTALTAX', 14)->nullable()->default('NULL');
            $table->string('ASSOCFEEFREQ', 50)->nullable()->default('NULL');
            $table->decimal('ASSOCIATIONFEE', 6, 0)->nullable();
            $table->string('ASSOCMGMTNAME', 39)->nullable()->default('NULL');
            $table->string('ASSOCMGMTPHONE', 16)->nullable()->default('NULL');
            $table->text('BASEDESC')->nullable();
            $table->string('BASEMENT', 50)->nullable()->default('NULL');
            $table->decimal('BATHS', 4, 1)->nullable();
            $table->text('BATHSDESC')->nullable();
            $table->integer('BATHSFULL')->nullable();
            $table->integer('BATHSHALF')->nullable();
            $table->string('BED1LEVEL', 50)->nullable()->default('NULL');
            $table->string('BED2LEVEL', 50)->nullable()->default('NULL');
            $table->string('BED3LEVEL', 50)->nullable()->default('NULL');
            $table->string('BED4LEVEL', 50)->nullable()->default('NULL');
            $table->string('BEDROOM1DIM', 54)->nullable()->default('NULL');
            $table->string('BEDROOM2DIM', 54)->nullable()->default('NULL');
            $table->string('BEDROOM3DIM', 54)->nullable()->default('NULL');
            $table->string('BEDROOM4DIM', 54)->nullable()->default('NULL');
            $table->integer('BEDS')->nullable();
            $table->string('BLOCKID', 10)->nullable()->default('NULL');
            $table->string('BLOCKIDTAX', 14)->nullable()->default('NULL');
            $table->string('BUILDINGNUM', 54)->nullable()->default('NULL');
            $table->text('BUSRELATION')->nullable();

            $table->string('CITY', 26)->nullable()->default('NULL');
            $table->date('CLOSEDATE');
            $table->decimal('CLOSEPRICE', 8, 0)->nullable();
            $table->string('COLISTAGENTNAME', 50)->nullable()->default('NULL');
            $table->text('COMMLIVING')->nullable();
            $table->string('COMPBUY', 13)->nullable()->default('NULL');
            $table->text('COMPLEXFEATURES')->nullable();
            $table->string('COMPSELL', 13)->nullable()->default('NULL');
            $table->string('COMPTRANS', 13)->nullable()->default('NULL');
            $table->string('CONDOMINIUM', 14)->nullable()->default('NULL');
            $table->string('CONFIDENTIALINCLUDED', 14)->nullable()->default('NULL');
            $table->date('CONTRACTDATE');
            $table->text('COOLING')->nullable();
            $table->string('COSELLAGENTNAME', 50)->nullable()->default('NULL');
            $table->string('COUNTY', 50)->nullable()->default('NULL');
            $table->string('COUNTYCODE', 24)->nullable()->default('NULL');
            $table->string('COUNTYCODETAX', 14)->nullable()->default('NULL');
            $table->string('COUNTYTAX', 14)->nullable()->default('NULL');

            $table->integer('DAYSONMARKET')->nullable();
            $table->string('DININGROOMDIM', 54)->nullable()->default('NULL');
            $table->string('DIRECTIONS', 100)->nullable()->default('NULL');
            $table->text('DISCLOSUREAVAIL')->nullable();
            $table->integer('DOMACT')->nullable();
            $table->integer('DOMCOMP')->nullable();
            $table->text('DRIVEWAYDESC')->nullable();
            $table->string('EASEDESC', 13)->nullable()->default('NULL');
            $table->text('EASEMENT')->nullable();
            $table->string('ELEMENTARYSCHOOL', 10)->nullable()->default('NULL');
            $table->string('EXCLUSIONS', 71)->nullable()->default('NULL');
            $table->date('EXPIRATIONDATE');
            $table->text('EXTERIOR')->nullable();
            $table->text('EXTERIORFEATURES')->nullable();
            $table->string('FAMILYROOMDIM', 54)->nullable()->default('NULL');
            $table->string('FARM', 14)->nullable()->default('NULL');
            $table->text('FEEINCLUDES')->nullable();
            $table->decimal('FEEOTHER', 6, 0)->nullable();
            $table->text('FEEOTHERFREQ')->nullable();
            $table->string('FHAAGERESTR', 50)->nullable()->default('NULL');
            $table->text('FIREPLACEDESC')->nullable();
            $table->integer('FIREPLACES')->nullable();
            $table->date('FIRSTSHOWINGDATE');
            $table->string('FLOORNUM', 14)->nullable()->default('NULL');
            $table->text('FLOORS')->nullable();

            $table->decimal('GARAGE', 2, 0)->nullable();
            $table->text('GARAGEDESC')->nullable();
            $table->string('HANDICAP', 50)->nullable()->default('NULL');
            $table->text('HEATING')->nullable();
            $table->text('HEATSRC')->nullable();
            $table->string('HIGHSCHOOL', 10)->nullable()->default('NULL');
            $table->integer('IMAGECOUNT')->nullable();
            $table->datetime('IMAGEDATE');
            $table->text('INTERIORFEATURES')->nullable();
            $table->string('INTERNETAUTOMATEDVALUATIONDISPLAYYN', 14)->nullable();
            $table->string('INTERNETCONSUMERCOMMENTYN', 14)->nullable();
            $table->string('KITCHENDIM', 54)->nullable();
            $table->datetime('LASTMODIFIED');
            $table->decimal('LATITUDE', 12, 8)->nullable();
            $table->string('LENDERAPPROVAL', 50)->nullable();
            $table->string('LISTAGENTNAME', 50)->nullable();
            $table->string('LISTAGENTPHONE', 16)->nullable();
            $table->date('LISTDATE');
            $table->string('LISTINGID', 38)->nullable();
            $table->string('LISTINGSTATUS', 50)->nullable();
            $table->text('LISTINGTYPE')->nullable();
            $table->string('LISTOFFICEFAX', 16)->nullable();
            $table->string('LISTOFFICENAME', 50)->nullable();
            $table->string('LISTOFFICEPHONE', 16)->nullable();
            $table->decimal('LISTPRICE', 8, 0)->nullable();
            $table->string('LISTTYPERESO', 50)->nullable();
            $table->string('LIVINGROOMDIM', 54)->nullable();
            $table->text('LOANTERMS')->nullable();
            $table->decimal('LONGITUDE', 12, 8)->nullable();
            $table->text('LOTDESC')->nullable();
            $table->string('LOTID', 10)->nullable();
            $table->string('LOTIDTAX', 14)->nullable();
            $table->string('LOTSIZE', 25)->nullable();
            $table->string('LOTSIZETAX', 14)->nullable();
            $table->decimal('LSTNGSYSID', 15, 0)->nullable();




            $table->datetime('MAJORCHANGETIMESTAMP');
            $table->string('MIDDLESCHOOL', 10)->nullable();
            $table->string('MLSTATUS', 50)->nullable();
            $table->string('OFFFICEBROKERID', 20)->nullable();
            $table->string('OFFICEID', 20)->nullable();
            $table->string('OFFICESELL', 20)->nullable();
            $table->string('OFFICESELLBROKERID', 20)->nullable();
            $table->string('OFFICESELLFAX', 16)->nullable();
            $table->string('OFFICESELLNAME', 50)->nullable();
            $table->string('OFFICESELLPHONE', 16)->nullable();
            $table->decimal('OPENPARKING', 3, 0)->nullable();
            $table->datetime('ORIGINALENTRYDATETIME');
            $table->decimal('ORIGINALLISTPRICE', 8, 0)->nullable();
            $table->string('OTHERROOM1DIM', 54)->nullable();
            $table->string('OTHERROOM2DIM', 54)->nullable();
            $table->string('OTHERROOM3DIM', 54)->nullable();
            $table->string('OTHERROOM4DIM', 54)->nullable();
            $table->text('OTHERUSE')->nullable();
            $table->string('OUTOFCOUNTY', 14)->nullable();
            $table->string('OWNERNAMETAX', 14)->nullable();
            $table->string('OWNERPHONE', 12)->nullable();
            $table->string('OWNERSHIPTYPE', 50)->nullable();
            $table->string('OWNERSNAME', 39)->nullable();
            $table->text('PETS')->nullable();
            $table->text('PHOTOINSTR')->nullable();
            $table->text('POOL')->nullable();
            $table->text('POOLDESC')->nullable();
            $table->string('POSSESSION', 15)->nullable();
            $table->text('POSSESSIONRESO')->nullable();
            $table->string('POSTALCODE', 10)->nullable();
            $table->string('PROPCOLOR', 10)->nullable();
            $table->text('PUBLICREMARKS')->nullable();
            $table->string('RCOMZIP', 54)->nullable();
            $table->string('REMARKS', 100)->nullable();
            $table->text('REMARKSPUBADD')->nullable();
            $table->integer('RENOVATED')->nullable();
            $table->string('REQUIREOFFICEINFO', 14)->nullable();
            $table->text('ROOF')->nullable();
            $table->text('ROOMBASELVLDESC')->nullable();
            $table->string('ROOMDENDIM', 54)->nullable();
            $table->string('ROOMDENLEVEL', 50)->nullable();
            $table->text('ROOMDININGDESC')->nullable();
            $table->string('ROOMDININGLEVEL', 50)->nullable();
            $table->string('ROOMFAMILYLEVEL', 50)->nullable();
            $table->text('ROOMGROUNDLVLDESC')->nullable();
            $table->text('ROOMKITCHENDESC')->nullable();
            $table->string('ROOMKITCHENLEVEL', 50)->nullable();
            $table->string('ROOMLIVINGLEVEL', 50)->nullable();
            $table->text('ROOMLVL1DESC')->nullable();
            $table->text('ROOMLVL2DESC')->nullable();
            $table->text('ROOMLVL3DESC')->nullable();
            $table->text('ROOMLVLOTHERDESC')->nullable();
            $table->text('ROOMMASTERBEDDESC')->nullable();
            $table->string('ROOMOTHER1', 50)->nullable();
            $table->string('ROOMOTHER1LEVEL', 50)->nullable();
            $table->string('ROOMOTHER2', 50)->nullable();
            $table->string('ROOMOTHER2LEVEL', 50)->nullable();
            $table->string('ROOMOTHER3', 50)->nullable();
            $table->string('ROOMOTHER3LEVEL', 50)->nullable();
            $table->string('ROOMOTHER4', 50)->nullable();
            $table->string('ROOMOTHER4LEVEL', 50)->nullable();

            $table->string('SELLAGENT2FIRSTNAME', 50)->nullable();
            $table->string('SELLAGENT2LASTNAME', 50)->nullable();
            $table->string('SELLAGENT2OFFICEPHONE', 16)->nullable();
            $table->string('SELLAGENT2PAGER', 16)->nullable();
            $table->string('SELLAGENT2PHONE', 16)->nullable();
            $table->string('SELLAGENTFIRSTNAME', 50)->nullable();
            $table->string('SELLAGENTLASTNAME', 50)->nullable();
            $table->string('SELLAGENTNAME', 50)->nullable();
            $table->string('SELLAGENTOFFICEPHONE', 16)->nullable();
            $table->string('SELLAGENTPAGER', 16)->nullable();
            $table->string('SELLAGENTPHONE', 16)->nullable();
            $table->text('SERVICES')->nullable();
            $table->text('SEWER')->nullable();
            $table->text('SHOWINGINSTRUCTIONS')->nullable();
            $table->string('SHOWSPECIAL', 68)->nullable();
            $table->string('SIGN', 50)->nullable();
            $table->decimal('SQFTAPPROX', 6, 0)->nullable();
            $table->string('STREETNAME', 24)->nullable();
            $table->string('STREETNAMETAX', 14)->nullable();
            $table->decimal('STREETNUMBER', 9, 0)->nullable();
            $table->string('STREETNUMDISPLAY', 94)->nullable();
            $table->string('STREETNUMTAX', 14)->nullable();
            $table->text('STYLE')->nullable();
            $table->text('STYLEPRIMARY')->nullable();
            $table->string('SUBDIVISION', 20)->nullable();
            $table->string('SUBPROPTYPE', 50)->nullable();
            $table->text('SUITE')->nullable();
            $table->text('SUITEDES')->nullable();

            $table->integer('TAXAMOUNT')->nullable();
            $table->string('TAXAMOUNTTAX', 14)->nullable();
            $table->integer('TAXASSESSEDVALUATION')->nullable();
            $table->string('TAXID', 50)->nullable();
            $table->string('TAXIDTAX', 14)->nullable();
            $table->decimal('TAXRATE', 5, 2)->nullable();
            $table->string('TAXRATETAX', 14)->nullable();
            $table->integer('TAXRATEYEAR')->nullable();
            $table->integer('TAXYEAR')->nullable();
            $table->string('TAXYEARTAX')->nullable();
            $table->integer('TOTALROOMS')->nullable();
            $table->string('TOWNCODE', 44)->nullable();
            $table->string('TOWNCODETAX', 14)->nullable();
            $table->string('TOWNTAX', 14)->nullable();
            $table->string('UNITNUMBER', 44)->nullable();
            // $table->text('UTILITIES')->nullable();
            // $table->string('WARRANTY')->nullable();
            // $table->text('WATER')->nullable();
            // $table->text('WATERHEATER')->nullable();
            // $table->date('WITHDRAWNDATE')->nullable();
            // $table->integer('YEARBUILT')->nullable();
            // $table->text('YEARBUILTDESC')->nullable();
            // $table->string('ZIPCODETAX')->nullable();
            // $table->string('ZONING')->nullable();

            $table->integer('IMAGEDOWNLOADED')->default('0');
            $table->integer('IMAGEDOWNLOADEDTRIED')->nullable();
            $table->string('IMAGEDOWNLOADEDTIME')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rets_property_data_resi');
    }
}
