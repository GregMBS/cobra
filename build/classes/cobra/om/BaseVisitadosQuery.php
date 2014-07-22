<?php


/**
 * Base class that represents a query for the 'visitados' table.
 *
 *
 *
 * @method VisitadosQuery orderByCta($order = Criteria::ASC) Order by the cta column
 *
 * @method VisitadosQuery groupByCta() Group by the cta column
 *
 * @method VisitadosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VisitadosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VisitadosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Visitados findOne(PropelPDO $con = null) Return the first Visitados matching the query
 * @method Visitados findOneOrCreate(PropelPDO $con = null) Return the first Visitados matching the query, or a new Visitados object populated from the query conditions when no match is found
 *
 *
 * @method array findByCta(int $cta) Return Visitados objects filtered by the cta column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseVisitadosQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVisitadosQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Visitados', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VisitadosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VisitadosQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VisitadosQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VisitadosQuery) {
            return $criteria;
        }
        $query = new VisitadosQuery();
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
     * @return   Visitados|Visitados[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VisitadosPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VisitadosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Visitados A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCta($key, $con = null)
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
     * @return                 Visitados A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `cta` FROM `visitados` WHERE `cta` = :p0';
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
            $obj = new Visitados();
            $obj->hydrate($row);
            VisitadosPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Visitados|Visitados[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Visitados[]|mixed the list of results, formatted by the current formatter
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
     * @return VisitadosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VisitadosPeer::CTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VisitadosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VisitadosPeer::CTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cta column
     *
     * Example usage:
     * <code>
     * $query->filterByCta(1234); // WHERE cta = 1234
     * $query->filterByCta(array(12, 34)); // WHERE cta IN (12, 34)
     * $query->filterByCta(array('min' => 12)); // WHERE cta >= 12
     * $query->filterByCta(array('max' => 12)); // WHERE cta <= 12
     * </code>
     *
     * @param     mixed $cta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VisitadosQuery The current query, for fluid interface
     */
    public function filterByCta($cta = null, $comparison = null)
    {
        if (is_array($cta)) {
            $useMinMax = false;
            if (isset($cta['min'])) {
                $this->addUsingAlias(VisitadosPeer::CTA, $cta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cta['max'])) {
                $this->addUsingAlias(VisitadosPeer::CTA, $cta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitadosPeer::CTA, $cta, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Visitados $visitados Object to remove from the list of results
     *
     * @return VisitadosQuery The current query, for fluid interface
     */
    public function prune($visitados = null)
    {
        if ($visitados) {
            $this->addUsingAlias(VisitadosPeer::CTA, $visitados->getCta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
