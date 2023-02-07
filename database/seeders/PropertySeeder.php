<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {
            $property = new Property();
            $property->user_id = 1;
            $property->title = $faker->sentence(3);
            $property->slug = Str::slug($property->title, '-');
            $property->price = $faker->randomFloat(2, 60, 9999);
            $property->rooms_num = $faker->numberBetween(1, 10);
            $property->beds_num = $faker->numberBetween(1, 20);
            $property->baths_num = $faker->numberBetween(1, 5);
            $property->square_meters = $faker->numberBetween(15, 300);
            $property->address = $faker->address();
            $property->image = 'placeholders/' . 'casapigna.png';
            $property->description = $faker->text(100);
            $property->visibility = $faker->boolean();
            $property->longitude = $faker->randomFloat(6, 0, 99);
            $property->latitude = $faker->randomFloat(6, 0, 99);
            $property->save();
        }
    }
}
