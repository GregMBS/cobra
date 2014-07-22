<?php


/**
 * Base class that represents a query for the 'grupos' table.
 *
 *
 *
 * @method GruposQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method GruposQuery orderByGrupo($order = Criteria::ASC) Order by the grupo column
 * @method GruposQuery orderByPw($order = Criteria::ASC) Order by the pw column
 * @method GruposQuery orderByEnlace($order = Criteria::ASC) Order by the enlace column
 *
 * @method GruposQuery groupByAuto() Group by the auto column
 * @method GruposQuery groupByGrupo() Group by the grupo column
 * @method GruposQuery groupByPw() Group by the pw column
 * @method GruposQuery groupByEnlace() Group by the enlace column
 *
 * @method GruposQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GruposQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GruposQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Grupos findOne(PropelPDO $con = null) Return the first Grupos matching the query
 * @method Grupos findOneOrCreate(PropelPDO $con = null) Return the first Grupos matching the query, or a new Grupos object populated from the query conditions when no match is found
 *
 * @method Grupos findOneByGrupo(string $grupo) Return the first Grupos filtered by the grupo column
 * @method Grupos findOneByPw(string $pw) Return the first Grupos filtered by the pw column
 * @method Grupos findOneByEnlace(string $enlace) Return the first Grupos filtered by the enlace column
 *
 * @method array findByAuto(int $auto) Return Grupos objects filtered by the auto column
 * @method array findByGrupo(string $grupo) Return Grupos objects filtered by the grupo column
 * @method array findByPw(string $pw) Return Grupos objects filtered by the pw column
 * @method array findByEnlace(string $enlace) Return Grupos objects filtered by the enlace column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseGruposQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGruposQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Grupos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GruposQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GruposQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GruposQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GruposQuery) {
            return $criteria;
        }
        $query = new GruposQuery();
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
     * @return   Grupos|Grupos[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GruposPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GruposPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Grupos A model object, or null if the key is not found
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
     * @return                 Grupos A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `grupo`, `pw`, `enlace` FROM `grupos` WHERE `auto` = :p0';
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
            $obj = new Grupos();
            $obj->hydrate($row);
            GruposPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Grupos|Grupos[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Grupos[]|mixed the list of results, formatted by the current formatter
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
     * @return GruposQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GruposPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GruposQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GruposPeer::AUTO, $keys, Criteria::IN);
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
     * @return GruposQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(GruposPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(GruposPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GruposPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the grupo column
     *
     * Example usage:
     * <code>
     * $query->filterByGrupo('fooValue');   // WHERE grupo = 'fooValue'
     * $query->filterByGrupo('%fooValue%'); // WHERE grupo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grupo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GruposQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grupo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $grupo)) {
                $grupo = str_replace('*', '%', $grupo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GruposPeer::GRUPO, $grupo, $comparison);
    }

    /**
     * Filter the query on the pw column
     *
     * Example usage:
     * <code>
     * $query->filterByPw('fooValue');   // WHERE pw = 'fooValue'
     * $query->filterByPw('%fooValue%'); // WHERE pw LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pw The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GruposQuery The current query, for fluid interface
     */
    public function filterByPw($pw = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pw)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pw)) {
                $pw = str_replace('*', '%', $pw);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GruposPeer::PW, $pw, $comparison);
    }

    /**
     * Filter the query on the enlace column
     *
     * Example usage:
     * <code>
     * $query->filterByEnlace('fooValue');   // WHERE enlace = 'fooValue'
     * $query->filterByEnlace('%fooValue%'); // WHERE enlace LIKE '%fooValue%'
     * </code>
     *
     * @param     string $enlace The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GruposQuery The current query, for fluid interface
     */
    public function filterByEnlace($enlace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($enlace)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $enlace)) {
                $enlace = str_replace('*', '%', $enlace);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GruposPeer::ENLACE, $enlace, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Grupos $grupos Object to remove from the list of results
     *
     * @return GruposQuery The current query, for fluid interface
     */
    public function prune($grupos = null)
    {
        if ($grupos) {
            $this->addUsingAlias(GruposPeer::AUTO, $grupos->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
