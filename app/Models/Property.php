<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $fillable = ['title', 'slug', 'price', 'description', 'rooms_num', 'beds_num', 'baths_num', 'square_meters', 'street', 'city',  'state', 'image', 'visibility', 'longitude', 'latitude'];
    use HasFactory;

    public static function generateSlug($title)
    {
        $property_slug = Str::slug($title);
        return $property_slug;
    }
}
