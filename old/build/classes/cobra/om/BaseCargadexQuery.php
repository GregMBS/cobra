<?php


/**
 * Base class that represents a query for the 'cargadex' table.
 *
 *
 *
 * @method CargadexQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method CargadexQuery orderByField($order = Criteria::ASC) Order by the field column
 * @method CargadexQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method CargadexQuery orderByNullok($order = Criteria::ASC) Order by the nullok column
 * @method CargadexQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method CargadexQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method CargadexQuery orderByKtable($order = Criteria::ASC) Order by the ktable column
 *
 * @method CargadexQuery groupByAuto() Group by the auto column
 * @method CargadexQuery groupByField() Group by the field column
 * @method CargadexQuery groupByType() Group by the type column
 * @method CargadexQuery groupByNullok() Group by the nullok column
 * @method CargadexQuery groupByPosition() Group by the position column
 * @method CargadexQuery groupByCliente() Group by the cliente column
 * @method CargadexQuery groupByKtable() Group by the ktable column
 *
 * @method CargadexQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CargadexQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CargadexQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Cargadex findOne(PropelPDO $con = null) Return the first Cargadex matching the query
 * @method Cargadex findOneOrCreate(PropelPDO $con = null) Return the first Cargadex matching the query, or a new Cargadex object populated from the query conditions when no match is found
 *
 * @method Cargadex findOneByField(string $field) Return the first Cargadex filtered by the field column
 * @method Cargadex findOneByType(string $type) Return the first Cargadex filtered by the type column
 * @method Cargadex findOneByNullok(string $nullok) Return the first Cargadex filtered by the nullok column
 * @method Cargadex findOneByPosition(int $position) Return the first Cargadex filtered by the position column
 * @method Cargadex findOneByCliente(string $cliente) Return the first Cargadex filtered by the cliente column
 * @method Cargadex findOneByKtable(string $ktable) Return the first Cargadex filtered by the ktable column
 *
 * @method array findByAuto(int $auto) Return Cargadex objects filtered by the auto column
 * @method array findByField(string $field) Return Cargadex objects filtered by the field column
 * @method array findByType(string $type) Return Cargadex objects filtered by the type column
 * @method array findByNullok(string $nullok) Return Cargadex objects filtered by the nullok column
 * @method array findByPosition(int $position) Return Cargadex objects filtered by the position column
 * @method array findByCliente(string $cliente) Return Cargadex objects filtered by the cliente column
 * @method array findByKtable(string $ktable) Return Cargadex objects filtered by the ktable column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCargadexQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCargadexQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Cargadex', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CargadexQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CargadexQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CargadexQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CargadexQuery) {
            return $criteria;
        }
        $query = new CargadexQuery();
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
     * @return   Cargadex|Cargadex[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CargadexPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CargadexPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Cargadex A model object, or null if the key is not found
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
     * @return                 Cargadex A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `field`, `type`, `nullok`, `position`, `cliente`, `ktable` FROM `cargadex` WHERE `auto` = :p0';
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
            $obj = new Cargadex();
            $obj->hydrate($row);
            CargadexPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Cargadex|Cargadex[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Cargadex[]|mixed the list of results, formatted by the current formatter
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
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CargadexPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CargadexPeer::AUTO, $keys, Criteria::IN);
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
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(CargadexPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(CargadexPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CargadexPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the field column
     *
     * Example usage:
     * <code>
     * $query->filterByField('fooValue');   // WHERE field = 'fooValue'
     * $query->filterByField('%fooValue%'); // WHERE field LIKE '%fooValue%'
     * </code>
     *
     * @param     string $field The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByField($field = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($field)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $field)) {
                $field = str_replace('*', '%', $field);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CargadexPeer::FIELD, $field, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CargadexPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the nullok column
     *
     * Example usage:
     * <code>
     * $query->filterByNullok('fooValue');   // WHERE nullok = 'fooValue'
     * $query->filterByNullok('%fooValue%'); // WHERE nullok LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nullok The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByNullok($nullok = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nullok)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nullok)) {
                $nullok = str_replace('*', '%', $nullok);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CargadexPeer::NULLOK, $nullok, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position >= 12
     * $query->filterByPosition(array('max' => 12)); // WHERE position <= 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(CargadexPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(CargadexPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CargadexPeer::POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the cliente column
     *
     * Example usage:
     * <code>
     * $query->filterByCliente('fooValue');   // WHERE cliente = 'fooValue'
     * $query->filterByCliente('%fooValue%'); // WHERE cliente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByCliente($cliente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliente)) {
                $cliente = str_replace('*', '%', $cliente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CargadexPeer::CLIENTE, $cliente, $comparison);
    }

    /**
     * Filter the query on the ktable column
     *
     * Example usage:
     * <code>
     * $query->filterByKtable('fooValue');   // WHERE ktable = 'fooValue'
     * $query->filterByKtable('%fooValue%'); // WHERE ktable LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ktable The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function filterByKtable($ktable = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ktable)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ktable)) {
                $ktable = str_replace('*', '%', $ktable);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CargadexPeer::KTABLE, $ktable, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Cargadex $cargadex Object to remove from the list of results
     *
     * @return CargadexQuery The current query, for fluid interface
     */
    public function prune($cargadex = null)
    {
        if ($cargadex) {
            $this->addUsingAlias(CargadexPeer::AUTO, $cargadex->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
