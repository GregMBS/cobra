<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'notas';

    /**
     * Run the migrations.
     * @table notas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('auto');
            $table->string('c_cvge');
            $table->date('d_fech');
            $table->time('c_hora');
            $table->date('fecha')->nullable()->default(null);
            $table->time('hora')->nullable()->default(null);
            $table->string('nota')->nullable()->default(null);
            $table->tinyInteger('borrado')->default('0');
            $table->integer('cuenta')->nullable()->default(null);
            $table->string('fuente')->nullable()->default(null);
            $table->integer('c_cont');

            $table->index(["c_cont"], 'id_cuenta');

            $table->index(["c_cvge", "borrado"], 'normdex');
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
