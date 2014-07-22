<?php


/**
 * Base static class for performing query and update operations on the 'historia' table.
 *
 *
 *
 * @package propel.generator.cobra.om
 */
abstract class BaseHistoriaPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cobra';

    /** the table name for this class */
    const TABLE_NAME = 'historia';

    /** the related Propel class for this table */
    const OM_CLASS = 'Historia';

    /** the related TableMap class for this table */
    const TM_CLASS = 'HistoriaTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 49;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 49;

    /** the column name for the Auto field */
    const AUTO = 'historia.Auto';

    /** the column name for the C_CVGE field */
    const C_CVGE = 'historia.C_CVGE';

    /** the column name for the C_CVBA field */
    const C_CVBA = 'historia.C_CVBA';

    /** the column name for the C_CONT field */
    const C_CONT = 'historia.C_CONT';

    /** the column name for the C_CVST field */
    const C_CVST = 'historia.C_CVST';

    /** the column name for the D_FECH field */
    const D_FECH = 'historia.D_FECH';

    /** the column name for the C_HRIN field */
    const C_HRIN = 'historia.C_HRIN';

    /** the column name for the C_HRFI field */
    const C_HRFI = 'historia.C_HRFI';

    /** the column name for the C_TELE field */
    const C_TELE = 'historia.C_TELE';

    /** the column name for the C_MSGE field */
    const C_MSGE = 'historia.C_MSGE';

    /** the column name for the CUENTA field */
    const CUENTA = 'historia.CUENTA';

    /** the column name for the C_OBSE1 field */
    const C_OBSE1 = 'historia.C_OBSE1';

    /** the column name for the C_OBSE2 field */
    const C_OBSE2 = 'historia.C_OBSE2';

    /** the column name for the C_CONTAN field */
    const C_CONTAN = 'historia.C_CONTAN';

    /** the column name for the C_NSE field */
    const C_NSE = 'historia.C_NSE';

    /** the column name for the C_VISIT field */
    const C_VISIT = 'historia.C_VISIT';

    /** the column name for the C_ATTE field */
    const C_ATTE = 'historia.C_ATTE';

    /** the column name for the C_CNIV field */
    const C_CNIV = 'historia.C_CNIV';

    /** the column name for the C_CARG field */
    const C_CARG = 'historia.C_CARG';

    /** the column name for the C_CFAC field */
    const C_CFAC = 'historia.C_CFAC';

    /** the column name for the C_CPTA field */
    const C_CPTA = 'historia.C_CPTA';

    /** the column name for the C_RCON field */
    const C_RCON = 'historia.C_RCON';

    /** the column name for the AUTH field */
    const AUTH = 'historia.AUTH';

    /** the column name for the CARGADO field */
    const CARGADO = 'historia.CARGADO';

    /** the column name for the CUANDO field */
    const CUANDO = 'historia.CUANDO';

    /** the column name for the D_PROM field */
    const D_PROM = 'historia.D_PROM';

    /** the column name for the C_PROM field */
    const C_PROM = 'historia.C_PROM';

    /** the column name for the N_PROM field */
    const N_PROM = 'historia.N_PROM';

    /** the column name for the C_CALLE1 field */
    const C_CALLE1 = 'historia.C_CALLE1';

    /** the column name for the C_CALLE2 field */
    const C_CALLE2 = 'historia.C_CALLE2';

    /** the column name for the C_CNP field */
    const C_CNP = 'historia.C_CNP';

    /** the column name for the C_EMAIL field */
    const C_EMAIL = 'historia.C_EMAIL';

    /** the column name for the C_NTEL field */
    const C_NTEL = 'historia.C_NTEL';

    /** the column name for the C_NDIR field */
    const C_NDIR = 'historia.C_NDIR';

    /** the column name for the C_FREQ field */
    const C_FREQ = 'historia.C_FREQ';

    /** the column name for the C_CTIPO field */
    const C_CTIPO = 'historia.C_CTIPO';

    /** the column name for the C_COWN field */
    const C_COWN = 'historia.C_COWN';

    /** the column name for the C_CSTAT field */
    const C_CSTAT = 'historia.C_CSTAT';

    /** the column name for the C_CREJ field */
    const C_CREJ = 'historia.C_CREJ';

    /** the column name for the C_CPAT field */
    const C_CPAT = 'historia.C_CPAT';

    /** the column name for the C_ACCION field */
    const C_ACCION = 'historia.C_ACCION';

    /** the column name for the C_MOTIV field */
    const C_MOTIV = 'historia.C_MOTIV';

    /** the column name for the C_CAMP field */
    const C_CAMP = 'historia.C_CAMP';

    /** the column name for the D_PROM1 field */
    const D_PROM1 = 'historia.D_PROM1';

    /** the column name for the N_PROM1 field */
    const N_PROM1 = 'historia.N_PROM1';

    /** the column name for the D_PROM2 field */
    const D_PROM2 = 'historia.D_PROM2';

    /** the column name for the N_PROM2 field */
    const N_PROM2 = 'historia.N_PROM2';

    /** the column name for the C_EJE field */
    const C_EJE = 'historia.C_EJE';

    /** the column name for the error field */
    const ERROR = 'historia.error';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Historia objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Historia[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. HistoriaPeer::$fieldNames[HistoriaPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Auto', 'CCvge', 'CCvba', 'CCont', 'CCvst', 'DFech', 'CHrin', 'CHrfi', 'CTele', 'CMsge', 'Cuenta', 'CObse1', 'CObse2', 'CContan', 'CNse', 'CVisit', 'CAtte', 'CCniv', 'CCarg', 'CCfac', 'CCpta', 'CRcon', 'Auth', 'Cargado', 'Cuando', 'DProm', 'CProm', 'NProm', 'CCalle1', 'CCalle2', 'CCnp', 'CEmail', 'CNtel', 'CNdir', 'CFreq', 'CCtipo', 'CCown', 'CCstat', 'CCrej', 'CCpat', 'CAccion', 'CMotiv', 'CCamp', 'DProm1', 'NProm1', 'DProm2', 'NProm2', 'CEje', 'Error', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('auto', 'cCvge', 'cCvba', 'cCont', 'cCvst', 'dFech', 'cHrin', 'cHrfi', 'cTele', 'cMsge', 'cuenta', 'cObse1', 'cObse2', 'cContan', 'cNse', 'cVisit', 'cAtte', 'cCniv', 'cCarg', 'cCfac', 'cCpta', 'cRcon', 'auth', 'cargado', 'cuando', 'dProm', 'cProm', 'nProm', 'cCalle1', 'cCalle2', 'cCnp', 'cEmail', 'cNtel', 'cNdir', 'cFreq', 'cCtipo', 'cCown', 'cCstat', 'cCrej', 'cCpat', 'cAccion', 'cMotiv', 'cCamp', 'dProm1', 'nProm1', 'dProm2', 'nProm2', 'cEje', 'error', ),
        BasePeer::TYPE_COLNAME => array (HistoriaPeer::AUTO, HistoriaPeer::C_CVGE, HistoriaPeer::C_CVBA, HistoriaPeer::C_CONT, HistoriaPeer::C_CVST, HistoriaPeer::D_FECH, HistoriaPeer::C_HRIN, HistoriaPeer::C_HRFI, HistoriaPeer::C_TELE, HistoriaPeer::C_MSGE, HistoriaPeer::CUENTA, HistoriaPeer::C_OBSE1, HistoriaPeer::C_OBSE2, HistoriaPeer::C_CONTAN, HistoriaPeer::C_NSE, HistoriaPeer::C_VISIT, HistoriaPeer::C_ATTE, HistoriaPeer::C_CNIV, HistoriaPeer::C_CARG, HistoriaPeer::C_CFAC, HistoriaPeer::C_CPTA, HistoriaPeer::C_RCON, HistoriaPeer::AUTH, HistoriaPeer::CARGADO, HistoriaPeer::CUANDO, HistoriaPeer::D_PROM, HistoriaPeer::C_PROM, HistoriaPeer::N_PROM, HistoriaPeer::C_CALLE1, HistoriaPeer::C_CALLE2, HistoriaPeer::C_CNP, HistoriaPeer::C_EMAIL, HistoriaPeer::C_NTEL, HistoriaPeer::C_NDIR, HistoriaPeer::C_FREQ, HistoriaPeer::C_CTIPO, HistoriaPeer::C_COWN, HistoriaPeer::C_CSTAT, HistoriaPeer::C_CREJ, HistoriaPeer::C_CPAT, HistoriaPeer::C_ACCION, HistoriaPeer::C_MOTIV, HistoriaPeer::C_CAMP, HistoriaPeer::D_PROM1, HistoriaPeer::N_PROM1, HistoriaPeer::D_PROM2, HistoriaPeer::N_PROM2, HistoriaPeer::C_EJE, HistoriaPeer::ERROR, ),
        BasePeer::TYPE_RAW_COLNAME => array ('AUTO', 'C_CVGE', 'C_CVBA', 'C_CONT', 'C_CVST', 'D_FECH', 'C_HRIN', 'C_HRFI', 'C_TELE', 'C_MSGE', 'CUENTA', 'C_OBSE1', 'C_OBSE2', 'C_CONTAN', 'C_NSE', 'C_VISIT', 'C_ATTE', 'C_CNIV', 'C_CARG', 'C_CFAC', 'C_CPTA', 'C_RCON', 'AUTH', 'CARGADO', 'CUANDO', 'D_PROM', 'C_PROM', 'N_PROM', 'C_CALLE1', 'C_CALLE2', 'C_CNP', 'C_EMAIL', 'C_NTEL', 'C_NDIR', 'C_FREQ', 'C_CTIPO', 'C_COWN', 'C_CSTAT', 'C_CREJ', 'C_CPAT', 'C_ACCION', 'C_MOTIV', 'C_CAMP', 'D_PROM1', 'N_PROM1', 'D_PROM2', 'N_PROM2', 'C_EJE', 'ERROR', ),
        BasePeer::TYPE_FIELDNAME => array ('Auto', 'C_CVGE', 'C_CVBA', 'C_CONT', 'C_CVST', 'D_FECH', 'C_HRIN', 'C_HRFI', 'C_TELE', 'C_MSGE', 'CUENTA', 'C_OBSE1', 'C_OBSE2', 'C_CONTAN', 'C_NSE', 'C_VISIT', 'C_ATTE', 'C_CNIV', 'C_CARG', 'C_CFAC', 'C_CPTA', 'C_RCON', 'AUTH', 'CARGADO', 'CUANDO', 'D_PROM', 'C_PROM', 'N_PROM', 'C_CALLE1', 'C_CALLE2', 'C_CNP', 'C_EMAIL', 'C_NTEL', 'C_NDIR', 'C_FREQ', 'C_CTIPO', 'C_COWN', 'C_CSTAT', 'C_CREJ', 'C_CPAT', 'C_ACCION', 'C_MOTIV', 'C_CAMP', 'D_PROM1', 'N_PROM1', 'D_PROM2', 'N_PROM2', 'C_EJE', 'error', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. HistoriaPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Auto' => 0, 'CCvge' => 1, 'CCvba' => 2, 'CCont' => 3, 'CCvst' => 4, 'DFech' => 5, 'CHrin' => 6, 'CHrfi' => 7, 'CTele' => 8, 'CMsge' => 9, 'Cuenta' => 10, 'CObse1' => 11, 'CObse2' => 12, 'CContan' => 13, 'CNse' => 14, 'CVisit' => 15, 'CAtte' => 16, 'CCniv' => 17, 'CCarg' => 18, 'CCfac' => 19, 'CCpta' => 20, 'CRcon' => 21, 'Auth' => 22, 'Cargado' => 23, 'Cuando' => 24, 'DProm' => 25, 'CProm' => 26, 'NProm' => 27, 'CCalle1' => 28, 'CCalle2' => 29, 'CCnp' => 30, 'CEmail' => 31, 'CNtel' => 32, 'CNdir' => 33, 'CFreq' => 34, 'CCtipo' => 35, 'CCown' => 36, 'CCstat' => 37, 'CCrej' => 38, 'CCpat' => 39, 'CAccion' => 40, 'CMotiv' => 41, 'CCamp' => 42, 'DProm1' => 43, 'NProm1' => 44, 'DProm2' => 45, 'NProm2' => 46, 'CEje' => 47, 'Error' => 48, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('auto' => 0, 'cCvge' => 1, 'cCvba' => 2, 'cCont' => 3, 'cCvst' => 4, 'dFech' => 5, 'cHrin' => 6, 'cHrfi' => 7, 'cTele' => 8, 'cMsge' => 9, 'cuenta' => 10, 'cObse1' => 11, 'cObse2' => 12, 'cContan' => 13, 'cNse' => 14, 'cVisit' => 15, 'cAtte' => 16, 'cCniv' => 17, 'cCarg' => 18, 'cCfac' => 19, 'cCpta' => 20, 'cRcon' => 21, 'auth' => 22, 'cargado' => 23, 'cuando' => 24, 'dProm' => 25, 'cProm' => 26, 'nProm' => 27, 'cCalle1' => 28, 'cCalle2' => 29, 'cCnp' => 30, 'cEmail' => 31, 'cNtel' => 32, 'cNdir' => 33, 'cFreq' => 34, 'cCtipo' => 35, 'cCown' => 36, 'cCstat' => 37, 'cCrej' => 38, 'cCpat' => 39, 'cAccion' => 40, 'cMotiv' => 41, 'cCamp' => 42, 'dProm1' => 43, 'nProm1' => 44, 'dProm2' => 45, 'nProm2' => 46, 'cEje' => 47, 'error' => 48, ),
        BasePeer::TYPE_COLNAME => array (HistoriaPeer::AUTO => 0, HistoriaPeer::C_CVGE => 1, HistoriaPeer::C_CVBA => 2, HistoriaPeer::C_CONT => 3, HistoriaPeer::C_CVST => 4, HistoriaPeer::D_FECH => 5, HistoriaPeer::C_HRIN => 6, HistoriaPeer::C_HRFI => 7, HistoriaPeer::C_TELE => 8, HistoriaPeer::C_MSGE => 9, HistoriaPeer::CUENTA => 10, HistoriaPeer::C_OBSE1 => 11, HistoriaPeer::C_OBSE2 => 12, HistoriaPeer::C_CONTAN => 13, HistoriaPeer::C_NSE => 14, HistoriaPeer::C_VISIT => 15, HistoriaPeer::C_ATTE => 16, HistoriaPeer::C_CNIV => 17, HistoriaPeer::C_CARG => 18, HistoriaPeer::C_CFAC => 19, HistoriaPeer::C_CPTA => 20, HistoriaPeer::C_RCON => 21, HistoriaPeer::AUTH => 22, HistoriaPeer::CARGADO => 23, HistoriaPeer::CUANDO => 24, HistoriaPeer::D_PROM => 25, HistoriaPeer::C_PROM => 26, HistoriaPeer::N_PROM => 27, HistoriaPeer::C_CALLE1 => 28, HistoriaPeer::C_CALLE2 => 29, HistoriaPeer::C_CNP => 30, HistoriaPeer::C_EMAIL => 31, HistoriaPeer::C_NTEL => 32, HistoriaPeer::C_NDIR => 33, HistoriaPeer::C_FREQ => 34, HistoriaPeer::C_CTIPO => 35, HistoriaPeer::C_COWN => 36, HistoriaPeer::C_CSTAT => 37, HistoriaPeer::C_CREJ => 38, HistoriaPeer::C_CPAT => 39, HistoriaPeer::C_ACCION => 40, HistoriaPeer::C_MOTIV => 41, HistoriaPeer::C_CAMP => 42, HistoriaPeer::D_PROM1 => 43, HistoriaPeer::N_PROM1 => 44, HistoriaPeer::D_PROM2 => 45, HistoriaPeer::N_PROM2 => 46, HistoriaPeer::C_EJE => 47, HistoriaPeer::ERROR => 48, ),
        BasePeer::TYPE_RAW_COLNAME => array ('AUTO' => 0, 'C_CVGE' => 1, 'C_CVBA' => 2, 'C_CONT' => 3, 'C_CVST' => 4, 'D_FECH' => 5, 'C_HRIN' => 6, 'C_HRFI' => 7, 'C_TELE' => 8, 'C_MSGE' => 9, 'CUENTA' => 10, 'C_OBSE1' => 11, 'C_OBSE2' => 12, 'C_CONTAN' => 13, 'C_NSE' => 14, 'C_VISIT' => 15, 'C_ATTE' => 16, 'C_CNIV' => 17, 'C_CARG' => 18, 'C_CFAC' => 19, 'C_CPTA' => 20, 'C_RCON' => 21, 'AUTH' => 22, 'CARGADO' => 23, 'CUANDO' => 24, 'D_PROM' => 25, 'C_PROM' => 26, 'N_PROM' => 27, 'C_CALLE1' => 28, 'C_CALLE2' => 29, 'C_CNP' => 30, 'C_EMAIL' => 31, 'C_NTEL' => 32, 'C_NDIR' => 33, 'C_FREQ' => 34, 'C_CTIPO' => 35, 'C_COWN' => 36, 'C_CSTAT' => 37, 'C_CREJ' => 38, 'C_CPAT' => 39, 'C_ACCION' => 40, 'C_MOTIV' => 41, 'C_CAMP' => 42, 'D_PROM1' => 43, 'N_PROM1' => 44, 'D_PROM2' => 45, 'N_PROM2' => 46, 'C_EJE' => 47, 'ERROR' => 48, ),
        BasePeer::TYPE_FIELDNAME => array ('Auto' => 0, 'C_CVGE' => 1, 'C_CVBA' => 2, 'C_CONT' => 3, 'C_CVST' => 4, 'D_FECH' => 5, 'C_HRIN' => 6, 'C_HRFI' => 7, 'C_TELE' => 8, 'C_MSGE' => 9, 'CUENTA' => 10, 'C_OBSE1' => 11, 'C_OBSE2' => 12, 'C_CONTAN' => 13, 'C_NSE' => 14, 'C_VISIT' => 15, 'C_ATTE' => 16, 'C_CNIV' => 17, 'C_CARG' => 18, 'C_CFAC' => 19, 'C_CPTA' => 20, 'C_RCON' => 21, 'AUTH' => 22, 'CARGADO' => 23, 'CUANDO' => 24, 'D_PROM' => 25, 'C_PROM' => 26, 'N_PROM' => 27, 'C_CALLE1' => 28, 'C_CALLE2' => 29, 'C_CNP' => 30, 'C_EMAIL' => 31, 'C_NTEL' => 32, 'C_NDIR' => 33, 'C_FREQ' => 34, 'C_CTIPO' => 35, 'C_COWN' => 36, 'C_CSTAT' => 37, 'C_CREJ' => 38, 'C_CPAT' => 39, 'C_ACCION' => 40, 'C_MOTIV' => 41, 'C_CAMP' => 42, 'D_PROM1' => 43, 'N_PROM1' => 44, 'D_PROM2' => 45, 'N_PROM2' => 46, 'C_EJE' => 47, 'error' => 48, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, )
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
        $toNames = HistoriaPeer::getFieldNames($toType);
        $key = isset(HistoriaPeer::$fieldKeys[$fromType][$name]) ? HistoriaPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(HistoriaPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, HistoriaPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return HistoriaPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. HistoriaPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(HistoriaPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(HistoriaPeer::AUTO);
            $criteria->addSelectColumn(HistoriaPeer::C_CVGE);
            $criteria->addSelectColumn(HistoriaPeer::C_CVBA);
            $criteria->addSelectColumn(HistoriaPeer::C_CONT);
            $criteria->addSelectColumn(HistoriaPeer::C_CVST);
            $criteria->addSelectColumn(HistoriaPeer::D_FECH);
            $criteria->addSelectColumn(HistoriaPeer::C_HRIN);
            $criteria->addSelectColumn(HistoriaPeer::C_HRFI);
            $criteria->addSelectColumn(HistoriaPeer::C_TELE);
            $criteria->addSelectColumn(HistoriaPeer::C_MSGE);
            $criteria->addSelectColumn(HistoriaPeer::CUENTA);
            $criteria->addSelectColumn(HistoriaPeer::C_OBSE1);
            $criteria->addSelectColumn(HistoriaPeer::C_OBSE2);
            $criteria->addSelectColumn(HistoriaPeer::C_CONTAN);
            $criteria->addSelectColumn(HistoriaPeer::C_NSE);
            $criteria->addSelectColumn(HistoriaPeer::C_VISIT);
            $criteria->addSelectColumn(HistoriaPeer::C_ATTE);
            $criteria->addSelectColumn(HistoriaPeer::C_CNIV);
            $criteria->addSelectColumn(HistoriaPeer::C_CARG);
            $criteria->addSelectColumn(HistoriaPeer::C_CFAC);
            $criteria->addSelectColumn(HistoriaPeer::C_CPTA);
            $criteria->addSelectColumn(HistoriaPeer::C_RCON);
            $criteria->addSelectColumn(HistoriaPeer::AUTH);
            $criteria->addSelectColumn(HistoriaPeer::CARGADO);
            $criteria->addSelectColumn(HistoriaPeer::CUANDO);
            $criteria->addSelectColumn(HistoriaPeer::D_PROM);
            $criteria->addSelectColumn(HistoriaPeer::C_PROM);
            $criteria->addSelectColumn(HistoriaPeer::N_PROM);
            $criteria->addSelectColumn(HistoriaPeer::C_CALLE1);
            $criteria->addSelectColumn(HistoriaPeer::C_CALLE2);
            $criteria->addSelectColumn(HistoriaPeer::C_CNP);
            $criteria->addSelectColumn(HistoriaPeer::C_EMAIL);
            $criteria->addSelectColumn(HistoriaPeer::C_NTEL);
            $criteria->addSelectColumn(HistoriaPeer::C_NDIR);
            $criteria->addSelectColumn(HistoriaPeer::C_FREQ);
            $criteria->addSelectColumn(HistoriaPeer::C_CTIPO);
            $criteria->addSelectColumn(HistoriaPeer::C_COWN);
            $criteria->addSelectColumn(HistoriaPeer::C_CSTAT);
            $criteria->addSelectColumn(HistoriaPeer::C_CREJ);
            $criteria->addSelectColumn(HistoriaPeer::C_CPAT);
            $criteria->addSelectColumn(HistoriaPeer::C_ACCION);
            $criteria->addSelectColumn(HistoriaPeer::C_MOTIV);
            $criteria->addSelectColumn(HistoriaPeer::C_CAMP);
            $criteria->addSelectColumn(HistoriaPeer::D_PROM1);
            $criteria->addSelectColumn(HistoriaPeer::N_PROM1);
            $criteria->addSelectColumn(HistoriaPeer::D_PROM2);
            $criteria->addSelectColumn(HistoriaPeer::N_PROM2);
            $criteria->addSelectColumn(HistoriaPeer::C_EJE);
            $criteria->addSelectColumn(HistoriaPeer::ERROR);
        } else {
            $criteria->addSelectColumn($alias . '.Auto');
            $criteria->addSelectColumn($alias . '.C_CVGE');
            $criteria->addSelectColumn($alias . '.C_CVBA');
            $criteria->addSelectColumn($alias . '.C_CONT');
            $criteria->addSelectColumn($alias . '.C_CVST');
            $criteria->addSelectColumn($alias . '.D_FECH');
            $criteria->addSelectColumn($alias . '.C_HRIN');
            $criteria->addSelectColumn($alias . '.C_HRFI');
            $criteria->addSelectColumn($alias . '.C_TELE');
            $criteria->addSelectColumn($alias . '.C_MSGE');
            $criteria->addSelectColumn($alias . '.CUENTA');
            $criteria->addSelectColumn($alias . '.C_OBSE1');
            $criteria->addSelectColumn($alias . '.C_OBSE2');
            $criteria->addSelectColumn($alias . '.C_CONTAN');
            $criteria->addSelectColumn($alias . '.C_NSE');
            $criteria->addSelectColumn($alias . '.C_VISIT');
            $criteria->addSelectColumn($alias . '.C_ATTE');
            $criteria->addSelectColumn($alias . '.C_CNIV');
            $criteria->addSelectColumn($alias . '.C_CARG');
            $criteria->addSelectColumn($alias . '.C_CFAC');
            $criteria->addSelectColumn($alias . '.C_CPTA');
            $criteria->addSelectColumn($alias . '.C_RCON');
            $criteria->addSelectColumn($alias . '.AUTH');
            $criteria->addSelectColumn($alias . '.CARGADO');
            $criteria->addSelectColumn($alias . '.CUANDO');
            $criteria->addSelectColumn($alias . '.D_PROM');
            $criteria->addSelectColumn($alias . '.C_PROM');
            $criteria->addSelectColumn($alias . '.N_PROM');
            $criteria->addSelectColumn($alias . '.C_CALLE1');
            $criteria->addSelectColumn($alias . '.C_CALLE2');
            $criteria->addSelectColumn($alias . '.C_CNP');
            $criteria->addSelectColumn($alias . '.C_EMAIL');
            $criteria->addSelectColumn($alias . '.C_NTEL');
            $criteria->addSelectColumn($alias . '.C_NDIR');
            $criteria->addSelectColumn($alias . '.C_FREQ');
            $criteria->addSelectColumn($alias . '.C_CTIPO');
            $criteria->addSelectColumn($alias . '.C_COWN');
            $criteria->addSelectColumn($alias . '.C_CSTAT');
            $criteria->addSelectColumn($alias . '.C_CREJ');
            $criteria->addSelectColumn($alias . '.C_CPAT');
            $criteria->addSelectColumn($alias . '.C_ACCION');
            $criteria->addSelectColumn($alias . '.C_MOTIV');
            $criteria->addSelectColumn($alias . '.C_CAMP');
            $criteria->addSelectColumn($alias . '.D_PROM1');
            $criteria->addSelectColumn($alias . '.N_PROM1');
            $criteria->addSelectColumn($alias . '.D_PROM2');
            $criteria->addSelectColumn($alias . '.N_PROM2');
            $criteria->addSelectColumn($alias . '.C_EJE');
            $criteria->addSelectColumn($alias . '.error');
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
        $criteria->setPrimaryTableName(HistoriaPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            HistoriaPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(HistoriaPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Historia
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = HistoriaPeer::doSelect($critcopy, $con);
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
        return HistoriaPeer::populateObjects(HistoriaPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            HistoriaPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(HistoriaPeer::DATABASE_NAME);

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
     * @param      Historia $obj A Historia object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getAuto();
            } // if key === null
            HistoriaPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Historia object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Historia) {
                $key = (string) $value->getAuto();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Historia object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(HistoriaPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Historia Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(HistoriaPeer::$instances[$key])) {
                return HistoriaPeer::$instances[$key];
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
        foreach (HistoriaPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        HistoriaPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to historia
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
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
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

        return (int) $row[$startcol];
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
        $cls = HistoriaPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = HistoriaPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = HistoriaPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HistoriaPeer::addInstanceToPool($obj, $key);
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
     * @return array (Historia object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = HistoriaPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = HistoriaPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + HistoriaPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HistoriaPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            HistoriaPeer::addInstanceToPool($obj, $key);
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
        return Propel::getDatabaseMap(HistoriaPeer::DATABASE_NAME)->getTable(HistoriaPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseHistoriaPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseHistoriaPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new HistoriaTableMap());
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
        return HistoriaPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Historia or Criteria object.
     *
     * @param      mixed $values Criteria or Historia object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Historia object
        }

        if ($criteria->containsKey(HistoriaPeer::AUTO) && $criteria->keyContainsValue(HistoriaPeer::AUTO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HistoriaPeer::AUTO.')');
        }


        // Set the correct dbName
        $criteria->setDbName(HistoriaPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Historia or Criteria object.
     *
     * @param      mixed $values Criteria or Historia object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(HistoriaPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(HistoriaPeer::AUTO);
            $value = $criteria->remove(HistoriaPeer::AUTO);
            if ($value) {
                $selectCriteria->add(HistoriaPeer::AUTO, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(HistoriaPeer::TABLE_NAME);
            }

        } else { // $values is Historia object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(HistoriaPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the historia table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(HistoriaPeer::TABLE_NAME, $con, HistoriaPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HistoriaPeer::clearInstancePool();
            HistoriaPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Historia or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Historia object or primary key or array of primary keys
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
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            HistoriaPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Historia) { // it's a model object
            // invalidate the cache for this single object
            HistoriaPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HistoriaPeer::DATABASE_NAME);
            $criteria->add(HistoriaPeer::AUTO, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                HistoriaPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(HistoriaPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            HistoriaPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Historia object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Historia $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(HistoriaPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(HistoriaPeer::TABLE_NAME);

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

        return BasePeer::doValidate(HistoriaPeer::DATABASE_NAME, HistoriaPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Historia
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = HistoriaPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(HistoriaPeer::DATABASE_NAME);
        $criteria->add(HistoriaPeer::AUTO, $pk);

        $v = HistoriaPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Historia[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(HistoriaPeer::DATABASE_NAME);
            $criteria->add(HistoriaPeer::AUTO, $pks, Criteria::IN);
            $objs = HistoriaPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseHistoriaPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseHistoriaPeer::buildTableMap();

