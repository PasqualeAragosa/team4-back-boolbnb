<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = ['Wi-Fi', 'Parking', 'Pool', 'Reception', 'TV', 'Air-Conditioning', 'Kitchen', 'Wellness SPA', 'Breakfast', 'Washing Machine', 'Iron', 'BBQ Grill'];

        foreach ($amenities as $amenity) {
            $newAmenity = new Amenity();
            $newAmenity->name = $amenity;
            $newAmenity->slug = Str::slug($newAmenity->name);
            $newAmenity->save();
        }
    }
}
