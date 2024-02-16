<?php

namespace Database\Seeders;

use App\Models\PlatformUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_data = [
            'role' => 1,
            'first_name' => 'Ye',
            'middle_name' => 'Linn',
            'last_name' => 'Oo',
            'email' => 'ylo@gmail.com',
            'password' => Hash::make('password123@'),
            'dob' => '2000-02-02',
            'gender' => 'male'
        ];

        PlatformUser::create($user_data);
    }
}
