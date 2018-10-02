<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPromsToHistoriaTable extends Migration
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
        Schema::table('historia', function (Blueprint $table) {
            $table->date('D_PROM3')->nullable()->default(null);
            $table->decimal('N_PROM3', 10, 2)->nullable()->default(null);
            $table->date('D_PROM4')->nullable()->default(null);
            $table->decimal('N_PROM4', 10, 2)->nullable()->default(null);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         Schema::table('users', function (Blueprint $table) {
             $table->dropColumn(['D_PROM3', 'N_PROM3', 'D_PROM4', 'N_PROM4']);
         });
     }
}
