<?php


/**
 * Base class that represents a query for the 'specdate' table.
 *
 *
 *
 * @method SpecdateQuery orderByCCont($order = Criteria::ASC) Order by the c_cont column
 * @method SpecdateQuery orderByMdf($order = Criteria::ASC) Order by the mdf column
 *
 * @method SpecdateQuery groupByCCont() Group by the c_cont column
 * @method SpecdateQuery groupByMdf() Group by the mdf column
 *
 * @method SpecdateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SpecdateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SpecdateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Specdate findOne(PropelPDO $con = null) Return the first Specdate matching the query
 * @method Specdate findOneOrCreate(PropelPDO $con = null) Return the first Specdate matching the query, or a new Specdate object populated from the query conditions when no match is found
 *
 * @method Specdate findOneByMdf(string $mdf) Return the first Specdate filtered by the mdf column
 *
 * @method array findByCCont(int $c_cont) Return Specdate objects filtered by the c_cont column
 * @method array findByMdf(string $mdf) Return Specdate objects filtered by the mdf column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseSpecdateQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSpecdateQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Specdate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SpecdateQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SpecdateQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SpecdateQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SpecdateQuery) {
            return $criteria;
        }
        $query = new SpecdateQuery();
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
     * @return   Specdate|Specdate[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SpecdatePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SpecdatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Specdate A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCCont($key, $con = null)
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
     * @return                 Specdate A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `c_cont`, `mdf` FROM `specdate` WHERE `c_cont` = :p0';
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
            $obj = new Specdate();
            $obj->hydrate($row);
            SpecdatePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Specdate|Specdate[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Specdate[]|mixed the list of results, formatted by the current formatter
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
     * @return SpecdateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SpecdatePeer::C_CONT, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SpecdateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SpecdatePeer::C_CONT, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the c_cont column
     *
     * Example usage:
     * <code>
     * $query->filterByCCont(1234); // WHERE c_cont = 1234
     * $query->filterByCCont(array(12, 34)); // WHERE c_cont IN (12, 34)
     * $query->filterByCCont(array('min' => 12)); // WHERE c_cont >= 12
     * $query->filterByCCont(array('max' => 12)); // WHERE c_cont <= 12
     * </code>
     *
     * @param     mixed $cCont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpecdateQuery The current query, for fluid interface
     */
    public function filterByCCont($cCont = null, $comparison = null)
    {
        if (is_array($cCont)) {
            $useMinMax = false;
            if (isset($cCont['min'])) {
                $this->addUsingAlias(SpecdatePeer::C_CONT, $cCont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cCont['max'])) {
                $this->addUsingAlias(SpecdatePeer::C_CONT, $cCont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecdatePeer::C_CONT, $cCont, $comparison);
    }

    /**
     * Filter the query on the mdf column
     *
     * Example usage:
     * <code>
     * $query->filterByMdf('2011-03-14'); // WHERE mdf = '2011-03-14'
     * $query->filterByMdf('now'); // WHERE mdf = '2011-03-14'
     * $query->filterByMdf(array('max' => 'yesterday')); // WHERE mdf > '2011-03-13'
     * </code>
     *
     * @param     mixed $mdf The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpecdateQuery The current query, for fluid interface
     */
    public function filterByMdf($mdf = null, $comparison = null)
    {
        if (is_array($mdf)) {
            $useMinMax = false;
            if (isset($mdf['min'])) {
                $this->addUsingAlias(SpecdatePeer::MDF, $mdf['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mdf['max'])) {
                $this->addUsingAlias(SpecdatePeer::MDF, $mdf['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecdatePeer::MDF, $mdf, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Specdate $specdate Object to remove from the list of results
     *
     * @return SpecdateQuery The current query, for fluid interface
     */
    public function prune($specdate = null)
    {
        if ($specdate) {
            $this->addUsingAlias(SpecdatePeer::C_CONT, $specdate->getCCont(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
