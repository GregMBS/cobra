<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagotempTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'pagotemp';

    /**
     * Run the migrations.
     * @table pagotemp
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('cuenta')->default('0');
            $table->date('fecha')->nullable()->default(null);
            $table->decimal('monto', 10, 2)->default('0.00');
            $table->string('cliente')->nullable()->default(null);
            $table->string('gestor')->default('sinasig');
            $table->integer('confirmado')->default('0');
            $table->integer('id_cuenta')->default('0');
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
