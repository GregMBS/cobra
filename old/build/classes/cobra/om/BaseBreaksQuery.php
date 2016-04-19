<?php


/**
 * Base class that represents a query for the 'breaks' table.
 *
 *
 *
 * @method BreaksQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method BreaksQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method BreaksQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method BreaksQuery orderByEmpieza($order = Criteria::ASC) Order by the empieza column
 * @method BreaksQuery orderByTermina($order = Criteria::ASC) Order by the termina column
 *
 * @method BreaksQuery groupByAuto() Group by the auto column
 * @method BreaksQuery groupByGestor() Group by the gestor column
 * @method BreaksQuery groupByTipo() Group by the tipo column
 * @method BreaksQuery groupByEmpieza() Group by the empieza column
 * @method BreaksQuery groupByTermina() Group by the termina column
 *
 * @method BreaksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BreaksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BreaksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Breaks findOne(PropelPDO $con = null) Return the first Breaks matching the query
 * @method Breaks findOneOrCreate(PropelPDO $con = null) Return the first Breaks matching the query, or a new Breaks object populated from the query conditions when no match is found
 *
 * @method Breaks findOneByGestor(string $gestor) Return the first Breaks filtered by the gestor column
 * @method Breaks findOneByTipo(string $tipo) Return the first Breaks filtered by the tipo column
 * @method Breaks findOneByEmpieza(string $empieza) Return the first Breaks filtered by the empieza column
 * @method Breaks findOneByTermina(string $termina) Return the first Breaks filtered by the termina column
 *
 * @method array findByAuto(int $auto) Return Breaks objects filtered by the auto column
 * @method array findByGestor(string $gestor) Return Breaks objects filtered by the gestor column
 * @method array findByTipo(string $tipo) Return Breaks objects filtered by the tipo column
 * @method array findByEmpieza(string $empieza) Return Breaks objects filtered by the empieza column
 * @method array findByTermina(string $termina) Return Breaks objects filtered by the termina column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseBreaksQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBreaksQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Breaks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BreaksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BreaksQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BreaksQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BreaksQuery) {
            return $criteria;
        }
        $query = new BreaksQuery();
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
     * @return   Breaks|Breaks[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BreaksPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BreaksPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Breaks A model object, or null if the key is not found
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
     * @return                 Breaks A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `gestor`, `tipo`, `empieza`, `termina` FROM `breaks` WHERE `auto` = :p0';
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
            $obj = new Breaks();
            $obj->hydrate($row);
            BreaksPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Breaks|Breaks[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Breaks[]|mixed the list of results, formatted by the current formatter
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
     * @return BreaksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BreaksPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BreaksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BreaksPeer::AUTO, $keys, Criteria::IN);
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
     * @return BreaksQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(BreaksPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(BreaksPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BreaksPeer::AUTO, $auto, $comparison);
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
     * @return BreaksQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BreaksPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Filter the query on the tipo column
     *
     * Example usage:
     * <code>
     * $query->filterByTipo('fooValue');   // WHERE tipo = 'fooValue'
     * $query->filterByTipo('%fooValue%'); // WHERE tipo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BreaksQuery The current query, for fluid interface
     */
    public function filterByTipo($tipo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tipo)) {
                $tipo = str_replace('*', '%', $tipo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BreaksPeer::TIPO, $tipo, $comparison);
    }

    /**
     * Filter the query on the empieza column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpieza('2011-03-14'); // WHERE empieza = '2011-03-14'
     * $query->filterByEmpieza('now'); // WHERE empieza = '2011-03-14'
     * $query->filterByEmpieza(array('max' => 'yesterday')); // WHERE empieza > '2011-03-13'
     * </code>
     *
     * @param     mixed $empieza The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BreaksQuery The current query, for fluid interface
     */
    public function filterByEmpieza($empieza = null, $comparison = null)
    {
        if (is_array($empieza)) {
            $useMinMax = false;
            if (isset($empieza['min'])) {
                $this->addUsingAlias(BreaksPeer::EMPIEZA, $empieza['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empieza['max'])) {
                $this->addUsingAlias(BreaksPeer::EMPIEZA, $empieza['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BreaksPeer::EMPIEZA, $empieza, $comparison);
    }

    /**
     * Filter the query on the termina column
     *
     * Example usage:
     * <code>
     * $query->filterByTermina('2011-03-14'); // WHERE termina = '2011-03-14'
     * $query->filterByTermina('now'); // WHERE termina = '2011-03-14'
     * $query->filterByTermina(array('max' => 'yesterday')); // WHERE termina > '2011-03-13'
     * </code>
     *
     * @param     mixed $termina The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BreaksQuery The current query, for fluid interface
     */
    public function filterByTermina($termina = null, $comparison = null)
    {
        if (is_array($termina)) {
            $useMinMax = false;
            if (isset($termina['min'])) {
                $this->addUsingAlias(BreaksPeer::TERMINA, $termina['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termina['max'])) {
                $this->addUsingAlias(BreaksPeer::TERMINA, $termina['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BreaksPeer::TERMINA, $termina, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Breaks $breaks Object to remove from the list of results
     *
     * @return BreaksQuery The current query, for fluid interface
     */
    public function prune($breaks = null)
    {
        if ($breaks) {
            $this->addUsingAlias(BreaksPeer::AUTO, $breaks->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
