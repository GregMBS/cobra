<?php


/**
 * Base class that represents a query for the 'shortzips' table.
 *
 *
 *
 * @method ShortzipsQuery orderByEstadoDeudor($order = Criteria::ASC) Order by the estado_deudor column
 * @method ShortzipsQuery orderByCiudadDeudor($order = Criteria::ASC) Order by the ciudad_deudor column
 * @method ShortzipsQuery orderByCpDeudor($order = Criteria::ASC) Order by the cp_deudor column
 * @method ShortzipsQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 *
 * @method ShortzipsQuery groupByEstadoDeudor() Group by the estado_deudor column
 * @method ShortzipsQuery groupByCiudadDeudor() Group by the ciudad_deudor column
 * @method ShortzipsQuery groupByCpDeudor() Group by the cp_deudor column
 * @method ShortzipsQuery groupByAuto() Group by the auto column
 *
 * @method ShortzipsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ShortzipsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ShortzipsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Shortzips findOne(PropelPDO $con = null) Return the first Shortzips matching the query
 * @method Shortzips findOneOrCreate(PropelPDO $con = null) Return the first Shortzips matching the query, or a new Shortzips object populated from the query conditions when no match is found
 *
 * @method Shortzips findOneByEstadoDeudor(string $estado_deudor) Return the first Shortzips filtered by the estado_deudor column
 * @method Shortzips findOneByCiudadDeudor(string $ciudad_deudor) Return the first Shortzips filtered by the ciudad_deudor column
 * @method Shortzips findOneByCpDeudor(string $cp_deudor) Return the first Shortzips filtered by the cp_deudor column
 *
 * @method array findByEstadoDeudor(string $estado_deudor) Return Shortzips objects filtered by the estado_deudor column
 * @method array findByCiudadDeudor(string $ciudad_deudor) Return Shortzips objects filtered by the ciudad_deudor column
 * @method array findByCpDeudor(string $cp_deudor) Return Shortzips objects filtered by the cp_deudor column
 * @method array findByAuto(int $auto) Return Shortzips objects filtered by the auto column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseShortzipsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseShortzipsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Shortzips', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ShortzipsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ShortzipsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ShortzipsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ShortzipsQuery) {
            return $criteria;
        }
        $query = new ShortzipsQuery();
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
     * @return   Shortzips|Shortzips[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShortzipsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ShortzipsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Shortzips A model object, or null if the key is not found
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
     * @return                 Shortzips A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `estado_deudor`, `ciudad_deudor`, `cp_deudor`, `auto` FROM `shortzips` WHERE `auto` = :p0';
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
            $obj = new Shortzips();
            $obj->hydrate($row);
            ShortzipsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Shortzips|Shortzips[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Shortzips[]|mixed the list of results, formatted by the current formatter
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
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShortzipsPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShortzipsPeer::AUTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the estado_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoDeudor('fooValue');   // WHERE estado_deudor = 'fooValue'
     * $query->filterByEstadoDeudor('%fooValue%'); // WHERE estado_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function filterByEstadoDeudor($estadoDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoDeudor)) {
                $estadoDeudor = str_replace('*', '%', $estadoDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShortzipsPeer::ESTADO_DEUDOR, $estadoDeudor, $comparison);
    }

    /**
     * Filter the query on the ciudad_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadDeudor('fooValue');   // WHERE ciudad_deudor = 'fooValue'
     * $query->filterByCiudadDeudor('%fooValue%'); // WHERE ciudad_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function filterByCiudadDeudor($ciudadDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadDeudor)) {
                $ciudadDeudor = str_replace('*', '%', $ciudadDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShortzipsPeer::CIUDAD_DEUDOR, $ciudadDeudor, $comparison);
    }

    /**
     * Filter the query on the cp_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByCpDeudor('fooValue');   // WHERE cp_deudor = 'fooValue'
     * $query->filterByCpDeudor('%fooValue%'); // WHERE cp_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function filterByCpDeudor($cpDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpDeudor)) {
                $cpDeudor = str_replace('*', '%', $cpDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShortzipsPeer::CP_DEUDOR, $cpDeudor, $comparison);
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
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(ShortzipsPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(ShortzipsPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShortzipsPeer::AUTO, $auto, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Shortzips $shortzips Object to remove from the list of results
     *
     * @return ShortzipsQuery The current query, for fluid interface
     */
    public function prune($shortzips = null)
    {
        if ($shortzips) {
            $this->addUsingAlias(ShortzipsPeer::AUTO, $shortzips->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
