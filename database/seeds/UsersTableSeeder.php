<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([ // Ajout d'un seed qui sera l'Admin
            "firstname" => "Admin",
            "lastname" => "Admin",
            "email" => "adminemail@gmail.com",
            "password" => Hash::make("00000000"),
            "address" => "1 rue de l'adresse 33000 Bordeaux",
            "ID_number" => "012345678910",
            "car" => "1",
            "electric_terminal" => "1",
            "profile_photo" => "1579270980-profile.jpg",
            'electric_terminal_photo' => "recharge-vehicule-electrique.jpg",
            "license_plate" => "AA-000-AA",
            "ID_number" => "012345678910",
            "longitude" => "-0.565375",
            "latitude" => "44.887733"
        ]);
        // DB::table('users')->insert([
        //     "firstname" => "A",
        //     "lastname" => "A",
        //     "email" => "admin@gmail.com",
        //     "password" => Hash::make("00000000"),
        //     "address" => "1 rue de l'adresse 33000 Bordeaux",
        //     "license_plate" => "AA-000-AA",
        //     "ID_number" => "012345678910",
        //     "longitude" => "44.836820",
        //     "latitude" => "-0.697879",
        //     "car" => "0",
        //     "electric_terminal" => "0",
        //     "profile_photo" => "\public\storage\profile_photo",
        // ]);
    }
}
