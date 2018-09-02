<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreaksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'breaks';

    /**
     * Run the migrations.
     * @table breaks
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('auto');
            $table->string('gestor', 50);
            $table->string('tipo', 50);
            $table->time('empieza');
            $table->time('termina');

            $table->index(["gestor", "empieza", "termina"], 'new_index3');

            $table->index(["empieza", "termina"], 'new_index2');

            $table->index(["gestor"], 'new_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
