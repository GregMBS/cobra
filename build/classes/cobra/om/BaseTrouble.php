<?php


/**
 * Base class that represents a row from the 'trouble' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseTrouble extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TroublePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TroublePeer
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
     * The value for the fechahora field.
     * @var        string
     */
    protected $fechahora;

    /**
     * The value for the sistema field.
     * @var        string
     */
    protected $sistema;

    /**
     * The value for the usuario field.
     * @var        string
     */
    protected $usuario;

    /**
     * The value for the fuente field.
     * @var        string
     */
    protected $fuente;

    /**
     * The value for the descripcion field.
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the error_msg field.
     * @var        string
     */
    protected $error_msg;

    /**
     * The value for the fechacomp field.
     * Note: this column has a database default value of: NULL
     * @var        string
     */
    protected $fechacomp;

    /**
     * The value for the it_guy field.
     * @var        string
     */
    protected $it_guy;

    /**
     * The value for the reparacion field.
     * @var        string
     */
    protected $reparacion;

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
        $this->fechacomp = NULL;
    }

    /**
     * Initializes internal state of BaseTrouble object.
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
     * Get the [optionally formatted] temporal [fechahora] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechahora($format = 'Y-m-d H:i:s')
    {
        if ($this->fechahora === null) {
            return null;
        }

        if ($this->fechahora === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fechahora);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fechahora, true), $x);
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
     * Get the [sistema] column value.
     *
     * @return string
     */
    public function getSistema()
    {
        return $this->sistema;
    }

    /**
     * Get the [usuario] column value.
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Get the [fuente] column value.
     *
     * @return string
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Get the [descripcion] column value.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the [error_msg] column value.
     *
     * @return string
     */
    public function getErrorMsg()
    {
        return $this->error_msg;
    }

    /**
     * Get the [optionally formatted] temporal [fechacomp] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechacomp($format = 'Y-m-d H:i:s')
    {
        if ($this->fechacomp === null) {
            return null;
        }

        if ($this->fechacomp === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fechacomp);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fechacomp, true), $x);
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
     * Get the [it_guy] column value.
     *
     * @return string
     */
    public function getItGuy()
    {
        return $this->it_guy;
    }

    /**
     * Get the [reparacion] column value.
     *
     * @return string
     */
    public function getReparacion()
    {
        return $this->reparacion;
    }

    /**
     * Set the value of [auto] column.
     *
     * @param int $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setAuto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->auto !== $v) {
            $this->auto = $v;
            $this->modifiedColumns[] = TroublePeer::AUTO;
        }


        return $this;
    } // setAuto()

    /**
     * Sets the value of [fechahora] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Trouble The current object (for fluent API support)
     */
    public function setFechahora($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fechahora !== null || $dt !== null) {
            $currentDateAsString = ($this->fechahora !== null && $tmpDt = new DateTime($this->fechahora)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fechahora = $newDateAsString;
                $this->modifiedColumns[] = TroublePeer::FECHAHORA;
            }
        } // if either are not null


        return $this;
    } // setFechahora()

    /**
     * Set the value of [sistema] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setSistema($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->sistema !== $v) {
            $this->sistema = $v;
            $this->modifiedColumns[] = TroublePeer::SISTEMA;
        }


        return $this;
    } // setSistema()

    /**
     * Set the value of [usuario] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setUsuario($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usuario !== $v) {
            $this->usuario = $v;
            $this->modifiedColumns[] = TroublePeer::USUARIO;
        }


        return $this;
    } // setUsuario()

    /**
     * Set the value of [fuente] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setFuente($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->fuente !== $v) {
            $this->fuente = $v;
            $this->modifiedColumns[] = TroublePeer::FUENTE;
        }


        return $this;
    } // setFuente()

    /**
     * Set the value of [descripcion] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[] = TroublePeer::DESCRIPCION;
        }


        return $this;
    } // setDescripcion()

    /**
     * Set the value of [error_msg] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setErrorMsg($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->error_msg !== $v) {
            $this->error_msg = $v;
            $this->modifiedColumns[] = TroublePeer::ERROR_MSG;
        }


        return $this;
    } // setErrorMsg()

    /**
     * Sets the value of [fechacomp] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Trouble The current object (for fluent API support)
     */
    public function setFechacomp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fechacomp !== null || $dt !== null) {
            $currentDateAsString = ($this->fechacomp !== null && $tmpDt = new DateTime($this->fechacomp)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->fechacomp = $newDateAsString;
                $this->modifiedColumns[] = TroublePeer::FECHACOMP;
            }
        } // if either are not null


        return $this;
    } // setFechacomp()

    /**
     * Set the value of [it_guy] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setItGuy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->it_guy !== $v) {
            $this->it_guy = $v;
            $this->modifiedColumns[] = TroublePeer::IT_GUY;
        }


        return $this;
    } // setItGuy()

    /**
     * Set the value of [reparacion] column.
     *
     * @param string $v new value
     * @return Trouble The current object (for fluent API support)
     */
    public function setReparacion($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->reparacion !== $v) {
            $this->reparacion = $v;
            $this->modifiedColumns[] = TroublePeer::REPARACION;
        }


        return $this;
    } // setReparacion()

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
            if ($this->fechacomp !== NULL) {
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
            $this->fechahora = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->sistema = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->usuario = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->fuente = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->descripcion = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->error_msg = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->fechacomp = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->it_guy = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->reparacion = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 10; // 10 = TroublePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Trouble object", $e);
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
            $con = Propel::getConnection(TroublePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TroublePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(TroublePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TroubleQuery::create()
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
            $con = Propel::getConnection(TroublePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TroublePeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = TroublePeer::AUTO;
        if (null !== $this->auto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TroublePeer::AUTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TroublePeer::AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`auto`';
        }
        if ($this->isColumnModified(TroublePeer::FECHAHORA)) {
            $modifiedColumns[':p' . $index++]  = '`fechahora`';
        }
        if ($this->isColumnModified(TroublePeer::SISTEMA)) {
            $modifiedColumns[':p' . $index++]  = '`sistema`';
        }
        if ($this->isColumnModified(TroublePeer::USUARIO)) {
            $modifiedColumns[':p' . $index++]  = '`usuario`';
        }
        if ($this->isColumnModified(TroublePeer::FUENTE)) {
            $modifiedColumns[':p' . $index++]  = '`fuente`';
        }
        if ($this->isColumnModified(TroublePeer::DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`descripcion`';
        }
        if ($this->isColumnModified(TroublePeer::ERROR_MSG)) {
            $modifiedColumns[':p' . $index++]  = '`error_msg`';
        }
        if ($this->isColumnModified(TroublePeer::FECHACOMP)) {
            $modifiedColumns[':p' . $index++]  = '`fechacomp`';
        }
        if ($this->isColumnModified(TroublePeer::IT_GUY)) {
            $modifiedColumns[':p' . $index++]  = '`it_guy`';
        }
        if ($this->isColumnModified(TroublePeer::REPARACION)) {
            $modifiedColumns[':p' . $index++]  = '`reparacion`';
        }

        $sql = sprintf(
            'INSERT INTO `trouble` (%s) VALUES (%s)',
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
                    case '`fechahora`':
                        $stmt->bindValue($identifier, $this->fechahora, PDO::PARAM_STR);
                        break;
                    case '`sistema`':
                        $stmt->bindValue($identifier, $this->sistema, PDO::PARAM_STR);
                        break;
                    case '`usuario`':
                        $stmt->bindValue($identifier, $this->usuario, PDO::PARAM_STR);
                        break;
                    case '`fuente`':
                        $stmt->bindValue($identifier, $this->fuente, PDO::PARAM_STR);
                        break;
                    case '`descripcion`':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case '`error_msg`':
                        $stmt->bindValue($identifier, $this->error_msg, PDO::PARAM_STR);
                        break;
                    case '`fechacomp`':
                        $stmt->bindValue($identifier, $this->fechacomp, PDO::PARAM_STR);
                        break;
                    case '`it_guy`':
                        $stmt->bindValue($identifier, $this->it_guy, PDO::PARAM_STR);
                        break;
                    case '`reparacion`':
                        $stmt->bindValue($identifier, $this->reparacion, PDO::PARAM_STR);
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


            if (($retval = TroublePeer::doValidate($this, $columns)) !== true) {
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
        $pos = TroublePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFechahora();
                break;
            case 2:
                return $this->getSistema();
                break;
            case 3:
                return $this->getUsuario();
                break;
            case 4:
                return $this->getFuente();
                break;
            case 5:
                return $this->getDescripcion();
                break;
            case 6:
                return $this->getErrorMsg();
                break;
            case 7:
                return $this->getFechacomp();
                break;
            case 8:
                return $this->getItGuy();
                break;
            case 9:
                return $this->getReparacion();
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
        if (isset($alreadyDumpedObjects['Trouble'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Trouble'][$this->getPrimaryKey()] = true;
        $keys = TroublePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAuto(),
            $keys[1] => $this->getFechahora(),
            $keys[2] => $this->getSistema(),
            $keys[3] => $this->getUsuario(),
            $keys[4] => $this->getFuente(),
            $keys[5] => $this->getDescripcion(),
            $keys[6] => $this->getErrorMsg(),
            $keys[7] => $this->getFechacomp(),
            $keys[8] => $this->getItGuy(),
            $keys[9] => $this->getReparacion(),
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
        $pos = TroublePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFechahora($value);
                break;
            case 2:
                $this->setSistema($value);
                break;
            case 3:
                $this->setUsuario($value);
                break;
            case 4:
                $this->setFuente($value);
                break;
            case 5:
                $this->setDescripcion($value);
                break;
            case 6:
                $this->setErrorMsg($value);
                break;
            case 7:
                $this->setFechacomp($value);
                break;
            case 8:
                $this->setItGuy($value);
                break;
            case 9:
                $this->setReparacion($value);
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
        $keys = TroublePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setAuto($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFechahora($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSistema($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUsuario($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFuente($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDescripcion($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setErrorMsg($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setFechacomp($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setItGuy($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setReparacion($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TroublePeer::DATABASE_NAME);

        if ($this->isColumnModified(TroublePeer::AUTO)) $criteria->add(TroublePeer::AUTO, $this->auto);
        if ($this->isColumnModified(TroublePeer::FECHAHORA)) $criteria->add(TroublePeer::FECHAHORA, $this->fechahora);
        if ($this->isColumnModified(TroublePeer::SISTEMA)) $criteria->add(TroublePeer::SISTEMA, $this->sistema);
        if ($this->isColumnModified(TroublePeer::USUARIO)) $criteria->add(TroublePeer::USUARIO, $this->usuario);
        if ($this->isColumnModified(TroublePeer::FUENTE)) $criteria->add(TroublePeer::FUENTE, $this->fuente);
        if ($this->isColumnModified(TroublePeer::DESCRIPCION)) $criteria->add(TroublePeer::DESCRIPCION, $this->descripcion);
        if ($this->isColumnModified(TroublePeer::ERROR_MSG)) $criteria->add(TroublePeer::ERROR_MSG, $this->error_msg);
        if ($this->isColumnModified(TroublePeer::FECHACOMP)) $criteria->add(TroublePeer::FECHACOMP, $this->fechacomp);
        if ($this->isColumnModified(TroublePeer::IT_GUY)) $criteria->add(TroublePeer::IT_GUY, $this->it_guy);
        if ($this->isColumnModified(TroublePeer::REPARACION)) $criteria->add(TroublePeer::REPARACION, $this->reparacion);

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
        $criteria = new Criteria(TroublePeer::DATABASE_NAME);
        $criteria->add(TroublePeer::AUTO, $this->auto);

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
     * @param object $copyObj An object of Trouble (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFechahora($this->getFechahora());
        $copyObj->setSistema($this->getSistema());
        $copyObj->setUsuario($this->getUsuario());
        $copyObj->setFuente($this->getFuente());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setErrorMsg($this->getErrorMsg());
        $copyObj->setFechacomp($this->getFechacomp());
        $copyObj->setItGuy($this->getItGuy());
        $copyObj->setReparacion($this->getReparacion());
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
     * @return Trouble Clone of current object.
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
     * @return TroublePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TroublePeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->auto = null;
        $this->fechahora = null;
        $this->sistema = null;
        $this->usuario = null;
        $this->fuente = null;
        $this->descripcion = null;
        $this->error_msg = null;
        $this->fechacomp = null;
        $this->it_guy = null;
        $this->reparacion = null;
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
        return (string) $this->exportTo(TroublePeer::DEFAULT_STRING_FORMAT);
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
