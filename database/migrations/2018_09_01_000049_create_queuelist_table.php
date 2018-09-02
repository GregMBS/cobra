<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuelistTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'queuelist';

    /**
     * Run the migrations.
     * @table queuelist
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('auto');
            $table->string('gestor');
            $table->string('cliente', 80);
            $table->string('status_aarsa')->default('.');
            $table->integer('camp')->default('0');
            $table->string('orden1')->default('id_cuenta');
            $table->tinyInteger('updown1')->default('0')->comment('1=desc');
            $table->string('orden2')->nullable()->default(null);
            $table->tinyInteger('updown2')->default('0')->comment('1=desc');
            $table->string('orden3')->nullable()->default(null);
            $table->tinyInteger('updown3')->default('0')->comment('1=desc');
            $table->string('sdc', 80)->nullable()->default(null);
            $table->tinyInteger('bloqueado')->default('0')->comment('1=bloqueado');

            $table->index(["camp"], 'csort');

            $table->unique(["cliente", "status_aarsa", "sdc", "gestor"], 'sortwho');
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
