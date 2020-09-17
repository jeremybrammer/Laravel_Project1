<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "Ada Lovelace",
            "email" => "jbrammer03+1@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make('password'),
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('users')->insert([
            "name" => "Alan Turing",
            "email" => "jbrammer03+2@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make('password'),
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('users')->insert([
            "name" => "John Horton Conway",
            "email" => "jbrammer03+3@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make('password'),
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
