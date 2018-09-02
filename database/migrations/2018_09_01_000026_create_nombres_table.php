<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNombresTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'nombres';

    /**
     * Run the migrations.
     * @table nombres
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->string('USUARIA', 20);
            $table->string('INICIALES', 20)->nullable()->default(null);
            $table->string('COMPLETO')->nullable()->default(null);
            $table->string('TIPO')->nullable()->default(null);
            $table->string('TICKET')->nullable()->default(null);
            $table->integer('camp')->default('0');
            $table->string('turno')->nullable()->default(null);
            $table->string('authcode', 6)->nullable()->default(null);
            $table->string('passw', 50)->default('adarc');
            $table->tinyInteger('policy')->default('0');
            $table->increments('id');

            $table->index(["TIPO"], 'grupo');

            $table->index(["INICIALES"], 'c_cvge');

            $table->unique(["USUARIA"], 'USUARIA_UNIQUE');
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
