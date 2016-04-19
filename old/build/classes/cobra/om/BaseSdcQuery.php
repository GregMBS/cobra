<?php


/**
 * Base class that represents a query for the 'sdc' table.
 *
 *
 *
 * @method SdcQuery orderByCta($order = Criteria::ASC) Order by the cta column
 * @method SdcQuery orderBySdc($order = Criteria::ASC) Order by the sdc column
 *
 * @method SdcQuery groupByCta() Group by the cta column
 * @method SdcQuery groupBySdc() Group by the sdc column
 *
 * @method SdcQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SdcQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SdcQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Sdc findOne(PropelPDO $con = null) Return the first Sdc matching the query
 * @method Sdc findOneOrCreate(PropelPDO $con = null) Return the first Sdc matching the query, or a new Sdc object populated from the query conditions when no match is found
 *
 * @method Sdc findOneBySdc(string $sdc) Return the first Sdc filtered by the sdc column
 *
 * @method array findByCta(int $cta) Return Sdc objects filtered by the cta column
 * @method array findBySdc(string $sdc) Return Sdc objects filtered by the sdc column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseSdcQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSdcQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Sdc', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SdcQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SdcQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SdcQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SdcQuery) {
            return $criteria;
        }
        $query = new SdcQuery();
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
     * @return   Sdc|Sdc[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SdcPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SdcPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Sdc A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCta($key, $con = null)
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
     * @return                 Sdc A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `cta`, `sdc` FROM `sdc` WHERE `cta` = :p0';
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
            $obj = new Sdc();
            $obj->hydrate($row);
            SdcPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Sdc|Sdc[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Sdc[]|mixed the list of results, formatted by the current formatter
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
     * @return SdcQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SdcPeer::CTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SdcQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SdcPeer::CTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cta column
     *
     * Example usage:
     * <code>
     * $query->filterByCta(1234); // WHERE cta = 1234
     * $query->filterByCta(array(12, 34)); // WHERE cta IN (12, 34)
     * $query->filterByCta(array('min' => 12)); // WHERE cta >= 12
     * $query->filterByCta(array('max' => 12)); // WHERE cta <= 12
     * </code>
     *
     * @param     mixed $cta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdcQuery The current query, for fluid interface
     */
    public function filterByCta($cta = null, $comparison = null)
    {
        if (is_array($cta)) {
            $useMinMax = false;
            if (isset($cta['min'])) {
                $this->addUsingAlias(SdcPeer::CTA, $cta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cta['max'])) {
                $this->addUsingAlias(SdcPeer::CTA, $cta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdcPeer::CTA, $cta, $comparison);
    }

    /**
     * Filter the query on the sdc column
     *
     * Example usage:
     * <code>
     * $query->filterBySdc('fooValue');   // WHERE sdc = 'fooValue'
     * $query->filterBySdc('%fooValue%'); // WHERE sdc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sdc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdcQuery The current query, for fluid interface
     */
    public function filterBySdc($sdc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sdc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sdc)) {
                $sdc = str_replace('*', '%', $sdc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SdcPeer::SDC, $sdc, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Sdc $sdc Object to remove from the list of results
     *
     * @return SdcQuery The current query, for fluid interface
     */
    public function prune($sdc = null)
    {
        if ($sdc) {
            $this->addUsingAlias(SdcPeer::CTA, $sdc->getCta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
