<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetsPropertyData extends Model
{
    use HasFactory;
    protected $table = "rets_property_data";
    public $timestamps = false;
    protected $fillable = ["POSTALCODE","LSTNGSYSID","LISTINGID","ADDRESSINCLUDED","AGENTFIRSTNAME","AGENTID","AGENTLASTNAME","AGENTOFFICEFEED","AGENTOFFICEPHONE","BATHS","BATHSDESC","BATHSFULL","BATHSHALF","BEDS","COUNTY","COUNTYCODE","GARAGE","GARAGEDESC","YEARBUILT","YEARBUILTDESC","ZIPCODETAX","LATITUDE","LONGITUDE","CLASSNAME","UNITNUMBER","LISTPRICE","ORIGINALLISTPRICE","UNITNUMBER","CITY"];
}
