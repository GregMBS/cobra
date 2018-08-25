<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('usuaria')->nullable();
            $table->string('iniciales');
            $table->string('completo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('ticket')->nullable();
            $table->integer('camp')->default(0);
            $table->string('turno')->nullable();
            $table->string('authcode')->nullable();
            $table->integer('policy')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
