<?php


/**
 * Base class that represents a row from the 'sdhextras' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseSdhextras extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'SdhextrasPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SdhextrasPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the cuenta field.
     * @var        string
     */
    protected $cuenta;

    /**
     * The value for the productos field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $productos;

    /**
     * The value for the st field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $st;

    /**
     * The value for the sv field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $sv;

    /**
     * The value for the sd field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $sd;

    /**
     * The value for the period field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $period;

    /**
     * The value for the monto field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $monto;

    /**
     * The value for the sdd field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $sdd;

    /**
     * The value for the subcuenta field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $subcuenta;

    /**
     * The value for the gc field.
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $gc;

    /**
     * The value for the xmora field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $xmora;

    /**
     * The value for the grupo field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $grupo;

    /**
     * The value for the liquid field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $liquid;

    /**
     * The value for the auto field.
     * @var        int
     */
    protected $auto;

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
        $this->productos = '';
        $this->st = '0.00';
        $this->sv = '0.00';
        $this->sd = '0.00';
        $this->period = '';
        $this->monto = '0.00';
        $this->sdd = '0.00';
        $this->subcuenta = '0';
        $this->gc = '0.00';
        $this->xmora = 0;
        $this->grupo = 0;
        $this->liquid = 0;
    }

    /**
     * Initializes internal state of BaseSdhextras object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
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
     * Get the [productos] column value.
     *
     * @return string
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Get the [st] column value.
     *
     * @return string
     */
    public function getSt()
    {
        return $this->st;
    }

    /**
     * Get the [sv] column value.
     *
     * @return string
     */
    public function getSv()
    {
        return $this->sv;
    }

    /**
     * Get the [sd] column value.
     *
     * @return string
     */
    public function getSd()
    {
        return $this->sd;
    }

    /**
     * Get the [period] column value.
     *
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Get the [monto] column value.
     *
     * @return string
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Get the [sdd] column value.
     *
     * @return string
     */
    public function getSdd()
    {
        return $this->sdd;
    }

    /**
     * Get the [subcuenta] column value.
     *
     * @return string
     */
    public function getSubcuenta()
    {
        return $this->subcuenta;
    }

    /**
     * Get the [gc] column value.
     *
     * @return string
     */
    public function getGc()
    {
        return $this->gc;
    }

    /**
     * Get the [xmora] column value.
     *
     * @return int
     */
    public function getXmora()
    {
        return $this->xmora;
    }

    /**
     * Get the [grupo] column value.
     *
     * @return int
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Get the [liquid] column value.
     *
     * @return int
     */
    public function getLiquid()
    {
        return $this->liquid;
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
     * Set the value of [cuenta] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cuenta !== $v) {
            $this->cuenta = $v;
            $this->modifiedColumns[] = SdhextrasPeer::CUENTA;
        }


        return $this;
    } // setCuenta()

    /**
     * Set the value of [productos] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setProductos($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->productos !== $v) {
            $this->productos = $v;
            $this->modifiedColumns[] = SdhextrasPeer::PRODUCTOS;
        }


        return $this;
    } // setProductos()

    /**
     * Set the value of [st] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setSt($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->st !== $v) {
            $this->st = $v;
            $this->modifiedColumns[] = SdhextrasPeer::ST;
        }


        return $this;
    } // setSt()

    /**
     * Set the value of [sv] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setSv($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sv !== $v) {
            $this->sv = $v;
            $this->modifiedColumns[] = SdhextrasPeer::SV;
        }


        return $this;
    } // setSv()

    /**
     * Set the value of [sd] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setSd($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sd !== $v) {
            $this->sd = $v;
            $this->modifiedColumns[] = SdhextrasPeer::SD;
        }


        return $this;
    } // setSd()

    /**
     * Set the value of [period] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setPeriod($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->period !== $v) {
            $this->period = $v;
            $this->modifiedColumns[] = SdhextrasPeer::PERIOD;
        }


        return $this;
    } // setPeriod()

    /**
     * Set the value of [monto] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setMonto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->monto !== $v) {
            $this->monto = $v;
            $this->modifiedColumns[] = SdhextrasPeer::MONTO;
        }


        return $this;
    } // setMonto()

    /**
     * Set the value of [sdd] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setSdd($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sdd !== $v) {
            $this->sdd = $v;
            $this->modifiedColumns[] = SdhextrasPeer::SDD;
        }


        return $this;
    } // setSdd()

    /**
     * Set the value of [subcuenta] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setSubcuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->subcuenta !== $v) {
            $this->subcuenta = $v;
            $this->modifiedColumns[] = SdhextrasPeer::SUBCUENTA;
        }


        return $this;
    } // setSubcuenta()

    /**
     * Set the value of [gc] column.
     *
     * @param string $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setGc($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->gc !== $v) {
            $this->gc = $v;
            $this->modifiedColumns[] = SdhextrasPeer::GC;
        }


        return $this;
    } // setGc()

    /**
     * Set the value of [xmora] column.
     *
     * @param int $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setXmora($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->xmora !== $v) {
            $this->xmora = $v;
            $this->modifiedColumns[] = SdhextrasPeer::XMORA;
        }


        return $this;
    } // setXmora()

    /**
     * Set the value of [grupo] column.
     *
     * @param int $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setGrupo($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->grupo !== $v) {
            $this->grupo = $v;
            $this->modifiedColumns[] = SdhextrasPeer::GRUPO;
        }


        return $this;
    } // setGrupo()

    /**
     * Set the value of [liquid] column.
     *
     * @param int $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setLiquid($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->liquid !== $v) {
            $this->liquid = $v;
            $this->modifiedColumns[] = SdhextrasPeer::LIQUID;
        }


        return $this;
    } // setLiquid()

    /**
     * Set the value of [auto] column.
     *
     * @param int $v new value
     * @return Sdhextras The current object (for fluent API support)
     */
    public function setAuto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->auto !== $v) {
            $this->auto = $v;
            $this->modifiedColumns[] = SdhextrasPeer::AUTO;
        }


        return $this;
    } // setAuto()

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
            if ($this->productos !== '') {
                return false;
            }

            if ($this->st !== '0.00') {
                return false;
            }

            if ($this->sv !== '0.00') {
                return false;
            }

            if ($this->sd !== '0.00') {
                return false;
            }

            if ($this->period !== '') {
                return false;
            }

            if ($this->monto !== '0.00') {
                return false;
            }

            if ($this->sdd !== '0.00') {
                return false;
            }

            if ($this->subcuenta !== '0') {
                return false;
            }

            if ($this->gc !== '0.00') {
                return false;
            }

            if ($this->xmora !== 0) {
                return false;
            }

            if ($this->grupo !== 0) {
                return false;
            }

            if ($this->liquid !== 0) {
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

            $this->cuenta = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->productos = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->st = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->sv = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->sd = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->period = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->monto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->sdd = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->subcuenta = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->gc = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->xmora = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->grupo = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->liquid = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->auto = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 14; // 14 = SdhextrasPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Sdhextras object", $e);
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
            $con = Propel::getConnection(SdhextrasPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SdhextrasPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(SdhextrasPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SdhextrasQuery::create()
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
            $con = Propel::getConnection(SdhextrasPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                SdhextrasPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = SdhextrasPeer::AUTO;
        if (null !== $this->auto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SdhextrasPeer::AUTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SdhextrasPeer::CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`cuenta`';
        }
        if ($this->isColumnModified(SdhextrasPeer::PRODUCTOS)) {
            $modifiedColumns[':p' . $index++]  = '`productos`';
        }
        if ($this->isColumnModified(SdhextrasPeer::ST)) {
            $modifiedColumns[':p' . $index++]  = '`st`';
        }
        if ($this->isColumnModified(SdhextrasPeer::SV)) {
            $modifiedColumns[':p' . $index++]  = '`sv`';
        }
        if ($this->isColumnModified(SdhextrasPeer::SD)) {
            $modifiedColumns[':p' . $index++]  = '`sd`';
        }
        if ($this->isColumnModified(SdhextrasPeer::PERIOD)) {
            $modifiedColumns[':p' . $index++]  = '`period`';
        }
        if ($this->isColumnModified(SdhextrasPeer::MONTO)) {
            $modifiedColumns[':p' . $index++]  = '`monto`';
        }
        if ($this->isColumnModified(SdhextrasPeer::SDD)) {
            $modifiedColumns[':p' . $index++]  = '`sdd`';
        }
        if ($this->isColumnModified(SdhextrasPeer::SUBCUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`subcuenta`';
        }
        if ($this->isColumnModified(SdhextrasPeer::GC)) {
            $modifiedColumns[':p' . $index++]  = '`gc`';
        }
        if ($this->isColumnModified(SdhextrasPeer::XMORA)) {
            $modifiedColumns[':p' . $index++]  = '`xmora`';
        }
        if ($this->isColumnModified(SdhextrasPeer::GRUPO)) {
            $modifiedColumns[':p' . $index++]  = '`grupo`';
        }
        if ($this->isColumnModified(SdhextrasPeer::LIQUID)) {
            $modifiedColumns[':p' . $index++]  = '`liquid`';
        }
        if ($this->isColumnModified(SdhextrasPeer::AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`auto`';
        }

        $sql = sprintf(
            'INSERT INTO `sdhextras` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`cuenta`':
                        $stmt->bindValue($identifier, $this->cuenta, PDO::PARAM_STR);
                        break;
                    case '`productos`':
                        $stmt->bindValue($identifier, $this->productos, PDO::PARAM_STR);
                        break;
                    case '`st`':
                        $stmt->bindValue($identifier, $this->st, PDO::PARAM_STR);
                        break;
                    case '`sv`':
                        $stmt->bindValue($identifier, $this->sv, PDO::PARAM_STR);
                        break;
                    case '`sd`':
                        $stmt->bindValue($identifier, $this->sd, PDO::PARAM_STR);
                        break;
                    case '`period`':
                        $stmt->bindValue($identifier, $this->period, PDO::PARAM_STR);
                        break;
                    case '`monto`':
                        $stmt->bindValue($identifier, $this->monto, PDO::PARAM_STR);
                        break;
                    case '`sdd`':
                        $stmt->bindValue($identifier, $this->sdd, PDO::PARAM_STR);
                        break;
                    case '`subcuenta`':
                        $stmt->bindValue($identifier, $this->subcuenta, PDO::PARAM_STR);
                        break;
                    case '`gc`':
                        $stmt->bindValue($identifier, $this->gc, PDO::PARAM_STR);
                        break;
                    case '`xmora`':
                        $stmt->bindValue($identifier, $this->xmora, PDO::PARAM_INT);
                        break;
                    case '`grupo`':
                        $stmt->bindValue($identifier, $this->grupo, PDO::PARAM_INT);
                        break;
                    case '`liquid`':
                        $stmt->bindValue($identifier, $this->liquid, PDO::PARAM_INT);
                        break;
                    case '`auto`':
                        $stmt->bindValue($identifier, $this->auto, PDO::PARAM_INT);
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


            if (($retval = SdhextrasPeer::doValidate($this, $columns)) !== true) {
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
        $pos = SdhextrasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCuenta();
                break;
            case 1:
                return $this->getProductos();
                break;
            case 2:
                return $this->getSt();
                break;
            case 3:
                return $this->getSv();
                break;
            case 4:
                return $this->getSd();
                break;
            case 5:
                return $this->getPeriod();
                break;
            case 6:
                return $this->getMonto();
                break;
            case 7:
                return $this->getSdd();
                break;
            case 8:
                return $this->getSubcuenta();
                break;
            case 9:
                return $this->getGc();
                break;
            case 10:
                return $this->getXmora();
                break;
            case 11:
                return $this->getGrupo();
                break;
            case 12:
                return $this->getLiquid();
                break;
            case 13:
                return $this->getAuto();
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
        if (isset($alreadyDumpedObjects['Sdhextras'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Sdhextras'][$this->getPrimaryKey()] = true;
        $keys = SdhextrasPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCuenta(),
            $keys[1] => $this->getProductos(),
            $keys[2] => $this->getSt(),
            $keys[3] => $this->getSv(),
            $keys[4] => $this->getSd(),
            $keys[5] => $this->getPeriod(),
            $keys[6] => $this->getMonto(),
            $keys[7] => $this->getSdd(),
            $keys[8] => $this->getSubcuenta(),
            $keys[9] => $this->getGc(),
            $keys[10] => $this->getXmora(),
            $keys[11] => $this->getGrupo(),
            $keys[12] => $this->getLiquid(),
            $keys[13] => $this->getAuto(),
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
        $pos = SdhextrasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCuenta($value);
                break;
            case 1:
                $this->setProductos($value);
                break;
            case 2:
                $this->setSt($value);
                break;
            case 3:
                $this->setSv($value);
                break;
            case 4:
                $this->setSd($value);
                break;
            case 5:
                $this->setPeriod($value);
                break;
            case 6:
                $this->setMonto($value);
                break;
            case 7:
                $this->setSdd($value);
                break;
            case 8:
                $this->setSubcuenta($value);
                break;
            case 9:
                $this->setGc($value);
                break;
            case 10:
                $this->setXmora($value);
                break;
            case 11:
                $this->setGrupo($value);
                break;
            case 12:
                $this->setLiquid($value);
                break;
            case 13:
                $this->setAuto($value);
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
        $keys = SdhextrasPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setCuenta($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setProductos($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSt($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSv($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSd($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPeriod($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setMonto($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSdd($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setSubcuenta($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setGc($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setXmora($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setGrupo($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setLiquid($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setAuto($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SdhextrasPeer::DATABASE_NAME);

        if ($this->isColumnModified(SdhextrasPeer::CUENTA)) $criteria->add(SdhextrasPeer::CUENTA, $this->cuenta);
        if ($this->isColumnModified(SdhextrasPeer::PRODUCTOS)) $criteria->add(SdhextrasPeer::PRODUCTOS, $this->productos);
        if ($this->isColumnModified(SdhextrasPeer::ST)) $criteria->add(SdhextrasPeer::ST, $this->st);
        if ($this->isColumnModified(SdhextrasPeer::SV)) $criteria->add(SdhextrasPeer::SV, $this->sv);
        if ($this->isColumnModified(SdhextrasPeer::SD)) $criteria->add(SdhextrasPeer::SD, $this->sd);
        if ($this->isColumnModified(SdhextrasPeer::PERIOD)) $criteria->add(SdhextrasPeer::PERIOD, $this->period);
        if ($this->isColumnModified(SdhextrasPeer::MONTO)) $criteria->add(SdhextrasPeer::MONTO, $this->monto);
        if ($this->isColumnModified(SdhextrasPeer::SDD)) $criteria->add(SdhextrasPeer::SDD, $this->sdd);
        if ($this->isColumnModified(SdhextrasPeer::SUBCUENTA)) $criteria->add(SdhextrasPeer::SUBCUENTA, $this->subcuenta);
        if ($this->isColumnModified(SdhextrasPeer::GC)) $criteria->add(SdhextrasPeer::GC, $this->gc);
        if ($this->isColumnModified(SdhextrasPeer::XMORA)) $criteria->add(SdhextrasPeer::XMORA, $this->xmora);
        if ($this->isColumnModified(SdhextrasPeer::GRUPO)) $criteria->add(SdhextrasPeer::GRUPO, $this->grupo);
        if ($this->isColumnModified(SdhextrasPeer::LIQUID)) $criteria->add(SdhextrasPeer::LIQUID, $this->liquid);
        if ($this->isColumnModified(SdhextrasPeer::AUTO)) $criteria->add(SdhextrasPeer::AUTO, $this->auto);

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
        $criteria = new Criteria(SdhextrasPeer::DATABASE_NAME);
        $criteria->add(SdhextrasPeer::AUTO, $this->auto);

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
     * @param object $copyObj An object of Sdhextras (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCuenta($this->getCuenta());
        $copyObj->setProductos($this->getProductos());
        $copyObj->setSt($this->getSt());
        $copyObj->setSv($this->getSv());
        $copyObj->setSd($this->getSd());
        $copyObj->setPeriod($this->getPeriod());
        $copyObj->setMonto($this->getMonto());
        $copyObj->setSdd($this->getSdd());
        $copyObj->setSubcuenta($this->getSubcuenta());
        $copyObj->setGc($this->getGc());
        $copyObj->setXmora($this->getXmora());
        $copyObj->setGrupo($this->getGrupo());
        $copyObj->setLiquid($this->getLiquid());
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
     * @return Sdhextras Clone of current object.
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
     * @return SdhextrasPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SdhextrasPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->cuenta = null;
        $this->productos = null;
        $this->st = null;
        $this->sv = null;
        $this->sd = null;
        $this->period = null;
        $this->monto = null;
        $this->sdd = null;
        $this->subcuenta = null;
        $this->gc = null;
        $this->xmora = null;
        $this->grupo = null;
        $this->liquid = null;
        $this->auto = null;
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
        return (string) $this->exportTo(SdhextrasPeer::DEFAULT_STRING_FORMAT);
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
