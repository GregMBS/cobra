<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('id_cuenta');
            $table->string('nombre', 250);
            $table->string('domicilio', 250)->default(null);
            $table->string('colonia', 250)->default(null);
            $table->string('ciudad', 250)->default(null);
            $table->string('estado', 250)->default(null);
            $table->string('cp', 5)->default(null);
            $table->string('rfc', 45)->default(null);
            $table->string('relacion', 250)->default(null);
            $table->string('tel_1', 45)->default(null);
            $table->string('tel_2', 45)->default(null);

            $table->index('id_cuenta','idc');

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
        Schema::drop('referencias');

    }
}