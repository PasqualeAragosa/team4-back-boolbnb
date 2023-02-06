<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    protected $fillable = ['title', 'slug', 'price', 'description', 'rooms_num', 'beds_num', 'baths_num', 'square_meters', 'street', 'city',  'state', 'image', 'visibility', 'longitude', 'latitude', 'user_id'];
    use HasFactory;

    public static function generateSlug($title)
    {
        $property_slug = Str::slug($title);
        return $property_slug;
    }



    /**
     * Get the user_id that owns the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The types that belong to the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function types(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * The amenities that belong to the Property
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }
}
