<?php


/**
 * Base class that represents a query for the 'trouble' table.
 *
 *
 *
 * @method TroubleQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method TroubleQuery orderByFechahora($order = Criteria::ASC) Order by the fechahora column
 * @method TroubleQuery orderBySistema($order = Criteria::ASC) Order by the sistema column
 * @method TroubleQuery orderByUsuario($order = Criteria::ASC) Order by the usuario column
 * @method TroubleQuery orderByFuente($order = Criteria::ASC) Order by the fuente column
 * @method TroubleQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method TroubleQuery orderByErrorMsg($order = Criteria::ASC) Order by the error_msg column
 * @method TroubleQuery orderByFechacomp($order = Criteria::ASC) Order by the fechacomp column
 * @method TroubleQuery orderByItGuy($order = Criteria::ASC) Order by the it_guy column
 * @method TroubleQuery orderByReparacion($order = Criteria::ASC) Order by the reparacion column
 *
 * @method TroubleQuery groupByAuto() Group by the auto column
 * @method TroubleQuery groupByFechahora() Group by the fechahora column
 * @method TroubleQuery groupBySistema() Group by the sistema column
 * @method TroubleQuery groupByUsuario() Group by the usuario column
 * @method TroubleQuery groupByFuente() Group by the fuente column
 * @method TroubleQuery groupByDescripcion() Group by the descripcion column
 * @method TroubleQuery groupByErrorMsg() Group by the error_msg column
 * @method TroubleQuery groupByFechacomp() Group by the fechacomp column
 * @method TroubleQuery groupByItGuy() Group by the it_guy column
 * @method TroubleQuery groupByReparacion() Group by the reparacion column
 *
 * @method TroubleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TroubleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TroubleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Trouble findOne(PropelPDO $con = null) Return the first Trouble matching the query
 * @method Trouble findOneOrCreate(PropelPDO $con = null) Return the first Trouble matching the query, or a new Trouble object populated from the query conditions when no match is found
 *
 * @method Trouble findOneByFechahora(string $fechahora) Return the first Trouble filtered by the fechahora column
 * @method Trouble findOneBySistema(string $sistema) Return the first Trouble filtered by the sistema column
 * @method Trouble findOneByUsuario(string $usuario) Return the first Trouble filtered by the usuario column
 * @method Trouble findOneByFuente(string $fuente) Return the first Trouble filtered by the fuente column
 * @method Trouble findOneByDescripcion(string $descripcion) Return the first Trouble filtered by the descripcion column
 * @method Trouble findOneByErrorMsg(string $error_msg) Return the first Trouble filtered by the error_msg column
 * @method Trouble findOneByFechacomp(string $fechacomp) Return the first Trouble filtered by the fechacomp column
 * @method Trouble findOneByItGuy(string $it_guy) Return the first Trouble filtered by the it_guy column
 * @method Trouble findOneByReparacion(string $reparacion) Return the first Trouble filtered by the reparacion column
 *
 * @method array findByAuto(int $auto) Return Trouble objects filtered by the auto column
 * @method array findByFechahora(string $fechahora) Return Trouble objects filtered by the fechahora column
 * @method array findBySistema(string $sistema) Return Trouble objects filtered by the sistema column
 * @method array findByUsuario(string $usuario) Return Trouble objects filtered by the usuario column
 * @method array findByFuente(string $fuente) Return Trouble objects filtered by the fuente column
 * @method array findByDescripcion(string $descripcion) Return Trouble objects filtered by the descripcion column
 * @method array findByErrorMsg(string $error_msg) Return Trouble objects filtered by the error_msg column
 * @method array findByFechacomp(string $fechacomp) Return Trouble objects filtered by the fechacomp column
 * @method array findByItGuy(string $it_guy) Return Trouble objects filtered by the it_guy column
 * @method array findByReparacion(string $reparacion) Return Trouble objects filtered by the reparacion column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseTroubleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTroubleQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Trouble', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TroubleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TroubleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TroubleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TroubleQuery) {
            return $criteria;
        }
        $query = new TroubleQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Trouble|Trouble[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TroublePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TroublePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Trouble A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByAuto($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Trouble A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `fechahora`, `sistema`, `usuario`, `fuente`, `descripcion`, `error_msg`, `fechacomp`, `it_guy`, `reparacion` FROM `trouble` WHERE `auto` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Trouble();
            $obj->hydrate($row);
            TroublePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Trouble|Trouble[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Trouble[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TroublePeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TroublePeer::AUTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the auto column
     *
     * Example usage:
     * <code>
     * $query->filterByAuto(1234); // WHERE auto = 1234
     * $query->filterByAuto(array(12, 34)); // WHERE auto IN (12, 34)
     * $query->filterByAuto(array('min' => 12)); // WHERE auto >= 12
     * $query->filterByAuto(array('max' => 12)); // WHERE auto <= 12
     * </code>
     *
     * @param     mixed $auto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(TroublePeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(TroublePeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TroublePeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the fechahora column
     *
     * Example usage:
     * <code>
     * $query->filterByFechahora('2011-03-14'); // WHERE fechahora = '2011-03-14'
     * $query->filterByFechahora('now'); // WHERE fechahora = '2011-03-14'
     * $query->filterByFechahora(array('max' => 'yesterday')); // WHERE fechahora > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechahora The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByFechahora($fechahora = null, $comparison = null)
    {
        if (is_array($fechahora)) {
            $useMinMax = false;
            if (isset($fechahora['min'])) {
                $this->addUsingAlias(TroublePeer::FECHAHORA, $fechahora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechahora['max'])) {
                $this->addUsingAlias(TroublePeer::FECHAHORA, $fechahora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TroublePeer::FECHAHORA, $fechahora, $comparison);
    }

    /**
     * Filter the query on the sistema column
     *
     * Example usage:
     * <code>
     * $query->filterBySistema('fooValue');   // WHERE sistema = 'fooValue'
     * $query->filterBySistema('%fooValue%'); // WHERE sistema LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sistema The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterBySistema($sistema = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sistema)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sistema)) {
                $sistema = str_replace('*', '%', $sistema);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::SISTEMA, $sistema, $comparison);
    }

    /**
     * Filter the query on the usuario column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuario('fooValue');   // WHERE usuario = 'fooValue'
     * $query->filterByUsuario('%fooValue%'); // WHERE usuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuario)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuario)) {
                $usuario = str_replace('*', '%', $usuario);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::USUARIO, $usuario, $comparison);
    }

    /**
     * Filter the query on the fuente column
     *
     * Example usage:
     * <code>
     * $query->filterByFuente('fooValue');   // WHERE fuente = 'fooValue'
     * $query->filterByFuente('%fooValue%'); // WHERE fuente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fuente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByFuente($fuente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fuente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fuente)) {
                $fuente = str_replace('*', '%', $fuente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::FUENTE, $fuente, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%'); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descripcion)) {
                $descripcion = str_replace('*', '%', $descripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the error_msg column
     *
     * Example usage:
     * <code>
     * $query->filterByErrorMsg('fooValue');   // WHERE error_msg = 'fooValue'
     * $query->filterByErrorMsg('%fooValue%'); // WHERE error_msg LIKE '%fooValue%'
     * </code>
     *
     * @param     string $errorMsg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByErrorMsg($errorMsg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($errorMsg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $errorMsg)) {
                $errorMsg = str_replace('*', '%', $errorMsg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::ERROR_MSG, $errorMsg, $comparison);
    }

    /**
     * Filter the query on the fechacomp column
     *
     * Example usage:
     * <code>
     * $query->filterByFechacomp('2011-03-14'); // WHERE fechacomp = '2011-03-14'
     * $query->filterByFechacomp('now'); // WHERE fechacomp = '2011-03-14'
     * $query->filterByFechacomp(array('max' => 'yesterday')); // WHERE fechacomp > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechacomp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByFechacomp($fechacomp = null, $comparison = null)
    {
        if (is_array($fechacomp)) {
            $useMinMax = false;
            if (isset($fechacomp['min'])) {
                $this->addUsingAlias(TroublePeer::FECHACOMP, $fechacomp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechacomp['max'])) {
                $this->addUsingAlias(TroublePeer::FECHACOMP, $fechacomp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TroublePeer::FECHACOMP, $fechacomp, $comparison);
    }

    /**
     * Filter the query on the it_guy column
     *
     * Example usage:
     * <code>
     * $query->filterByItGuy('fooValue');   // WHERE it_guy = 'fooValue'
     * $query->filterByItGuy('%fooValue%'); // WHERE it_guy LIKE '%fooValue%'
     * </code>
     *
     * @param     string $itGuy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByItGuy($itGuy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($itGuy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $itGuy)) {
                $itGuy = str_replace('*', '%', $itGuy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::IT_GUY, $itGuy, $comparison);
    }

    /**
     * Filter the query on the reparacion column
     *
     * Example usage:
     * <code>
     * $query->filterByReparacion('fooValue');   // WHERE reparacion = 'fooValue'
     * $query->filterByReparacion('%fooValue%'); // WHERE reparacion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $reparacion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function filterByReparacion($reparacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reparacion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $reparacion)) {
                $reparacion = str_replace('*', '%', $reparacion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TroublePeer::REPARACION, $reparacion, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Trouble $trouble Object to remove from the list of results
     *
     * @return TroubleQuery The current query, for fluid interface
     */
    public function prune($trouble = null)
    {
        if ($trouble) {
            $this->addUsingAlias(TroublePeer::AUTO, $trouble->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
