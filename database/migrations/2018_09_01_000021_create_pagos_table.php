<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'pagos';

    /**
     * Run the migrations.
     * @table pagos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('auto');
            $table->string('cuenta', 50)->default('0');
            $table->date('fecha')->default('0000-00-00');
            $table->decimal('monto', 10, 2)->default('0.00');
            $table->string('cliente');
            $table->string('gestor')->nullable()->default(null);
            $table->tinyInteger('confirmado')->default('0');
            $table->string('credito', 50)->nullable()->default(null);
            $table->integer('id_cuenta')->default('0');

            $table->index(["cuenta", "fecha"], 'index3');

            $table->unique(["id_cuenta", "fecha", "monto", "confirmado"], 'upay2');

            $table->unique(["cuenta", "fecha", "monto", "confirmado"], 'upay');
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
