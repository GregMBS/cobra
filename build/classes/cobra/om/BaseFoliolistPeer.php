<?php


/**
 * Base static class for performing query and update operations on the 'foliolist' table.
 *
 *
 *
 * @package propel.generator.cobra.om
 */
abstract class BaseFoliolistPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cobra';

    /** the table name for this class */
    const TABLE_NAME = 'foliolist';

    /** the related Propel class for this table */
    const OM_CLASS = 'Foliolist';

    /** the related TableMap class for this table */
    const TM_CLASS = 'FoliolistTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 28;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 28;

    /** the column name for the cliente field */
    const CLIENTE = 'foliolist.cliente';

    /** the column name for the folio field */
    const FOLIO = 'foliolist.folio';

    /** the column name for the enviado field */
    const ENVIADO = 'foliolist.enviado';

    /** the column name for the upda field */
    const UPDA = 'foliolist.upda';

    /** the column name for the crear field */
    const CREAR = 'foliolist.crear';

    /** the column name for the cuenta field */
    const CUENTA = 'foliolist.cuenta';

    /** the column name for the nombre_deudor field */
    const NOMBRE_DEUDOR = 'foliolist.nombre_deudor';

    /** the column name for the capital field */
    const CAPITAL = 'foliolist.capital';

    /** the column name for the saldo_can field */
    const SALDO_CAN = 'foliolist.saldo_can';

    /** the column name for the mora field */
    const MORA = 'foliolist.mora';

    /** the column name for the n_prom field */
    const N_PROM = 'foliolist.n_prom';

    /** the column name for the d_prom1 field */
    const D_PROM1 = 'foliolist.d_prom1';

    /** the column name for the n_prom1 field */
    const N_PROM1 = 'foliolist.n_prom1';

    /** the column name for the d_prom2 field */
    const D_PROM2 = 'foliolist.d_prom2';

    /** the column name for the n_prom2 field */
    const N_PROM2 = 'foliolist.n_prom2';

    /** the column name for the cuenta_concentradora_1 field */
    const CUENTA_CONCENTRADORA_1 = 'foliolist.cuenta_concentradora_1';

    /** the column name for the d_fech field */
    const D_FECH = 'foliolist.d_fech';

    /** the column name for the id_cuenta field */
    const ID_CUENTA = 'foliolist.id_cuenta';

    /** the column name for the cnp field */
    const CNP = 'foliolist.cnp';

    /** the column name for the auto field */
    const AUTO = 'foliolist.auto';

    /** the column name for the ciudad_deudor field */
    const CIUDAD_DEUDOR = 'foliolist.ciudad_deudor';

    /** the column name for the estado_deudor field */
    const ESTADO_DEUDOR = 'foliolist.estado_deudor';

    /** the column name for the gestor field */
    const GESTOR = 'foliolist.gestor';

    /** the column name for the sdc field */
    const SDC = 'foliolist.sdc';

    /** the column name for the upd field */
    const UPD = 'foliolist.upd';

    /** the column name for the c_prom field */
    const C_PROM = 'foliolist.c_prom';

    /** the column name for the c_freq field */
    const C_FREQ = 'foliolist.c_freq';

    /** the column name for the diff field */
    const DIFF = 'foliolist.diff';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Foliolist objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Foliolist[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. FoliolistPeer::$fieldNames[FoliolistPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Cliente', 'Folio', 'Enviado', 'Upda', 'Crear', 'Cuenta', 'NombreDeudor', 'Capital', 'SaldoCan', 'Mora', 'NProm', 'DProm1', 'NProm1', 'DProm2', 'NProm2', 'CuentaConcentradora1', 'DFech', 'IdCuenta', 'Cnp', 'Auto', 'CiudadDeudor', 'EstadoDeudor', 'Gestor', 'Sdc', 'Upd', 'CProm', 'CFreq', 'Diff', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('cliente', 'folio', 'enviado', 'upda', 'crear', 'cuenta', 'nombreDeudor', 'capital', 'saldoCan', 'mora', 'nProm', 'dProm1', 'nProm1', 'dProm2', 'nProm2', 'cuentaConcentradora1', 'dFech', 'idCuenta', 'cnp', 'auto', 'ciudadDeudor', 'estadoDeudor', 'gestor', 'sdc', 'upd', 'cProm', 'cFreq', 'diff', ),
        BasePeer::TYPE_COLNAME => array (FoliolistPeer::CLIENTE, FoliolistPeer::FOLIO, FoliolistPeer::ENVIADO, FoliolistPeer::UPDA, FoliolistPeer::CREAR, FoliolistPeer::CUENTA, FoliolistPeer::NOMBRE_DEUDOR, FoliolistPeer::CAPITAL, FoliolistPeer::SALDO_CAN, FoliolistPeer::MORA, FoliolistPeer::N_PROM, FoliolistPeer::D_PROM1, FoliolistPeer::N_PROM1, FoliolistPeer::D_PROM2, FoliolistPeer::N_PROM2, FoliolistPeer::CUENTA_CONCENTRADORA_1, FoliolistPeer::D_FECH, FoliolistPeer::ID_CUENTA, FoliolistPeer::CNP, FoliolistPeer::AUTO, FoliolistPeer::CIUDAD_DEUDOR, FoliolistPeer::ESTADO_DEUDOR, FoliolistPeer::GESTOR, FoliolistPeer::SDC, FoliolistPeer::UPD, FoliolistPeer::C_PROM, FoliolistPeer::C_FREQ, FoliolistPeer::DIFF, ),
        BasePeer::TYPE_RAW_COLNAME => array ('CLIENTE', 'FOLIO', 'ENVIADO', 'UPDA', 'CREAR', 'CUENTA', 'NOMBRE_DEUDOR', 'CAPITAL', 'SALDO_CAN', 'MORA', 'N_PROM', 'D_PROM1', 'N_PROM1', 'D_PROM2', 'N_PROM2', 'CUENTA_CONCENTRADORA_1', 'D_FECH', 'ID_CUENTA', 'CNP', 'AUTO', 'CIUDAD_DEUDOR', 'ESTADO_DEUDOR', 'GESTOR', 'SDC', 'UPD', 'C_PROM', 'C_FREQ', 'DIFF', ),
        BasePeer::TYPE_FIELDNAME => array ('cliente', 'folio', 'enviado', 'upda', 'crear', 'cuenta', 'nombre_deudor', 'capital', 'saldo_can', 'mora', 'n_prom', 'd_prom1', 'n_prom1', 'd_prom2', 'n_prom2', 'cuenta_concentradora_1', 'd_fech', 'id_cuenta', 'cnp', 'auto', 'ciudad_deudor', 'estado_deudor', 'gestor', 'sdc', 'upd', 'c_prom', 'c_freq', 'diff', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. FoliolistPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Cliente' => 0, 'Folio' => 1, 'Enviado' => 2, 'Upda' => 3, 'Crear' => 4, 'Cuenta' => 5, 'NombreDeudor' => 6, 'Capital' => 7, 'SaldoCan' => 8, 'Mora' => 9, 'NProm' => 10, 'DProm1' => 11, 'NProm1' => 12, 'DProm2' => 13, 'NProm2' => 14, 'CuentaConcentradora1' => 15, 'DFech' => 16, 'IdCuenta' => 17, 'Cnp' => 18, 'Auto' => 19, 'CiudadDeudor' => 20, 'EstadoDeudor' => 21, 'Gestor' => 22, 'Sdc' => 23, 'Upd' => 24, 'CProm' => 25, 'CFreq' => 26, 'Diff' => 27, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('cliente' => 0, 'folio' => 1, 'enviado' => 2, 'upda' => 3, 'crear' => 4, 'cuenta' => 5, 'nombreDeudor' => 6, 'capital' => 7, 'saldoCan' => 8, 'mora' => 9, 'nProm' => 10, 'dProm1' => 11, 'nProm1' => 12, 'dProm2' => 13, 'nProm2' => 14, 'cuentaConcentradora1' => 15, 'dFech' => 16, 'idCuenta' => 17, 'cnp' => 18, 'auto' => 19, 'ciudadDeudor' => 20, 'estadoDeudor' => 21, 'gestor' => 22, 'sdc' => 23, 'upd' => 24, 'cProm' => 25, 'cFreq' => 26, 'diff' => 27, ),
        BasePeer::TYPE_COLNAME => array (FoliolistPeer::CLIENTE => 0, FoliolistPeer::FOLIO => 1, FoliolistPeer::ENVIADO => 2, FoliolistPeer::UPDA => 3, FoliolistPeer::CREAR => 4, FoliolistPeer::CUENTA => 5, FoliolistPeer::NOMBRE_DEUDOR => 6, FoliolistPeer::CAPITAL => 7, FoliolistPeer::SALDO_CAN => 8, FoliolistPeer::MORA => 9, FoliolistPeer::N_PROM => 10, FoliolistPeer::D_PROM1 => 11, FoliolistPeer::N_PROM1 => 12, FoliolistPeer::D_PROM2 => 13, FoliolistPeer::N_PROM2 => 14, FoliolistPeer::CUENTA_CONCENTRADORA_1 => 15, FoliolistPeer::D_FECH => 16, FoliolistPeer::ID_CUENTA => 17, FoliolistPeer::CNP => 18, FoliolistPeer::AUTO => 19, FoliolistPeer::CIUDAD_DEUDOR => 20, FoliolistPeer::ESTADO_DEUDOR => 21, FoliolistPeer::GESTOR => 22, FoliolistPeer::SDC => 23, FoliolistPeer::UPD => 24, FoliolistPeer::C_PROM => 25, FoliolistPeer::C_FREQ => 26, FoliolistPeer::DIFF => 27, ),
        BasePeer::TYPE_RAW_COLNAME => array ('CLIENTE' => 0, 'FOLIO' => 1, 'ENVIADO' => 2, 'UPDA' => 3, 'CREAR' => 4, 'CUENTA' => 5, 'NOMBRE_DEUDOR' => 6, 'CAPITAL' => 7, 'SALDO_CAN' => 8, 'MORA' => 9, 'N_PROM' => 10, 'D_PROM1' => 11, 'N_PROM1' => 12, 'D_PROM2' => 13, 'N_PROM2' => 14, 'CUENTA_CONCENTRADORA_1' => 15, 'D_FECH' => 16, 'ID_CUENTA' => 17, 'CNP' => 18, 'AUTO' => 19, 'CIUDAD_DEUDOR' => 20, 'ESTADO_DEUDOR' => 21, 'GESTOR' => 22, 'SDC' => 23, 'UPD' => 24, 'C_PROM' => 25, 'C_FREQ' => 26, 'DIFF' => 27, ),
        BasePeer::TYPE_FIELDNAME => array ('cliente' => 0, 'folio' => 1, 'enviado' => 2, 'upda' => 3, 'crear' => 4, 'cuenta' => 5, 'nombre_deudor' => 6, 'capital' => 7, 'saldo_can' => 8, 'mora' => 9, 'n_prom' => 10, 'd_prom1' => 11, 'n_prom1' => 12, 'd_prom2' => 13, 'n_prom2' => 14, 'cuenta_concentradora_1' => 15, 'd_fech' => 16, 'id_cuenta' => 17, 'cnp' => 18, 'auto' => 19, 'ciudad_deudor' => 20, 'estado_deudor' => 21, 'gestor' => 22, 'sdc' => 23, 'upd' => 24, 'c_prom' => 25, 'c_freq' => 26, 'diff' => 27, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, )
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
        $toNames = FoliolistPeer::getFieldNames($toType);
        $key = isset(FoliolistPeer::$fieldKeys[$fromType][$name]) ? FoliolistPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(FoliolistPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, FoliolistPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return FoliolistPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. FoliolistPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(FoliolistPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(FoliolistPeer::CLIENTE);
            $criteria->addSelectColumn(FoliolistPeer::FOLIO);
            $criteria->addSelectColumn(FoliolistPeer::ENVIADO);
            $criteria->addSelectColumn(FoliolistPeer::UPDA);
            $criteria->addSelectColumn(FoliolistPeer::CREAR);
            $criteria->addSelectColumn(FoliolistPeer::CUENTA);
            $criteria->addSelectColumn(FoliolistPeer::NOMBRE_DEUDOR);
            $criteria->addSelectColumn(FoliolistPeer::CAPITAL);
            $criteria->addSelectColumn(FoliolistPeer::SALDO_CAN);
            $criteria->addSelectColumn(FoliolistPeer::MORA);
            $criteria->addSelectColumn(FoliolistPeer::N_PROM);
            $criteria->addSelectColumn(FoliolistPeer::D_PROM1);
            $criteria->addSelectColumn(FoliolistPeer::N_PROM1);
            $criteria->addSelectColumn(FoliolistPeer::D_PROM2);
            $criteria->addSelectColumn(FoliolistPeer::N_PROM2);
            $criteria->addSelectColumn(FoliolistPeer::CUENTA_CONCENTRADORA_1);
            $criteria->addSelectColumn(FoliolistPeer::D_FECH);
            $criteria->addSelectColumn(FoliolistPeer::ID_CUENTA);
            $criteria->addSelectColumn(FoliolistPeer::CNP);
            $criteria->addSelectColumn(FoliolistPeer::AUTO);
            $criteria->addSelectColumn(FoliolistPeer::CIUDAD_DEUDOR);
            $criteria->addSelectColumn(FoliolistPeer::ESTADO_DEUDOR);
            $criteria->addSelectColumn(FoliolistPeer::GESTOR);
            $criteria->addSelectColumn(FoliolistPeer::SDC);
            $criteria->addSelectColumn(FoliolistPeer::UPD);
            $criteria->addSelectColumn(FoliolistPeer::C_PROM);
            $criteria->addSelectColumn(FoliolistPeer::C_FREQ);
            $criteria->addSelectColumn(FoliolistPeer::DIFF);
        } else {
            $criteria->addSelectColumn($alias . '.cliente');
            $criteria->addSelectColumn($alias . '.folio');
            $criteria->addSelectColumn($alias . '.enviado');
            $criteria->addSelectColumn($alias . '.upda');
            $criteria->addSelectColumn($alias . '.crear');
            $criteria->addSelectColumn($alias . '.cuenta');
            $criteria->addSelectColumn($alias . '.nombre_deudor');
            $criteria->addSelectColumn($alias . '.capital');
            $criteria->addSelectColumn($alias . '.saldo_can');
            $criteria->addSelectColumn($alias . '.mora');
            $criteria->addSelectColumn($alias . '.n_prom');
            $criteria->addSelectColumn($alias . '.d_prom1');
            $criteria->addSelectColumn($alias . '.n_prom1');
            $criteria->addSelectColumn($alias . '.d_prom2');
            $criteria->addSelectColumn($alias . '.n_prom2');
            $criteria->addSelectColumn($alias . '.cuenta_concentradora_1');
            $criteria->addSelectColumn($alias . '.d_fech');
            $criteria->addSelectColumn($alias . '.id_cuenta');
            $criteria->addSelectColumn($alias . '.cnp');
            $criteria->addSelectColumn($alias . '.auto');
            $criteria->addSelectColumn($alias . '.ciudad_deudor');
            $criteria->addSelectColumn($alias . '.estado_deudor');
            $criteria->addSelectColumn($alias . '.gestor');
            $criteria->addSelectColumn($alias . '.sdc');
            $criteria->addSelectColumn($alias . '.upd');
            $criteria->addSelectColumn($alias . '.c_prom');
            $criteria->addSelectColumn($alias . '.c_freq');
            $criteria->addSelectColumn($alias . '.diff');
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
        $criteria->setPrimaryTableName(FoliolistPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            FoliolistPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(FoliolistPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Foliolist
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = FoliolistPeer::doSelect($critcopy, $con);
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
        return FoliolistPeer::populateObjects(FoliolistPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            FoliolistPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(FoliolistPeer::DATABASE_NAME);

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
     * @param      Foliolist $obj A Foliolist object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getCliente(), (string) $obj->getFolio()));
            } // if key === null
            FoliolistPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Foliolist object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Foliolist) {
                $key = serialize(array((string) $value->getCliente(), (string) $value->getFolio()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Foliolist object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(FoliolistPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Foliolist Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(FoliolistPeer::$instances[$key])) {
                return FoliolistPeer::$instances[$key];
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
        foreach (FoliolistPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        FoliolistPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to foliolist
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
        if ($row[$startcol] === null && $row[$startcol + 1] === null) {
            return null;
        }

        return serialize(array((string) $row[$startcol], (string) $row[$startcol + 1]));
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

        return array((string) $row[$startcol], (int) $row[$startcol + 1]);
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
        $cls = FoliolistPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = FoliolistPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = FoliolistPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FoliolistPeer::addInstanceToPool($obj, $key);
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
     * @return array (Foliolist object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = FoliolistPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = FoliolistPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + FoliolistPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FoliolistPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            FoliolistPeer::addInstanceToPool($obj, $key);
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
        return Propel::getDatabaseMap(FoliolistPeer::DATABASE_NAME)->getTable(FoliolistPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseFoliolistPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseFoliolistPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new FoliolistTableMap());
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
        return FoliolistPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Foliolist or Criteria object.
     *
     * @param      mixed $values Criteria or Foliolist object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Foliolist object
        }


        // Set the correct dbName
        $criteria->setDbName(FoliolistPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Foliolist or Criteria object.
     *
     * @param      mixed $values Criteria or Foliolist object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(FoliolistPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(FoliolistPeer::CLIENTE);
            $value = $criteria->remove(FoliolistPeer::CLIENTE);
            if ($value) {
                $selectCriteria->add(FoliolistPeer::CLIENTE, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(FoliolistPeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(FoliolistPeer::FOLIO);
            $value = $criteria->remove(FoliolistPeer::FOLIO);
            if ($value) {
                $selectCriteria->add(FoliolistPeer::FOLIO, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(FoliolistPeer::TABLE_NAME);
            }

        } else { // $values is Foliolist object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(FoliolistPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the foliolist table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(FoliolistPeer::TABLE_NAME, $con, FoliolistPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FoliolistPeer::clearInstancePool();
            FoliolistPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Foliolist or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Foliolist object or primary key or array of primary keys
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
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            FoliolistPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Foliolist) { // it's a model object
            // invalidate the cache for this single object
            FoliolistPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FoliolistPeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(FoliolistPeer::CLIENTE, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(FoliolistPeer::FOLIO, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                FoliolistPeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(FoliolistPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            FoliolistPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Foliolist object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Foliolist $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(FoliolistPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(FoliolistPeer::TABLE_NAME);

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

        return BasePeer::doValidate(FoliolistPeer::DATABASE_NAME, FoliolistPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   string $cliente
     * @param   int $folio
     * @param      PropelPDO $con
     * @return   Foliolist
     */
    public static function retrieveByPK($cliente, $folio, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $cliente, (string) $folio));
         if (null !== ($obj = FoliolistPeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(FoliolistPeer::DATABASE_NAME);
        $criteria->add(FoliolistPeer::CLIENTE, $cliente);
        $criteria->add(FoliolistPeer::FOLIO, $folio);
        $v = FoliolistPeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseFoliolistPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseFoliolistPeer::buildTableMap();

