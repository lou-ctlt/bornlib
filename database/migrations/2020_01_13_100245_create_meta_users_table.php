<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_users', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id');
            $table->foreign("users_id")->references("id")->on("users");
            $table->boolean('car');
            $table->boolean("electric_terminal");
            $table->string("profile_photo");
            $table->string("electric_terminal_photo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_users');
    }
}
