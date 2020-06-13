<?php

use App\BuyingAnimal;
use App\Community;
use App\Doctor;
use App\Food;
use App\Medicine;
use App\PetShop;
use App\WashingAndSpa;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'image' => 'default.png',
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('user_petshops')->insert([
            'image' => 'default.png',
            'name' => 'Popo Care',
            'email' => 'popo@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('user_petshops')->insert([
            'image' => 'default.png',
            'name' => 'CHS Petshop',
            'email' => 'chs@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('user_petshops')->insert([
            'image' => 'default.png',
            'name' => 'HEHE Petshop',
            'email' => 'hehe@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
