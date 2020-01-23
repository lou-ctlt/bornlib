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
            "role"=>"admin",
            "firstname" => "Admin",
            "lastname" => "Admin",
            "email" => "adminemail@gmail.com",
            "password" => Hash::make("00000000"),
            "address" => "1 rue de l'adresse 33000 Bordeaux",
            "ID_number" => "012345678910",
            "car" => "1",
            "electric_terminal" => "1",
            "profile_photo" => "admin-profile-photo.jpg",
            'electric_terminal_photo' => "admin-terminal.jpg",
            "license_plate" => "AA-000-AA",
            "ID_number" => "012345678910",
            "longitude" => "-0.565375",
            "latitude" => "44.887733"
        ]);
       
    }
}
