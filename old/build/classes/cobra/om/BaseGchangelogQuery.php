<?php


/**
 * Base class that represents a query for the 'gchangelog' table.
 *
 *
 *
 * @method GchangelogQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method GchangelogQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 * @method GchangelogQuery orderByFechahora($order = Criteria::ASC) Order by the fechahora column
 * @method GchangelogQuery orderByGestorOld($order = Criteria::ASC) Order by the gestor_old column
 * @method GchangelogQuery orderByGestorNew($order = Criteria::ASC) Order by the gestor_new column
 *
 * @method GchangelogQuery groupByAuto() Group by the auto column
 * @method GchangelogQuery groupByIdCuenta() Group by the id_cuenta column
 * @method GchangelogQuery groupByFechahora() Group by the fechahora column
 * @method GchangelogQuery groupByGestorOld() Group by the gestor_old column
 * @method GchangelogQuery groupByGestorNew() Group by the gestor_new column
 *
 * @method GchangelogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GchangelogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GchangelogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Gchangelog findOne(PropelPDO $con = null) Return the first Gchangelog matching the query
 * @method Gchangelog findOneOrCreate(PropelPDO $con = null) Return the first Gchangelog matching the query, or a new Gchangelog object populated from the query conditions when no match is found
 *
 * @method Gchangelog findOneByIdCuenta(int $id_cuenta) Return the first Gchangelog filtered by the id_cuenta column
 * @method Gchangelog findOneByFechahora(string $fechahora) Return the first Gchangelog filtered by the fechahora column
 * @method Gchangelog findOneByGestorOld(string $gestor_old) Return the first Gchangelog filtered by the gestor_old column
 * @method Gchangelog findOneByGestorNew(string $gestor_new) Return the first Gchangelog filtered by the gestor_new column
 *
 * @method array findByAuto(int $auto) Return Gchangelog objects filtered by the auto column
 * @method array findByIdCuenta(int $id_cuenta) Return Gchangelog objects filtered by the id_cuenta column
 * @method array findByFechahora(string $fechahora) Return Gchangelog objects filtered by the fechahora column
 * @method array findByGestorOld(string $gestor_old) Return Gchangelog objects filtered by the gestor_old column
 * @method array findByGestorNew(string $gestor_new) Return Gchangelog objects filtered by the gestor_new column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseGchangelogQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGchangelogQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Gchangelog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GchangelogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GchangelogQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GchangelogQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GchangelogQuery) {
            return $criteria;
        }
        $query = new GchangelogQuery();
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
     * @return   Gchangelog|Gchangelog[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GchangelogPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GchangelogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Gchangelog A model object, or null if the key is not found
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
     * @return                 Gchangelog A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `id_cuenta`, `fechahora`, `gestor_old`, `gestor_new` FROM `gchangelog` WHERE `auto` = :p0';
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
            $obj = new Gchangelog();
            $obj->hydrate($row);
            GchangelogPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Gchangelog|Gchangelog[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Gchangelog[]|mixed the list of results, formatted by the current formatter
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
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GchangelogPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GchangelogPeer::AUTO, $keys, Criteria::IN);
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
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(GchangelogPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(GchangelogPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GchangelogPeer::AUTO, $auto, $comparison);
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
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(GchangelogPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(GchangelogPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GchangelogPeer::ID_CUENTA, $idCuenta, $comparison);
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
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByFechahora($fechahora = null, $comparison = null)
    {
        if (is_array($fechahora)) {
            $useMinMax = false;
            if (isset($fechahora['min'])) {
                $this->addUsingAlias(GchangelogPeer::FECHAHORA, $fechahora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechahora['max'])) {
                $this->addUsingAlias(GchangelogPeer::FECHAHORA, $fechahora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GchangelogPeer::FECHAHORA, $fechahora, $comparison);
    }

    /**
     * Filter the query on the gestor_old column
     *
     * Example usage:
     * <code>
     * $query->filterByGestorOld('fooValue');   // WHERE gestor_old = 'fooValue'
     * $query->filterByGestorOld('%fooValue%'); // WHERE gestor_old LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gestorOld The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByGestorOld($gestorOld = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gestorOld)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gestorOld)) {
                $gestorOld = str_replace('*', '%', $gestorOld);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GchangelogPeer::GESTOR_OLD, $gestorOld, $comparison);
    }

    /**
     * Filter the query on the gestor_new column
     *
     * Example usage:
     * <code>
     * $query->filterByGestorNew('fooValue');   // WHERE gestor_new = 'fooValue'
     * $query->filterByGestorNew('%fooValue%'); // WHERE gestor_new LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gestorNew The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function filterByGestorNew($gestorNew = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gestorNew)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gestorNew)) {
                $gestorNew = str_replace('*', '%', $gestorNew);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GchangelogPeer::GESTOR_NEW, $gestorNew, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Gchangelog $gchangelog Object to remove from the list of results
     *
     * @return GchangelogQuery The current query, for fluid interface
     */
    public function prune($gchangelog = null)
    {
        if ($gchangelog) {
            $this->addUsingAlias(GchangelogPeer::AUTO, $gchangelog->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
