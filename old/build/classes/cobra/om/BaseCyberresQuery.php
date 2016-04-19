<?php


/**
 * Base class that represents a query for the 'cyberres' table.
 *
 *
 *
 * @method CyberresQuery orderByDictamen($order = Criteria::ASC) Order by the dictamen column
 * @method CyberresQuery orderByCsiCr($order = Criteria::ASC) Order by the csi_cr column
 * @method CyberresQuery orderByCsiRes($order = Criteria::ASC) Order by the csi_res column
 * @method CyberresQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 *
 * @method CyberresQuery groupByDictamen() Group by the dictamen column
 * @method CyberresQuery groupByCsiCr() Group by the csi_cr column
 * @method CyberresQuery groupByCsiRes() Group by the csi_res column
 * @method CyberresQuery groupByAuto() Group by the auto column
 *
 * @method CyberresQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CyberresQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CyberresQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Cyberres findOne(PropelPDO $con = null) Return the first Cyberres matching the query
 * @method Cyberres findOneOrCreate(PropelPDO $con = null) Return the first Cyberres matching the query, or a new Cyberres object populated from the query conditions when no match is found
 *
 * @method Cyberres findOneByDictamen(string $dictamen) Return the first Cyberres filtered by the dictamen column
 * @method Cyberres findOneByCsiCr(string $csi_cr) Return the first Cyberres filtered by the csi_cr column
 * @method Cyberres findOneByCsiRes(string $csi_res) Return the first Cyberres filtered by the csi_res column
 *
 * @method array findByDictamen(string $dictamen) Return Cyberres objects filtered by the dictamen column
 * @method array findByCsiCr(string $csi_cr) Return Cyberres objects filtered by the csi_cr column
 * @method array findByCsiRes(string $csi_res) Return Cyberres objects filtered by the csi_res column
 * @method array findByAuto(int $auto) Return Cyberres objects filtered by the auto column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCyberresQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCyberresQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Cyberres', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CyberresQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CyberresQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CyberresQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CyberresQuery) {
            return $criteria;
        }
        $query = new CyberresQuery();
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
     * @return   Cyberres|Cyberres[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CyberresPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CyberresPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Cyberres A model object, or null if the key is not found
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
     * @return                 Cyberres A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `dictamen`, `csi_cr`, `csi_res`, `auto` FROM `cyberres` WHERE `auto` = :p0';
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
            $obj = new Cyberres();
            $obj->hydrate($row);
            CyberresPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Cyberres|Cyberres[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Cyberres[]|mixed the list of results, formatted by the current formatter
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
     * @return CyberresQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CyberresPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CyberresQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CyberresPeer::AUTO, $keys, Criteria::IN);
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
     * @return CyberresQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CyberresPeer::DICTAMEN, $dictamen, $comparison);
    }

    /**
     * Filter the query on the csi_cr column
     *
     * Example usage:
     * <code>
     * $query->filterByCsiCr('fooValue');   // WHERE csi_cr = 'fooValue'
     * $query->filterByCsiCr('%fooValue%'); // WHERE csi_cr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $csiCr The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CyberresQuery The current query, for fluid interface
     */
    public function filterByCsiCr($csiCr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($csiCr)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $csiCr)) {
                $csiCr = str_replace('*', '%', $csiCr);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CyberresPeer::CSI_CR, $csiCr, $comparison);
    }

    /**
     * Filter the query on the csi_res column
     *
     * Example usage:
     * <code>
     * $query->filterByCsiRes('fooValue');   // WHERE csi_res = 'fooValue'
     * $query->filterByCsiRes('%fooValue%'); // WHERE csi_res LIKE '%fooValue%'
     * </code>
     *
     * @param     string $csiRes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CyberresQuery The current query, for fluid interface
     */
    public function filterByCsiRes($csiRes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($csiRes)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $csiRes)) {
                $csiRes = str_replace('*', '%', $csiRes);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CyberresPeer::CSI_RES, $csiRes, $comparison);
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
     * @return CyberresQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(CyberresPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(CyberresPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CyberresPeer::AUTO, $auto, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Cyberres $cyberres Object to remove from the list of results
     *
     * @return CyberresQuery The current query, for fluid interface
     */
    public function prune($cyberres = null)
    {
        if ($cyberres) {
            $this->addUsingAlias(CyberresPeer::AUTO, $cyberres->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
