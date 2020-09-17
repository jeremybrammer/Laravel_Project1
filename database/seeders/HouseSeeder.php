<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Missouri houses.
        DB::table('houses')->insert([
            "user_id" => 1,
            "address_street" => "112 East Hazel Street",
            "address_city" => "Clarence",
            "address_state" => "MO",
            "address_zip" => "63437",
            "description" => "My house!",
            "price" => "30000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('houses')->insert([
            "user_id" => 1,
            "address_street" => "505 Newton Street",
            "address_city" => "Macon",
            "address_state" => "MO",
            "address_zip" => "63552",
            "description" => "3 bds, 2 ba, 1560 sqft",
            "price" => "95000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('houses')->insert([
            "user_id" => 1,
            "address_street" => "604 N Rutherford Street",
            "address_city" => "Macon",
            "address_state" => "MO",
            "address_zip" => "63552",
            "description" => "3 bds, 2 ba, 1279 sqft",
            "price" => "79900",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        //California houses.
        DB::table('houses')->insert([
            "user_id" => 2,
            "address_street" => "1222 Country Club Dr",
            "address_city" => "Escondido",
            "address_state" => "CA",
            "address_zip" => "92029",
            "description" => "4 bds, 2 ba, 2176 sqft",
            "price" => "729000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('houses')->insert([
            "user_id" => 2,
            "address_street" => "1703 Midvale Dr",
            "address_city" => "San Diego",
            "address_state" => "CA",
            "address_zip" => "92105",
            "description" => "4 bds, 3 ba, 1496 sqft",
            "price" => "649000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('houses')->insert([
            "user_id" => 2,
            "address_street" => "23821 Dracaea Ave",
            "address_city" => "Moreno Valley",
            "address_state" => "CA",
            "address_zip" => "92553",
            "description" => "2 bds, 2 ba, 940 sqft",
            "price" => "300000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        //New York houses.
        DB::table('houses')->insert([
            "user_id" => 3,
            "address_street" => "119 Nevada Ave",
            "address_city" => "Staten Island",
            "address_state" => "NY",
            "address_zip" => "10306",
            "description" => "4 bds, 3 ba, 1636 sqft",
            "price" => "849900",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('houses')->insert([
            "user_id" => 3,
            "address_street" => "13724 233rd St",
            "address_city" => "Jamaica",
            "address_state" => "NY",
            "address_zip" => "11422",
            "description" => "4 bds, 3 ba, 1364 sqft",
            "price" => "630000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('houses')->insert([
            "user_id" => 3,
            "address_street" => "77 Ocean Ave",
            "address_city" => "Staten Island",
            "address_state" => "NY",
            "address_zip" => "10305",
            "description" => "3 bds, 1 ba, 1610 sqft",
            "price" => "575000",
            "sold" => 0,
            "created_at" => now(),
            "updated_at" => now()
        ]);

    }
}
