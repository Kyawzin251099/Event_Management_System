<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$venues = ['HNR', 'FNB', 'CEC', 'SHP', 'RLB', 'PBL'];
        // $venue_def = [
        //     'Hotel & Resort', 'Fine Dining, Restaurant & Bar', 'Convention/Exhibition/Conference Center',
        //     'Shopping Mall/Center, Supermarkets, Hypermarkets', 'Monastery, Church, Mosque, Hindu Temple', 'Museum, Garden, Beach'
        // ];
        $venues = [
            [
                'venue_name' => 'HNR',
                'venue_def' => 'Hotel & Resort'
            ],
            [
                'venue_name' => 'FNB',
                'venue_def' => 'Fine Dining, Restaurant & Bar'
            ],
            [
                'venue_name' => 'CEC',
                'venue_def' => 'Convention/Exhibition/Conference Center'
            ],
            [
                'venue_name' => 'SHP',
                'venue_def' => 'Shopping Mall/Center, Supermarkets, Hypermarkets'
            ],
            [
                'venue_name' => 'RLB',
                'venue_def' => 'Monastery, Church, Mosque, Hindu Temple'
            ],
            [
                'venue_name' => 'PBL',
                'venue_def' => 'Museum, Garden, Beach'
            ],

        ];


        // $event_names = [
        //     'WED', 'BIR', 'SEM', 'PES', 'TKS', 'REL', 'EDU', 'JCF',
        //     'MTS', 'ENT', 'CFS', 'NET', 'ITW', 'WTE', 'SMT'
        // ];
        // $event_def = [
        //     'Weddings', 'Birthdays', 'Seminars', 'Promotion Events, Warehouse Sales', 'Talk Shows, TED Talk', 'Religious Events',
        //     'Education Fairs, Graduation Ceremony, Bar Camp', 'Job Fairs, Career Fairs, Recruitment Events', 'Meetings', 'Entertainment Events, Road Shows',
        //     'Conferences', 'Networking Events', 'ITs and Trade Shows & Exhibition, IT Gadgets Sale', 'Workshops & Training Events', 'Summits'
        // ];

        $events = [
            [
                'event_name' => 'WED',
                'event_def' => 'Weddings',
            ],
            [
                'event_name' => 'BIR',
                'event_def' => 'Birthdays',
            ],
            [
                'event_name' => 'SEM',
                'event_def' => 'Seminars',
            ],
            [
                'event_name' => 'PES',
                'event_def' => 'Promotion Events, Warehouse Sales',
            ],
            [
                'event_name' => 'TKS',
                'event_def' => 'Talk Shows, TED Talk',
            ],
            [
                'event_name' => 'REL',
                'event_def' => 'Religious Events',
            ],
            [
                'event_name' => 'EDU',
                'event_def' => 'Education Fairs, Graduation Ceremony, Bar Camp',
            ],
            [
                'event_name' => 'JCF',
                'event_def' => 'Job Fairs, Career Fairs, Recruitment Events',
            ],
            [
                'event_name' => 'MTS',
                'event_def' => 'Meetings',
            ],
            [
                'event_name' => 'ENT',
                'event_def' => 'Entertainment Events, Road Shows',
            ],
            [
                'event_name' => 'CFS',
                'event_def' => 'Conferences',
            ],
            [
                'event_name' => 'ITW',
                'event_def' => 'ITs and Trade Shows & Exhibition, IT Gadgets Sale',
            ],
            [
                'event_name' => 'WTE',
                'event_def' => 'Workshops & Training Events',
            ],
            [
                'event_name' => 'SMT',
                'event_def' => 'Summits',
            ],
        ];

        foreach ($venues as $venue) {
            Type::create([
                'category' => 'Venue',
                'name' => $venue['venue_name'],
                'abbrv' => $venue['venue_def'],
            ]);
        }
        
        foreach ($events as $event) {
            Type::create([
                'category' => 'Event',
                'name' => $event['event_name'],
                'abbrv' => $event['event_def'],
            ]);
        }
    }
}
