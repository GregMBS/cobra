<?php


/**
 * Base class that represents a row from the 'historia' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseHistoria extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'HistoriaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        HistoriaPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the auto field.
     * @var        int
     */
    protected $auto;

    /**
     * The value for the c_cvge field.
     * @var        string
     */
    protected $c_cvge;

    /**
     * The value for the c_cvba field.
     * @var        string
     */
    protected $c_cvba;

    /**
     * The value for the c_cont field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $c_cont;

    /**
     * The value for the c_cvst field.
     * @var        string
     */
    protected $c_cvst;

    /**
     * The value for the d_fech field.
     * @var        string
     */
    protected $d_fech;

    /**
     * The value for the c_hrin field.
     * @var        string
     */
    protected $c_hrin;

    /**
     * The value for the c_hrfi field.
     * @var        string
     */
    protected $c_hrfi;

    /**
     * The value for the c_tele field.
     * @var        string
     */
    protected $c_tele;

    /**
     * The value for the c_msge field.
     * @var        string
     */
    protected $c_msge;

    /**
     * The value for the cuenta field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $cuenta;

    /**
     * The value for the c_obse1 field.
     * @var        string
     */
    protected $c_obse1;

    /**
     * The value for the c_obse2 field.
     * @var        string
     */
    protected $c_obse2;

    /**
     * The value for the c_contan field.
     * @var        string
     */
    protected $c_contan;

    /**
     * The value for the c_nse field.
     * @var        string
     */
    protected $c_nse;

    /**
     * The value for the c_visit field.
     * @var        string
     */
    protected $c_visit;

    /**
     * The value for the c_atte field.
     * @var        string
     */
    protected $c_atte;

    /**
     * The value for the c_cniv field.
     * @var        string
     */
    protected $c_cniv;

    /**
     * The value for the c_carg field.
     * @var        string
     */
    protected $c_carg;

    /**
     * The value for the c_cfac field.
     * @var        string
     */
    protected $c_cfac;

    /**
     * The value for the c_cpta field.
     * @var        string
     */
    protected $c_cpta;

    /**
     * The value for the c_rcon field.
     * @var        string
     */
    protected $c_rcon;

    /**
     * The value for the auth field.
     * @var        string
     */
    protected $auth;

    /**
     * The value for the cargado field.
     * @var        string
     */
    protected $cargado;

    /**
     * The value for the cuando field.
     * @var        string
     */
    protected $cuando;

    /**
     * The value for the d_prom field.
     * @var        string
     */
    protected $d_prom;

    /**
     * The value for the c_prom field.
     * @var        string
     */
    protected $c_prom;

    /**
     * The value for the n_prom field.
     * @var        string
     */
    protected $n_prom;

    /**
     * The value for the c_calle1 field.
     * @var        string
     */
    protected $c_calle1;

    /**
     * The value for the c_calle2 field.
     * @var        string
     */
    protected $c_calle2;

    /**
     * The value for the c_cnp field.
     * @var        string
     */
    protected $c_cnp;

    /**
     * The value for the c_email field.
     * @var        string
     */
    protected $c_email;

    /**
     * The value for the c_ntel field.
     * @var        string
     */
    protected $c_ntel;

    /**
     * The value for the c_ndir field.
     * @var        string
     */
    protected $c_ndir;

    /**
     * The value for the c_freq field.
     * @var        string
     */
    protected $c_freq;

    /**
     * The value for the c_ctipo field.
     * @var        string
     */
    protected $c_ctipo;

    /**
     * The value for the c_cown field.
     * @var        string
     */
    protected $c_cown;

    /**
     * The value for the c_cstat field.
     * @var        string
     */
    protected $c_cstat;

    /**
     * The value for the c_crej field.
     * @var        string
     */
    protected $c_crej;

    /**
     * The value for the c_cpat field.
     * @var        string
     */
    protected $c_cpat;

    /**
     * The value for the c_accion field.
     * @var        string
     */
    protected $c_accion;

    /**
     * The value for the c_motiv field.
     * @var        string
     */
    protected $c_motiv;

    /**
     * The value for the c_camp field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $c_camp;

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
     * The value for the c_eje field.
     * @var        string
     */
    protected $c_eje;

    /**
     * The value for the error field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $error;

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
        $this->c_cont = 0;
        $this->cuenta = '0';
        $this->c_camp = '0';
        $this->error = 0;
    }

    /**
     * Initializes internal state of BaseHistoria object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
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
     * Get the [c_cvge] column value.
     *
     * @return string
     */
    public function getCCvge()
    {
        return $this->c_cvge;
    }

    /**
     * Get the [c_cvba] column value.
     *
     * @return string
     */
    public function getCCvba()
    {
        return $this->c_cvba;
    }

    /**
     * Get the [c_cont] column value.
     *
     * @return int
     */
    public function getCCont()
    {
        return $this->c_cont;
    }

    /**
     * Get the [c_cvst] column value.
     *
     * @return string
     */
    public function getCCvst()
    {
        return $this->c_cvst;
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
     * Get the [optionally formatted] temporal [c_hrin] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCHrin($format = '%X')
    {
        if ($this->c_hrin === null) {
            return null;
        }


        try {
            $dt = new DateTime($this->c_hrin);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->c_hrin, true), $x);
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
     * Get the [optionally formatted] temporal [c_hrfi] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCHrfi($format = '%X')
    {
        if ($this->c_hrfi === null) {
            return null;
        }


        try {
            $dt = new DateTime($this->c_hrfi);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->c_hrfi, true), $x);
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
     * Get the [c_tele] column value.
     *
     * @return string
     */
    public function getCTele()
    {
        return $this->c_tele;
    }

    /**
     * Get the [c_msge] column value.
     *
     * @return string
     */
    public function getCMsge()
    {
        return $this->c_msge;
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
     * Get the [c_obse1] column value.
     *
     * @return string
     */
    public function getCObse1()
    {
        return $this->c_obse1;
    }

    /**
     * Get the [c_obse2] column value.
     *
     * @return string
     */
    public function getCObse2()
    {
        return $this->c_obse2;
    }

    /**
     * Get the [c_contan] column value.
     *
     * @return string
     */
    public function getCContan()
    {
        return $this->c_contan;
    }

    /**
     * Get the [c_nse] column value.
     *
     * @return string
     */
    public function getCNse()
    {
        return $this->c_nse;
    }

    /**
     * Get the [c_visit] column value.
     *
     * @return string
     */
    public function getCVisit()
    {
        return $this->c_visit;
    }

    /**
     * Get the [c_atte] column value.
     *
     * @return string
     */
    public function getCAtte()
    {
        return $this->c_atte;
    }

    /**
     * Get the [c_cniv] column value.
     *
     * @return string
     */
    public function getCCniv()
    {
        return $this->c_cniv;
    }

    /**
     * Get the [c_carg] column value.
     *
     * @return string
     */
    public function getCCarg()
    {
        return $this->c_carg;
    }

    /**
     * Get the [c_cfac] column value.
     *
     * @return string
     */
    public function getCCfac()
    {
        return $this->c_cfac;
    }

    /**
     * Get the [c_cpta] column value.
     *
     * @return string
     */
    public function getCCpta()
    {
        return $this->c_cpta;
    }

    /**
     * Get the [c_rcon] column value.
     *
     * @return string
     */
    public function getCRcon()
    {
        return $this->c_rcon;
    }

    /**
     * Get the [auth] column value.
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Get the [cargado] column value.
     *
     * @return string
     */
    public function getCargado()
    {
        return $this->cargado;
    }

    /**
     * Get the [cuando] column value.
     *
     * @return string
     */
    public function getCuando()
    {
        return $this->cuando;
    }

    /**
     * Get the [optionally formatted] temporal [d_prom] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDProm($format = '%F')
    {
        if ($this->d_prom === null) {
            return null;
        }

        if ($this->d_prom === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->d_prom);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->d_prom, true), $x);
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
     * Get the [c_prom] column value.
     *
     * @return string
     */
    public function getCProm()
    {
        return $this->c_prom;
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
     * Get the [c_calle1] column value.
     *
     * @return string
     */
    public function getCCalle1()
    {
        return $this->c_calle1;
    }

    /**
     * Get the [c_calle2] column value.
     *
     * @return string
     */
    public function getCCalle2()
    {
        return $this->c_calle2;
    }

    /**
     * Get the [c_cnp] column value.
     *
     * @return string
     */
    public function getCCnp()
    {
        return $this->c_cnp;
    }

    /**
     * Get the [c_email] column value.
     *
     * @return string
     */
    public function getCEmail()
    {
        return $this->c_email;
    }

    /**
     * Get the [c_ntel] column value.
     *
     * @return string
     */
    public function getCNtel()
    {
        return $this->c_ntel;
    }

    /**
     * Get the [c_ndir] column value.
     *
     * @return string
     */
    public function getCNdir()
    {
        return $this->c_ndir;
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
     * Get the [c_ctipo] column value.
     *
     * @return string
     */
    public function getCCtipo()
    {
        return $this->c_ctipo;
    }

    /**
     * Get the [c_cown] column value.
     *
     * @return string
     */
    public function getCCown()
    {
        return $this->c_cown;
    }

    /**
     * Get the [c_cstat] column value.
     *
     * @return string
     */
    public function getCCstat()
    {
        return $this->c_cstat;
    }

    /**
     * Get the [c_crej] column value.
     *
     * @return string
     */
    public function getCCrej()
    {
        return $this->c_crej;
    }

    /**
     * Get the [c_cpat] column value.
     *
     * @return string
     */
    public function getCCpat()
    {
        return $this->c_cpat;
    }

    /**
     * Get the [c_accion] column value.
     *
     * @return string
     */
    public function getCAccion()
    {
        return $this->c_accion;
    }

    /**
     * Get the [c_motiv] column value.
     *
     * @return string
     */
    public function getCMotiv()
    {
        return $this->c_motiv;
    }

    /**
     * Get the [c_camp] column value.
     *
     * @return string
     */
    public function getCCamp()
    {
        return $this->c_camp;
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
     * Get the [c_eje] column value.
     *
     * @return string
     */
    public function getCEje()
    {
        return $this->c_eje;
    }

    /**
     * Get the [error] column value.
     *
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of [auto] column.
     *
     * @param int $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setAuto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->auto !== $v) {
            $this->auto = $v;
            $this->modifiedColumns[] = HistoriaPeer::AUTO;
        }


        return $this;
    } // setAuto()

    /**
     * Set the value of [c_cvge] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCvge($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cvge !== $v) {
            $this->c_cvge = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CVGE;
        }


        return $this;
    } // setCCvge()

    /**
     * Set the value of [c_cvba] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCvba($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cvba !== $v) {
            $this->c_cvba = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CVBA;
        }


        return $this;
    } // setCCvba()

    /**
     * Set the value of [c_cont] column.
     *
     * @param int $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCont($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->c_cont !== $v) {
            $this->c_cont = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CONT;
        }


        return $this;
    } // setCCont()

    /**
     * Set the value of [c_cvst] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCvst($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cvst !== $v) {
            $this->c_cvst = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CVST;
        }


        return $this;
    } // setCCvst()

    /**
     * Sets the value of [d_fech] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Historia The current object (for fluent API support)
     */
    public function setDFech($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_fech !== null || $dt !== null) {
            $currentDateAsString = ($this->d_fech !== null && $tmpDt = new DateTime($this->d_fech)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_fech = $newDateAsString;
                $this->modifiedColumns[] = HistoriaPeer::D_FECH;
            }
        } // if either are not null


        return $this;
    } // setDFech()

    /**
     * Sets the value of [c_hrin] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Historia The current object (for fluent API support)
     */
    public function setCHrin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->c_hrin !== null || $dt !== null) {
            $currentDateAsString = ($this->c_hrin !== null && $tmpDt = new DateTime($this->c_hrin)) ? $tmpDt->format('H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->c_hrin = $newDateAsString;
                $this->modifiedColumns[] = HistoriaPeer::C_HRIN;
            }
        } // if either are not null


        return $this;
    } // setCHrin()

    /**
     * Sets the value of [c_hrfi] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Historia The current object (for fluent API support)
     */
    public function setCHrfi($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->c_hrfi !== null || $dt !== null) {
            $currentDateAsString = ($this->c_hrfi !== null && $tmpDt = new DateTime($this->c_hrfi)) ? $tmpDt->format('H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->c_hrfi = $newDateAsString;
                $this->modifiedColumns[] = HistoriaPeer::C_HRFI;
            }
        } // if either are not null


        return $this;
    } // setCHrfi()

    /**
     * Set the value of [c_tele] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCTele($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_tele !== $v) {
            $this->c_tele = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_TELE;
        }


        return $this;
    } // setCTele()

    /**
     * Set the value of [c_msge] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCMsge($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_msge !== $v) {
            $this->c_msge = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_MSGE;
        }


        return $this;
    } // setCMsge()

    /**
     * Set the value of [cuenta] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuenta !== $v) {
            $this->cuenta = $v;
            $this->modifiedColumns[] = HistoriaPeer::CUENTA;
        }


        return $this;
    } // setCuenta()

    /**
     * Set the value of [c_obse1] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCObse1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_obse1 !== $v) {
            $this->c_obse1 = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_OBSE1;
        }


        return $this;
    } // setCObse1()

    /**
     * Set the value of [c_obse2] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCObse2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_obse2 !== $v) {
            $this->c_obse2 = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_OBSE2;
        }


        return $this;
    } // setCObse2()

    /**
     * Set the value of [c_contan] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCContan($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_contan !== $v) {
            $this->c_contan = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CONTAN;
        }


        return $this;
    } // setCContan()

    /**
     * Set the value of [c_nse] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCNse($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_nse !== $v) {
            $this->c_nse = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_NSE;
        }


        return $this;
    } // setCNse()

    /**
     * Set the value of [c_visit] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCVisit($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_visit !== $v) {
            $this->c_visit = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_VISIT;
        }


        return $this;
    } // setCVisit()

    /**
     * Set the value of [c_atte] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCAtte($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_atte !== $v) {
            $this->c_atte = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_ATTE;
        }


        return $this;
    } // setCAtte()

    /**
     * Set the value of [c_cniv] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCniv($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cniv !== $v) {
            $this->c_cniv = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CNIV;
        }


        return $this;
    } // setCCniv()

    /**
     * Set the value of [c_carg] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCarg($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_carg !== $v) {
            $this->c_carg = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CARG;
        }


        return $this;
    } // setCCarg()

    /**
     * Set the value of [c_cfac] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCfac($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cfac !== $v) {
            $this->c_cfac = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CFAC;
        }


        return $this;
    } // setCCfac()

    /**
     * Set the value of [c_cpta] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCpta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cpta !== $v) {
            $this->c_cpta = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CPTA;
        }


        return $this;
    } // setCCpta()

    /**
     * Set the value of [c_rcon] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCRcon($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_rcon !== $v) {
            $this->c_rcon = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_RCON;
        }


        return $this;
    } // setCRcon()

    /**
     * Set the value of [auth] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setAuth($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->auth !== $v) {
            $this->auth = $v;
            $this->modifiedColumns[] = HistoriaPeer::AUTH;
        }


        return $this;
    } // setAuth()

    /**
     * Set the value of [cargado] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCargado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cargado !== $v) {
            $this->cargado = $v;
            $this->modifiedColumns[] = HistoriaPeer::CARGADO;
        }


        return $this;
    } // setCargado()

    /**
     * Set the value of [cuando] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCuando($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuando !== $v) {
            $this->cuando = $v;
            $this->modifiedColumns[] = HistoriaPeer::CUANDO;
        }


        return $this;
    } // setCuando()

    /**
     * Sets the value of [d_prom] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Historia The current object (for fluent API support)
     */
    public function setDProm($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_prom !== null || $dt !== null) {
            $currentDateAsString = ($this->d_prom !== null && $tmpDt = new DateTime($this->d_prom)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_prom = $newDateAsString;
                $this->modifiedColumns[] = HistoriaPeer::D_PROM;
            }
        } // if either are not null


        return $this;
    } // setDProm()

    /**
     * Set the value of [c_prom] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCProm($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_prom !== $v) {
            $this->c_prom = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_PROM;
        }


        return $this;
    } // setCProm()

    /**
     * Set the value of [n_prom] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setNProm($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->n_prom !== $v) {
            $this->n_prom = $v;
            $this->modifiedColumns[] = HistoriaPeer::N_PROM;
        }


        return $this;
    } // setNProm()

    /**
     * Set the value of [c_calle1] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCalle1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_calle1 !== $v) {
            $this->c_calle1 = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CALLE1;
        }


        return $this;
    } // setCCalle1()

    /**
     * Set the value of [c_calle2] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCalle2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_calle2 !== $v) {
            $this->c_calle2 = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CALLE2;
        }


        return $this;
    } // setCCalle2()

    /**
     * Set the value of [c_cnp] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCnp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cnp !== $v) {
            $this->c_cnp = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CNP;
        }


        return $this;
    } // setCCnp()

    /**
     * Set the value of [c_email] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCEmail($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_email !== $v) {
            $this->c_email = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_EMAIL;
        }


        return $this;
    } // setCEmail()

    /**
     * Set the value of [c_ntel] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCNtel($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_ntel !== $v) {
            $this->c_ntel = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_NTEL;
        }


        return $this;
    } // setCNtel()

    /**
     * Set the value of [c_ndir] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCNdir($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_ndir !== $v) {
            $this->c_ndir = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_NDIR;
        }


        return $this;
    } // setCNdir()

    /**
     * Set the value of [c_freq] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCFreq($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_freq !== $v) {
            $this->c_freq = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_FREQ;
        }


        return $this;
    } // setCFreq()

    /**
     * Set the value of [c_ctipo] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCtipo($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_ctipo !== $v) {
            $this->c_ctipo = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CTIPO;
        }


        return $this;
    } // setCCtipo()

    /**
     * Set the value of [c_cown] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCown($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cown !== $v) {
            $this->c_cown = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_COWN;
        }


        return $this;
    } // setCCown()

    /**
     * Set the value of [c_cstat] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCstat($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cstat !== $v) {
            $this->c_cstat = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CSTAT;
        }


        return $this;
    } // setCCstat()

    /**
     * Set the value of [c_crej] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCrej($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_crej !== $v) {
            $this->c_crej = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CREJ;
        }


        return $this;
    } // setCCrej()

    /**
     * Set the value of [c_cpat] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCpat($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_cpat !== $v) {
            $this->c_cpat = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CPAT;
        }


        return $this;
    } // setCCpat()

    /**
     * Set the value of [c_accion] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCAccion($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_accion !== $v) {
            $this->c_accion = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_ACCION;
        }


        return $this;
    } // setCAccion()

    /**
     * Set the value of [c_motiv] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCMotiv($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_motiv !== $v) {
            $this->c_motiv = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_MOTIV;
        }


        return $this;
    } // setCMotiv()

    /**
     * Set the value of [c_camp] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCCamp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_camp !== $v) {
            $this->c_camp = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_CAMP;
        }


        return $this;
    } // setCCamp()

    /**
     * Sets the value of [d_prom1] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Historia The current object (for fluent API support)
     */
    public function setDProm1($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_prom1 !== null || $dt !== null) {
            $currentDateAsString = ($this->d_prom1 !== null && $tmpDt = new DateTime($this->d_prom1)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_prom1 = $newDateAsString;
                $this->modifiedColumns[] = HistoriaPeer::D_PROM1;
            }
        } // if either are not null


        return $this;
    } // setDProm1()

    /**
     * Set the value of [n_prom1] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setNProm1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->n_prom1 !== $v) {
            $this->n_prom1 = $v;
            $this->modifiedColumns[] = HistoriaPeer::N_PROM1;
        }


        return $this;
    } // setNProm1()

    /**
     * Sets the value of [d_prom2] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Historia The current object (for fluent API support)
     */
    public function setDProm2($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->d_prom2 !== null || $dt !== null) {
            $currentDateAsString = ($this->d_prom2 !== null && $tmpDt = new DateTime($this->d_prom2)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->d_prom2 = $newDateAsString;
                $this->modifiedColumns[] = HistoriaPeer::D_PROM2;
            }
        } // if either are not null


        return $this;
    } // setDProm2()

    /**
     * Set the value of [n_prom2] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setNProm2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->n_prom2 !== $v) {
            $this->n_prom2 = $v;
            $this->modifiedColumns[] = HistoriaPeer::N_PROM2;
        }


        return $this;
    } // setNProm2()

    /**
     * Set the value of [c_eje] column.
     *
     * @param string $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setCEje($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->c_eje !== $v) {
            $this->c_eje = $v;
            $this->modifiedColumns[] = HistoriaPeer::C_EJE;
        }


        return $this;
    } // setCEje()

    /**
     * Set the value of [error] column.
     *
     * @param int $v new value
     * @return Historia The current object (for fluent API support)
     */
    public function setError($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->error !== $v) {
            $this->error = $v;
            $this->modifiedColumns[] = HistoriaPeer::ERROR;
        }


        return $this;
    } // setError()

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
            if ($this->c_cont !== 0) {
                return false;
            }

            if ($this->cuenta !== '0') {
                return false;
            }

            if ($this->c_camp !== '0') {
                return false;
            }

            if ($this->error !== 0) {
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

            $this->auto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->c_cvge = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->c_cvba = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->c_cont = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->c_cvst = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->d_fech = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->c_hrin = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->c_hrfi = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->c_tele = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->c_msge = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->cuenta = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->c_obse1 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->c_obse2 = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->c_contan = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->c_nse = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->c_visit = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->c_atte = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->c_cniv = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->c_carg = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->c_cfac = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->c_cpta = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->c_rcon = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
            $this->auth = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
            $this->cargado = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
            $this->cuando = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
            $this->d_prom = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
            $this->c_prom = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
            $this->n_prom = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
            $this->c_calle1 = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
            $this->c_calle2 = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
            $this->c_cnp = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
            $this->c_email = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
            $this->c_ntel = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
            $this->c_ndir = ($row[$startcol + 33] !== null) ? (string) $row[$startcol + 33] : null;
            $this->c_freq = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
            $this->c_ctipo = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
            $this->c_cown = ($row[$startcol + 36] !== null) ? (string) $row[$startcol + 36] : null;
            $this->c_cstat = ($row[$startcol + 37] !== null) ? (string) $row[$startcol + 37] : null;
            $this->c_crej = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
            $this->c_cpat = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
            $this->c_accion = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
            $this->c_motiv = ($row[$startcol + 41] !== null) ? (string) $row[$startcol + 41] : null;
            $this->c_camp = ($row[$startcol + 42] !== null) ? (string) $row[$startcol + 42] : null;
            $this->d_prom1 = ($row[$startcol + 43] !== null) ? (string) $row[$startcol + 43] : null;
            $this->n_prom1 = ($row[$startcol + 44] !== null) ? (string) $row[$startcol + 44] : null;
            $this->d_prom2 = ($row[$startcol + 45] !== null) ? (string) $row[$startcol + 45] : null;
            $this->n_prom2 = ($row[$startcol + 46] !== null) ? (string) $row[$startcol + 46] : null;
            $this->c_eje = ($row[$startcol + 47] !== null) ? (string) $row[$startcol + 47] : null;
            $this->error = ($row[$startcol + 48] !== null) ? (int) $row[$startcol + 48] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 49; // 49 = HistoriaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Historia object", $e);
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
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = HistoriaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = HistoriaQuery::create()
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
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                HistoriaPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = HistoriaPeer::AUTO;
        if (null !== $this->auto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HistoriaPeer::AUTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HistoriaPeer::AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`Auto`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CVGE)) {
            $modifiedColumns[':p' . $index++]  = '`C_CVGE`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CVBA)) {
            $modifiedColumns[':p' . $index++]  = '`C_CVBA`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CONT)) {
            $modifiedColumns[':p' . $index++]  = '`C_CONT`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CVST)) {
            $modifiedColumns[':p' . $index++]  = '`C_CVST`';
        }
        if ($this->isColumnModified(HistoriaPeer::D_FECH)) {
            $modifiedColumns[':p' . $index++]  = '`D_FECH`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_HRIN)) {
            $modifiedColumns[':p' . $index++]  = '`C_HRIN`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_HRFI)) {
            $modifiedColumns[':p' . $index++]  = '`C_HRFI`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_TELE)) {
            $modifiedColumns[':p' . $index++]  = '`C_TELE`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_MSGE)) {
            $modifiedColumns[':p' . $index++]  = '`C_MSGE`';
        }
        if ($this->isColumnModified(HistoriaPeer::CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`CUENTA`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_OBSE1)) {
            $modifiedColumns[':p' . $index++]  = '`C_OBSE1`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_OBSE2)) {
            $modifiedColumns[':p' . $index++]  = '`C_OBSE2`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CONTAN)) {
            $modifiedColumns[':p' . $index++]  = '`C_CONTAN`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_NSE)) {
            $modifiedColumns[':p' . $index++]  = '`C_NSE`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_VISIT)) {
            $modifiedColumns[':p' . $index++]  = '`C_VISIT`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_ATTE)) {
            $modifiedColumns[':p' . $index++]  = '`C_ATTE`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CNIV)) {
            $modifiedColumns[':p' . $index++]  = '`C_CNIV`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CARG)) {
            $modifiedColumns[':p' . $index++]  = '`C_CARG`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CFAC)) {
            $modifiedColumns[':p' . $index++]  = '`C_CFAC`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CPTA)) {
            $modifiedColumns[':p' . $index++]  = '`C_CPTA`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_RCON)) {
            $modifiedColumns[':p' . $index++]  = '`C_RCON`';
        }
        if ($this->isColumnModified(HistoriaPeer::AUTH)) {
            $modifiedColumns[':p' . $index++]  = '`AUTH`';
        }
        if ($this->isColumnModified(HistoriaPeer::CARGADO)) {
            $modifiedColumns[':p' . $index++]  = '`CARGADO`';
        }
        if ($this->isColumnModified(HistoriaPeer::CUANDO)) {
            $modifiedColumns[':p' . $index++]  = '`CUANDO`';
        }
        if ($this->isColumnModified(HistoriaPeer::D_PROM)) {
            $modifiedColumns[':p' . $index++]  = '`D_PROM`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_PROM)) {
            $modifiedColumns[':p' . $index++]  = '`C_PROM`';
        }
        if ($this->isColumnModified(HistoriaPeer::N_PROM)) {
            $modifiedColumns[':p' . $index++]  = '`N_PROM`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CALLE1)) {
            $modifiedColumns[':p' . $index++]  = '`C_CALLE1`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CALLE2)) {
            $modifiedColumns[':p' . $index++]  = '`C_CALLE2`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CNP)) {
            $modifiedColumns[':p' . $index++]  = '`C_CNP`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`C_EMAIL`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_NTEL)) {
            $modifiedColumns[':p' . $index++]  = '`C_NTEL`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_NDIR)) {
            $modifiedColumns[':p' . $index++]  = '`C_NDIR`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_FREQ)) {
            $modifiedColumns[':p' . $index++]  = '`C_FREQ`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CTIPO)) {
            $modifiedColumns[':p' . $index++]  = '`C_CTIPO`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_COWN)) {
            $modifiedColumns[':p' . $index++]  = '`C_COWN`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CSTAT)) {
            $modifiedColumns[':p' . $index++]  = '`C_CSTAT`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CREJ)) {
            $modifiedColumns[':p' . $index++]  = '`C_CREJ`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CPAT)) {
            $modifiedColumns[':p' . $index++]  = '`C_CPAT`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_ACCION)) {
            $modifiedColumns[':p' . $index++]  = '`C_ACCION`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_MOTIV)) {
            $modifiedColumns[':p' . $index++]  = '`C_MOTIV`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_CAMP)) {
            $modifiedColumns[':p' . $index++]  = '`C_CAMP`';
        }
        if ($this->isColumnModified(HistoriaPeer::D_PROM1)) {
            $modifiedColumns[':p' . $index++]  = '`D_PROM1`';
        }
        if ($this->isColumnModified(HistoriaPeer::N_PROM1)) {
            $modifiedColumns[':p' . $index++]  = '`N_PROM1`';
        }
        if ($this->isColumnModified(HistoriaPeer::D_PROM2)) {
            $modifiedColumns[':p' . $index++]  = '`D_PROM2`';
        }
        if ($this->isColumnModified(HistoriaPeer::N_PROM2)) {
            $modifiedColumns[':p' . $index++]  = '`N_PROM2`';
        }
        if ($this->isColumnModified(HistoriaPeer::C_EJE)) {
            $modifiedColumns[':p' . $index++]  = '`C_EJE`';
        }
        if ($this->isColumnModified(HistoriaPeer::ERROR)) {
            $modifiedColumns[':p' . $index++]  = '`error`';
        }

        $sql = sprintf(
            'INSERT INTO `historia` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`Auto`':
                        $stmt->bindValue($identifier, $this->auto, PDO::PARAM_INT);
                        break;
                    case '`C_CVGE`':
                        $stmt->bindValue($identifier, $this->c_cvge, PDO::PARAM_STR);
                        break;
                    case '`C_CVBA`':
                        $stmt->bindValue($identifier, $this->c_cvba, PDO::PARAM_STR);
                        break;
                    case '`C_CONT`':
                        $stmt->bindValue($identifier, $this->c_cont, PDO::PARAM_INT);
                        break;
                    case '`C_CVST`':
                        $stmt->bindValue($identifier, $this->c_cvst, PDO::PARAM_STR);
                        break;
                    case '`D_FECH`':
                        $stmt->bindValue($identifier, $this->d_fech, PDO::PARAM_STR);
                        break;
                    case '`C_HRIN`':
                        $stmt->bindValue($identifier, $this->c_hrin, PDO::PARAM_STR);
                        break;
                    case '`C_HRFI`':
                        $stmt->bindValue($identifier, $this->c_hrfi, PDO::PARAM_STR);
                        break;
                    case '`C_TELE`':
                        $stmt->bindValue($identifier, $this->c_tele, PDO::PARAM_STR);
                        break;
                    case '`C_MSGE`':
                        $stmt->bindValue($identifier, $this->c_msge, PDO::PARAM_STR);
                        break;
                    case '`CUENTA`':
                        $stmt->bindValue($identifier, $this->cuenta, PDO::PARAM_STR);
                        break;
                    case '`C_OBSE1`':
                        $stmt->bindValue($identifier, $this->c_obse1, PDO::PARAM_STR);
                        break;
                    case '`C_OBSE2`':
                        $stmt->bindValue($identifier, $this->c_obse2, PDO::PARAM_STR);
                        break;
                    case '`C_CONTAN`':
                        $stmt->bindValue($identifier, $this->c_contan, PDO::PARAM_STR);
                        break;
                    case '`C_NSE`':
                        $stmt->bindValue($identifier, $this->c_nse, PDO::PARAM_STR);
                        break;
                    case '`C_VISIT`':
                        $stmt->bindValue($identifier, $this->c_visit, PDO::PARAM_STR);
                        break;
                    case '`C_ATTE`':
                        $stmt->bindValue($identifier, $this->c_atte, PDO::PARAM_STR);
                        break;
                    case '`C_CNIV`':
                        $stmt->bindValue($identifier, $this->c_cniv, PDO::PARAM_STR);
                        break;
                    case '`C_CARG`':
                        $stmt->bindValue($identifier, $this->c_carg, PDO::PARAM_STR);
                        break;
                    case '`C_CFAC`':
                        $stmt->bindValue($identifier, $this->c_cfac, PDO::PARAM_STR);
                        break;
                    case '`C_CPTA`':
                        $stmt->bindValue($identifier, $this->c_cpta, PDO::PARAM_STR);
                        break;
                    case '`C_RCON`':
                        $stmt->bindValue($identifier, $this->c_rcon, PDO::PARAM_STR);
                        break;
                    case '`AUTH`':
                        $stmt->bindValue($identifier, $this->auth, PDO::PARAM_STR);
                        break;
                    case '`CARGADO`':
                        $stmt->bindValue($identifier, $this->cargado, PDO::PARAM_STR);
                        break;
                    case '`CUANDO`':
                        $stmt->bindValue($identifier, $this->cuando, PDO::PARAM_STR);
                        break;
                    case '`D_PROM`':
                        $stmt->bindValue($identifier, $this->d_prom, PDO::PARAM_STR);
                        break;
                    case '`C_PROM`':
                        $stmt->bindValue($identifier, $this->c_prom, PDO::PARAM_STR);
                        break;
                    case '`N_PROM`':
                        $stmt->bindValue($identifier, $this->n_prom, PDO::PARAM_STR);
                        break;
                    case '`C_CALLE1`':
                        $stmt->bindValue($identifier, $this->c_calle1, PDO::PARAM_STR);
                        break;
                    case '`C_CALLE2`':
                        $stmt->bindValue($identifier, $this->c_calle2, PDO::PARAM_STR);
                        break;
                    case '`C_CNP`':
                        $stmt->bindValue($identifier, $this->c_cnp, PDO::PARAM_STR);
                        break;
                    case '`C_EMAIL`':
                        $stmt->bindValue($identifier, $this->c_email, PDO::PARAM_STR);
                        break;
                    case '`C_NTEL`':
                        $stmt->bindValue($identifier, $this->c_ntel, PDO::PARAM_STR);
                        break;
                    case '`C_NDIR`':
                        $stmt->bindValue($identifier, $this->c_ndir, PDO::PARAM_STR);
                        break;
                    case '`C_FREQ`':
                        $stmt->bindValue($identifier, $this->c_freq, PDO::PARAM_STR);
                        break;
                    case '`C_CTIPO`':
                        $stmt->bindValue($identifier, $this->c_ctipo, PDO::PARAM_STR);
                        break;
                    case '`C_COWN`':
                        $stmt->bindValue($identifier, $this->c_cown, PDO::PARAM_STR);
                        break;
                    case '`C_CSTAT`':
                        $stmt->bindValue($identifier, $this->c_cstat, PDO::PARAM_STR);
                        break;
                    case '`C_CREJ`':
                        $stmt->bindValue($identifier, $this->c_crej, PDO::PARAM_STR);
                        break;
                    case '`C_CPAT`':
                        $stmt->bindValue($identifier, $this->c_cpat, PDO::PARAM_STR);
                        break;
                    case '`C_ACCION`':
                        $stmt->bindValue($identifier, $this->c_accion, PDO::PARAM_STR);
                        break;
                    case '`C_MOTIV`':
                        $stmt->bindValue($identifier, $this->c_motiv, PDO::PARAM_STR);
                        break;
                    case '`C_CAMP`':
                        $stmt->bindValue($identifier, $this->c_camp, PDO::PARAM_STR);
                        break;
                    case '`D_PROM1`':
                        $stmt->bindValue($identifier, $this->d_prom1, PDO::PARAM_STR);
                        break;
                    case '`N_PROM1`':
                        $stmt->bindValue($identifier, $this->n_prom1, PDO::PARAM_STR);
                        break;
                    case '`D_PROM2`':
                        $stmt->bindValue($identifier, $this->d_prom2, PDO::PARAM_STR);
                        break;
                    case '`N_PROM2`':
                        $stmt->bindValue($identifier, $this->n_prom2, PDO::PARAM_STR);
                        break;
                    case '`C_EJE`':
                        $stmt->bindValue($identifier, $this->c_eje, PDO::PARAM_STR);
                        break;
                    case '`error`':
                        $stmt->bindValue($identifier, $this->error, PDO::PARAM_INT);
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
        $this->setAuto($pk);

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


            if (($retval = HistoriaPeer::doValidate($this, $columns)) !== true) {
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
        $pos = HistoriaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAuto();
                break;
            case 1:
                return $this->getCCvge();
                break;
            case 2:
                return $this->getCCvba();
                break;
            case 3:
                return $this->getCCont();
                break;
            case 4:
                return $this->getCCvst();
                break;
            case 5:
                return $this->getDFech();
                break;
            case 6:
                return $this->getCHrin();
                break;
            case 7:
                return $this->getCHrfi();
                break;
            case 8:
                return $this->getCTele();
                break;
            case 9:
                return $this->getCMsge();
                break;
            case 10:
                return $this->getCuenta();
                break;
            case 11:
                return $this->getCObse1();
                break;
            case 12:
                return $this->getCObse2();
                break;
            case 13:
                return $this->getCContan();
                break;
            case 14:
                return $this->getCNse();
                break;
            case 15:
                return $this->getCVisit();
                break;
            case 16:
                return $this->getCAtte();
                break;
            case 17:
                return $this->getCCniv();
                break;
            case 18:
                return $this->getCCarg();
                break;
            case 19:
                return $this->getCCfac();
                break;
            case 20:
                return $this->getCCpta();
                break;
            case 21:
                return $this->getCRcon();
                break;
            case 22:
                return $this->getAuth();
                break;
            case 23:
                return $this->getCargado();
                break;
            case 24:
                return $this->getCuando();
                break;
            case 25:
                return $this->getDProm();
                break;
            case 26:
                return $this->getCProm();
                break;
            case 27:
                return $this->getNProm();
                break;
            case 28:
                return $this->getCCalle1();
                break;
            case 29:
                return $this->getCCalle2();
                break;
            case 30:
                return $this->getCCnp();
                break;
            case 31:
                return $this->getCEmail();
                break;
            case 32:
                return $this->getCNtel();
                break;
            case 33:
                return $this->getCNdir();
                break;
            case 34:
                return $this->getCFreq();
                break;
            case 35:
                return $this->getCCtipo();
                break;
            case 36:
                return $this->getCCown();
                break;
            case 37:
                return $this->getCCstat();
                break;
            case 38:
                return $this->getCCrej();
                break;
            case 39:
                return $this->getCCpat();
                break;
            case 40:
                return $this->getCAccion();
                break;
            case 41:
                return $this->getCMotiv();
                break;
            case 42:
                return $this->getCCamp();
                break;
            case 43:
                return $this->getDProm1();
                break;
            case 44:
                return $this->getNProm1();
                break;
            case 45:
                return $this->getDProm2();
                break;
            case 46:
                return $this->getNProm2();
                break;
            case 47:
                return $this->getCEje();
                break;
            case 48:
                return $this->getError();
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
        if (isset($alreadyDumpedObjects['Historia'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Historia'][$this->getPrimaryKey()] = true;
        $keys = HistoriaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAuto(),
            $keys[1] => $this->getCCvge(),
            $keys[2] => $this->getCCvba(),
            $keys[3] => $this->getCCont(),
            $keys[4] => $this->getCCvst(),
            $keys[5] => $this->getDFech(),
            $keys[6] => $this->getCHrin(),
            $keys[7] => $this->getCHrfi(),
            $keys[8] => $this->getCTele(),
            $keys[9] => $this->getCMsge(),
            $keys[10] => $this->getCuenta(),
            $keys[11] => $this->getCObse1(),
            $keys[12] => $this->getCObse2(),
            $keys[13] => $this->getCContan(),
            $keys[14] => $this->getCNse(),
            $keys[15] => $this->getCVisit(),
            $keys[16] => $this->getCAtte(),
            $keys[17] => $this->getCCniv(),
            $keys[18] => $this->getCCarg(),
            $keys[19] => $this->getCCfac(),
            $keys[20] => $this->getCCpta(),
            $keys[21] => $this->getCRcon(),
            $keys[22] => $this->getAuth(),
            $keys[23] => $this->getCargado(),
            $keys[24] => $this->getCuando(),
            $keys[25] => $this->getDProm(),
            $keys[26] => $this->getCProm(),
            $keys[27] => $this->getNProm(),
            $keys[28] => $this->getCCalle1(),
            $keys[29] => $this->getCCalle2(),
            $keys[30] => $this->getCCnp(),
            $keys[31] => $this->getCEmail(),
            $keys[32] => $this->getCNtel(),
            $keys[33] => $this->getCNdir(),
            $keys[34] => $this->getCFreq(),
            $keys[35] => $this->getCCtipo(),
            $keys[36] => $this->getCCown(),
            $keys[37] => $this->getCCstat(),
            $keys[38] => $this->getCCrej(),
            $keys[39] => $this->getCCpat(),
            $keys[40] => $this->getCAccion(),
            $keys[41] => $this->getCMotiv(),
            $keys[42] => $this->getCCamp(),
            $keys[43] => $this->getDProm1(),
            $keys[44] => $this->getNProm1(),
            $keys[45] => $this->getDProm2(),
            $keys[46] => $this->getNProm2(),
            $keys[47] => $this->getCEje(),
            $keys[48] => $this->getError(),
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
        $pos = HistoriaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAuto($value);
                break;
            case 1:
                $this->setCCvge($value);
                break;
            case 2:
                $this->setCCvba($value);
                break;
            case 3:
                $this->setCCont($value);
                break;
            case 4:
                $this->setCCvst($value);
                break;
            case 5:
                $this->setDFech($value);
                break;
            case 6:
                $this->setCHrin($value);
                break;
            case 7:
                $this->setCHrfi($value);
                break;
            case 8:
                $this->setCTele($value);
                break;
            case 9:
                $this->setCMsge($value);
                break;
            case 10:
                $this->setCuenta($value);
                break;
            case 11:
                $this->setCObse1($value);
                break;
            case 12:
                $this->setCObse2($value);
                break;
            case 13:
                $this->setCContan($value);
                break;
            case 14:
                $this->setCNse($value);
                break;
            case 15:
                $this->setCVisit($value);
                break;
            case 16:
                $this->setCAtte($value);
                break;
            case 17:
                $this->setCCniv($value);
                break;
            case 18:
                $this->setCCarg($value);
                break;
            case 19:
                $this->setCCfac($value);
                break;
            case 20:
                $this->setCCpta($value);
                break;
            case 21:
                $this->setCRcon($value);
                break;
            case 22:
                $this->setAuth($value);
                break;
            case 23:
                $this->setCargado($value);
                break;
            case 24:
                $this->setCuando($value);
                break;
            case 25:
                $this->setDProm($value);
                break;
            case 26:
                $this->setCProm($value);
                break;
            case 27:
                $this->setNProm($value);
                break;
            case 28:
                $this->setCCalle1($value);
                break;
            case 29:
                $this->setCCalle2($value);
                break;
            case 30:
                $this->setCCnp($value);
                break;
            case 31:
                $this->setCEmail($value);
                break;
            case 32:
                $this->setCNtel($value);
                break;
            case 33:
                $this->setCNdir($value);
                break;
            case 34:
                $this->setCFreq($value);
                break;
            case 35:
                $this->setCCtipo($value);
                break;
            case 36:
                $this->setCCown($value);
                break;
            case 37:
                $this->setCCstat($value);
                break;
            case 38:
                $this->setCCrej($value);
                break;
            case 39:
                $this->setCCpat($value);
                break;
            case 40:
                $this->setCAccion($value);
                break;
            case 41:
                $this->setCMotiv($value);
                break;
            case 42:
                $this->setCCamp($value);
                break;
            case 43:
                $this->setDProm1($value);
                break;
            case 44:
                $this->setNProm1($value);
                break;
            case 45:
                $this->setDProm2($value);
                break;
            case 46:
                $this->setNProm2($value);
                break;
            case 47:
                $this->setCEje($value);
                break;
            case 48:
                $this->setError($value);
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
        $keys = HistoriaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setAuto($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCCvge($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCCvba($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCCont($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCCvst($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDFech($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCHrin($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCHrfi($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCTele($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCMsge($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCuenta($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setCObse1($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setCObse2($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setCContan($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setCNse($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setCVisit($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setCAtte($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setCCniv($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setCCarg($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setCCfac($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setCCpta($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setCRcon($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setAuth($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setCargado($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setCuando($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setDProm($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setCProm($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setNProm($arr[$keys[27]]);
        if (array_key_exists($keys[28], $arr)) $this->setCCalle1($arr[$keys[28]]);
        if (array_key_exists($keys[29], $arr)) $this->setCCalle2($arr[$keys[29]]);
        if (array_key_exists($keys[30], $arr)) $this->setCCnp($arr[$keys[30]]);
        if (array_key_exists($keys[31], $arr)) $this->setCEmail($arr[$keys[31]]);
        if (array_key_exists($keys[32], $arr)) $this->setCNtel($arr[$keys[32]]);
        if (array_key_exists($keys[33], $arr)) $this->setCNdir($arr[$keys[33]]);
        if (array_key_exists($keys[34], $arr)) $this->setCFreq($arr[$keys[34]]);
        if (array_key_exists($keys[35], $arr)) $this->setCCtipo($arr[$keys[35]]);
        if (array_key_exists($keys[36], $arr)) $this->setCCown($arr[$keys[36]]);
        if (array_key_exists($keys[37], $arr)) $this->setCCstat($arr[$keys[37]]);
        if (array_key_exists($keys[38], $arr)) $this->setCCrej($arr[$keys[38]]);
        if (array_key_exists($keys[39], $arr)) $this->setCCpat($arr[$keys[39]]);
        if (array_key_exists($keys[40], $arr)) $this->setCAccion($arr[$keys[40]]);
        if (array_key_exists($keys[41], $arr)) $this->setCMotiv($arr[$keys[41]]);
        if (array_key_exists($keys[42], $arr)) $this->setCCamp($arr[$keys[42]]);
        if (array_key_exists($keys[43], $arr)) $this->setDProm1($arr[$keys[43]]);
        if (array_key_exists($keys[44], $arr)) $this->setNProm1($arr[$keys[44]]);
        if (array_key_exists($keys[45], $arr)) $this->setDProm2($arr[$keys[45]]);
        if (array_key_exists($keys[46], $arr)) $this->setNProm2($arr[$keys[46]]);
        if (array_key_exists($keys[47], $arr)) $this->setCEje($arr[$keys[47]]);
        if (array_key_exists($keys[48], $arr)) $this->setError($arr[$keys[48]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(HistoriaPeer::DATABASE_NAME);

        if ($this->isColumnModified(HistoriaPeer::AUTO)) $criteria->add(HistoriaPeer::AUTO, $this->auto);
        if ($this->isColumnModified(HistoriaPeer::C_CVGE)) $criteria->add(HistoriaPeer::C_CVGE, $this->c_cvge);
        if ($this->isColumnModified(HistoriaPeer::C_CVBA)) $criteria->add(HistoriaPeer::C_CVBA, $this->c_cvba);
        if ($this->isColumnModified(HistoriaPeer::C_CONT)) $criteria->add(HistoriaPeer::C_CONT, $this->c_cont);
        if ($this->isColumnModified(HistoriaPeer::C_CVST)) $criteria->add(HistoriaPeer::C_CVST, $this->c_cvst);
        if ($this->isColumnModified(HistoriaPeer::D_FECH)) $criteria->add(HistoriaPeer::D_FECH, $this->d_fech);
        if ($this->isColumnModified(HistoriaPeer::C_HRIN)) $criteria->add(HistoriaPeer::C_HRIN, $this->c_hrin);
        if ($this->isColumnModified(HistoriaPeer::C_HRFI)) $criteria->add(HistoriaPeer::C_HRFI, $this->c_hrfi);
        if ($this->isColumnModified(HistoriaPeer::C_TELE)) $criteria->add(HistoriaPeer::C_TELE, $this->c_tele);
        if ($this->isColumnModified(HistoriaPeer::C_MSGE)) $criteria->add(HistoriaPeer::C_MSGE, $this->c_msge);
        if ($this->isColumnModified(HistoriaPeer::CUENTA)) $criteria->add(HistoriaPeer::CUENTA, $this->cuenta);
        if ($this->isColumnModified(HistoriaPeer::C_OBSE1)) $criteria->add(HistoriaPeer::C_OBSE1, $this->c_obse1);
        if ($this->isColumnModified(HistoriaPeer::C_OBSE2)) $criteria->add(HistoriaPeer::C_OBSE2, $this->c_obse2);
        if ($this->isColumnModified(HistoriaPeer::C_CONTAN)) $criteria->add(HistoriaPeer::C_CONTAN, $this->c_contan);
        if ($this->isColumnModified(HistoriaPeer::C_NSE)) $criteria->add(HistoriaPeer::C_NSE, $this->c_nse);
        if ($this->isColumnModified(HistoriaPeer::C_VISIT)) $criteria->add(HistoriaPeer::C_VISIT, $this->c_visit);
        if ($this->isColumnModified(HistoriaPeer::C_ATTE)) $criteria->add(HistoriaPeer::C_ATTE, $this->c_atte);
        if ($this->isColumnModified(HistoriaPeer::C_CNIV)) $criteria->add(HistoriaPeer::C_CNIV, $this->c_cniv);
        if ($this->isColumnModified(HistoriaPeer::C_CARG)) $criteria->add(HistoriaPeer::C_CARG, $this->c_carg);
        if ($this->isColumnModified(HistoriaPeer::C_CFAC)) $criteria->add(HistoriaPeer::C_CFAC, $this->c_cfac);
        if ($this->isColumnModified(HistoriaPeer::C_CPTA)) $criteria->add(HistoriaPeer::C_CPTA, $this->c_cpta);
        if ($this->isColumnModified(HistoriaPeer::C_RCON)) $criteria->add(HistoriaPeer::C_RCON, $this->c_rcon);
        if ($this->isColumnModified(HistoriaPeer::AUTH)) $criteria->add(HistoriaPeer::AUTH, $this->auth);
        if ($this->isColumnModified(HistoriaPeer::CARGADO)) $criteria->add(HistoriaPeer::CARGADO, $this->cargado);
        if ($this->isColumnModified(HistoriaPeer::CUANDO)) $criteria->add(HistoriaPeer::CUANDO, $this->cuando);
        if ($this->isColumnModified(HistoriaPeer::D_PROM)) $criteria->add(HistoriaPeer::D_PROM, $this->d_prom);
        if ($this->isColumnModified(HistoriaPeer::C_PROM)) $criteria->add(HistoriaPeer::C_PROM, $this->c_prom);
        if ($this->isColumnModified(HistoriaPeer::N_PROM)) $criteria->add(HistoriaPeer::N_PROM, $this->n_prom);
        if ($this->isColumnModified(HistoriaPeer::C_CALLE1)) $criteria->add(HistoriaPeer::C_CALLE1, $this->c_calle1);
        if ($this->isColumnModified(HistoriaPeer::C_CALLE2)) $criteria->add(HistoriaPeer::C_CALLE2, $this->c_calle2);
        if ($this->isColumnModified(HistoriaPeer::C_CNP)) $criteria->add(HistoriaPeer::C_CNP, $this->c_cnp);
        if ($this->isColumnModified(HistoriaPeer::C_EMAIL)) $criteria->add(HistoriaPeer::C_EMAIL, $this->c_email);
        if ($this->isColumnModified(HistoriaPeer::C_NTEL)) $criteria->add(HistoriaPeer::C_NTEL, $this->c_ntel);
        if ($this->isColumnModified(HistoriaPeer::C_NDIR)) $criteria->add(HistoriaPeer::C_NDIR, $this->c_ndir);
        if ($this->isColumnModified(HistoriaPeer::C_FREQ)) $criteria->add(HistoriaPeer::C_FREQ, $this->c_freq);
        if ($this->isColumnModified(HistoriaPeer::C_CTIPO)) $criteria->add(HistoriaPeer::C_CTIPO, $this->c_ctipo);
        if ($this->isColumnModified(HistoriaPeer::C_COWN)) $criteria->add(HistoriaPeer::C_COWN, $this->c_cown);
        if ($this->isColumnModified(HistoriaPeer::C_CSTAT)) $criteria->add(HistoriaPeer::C_CSTAT, $this->c_cstat);
        if ($this->isColumnModified(HistoriaPeer::C_CREJ)) $criteria->add(HistoriaPeer::C_CREJ, $this->c_crej);
        if ($this->isColumnModified(HistoriaPeer::C_CPAT)) $criteria->add(HistoriaPeer::C_CPAT, $this->c_cpat);
        if ($this->isColumnModified(HistoriaPeer::C_ACCION)) $criteria->add(HistoriaPeer::C_ACCION, $this->c_accion);
        if ($this->isColumnModified(HistoriaPeer::C_MOTIV)) $criteria->add(HistoriaPeer::C_MOTIV, $this->c_motiv);
        if ($this->isColumnModified(HistoriaPeer::C_CAMP)) $criteria->add(HistoriaPeer::C_CAMP, $this->c_camp);
        if ($this->isColumnModified(HistoriaPeer::D_PROM1)) $criteria->add(HistoriaPeer::D_PROM1, $this->d_prom1);
        if ($this->isColumnModified(HistoriaPeer::N_PROM1)) $criteria->add(HistoriaPeer::N_PROM1, $this->n_prom1);
        if ($this->isColumnModified(HistoriaPeer::D_PROM2)) $criteria->add(HistoriaPeer::D_PROM2, $this->d_prom2);
        if ($this->isColumnModified(HistoriaPeer::N_PROM2)) $criteria->add(HistoriaPeer::N_PROM2, $this->n_prom2);
        if ($this->isColumnModified(HistoriaPeer::C_EJE)) $criteria->add(HistoriaPeer::C_EJE, $this->c_eje);
        if ($this->isColumnModified(HistoriaPeer::ERROR)) $criteria->add(HistoriaPeer::ERROR, $this->error);

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
        $criteria = new Criteria(HistoriaPeer::DATABASE_NAME);
        $criteria->add(HistoriaPeer::AUTO, $this->auto);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getAuto();
    }

    /**
     * Generic method to set the primary key (auto column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setAuto($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getAuto();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Historia (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCCvge($this->getCCvge());
        $copyObj->setCCvba($this->getCCvba());
        $copyObj->setCCont($this->getCCont());
        $copyObj->setCCvst($this->getCCvst());
        $copyObj->setDFech($this->getDFech());
        $copyObj->setCHrin($this->getCHrin());
        $copyObj->setCHrfi($this->getCHrfi());
        $copyObj->setCTele($this->getCTele());
        $copyObj->setCMsge($this->getCMsge());
        $copyObj->setCuenta($this->getCuenta());
        $copyObj->setCObse1($this->getCObse1());
        $copyObj->setCObse2($this->getCObse2());
        $copyObj->setCContan($this->getCContan());
        $copyObj->setCNse($this->getCNse());
        $copyObj->setCVisit($this->getCVisit());
        $copyObj->setCAtte($this->getCAtte());
        $copyObj->setCCniv($this->getCCniv());
        $copyObj->setCCarg($this->getCCarg());
        $copyObj->setCCfac($this->getCCfac());
        $copyObj->setCCpta($this->getCCpta());
        $copyObj->setCRcon($this->getCRcon());
        $copyObj->setAuth($this->getAuth());
        $copyObj->setCargado($this->getCargado());
        $copyObj->setCuando($this->getCuando());
        $copyObj->setDProm($this->getDProm());
        $copyObj->setCProm($this->getCProm());
        $copyObj->setNProm($this->getNProm());
        $copyObj->setCCalle1($this->getCCalle1());
        $copyObj->setCCalle2($this->getCCalle2());
        $copyObj->setCCnp($this->getCCnp());
        $copyObj->setCEmail($this->getCEmail());
        $copyObj->setCNtel($this->getCNtel());
        $copyObj->setCNdir($this->getCNdir());
        $copyObj->setCFreq($this->getCFreq());
        $copyObj->setCCtipo($this->getCCtipo());
        $copyObj->setCCown($this->getCCown());
        $copyObj->setCCstat($this->getCCstat());
        $copyObj->setCCrej($this->getCCrej());
        $copyObj->setCCpat($this->getCCpat());
        $copyObj->setCAccion($this->getCAccion());
        $copyObj->setCMotiv($this->getCMotiv());
        $copyObj->setCCamp($this->getCCamp());
        $copyObj->setDProm1($this->getDProm1());
        $copyObj->setNProm1($this->getNProm1());
        $copyObj->setDProm2($this->getDProm2());
        $copyObj->setNProm2($this->getNProm2());
        $copyObj->setCEje($this->getCEje());
        $copyObj->setError($this->getError());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAuto(NULL); // this is a auto-increment column, so set to default value
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
     * @return Historia Clone of current object.
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
     * @return HistoriaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new HistoriaPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->auto = null;
        $this->c_cvge = null;
        $this->c_cvba = null;
        $this->c_cont = null;
        $this->c_cvst = null;
        $this->d_fech = null;
        $this->c_hrin = null;
        $this->c_hrfi = null;
        $this->c_tele = null;
        $this->c_msge = null;
        $this->cuenta = null;
        $this->c_obse1 = null;
        $this->c_obse2 = null;
        $this->c_contan = null;
        $this->c_nse = null;
        $this->c_visit = null;
        $this->c_atte = null;
        $this->c_cniv = null;
        $this->c_carg = null;
        $this->c_cfac = null;
        $this->c_cpta = null;
        $this->c_rcon = null;
        $this->auth = null;
        $this->cargado = null;
        $this->cuando = null;
        $this->d_prom = null;
        $this->c_prom = null;
        $this->n_prom = null;
        $this->c_calle1 = null;
        $this->c_calle2 = null;
        $this->c_cnp = null;
        $this->c_email = null;
        $this->c_ntel = null;
        $this->c_ndir = null;
        $this->c_freq = null;
        $this->c_ctipo = null;
        $this->c_cown = null;
        $this->c_cstat = null;
        $this->c_crej = null;
        $this->c_cpat = null;
        $this->c_accion = null;
        $this->c_motiv = null;
        $this->c_camp = null;
        $this->d_prom1 = null;
        $this->n_prom1 = null;
        $this->d_prom2 = null;
        $this->n_prom2 = null;
        $this->c_eje = null;
        $this->error = null;
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
        return (string) $this->exportTo(HistoriaPeer::DEFAULT_STRING_FORMAT);
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
