<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictamenesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'dictamenes';

    /**
     * Run the migrations.
     * @table dictamenes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->string('dictamen');
            $table->tinyInteger('visitas')->nullable()->default('0');
            $table->tinyInteger('callcenter')->nullable()->default('0');
            $table->tinyInteger('judicial')->nullable()->default('0');
            $table->tinyInteger('promo')->nullable()->default('0');
            $table->increments('auto');
            $table->unsignedInteger('v_cc')->default('99');
            $table->unsignedInteger('v_v')->default('99');
            $table->unsignedInteger('v_j')->default('99');
            $table->string('queue')->nullable()->default(null);

            $table->index(["queue"], 'q');

            $table->index(["callcenter"], 'cc');

            $table->index(["dictamen", "v_cc"], 'sa');

            $table->index(["v_cc"], 'value');
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
