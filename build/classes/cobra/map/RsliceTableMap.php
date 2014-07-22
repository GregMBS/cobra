<?php



/**
 * This class defines the structure of the 'rslice' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.cobra.map
 */
class RsliceTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.RsliceTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('rslice');
        $this->setPhpName('Rslice');
        $this->setClassname('Rslice');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('nombre_deudor', 'NombreDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('domicilio_deudor', 'DomicilioDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_deudor', 'ColoniaDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_deudor', 'CiudadDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_deudor', 'EstadoDeudor', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_deudor', 'CpDeudor', 'VARCHAR', false, 5, null);
        $this->addColumn('plano_guia_roji', 'PlanoGuiaRoji', 'VARCHAR', false, 4, null);
        $this->addColumn('cuadrante_guia_roji', 'CuadranteGuiaRoji', 'VARCHAR', false, 4, null);
        $this->addColumn('tel_1', 'Tel1', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2', 'Tel2', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_3', 'Tel3', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_4', 'Tel4', 'VARCHAR', false, 20, null);
        $this->addColumn('nombre_deudor_alterno', 'NombreDeudorAlterno', 'VARCHAR', false, 255, null);
        $this->addColumn('domicilio_deudor_alterno', 'DomicilioDeudorAlterno', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_deudor_alterno', 'ColoniaDeudorAlterno', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_deudor_alterno', 'CiudadDeudorAlterno', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_deudor_alterno', 'EstadoDeudorAlterno', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_deudor_aterno', 'CpDeudorAterno', 'VARCHAR', false, 5, null);
        $this->addColumn('tel_1_alterno', 'Tel1Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_alterno', 'Tel2Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_3_alterno', 'Tel3Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_4_alterno', 'Tel4Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('plano_guia_roji_alterno', 'PlanoGuiaRojiAlterno', 'VARCHAR', false, 4, null);
        $this->addColumn('cuadrante_guia_roji_alterno', 'CuadranteGuiaRojiAlterno', 'VARCHAR', false, 4, null);
        $this->addColumn('status_aarsa', 'StatusAarsa', 'VARCHAR', true, 50, '');
        $this->addColumn('sucursal_cliente', 'SucursalCliente', 'VARCHAR', false, 255, null);
        $this->addColumn('parentesco_ref_1', 'ParentescoRef1', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_1', 'NombreReferencia1', 'VARCHAR', false, 255, null);
        $this->addColumn('domicilio_referencia_1', 'DomicilioReferencia1', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_referencia_1', 'ColoniaReferencia1', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_referencia_1', 'CiudadReferencia1', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_referencia_1', 'EstadoReferencia1', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_referencia_1', 'CpReferencia1', 'VARCHAR', false, 5, null);
        $this->addColumn('tel_1_ref_1', 'Tel1Ref1', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_1', 'Tel2Ref1', 'VARCHAR', false, 20, null);
        $this->addColumn('parentesco_ref_2', 'ParentescoRef2', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_2', 'NombreReferencia2', 'VARCHAR', false, 255, null);
        $this->addColumn('domicilio_referencia_2', 'DomicilioReferencia2', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_referencia_2', 'ColoniaReferencia2', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_referencia_2', 'CiudadReferencia2', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_referencia_2', 'EstadoReferencia2', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_referencia_2', 'CpReferencia2', 'VARCHAR', false, 5, null);
        $this->addColumn('tel_1_ref_2', 'Tel1Ref2', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_2', 'Tel2Ref2', 'VARCHAR', false, 20, null);
        $this->addColumn('parentesco_ref_3', 'ParentescoRef3', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_3', 'NombreReferencia3', 'VARCHAR', false, 255, null);
        $this->addColumn('domicilio_referencia_3', 'DomicilioReferencia3', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_referencia_3', 'ColoniaReferencia3', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_referencia_3', 'CiudadReferencia3', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_referencia_3', 'EstadoReferencia3', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_referencia_3', 'CpReferencia3', 'VARCHAR', false, 5, null);
        $this->addColumn('tel_1_ref_3', 'Tel1Ref3', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_3', 'Tel2Ref3', 'VARCHAR', false, 20, null);
        $this->addColumn('parentesco_ref_4', 'ParentescoRef4', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_4', 'NombreReferencia4', 'VARCHAR', false, 255, null);
        $this->addColumn('domicilio_referencia_4', 'DomicilioReferencia4', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_referencia_4', 'ColoniaReferencia4', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_referencia_4', 'CiudadReferencia4', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_referencia_4', 'EstadoReferencia4', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_referencia_4', 'CpReferencia4', 'VARCHAR', false, 5, null);
        $this->addColumn('tel_1_ref_4', 'Tel1Ref4', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_4', 'Tel2Ref4', 'VARCHAR', false, 20, null);
        $this->addColumn('domicilio_laboral', 'DomicilioLaboral', 'VARCHAR', false, 255, null);
        $this->addColumn('colonia_laboral', 'ColoniaLaboral', 'VARCHAR', false, 255, null);
        $this->addColumn('ciudad_laboral', 'CiudadLaboral', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_laboral', 'EstadoLaboral', 'VARCHAR', false, 25, null);
        $this->addColumn('cp_laboral', 'CpLaboral', 'VARCHAR', false, 5, null);
        $this->addColumn('tel_1_laboral', 'Tel1Laboral', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_laboral', 'Tel2Laboral', 'VARCHAR', false, 20, null);
        $this->addColumn('saldo_corriente', 'SaldoCorriente', 'DECIMAL', false, null, null);
        $this->addColumn('fecha_de_actualizacion', 'FechaDeActualizacion', 'DATE', false, null, null);
        $this->addColumn('numero_de_cuenta', 'NumeroDeCuenta', 'VARCHAR', true, 255, '0');
        $this->addColumn('numero_de_credito', 'NumeroDeCredito', 'VARCHAR', false, 255, null);
        $this->addColumn('contrato', 'Contrato', 'VARCHAR', false, 255, null);
        $this->addColumn('saldo_total', 'SaldoTotal', 'DECIMAL', true, null, 0);
        $this->addColumn('saldo_vencido', 'SaldoVencido', 'DECIMAL', true, null, 0);
        $this->addColumn('saldo_descuento_1', 'SaldoDescuento1', 'DECIMAL', true, null, 0);
        $this->addColumn('saldo_descuento_2', 'SaldoDescuento2', 'DECIMAL', true, null, 0);
        $this->addColumn('fecha_corte', 'FechaCorte', 'DATE', false, null, null);
        $this->addColumn('fecha_limite', 'FechaLimite', 'DATE', false, null, null);
        $this->addColumn('fecha_de_ultimo_pago', 'FechaDeUltimoPago', 'DATE', false, null, null);
        $this->addColumn('monto_ultimo_pago', 'MontoUltimoPago', 'DECIMAL', true, null, 0);
        $this->addColumn('producto', 'Producto', 'VARCHAR', false, 255, null);
        $this->addColumn('subproducto', 'Subproducto', 'VARCHAR', false, 255, null);
        $this->addColumn('cliente', 'Cliente', 'VARCHAR', false, 255, null);
        $this->addColumn('status_de_credito', 'StatusDeCredito', 'VARCHAR', false, 50, null);
        $this->addColumn('pagos_vencidos', 'PagosVencidos', 'INTEGER', false, null, null);
        $this->addColumn('monto_adeudado', 'MontoAdeudado', 'DECIMAL', true, null, 0);
        $this->addColumn('fecha_de_asignacion', 'FechaDeAsignacion', 'DATE', false, null, null);
        $this->addColumn('fecha_de_deasignacion', 'FechaDeDeasignacion', 'DATE', false, null, null);
        $this->addColumn('cuenta_concentradora_1', 'CuentaConcentradora1', 'VARCHAR', false, 25, null);
        $this->addColumn('saldo_cuota', 'SaldoCuota', 'DECIMAL', false, null, null);
        $this->addColumn('email_deudor', 'EmailDeudor', 'VARCHAR', false, 255, null);
        $this->addPrimaryKey('id_cuenta', 'IdCuenta', 'INTEGER', true, null, null);
        $this->addColumn('pago_pactado', 'PagoPactado', 'VARCHAR', false, 255, null);
        $this->addColumn('rfc_deudor', 'RfcDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('telefonos_marcados', 'TelefonosMarcados', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_verif', 'Tel1Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_verif', 'Tel2Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_3_verif', 'Tel3Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_4_verif', 'Tel4Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('telefono_de_ultimo_contacto', 'TelefonoDeUltimoContacto', 'VARCHAR', false, 20, null);
        $this->addColumn('dias_vencidos', 'DiasVencidos', 'INTEGER', false, null, 0);
        $this->addColumn('ejecutivo_asignado_call_center', 'EjecutivoAsignadoCallCenter', 'VARCHAR', true, 255, 'sinasig');
        $this->addColumn('ejecutivo_asignado_domiciliario', 'EjecutivoAsignadoDomiciliario', 'VARCHAR', false, 255, null);
        $this->addColumn('prioridad_de_gestion', 'PrioridadDeGestion', 'INTEGER', false, null, null);
        $this->addColumn('region_aarsa', 'RegionAarsa', 'VARCHAR', false, 255, null);
        $this->addColumn('parentesco_aval', 'ParentescoAval', 'VARCHAR', false, 255, null);
        $this->addColumn('localizar', 'Localizar', 'BOOLEAN', false, 1, null);
        $this->addColumn('fecha_ultima_gestion', 'FechaUltimaGestion', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('empresa', 'Empresa', 'VARCHAR', false, 255, null);
        $this->addColumn('timelock', 'Timelock', 'TIMESTAMP', false, null, null);
        $this->addColumn('locker', 'Locker', 'VARCHAR', false, 255, null);
        $this->addColumn('fecha_de_venta', 'FechaDeVenta', 'DATE', false, null, null);
        $this->addColumn('especial', 'Especial', 'BOOLEAN', true, 1, false);
        $this->addColumn('direccion_nueva', 'DireccionNueva', 'VARCHAR', false, 255, null);
        $this->addColumn('norobot', 'Norobot', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('user', 'User', 'VARCHAR', true, 50, null);
        $this->addColumn('timeuser', 'Timeuser', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // RsliceTableMap
