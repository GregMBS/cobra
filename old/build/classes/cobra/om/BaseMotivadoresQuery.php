<?php


/**
 * Base class that represents a query for the 'motivadores' table.
 *
 *
 *
 * @method MotivadoresQuery orderByMotiv($order = Criteria::ASC) Order by the motiv column
 * @method MotivadoresQuery orderByCallcenter($order = Criteria::ASC) Order by the callcenter column
 * @method MotivadoresQuery orderByVisitas($order = Criteria::ASC) Order by the visitas column
 * @method MotivadoresQuery orderByJudicial($order = Criteria::ASC) Order by the judicial column
 *
 * @method MotivadoresQuery groupByMotiv() Group by the motiv column
 * @method MotivadoresQuery groupByCallcenter() Group by the callcenter column
 * @method MotivadoresQuery groupByVisitas() Group by the visitas column
 * @method MotivadoresQuery groupByJudicial() Group by the judicial column
 *
 * @method MotivadoresQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MotivadoresQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MotivadoresQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Motivadores findOne(PropelPDO $con = null) Return the first Motivadores matching the query
 * @method Motivadores findOneOrCreate(PropelPDO $con = null) Return the first Motivadores matching the query, or a new Motivadores object populated from the query conditions when no match is found
 *
 * @method Motivadores findOneByCallcenter(boolean $callcenter) Return the first Motivadores filtered by the callcenter column
 * @method Motivadores findOneByVisitas(boolean $visitas) Return the first Motivadores filtered by the visitas column
 * @method Motivadores findOneByJudicial(boolean $judicial) Return the first Motivadores filtered by the judicial column
 *
 * @method array findByMotiv(string $motiv) Return Motivadores objects filtered by the motiv column
 * @method array findByCallcenter(boolean $callcenter) Return Motivadores objects filtered by the callcenter column
 * @method array findByVisitas(boolean $visitas) Return Motivadores objects filtered by the visitas column
 * @method array findByJudicial(boolean $judicial) Return Motivadores objects filtered by the judicial column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseMotivadoresQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMotivadoresQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Motivadores', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MotivadoresQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   MotivadoresQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MotivadoresQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MotivadoresQuery) {
            return $criteria;
        }
        $query = new MotivadoresQuery();
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
     * @return   Motivadores|Motivadores[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MotivadoresPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MotivadoresPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Motivadores A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByMotiv($key, $con = null)
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
     * @return                 Motivadores A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `motiv`, `callcenter`, `visitas`, `judicial` FROM `motivadores` WHERE `motiv` = :p0';
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
            $obj = new Motivadores();
            $obj->hydrate($row);
            MotivadoresPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Motivadores|Motivadores[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Motivadores[]|mixed the list of results, formatted by the current formatter
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
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MotivadoresPeer::MOTIV, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MotivadoresPeer::MOTIV, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the motiv column
     *
     * Example usage:
     * <code>
     * $query->filterByMotiv('fooValue');   // WHERE motiv = 'fooValue'
     * $query->filterByMotiv('%fooValue%'); // WHERE motiv LIKE '%fooValue%'
     * </code>
     *
     * @param     string $motiv The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function filterByMotiv($motiv = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($motiv)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $motiv)) {
                $motiv = str_replace('*', '%', $motiv);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MotivadoresPeer::MOTIV, $motiv, $comparison);
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
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function filterByCallcenter($callcenter = null, $comparison = null)
    {
        if (is_string($callcenter)) {
            $callcenter = in_array(strtolower($callcenter), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MotivadoresPeer::CALLCENTER, $callcenter, $comparison);
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
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function filterByVisitas($visitas = null, $comparison = null)
    {
        if (is_string($visitas)) {
            $visitas = in_array(strtolower($visitas), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MotivadoresPeer::VISITAS, $visitas, $comparison);
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
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function filterByJudicial($judicial = null, $comparison = null)
    {
        if (is_string($judicial)) {
            $judicial = in_array(strtolower($judicial), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MotivadoresPeer::JUDICIAL, $judicial, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Motivadores $motivadores Object to remove from the list of results
     *
     * @return MotivadoresQuery The current query, for fluid interface
     */
    public function prune($motivadores = null)
    {
        if ($motivadores) {
            $this->addUsingAlias(MotivadoresPeer::MOTIV, $motivadores->getMotiv(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
