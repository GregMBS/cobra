<?php


/**
 * Base class that represents a query for the 'stj' table.
 *
 *
 *
 * @method StjQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method StjQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method StjQuery groupByCuenta() Group by the cuenta column
 * @method StjQuery groupByStatus() Group by the status column
 *
 * @method StjQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method StjQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method StjQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Stj findOne(PropelPDO $con = null) Return the first Stj matching the query
 * @method Stj findOneOrCreate(PropelPDO $con = null) Return the first Stj matching the query, or a new Stj object populated from the query conditions when no match is found
 *
 * @method Stj findOneByStatus(string $status) Return the first Stj filtered by the status column
 *
 * @method array findByCuenta(int $cuenta) Return Stj objects filtered by the cuenta column
 * @method array findByStatus(string $status) Return Stj objects filtered by the status column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseStjQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseStjQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Stj', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new StjQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   StjQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return StjQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof StjQuery) {
            return $criteria;
        }
        $query = new StjQuery();
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
     * @return   Stj|Stj[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = StjPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(StjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Stj A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCuenta($key, $con = null)
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
     * @return                 Stj A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `cuenta`, `status` FROM `stj` WHERE `cuenta` = :p0';
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
            $obj = new Stj();
            $obj->hydrate($row);
            StjPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Stj|Stj[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Stj[]|mixed the list of results, formatted by the current formatter
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
     * @return StjQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StjPeer::CUENTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return StjQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StjPeer::CUENTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByCuenta(1234); // WHERE cuenta = 1234
     * $query->filterByCuenta(array(12, 34)); // WHERE cuenta IN (12, 34)
     * $query->filterByCuenta(array('min' => 12)); // WHERE cuenta >= 12
     * $query->filterByCuenta(array('max' => 12)); // WHERE cuenta <= 12
     * </code>
     *
     * @param     mixed $cuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StjQuery The current query, for fluid interface
     */
    public function filterByCuenta($cuenta = null, $comparison = null)
    {
        if (is_array($cuenta)) {
            $useMinMax = false;
            if (isset($cuenta['min'])) {
                $this->addUsingAlias(StjPeer::CUENTA, $cuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cuenta['max'])) {
                $this->addUsingAlias(StjPeer::CUENTA, $cuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StjPeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return StjQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(StjPeer::STATUS, $status, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Stj $stj Object to remove from the list of results
     *
     * @return StjQuery The current query, for fluid interface
     */
    public function prune($stj = null)
    {
        if ($stj) {
            $this->addUsingAlias(StjPeer::CUENTA, $stj->getCuenta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
