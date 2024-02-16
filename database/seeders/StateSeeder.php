<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [

            'Yangon Region', 'Mandalay Region'
            // 'Ayeyarwaddy Region', 'Bago Region', ' Magway Region', 'Mandalay Region', 'Sagaing Region', 'Tanintharyi Region',
            // 'Yangon Region', 'Chin State', 'Kachin State', 'Kayah State', 'Kayin State', 'Mon State', 'Rakhine State', 'Shan State', 'Naypyidaw Union Territory'
        ];

        foreach ($states as $state) {


            $countries = Country::all();
            foreach ($countries as $country) {
                if ($country->name === 'Myanmar') {
                    State::create([
                        'country_id' => $country->id,
                        'name' => $state,
                    ]);
                }
            }
        }
    }
}
