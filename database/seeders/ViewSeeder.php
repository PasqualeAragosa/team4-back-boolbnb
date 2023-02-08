<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\View;


class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $view = new View();
            $view->ip = $faker->ipv4();
            $view->date = $faker->dateTimeInInterval('-1 week', '+3 days');
            $view->property_id = $faker->randomDigitNotNull();
            $view->save();
        }
    }
}
