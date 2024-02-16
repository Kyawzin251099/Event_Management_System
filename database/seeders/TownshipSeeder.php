<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Township;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $townshipData = [

            // for Mandalay City in Mandalay Satate
            //for Amarapura
            [
                'city_id' => Config::get('variables.ONE'),
                'townships' =>
                [
                    "Amarapura Township"
                ],

            ],

            //for Bagan
            [
                'city_id' => Config::get('variables.TWO'),
                'townships' =>
                [
                    "Bagan Township",
                ],

            ],
            //for Innwa
            [
                'city_id' => Config::get('variables.THREE'),
                'townships' =>
                [
                    "Innwa Township"
                ],

            ],
            //for Kyaukpadaung
            [
                'city_id' => Config::get('variables.FOUR'),
                'townships' =>
                [
                    "Kyaukpadaung Township"
                ],

            ],
            //for Kyaukse
            [
                'city_id' => Config::get('variables.FIVE'),
                'townships' =>
                [
                    "Kyaukse Township"
                ],

            ],
            //for Madaya
            [
                'city_id' => Config::get('variables.SIX'),
                'townships' =>
                [
                    "Madaya Township"
                ],
            ],
            //for Mahlaing
            [
                'city_id' => Config::get('variables.SEVEN'),
                'townships' =>
                [
                    "Mahlaing Township"
                ],

            ],
            //for Mandalay
            [
                'city_id' => Config::get('variables.EIGHT'),
                'townships' =>
                [
                    "Aungmyethazan Township",
                    "Chanayethazan Township",
                    "Chanmyathazi Township",
                    "Maha Aungmye Township",
                    "Patheingyi Township",
                    "Pyigyidagun Township"
                ],
            ],
            //for Meikhtila
            [
                'city_id' => Config::get('variables.NINE'),
                'townships' =>
                [
                    "Meiktila Township"
                ],
            ],
            //for Mogok
            [
                'city_id' => Config::get('variables.TEN'),
                'townships' =>
                [
                    "Mogok Township"
                ],
            ],
            //for Myingyan
            [
                'city_id' => Config::get('variables.ELEVEN'),
                'townships' =>
                [
                    "Myingyan Township"
                ],

            ],
            //for Myitnge
            [
                'city_id' => Config::get('variables.TWELVE'),
                'townships' =>
                [
                    "Myitnge Township"
                ],
            ],
            //for Myittha
            [
                'city_id' => Config::get('variables.THIRTEEN'),
                'townships' =>
                [
                    "Myittha Township"
                ],
            ],
            //for Natogyi
            [
                'city_id' => Config::get('variables.FOURTEEN'),
                'townships' =>
                [
                    "Natogyi Township"
                ],
            ],
            //for Nganzun
            [
                'city_id' => Config::get('variables.FIFTEEN'),
                'townships' =>
                [
                    "Ngazun Township"
                ],
            ],
            //for Nyaung-U
            [
                'city_id' => Config::get('variables.SIXTEEN'),
                'townships' =>
                [
                    "Nyaung-U Township
                    "
                ],
            ],
            //for Pyawbwe
            [
                'city_id' => Config::get('variables.SEVENTEEN'),
                'townships' =>
                [
                    "Pyawbwe Township
                    "
                ],
            ],
            //for PyinOoLwin
            [
                'city_id' => Config::get('variables.EIGHTEEN'),
                'townships' =>
                [
                    "Pyinoolwin Township
                    "
                ],
            ],
            //for Tagaung
            [
                'city_id' => Config::get('variables.NINETEEN'),
                'townships' =>
                [
                    "Tagaung Township
                    "
                ],
            ],
            //for Thabeikkyin
            [
                'city_id' => Config::get('variables.TWENTY'),
                'townships' =>
                [
                    "Thabeikkyin Township
                    "
                ],
            ],
            //for Sintgaing
            [
                'city_id' => Config::get('variables.TWENTY_ONE'),
                'townships' =>
                [
                    "Sintgaing Township
                    "
                ],
            ],
            //for Tada-U
            [
                'city_id' => Config::get('variables.TWENTY_TWO'),
                'townships' =>
                [
                    "Tada-U Township"
                ],
            ],
            //for Taungtha
            [
                'city_id' => Config::get('variables.TWENTY_THREE'),
                'townships' =>
                [
                    "Taungtha Township"
                ],
            ],
            //for Singu
            [
                'city_id' => Config::get('variables.TWENTY_FOUR'),
                'townships' =>
                [
                    "Singu Township"
                ],
            ],
            //for Thazi
            [
                'city_id' => Config::get('variables.TWENTY_FIVE'),
                'townships' =>
                [
                    "Thazi Township "
                ],
            ],
            //for Wundwin
            [
                'city_id' => Config::get('variables.TWENTY_SIX'),
                'townships' =>
                [
                    "Wundwin Township "
                ],
            ],
            //for Yamethin
            [
                'city_id' => Config::get('variables.TWENTY_SEVEN'),
                'townships' =>
                [
                    "Yamethin Township "
                ],
            ],
            //For Rangoon
            //for Hlegu
            [
                'city_id' => Config::get('variables.TWENTY_EIGHT'),
                'townships' =>
                [
                    "Hlegu Township", "Hmawbi Township", "Htantabin Township"
                ],
            ],

            //for KawHmu
            [
                'city_id' => Config::get('variables.TWENTY_NINE'),
                'townships' =>
                [
                    "Kawhmu Township", "Kayan Township", "KungYagon Township"
                ],
            ],

            //for Kyauktan
            [
                'city_id' => Config::get('variables.THIRTY'),
                'townships' =>
                [
                    "Kyauktan Township"
                ],
            ],
            //for Taikkyi
            [
                'city_id' => Config::get('variables.THIRTY_ONE'),
                'townships' =>
                [
                    "Taikkyi Township"
                ],
            ],
            // for Thongwa
            [
                'city_id' => Config::get('variables.THIRTY_TWO'),
                'townships' =>
                [
                    "Thongwa Township"
                ],
            ],
            //for Thanlyin
            [
                'city_id' => Config::get('variables.THIRTY_THREE'),
                'townships' =>
                [
                    "Thanlyin Township"
                ],

            ],
            //for Twante
            [
                'city_id' => Config::get('variables.THIRTY_FOUR'),
                'townships' =>
                [
                    "Twante Township"
                ],

            ],
            //for Yangon
            [
                'city_id' => Config::get('variables.THIRTY_FIVE'),
                'townships' => [
                    "Hlaingthaya Township",
                    "Ahlon Township",
                    "Bahan Township",
                    "Dagon Seikkan Township",
                    "East Dagon Township",
                    "North Dagon Township",
                    "South Dagon Township",
                    "Dagon Township",
                    "Mingala Taungnyunt Township",
                    "Thingangyun Township",
                    "South Okkalapa Township",
                    "North Okkalapa Township",
                    "Botataung Township",
                    "Pazundaung Township",
                    "Dawbon Township",
                    "Hlaing Township",
                    "Kamayut Township",
                    "Kyauktada Township",
                    "Kyimyindaing Township",
                    "Lanmadaw Township",
                    "Latha Township",
                    "Pabedan Township",
                    "Sanchaung Township",
                    "Seikkan Township",
                    "Mayangon Township",
                    "Tamwe Township",
                    "Thaketa Township",
                    "Yankin Township",
                    "Insein Township",
                    "Mingaladon Township",
                    "Shwepyitha Township",
                    "Dala Township",
                    "Seikkyi Kanaungto Township",
                    "Cocokyun Township",
                ]
            ],
        ];

        foreach ($townshipData as $data) {
            $cityId = $data['city_id'];
            $townships = $data['townships'];

            foreach ($townships as $township) {
                Township::create([
                    'city_id' => $cityId,
                    'name' => $township,
                ]);
            }
        }
    }
}
