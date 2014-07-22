<?php


/**
 * Base static class for performing query and update operations on the 'folios' table.
 *
 *
 *
 * @package propel.generator.cobra.om
 */
abstract class BaseFoliosPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cobra';

    /** the table name for this class */
    const TABLE_NAME = 'folios';

    /** the related Propel class for this table */
    const OM_CLASS = 'Folios';

    /** the related TableMap class for this table */
    const TM_CLASS = 'FoliosTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 13;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 13;

    /** the column name for the folio field */
    const FOLIO = 'folios.folio';

    /** the column name for the usado field */
    const USADO = 'folios.usado';

    /** the column name for the cuenta field */
    const CUENTA = 'folios.cuenta';

    /** the column name for the gestor field */
    const GESTOR = 'folios.gestor';

    /** the column name for the enviado field */
    const ENVIADO = 'folios.enviado';

    /** the column name for the fecha field */
    const FECHA = 'folios.fecha';

    /** the column name for the mora field */
    const MORA = 'folios.mora';

    /** the column name for the capital field */
    const CAPITAL = 'folios.capital';

    /** the column name for the saldo_can field */
    const SALDO_CAN = 'folios.saldo_can';

    /** the column name for the cliente field */
    const CLIENTE = 'folios.cliente';

    /** the column name for the auto field */
    const AUTO = 'folios.auto';

    /** the column name for the mercancia field */
    const MERCANCIA = 'folios.mercancia';

    /** the column name for the id field */
    const ID = 'folios.id';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Folios objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Folios[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. FoliosPeer::$fieldNames[FoliosPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Folio', 'Usado', 'Cuenta', 'Gestor', 'Enviado', 'Fecha', 'Mora', 'Capital', 'SaldoCan', 'Cliente', 'Auto', 'Mercancia', 'Id', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('folio', 'usado', 'cuenta', 'gestor', 'enviado', 'fecha', 'mora', 'capital', 'saldoCan', 'cliente', 'auto', 'mercancia', 'id', ),
        BasePeer::TYPE_COLNAME => array (FoliosPeer::FOLIO, FoliosPeer::USADO, FoliosPeer::CUENTA, FoliosPeer::GESTOR, FoliosPeer::ENVIADO, FoliosPeer::FECHA, FoliosPeer::MORA, FoliosPeer::CAPITAL, FoliosPeer::SALDO_CAN, FoliosPeer::CLIENTE, FoliosPeer::AUTO, FoliosPeer::MERCANCIA, FoliosPeer::ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('FOLIO', 'USADO', 'CUENTA', 'GESTOR', 'ENVIADO', 'FECHA', 'MORA', 'CAPITAL', 'SALDO_CAN', 'CLIENTE', 'AUTO', 'MERCANCIA', 'ID', ),
        BasePeer::TYPE_FIELDNAME => array ('folio', 'usado', 'cuenta', 'gestor', 'enviado', 'fecha', 'mora', 'capital', 'saldo_can', 'cliente', 'auto', 'mercancia', 'id', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. FoliosPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Folio' => 0, 'Usado' => 1, 'Cuenta' => 2, 'Gestor' => 3, 'Enviado' => 4, 'Fecha' => 5, 'Mora' => 6, 'Capital' => 7, 'SaldoCan' => 8, 'Cliente' => 9, 'Auto' => 10, 'Mercancia' => 11, 'Id' => 12, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('folio' => 0, 'usado' => 1, 'cuenta' => 2, 'gestor' => 3, 'enviado' => 4, 'fecha' => 5, 'mora' => 6, 'capital' => 7, 'saldoCan' => 8, 'cliente' => 9, 'auto' => 10, 'mercancia' => 11, 'id' => 12, ),
        BasePeer::TYPE_COLNAME => array (FoliosPeer::FOLIO => 0, FoliosPeer::USADO => 1, FoliosPeer::CUENTA => 2, FoliosPeer::GESTOR => 3, FoliosPeer::ENVIADO => 4, FoliosPeer::FECHA => 5, FoliosPeer::MORA => 6, FoliosPeer::CAPITAL => 7, FoliosPeer::SALDO_CAN => 8, FoliosPeer::CLIENTE => 9, FoliosPeer::AUTO => 10, FoliosPeer::MERCANCIA => 11, FoliosPeer::ID => 12, ),
        BasePeer::TYPE_RAW_COLNAME => array ('FOLIO' => 0, 'USADO' => 1, 'CUENTA' => 2, 'GESTOR' => 3, 'ENVIADO' => 4, 'FECHA' => 5, 'MORA' => 6, 'CAPITAL' => 7, 'SALDO_CAN' => 8, 'CLIENTE' => 9, 'AUTO' => 10, 'MERCANCIA' => 11, 'ID' => 12, ),
        BasePeer::TYPE_FIELDNAME => array ('folio' => 0, 'usado' => 1, 'cuenta' => 2, 'gestor' => 3, 'enviado' => 4, 'fecha' => 5, 'mora' => 6, 'capital' => 7, 'saldo_can' => 8, 'cliente' => 9, 'auto' => 10, 'mercancia' => 11, 'id' => 12, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $toNames = FoliosPeer::getFieldNames($toType);
        $key = isset(FoliosPeer::$fieldKeys[$fromType][$name]) ? FoliosPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(FoliosPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, FoliosPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return FoliosPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. FoliosPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(FoliosPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(FoliosPeer::FOLIO);
            $criteria->addSelectColumn(FoliosPeer::USADO);
            $criteria->addSelectColumn(FoliosPeer::CUENTA);
            $criteria->addSelectColumn(FoliosPeer::GESTOR);
            $criteria->addSelectColumn(FoliosPeer::ENVIADO);
            $criteria->addSelectColumn(FoliosPeer::FECHA);
            $criteria->addSelectColumn(FoliosPeer::MORA);
            $criteria->addSelectColumn(FoliosPeer::CAPITAL);
            $criteria->addSelectColumn(FoliosPeer::SALDO_CAN);
            $criteria->addSelectColumn(FoliosPeer::CLIENTE);
            $criteria->addSelectColumn(FoliosPeer::AUTO);
            $criteria->addSelectColumn(FoliosPeer::MERCANCIA);
            $criteria->addSelectColumn(FoliosPeer::ID);
        } else {
            $criteria->addSelectColumn($alias . '.folio');
            $criteria->addSelectColumn($alias . '.usado');
            $criteria->addSelectColumn($alias . '.cuenta');
            $criteria->addSelectColumn($alias . '.gestor');
            $criteria->addSelectColumn($alias . '.enviado');
            $criteria->addSelectColumn($alias . '.fecha');
            $criteria->addSelectColumn($alias . '.mora');
            $criteria->addSelectColumn($alias . '.capital');
            $criteria->addSelectColumn($alias . '.saldo_can');
            $criteria->addSelectColumn($alias . '.cliente');
            $criteria->addSelectColumn($alias . '.auto');
            $criteria->addSelectColumn($alias . '.mercancia');
            $criteria->addSelectColumn($alias . '.id');
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
        $criteria->setPrimaryTableName(FoliosPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            FoliosPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(FoliosPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Folios
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = FoliosPeer::doSelect($critcopy, $con);
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
        return FoliosPeer::populateObjects(FoliosPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            FoliosPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(FoliosPeer::DATABASE_NAME);

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
     * @param      Folios $obj A Folios object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getAuto();
            } // if key === null
            FoliosPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Folios object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Folios) {
                $key = (string) $value->getAuto();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Folios object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(FoliosPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Folios Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(FoliosPeer::$instances[$key])) {
                return FoliosPeer::$instances[$key];
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
        foreach (FoliosPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        FoliosPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to folios
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
        if ($row[$startcol + 10] === null) {
            return null;
        }

        return (string) $row[$startcol + 10];
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

        return (int) $row[$startcol + 10];
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
        $cls = FoliosPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = FoliosPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = FoliosPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FoliosPeer::addInstanceToPool($obj, $key);
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
     * @return array (Folios object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = FoliosPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = FoliosPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + FoliosPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FoliosPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            FoliosPeer::addInstanceToPool($obj, $key);
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
        return Propel::getDatabaseMap(FoliosPeer::DATABASE_NAME)->getTable(FoliosPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseFoliosPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseFoliosPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new FoliosTableMap());
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
        return FoliosPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Folios or Criteria object.
     *
     * @param      mixed $values Criteria or Folios object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Folios object
        }

        if ($criteria->containsKey(FoliosPeer::AUTO) && $criteria->keyContainsValue(FoliosPeer::AUTO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FoliosPeer::AUTO.')');
        }


        // Set the correct dbName
        $criteria->setDbName(FoliosPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Folios or Criteria object.
     *
     * @param      mixed $values Criteria or Folios object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(FoliosPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(FoliosPeer::AUTO);
            $value = $criteria->remove(FoliosPeer::AUTO);
            if ($value) {
                $selectCriteria->add(FoliosPeer::AUTO, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(FoliosPeer::TABLE_NAME);
            }

        } else { // $values is Folios object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(FoliosPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the folios table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(FoliosPeer::TABLE_NAME, $con, FoliosPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FoliosPeer::clearInstancePool();
            FoliosPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Folios or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Folios object or primary key or array of primary keys
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
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            FoliosPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Folios) { // it's a model object
            // invalidate the cache for this single object
            FoliosPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FoliosPeer::DATABASE_NAME);
            $criteria->add(FoliosPeer::AUTO, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                FoliosPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(FoliosPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            FoliosPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Folios object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Folios $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(FoliosPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(FoliosPeer::TABLE_NAME);

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

        return BasePeer::doValidate(FoliosPeer::DATABASE_NAME, FoliosPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Folios
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = FoliosPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(FoliosPeer::DATABASE_NAME);
        $criteria->add(FoliosPeer::AUTO, $pk);

        $v = FoliosPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Folios[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(FoliosPeer::DATABASE_NAME);
            $criteria->add(FoliosPeer::AUTO, $pks, Criteria::IN);
            $objs = FoliosPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseFoliosPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseFoliosPeer::buildTableMap();

