<?php


/**
 * Base class that represents a query for the 'sdcs' table.
 *
 *
 *
 * @method SdcsQuery orderByStatusDeCredito($order = Criteria::ASC) Order by the status_de_credito column
 *
 * @method SdcsQuery groupByStatusDeCredito() Group by the status_de_credito column
 *
 * @method SdcsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SdcsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SdcsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Sdcs findOne(PropelPDO $con = null) Return the first Sdcs matching the query
 * @method Sdcs findOneOrCreate(PropelPDO $con = null) Return the first Sdcs matching the query, or a new Sdcs object populated from the query conditions when no match is found
 *
 *
 * @method array findByStatusDeCredito(string $status_de_credito) Return Sdcs objects filtered by the status_de_credito column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseSdcsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSdcsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Sdcs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SdcsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SdcsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SdcsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SdcsQuery) {
            return $criteria;
        }
        $query = new SdcsQuery();
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
     * @return   Sdcs|Sdcs[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SdcsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SdcsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Sdcs A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByStatusDeCredito($key, $con = null)
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
     * @return                 Sdcs A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `status_de_credito` FROM `sdcs` WHERE `status_de_credito` = :p0';
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
            $obj = new Sdcs();
            $obj->hydrate($row);
            SdcsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Sdcs|Sdcs[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Sdcs[]|mixed the list of results, formatted by the current formatter
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
     * @return SdcsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SdcsPeer::STATUS_DE_CREDITO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SdcsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SdcsPeer::STATUS_DE_CREDITO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the status_de_credito column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusDeCredito('fooValue');   // WHERE status_de_credito = 'fooValue'
     * $query->filterByStatusDeCredito('%fooValue%'); // WHERE status_de_credito LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusDeCredito The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SdcsQuery The current query, for fluid interface
     */
    public function filterByStatusDeCredito($statusDeCredito = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusDeCredito)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $statusDeCredito)) {
                $statusDeCredito = str_replace('*', '%', $statusDeCredito);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SdcsPeer::STATUS_DE_CREDITO, $statusDeCredito, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Sdcs $sdcs Object to remove from the list of results
     *
     * @return SdcsQuery The current query, for fluid interface
     */
    public function prune($sdcs = null)
    {
        if ($sdcs) {
            $this->addUsingAlias(SdcsPeer::STATUS_DE_CREDITO, $sdcs->getStatusDeCredito(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
