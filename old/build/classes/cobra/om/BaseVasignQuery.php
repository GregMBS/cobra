<?php


/**
 * Base class that represents a query for the 'vasign' table.
 *
 *
 *
 * @method VasignQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method VasignQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method VasignQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method VasignQuery orderByFechaout($order = Criteria::ASC) Order by the fechaout column
 * @method VasignQuery orderByFechain($order = Criteria::ASC) Order by the fechain column
 * @method VasignQuery orderByCCont($order = Criteria::ASC) Order by the c_cont column
 *
 * @method VasignQuery groupByAuto() Group by the auto column
 * @method VasignQuery groupByCuenta() Group by the cuenta column
 * @method VasignQuery groupByGestor() Group by the gestor column
 * @method VasignQuery groupByFechaout() Group by the fechaout column
 * @method VasignQuery groupByFechain() Group by the fechain column
 * @method VasignQuery groupByCCont() Group by the c_cont column
 *
 * @method VasignQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VasignQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VasignQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Vasign findOne(PropelPDO $con = null) Return the first Vasign matching the query
 * @method Vasign findOneOrCreate(PropelPDO $con = null) Return the first Vasign matching the query, or a new Vasign object populated from the query conditions when no match is found
 *
 * @method Vasign findOneByCuenta(string $cuenta) Return the first Vasign filtered by the cuenta column
 * @method Vasign findOneByGestor(string $gestor) Return the first Vasign filtered by the gestor column
 * @method Vasign findOneByFechaout(string $fechaout) Return the first Vasign filtered by the fechaout column
 * @method Vasign findOneByFechain(string $fechain) Return the first Vasign filtered by the fechain column
 * @method Vasign findOneByCCont(int $c_cont) Return the first Vasign filtered by the c_cont column
 *
 * @method array findByAuto(int $auto) Return Vasign objects filtered by the auto column
 * @method array findByCuenta(string $cuenta) Return Vasign objects filtered by the cuenta column
 * @method array findByGestor(string $gestor) Return Vasign objects filtered by the gestor column
 * @method array findByFechaout(string $fechaout) Return Vasign objects filtered by the fechaout column
 * @method array findByFechain(string $fechain) Return Vasign objects filtered by the fechain column
 * @method array findByCCont(int $c_cont) Return Vasign objects filtered by the c_cont column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseVasignQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVasignQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Vasign', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VasignQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VasignQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VasignQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VasignQuery) {
            return $criteria;
        }
        $query = new VasignQuery();
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
     * @return   Vasign|Vasign[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VasignPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VasignPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Vasign A model object, or null if the key is not found
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
     * @return                 Vasign A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `cuenta`, `gestor`, `fechaout`, `fechain`, `c_cont` FROM `vasign` WHERE `auto` = :p0';
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
            $obj = new Vasign();
            $obj->hydrate($row);
            VasignPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Vasign|Vasign[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Vasign[]|mixed the list of results, formatted by the current formatter
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
     * @return VasignQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VasignPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VasignQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VasignPeer::AUTO, $keys, Criteria::IN);
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
     * @return VasignQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(VasignPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(VasignPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VasignPeer::AUTO, $auto, $comparison);
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
     * @return VasignQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VasignPeer::CUENTA, $cuenta, $comparison);
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
     * @return VasignQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VasignPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Filter the query on the fechaout column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaout('2011-03-14'); // WHERE fechaout = '2011-03-14'
     * $query->filterByFechaout('now'); // WHERE fechaout = '2011-03-14'
     * $query->filterByFechaout(array('max' => 'yesterday')); // WHERE fechaout > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaout The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VasignQuery The current query, for fluid interface
     */
    public function filterByFechaout($fechaout = null, $comparison = null)
    {
        if (is_array($fechaout)) {
            $useMinMax = false;
            if (isset($fechaout['min'])) {
                $this->addUsingAlias(VasignPeer::FECHAOUT, $fechaout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaout['max'])) {
                $this->addUsingAlias(VasignPeer::FECHAOUT, $fechaout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VasignPeer::FECHAOUT, $fechaout, $comparison);
    }

    /**
     * Filter the query on the fechain column
     *
     * Example usage:
     * <code>
     * $query->filterByFechain('2011-03-14'); // WHERE fechain = '2011-03-14'
     * $query->filterByFechain('now'); // WHERE fechain = '2011-03-14'
     * $query->filterByFechain(array('max' => 'yesterday')); // WHERE fechain > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechain The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VasignQuery The current query, for fluid interface
     */
    public function filterByFechain($fechain = null, $comparison = null)
    {
        if (is_array($fechain)) {
            $useMinMax = false;
            if (isset($fechain['min'])) {
                $this->addUsingAlias(VasignPeer::FECHAIN, $fechain['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechain['max'])) {
                $this->addUsingAlias(VasignPeer::FECHAIN, $fechain['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VasignPeer::FECHAIN, $fechain, $comparison);
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
     * @return VasignQuery The current query, for fluid interface
     */
    public function filterByCCont($cCont = null, $comparison = null)
    {
        if (is_array($cCont)) {
            $useMinMax = false;
            if (isset($cCont['min'])) {
                $this->addUsingAlias(VasignPeer::C_CONT, $cCont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cCont['max'])) {
                $this->addUsingAlias(VasignPeer::C_CONT, $cCont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VasignPeer::C_CONT, $cCont, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Vasign $vasign Object to remove from the list of results
     *
     * @return VasignQuery The current query, for fluid interface
     */
    public function prune($vasign = null)
    {
        if ($vasign) {
            $this->addUsingAlias(VasignPeer::AUTO, $vasign->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
