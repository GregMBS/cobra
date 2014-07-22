<?php


/**
 * Base class that represents a query for the 'cyberact' table.
 *
 *
 *
 * @method CyberactQuery orderByAccion($order = Criteria::ASC) Order by the accion column
 * @method CyberactQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method CyberactQuery orderByCodigo($order = Criteria::ASC) Order by the codigo column
 * @method CyberactQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 *
 * @method CyberactQuery groupByAccion() Group by the accion column
 * @method CyberactQuery groupByDescripcion() Group by the descripcion column
 * @method CyberactQuery groupByCodigo() Group by the codigo column
 * @method CyberactQuery groupByAuto() Group by the auto column
 *
 * @method CyberactQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CyberactQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CyberactQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Cyberact findOne(PropelPDO $con = null) Return the first Cyberact matching the query
 * @method Cyberact findOneOrCreate(PropelPDO $con = null) Return the first Cyberact matching the query, or a new Cyberact object populated from the query conditions when no match is found
 *
 * @method Cyberact findOneByAccion(string $accion) Return the first Cyberact filtered by the accion column
 * @method Cyberact findOneByDescripcion(string $descripcion) Return the first Cyberact filtered by the descripcion column
 * @method Cyberact findOneByCodigo(string $codigo) Return the first Cyberact filtered by the codigo column
 *
 * @method array findByAccion(string $accion) Return Cyberact objects filtered by the accion column
 * @method array findByDescripcion(string $descripcion) Return Cyberact objects filtered by the descripcion column
 * @method array findByCodigo(string $codigo) Return Cyberact objects filtered by the codigo column
 * @method array findByAuto(int $auto) Return Cyberact objects filtered by the auto column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCyberactQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCyberactQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Cyberact', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CyberactQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CyberactQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CyberactQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CyberactQuery) {
            return $criteria;
        }
        $query = new CyberactQuery();
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
     * @return   Cyberact|Cyberact[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CyberactPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CyberactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Cyberact A model object, or null if the key is not found
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
     * @return                 Cyberact A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `accion`, `descripcion`, `codigo`, `auto` FROM `cyberact` WHERE `auto` = :p0';
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
            $obj = new Cyberact();
            $obj->hydrate($row);
            CyberactPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Cyberact|Cyberact[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Cyberact[]|mixed the list of results, formatted by the current formatter
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
     * @return CyberactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CyberactPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CyberactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CyberactPeer::AUTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the accion column
     *
     * Example usage:
     * <code>
     * $query->filterByAccion('fooValue');   // WHERE accion = 'fooValue'
     * $query->filterByAccion('%fooValue%'); // WHERE accion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CyberactQuery The current query, for fluid interface
     */
    public function filterByAccion($accion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $accion)) {
                $accion = str_replace('*', '%', $accion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CyberactPeer::ACCION, $accion, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%'); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CyberactQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descripcion)) {
                $descripcion = str_replace('*', '%', $descripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CyberactPeer::DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the codigo column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigo('fooValue');   // WHERE codigo = 'fooValue'
     * $query->filterByCodigo('%fooValue%'); // WHERE codigo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CyberactQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $codigo)) {
                $codigo = str_replace('*', '%', $codigo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CyberactPeer::CODIGO, $codigo, $comparison);
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
     * @return CyberactQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(CyberactPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(CyberactPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CyberactPeer::AUTO, $auto, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Cyberact $cyberact Object to remove from the list of results
     *
     * @return CyberactQuery The current query, for fluid interface
     */
    public function prune($cyberact = null)
    {
        if ($cyberact) {
            $this->addUsingAlias(CyberactPeer::AUTO, $cyberact->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
