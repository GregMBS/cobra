<?php


/**
 * Base class that represents a query for the 'csilugar' table.
 *
 *
 *
 * @method CsilugarQuery orderByAccion($order = Criteria::ASC) Order by the accion column
 * @method CsilugarQuery orderByLugar($order = Criteria::ASC) Order by the lugar column
 * @method CsilugarQuery orderByCodigo($order = Criteria::ASC) Order by the codigo column
 *
 * @method CsilugarQuery groupByAccion() Group by the accion column
 * @method CsilugarQuery groupByLugar() Group by the lugar column
 * @method CsilugarQuery groupByCodigo() Group by the codigo column
 *
 * @method CsilugarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CsilugarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CsilugarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Csilugar findOne(PropelPDO $con = null) Return the first Csilugar matching the query
 * @method Csilugar findOneOrCreate(PropelPDO $con = null) Return the first Csilugar matching the query, or a new Csilugar object populated from the query conditions when no match is found
 *
 * @method Csilugar findOneByLugar(string $lugar) Return the first Csilugar filtered by the lugar column
 * @method Csilugar findOneByCodigo(string $codigo) Return the first Csilugar filtered by the codigo column
 *
 * @method array findByAccion(string $accion) Return Csilugar objects filtered by the accion column
 * @method array findByLugar(string $lugar) Return Csilugar objects filtered by the lugar column
 * @method array findByCodigo(string $codigo) Return Csilugar objects filtered by the codigo column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCsilugarQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCsilugarQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Csilugar', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CsilugarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CsilugarQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CsilugarQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CsilugarQuery) {
            return $criteria;
        }
        $query = new CsilugarQuery();
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
     * @return   Csilugar|Csilugar[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CsilugarPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CsilugarPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Csilugar A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByAccion($key, $con = null)
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
     * @return                 Csilugar A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `accion`, `lugar`, `codigo` FROM `csilugar` WHERE `accion` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Csilugar();
            $obj->hydrate($row);
            CsilugarPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Csilugar|Csilugar[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Csilugar[]|mixed the list of results, formatted by the current formatter
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
     * @return CsilugarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CsilugarPeer::ACCION, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CsilugarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CsilugarPeer::ACCION, $keys, Criteria::IN);
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
     * @return CsilugarQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CsilugarPeer::ACCION, $accion, $comparison);
    }

    /**
     * Filter the query on the lugar column
     *
     * Example usage:
     * <code>
     * $query->filterByLugar('fooValue');   // WHERE lugar = 'fooValue'
     * $query->filterByLugar('%fooValue%'); // WHERE lugar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lugar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsilugarQuery The current query, for fluid interface
     */
    public function filterByLugar($lugar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lugar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lugar)) {
                $lugar = str_replace('*', '%', $lugar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CsilugarPeer::LUGAR, $lugar, $comparison);
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
     * @return CsilugarQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CsilugarPeer::CODIGO, $codigo, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Csilugar $csilugar Object to remove from the list of results
     *
     * @return CsilugarQuery The current query, for fluid interface
     */
    public function prune($csilugar = null)
    {
        if ($csilugar) {
            $this->addUsingAlias(CsilugarPeer::ACCION, $csilugar->getAccion(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
