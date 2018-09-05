<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccionesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'acciones';

    /**
     * Run the migrations.
     * @table acciones
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->string('accion');
            $table->tinyInteger('callcenter')->nullable()->default(null);
            $table->tinyInteger('visitas')->nullable()->default(null);
            $table->tinyInteger('judicial')->nullable()->default(null);
            $table->tinyInteger('promo')->nullable()->default('0');

            $table->index(["callcenter"], 'cc');
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
