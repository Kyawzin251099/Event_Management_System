<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cityData = [
            // // State 1: Ayeyarwady
            // [
            //     'state_id' => '1',
            //     'cities' => [
            //         'Pathein', 'Ahmar', 'Ahtaung', 'Aingthapyu', 'Bogale', 'Chaungtha', 'Danubyu', 'Dedaye',
            //         'Einme', 'Hainggyi Island', 'Hinthada', 'Ingapu', 'Kanaung', 'Kangyidaut', 'Kyaiklat', 'Kyangin', 'Kyaunggon',
            //         'Kyonmanage', 'Kyonpyaw', 'Labutta', 'Lemyethna', 'Maubin', 'Mawlamyinegyun', 'Myan Aung', 'Myaungmya', 'Ngapudaw',
            //         'Ngathaingchaung', 'Ngayokaung', 'Ngwesaung', 'Nyaungdon', 'Pantanaw', 'Pyapon', 'Pyinsalu',
            //         'Shwelaung', 'Thabaung', 'Wakema', 'Yekyi', 'Zalun'
            //     ],
            // ],

            // // State 2: Bago
            // [
            //     'state_id' => '2',
            //     'cities' => [
            //         'Bago', 'Daik-U', 'Gyobingauk', 'Letpadan', 'Nyaunglebin', 'Paungde', 'Pyay', 'Pyu', 'Pyuntaza', 'Shwedaung',
            //         'Shwegyin', 'Taungoo', 'Tharrawaddy', 'Yedashe'
            //     ],
            // ],

            // // State 3: Magway
            // [
            //     'state_id' => '3',
            //     'cities' => [
            //         'Magway', 'Aunglan', 'Chauk', 'Gangaw', 'Htilin', 'Kamma', 'Minbu', 'Mindon',
            //         'Minhla', 'Myaing', 'Myothit', 'Natmauk', 'Ngape', 'Pakokku', 'Pauk', 'Pwintbyu',
            //         'Sagu', 'Salin', 'Saw', 'Seikpyu', 'Sidoktaya', 'Sinbyugyun', 'Taungdwingyi', 'Thayet',
            //         'Yenangyaung', 'Yesagyo'
            //     ],
            // ],

            // State 4: Mandalay
            [
                'state_id' =>  Config::get('variables.TWO'),
                'cities' => [
                    'Amarapura', 'Bagan', 'Inwa', 'Kyaukpadaung', 'Kyaukse', 'Madaya', 'Mahlaing', 'Mandalay',
                    'Meiktila', 'Mogok', 'Myingyan', 'Myitnge', 'Myittha', 'Natogyi', 'Nganzun', 'Nyaung-U',
                    'Pyawbwe', 'Pyinoolwin', 'Tagaung', 'Thabeikkyin', 'Sintgaing', 'Tada-U', 'Taungtha',
                    'Singu', 'Thazi', 'Wundwin', 'Yamethin'
                ],
            ],

            // // State 5: Sagaing
            // [
            //     'state_id' => '5',
            //     'cities' => [
            //         'Hkamti', 'Homalin', 'Kale', 'Kalewa', 'Mingin', 'Kanbalu', 'Kyunhla', 'Banmauk', 'Htigyaing',
            //         'Indaw', 'Katha', 'Kawlin', 'Pinlebu', 'Wuntho', 'Mawlaik', 'Paungbyin', 'Ayadaw',
            //         'Budalin', 'Chaung-U', 'Monywa', 'Lahe', 'Leshi', 'Nanyun', 'Myaung', 'Myinmu', 'Sagaing',
            //         'Khin-U', 'Shwebo', 'Wetlet', 'Tamu', 'Tabayin', 'Taze', 'Ye-U', 'Kani', 'Pale', 'Salingyi',
            //         'Yinmabin'
            //     ],
            // ],

            // // State 6: Tanintharyi
            // [
            //     'state_id' => '6',
            //     'cities' => [
            //         'Dawei', 'Bokepyin', 'Kawthaung', 'Kyunsu', 'Launglon', 'Myeik', 'Palaw',
            //         'Tanintharyi', 'Thayetchaung', 'Yebyu'
            //     ],
            // ],

            // State 7: Yangon
            [
                'state_id' => Config::get('variables.ONE'),
                'cities' => [
                    'Hlegu', 'Kawhmu', 'Kyauktan', 'Taikkyi', 'Thongwa', 'Thanlyin', 'Twante', 'Yangon'
                ],
            ],

            // // State 8: Chin
            // [
            //     'state_id' => '8',
            //     'cities' => [
            //         'Cikha', 'Falam', 'Hakha', 'Hnaring', 'Htantlang', 'Kanpetlet', 'Lalengpi', 'Matupi',
            //         'Mindat', 'Paletwa', 'Phunom', 'Rezua', 'Rihkhawdar', 'Sami', 'Tiddim', 'Ton Zang'
            //     ],
            // ],

            // // State 9: Kachin
            // [
            //     'state_id' => '9',
            //     'cities' => [
            //         'Bhamo', 'Chipwi', 'Hsawlaw', 'Hsinbo', 'Hopin', 'Hpakant', 'Injangyang', 'Kamaing', 'Kawnglanghpu', 'Lweje',
            //         'Machanbaw', 'Mansi', 'Mogaung', 'Mohnyin', 'Momauk', 'Myitkyina', 'Putao', 'Shwegu', 'Sumprabum',
            //         'Tanai', 'Nogmung', 'Waingmaw', 'Ywathit'
            //     ],
            // ],

            // // State 10: Kayah
            // [
            //     'state_id' => '10',
            //     'cities' => ['laikaw', 'hteeSaiKha', 'kaya', 'kayan'],
            // ],

            // // State 11: Kayin
            // [
            //     'state_id' => '11',
            //     'cities' => [
            //         'Bawlakhe', 'Demoso', 'Hpasawng', 'Hpruso', 'Lawpita', 'Loikaw', 'Loilinlay',
            //         'Mese', 'Nanmekon', 'Shadaw', 'Ywathit'
            //     ],
            // ],

            // // State 12: Mon
            // [
            //     'state_id' => '12',
            //     'cities' => [
            //         'Bilin', 'Chaungzon', 'Kamarwet', 'Kyaikkhami', 'Kyaikmaraw', 'Kyaikto', 'Mawlamyine',
            //         'Mudon', 'Paung', 'Zinkyaik', 'Sittaung', 'Thanbyuzayat', 'Thaton', 'Thuwanawaddy',
            //         'Ye', 'Khawzar'
            //     ],
            // ],

            // // State 13: Rakhine
            // [
            //     'state_id' => '13',
            //     'cities' => [
            //         'Sittwe', 'Ann', 'Buthidaung', 'Gwa', 'Kyaukphyu', 'Kyauktaw', 'Kyeintali', 'Manaung',
            //         'Maungdaw', 'Minbya', 'Mrauk U', 'Myebon', 'Pauktaw', 'Ponnagyun', 'Ramree', 'Rathedaung',
            //         'Thandwe', 'Toungup'
            //     ],
            // ],

            // // State 14: Shan
            // [
            //     'state_id' => '14',
            //     'cities' => [
            //         'Taunggyi', 'Aungban', 'Ayetharyar', 'Chinshwehaw', 'Hong Pai', 'Hopang', 'Hopong',
            //         'Hseni', 'Hsi Hseng', 'Hsipaw', 'Kalaw', 'Kengtung', 'Kunhing', 'Kunlong', 'Kutkai',
            //         'Kyaukme', 'Kyethi', 'Lai-Hka', 'Langkho', 'Lashio', 'Laukkaing', 'Lawksawk', 'Loilen',
            //         'Mabein', 'Mantong', 'Mawkmai', 'Mong Hpayak', 'Mong Hsat', 'Mong Hsu', 'Mong Khet',
            //         'Mong Kung', 'Mong Nai', 'Mong Pan', 'Mong Ping', 'Mong Ton', 'Mong Yang', 'Mong Yawng',
            //         'Mongko', 'Mongmit', 'Mongyai', 'Muse', 'Nanhkan', 'Namhsan', 'Namtu', 'Nansang', 'Nawnghkio',
            //         'Nyaungshwe', 'Panglong', 'Pekon', 'Pinlaung', 'Tachileik', 'Tangyan'
            //     ],
            // ],

            // // State 15: Naypyidaw
            // [
            //     'state_id' => '15',
            //     'cities' => [
            //         'Lewe', 'Pyinmana', 'Tatkon'
            //     ],
            // ],
        ];

        foreach ($cityData as $data) {
            $stateId = $data['state_id']; //Yangon  Mandalay
            $cities = $data['cities'];

            foreach ($cities as $city) {
                City::create([
                    'state_id' => $stateId,
                    'name' => $city,
                ]);
            }
        }
    }
}
