<?php


/**
 * Base class that represents a row from the 'rlook' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseRlook extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'RlookPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        RlookPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_cuenta field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $id_cuenta;

    /**
     * The value for the numero_de_cuenta field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $numero_de_cuenta;

    /**
     * The value for the nombre_deudor field.
     * @var        string
     */
    protected $nombre_deudor;

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
     * The value for the nombre_referencia_1 field.
     * @var        string
     */
    protected $nombre_referencia_1;

    /**
     * The value for the nombre_referencia_2 field.
     * @var        string
     */
    protected $nombre_referencia_2;

    /**
     * The value for the nombre_referencia_3 field.
     * @var        string
     */
    protected $nombre_referencia_3;

    /**
     * The value for the nombre_referencia_4 field.
     * @var        string
     */
    protected $nombre_referencia_4;

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
     * The value for the telefonos_marcados field.
     * @var        string
     */
    protected $telefonos_marcados;

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
        $this->id_cuenta = 0;
        $this->numero_de_cuenta = '0';
    }

    /**
     * Initializes internal state of BaseRlook object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
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
     * Get the [numero_de_cuenta] column value.
     *
     * @return string
     */
    public function getNumeroDeCuenta()
    {
        return $this->numero_de_cuenta;
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
     * Get the [nombre_referencia_1] column value.
     *
     * @return string
     */
    public function getNombreReferencia1()
    {
        return $this->nombre_referencia_1;
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
     * Get the [nombre_referencia_3] column value.
     *
     * @return string
     */
    public function getNombreReferencia3()
    {
        return $this->nombre_referencia_3;
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
     * Get the [telefonos_marcados] column value.
     *
     * @return string
     */
    public function getTelefonosMarcados()
    {
        return $this->telefonos_marcados;
    }

    /**
     * Set the value of [id_cuenta] column.
     *
     * @param int $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setIdCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_cuenta !== $v) {
            $this->id_cuenta = $v;
            $this->modifiedColumns[] = RlookPeer::ID_CUENTA;
        }


        return $this;
    } // setIdCuenta()

    /**
     * Set the value of [numero_de_cuenta] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setNumeroDeCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->numero_de_cuenta !== $v) {
            $this->numero_de_cuenta = $v;
            $this->modifiedColumns[] = RlookPeer::NUMERO_DE_CUENTA;
        }


        return $this;
    } // setNumeroDeCuenta()

    /**
     * Set the value of [nombre_deudor] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setNombreDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_deudor !== $v) {
            $this->nombre_deudor = $v;
            $this->modifiedColumns[] = RlookPeer::NOMBRE_DEUDOR;
        }


        return $this;
    } // setNombreDeudor()

    /**
     * Set the value of [cliente] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setCliente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cliente !== $v) {
            $this->cliente = $v;
            $this->modifiedColumns[] = RlookPeer::CLIENTE;
        }


        return $this;
    } // setCliente()

    /**
     * Set the value of [status_de_credito] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setStatusDeCredito($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->status_de_credito !== $v) {
            $this->status_de_credito = $v;
            $this->modifiedColumns[] = RlookPeer::STATUS_DE_CREDITO;
        }


        return $this;
    } // setStatusDeCredito()

    /**
     * Set the value of [nombre_referencia_1] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setNombreReferencia1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_1 !== $v) {
            $this->nombre_referencia_1 = $v;
            $this->modifiedColumns[] = RlookPeer::NOMBRE_REFERENCIA_1;
        }


        return $this;
    } // setNombreReferencia1()

    /**
     * Set the value of [nombre_referencia_2] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setNombreReferencia2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_2 !== $v) {
            $this->nombre_referencia_2 = $v;
            $this->modifiedColumns[] = RlookPeer::NOMBRE_REFERENCIA_2;
        }


        return $this;
    } // setNombreReferencia2()

    /**
     * Set the value of [nombre_referencia_3] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setNombreReferencia3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_3 !== $v) {
            $this->nombre_referencia_3 = $v;
            $this->modifiedColumns[] = RlookPeer::NOMBRE_REFERENCIA_3;
        }


        return $this;
    } // setNombreReferencia3()

    /**
     * Set the value of [nombre_referencia_4] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setNombreReferencia4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_referencia_4 !== $v) {
            $this->nombre_referencia_4 = $v;
            $this->modifiedColumns[] = RlookPeer::NOMBRE_REFERENCIA_4;
        }


        return $this;
    } // setNombreReferencia4()

    /**
     * Set the value of [tel_1] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1 !== $v) {
            $this->tel_1 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1;
        }


        return $this;
    } // setTel1()

    /**
     * Set the value of [tel_2] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2 !== $v) {
            $this->tel_2 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2;
        }


        return $this;
    } // setTel2()

    /**
     * Set the value of [tel_3] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_3 !== $v) {
            $this->tel_3 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_3;
        }


        return $this;
    } // setTel3()

    /**
     * Set the value of [tel_4] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_4 !== $v) {
            $this->tel_4 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_4;
        }


        return $this;
    } // setTel4()

    /**
     * Set the value of [tel_1_alterno] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_alterno !== $v) {
            $this->tel_1_alterno = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_ALTERNO;
        }


        return $this;
    } // setTel1Alterno()

    /**
     * Set the value of [tel_2_alterno] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_alterno !== $v) {
            $this->tel_2_alterno = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_ALTERNO;
        }


        return $this;
    } // setTel2Alterno()

    /**
     * Set the value of [tel_3_alterno] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel3Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_3_alterno !== $v) {
            $this->tel_3_alterno = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_3_ALTERNO;
        }


        return $this;
    } // setTel3Alterno()

    /**
     * Set the value of [tel_4_alterno] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel4Alterno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_4_alterno !== $v) {
            $this->tel_4_alterno = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_4_ALTERNO;
        }


        return $this;
    } // setTel4Alterno()

    /**
     * Set the value of [tel_1_verif] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_verif !== $v) {
            $this->tel_1_verif = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_VERIF;
        }


        return $this;
    } // setTel1Verif()

    /**
     * Set the value of [tel_2_verif] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_verif !== $v) {
            $this->tel_2_verif = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_VERIF;
        }


        return $this;
    } // setTel2Verif()

    /**
     * Set the value of [tel_3_verif] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel3Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_3_verif !== $v) {
            $this->tel_3_verif = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_3_VERIF;
        }


        return $this;
    } // setTel3Verif()

    /**
     * Set the value of [tel_4_verif] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel4Verif($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_4_verif !== $v) {
            $this->tel_4_verif = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_4_VERIF;
        }


        return $this;
    } // setTel4Verif()

    /**
     * Set the value of [tel_1_ref_1] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Ref1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_1 !== $v) {
            $this->tel_1_ref_1 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_REF_1;
        }


        return $this;
    } // setTel1Ref1()

    /**
     * Set the value of [tel_2_ref_1] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Ref1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_1 !== $v) {
            $this->tel_2_ref_1 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_REF_1;
        }


        return $this;
    } // setTel2Ref1()

    /**
     * Set the value of [tel_1_ref_2] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Ref2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_2 !== $v) {
            $this->tel_1_ref_2 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_REF_2;
        }


        return $this;
    } // setTel1Ref2()

    /**
     * Set the value of [tel_2_ref_2] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Ref2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_2 !== $v) {
            $this->tel_2_ref_2 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_REF_2;
        }


        return $this;
    } // setTel2Ref2()

    /**
     * Set the value of [tel_1_ref_3] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Ref3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_3 !== $v) {
            $this->tel_1_ref_3 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_REF_3;
        }


        return $this;
    } // setTel1Ref3()

    /**
     * Set the value of [tel_2_ref_3] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Ref3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_3 !== $v) {
            $this->tel_2_ref_3 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_REF_3;
        }


        return $this;
    } // setTel2Ref3()

    /**
     * Set the value of [tel_1_ref_4] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Ref4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_ref_4 !== $v) {
            $this->tel_1_ref_4 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_REF_4;
        }


        return $this;
    } // setTel1Ref4()

    /**
     * Set the value of [tel_2_ref_4] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Ref4($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_ref_4 !== $v) {
            $this->tel_2_ref_4 = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_REF_4;
        }


        return $this;
    } // setTel2Ref4()

    /**
     * Set the value of [tel_1_laboral] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel1Laboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_1_laboral !== $v) {
            $this->tel_1_laboral = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_1_LABORAL;
        }


        return $this;
    } // setTel1Laboral()

    /**
     * Set the value of [tel_2_laboral] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTel2Laboral($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tel_2_laboral !== $v) {
            $this->tel_2_laboral = $v;
            $this->modifiedColumns[] = RlookPeer::TEL_2_LABORAL;
        }


        return $this;
    } // setTel2Laboral()

    /**
     * Set the value of [telefonos_marcados] column.
     *
     * @param string $v new value
     * @return Rlook The current object (for fluent API support)
     */
    public function setTelefonosMarcados($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->telefonos_marcados !== $v) {
            $this->telefonos_marcados = $v;
            $this->modifiedColumns[] = RlookPeer::TELEFONOS_MARCADOS;
        }


        return $this;
    } // setTelefonosMarcados()

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
            if ($this->id_cuenta !== 0) {
                return false;
            }

            if ($this->numero_de_cuenta !== '0') {
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

            $this->id_cuenta = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->numero_de_cuenta = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->nombre_deudor = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->cliente = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->status_de_credito = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->nombre_referencia_1 = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->nombre_referencia_2 = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->nombre_referencia_3 = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->nombre_referencia_4 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->tel_1 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->tel_2 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->tel_3 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->tel_4 = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->tel_1_alterno = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->tel_2_alterno = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->tel_3_alterno = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->tel_4_alterno = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->tel_1_verif = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->tel_2_verif = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->tel_3_verif = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->tel_4_verif = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->tel_1_ref_1 = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->tel_2_ref_1 = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->tel_1_ref_2 = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->tel_2_ref_2 = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
            $this->tel_1_ref_3 = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
            $this->tel_2_ref_3 = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->tel_1_ref_4 = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
            $this->tel_2_ref_4 = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
            $this->tel_1_laboral = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
            $this->tel_2_laboral = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
            $this->telefonos_marcados = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 32; // 32 = RlookPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Rlook object", $e);
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
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = RlookPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = RlookQuery::create()
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
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                RlookPeer::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RlookPeer::ID_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`id_cuenta`';
        }
        if ($this->isColumnModified(RlookPeer::NUMERO_DE_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`numero_de_cuenta`';
        }
        if ($this->isColumnModified(RlookPeer::NOMBRE_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_deudor`';
        }
        if ($this->isColumnModified(RlookPeer::CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = '`cliente`';
        }
        if ($this->isColumnModified(RlookPeer::STATUS_DE_CREDITO)) {
            $modifiedColumns[':p' . $index++]  = '`status_de_credito`';
        }
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_1)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_1`';
        }
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_2)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_2`';
        }
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_3)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_3`';
        }
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_4)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_referencia_4`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_3)) {
            $modifiedColumns[':p' . $index++]  = '`tel_3`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_4)) {
            $modifiedColumns[':p' . $index++]  = '`tel_4`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_alterno`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_alterno`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_3_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_3_alterno`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_4_ALTERNO)) {
            $modifiedColumns[':p' . $index++]  = '`tel_4_alterno`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_verif`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_verif`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_3_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_3_verif`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_4_VERIF)) {
            $modifiedColumns[':p' . $index++]  = '`tel_4_verif`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_1)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_1`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_1)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_1`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_2)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_2`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_2)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_2`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_3)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_3`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_3)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_3`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_4)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_ref_4`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_4)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_ref_4`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_1_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`tel_1_laboral`';
        }
        if ($this->isColumnModified(RlookPeer::TEL_2_LABORAL)) {
            $modifiedColumns[':p' . $index++]  = '`tel_2_laboral`';
        }
        if ($this->isColumnModified(RlookPeer::TELEFONOS_MARCADOS)) {
            $modifiedColumns[':p' . $index++]  = '`telefonos_marcados`';
        }

        $sql = sprintf(
            'INSERT INTO `rlook` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_cuenta`':
                        $stmt->bindValue($identifier, $this->id_cuenta, PDO::PARAM_INT);
                        break;
                    case '`numero_de_cuenta`':
                        $stmt->bindValue($identifier, $this->numero_de_cuenta, PDO::PARAM_STR);
                        break;
                    case '`nombre_deudor`':
                        $stmt->bindValue($identifier, $this->nombre_deudor, PDO::PARAM_STR);
                        break;
                    case '`cliente`':
                        $stmt->bindValue($identifier, $this->cliente, PDO::PARAM_STR);
                        break;
                    case '`status_de_credito`':
                        $stmt->bindValue($identifier, $this->status_de_credito, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_1`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_1, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_2`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_2, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_3`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_3, PDO::PARAM_STR);
                        break;
                    case '`nombre_referencia_4`':
                        $stmt->bindValue($identifier, $this->nombre_referencia_4, PDO::PARAM_STR);
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
                    case '`tel_1_ref_1`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_1, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_1`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_1, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_2`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_2, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_2`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_2, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_3`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_3, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_3`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_3, PDO::PARAM_STR);
                        break;
                    case '`tel_1_ref_4`':
                        $stmt->bindValue($identifier, $this->tel_1_ref_4, PDO::PARAM_STR);
                        break;
                    case '`tel_2_ref_4`':
                        $stmt->bindValue($identifier, $this->tel_2_ref_4, PDO::PARAM_STR);
                        break;
                    case '`tel_1_laboral`':
                        $stmt->bindValue($identifier, $this->tel_1_laboral, PDO::PARAM_STR);
                        break;
                    case '`tel_2_laboral`':
                        $stmt->bindValue($identifier, $this->tel_2_laboral, PDO::PARAM_STR);
                        break;
                    case '`telefonos_marcados`':
                        $stmt->bindValue($identifier, $this->telefonos_marcados, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

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


            if (($retval = RlookPeer::doValidate($this, $columns)) !== true) {
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
        $pos = RlookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIdCuenta();
                break;
            case 1:
                return $this->getNumeroDeCuenta();
                break;
            case 2:
                return $this->getNombreDeudor();
                break;
            case 3:
                return $this->getCliente();
                break;
            case 4:
                return $this->getStatusDeCredito();
                break;
            case 5:
                return $this->getNombreReferencia1();
                break;
            case 6:
                return $this->getNombreReferencia2();
                break;
            case 7:
                return $this->getNombreReferencia3();
                break;
            case 8:
                return $this->getNombreReferencia4();
                break;
            case 9:
                return $this->getTel1();
                break;
            case 10:
                return $this->getTel2();
                break;
            case 11:
                return $this->getTel3();
                break;
            case 12:
                return $this->getTel4();
                break;
            case 13:
                return $this->getTel1Alterno();
                break;
            case 14:
                return $this->getTel2Alterno();
                break;
            case 15:
                return $this->getTel3Alterno();
                break;
            case 16:
                return $this->getTel4Alterno();
                break;
            case 17:
                return $this->getTel1Verif();
                break;
            case 18:
                return $this->getTel2Verif();
                break;
            case 19:
                return $this->getTel3Verif();
                break;
            case 20:
                return $this->getTel4Verif();
                break;
            case 21:
                return $this->getTel1Ref1();
                break;
            case 22:
                return $this->getTel2Ref1();
                break;
            case 23:
                return $this->getTel1Ref2();
                break;
            case 24:
                return $this->getTel2Ref2();
                break;
            case 25:
                return $this->getTel1Ref3();
                break;
            case 26:
                return $this->getTel2Ref3();
                break;
            case 27:
                return $this->getTel1Ref4();
                break;
            case 28:
                return $this->getTel2Ref4();
                break;
            case 29:
                return $this->getTel1Laboral();
                break;
            case 30:
                return $this->getTel2Laboral();
                break;
            case 31:
                return $this->getTelefonosMarcados();
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
        if (isset($alreadyDumpedObjects['Rlook'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Rlook'][$this->getPrimaryKey()] = true;
        $keys = RlookPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdCuenta(),
            $keys[1] => $this->getNumeroDeCuenta(),
            $keys[2] => $this->getNombreDeudor(),
            $keys[3] => $this->getCliente(),
            $keys[4] => $this->getStatusDeCredito(),
            $keys[5] => $this->getNombreReferencia1(),
            $keys[6] => $this->getNombreReferencia2(),
            $keys[7] => $this->getNombreReferencia3(),
            $keys[8] => $this->getNombreReferencia4(),
            $keys[9] => $this->getTel1(),
            $keys[10] => $this->getTel2(),
            $keys[11] => $this->getTel3(),
            $keys[12] => $this->getTel4(),
            $keys[13] => $this->getTel1Alterno(),
            $keys[14] => $this->getTel2Alterno(),
            $keys[15] => $this->getTel3Alterno(),
            $keys[16] => $this->getTel4Alterno(),
            $keys[17] => $this->getTel1Verif(),
            $keys[18] => $this->getTel2Verif(),
            $keys[19] => $this->getTel3Verif(),
            $keys[20] => $this->getTel4Verif(),
            $keys[21] => $this->getTel1Ref1(),
            $keys[22] => $this->getTel2Ref1(),
            $keys[23] => $this->getTel1Ref2(),
            $keys[24] => $this->getTel2Ref2(),
            $keys[25] => $this->getTel1Ref3(),
            $keys[26] => $this->getTel2Ref3(),
            $keys[27] => $this->getTel1Ref4(),
            $keys[28] => $this->getTel2Ref4(),
            $keys[29] => $this->getTel1Laboral(),
            $keys[30] => $this->getTel2Laboral(),
            $keys[31] => $this->getTelefonosMarcados(),
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
        $pos = RlookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdCuenta($value);
                break;
            case 1:
                $this->setNumeroDeCuenta($value);
                break;
            case 2:
                $this->setNombreDeudor($value);
                break;
            case 3:
                $this->setCliente($value);
                break;
            case 4:
                $this->setStatusDeCredito($value);
                break;
            case 5:
                $this->setNombreReferencia1($value);
                break;
            case 6:
                $this->setNombreReferencia2($value);
                break;
            case 7:
                $this->setNombreReferencia3($value);
                break;
            case 8:
                $this->setNombreReferencia4($value);
                break;
            case 9:
                $this->setTel1($value);
                break;
            case 10:
                $this->setTel2($value);
                break;
            case 11:
                $this->setTel3($value);
                break;
            case 12:
                $this->setTel4($value);
                break;
            case 13:
                $this->setTel1Alterno($value);
                break;
            case 14:
                $this->setTel2Alterno($value);
                break;
            case 15:
                $this->setTel3Alterno($value);
                break;
            case 16:
                $this->setTel4Alterno($value);
                break;
            case 17:
                $this->setTel1Verif($value);
                break;
            case 18:
                $this->setTel2Verif($value);
                break;
            case 19:
                $this->setTel3Verif($value);
                break;
            case 20:
                $this->setTel4Verif($value);
                break;
            case 21:
                $this->setTel1Ref1($value);
                break;
            case 22:
                $this->setTel2Ref1($value);
                break;
            case 23:
                $this->setTel1Ref2($value);
                break;
            case 24:
                $this->setTel2Ref2($value);
                break;
            case 25:
                $this->setTel1Ref3($value);
                break;
            case 26:
                $this->setTel2Ref3($value);
                break;
            case 27:
                $this->setTel1Ref4($value);
                break;
            case 28:
                $this->setTel2Ref4($value);
                break;
            case 29:
                $this->setTel1Laboral($value);
                break;
            case 30:
                $this->setTel2Laboral($value);
                break;
            case 31:
                $this->setTelefonosMarcados($value);
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
        $keys = RlookPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdCuenta($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNumeroDeCuenta($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setNombreDeudor($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCliente($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setStatusDeCredito($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setNombreReferencia1($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setNombreReferencia2($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setNombreReferencia3($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setNombreReferencia4($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setTel1($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setTel2($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setTel3($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setTel4($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setTel1Alterno($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setTel2Alterno($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setTel3Alterno($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setTel4Alterno($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setTel1Verif($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setTel2Verif($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setTel3Verif($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setTel4Verif($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setTel1Ref1($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setTel2Ref1($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setTel1Ref2($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setTel2Ref2($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setTel1Ref3($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setTel2Ref3($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setTel1Ref4($arr[$keys[27]]);
        if (array_key_exists($keys[28], $arr)) $this->setTel2Ref4($arr[$keys[28]]);
        if (array_key_exists($keys[29], $arr)) $this->setTel1Laboral($arr[$keys[29]]);
        if (array_key_exists($keys[30], $arr)) $this->setTel2Laboral($arr[$keys[30]]);
        if (array_key_exists($keys[31], $arr)) $this->setTelefonosMarcados($arr[$keys[31]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RlookPeer::DATABASE_NAME);

        if ($this->isColumnModified(RlookPeer::ID_CUENTA)) $criteria->add(RlookPeer::ID_CUENTA, $this->id_cuenta);
        if ($this->isColumnModified(RlookPeer::NUMERO_DE_CUENTA)) $criteria->add(RlookPeer::NUMERO_DE_CUENTA, $this->numero_de_cuenta);
        if ($this->isColumnModified(RlookPeer::NOMBRE_DEUDOR)) $criteria->add(RlookPeer::NOMBRE_DEUDOR, $this->nombre_deudor);
        if ($this->isColumnModified(RlookPeer::CLIENTE)) $criteria->add(RlookPeer::CLIENTE, $this->cliente);
        if ($this->isColumnModified(RlookPeer::STATUS_DE_CREDITO)) $criteria->add(RlookPeer::STATUS_DE_CREDITO, $this->status_de_credito);
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_1)) $criteria->add(RlookPeer::NOMBRE_REFERENCIA_1, $this->nombre_referencia_1);
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_2)) $criteria->add(RlookPeer::NOMBRE_REFERENCIA_2, $this->nombre_referencia_2);
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_3)) $criteria->add(RlookPeer::NOMBRE_REFERENCIA_3, $this->nombre_referencia_3);
        if ($this->isColumnModified(RlookPeer::NOMBRE_REFERENCIA_4)) $criteria->add(RlookPeer::NOMBRE_REFERENCIA_4, $this->nombre_referencia_4);
        if ($this->isColumnModified(RlookPeer::TEL_1)) $criteria->add(RlookPeer::TEL_1, $this->tel_1);
        if ($this->isColumnModified(RlookPeer::TEL_2)) $criteria->add(RlookPeer::TEL_2, $this->tel_2);
        if ($this->isColumnModified(RlookPeer::TEL_3)) $criteria->add(RlookPeer::TEL_3, $this->tel_3);
        if ($this->isColumnModified(RlookPeer::TEL_4)) $criteria->add(RlookPeer::TEL_4, $this->tel_4);
        if ($this->isColumnModified(RlookPeer::TEL_1_ALTERNO)) $criteria->add(RlookPeer::TEL_1_ALTERNO, $this->tel_1_alterno);
        if ($this->isColumnModified(RlookPeer::TEL_2_ALTERNO)) $criteria->add(RlookPeer::TEL_2_ALTERNO, $this->tel_2_alterno);
        if ($this->isColumnModified(RlookPeer::TEL_3_ALTERNO)) $criteria->add(RlookPeer::TEL_3_ALTERNO, $this->tel_3_alterno);
        if ($this->isColumnModified(RlookPeer::TEL_4_ALTERNO)) $criteria->add(RlookPeer::TEL_4_ALTERNO, $this->tel_4_alterno);
        if ($this->isColumnModified(RlookPeer::TEL_1_VERIF)) $criteria->add(RlookPeer::TEL_1_VERIF, $this->tel_1_verif);
        if ($this->isColumnModified(RlookPeer::TEL_2_VERIF)) $criteria->add(RlookPeer::TEL_2_VERIF, $this->tel_2_verif);
        if ($this->isColumnModified(RlookPeer::TEL_3_VERIF)) $criteria->add(RlookPeer::TEL_3_VERIF, $this->tel_3_verif);
        if ($this->isColumnModified(RlookPeer::TEL_4_VERIF)) $criteria->add(RlookPeer::TEL_4_VERIF, $this->tel_4_verif);
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_1)) $criteria->add(RlookPeer::TEL_1_REF_1, $this->tel_1_ref_1);
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_1)) $criteria->add(RlookPeer::TEL_2_REF_1, $this->tel_2_ref_1);
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_2)) $criteria->add(RlookPeer::TEL_1_REF_2, $this->tel_1_ref_2);
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_2)) $criteria->add(RlookPeer::TEL_2_REF_2, $this->tel_2_ref_2);
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_3)) $criteria->add(RlookPeer::TEL_1_REF_3, $this->tel_1_ref_3);
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_3)) $criteria->add(RlookPeer::TEL_2_REF_3, $this->tel_2_ref_3);
        if ($this->isColumnModified(RlookPeer::TEL_1_REF_4)) $criteria->add(RlookPeer::TEL_1_REF_4, $this->tel_1_ref_4);
        if ($this->isColumnModified(RlookPeer::TEL_2_REF_4)) $criteria->add(RlookPeer::TEL_2_REF_4, $this->tel_2_ref_4);
        if ($this->isColumnModified(RlookPeer::TEL_1_LABORAL)) $criteria->add(RlookPeer::TEL_1_LABORAL, $this->tel_1_laboral);
        if ($this->isColumnModified(RlookPeer::TEL_2_LABORAL)) $criteria->add(RlookPeer::TEL_2_LABORAL, $this->tel_2_laboral);
        if ($this->isColumnModified(RlookPeer::TELEFONOS_MARCADOS)) $criteria->add(RlookPeer::TELEFONOS_MARCADOS, $this->telefonos_marcados);

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
        $criteria = new Criteria(RlookPeer::DATABASE_NAME);
        $criteria->add(RlookPeer::ID_CUENTA, $this->id_cuenta);

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
     * @param object $copyObj An object of Rlook (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNumeroDeCuenta($this->getNumeroDeCuenta());
        $copyObj->setNombreDeudor($this->getNombreDeudor());
        $copyObj->setCliente($this->getCliente());
        $copyObj->setStatusDeCredito($this->getStatusDeCredito());
        $copyObj->setNombreReferencia1($this->getNombreReferencia1());
        $copyObj->setNombreReferencia2($this->getNombreReferencia2());
        $copyObj->setNombreReferencia3($this->getNombreReferencia3());
        $copyObj->setNombreReferencia4($this->getNombreReferencia4());
        $copyObj->setTel1($this->getTel1());
        $copyObj->setTel2($this->getTel2());
        $copyObj->setTel3($this->getTel3());
        $copyObj->setTel4($this->getTel4());
        $copyObj->setTel1Alterno($this->getTel1Alterno());
        $copyObj->setTel2Alterno($this->getTel2Alterno());
        $copyObj->setTel3Alterno($this->getTel3Alterno());
        $copyObj->setTel4Alterno($this->getTel4Alterno());
        $copyObj->setTel1Verif($this->getTel1Verif());
        $copyObj->setTel2Verif($this->getTel2Verif());
        $copyObj->setTel3Verif($this->getTel3Verif());
        $copyObj->setTel4Verif($this->getTel4Verif());
        $copyObj->setTel1Ref1($this->getTel1Ref1());
        $copyObj->setTel2Ref1($this->getTel2Ref1());
        $copyObj->setTel1Ref2($this->getTel1Ref2());
        $copyObj->setTel2Ref2($this->getTel2Ref2());
        $copyObj->setTel1Ref3($this->getTel1Ref3());
        $copyObj->setTel2Ref3($this->getTel2Ref3());
        $copyObj->setTel1Ref4($this->getTel1Ref4());
        $copyObj->setTel2Ref4($this->getTel2Ref4());
        $copyObj->setTel1Laboral($this->getTel1Laboral());
        $copyObj->setTel2Laboral($this->getTel2Laboral());
        $copyObj->setTelefonosMarcados($this->getTelefonosMarcados());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCuenta('0'); // this is a auto-increment column, so set to default value
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
     * @return Rlook Clone of current object.
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
     * @return RlookPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new RlookPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_cuenta = null;
        $this->numero_de_cuenta = null;
        $this->nombre_deudor = null;
        $this->cliente = null;
        $this->status_de_credito = null;
        $this->nombre_referencia_1 = null;
        $this->nombre_referencia_2 = null;
        $this->nombre_referencia_3 = null;
        $this->nombre_referencia_4 = null;
        $this->tel_1 = null;
        $this->tel_2 = null;
        $this->tel_3 = null;
        $this->tel_4 = null;
        $this->tel_1_alterno = null;
        $this->tel_2_alterno = null;
        $this->tel_3_alterno = null;
        $this->tel_4_alterno = null;
        $this->tel_1_verif = null;
        $this->tel_2_verif = null;
        $this->tel_3_verif = null;
        $this->tel_4_verif = null;
        $this->tel_1_ref_1 = null;
        $this->tel_2_ref_1 = null;
        $this->tel_1_ref_2 = null;
        $this->tel_2_ref_2 = null;
        $this->tel_1_ref_3 = null;
        $this->tel_2_ref_3 = null;
        $this->tel_1_ref_4 = null;
        $this->tel_2_ref_4 = null;
        $this->tel_1_laboral = null;
        $this->tel_2_laboral = null;
        $this->telefonos_marcados = null;
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
        return (string) $this->exportTo(RlookPeer::DEFAULT_STRING_FORMAT);
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
