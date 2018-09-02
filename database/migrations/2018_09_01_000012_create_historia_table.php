<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'historia';

    /**
     * Run the migrations.
     * @table historia
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('Auto');
            $table->string('C_CVGE')->nullable()->default(null);
            $table->string('C_CVBA')->nullable()->default(null);
            $table->integer('C_CONT')->default('0');
            $table->string('C_CVST')->nullable()->default(null);
            $table->date('D_FECH')->nullable()->default(null);
            $table->time('C_HRIN')->nullable()->default(null);
            $table->time('C_HRFI')->nullable()->default(null);
            $table->string('C_TELE')->nullable()->default(null);
            $table->string('C_MSGE')->nullable()->default(null);
            $table->string('CUENTA', 50)->default('0');
            $table->string('C_OBSE1')->nullable()->default(null);
            $table->string('C_OBSE2')->nullable()->default(null);
            $table->string('C_CONTAN')->nullable()->default(null);
            $table->string('C_NSE')->nullable()->default(null);
            $table->string('C_VISIT')->nullable()->default(null);
            $table->string('C_ATTE')->nullable()->default(null);
            $table->string('C_CNIV')->nullable()->default(null);
            $table->string('C_CARG')->nullable()->default(null);
            $table->string('C_CFAC')->nullable()->default(null);
            $table->string('C_CPTA')->nullable()->default(null);
            $table->string('C_RCON', 2)->nullable()->default(null);
            $table->string('AUTH')->nullable()->default(null);
            $table->string('CARGADO')->nullable()->default(null);
            $table->string('CUANDO')->nullable()->default(null);
            $table->date('D_PROM')->nullable()->default(null);
            $table->string('C_PROM')->nullable()->default(null);
            $table->decimal('N_PROM', 10, 2)->nullable()->default(null);
            $table->string('C_CALLE1')->nullable()->default(null);
            $table->string('C_CALLE2')->nullable()->default(null);
            $table->string('C_CNP')->nullable()->default(null);
            $table->string('C_EMAIL')->nullable()->default(null);
            $table->string('C_NTEL')->nullable()->default(null);
            $table->string('C_NDIR')->nullable()->default(null);
            $table->string('C_FREQ', 20)->nullable()->default(null);
            $table->string('C_CTIPO')->nullable()->default(null);
            $table->string('C_COWN')->nullable()->default(null);
            $table->string('C_CSTAT')->nullable()->default(null);
            $table->string('C_CREJ')->nullable()->default(null);
            $table->string('C_CPAT')->nullable()->default(null);
            $table->string('C_ACCION')->nullable()->default(null);
            $table->string('C_MOTIV')->nullable()->default(null);
            $table->string('C_CAMP', 20)->default('0');
            $table->date('D_PROM1')->nullable()->default(null);
            $table->decimal('N_PROM1', 10, 2)->nullable()->default(null);
            $table->date('D_PROM2')->nullable()->default(null);
            $table->decimal('N_PROM2', 10, 2)->nullable()->default(null);
            $table->string('C_EJE')->nullable()->default(null);
            $table->integer('error')->default('0');
            $table->date('D_PROM3')->nullable()->default(null);
            $table->decimal('N_PROM3', 10, 2)->nullable()->default(null);
            $table->date('D_PROM4')->nullable()->default(null);
            $table->decimal('N_PROM4', 10, 2)->nullable()->default(null);

            $table->index(["D_FECH", "C_HRIN", "C_HRFI"], 'timing');

            $table->index(["C_CVGE"], 'iniciales');

            $table->index(["C_CONT", "N_PROM", "D_PROM"], 'cnd');
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
