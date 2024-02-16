<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stars = ['1', '2', '3', '4', '5'];
        foreach ($stars as $star) {
            Rating::create([
               'star' => $star 
            ]);
        }
    }
}
