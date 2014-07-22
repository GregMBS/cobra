<?php


/**
 * Base class that represents a query for the 'histgest' table.
 *
 *
 *
 * @method HistgestQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method HistgestQuery orderByCCvge($order = Criteria::ASC) Order by the c_cvge column
 *
 * @method HistgestQuery groupByAuto() Group by the auto column
 * @method HistgestQuery groupByCCvge() Group by the c_cvge column
 *
 * @method HistgestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method HistgestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method HistgestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Histgest findOne(PropelPDO $con = null) Return the first Histgest matching the query
 * @method Histgest findOneOrCreate(PropelPDO $con = null) Return the first Histgest matching the query, or a new Histgest object populated from the query conditions when no match is found
 *
 * @method Histgest findOneByCCvge(string $c_cvge) Return the first Histgest filtered by the c_cvge column
 *
 * @method array findByAuto(int $auto) Return Histgest objects filtered by the auto column
 * @method array findByCCvge(string $c_cvge) Return Histgest objects filtered by the c_cvge column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseHistgestQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseHistgestQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Histgest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new HistgestQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   HistgestQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return HistgestQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof HistgestQuery) {
            return $criteria;
        }
        $query = new HistgestQuery();
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
     * @return   Histgest|Histgest[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = HistgestPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(HistgestPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Histgest A model object, or null if the key is not found
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
     * @return                 Histgest A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `c_cvge` FROM `histgest` WHERE `auto` = :p0';
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
            $obj = new Histgest();
            $obj->hydrate($row);
            HistgestPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Histgest|Histgest[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Histgest[]|mixed the list of results, formatted by the current formatter
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
     * @return HistgestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HistgestPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return HistgestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HistgestPeer::AUTO, $keys, Criteria::IN);
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
     * @return HistgestQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(HistgestPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(HistgestPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistgestPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the c_cvge column
     *
     * Example usage:
     * <code>
     * $query->filterByCCvge('fooValue');   // WHERE c_cvge = 'fooValue'
     * $query->filterByCCvge('%fooValue%'); // WHERE c_cvge LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCvge The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistgestQuery The current query, for fluid interface
     */
    public function filterByCCvge($cCvge = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCvge)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCvge)) {
                $cCvge = str_replace('*', '%', $cCvge);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistgestPeer::C_CVGE, $cCvge, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Histgest $histgest Object to remove from the list of results
     *
     * @return HistgestQuery The current query, for fluid interface
     */
    public function prune($histgest = null)
    {
        if ($histgest) {
            $this->addUsingAlias(HistgestPeer::AUTO, $histgest->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
