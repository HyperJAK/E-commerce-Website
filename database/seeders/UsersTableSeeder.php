<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Populating Db
        DB::table('users')->insertOrIgnore([
            [
                'username' => 'john_doe',
                'email' => 'john@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'address'=> 'address 1',
                'country'=> 'Lebanon',
                'city'=> 'Beirut',
                'phone'=> '70203192',
                'about'=> 'This is my about comment',
                'is_seller'=>true,
                'is_verified'=>true,
                'is_admin'=>false,
            ],[
                'username' => 'jane_smith',
                'email' => 'jane@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'address'=> 'address 2',
                'country'=> 'Lebanon',
                'city'=> 'Hazmieh',
                'phone'=> '70403192',
                'about'=> 'This is my about comment',
                'is_seller'=>true,
                'is_verified'=>true,
                'is_admin'=>false,
            ],[
                'username' => 'janine_jones',
                'email' => 'janine@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'address'=> 'address 3',
                'country'=> 'Lebanon',
                'city'=> 'Baabda',
                'phone'=> '70406892',
                'about'=> 'This is my about comment',
                'is_seller'=>false,
                'is_verified'=>true,
                'is_admin'=>false,
            ],[
                'username' => 'karl_name',
                'email' => 'karl@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'address'=> 'address 4',
                'country'=> 'Lebanon',
                'city'=> 'Akkar',
                'phone'=> '70409292',
                'about'=> 'This is my about comment',
                'is_seller'=>false,
                'is_verified'=>true,
                'is_admin'=>false,
            ],[
                'username' => 'admin_name',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'address'=> 'address 5',
                'country'=> 'Lebanon',
                'city'=> 'Beirut',
                'phone'=> '70972892',
                'about'=> 'This is my about comment',
                'is_seller'=>false,
                'is_verified'=>true,
                'is_admin'=>true,
            ],
        ]);
    }
}
