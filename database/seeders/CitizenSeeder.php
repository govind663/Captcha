<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('citizens')->insert([
            'name' => 'Abhishek G Jha',
            'user_type' => '3',
            'mobile_no' => '9004763926',
            'email' => 'abhishek.j.456@gmail.com',
            'password' => Hash::make('Coding_Thunder@123'),
            'user_id' => 2,
            'package_id' => 1,
            'payment_type' => 1,
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
