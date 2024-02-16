<?php

namespace Database\Seeders;

use App\Models\PlatformUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_data = [
            'role' => 23,
            'first_name' => 'System',
            'middle_name' => '',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123@'),
            'dob' => '2000-02-02',
            'gender' => 'male'
        ];

        PlatformUser::create($admin_data);
    }
}
