<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVasignTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'vasign';

    /**
     * Run the migrations.
     * @table vasign
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('auto');
            $table->string('cuenta');
            $table->string('gestor');
            $table->dateTime('fechaout');
            $table->dateTime('fechain')->nullable()->default(null);
            $table->integer('c_cont');

            $table->index(["fechain", "fechaout"], 'reverse');

            $table->index(["c_cont", "gestor", "fechaout"], 'dups');

            $table->index(["c_cont", "gestor"], 'dups2');

            $table->index(["gestor"], 'visitador');

            $table->index(["cuenta", "fechaout"], 'bigsort');

            $table->index(["c_cont"], 'cc');

            $table->index(["cuenta"], 'cta');

            $table->index(["fechaout", "fechain"], 'fechas');
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
