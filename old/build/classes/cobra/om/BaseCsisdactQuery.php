<?php


/**
 * Base class that represents a query for the 'csisdact' table.
 *
 *
 *
 * @method CsisdactQuery orderByNdc($order = Criteria::ASC) Order by the ndc column
 * @method CsisdactQuery orderBySd1($order = Criteria::ASC) Order by the sd1 column
 * @method CsisdactQuery orderBySd2($order = Criteria::ASC) Order by the sd2 column
 *
 * @method CsisdactQuery groupByNdc() Group by the ndc column
 * @method CsisdactQuery groupBySd1() Group by the sd1 column
 * @method CsisdactQuery groupBySd2() Group by the sd2 column
 *
 * @method CsisdactQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CsisdactQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CsisdactQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Csisdact findOne(PropelPDO $con = null) Return the first Csisdact matching the query
 * @method Csisdact findOneOrCreate(PropelPDO $con = null) Return the first Csisdact matching the query, or a new Csisdact object populated from the query conditions when no match is found
 *
 * @method Csisdact findOneBySd1(string $sd1) Return the first Csisdact filtered by the sd1 column
 * @method Csisdact findOneBySd2(string $sd2) Return the first Csisdact filtered by the sd2 column
 *
 * @method array findByNdc(int $ndc) Return Csisdact objects filtered by the ndc column
 * @method array findBySd1(string $sd1) Return Csisdact objects filtered by the sd1 column
 * @method array findBySd2(string $sd2) Return Csisdact objects filtered by the sd2 column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCsisdactQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCsisdactQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Csisdact', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CsisdactQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CsisdactQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CsisdactQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CsisdactQuery) {
            return $criteria;
        }
        $query = new CsisdactQuery();
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
     * @return   Csisdact|Csisdact[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CsisdactPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CsisdactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Csisdact A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByNdc($key, $con = null)
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
     * @return                 Csisdact A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ndc`, `sd1`, `sd2` FROM `csisdact` WHERE `ndc` = :p0';
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
            $obj = new Csisdact();
            $obj->hydrate($row);
            CsisdactPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Csisdact|Csisdact[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Csisdact[]|mixed the list of results, formatted by the current formatter
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
     * @return CsisdactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CsisdactPeer::NDC, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CsisdactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CsisdactPeer::NDC, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ndc column
     *
     * Example usage:
     * <code>
     * $query->filterByNdc(1234); // WHERE ndc = 1234
     * $query->filterByNdc(array(12, 34)); // WHERE ndc IN (12, 34)
     * $query->filterByNdc(array('min' => 12)); // WHERE ndc >= 12
     * $query->filterByNdc(array('max' => 12)); // WHERE ndc <= 12
     * </code>
     *
     * @param     mixed $ndc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsisdactQuery The current query, for fluid interface
     */
    public function filterByNdc($ndc = null, $comparison = null)
    {
        if (is_array($ndc)) {
            $useMinMax = false;
            if (isset($ndc['min'])) {
                $this->addUsingAlias(CsisdactPeer::NDC, $ndc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ndc['max'])) {
                $this->addUsingAlias(CsisdactPeer::NDC, $ndc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CsisdactPeer::NDC, $ndc, $comparison);
    }

    /**
     * Filter the query on the sd1 column
     *
     * Example usage:
     * <code>
     * $query->filterBySd1(1234); // WHERE sd1 = 1234
     * $query->filterBySd1(array(12, 34)); // WHERE sd1 IN (12, 34)
     * $query->filterBySd1(array('min' => 12)); // WHERE sd1 >= 12
     * $query->filterBySd1(array('max' => 12)); // WHERE sd1 <= 12
     * </code>
     *
     * @param     mixed $sd1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsisdactQuery The current query, for fluid interface
     */
    public function filterBySd1($sd1 = null, $comparison = null)
    {
        if (is_array($sd1)) {
            $useMinMax = false;
            if (isset($sd1['min'])) {
                $this->addUsingAlias(CsisdactPeer::SD1, $sd1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sd1['max'])) {
                $this->addUsingAlias(CsisdactPeer::SD1, $sd1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CsisdactPeer::SD1, $sd1, $comparison);
    }

    /**
     * Filter the query on the sd2 column
     *
     * Example usage:
     * <code>
     * $query->filterBySd2(1234); // WHERE sd2 = 1234
     * $query->filterBySd2(array(12, 34)); // WHERE sd2 IN (12, 34)
     * $query->filterBySd2(array('min' => 12)); // WHERE sd2 >= 12
     * $query->filterBySd2(array('max' => 12)); // WHERE sd2 <= 12
     * </code>
     *
     * @param     mixed $sd2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsisdactQuery The current query, for fluid interface
     */
    public function filterBySd2($sd2 = null, $comparison = null)
    {
        if (is_array($sd2)) {
            $useMinMax = false;
            if (isset($sd2['min'])) {
                $this->addUsingAlias(CsisdactPeer::SD2, $sd2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sd2['max'])) {
                $this->addUsingAlias(CsisdactPeer::SD2, $sd2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CsisdactPeer::SD2, $sd2, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Csisdact $csisdact Object to remove from the list of results
     *
     * @return CsisdactQuery The current query, for fluid interface
     */
    public function prune($csisdact = null)
    {
        if ($csisdact) {
            $this->addUsingAlias(CsisdactPeer::NDC, $csisdact->getNdc(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
