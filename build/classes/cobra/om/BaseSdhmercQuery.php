<?php


/**
 * Base class that represents a query for the 'sdhmerc' table.
 *
 *
 *
 * @method SdhmercQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method SdhmercQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 * @method SdhmercQuery orderByMerc($order = Criteria::ASC) Order by the merc column
 * @method SdhmercQuery orderByFechamerc($order = Criteria::ASC) Order by the fechamerc column
 * @method SdhmercQuery orderByFechacapt($order = Criteria::ASC) Order by the fechacapt column
 *
 * @method SdhmercQuery groupByAuto() Group by the auto column
 * @method SdhmercQuery groupByIdCuenta() Group by the id_cuenta column
 * @method SdhmercQuery groupByMerc() Group by the merc column
 * @method SdhmercQuery groupByFechamerc() Group by the fechamerc column
 * @method SdhmercQuery groupByFechacapt() Group by the fechacapt column
 *
 * @method SdhmercQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SdhmercQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SdhmercQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Sdhmerc findOne(PropelPDO $con = null) Return the first Sdhmerc matching the query
 * @method Sdhmerc findOneOrCreate(PropelPDO $con = null) Return the first Sdhmerc matching the query, or a new Sdhmerc object populated from the query conditions when no match is found
 *
 * @method Sdhmerc findOneByIdCuenta(int $id_cuenta) Return the first Sdhmerc filtered by the id_cuenta column
 * @method Sdhmerc findOneByMerc(string $merc) Return the first Sdhmerc filtered by the merc column
 * @method Sdhmerc findOneByFechamerc(string $fechamerc) Return the first Sdhmerc filtered by the fechamerc column
 * @method Sdhmerc findOneByFechacapt(string $fechacapt) Return the first Sdhmerc filtered by the fechacapt column
 *
 * @method array findByAuto(int $auto) Return Sdhmerc objects filtered by the auto column
 * @method array findByIdCuenta(int $id_cuenta) Return Sdhmerc objects filtered by the id_cuenta column
 * @method array findByMerc(string $merc) Return Sdhmerc objects filtered by the merc column
 * @method array findByFechamerc(string $fechamerc) Return Sdhmerc objects filtered by the fechamerc column
 * @method array findByFechacapt(string $fechacapt) Return Sdhmerc objects filtered by the fechacapt column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseSdhmercQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSdhmercQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Sdhmerc', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SdhmercQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SdhmercQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SdhmercQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SdhmercQuery) {
            return $criteria;
        }
        $query = new SdhmercQuery();
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
     * @return   Sdhmerc|Sdhmerc[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SdhmercPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SdhmercPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Sdhmerc A model object, or null if the key is not found
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
     * @return                 Sdhmerc A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `id_cuenta`, `merc`, `fechamerc`, `fechacapt` FROM `sdhmerc` WHERE `auto` = :p0';
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
            $obj = new Sdhmerc();
            $obj->hydrate($row);
            SdhmercPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Sdhmerc|Sdhmerc[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Sdhmerc[]|mixed the list of results, formatted by the current formatter
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
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SdhmercPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SdhmercPeer::AUTO, $keys, Criteria::IN);
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
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(SdhmercPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(SdhmercPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhmercPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the id_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCuenta(1234); // WHERE id_cuenta = 1234
     * $query->filterByIdCuenta(array(12, 34)); // WHERE id_cuenta IN (12, 34)
     * $query->filterByIdCuenta(array('min' => 12)); // WHERE id_cuenta >= 12
     * $query->filterByIdCuenta(array('max' => 12)); // WHERE id_cuenta <= 12
     * </code>
     *
     * @param     mixed $idCuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(SdhmercPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(SdhmercPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhmercPeer::ID_CUENTA, $idCuenta, $comparison);
    }

    /**
     * Filter the query on the merc column
     *
     * Example usage:
     * <code>
     * $query->filterByMerc('fooValue');   // WHERE merc = 'fooValue'
     * $query->filterByMerc('%fooValue%'); // WHERE merc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $merc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByMerc($merc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($merc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $merc)) {
                $merc = str_replace('*', '%', $merc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SdhmercPeer::MERC, $merc, $comparison);
    }

    /**
     * Filter the query on the fechamerc column
     *
     * Example usage:
     * <code>
     * $query->filterByFechamerc('2011-03-14'); // WHERE fechamerc = '2011-03-14'
     * $query->filterByFechamerc('now'); // WHERE fechamerc = '2011-03-14'
     * $query->filterByFechamerc(array('max' => 'yesterday')); // WHERE fechamerc > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechamerc The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByFechamerc($fechamerc = null, $comparison = null)
    {
        if (is_array($fechamerc)) {
            $useMinMax = false;
            if (isset($fechamerc['min'])) {
                $this->addUsingAlias(SdhmercPeer::FECHAMERC, $fechamerc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechamerc['max'])) {
                $this->addUsingAlias(SdhmercPeer::FECHAMERC, $fechamerc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhmercPeer::FECHAMERC, $fechamerc, $comparison);
    }

    /**
     * Filter the query on the fechacapt column
     *
     * Example usage:
     * <code>
     * $query->filterByFechacapt('2011-03-14'); // WHERE fechacapt = '2011-03-14'
     * $query->filterByFechacapt('now'); // WHERE fechacapt = '2011-03-14'
     * $query->filterByFechacapt(array('max' => 'yesterday')); // WHERE fechacapt > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechacapt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function filterByFechacapt($fechacapt = null, $comparison = null)
    {
        if (is_array($fechacapt)) {
            $useMinMax = false;
            if (isset($fechacapt['min'])) {
                $this->addUsingAlias(SdhmercPeer::FECHACAPT, $fechacapt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechacapt['max'])) {
                $this->addUsingAlias(SdhmercPeer::FECHACAPT, $fechacapt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhmercPeer::FECHACAPT, $fechacapt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Sdhmerc $sdhmerc Object to remove from the list of results
     *
     * @return SdhmercQuery The current query, for fluid interface
     */
    public function prune($sdhmerc = null)
    {
        if ($sdhmerc) {
            $this->addUsingAlias(SdhmercPeer::AUTO, $sdhmerc->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
