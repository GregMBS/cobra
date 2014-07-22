<?php


/**
 * Base class that represents a row from the 'queuelist' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseQueuelist extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'QueuelistPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        QueuelistPeer
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
     * The value for the gestor field.
     * @var        string
     */
    protected $gestor;

    /**
     * The value for the cliente field.
     * @var        string
     */
    protected $cliente;

    /**
     * The value for the status_aarsa field.
     * Note: this column has a database default value of: '.'
     * @var        string
     */
    protected $status_aarsa;

    /**
     * The value for the camp field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $camp;

    /**
     * The value for the orden1 field.
     * Note: this column has a database default value of: 'id_cuenta'
     * @var        string
     */
    protected $orden1;

    /**
     * The value for the updown1 field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $updown1;

    /**
     * The value for the orden2 field.
     * @var        string
     */
    protected $orden2;

    /**
     * The value for the updown2 field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $updown2;

    /**
     * The value for the orden3 field.
     * @var        string
     */
    protected $orden3;

    /**
     * The value for the updown3 field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $updown3;

    /**
     * The value for the sdc field.
     * @var        string
     */
    protected $sdc;

    /**
     * The value for the bloqueado field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $bloqueado;

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
        $this->status_aarsa = '.';
        $this->camp = 0;
        $this->orden1 = 'id_cuenta';
        $this->updown1 = false;
        $this->updown2 = false;
        $this->updown3 = false;
        $this->bloqueado = false;
    }

    /**
     * Initializes internal state of BaseQueuelist object.
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
     * Get the [gestor] column value.
     *
     * @return string
     */
    public function getGestor()
    {
        return $this->gestor;
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
     * Get the [status_aarsa] column value.
     *
     * @return string
     */
    public function getStatusAarsa()
    {
        return $this->status_aarsa;
    }

    /**
     * Get the [camp] column value.
     *
     * @return int
     */
    public function getCamp()
    {
        return $this->camp;
    }

    /**
     * Get the [orden1] column value.
     *
     * @return string
     */
    public function getOrden1()
    {
        return $this->orden1;
    }

    /**
     * Get the [updown1] column value.
     *
     * @return boolean
     */
    public function getUpdown1()
    {
        return $this->updown1;
    }

    /**
     * Get the [orden2] column value.
     *
     * @return string
     */
    public function getOrden2()
    {
        return $this->orden2;
    }

    /**
     * Get the [updown2] column value.
     *
     * @return boolean
     */
    public function getUpdown2()
    {
        return $this->updown2;
    }

    /**
     * Get the [orden3] column value.
     *
     * @return string
     */
    public function getOrden3()
    {
        return $this->orden3;
    }

    /**
     * Get the [updown3] column value.
     *
     * @return boolean
     */
    public function getUpdown3()
    {
        return $this->updown3;
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
     * Get the [bloqueado] column value.
     *
     * @return boolean
     */
    public function getBloqueado()
    {
        return $this->bloqueado;
    }

    /**
     * Set the value of [auto] column.
     *
     * @param int $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setAuto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->auto !== $v) {
            $this->auto = $v;
            $this->modifiedColumns[] = QueuelistPeer::AUTO;
        }


        return $this;
    } // setAuto()

    /**
     * Set the value of [gestor] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setGestor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->gestor !== $v) {
            $this->gestor = $v;
            $this->modifiedColumns[] = QueuelistPeer::GESTOR;
        }


        return $this;
    } // setGestor()

    /**
     * Set the value of [cliente] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setCliente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cliente !== $v) {
            $this->cliente = $v;
            $this->modifiedColumns[] = QueuelistPeer::CLIENTE;
        }


        return $this;
    } // setCliente()

    /**
     * Set the value of [status_aarsa] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setStatusAarsa($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->status_aarsa !== $v) {
            $this->status_aarsa = $v;
            $this->modifiedColumns[] = QueuelistPeer::STATUS_AARSA;
        }


        return $this;
    } // setStatusAarsa()

    /**
     * Set the value of [camp] column.
     *
     * @param int $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setCamp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->camp !== $v) {
            $this->camp = $v;
            $this->modifiedColumns[] = QueuelistPeer::CAMP;
        }


        return $this;
    } // setCamp()

    /**
     * Set the value of [orden1] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setOrden1($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->orden1 !== $v) {
            $this->orden1 = $v;
            $this->modifiedColumns[] = QueuelistPeer::ORDEN1;
        }


        return $this;
    } // setOrden1()

    /**
     * Sets the value of the [updown1] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setUpdown1($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->updown1 !== $v) {
            $this->updown1 = $v;
            $this->modifiedColumns[] = QueuelistPeer::UPDOWN1;
        }


        return $this;
    } // setUpdown1()

    /**
     * Set the value of [orden2] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setOrden2($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->orden2 !== $v) {
            $this->orden2 = $v;
            $this->modifiedColumns[] = QueuelistPeer::ORDEN2;
        }


        return $this;
    } // setOrden2()

    /**
     * Sets the value of the [updown2] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setUpdown2($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->updown2 !== $v) {
            $this->updown2 = $v;
            $this->modifiedColumns[] = QueuelistPeer::UPDOWN2;
        }


        return $this;
    } // setUpdown2()

    /**
     * Set the value of [orden3] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setOrden3($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->orden3 !== $v) {
            $this->orden3 = $v;
            $this->modifiedColumns[] = QueuelistPeer::ORDEN3;
        }


        return $this;
    } // setOrden3()

    /**
     * Sets the value of the [updown3] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setUpdown3($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->updown3 !== $v) {
            $this->updown3 = $v;
            $this->modifiedColumns[] = QueuelistPeer::UPDOWN3;
        }


        return $this;
    } // setUpdown3()

    /**
     * Set the value of [sdc] column.
     *
     * @param string $v new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setSdc($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sdc !== $v) {
            $this->sdc = $v;
            $this->modifiedColumns[] = QueuelistPeer::SDC;
        }


        return $this;
    } // setSdc()

    /**
     * Sets the value of the [bloqueado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Queuelist The current object (for fluent API support)
     */
    public function setBloqueado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->bloqueado !== $v) {
            $this->bloqueado = $v;
            $this->modifiedColumns[] = QueuelistPeer::BLOQUEADO;
        }


        return $this;
    } // setBloqueado()

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
            if ($this->status_aarsa !== '.') {
                return false;
            }

            if ($this->camp !== 0) {
                return false;
            }

            if ($this->orden1 !== 'id_cuenta') {
                return false;
            }

            if ($this->updown1 !== false) {
                return false;
            }

            if ($this->updown2 !== false) {
                return false;
            }

            if ($this->updown3 !== false) {
                return false;
            }

            if ($this->bloqueado !== false) {
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
            $this->gestor = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->cliente = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->status_aarsa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->camp = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->orden1 = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->updown1 = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
            $this->orden2 = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->updown2 = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->orden3 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updown3 = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
            $this->sdc = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->bloqueado = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 13; // 13 = QueuelistPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Queuelist object", $e);
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
            $con = Propel::getConnection(QueuelistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = QueuelistPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(QueuelistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = QueuelistQuery::create()
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
            $con = Propel::getConnection(QueuelistPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                QueuelistPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = QueuelistPeer::AUTO;
        if (null !== $this->auto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . QueuelistPeer::AUTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(QueuelistPeer::AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`auto`';
        }
        if ($this->isColumnModified(QueuelistPeer::GESTOR)) {
            $modifiedColumns[':p' . $index++]  = '`gestor`';
        }
        if ($this->isColumnModified(QueuelistPeer::CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = '`cliente`';
        }
        if ($this->isColumnModified(QueuelistPeer::STATUS_AARSA)) {
            $modifiedColumns[':p' . $index++]  = '`status_aarsa`';
        }
        if ($this->isColumnModified(QueuelistPeer::CAMP)) {
            $modifiedColumns[':p' . $index++]  = '`camp`';
        }
        if ($this->isColumnModified(QueuelistPeer::ORDEN1)) {
            $modifiedColumns[':p' . $index++]  = '`orden1`';
        }
        if ($this->isColumnModified(QueuelistPeer::UPDOWN1)) {
            $modifiedColumns[':p' . $index++]  = '`updown1`';
        }
        if ($this->isColumnModified(QueuelistPeer::ORDEN2)) {
            $modifiedColumns[':p' . $index++]  = '`orden2`';
        }
        if ($this->isColumnModified(QueuelistPeer::UPDOWN2)) {
            $modifiedColumns[':p' . $index++]  = '`updown2`';
        }
        if ($this->isColumnModified(QueuelistPeer::ORDEN3)) {
            $modifiedColumns[':p' . $index++]  = '`orden3`';
        }
        if ($this->isColumnModified(QueuelistPeer::UPDOWN3)) {
            $modifiedColumns[':p' . $index++]  = '`updown3`';
        }
        if ($this->isColumnModified(QueuelistPeer::SDC)) {
            $modifiedColumns[':p' . $index++]  = '`sdc`';
        }
        if ($this->isColumnModified(QueuelistPeer::BLOQUEADO)) {
            $modifiedColumns[':p' . $index++]  = '`bloqueado`';
        }

        $sql = sprintf(
            'INSERT INTO `queuelist` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`auto`':
                        $stmt->bindValue($identifier, $this->auto, PDO::PARAM_INT);
                        break;
                    case '`gestor`':
                        $stmt->bindValue($identifier, $this->gestor, PDO::PARAM_STR);
                        break;
                    case '`cliente`':
                        $stmt->bindValue($identifier, $this->cliente, PDO::PARAM_STR);
                        break;
                    case '`status_aarsa`':
                        $stmt->bindValue($identifier, $this->status_aarsa, PDO::PARAM_STR);
                        break;
                    case '`camp`':
                        $stmt->bindValue($identifier, $this->camp, PDO::PARAM_INT);
                        break;
                    case '`orden1`':
                        $stmt->bindValue($identifier, $this->orden1, PDO::PARAM_STR);
                        break;
                    case '`updown1`':
                        $stmt->bindValue($identifier, (int) $this->updown1, PDO::PARAM_INT);
                        break;
                    case '`orden2`':
                        $stmt->bindValue($identifier, $this->orden2, PDO::PARAM_STR);
                        break;
                    case '`updown2`':
                        $stmt->bindValue($identifier, (int) $this->updown2, PDO::PARAM_INT);
                        break;
                    case '`orden3`':
                        $stmt->bindValue($identifier, $this->orden3, PDO::PARAM_STR);
                        break;
                    case '`updown3`':
                        $stmt->bindValue($identifier, (int) $this->updown3, PDO::PARAM_INT);
                        break;
                    case '`sdc`':
                        $stmt->bindValue($identifier, $this->sdc, PDO::PARAM_STR);
                        break;
                    case '`bloqueado`':
                        $stmt->bindValue($identifier, (int) $this->bloqueado, PDO::PARAM_INT);
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


            if (($retval = QueuelistPeer::doValidate($this, $columns)) !== true) {
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
        $pos = QueuelistPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getGestor();
                break;
            case 2:
                return $this->getCliente();
                break;
            case 3:
                return $this->getStatusAarsa();
                break;
            case 4:
                return $this->getCamp();
                break;
            case 5:
                return $this->getOrden1();
                break;
            case 6:
                return $this->getUpdown1();
                break;
            case 7:
                return $this->getOrden2();
                break;
            case 8:
                return $this->getUpdown2();
                break;
            case 9:
                return $this->getOrden3();
                break;
            case 10:
                return $this->getUpdown3();
                break;
            case 11:
                return $this->getSdc();
                break;
            case 12:
                return $this->getBloqueado();
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
        if (isset($alreadyDumpedObjects['Queuelist'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Queuelist'][$this->getPrimaryKey()] = true;
        $keys = QueuelistPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAuto(),
            $keys[1] => $this->getGestor(),
            $keys[2] => $this->getCliente(),
            $keys[3] => $this->getStatusAarsa(),
            $keys[4] => $this->getCamp(),
            $keys[5] => $this->getOrden1(),
            $keys[6] => $this->getUpdown1(),
            $keys[7] => $this->getOrden2(),
            $keys[8] => $this->getUpdown2(),
            $keys[9] => $this->getOrden3(),
            $keys[10] => $this->getUpdown3(),
            $keys[11] => $this->getSdc(),
            $keys[12] => $this->getBloqueado(),
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
        $pos = QueuelistPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setGestor($value);
                break;
            case 2:
                $this->setCliente($value);
                break;
            case 3:
                $this->setStatusAarsa($value);
                break;
            case 4:
                $this->setCamp($value);
                break;
            case 5:
                $this->setOrden1($value);
                break;
            case 6:
                $this->setUpdown1($value);
                break;
            case 7:
                $this->setOrden2($value);
                break;
            case 8:
                $this->setUpdown2($value);
                break;
            case 9:
                $this->setOrden3($value);
                break;
            case 10:
                $this->setUpdown3($value);
                break;
            case 11:
                $this->setSdc($value);
                break;
            case 12:
                $this->setBloqueado($value);
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
        $keys = QueuelistPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setAuto($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setGestor($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCliente($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStatusAarsa($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCamp($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setOrden1($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUpdown1($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setOrden2($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdown2($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setOrden3($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdown3($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setSdc($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setBloqueado($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(QueuelistPeer::DATABASE_NAME);

        if ($this->isColumnModified(QueuelistPeer::AUTO)) $criteria->add(QueuelistPeer::AUTO, $this->auto);
        if ($this->isColumnModified(QueuelistPeer::GESTOR)) $criteria->add(QueuelistPeer::GESTOR, $this->gestor);
        if ($this->isColumnModified(QueuelistPeer::CLIENTE)) $criteria->add(QueuelistPeer::CLIENTE, $this->cliente);
        if ($this->isColumnModified(QueuelistPeer::STATUS_AARSA)) $criteria->add(QueuelistPeer::STATUS_AARSA, $this->status_aarsa);
        if ($this->isColumnModified(QueuelistPeer::CAMP)) $criteria->add(QueuelistPeer::CAMP, $this->camp);
        if ($this->isColumnModified(QueuelistPeer::ORDEN1)) $criteria->add(QueuelistPeer::ORDEN1, $this->orden1);
        if ($this->isColumnModified(QueuelistPeer::UPDOWN1)) $criteria->add(QueuelistPeer::UPDOWN1, $this->updown1);
        if ($this->isColumnModified(QueuelistPeer::ORDEN2)) $criteria->add(QueuelistPeer::ORDEN2, $this->orden2);
        if ($this->isColumnModified(QueuelistPeer::UPDOWN2)) $criteria->add(QueuelistPeer::UPDOWN2, $this->updown2);
        if ($this->isColumnModified(QueuelistPeer::ORDEN3)) $criteria->add(QueuelistPeer::ORDEN3, $this->orden3);
        if ($this->isColumnModified(QueuelistPeer::UPDOWN3)) $criteria->add(QueuelistPeer::UPDOWN3, $this->updown3);
        if ($this->isColumnModified(QueuelistPeer::SDC)) $criteria->add(QueuelistPeer::SDC, $this->sdc);
        if ($this->isColumnModified(QueuelistPeer::BLOQUEADO)) $criteria->add(QueuelistPeer::BLOQUEADO, $this->bloqueado);

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
        $criteria = new Criteria(QueuelistPeer::DATABASE_NAME);
        $criteria->add(QueuelistPeer::AUTO, $this->auto);

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
     * @param object $copyObj An object of Queuelist (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setGestor($this->getGestor());
        $copyObj->setCliente($this->getCliente());
        $copyObj->setStatusAarsa($this->getStatusAarsa());
        $copyObj->setCamp($this->getCamp());
        $copyObj->setOrden1($this->getOrden1());
        $copyObj->setUpdown1($this->getUpdown1());
        $copyObj->setOrden2($this->getOrden2());
        $copyObj->setUpdown2($this->getUpdown2());
        $copyObj->setOrden3($this->getOrden3());
        $copyObj->setUpdown3($this->getUpdown3());
        $copyObj->setSdc($this->getSdc());
        $copyObj->setBloqueado($this->getBloqueado());
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
     * @return Queuelist Clone of current object.
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
     * @return QueuelistPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new QueuelistPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->auto = null;
        $this->gestor = null;
        $this->cliente = null;
        $this->status_aarsa = null;
        $this->camp = null;
        $this->orden1 = null;
        $this->updown1 = null;
        $this->orden2 = null;
        $this->updown2 = null;
        $this->orden3 = null;
        $this->updown3 = null;
        $this->sdc = null;
        $this->bloqueado = null;
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
        return (string) $this->exportTo(QueuelistPeer::DEFAULT_STRING_FORMAT);
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
