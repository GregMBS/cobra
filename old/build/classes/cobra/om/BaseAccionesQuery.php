<?php


/**
 * Base class that represents a query for the 'acciones' table.
 *
 *
 *
 * @method AccionesQuery orderByAccion($order = Criteria::ASC) Order by the accion column
 * @method AccionesQuery orderByCallcenter($order = Criteria::ASC) Order by the callcenter column
 * @method AccionesQuery orderByVisitas($order = Criteria::ASC) Order by the visitas column
 * @method AccionesQuery orderByJudicial($order = Criteria::ASC) Order by the judicial column
 * @method AccionesQuery orderByPromo($order = Criteria::ASC) Order by the promo column
 *
 * @method AccionesQuery groupByAccion() Group by the accion column
 * @method AccionesQuery groupByCallcenter() Group by the callcenter column
 * @method AccionesQuery groupByVisitas() Group by the visitas column
 * @method AccionesQuery groupByJudicial() Group by the judicial column
 * @method AccionesQuery groupByPromo() Group by the promo column
 *
 * @method AccionesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AccionesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AccionesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Acciones findOne(PropelPDO $con = null) Return the first Acciones matching the query
 * @method Acciones findOneOrCreate(PropelPDO $con = null) Return the first Acciones matching the query, or a new Acciones object populated from the query conditions when no match is found
 *
 * @method Acciones findOneByCallcenter(boolean $callcenter) Return the first Acciones filtered by the callcenter column
 * @method Acciones findOneByVisitas(boolean $visitas) Return the first Acciones filtered by the visitas column
 * @method Acciones findOneByJudicial(boolean $judicial) Return the first Acciones filtered by the judicial column
 * @method Acciones findOneByPromo(boolean $promo) Return the first Acciones filtered by the promo column
 *
 * @method array findByAccion(string $accion) Return Acciones objects filtered by the accion column
 * @method array findByCallcenter(boolean $callcenter) Return Acciones objects filtered by the callcenter column
 * @method array findByVisitas(boolean $visitas) Return Acciones objects filtered by the visitas column
 * @method array findByJudicial(boolean $judicial) Return Acciones objects filtered by the judicial column
 * @method array findByPromo(boolean $promo) Return Acciones objects filtered by the promo column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseAccionesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAccionesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Acciones', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AccionesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   AccionesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AccionesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AccionesQuery) {
            return $criteria;
        }
        $query = new AccionesQuery();
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
     * @return   Acciones|Acciones[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AccionesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AccionesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Acciones A model object, or null if the key is not found
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
     * @return                 Acciones A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `accion`, `callcenter`, `visitas`, `judicial`, `promo` FROM `acciones` WHERE `accion` = :p0';
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
            $obj = new Acciones();
            $obj->hydrate($row);
            AccionesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Acciones|Acciones[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Acciones[]|mixed the list of results, formatted by the current formatter
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
     * @return AccionesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccionesPeer::ACCION, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AccionesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccionesPeer::ACCION, $keys, Criteria::IN);
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
     * @return AccionesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AccionesPeer::ACCION, $accion, $comparison);
    }

    /**
     * Filter the query on the callcenter column
     *
     * Example usage:
     * <code>
     * $query->filterByCallcenter(true); // WHERE callcenter = true
     * $query->filterByCallcenter('yes'); // WHERE callcenter = true
     * </code>
     *
     * @param     boolean|string $callcenter The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AccionesQuery The current query, for fluid interface
     */
    public function filterByCallcenter($callcenter = null, $comparison = null)
    {
        if (is_string($callcenter)) {
            $callcenter = in_array(strtolower($callcenter), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccionesPeer::CALLCENTER, $callcenter, $comparison);
    }

    /**
     * Filter the query on the visitas column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitas(true); // WHERE visitas = true
     * $query->filterByVisitas('yes'); // WHERE visitas = true
     * </code>
     *
     * @param     boolean|string $visitas The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AccionesQuery The current query, for fluid interface
     */
    public function filterByVisitas($visitas = null, $comparison = null)
    {
        if (is_string($visitas)) {
            $visitas = in_array(strtolower($visitas), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccionesPeer::VISITAS, $visitas, $comparison);
    }

    /**
     * Filter the query on the judicial column
     *
     * Example usage:
     * <code>
     * $query->filterByJudicial(true); // WHERE judicial = true
     * $query->filterByJudicial('yes'); // WHERE judicial = true
     * </code>
     *
     * @param     boolean|string $judicial The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AccionesQuery The current query, for fluid interface
     */
    public function filterByJudicial($judicial = null, $comparison = null)
    {
        if (is_string($judicial)) {
            $judicial = in_array(strtolower($judicial), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccionesPeer::JUDICIAL, $judicial, $comparison);
    }

    /**
     * Filter the query on the promo column
     *
     * Example usage:
     * <code>
     * $query->filterByPromo(true); // WHERE promo = true
     * $query->filterByPromo('yes'); // WHERE promo = true
     * </code>
     *
     * @param     boolean|string $promo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AccionesQuery The current query, for fluid interface
     */
    public function filterByPromo($promo = null, $comparison = null)
    {
        if (is_string($promo)) {
            $promo = in_array(strtolower($promo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccionesPeer::PROMO, $promo, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Acciones $acciones Object to remove from the list of results
     *
     * @return AccionesQuery The current query, for fluid interface
     */
    public function prune($acciones = null)
    {
        if ($acciones) {
            $this->addUsingAlias(AccionesPeer::ACCION, $acciones->getAccion(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
