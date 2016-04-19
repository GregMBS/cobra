<?php


/**
 * Base class that represents a query for the 'sdhextras' table.
 *
 *
 *
 * @method SdhextrasQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method SdhextrasQuery orderByProductos($order = Criteria::ASC) Order by the productos column
 * @method SdhextrasQuery orderBySt($order = Criteria::ASC) Order by the st column
 * @method SdhextrasQuery orderBySv($order = Criteria::ASC) Order by the sv column
 * @method SdhextrasQuery orderBySd($order = Criteria::ASC) Order by the sd column
 * @method SdhextrasQuery orderByPeriod($order = Criteria::ASC) Order by the period column
 * @method SdhextrasQuery orderByMonto($order = Criteria::ASC) Order by the monto column
 * @method SdhextrasQuery orderBySdd($order = Criteria::ASC) Order by the sdd column
 * @method SdhextrasQuery orderBySubcuenta($order = Criteria::ASC) Order by the subcuenta column
 * @method SdhextrasQuery orderByGc($order = Criteria::ASC) Order by the gc column
 * @method SdhextrasQuery orderByXmora($order = Criteria::ASC) Order by the xmora column
 * @method SdhextrasQuery orderByGrupo($order = Criteria::ASC) Order by the grupo column
 * @method SdhextrasQuery orderByLiquid($order = Criteria::ASC) Order by the liquid column
 * @method SdhextrasQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 *
 * @method SdhextrasQuery groupByCuenta() Group by the cuenta column
 * @method SdhextrasQuery groupByProductos() Group by the productos column
 * @method SdhextrasQuery groupBySt() Group by the st column
 * @method SdhextrasQuery groupBySv() Group by the sv column
 * @method SdhextrasQuery groupBySd() Group by the sd column
 * @method SdhextrasQuery groupByPeriod() Group by the period column
 * @method SdhextrasQuery groupByMonto() Group by the monto column
 * @method SdhextrasQuery groupBySdd() Group by the sdd column
 * @method SdhextrasQuery groupBySubcuenta() Group by the subcuenta column
 * @method SdhextrasQuery groupByGc() Group by the gc column
 * @method SdhextrasQuery groupByXmora() Group by the xmora column
 * @method SdhextrasQuery groupByGrupo() Group by the grupo column
 * @method SdhextrasQuery groupByLiquid() Group by the liquid column
 * @method SdhextrasQuery groupByAuto() Group by the auto column
 *
 * @method SdhextrasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SdhextrasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SdhextrasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Sdhextras findOne(PropelPDO $con = null) Return the first Sdhextras matching the query
 * @method Sdhextras findOneOrCreate(PropelPDO $con = null) Return the first Sdhextras matching the query, or a new Sdhextras object populated from the query conditions when no match is found
 *
 * @method Sdhextras findOneByCuenta(string $cuenta) Return the first Sdhextras filtered by the cuenta column
 * @method Sdhextras findOneByProductos(string $productos) Return the first Sdhextras filtered by the productos column
 * @method Sdhextras findOneBySt(string $st) Return the first Sdhextras filtered by the st column
 * @method Sdhextras findOneBySv(string $sv) Return the first Sdhextras filtered by the sv column
 * @method Sdhextras findOneBySd(string $sd) Return the first Sdhextras filtered by the sd column
 * @method Sdhextras findOneByPeriod(string $period) Return the first Sdhextras filtered by the period column
 * @method Sdhextras findOneByMonto(string $monto) Return the first Sdhextras filtered by the monto column
 * @method Sdhextras findOneBySdd(string $sdd) Return the first Sdhextras filtered by the sdd column
 * @method Sdhextras findOneBySubcuenta(string $subcuenta) Return the first Sdhextras filtered by the subcuenta column
 * @method Sdhextras findOneByGc(string $gc) Return the first Sdhextras filtered by the gc column
 * @method Sdhextras findOneByXmora(int $xmora) Return the first Sdhextras filtered by the xmora column
 * @method Sdhextras findOneByGrupo(int $grupo) Return the first Sdhextras filtered by the grupo column
 * @method Sdhextras findOneByLiquid(int $liquid) Return the first Sdhextras filtered by the liquid column
 *
 * @method array findByCuenta(string $cuenta) Return Sdhextras objects filtered by the cuenta column
 * @method array findByProductos(string $productos) Return Sdhextras objects filtered by the productos column
 * @method array findBySt(string $st) Return Sdhextras objects filtered by the st column
 * @method array findBySv(string $sv) Return Sdhextras objects filtered by the sv column
 * @method array findBySd(string $sd) Return Sdhextras objects filtered by the sd column
 * @method array findByPeriod(string $period) Return Sdhextras objects filtered by the period column
 * @method array findByMonto(string $monto) Return Sdhextras objects filtered by the monto column
 * @method array findBySdd(string $sdd) Return Sdhextras objects filtered by the sdd column
 * @method array findBySubcuenta(string $subcuenta) Return Sdhextras objects filtered by the subcuenta column
 * @method array findByGc(string $gc) Return Sdhextras objects filtered by the gc column
 * @method array findByXmora(int $xmora) Return Sdhextras objects filtered by the xmora column
 * @method array findByGrupo(int $grupo) Return Sdhextras objects filtered by the grupo column
 * @method array findByLiquid(int $liquid) Return Sdhextras objects filtered by the liquid column
 * @method array findByAuto(int $auto) Return Sdhextras objects filtered by the auto column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseSdhextrasQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSdhextrasQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Sdhextras', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SdhextrasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SdhextrasQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SdhextrasQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SdhextrasQuery) {
            return $criteria;
        }
        $query = new SdhextrasQuery();
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
     * @return   Sdhextras|Sdhextras[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SdhextrasPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SdhextrasPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Sdhextras A model object, or null if the key is not found
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
     * @return                 Sdhextras A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `cuenta`, `productos`, `st`, `sv`, `sd`, `period`, `monto`, `sdd`, `subcuenta`, `gc`, `xmora`, `grupo`, `liquid`, `auto` FROM `sdhextras` WHERE `auto` = :p0';
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
            $obj = new Sdhextras();
            $obj->hydrate($row);
            SdhextrasPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Sdhextras|Sdhextras[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Sdhextras[]|mixed the list of results, formatted by the current formatter
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
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SdhextrasPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SdhextrasPeer::AUTO, $keys, Criteria::IN);
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
     * @return SdhextrasQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SdhextrasPeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the productos column
     *
     * Example usage:
     * <code>
     * $query->filterByProductos('fooValue');   // WHERE productos = 'fooValue'
     * $query->filterByProductos('%fooValue%'); // WHERE productos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByProductos($productos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productos)) {
                $productos = str_replace('*', '%', $productos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::PRODUCTOS, $productos, $comparison);
    }

    /**
     * Filter the query on the st column
     *
     * Example usage:
     * <code>
     * $query->filterBySt(1234); // WHERE st = 1234
     * $query->filterBySt(array(12, 34)); // WHERE st IN (12, 34)
     * $query->filterBySt(array('min' => 12)); // WHERE st >= 12
     * $query->filterBySt(array('max' => 12)); // WHERE st <= 12
     * </code>
     *
     * @param     mixed $st The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterBySt($st = null, $comparison = null)
    {
        if (is_array($st)) {
            $useMinMax = false;
            if (isset($st['min'])) {
                $this->addUsingAlias(SdhextrasPeer::ST, $st['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($st['max'])) {
                $this->addUsingAlias(SdhextrasPeer::ST, $st['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::ST, $st, $comparison);
    }

    /**
     * Filter the query on the sv column
     *
     * Example usage:
     * <code>
     * $query->filterBySv(1234); // WHERE sv = 1234
     * $query->filterBySv(array(12, 34)); // WHERE sv IN (12, 34)
     * $query->filterBySv(array('min' => 12)); // WHERE sv >= 12
     * $query->filterBySv(array('max' => 12)); // WHERE sv <= 12
     * </code>
     *
     * @param     mixed $sv The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterBySv($sv = null, $comparison = null)
    {
        if (is_array($sv)) {
            $useMinMax = false;
            if (isset($sv['min'])) {
                $this->addUsingAlias(SdhextrasPeer::SV, $sv['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sv['max'])) {
                $this->addUsingAlias(SdhextrasPeer::SV, $sv['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::SV, $sv, $comparison);
    }

    /**
     * Filter the query on the sd column
     *
     * Example usage:
     * <code>
     * $query->filterBySd(1234); // WHERE sd = 1234
     * $query->filterBySd(array(12, 34)); // WHERE sd IN (12, 34)
     * $query->filterBySd(array('min' => 12)); // WHERE sd >= 12
     * $query->filterBySd(array('max' => 12)); // WHERE sd <= 12
     * </code>
     *
     * @param     mixed $sd The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterBySd($sd = null, $comparison = null)
    {
        if (is_array($sd)) {
            $useMinMax = false;
            if (isset($sd['min'])) {
                $this->addUsingAlias(SdhextrasPeer::SD, $sd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sd['max'])) {
                $this->addUsingAlias(SdhextrasPeer::SD, $sd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::SD, $sd, $comparison);
    }

    /**
     * Filter the query on the period column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriod('fooValue');   // WHERE period = 'fooValue'
     * $query->filterByPeriod('%fooValue%'); // WHERE period LIKE '%fooValue%'
     * </code>
     *
     * @param     string $period The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByPeriod($period = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($period)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $period)) {
                $period = str_replace('*', '%', $period);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::PERIOD, $period, $comparison);
    }

    /**
     * Filter the query on the monto column
     *
     * Example usage:
     * <code>
     * $query->filterByMonto(1234); // WHERE monto = 1234
     * $query->filterByMonto(array(12, 34)); // WHERE monto IN (12, 34)
     * $query->filterByMonto(array('min' => 12)); // WHERE monto >= 12
     * $query->filterByMonto(array('max' => 12)); // WHERE monto <= 12
     * </code>
     *
     * @param     mixed $monto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByMonto($monto = null, $comparison = null)
    {
        if (is_array($monto)) {
            $useMinMax = false;
            if (isset($monto['min'])) {
                $this->addUsingAlias(SdhextrasPeer::MONTO, $monto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($monto['max'])) {
                $this->addUsingAlias(SdhextrasPeer::MONTO, $monto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::MONTO, $monto, $comparison);
    }

    /**
     * Filter the query on the sdd column
     *
     * Example usage:
     * <code>
     * $query->filterBySdd(1234); // WHERE sdd = 1234
     * $query->filterBySdd(array(12, 34)); // WHERE sdd IN (12, 34)
     * $query->filterBySdd(array('min' => 12)); // WHERE sdd >= 12
     * $query->filterBySdd(array('max' => 12)); // WHERE sdd <= 12
     * </code>
     *
     * @param     mixed $sdd The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterBySdd($sdd = null, $comparison = null)
    {
        if (is_array($sdd)) {
            $useMinMax = false;
            if (isset($sdd['min'])) {
                $this->addUsingAlias(SdhextrasPeer::SDD, $sdd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sdd['max'])) {
                $this->addUsingAlias(SdhextrasPeer::SDD, $sdd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::SDD, $sdd, $comparison);
    }

    /**
     * Filter the query on the subcuenta column
     *
     * Example usage:
     * <code>
     * $query->filterBySubcuenta('fooValue');   // WHERE subcuenta = 'fooValue'
     * $query->filterBySubcuenta('%fooValue%'); // WHERE subcuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subcuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterBySubcuenta($subcuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subcuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subcuenta)) {
                $subcuenta = str_replace('*', '%', $subcuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::SUBCUENTA, $subcuenta, $comparison);
    }

    /**
     * Filter the query on the gc column
     *
     * Example usage:
     * <code>
     * $query->filterByGc(1234); // WHERE gc = 1234
     * $query->filterByGc(array(12, 34)); // WHERE gc IN (12, 34)
     * $query->filterByGc(array('min' => 12)); // WHERE gc >= 12
     * $query->filterByGc(array('max' => 12)); // WHERE gc <= 12
     * </code>
     *
     * @param     mixed $gc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByGc($gc = null, $comparison = null)
    {
        if (is_array($gc)) {
            $useMinMax = false;
            if (isset($gc['min'])) {
                $this->addUsingAlias(SdhextrasPeer::GC, $gc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gc['max'])) {
                $this->addUsingAlias(SdhextrasPeer::GC, $gc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::GC, $gc, $comparison);
    }

    /**
     * Filter the query on the xmora column
     *
     * Example usage:
     * <code>
     * $query->filterByXmora(1234); // WHERE xmora = 1234
     * $query->filterByXmora(array(12, 34)); // WHERE xmora IN (12, 34)
     * $query->filterByXmora(array('min' => 12)); // WHERE xmora >= 12
     * $query->filterByXmora(array('max' => 12)); // WHERE xmora <= 12
     * </code>
     *
     * @param     mixed $xmora The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByXmora($xmora = null, $comparison = null)
    {
        if (is_array($xmora)) {
            $useMinMax = false;
            if (isset($xmora['min'])) {
                $this->addUsingAlias(SdhextrasPeer::XMORA, $xmora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($xmora['max'])) {
                $this->addUsingAlias(SdhextrasPeer::XMORA, $xmora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::XMORA, $xmora, $comparison);
    }

    /**
     * Filter the query on the grupo column
     *
     * Example usage:
     * <code>
     * $query->filterByGrupo(1234); // WHERE grupo = 1234
     * $query->filterByGrupo(array(12, 34)); // WHERE grupo IN (12, 34)
     * $query->filterByGrupo(array('min' => 12)); // WHERE grupo >= 12
     * $query->filterByGrupo(array('max' => 12)); // WHERE grupo <= 12
     * </code>
     *
     * @param     mixed $grupo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo = null, $comparison = null)
    {
        if (is_array($grupo)) {
            $useMinMax = false;
            if (isset($grupo['min'])) {
                $this->addUsingAlias(SdhextrasPeer::GRUPO, $grupo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grupo['max'])) {
                $this->addUsingAlias(SdhextrasPeer::GRUPO, $grupo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::GRUPO, $grupo, $comparison);
    }

    /**
     * Filter the query on the liquid column
     *
     * Example usage:
     * <code>
     * $query->filterByLiquid(1234); // WHERE liquid = 1234
     * $query->filterByLiquid(array(12, 34)); // WHERE liquid IN (12, 34)
     * $query->filterByLiquid(array('min' => 12)); // WHERE liquid >= 12
     * $query->filterByLiquid(array('max' => 12)); // WHERE liquid <= 12
     * </code>
     *
     * @param     mixed $liquid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByLiquid($liquid = null, $comparison = null)
    {
        if (is_array($liquid)) {
            $useMinMax = false;
            if (isset($liquid['min'])) {
                $this->addUsingAlias(SdhextrasPeer::LIQUID, $liquid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($liquid['max'])) {
                $this->addUsingAlias(SdhextrasPeer::LIQUID, $liquid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::LIQUID, $liquid, $comparison);
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
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(SdhextrasPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(SdhextrasPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SdhextrasPeer::AUTO, $auto, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Sdhextras $sdhextras Object to remove from the list of results
     *
     * @return SdhextrasQuery The current query, for fluid interface
     */
    public function prune($sdhextras = null)
    {
        if ($sdhextras) {
            $this->addUsingAlias(SdhextrasPeer::AUTO, $sdhextras->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
