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
            'user_type' => 'Jha',
            'email' => 'abhishek.j.456@gmail.com',
            'password' => Hash::make('1234567890'),
            'inserted_by' => 1,
            'inserted_dt' => Carbon::now(),
        ]);
    }
}
