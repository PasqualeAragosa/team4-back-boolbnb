<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $message = new Message();
            $message->guest_full_name = $faker->name();
            $message->guest_phone_number = $faker->phoneNumber();
            $message->guest_email = $faker->email();
            $message->content = $faker->text(100);
            $message->property_id = $faker->randomDigitNotNull();
            $message->save();
        }
    }
}
