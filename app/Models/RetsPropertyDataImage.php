<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetsPropertyDataImage extends Model
{
    use HasFactory;
    protected $table = "rets_property_data_images";
    protected $fillable = [
        "listingID",
        "image_directory",
        "image_path",
        "image_url",
        "s3_image_url",
        "image_name",
        "downloaded_time",
        "is_download",
        "is_resized1",
        "is_resized2",
        "is_resized3",
        "sort_order_no",
        "mls_order",
        "is_uploaded_by_agent",
        "updated_time",
        "image_last_tried_time",
        "property_id",
    ];
}
