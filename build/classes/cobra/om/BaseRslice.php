<?php


/**
 * Base class that represents a row from the 'rslice' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseRslice extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'RslicePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        RslicePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the nombre_deudor field.
     * @var        string
     */
    protected $nombre_deudor;

    /**
     * The value for the domicilio_deudor field.
     * @var        string
     */
    protected $domicilio_deudor;

    /**
     * The value for the colonia_deudor field.
     * @var        string
     */
    protected $colonia_deudor;

    /**
     * The value for the ciudad_deudor field.
     * @var        string
     */
    protected $ciudad_deudor;

    /**
     * The value for the estado_deudor field.
     * @var        string
     */
    protected $estado_deudor;

    /**
     * The value for the cp_deudor field.
     * @var        string
     */
    protected $cp_deudor;

    /**
     * The value for the plano_guia_roji field.
     * @var        string
     */
    protected $plano_guia_roji;

    /**
     * The value for the cuadrante_guia_roji field.
     * @var        string
     */
    protected $cuadrante_guia_roji;

    /**
     * The value for the tel_1 field.
     * @var        string
     */
    protected $tel_1;

    /**
     * The value for the tel_2 field.
     * @var        string
     */
    protected $tel_2;

    /**
     * The value for the tel_3 field.
     * @var        string
     */
    protected $tel_3;

    /**
     * The value for the tel_4 field.
     * @var        string
     */
    protected $tel_4;

    /**
     * The value for the nombre_deudor_alterno field.
     * @var        string
     */
    protected $nombre_deudor_alterno;

    /**
     * The value for the domicilio_deudor_alterno field.
     * @var        string
     */
    protected $domicilio_deudor_alterno;

    /**
     * The value for the colonia_deudor_alterno field.
     * @var        string
     */
    protected $colonia_deudor_alterno;

    /**
     * The value for the ciudad_deudor_alterno field.
     * @var        string
     */
    protected $ciudad_deudor_alterno;

    /**
     * The value for the estado_deudor_alterno field.
     * @var        string
     */
    protected $estado_deudor_alterno;

    /**
     * The value for the cp_deudor_aterno field.
     * @var        string
     */
    protected $cp_deudor_aterno;

    /**
     * The value for the tel_1_alterno field.
     * @var        string
     */
    protected $tel_1_alterno;

    /**
     * The value for the tel_2_alterno field.
     * @var        string
     */
    protected $tel_2_alterno;

    /**
     * The value for the tel_3_alterno field.
     * @var        string
     */
    protected $tel_3_alterno;

    /**
     * The value for the tel_4_alterno field.
     * @var        string
     */
    protected $tel_4_alterno;

    /**
     * The value for the plano_guia_roji_alterno field.
     * @var        string
     */
    protected $plano_guia_roji_alterno;

    /**
     * The value for the cuadrante_guia_roji_alterno field.
     * @var        string
     */
    protected $cuadrante_guia_roji_alterno;

    /**
     * The value for the status_aarsa field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $status_aarsa;

    /**
     * The value for the sucursal_cliente field.
     * @var        string
     */
    protected $sucursal_cliente;

    /**
     * The value for the parentesco_ref_1 field.
     * @var        string
     */
    protected $parentesco_ref_1;

    /**
     * The value for the nombre_referencia_1 field.
     * @var        string
     */
    protected $nombre_referencia_1;

    /**
     * The value for the domicilio_referencia_1 field.
     * @var        string
     */
    protected $domicilio_referencia_1;

    /**
     * The value for the colonia_referencia_1 field.
     * @var        string
     */
    protected $colonia_referencia_1;

    /**
     * The value for the ciudad_referencia_1 field.
     * @var        string
     */
    protected $ciudad_referencia_1;

    /**
     * The value for the estado_referencia_1 field.
     * @var        string
     */
    protected $estado_referencia_1;

    /**
     * The value for the cp_referencia_1 field.
     * @var        string
     */
    protected $cp_referencia_1;

    /**
     * The value for the tel_1_ref_1 field.
     * @var        string
     */
    protected $tel_1_ref_1;

    /**
     * The value for the tel_2_ref_1 field.
     * @var        string
     */
    protected $tel_2_ref_1;

    /**
     * The value for the parentesco_ref_2 field.
     * @var        string
     */
    protected $parentesco_ref_2;

    /**
     * The value for the nombre_referencia_2 field.
     * @var        string
     */
    protected $nombre_referencia_2;

    /**
     * The value for the domicilio_referencia_2 field.
     * @var        string
     */
    protected $domicilio_referencia_2;

    /**
     * The value for the colonia_referencia_2 field.
     * @var        string
     */
    protected $colonia_referencia_2;

    /**
     * The value for the ciudad_referencia_2 field.
     * @var        string
     */
    protected $ciudad_referencia_2;

    /**
     * The value for the estado_referencia_2 field.
     * @var        string
     */
    protected $estado_referencia_2;

    /**
     * The value for the cp_referencia_2 field.
     * @var        string
     */
    protected $cp_referencia_2;

    /**
     * The value for the tel_1_ref_2 field.
     * @var        string
     */
    protected $tel_1_ref_2;

    /**
     * The value for the tel_2_ref_2 field.
     * @var        string
     */
    protected $tel_2_ref_2;

    /**
     * The value for the parentesco_ref_3 field.
     * @var        string
     */
    protected $parentesco_ref_3;

    /**
     * The value for the nombre_referencia_3 field.
     * @var        string
     */
    protected $nombre_referencia_3;

    /**
     * The value for the domicilio_referencia_3 field.
     * @var        string
     */
    protected $domicilio_referencia_3;

    /**
     * The value for the colonia_referencia_3 field.
     * @var        string
     */
    protected $colonia_referencia_3;

    /**
     * The value for the ciudad_referencia_3 field.
     * @var        string
     */
    protected $ciudad_referencia_3;

    /**
     * The value for the estado_referencia_3 field.
     * @var        string
     */
    protected $estado_referencia_3;

    /**
     * The value for the cp_referencia_3 field.
     * @var        string
     */
    protected $cp_referencia_3;

    /**
     * The value for the tel_1_ref_3 field.
     * @var        string
     */
    protected $tel_1_ref_3;

    /**
     * The value for the tel_2_ref_3 field.
     * @var        string
     */
    protected $tel_2_ref_3;

    /**
     * The value for the parentesco_ref_4 field.
     * @var        string
     */
    protected $parentesco_ref_4;

    /**
     * The value for the nombre_referencia_4 field.
     * @var        string
     */
    protected $nombre_referencia_4;

    /**
     * The value for the domicilio_referencia_4 field.
     * @var        string
     */
    protected $domicilio_referencia_4;

    /**
     * The value for the colonia_referencia_4 field.
     * @var        string
     */
    protected $colonia_referencia_4;

    /**
     * The value for the ciudad_referencia_4 field.
     * @var        string
     */
    protected $ciudad_referencia_4;

    /**
     * The value for the estado_referencia_4 field.
     * @var        string
     */
    protected $estado_referencia_4;

    /**
     * The value for the cp_referencia_4 field.
     * @var        string
     */
    protected $cp_referencia_4;

    /**
     * The value for the tel_1_ref_4 field.
     * @var        string
     */
    protected $tel_1_ref_4;

    /**
     * The value for the tel_2_ref_4 field.
     * @var        string
     */
    protected $tel_2_ref_4;

    /**
     * The value for the domicilio_laboral field.
     * @var        string
     */
    protected $domicilio_laboral;

    /**
     * The value for the colonia_laboral field.
     * @var        string
     */
    protected $colonia_laboral;

    /**
     * The value for the ciudad_laboral field.
     * @var        string
     */
    protected $ciudad_laboral;

    /**
     * The value for the estado_laboral field.
     * @var        string
     */
    protected $estado_laboral;

    /**
     * The value for the cp_laboral field.
     * @var        string
     */
    protected $cp_laboral;

    /**
     * The value for the tel_1_laboral field.
     * @var        string
     */
    protected $tel_1_laboral;

    /**
     * The value for the tel_2_laboral field.
     * @var        string
     */
    protected $tel_2_laboral;

    /**
     * The value for the saldo_corriente field.
     * @var        string
     */
    protected $saldo_corriente;

    /**
     * The value for the fecha_de_actualizacion field.
     * @var        string
     */
    protected $fecha_de_actualizacion;

    /**
     * The value for the numero_de_cuenta field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $numero_de_cuenta;

    /**
     * The value for the numero_de_credito field.
     * @var        string
     */
    protected $numero_de_credito;

    /**
     * The value for the contrato field.
     * @var        string
     */
    protected $contrato;

    /**
     * The value for the saldo_total field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $saldo_total;

    /**
     * The value for the saldo_vencido field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $saldo_vencido;

    /**
     * The value for the saldo_descuento_1 field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $saldo_descuento_1;

    /**
     * The value for the saldo_descuento_2 field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $saldo_descuento_2;

    /**
     * The value for the fecha_corte field.
     * @var        string
     */
    protected $fecha_corte;

    /**
     * The value for the fecha_limite field.
     * @var        string
     */
    protected $fecha_limite;

    /**
     * The value for the fecha_de_ultimo_pago field.
     * @var        string
     */
    protected $fecha_de_ultimo_pago;

    /**
     * The value for the monto_ultimo_pago field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $monto_ultimo_pago;

    /**
     * The value for the producto field.
     * @var        string
     */
    protected $producto;

    /**
     * The value for the subproducto field.
     * @var        string
     */
    protected $subproducto;

    /**
     * The value for the cliente field.
     * @var        string
     */
    protected $cliente;

    /**
     * The value for the status_de_credito field.
     * @var        string
     */
    protected $status_de_credito;

    /**
     * The value for the pagos_vencidos field.
     * @var        int
     */
    protected $pagos_vencidos;

    /**
     * The value for the monto_adeudado field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $monto_adeudado;

    /**
     * The value for the fecha_de_asignacion field.
     * @var        string
     */
    protected $fecha_de_asignacion;

    /**
     * The value for the fecha_de_deasignacion field.
     * @var        string
     */
    protected $fecha_de_deasignacion;

    /**
     * The value for the cuenta_concentradora_1 field.
     * @var        string
     */
    protected $cuenta_concentradora_1;

    /**
     * The value for the saldo_cuota field.
     * @var        string
     */
    protected $saldo_cuota;

    /**
     * The value for the email_deudor field.
     * @var        string
     */
    protected $email_deudor;

    /**
     * The value for the id_cuenta field.
     * @var        int
     */
    protected $id_cuenta;

    /**
     * The value for the pago_pactado field.
     * @var        string
     */
    protected $pago_pactado;

    /**
     * The value for the rfc_deudor field.
     * @var        string
     */
    protected $rfc_deudor;

    /**
     * The value for the telefonos_marcados field.
     * @var        string
     */
    protected $telefonos_marcados;

    /**
     * The value for the tel_1_verif field.
     * @var        string
     */
    protected $tel_1_verif;

    /**
     * The value for the tel_2_verif field.
     * @var        string
     */
    protected $tel_2_verif;

    /**
     * The value for the tel_3_verif field.
     * @var        string
     */
    protected $tel_3_verif;

    /**
     * The value for the tel_4_verif field.
     * @var        string
     */
    protected $tel_4_verif;

    /**
     * The value for the telefono_de_ultimo_contacto field.
     * @var        string
     */
    protected $telefono_de_ultimo_contacto;

    /**
     * The value for the dias_vencidos field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $dias_vencidos;

    /**
     * The value for the ejecutivo_asignado_call_center field.
     * Note: this column has a database default value of: 'sinasig'
     * @var        string
     */
    protected $ejecutivo_asignado_call_center;

    /**
     * The value for the ejecutivo_asignado_domiciliario field.
     * @var        string
     */
    protected $ejecutivo_asignado_domiciliario;

    /**
     * The value for the prioridad_de_gestion field.
     * @var        int
     */
    protected $prioridad_de_gestion;

    /**
     * The value for the region_aarsa field.
     * @var        string
     */
    protected $region_aarsa;

    /**
     * The value for the parentesco_aval field.
     * @var        string
     */
    protected $parentesco_aval;

    /**
     * The value for the localizar field.
     * @var        boolean
     */
    protected $localizar;

    /**
     * The value for the fecha_ultima_gestion field.
     * Note: this column has a database default value of: NULL
     * @var        string
     */
    protected $fecha_ultima_gestion;

    /**
     * The value for the empresa field.
     * @var        string
     */
    protected $empresa;

    /**
     * The value for the timelock field.
     * @var        string
     */
    protected $timelock;

    /**
     * The value for the locker field.
     * @var        string
     */
    protected $locker;

    /**
     * The value for the fecha_de_venta field.
     * @var        string
     */
    protected $fecha_de_venta;

    /**
     * The value for the especial field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $especial;

    /**
     * The value for the direccion_nueva field.
     * @var        string
     */
    protected $direccion_nueva;

    /**
     * The value for the norobot field.
     * Note: this column has a database default value of: NULL
     * @var        string
     */
    protected $norobot;

    /**
     * The value for the user field.
     * @var        string
     */
    protected $user;

    /**
     * The value for the timeuser field.
     * @var        string
     */
    protected $timeuser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->status_aarsa = '';
        $this->numero_de_cuenta = '0';
        $this->saldo_total = '0.00';
        $this->saldo_vencido = '0.00';
        $this->saldo_descuento_1 = '0.00';
        $this->saldo_descuento_2 = '0.00';
        $this->monto_ultimo_pago = '0.00';
        $this->monto_adeudado = '0.00';
        $this->dias_vencidos = 0;
        $this->ejecutivo_asignado_call_center = 'sinasig';
        $this->fecha_ultima_gestion = NULL;
        $this->especial = false;
        $this->norobot = NULL;
    }

    /**
     * Initializes internal state of BaseRslice object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [nombre_deudor] column value.
     *
     * @return string
     */
    public function getNombreDeudor()
    {
        return $this->nombre_deudor;
    }

    /**
     * Get the [domicilio_deudor] column value.
     *
     * @return string
     */
    public function getDomicilioDeudor()
    {
        return $this->domicilio_deudor;
    }

    /**
     * Get the [colonia_deudor] column value.
     *
     * @return string
     */
    public function getColoniaDeudor()
    {
        return $this->colonia_deudor;
    }

    /**
     * Get the [ciudad_deudor] column value.
     *
     * @return string
     */
    public function getCiudadDeudor()
    {
        return $this->ciudad_deudor;
    }

    /**
     * Get the [estado_deudor] column value.
     *
     * @return string
     */
    public function getEstadoDeudor()
    {
        return $this->estado_deudor;
    }

    /**
     * Get the [cp_deudor] column value.
     *
     * @return string
     */
    public function getCpDeudor()
    {
        return $this->cp_deudor;
    }

    /**
     * Get the [plano_guia_roji] column value.
     *
     * @return string
     */
    public function getPlanoGuiaRoji()
    {
        return $this->plano_guia_roji;
    }

    /**
     * Get the [cuadrante_guia_roji] column value.
     *
     * @return string
     */
    public function getCuadranteGuiaRoji()
    {
        return $this->cuadrante_guia_roji;
    }

    /**
     * Get the [tel_1] column value.
     *
     * @return string
     */
    public function getTel1()
    {
        return $this->tel_1;
    }

    /**
     * Get the [tel_2] column value.
     *
     * @return string
     */
    public function getTel2()
    {
        return $this->tel_2;
    }

    /**
     * Get the [tel_3] column value.
     *
     * @return string
     */
    public function getTel3()
    {
        return $this->tel_3;
    }

    /**
     * Get the [tel_4] column value.
     *
     * @return string
     */
    public function getTel4()
    {
        return $this->tel_4;
    }

    /**
     * Get the [nombre_deudor_alterno] column value.
     *
     * @return string
     */
    public function getNombreDeudorAlterno()
    {
        return $this->nombre_deudor_alterno;
    }

    /**
     * Get the [domicilio_deudor_alterno] column value.
     *
     * @return string
     */
    public function getDomicilioDeudorAlterno()
    {
        return $this->domicilio_deudor_alterno;
    }

    /**
     * Get the [colonia_deudor_alterno] column value.
     *
     * @return string
     */
    public function getColoniaDeudorAlterno()
    {
        return $this->colonia_deudor_alterno;
    }

    /**
     * Get the [ciudad_deudor_alterno] column value.
     *
     * @return string
     */
    public function getCiudadDeudorAlterno()
    {
        return $this->ciudad_deudor_alterno;
    }

    /**
     * Get the [estado_deudor_alterno] column value.
     *
     * @return string
     */
    public function getEstadoDeudorAlterno()
    {
        return $this->estado_deudor_alterno;
    }

    /**
     * Get the [cp_deudor_aterno] column value.
     *
     * @return string
     */
    public function getCpDeudorAterno()
    {
        return $this->cp_deudor_aterno;
    }

    /**
     * Get the [tel_1_alterno] column value.
     *
     * @return string
     */
    public function getTel1Alterno()
    {
        return $this->tel_1_alterno;
    }

    /**
     * Get the [tel_2_alterno] column value.
     *
     * @return string
     */
    public function getTel2Alterno()
    {
        return $this->tel_2_alterno;
    }

    /**
     * Get the [tel_3_alterno] column value.
     *
     * @return string
     */
    public function getTel3Alterno()
    {
        return $this->tel_3_alterno;
    }

    /**
     * Get the [tel_4_alterno] column value.
     *
     * @return string
     */
    public function getTel4Alterno()
    {
        return $this->tel_4_alterno;
    }

    /**
     * Get the [plano_guia_roji_alterno] column value.
     *
     * @return string
     */
    public function getPlanoGuiaRojiAlterno()
    {
        return $this->plano_guia_roji_alterno;
    }

    /**
     * Get the [cuadrante_guia_roji_alterno] column value.
     *
     * @return string
     */
    public function getCuadranteGuiaRojiAlterno()
    {
        return $this->cuadrante_guia_roji_alterno;
    }

    /**
     * Get the [status_aarsa] column value.
     *
     * @return string
     */
    public function getStatusAarsa()
    {
        return $this->status_aarsa;
    }

    /**
     * Get the [sucursal_cliente] column value.
     *
     * @return string
     */
    public function getSucursalCliente()
    {
        return $this->sucursal_cliente;
    }

    /**
     * Get the [parentesco_ref_1] column value.
     *
     * @return string
     */
    public function getParentescoRef1()
    {
        return $this->parentesco_ref_1;
    }

    /**
     * Get the [nombre_referencia_1] column value.
     *
     * @return string
     */
    public function getNombreReferencia1()
    {
        return $this->nombre_referencia_1;
    }

    /**
     * Get the [domicilio_referencia_1] column value.
     *
     * @return string
     */
    public function getDomicilioReferencia1()
    {
        return $this->domicilio_referencia_1;
    }

    /**
     * Get the [colonia_referencia_1] column value.
     *
     * @return string
     */
    public function getColoniaReferencia1()
    {
        return $this->colonia_referencia_1;
    }

    /**
     * Get the [ciudad_referencia_1] column value.
     *
     * @return string
     */
    public function getCiudadReferencia1()
    {
        return $this->ciudad_referencia_1;
    }

    /**
     * Get the [estado_referencia_1] column value.
     *
     * @return string
     */
    public function getEstadoReferencia1()
    {
        return $this->estado_referencia_1;
    }

    /**
     * Get the [cp_referencia_1] column value.
     *
     * @return string
     */
    public function getCpReferencia1()
    {
        return $this->cp_referencia_1;
    }

    /**
     * Get the [tel_1_ref_1] column value.
     *
     * @return string
     */
    public function getTel1Ref1()
    {
        return $this->tel_1_ref_1;
    }

    /**
     * Get the [tel_2_ref_1] column value.
     *
     * @return string
     */
    public function getTel2Ref1()
    {
        return $this->tel_2_ref_1;
    }

    /**
     * Get the [parentesco_ref_2] column value.
     *
     * @return string
     */
    public function getParentescoRef2()
    {
        return $this->parentesco_ref_2;
    }

    /**
     * Get the [nombre_referencia_2] column value.
     *
     * @return string
     */
    public function getNombreReferencia2()
    {
        return $this->nombre_referencia_2;
    }

    /**
     * Get the [domicilio_referencia_2] column value.
     *
     * @return string
     */
    public function getDomicilioReferencia2()
    {
        return $this->domicilio_referencia_2;
    }

    /**
     * Get the [colonia_referencia_2] column value.
     *
     * @return string
     */
    public function getColoniaReferencia2()
    {
        return $this->colonia_referencia_2;
    }

    /**
     * Get the [ciudad_referencia_2] column value.
     *
     * @return string
     */
    public function getCiudadReferencia2()
    {
        return $this->ciudad_referencia_2;
    }

    /**
     * Get the [estado_referencia_2] column value.
     *
     * @return string
     */
    public function getEstadoReferencia2()
    {
        return $this->estado_referencia_2;
    }

    /**
     * Get the [cp_referencia_2] column value.
     *
     * @return string
     */
    public function getCpReferencia2()
    {
        return $this->cp_referencia_2;
    }

    /**
     * Get the [tel_1_ref_2] column value.
     *
     * @return string
     */
    public function getTel1Ref2()
    {
        return $this->tel_1_ref_2;
    }

    /**
     * Get the [tel_2_ref_2] column value.
     *
     * @return string
     */
    public function getTel2Ref2()
    {
        return $this->tel_2_ref_2;
    }

    /**
     * Get the [parentesco_ref_3] column value.
     *
     * @return string
     */
    public function getParentescoRef3()
    {
        return $this->parentesco_ref_3;
    }

    /**
     * Get the [nombre_referencia_3] column value.
     *
     * @return string
     */
    public function getNombreReferencia3()
    {
        return $this->nombre_referencia_3;
    }

    /**
     * Get the [domicilio_referencia_3] column value.
     *
     * @return string
     */
    public function getDomicilioReferencia3()
    {
        return $this->domicilio_referencia_3;
    }

    /**
     * Get the [colonia_referencia_3] column value.
     *
     * @return string
     */
    public function getColoniaReferencia3()
    {
        return $this->colonia_referencia_3;
    }

    /**
     * Get the [ciudad_referencia_3] column value.
     *
     * @return string
     */
    public function getCiudadReferencia3()
    {
        return $this->ciudad_referencia_3;
    }

    /**
     * Get the [estado_referencia_3] column value.
     *
     * @return string
     */
    public function getEstadoReferencia3()
    {
        return $this->estado_referencia_3;
    }

    /**
     * Get the [cp_referencia_3] column value.
     *
     * @return string
     */
    public function getCpReferencia3()
    {
        return $this->cp_referencia_3;
    }

    /**
     * Get the [tel_1_ref_3] column value.
     *
     * @return string
     */
    public function getTel1Ref3()
    {
        return $this->tel_1_ref_3;
    }

    /**
     * Get the [tel_2_ref_3] column value.
     *
     * @return string
     */
    public function getTel2Ref3()
    {
        return $this->tel_2_ref_3;
    }

    /**
     * Get the [parentesco_ref_4] column value.
     *
     * @return string
     */
    public function getParentescoRef4()
    {
        return $this->parentesco_ref_4;
    }

    /**
     * Get the [nombre_referencia_4] column value.
     *
     * @return string
     */
    public function getNombreReferencia4()
    {
        return $this->nombre_referencia_4;
    }

    /**
     * Get the [domicilio_referencia_4] column value.
     *
     * @return string
     */
    public function getDomicilioReferencia4()
    {
        return $this->domicilio_referencia_4;
    }

    /**
     * Get the [colonia_referencia_4] column value.
     *
     * @return string
     */
    public function getColoniaReferencia4()
    {
        return $this->colonia_referencia_4;
    }

    /**
     * Get the [ciudad_referencia_4] column value.
     *
     * @return string
     */
    public function getCiudadReferencia4()
    {
        return $this->ciudad_referencia_4;
    }

    /**
     * Get the [estado_referencia_4] column value.
     *
     * @return string
     */
    public function getEstadoReferencia4()
    {
        return $this->estado_referencia_4;
    }

    /**
     * Get the [cp_referencia_4] column value.
     *
     * @return string
     */
    public function getCpReferencia4()
    {
        return $this->cp_referencia_4;
    }

    /**
     * Get the [tel_1_ref_4] column value.
     *
     * @return string
     */
    public function getTel1Ref4()
    {
        return $this->tel_1_ref_4;
    }

    /**
     * Get the [tel_2_ref_4] column value.
     *
     * @return string
     */
    public function getTel2Ref4()
    {
        return $this->tel_2_ref_4;
    }

    /**
     * Get the [domicilio_laboral] column value.
     *
     * @return string
     */
    public function getDomicilioLaboral()
    {
        return $this->domicilio_laboral;
    }

    /**
     * Get the [colonia_laboral] column value.
     *
     * @return string
     */
    public function getColoniaLaboral()
    {
        return $this->colonia_laboral;
    }

    /**
     * Get the [ciudad_laboral] column value.
     *
     * @return string
     */
    public function getCiudadLaboral()
    {
        return $this->ciudad_laboral;
    }

    /**
     * Get the [estado_laboral] column value.
     *
     * @return string
     */
    public function getEstadoLaboral()
    {
        return $this->estado_laboral;
    }

    /**
     * Get the [cp_laboral] column value.
     *
     * @return string
     */
    public function getCpLaboral()
    {
        return $this->cp_laboral;
    }

    /**
     * Get the [tel_1_laboral] column value.
     *
     * @return string
     */
    public function getTel1Laboral()
    {
        return $this->tel_1_laboral;
    }

    /**
     * Get the [tel_2_laboral] column value.
     *
     * @return string
     */
    public function getTel2Laboral()
    {
        return $this->tel_2_laboral;
    }

    /**
     * Get the [saldo_corriente] column value.
     *
     * @return string
     */
    public function getSaldoCorriente()
    {
        return $this->saldo_corriente;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_de_actualizacion] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaDeActualizacion($format = '%F')
    {
        if ($this->fecha_de_actualizacion === null) {
            return null;
        }

        if ($this->fecha_de_actualizacion === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_de_actualizacion);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_de_actualizacion, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [numero_de_cuenta] column value.
     *
     * @return string
     */
    public function getNumeroDeCuenta()
    {
        return $this->numero_de_cuenta;
    }

    /**
     * Get the [numero_de_credito] column value.
     *
     * @return string
     */
    public function getNumeroDeCredito()
    {
        return $this->numero_de_credito;
    }

    /**
     * Get the [contrato] column value.
     *
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * Get the [saldo_total] column value.
     *
     * @return string
     */
    public function getSaldoTotal()
    {
        return $this->saldo_total;
    }

    /**
     * Get the [saldo_vencido] column value.
     *
     * @return string
     */
    public function getSaldoVencido()
    {
        return $this->saldo_vencido;
    }

    /**
     * Get the [saldo_descuento_1] column value.
     *
     * @return string
     */
    public function getSaldoDescuento1()
    {
        return $this->saldo_descuento_1;
    }

    /**
     * Get the [saldo_descuento_2] column value.
     *
     * @return string
     */
    public function getSaldoDescuento2()
    {
        return $this->saldo_descuento_2;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_corte] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaCorte($format = '%F')
    {
        if ($this->fecha_corte === null) {
            return null;
        }

        if ($this->fecha_corte === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_corte);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_corte, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [fecha_limite] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaLimite($format = '%F')
    {
        if ($this->fecha_limite === null) {
            return null;
        }

        if ($this->fecha_limite === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_limite);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_limite, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [fecha_de_ultimo_pago] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaDeUltimoPago($format = '%F')
    {
        if ($this->fecha_de_ultimo_pago === null) {
            return null;
        }

        if ($this->fecha_de_ultimo_pago === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_de_ultimo_pago);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_de_ultimo_pago, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [monto_ultimo_pago] column value.
     *
     * @return string
     */
    public function getMontoUltimoPago()
    {
        return $this->monto_ultimo_pago;
    }

    /**
     * Get the [producto] column value.
     *
     * @return string
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Get the [subproducto] column value.
     *
     * @return string
     */
    public function getSubproducto()
    {
        return $this->subproducto;
    }

    /**
     * Get the [cliente] column value.
     *
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Get the [status_de_credito] column value.
     *
     * @return string
     */
    public function getStatusDeCredito()
    {
        return $this->status_de_credito;
    }

    /**
     * Get the [pagos_vencidos] column value.
     *
     * @return int
     */
    public function getPagosVencidos()
    {
        return $this->pagos_vencidos;
    }

    /**
     * Get the [monto_adeudado] column value.
     *
     * @return string
     */
    public function getMontoAdeudado()
    {
        return $this->monto_adeudado;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_de_asignacion] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaDeAsignacion($format = '%F')
    {
        if ($this->fecha_de_asignacion === null) {
            return null;
        }

        if ($this->fecha_de_asignacion === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_de_asignacion);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_de_asignacion, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [fecha_de_deasignacion] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaDeDeasignacion($format = '%F')
    {
        if ($this->fecha_de_deasignacion === null) {
            return null;
        }

        if ($this->fecha_de_deasignacion === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_de_deasignacion);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_de_deasignacion, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [cuenta_concentradora_1] column value.
     *
     * @return string
     */
    public function getCuentaConcentradora1()
    {
        return $this->cuenta_concentradora_1;
    }

    /**
     * Get the [saldo_cuota] column value.
     *
     * @return string
     */
    public function getSaldoCuota()
    {
        return $this->saldo_cuota;
    }

    /**
     * Get the [email_deudor] column value.
     *
     * @return string
     */
    public function getEmailDeudor()
    {
        return $this->email_deudor;
    }

    /**
     * Get the [id_cuenta] column value.
     *
     * @return int
     */
    public function getIdCuenta()
    {
        return $this->id_cuenta;
    }

    /**
     * Get the [pago_pactado] column value.
     *
     * @return string
     */
    public function getPagoPactado()
    {
        return $this->pago_pactado;
    }

    /**
     * Get the [rfc_deudor] column value.
     *
     * @return string
     */
    public function getRfcDeudor()
    {
        return $this->rfc_deudor;
    }

    /**
     * Get the [telefonos_marcados] column value.
     *
     * @return string
     */
    public function getTelefonosMarcados()
    {
        return $this->telefonos_marcados;
    }

    /**
     * Get the [tel_1_verif] column value.
     *
     * @return string
     */
    public function getTel1Verif()
    {
        return $this->tel_1_verif;
    }

    /**
     * Get the [tel_2_verif] column value.
     *
     * @return string
     */
    public function getTel2Verif()
    {
        return $this->tel_2_verif;
    }

    /**
     * Get the [tel_3_verif] column value.
     *
     * @return string
     */
    public function getTel3Verif()
    {
        return $this->tel_3_verif;
    }

    /**
     * Get the [tel_4_verif] column value.
     *
     * @return string
     */
    public function getTel4Verif()
    {
        return $this->tel_4_verif;
    }

    /**
     * Get the [telefono_de_ultimo_contacto] column value.
     *
     * @return string
     */
    public function getTelefonoDeUltimoContacto()
    {
        return $this->telefono_de_ultimo_contacto;
    }

    /**
     * Get the [dias_vencidos] column value.
     *
     * @return int
     */
    public function getDiasVencidos()
    {
        return $this->dias_vencidos;
    }

    /**
     * Get the [ejecutivo_asignado_call_center] column value.
     *
     * @return string
     */
    public function getEjecutivoAsignadoCallCenter()
    {
        return $this->ejecutivo_asignado_call_center;
    }

    /**
     * Get the [ejecutivo_asignado_domiciliario] column value.
     *
     * @return string
     */
    public function getEjecutivoAsignadoDomiciliario()
    {
        return $this->ejecutivo_asignado_domiciliario;
    }

    /**
     * Get the [prioridad_de_gestion] column value.
     *
     * @return int
     */
    public function getPrioridadDeGestion()
    {
        return $this->prioridad_de_gestion;
    }

    /**
     * Get the [region_aarsa] column value.
     *
     * @return string
     */
    public function getRegionAarsa()
    {
        return $this->region_aarsa;
    }

    /**
     * Get the [parentesco_aval] column value.
     *
     * @return string
     */
    public function getParentescoAval()
    {
        return $this->parentesco_aval;
    }

    /**
     * Get the [localizar] column value.
     *
     * @return boolean
     */
    public function getLocalizar()
    {
        return $this->localizar;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_ultima_gestion] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaUltimaGestion($format = 'Y-m-d H:i:s')
    {
        if ($this->fecha_ultima_gestion === null) {
            return null;
        }

        if ($this->fecha_ultima_gestion === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_ultima_gestion);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_ultima_gestion, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [empresa] column value.
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Get the [optionally formatted] temporal [timelock] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTimelock($format = 'Y-m-d H:i:s')
    {
        if ($this->timelock === null) {
            return null;
        }

        if ($this->timelock === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->timelock);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->timelock, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [locker] column value.
     *
     * @return string
     */
    public function getLocker()
    {
        return $this->locker;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_de_venta] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaDeVenta($format = '%F')
    {
        if ($this->fecha_de_venta === null) {
            return null;
        }

        if ($this->fecha_de_venta === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_de_venta);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_de_venta, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [especial] column value.
     *
     * @return boolean
     */
    public function getEspecial()
    {
        return $this->especial;
    }

    /**
     * Get the [direccion_nueva] column value.
     *
     * @return string
     */
    public function getDireccionNueva()
    {
        return $this->direccion_nueva;
    }

    /**
     * Get the [optionally formatted] temporal [norobot] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getNorobot($format = 'Y-m-d H:i:s')
    {
        if ($this->norobot === null) {
            return null;
        }

        if ($this->norobot === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->norobot);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->norobot, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [user] column value.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the [optionally formatted] temporal [timeuser] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTimeuser($format = 'Y-m-d H:i:s')
    {
        if ($this->timeuser === null) {
            return null;
        }

        if ($this->timeuser === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->timeuser);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->timeuser, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [nombre_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNombreDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_deudor !== $v) {
            $this->nombre_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::NOMBRE_DEUDOR;
        }


        return $this;
    } // setNombreDeudor()

    /**
     * Set the value of [domicilio_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_deudor !== $v) {
            $this->domicilio_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_DEUDOR;
        }


        return $this;
    } // setDomicilioDeudor()

    /**
     * Set the value of [colonia_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_deudor !== $v) {
            $this->colonia_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_DEUDOR;
        }


        return $this;
    } // setColoniaDeudor()

    /**
     * Set the value of [ciudad_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_deudor !== $v) {
            $this->ciudad_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_DEUDOR;
        }


        return $this;
    } // setCiudadDeudor()

    /**
     * Set the value of [estado_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_deudor !== $v) {
            $this->estado_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_DEUDOR;
        }


        return $this;
    } // setEstadoDeudor()

    /**
     * Set the value of [cp_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_deudor !== $v) {
            $this->cp_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::CP_DEUDOR;
        }


        return $this;
    } // setCpDeudor()

    /**
     * Set the value of [plano_guia_roji] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setPlanoGuiaRoji($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->plano_guia_roji !== $v) {
            $this->plano_guia_roji = $v;
            $this->modifiedColumns[] = RslicePeer::PLANO_GUIA_ROJI;
        }


        return $this;
    } // setPlanoGuiaRoji()

    /**
     * Set the value of [cuadrante_guia_roji] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCuadranteGuiaRoji($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuadrante_guia_roji !== $v) {
            $this->cuadrante_guia_roji = $v;
            $this->modifiedColumns[] = RslicePeer::CUADRANTE_GUIA_ROJI;
        }


        return $this;
    } // setCuadranteGuiaRoji()

    /**
     * Set the value of [tel_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1 !== $v) {
            $this->tel_1 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1;
        }


        return $this;
    } // setTel1()

    /**
     * Set the value of [tel_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2 !== $v) {
            $this->tel_2 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2;
        }


        return $this;
    } // setTel2()

    /**
     * Set the value of [tel_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_3 !== $v) {
            $this->tel_3 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_3;
        }


        return $this;
    } // setTel3()

    /**
     * Set the value of [tel_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_4 !== $v) {
            $this->tel_4 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_4;
        }


        return $this;
    } // setTel4()

    /**
     * Set the value of [nombre_deudor_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNombreDeudorAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_deudor_alterno !== $v) {
            $this->nombre_deudor_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::NOMBRE_DEUDOR_ALTERNO;
        }


        return $this;
    } // setNombreDeudorAlterno()

    /**
     * Set the value of [domicilio_deudor_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioDeudorAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_deudor_alterno !== $v) {
            $this->domicilio_deudor_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_DEUDOR_ALTERNO;
        }


        return $this;
    } // setDomicilioDeudorAlterno()

    /**
     * Set the value of [colonia_deudor_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaDeudorAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_deudor_alterno !== $v) {
            $this->colonia_deudor_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_DEUDOR_ALTERNO;
        }


        return $this;
    } // setColoniaDeudorAlterno()

    /**
     * Set the value of [ciudad_deudor_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadDeudorAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_deudor_alterno !== $v) {
            $this->ciudad_deudor_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_DEUDOR_ALTERNO;
        }


        return $this;
    } // setCiudadDeudorAlterno()

    /**
     * Set the value of [estado_deudor_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoDeudorAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_deudor_alterno !== $v) {
            $this->estado_deudor_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_DEUDOR_ALTERNO;
        }


        return $this;
    } // setEstadoDeudorAlterno()

    /**
     * Set the value of [cp_deudor_aterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpDeudorAterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_deudor_aterno !== $v) {
            $this->cp_deudor_aterno = $v;
            $this->modifiedColumns[] = RslicePeer::CP_DEUDOR_ATERNO;
        }


        return $this;
    } // setCpDeudorAterno()

    /**
     * Set the value of [tel_1_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_alterno !== $v) {
            $this->tel_1_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_ALTERNO;
        }


        return $this;
    } // setTel1Alterno()

    /**
     * Set the value of [tel_2_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_alterno !== $v) {
            $this->tel_2_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_ALTERNO;
        }


        return $this;
    } // setTel2Alterno()

    /**
     * Set the value of [tel_3_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel3Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_3_alterno !== $v) {
            $this->tel_3_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_3_ALTERNO;
        }


        return $this;
    } // setTel3Alterno()

    /**
     * Set the value of [tel_4_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel4Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_4_alterno !== $v) {
            $this->tel_4_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_4_ALTERNO;
        }


        return $this;
    } // setTel4Alterno()

    /**
     * Set the value of [plano_guia_roji_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setPlanoGuiaRojiAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->plano_guia_roji_alterno !== $v) {
            $this->plano_guia_roji_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::PLANO_GUIA_ROJI_ALTERNO;
        }


        return $this;
    } // setPlanoGuiaRojiAlterno()

    /**
     * Set the value of [cuadrante_guia_roji_alterno] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCuadranteGuiaRojiAlterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuadrante_guia_roji_alterno !== $v) {
            $this->cuadrante_guia_roji_alterno = $v;
            $this->modifiedColumns[] = RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO;
        }


        return $this;
    } // setCuadranteGuiaRojiAlterno()

    /**
     * Set the value of [status_aarsa] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setStatusAarsa($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->status_aarsa !== $v) {
            $this->status_aarsa = $v;
            $this->modifiedColumns[] = RslicePeer::STATUS_AARSA;
        }


        return $this;
    } // setStatusAarsa()

    /**
     * Set the value of [sucursal_cliente] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSucursalCliente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sucursal_cliente !== $v) {
            $this->sucursal_cliente = $v;
            $this->modifiedColumns[] = RslicePeer::SUCURSAL_CLIENTE;
        }


        return $this;
    } // setSucursalCliente()

    /**
     * Set the value of [parentesco_ref_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setParentescoRef1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->parentesco_ref_1 !== $v) {
            $this->parentesco_ref_1 = $v;
            $this->modifiedColumns[] = RslicePeer::PARENTESCO_REF_1;
        }


        return $this;
    } // setParentescoRef1()

    /**
     * Set the value of [nombre_referencia_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNombreReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_1 !== $v) {
            $this->nombre_referencia_1 = $v;
            $this->modifiedColumns[] = RslicePeer::NOMBRE_REFERENCIA_1;
        }


        return $this;
    } // setNombreReferencia1()

    /**
     * Set the value of [domicilio_referencia_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_referencia_1 !== $v) {
            $this->domicilio_referencia_1 = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_REFERENCIA_1;
        }


        return $this;
    } // setDomicilioReferencia1()

    /**
     * Set the value of [colonia_referencia_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_referencia_1 !== $v) {
            $this->colonia_referencia_1 = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_REFERENCIA_1;
        }


        return $this;
    } // setColoniaReferencia1()

    /**
     * Set the value of [ciudad_referencia_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_referencia_1 !== $v) {
            $this->ciudad_referencia_1 = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_REFERENCIA_1;
        }


        return $this;
    } // setCiudadReferencia1()

    /**
     * Set the value of [estado_referencia_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_referencia_1 !== $v) {
            $this->estado_referencia_1 = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_REFERENCIA_1;
        }


        return $this;
    } // setEstadoReferencia1()

    /**
     * Set the value of [cp_referencia_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_referencia_1 !== $v) {
            $this->cp_referencia_1 = $v;
            $this->modifiedColumns[] = RslicePeer::CP_REFERENCIA_1;
        }


        return $this;
    } // setCpReferencia1()

    /**
     * Set the value of [tel_1_ref_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Ref1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_1 !== $v) {
            $this->tel_1_ref_1 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_REF_1;
        }


        return $this;
    } // setTel1Ref1()

    /**
     * Set the value of [tel_2_ref_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Ref1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_1 !== $v) {
            $this->tel_2_ref_1 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_REF_1;
        }


        return $this;
    } // setTel2Ref1()

    /**
     * Set the value of [parentesco_ref_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setParentescoRef2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->parentesco_ref_2 !== $v) {
            $this->parentesco_ref_2 = $v;
            $this->modifiedColumns[] = RslicePeer::PARENTESCO_REF_2;
        }


        return $this;
    } // setParentescoRef2()

    /**
     * Set the value of [nombre_referencia_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNombreReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_2 !== $v) {
            $this->nombre_referencia_2 = $v;
            $this->modifiedColumns[] = RslicePeer::NOMBRE_REFERENCIA_2;
        }


        return $this;
    } // setNombreReferencia2()

    /**
     * Set the value of [domicilio_referencia_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_referencia_2 !== $v) {
            $this->domicilio_referencia_2 = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_REFERENCIA_2;
        }


        return $this;
    } // setDomicilioReferencia2()

    /**
     * Set the value of [colonia_referencia_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_referencia_2 !== $v) {
            $this->colonia_referencia_2 = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_REFERENCIA_2;
        }


        return $this;
    } // setColoniaReferencia2()

    /**
     * Set the value of [ciudad_referencia_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_referencia_2 !== $v) {
            $this->ciudad_referencia_2 = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_REFERENCIA_2;
        }


        return $this;
    } // setCiudadReferencia2()

    /**
     * Set the value of [estado_referencia_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_referencia_2 !== $v) {
            $this->estado_referencia_2 = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_REFERENCIA_2;
        }


        return $this;
    } // setEstadoReferencia2()

    /**
     * Set the value of [cp_referencia_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_referencia_2 !== $v) {
            $this->cp_referencia_2 = $v;
            $this->modifiedColumns[] = RslicePeer::CP_REFERENCIA_2;
        }


        return $this;
    } // setCpReferencia2()

    /**
     * Set the value of [tel_1_ref_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Ref2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_2 !== $v) {
            $this->tel_1_ref_2 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_REF_2;
        }


        return $this;
    } // setTel1Ref2()

    /**
     * Set the value of [tel_2_ref_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Ref2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_2 !== $v) {
            $this->tel_2_ref_2 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_REF_2;
        }


        return $this;
    } // setTel2Ref2()

    /**
     * Set the value of [parentesco_ref_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setParentescoRef3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->parentesco_ref_3 !== $v) {
            $this->parentesco_ref_3 = $v;
            $this->modifiedColumns[] = RslicePeer::PARENTESCO_REF_3;
        }


        return $this;
    } // setParentescoRef3()

    /**
     * Set the value of [nombre_referencia_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNombreReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_3 !== $v) {
            $this->nombre_referencia_3 = $v;
            $this->modifiedColumns[] = RslicePeer::NOMBRE_REFERENCIA_3;
        }


        return $this;
    } // setNombreReferencia3()

    /**
     * Set the value of [domicilio_referencia_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_referencia_3 !== $v) {
            $this->domicilio_referencia_3 = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_REFERENCIA_3;
        }


        return $this;
    } // setDomicilioReferencia3()

    /**
     * Set the value of [colonia_referencia_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_referencia_3 !== $v) {
            $this->colonia_referencia_3 = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_REFERENCIA_3;
        }


        return $this;
    } // setColoniaReferencia3()

    /**
     * Set the value of [ciudad_referencia_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_referencia_3 !== $v) {
            $this->ciudad_referencia_3 = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_REFERENCIA_3;
        }


        return $this;
    } // setCiudadReferencia3()

    /**
     * Set the value of [estado_referencia_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_referencia_3 !== $v) {
            $this->estado_referencia_3 = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_REFERENCIA_3;
        }


        return $this;
    } // setEstadoReferencia3()

    /**
     * Set the value of [cp_referencia_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_referencia_3 !== $v) {
            $this->cp_referencia_3 = $v;
            $this->modifiedColumns[] = RslicePeer::CP_REFERENCIA_3;
        }


        return $this;
    } // setCpReferencia3()

    /**
     * Set the value of [tel_1_ref_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Ref3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_3 !== $v) {
            $this->tel_1_ref_3 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_REF_3;
        }


        return $this;
    } // setTel1Ref3()

    /**
     * Set the value of [tel_2_ref_3] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Ref3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_3 !== $v) {
            $this->tel_2_ref_3 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_REF_3;
        }


        return $this;
    } // setTel2Ref3()

    /**
     * Set the value of [parentesco_ref_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setParentescoRef4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->parentesco_ref_4 !== $v) {
            $this->parentesco_ref_4 = $v;
            $this->modifiedColumns[] = RslicePeer::PARENTESCO_REF_4;
        }


        return $this;
    } // setParentescoRef4()

    /**
     * Set the value of [nombre_referencia_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNombreReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_4 !== $v) {
            $this->nombre_referencia_4 = $v;
            $this->modifiedColumns[] = RslicePeer::NOMBRE_REFERENCIA_4;
        }


        return $this;
    } // setNombreReferencia4()

    /**
     * Set the value of [domicilio_referencia_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_referencia_4 !== $v) {
            $this->domicilio_referencia_4 = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_REFERENCIA_4;
        }


        return $this;
    } // setDomicilioReferencia4()

    /**
     * Set the value of [colonia_referencia_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_referencia_4 !== $v) {
            $this->colonia_referencia_4 = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_REFERENCIA_4;
        }


        return $this;
    } // setColoniaReferencia4()

    /**
     * Set the value of [ciudad_referencia_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_referencia_4 !== $v) {
            $this->ciudad_referencia_4 = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_REFERENCIA_4;
        }


        return $this;
    } // setCiudadReferencia4()

    /**
     * Set the value of [estado_referencia_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_referencia_4 !== $v) {
            $this->estado_referencia_4 = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_REFERENCIA_4;
        }


        return $this;
    } // setEstadoReferencia4()

    /**
     * Set the value of [cp_referencia_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_referencia_4 !== $v) {
            $this->cp_referencia_4 = $v;
            $this->modifiedColumns[] = RslicePeer::CP_REFERENCIA_4;
        }


        return $this;
    } // setCpReferencia4()

    /**
     * Set the value of [tel_1_ref_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Ref4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_4 !== $v) {
            $this->tel_1_ref_4 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_REF_4;
        }


        return $this;
    } // setTel1Ref4()

    /**
     * Set the value of [tel_2_ref_4] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Ref4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_4 !== $v) {
            $this->tel_2_ref_4 = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_REF_4;
        }


        return $this;
    } // setTel2Ref4()

    /**
     * Set the value of [domicilio_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDomicilioLaboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->domicilio_laboral !== $v) {
            $this->domicilio_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::DOMICILIO_LABORAL;
        }


        return $this;
    } // setDomicilioLaboral()

    /**
     * Set the value of [colonia_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setColoniaLaboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->colonia_laboral !== $v) {
            $this->colonia_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::COLONIA_LABORAL;
        }


        return $this;
    } // setColoniaLaboral()

    /**
     * Set the value of [ciudad_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCiudadLaboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_laboral !== $v) {
            $this->ciudad_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::CIUDAD_LABORAL;
        }


        return $this;
    } // setCiudadLaboral()

    /**
     * Set the value of [estado_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEstadoLaboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_laboral !== $v) {
            $this->estado_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::ESTADO_LABORAL;
        }


        return $this;
    } // setEstadoLaboral()

    /**
     * Set the value of [cp_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCpLaboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cp_laboral !== $v) {
            $this->cp_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::CP_LABORAL;
        }


        return $this;
    } // setCpLaboral()

    /**
     * Set the value of [tel_1_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Laboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_laboral !== $v) {
            $this->tel_1_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_LABORAL;
        }


        return $this;
    } // setTel1Laboral()

    /**
     * Set the value of [tel_2_laboral] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Laboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_laboral !== $v) {
            $this->tel_2_laboral = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_LABORAL;
        }


        return $this;
    } // setTel2Laboral()

    /**
     * Set the value of [saldo_corriente] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSaldoCorriente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_corriente !== $v) {
            $this->saldo_corriente = $v;
            $this->modifiedColumns[] = RslicePeer::SALDO_CORRIENTE;
        }


        return $this;
    } // setSaldoCorriente()

    /**
     * Sets the value of [fecha_de_actualizacion] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaDeActualizacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_de_actualizacion !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_de_actualizacion !== null && $tmpDt = new DateTime($this->fecha_de_actualizacion)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_de_actualizacion = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_DE_ACTUALIZACION;
            }
        } // if either are not null


        return $this;
    } // setFechaDeActualizacion()

    /**
     * Set the value of [numero_de_cuenta] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNumeroDeCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->numero_de_cuenta !== $v) {
            $this->numero_de_cuenta = $v;
            $this->modifiedColumns[] = RslicePeer::NUMERO_DE_CUENTA;
        }


        return $this;
    } // setNumeroDeCuenta()

    /**
     * Set the value of [numero_de_credito] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setNumeroDeCredito($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->numero_de_credito !== $v) {
            $this->numero_de_credito = $v;
            $this->modifiedColumns[] = RslicePeer::NUMERO_DE_CREDITO;
        }


        return $this;
    } // setNumeroDeCredito()

    /**
     * Set the value of [contrato] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setContrato($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->contrato !== $v) {
            $this->contrato = $v;
            $this->modifiedColumns[] = RslicePeer::CONTRATO;
        }


        return $this;
    } // setContrato()

    /**
     * Set the value of [saldo_total] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSaldoTotal($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_total !== $v) {
            $this->saldo_total = $v;
            $this->modifiedColumns[] = RslicePeer::SALDO_TOTAL;
        }


        return $this;
    } // setSaldoTotal()

    /**
     * Set the value of [saldo_vencido] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSaldoVencido($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_vencido !== $v) {
            $this->saldo_vencido = $v;
            $this->modifiedColumns[] = RslicePeer::SALDO_VENCIDO;
        }


        return $this;
    } // setSaldoVencido()

    /**
     * Set the value of [saldo_descuento_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSaldoDescuento1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_descuento_1 !== $v) {
            $this->saldo_descuento_1 = $v;
            $this->modifiedColumns[] = RslicePeer::SALDO_DESCUENTO_1;
        }


        return $this;
    } // setSaldoDescuento1()

    /**
     * Set the value of [saldo_descuento_2] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSaldoDescuento2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_descuento_2 !== $v) {
            $this->saldo_descuento_2 = $v;
            $this->modifiedColumns[] = RslicePeer::SALDO_DESCUENTO_2;
        }


        return $this;
    } // setSaldoDescuento2()

    /**
     * Sets the value of [fecha_corte] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaCorte($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_corte !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_corte !== null && $tmpDt = new DateTime($this->fecha_corte)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_corte = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_CORTE;
            }
        } // if either are not null


        return $this;
    } // setFechaCorte()

    /**
     * Sets the value of [fecha_limite] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaLimite($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_limite !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_limite !== null && $tmpDt = new DateTime($this->fecha_limite)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_limite = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_LIMITE;
            }
        } // if either are not null


        return $this;
    } // setFechaLimite()

    /**
     * Sets the value of [fecha_de_ultimo_pago] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaDeUltimoPago($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_de_ultimo_pago !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_de_ultimo_pago !== null && $tmpDt = new DateTime($this->fecha_de_ultimo_pago)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_de_ultimo_pago = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_DE_ULTIMO_PAGO;
            }
        } // if either are not null


        return $this;
    } // setFechaDeUltimoPago()

    /**
     * Set the value of [monto_ultimo_pago] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setMontoUltimoPago($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->monto_ultimo_pago !== $v) {
            $this->monto_ultimo_pago = $v;
            $this->modifiedColumns[] = RslicePeer::MONTO_ULTIMO_PAGO;
        }


        return $this;
    } // setMontoUltimoPago()

    /**
     * Set the value of [producto] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setProducto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->producto !== $v) {
            $this->producto = $v;
            $this->modifiedColumns[] = RslicePeer::PRODUCTO;
        }


        return $this;
    } // setProducto()

    /**
     * Set the value of [subproducto] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSubproducto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->subproducto !== $v) {
            $this->subproducto = $v;
            $this->modifiedColumns[] = RslicePeer::SUBPRODUCTO;
        }


        return $this;
    } // setSubproducto()

    /**
     * Set the value of [cliente] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCliente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cliente !== $v) {
            $this->cliente = $v;
            $this->modifiedColumns[] = RslicePeer::CLIENTE;
        }


        return $this;
    } // setCliente()

    /**
     * Set the value of [status_de_credito] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setStatusDeCredito($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->status_de_credito !== $v) {
            $this->status_de_credito = $v;
            $this->modifiedColumns[] = RslicePeer::STATUS_DE_CREDITO;
        }


        return $this;
    } // setStatusDeCredito()

    /**
     * Set the value of [pagos_vencidos] column.
     *
     * @param int $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setPagosVencidos($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pagos_vencidos !== $v) {
            $this->pagos_vencidos = $v;
            $this->modifiedColumns[] = RslicePeer::PAGOS_VENCIDOS;
        }


        return $this;
    } // setPagosVencidos()

    /**
     * Set the value of [monto_adeudado] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setMontoAdeudado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->monto_adeudado !== $v) {
            $this->monto_adeudado = $v;
            $this->modifiedColumns[] = RslicePeer::MONTO_ADEUDADO;
        }


        return $this;
    } // setMontoAdeudado()

    /**
     * Sets the value of [fecha_de_asignacion] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaDeAsignacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_de_asignacion !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_de_asignacion !== null && $tmpDt = new DateTime($this->fecha_de_asignacion)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_de_asignacion = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_DE_ASIGNACION;
            }
        } // if either are not null


        return $this;
    } // setFechaDeAsignacion()

    /**
     * Sets the value of [fecha_de_deasignacion] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaDeDeasignacion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_de_deasignacion !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_de_deasignacion !== null && $tmpDt = new DateTime($this->fecha_de_deasignacion)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_de_deasignacion = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_DE_DEASIGNACION;
            }
        } // if either are not null


        return $this;
    } // setFechaDeDeasignacion()

    /**
     * Set the value of [cuenta_concentradora_1] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setCuentaConcentradora1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuenta_concentradora_1 !== $v) {
            $this->cuenta_concentradora_1 = $v;
            $this->modifiedColumns[] = RslicePeer::CUENTA_CONCENTRADORA_1;
        }


        return $this;
    } // setCuentaConcentradora1()

    /**
     * Set the value of [saldo_cuota] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setSaldoCuota($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_cuota !== $v) {
            $this->saldo_cuota = $v;
            $this->modifiedColumns[] = RslicePeer::SALDO_CUOTA;
        }


        return $this;
    } // setSaldoCuota()

    /**
     * Set the value of [email_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEmailDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->email_deudor !== $v) {
            $this->email_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::EMAIL_DEUDOR;
        }


        return $this;
    } // setEmailDeudor()

    /**
     * Set the value of [id_cuenta] column.
     *
     * @param int $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setIdCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_cuenta !== $v) {
            $this->id_cuenta = $v;
            $this->modifiedColumns[] = RslicePeer::ID_CUENTA;
        }


        return $this;
    } // setIdCuenta()

    /**
     * Set the value of [pago_pactado] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setPagoPactado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->pago_pactado !== $v) {
            $this->pago_pactado = $v;
            $this->modifiedColumns[] = RslicePeer::PAGO_PACTADO;
        }


        return $this;
    } // setPagoPactado()

    /**
     * Set the value of [rfc_deudor] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setRfcDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->rfc_deudor !== $v) {
            $this->rfc_deudor = $v;
            $this->modifiedColumns[] = RslicePeer::RFC_DEUDOR;
        }


        return $this;
    } // setRfcDeudor()

    /**
     * Set the value of [telefonos_marcados] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTelefonosMarcados($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->telefonos_marcados !== $v) {
            $this->telefonos_marcados = $v;
            $this->modifiedColumns[] = RslicePeer::TELEFONOS_MARCADOS;
        }


        return $this;
    } // setTelefonosMarcados()

    /**
     * Set the value of [tel_1_verif] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel1Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_verif !== $v) {
            $this->tel_1_verif = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_1_VERIF;
        }


        return $this;
    } // setTel1Verif()

    /**
     * Set the value of [tel_2_verif] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel2Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_verif !== $v) {
            $this->tel_2_verif = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_2_VERIF;
        }


        return $this;
    } // setTel2Verif()

    /**
     * Set the value of [tel_3_verif] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel3Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_3_verif !== $v) {
            $this->tel_3_verif = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_3_VERIF;
        }


        return $this;
    } // setTel3Verif()

    /**
     * Set the value of [tel_4_verif] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTel4Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_4_verif !== $v) {
            $this->tel_4_verif = $v;
            $this->modifiedColumns[] = RslicePeer::TEL_4_VERIF;
        }


        return $this;
    } // setTel4Verif()

    /**
     * Set the value of [telefono_de_ultimo_contacto] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setTelefonoDeUltimoContacto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->telefono_de_ultimo_contacto !== $v) {
            $this->telefono_de_ultimo_contacto = $v;
            $this->modifiedColumns[] = RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO;
        }


        return $this;
    } // setTelefonoDeUltimoContacto()

    /**
     * Set the value of [dias_vencidos] column.
     *
     * @param int $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDiasVencidos($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dias_vencidos !== $v) {
            $this->dias_vencidos = $v;
            $this->modifiedColumns[] = RslicePeer::DIAS_VENCIDOS;
        }


        return $this;
    } // setDiasVencidos()

    /**
     * Set the value of [ejecutivo_asignado_call_center] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEjecutivoAsignadoCallCenter($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ejecutivo_asignado_call_center !== $v) {
            $this->ejecutivo_asignado_call_center = $v;
            $this->modifiedColumns[] = RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER;
        }


        return $this;
    } // setEjecutivoAsignadoCallCenter()

    /**
     * Set the value of [ejecutivo_asignado_domiciliario] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEjecutivoAsignadoDomiciliario($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ejecutivo_asignado_domiciliario !== $v) {
            $this->ejecutivo_asignado_domiciliario = $v;
            $this->modifiedColumns[] = RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO;
        }


        return $this;
    } // setEjecutivoAsignadoDomiciliario()

    /**
     * Set the value of [prioridad_de_gestion] column.
     *
     * @param int $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setPrioridadDeGestion($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->prioridad_de_gestion !== $v) {
            $this->prioridad_de_gestion = $v;
            $this->modifiedColumns[] = RslicePeer::PRIORIDAD_DE_GESTION;
        }


        return $this;
    } // setPrioridadDeGestion()

    /**
     * Set the value of [region_aarsa] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setRegionAarsa($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->region_aarsa !== $v) {
            $this->region_aarsa = $v;
            $this->modifiedColumns[] = RslicePeer::REGION_AARSA;
        }


        return $this;
    } // setRegionAarsa()

    /**
     * Set the value of [parentesco_aval] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setParentescoAval($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->parentesco_aval !== $v) {
            $this->parentesco_aval = $v;
            $this->modifiedColumns[] = RslicePeer::PARENTESCO_AVAL;
        }


        return $this;
    } // setParentescoAval()

    /**
     * Sets the value of the [localizar] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setLocalizar($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->localizar !== $v) {
            $this->localizar = $v;
            $this->modifiedColumns[] = RslicePeer::LOCALIZAR;
        }


        return $this;
    } // setLocalizar()

    /**
     * Sets the value of [fecha_ultima_gestion] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaUltimaGestion($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_ultima_gestion !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_ultima_gestion !== null && $tmpDt = new DateTime($this->fecha_ultima_gestion)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->fecha_ultima_gestion = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_ULTIMA_GESTION;
            }
        } // if either are not null


        return $this;
    } // setFechaUltimaGestion()

    /**
     * Set the value of [empresa] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEmpresa($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->empresa !== $v) {
            $this->empresa = $v;
            $this->modifiedColumns[] = RslicePeer::EMPRESA;
        }


        return $this;
    } // setEmpresa()

    /**
     * Sets the value of [timelock] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setTimelock($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->timelock !== null || $dt !== null) {
            $currentDateAsString = ($this->timelock !== null && $tmpDt = new DateTime($this->timelock)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->timelock = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::TIMELOCK;
            }
        } // if either are not null


        return $this;
    } // setTimelock()

    /**
     * Set the value of [locker] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setLocker($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->locker !== $v) {
            $this->locker = $v;
            $this->modifiedColumns[] = RslicePeer::LOCKER;
        }


        return $this;
    } // setLocker()

    /**
     * Sets the value of [fecha_de_venta] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setFechaDeVenta($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_de_venta !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_de_venta !== null && $tmpDt = new DateTime($this->fecha_de_venta)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_de_venta = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::FECHA_DE_VENTA;
            }
        } // if either are not null


        return $this;
    } // setFechaDeVenta()

    /**
     * Sets the value of the [especial] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setEspecial($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->especial !== $v) {
            $this->especial = $v;
            $this->modifiedColumns[] = RslicePeer::ESPECIAL;
        }


        return $this;
    } // setEspecial()

    /**
     * Set the value of [direccion_nueva] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setDireccionNueva($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->direccion_nueva !== $v) {
            $this->direccion_nueva = $v;
            $this->modifiedColumns[] = RslicePeer::DIRECCION_NUEVA;
        }


        return $this;
    } // setDireccionNueva()

    /**
     * Sets the value of [norobot] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setNorobot($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->norobot !== null || $dt !== null) {
            $currentDateAsString = ($this->norobot !== null && $tmpDt = new DateTime($this->norobot)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->norobot = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::NOROBOT;
            }
        } // if either are not null


        return $this;
    } // setNorobot()

    /**
     * Set the value of [user] column.
     *
     * @param string $v new value
     * @return Rslice The current object (for fluent API support)
     */
    public function setUser($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user !== $v) {
            $this->user = $v;
            $this->modifiedColumns[] = RslicePeer::USER;
        }


        return $this;
    } // setUser()

    /**
     * Sets the value of [timeuser] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rslice The current object (for fluent API support)
     */
    public function setTimeuser($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->timeuser !== null || $dt !== null) {
            $currentDateAsString = ($this->timeuser !== null && $tmpDt = new DateTime($this->timeuser)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->timeuser = $newDateAsString;
                $this->modifiedColumns[] = RslicePeer::TIMEUSER;
            }
        } // if either are not null


        return $this;
    } // setTimeuser()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->status_aarsa !== '') {
                return false;
            }

            if ($this->numero_de_cuenta !== '0') {
                return false;
            }

            if ($this->saldo_total !== '0.00') {
                return false;
            }

            if ($this->saldo_vencido !== '0.00') {
                return false;
            }

            if ($this->saldo_descuento_1 !== '0.00') {
                return false;
            }

            if ($this->saldo_descuento_2 !== '0.00') {
                return false;
            }

            if ($this->monto_ultimo_pago !== '0.00') {
                return false;
            }

            if ($this->monto_adeudado !== '0.00') {
                return false;
            }

            if ($this->dias_vencidos !== 0) {
                return false;
            }

            if ($this->ejecutivo_asignado_call_center !== 'sinasig') {
                return false;
            }

            if ($this->fecha_ultima_gestion !== NULL) {
                return false;
            }

            if ($this->especial !== false) {
                return false;
            }

            if ($this->norobot !== NULL) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->nombre_deudor = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->domicilio_deudor = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->colonia_deudor = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->ciudad_deudor = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->estado_deudor = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->cp_deudor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->plano_guia_roji = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->cuadrante_guia_roji = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->tel_1 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->tel_2 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->tel_3 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->tel_4 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->nombre_deudor_alterno = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->domicilio_deudor_alterno = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->colonia_deudor_alterno = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->ciudad_deudor_alterno = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->estado_deudor_alterno = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->cp_deudor_aterno = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->tel_1_alterno = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->tel_2_alterno = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->tel_3_alterno = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->tel_4_alterno = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->plano_guia_roji_alterno = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->cuadrante_guia_roji_alterno = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->status_aarsa = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
            $this->sucursal_cliente = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
            $this->parentesco_ref_1 = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->nombre_referencia_1 = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
            $this->domicilio_referencia_1 = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
            $this->colonia_referencia_1 = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
            $this->ciudad_referencia_1 = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
            $this->estado_referencia_1 = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
            $this->cp_referencia_1 = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
            $this->tel_1_ref_1 = ($row[$startcol + 33] !== null) ? (string) $row[$startcol + 33] : null;
            $this->tel_2_ref_1 = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
            $this->parentesco_ref_2 = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
            $this->nombre_referencia_2 = ($row[$startcol + 36] !== null) ? (string) $row[$startcol + 36] : null;
            $this->domicilio_referencia_2 = ($row[$startcol + 37] !== null) ? (string) $row[$startcol + 37] : null;
            $this->colonia_referencia_2 = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
            $this->ciudad_referencia_2 = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
            $this->estado_referencia_2 = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
            $this->cp_referencia_2 = ($row[$startcol + 41] !== null) ? (string) $row[$startcol + 41] : null;
            $this->tel_1_ref_2 = ($row[$startcol + 42] !== null) ? (string) $row[$startcol + 42] : null;
            $this->tel_2_ref_2 = ($row[$startcol + 43] !== null) ? (string) $row[$startcol + 43] : null;
            $this->parentesco_ref_3 = ($row[$startcol + 44] !== null) ? (string) $row[$startcol + 44] : null;
            $this->nombre_referencia_3 = ($row[$startcol + 45] !== null) ? (string) $row[$startcol + 45] : null;
            $this->domicilio_referencia_3 = ($row[$startcol + 46] !== null) ? (string) $row[$startcol + 46] : null;
            $this->colonia_referencia_3 = ($row[$startcol + 47] !== null) ? (string) $row[$startcol + 47] : null;
            $this->ciudad_referencia_3 = ($row[$startcol + 48] !== null) ? (string) $row[$startcol + 48] : null;
            $this->estado_referencia_3 = ($row[$startcol + 49] !== null) ? (string) $row[$startcol + 49] : null;
            $this->cp_referencia_3 = ($row[$startcol + 50] !== null) ? (string) $row[$startcol + 50] : null;
            $this->tel_1_ref_3 = ($row[$startcol + 51] !== null) ? (string) $row[$startcol + 51] : null;
            $this->tel_2_ref_3 = ($row[$startcol + 52] !== null) ? (string) $row[$startcol + 52] : null;
            $this->parentesco_ref_4 = ($row[$startcol + 53] !== null) ? (string) $row[$startcol + 53] : null;
            $this->nombre_referencia_4 = ($row[$startcol + 54] !== null) ? (string) $row[$startcol + 54] : null;
            $this->domicilio_referencia_4 = ($row[$startcol + 55] !== null) ? (string) $row[$startcol + 55] : null;
            $this->colonia_referencia_4 = ($row[$startcol + 56] !== null) ? (string) $row[$startcol + 56] : null;
            $this->ciudad_referencia_4 = ($row[$startcol + 57] !== null) ? (string) $row[$startcol + 57] : null;
            $this->estado_referencia_4 = ($row[$startcol + 58] !== null) ? (string) $row[$startcol + 58] : null;
            $this->cp_referencia_4 = ($row[$startcol + 59] !== null) ? (string) $row[$startcol + 59] : null;
            $this->tel_1_ref_4 = ($row[$startcol + 60] !== null) ? (string) $row[$startcol + 60] : null;
            $this->tel_2_ref_4 = ($row[$startcol + 61] !== null) ? (string) $row[$startcol + 61] : null;
            $this->domicilio_laboral = ($row[$startcol + 62] !== null) ? (string) $row[$startcol + 62] : null;
            $this->colonia_laboral = ($row[$startcol + 63] !== null) ? (string) $row[$startcol + 63] : null;
            $this->ciudad_laboral = ($row[$startcol + 64] !== null) ? (string) $row[$startcol + 64] : null;
            $this->estado_laboral = ($row[$startcol + 65] !== null) ? (string) $row[$startcol + 65] : null;
            $this->cp_laboral = ($row[$startcol + 66] !== null) ? (string) $row[$startcol + 66] : null;
            $this->tel_1_laboral = ($row[$startcol + 67] !== null) ? (string) $row[$startcol + 67] : null;
            $this->tel_2_laboral = ($row[$startcol + 68] !== null) ? (string) $row[$startcol + 68] : null;
            $this->saldo_corriente = ($row[$startcol + 69] !== null) ? (string) $row[$startcol + 69] : null;
            $this->fecha_de_actualizacion = ($row[$startcol + 70] !== null) ? (string) $row[$startcol + 70] : null;
            $this->numero_de_cuenta = ($row[$startcol + 71] !== null) ? (string) $row[$startcol + 71] : null;
            $this->numero_de_credito = ($row[$startcol + 72] !== null) ? (string) $row[$startcol + 72] : null;
            $this->contrato = ($row[$startcol + 73] !== null) ? (string) $row[$startcol + 73] : null;
            $this->saldo_total = ($row[$startcol + 74] !== null) ? (string) $row[$startcol + 74] : null;
            $this->saldo_vencido = ($row[$startcol + 75] !== null) ? (string) $row[$startcol + 75] : null;
            $this->saldo_descuento_1 = ($row[$startcol + 76] !== null) ? (string) $row[$startcol + 76] : null;
            $this->saldo_descuento_2 = ($row[$startcol + 77] !== null) ? (string) $row[$startcol + 77] : null;
            $this->fecha_corte = ($row[$startcol + 78] !== null) ? (string) $row[$startcol + 78] : null;
            $this->fecha_limite = ($row[$startcol + 79] !== null) ? (string) $row[$startcol + 79] : null;
            $this->fecha_de_ultimo_pago = ($row[$startcol + 80] !== null) ? (string) $row[$startcol + 80] : null;
            $this->monto_ultimo_pago = ($row[$startcol + 81] !== null) ? (string) $row[$startcol + 81] : null;
            $this->producto = ($row[$startcol + 82] !== null) ? (string) $row[$startcol + 82] : null;
            $this->subproducto = ($row[$startcol + 83] !== null) ? (string) $row[$startcol + 83] : null;
            $this->cliente = ($row[$startcol + 84] !== null) ? (string) $row[$startcol + 84] : null;
            $this->status_de_credito = ($row[$startcol + 85] !== null) ? (string) $row[$startcol + 85] : null;
            $this->pagos_vencidos = ($row[$startcol + 86] !== null) ? (int) $row[$startcol + 86] : null;
            $this->monto_adeudado = ($row[$startcol + 87] !== null) ? (string) $row[$startcol + 87] : null;
            $this->fecha_de_asignacion = ($row[$startcol + 88] !== null) ? (string) $row[$startcol + 88] : null;
            $this->fecha_de_deasignacion = ($row[$startcol + 89] !== null) ? (string) $row[$startcol + 89] : null;
            $this->cuenta_concentradora_1 = ($row[$startcol + 90] !== null) ? (string) $row[$startcol + 90] : null;
            $this->saldo_cuota = ($row[$startcol + 91] !== null) ? (string) $row[$startcol + 91] : null;
            $this->email_deudor = ($row[$startcol + 92] !== null) ? (string) $row[$startcol + 92] : null;
            $this->id_cuenta = ($row[$startcol + 93] !== null) ? (int) $row[$startcol + 93] : null;
            $this->pago_pactado = ($row[$startcol + 94] !== null) ? (string) $row[$startcol + 94] : null;
            $this->rfc_deudor = ($row[$startcol + 95] !== null) ? (string) $row[$startcol + 95] : null;
            $this->telefonos_marcados = ($row[$startcol + 96] !== null) ? (string) $row[$startcol + 96] : null;
            $this->tel_1_verif = ($row[$startcol + 97] !== null) ? (string) $row[$startcol + 97] : null;
            $this->tel_2_verif = ($row[$startcol + 98] !== null) ? (string) $row[$startcol + 98] : null;
            $this->tel_3_verif = ($row[$startcol + 99] !== null) ? (string) $row[$startcol + 99] : null;
            $this->tel_4_verif = ($row[$startcol + 100] !== null) ? (string) $row[$startcol + 100] : null;
            $this->telefono_de_ultimo_contacto = ($row[$startcol + 101] !== null) ? (string) $row[$startcol + 101] : null;
            $this->dias_vencidos = ($row[$startcol + 102] !== null) ? (int) $row[$startcol + 102] : null;
            $this->ejecutivo_asignado_call_center = ($row[$startcol + 103] !== null) ? (string) $row[$startcol + 103] : null;
            $this->ejecutivo_asignado_domiciliario = ($row[$startcol + 104] !== null) ? (string) $row[$startcol + 104] : null;
            $this->prioridad_de_gestion = ($row[$startcol + 105] !== null) ? (int) $row[$startcol + 105] : null;
            $this->region_aarsa = ($row[$startcol + 106] !== null) ? (string) $row[$startcol + 106] : null;
            $this->parentesco_aval = ($row[$startcol + 107] !== null) ? (string) $row[$startcol + 107] : null;
            $this->localizar = ($row[$startcol + 108] !== null) ? (boolean) $row[$startcol + 108] : null;
            $this->fecha_ultima_gestion = ($row[$startcol + 109] !== null) ? (string) $row[$startcol + 109] : null;
            $this->empresa = ($row[$startcol + 110] !== null) ? (string) $row[$startcol + 110] : null;
            $this->timelock = ($row[$startcol + 111] !== null) ? (string) $row[$startcol + 111] : null;
            $this->locker = ($row[$startcol + 112] !== null) ? (string) $row[$startcol + 112] : null;
            $this->fecha_de_venta = ($row[$startcol + 113] !== null) ? (string) $row[$startcol + 113] : null;
            $this->especial = ($row[$startcol + 114] !== null) ? (boolean) $row[$startcol + 114] : null;
            $this->direccion_nueva = ($row[$startcol + 115] !== null) ? (string) $row[$startcol + 115] : null;
            $this->norobot = ($row[$startcol + 116] !== null) ? (string) $row[$startcol + 116] : null;
            $this->user = ($row[$startcol + 117] !== null) ? (string) $row[$startcol + 117] : null;
            $this->timeuser = ($row[$startcol + 118] !== null) ? (string) $row[$startcol + 118] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 119; // 119 = RslicePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Rslice object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = RslicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = RsliceQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(RslicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                RslicePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = RslicePeer::ID_CUENTA;
        if (null !== $this->id_cuenta) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RslicePeer::ID_CUENTA . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RslicePeer::NOMBRE_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`estado_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::CP_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`cp_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::PLANO_GUIA_ROJI)) {
            $modifiedColumns[':p' . $index++]  = '`plano_guia_roji`';
        }
        if ($this->isColumnModified(RslicePeer::CUADRANTE_GUIA_ROJI)) {
            $modifiedColumns[':p' . $index++]  = '`cuadrante_guia_roji`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_3)) {
            $modifiedColumns[':p' . $index++]  = '`tel_3`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_4)) {
            $modifiedColumns[':p' . $index++]  = '`tel_4`';
        }
        if ($this->isColumnModified(RslicePeer::NOMBRE_DEUDOR_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_deudor_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_DEUDOR_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_deudor_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_DEUDOR_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_deudor_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_DEUDOR_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_deudor_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_DEUDOR_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`estado_deudor_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::CP_DEUDOR_ATERNO)) {
            $modifiedColumns[':p' . $index++]  = '`cp_deudor_aterno`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_3_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_3_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_4_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_4_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::PLANO_GUIA_ROJI_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`plano_guia_roji_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`cuadrante_guia_roji_alterno`';
        }
        if ($this->isColumnModified(RslicePeer::STATUS_AARSA)) {
            $modifiedColumns[':p' . $index++]  = '`status_aarsa`';
        }
        if ($this->isColumnModified(RslicePeer::SUCURSAL_CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = '`sucursal_cliente`';
        }
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_1)) {
            $modifiedColumns[':p' . $index++]  = '`parentesco_ref_1`';
        }
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_1`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_referencia_1`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_referencia_1`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_referencia_1`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`estado_referencia_1`';
        }
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`cp_referencia_1`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_1)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_1`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_1)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_1`';
        }
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_2)) {
            $modifiedColumns[':p' . $index++]  = '`parentesco_ref_2`';
        }
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_2`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_referencia_2`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_referencia_2`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_referencia_2`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`estado_referencia_2`';
        }
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`cp_referencia_2`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_2)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_2`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_2)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_2`';
        }
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_3)) {
            $modifiedColumns[':p' . $index++]  = '`parentesco_ref_3`';
        }
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_3`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_referencia_3`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_referencia_3`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_referencia_3`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`estado_referencia_3`';
        }
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`cp_referencia_3`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_3)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_3`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_3)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_3`';
        }
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_4)) {
            $modifiedColumns[':p' . $index++]  = '`parentesco_ref_4`';
        }
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_4`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_referencia_4`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_referencia_4`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_referencia_4`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`estado_referencia_4`';
        }
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`cp_referencia_4`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_4)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_4`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_4)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_4`';
        }
        if ($this->isColumnModified(RslicePeer::DOMICILIO_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`domicilio_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::COLONIA_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`colonia_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::CIUDAD_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::ESTADO_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`estado_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::CP_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`cp_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_laboral`';
        }
        if ($this->isColumnModified(RslicePeer::SALDO_CORRIENTE)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_corriente`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_DE_ACTUALIZACION)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_de_actualizacion`';
        }
        if ($this->isColumnModified(RslicePeer::NUMERO_DE_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`numero_de_cuenta`';
        }
        if ($this->isColumnModified(RslicePeer::NUMERO_DE_CREDITO)) {
            $modifiedColumns[':p' . $index++]  = '`numero_de_credito`';
        }
        if ($this->isColumnModified(RslicePeer::CONTRATO)) {
            $modifiedColumns[':p' . $index++]  = '`contrato`';
        }
        if ($this->isColumnModified(RslicePeer::SALDO_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_total`';
        }
        if ($this->isColumnModified(RslicePeer::SALDO_VENCIDO)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_vencido`';
        }
        if ($this->isColumnModified(RslicePeer::SALDO_DESCUENTO_1)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_descuento_1`';
        }
        if ($this->isColumnModified(RslicePeer::SALDO_DESCUENTO_2)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_descuento_2`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_CORTE)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_corte`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_LIMITE)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_limite`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_DE_ULTIMO_PAGO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_de_ultimo_pago`';
        }
        if ($this->isColumnModified(RslicePeer::MONTO_ULTIMO_PAGO)) {
            $modifiedColumns[':p' . $index++]  = '`monto_ultimo_pago`';
        }
        if ($this->isColumnModified(RslicePeer::PRODUCTO)) {
            $modifiedColumns[':p' . $index++]  = '`producto`';
        }
        if ($this->isColumnModified(RslicePeer::SUBPRODUCTO)) {
            $modifiedColumns[':p' . $index++]  = '`subproducto`';
        }
        if ($this->isColumnModified(RslicePeer::CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = '`cliente`';
        }
        if ($this->isColumnModified(RslicePeer::STATUS_DE_CREDITO)) {
            $modifiedColumns[':p' . $index++]  = '`status_de_credito`';
        }
        if ($this->isColumnModified(RslicePeer::PAGOS_VENCIDOS)) {
            $modifiedColumns[':p' . $index++]  = '`pagos_vencidos`';
        }
        if ($this->isColumnModified(RslicePeer::MONTO_ADEUDADO)) {
            $modifiedColumns[':p' . $index++]  = '`monto_adeudado`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_DE_ASIGNACION)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_de_asignacion`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_DE_DEASIGNACION)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_de_deasignacion`';
        }
        if ($this->isColumnModified(RslicePeer::CUENTA_CONCENTRADORA_1)) {
            $modifiedColumns[':p' . $index++]  = '`cuenta_concentradora_1`';
        }
        if ($this->isColumnModified(RslicePeer::SALDO_CUOTA)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_cuota`';
        }
        if ($this->isColumnModified(RslicePeer::EMAIL_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`email_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::ID_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`id_cuenta`';
        }
        if ($this->isColumnModified(RslicePeer::PAGO_PACTADO)) {
            $modifiedColumns[':p' . $index++]  = '`pago_pactado`';
        }
        if ($this->isColumnModified(RslicePeer::RFC_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`rfc_deudor`';
        }
        if ($this->isColumnModified(RslicePeer::TELEFONOS_MARCADOS)) {
            $modifiedColumns[':p' . $index++]  = '`telefonos_marcados`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_1_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_verif`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_2_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_verif`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_3_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_3_verif`';
        }
        if ($this->isColumnModified(RslicePeer::TEL_4_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_4_verif`';
        }
        if ($this->isColumnModified(RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = '`telefono_de_ultimo_contacto`';
        }
        if ($this->isColumnModified(RslicePeer::DIAS_VENCIDOS)) {
            $modifiedColumns[':p' . $index++]  = '`dias_vencidos`';
        }
        if ($this->isColumnModified(RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER)) {
            $modifiedColumns[':p' . $index++]  = '`ejecutivo_asignado_call_center`';
        }
        if ($this->isColumnModified(RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO)) {
            $modifiedColumns[':p' . $index++]  = '`ejecutivo_asignado_domiciliario`';
        }
        if ($this->isColumnModified(RslicePeer::PRIORIDAD_DE_GESTION)) {
            $modifiedColumns[':p' . $index++]  = '`prioridad_de_gestion`';
        }
        if ($this->isColumnModified(RslicePeer::REGION_AARSA)) {
            $modifiedColumns[':p' . $index++]  = '`region_aarsa`';
        }
        if ($this->isColumnModified(RslicePeer::PARENTESCO_AVAL)) {
            $modifiedColumns[':p' . $index++]  = '`parentesco_aval`';
        }
        if ($this->isColumnModified(RslicePeer::LOCALIZAR)) {
            $modifiedColumns[':p' . $index++]  = '`localizar`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_ULTIMA_GESTION)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_ultima_gestion`';
        }
        if ($this->isColumnModified(RslicePeer::EMPRESA)) {
            $modifiedColumns[':p' . $index++]  = '`empresa`';
        }
        if ($this->isColumnModified(RslicePeer::TIMELOCK)) {
            $modifiedColumns[':p' . $index++]  = '`timelock`';
        }
        if ($this->isColumnModified(RslicePeer::LOCKER)) {
            $modifiedColumns[':p' . $index++]  = '`locker`';
        }
        if ($this->isColumnModified(RslicePeer::FECHA_DE_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_de_venta`';
        }
        if ($this->isColumnModified(RslicePeer::ESPECIAL)) {
            $modifiedColumns[':p' . $index++]  = '`especial`';
        }
        if ($this->isColumnModified(RslicePeer::DIRECCION_NUEVA)) {
            $modifiedColumns[':p' . $index++]  = '`direccion_nueva`';
        }
        if ($this->isColumnModified(RslicePeer::NOROBOT)) {
            $modifiedColumns[':p' . $index++]  = '`norobot`';
        }
        if ($this->isColumnModified(RslicePeer::USER)) {
            $modifiedColumns[':p' . $index++]  = '`user`';
        }
        if ($this->isColumnModified(RslicePeer::TIMEUSER)) {
            $modifiedColumns[':p' . $index++]  = '`timeuser`';
        }

        $sql = sprintf(
            'INSERT INTO `rslice` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`nombre_deudor`':
                        $stmt->bindValue($identifier, $this->nombre_deudor, PDO::PARAM_STR);
                        break;
                    case '`domicilio_deudor`':
                        $stmt->bindValue($identifier, $this->domicilio_deudor, PDO::PARAM_STR);
                        break;
                    case '`colonia_deudor`':
                        $stmt->bindValue($identifier, $this->colonia_deudor, PDO::PARAM_STR);
                        break;
                    case '`ciudad_deudor`':
                        $stmt->bindValue($identifier, $this->ciudad_deudor, PDO::PARAM_STR);
                        break;
                    case '`estado_deudor`':
                        $stmt->bindValue($identifier, $this->estado_deudor, PDO::PARAM_STR);
                        break;
                    case '`cp_deudor`':
                        $stmt->bindValue($identifier, $this->cp_deudor, PDO::PARAM_STR);
                        break;
                    case '`plano_guia_roji`':
                        $stmt->bindValue($identifier, $this->plano_guia_roji, PDO::PARAM_STR);
                        break;
                    case '`cuadrante_guia_roji`':
                        $stmt->bindValue($identifier, $this->cuadrante_guia_roji, PDO::PARAM_STR);
                        break;
                    case '`tel_1`':
                        $stmt->bindValue($identifier, $this->tel_1, PDO::PARAM_STR);
                        break;
                    case '`tel_2`':
                        $stmt->bindValue($identifier, $this->tel_2, PDO::PARAM_STR);
                        break;
                    case '`tel_3`':
                        $stmt->bindValue($identifier, $this->tel_3, PDO::PARAM_STR);
                        break;
                    case '`tel_4`':
                        $stmt->bindValue($identifier, $this->tel_4, PDO::PARAM_STR);
                        break;
                    case '`nombre_deudor_alterno`':
                        $stmt->bindValue($identifier, $this->nombre_deudor_alterno, PDO::PARAM_STR);
                        break;
                    case '`domicilio_deudor_alterno`':
                        $stmt->bindValue($identifier, $this->domicilio_deudor_alterno, PDO::PARAM_STR);
                        break;
                    case '`colonia_deudor_alterno`':
                        $stmt->bindValue($identifier, $this->colonia_deudor_alterno, PDO::PARAM_STR);
                        break;
                    case '`ciudad_deudor_alterno`':
                        $stmt->bindValue($identifier, $this->ciudad_deudor_alterno, PDO::PARAM_STR);
                        break;
                    case '`estado_deudor_alterno`':
                        $stmt->bindValue($identifier, $this->estado_deudor_alterno, PDO::PARAM_STR);
                        break;
                    case '`cp_deudor_aterno`':
                        $stmt->bindValue($identifier, $this->cp_deudor_aterno, PDO::PARAM_STR);
                        break;
                    case '`tel_1_alterno`':
                        $stmt->bindValue($identifier, $this->tel_1_alterno, PDO::PARAM_STR);
                        break;
                    case '`tel_2_alterno`':
                        $stmt->bindValue($identifier, $this->tel_2_alterno, PDO::PARAM_STR);
                        break;
                    case '`tel_3_alterno`':
                        $stmt->bindValue($identifier, $this->tel_3_alterno, PDO::PARAM_STR);
                        break;
                    case '`tel_4_alterno`':
                        $stmt->bindValue($identifier, $this->tel_4_alterno, PDO::PARAM_STR);
                        break;
                    case '`plano_guia_roji_alterno`':
                        $stmt->bindValue($identifier, $this->plano_guia_roji_alterno, PDO::PARAM_STR);
                        break;
                    case '`cuadrante_guia_roji_alterno`':
                        $stmt->bindValue($identifier, $this->cuadrante_guia_roji_alterno, PDO::PARAM_STR);
                        break;
                    case '`status_aarsa`':
                        $stmt->bindValue($identifier, $this->status_aarsa, PDO::PARAM_STR);
                        break;
                    case '`sucursal_cliente`':
                        $stmt->bindValue($identifier, $this->sucursal_cliente, PDO::PARAM_STR);
                        break;
                    case '`parentesco_ref_1`':
                        $stmt->bindValue($identifier, $this->parentesco_ref_1, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_1`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`domicilio_referencia_1`':
                        $stmt->bindValue($identifier, $this->domicilio_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`colonia_referencia_1`':
                        $stmt->bindValue($identifier, $this->colonia_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`ciudad_referencia_1`':
                        $stmt->bindValue($identifier, $this->ciudad_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`estado_referencia_1`':
                        $stmt->bindValue($identifier, $this->estado_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`cp_referencia_1`':
                        $stmt->bindValue($identifier, $this->cp_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_1`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_1, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_1`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_1, PDO::PARAM_STR);
                        break;
                    case '`parentesco_ref_2`':
                        $stmt->bindValue($identifier, $this->parentesco_ref_2, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_2`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`domicilio_referencia_2`':
                        $stmt->bindValue($identifier, $this->domicilio_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`colonia_referencia_2`':
                        $stmt->bindValue($identifier, $this->colonia_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`ciudad_referencia_2`':
                        $stmt->bindValue($identifier, $this->ciudad_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`estado_referencia_2`':
                        $stmt->bindValue($identifier, $this->estado_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`cp_referencia_2`':
                        $stmt->bindValue($identifier, $this->cp_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_2`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_2, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_2`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_2, PDO::PARAM_STR);
                        break;
                    case '`parentesco_ref_3`':
                        $stmt->bindValue($identifier, $this->parentesco_ref_3, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_3`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`domicilio_referencia_3`':
                        $stmt->bindValue($identifier, $this->domicilio_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`colonia_referencia_3`':
                        $stmt->bindValue($identifier, $this->colonia_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`ciudad_referencia_3`':
                        $stmt->bindValue($identifier, $this->ciudad_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`estado_referencia_3`':
                        $stmt->bindValue($identifier, $this->estado_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`cp_referencia_3`':
                        $stmt->bindValue($identifier, $this->cp_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_3`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_3, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_3`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_3, PDO::PARAM_STR);
                        break;
                    case '`parentesco_ref_4`':
                        $stmt->bindValue($identifier, $this->parentesco_ref_4, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_4`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_4, PDO::PARAM_STR);
                        break;
                    case '`domicilio_referencia_4`':
                        $stmt->bindValue($identifier, $this->domicilio_referencia_4, PDO::PARAM_STR);
                        break;
                    case '`colonia_referencia_4`':
                        $stmt->bindValue($identifier, $this->colonia_referencia_4, PDO::PARAM_STR);
                        break;
                    case '`ciudad_referencia_4`':
                        $stmt->bindValue($identifier, $this->ciudad_referencia_4, PDO::PARAM_STR);
                        break;
                    case '`estado_referencia_4`':
                        $stmt->bindValue($identifier, $this->estado_referencia_4, PDO::PARAM_STR);
                        break;
                    case '`cp_referencia_4`':
                        $stmt->bindValue($identifier, $this->cp_referencia_4, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_4`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_4, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_4`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_4, PDO::PARAM_STR);
                        break;
                    case '`domicilio_laboral`':
                        $stmt->bindValue($identifier, $this->domicilio_laboral, PDO::PARAM_STR);
                        break;
                    case '`colonia_laboral`':
                        $stmt->bindValue($identifier, $this->colonia_laboral, PDO::PARAM_STR);
                        break;
                    case '`ciudad_laboral`':
                        $stmt->bindValue($identifier, $this->ciudad_laboral, PDO::PARAM_STR);
                        break;
                    case '`estado_laboral`':
                        $stmt->bindValue($identifier, $this->estado_laboral, PDO::PARAM_STR);
                        break;
                    case '`cp_laboral`':
                        $stmt->bindValue($identifier, $this->cp_laboral, PDO::PARAM_STR);
                        break;
                    case '`tel_1_laboral`':
                        $stmt->bindValue($identifier, $this->tel_1_laboral, PDO::PARAM_STR);
                        break;
                    case '`tel_2_laboral`':
                        $stmt->bindValue($identifier, $this->tel_2_laboral, PDO::PARAM_STR);
                        break;
                    case '`saldo_corriente`':
                        $stmt->bindValue($identifier, $this->saldo_corriente, PDO::PARAM_STR);
                        break;
                    case '`fecha_de_actualizacion`':
                        $stmt->bindValue($identifier, $this->fecha_de_actualizacion, PDO::PARAM_STR);
                        break;
                    case '`numero_de_cuenta`':
                        $stmt->bindValue($identifier, $this->numero_de_cuenta, PDO::PARAM_STR);
                        break;
                    case '`numero_de_credito`':
                        $stmt->bindValue($identifier, $this->numero_de_credito, PDO::PARAM_STR);
                        break;
                    case '`contrato`':
                        $stmt->bindValue($identifier, $this->contrato, PDO::PARAM_STR);
                        break;
                    case '`saldo_total`':
                        $stmt->bindValue($identifier, $this->saldo_total, PDO::PARAM_STR);
                        break;
                    case '`saldo_vencido`':
                        $stmt->bindValue($identifier, $this->saldo_vencido, PDO::PARAM_STR);
                        break;
                    case '`saldo_descuento_1`':
                        $stmt->bindValue($identifier, $this->saldo_descuento_1, PDO::PARAM_STR);
                        break;
                    case '`saldo_descuento_2`':
                        $stmt->bindValue($identifier, $this->saldo_descuento_2, PDO::PARAM_STR);
                        break;
                    case '`fecha_corte`':
                        $stmt->bindValue($identifier, $this->fecha_corte, PDO::PARAM_STR);
                        break;
                    case '`fecha_limite`':
                        $stmt->bindValue($identifier, $this->fecha_limite, PDO::PARAM_STR);
                        break;
                    case '`fecha_de_ultimo_pago`':
                        $stmt->bindValue($identifier, $this->fecha_de_ultimo_pago, PDO::PARAM_STR);
                        break;
                    case '`monto_ultimo_pago`':
                        $stmt->bindValue($identifier, $this->monto_ultimo_pago, PDO::PARAM_STR);
                        break;
                    case '`producto`':
                        $stmt->bindValue($identifier, $this->producto, PDO::PARAM_STR);
                        break;
                    case '`subproducto`':
                        $stmt->bindValue($identifier, $this->subproducto, PDO::PARAM_STR);
                        break;
                    case '`cliente`':
                        $stmt->bindValue($identifier, $this->cliente, PDO::PARAM_STR);
                        break;
                    case '`status_de_credito`':
                        $stmt->bindValue($identifier, $this->status_de_credito, PDO::PARAM_STR);
                        break;
                    case '`pagos_vencidos`':
                        $stmt->bindValue($identifier, $this->pagos_vencidos, PDO::PARAM_INT);
                        break;
                    case '`monto_adeudado`':
                        $stmt->bindValue($identifier, $this->monto_adeudado, PDO::PARAM_STR);
                        break;
                    case '`fecha_de_asignacion`':
                        $stmt->bindValue($identifier, $this->fecha_de_asignacion, PDO::PARAM_STR);
                        break;
                    case '`fecha_de_deasignacion`':
                        $stmt->bindValue($identifier, $this->fecha_de_deasignacion, PDO::PARAM_STR);
                        break;
                    case '`cuenta_concentradora_1`':
                        $stmt->bindValue($identifier, $this->cuenta_concentradora_1, PDO::PARAM_STR);
                        break;
                    case '`saldo_cuota`':
                        $stmt->bindValue($identifier, $this->saldo_cuota, PDO::PARAM_STR);
                        break;
                    case '`email_deudor`':
                        $stmt->bindValue($identifier, $this->email_deudor, PDO::PARAM_STR);
                        break;
                    case '`id_cuenta`':
                        $stmt->bindValue($identifier, $this->id_cuenta, PDO::PARAM_INT);
                        break;
                    case '`pago_pactado`':
                        $stmt->bindValue($identifier, $this->pago_pactado, PDO::PARAM_STR);
                        break;
                    case '`rfc_deudor`':
                        $stmt->bindValue($identifier, $this->rfc_deudor, PDO::PARAM_STR);
                        break;
                    case '`telefonos_marcados`':
                        $stmt->bindValue($identifier, $this->telefonos_marcados, PDO::PARAM_STR);
                        break;
                    case '`tel_1_verif`':
                        $stmt->bindValue($identifier, $this->tel_1_verif, PDO::PARAM_STR);
                        break;
                    case '`tel_2_verif`':
                        $stmt->bindValue($identifier, $this->tel_2_verif, PDO::PARAM_STR);
                        break;
                    case '`tel_3_verif`':
                        $stmt->bindValue($identifier, $this->tel_3_verif, PDO::PARAM_STR);
                        break;
                    case '`tel_4_verif`':
                        $stmt->bindValue($identifier, $this->tel_4_verif, PDO::PARAM_STR);
                        break;
                    case '`telefono_de_ultimo_contacto`':
                        $stmt->bindValue($identifier, $this->telefono_de_ultimo_contacto, PDO::PARAM_STR);
                        break;
                    case '`dias_vencidos`':
                        $stmt->bindValue($identifier, $this->dias_vencidos, PDO::PARAM_INT);
                        break;
                    case '`ejecutivo_asignado_call_center`':
                        $stmt->bindValue($identifier, $this->ejecutivo_asignado_call_center, PDO::PARAM_STR);
                        break;
                    case '`ejecutivo_asignado_domiciliario`':
                        $stmt->bindValue($identifier, $this->ejecutivo_asignado_domiciliario, PDO::PARAM_STR);
                        break;
                    case '`prioridad_de_gestion`':
                        $stmt->bindValue($identifier, $this->prioridad_de_gestion, PDO::PARAM_INT);
                        break;
                    case '`region_aarsa`':
                        $stmt->bindValue($identifier, $this->region_aarsa, PDO::PARAM_STR);
                        break;
                    case '`parentesco_aval`':
                        $stmt->bindValue($identifier, $this->parentesco_aval, PDO::PARAM_STR);
                        break;
                    case '`localizar`':
                        $stmt->bindValue($identifier, (int) $this->localizar, PDO::PARAM_INT);
                        break;
                    case '`fecha_ultima_gestion`':
                        $stmt->bindValue($identifier, $this->fecha_ultima_gestion, PDO::PARAM_STR);
                        break;
                    case '`empresa`':
                        $stmt->bindValue($identifier, $this->empresa, PDO::PARAM_STR);
                        break;
                    case '`timelock`':
                        $stmt->bindValue($identifier, $this->timelock, PDO::PARAM_STR);
                        break;
                    case '`locker`':
                        $stmt->bindValue($identifier, $this->locker, PDO::PARAM_STR);
                        break;
                    case '`fecha_de_venta`':
                        $stmt->bindValue($identifier, $this->fecha_de_venta, PDO::PARAM_STR);
                        break;
                    case '`especial`':
                        $stmt->bindValue($identifier, (int) $this->especial, PDO::PARAM_INT);
                        break;
                    case '`direccion_nueva`':
                        $stmt->bindValue($identifier, $this->direccion_nueva, PDO::PARAM_STR);
                        break;
                    case '`norobot`':
                        $stmt->bindValue($identifier, $this->norobot, PDO::PARAM_STR);
                        break;
                    case '`user`':
                        $stmt->bindValue($identifier, $this->user, PDO::PARAM_STR);
                        break;
                    case '`timeuser`':
                        $stmt->bindValue($identifier, $this->timeuser, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setIdCuenta($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = RslicePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = RslicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getNombreDeudor();
                break;
            case 1:
                return $this->getDomicilioDeudor();
                break;
            case 2:
                return $this->getColoniaDeudor();
                break;
            case 3:
                return $this->getCiudadDeudor();
                break;
            case 4:
                return $this->getEstadoDeudor();
                break;
            case 5:
                return $this->getCpDeudor();
                break;
            case 6:
                return $this->getPlanoGuiaRoji();
                break;
            case 7:
                return $this->getCuadranteGuiaRoji();
                break;
            case 8:
                return $this->getTel1();
                break;
            case 9:
                return $this->getTel2();
                break;
            case 10:
                return $this->getTel3();
                break;
            case 11:
                return $this->getTel4();
                break;
            case 12:
                return $this->getNombreDeudorAlterno();
                break;
            case 13:
                return $this->getDomicilioDeudorAlterno();
                break;
            case 14:
                return $this->getColoniaDeudorAlterno();
                break;
            case 15:
                return $this->getCiudadDeudorAlterno();
                break;
            case 16:
                return $this->getEstadoDeudorAlterno();
                break;
            case 17:
                return $this->getCpDeudorAterno();
                break;
            case 18:
                return $this->getTel1Alterno();
                break;
            case 19:
                return $this->getTel2Alterno();
                break;
            case 20:
                return $this->getTel3Alterno();
                break;
            case 21:
                return $this->getTel4Alterno();
                break;
            case 22:
                return $this->getPlanoGuiaRojiAlterno();
                break;
            case 23:
                return $this->getCuadranteGuiaRojiAlterno();
                break;
            case 24:
                return $this->getStatusAarsa();
                break;
            case 25:
                return $this->getSucursalCliente();
                break;
            case 26:
                return $this->getParentescoRef1();
                break;
            case 27:
                return $this->getNombreReferencia1();
                break;
            case 28:
                return $this->getDomicilioReferencia1();
                break;
            case 29:
                return $this->getColoniaReferencia1();
                break;
            case 30:
                return $this->getCiudadReferencia1();
                break;
            case 31:
                return $this->getEstadoReferencia1();
                break;
            case 32:
                return $this->getCpReferencia1();
                break;
            case 33:
                return $this->getTel1Ref1();
                break;
            case 34:
                return $this->getTel2Ref1();
                break;
            case 35:
                return $this->getParentescoRef2();
                break;
            case 36:
                return $this->getNombreReferencia2();
                break;
            case 37:
                return $this->getDomicilioReferencia2();
                break;
            case 38:
                return $this->getColoniaReferencia2();
                break;
            case 39:
                return $this->getCiudadReferencia2();
                break;
            case 40:
                return $this->getEstadoReferencia2();
                break;
            case 41:
                return $this->getCpReferencia2();
                break;
            case 42:
                return $this->getTel1Ref2();
                break;
            case 43:
                return $this->getTel2Ref2();
                break;
            case 44:
                return $this->getParentescoRef3();
                break;
            case 45:
                return $this->getNombreReferencia3();
                break;
            case 46:
                return $this->getDomicilioReferencia3();
                break;
            case 47:
                return $this->getColoniaReferencia3();
                break;
            case 48:
                return $this->getCiudadReferencia3();
                break;
            case 49:
                return $this->getEstadoReferencia3();
                break;
            case 50:
                return $this->getCpReferencia3();
                break;
            case 51:
                return $this->getTel1Ref3();
                break;
            case 52:
                return $this->getTel2Ref3();
                break;
            case 53:
                return $this->getParentescoRef4();
                break;
            case 54:
                return $this->getNombreReferencia4();
                break;
            case 55:
                return $this->getDomicilioReferencia4();
                break;
            case 56:
                return $this->getColoniaReferencia4();
                break;
            case 57:
                return $this->getCiudadReferencia4();
                break;
            case 58:
                return $this->getEstadoReferencia4();
                break;
            case 59:
                return $this->getCpReferencia4();
                break;
            case 60:
                return $this->getTel1Ref4();
                break;
            case 61:
                return $this->getTel2Ref4();
                break;
            case 62:
                return $this->getDomicilioLaboral();
                break;
            case 63:
                return $this->getColoniaLaboral();
                break;
            case 64:
                return $this->getCiudadLaboral();
                break;
            case 65:
                return $this->getEstadoLaboral();
                break;
            case 66:
                return $this->getCpLaboral();
                break;
            case 67:
                return $this->getTel1Laboral();
                break;
            case 68:
                return $this->getTel2Laboral();
                break;
            case 69:
                return $this->getSaldoCorriente();
                break;
            case 70:
                return $this->getFechaDeActualizacion();
                break;
            case 71:
                return $this->getNumeroDeCuenta();
                break;
            case 72:
                return $this->getNumeroDeCredito();
                break;
            case 73:
                return $this->getContrato();
                break;
            case 74:
                return $this->getSaldoTotal();
                break;
            case 75:
                return $this->getSaldoVencido();
                break;
            case 76:
                return $this->getSaldoDescuento1();
                break;
            case 77:
                return $this->getSaldoDescuento2();
                break;
            case 78:
                return $this->getFechaCorte();
                break;
            case 79:
                return $this->getFechaLimite();
                break;
            case 80:
                return $this->getFechaDeUltimoPago();
                break;
            case 81:
                return $this->getMontoUltimoPago();
                break;
            case 82:
                return $this->getProducto();
                break;
            case 83:
                return $this->getSubproducto();
                break;
            case 84:
                return $this->getCliente();
                break;
            case 85:
                return $this->getStatusDeCredito();
                break;
            case 86:
                return $this->getPagosVencidos();
                break;
            case 87:
                return $this->getMontoAdeudado();
                break;
            case 88:
                return $this->getFechaDeAsignacion();
                break;
            case 89:
                return $this->getFechaDeDeasignacion();
                break;
            case 90:
                return $this->getCuentaConcentradora1();
                break;
            case 91:
                return $this->getSaldoCuota();
                break;
            case 92:
                return $this->getEmailDeudor();
                break;
            case 93:
                return $this->getIdCuenta();
                break;
            case 94:
                return $this->getPagoPactado();
                break;
            case 95:
                return $this->getRfcDeudor();
                break;
            case 96:
                return $this->getTelefonosMarcados();
                break;
            case 97:
                return $this->getTel1Verif();
                break;
            case 98:
                return $this->getTel2Verif();
                break;
            case 99:
                return $this->getTel3Verif();
                break;
            case 100:
                return $this->getTel4Verif();
                break;
            case 101:
                return $this->getTelefonoDeUltimoContacto();
                break;
            case 102:
                return $this->getDiasVencidos();
                break;
            case 103:
                return $this->getEjecutivoAsignadoCallCenter();
                break;
            case 104:
                return $this->getEjecutivoAsignadoDomiciliario();
                break;
            case 105:
                return $this->getPrioridadDeGestion();
                break;
            case 106:
                return $this->getRegionAarsa();
                break;
            case 107:
                return $this->getParentescoAval();
                break;
            case 108:
                return $this->getLocalizar();
                break;
            case 109:
                return $this->getFechaUltimaGestion();
                break;
            case 110:
                return $this->getEmpresa();
                break;
            case 111:
                return $this->getTimelock();
                break;
            case 112:
                return $this->getLocker();
                break;
            case 113:
                return $this->getFechaDeVenta();
                break;
            case 114:
                return $this->getEspecial();
                break;
            case 115:
                return $this->getDireccionNueva();
                break;
            case 116:
                return $this->getNorobot();
                break;
            case 117:
                return $this->getUser();
                break;
            case 118:
                return $this->getTimeuser();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Rslice'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Rslice'][$this->getPrimaryKey()] = true;
        $keys = RslicePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getNombreDeudor(),
            $keys[1] => $this->getDomicilioDeudor(),
            $keys[2] => $this->getColoniaDeudor(),
            $keys[3] => $this->getCiudadDeudor(),
            $keys[4] => $this->getEstadoDeudor(),
            $keys[5] => $this->getCpDeudor(),
            $keys[6] => $this->getPlanoGuiaRoji(),
            $keys[7] => $this->getCuadranteGuiaRoji(),
            $keys[8] => $this->getTel1(),
            $keys[9] => $this->getTel2(),
            $keys[10] => $this->getTel3(),
            $keys[11] => $this->getTel4(),
            $keys[12] => $this->getNombreDeudorAlterno(),
            $keys[13] => $this->getDomicilioDeudorAlterno(),
            $keys[14] => $this->getColoniaDeudorAlterno(),
            $keys[15] => $this->getCiudadDeudorAlterno(),
            $keys[16] => $this->getEstadoDeudorAlterno(),
            $keys[17] => $this->getCpDeudorAterno(),
            $keys[18] => $this->getTel1Alterno(),
            $keys[19] => $this->getTel2Alterno(),
            $keys[20] => $this->getTel3Alterno(),
            $keys[21] => $this->getTel4Alterno(),
            $keys[22] => $this->getPlanoGuiaRojiAlterno(),
            $keys[23] => $this->getCuadranteGuiaRojiAlterno(),
            $keys[24] => $this->getStatusAarsa(),
            $keys[25] => $this->getSucursalCliente(),
            $keys[26] => $this->getParentescoRef1(),
            $keys[27] => $this->getNombreReferencia1(),
            $keys[28] => $this->getDomicilioReferencia1(),
            $keys[29] => $this->getColoniaReferencia1(),
            $keys[30] => $this->getCiudadReferencia1(),
            $keys[31] => $this->getEstadoReferencia1(),
            $keys[32] => $this->getCpReferencia1(),
            $keys[33] => $this->getTel1Ref1(),
            $keys[34] => $this->getTel2Ref1(),
            $keys[35] => $this->getParentescoRef2(),
            $keys[36] => $this->getNombreReferencia2(),
            $keys[37] => $this->getDomicilioReferencia2(),
            $keys[38] => $this->getColoniaReferencia2(),
            $keys[39] => $this->getCiudadReferencia2(),
            $keys[40] => $this->getEstadoReferencia2(),
            $keys[41] => $this->getCpReferencia2(),
            $keys[42] => $this->getTel1Ref2(),
            $keys[43] => $this->getTel2Ref2(),
            $keys[44] => $this->getParentescoRef3(),
            $keys[45] => $this->getNombreReferencia3(),
            $keys[46] => $this->getDomicilioReferencia3(),
            $keys[47] => $this->getColoniaReferencia3(),
            $keys[48] => $this->getCiudadReferencia3(),
            $keys[49] => $this->getEstadoReferencia3(),
            $keys[50] => $this->getCpReferencia3(),
            $keys[51] => $this->getTel1Ref3(),
            $keys[52] => $this->getTel2Ref3(),
            $keys[53] => $this->getParentescoRef4(),
            $keys[54] => $this->getNombreReferencia4(),
            $keys[55] => $this->getDomicilioReferencia4(),
            $keys[56] => $this->getColoniaReferencia4(),
            $keys[57] => $this->getCiudadReferencia4(),
            $keys[58] => $this->getEstadoReferencia4(),
            $keys[59] => $this->getCpReferencia4(),
            $keys[60] => $this->getTel1Ref4(),
            $keys[61] => $this->getTel2Ref4(),
            $keys[62] => $this->getDomicilioLaboral(),
            $keys[63] => $this->getColoniaLaboral(),
            $keys[64] => $this->getCiudadLaboral(),
            $keys[65] => $this->getEstadoLaboral(),
            $keys[66] => $this->getCpLaboral(),
            $keys[67] => $this->getTel1Laboral(),
            $keys[68] => $this->getTel2Laboral(),
            $keys[69] => $this->getSaldoCorriente(),
            $keys[70] => $this->getFechaDeActualizacion(),
            $keys[71] => $this->getNumeroDeCuenta(),
            $keys[72] => $this->getNumeroDeCredito(),
            $keys[73] => $this->getContrato(),
            $keys[74] => $this->getSaldoTotal(),
            $keys[75] => $this->getSaldoVencido(),
            $keys[76] => $this->getSaldoDescuento1(),
            $keys[77] => $this->getSaldoDescuento2(),
            $keys[78] => $this->getFechaCorte(),
            $keys[79] => $this->getFechaLimite(),
            $keys[80] => $this->getFechaDeUltimoPago(),
            $keys[81] => $this->getMontoUltimoPago(),
            $keys[82] => $this->getProducto(),
            $keys[83] => $this->getSubproducto(),
            $keys[84] => $this->getCliente(),
            $keys[85] => $this->getStatusDeCredito(),
            $keys[86] => $this->getPagosVencidos(),
            $keys[87] => $this->getMontoAdeudado(),
            $keys[88] => $this->getFechaDeAsignacion(),
            $keys[89] => $this->getFechaDeDeasignacion(),
            $keys[90] => $this->getCuentaConcentradora1(),
            $keys[91] => $this->getSaldoCuota(),
            $keys[92] => $this->getEmailDeudor(),
            $keys[93] => $this->getIdCuenta(),
            $keys[94] => $this->getPagoPactado(),
            $keys[95] => $this->getRfcDeudor(),
            $keys[96] => $this->getTelefonosMarcados(),
            $keys[97] => $this->getTel1Verif(),
            $keys[98] => $this->getTel2Verif(),
            $keys[99] => $this->getTel3Verif(),
            $keys[100] => $this->getTel4Verif(),
            $keys[101] => $this->getTelefonoDeUltimoContacto(),
            $keys[102] => $this->getDiasVencidos(),
            $keys[103] => $this->getEjecutivoAsignadoCallCenter(),
            $keys[104] => $this->getEjecutivoAsignadoDomiciliario(),
            $keys[105] => $this->getPrioridadDeGestion(),
            $keys[106] => $this->getRegionAarsa(),
            $keys[107] => $this->getParentescoAval(),
            $keys[108] => $this->getLocalizar(),
            $keys[109] => $this->getFechaUltimaGestion(),
            $keys[110] => $this->getEmpresa(),
            $keys[111] => $this->getTimelock(),
            $keys[112] => $this->getLocker(),
            $keys[113] => $this->getFechaDeVenta(),
            $keys[114] => $this->getEspecial(),
            $keys[115] => $this->getDireccionNueva(),
            $keys[116] => $this->getNorobot(),
            $keys[117] => $this->getUser(),
            $keys[118] => $this->getTimeuser(),
        );

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = RslicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setNombreDeudor($value);
                break;
            case 1:
                $this->setDomicilioDeudor($value);
                break;
            case 2:
                $this->setColoniaDeudor($value);
                break;
            case 3:
                $this->setCiudadDeudor($value);
                break;
            case 4:
                $this->setEstadoDeudor($value);
                break;
            case 5:
                $this->setCpDeudor($value);
                break;
            case 6:
                $this->setPlanoGuiaRoji($value);
                break;
            case 7:
                $this->setCuadranteGuiaRoji($value);
                break;
            case 8:
                $this->setTel1($value);
                break;
            case 9:
                $this->setTel2($value);
                break;
            case 10:
                $this->setTel3($value);
                break;
            case 11:
                $this->setTel4($value);
                break;
            case 12:
                $this->setNombreDeudorAlterno($value);
                break;
            case 13:
                $this->setDomicilioDeudorAlterno($value);
                break;
            case 14:
                $this->setColoniaDeudorAlterno($value);
                break;
            case 15:
                $this->setCiudadDeudorAlterno($value);
                break;
            case 16:
                $this->setEstadoDeudorAlterno($value);
                break;
            case 17:
                $this->setCpDeudorAterno($value);
                break;
            case 18:
                $this->setTel1Alterno($value);
                break;
            case 19:
                $this->setTel2Alterno($value);
                break;
            case 20:
                $this->setTel3Alterno($value);
                break;
            case 21:
                $this->setTel4Alterno($value);
                break;
            case 22:
                $this->setPlanoGuiaRojiAlterno($value);
                break;
            case 23:
                $this->setCuadranteGuiaRojiAlterno($value);
                break;
            case 24:
                $this->setStatusAarsa($value);
                break;
            case 25:
                $this->setSucursalCliente($value);
                break;
            case 26:
                $this->setParentescoRef1($value);
                break;
            case 27:
                $this->setNombreReferencia1($value);
                break;
            case 28:
                $this->setDomicilioReferencia1($value);
                break;
            case 29:
                $this->setColoniaReferencia1($value);
                break;
            case 30:
                $this->setCiudadReferencia1($value);
                break;
            case 31:
                $this->setEstadoReferencia1($value);
                break;
            case 32:
                $this->setCpReferencia1($value);
                break;
            case 33:
                $this->setTel1Ref1($value);
                break;
            case 34:
                $this->setTel2Ref1($value);
                break;
            case 35:
                $this->setParentescoRef2($value);
                break;
            case 36:
                $this->setNombreReferencia2($value);
                break;
            case 37:
                $this->setDomicilioReferencia2($value);
                break;
            case 38:
                $this->setColoniaReferencia2($value);
                break;
            case 39:
                $this->setCiudadReferencia2($value);
                break;
            case 40:
                $this->setEstadoReferencia2($value);
                break;
            case 41:
                $this->setCpReferencia2($value);
                break;
            case 42:
                $this->setTel1Ref2($value);
                break;
            case 43:
                $this->setTel2Ref2($value);
                break;
            case 44:
                $this->setParentescoRef3($value);
                break;
            case 45:
                $this->setNombreReferencia3($value);
                break;
            case 46:
                $this->setDomicilioReferencia3($value);
                break;
            case 47:
                $this->setColoniaReferencia3($value);
                break;
            case 48:
                $this->setCiudadReferencia3($value);
                break;
            case 49:
                $this->setEstadoReferencia3($value);
                break;
            case 50:
                $this->setCpReferencia3($value);
                break;
            case 51:
                $this->setTel1Ref3($value);
                break;
            case 52:
                $this->setTel2Ref3($value);
                break;
            case 53:
                $this->setParentescoRef4($value);
                break;
            case 54:
                $this->setNombreReferencia4($value);
                break;
            case 55:
                $this->setDomicilioReferencia4($value);
                break;
            case 56:
                $this->setColoniaReferencia4($value);
                break;
            case 57:
                $this->setCiudadReferencia4($value);
                break;
            case 58:
                $this->setEstadoReferencia4($value);
                break;
            case 59:
                $this->setCpReferencia4($value);
                break;
            case 60:
                $this->setTel1Ref4($value);
                break;
            case 61:
                $this->setTel2Ref4($value);
                break;
            case 62:
                $this->setDomicilioLaboral($value);
                break;
            case 63:
                $this->setColoniaLaboral($value);
                break;
            case 64:
                $this->setCiudadLaboral($value);
                break;
            case 65:
                $this->setEstadoLaboral($value);
                break;
            case 66:
                $this->setCpLaboral($value);
                break;
            case 67:
                $this->setTel1Laboral($value);
                break;
            case 68:
                $this->setTel2Laboral($value);
                break;
            case 69:
                $this->setSaldoCorriente($value);
                break;
            case 70:
                $this->setFechaDeActualizacion($value);
                break;
            case 71:
                $this->setNumeroDeCuenta($value);
                break;
            case 72:
                $this->setNumeroDeCredito($value);
                break;
            case 73:
                $this->setContrato($value);
                break;
            case 74:
                $this->setSaldoTotal($value);
                break;
            case 75:
                $this->setSaldoVencido($value);
                break;
            case 76:
                $this->setSaldoDescuento1($value);
                break;
            case 77:
                $this->setSaldoDescuento2($value);
                break;
            case 78:
                $this->setFechaCorte($value);
                break;
            case 79:
                $this->setFechaLimite($value);
                break;
            case 80:
                $this->setFechaDeUltimoPago($value);
                break;
            case 81:
                $this->setMontoUltimoPago($value);
                break;
            case 82:
                $this->setProducto($value);
                break;
            case 83:
                $this->setSubproducto($value);
                break;
            case 84:
                $this->setCliente($value);
                break;
            case 85:
                $this->setStatusDeCredito($value);
                break;
            case 86:
                $this->setPagosVencidos($value);
                break;
            case 87:
                $this->setMontoAdeudado($value);
                break;
            case 88:
                $this->setFechaDeAsignacion($value);
                break;
            case 89:
                $this->setFechaDeDeasignacion($value);
                break;
            case 90:
                $this->setCuentaConcentradora1($value);
                break;
            case 91:
                $this->setSaldoCuota($value);
                break;
            case 92:
                $this->setEmailDeudor($value);
                break;
            case 93:
                $this->setIdCuenta($value);
                break;
            case 94:
                $this->setPagoPactado($value);
                break;
            case 95:
                $this->setRfcDeudor($value);
                break;
            case 96:
                $this->setTelefonosMarcados($value);
                break;
            case 97:
                $this->setTel1Verif($value);
                break;
            case 98:
                $this->setTel2Verif($value);
                break;
            case 99:
                $this->setTel3Verif($value);
                break;
            case 100:
                $this->setTel4Verif($value);
                break;
            case 101:
                $this->setTelefonoDeUltimoContacto($value);
                break;
            case 102:
                $this->setDiasVencidos($value);
                break;
            case 103:
                $this->setEjecutivoAsignadoCallCenter($value);
                break;
            case 104:
                $this->setEjecutivoAsignadoDomiciliario($value);
                break;
            case 105:
                $this->setPrioridadDeGestion($value);
                break;
            case 106:
                $this->setRegionAarsa($value);
                break;
            case 107:
                $this->setParentescoAval($value);
                break;
            case 108:
                $this->setLocalizar($value);
                break;
            case 109:
                $this->setFechaUltimaGestion($value);
                break;
            case 110:
                $this->setEmpresa($value);
                break;
            case 111:
                $this->setTimelock($value);
                break;
            case 112:
                $this->setLocker($value);
                break;
            case 113:
                $this->setFechaDeVenta($value);
                break;
            case 114:
                $this->setEspecial($value);
                break;
            case 115:
                $this->setDireccionNueva($value);
                break;
            case 116:
                $this->setNorobot($value);
                break;
            case 117:
                $this->setUser($value);
                break;
            case 118:
                $this->setTimeuser($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = RslicePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setNombreDeudor($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDomicilioDeudor($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setColoniaDeudor($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCiudadDeudor($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEstadoDeudor($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCpDeudor($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPlanoGuiaRoji($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCuadranteGuiaRoji($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setTel1($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setTel2($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setTel3($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setTel4($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setNombreDeudorAlterno($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setDomicilioDeudorAlterno($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setColoniaDeudorAlterno($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setCiudadDeudorAlterno($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setEstadoDeudorAlterno($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setCpDeudorAterno($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setTel1Alterno($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setTel2Alterno($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setTel3Alterno($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setTel4Alterno($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setPlanoGuiaRojiAlterno($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setCuadranteGuiaRojiAlterno($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setStatusAarsa($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setSucursalCliente($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setParentescoRef1($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setNombreReferencia1($arr[$keys[27]]);
        if (array_key_exists($keys[28], $arr)) $this->setDomicilioReferencia1($arr[$keys[28]]);
        if (array_key_exists($keys[29], $arr)) $this->setColoniaReferencia1($arr[$keys[29]]);
        if (array_key_exists($keys[30], $arr)) $this->setCiudadReferencia1($arr[$keys[30]]);
        if (array_key_exists($keys[31], $arr)) $this->setEstadoReferencia1($arr[$keys[31]]);
        if (array_key_exists($keys[32], $arr)) $this->setCpReferencia1($arr[$keys[32]]);
        if (array_key_exists($keys[33], $arr)) $this->setTel1Ref1($arr[$keys[33]]);
        if (array_key_exists($keys[34], $arr)) $this->setTel2Ref1($arr[$keys[34]]);
        if (array_key_exists($keys[35], $arr)) $this->setParentescoRef2($arr[$keys[35]]);
        if (array_key_exists($keys[36], $arr)) $this->setNombreReferencia2($arr[$keys[36]]);
        if (array_key_exists($keys[37], $arr)) $this->setDomicilioReferencia2($arr[$keys[37]]);
        if (array_key_exists($keys[38], $arr)) $this->setColoniaReferencia2($arr[$keys[38]]);
        if (array_key_exists($keys[39], $arr)) $this->setCiudadReferencia2($arr[$keys[39]]);
        if (array_key_exists($keys[40], $arr)) $this->setEstadoReferencia2($arr[$keys[40]]);
        if (array_key_exists($keys[41], $arr)) $this->setCpReferencia2($arr[$keys[41]]);
        if (array_key_exists($keys[42], $arr)) $this->setTel1Ref2($arr[$keys[42]]);
        if (array_key_exists($keys[43], $arr)) $this->setTel2Ref2($arr[$keys[43]]);
        if (array_key_exists($keys[44], $arr)) $this->setParentescoRef3($arr[$keys[44]]);
        if (array_key_exists($keys[45], $arr)) $this->setNombreReferencia3($arr[$keys[45]]);
        if (array_key_exists($keys[46], $arr)) $this->setDomicilioReferencia3($arr[$keys[46]]);
        if (array_key_exists($keys[47], $arr)) $this->setColoniaReferencia3($arr[$keys[47]]);
        if (array_key_exists($keys[48], $arr)) $this->setCiudadReferencia3($arr[$keys[48]]);
        if (array_key_exists($keys[49], $arr)) $this->setEstadoReferencia3($arr[$keys[49]]);
        if (array_key_exists($keys[50], $arr)) $this->setCpReferencia3($arr[$keys[50]]);
        if (array_key_exists($keys[51], $arr)) $this->setTel1Ref3($arr[$keys[51]]);
        if (array_key_exists($keys[52], $arr)) $this->setTel2Ref3($arr[$keys[52]]);
        if (array_key_exists($keys[53], $arr)) $this->setParentescoRef4($arr[$keys[53]]);
        if (array_key_exists($keys[54], $arr)) $this->setNombreReferencia4($arr[$keys[54]]);
        if (array_key_exists($keys[55], $arr)) $this->setDomicilioReferencia4($arr[$keys[55]]);
        if (array_key_exists($keys[56], $arr)) $this->setColoniaReferencia4($arr[$keys[56]]);
        if (array_key_exists($keys[57], $arr)) $this->setCiudadReferencia4($arr[$keys[57]]);
        if (array_key_exists($keys[58], $arr)) $this->setEstadoReferencia4($arr[$keys[58]]);
        if (array_key_exists($keys[59], $arr)) $this->setCpReferencia4($arr[$keys[59]]);
        if (array_key_exists($keys[60], $arr)) $this->setTel1Ref4($arr[$keys[60]]);
        if (array_key_exists($keys[61], $arr)) $this->setTel2Ref4($arr[$keys[61]]);
        if (array_key_exists($keys[62], $arr)) $this->setDomicilioLaboral($arr[$keys[62]]);
        if (array_key_exists($keys[63], $arr)) $this->setColoniaLaboral($arr[$keys[63]]);
        if (array_key_exists($keys[64], $arr)) $this->setCiudadLaboral($arr[$keys[64]]);
        if (array_key_exists($keys[65], $arr)) $this->setEstadoLaboral($arr[$keys[65]]);
        if (array_key_exists($keys[66], $arr)) $this->setCpLaboral($arr[$keys[66]]);
        if (array_key_exists($keys[67], $arr)) $this->setTel1Laboral($arr[$keys[67]]);
        if (array_key_exists($keys[68], $arr)) $this->setTel2Laboral($arr[$keys[68]]);
        if (array_key_exists($keys[69], $arr)) $this->setSaldoCorriente($arr[$keys[69]]);
        if (array_key_exists($keys[70], $arr)) $this->setFechaDeActualizacion($arr[$keys[70]]);
        if (array_key_exists($keys[71], $arr)) $this->setNumeroDeCuenta($arr[$keys[71]]);
        if (array_key_exists($keys[72], $arr)) $this->setNumeroDeCredito($arr[$keys[72]]);
        if (array_key_exists($keys[73], $arr)) $this->setContrato($arr[$keys[73]]);
        if (array_key_exists($keys[74], $arr)) $this->setSaldoTotal($arr[$keys[74]]);
        if (array_key_exists($keys[75], $arr)) $this->setSaldoVencido($arr[$keys[75]]);
        if (array_key_exists($keys[76], $arr)) $this->setSaldoDescuento1($arr[$keys[76]]);
        if (array_key_exists($keys[77], $arr)) $this->setSaldoDescuento2($arr[$keys[77]]);
        if (array_key_exists($keys[78], $arr)) $this->setFechaCorte($arr[$keys[78]]);
        if (array_key_exists($keys[79], $arr)) $this->setFechaLimite($arr[$keys[79]]);
        if (array_key_exists($keys[80], $arr)) $this->setFechaDeUltimoPago($arr[$keys[80]]);
        if (array_key_exists($keys[81], $arr)) $this->setMontoUltimoPago($arr[$keys[81]]);
        if (array_key_exists($keys[82], $arr)) $this->setProducto($arr[$keys[82]]);
        if (array_key_exists($keys[83], $arr)) $this->setSubproducto($arr[$keys[83]]);
        if (array_key_exists($keys[84], $arr)) $this->setCliente($arr[$keys[84]]);
        if (array_key_exists($keys[85], $arr)) $this->setStatusDeCredito($arr[$keys[85]]);
        if (array_key_exists($keys[86], $arr)) $this->setPagosVencidos($arr[$keys[86]]);
        if (array_key_exists($keys[87], $arr)) $this->setMontoAdeudado($arr[$keys[87]]);
        if (array_key_exists($keys[88], $arr)) $this->setFechaDeAsignacion($arr[$keys[88]]);
        if (array_key_exists($keys[89], $arr)) $this->setFechaDeDeasignacion($arr[$keys[89]]);
        if (array_key_exists($keys[90], $arr)) $this->setCuentaConcentradora1($arr[$keys[90]]);
        if (array_key_exists($keys[91], $arr)) $this->setSaldoCuota($arr[$keys[91]]);
        if (array_key_exists($keys[92], $arr)) $this->setEmailDeudor($arr[$keys[92]]);
        if (array_key_exists($keys[93], $arr)) $this->setIdCuenta($arr[$keys[93]]);
        if (array_key_exists($keys[94], $arr)) $this->setPagoPactado($arr[$keys[94]]);
        if (array_key_exists($keys[95], $arr)) $this->setRfcDeudor($arr[$keys[95]]);
        if (array_key_exists($keys[96], $arr)) $this->setTelefonosMarcados($arr[$keys[96]]);
        if (array_key_exists($keys[97], $arr)) $this->setTel1Verif($arr[$keys[97]]);
        if (array_key_exists($keys[98], $arr)) $this->setTel2Verif($arr[$keys[98]]);
        if (array_key_exists($keys[99], $arr)) $this->setTel3Verif($arr[$keys[99]]);
        if (array_key_exists($keys[100], $arr)) $this->setTel4Verif($arr[$keys[100]]);
        if (array_key_exists($keys[101], $arr)) $this->setTelefonoDeUltimoContacto($arr[$keys[101]]);
        if (array_key_exists($keys[102], $arr)) $this->setDiasVencidos($arr[$keys[102]]);
        if (array_key_exists($keys[103], $arr)) $this->setEjecutivoAsignadoCallCenter($arr[$keys[103]]);
        if (array_key_exists($keys[104], $arr)) $this->setEjecutivoAsignadoDomiciliario($arr[$keys[104]]);
        if (array_key_exists($keys[105], $arr)) $this->setPrioridadDeGestion($arr[$keys[105]]);
        if (array_key_exists($keys[106], $arr)) $this->setRegionAarsa($arr[$keys[106]]);
        if (array_key_exists($keys[107], $arr)) $this->setParentescoAval($arr[$keys[107]]);
        if (array_key_exists($keys[108], $arr)) $this->setLocalizar($arr[$keys[108]]);
        if (array_key_exists($keys[109], $arr)) $this->setFechaUltimaGestion($arr[$keys[109]]);
        if (array_key_exists($keys[110], $arr)) $this->setEmpresa($arr[$keys[110]]);
        if (array_key_exists($keys[111], $arr)) $this->setTimelock($arr[$keys[111]]);
        if (array_key_exists($keys[112], $arr)) $this->setLocker($arr[$keys[112]]);
        if (array_key_exists($keys[113], $arr)) $this->setFechaDeVenta($arr[$keys[113]]);
        if (array_key_exists($keys[114], $arr)) $this->setEspecial($arr[$keys[114]]);
        if (array_key_exists($keys[115], $arr)) $this->setDireccionNueva($arr[$keys[115]]);
        if (array_key_exists($keys[116], $arr)) $this->setNorobot($arr[$keys[116]]);
        if (array_key_exists($keys[117], $arr)) $this->setUser($arr[$keys[117]]);
        if (array_key_exists($keys[118], $arr)) $this->setTimeuser($arr[$keys[118]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RslicePeer::DATABASE_NAME);

        if ($this->isColumnModified(RslicePeer::NOMBRE_DEUDOR)) $criteria->add(RslicePeer::NOMBRE_DEUDOR, $this->nombre_deudor);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_DEUDOR)) $criteria->add(RslicePeer::DOMICILIO_DEUDOR, $this->domicilio_deudor);
        if ($this->isColumnModified(RslicePeer::COLONIA_DEUDOR)) $criteria->add(RslicePeer::COLONIA_DEUDOR, $this->colonia_deudor);
        if ($this->isColumnModified(RslicePeer::CIUDAD_DEUDOR)) $criteria->add(RslicePeer::CIUDAD_DEUDOR, $this->ciudad_deudor);
        if ($this->isColumnModified(RslicePeer::ESTADO_DEUDOR)) $criteria->add(RslicePeer::ESTADO_DEUDOR, $this->estado_deudor);
        if ($this->isColumnModified(RslicePeer::CP_DEUDOR)) $criteria->add(RslicePeer::CP_DEUDOR, $this->cp_deudor);
        if ($this->isColumnModified(RslicePeer::PLANO_GUIA_ROJI)) $criteria->add(RslicePeer::PLANO_GUIA_ROJI, $this->plano_guia_roji);
        if ($this->isColumnModified(RslicePeer::CUADRANTE_GUIA_ROJI)) $criteria->add(RslicePeer::CUADRANTE_GUIA_ROJI, $this->cuadrante_guia_roji);
        if ($this->isColumnModified(RslicePeer::TEL_1)) $criteria->add(RslicePeer::TEL_1, $this->tel_1);
        if ($this->isColumnModified(RslicePeer::TEL_2)) $criteria->add(RslicePeer::TEL_2, $this->tel_2);
        if ($this->isColumnModified(RslicePeer::TEL_3)) $criteria->add(RslicePeer::TEL_3, $this->tel_3);
        if ($this->isColumnModified(RslicePeer::TEL_4)) $criteria->add(RslicePeer::TEL_4, $this->tel_4);
        if ($this->isColumnModified(RslicePeer::NOMBRE_DEUDOR_ALTERNO)) $criteria->add(RslicePeer::NOMBRE_DEUDOR_ALTERNO, $this->nombre_deudor_alterno);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_DEUDOR_ALTERNO)) $criteria->add(RslicePeer::DOMICILIO_DEUDOR_ALTERNO, $this->domicilio_deudor_alterno);
        if ($this->isColumnModified(RslicePeer::COLONIA_DEUDOR_ALTERNO)) $criteria->add(RslicePeer::COLONIA_DEUDOR_ALTERNO, $this->colonia_deudor_alterno);
        if ($this->isColumnModified(RslicePeer::CIUDAD_DEUDOR_ALTERNO)) $criteria->add(RslicePeer::CIUDAD_DEUDOR_ALTERNO, $this->ciudad_deudor_alterno);
        if ($this->isColumnModified(RslicePeer::ESTADO_DEUDOR_ALTERNO)) $criteria->add(RslicePeer::ESTADO_DEUDOR_ALTERNO, $this->estado_deudor_alterno);
        if ($this->isColumnModified(RslicePeer::CP_DEUDOR_ATERNO)) $criteria->add(RslicePeer::CP_DEUDOR_ATERNO, $this->cp_deudor_aterno);
        if ($this->isColumnModified(RslicePeer::TEL_1_ALTERNO)) $criteria->add(RslicePeer::TEL_1_ALTERNO, $this->tel_1_alterno);
        if ($this->isColumnModified(RslicePeer::TEL_2_ALTERNO)) $criteria->add(RslicePeer::TEL_2_ALTERNO, $this->tel_2_alterno);
        if ($this->isColumnModified(RslicePeer::TEL_3_ALTERNO)) $criteria->add(RslicePeer::TEL_3_ALTERNO, $this->tel_3_alterno);
        if ($this->isColumnModified(RslicePeer::TEL_4_ALTERNO)) $criteria->add(RslicePeer::TEL_4_ALTERNO, $this->tel_4_alterno);
        if ($this->isColumnModified(RslicePeer::PLANO_GUIA_ROJI_ALTERNO)) $criteria->add(RslicePeer::PLANO_GUIA_ROJI_ALTERNO, $this->plano_guia_roji_alterno);
        if ($this->isColumnModified(RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO)) $criteria->add(RslicePeer::CUADRANTE_GUIA_ROJI_ALTERNO, $this->cuadrante_guia_roji_alterno);
        if ($this->isColumnModified(RslicePeer::STATUS_AARSA)) $criteria->add(RslicePeer::STATUS_AARSA, $this->status_aarsa);
        if ($this->isColumnModified(RslicePeer::SUCURSAL_CLIENTE)) $criteria->add(RslicePeer::SUCURSAL_CLIENTE, $this->sucursal_cliente);
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_1)) $criteria->add(RslicePeer::PARENTESCO_REF_1, $this->parentesco_ref_1);
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_1)) $criteria->add(RslicePeer::NOMBRE_REFERENCIA_1, $this->nombre_referencia_1);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_1)) $criteria->add(RslicePeer::DOMICILIO_REFERENCIA_1, $this->domicilio_referencia_1);
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_1)) $criteria->add(RslicePeer::COLONIA_REFERENCIA_1, $this->colonia_referencia_1);
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_1)) $criteria->add(RslicePeer::CIUDAD_REFERENCIA_1, $this->ciudad_referencia_1);
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_1)) $criteria->add(RslicePeer::ESTADO_REFERENCIA_1, $this->estado_referencia_1);
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_1)) $criteria->add(RslicePeer::CP_REFERENCIA_1, $this->cp_referencia_1);
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_1)) $criteria->add(RslicePeer::TEL_1_REF_1, $this->tel_1_ref_1);
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_1)) $criteria->add(RslicePeer::TEL_2_REF_1, $this->tel_2_ref_1);
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_2)) $criteria->add(RslicePeer::PARENTESCO_REF_2, $this->parentesco_ref_2);
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_2)) $criteria->add(RslicePeer::NOMBRE_REFERENCIA_2, $this->nombre_referencia_2);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_2)) $criteria->add(RslicePeer::DOMICILIO_REFERENCIA_2, $this->domicilio_referencia_2);
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_2)) $criteria->add(RslicePeer::COLONIA_REFERENCIA_2, $this->colonia_referencia_2);
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_2)) $criteria->add(RslicePeer::CIUDAD_REFERENCIA_2, $this->ciudad_referencia_2);
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_2)) $criteria->add(RslicePeer::ESTADO_REFERENCIA_2, $this->estado_referencia_2);
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_2)) $criteria->add(RslicePeer::CP_REFERENCIA_2, $this->cp_referencia_2);
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_2)) $criteria->add(RslicePeer::TEL_1_REF_2, $this->tel_1_ref_2);
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_2)) $criteria->add(RslicePeer::TEL_2_REF_2, $this->tel_2_ref_2);
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_3)) $criteria->add(RslicePeer::PARENTESCO_REF_3, $this->parentesco_ref_3);
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_3)) $criteria->add(RslicePeer::NOMBRE_REFERENCIA_3, $this->nombre_referencia_3);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_3)) $criteria->add(RslicePeer::DOMICILIO_REFERENCIA_3, $this->domicilio_referencia_3);
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_3)) $criteria->add(RslicePeer::COLONIA_REFERENCIA_3, $this->colonia_referencia_3);
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_3)) $criteria->add(RslicePeer::CIUDAD_REFERENCIA_3, $this->ciudad_referencia_3);
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_3)) $criteria->add(RslicePeer::ESTADO_REFERENCIA_3, $this->estado_referencia_3);
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_3)) $criteria->add(RslicePeer::CP_REFERENCIA_3, $this->cp_referencia_3);
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_3)) $criteria->add(RslicePeer::TEL_1_REF_3, $this->tel_1_ref_3);
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_3)) $criteria->add(RslicePeer::TEL_2_REF_3, $this->tel_2_ref_3);
        if ($this->isColumnModified(RslicePeer::PARENTESCO_REF_4)) $criteria->add(RslicePeer::PARENTESCO_REF_4, $this->parentesco_ref_4);
        if ($this->isColumnModified(RslicePeer::NOMBRE_REFERENCIA_4)) $criteria->add(RslicePeer::NOMBRE_REFERENCIA_4, $this->nombre_referencia_4);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_REFERENCIA_4)) $criteria->add(RslicePeer::DOMICILIO_REFERENCIA_4, $this->domicilio_referencia_4);
        if ($this->isColumnModified(RslicePeer::COLONIA_REFERENCIA_4)) $criteria->add(RslicePeer::COLONIA_REFERENCIA_4, $this->colonia_referencia_4);
        if ($this->isColumnModified(RslicePeer::CIUDAD_REFERENCIA_4)) $criteria->add(RslicePeer::CIUDAD_REFERENCIA_4, $this->ciudad_referencia_4);
        if ($this->isColumnModified(RslicePeer::ESTADO_REFERENCIA_4)) $criteria->add(RslicePeer::ESTADO_REFERENCIA_4, $this->estado_referencia_4);
        if ($this->isColumnModified(RslicePeer::CP_REFERENCIA_4)) $criteria->add(RslicePeer::CP_REFERENCIA_4, $this->cp_referencia_4);
        if ($this->isColumnModified(RslicePeer::TEL_1_REF_4)) $criteria->add(RslicePeer::TEL_1_REF_4, $this->tel_1_ref_4);
        if ($this->isColumnModified(RslicePeer::TEL_2_REF_4)) $criteria->add(RslicePeer::TEL_2_REF_4, $this->tel_2_ref_4);
        if ($this->isColumnModified(RslicePeer::DOMICILIO_LABORAL)) $criteria->add(RslicePeer::DOMICILIO_LABORAL, $this->domicilio_laboral);
        if ($this->isColumnModified(RslicePeer::COLONIA_LABORAL)) $criteria->add(RslicePeer::COLONIA_LABORAL, $this->colonia_laboral);
        if ($this->isColumnModified(RslicePeer::CIUDAD_LABORAL)) $criteria->add(RslicePeer::CIUDAD_LABORAL, $this->ciudad_laboral);
        if ($this->isColumnModified(RslicePeer::ESTADO_LABORAL)) $criteria->add(RslicePeer::ESTADO_LABORAL, $this->estado_laboral);
        if ($this->isColumnModified(RslicePeer::CP_LABORAL)) $criteria->add(RslicePeer::CP_LABORAL, $this->cp_laboral);
        if ($this->isColumnModified(RslicePeer::TEL_1_LABORAL)) $criteria->add(RslicePeer::TEL_1_LABORAL, $this->tel_1_laboral);
        if ($this->isColumnModified(RslicePeer::TEL_2_LABORAL)) $criteria->add(RslicePeer::TEL_2_LABORAL, $this->tel_2_laboral);
        if ($this->isColumnModified(RslicePeer::SALDO_CORRIENTE)) $criteria->add(RslicePeer::SALDO_CORRIENTE, $this->saldo_corriente);
        if ($this->isColumnModified(RslicePeer::FECHA_DE_ACTUALIZACION)) $criteria->add(RslicePeer::FECHA_DE_ACTUALIZACION, $this->fecha_de_actualizacion);
        if ($this->isColumnModified(RslicePeer::NUMERO_DE_CUENTA)) $criteria->add(RslicePeer::NUMERO_DE_CUENTA, $this->numero_de_cuenta);
        if ($this->isColumnModified(RslicePeer::NUMERO_DE_CREDITO)) $criteria->add(RslicePeer::NUMERO_DE_CREDITO, $this->numero_de_credito);
        if ($this->isColumnModified(RslicePeer::CONTRATO)) $criteria->add(RslicePeer::CONTRATO, $this->contrato);
        if ($this->isColumnModified(RslicePeer::SALDO_TOTAL)) $criteria->add(RslicePeer::SALDO_TOTAL, $this->saldo_total);
        if ($this->isColumnModified(RslicePeer::SALDO_VENCIDO)) $criteria->add(RslicePeer::SALDO_VENCIDO, $this->saldo_vencido);
        if ($this->isColumnModified(RslicePeer::SALDO_DESCUENTO_1)) $criteria->add(RslicePeer::SALDO_DESCUENTO_1, $this->saldo_descuento_1);
        if ($this->isColumnModified(RslicePeer::SALDO_DESCUENTO_2)) $criteria->add(RslicePeer::SALDO_DESCUENTO_2, $this->saldo_descuento_2);
        if ($this->isColumnModified(RslicePeer::FECHA_CORTE)) $criteria->add(RslicePeer::FECHA_CORTE, $this->fecha_corte);
        if ($this->isColumnModified(RslicePeer::FECHA_LIMITE)) $criteria->add(RslicePeer::FECHA_LIMITE, $this->fecha_limite);
        if ($this->isColumnModified(RslicePeer::FECHA_DE_ULTIMO_PAGO)) $criteria->add(RslicePeer::FECHA_DE_ULTIMO_PAGO, $this->fecha_de_ultimo_pago);
        if ($this->isColumnModified(RslicePeer::MONTO_ULTIMO_PAGO)) $criteria->add(RslicePeer::MONTO_ULTIMO_PAGO, $this->monto_ultimo_pago);
        if ($this->isColumnModified(RslicePeer::PRODUCTO)) $criteria->add(RslicePeer::PRODUCTO, $this->producto);
        if ($this->isColumnModified(RslicePeer::SUBPRODUCTO)) $criteria->add(RslicePeer::SUBPRODUCTO, $this->subproducto);
        if ($this->isColumnModified(RslicePeer::CLIENTE)) $criteria->add(RslicePeer::CLIENTE, $this->cliente);
        if ($this->isColumnModified(RslicePeer::STATUS_DE_CREDITO)) $criteria->add(RslicePeer::STATUS_DE_CREDITO, $this->status_de_credito);
        if ($this->isColumnModified(RslicePeer::PAGOS_VENCIDOS)) $criteria->add(RslicePeer::PAGOS_VENCIDOS, $this->pagos_vencidos);
        if ($this->isColumnModified(RslicePeer::MONTO_ADEUDADO)) $criteria->add(RslicePeer::MONTO_ADEUDADO, $this->monto_adeudado);
        if ($this->isColumnModified(RslicePeer::FECHA_DE_ASIGNACION)) $criteria->add(RslicePeer::FECHA_DE_ASIGNACION, $this->fecha_de_asignacion);
        if ($this->isColumnModified(RslicePeer::FECHA_DE_DEASIGNACION)) $criteria->add(RslicePeer::FECHA_DE_DEASIGNACION, $this->fecha_de_deasignacion);
        if ($this->isColumnModified(RslicePeer::CUENTA_CONCENTRADORA_1)) $criteria->add(RslicePeer::CUENTA_CONCENTRADORA_1, $this->cuenta_concentradora_1);
        if ($this->isColumnModified(RslicePeer::SALDO_CUOTA)) $criteria->add(RslicePeer::SALDO_CUOTA, $this->saldo_cuota);
        if ($this->isColumnModified(RslicePeer::EMAIL_DEUDOR)) $criteria->add(RslicePeer::EMAIL_DEUDOR, $this->email_deudor);
        if ($this->isColumnModified(RslicePeer::ID_CUENTA)) $criteria->add(RslicePeer::ID_CUENTA, $this->id_cuenta);
        if ($this->isColumnModified(RslicePeer::PAGO_PACTADO)) $criteria->add(RslicePeer::PAGO_PACTADO, $this->pago_pactado);
        if ($this->isColumnModified(RslicePeer::RFC_DEUDOR)) $criteria->add(RslicePeer::RFC_DEUDOR, $this->rfc_deudor);
        if ($this->isColumnModified(RslicePeer::TELEFONOS_MARCADOS)) $criteria->add(RslicePeer::TELEFONOS_MARCADOS, $this->telefonos_marcados);
        if ($this->isColumnModified(RslicePeer::TEL_1_VERIF)) $criteria->add(RslicePeer::TEL_1_VERIF, $this->tel_1_verif);
        if ($this->isColumnModified(RslicePeer::TEL_2_VERIF)) $criteria->add(RslicePeer::TEL_2_VERIF, $this->tel_2_verif);
        if ($this->isColumnModified(RslicePeer::TEL_3_VERIF)) $criteria->add(RslicePeer::TEL_3_VERIF, $this->tel_3_verif);
        if ($this->isColumnModified(RslicePeer::TEL_4_VERIF)) $criteria->add(RslicePeer::TEL_4_VERIF, $this->tel_4_verif);
        if ($this->isColumnModified(RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO)) $criteria->add(RslicePeer::TELEFONO_DE_ULTIMO_CONTACTO, $this->telefono_de_ultimo_contacto);
        if ($this->isColumnModified(RslicePeer::DIAS_VENCIDOS)) $criteria->add(RslicePeer::DIAS_VENCIDOS, $this->dias_vencidos);
        if ($this->isColumnModified(RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER)) $criteria->add(RslicePeer::EJECUTIVO_ASIGNADO_CALL_CENTER, $this->ejecutivo_asignado_call_center);
        if ($this->isColumnModified(RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO)) $criteria->add(RslicePeer::EJECUTIVO_ASIGNADO_DOMICILIARIO, $this->ejecutivo_asignado_domiciliario);
        if ($this->isColumnModified(RslicePeer::PRIORIDAD_DE_GESTION)) $criteria->add(RslicePeer::PRIORIDAD_DE_GESTION, $this->prioridad_de_gestion);
        if ($this->isColumnModified(RslicePeer::REGION_AARSA)) $criteria->add(RslicePeer::REGION_AARSA, $this->region_aarsa);
        if ($this->isColumnModified(RslicePeer::PARENTESCO_AVAL)) $criteria->add(RslicePeer::PARENTESCO_AVAL, $this->parentesco_aval);
        if ($this->isColumnModified(RslicePeer::LOCALIZAR)) $criteria->add(RslicePeer::LOCALIZAR, $this->localizar);
        if ($this->isColumnModified(RslicePeer::FECHA_ULTIMA_GESTION)) $criteria->add(RslicePeer::FECHA_ULTIMA_GESTION, $this->fecha_ultima_gestion);
        if ($this->isColumnModified(RslicePeer::EMPRESA)) $criteria->add(RslicePeer::EMPRESA, $this->empresa);
        if ($this->isColumnModified(RslicePeer::TIMELOCK)) $criteria->add(RslicePeer::TIMELOCK, $this->timelock);
        if ($this->isColumnModified(RslicePeer::LOCKER)) $criteria->add(RslicePeer::LOCKER, $this->locker);
        if ($this->isColumnModified(RslicePeer::FECHA_DE_VENTA)) $criteria->add(RslicePeer::FECHA_DE_VENTA, $this->fecha_de_venta);
        if ($this->isColumnModified(RslicePeer::ESPECIAL)) $criteria->add(RslicePeer::ESPECIAL, $this->especial);
        if ($this->isColumnModified(RslicePeer::DIRECCION_NUEVA)) $criteria->add(RslicePeer::DIRECCION_NUEVA, $this->direccion_nueva);
        if ($this->isColumnModified(RslicePeer::NOROBOT)) $criteria->add(RslicePeer::NOROBOT, $this->norobot);
        if ($this->isColumnModified(RslicePeer::USER)) $criteria->add(RslicePeer::USER, $this->user);
        if ($this->isColumnModified(RslicePeer::TIMEUSER)) $criteria->add(RslicePeer::TIMEUSER, $this->timeuser);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(RslicePeer::DATABASE_NAME);
        $criteria->add(RslicePeer::ID_CUENTA, $this->id_cuenta);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdCuenta();
    }

    /**
     * Generic method to set the primary key (id_cuenta column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdCuenta($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdCuenta();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Rslice (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombreDeudor($this->getNombreDeudor());
        $copyObj->setDomicilioDeudor($this->getDomicilioDeudor());
        $copyObj->setColoniaDeudor($this->getColoniaDeudor());
        $copyObj->setCiudadDeudor($this->getCiudadDeudor());
        $copyObj->setEstadoDeudor($this->getEstadoDeudor());
        $copyObj->setCpDeudor($this->getCpDeudor());
        $copyObj->setPlanoGuiaRoji($this->getPlanoGuiaRoji());
        $copyObj->setCuadranteGuiaRoji($this->getCuadranteGuiaRoji());
        $copyObj->setTel1($this->getTel1());
        $copyObj->setTel2($this->getTel2());
        $copyObj->setTel3($this->getTel3());
        $copyObj->setTel4($this->getTel4());
        $copyObj->setNombreDeudorAlterno($this->getNombreDeudorAlterno());
        $copyObj->setDomicilioDeudorAlterno($this->getDomicilioDeudorAlterno());
        $copyObj->setColoniaDeudorAlterno($this->getColoniaDeudorAlterno());
        $copyObj->setCiudadDeudorAlterno($this->getCiudadDeudorAlterno());
        $copyObj->setEstadoDeudorAlterno($this->getEstadoDeudorAlterno());
        $copyObj->setCpDeudorAterno($this->getCpDeudorAterno());
        $copyObj->setTel1Alterno($this->getTel1Alterno());
        $copyObj->setTel2Alterno($this->getTel2Alterno());
        $copyObj->setTel3Alterno($this->getTel3Alterno());
        $copyObj->setTel4Alterno($this->getTel4Alterno());
        $copyObj->setPlanoGuiaRojiAlterno($this->getPlanoGuiaRojiAlterno());
        $copyObj->setCuadranteGuiaRojiAlterno($this->getCuadranteGuiaRojiAlterno());
        $copyObj->setStatusAarsa($this->getStatusAarsa());
        $copyObj->setSucursalCliente($this->getSucursalCliente());
        $copyObj->setParentescoRef1($this->getParentescoRef1());
        $copyObj->setNombreReferencia1($this->getNombreReferencia1());
        $copyObj->setDomicilioReferencia1($this->getDomicilioReferencia1());
        $copyObj->setColoniaReferencia1($this->getColoniaReferencia1());
        $copyObj->setCiudadReferencia1($this->getCiudadReferencia1());
        $copyObj->setEstadoReferencia1($this->getEstadoReferencia1());
        $copyObj->setCpReferencia1($this->getCpReferencia1());
        $copyObj->setTel1Ref1($this->getTel1Ref1());
        $copyObj->setTel2Ref1($this->getTel2Ref1());
        $copyObj->setParentescoRef2($this->getParentescoRef2());
        $copyObj->setNombreReferencia2($this->getNombreReferencia2());
        $copyObj->setDomicilioReferencia2($this->getDomicilioReferencia2());
        $copyObj->setColoniaReferencia2($this->getColoniaReferencia2());
        $copyObj->setCiudadReferencia2($this->getCiudadReferencia2());
        $copyObj->setEstadoReferencia2($this->getEstadoReferencia2());
        $copyObj->setCpReferencia2($this->getCpReferencia2());
        $copyObj->setTel1Ref2($this->getTel1Ref2());
        $copyObj->setTel2Ref2($this->getTel2Ref2());
        $copyObj->setParentescoRef3($this->getParentescoRef3());
        $copyObj->setNombreReferencia3($this->getNombreReferencia3());
        $copyObj->setDomicilioReferencia3($this->getDomicilioReferencia3());
        $copyObj->setColoniaReferencia3($this->getColoniaReferencia3());
        $copyObj->setCiudadReferencia3($this->getCiudadReferencia3());
        $copyObj->setEstadoReferencia3($this->getEstadoReferencia3());
        $copyObj->setCpReferencia3($this->getCpReferencia3());
        $copyObj->setTel1Ref3($this->getTel1Ref3());
        $copyObj->setTel2Ref3($this->getTel2Ref3());
        $copyObj->setParentescoRef4($this->getParentescoRef4());
        $copyObj->setNombreReferencia4($this->getNombreReferencia4());
        $copyObj->setDomicilioReferencia4($this->getDomicilioReferencia4());
        $copyObj->setColoniaReferencia4($this->getColoniaReferencia4());
        $copyObj->setCiudadReferencia4($this->getCiudadReferencia4());
        $copyObj->setEstadoReferencia4($this->getEstadoReferencia4());
        $copyObj->setCpReferencia4($this->getCpReferencia4());
        $copyObj->setTel1Ref4($this->getTel1Ref4());
        $copyObj->setTel2Ref4($this->getTel2Ref4());
        $copyObj->setDomicilioLaboral($this->getDomicilioLaboral());
        $copyObj->setColoniaLaboral($this->getColoniaLaboral());
        $copyObj->setCiudadLaboral($this->getCiudadLaboral());
        $copyObj->setEstadoLaboral($this->getEstadoLaboral());
        $copyObj->setCpLaboral($this->getCpLaboral());
        $copyObj->setTel1Laboral($this->getTel1Laboral());
        $copyObj->setTel2Laboral($this->getTel2Laboral());
        $copyObj->setSaldoCorriente($this->getSaldoCorriente());
        $copyObj->setFechaDeActualizacion($this->getFechaDeActualizacion());
        $copyObj->setNumeroDeCuenta($this->getNumeroDeCuenta());
        $copyObj->setNumeroDeCredito($this->getNumeroDeCredito());
        $copyObj->setContrato($this->getContrato());
        $copyObj->setSaldoTotal($this->getSaldoTotal());
        $copyObj->setSaldoVencido($this->getSaldoVencido());
        $copyObj->setSaldoDescuento1($this->getSaldoDescuento1());
        $copyObj->setSaldoDescuento2($this->getSaldoDescuento2());
        $copyObj->setFechaCorte($this->getFechaCorte());
        $copyObj->setFechaLimite($this->getFechaLimite());
        $copyObj->setFechaDeUltimoPago($this->getFechaDeUltimoPago());
        $copyObj->setMontoUltimoPago($this->getMontoUltimoPago());
        $copyObj->setProducto($this->getProducto());
        $copyObj->setSubproducto($this->getSubproducto());
        $copyObj->setCliente($this->getCliente());
        $copyObj->setStatusDeCredito($this->getStatusDeCredito());
        $copyObj->setPagosVencidos($this->getPagosVencidos());
        $copyObj->setMontoAdeudado($this->getMontoAdeudado());
        $copyObj->setFechaDeAsignacion($this->getFechaDeAsignacion());
        $copyObj->setFechaDeDeasignacion($this->getFechaDeDeasignacion());
        $copyObj->setCuentaConcentradora1($this->getCuentaConcentradora1());
        $copyObj->setSaldoCuota($this->getSaldoCuota());
        $copyObj->setEmailDeudor($this->getEmailDeudor());
        $copyObj->setPagoPactado($this->getPagoPactado());
        $copyObj->setRfcDeudor($this->getRfcDeudor());
        $copyObj->setTelefonosMarcados($this->getTelefonosMarcados());
        $copyObj->setTel1Verif($this->getTel1Verif());
        $copyObj->setTel2Verif($this->getTel2Verif());
        $copyObj->setTel3Verif($this->getTel3Verif());
        $copyObj->setTel4Verif($this->getTel4Verif());
        $copyObj->setTelefonoDeUltimoContacto($this->getTelefonoDeUltimoContacto());
        $copyObj->setDiasVencidos($this->getDiasVencidos());
        $copyObj->setEjecutivoAsignadoCallCenter($this->getEjecutivoAsignadoCallCenter());
        $copyObj->setEjecutivoAsignadoDomiciliario($this->getEjecutivoAsignadoDomiciliario());
        $copyObj->setPrioridadDeGestion($this->getPrioridadDeGestion());
        $copyObj->setRegionAarsa($this->getRegionAarsa());
        $copyObj->setParentescoAval($this->getParentescoAval());
        $copyObj->setLocalizar($this->getLocalizar());
        $copyObj->setFechaUltimaGestion($this->getFechaUltimaGestion());
        $copyObj->setEmpresa($this->getEmpresa());
        $copyObj->setTimelock($this->getTimelock());
        $copyObj->setLocker($this->getLocker());
        $copyObj->setFechaDeVenta($this->getFechaDeVenta());
        $copyObj->setEspecial($this->getEspecial());
        $copyObj->setDireccionNueva($this->getDireccionNueva());
        $copyObj->setNorobot($this->getNorobot());
        $copyObj->setUser($this->getUser());
        $copyObj->setTimeuser($this->getTimeuser());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCuenta(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Rslice Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return RslicePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new RslicePeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->nombre_deudor = null;
        $this->domicilio_deudor = null;
        $this->colonia_deudor = null;
        $this->ciudad_deudor = null;
        $this->estado_deudor = null;
        $this->cp_deudor = null;
        $this->plano_guia_roji = null;
        $this->cuadrante_guia_roji = null;
        $this->tel_1 = null;
        $this->tel_2 = null;
        $this->tel_3 = null;
        $this->tel_4 = null;
        $this->nombre_deudor_alterno = null;
        $this->domicilio_deudor_alterno = null;
        $this->colonia_deudor_alterno = null;
        $this->ciudad_deudor_alterno = null;
        $this->estado_deudor_alterno = null;
        $this->cp_deudor_aterno = null;
        $this->tel_1_alterno = null;
        $this->tel_2_alterno = null;
        $this->tel_3_alterno = null;
        $this->tel_4_alterno = null;
        $this->plano_guia_roji_alterno = null;
        $this->cuadrante_guia_roji_alterno = null;
        $this->status_aarsa = null;
        $this->sucursal_cliente = null;
        $this->parentesco_ref_1 = null;
        $this->nombre_referencia_1 = null;
        $this->domicilio_referencia_1 = null;
        $this->colonia_referencia_1 = null;
        $this->ciudad_referencia_1 = null;
        $this->estado_referencia_1 = null;
        $this->cp_referencia_1 = null;
        $this->tel_1_ref_1 = null;
        $this->tel_2_ref_1 = null;
        $this->parentesco_ref_2 = null;
        $this->nombre_referencia_2 = null;
        $this->domicilio_referencia_2 = null;
        $this->colonia_referencia_2 = null;
        $this->ciudad_referencia_2 = null;
        $this->estado_referencia_2 = null;
        $this->cp_referencia_2 = null;
        $this->tel_1_ref_2 = null;
        $this->tel_2_ref_2 = null;
        $this->parentesco_ref_3 = null;
        $this->nombre_referencia_3 = null;
        $this->domicilio_referencia_3 = null;
        $this->colonia_referencia_3 = null;
        $this->ciudad_referencia_3 = null;
        $this->estado_referencia_3 = null;
        $this->cp_referencia_3 = null;
        $this->tel_1_ref_3 = null;
        $this->tel_2_ref_3 = null;
        $this->parentesco_ref_4 = null;
        $this->nombre_referencia_4 = null;
        $this->domicilio_referencia_4 = null;
        $this->colonia_referencia_4 = null;
        $this->ciudad_referencia_4 = null;
        $this->estado_referencia_4 = null;
        $this->cp_referencia_4 = null;
        $this->tel_1_ref_4 = null;
        $this->tel_2_ref_4 = null;
        $this->domicilio_laboral = null;
        $this->colonia_laboral = null;
        $this->ciudad_laboral = null;
        $this->estado_laboral = null;
        $this->cp_laboral = null;
        $this->tel_1_laboral = null;
        $this->tel_2_laboral = null;
        $this->saldo_corriente = null;
        $this->fecha_de_actualizacion = null;
        $this->numero_de_cuenta = null;
        $this->numero_de_credito = null;
        $this->contrato = null;
        $this->saldo_total = null;
        $this->saldo_vencido = null;
        $this->saldo_descuento_1 = null;
        $this->saldo_descuento_2 = null;
        $this->fecha_corte = null;
        $this->fecha_limite = null;
        $this->fecha_de_ultimo_pago = null;
        $this->monto_ultimo_pago = null;
        $this->producto = null;
        $this->subproducto = null;
        $this->cliente = null;
        $this->status_de_credito = null;
        $this->pagos_vencidos = null;
        $this->monto_adeudado = null;
        $this->fecha_de_asignacion = null;
        $this->fecha_de_deasignacion = null;
        $this->cuenta_concentradora_1 = null;
        $this->saldo_cuota = null;
        $this->email_deudor = null;
        $this->id_cuenta = null;
        $this->pago_pactado = null;
        $this->rfc_deudor = null;
        $this->telefonos_marcados = null;
        $this->tel_1_verif = null;
        $this->tel_2_verif = null;
        $this->tel_3_verif = null;
        $this->tel_4_verif = null;
        $this->telefono_de_ultimo_contacto = null;
        $this->dias_vencidos = null;
        $this->ejecutivo_asignado_call_center = null;
        $this->ejecutivo_asignado_domiciliario = null;
        $this->prioridad_de_gestion = null;
        $this->region_aarsa = null;
        $this->parentesco_aval = null;
        $this->localizar = null;
        $this->fecha_ultima_gestion = null;
        $this->empresa = null;
        $this->timelock = null;
        $this->locker = null;
        $this->fecha_de_venta = null;
        $this->especial = null;
        $this->direccion_nueva = null;
        $this->norobot = null;
        $this->user = null;
        $this->timeuser = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RslicePeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
