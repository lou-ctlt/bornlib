<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "firstname" => "Admin",
            "lastname" => "Admin",
            "email" => "adminemail@gmail.com",
            "password" => Hash::make("00000000"),
            "address" => "1 rue de l'adresse 33000 Bordeaux",
            "ID_number" => "012345678910"
        ]);
    }
}
