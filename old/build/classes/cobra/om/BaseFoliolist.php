<?php


/**
 * Base class that represents a row from the 'foliolist' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseFoliolist extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'FoliolistPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        FoliolistPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the cliente field.
     * @var        string
     */
    protected $cliente;

    /**
     * The value for the folio field.
     * @var        int
     */
    protected $folio;

    /**
     * The value for the enviado field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $enviado;

    /**
     * The value for the upda field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $upda;

    /**
     * The value for the crear field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $crear;

    /**
     * The value for the cuenta field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $cuenta;

    /**
     * The value for the nombre_deudor field.
     * @var        string
     */
    protected $nombre_deudor;

    /**
     * The value for the capital field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $capital;

    /**
     * The value for the saldo_can field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $saldo_can;

    /**
     * The value for the mora field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $mora;

    /**
     * The value for the n_prom field.
     * @var        string
     */
    protected $n_prom;

    /**
     * The value for the d_prom1 field.
     * @var        string
     */
    protected $d_prom1;

    /**
     * The value for the n_prom1 field.
     * @var        string
     */
    protected $n_prom1;

    /**
     * The value for the d_prom2 field.
     * @var        string
     */
    protected $d_prom2;

    /**
     * The value for the n_prom2 field.
     * @var        string
     */
    protected $n_prom2;

    /**
     * The value for the cuenta_concentradora_1 field.
     * @var        string
     */
    protected $cuenta_concentradora_1;

    /**
     * The value for the d_fech field.
     * @var        string
     */
    protected $d_fech;

    /**
     * The value for the id_cuenta field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $id_cuenta;

    /**
     * The value for the cnp field.
     * @var        string
     */
    protected $cnp;

    /**
     * The value for the auto field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $auto;

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
     * The value for the gestor field.
     * @var        string
     */
    protected $gestor;

    /**
     * The value for the sdc field.
     * @var        string
     */
    protected $sdc;

    /**
     * The value for the upd field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $upd;

    /**
     * The value for the c_prom field.
     * @var        string
     */
    protected $c_prom;

    /**
     * The value for the c_freq field.
     * @var        string
     */
    protected $c_freq;

    /**
     * The value for the diff field.
     * @var        int
     */
    protected $diff;

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
        $this->enviado = false;
        $this->upda = 0;
        $this->crear = '';
        $this->cuenta = '';
        $this->capital = '0.00';
        $this->saldo_can = '0.00';
        $this->mora = 0;
        $this->id_cuenta = 0;
        $this->auto = 0;
        $this->upd = '';
    }

    /**
     * Initializes internal state of BaseFoliolist object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
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
     * Get the [folio] column value.
     *
     * @return int
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Get the [enviado] column value.
     *
     * @return boolean
     */
    public function getEnviado()
    {
        return $this->enviado;
    }

    /**
     * Get the [upda] column value.
     *
     * @return int
     */
    public function getUpda()
    {
        return $this->upda;
    }

    /**
     * Get the [crear] column value.
     *
     * @return string
     */
    public function getCrear()
    {
        return $this->crear;
    }

    /**
     * Get the [cuenta] column value.
     *
     * @return string
     */
    public function getCuenta()
    {
        return $this->cuenta;
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
     * Get the [capital] column value.
     *
     * @return string
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Get the [saldo_can] column value.
     *
     * @return string
     */
    public function getSaldoCan()
    {
        return $this->saldo_can;
    }

    /**
     * Get the [mora] column value.
     *
     * @return int
     */
    public function getMora()
    {
        return $this->mora;
    }

    /**
     * Get the [n_prom] column value.
     *
     * @return string
     */
    public function getNProm()
    {
        return $this->n_prom;
    }

    /**
     * Get the [optionally formatted] temporal [d_prom1] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDProm1($format = '%F')
    {
        if ($this->d_prom1 === null) {
            return null;
        }

        if ($this->d_prom1 === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->d_prom1);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->d_prom1, true), $x);
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
     * Get the [n_prom1] column value.
     *
     * @return string
     */
    public function getNProm1()
    {
        return $this->n_prom1;
    }

    /**
     * Get the [optionally formatted] temporal [d_prom2] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDProm2($format = '%F')
    {
        if ($this->d_prom2 === null) {
            return null;
        }

        if ($this->d_prom2 === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->d_prom2);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->d_prom2, true), $x);
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
     * Get the [n_prom2] column value.
     *
     * @return string
     */
    public function getNProm2()
    {
        return $this->n_prom2;
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
     * Get the [optionally formatted] temporal [d_fech] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDFech($format = '%F')
    {
        if ($this->d_fech === null) {
            return null;
        }

        if ($this->d_fech === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->d_fech);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->d_fech, true), $x);
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
     * Get the [id_cuenta] column value.
     *
     * @return int
     */
    public function getIdCuenta()
    {
        return $this->id_cuenta;
    }

    /**
     * Get the [cnp] column value.
     *
     * @return string
     */
    public function getCnp()
    {
        return $this->cnp;
    }

    /**
     * Get the [auto] column value.
     *
     * @return int
     */
    public function getAuto()
    {
        return $this->auto;
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
     * Get the [gestor] column value.
     *
     * @return string
     */
    public function getGestor()
    {
        return $this->gestor;
    }

    /**
     * Get the [sdc] column value.
     *
     * @return string
     */
    public function getSdc()
    {
        return $this->sdc;
    }

    /**
     * Get the [upd] column value.
     *
     * @return string
     */
    public function getUpd()
    {
        return $this->upd;
    }

    /**
     * Get the [c_prom] column value.
     *
     * @return string
     */
    public function getCProm()
    {
        return $this->c_prom;
    }

    /**
     * Get the [c_freq] column value.
     *
     * @return string
     */
    public function getCFreq()
    {
        return $this->c_freq;
    }

    /**
     * Get the [diff] column value.
     *
     * @return int
     */
    public function getDiff()
    {
        return $this->diff;
    }

    /**
     * Set the value of [cliente] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCliente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cliente !== $v) {
            $this->cliente = $v;
            $this->modifiedColumns[] = FoliolistPeer::CLIENTE;
        }


        return $this;
    } // setCliente()

    /**
     * Set the value of [folio] column.
     *
     * @param int $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setFolio($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->folio !== $v) {
            $this->folio = $v;
            $this->modifiedColumns[] = FoliolistPeer::FOLIO;
        }


        return $this;
    } // setFolio()

    /**
     * Sets the value of the [enviado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setEnviado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->enviado !== $v) {
            $this->enviado = $v;
            $this->modifiedColumns[] = FoliolistPeer::ENVIADO;
        }


        return $this;
    } // setEnviado()

    /**
     * Set the value of [upda] column.
     *
     * @param int $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setUpda($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upda !== $v) {
            $this->upda = $v;
            $this->modifiedColumns[] = FoliolistPeer::UPDA;
        }


        return $this;
    } // setUpda()

    /**
     * Set the value of [crear] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCrear($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->crear !== $v) {
            $this->crear = $v;
            $this->modifiedColumns[] = FoliolistPeer::CREAR;
        }


        return $this;
    } // setCrear()

    /**
     * Set the value of [cuenta] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuenta !== $v) {
            $this->cuenta = $v;
            $this->modifiedColumns[] = FoliolistPeer::CUENTA;
        }


        return $this;
    } // setCuenta()

    /**
     * Set the value of [nombre_deudor] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setNombreDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_deudor !== $v) {
            $this->nombre_deudor = $v;
            $this->modifiedColumns[] = FoliolistPeer::NOMBRE_DEUDOR;
        }


        return $this;
    } // setNombreDeudor()

    /**
     * Set the value of [capital] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCapital($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->capital !== $v) {
            $this->capital = $v;
            $this->modifiedColumns[] = FoliolistPeer::CAPITAL;
        }


        return $this;
    } // setCapital()

    /**
     * Set the value of [saldo_can] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setSaldoCan($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->saldo_can !== $v) {
            $this->saldo_can = $v;
            $this->modifiedColumns[] = FoliolistPeer::SALDO_CAN;
        }


        return $this;
    } // setSaldoCan()

    /**
     * Set the value of [mora] column.
     *
     * @param int $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setMora($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->mora !== $v) {
            $this->mora = $v;
            $this->modifiedColumns[] = FoliolistPeer::MORA;
        }


        return $this;
    } // setMora()

    /**
     * Set the value of [n_prom] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setNProm($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->n_prom !== $v) {
            $this->n_prom = $v;
            $this->modifiedColumns[] = FoliolistPeer::N_PROM;
        }


        return $this;
    } // setNProm()

    /**
     * Sets the value of [d_prom1] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Foliolist The current object (for fluent API support)
     */
    public function setDProm1($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_prom1 !== null || $dt !== null) {
            $currentDateAsString = ($this->d_prom1 !== null && $tmpDt = new DateTime($this->d_prom1)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_prom1 = $newDateAsString;
                $this->modifiedColumns[] = FoliolistPeer::D_PROM1;
            }
        } // if either are not null


        return $this;
    } // setDProm1()

    /**
     * Set the value of [n_prom1] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setNProm1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->n_prom1 !== $v) {
            $this->n_prom1 = $v;
            $this->modifiedColumns[] = FoliolistPeer::N_PROM1;
        }


        return $this;
    } // setNProm1()

    /**
     * Sets the value of [d_prom2] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Foliolist The current object (for fluent API support)
     */
    public function setDProm2($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_prom2 !== null || $dt !== null) {
            $currentDateAsString = ($this->d_prom2 !== null && $tmpDt = new DateTime($this->d_prom2)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_prom2 = $newDateAsString;
                $this->modifiedColumns[] = FoliolistPeer::D_PROM2;
            }
        } // if either are not null


        return $this;
    } // setDProm2()

    /**
     * Set the value of [n_prom2] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setNProm2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->n_prom2 !== $v) {
            $this->n_prom2 = $v;
            $this->modifiedColumns[] = FoliolistPeer::N_PROM2;
        }


        return $this;
    } // setNProm2()

    /**
     * Set the value of [cuenta_concentradora_1] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCuentaConcentradora1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuenta_concentradora_1 !== $v) {
            $this->cuenta_concentradora_1 = $v;
            $this->modifiedColumns[] = FoliolistPeer::CUENTA_CONCENTRADORA_1;
        }


        return $this;
    } // setCuentaConcentradora1()

    /**
     * Sets the value of [d_fech] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Foliolist The current object (for fluent API support)
     */
    public function setDFech($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_fech !== null || $dt !== null) {
            $currentDateAsString = ($this->d_fech !== null && $tmpDt = new DateTime($this->d_fech)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_fech = $newDateAsString;
                $this->modifiedColumns[] = FoliolistPeer::D_FECH;
            }
        } // if either are not null


        return $this;
    } // setDFech()

    /**
     * Set the value of [id_cuenta] column.
     *
     * @param int $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setIdCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_cuenta !== $v) {
            $this->id_cuenta = $v;
            $this->modifiedColumns[] = FoliolistPeer::ID_CUENTA;
        }


        return $this;
    } // setIdCuenta()

    /**
     * Set the value of [cnp] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCnp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cnp !== $v) {
            $this->cnp = $v;
            $this->modifiedColumns[] = FoliolistPeer::CNP;
        }


        return $this;
    } // setCnp()

    /**
     * Set the value of [auto] column.
     *
     * @param int $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setAuto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->auto !== $v) {
            $this->auto = $v;
            $this->modifiedColumns[] = FoliolistPeer::AUTO;
        }


        return $this;
    } // setAuto()

    /**
     * Set the value of [ciudad_deudor] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCiudadDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ciudad_deudor !== $v) {
            $this->ciudad_deudor = $v;
            $this->modifiedColumns[] = FoliolistPeer::CIUDAD_DEUDOR;
        }


        return $this;
    } // setCiudadDeudor()

    /**
     * Set the value of [estado_deudor] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setEstadoDeudor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->estado_deudor !== $v) {
            $this->estado_deudor = $v;
            $this->modifiedColumns[] = FoliolistPeer::ESTADO_DEUDOR;
        }


        return $this;
    } // setEstadoDeudor()

    /**
     * Set the value of [gestor] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setGestor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->gestor !== $v) {
            $this->gestor = $v;
            $this->modifiedColumns[] = FoliolistPeer::GESTOR;
        }


        return $this;
    } // setGestor()

    /**
     * Set the value of [sdc] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setSdc($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sdc !== $v) {
            $this->sdc = $v;
            $this->modifiedColumns[] = FoliolistPeer::SDC;
        }


        return $this;
    } // setSdc()

    /**
     * Set the value of [upd] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setUpd($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->upd !== $v) {
            $this->upd = $v;
            $this->modifiedColumns[] = FoliolistPeer::UPD;
        }


        return $this;
    } // setUpd()

    /**
     * Set the value of [c_prom] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCProm($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_prom !== $v) {
            $this->c_prom = $v;
            $this->modifiedColumns[] = FoliolistPeer::C_PROM;
        }


        return $this;
    } // setCProm()

    /**
     * Set the value of [c_freq] column.
     *
     * @param string $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setCFreq($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_freq !== $v) {
            $this->c_freq = $v;
            $this->modifiedColumns[] = FoliolistPeer::C_FREQ;
        }


        return $this;
    } // setCFreq()

    /**
     * Set the value of [diff] column.
     *
     * @param int $v new value
     * @return Foliolist The current object (for fluent API support)
     */
    public function setDiff($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->diff !== $v) {
            $this->diff = $v;
            $this->modifiedColumns[] = FoliolistPeer::DIFF;
        }


        return $this;
    } // setDiff()

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
            if ($this->enviado !== false) {
                return false;
            }

            if ($this->upda !== 0) {
                return false;
            }

            if ($this->crear !== '') {
                return false;
            }

            if ($this->cuenta !== '') {
                return false;
            }

            if ($this->capital !== '0.00') {
                return false;
            }

            if ($this->saldo_can !== '0.00') {
                return false;
            }

            if ($this->mora !== 0) {
                return false;
            }

            if ($this->id_cuenta !== 0) {
                return false;
            }

            if ($this->auto !== 0) {
                return false;
            }

            if ($this->upd !== '') {
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

            $this->cliente = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->folio = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->enviado = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->upda = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->crear = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->cuenta = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->nombre_deudor = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->capital = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->saldo_can = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->mora = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->n_prom = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->d_prom1 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->n_prom1 = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->d_prom2 = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->n_prom2 = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->cuenta_concentradora_1 = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->d_fech = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->id_cuenta = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
            $this->cnp = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->auto = ($row[$startcol + 19] !== null) ? (int) $row[$startcol + 19] : null;
            $this->ciudad_deudor = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->estado_deudor = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->gestor = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->sdc = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->upd = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
            $this->c_prom = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
            $this->c_freq = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->diff = ($row[$startcol + 27] !== null) ? (int) $row[$startcol + 27] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 28; // 28 = FoliolistPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Foliolist object", $e);
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
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = FoliolistPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = FoliolistQuery::create()
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
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                FoliolistPeer::addInstanceToPool($this);
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
        if ($this->isColumnModified(FoliolistPeer::CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = '`cliente`';
        }
        if ($this->isColumnModified(FoliolistPeer::FOLIO)) {
            $modifiedColumns[':p' . $index++]  = '`folio`';
        }
        if ($this->isColumnModified(FoliolistPeer::ENVIADO)) {
            $modifiedColumns[':p' . $index++]  = '`enviado`';
        }
        if ($this->isColumnModified(FoliolistPeer::UPDA)) {
            $modifiedColumns[':p' . $index++]  = '`upda`';
        }
        if ($this->isColumnModified(FoliolistPeer::CREAR)) {
            $modifiedColumns[':p' . $index++]  = '`crear`';
        }
        if ($this->isColumnModified(FoliolistPeer::CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`cuenta`';
        }
        if ($this->isColumnModified(FoliolistPeer::NOMBRE_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_deudor`';
        }
        if ($this->isColumnModified(FoliolistPeer::CAPITAL)) {
            $modifiedColumns[':p' . $index++]  = '`capital`';
        }
        if ($this->isColumnModified(FoliolistPeer::SALDO_CAN)) {
            $modifiedColumns[':p' . $index++]  = '`saldo_can`';
        }
        if ($this->isColumnModified(FoliolistPeer::MORA)) {
            $modifiedColumns[':p' . $index++]  = '`mora`';
        }
        if ($this->isColumnModified(FoliolistPeer::N_PROM)) {
            $modifiedColumns[':p' . $index++]  = '`n_prom`';
        }
        if ($this->isColumnModified(FoliolistPeer::D_PROM1)) {
            $modifiedColumns[':p' . $index++]  = '`d_prom1`';
        }
        if ($this->isColumnModified(FoliolistPeer::N_PROM1)) {
            $modifiedColumns[':p' . $index++]  = '`n_prom1`';
        }
        if ($this->isColumnModified(FoliolistPeer::D_PROM2)) {
            $modifiedColumns[':p' . $index++]  = '`d_prom2`';
        }
        if ($this->isColumnModified(FoliolistPeer::N_PROM2)) {
            $modifiedColumns[':p' . $index++]  = '`n_prom2`';
        }
        if ($this->isColumnModified(FoliolistPeer::CUENTA_CONCENTRADORA_1)) {
            $modifiedColumns[':p' . $index++]  = '`cuenta_concentradora_1`';
        }
        if ($this->isColumnModified(FoliolistPeer::D_FECH)) {
            $modifiedColumns[':p' . $index++]  = '`d_fech`';
        }
        if ($this->isColumnModified(FoliolistPeer::ID_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`id_cuenta`';
        }
        if ($this->isColumnModified(FoliolistPeer::CNP)) {
            $modifiedColumns[':p' . $index++]  = '`cnp`';
        }
        if ($this->isColumnModified(FoliolistPeer::AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`auto`';
        }
        if ($this->isColumnModified(FoliolistPeer::CIUDAD_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`ciudad_deudor`';
        }
        if ($this->isColumnModified(FoliolistPeer::ESTADO_DEUDOR)) {
            $modifiedColumns[':p' . $index++]  = '`estado_deudor`';
        }
        if ($this->isColumnModified(FoliolistPeer::GESTOR)) {
            $modifiedColumns[':p' . $index++]  = '`gestor`';
        }
        if ($this->isColumnModified(FoliolistPeer::SDC)) {
            $modifiedColumns[':p' . $index++]  = '`sdc`';
        }
        if ($this->isColumnModified(FoliolistPeer::UPD)) {
            $modifiedColumns[':p' . $index++]  = '`upd`';
        }
        if ($this->isColumnModified(FoliolistPeer::C_PROM)) {
            $modifiedColumns[':p' . $index++]  = '`c_prom`';
        }
        if ($this->isColumnModified(FoliolistPeer::C_FREQ)) {
            $modifiedColumns[':p' . $index++]  = '`c_freq`';
        }
        if ($this->isColumnModified(FoliolistPeer::DIFF)) {
            $modifiedColumns[':p' . $index++]  = '`diff`';
        }

        $sql = sprintf(
            'INSERT INTO `foliolist` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`cliente`':
                        $stmt->bindValue($identifier, $this->cliente, PDO::PARAM_STR);
                        break;
                    case '`folio`':
                        $stmt->bindValue($identifier, $this->folio, PDO::PARAM_INT);
                        break;
                    case '`enviado`':
                        $stmt->bindValue($identifier, (int) $this->enviado, PDO::PARAM_INT);
                        break;
                    case '`upda`':
                        $stmt->bindValue($identifier, $this->upda, PDO::PARAM_INT);
                        break;
                    case '`crear`':
                        $stmt->bindValue($identifier, $this->crear, PDO::PARAM_STR);
                        break;
                    case '`cuenta`':
                        $stmt->bindValue($identifier, $this->cuenta, PDO::PARAM_STR);
                        break;
                    case '`nombre_deudor`':
                        $stmt->bindValue($identifier, $this->nombre_deudor, PDO::PARAM_STR);
                        break;
                    case '`capital`':
                        $stmt->bindValue($identifier, $this->capital, PDO::PARAM_STR);
                        break;
                    case '`saldo_can`':
                        $stmt->bindValue($identifier, $this->saldo_can, PDO::PARAM_STR);
                        break;
                    case '`mora`':
                        $stmt->bindValue($identifier, $this->mora, PDO::PARAM_INT);
                        break;
                    case '`n_prom`':
                        $stmt->bindValue($identifier, $this->n_prom, PDO::PARAM_STR);
                        break;
                    case '`d_prom1`':
                        $stmt->bindValue($identifier, $this->d_prom1, PDO::PARAM_STR);
                        break;
                    case '`n_prom1`':
                        $stmt->bindValue($identifier, $this->n_prom1, PDO::PARAM_STR);
                        break;
                    case '`d_prom2`':
                        $stmt->bindValue($identifier, $this->d_prom2, PDO::PARAM_STR);
                        break;
                    case '`n_prom2`':
                        $stmt->bindValue($identifier, $this->n_prom2, PDO::PARAM_STR);
                        break;
                    case '`cuenta_concentradora_1`':
                        $stmt->bindValue($identifier, $this->cuenta_concentradora_1, PDO::PARAM_STR);
                        break;
                    case '`d_fech`':
                        $stmt->bindValue($identifier, $this->d_fech, PDO::PARAM_STR);
                        break;
                    case '`id_cuenta`':
                        $stmt->bindValue($identifier, $this->id_cuenta, PDO::PARAM_INT);
                        break;
                    case '`cnp`':
                        $stmt->bindValue($identifier, $this->cnp, PDO::PARAM_STR);
                        break;
                    case '`auto`':
                        $stmt->bindValue($identifier, $this->auto, PDO::PARAM_INT);
                        break;
                    case '`ciudad_deudor`':
                        $stmt->bindValue($identifier, $this->ciudad_deudor, PDO::PARAM_STR);
                        break;
                    case '`estado_deudor`':
                        $stmt->bindValue($identifier, $this->estado_deudor, PDO::PARAM_STR);
                        break;
                    case '`gestor`':
                        $stmt->bindValue($identifier, $this->gestor, PDO::PARAM_STR);
                        break;
                    case '`sdc`':
                        $stmt->bindValue($identifier, $this->sdc, PDO::PARAM_STR);
                        break;
                    case '`upd`':
                        $stmt->bindValue($identifier, $this->upd, PDO::PARAM_STR);
                        break;
                    case '`c_prom`':
                        $stmt->bindValue($identifier, $this->c_prom, PDO::PARAM_STR);
                        break;
                    case '`c_freq`':
                        $stmt->bindValue($identifier, $this->c_freq, PDO::PARAM_STR);
                        break;
                    case '`diff`':
                        $stmt->bindValue($identifier, $this->diff, PDO::PARAM_INT);
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


            if (($retval = FoliolistPeer::doValidate($this, $columns)) !== true) {
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
        $pos = FoliolistPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCliente();
                break;
            case 1:
                return $this->getFolio();
                break;
            case 2:
                return $this->getEnviado();
                break;
            case 3:
                return $this->getUpda();
                break;
            case 4:
                return $this->getCrear();
                break;
            case 5:
                return $this->getCuenta();
                break;
            case 6:
                return $this->getNombreDeudor();
                break;
            case 7:
                return $this->getCapital();
                break;
            case 8:
                return $this->getSaldoCan();
                break;
            case 9:
                return $this->getMora();
                break;
            case 10:
                return $this->getNProm();
                break;
            case 11:
                return $this->getDProm1();
                break;
            case 12:
                return $this->getNProm1();
                break;
            case 13:
                return $this->getDProm2();
                break;
            case 14:
                return $this->getNProm2();
                break;
            case 15:
                return $this->getCuentaConcentradora1();
                break;
            case 16:
                return $this->getDFech();
                break;
            case 17:
                return $this->getIdCuenta();
                break;
            case 18:
                return $this->getCnp();
                break;
            case 19:
                return $this->getAuto();
                break;
            case 20:
                return $this->getCiudadDeudor();
                break;
            case 21:
                return $this->getEstadoDeudor();
                break;
            case 22:
                return $this->getGestor();
                break;
            case 23:
                return $this->getSdc();
                break;
            case 24:
                return $this->getUpd();
                break;
            case 25:
                return $this->getCProm();
                break;
            case 26:
                return $this->getCFreq();
                break;
            case 27:
                return $this->getDiff();
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
        if (isset($alreadyDumpedObjects['Foliolist'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Foliolist'][serialize($this->getPrimaryKey())] = true;
        $keys = FoliolistPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCliente(),
            $keys[1] => $this->getFolio(),
            $keys[2] => $this->getEnviado(),
            $keys[3] => $this->getUpda(),
            $keys[4] => $this->getCrear(),
            $keys[5] => $this->getCuenta(),
            $keys[6] => $this->getNombreDeudor(),
            $keys[7] => $this->getCapital(),
            $keys[8] => $this->getSaldoCan(),
            $keys[9] => $this->getMora(),
            $keys[10] => $this->getNProm(),
            $keys[11] => $this->getDProm1(),
            $keys[12] => $this->getNProm1(),
            $keys[13] => $this->getDProm2(),
            $keys[14] => $this->getNProm2(),
            $keys[15] => $this->getCuentaConcentradora1(),
            $keys[16] => $this->getDFech(),
            $keys[17] => $this->getIdCuenta(),
            $keys[18] => $this->getCnp(),
            $keys[19] => $this->getAuto(),
            $keys[20] => $this->getCiudadDeudor(),
            $keys[21] => $this->getEstadoDeudor(),
            $keys[22] => $this->getGestor(),
            $keys[23] => $this->getSdc(),
            $keys[24] => $this->getUpd(),
            $keys[25] => $this->getCProm(),
            $keys[26] => $this->getCFreq(),
            $keys[27] => $this->getDiff(),
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
        $pos = FoliolistPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCliente($value);
                break;
            case 1:
                $this->setFolio($value);
                break;
            case 2:
                $this->setEnviado($value);
                break;
            case 3:
                $this->setUpda($value);
                break;
            case 4:
                $this->setCrear($value);
                break;
            case 5:
                $this->setCuenta($value);
                break;
            case 6:
                $this->setNombreDeudor($value);
                break;
            case 7:
                $this->setCapital($value);
                break;
            case 8:
                $this->setSaldoCan($value);
                break;
            case 9:
                $this->setMora($value);
                break;
            case 10:
                $this->setNProm($value);
                break;
            case 11:
                $this->setDProm1($value);
                break;
            case 12:
                $this->setNProm1($value);
                break;
            case 13:
                $this->setDProm2($value);
                break;
            case 14:
                $this->setNProm2($value);
                break;
            case 15:
                $this->setCuentaConcentradora1($value);
                break;
            case 16:
                $this->setDFech($value);
                break;
            case 17:
                $this->setIdCuenta($value);
                break;
            case 18:
                $this->setCnp($value);
                break;
            case 19:
                $this->setAuto($value);
                break;
            case 20:
                $this->setCiudadDeudor($value);
                break;
            case 21:
                $this->setEstadoDeudor($value);
                break;
            case 22:
                $this->setGestor($value);
                break;
            case 23:
                $this->setSdc($value);
                break;
            case 24:
                $this->setUpd($value);
                break;
            case 25:
                $this->setCProm($value);
                break;
            case 26:
                $this->setCFreq($value);
                break;
            case 27:
                $this->setDiff($value);
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
        $keys = FoliolistPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setCliente($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFolio($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEnviado($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUpda($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCrear($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCuenta($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setNombreDeudor($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCapital($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSaldoCan($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMora($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setNProm($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDProm1($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setNProm1($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setDProm2($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setNProm2($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setCuentaConcentradora1($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setDFech($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setIdCuenta($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setCnp($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setAuto($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setCiudadDeudor($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setEstadoDeudor($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setGestor($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setSdc($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setUpd($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setCProm($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setCFreq($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setDiff($arr[$keys[27]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FoliolistPeer::DATABASE_NAME);

        if ($this->isColumnModified(FoliolistPeer::CLIENTE)) $criteria->add(FoliolistPeer::CLIENTE, $this->cliente);
        if ($this->isColumnModified(FoliolistPeer::FOLIO)) $criteria->add(FoliolistPeer::FOLIO, $this->folio);
        if ($this->isColumnModified(FoliolistPeer::ENVIADO)) $criteria->add(FoliolistPeer::ENVIADO, $this->enviado);
        if ($this->isColumnModified(FoliolistPeer::UPDA)) $criteria->add(FoliolistPeer::UPDA, $this->upda);
        if ($this->isColumnModified(FoliolistPeer::CREAR)) $criteria->add(FoliolistPeer::CREAR, $this->crear);
        if ($this->isColumnModified(FoliolistPeer::CUENTA)) $criteria->add(FoliolistPeer::CUENTA, $this->cuenta);
        if ($this->isColumnModified(FoliolistPeer::NOMBRE_DEUDOR)) $criteria->add(FoliolistPeer::NOMBRE_DEUDOR, $this->nombre_deudor);
        if ($this->isColumnModified(FoliolistPeer::CAPITAL)) $criteria->add(FoliolistPeer::CAPITAL, $this->capital);
        if ($this->isColumnModified(FoliolistPeer::SALDO_CAN)) $criteria->add(FoliolistPeer::SALDO_CAN, $this->saldo_can);
        if ($this->isColumnModified(FoliolistPeer::MORA)) $criteria->add(FoliolistPeer::MORA, $this->mora);
        if ($this->isColumnModified(FoliolistPeer::N_PROM)) $criteria->add(FoliolistPeer::N_PROM, $this->n_prom);
        if ($this->isColumnModified(FoliolistPeer::D_PROM1)) $criteria->add(FoliolistPeer::D_PROM1, $this->d_prom1);
        if ($this->isColumnModified(FoliolistPeer::N_PROM1)) $criteria->add(FoliolistPeer::N_PROM1, $this->n_prom1);
        if ($this->isColumnModified(FoliolistPeer::D_PROM2)) $criteria->add(FoliolistPeer::D_PROM2, $this->d_prom2);
        if ($this->isColumnModified(FoliolistPeer::N_PROM2)) $criteria->add(FoliolistPeer::N_PROM2, $this->n_prom2);
        if ($this->isColumnModified(FoliolistPeer::CUENTA_CONCENTRADORA_1)) $criteria->add(FoliolistPeer::CUENTA_CONCENTRADORA_1, $this->cuenta_concentradora_1);
        if ($this->isColumnModified(FoliolistPeer::D_FECH)) $criteria->add(FoliolistPeer::D_FECH, $this->d_fech);
        if ($this->isColumnModified(FoliolistPeer::ID_CUENTA)) $criteria->add(FoliolistPeer::ID_CUENTA, $this->id_cuenta);
        if ($this->isColumnModified(FoliolistPeer::CNP)) $criteria->add(FoliolistPeer::CNP, $this->cnp);
        if ($this->isColumnModified(FoliolistPeer::AUTO)) $criteria->add(FoliolistPeer::AUTO, $this->auto);
        if ($this->isColumnModified(FoliolistPeer::CIUDAD_DEUDOR)) $criteria->add(FoliolistPeer::CIUDAD_DEUDOR, $this->ciudad_deudor);
        if ($this->isColumnModified(FoliolistPeer::ESTADO_DEUDOR)) $criteria->add(FoliolistPeer::ESTADO_DEUDOR, $this->estado_deudor);
        if ($this->isColumnModified(FoliolistPeer::GESTOR)) $criteria->add(FoliolistPeer::GESTOR, $this->gestor);
        if ($this->isColumnModified(FoliolistPeer::SDC)) $criteria->add(FoliolistPeer::SDC, $this->sdc);
        if ($this->isColumnModified(FoliolistPeer::UPD)) $criteria->add(FoliolistPeer::UPD, $this->upd);
        if ($this->isColumnModified(FoliolistPeer::C_PROM)) $criteria->add(FoliolistPeer::C_PROM, $this->c_prom);
        if ($this->isColumnModified(FoliolistPeer::C_FREQ)) $criteria->add(FoliolistPeer::C_FREQ, $this->c_freq);
        if ($this->isColumnModified(FoliolistPeer::DIFF)) $criteria->add(FoliolistPeer::DIFF, $this->diff);

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
        $criteria = new Criteria(FoliolistPeer::DATABASE_NAME);
        $criteria->add(FoliolistPeer::CLIENTE, $this->cliente);
        $criteria->add(FoliolistPeer::FOLIO, $this->folio);

        return $criteria;
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getCliente();
        $pks[1] = $this->getFolio();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setCliente($keys[0]);
        $this->setFolio($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getCliente()) && (null === $this->getFolio());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Foliolist (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCliente($this->getCliente());
        $copyObj->setFolio($this->getFolio());
        $copyObj->setEnviado($this->getEnviado());
        $copyObj->setUpda($this->getUpda());
        $copyObj->setCrear($this->getCrear());
        $copyObj->setCuenta($this->getCuenta());
        $copyObj->setNombreDeudor($this->getNombreDeudor());
        $copyObj->setCapital($this->getCapital());
        $copyObj->setSaldoCan($this->getSaldoCan());
        $copyObj->setMora($this->getMora());
        $copyObj->setNProm($this->getNProm());
        $copyObj->setDProm1($this->getDProm1());
        $copyObj->setNProm1($this->getNProm1());
        $copyObj->setDProm2($this->getDProm2());
        $copyObj->setNProm2($this->getNProm2());
        $copyObj->setCuentaConcentradora1($this->getCuentaConcentradora1());
        $copyObj->setDFech($this->getDFech());
        $copyObj->setIdCuenta($this->getIdCuenta());
        $copyObj->setCnp($this->getCnp());
        $copyObj->setAuto($this->getAuto());
        $copyObj->setCiudadDeudor($this->getCiudadDeudor());
        $copyObj->setEstadoDeudor($this->getEstadoDeudor());
        $copyObj->setGestor($this->getGestor());
        $copyObj->setSdc($this->getSdc());
        $copyObj->setUpd($this->getUpd());
        $copyObj->setCProm($this->getCProm());
        $copyObj->setCFreq($this->getCFreq());
        $copyObj->setDiff($this->getDiff());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return Foliolist Clone of current object.
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
     * @return FoliolistPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new FoliolistPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->cliente = null;
        $this->folio = null;
        $this->enviado = null;
        $this->upda = null;
        $this->crear = null;
        $this->cuenta = null;
        $this->nombre_deudor = null;
        $this->capital = null;
        $this->saldo_can = null;
        $this->mora = null;
        $this->n_prom = null;
        $this->d_prom1 = null;
        $this->n_prom1 = null;
        $this->d_prom2 = null;
        $this->n_prom2 = null;
        $this->cuenta_concentradora_1 = null;
        $this->d_fech = null;
        $this->id_cuenta = null;
        $this->cnp = null;
        $this->auto = null;
        $this->ciudad_deudor = null;
        $this->estado_deudor = null;
        $this->gestor = null;
        $this->sdc = null;
        $this->upd = null;
        $this->c_prom = null;
        $this->c_freq = null;
        $this->diff = null;
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
        return (string) $this->exportTo(FoliolistPeer::DEFAULT_STRING_FORMAT);
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
