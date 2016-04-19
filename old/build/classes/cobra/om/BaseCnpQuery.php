<?php


/**
 * Base class that represents a query for the 'cnp' table.
 *
 *
 *
 * @method CnpQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method CnpQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method CnpQuery orderByAcr($order = Criteria::ASC) Order by the acr column
 *
 * @method CnpQuery groupByStatus() Group by the status column
 * @method CnpQuery groupByAuto() Group by the auto column
 * @method CnpQuery groupByAcr() Group by the acr column
 *
 * @method CnpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CnpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CnpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Cnp findOne(PropelPDO $con = null) Return the first Cnp matching the query
 * @method Cnp findOneOrCreate(PropelPDO $con = null) Return the first Cnp matching the query, or a new Cnp object populated from the query conditions when no match is found
 *
 * @method Cnp findOneByStatus(string $status) Return the first Cnp filtered by the status column
 * @method Cnp findOneByAcr(string $acr) Return the first Cnp filtered by the acr column
 *
 * @method array findByStatus(string $status) Return Cnp objects filtered by the status column
 * @method array findByAuto(int $auto) Return Cnp objects filtered by the auto column
 * @method array findByAcr(string $acr) Return Cnp objects filtered by the acr column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCnpQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCnpQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Cnp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CnpQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CnpQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CnpQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CnpQuery) {
            return $criteria;
        }
        $query = new CnpQuery();
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
     * @return   Cnp|Cnp[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CnpPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CnpPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Cnp A model object, or null if the key is not found
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
     * @return                 Cnp A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `status`, `auto`, `acr` FROM `cnp` WHERE `auto` = :p0';
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
            $obj = new Cnp();
            $obj->hydrate($row);
            CnpPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Cnp|Cnp[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Cnp[]|mixed the list of results, formatted by the current formatter
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
     * @return CnpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CnpPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CnpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CnpPeer::AUTO, $keys, Criteria::IN);
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
     * @return CnpQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CnpPeer::STATUS, $status, $comparison);
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
     * @return CnpQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(CnpPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(CnpPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CnpPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the acr column
     *
     * Example usage:
     * <code>
     * $query->filterByAcr('fooValue');   // WHERE acr = 'fooValue'
     * $query->filterByAcr('%fooValue%'); // WHERE acr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $acr The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CnpQuery The current query, for fluid interface
     */
    public function filterByAcr($acr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($acr)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $acr)) {
                $acr = str_replace('*', '%', $acr);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CnpPeer::ACR, $acr, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Cnp $cnp Object to remove from the list of results
     *
     * @return CnpQuery The current query, for fluid interface
     */
    public function prune($cnp = null)
    {
        if ($cnp) {
            $this->addUsingAlias(CnpPeer::AUTO, $cnp->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
