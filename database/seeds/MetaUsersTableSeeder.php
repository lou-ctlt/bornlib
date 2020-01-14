<?php

use Illuminate\Database\Seeder;

class MetaUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meta_users')->insert([
            "users_id" => "1",
            "car" => "1",
            "electric_terminal" => "0",
        ]);
    }
}
