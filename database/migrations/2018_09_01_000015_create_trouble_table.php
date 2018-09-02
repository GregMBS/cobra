<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTroubleTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'trouble';

    /**
     * Run the migrations.
     * @table trouble
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('auto');
            $table->dateTime('fechahora');
            $table->string('sistema', 15);
            $table->string('usuario')->nullable()->default(null);
            $table->string('fuente')->nullable()->default(null);
            $table->string('descripcion')->nullable()->default(null);
            $table->string('error_msg')->nullable()->default(null);
            $table->dateTime('fechacomp')->default('0000-00-00 00:00:00');
            $table->string('it_guy')->nullable()->default(null);
            $table->string('reparacion')->nullable()->default(null);
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
