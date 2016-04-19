<?php


/**
 * Base static class for performing query and update operations on the 'gchangelog' table.
 *
 *
 *
 * @package propel.generator.cobra.om
 */
abstract class BaseGchangelogPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cobra';

    /** the table name for this class */
    const TABLE_NAME = 'gchangelog';

    /** the related Propel class for this table */
    const OM_CLASS = 'Gchangelog';

    /** the related TableMap class for this table */
    const TM_CLASS = 'GchangelogTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 5;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 5;

    /** the column name for the auto field */
    const AUTO = 'gchangelog.auto';

    /** the column name for the id_cuenta field */
    const ID_CUENTA = 'gchangelog.id_cuenta';

    /** the column name for the fechahora field */
    const FECHAHORA = 'gchangelog.fechahora';

    /** the column name for the gestor_old field */
    const GESTOR_OLD = 'gchangelog.gestor_old';

    /** the column name for the gestor_new field */
    const GESTOR_NEW = 'gchangelog.gestor_new';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Gchangelog objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Gchangelog[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. GchangelogPeer::$fieldNames[GchangelogPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Auto', 'IdCuenta', 'Fechahora', 'GestorOld', 'GestorNew', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('auto', 'idCuenta', 'fechahora', 'gestorOld', 'gestorNew', ),
        BasePeer::TYPE_COLNAME => array (GchangelogPeer::AUTO, GchangelogPeer::ID_CUENTA, GchangelogPeer::FECHAHORA, GchangelogPeer::GESTOR_OLD, GchangelogPeer::GESTOR_NEW, ),
        BasePeer::TYPE_RAW_COLNAME => array ('AUTO', 'ID_CUENTA', 'FECHAHORA', 'GESTOR_OLD', 'GESTOR_NEW', ),
        BasePeer::TYPE_FIELDNAME => array ('auto', 'id_cuenta', 'fechahora', 'gestor_old', 'gestor_new', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. GchangelogPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Auto' => 0, 'IdCuenta' => 1, 'Fechahora' => 2, 'GestorOld' => 3, 'GestorNew' => 4, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('auto' => 0, 'idCuenta' => 1, 'fechahora' => 2, 'gestorOld' => 3, 'gestorNew' => 4, ),
        BasePeer::TYPE_COLNAME => array (GchangelogPeer::AUTO => 0, GchangelogPeer::ID_CUENTA => 1, GchangelogPeer::FECHAHORA => 2, GchangelogPeer::GESTOR_OLD => 3, GchangelogPeer::GESTOR_NEW => 4, ),
        BasePeer::TYPE_RAW_COLNAME => array ('AUTO' => 0, 'ID_CUENTA' => 1, 'FECHAHORA' => 2, 'GESTOR_OLD' => 3, 'GESTOR_NEW' => 4, ),
        BasePeer::TYPE_FIELDNAME => array ('auto' => 0, 'id_cuenta' => 1, 'fechahora' => 2, 'gestor_old' => 3, 'gestor_new' => 4, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
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
        $toNames = GchangelogPeer::getFieldNames($toType);
        $key = isset(GchangelogPeer::$fieldKeys[$fromType][$name]) ? GchangelogPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(GchangelogPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, GchangelogPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return GchangelogPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. GchangelogPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(GchangelogPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(GchangelogPeer::AUTO);
            $criteria->addSelectColumn(GchangelogPeer::ID_CUENTA);
            $criteria->addSelectColumn(GchangelogPeer::FECHAHORA);
            $criteria->addSelectColumn(GchangelogPeer::GESTOR_OLD);
            $criteria->addSelectColumn(GchangelogPeer::GESTOR_NEW);
        } else {
            $criteria->addSelectColumn($alias . '.auto');
            $criteria->addSelectColumn($alias . '.id_cuenta');
            $criteria->addSelectColumn($alias . '.fechahora');
            $criteria->addSelectColumn($alias . '.gestor_old');
            $criteria->addSelectColumn($alias . '.gestor_new');
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
        $criteria->setPrimaryTableName(GchangelogPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            GchangelogPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(GchangelogPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Gchangelog
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = GchangelogPeer::doSelect($critcopy, $con);
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
        return GchangelogPeer::populateObjects(GchangelogPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            GchangelogPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(GchangelogPeer::DATABASE_NAME);

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
     * @param      Gchangelog $obj A Gchangelog object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getAuto();
            } // if key === null
            GchangelogPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Gchangelog object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Gchangelog) {
                $key = (string) $value->getAuto();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Gchangelog object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(GchangelogPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Gchangelog Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(GchangelogPeer::$instances[$key])) {
                return GchangelogPeer::$instances[$key];
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
        foreach (GchangelogPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        GchangelogPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to gchangelog
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
        $cls = GchangelogPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = GchangelogPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = GchangelogPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GchangelogPeer::addInstanceToPool($obj, $key);
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
     * @return array (Gchangelog object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = GchangelogPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = GchangelogPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + GchangelogPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GchangelogPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            GchangelogPeer::addInstanceToPool($obj, $key);
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
        return Propel::getDatabaseMap(GchangelogPeer::DATABASE_NAME)->getTable(GchangelogPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseGchangelogPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseGchangelogPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new GchangelogTableMap());
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
        return GchangelogPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Gchangelog or Criteria object.
     *
     * @param      mixed $values Criteria or Gchangelog object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Gchangelog object
        }

        if ($criteria->containsKey(GchangelogPeer::AUTO) && $criteria->keyContainsValue(GchangelogPeer::AUTO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GchangelogPeer::AUTO.')');
        }


        // Set the correct dbName
        $criteria->setDbName(GchangelogPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Gchangelog or Criteria object.
     *
     * @param      mixed $values Criteria or Gchangelog object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(GchangelogPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(GchangelogPeer::AUTO);
            $value = $criteria->remove(GchangelogPeer::AUTO);
            if ($value) {
                $selectCriteria->add(GchangelogPeer::AUTO, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(GchangelogPeer::TABLE_NAME);
            }

        } else { // $values is Gchangelog object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(GchangelogPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the gchangelog table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(GchangelogPeer::TABLE_NAME, $con, GchangelogPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GchangelogPeer::clearInstancePool();
            GchangelogPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Gchangelog or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Gchangelog object or primary key or array of primary keys
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
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            GchangelogPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Gchangelog) { // it's a model object
            // invalidate the cache for this single object
            GchangelogPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GchangelogPeer::DATABASE_NAME);
            $criteria->add(GchangelogPeer::AUTO, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                GchangelogPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(GchangelogPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            GchangelogPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Gchangelog object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Gchangelog $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(GchangelogPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(GchangelogPeer::TABLE_NAME);

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

        return BasePeer::doValidate(GchangelogPeer::DATABASE_NAME, GchangelogPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Gchangelog
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = GchangelogPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(GchangelogPeer::DATABASE_NAME);
        $criteria->add(GchangelogPeer::AUTO, $pk);

        $v = GchangelogPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Gchangelog[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(GchangelogPeer::DATABASE_NAME);
            $criteria->add(GchangelogPeer::AUTO, $pks, Criteria::IN);
            $objs = GchangelogPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseGchangelogPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseGchangelogPeer::buildTableMap();

