<?php


/**
 * Base class that represents a query for the 'deadlines' table.
 *
 *
 *
 * @method DeadlinesQuery orderByCTele($order = Criteria::ASC) Order by the c_tele column
 *
 * @method DeadlinesQuery groupByCTele() Group by the c_tele column
 *
 * @method DeadlinesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DeadlinesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DeadlinesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Deadlines findOne(PropelPDO $con = null) Return the first Deadlines matching the query
 * @method Deadlines findOneOrCreate(PropelPDO $con = null) Return the first Deadlines matching the query, or a new Deadlines object populated from the query conditions when no match is found
 *
 *
 * @method array findByCTele(string $c_tele) Return Deadlines objects filtered by the c_tele column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseDeadlinesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDeadlinesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Deadlines', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DeadlinesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DeadlinesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DeadlinesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DeadlinesQuery) {
            return $criteria;
        }
        $query = new DeadlinesQuery();
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
     * @return   Deadlines|Deadlines[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DeadlinesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DeadlinesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Deadlines A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCTele($key, $con = null)
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
     * @return                 Deadlines A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `c_tele` FROM `deadlines` WHERE `c_tele` = :p0';
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
            $obj = new Deadlines();
            $obj->hydrate($row);
            DeadlinesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Deadlines|Deadlines[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Deadlines[]|mixed the list of results, formatted by the current formatter
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
     * @return DeadlinesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeadlinesPeer::C_TELE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DeadlinesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeadlinesPeer::C_TELE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the c_tele column
     *
     * Example usage:
     * <code>
     * $query->filterByCTele('fooValue');   // WHERE c_tele = 'fooValue'
     * $query->filterByCTele('%fooValue%'); // WHERE c_tele LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cTele The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeadlinesQuery The current query, for fluid interface
     */
    public function filterByCTele($cTele = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cTele)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cTele)) {
                $cTele = str_replace('*', '%', $cTele);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DeadlinesPeer::C_TELE, $cTele, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Deadlines $deadlines Object to remove from the list of results
     *
     * @return DeadlinesQuery The current query, for fluid interface
     */
    public function prune($deadlines = null)
    {
        if ($deadlines) {
            $this->addUsingAlias(DeadlinesPeer::C_TELE, $deadlines->getCTele(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
