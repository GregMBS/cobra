<?php


/**
 * Base class that represents a row from the 'nombres' table.
 *
 *
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseNombres extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'NombresPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NombresPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the usuaria field.
     * @var        string
     */
    protected $usuaria;

    /**
     * The value for the iniciales field.
     * @var        string
     */
    protected $iniciales;

    /**
     * The value for the completo field.
     * @var        string
     */
    protected $completo;

    /**
     * The value for the tipo field.
     * @var        string
     */
    protected $tipo;

    /**
     * The value for the ticket field.
     * @var        string
     */
    protected $ticket;

    /**
     * The value for the camp field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $camp;

    /**
     * The value for the turno field.
     * @var        string
     */
    protected $turno;

    /**
     * The value for the authcode field.
     * @var        string
     */
    protected $authcode;

    /**
     * The value for the passw field.
     * Note: this column has a database default value of: 'adarc'
     * @var        string
     */
    protected $passw;

    /**
     * The value for the policy field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $policy;

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
        $this->camp = 0;
        $this->passw = 'adarc';
        $this->policy = 0;
    }

    /**
     * Initializes internal state of BaseNombres object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [usuaria] column value.
     *
     * @return string
     */
    public function getUsuaria()
    {
        return $this->usuaria;
    }

    /**
     * Get the [iniciales] column value.
     *
     * @return string
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }

    /**
     * Get the [completo] column value.
     *
     * @return string
     */
    public function getCompleto()
    {
        return $this->completo;
    }

    /**
     * Get the [tipo] column value.
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get the [ticket] column value.
     *
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
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
     * Get the [turno] column value.
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Get the [authcode] column value.
     *
     * @return string
     */
    public function getAuthcode()
    {
        return $this->authcode;
    }

    /**
     * Get the [passw] column value.
     *
     * @return string
     */
    public function getPassw()
    {
        return $this->passw;
    }

    /**
     * Get the [policy] column value.
     *
     * @return int
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * Set the value of [usuaria] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setUsuaria($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usuaria !== $v) {
            $this->usuaria = $v;
            $this->modifiedColumns[] = NombresPeer::USUARIA;
        }


        return $this;
    } // setUsuaria()

    /**
     * Set the value of [iniciales] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setIniciales($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->iniciales !== $v) {
            $this->iniciales = $v;
            $this->modifiedColumns[] = NombresPeer::INICIALES;
        }


        return $this;
    } // setIniciales()

    /**
     * Set the value of [completo] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setCompleto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->completo !== $v) {
            $this->completo = $v;
            $this->modifiedColumns[] = NombresPeer::COMPLETO;
        }


        return $this;
    } // setCompleto()

    /**
     * Set the value of [tipo] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setTipo($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tipo !== $v) {
            $this->tipo = $v;
            $this->modifiedColumns[] = NombresPeer::TIPO;
        }


        return $this;
    } // setTipo()

    /**
     * Set the value of [ticket] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setTicket($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ticket !== $v) {
            $this->ticket = $v;
            $this->modifiedColumns[] = NombresPeer::TICKET;
        }


        return $this;
    } // setTicket()

    /**
     * Set the value of [camp] column.
     *
     * @param int $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setCamp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->camp !== $v) {
            $this->camp = $v;
            $this->modifiedColumns[] = NombresPeer::CAMP;
        }


        return $this;
    } // setCamp()

    /**
     * Set the value of [turno] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setTurno($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->turno !== $v) {
            $this->turno = $v;
            $this->modifiedColumns[] = NombresPeer::TURNO;
        }


        return $this;
    } // setTurno()

    /**
     * Set the value of [authcode] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setAuthcode($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->authcode !== $v) {
            $this->authcode = $v;
            $this->modifiedColumns[] = NombresPeer::AUTHCODE;
        }


        return $this;
    } // setAuthcode()

    /**
     * Set the value of [passw] column.
     *
     * @param string $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setPassw($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->passw !== $v) {
            $this->passw = $v;
            $this->modifiedColumns[] = NombresPeer::PASSW;
        }


        return $this;
    } // setPassw()

    /**
     * Set the value of [policy] column.
     *
     * @param int $v new value
     * @return Nombres The current object (for fluent API support)
     */
    public function setPolicy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->policy !== $v) {
            $this->policy = $v;
            $this->modifiedColumns[] = NombresPeer::POLICY;
        }


        return $this;
    } // setPolicy()

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
            if ($this->camp !== 0) {
                return false;
            }

            if ($this->passw !== 'adarc') {
                return false;
            }

            if ($this->policy !== 0) {
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

            $this->usuaria = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->iniciales = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->completo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->tipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->ticket = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->camp = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->turno = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->authcode = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->passw = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->policy = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 10; // 10 = NombresPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Nombres object", $e);
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
            $con = Propel::getConnection(NombresPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NombresPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(NombresPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NombresQuery::create()
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
            $con = Propel::getConnection(NombresPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NombresPeer::addInstanceToPool($this);
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
        if ($this->isColumnModified(NombresPeer::USUARIA)) {
            $modifiedColumns[':p' . $index++]  = '`USUARIA`';
        }
        if ($this->isColumnModified(NombresPeer::INICIALES)) {
            $modifiedColumns[':p' . $index++]  = '`INICIALES`';
        }
        if ($this->isColumnModified(NombresPeer::COMPLETO)) {
            $modifiedColumns[':p' . $index++]  = '`COMPLETO`';
        }
        if ($this->isColumnModified(NombresPeer::TIPO)) {
            $modifiedColumns[':p' . $index++]  = '`TIPO`';
        }
        if ($this->isColumnModified(NombresPeer::TICKET)) {
            $modifiedColumns[':p' . $index++]  = '`TICKET`';
        }
        if ($this->isColumnModified(NombresPeer::CAMP)) {
            $modifiedColumns[':p' . $index++]  = '`camp`';
        }
        if ($this->isColumnModified(NombresPeer::TURNO)) {
            $modifiedColumns[':p' . $index++]  = '`turno`';
        }
        if ($this->isColumnModified(NombresPeer::AUTHCODE)) {
            $modifiedColumns[':p' . $index++]  = '`authcode`';
        }
        if ($this->isColumnModified(NombresPeer::PASSW)) {
            $modifiedColumns[':p' . $index++]  = '`passw`';
        }
        if ($this->isColumnModified(NombresPeer::POLICY)) {
            $modifiedColumns[':p' . $index++]  = '`policy`';
        }

        $sql = sprintf(
            'INSERT INTO `nombres` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`USUARIA`':
                        $stmt->bindValue($identifier, $this->usuaria, PDO::PARAM_STR);
                        break;
                    case '`INICIALES`':
                        $stmt->bindValue($identifier, $this->iniciales, PDO::PARAM_STR);
                        break;
                    case '`COMPLETO`':
                        $stmt->bindValue($identifier, $this->completo, PDO::PARAM_STR);
                        break;
                    case '`TIPO`':
                        $stmt->bindValue($identifier, $this->tipo, PDO::PARAM_STR);
                        break;
                    case '`TICKET`':
                        $stmt->bindValue($identifier, $this->ticket, PDO::PARAM_STR);
                        break;
                    case '`camp`':
                        $stmt->bindValue($identifier, $this->camp, PDO::PARAM_INT);
                        break;
                    case '`turno`':
                        $stmt->bindValue($identifier, $this->turno, PDO::PARAM_STR);
                        break;
                    case '`authcode`':
                        $stmt->bindValue($identifier, $this->authcode, PDO::PARAM_STR);
                        break;
                    case '`passw`':
                        $stmt->bindValue($identifier, $this->passw, PDO::PARAM_STR);
                        break;
                    case '`policy`':
                        $stmt->bindValue($identifier, $this->policy, PDO::PARAM_INT);
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


            if (($retval = NombresPeer::doValidate($this, $columns)) !== true) {
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
        $pos = NombresPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getUsuaria();
                break;
            case 1:
                return $this->getIniciales();
                break;
            case 2:
                return $this->getCompleto();
                break;
            case 3:
                return $this->getTipo();
                break;
            case 4:
                return $this->getTicket();
                break;
            case 5:
                return $this->getCamp();
                break;
            case 6:
                return $this->getTurno();
                break;
            case 7:
                return $this->getAuthcode();
                break;
            case 8:
                return $this->getPassw();
                break;
            case 9:
                return $this->getPolicy();
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
        if (isset($alreadyDumpedObjects['Nombres'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Nombres'][$this->getPrimaryKey()] = true;
        $keys = NombresPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUsuaria(),
            $keys[1] => $this->getIniciales(),
            $keys[2] => $this->getCompleto(),
            $keys[3] => $this->getTipo(),
            $keys[4] => $this->getTicket(),
            $keys[5] => $this->getCamp(),
            $keys[6] => $this->getTurno(),
            $keys[7] => $this->getAuthcode(),
            $keys[8] => $this->getPassw(),
            $keys[9] => $this->getPolicy(),
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
        $pos = NombresPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setUsuaria($value);
                break;
            case 1:
                $this->setIniciales($value);
                break;
            case 2:
                $this->setCompleto($value);
                break;
            case 3:
                $this->setTipo($value);
                break;
            case 4:
                $this->setTicket($value);
                break;
            case 5:
                $this->setCamp($value);
                break;
            case 6:
                $this->setTurno($value);
                break;
            case 7:
                $this->setAuthcode($value);
                break;
            case 8:
                $this->setPassw($value);
                break;
            case 9:
                $this->setPolicy($value);
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
        $keys = NombresPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setUsuaria($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setIniciales($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCompleto($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTipo($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTicket($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCamp($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setTurno($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAuthcode($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setPassw($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setPolicy($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NombresPeer::DATABASE_NAME);

        if ($this->isColumnModified(NombresPeer::USUARIA)) $criteria->add(NombresPeer::USUARIA, $this->usuaria);
        if ($this->isColumnModified(NombresPeer::INICIALES)) $criteria->add(NombresPeer::INICIALES, $this->iniciales);
        if ($this->isColumnModified(NombresPeer::COMPLETO)) $criteria->add(NombresPeer::COMPLETO, $this->completo);
        if ($this->isColumnModified(NombresPeer::TIPO)) $criteria->add(NombresPeer::TIPO, $this->tipo);
        if ($this->isColumnModified(NombresPeer::TICKET)) $criteria->add(NombresPeer::TICKET, $this->ticket);
        if ($this->isColumnModified(NombresPeer::CAMP)) $criteria->add(NombresPeer::CAMP, $this->camp);
        if ($this->isColumnModified(NombresPeer::TURNO)) $criteria->add(NombresPeer::TURNO, $this->turno);
        if ($this->isColumnModified(NombresPeer::AUTHCODE)) $criteria->add(NombresPeer::AUTHCODE, $this->authcode);
        if ($this->isColumnModified(NombresPeer::PASSW)) $criteria->add(NombresPeer::PASSW, $this->passw);
        if ($this->isColumnModified(NombresPeer::POLICY)) $criteria->add(NombresPeer::POLICY, $this->policy);

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
        $criteria = new Criteria(NombresPeer::DATABASE_NAME);
        $criteria->add(NombresPeer::USUARIA, $this->usuaria);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getUsuaria();
    }

    /**
     * Generic method to set the primary key (usuaria column).
     *
     * @param  string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUsuaria($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getUsuaria();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Nombres (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIniciales($this->getIniciales());
        $copyObj->setCompleto($this->getCompleto());
        $copyObj->setTipo($this->getTipo());
        $copyObj->setTicket($this->getTicket());
        $copyObj->setCamp($this->getCamp());
        $copyObj->setTurno($this->getTurno());
        $copyObj->setAuthcode($this->getAuthcode());
        $copyObj->setPassw($this->getPassw());
        $copyObj->setPolicy($this->getPolicy());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUsuaria(NULL); // this is a auto-increment column, so set to default value
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
     * @return Nombres Clone of current object.
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
     * @return NombresPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NombresPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->usuaria = null;
        $this->iniciales = null;
        $this->completo = null;
        $this->tipo = null;
        $this->ticket = null;
        $this->camp = null;
        $this->turno = null;
        $this->authcode = null;
        $this->passw = null;
        $this->policy = null;
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
        return (string) $this->exportTo(NombresPeer::DEFAULT_STRING_FORMAT);
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
