<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Common;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commons = [
            [
                'status' => 'CP',
                'abbrv' => 'Complete'
            ],
            [
                'status' => 'CF',
                'abbrv' => 'Confirm'
            ],
            [
                'status' => 'UD',
                'abbrv' => 'Update'
            ],
            [
                'status' => 'CC',
                'abbrv' => 'Cancel'
            ],
            [
                'status' => 'DL',
                'abbrv' => 'Delete'
            ],
            [
                'status' => 'LG',
                'abbrv' => 'Log'
            ],
            [
                'status' => 'AC',
                'abbrv' => 'Active'
            ],
            [
                'status' => 'SP',
                'abbrv' => 'Suspend'
            ],
            [
                'status' => 'DN',
                'abbrv' => 'Deny'
            ],
            [
                'status' => 'PD',
                'abbrv' => 'Pending'
            ],
            [
                'status' => 'ER',
                'abbrv' => 'Error'
            ],
            [
                'status' => 'RV',
                'abbrv' => 'Reserved'
            ],
            [
                'status' => 'PC',
                'abbrv' => 'Purchased'
            ],
            [
                'status' => 'FP',
                'abbrv' => 'Full Payment'
            ],
            [
                'status' => 'DP',
                'abbrv' => 'Deposit'
            ],
            [
                'status' => 'CD',
                'abbrv' => 'Credit Card'
            ],
            [
                'status' => 'DB',
                'abbrv' => 'Debit Card'
            ],
            [
                'status' => 'EQ',
                'abbrv' => 'Enquiry'
            ],
            [
                'status' => 'CM',
                'abbrv' => 'Complain'
            ],
            [
                'status' => 'FV',
                'abbrv' => 'Favorite'
            ],
            [
                'status' => 'RS',
                'abbrv' => 'Residential'
            ],
            [
                'status' => 'OC',
                'abbrv' => 'Office'
            ],
            [
                'status' => 'SA',
                'abbrv' => 'System Admin'
            ],
            [
                'status' => 'ML',
                'abbrv' => 'Management Level'
            ],
            [
                'status' => 'SL',
                'abbrv' => 'Senior Level'
            ],
            [
                'status' => 'MS',
                'abbrv' => 'Mid-Senior Level'
            ],
            [
                'status' => 'ET',
                'abbrv' => 'Error'
            ],
            [
                'status' => 'IV',
                'abbrv' => 'Individual'
            ],
            [
                'status' => 'CO',
                'abbrv' => 'Corporate'
            ],
            [
                'status' => 'PR',
                'abbrv' => 'Partner'
            ],

        ];

        
        foreach ($commons as $common) {
            Common::create([
               'status' => $common['status'], 
               'abbrv' => $common['abbrv'],
            ]);
        }
    }
}
