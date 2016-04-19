<?php


/**
 * Base class that represents a query for the 'callme' table.
 *
 *
 *
 * @method CallmeQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method CallmeQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method CallmeQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method CallmeQuery orderByTel($order = Criteria::ASC) Order by the tel column
 * @method CallmeQuery orderByExt($order = Criteria::ASC) Order by the ext column
 * @method CallmeQuery orderByTiempo($order = Criteria::ASC) Order by the tiempo column
 * @method CallmeQuery orderByCompletado($order = Criteria::ASC) Order by the completado column
 *
 * @method CallmeQuery groupByAuto() Group by the auto column
 * @method CallmeQuery groupByGestor() Group by the gestor column
 * @method CallmeQuery groupByCuenta() Group by the cuenta column
 * @method CallmeQuery groupByTel() Group by the tel column
 * @method CallmeQuery groupByExt() Group by the ext column
 * @method CallmeQuery groupByTiempo() Group by the tiempo column
 * @method CallmeQuery groupByCompletado() Group by the completado column
 *
 * @method CallmeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CallmeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CallmeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Callme findOne(PropelPDO $con = null) Return the first Callme matching the query
 * @method Callme findOneOrCreate(PropelPDO $con = null) Return the first Callme matching the query, or a new Callme object populated from the query conditions when no match is found
 *
 * @method Callme findOneByGestor(string $gestor) Return the first Callme filtered by the gestor column
 * @method Callme findOneByCuenta(string $cuenta) Return the first Callme filtered by the cuenta column
 * @method Callme findOneByTel(string $tel) Return the first Callme filtered by the tel column
 * @method Callme findOneByExt(string $ext) Return the first Callme filtered by the ext column
 * @method Callme findOneByTiempo(string $tiempo) Return the first Callme filtered by the tiempo column
 * @method Callme findOneByCompletado(int $completado) Return the first Callme filtered by the completado column
 *
 * @method array findByAuto(int $auto) Return Callme objects filtered by the auto column
 * @method array findByGestor(string $gestor) Return Callme objects filtered by the gestor column
 * @method array findByCuenta(string $cuenta) Return Callme objects filtered by the cuenta column
 * @method array findByTel(string $tel) Return Callme objects filtered by the tel column
 * @method array findByExt(string $ext) Return Callme objects filtered by the ext column
 * @method array findByTiempo(string $tiempo) Return Callme objects filtered by the tiempo column
 * @method array findByCompletado(int $completado) Return Callme objects filtered by the completado column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCallmeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCallmeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Callme', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CallmeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CallmeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CallmeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CallmeQuery) {
            return $criteria;
        }
        $query = new CallmeQuery();
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
     * @return   Callme|Callme[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CallmePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CallmePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Callme A model object, or null if the key is not found
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
     * @return                 Callme A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `gestor`, `cuenta`, `tel`, `ext`, `tiempo`, `completado` FROM `callme` WHERE `auto` = :p0';
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
            $obj = new Callme();
            $obj->hydrate($row);
            CallmePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Callme|Callme[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Callme[]|mixed the list of results, formatted by the current formatter
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
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CallmePeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CallmePeer::AUTO, $keys, Criteria::IN);
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
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(CallmePeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(CallmePeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CallmePeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the gestor column
     *
     * Example usage:
     * <code>
     * $query->filterByGestor('fooValue');   // WHERE gestor = 'fooValue'
     * $query->filterByGestor('%fooValue%'); // WHERE gestor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gestor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByGestor($gestor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gestor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gestor)) {
                $gestor = str_replace('*', '%', $gestor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CallmePeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Filter the query on the cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByCuenta('fooValue');   // WHERE cuenta = 'fooValue'
     * $query->filterByCuenta('%fooValue%'); // WHERE cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByCuenta($cuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuenta)) {
                $cuenta = str_replace('*', '%', $cuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CallmePeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the tel column
     *
     * Example usage:
     * <code>
     * $query->filterByTel('fooValue');   // WHERE tel = 'fooValue'
     * $query->filterByTel('%fooValue%'); // WHERE tel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByTel($tel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel)) {
                $tel = str_replace('*', '%', $tel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CallmePeer::TEL, $tel, $comparison);
    }

    /**
     * Filter the query on the ext column
     *
     * Example usage:
     * <code>
     * $query->filterByExt('fooValue');   // WHERE ext = 'fooValue'
     * $query->filterByExt('%fooValue%'); // WHERE ext LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ext The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByExt($ext = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ext)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ext)) {
                $ext = str_replace('*', '%', $ext);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CallmePeer::EXT, $ext, $comparison);
    }

    /**
     * Filter the query on the tiempo column
     *
     * Example usage:
     * <code>
     * $query->filterByTiempo('2011-03-14'); // WHERE tiempo = '2011-03-14'
     * $query->filterByTiempo('now'); // WHERE tiempo = '2011-03-14'
     * $query->filterByTiempo(array('max' => 'yesterday')); // WHERE tiempo > '2011-03-13'
     * </code>
     *
     * @param     mixed $tiempo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByTiempo($tiempo = null, $comparison = null)
    {
        if (is_array($tiempo)) {
            $useMinMax = false;
            if (isset($tiempo['min'])) {
                $this->addUsingAlias(CallmePeer::TIEMPO, $tiempo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tiempo['max'])) {
                $this->addUsingAlias(CallmePeer::TIEMPO, $tiempo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CallmePeer::TIEMPO, $tiempo, $comparison);
    }

    /**
     * Filter the query on the completado column
     *
     * Example usage:
     * <code>
     * $query->filterByCompletado(1234); // WHERE completado = 1234
     * $query->filterByCompletado(array(12, 34)); // WHERE completado IN (12, 34)
     * $query->filterByCompletado(array('min' => 12)); // WHERE completado >= 12
     * $query->filterByCompletado(array('max' => 12)); // WHERE completado <= 12
     * </code>
     *
     * @param     mixed $completado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function filterByCompletado($completado = null, $comparison = null)
    {
        if (is_array($completado)) {
            $useMinMax = false;
            if (isset($completado['min'])) {
                $this->addUsingAlias(CallmePeer::COMPLETADO, $completado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completado['max'])) {
                $this->addUsingAlias(CallmePeer::COMPLETADO, $completado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CallmePeer::COMPLETADO, $completado, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Callme $callme Object to remove from the list of results
     *
     * @return CallmeQuery The current query, for fluid interface
     */
    public function prune($callme = null)
    {
        if ($callme) {
            $this->addUsingAlias(CallmePeer::AUTO, $callme->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
