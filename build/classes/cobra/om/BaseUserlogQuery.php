<?php


/**
 * Base class that represents a query for the 'userlog' table.
 *
 *
 *
 * @method UserlogQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method UserlogQuery orderByUsuario($order = Criteria::ASC) Order by the usuario column
 * @method UserlogQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method UserlogQuery orderByFechahora($order = Criteria::ASC) Order by the fechahora column
 * @method UserlogQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 *
 * @method UserlogQuery groupByAuto() Group by the auto column
 * @method UserlogQuery groupByUsuario() Group by the usuario column
 * @method UserlogQuery groupByTipo() Group by the tipo column
 * @method UserlogQuery groupByFechahora() Group by the fechahora column
 * @method UserlogQuery groupByGestor() Group by the gestor column
 *
 * @method UserlogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserlogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserlogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Userlog findOne(PropelPDO $con = null) Return the first Userlog matching the query
 * @method Userlog findOneOrCreate(PropelPDO $con = null) Return the first Userlog matching the query, or a new Userlog object populated from the query conditions when no match is found
 *
 * @method Userlog findOneByUsuario(string $usuario) Return the first Userlog filtered by the usuario column
 * @method Userlog findOneByTipo(string $tipo) Return the first Userlog filtered by the tipo column
 * @method Userlog findOneByFechahora(string $fechahora) Return the first Userlog filtered by the fechahora column
 * @method Userlog findOneByGestor(string $gestor) Return the first Userlog filtered by the gestor column
 *
 * @method array findByAuto(int $auto) Return Userlog objects filtered by the auto column
 * @method array findByUsuario(string $usuario) Return Userlog objects filtered by the usuario column
 * @method array findByTipo(string $tipo) Return Userlog objects filtered by the tipo column
 * @method array findByFechahora(string $fechahora) Return Userlog objects filtered by the fechahora column
 * @method array findByGestor(string $gestor) Return Userlog objects filtered by the gestor column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseUserlogQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserlogQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Userlog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserlogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UserlogQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserlogQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserlogQuery) {
            return $criteria;
        }
        $query = new UserlogQuery();
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
     * @return   Userlog|Userlog[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserlogPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Userlog A model object, or null if the key is not found
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
     * @return                 Userlog A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `usuario`, `tipo`, `fechahora`, `gestor` FROM `userlog` WHERE `auto` = :p0';
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
            $obj = new Userlog();
            $obj->hydrate($row);
            UserlogPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Userlog|Userlog[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Userlog[]|mixed the list of results, formatted by the current formatter
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
     * @return UserlogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserlogPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserlogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserlogPeer::AUTO, $keys, Criteria::IN);
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
     * @return UserlogQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(UserlogPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(UserlogPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserlogPeer::AUTO, $auto, $comparison);
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
     * @return UserlogQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserlogPeer::USUARIO, $usuario, $comparison);
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
     * @return UserlogQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserlogPeer::TIPO, $tipo, $comparison);
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
     * @return UserlogQuery The current query, for fluid interface
     */
    public function filterByFechahora($fechahora = null, $comparison = null)
    {
        if (is_array($fechahora)) {
            $useMinMax = false;
            if (isset($fechahora['min'])) {
                $this->addUsingAlias(UserlogPeer::FECHAHORA, $fechahora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechahora['max'])) {
                $this->addUsingAlias(UserlogPeer::FECHAHORA, $fechahora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserlogPeer::FECHAHORA, $fechahora, $comparison);
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
     * @return UserlogQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserlogPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Userlog $userlog Object to remove from the list of results
     *
     * @return UserlogQuery The current query, for fluid interface
     */
    public function prune($userlog = null)
    {
        if ($userlog) {
            $this->addUsingAlias(UserlogPeer::AUTO, $userlog->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
