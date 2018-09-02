<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsliceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'rslice';

    /**
     * Run the migrations.
     * @table rslice
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('nombre_deudor')->nullable()->default(null);
            $table->string('domicilio_deudor')->nullable()->default(null);
            $table->string('colonia_deudor')->nullable()->default(null);
            $table->string('ciudad_deudor')->nullable()->default(null);
            $table->string('estado_deudor', 25)->nullable()->default(null);
            $table->string('cp_deudor', 5)->nullable()->default(null);
            $table->string('plano_guia_roji', 4)->nullable()->default(null);
            $table->string('cuadrante_guia_roji', 4)->nullable()->default(null);
            $table->string('tel_1', 20)->nullable()->default(null);
            $table->string('tel_2', 20)->nullable()->default(null);
            $table->string('tel_3', 20)->nullable()->default(null);
            $table->string('tel_4', 20)->nullable()->default(null);
            $table->string('nombre_deudor_alterno')->nullable()->default(null);
            $table->string('domicilio_deudor_alterno')->nullable()->default(null);
            $table->string('colonia_deudor_alterno')->nullable()->default(null);
            $table->string('ciudad_deudor_alterno')->nullable()->default(null);
            $table->string('estado_deudor_alterno', 25)->nullable()->default(null);
            $table->string('cp_deudor_aterno', 5)->nullable()->default(null);
            $table->string('tel_1_alterno', 20)->nullable()->default(null);
            $table->string('tel_2_alterno', 20)->nullable()->default(null);
            $table->string('tel_3_alterno', 20)->nullable()->default(null);
            $table->string('tel_4_alterno', 20)->nullable()->default(null);
            $table->string('plano_guia_roji_alterno', 4)->nullable()->default(null);
            $table->string('cuadrante_guia_roji_alterno', 4)->nullable()->default(null);
            $table->string('status_aarsa', 50)->default('');
            $table->string('sucursal_cliente')->nullable()->default(null);
            $table->string('parentesco_ref_1')->nullable()->default(null);
            $table->string('nombre_referencia_1')->nullable()->default(null);
            $table->string('domicilio_referencia_1')->nullable()->default(null);
            $table->string('colonia_referencia_1')->nullable()->default(null);
            $table->string('ciudad_referencia_1')->nullable()->default(null);
            $table->string('estado_referencia_1', 25)->nullable()->default(null);
            $table->string('cp_referencia_1', 5)->nullable()->default(null);
            $table->string('tel_1_ref_1', 20)->nullable()->default(null);
            $table->string('tel_2_ref_1', 20)->nullable()->default(null);
            $table->string('parentesco_ref_2')->nullable()->default(null);
            $table->string('nombre_referencia_2')->nullable()->default(null);
            $table->string('domicilio_referencia_2')->nullable()->default(null);
            $table->string('colonia_referencia_2')->nullable()->default(null);
            $table->string('ciudad_referencia_2')->nullable()->default(null);
            $table->string('estado_referencia_2', 25)->nullable()->default(null);
            $table->string('cp_referencia_2', 5)->nullable()->default(null);
            $table->string('tel_1_ref_2', 20)->nullable()->default(null);
            $table->string('tel_2_ref_2', 20)->nullable()->default(null);
            $table->string('parentesco_ref_3')->nullable()->default(null);
            $table->string('nombre_referencia_3')->nullable()->default(null);
            $table->string('domicilio_referencia_3')->nullable()->default(null);
            $table->string('colonia_referencia_3')->nullable()->default(null);
            $table->string('ciudad_referencia_3')->nullable()->default(null);
            $table->string('estado_referencia_3', 25)->nullable()->default(null);
            $table->string('cp_referencia_3', 5)->nullable()->default(null);
            $table->string('tel_1_ref_3', 20)->nullable()->default(null);
            $table->string('tel_2_ref_3', 20)->nullable()->default(null);
            $table->string('parentesco_ref_4')->nullable()->default(null);
            $table->string('nombre_referencia_4')->nullable()->default(null);
            $table->string('domicilio_referencia_4')->nullable()->default(null);
            $table->string('multiestrategia')->nullable()->default(null);
            $table->string('ciudad_referencia_4')->nullable()->default(null);
            $table->string('estado_referencia_4', 25)->nullable()->default(null);
            $table->string('cp_referencia_4', 5)->nullable()->default(null);
            $table->string('tel_1_ref_4', 20)->nullable()->default(null);
            $table->string('tel_2_ref_4', 20)->nullable()->default(null);
            $table->string('domicilio_laboral')->nullable()->default(null);
            $table->string('colonia_laboral')->nullable()->default(null);
            $table->string('ciudad_laboral')->nullable()->default(null);
            $table->string('estado_laboral', 25)->nullable()->default(null);
            $table->string('cp_laboral', 5)->nullable()->default(null);
            $table->string('tel_1_laboral', 20)->nullable()->default(null);
            $table->string('tel_2_laboral', 20)->nullable()->default(null);
            $table->decimal('saldo_corriente', 10, 2)->nullable()->default(null);
            $table->date('fecha_de_actualizacion')->nullable()->default(null);
            $table->string('numero_de_cuenta')->default('0');
            $table->string('numero_de_credito')->nullable()->default(null);
            $table->string('contrato')->nullable()->default(null);
            $table->decimal('saldo_total', 10, 2)->default('0.00');
            $table->decimal('saldo_vencido', 10, 2)->default('0.00');
            $table->decimal('saldo_descuento_1', 10, 2)->default('0.00');
            $table->decimal('saldo_descuento_2', 10, 2)->default('0.00');
            $table->date('fecha_corte')->nullable()->default(null);
            $table->date('fecha_limite')->nullable()->default(null);
            $table->date('fecha_de_ultimo_pago')->nullable()->default(null);
            $table->decimal('monto_ultimo_pago', 10, 2)->default('0.00');
            $table->string('producto')->nullable()->default(null);
            $table->string('subproducto')->nullable()->default(null);
            $table->string('cliente')->nullable()->default(null);
            $table->string('status_de_credito', 50)->nullable()->default(null);
            $table->integer('pagos_vencidos')->nullable()->default(null);
            $table->decimal('monto_adeudado', 10, 2)->default('0.00');
            $table->date('fecha_de_asignacion')->nullable()->default(null);
            $table->date('fecha_de_deasignacion')->nullable()->default(null);
            $table->string('cuenta_concentradora_1', 25)->nullable()->default(null);
            $table->decimal('saldo_cuota', 10, 2)->nullable()->default(null);
            $table->string('email_deudor')->nullable()->default(null);
            $table->increments('id_cuenta');
            $table->string('pago_pactado')->nullable()->default(null);
            $table->string('rfc_deudor')->nullable()->default(null);
            $table->string('telefonos_marcados', 20)->nullable()->default(null);
            $table->string('tel_1_verif', 20)->nullable()->default(null);
            $table->string('tel_2_verif', 20)->nullable()->default(null);
            $table->string('tel_3_verif', 20)->nullable()->default(null);
            $table->string('tel_4_verif', 20)->nullable()->default(null);
            $table->string('telefono_de_ultimo_contacto', 20)->nullable()->default(null);
            $table->integer('dias_vencidos')->nullable()->default('0');
            $table->string('ejecutivo_asignado_call_center')->default('sinasig');
            $table->string('ejecutivo_asignado_domiciliario')->nullable()->default(null);
            $table->integer('prioridad_de_gestion')->nullable()->default(null);
            $table->string('region_aarsa')->nullable()->default(null);
            $table->string('parentesco_aval')->nullable()->default(null);
            $table->tinyInteger('localizar')->nullable()->default(null);
            $table->dateTime('fecha_ultima_gestion')->default('0000-00-00 00:00:00');
            $table->string('empresa')->nullable()->default(null);
            $table->dateTime('timelock')->nullable()->default(null);
            $table->string('locker')->nullable()->default(null);
            $table->date('fecha_de_venta')->nullable()->default(null);
            $table->tinyInteger('especial')->default('0');
            $table->string('direccion_nueva')->nullable()->default(null);
            $table->dateTime('norobot')->default('0000-00-00 00:00:00');
            $table->string('user', 50);
            $table->dateTime('timeuser')->nullable()->default(null);

            $table->index(["user", "timeuser"], 'whose');
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
