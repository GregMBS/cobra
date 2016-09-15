<?php


/**
 * Base class that represents a query for the 'locales' table.
 *
 *
 *
 * @method LocalesQuery orderByCiudad($order = Criteria::ASC) Order by the ciudad column
 *
 * @method LocalesQuery groupByCiudad() Group by the ciudad column
 *
 * @method LocalesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LocalesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LocalesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Locales findOne(PropelPDO $con = null) Return the first Locales matching the query
 * @method Locales findOneOrCreate(PropelPDO $con = null) Return the first Locales matching the query, or a new Locales object populated from the query conditions when no match is found
 *
 *
 * @method array findByCiudad(string $ciudad) Return Locales objects filtered by the ciudad column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseLocalesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLocalesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Locales', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LocalesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LocalesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LocalesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LocalesQuery) {
            return $criteria;
        }
        $query = new LocalesQuery();
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
     * @return   Locales|Locales[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LocalesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LocalesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Locales A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCiudad($key, $con = null)
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
     * @return                 Locales A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ciudad` FROM `locales` WHERE `ciudad` = :p0';
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
            $obj = new Locales();
            $obj->hydrate($row);
            LocalesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Locales|Locales[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Locales[]|mixed the list of results, formatted by the current formatter
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
     * @return LocalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LocalesPeer::CIUDAD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LocalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LocalesPeer::CIUDAD, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ciudad column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudad('fooValue');   // WHERE ciudad = 'fooValue'
     * $query->filterByCiudad('%fooValue%'); // WHERE ciudad LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudad The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LocalesQuery The current query, for fluid interface
     */
    public function filterByCiudad($ciudad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudad)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudad)) {
                $ciudad = str_replace('*', '%', $ciudad);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LocalesPeer::CIUDAD, $ciudad, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Locales $locales Object to remove from the list of results
     *
     * @return LocalesQuery The current query, for fluid interface
     */
    public function prune($locales = null)
    {
        if ($locales) {
            $this->addUsingAlias(LocalesPeer::CIUDAD, $locales->getCiudad(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}