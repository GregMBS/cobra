<?php


/**
 * Base class that represents a query for the 'histels' table.
 *
 *
 *
 * @method HistelsQuery orderByHtel($order = Criteria::ASC) Order by the htel column
 *
 * @method HistelsQuery groupByHtel() Group by the htel column
 *
 * @method HistelsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method HistelsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method HistelsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Histels findOne(PropelPDO $con = null) Return the first Histels matching the query
 * @method Histels findOneOrCreate(PropelPDO $con = null) Return the first Histels matching the query, or a new Histels object populated from the query conditions when no match is found
 *
 *
 * @method array findByHtel(string $htel) Return Histels objects filtered by the htel column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseHistelsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseHistelsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Histels', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new HistelsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   HistelsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return HistelsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof HistelsQuery) {
            return $criteria;
        }
        $query = new HistelsQuery();
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
     * @return   Histels|Histels[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = HistelsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(HistelsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Histels A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByHtel($key, $con = null)
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
     * @return                 Histels A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `htel` FROM `histels` WHERE `htel` = :p0';
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
            $obj = new Histels();
            $obj->hydrate($row);
            HistelsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Histels|Histels[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Histels[]|mixed the list of results, formatted by the current formatter
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
     * @return HistelsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HistelsPeer::HTEL, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return HistelsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HistelsPeer::HTEL, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the htel column
     *
     * Example usage:
     * <code>
     * $query->filterByHtel('fooValue');   // WHERE htel = 'fooValue'
     * $query->filterByHtel('%fooValue%'); // WHERE htel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $htel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistelsQuery The current query, for fluid interface
     */
    public function filterByHtel($htel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($htel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $htel)) {
                $htel = str_replace('*', '%', $htel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistelsPeer::HTEL, $htel, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Histels $histels Object to remove from the list of results
     *
     * @return HistelsQuery The current query, for fluid interface
     */
    public function prune($histels = null)
    {
        if ($histels) {
            $this->addUsingAlias(HistelsPeer::HTEL, $histels->getHtel(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
