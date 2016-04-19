<?php


/**
 * Base class that represents a query for the 'permalog' table.
 *
 *
 *
 * @method PermalogQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method PermalogQuery orderByUsuario($order = Criteria::ASC) Order by the usuario column
 * @method PermalogQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method PermalogQuery orderByFechahora($order = Criteria::ASC) Order by the fechahora column
 * @method PermalogQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 *
 * @method PermalogQuery groupByAuto() Group by the auto column
 * @method PermalogQuery groupByUsuario() Group by the usuario column
 * @method PermalogQuery groupByTipo() Group by the tipo column
 * @method PermalogQuery groupByFechahora() Group by the fechahora column
 * @method PermalogQuery groupByGestor() Group by the gestor column
 *
 * @method PermalogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PermalogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PermalogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Permalog findOne(PropelPDO $con = null) Return the first Permalog matching the query
 * @method Permalog findOneOrCreate(PropelPDO $con = null) Return the first Permalog matching the query, or a new Permalog object populated from the query conditions when no match is found
 *
 * @method Permalog findOneByUsuario(string $usuario) Return the first Permalog filtered by the usuario column
 * @method Permalog findOneByTipo(string $tipo) Return the first Permalog filtered by the tipo column
 * @method Permalog findOneByFechahora(string $fechahora) Return the first Permalog filtered by the fechahora column
 * @method Permalog findOneByGestor(string $gestor) Return the first Permalog filtered by the gestor column
 *
 * @method array findByAuto(int $auto) Return Permalog objects filtered by the auto column
 * @method array findByUsuario(string $usuario) Return Permalog objects filtered by the usuario column
 * @method array findByTipo(string $tipo) Return Permalog objects filtered by the tipo column
 * @method array findByFechahora(string $fechahora) Return Permalog objects filtered by the fechahora column
 * @method array findByGestor(string $gestor) Return Permalog objects filtered by the gestor column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BasePermalogQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePermalogQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Permalog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PermalogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PermalogQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PermalogQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PermalogQuery) {
            return $criteria;
        }
        $query = new PermalogQuery();
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
     * @return   Permalog|Permalog[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PermalogPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PermalogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Permalog A model object, or null if the key is not found
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
     * @return                 Permalog A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `usuario`, `tipo`, `fechahora`, `gestor` FROM `permalog` WHERE `auto` = :p0';
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
            $obj = new Permalog();
            $obj->hydrate($row);
            PermalogPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Permalog|Permalog[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Permalog[]|mixed the list of results, formatted by the current formatter
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
     * @return PermalogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PermalogPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PermalogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PermalogPeer::AUTO, $keys, Criteria::IN);
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
     * @return PermalogQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(PermalogPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(PermalogPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermalogPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the usuario column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuario('fooValue');   // WHERE usuario = 'fooValue'
     * $query->filterByUsuario('%fooValue%'); // WHERE usuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PermalogQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuario)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuario)) {
                $usuario = str_replace('*', '%', $usuario);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PermalogPeer::USUARIO, $usuario, $comparison);
    }

    /**
     * Filter the query on the tipo column
     *
     * Example usage:
     * <code>
     * $query->filterByTipo('fooValue');   // WHERE tipo = 'fooValue'
     * $query->filterByTipo('%fooValue%'); // WHERE tipo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PermalogQuery The current query, for fluid interface
     */
    public function filterByTipo($tipo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tipo)) {
                $tipo = str_replace('*', '%', $tipo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PermalogPeer::TIPO, $tipo, $comparison);
    }

    /**
     * Filter the query on the fechahora column
     *
     * Example usage:
     * <code>
     * $query->filterByFechahora('2011-03-14'); // WHERE fechahora = '2011-03-14'
     * $query->filterByFechahora('now'); // WHERE fechahora = '2011-03-14'
     * $query->filterByFechahora(array('max' => 'yesterday')); // WHERE fechahora > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechahora The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PermalogQuery The current query, for fluid interface
     */
    public function filterByFechahora($fechahora = null, $comparison = null)
    {
        if (is_array($fechahora)) {
            $useMinMax = false;
            if (isset($fechahora['min'])) {
                $this->addUsingAlias(PermalogPeer::FECHAHORA, $fechahora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechahora['max'])) {
                $this->addUsingAlias(PermalogPeer::FECHAHORA, $fechahora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermalogPeer::FECHAHORA, $fechahora, $comparison);
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
     * @return PermalogQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PermalogPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Permalog $permalog Object to remove from the list of results
     *
     * @return PermalogQuery The current query, for fluid interface
     */
    public function prune($permalog = null)
    {
        if ($permalog) {
            $this->addUsingAlias(PermalogPeer::AUTO, $permalog->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
