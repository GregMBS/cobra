<?php


/**
 * Base class that represents a query for the 'dictamenes' table.
 *
 *
 *
 * @method DictamenesQuery orderByDictamen($order = Criteria::ASC) Order by the dictamen column
 * @method DictamenesQuery orderByVisitas($order = Criteria::ASC) Order by the visitas column
 * @method DictamenesQuery orderByCallcenter($order = Criteria::ASC) Order by the callcenter column
 * @method DictamenesQuery orderByJudicial($order = Criteria::ASC) Order by the judicial column
 * @method DictamenesQuery orderByPromo($order = Criteria::ASC) Order by the promo column
 * @method DictamenesQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method DictamenesQuery orderByVCc($order = Criteria::ASC) Order by the v_cc column
 * @method DictamenesQuery orderByVV($order = Criteria::ASC) Order by the v_v column
 * @method DictamenesQuery orderByVJ($order = Criteria::ASC) Order by the v_j column
 * @method DictamenesQuery orderByQueue($order = Criteria::ASC) Order by the queue column
 *
 * @method DictamenesQuery groupByDictamen() Group by the dictamen column
 * @method DictamenesQuery groupByVisitas() Group by the visitas column
 * @method DictamenesQuery groupByCallcenter() Group by the callcenter column
 * @method DictamenesQuery groupByJudicial() Group by the judicial column
 * @method DictamenesQuery groupByPromo() Group by the promo column
 * @method DictamenesQuery groupByAuto() Group by the auto column
 * @method DictamenesQuery groupByVCc() Group by the v_cc column
 * @method DictamenesQuery groupByVV() Group by the v_v column
 * @method DictamenesQuery groupByVJ() Group by the v_j column
 * @method DictamenesQuery groupByQueue() Group by the queue column
 *
 * @method DictamenesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DictamenesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DictamenesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Dictamenes findOne(PropelPDO $con = null) Return the first Dictamenes matching the query
 * @method Dictamenes findOneOrCreate(PropelPDO $con = null) Return the first Dictamenes matching the query, or a new Dictamenes object populated from the query conditions when no match is found
 *
 * @method Dictamenes findOneByDictamen(string $dictamen) Return the first Dictamenes filtered by the dictamen column
 * @method Dictamenes findOneByVisitas(boolean $visitas) Return the first Dictamenes filtered by the visitas column
 * @method Dictamenes findOneByCallcenter(boolean $callcenter) Return the first Dictamenes filtered by the callcenter column
 * @method Dictamenes findOneByJudicial(boolean $judicial) Return the first Dictamenes filtered by the judicial column
 * @method Dictamenes findOneByPromo(boolean $promo) Return the first Dictamenes filtered by the promo column
 * @method Dictamenes findOneByVCc(int $v_cc) Return the first Dictamenes filtered by the v_cc column
 * @method Dictamenes findOneByVV(int $v_v) Return the first Dictamenes filtered by the v_v column
 * @method Dictamenes findOneByVJ(int $v_j) Return the first Dictamenes filtered by the v_j column
 * @method Dictamenes findOneByQueue(string $queue) Return the first Dictamenes filtered by the queue column
 *
 * @method array findByDictamen(string $dictamen) Return Dictamenes objects filtered by the dictamen column
 * @method array findByVisitas(boolean $visitas) Return Dictamenes objects filtered by the visitas column
 * @method array findByCallcenter(boolean $callcenter) Return Dictamenes objects filtered by the callcenter column
 * @method array findByJudicial(boolean $judicial) Return Dictamenes objects filtered by the judicial column
 * @method array findByPromo(boolean $promo) Return Dictamenes objects filtered by the promo column
 * @method array findByAuto(int $auto) Return Dictamenes objects filtered by the auto column
 * @method array findByVCc(int $v_cc) Return Dictamenes objects filtered by the v_cc column
 * @method array findByVV(int $v_v) Return Dictamenes objects filtered by the v_v column
 * @method array findByVJ(int $v_j) Return Dictamenes objects filtered by the v_j column
 * @method array findByQueue(string $queue) Return Dictamenes objects filtered by the queue column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseDictamenesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDictamenesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Dictamenes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DictamenesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DictamenesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DictamenesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DictamenesQuery) {
            return $criteria;
        }
        $query = new DictamenesQuery();
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
     * @return   Dictamenes|Dictamenes[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DictamenesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DictamenesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Dictamenes A model object, or null if the key is not found
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
     * @return                 Dictamenes A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `dictamen`, `visitas`, `callcenter`, `judicial`, `promo`, `auto`, `v_cc`, `v_v`, `v_j`, `queue` FROM `dictamenes` WHERE `auto` = :p0';
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
            $obj = new Dictamenes();
            $obj->hydrate($row);
            DictamenesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Dictamenes|Dictamenes[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Dictamenes[]|mixed the list of results, formatted by the current formatter
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
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DictamenesPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DictamenesPeer::AUTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the dictamen column
     *
     * Example usage:
     * <code>
     * $query->filterByDictamen('fooValue');   // WHERE dictamen = 'fooValue'
     * $query->filterByDictamen('%fooValue%'); // WHERE dictamen LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dictamen The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByDictamen($dictamen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dictamen)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dictamen)) {
                $dictamen = str_replace('*', '%', $dictamen);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DictamenesPeer::DICTAMEN, $dictamen, $comparison);
    }

    /**
     * Filter the query on the visitas column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitas(true); // WHERE visitas = true
     * $query->filterByVisitas('yes'); // WHERE visitas = true
     * </code>
     *
     * @param     boolean|string $visitas The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByVisitas($visitas = null, $comparison = null)
    {
        if (is_string($visitas)) {
            $visitas = in_array(strtolower($visitas), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DictamenesPeer::VISITAS, $visitas, $comparison);
    }

    /**
     * Filter the query on the callcenter column
     *
     * Example usage:
     * <code>
     * $query->filterByCallcenter(true); // WHERE callcenter = true
     * $query->filterByCallcenter('yes'); // WHERE callcenter = true
     * </code>
     *
     * @param     boolean|string $callcenter The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByCallcenter($callcenter = null, $comparison = null)
    {
        if (is_string($callcenter)) {
            $callcenter = in_array(strtolower($callcenter), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DictamenesPeer::CALLCENTER, $callcenter, $comparison);
    }

    /**
     * Filter the query on the judicial column
     *
     * Example usage:
     * <code>
     * $query->filterByJudicial(true); // WHERE judicial = true
     * $query->filterByJudicial('yes'); // WHERE judicial = true
     * </code>
     *
     * @param     boolean|string $judicial The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByJudicial($judicial = null, $comparison = null)
    {
        if (is_string($judicial)) {
            $judicial = in_array(strtolower($judicial), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DictamenesPeer::JUDICIAL, $judicial, $comparison);
    }

    /**
     * Filter the query on the promo column
     *
     * Example usage:
     * <code>
     * $query->filterByPromo(true); // WHERE promo = true
     * $query->filterByPromo('yes'); // WHERE promo = true
     * </code>
     *
     * @param     boolean|string $promo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByPromo($promo = null, $comparison = null)
    {
        if (is_string($promo)) {
            $promo = in_array(strtolower($promo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DictamenesPeer::PROMO, $promo, $comparison);
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
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(DictamenesPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(DictamenesPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DictamenesPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the v_cc column
     *
     * Example usage:
     * <code>
     * $query->filterByVCc(1234); // WHERE v_cc = 1234
     * $query->filterByVCc(array(12, 34)); // WHERE v_cc IN (12, 34)
     * $query->filterByVCc(array('min' => 12)); // WHERE v_cc >= 12
     * $query->filterByVCc(array('max' => 12)); // WHERE v_cc <= 12
     * </code>
     *
     * @param     mixed $vCc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByVCc($vCc = null, $comparison = null)
    {
        if (is_array($vCc)) {
            $useMinMax = false;
            if (isset($vCc['min'])) {
                $this->addUsingAlias(DictamenesPeer::V_CC, $vCc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vCc['max'])) {
                $this->addUsingAlias(DictamenesPeer::V_CC, $vCc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DictamenesPeer::V_CC, $vCc, $comparison);
    }

    /**
     * Filter the query on the v_v column
     *
     * Example usage:
     * <code>
     * $query->filterByVV(1234); // WHERE v_v = 1234
     * $query->filterByVV(array(12, 34)); // WHERE v_v IN (12, 34)
     * $query->filterByVV(array('min' => 12)); // WHERE v_v >= 12
     * $query->filterByVV(array('max' => 12)); // WHERE v_v <= 12
     * </code>
     *
     * @param     mixed $vV The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByVV($vV = null, $comparison = null)
    {
        if (is_array($vV)) {
            $useMinMax = false;
            if (isset($vV['min'])) {
                $this->addUsingAlias(DictamenesPeer::V_V, $vV['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vV['max'])) {
                $this->addUsingAlias(DictamenesPeer::V_V, $vV['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DictamenesPeer::V_V, $vV, $comparison);
    }

    /**
     * Filter the query on the v_j column
     *
     * Example usage:
     * <code>
     * $query->filterByVJ(1234); // WHERE v_j = 1234
     * $query->filterByVJ(array(12, 34)); // WHERE v_j IN (12, 34)
     * $query->filterByVJ(array('min' => 12)); // WHERE v_j >= 12
     * $query->filterByVJ(array('max' => 12)); // WHERE v_j <= 12
     * </code>
     *
     * @param     mixed $vJ The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByVJ($vJ = null, $comparison = null)
    {
        if (is_array($vJ)) {
            $useMinMax = false;
            if (isset($vJ['min'])) {
                $this->addUsingAlias(DictamenesPeer::V_J, $vJ['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vJ['max'])) {
                $this->addUsingAlias(DictamenesPeer::V_J, $vJ['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DictamenesPeer::V_J, $vJ, $comparison);
    }

    /**
     * Filter the query on the queue column
     *
     * Example usage:
     * <code>
     * $query->filterByQueue('fooValue');   // WHERE queue = 'fooValue'
     * $query->filterByQueue('%fooValue%'); // WHERE queue LIKE '%fooValue%'
     * </code>
     *
     * @param     string $queue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function filterByQueue($queue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($queue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $queue)) {
                $queue = str_replace('*', '%', $queue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DictamenesPeer::QUEUE, $queue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Dictamenes $dictamenes Object to remove from the list of results
     *
     * @return DictamenesQuery The current query, for fluid interface
     */
    public function prune($dictamenes = null)
    {
        if ($dictamenes) {
            $this->addUsingAlias(DictamenesPeer::AUTO, $dictamenes->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
