<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = ['title', 'slug', 'price', 'description', 'rooms_num', 'beds_num', 'baths_num', 'square_meters', 'address', 'image', 'visibility', 'longitude', 'latitude', 'user_id'];
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

    /**
     * The sponsorships that belong to the Property
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sponsorships(): BelongsToMany
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    /**
     * Get all the Views for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    /**
     * Get all the Messages for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
