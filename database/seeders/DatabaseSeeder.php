<?php

namespace Database\Seeders;
use DB;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "email"=>'admin@gmail.com',
            "name"=>'Super Admin sistemas',
            'role' => "SuperAdmin",
            'password' => Hash::make('desarrollo')
        ]);
    }
}
