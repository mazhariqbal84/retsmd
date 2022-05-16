<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RetsPropertyDataRn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rets_property_data_rn', function (Blueprint $table) {

            $table->integer('id',11);
            $table->decimal('ACRES',9,2)->nullable();
            $table->string('ACRESTAX',14)->nullable()->default('NULL');
            $table->string('ADDRESSINCLUDED',14)->nullable()->default('NULL');
            $table->string('AGENTCOLIST',20)->nullable()->default('NULL');
            $table->string('AGENTCORENT',20)->nullable()->default('NULL');
            $table->string('AGENTID',20)->nullable()->default('NULL');
            $table->string('AGENTOFFICEFEED',14)->nullable()->default('NULL');
            $table->string('AGENTRENT',20)->nullable()->default('NULL');
            $table->date('ANTICCLOSEDDATE');
            $table->text('APPLIANCES')->nullable();
            $table->string('ARIP',14)->nullable()->default('NULL');
            $table->text('ASSESSFARM')->nullable();
            $table->string('ASSOCFEEFREQ',50)->nullable()->default('NULL');
            $table->decimal('ASSOCIATIONFEE',6,0)->nullable();
            $table->string('ASSOCMGMTNAME',39)->nullable()->default('NULL');
            $table->string('ASSOCMGMTPHONE',16)->nullable()->default('NULL');
            $table->text('AVAILABLE')->nullable();

            $table->text('BASEDESC')->nullable();
            $table->string('BASEMENT',50)->nullable()->default('NULL');
            $table->decimal('BATHS',4,1)->nullable();
            $table->integer('BATHSFULL')->nullable();
            $table->integer('BATHSHALF')->nullable();
            $table->string('BED1LEVEL',50)->nullable()->default('NULL');
            $table->string('BED2LEVEL',50)->nullable()->default('NULL');
            $table->string('BED3LEVEL',50)->nullable()->default('NULL');
            $table->string('BEDROOM1DIM',54)->nullable()->default('NULL');
            $table->string('BEDROOM2DIM',54)->nullable()->default('NULL');
            $table->string('BEDROOM3DIM',54)->nullable()->default('NULL');
            $table->integer('BEDS')->nullable();
            $table->string('BUILDINGNUM',54)->nullable()->default('NULL');
            $table->text('BUSCLASSRN')->nullable();
            $table->string('BUSINESSNAME',20)->nullable()->default('NULL');
            $table->text('BUSRELATION')->nullable();

            $table->string('CITY',26)->nullable()->default('NULL');
            $table->date('CLOSEDATE');
            $table->string('COLISTAGENTNAME',50)->nullable()->default('NULL');
            $table->text('COMMLIVING')->nullable();
            $table->string('COMPBUY',13)->nullable()->default('NULL');
            $table->text('COMPLEXFEATURES')->nullable();
            $table->string('COMPSELL',13)->nullable()->default('NULL');
            $table->string('COMPTRANS',13)->nullable()->default('NULL');
            $table->string('CONFIDENTIALINCLUDED',14)->nullable()->default('NULL');
            $table->date('CONTRACTDATE');
            $table->text('COOLING')->nullable();
            $table->string('COSELLAGENTNAME',50)->nullable()->default('NULL');
            $table->string('COUNTY',50)->nullable()->default('NULL');
            $table->string('COUNTYCODE',24)->nullable()->default('NULL');
            $table->string('COUNTYCODETAX',14)->nullable()->default('NULL');
            $table->string('COUNTYTAX',14)->nullable()->default('NULL');

            $table->integer('DAYSONMARKET')->nullable();
            $table->string('DININGROOMDIM',54)->nullable()->default('NULL');
            $table->string('DIRECTIONS',100)->nullable()->default('NULL');
            $table->text('DISCLOSUREAVAIL')->nullable();
            $table->integer('DOMACT')->nullable();
            $table->decimal('DOORHIMAX',5,0)->nullable();
            $table->text('DRIVEWAYDESC')->nullable();
            $table->string('EASEDESC',13)->nullable()->default('NULL');
            $table->text('EASEMENT')->nullable();
            $table->string('ELEMENTARYSCHOOL',10)->nullable()->default('NULL');
            $table->decimal('EXPENSEOPERATING',8,0)->nullable();
            $table->date('EXPIRATIONDATE');
            $table->text('EXTERIORFEATURES')->nullable();
            $table->string('FAMILYROOMDIM',54)->nullable()->default('NULL');
            $table->string('FHAAGERESTR',50)->nullable()->default('NULL');
            $table->text('FIREPLACEDESC')->nullable();
            $table->integer('FIREPLACES')->nullable();
            $table->date('FIRSTSHOWINGDATE');
            $table->string('FLOORNUM',14)->nullable()->default('NULL');
            $table->text('FLOORS')->nullable();
            $table->text('FURNISHINFO')->nullable();

            $table->decimal('GARAGE',2,0)->nullable();
            $table->text('GARAGEDESC')->nullable();
            $table->decimal('GROSSINCOME',8,0)->nullable();
            $table->string('HANDICAP',50)->nullable()->default('NULL');
            $table->text('HEATING')->nullable();
            $table->text('HEATSRC')->nullable();
            $table->string('HIGHSCHOOL',10)->nullable()->default('NULL');
            $table->string('HOURSOFOPERATION',45)->nullable()->default('NULL');
            $table->integer('IMAGECOUNT')->nullable();
            $table->datetime('IMAGEDATE');
            $table->text('INTERIORFEATURES')->nullable();
            $table->string('INTERNETAUTOMATEDVALUATIONDISPLAYYN',41)->nullable()->default('NULL');
            $table->string('INTERNETCONSUMERCOMMENTYN',14)->nullable()->default('NULL');
            $table->string('KITCHENDIM',54)->nullable()->default('NULL');
            $table->datetime('LASTMODIFIED');
            $table->decimal('LATITUDE',12,8)->nullable();
            $table->text('LAUNDRYFAC')->nullable();
            $table->date('LEASEEXPIREDATE');
            $table->text('LEASETERMS')->nullable();
            $table->string('LISTAGENTNAME',50)->nullable()->default('NULL');
            $table->string('LISTAGENTPHONE',16)->nullable()->default('NULL');
            $table->date('LISTDATE');
            $table->string('LISTINGID',38)->nullable()->default('NULL');
            $table->string('LISTINGSTATUS',50)->nullable()->default('NULL');
            $table->text('LISTINGTYPE')->nullable();
            $table->string('LISTOFFICEFAX',16)->nullable()->default('NULL');
            $table->string('LISTOFFICENAME',50)->nullable()->default('NULL');

            $table->string('LISTOFFICEPHONE',16)->nullable()->default('NULL');
            $table->string('LISTTYPERESO',50)->nullable()->default('NULL');
            $table->string('LIVINGROOMDIM',54)->nullable()->default('NULL');
            $table->text('LOCATION')->nullable();
            $table->decimal('LONGITUDE',12,8)->nullable();
            $table->text('LOTDESC')->nullable();
            $table->string('LOTSIZE',25)->nullable()->default('NULL');
            $table->string('LOTSIZETAX',14)->nullable()->default('NULL');
            $table->decimal('LSTNGSYSID',15,0)->nullable();

            $table->datetime('MAJORCHANGETIMESTAMP');
            $table->string('MIDDLESCHOOL',10)->nullable()->default('NULL');
            $table->text('MISCINFO')->nullable();
            $table->string('MLSTATUS',50)->nullable()->default('NULL');
            $table->decimal('NETINCOME',8,0)->nullable();
            $table->string('NUMAMPS',64)->nullable()->default('NULL');
            $table->decimal('NUMDOCKS',5,0)->nullable();
            $table->decimal('NUMDOORS',5,0)->nullable();
            $table->decimal('NUMEMPLOY',5,0)->nullable();
            $table->string('NUMVOLTS',64)->nullable()->default('NULL');
            $table->date('OCCUPDATE');
            $table->string('OFFICEID',20)->nullable()->default('NULL');
            $table->string('OFFICERENT',20)->nullable()->default('NULL');
            $table->decimal('OPENPARKING',3,0)->nullable();
            $table->datetime('ORIGINALENTRYDATETIME');
            $table->string('OTHERROOM1DIM',54)->nullable()->default('NULL');
            $table->string('OTHERROOM2DIM',54)->nullable()->default('NULL');
            $table->string('OTHERROOM3DIM',54)->nullable()->default('NULL');
            $table->string('OUTOFCOUNTY',14)->nullable()->default('NULL');
            $table->string('OWNERNAMETAX',14)->nullable()->default('NULL');
            $table->text('OWNERPAYS')->nullable();
            $table->string('OWNERPHONE',12)->nullable()->default('NULL');
            $table->string('OWNERSNAME',39)->nullable()->default('NULL');

            $table->text('PETS')->nullable();
            $table->text('PHOTOINSTR')->nullable();
            $table->string('POSSESSION',15)->nullable()->default('NULL');
            $table->text('POSSESSIONRESO')->nullable();
            $table->string('POSTALCODE',10)->nullable()->default('NULL');
            $table->text('PRERENTREQUIRE')->nullable();
            $table->text('PROPERTYTYPE')->nullable();
            $table->string('PROPERTYTYPEPRIMARY',50)->nullable()->default('NULL');
            $table->string('PROPSUBTYPERN',50)->nullable()->default('NULL');
            $table->text('PUBLICREMARKS')->nullable();
            $table->string('RCOMZIP',54)->nullable()->default('NULL');
            $table->string('REMARKS',100)->nullable()->default('NULL');
            $table->text('REMARKSPUBADD')->nullable();
            $table->integer('RENOVATED')->nullable();
            $table->text('RENTINCLUDES')->nullable();
            $table->decimal('RENTMONTHLY',6,0)->nullable();
            $table->decimal('RENTMONTHPERLSE',6,0)->nullable();
            $table->decimal('RENTPRICE',8,0)->nullable();
            $table->decimal('RENTPRICEORIG',8,0)->nullable();
            $table->string('RENTTERMS',50)->nullable()->default('NULL');
            $table->string('REPORTDETAILS')->nullable()->default('NULL');
            $table->string('REQUIREOFFICEINFO',14)->nullable()->default('NULL');

            $table->text('ROADTYPE')->nullable();
            $table->text('ROOMBASELVLDESC')->nullable();
            $table->string('ROOMDININGLEVEL',50)->nullable()->default('NULL');
            $table->string('ROOMFAMILYLEVEL',50)->nullable()->default('NULL');
            $table->text('ROOMFEAT')->nullable();
            $table->text('ROOMGROUNDLVLDESC')->nullable();
            $table->string('ROOMKITCHENLEVEL',50)->nullable()->default('NULL');
            $table->string('ROOMLIVINGLEVEL',50)->nullable()->default('NULL');
            $table->text('ROOMLVL1DESC')->nullable();
            $table->text('ROOMLVL2DESC')->nullable();
            $table->text('ROOMLVL3DESC')->nullable();
            $table->string('ROOMOTHER1',50)->nullable()->default('NULL');
            $table->string('ROOMOTHER1LEVEL',50)->nullable()->default('NULL');
            $table->string('ROOMOTHER2',50)->nullable()->default('NULL');
            $table->string('ROOMOTHER2LEVEL',50)->nullable()->default('NULL');
            $table->string('ROOMOTHER3',50)->nullable()->default('NULL');
            $table->string('ROOMOTHER3LEVEL',50)->nullable()->default('NULL');

            $table->string('SELLAGENTNAME',50)->nullable()->default('NULL');
            $table->text('SERVICES')->nullable();
            $table->text('SEWER')->nullable();
            $table->text('SHOWINGINSTRUCTIONS')->nullable();
            $table->string('SHOWSPECIAL',68)->nullable()->default('NULL');
            $table->string('SIGN',50)->nullable()->default('NULL');
            $table->decimal('SQFTAPPROX',6,0)->nullable();
            $table->decimal('SQFTBUSINESS',6,0)->nullable();
            $table->string('STREETNAME',24)->nullable()->default('NULL');
            $table->string('STREETNAMETAX',14)->nullable()->default('NULL');
            $table->decimal('STREETNUMBER',9,0)->nullable();
            $table->string('STREETNUMDISPLAY',9)->nullable()->default('NULL');
            $table->string('STREETNUMTAX',14)->nullable()->default('NULL');
            $table->string('SUBDIVISION',20)->nullable()->default('NULL');
            $table->string('SUBPROPTYPE',50)->nullable()->default('NULL');
            $table->string('TAXID',50)->nullable()->default('NULL');
            $table->string('TAXIDTAX',14)->nullable()->default('NULL');
            $table->text('TENANTPAYS')->nullable();
            $table->text('TENANTUSEOF')->nullable();
            $table->text('TENLANDCOMM')->nullable();
            $table->integer('TOTALROOMS')->nullable();
            $table->string('TOWNCODE',44)->nullable()->default('NULL');
            $table->string('TOWNCODETAX',14)->nullable()->default('NULL');
            $table->string('TOWNTAX',14)->nullable()->default('NULL');
            $table->string('UNITNUMBER',44)->nullable()->default('NULL');
            $table->text('UTILITIES')->nullable();
            $table->text('WATER')->nullable();
            $table->text('WATERHEATER')->nullable();
            $table->date('WITHDRAWNDATE');

            $table->integer('YEARBUILT')->nullable();
            $table->text('YEARBUILTDESC')->nullable();
            $table->string('ZIPCODETAX',14)->nullable()->default('NULL');
            $table->string('ZONING',13)->nullable()->default('NULL');
            $table->text('ZONINGCOMP')->nullable();
            $table->integer('IMAGEDOWNLOADED')->default('0');
            $table->integer('IMAGEDOWNLOADEDTRIED')->nullable();
            $table->string('IMAGEDOWNLOADEDTIME')->nullable()->default('NULL');


        });
    }

    public function down()
    {
        Schema::dropIfExists('rets_property_data_rn');
    }
}
