<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { // Création de la table Users avec tous les champs nécessaires (pour la voiture et la borne de l'utilisateur)
            $table->bigIncrements('id');
            $table->enum('role', ['user','admin'])->default('user');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string("address");
            $table->string("ID_number");
            $table->boolean("car");
            $table->boolean("electric_terminal");
            $table->string("profile_photo");
            $table->string("electric_terminal_photo")->nullable();
            $table->string("license_plate")->nullable();
            $table->string("longitude")->nullable();
            $table->string("latitude")->nullable();
            $table->boolean("reserve_born")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
