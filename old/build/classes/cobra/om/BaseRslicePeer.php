<?php


/**
 * Base static class for performing query and update operations on the 'rslice' table.
 *
 *
 *
 * @package propel.generator.cobra.om
 */
abstract class BaseRslicePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cobra';

    /** the table name for this class */
    const TABLE_NAME = 'rslice';

    /** the related Propel class for this table */
    const OM_CLASS = 'Rslice';

    /** the related TableMap class for this table */
    const TM_CLASS = 'RsliceTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 119;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 119;

    /** the column name for the nombre_deudor field */
    const NOMBRE_DEUDOR = 'rslice.nombre_deudor';

    /** the column name for the domicilio_deudor field */
    const DOMICILIO_DEUDOR = 'rslice.domicilio_deudor';

    /** the column name for the colonia_deudor field */
    const COLONIA_DEUDOR = 'rslice.colonia_deudor';

    /** the column name for the ciudad_deudor field */
    const CIUDAD_DEUDOR = 'rslice.ciudad_deudor';

    /** the column name for the estado_deudor field */
    const ESTADO_DEUDOR = 'rslice.estado_deudor';

    /** the column name for the cp_deudor field */
    const CP_DEUDOR = 'rslice.cp_deudor';

    /** the column name for the plano_guia_roji field */
    const PLANO_GUIA_ROJI = 'rslice.plano_guia_roji';

    /** the column name for the cuadrante_guia_roji field */
    const CUADRANTE_GUIA_ROJI = 'rslice.cuadrante_guia_roji';

    /** the column name for the tel_1 field */
    const TEL_1 = 'rslice.tel_1';

    /** the column name for the tel_2 field */
    const TEL_2 = 'rslice.tel_2';

    /** the column name for the tel_3 field */
    const TEL_3 = 'rslice.tel_3';

    /** the column name for the tel_4 field */
    const TEL_4 = 'rslice.tel_4';

    /** the column name for the nombre_deudor_alterno field */
    const NOMBRE_DEUDOR_ALTERNO = 'rslice.nombre_deudor_alterno';

    /** the column name for the domicilio_deudor_alterno field */
    const DOMICILIO_DEUDOR_ALTERNO = 'rslice.domicilio_deudor_alterno';

    /** the column name for the colonia_deudor_alterno field */
    const COLONIA_DEUDOR_ALTERNO = 'rslice.colonia_deudor_alterno';

    /** the column name for the ciudad_deudor_alterno field */
    const CIUDAD_DEUDOR_ALTERNO = 'rslice.ciudad_deudor_alterno';

    /** the column name for the estado_deudor_alterno field */
    const ESTADO_DEUDOR_ALTERNO = 'rslice.estado_deudor_alterno';

    /** the column name for the cp_deudor_aterno field */
    const CP_DEUDOR_ATERNO = 'rslice.cp_deudor_aterno';

    /** the column name for the tel_1_alterno field */
    const TEL_1_ALTERNO = 'rslice.tel_1_alterno';

    /** the column name for the tel_2_alterno field */
    const TEL_2_ALTERNO = 'rslice.tel_2_alterno';

    /** the column name for the tel_3_alterno field */
    const TEL_3_ALTERNO = 'rslice.tel_3_alterno';

    /** the column name for the tel_4_alterno field */
    const TEL_4_ALTERNO = 'rslice.tel_4_alterno';

    /** the column name for the plano_guia_roji_alterno field */
    const PLANO_GUIA_ROJI_ALTERNO = 'rslice.plano_guia_roji_alterno';

    /** the column name for the cuadrante_guia_roji_alterno field */
    const CUADRANTE_GUIA_ROJI_ALTERNO = 'rslice.cuadrante_guia_roji_alterno';

    /** the column name for the status_aarsa field */
    const STATUS_AARSA = 'rslice.status_aarsa';

    /** the column name for the sucursal_cliente field */
    const SUCURSAL_CLIENTE = 'rslice.sucursal_cliente';

    /** the column name for the parentesco_ref_1 field */
    const PARENTESCO_REF_1 = 'rslice.parentesco_ref_1';

    /** the column name for the nombre_referencia_1 field */
    const NOMBRE_REFERENCIA_1 = 'rslice.nombre_referencia_1';

    /** the column name for the domicilio_referencia_1 field */
    const DOMICILIO_REFERENCIA_1 = 'rslice.domicilio_referencia_1';

    /** the column name for the colonia_referencia_1 field */
    const COLONIA_REFERENCIA_1 = 'rslice.colonia_referencia_1';

    /** the column name for the ciudad_referencia_1 field */
    const CIUDAD_REFERENCIA_1 = 'rslice.ciudad_referencia_1';

    /** the column name for the estado_referencia_1 field */
    const ESTADO_REFERENCIA_1 = 'rslice.estado_referencia_1';

    /** the column name for the cp_referencia_1 field */
    const CP_REFERENCIA_1 = 'rslice.cp_referencia_1';

    /** the column name for the tel_1_ref_1 field */
    const TEL_1_REF_1 = 'rslice.tel_1_ref_1';

    /** the column name for the tel_2_ref_1 field */
    const TEL_2_REF_1 = 'rslice.tel_2_ref_1';

    /** the column name for the parentesco_ref_2 field */
    const PARENTESCO_REF_2 = 'rslice.parentesco_ref_2';

    /** the column name for the nombre_referencia_2 field */
    const NOMBRE_REFERENCIA_2 = 'rslice.nombre_referencia_2';

    /** the column name for the domicilio_referencia_2 field */
    const DOMICILIO_REFERENCIA_2 = 'rslice.domicilio_referencia_2';

    /** the column name for the colonia_referencia_2 field */
    const COLONIA_REFERENCIA_2 = 'rslice.colonia_referencia_2';

    /** the column name for the ciudad_referencia_2 field */
    const CIUDAD_REFERENCIA_2 = 'rslice.ciudad_referencia_2';

    /** the column name for the estado_referencia_2 field */
    const ESTADO_REFERENCIA_2 = 'rslice.estado_referencia_2';

    /** the column name for the cp_referencia_2 field */
    const CP_REFERENCIA_2 = 'rslice.cp_referencia_2';

    /** the column name for the tel_1_ref_2 field */
    const TEL_1_REF_2 = 'rslice.tel_1_ref_2';

    /** the column name for the tel_2_ref_2 field */
    const TEL_2_REF_2 = 'rslice.tel_2_ref_2';

    /** the column name for the parentesco_ref_3 field */
    const PARENTESCO_REF_3 = 'rslice.parentesco_ref_3';

    /** the column name for the nombre_referencia_3 field */
    const NOMBRE_REFERENCIA_3 = 'rslice.nombre_referencia_3';

    /** the column name for the domicilio_referencia_3 field */
    const DOMICILIO_REFERENCIA_3 = 'rslice.domicilio_referencia_3';

    /** the column name for the colonia_referencia_3 field */
    const COLONIA_REFERENCIA_3 = 'rslice.colonia_referencia_3';

    /** the column name for the ciudad_referencia_3 field */
    const CIUDAD_REFERENCIA_3 = 'rslice.ciudad_referencia_3';

    /** the column name for the estado_referencia_3 field */
    const ESTADO_REFERENCIA_3 = 'rslice.estado_referencia_3';

    /** the column name for the cp_referencia_3 field */
    const CP_REFERENCIA_3 = 'rslice.cp_referencia_3';

    /** the column name for the tel_1_ref_3 field */
    const TEL_1_REF_3 = 'rslice.tel_1_ref_3';

    /** the column name for the tel_2_ref_3 field */
    const TEL_2_REF_3 = 'rslice.tel_2_ref_3';

    /** the column name for the parentesco_ref_4 field */
    const PARENTESCO_REF_4 = 'rslice.parentesco_ref_4';

    /** the column name for the nombre_referencia_4 field */
    const NOMBRE_REFERENCIA_4 = 'rslice.nombre_referencia_4';

    /** the column name for the domicilio_referencia_4 field */
    const DOMICILIO_REFERENCIA_4 = 'rslice.domicilio_referencia_4';

    /** the column name for the colonia_referencia_4 field */
    const COLONIA_REFERENCIA_4 = 'rslice.colonia_referencia_4';

    /** the column name for the ciudad_referencia_4 field */
    const CIUDAD_REFERENCIA_4 = 'rslice.ciudad_referencia_4';

    /** the column name for the estado_referencia_4 field */
    const ESTADO_REFERENCIA_4 = 'rslice.estado_referencia_4';

    /** the column name for the cp_referencia_4 field */
    const CP_REFERENCIA_4 = 'rslice.cp_referencia_4';

    /** the column name for the tel_1_ref_4 field */
    const TEL_1_REF_4 = 'rslice.tel_1_ref_4';

    /** the column name for the tel_2_ref_4 field */
    const TEL_2_REF_4 = 'rslice.tel_2_ref_4';

    /** the column name for the domicilio_laboral field */
    const DOMICILIO_LABORAL = 'rslice.domicilio_laboral';

    /** the column name for the colonia_laboral field */
    const COLONIA_LABORAL = 'rslice.colonia_laboral';

    /** the column name for the ciudad_laboral field */
    const CIUDAD_LABORAL = 'rslice.ciudad_laboral';

    /** the column name for the estado_laboral field */
    const ESTADO_LABORAL = 'rslice.estado_laboral';

    /** the column name for the cp_laboral field */
    const CP_LABORAL = 'rslice.cp_laboral';

    /** the column name for the tel_1_laboral field */
    const TEL_1_LABORAL = 'rslice.tel_1_laboral';

    /** the column name for the tel_2_laboral field */
    const TEL_2_LABORAL = 'rslice.tel_2_laboral';

    /** the column name for the saldo_corriente field */
    const SALDO_CORRIENTE = 'rslice.saldo_corriente';

    /** the column name for the fecha_de_actualizacion field */
    const FECHA_DE_ACTUALIZACION = 'rslice.fecha_de_actualizacion';

    /** the column name for the numero_de_cuenta field */
    const NUMERO_DE_CUENTA = 'rslice.numero_de_cuenta';

    /** the column name for the numero_de_credito field */
    const NUMERO_DE_CREDITO = 'rslice.numero_de_credito';

    /** the column name for the contrato field */
    const CONTRATO = 'rslice.contrato';

    /** the column name for the saldo_total field */
    const SALDO_TOTAL = 'rslice.saldo_total';

    /** the column name for the saldo_vencido field */
    const SALDO_VENCIDO = 'rslice.saldo_vencido';

    /** the column name for the saldo_descuento_1 field */
    const SALDO_DESCUENTO_1 = 'rslice.saldo_descuento_1';

    /** the column name for the saldo_descuento_2 field */
    const SALDO_DESCUENTO_2 = 'rslice.saldo_descuento_2';

    /** the column name for the fecha_corte field */
    const FECHA_CORTE = 'rslice.fecha_corte';

    /** the column name for the fecha_limite field */
    const FECHA_LIMITE = 'rslice.fecha_limite';

    /** the column name for the fecha_de_ultimo_pago field */
    const FECHA_DE_ULTIMO_PAGO = 'rslice.fecha_de_ultimo_pago';

    /** the column name for the monto_ultimo_pago field */
    const MONTO_ULTIMO_PAGO = 'rslice.monto_ultimo_pago';

    /** the column name for the producto field */
    const PRODUCTO = 'rslice.producto';

    /** the column name for the subproducto field */
    const SUBPRODUCTO = 'rslice.subproducto';

    /** the column name for the cliente field */
    const CLIENTE = 'rslice.cliente';

    /** the column name for the status_de_credito field */
    const STATUS_DE_CREDITO = 'rslice.status_de_credito';

    /** the column name for the pagos_vencidos field */
    const PAGOS_VENCIDOS = 'rslice.pagos_vencidos';

    /** the column name for the monto_adeudado field */
    const MONTO_ADEUDADO = 'rslice.monto_adeudado';

    /** the column name for the fecha_de_asignacion field */
    const FECHA_DE_ASIGNACION = 'rslice.fecha_de_asignacion';

    /** the column name for the fecha_de_deasignacion field */
    const FECHA_DE_DEASIGNACION = 'rslice.fecha_de_deasignacion';

    /** the column name for the cuenta_concentradora_1 field */
    const CUENTA_CONCENTRADORA_1 = 'rslice.cuenta_concentradora_1';

    /** the column name for the saldo_cuota field */
    const SALDO_CUOTA = 'rslice.saldo_cuota';

    /** the column name for the email_deudor field */
    const EMAIL_DEUDOR = 'rslice.email_deudor';

    /** the column name for the id_cuenta field */
    const ID_CUENTA = 'rslice.id_cuenta';

    /** the column name for the pago_pactado field */
    const PAGO_PACTADO = 'rslice.pago_pactado';

    /** the column name for the rfc_deudor field */
    const RFC_DEUDOR = 'rslice.rfc_deudor';

    /** the column name for the telefonos_marcados field */
    const TELEFONOS_MARCADOS = 'rslice.telefonos_marcados';

    /** the column name for the tel_1_verif field */
    const TEL_1_VERIF = 'rslice.tel_1_verif';

    /** the column name for the tel_2_verif field */
    const TEL_2_VERIF = 'rslice.tel_2_verif';

    /** the column name for the tel_3_verif field */
    const TEL_3_VERIF = 'rslice.tel_3_verif';

    /** the column name for the tel_4_verif field */
    const TEL_4_VERIF = 'rslice.tel_4_verif';

    /** the column name for the telefono_de_ultimo_contacto field */
    const TELEFONO_DE_ULTIMO_CONTACTO = 'rslice.telefono_de_ultimo_contacto';

    /** the column name for the dias_vencidos field */
    const DIAS_VENCIDOS = 'rslice.dias_vencidos';

    /** the column name for the ejecutivo_asignado_call_center field */
    const EJECUTIVO_ASIGNADO_CALL_CENTER = 'rslice.ejecutivo_asignado_call_center';

    /** the column name for the ejecutivo_asignado_domiciliario field */
    const EJECUTIVO_ASIGNADO_DOMICILIARIO = 'rslice.ejecutivo_asignado_domiciliario';

    /** the column name for the prioridad_de_gestion field */
    const PRIORIDAD_DE_GESTION = 'rslice.prioridad_de_gestion';

    /** the column name for the region_aarsa field */
    const REGION_AARSA = 'rslice.region_aarsa';

    /** the column name for the parentesco_aval field */
    const PARENTESCO_AVAL = 'rslice.parentesco_aval';

    /** the column name for the localizar field */
    const LOCALIZAR = 'rslice.localizar';

    /** the column name for the fecha_ultima_gestion field */
    const FECHA_ULTIMA_GESTION = 'rslice.fecha_ultima_gestion';

    /** the column name for the empresa field */
    const EMPRESA = 'rslice.empresa';

    /** the column name for the timelock field */
    const TIMELOCK = 'rslice.timelock';

    /** the column name for the locker field */
    const LOCKER = 'rslice.locker';

    /** the column name for the fecha_de_venta field */
    const FECHA_DE_VENTA = 'rslice.fecha_de_venta';

    /** the column name for the especial field */
    const ESPECIAL = 'rslice.especial';

    /** the column name for the direccion_nueva field */
    const DIRECCION_NUEVA = 'rslice.direccion_nueva';

    /** the column name for the norobot field */
    const NOROBOT = 'rslice.norobot';

    /** the column name for the user field */
    const USER = 'rslice.user';

    /** the column name for the timeuser field */
    const TIMEUSER = 'rslice.timeuser';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Rslice objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Rslice[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. RslicePeer::$fieldNames[RslicePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('NombreDeudor', 'DomicilioDeudor', 'ColoniaDeudor', 'CiudadDeudor', 'EstadoDeudor', 'CpDeudor', 'PlanoGuiaRoji', 'CuadranteGuiaRoji', 'Tel1', 'Tel2', 'Tel3', 'Tel4', 'NombreDeudorAlterno', 'DomicilioDeudorAlterno', 'ColoniaDeudorAlterno', 'CiudadDeudorAlterno', 'EstadoDeudorAlterno', 'CpDeudorAterno', 'Tel1Alterno', 'Tel2Alterno', 'Tel3Alterno', 'Tel4Alterno', 'PlanoGuiaRojiAlterno', 'CuadranteGuiaRojiAlterno', 'StatusAarsa', 'SucursalCliente', 'ParentescoRef1', 'NombreReferencia1', 'DomicilioReferencia1', 'ColoniaReferencia1', 'CiudadReferencia1', 'EstadoReferencia1', 'CpReferencia1', 'Tel1Ref1', 'Tel2Ref1', 'ParentescoRef2', 'NombreReferencia2', 'DomicilioReferencia2', 'ColoniaReferencia2', 'CiudadReferencia2', 'EstadoReferencia2', 'CpReferencia2', 'Tel1Ref2', 'Tel2Ref2', 'ParentescoRef3', 'NombreReferencia3', 'DomicilioReferencia3', 'ColoniaReferencia3', 'CiudadReferencia3', 'EstadoReferencia3', 'CpReferencia3', 'Tel1Ref3', 'Tel2Ref3', 'ParentescoRef4', 'NombreReferencia4', 'DomicilioReferencia4', 'ColoniaReferencia4', 'CiudadReferencia4', 'EstadoReferencia4', 'CpReferencia4', 'Tel1Ref4', 'Tel2Ref4', 'DomicilioLaboral', 'ColoniaLaboral', 'CiudadLaboral', 'EstadoLaboral', 'CpLaboral', 'Tel1Laboral', 'Tel2Laboral', 'SaldoCorriente', 'FechaDeActualizacion', 'NumeroDeCuenta', 'NumeroDeCredito', 'Contrato', 'SaldoTotal', 'SaldoVencido', 'SaldoDescuento1', 'SaldoDescuento2', 'FechaCorte', 'FechaLimite', 'FechaDeUltimoPago', 'MontoUltimoPago', 'Producto', 'Subproducto', 'Cliente', 'StatusDeCredito', 'PagosVencidos', 'MontoAdeudado', 'FechaDeAsignacion', 'FechaDeDeasignacion', 'CuentaConcentradora1', 'SaldoCuota', 'EmailDeudor', 'IdCuenta', 'PagoPactado', 'RfcDeudor', 'TelefonosMarcados', 'Tel1Verif', 'Tel2Verif', 'Tel3Verif', 'Tel4Verif', 'TelefonoDeUltimoContacto', 'DiasVencidos', 'EjecutivoAsignadoCallCenter', 'EjecutivoAsignadoDomiciliario', 'PrioridadDeGestion', 'RegionAarsa', 'ParentescoAval', 'Localizar', 'FechaUltimaGestion', 'Empresa', 'Timelock', 'Locker', 'FechaDeVenta', 'Especial', 'DireccionNueva', 'Norobot', 'User', 'Timeuser', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('nombreDeudor', 'domicilioDeudor', 'coloniaDeudor', 'ciudadDeudor', 'estadoDeudor', 'cpDeudor', 'planoGuiaRoji', 'cuadranteGuiaRoji', 'tel1', 'tel2', 'tel3', 'tel4', 'nombreDeudorAlterno', 'domicilioDeudorAlterno', 'coloniaDeudorAlterno', 'ciudadDeudorAlterno', 'estadoDeudorAlterno', 'cpDeudorAterno', 'tel1Alterno', 'tel2Alterno', 'tel3Alterno', 'tel4Alterno', 'planoGuiaRojiAlterno', 'cuadranteGuiaRojiAlterno', 'statusAarsa', 'sucursalCliente', 'parentescoRef1', 'nombreReferencia1', 'domicilioReferencia1', 'coloniaReferencia1', 'ciudadReferencia1', 'estadoReferencia1', 'cpReferencia1', 'tel1Ref1', 'tel2Ref1', 'parentescoRef2', 'nombreReferencia2', 'domicilioReferencia2', 'coloniaReferencia2', 'ciudadReferencia2', 'estadoReferencia2', 'cpReferencia2', 'tel1Ref2', 'tel2Ref2', 'parentescoRef3', 'nombreReferencia3', 'domicilioReferencia3', 'coloniaReferencia3', 'ciudadReferencia3', 'estadoReferencia3', 'cpReferencia3', 'tel1Ref3', 'tel2Ref3', 'parentescoRef4', 'nombreReferencia4', 'domicilioReferencia4', 'coloniaReferencia4', 'ciudadReferencia4', 'estadoReferencia4', 'cpReferencia4', 'tel1Ref4', 'tel2Ref4', 'domicilioLaboral', 'coloniaLaboral', 'ciudadLaboral', 'estadoLaboral', 'cpLaboral', 'tel1Laboral', 'tel2Laboral', 'saldoCorriente', 'fechaDeActualizacion', 'numeroDeCuenta', 'numeroDeCredito', 'contrato', 'saldoTotal', 'saldoVencido', 'saldoDescuento1', 'saldoDescuento2', 'fechaCorte', 'fechaLimite', 'fechaDeUltimoPago', 'montoUltimoPago', 'producto', 'subproducto', 'cliente', 'statusDeCredito', 'pagosVencidos', 'montoAdeudado', 'fechaDeAsignacion', 'fechaDeDeasignacion', 'cuentaConcentradora1', 'saldoCuota', 'emailDeudor', 'idCuenta', 'pagoPactado', 'rfcDeudor', 'telefonosMarcados', 'tel1Verif', 'tel2Verif', 'tel3Verif', 'tel4Verif', 'telefonoDeUltimoContacto', 'diasVencidos', 'ejecutivoAsignadoCallCenter', 'ejecutivoAsignadoDomiciliario', 'prioridadDeGestion', 'regionAarsa', 'parentescoAval', 'localizar', 'fechaUltimaGestion', 'empresa', 'timelock', 'locker', 'fechaDeVenta', 'especial', 'direccionNueva', 'norobot', 'user', 'timeuser', ),
        BasePeer::TYPE_COLNAME => array (RslicePeer::NOMBRE_DEUDOR, RslicePeer::DOMICILIO_DEUDOR, RslicePeer::COLONIA_DEUDOR, RslicePeer::CIUDAD_DEUDOR, RslicePeer::ESTADO_DEUDOR, RslicePeer::CP_DEUDOR, RslicePeer::PLANO_GUIA_ROJI, RslicePeer::CUADRANTE_GUIA_ROJI, RslicePeer::TEL_1, RslicePeer::TEL_2, RslicePeer::TEL_3, RslicePeer::TEL_4, RslicePeer::NOMBRE_DEUDOR_ALTERNO, RslicePeer::DOMICILIO_DEUDOR_ALTERNO, RslicePeer::COLONIA_DEUDOR_ALTERNO, RslicePeer::CIUDAD_DEUDOR_ALTERNO, RslicePeer::ESTADO_DEUDOR_ALTERNO, RslicePeer::CP_DEUDOR_ATERNO, RslicePeer::TEL_1_ALTERNO, RslicePeer::TEL_2_ALTERNO, RslicePeer::TEL_3_ALTERNO, RslicePeer::TEL_4_ALTERNO, RslicePeer::PLANO_GUIA_ROJI_ALTERNO, RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO, RslicePeer::STATUS_AARSA, RslicePeer::SUCURSAL_CLIENTE, RslicePeer::PARENTESCO_REF_1, RslicePeer::NOMBRE_REFERENCIA_1, RslicePeer::DOMICILIO_REFERENCIA_1, RslicePeer::COLONIA_REFERENCIA_1, RslicePeer::CIUDAD_REFERENCIA_1, RslicePeer::ESTADO_REFERENCIA_1, RslicePeer::CP_REFERENCIA_1, RslicePeer::TEL_1_REF_1, RslicePeer::TEL_2_REF_1, RslicePeer::PARENTESCO_REF_2, RslicePeer::NOMBRE_REFERENCIA_2, RslicePeer::DOMICILIO_REFERENCIA_2, RslicePeer::COLONIA_REFERENCIA_2, RslicePeer::CIUDAD_REFERENCIA_2, RslicePeer::ESTADO_REFERENCIA_2, RslicePeer::CP_REFERENCIA_2, RslicePeer::TEL_1_REF_2, RslicePeer::TEL_2_REF_2, RslicePeer::PARENTESCO_REF_3, RslicePeer::NOMBRE_REFERENCIA_3, RslicePeer::DOMICILIO_REFERENCIA_3, RslicePeer::COLONIA_REFERENCIA_3, RslicePeer::CIUDAD_REFERENCIA_3, RslicePeer::ESTADO_REFERENCIA_3, RslicePeer::CP_REFERENCIA_3, RslicePeer::TEL_1_REF_3, RslicePeer::TEL_2_REF_3, RslicePeer::PARENTESCO_REF_4, RslicePeer::NOMBRE_REFERENCIA_4, RslicePeer::DOMICILIO_REFERENCIA_4, RslicePeer::COLONIA_REFERENCIA_4, RslicePeer::CIUDAD_REFERENCIA_4, RslicePeer::ESTADO_REFERENCIA_4, RslicePeer::CP_REFERENCIA_4, RslicePeer::TEL_1_REF_4, RslicePeer::TEL_2_REF_4, RslicePeer::DOMICILIO_LABORAL, RslicePeer::COLONIA_LABORAL, RslicePeer::CIUDAD_LABORAL, RslicePeer::ESTADO_LABORAL, RslicePeer::CP_LABORAL, RslicePeer::TEL_1_LABORAL, RslicePeer::TEL_2_LABORAL, RslicePeer::SALDO_CORRIENTE, RslicePeer::FECHA_DE_ACTUALIZACION, RslicePeer::NUMERO_DE_CUENTA, RslicePeer::NUMERO_DE_CREDITO, RslicePeer::CONTRATO, RslicePeer::SALDO_TOTAL, RslicePeer::SALDO_VENCIDO, RslicePeer::SALDO_DESCUENTO_1, RslicePeer::SALDO_DESCUENTO_2, RslicePeer::FECHA_CORTE, RslicePeer::FECHA_LIMITE, RslicePeer::FECHA_DE_ULTIMO_PAGO, RslicePeer::MONTO_ULTIMO_PAGO, RslicePeer::PRODUCTO, RslicePeer::SUBPRODUCTO, RslicePeer::CLIENTE, RslicePeer::STATUS_DE_CREDITO, RslicePeer::PAGOS_VENCIDOS, RslicePeer::MONTO_ADEUDADO, RslicePeer::FECHA_DE_ASIGNACION, RslicePeer::FECHA_DE_DEASIGNACION, RslicePeer::CUENTA_CONCENTRADORA_1, RslicePeer::SALDO_CUOTA, RslicePeer::EMAIL_DEUDOR, RslicePeer::ID_CUENTA, RslicePeer::PAGO_PACTADO, RslicePeer::RFC_DEUDOR, RslicePeer::TELEFONOS_MARCADOS, RslicePeer::TEL_1_VERIF, RslicePeer::TEL_2_VERIF, RslicePeer::TEL_3_VERIF, RslicePeer::TEL_4_VERIF, RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO, RslicePeer::DIAS_VENCIDOS, RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER, RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO, RslicePeer::PRIORIDAD_DE_GESTION, RslicePeer::REGION_AARSA, RslicePeer::PARENTESCO_AVAL, RslicePeer::LOCALIZAR, RslicePeer::FECHA_ULTIMA_GESTION, RslicePeer::EMPRESA, RslicePeer::TIMELOCK, RslicePeer::LOCKER, RslicePeer::FECHA_DE_VENTA, RslicePeer::ESPECIAL, RslicePeer::DIRECCION_NUEVA, RslicePeer::NOROBOT, RslicePeer::USER, RslicePeer::TIMEUSER, ),
        BasePeer::TYPE_RAW_COLNAME => array ('NOMBRE_DEUDOR', 'DOMICILIO_DEUDOR', 'COLONIA_DEUDOR', 'CIUDAD_DEUDOR', 'ESTADO_DEUDOR', 'CP_DEUDOR', 'PLANO_GUIA_ROJI', 'CUADRANTE_GUIA_ROJI', 'TEL_1', 'TEL_2', 'TEL_3', 'TEL_4', 'NOMBRE_DEUDOR_ALTERNO', 'DOMICILIO_DEUDOR_ALTERNO', 'COLONIA_DEUDOR_ALTERNO', 'CIUDAD_DEUDOR_ALTERNO', 'ESTADO_DEUDOR_ALTERNO', 'CP_DEUDOR_ATERNO', 'TEL_1_ALTERNO', 'TEL_2_ALTERNO', 'TEL_3_ALTERNO', 'TEL_4_ALTERNO', 'PLANO_GUIA_ROJI_ALTERNO', 'CUADRANTE_GUIA_ROJI_ALTERNO', 'STATUS_AARSA', 'SUCURSAL_CLIENTE', 'PARENTESCO_REF_1', 'NOMBRE_REFERENCIA_1', 'DOMICILIO_REFERENCIA_1', 'COLONIA_REFERENCIA_1', 'CIUDAD_REFERENCIA_1', 'ESTADO_REFERENCIA_1', 'CP_REFERENCIA_1', 'TEL_1_REF_1', 'TEL_2_REF_1', 'PARENTESCO_REF_2', 'NOMBRE_REFERENCIA_2', 'DOMICILIO_REFERENCIA_2', 'COLONIA_REFERENCIA_2', 'CIUDAD_REFERENCIA_2', 'ESTADO_REFERENCIA_2', 'CP_REFERENCIA_2', 'TEL_1_REF_2', 'TEL_2_REF_2', 'PARENTESCO_REF_3', 'NOMBRE_REFERENCIA_3', 'DOMICILIO_REFERENCIA_3', 'COLONIA_REFERENCIA_3', 'CIUDAD_REFERENCIA_3', 'ESTADO_REFERENCIA_3', 'CP_REFERENCIA_3', 'TEL_1_REF_3', 'TEL_2_REF_3', 'PARENTESCO_REF_4', 'NOMBRE_REFERENCIA_4', 'DOMICILIO_REFERENCIA_4', 'COLONIA_REFERENCIA_4', 'CIUDAD_REFERENCIA_4', 'ESTADO_REFERENCIA_4', 'CP_REFERENCIA_4', 'TEL_1_REF_4', 'TEL_2_REF_4', 'DOMICILIO_LABORAL', 'COLONIA_LABORAL', 'CIUDAD_LABORAL', 'ESTADO_LABORAL', 'CP_LABORAL', 'TEL_1_LABORAL', 'TEL_2_LABORAL', 'SALDO_CORRIENTE', 'FECHA_DE_ACTUALIZACION', 'NUMERO_DE_CUENTA', 'NUMERO_DE_CREDITO', 'CONTRATO', 'SALDO_TOTAL', 'SALDO_VENCIDO', 'SALDO_DESCUENTO_1', 'SALDO_DESCUENTO_2', 'FECHA_CORTE', 'FECHA_LIMITE', 'FECHA_DE_ULTIMO_PAGO', 'MONTO_ULTIMO_PAGO', 'PRODUCTO', 'SUBPRODUCTO', 'CLIENTE', 'STATUS_DE_CREDITO', 'PAGOS_VENCIDOS', 'MONTO_ADEUDADO', 'FECHA_DE_ASIGNACION', 'FECHA_DE_DEASIGNACION', 'CUENTA_CONCENTRADORA_1', 'SALDO_CUOTA', 'EMAIL_DEUDOR', 'ID_CUENTA', 'PAGO_PACTADO', 'RFC_DEUDOR', 'TELEFONOS_MARCADOS', 'TEL_1_VERIF', 'TEL_2_VERIF', 'TEL_3_VERIF', 'TEL_4_VERIF', 'TELEFONO_DE_ULTIMO_CONTACTO', 'DIAS_VENCIDOS', 'EJECUTIVO_ASIGNADO_CALL_CENTER', 'EJECUTIVO_ASIGNADO_DOMICILIARIO', 'PRIORIDAD_DE_GESTION', 'REGION_AARSA', 'PARENTESCO_AVAL', 'LOCALIZAR', 'FECHA_ULTIMA_GESTION', 'EMPRESA', 'TIMELOCK', 'LOCKER', 'FECHA_DE_VENTA', 'ESPECIAL', 'DIRECCION_NUEVA', 'NOROBOT', 'USER', 'TIMEUSER', ),
        BasePeer::TYPE_FIELDNAME => array ('nombre_deudor', 'domicilio_deudor', 'colonia_deudor', 'ciudad_deudor', 'estado_deudor', 'cp_deudor', 'plano_guia_roji', 'cuadrante_guia_roji', 'tel_1', 'tel_2', 'tel_3', 'tel_4', 'nombre_deudor_alterno', 'domicilio_deudor_alterno', 'colonia_deudor_alterno', 'ciudad_deudor_alterno', 'estado_deudor_alterno', 'cp_deudor_aterno', 'tel_1_alterno', 'tel_2_alterno', 'tel_3_alterno', 'tel_4_alterno', 'plano_guia_roji_alterno', 'cuadrante_guia_roji_alterno', 'status_aarsa', 'sucursal_cliente', 'parentesco_ref_1', 'nombre_referencia_1', 'domicilio_referencia_1', 'colonia_referencia_1', 'ciudad_referencia_1', 'estado_referencia_1', 'cp_referencia_1', 'tel_1_ref_1', 'tel_2_ref_1', 'parentesco_ref_2', 'nombre_referencia_2', 'domicilio_referencia_2', 'colonia_referencia_2', 'ciudad_referencia_2', 'estado_referencia_2', 'cp_referencia_2', 'tel_1_ref_2', 'tel_2_ref_2', 'parentesco_ref_3', 'nombre_referencia_3', 'domicilio_referencia_3', 'colonia_referencia_3', 'ciudad_referencia_3', 'estado_referencia_3', 'cp_referencia_3', 'tel_1_ref_3', 'tel_2_ref_3', 'parentesco_ref_4', 'nombre_referencia_4', 'domicilio_referencia_4', 'colonia_referencia_4', 'ciudad_referencia_4', 'estado_referencia_4', 'cp_referencia_4', 'tel_1_ref_4', 'tel_2_ref_4', 'domicilio_laboral', 'colonia_laboral', 'ciudad_laboral', 'estado_laboral', 'cp_laboral', 'tel_1_laboral', 'tel_2_laboral', 'saldo_corriente', 'fecha_de_actualizacion', 'numero_de_cuenta', 'numero_de_credito', 'contrato', 'saldo_total', 'saldo_vencido', 'saldo_descuento_1', 'saldo_descuento_2', 'fecha_corte', 'fecha_limite', 'fecha_de_ultimo_pago', 'monto_ultimo_pago', 'producto', 'subproducto', 'cliente', 'status_de_credito', 'pagos_vencidos', 'monto_adeudado', 'fecha_de_asignacion', 'fecha_de_deasignacion', 'cuenta_concentradora_1', 'saldo_cuota', 'email_deudor', 'id_cuenta', 'pago_pactado', 'rfc_deudor', 'telefonos_marcados', 'tel_1_verif', 'tel_2_verif', 'tel_3_verif', 'tel_4_verif', 'telefono_de_ultimo_contacto', 'dias_vencidos', 'ejecutivo_asignado_call_center', 'ejecutivo_asignado_domiciliario', 'prioridad_de_gestion', 'region_aarsa', 'parentesco_aval', 'localizar', 'fecha_ultima_gestion', 'empresa', 'timelock', 'locker', 'fecha_de_venta', 'especial', 'direccion_nueva', 'norobot', 'user', 'timeuser', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. RslicePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('NombreDeudor' => 0, 'DomicilioDeudor' => 1, 'ColoniaDeudor' => 2, 'CiudadDeudor' => 3, 'EstadoDeudor' => 4, 'CpDeudor' => 5, 'PlanoGuiaRoji' => 6, 'CuadranteGuiaRoji' => 7, 'Tel1' => 8, 'Tel2' => 9, 'Tel3' => 10, 'Tel4' => 11, 'NombreDeudorAlterno' => 12, 'DomicilioDeudorAlterno' => 13, 'ColoniaDeudorAlterno' => 14, 'CiudadDeudorAlterno' => 15, 'EstadoDeudorAlterno' => 16, 'CpDeudorAterno' => 17, 'Tel1Alterno' => 18, 'Tel2Alterno' => 19, 'Tel3Alterno' => 20, 'Tel4Alterno' => 21, 'PlanoGuiaRojiAlterno' => 22, 'CuadranteGuiaRojiAlterno' => 23, 'StatusAarsa' => 24, 'SucursalCliente' => 25, 'ParentescoRef1' => 26, 'NombreReferencia1' => 27, 'DomicilioReferencia1' => 28, 'ColoniaReferencia1' => 29, 'CiudadReferencia1' => 30, 'EstadoReferencia1' => 31, 'CpReferencia1' => 32, 'Tel1Ref1' => 33, 'Tel2Ref1' => 34, 'ParentescoRef2' => 35, 'NombreReferencia2' => 36, 'DomicilioReferencia2' => 37, 'ColoniaReferencia2' => 38, 'CiudadReferencia2' => 39, 'EstadoReferencia2' => 40, 'CpReferencia2' => 41, 'Tel1Ref2' => 42, 'Tel2Ref2' => 43, 'ParentescoRef3' => 44, 'NombreReferencia3' => 45, 'DomicilioReferencia3' => 46, 'ColoniaReferencia3' => 47, 'CiudadReferencia3' => 48, 'EstadoReferencia3' => 49, 'CpReferencia3' => 50, 'Tel1Ref3' => 51, 'Tel2Ref3' => 52, 'ParentescoRef4' => 53, 'NombreReferencia4' => 54, 'DomicilioReferencia4' => 55, 'ColoniaReferencia4' => 56, 'CiudadReferencia4' => 57, 'EstadoReferencia4' => 58, 'CpReferencia4' => 59, 'Tel1Ref4' => 60, 'Tel2Ref4' => 61, 'DomicilioLaboral' => 62, 'ColoniaLaboral' => 63, 'CiudadLaboral' => 64, 'EstadoLaboral' => 65, 'CpLaboral' => 66, 'Tel1Laboral' => 67, 'Tel2Laboral' => 68, 'SaldoCorriente' => 69, 'FechaDeActualizacion' => 70, 'NumeroDeCuenta' => 71, 'NumeroDeCredito' => 72, 'Contrato' => 73, 'SaldoTotal' => 74, 'SaldoVencido' => 75, 'SaldoDescuento1' => 76, 'SaldoDescuento2' => 77, 'FechaCorte' => 78, 'FechaLimite' => 79, 'FechaDeUltimoPago' => 80, 'MontoUltimoPago' => 81, 'Producto' => 82, 'Subproducto' => 83, 'Cliente' => 84, 'StatusDeCredito' => 85, 'PagosVencidos' => 86, 'MontoAdeudado' => 87, 'FechaDeAsignacion' => 88, 'FechaDeDeasignacion' => 89, 'CuentaConcentradora1' => 90, 'SaldoCuota' => 91, 'EmailDeudor' => 92, 'IdCuenta' => 93, 'PagoPactado' => 94, 'RfcDeudor' => 95, 'TelefonosMarcados' => 96, 'Tel1Verif' => 97, 'Tel2Verif' => 98, 'Tel3Verif' => 99, 'Tel4Verif' => 100, 'TelefonoDeUltimoContacto' => 101, 'DiasVencidos' => 102, 'EjecutivoAsignadoCallCenter' => 103, 'EjecutivoAsignadoDomiciliario' => 104, 'PrioridadDeGestion' => 105, 'RegionAarsa' => 106, 'ParentescoAval' => 107, 'Localizar' => 108, 'FechaUltimaGestion' => 109, 'Empresa' => 110, 'Timelock' => 111, 'Locker' => 112, 'FechaDeVenta' => 113, 'Especial' => 114, 'DireccionNueva' => 115, 'Norobot' => 116, 'User' => 117, 'Timeuser' => 118, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('nombreDeudor' => 0, 'domicilioDeudor' => 1, 'coloniaDeudor' => 2, 'ciudadDeudor' => 3, 'estadoDeudor' => 4, 'cpDeudor' => 5, 'planoGuiaRoji' => 6, 'cuadranteGuiaRoji' => 7, 'tel1' => 8, 'tel2' => 9, 'tel3' => 10, 'tel4' => 11, 'nombreDeudorAlterno' => 12, 'domicilioDeudorAlterno' => 13, 'coloniaDeudorAlterno' => 14, 'ciudadDeudorAlterno' => 15, 'estadoDeudorAlterno' => 16, 'cpDeudorAterno' => 17, 'tel1Alterno' => 18, 'tel2Alterno' => 19, 'tel3Alterno' => 20, 'tel4Alterno' => 21, 'planoGuiaRojiAlterno' => 22, 'cuadranteGuiaRojiAlterno' => 23, 'statusAarsa' => 24, 'sucursalCliente' => 25, 'parentescoRef1' => 26, 'nombreReferencia1' => 27, 'domicilioReferencia1' => 28, 'coloniaReferencia1' => 29, 'ciudadReferencia1' => 30, 'estadoReferencia1' => 31, 'cpReferencia1' => 32, 'tel1Ref1' => 33, 'tel2Ref1' => 34, 'parentescoRef2' => 35, 'nombreReferencia2' => 36, 'domicilioReferencia2' => 37, 'coloniaReferencia2' => 38, 'ciudadReferencia2' => 39, 'estadoReferencia2' => 40, 'cpReferencia2' => 41, 'tel1Ref2' => 42, 'tel2Ref2' => 43, 'parentescoRef3' => 44, 'nombreReferencia3' => 45, 'domicilioReferencia3' => 46, 'coloniaReferencia3' => 47, 'ciudadReferencia3' => 48, 'estadoReferencia3' => 49, 'cpReferencia3' => 50, 'tel1Ref3' => 51, 'tel2Ref3' => 52, 'parentescoRef4' => 53, 'nombreReferencia4' => 54, 'domicilioReferencia4' => 55, 'coloniaReferencia4' => 56, 'ciudadReferencia4' => 57, 'estadoReferencia4' => 58, 'cpReferencia4' => 59, 'tel1Ref4' => 60, 'tel2Ref4' => 61, 'domicilioLaboral' => 62, 'coloniaLaboral' => 63, 'ciudadLaboral' => 64, 'estadoLaboral' => 65, 'cpLaboral' => 66, 'tel1Laboral' => 67, 'tel2Laboral' => 68, 'saldoCorriente' => 69, 'fechaDeActualizacion' => 70, 'numeroDeCuenta' => 71, 'numeroDeCredito' => 72, 'contrato' => 73, 'saldoTotal' => 74, 'saldoVencido' => 75, 'saldoDescuento1' => 76, 'saldoDescuento2' => 77, 'fechaCorte' => 78, 'fechaLimite' => 79, 'fechaDeUltimoPago' => 80, 'montoUltimoPago' => 81, 'producto' => 82, 'subproducto' => 83, 'cliente' => 84, 'statusDeCredito' => 85, 'pagosVencidos' => 86, 'montoAdeudado' => 87, 'fechaDeAsignacion' => 88, 'fechaDeDeasignacion' => 89, 'cuentaConcentradora1' => 90, 'saldoCuota' => 91, 'emailDeudor' => 92, 'idCuenta' => 93, 'pagoPactado' => 94, 'rfcDeudor' => 95, 'telefonosMarcados' => 96, 'tel1Verif' => 97, 'tel2Verif' => 98, 'tel3Verif' => 99, 'tel4Verif' => 100, 'telefonoDeUltimoContacto' => 101, 'diasVencidos' => 102, 'ejecutivoAsignadoCallCenter' => 103, 'ejecutivoAsignadoDomiciliario' => 104, 'prioridadDeGestion' => 105, 'regionAarsa' => 106, 'parentescoAval' => 107, 'localizar' => 108, 'fechaUltimaGestion' => 109, 'empresa' => 110, 'timelock' => 111, 'locker' => 112, 'fechaDeVenta' => 113, 'especial' => 114, 'direccionNueva' => 115, 'norobot' => 116, 'user' => 117, 'timeuser' => 118, ),
        BasePeer::TYPE_COLNAME => array (RslicePeer::NOMBRE_DEUDOR => 0, RslicePeer::DOMICILIO_DEUDOR => 1, RslicePeer::COLONIA_DEUDOR => 2, RslicePeer::CIUDAD_DEUDOR => 3, RslicePeer::ESTADO_DEUDOR => 4, RslicePeer::CP_DEUDOR => 5, RslicePeer::PLANO_GUIA_ROJI => 6, RslicePeer::CUADRANTE_GUIA_ROJI => 7, RslicePeer::TEL_1 => 8, RslicePeer::TEL_2 => 9, RslicePeer::TEL_3 => 10, RslicePeer::TEL_4 => 11, RslicePeer::NOMBRE_DEUDOR_ALTERNO => 12, RslicePeer::DOMICILIO_DEUDOR_ALTERNO => 13, RslicePeer::COLONIA_DEUDOR_ALTERNO => 14, RslicePeer::CIUDAD_DEUDOR_ALTERNO => 15, RslicePeer::ESTADO_DEUDOR_ALTERNO => 16, RslicePeer::CP_DEUDOR_ATERNO => 17, RslicePeer::TEL_1_ALTERNO => 18, RslicePeer::TEL_2_ALTERNO => 19, RslicePeer::TEL_3_ALTERNO => 20, RslicePeer::TEL_4_ALTERNO => 21, RslicePeer::PLANO_GUIA_ROJI_ALTERNO => 22, RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO => 23, RslicePeer::STATUS_AARSA => 24, RslicePeer::SUCURSAL_CLIENTE => 25, RslicePeer::PARENTESCO_REF_1 => 26, RslicePeer::NOMBRE_REFERENCIA_1 => 27, RslicePeer::DOMICILIO_REFERENCIA_1 => 28, RslicePeer::COLONIA_REFERENCIA_1 => 29, RslicePeer::CIUDAD_REFERENCIA_1 => 30, RslicePeer::ESTADO_REFERENCIA_1 => 31, RslicePeer::CP_REFERENCIA_1 => 32, RslicePeer::TEL_1_REF_1 => 33, RslicePeer::TEL_2_REF_1 => 34, RslicePeer::PARENTESCO_REF_2 => 35, RslicePeer::NOMBRE_REFERENCIA_2 => 36, RslicePeer::DOMICILIO_REFERENCIA_2 => 37, RslicePeer::COLONIA_REFERENCIA_2 => 38, RslicePeer::CIUDAD_REFERENCIA_2 => 39, RslicePeer::ESTADO_REFERENCIA_2 => 40, RslicePeer::CP_REFERENCIA_2 => 41, RslicePeer::TEL_1_REF_2 => 42, RslicePeer::TEL_2_REF_2 => 43, RslicePeer::PARENTESCO_REF_3 => 44, RslicePeer::NOMBRE_REFERENCIA_3 => 45, RslicePeer::DOMICILIO_REFERENCIA_3 => 46, RslicePeer::COLONIA_REFERENCIA_3 => 47, RslicePeer::CIUDAD_REFERENCIA_3 => 48, RslicePeer::ESTADO_REFERENCIA_3 => 49, RslicePeer::CP_REFERENCIA_3 => 50, RslicePeer::TEL_1_REF_3 => 51, RslicePeer::TEL_2_REF_3 => 52, RslicePeer::PARENTESCO_REF_4 => 53, RslicePeer::NOMBRE_REFERENCIA_4 => 54, RslicePeer::DOMICILIO_REFERENCIA_4 => 55, RslicePeer::COLONIA_REFERENCIA_4 => 56, RslicePeer::CIUDAD_REFERENCIA_4 => 57, RslicePeer::ESTADO_REFERENCIA_4 => 58, RslicePeer::CP_REFERENCIA_4 => 59, RslicePeer::TEL_1_REF_4 => 60, RslicePeer::TEL_2_REF_4 => 61, RslicePeer::DOMICILIO_LABORAL => 62, RslicePeer::COLONIA_LABORAL => 63, RslicePeer::CIUDAD_LABORAL => 64, RslicePeer::ESTADO_LABORAL => 65, RslicePeer::CP_LABORAL => 66, RslicePeer::TEL_1_LABORAL => 67, RslicePeer::TEL_2_LABORAL => 68, RslicePeer::SALDO_CORRIENTE => 69, RslicePeer::FECHA_DE_ACTUALIZACION => 70, RslicePeer::NUMERO_DE_CUENTA => 71, RslicePeer::NUMERO_DE_CREDITO => 72, RslicePeer::CONTRATO => 73, RslicePeer::SALDO_TOTAL => 74, RslicePeer::SALDO_VENCIDO => 75, RslicePeer::SALDO_DESCUENTO_1 => 76, RslicePeer::SALDO_DESCUENTO_2 => 77, RslicePeer::FECHA_CORTE => 78, RslicePeer::FECHA_LIMITE => 79, RslicePeer::FECHA_DE_ULTIMO_PAGO => 80, RslicePeer::MONTO_ULTIMO_PAGO => 81, RslicePeer::PRODUCTO => 82, RslicePeer::SUBPRODUCTO => 83, RslicePeer::CLIENTE => 84, RslicePeer::STATUS_DE_CREDITO => 85, RslicePeer::PAGOS_VENCIDOS => 86, RslicePeer::MONTO_ADEUDADO => 87, RslicePeer::FECHA_DE_ASIGNACION => 88, RslicePeer::FECHA_DE_DEASIGNACION => 89, RslicePeer::CUENTA_CONCENTRADORA_1 => 90, RslicePeer::SALDO_CUOTA => 91, RslicePeer::EMAIL_DEUDOR => 92, RslicePeer::ID_CUENTA => 93, RslicePeer::PAGO_PACTADO => 94, RslicePeer::RFC_DEUDOR => 95, RslicePeer::TELEFONOS_MARCADOS => 96, RslicePeer::TEL_1_VERIF => 97, RslicePeer::TEL_2_VERIF => 98, RslicePeer::TEL_3_VERIF => 99, RslicePeer::TEL_4_VERIF => 100, RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO => 101, RslicePeer::DIAS_VENCIDOS => 102, RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER => 103, RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO => 104, RslicePeer::PRIORIDAD_DE_GESTION => 105, RslicePeer::REGION_AARSA => 106, RslicePeer::PARENTESCO_AVAL => 107, RslicePeer::LOCALIZAR => 108, RslicePeer::FECHA_ULTIMA_GESTION => 109, RslicePeer::EMPRESA => 110, RslicePeer::TIMELOCK => 111, RslicePeer::LOCKER => 112, RslicePeer::FECHA_DE_VENTA => 113, RslicePeer::ESPECIAL => 114, RslicePeer::DIRECCION_NUEVA => 115, RslicePeer::NOROBOT => 116, RslicePeer::USER => 117, RslicePeer::TIMEUSER => 118, ),
        BasePeer::TYPE_RAW_COLNAME => array ('NOMBRE_DEUDOR' => 0, 'DOMICILIO_DEUDOR' => 1, 'COLONIA_DEUDOR' => 2, 'CIUDAD_DEUDOR' => 3, 'ESTADO_DEUDOR' => 4, 'CP_DEUDOR' => 5, 'PLANO_GUIA_ROJI' => 6, 'CUADRANTE_GUIA_ROJI' => 7, 'TEL_1' => 8, 'TEL_2' => 9, 'TEL_3' => 10, 'TEL_4' => 11, 'NOMBRE_DEUDOR_ALTERNO' => 12, 'DOMICILIO_DEUDOR_ALTERNO' => 13, 'COLONIA_DEUDOR_ALTERNO' => 14, 'CIUDAD_DEUDOR_ALTERNO' => 15, 'ESTADO_DEUDOR_ALTERNO' => 16, 'CP_DEUDOR_ATERNO' => 17, 'TEL_1_ALTERNO' => 18, 'TEL_2_ALTERNO' => 19, 'TEL_3_ALTERNO' => 20, 'TEL_4_ALTERNO' => 21, 'PLANO_GUIA_ROJI_ALTERNO' => 22, 'CUADRANTE_GUIA_ROJI_ALTERNO' => 23, 'STATUS_AARSA' => 24, 'SUCURSAL_CLIENTE' => 25, 'PARENTESCO_REF_1' => 26, 'NOMBRE_REFERENCIA_1' => 27, 'DOMICILIO_REFERENCIA_1' => 28, 'COLONIA_REFERENCIA_1' => 29, 'CIUDAD_REFERENCIA_1' => 30, 'ESTADO_REFERENCIA_1' => 31, 'CP_REFERENCIA_1' => 32, 'TEL_1_REF_1' => 33, 'TEL_2_REF_1' => 34, 'PARENTESCO_REF_2' => 35, 'NOMBRE_REFERENCIA_2' => 36, 'DOMICILIO_REFERENCIA_2' => 37, 'COLONIA_REFERENCIA_2' => 38, 'CIUDAD_REFERENCIA_2' => 39, 'ESTADO_REFERENCIA_2' => 40, 'CP_REFERENCIA_2' => 41, 'TEL_1_REF_2' => 42, 'TEL_2_REF_2' => 43, 'PARENTESCO_REF_3' => 44, 'NOMBRE_REFERENCIA_3' => 45, 'DOMICILIO_REFERENCIA_3' => 46, 'COLONIA_REFERENCIA_3' => 47, 'CIUDAD_REFERENCIA_3' => 48, 'ESTADO_REFERENCIA_3' => 49, 'CP_REFERENCIA_3' => 50, 'TEL_1_REF_3' => 51, 'TEL_2_REF_3' => 52, 'PARENTESCO_REF_4' => 53, 'NOMBRE_REFERENCIA_4' => 54, 'DOMICILIO_REFERENCIA_4' => 55, 'COLONIA_REFERENCIA_4' => 56, 'CIUDAD_REFERENCIA_4' => 57, 'ESTADO_REFERENCIA_4' => 58, 'CP_REFERENCIA_4' => 59, 'TEL_1_REF_4' => 60, 'TEL_2_REF_4' => 61, 'DOMICILIO_LABORAL' => 62, 'COLONIA_LABORAL' => 63, 'CIUDAD_LABORAL' => 64, 'ESTADO_LABORAL' => 65, 'CP_LABORAL' => 66, 'TEL_1_LABORAL' => 67, 'TEL_2_LABORAL' => 68, 'SALDO_CORRIENTE' => 69, 'FECHA_DE_ACTUALIZACION' => 70, 'NUMERO_DE_CUENTA' => 71, 'NUMERO_DE_CREDITO' => 72, 'CONTRATO' => 73, 'SALDO_TOTAL' => 74, 'SALDO_VENCIDO' => 75, 'SALDO_DESCUENTO_1' => 76, 'SALDO_DESCUENTO_2' => 77, 'FECHA_CORTE' => 78, 'FECHA_LIMITE' => 79, 'FECHA_DE_ULTIMO_PAGO' => 80, 'MONTO_ULTIMO_PAGO' => 81, 'PRODUCTO' => 82, 'SUBPRODUCTO' => 83, 'CLIENTE' => 84, 'STATUS_DE_CREDITO' => 85, 'PAGOS_VENCIDOS' => 86, 'MONTO_ADEUDADO' => 87, 'FECHA_DE_ASIGNACION' => 88, 'FECHA_DE_DEASIGNACION' => 89, 'CUENTA_CONCENTRADORA_1' => 90, 'SALDO_CUOTA' => 91, 'EMAIL_DEUDOR' => 92, 'ID_CUENTA' => 93, 'PAGO_PACTADO' => 94, 'RFC_DEUDOR' => 95, 'TELEFONOS_MARCADOS' => 96, 'TEL_1_VERIF' => 97, 'TEL_2_VERIF' => 98, 'TEL_3_VERIF' => 99, 'TEL_4_VERIF' => 100, 'TELEFONO_DE_ULTIMO_CONTACTO' => 101, 'DIAS_VENCIDOS' => 102, 'EJECUTIVO_ASIGNADO_CALL_CENTER' => 103, 'EJECUTIVO_ASIGNADO_DOMICILIARIO' => 104, 'PRIORIDAD_DE_GESTION' => 105, 'REGION_AARSA' => 106, 'PARENTESCO_AVAL' => 107, 'LOCALIZAR' => 108, 'FECHA_ULTIMA_GESTION' => 109, 'EMPRESA' => 110, 'TIMELOCK' => 111, 'LOCKER' => 112, 'FECHA_DE_VENTA' => 113, 'ESPECIAL' => 114, 'DIRECCION_NUEVA' => 115, 'NOROBOT' => 116, 'USER' => 117, 'TIMEUSER' => 118, ),
        BasePeer::TYPE_FIELDNAME => array ('nombre_deudor' => 0, 'domicilio_deudor' => 1, 'colonia_deudor' => 2, 'ciudad_deudor' => 3, 'estado_deudor' => 4, 'cp_deudor' => 5, 'plano_guia_roji' => 6, 'cuadrante_guia_roji' => 7, 'tel_1' => 8, 'tel_2' => 9, 'tel_3' => 10, 'tel_4' => 11, 'nombre_deudor_alterno' => 12, 'domicilio_deudor_alterno' => 13, 'colonia_deudor_alterno' => 14, 'ciudad_deudor_alterno' => 15, 'estado_deudor_alterno' => 16, 'cp_deudor_aterno' => 17, 'tel_1_alterno' => 18, 'tel_2_alterno' => 19, 'tel_3_alterno' => 20, 'tel_4_alterno' => 21, 'plano_guia_roji_alterno' => 22, 'cuadrante_guia_roji_alterno' => 23, 'status_aarsa' => 24, 'sucursal_cliente' => 25, 'parentesco_ref_1' => 26, 'nombre_referencia_1' => 27, 'domicilio_referencia_1' => 28, 'colonia_referencia_1' => 29, 'ciudad_referencia_1' => 30, 'estado_referencia_1' => 31, 'cp_referencia_1' => 32, 'tel_1_ref_1' => 33, 'tel_2_ref_1' => 34, 'parentesco_ref_2' => 35, 'nombre_referencia_2' => 36, 'domicilio_referencia_2' => 37, 'colonia_referencia_2' => 38, 'ciudad_referencia_2' => 39, 'estado_referencia_2' => 40, 'cp_referencia_2' => 41, 'tel_1_ref_2' => 42, 'tel_2_ref_2' => 43, 'parentesco_ref_3' => 44, 'nombre_referencia_3' => 45, 'domicilio_referencia_3' => 46, 'colonia_referencia_3' => 47, 'ciudad_referencia_3' => 48, 'estado_referencia_3' => 49, 'cp_referencia_3' => 50, 'tel_1_ref_3' => 51, 'tel_2_ref_3' => 52, 'parentesco_ref_4' => 53, 'nombre_referencia_4' => 54, 'domicilio_referencia_4' => 55, 'colonia_referencia_4' => 56, 'ciudad_referencia_4' => 57, 'estado_referencia_4' => 58, 'cp_referencia_4' => 59, 'tel_1_ref_4' => 60, 'tel_2_ref_4' => 61, 'domicilio_laboral' => 62, 'colonia_laboral' => 63, 'ciudad_laboral' => 64, 'estado_laboral' => 65, 'cp_laboral' => 66, 'tel_1_laboral' => 67, 'tel_2_laboral' => 68, 'saldo_corriente' => 69, 'fecha_de_actualizacion' => 70, 'numero_de_cuenta' => 71, 'numero_de_credito' => 72, 'contrato' => 73, 'saldo_total' => 74, 'saldo_vencido' => 75, 'saldo_descuento_1' => 76, 'saldo_descuento_2' => 77, 'fecha_corte' => 78, 'fecha_limite' => 79, 'fecha_de_ultimo_pago' => 80, 'monto_ultimo_pago' => 81, 'producto' => 82, 'subproducto' => 83, 'cliente' => 84, 'status_de_credito' => 85, 'pagos_vencidos' => 86, 'monto_adeudado' => 87, 'fecha_de_asignacion' => 88, 'fecha_de_deasignacion' => 89, 'cuenta_concentradora_1' => 90, 'saldo_cuota' => 91, 'email_deudor' => 92, 'id_cuenta' => 93, 'pago_pactado' => 94, 'rfc_deudor' => 95, 'telefonos_marcados' => 96, 'tel_1_verif' => 97, 'tel_2_verif' => 98, 'tel_3_verif' => 99, 'tel_4_verif' => 100, 'telefono_de_ultimo_contacto' => 101, 'dias_vencidos' => 102, 'ejecutivo_asignado_call_center' => 103, 'ejecutivo_asignado_domiciliario' => 104, 'prioridad_de_gestion' => 105, 'region_aarsa' => 106, 'parentesco_aval' => 107, 'localizar' => 108, 'fecha_ultima_gestion' => 109, 'empresa' => 110, 'timelock' => 111, 'locker' => 112, 'fecha_de_venta' => 113, 'especial' => 114, 'direccion_nueva' => 115, 'norobot' => 116, 'user' => 117, 'timeuser' => 118, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = RslicePeer::getFieldNames($toType);
        $key = isset(RslicePeer::$fieldKeys[$fromType][$name]) ? RslicePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(RslicePeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, RslicePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return RslicePeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. RslicePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(RslicePeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RslicePeer::NOMBRE_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::COLONIA_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::ESTADO_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::CP_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::PLANO_GUIA_ROJI);
            $criteria->addSelectColumn(RslicePeer::CUADRANTE_GUIA_ROJI);
            $criteria->addSelectColumn(RslicePeer::TEL_1);
            $criteria->addSelectColumn(RslicePeer::TEL_2);
            $criteria->addSelectColumn(RslicePeer::TEL_3);
            $criteria->addSelectColumn(RslicePeer::TEL_4);
            $criteria->addSelectColumn(RslicePeer::NOMBRE_DEUDOR_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_DEUDOR_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::COLONIA_DEUDOR_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_DEUDOR_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::ESTADO_DEUDOR_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::CP_DEUDOR_ATERNO);
            $criteria->addSelectColumn(RslicePeer::TEL_1_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::TEL_2_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::TEL_3_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::TEL_4_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::PLANO_GUIA_ROJI_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO);
            $criteria->addSelectColumn(RslicePeer::STATUS_AARSA);
            $criteria->addSelectColumn(RslicePeer::SUCURSAL_CLIENTE);
            $criteria->addSelectColumn(RslicePeer::PARENTESCO_REF_1);
            $criteria->addSelectColumn(RslicePeer::NOMBRE_REFERENCIA_1);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_REFERENCIA_1);
            $criteria->addSelectColumn(RslicePeer::COLONIA_REFERENCIA_1);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_REFERENCIA_1);
            $criteria->addSelectColumn(RslicePeer::ESTADO_REFERENCIA_1);
            $criteria->addSelectColumn(RslicePeer::CP_REFERENCIA_1);
            $criteria->addSelectColumn(RslicePeer::TEL_1_REF_1);
            $criteria->addSelectColumn(RslicePeer::TEL_2_REF_1);
            $criteria->addSelectColumn(RslicePeer::PARENTESCO_REF_2);
            $criteria->addSelectColumn(RslicePeer::NOMBRE_REFERENCIA_2);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_REFERENCIA_2);
            $criteria->addSelectColumn(RslicePeer::COLONIA_REFERENCIA_2);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_REFERENCIA_2);
            $criteria->addSelectColumn(RslicePeer::ESTADO_REFERENCIA_2);
            $criteria->addSelectColumn(RslicePeer::CP_REFERENCIA_2);
            $criteria->addSelectColumn(RslicePeer::TEL_1_REF_2);
            $criteria->addSelectColumn(RslicePeer::TEL_2_REF_2);
            $criteria->addSelectColumn(RslicePeer::PARENTESCO_REF_3);
            $criteria->addSelectColumn(RslicePeer::NOMBRE_REFERENCIA_3);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_REFERENCIA_3);
            $criteria->addSelectColumn(RslicePeer::COLONIA_REFERENCIA_3);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_REFERENCIA_3);
            $criteria->addSelectColumn(RslicePeer::ESTADO_REFERENCIA_3);
            $criteria->addSelectColumn(RslicePeer::CP_REFERENCIA_3);
            $criteria->addSelectColumn(RslicePeer::TEL_1_REF_3);
            $criteria->addSelectColumn(RslicePeer::TEL_2_REF_3);
            $criteria->addSelectColumn(RslicePeer::PARENTESCO_REF_4);
            $criteria->addSelectColumn(RslicePeer::NOMBRE_REFERENCIA_4);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_REFERENCIA_4);
            $criteria->addSelectColumn(RslicePeer::COLONIA_REFERENCIA_4);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_REFERENCIA_4);
            $criteria->addSelectColumn(RslicePeer::ESTADO_REFERENCIA_4);
            $criteria->addSelectColumn(RslicePeer::CP_REFERENCIA_4);
            $criteria->addSelectColumn(RslicePeer::TEL_1_REF_4);
            $criteria->addSelectColumn(RslicePeer::TEL_2_REF_4);
            $criteria->addSelectColumn(RslicePeer::DOMICILIO_LABORAL);
            $criteria->addSelectColumn(RslicePeer::COLONIA_LABORAL);
            $criteria->addSelectColumn(RslicePeer::CIUDAD_LABORAL);
            $criteria->addSelectColumn(RslicePeer::ESTADO_LABORAL);
            $criteria->addSelectColumn(RslicePeer::CP_LABORAL);
            $criteria->addSelectColumn(RslicePeer::TEL_1_LABORAL);
            $criteria->addSelectColumn(RslicePeer::TEL_2_LABORAL);
            $criteria->addSelectColumn(RslicePeer::SALDO_CORRIENTE);
            $criteria->addSelectColumn(RslicePeer::FECHA_DE_ACTUALIZACION);
            $criteria->addSelectColumn(RslicePeer::NUMERO_DE_CUENTA);
            $criteria->addSelectColumn(RslicePeer::NUMERO_DE_CREDITO);
            $criteria->addSelectColumn(RslicePeer::CONTRATO);
            $criteria->addSelectColumn(RslicePeer::SALDO_TOTAL);
            $criteria->addSelectColumn(RslicePeer::SALDO_VENCIDO);
            $criteria->addSelectColumn(RslicePeer::SALDO_DESCUENTO_1);
            $criteria->addSelectColumn(RslicePeer::SALDO_DESCUENTO_2);
            $criteria->addSelectColumn(RslicePeer::FECHA_CORTE);
            $criteria->addSelectColumn(RslicePeer::FECHA_LIMITE);
            $criteria->addSelectColumn(RslicePeer::FECHA_DE_ULTIMO_PAGO);
            $criteria->addSelectColumn(RslicePeer::MONTO_ULTIMO_PAGO);
            $criteria->addSelectColumn(RslicePeer::PRODUCTO);
            $criteria->addSelectColumn(RslicePeer::SUBPRODUCTO);
            $criteria->addSelectColumn(RslicePeer::CLIENTE);
            $criteria->addSelectColumn(RslicePeer::STATUS_DE_CREDITO);
            $criteria->addSelectColumn(RslicePeer::PAGOS_VENCIDOS);
            $criteria->addSelectColumn(RslicePeer::MONTO_ADEUDADO);
            $criteria->addSelectColumn(RslicePeer::FECHA_DE_ASIGNACION);
            $criteria->addSelectColumn(RslicePeer::FECHA_DE_DEASIGNACION);
            $criteria->addSelectColumn(RslicePeer::CUENTA_CONCENTRADORA_1);
            $criteria->addSelectColumn(RslicePeer::SALDO_CUOTA);
            $criteria->addSelectColumn(RslicePeer::EMAIL_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::ID_CUENTA);
            $criteria->addSelectColumn(RslicePeer::PAGO_PACTADO);
            $criteria->addSelectColumn(RslicePeer::RFC_DEUDOR);
            $criteria->addSelectColumn(RslicePeer::TELEFONOS_MARCADOS);
            $criteria->addSelectColumn(RslicePeer::TEL_1_VERIF);
            $criteria->addSelectColumn(RslicePeer::TEL_2_VERIF);
            $criteria->addSelectColumn(RslicePeer::TEL_3_VERIF);
            $criteria->addSelectColumn(RslicePeer::TEL_4_VERIF);
            $criteria->addSelectColumn(RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO);
            $criteria->addSelectColumn(RslicePeer::DIAS_VENCIDOS);
            $criteria->addSelectColumn(RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER);
            $criteria->addSelectColumn(RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO);
            $criteria->addSelectColumn(RslicePeer::PRIORIDAD_DE_GESTION);
            $criteria->addSelectColumn(RslicePeer::REGION_AARSA);
            $criteria->addSelectColumn(RslicePeer::PARENTESCO_AVAL);
            $criteria->addSelectColumn(RslicePeer::LOCALIZAR);
            $criteria->addSelectColumn(RslicePeer::FECHA_ULTIMA_GESTION);
            $criteria->addSelectColumn(RslicePeer::EMPRESA);
            $criteria->addSelectColumn(RslicePeer::TIMELOCK);
            $criteria->addSelectColumn(RslicePeer::LOCKER);
            $criteria->addSelectColumn(RslicePeer::FECHA_DE_VENTA);
            $criteria->addSelectColumn(RslicePeer::ESPECIAL);
            $criteria->addSelectColumn(RslicePeer::DIRECCION_NUEVA);
            $criteria->addSelectColumn(RslicePeer::NOROBOT);
            $criteria->addSelectColumn(RslicePeer::USER);
            $criteria->addSelectColumn(RslicePeer::TIMEUSER);
        } else {
            $criteria->addSelectColumn($alias . '.nombre_deudor');
            $criteria->addSelectColumn($alias . '.domicilio_deudor');
            $criteria->addSelectColumn($alias . '.colonia_deudor');
            $criteria->addSelectColumn($alias . '.ciudad_deudor');
            $criteria->addSelectColumn($alias . '.estado_deudor');
            $criteria->addSelectColumn($alias . '.cp_deudor');
            $criteria->addSelectColumn($alias . '.plano_guia_roji');
            $criteria->addSelectColumn($alias . '.cuadrante_guia_roji');
            $criteria->addSelectColumn($alias . '.tel_1');
            $criteria->addSelectColumn($alias . '.tel_2');
            $criteria->addSelectColumn($alias . '.tel_3');
            $criteria->addSelectColumn($alias . '.tel_4');
            $criteria->addSelectColumn($alias . '.nombre_deudor_alterno');
            $criteria->addSelectColumn($alias . '.domicilio_deudor_alterno');
            $criteria->addSelectColumn($alias . '.colonia_deudor_alterno');
            $criteria->addSelectColumn($alias . '.ciudad_deudor_alterno');
            $criteria->addSelectColumn($alias . '.estado_deudor_alterno');
            $criteria->addSelectColumn($alias . '.cp_deudor_aterno');
            $criteria->addSelectColumn($alias . '.tel_1_alterno');
            $criteria->addSelectColumn($alias . '.tel_2_alterno');
            $criteria->addSelectColumn($alias . '.tel_3_alterno');
            $criteria->addSelectColumn($alias . '.tel_4_alterno');
            $criteria->addSelectColumn($alias . '.plano_guia_roji_alterno');
            $criteria->addSelectColumn($alias . '.cuadrante_guia_roji_alterno');
            $criteria->addSelectColumn($alias . '.status_aarsa');
            $criteria->addSelectColumn($alias . '.sucursal_cliente');
            $criteria->addSelectColumn($alias . '.parentesco_ref_1');
            $criteria->addSelectColumn($alias . '.nombre_referencia_1');
            $criteria->addSelectColumn($alias . '.domicilio_referencia_1');
            $criteria->addSelectColumn($alias . '.colonia_referencia_1');
            $criteria->addSelectColumn($alias . '.ciudad_referencia_1');
            $criteria->addSelectColumn($alias . '.estado_referencia_1');
            $criteria->addSelectColumn($alias . '.cp_referencia_1');
            $criteria->addSelectColumn($alias . '.tel_1_ref_1');
            $criteria->addSelectColumn($alias . '.tel_2_ref_1');
            $criteria->addSelectColumn($alias . '.parentesco_ref_2');
            $criteria->addSelectColumn($alias . '.nombre_referencia_2');
            $criteria->addSelectColumn($alias . '.domicilio_referencia_2');
            $criteria->addSelectColumn($alias . '.colonia_referencia_2');
            $criteria->addSelectColumn($alias . '.ciudad_referencia_2');
            $criteria->addSelectColumn($alias . '.estado_referencia_2');
            $criteria->addSelectColumn($alias . '.cp_referencia_2');
            $criteria->addSelectColumn($alias . '.tel_1_ref_2');
            $criteria->addSelectColumn($alias . '.tel_2_ref_2');
            $criteria->addSelectColumn($alias . '.parentesco_ref_3');
            $criteria->addSelectColumn($alias . '.nombre_referencia_3');
            $criteria->addSelectColumn($alias . '.domicilio_referencia_3');
            $criteria->addSelectColumn($alias . '.colonia_referencia_3');
            $criteria->addSelectColumn($alias . '.ciudad_referencia_3');
            $criteria->addSelectColumn($alias . '.estado_referencia_3');
            $criteria->addSelectColumn($alias . '.cp_referencia_3');
            $criteria->addSelectColumn($alias . '.tel_1_ref_3');
            $criteria->addSelectColumn($alias . '.tel_2_ref_3');
            $criteria->addSelectColumn($alias . '.parentesco_ref_4');
            $criteria->addSelectColumn($alias . '.nombre_referencia_4');
            $criteria->addSelectColumn($alias . '.domicilio_referencia_4');
            $criteria->addSelectColumn($alias . '.colonia_referencia_4');
            $criteria->addSelectColumn($alias . '.ciudad_referencia_4');
            $criteria->addSelectColumn($alias . '.estado_referencia_4');
            $criteria->addSelectColumn($alias . '.cp_referencia_4');
            $criteria->addSelectColumn($alias . '.tel_1_ref_4');
            $criteria->addSelectColumn($alias . '.tel_2_ref_4');
            $criteria->addSelectColumn($alias . '.domicilio_laboral');
            $criteria->addSelectColumn($alias . '.colonia_laboral');
            $criteria->addSelectColumn($alias . '.ciudad_laboral');
            $criteria->addSelectColumn($alias . '.estado_laboral');
            $criteria->addSelectColumn($alias . '.cp_laboral');
            $criteria->addSelectColumn($alias . '.tel_1_laboral');
            $criteria->addSelectColumn($alias . '.tel_2_laboral');
            $criteria->addSelectColumn($alias . '.saldo_corriente');
            $criteria->addSelectColumn($alias . '.fecha_de_actualizacion');
            $criteria->addSelectColumn($alias . '.numero_de_cuenta');
            $criteria->addSelectColumn($alias . '.numero_de_credito');
            $criteria->addSelectColumn($alias . '.contrato');
            $criteria->addSelectColumn($alias . '.saldo_total');
            $criteria->addSelectColumn($alias . '.saldo_vencido');
            $criteria->addSelectColumn($alias . '.saldo_descuento_1');
            $criteria->addSelectColumn($alias . '.saldo_descuento_2');
            $criteria->addSelectColumn($alias . '.fecha_corte');
            $criteria->addSelectColumn($alias . '.fecha_limite');
            $criteria->addSelectColumn($alias . '.fecha_de_ultimo_pago');
            $criteria->addSelectColumn($alias . '.monto_ultimo_pago');
            $criteria->addSelectColumn($alias . '.producto');
            $criteria->addSelectColumn($alias . '.subproducto');
            $criteria->addSelectColumn($alias . '.cliente');
            $criteria->addSelectColumn($alias . '.status_de_credito');
            $criteria->addSelectColumn($alias . '.pagos_vencidos');
            $criteria->addSelectColumn($alias . '.monto_adeudado');
            $criteria->addSelectColumn($alias . '.fecha_de_asignacion');
            $criteria->addSelectColumn($alias . '.fecha_de_deasignacion');
            $criteria->addSelectColumn($alias . '.cuenta_concentradora_1');
            $criteria->addSelectColumn($alias . '.saldo_cuota');
            $criteria->addSelectColumn($alias . '.email_deudor');
            $criteria->addSelectColumn($alias . '.id_cuenta');
            $criteria->addSelectColumn($alias . '.pago_pactado');
            $criteria->addSelectColumn($alias . '.rfc_deudor');
            $criteria->addSelectColumn($alias . '.telefonos_marcados');
            $criteria->addSelectColumn($alias . '.tel_1_verif');
            $criteria->addSelectColumn($alias . '.tel_2_verif');
            $criteria->addSelectColumn($alias . '.tel_3_verif');
            $criteria->addSelectColumn($alias . '.tel_4_verif');
            $criteria->addSelectColumn($alias . '.telefono_de_ultimo_contacto');
            $criteria->addSelectColumn($alias . '.dias_vencidos');
            $criteria->addSelectColumn($alias . '.ejecutivo_asignado_call_center');
            $criteria->addSelectColumn($alias . '.ejecutivo_asignado_domiciliario');
            $criteria->addSelectColumn($alias . '.prioridad_de_gestion');
            $criteria->addSelectColumn($alias . '.region_aarsa');
            $criteria->addSelectColumn($alias . '.parentesco_aval');
            $criteria->addSelectColumn($alias . '.localizar');
            $criteria->addSelectColumn($alias . '.fecha_ultima_gestion');
            $criteria->addSelectColumn($alias . '.empresa');
            $criteria->addSelectColumn($alias . '.timelock');
            $criteria->addSelectColumn($alias . '.locker');
            $criteria->addSelectColumn($alias . '.fecha_de_venta');
            $criteria->addSelectColumn($alias . '.especial');
            $criteria->addSelectColumn($alias . '.direccion_nueva');
            $criteria->addSelectColumn($alias . '.norobot');
            $criteria->addSelectColumn($alias . '.user');
            $criteria->addSelectColumn($alias . '.timeuser');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(RslicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            RslicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(RslicePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Rslice
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = RslicePeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return RslicePeer::populateObjects(RslicePeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            RslicePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(RslicePeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Rslice $obj A Rslice object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIdCuenta();
            } // if key === null
            RslicePeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Rslice object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Rslice) {
                $key = (string) $value->getIdCuenta();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Rslice object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(RslicePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Rslice Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(RslicePeer::$instances[$key])) {
                return RslicePeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (RslicePeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        RslicePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to rslice
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol + 93] === null) {
            return null;
        }

        return (string) $row[$startcol + 93];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol + 93];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = RslicePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = RslicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = RslicePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RslicePeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Rslice object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = RslicePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = RslicePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + RslicePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RslicePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            RslicePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(RslicePeer::DATABASE_NAME)->getTable(RslicePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseRslicePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseRslicePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new RsliceTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return RslicePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Rslice or Criteria object.
     *
     * @param      mixed $values Criteria or Rslice object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Rslice object
        }

        if ($criteria->containsKey(RslicePeer::ID_CUENTA) && $criteria->keyContainsValue(RslicePeer::ID_CUENTA) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RslicePeer::ID_CUENTA.')');
        }


        // Set the correct dbName
        $criteria->setDbName(RslicePeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Rslice or Criteria object.
     *
     * @param      mixed $values Criteria or Rslice object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(RslicePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(RslicePeer::ID_CUENTA);
            $value = $criteria->remove(RslicePeer::ID_CUENTA);
            if ($value) {
                $selectCriteria->add(RslicePeer::ID_CUENTA, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(RslicePeer::TABLE_NAME);
            }

        } else { // $values is Rslice object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(RslicePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the rslice table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(RslicePeer::TABLE_NAME, $con, RslicePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RslicePeer::clearInstancePool();
            RslicePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Rslice or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Rslice object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            RslicePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Rslice) { // it's a model object
            // invalidate the cache for this single object
            RslicePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RslicePeer::DATABASE_NAME);
            $criteria->add(RslicePeer::ID_CUENTA, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                RslicePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(RslicePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            RslicePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Rslice object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Rslice $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(RslicePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(RslicePeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(RslicePeer::DATABASE_NAME, RslicePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Rslice
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = RslicePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(RslicePeer::DATABASE_NAME);
        $criteria->add(RslicePeer::ID_CUENTA, $pk);

        $v = RslicePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Rslice[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(RslicePeer::DATABASE_NAME);
            $criteria->add(RslicePeer::ID_CUENTA, $pks, Criteria::IN);
            $objs = RslicePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseRslicePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseRslicePeer::buildTableMap();

