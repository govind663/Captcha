<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the superadmin user
        DB::table('users')->insert([
            'name' => 'Durgesh Ram Kumar',
            'user_type' => '1',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);

        // Insert the Admin user
        DB::table('users')->insert([
            'name' => 'Arvind Kumar Yadav',
            'user_type' => '2',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => 2,
            'created_at' => Carbon::now(),
        ]);
    }
}
