<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' => 'silver',
                'price' => 2.99,
                'duration' => 24,
            ],
            [
                'name' => 'gold',
                'price' => 5.99,
                'duration' => 72,
            ],
            [
                'name' => 'premium',
                'price' => 9.99,
                'duration' => 144,
            ]
        ];

        foreach ($sponsorships as $sponsorship) {
            $newsponsorship = new Sponsorship();
            $newsponsorship->name = $sponsorship['name'];
            $newsponsorship->slug = Str::slug($newsponsorship->name);
            $newsponsorship->price = $sponsorship['price'];
            $newsponsorship->duration = $sponsorship['duration'];
            $newsponsorship->save();
        }
    }
}
