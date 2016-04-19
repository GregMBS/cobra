<?php


/**
 * Base class that represents a query for the 'csidict' table.
 *
 *
 *
 * @method CsidictQuery orderByDictamen($order = Criteria::ASC) Order by the dictamen column
 * @method CsidictQuery orderByCsiCr($order = Criteria::ASC) Order by the csi_cr column
 * @method CsidictQuery orderByCsiRes($order = Criteria::ASC) Order by the csi_res column
 * @method CsidictQuery orderByCsiTipo($order = Criteria::ASC) Order by the csi_tipo column
 *
 * @method CsidictQuery groupByDictamen() Group by the dictamen column
 * @method CsidictQuery groupByCsiCr() Group by the csi_cr column
 * @method CsidictQuery groupByCsiRes() Group by the csi_res column
 * @method CsidictQuery groupByCsiTipo() Group by the csi_tipo column
 *
 * @method CsidictQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CsidictQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CsidictQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Csidict findOne(PropelPDO $con = null) Return the first Csidict matching the query
 * @method Csidict findOneOrCreate(PropelPDO $con = null) Return the first Csidict matching the query, or a new Csidict object populated from the query conditions when no match is found
 *
 * @method Csidict findOneByCsiCr(string $csi_cr) Return the first Csidict filtered by the csi_cr column
 * @method Csidict findOneByCsiRes(string $csi_res) Return the first Csidict filtered by the csi_res column
 * @method Csidict findOneByCsiTipo(string $csi_tipo) Return the first Csidict filtered by the csi_tipo column
 *
 * @method array findByDictamen(string $dictamen) Return Csidict objects filtered by the dictamen column
 * @method array findByCsiCr(string $csi_cr) Return Csidict objects filtered by the csi_cr column
 * @method array findByCsiRes(string $csi_res) Return Csidict objects filtered by the csi_res column
 * @method array findByCsiTipo(string $csi_tipo) Return Csidict objects filtered by the csi_tipo column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseCsidictQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCsidictQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Csidict', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CsidictQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CsidictQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CsidictQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CsidictQuery) {
            return $criteria;
        }
        $query = new CsidictQuery();
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
     * @return   Csidict|Csidict[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CsidictPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CsidictPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Csidict A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByDictamen($key, $con = null)
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
     * @return                 Csidict A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `dictamen`, `csi_cr`, `csi_res`, `csi_tipo` FROM `csidict` WHERE `dictamen` = :p0';
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
            $obj = new Csidict();
            $obj->hydrate($row);
            CsidictPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Csidict|Csidict[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Csidict[]|mixed the list of results, formatted by the current formatter
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
     * @return CsidictQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CsidictPeer::DICTAMEN, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CsidictQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CsidictPeer::DICTAMEN, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the dictamen column
     *
     * Example usage:
     * <code>
     * $query->filterByDictamen('fooValue');   // WHERE dictamen = 'fooValue'
     * $query->filterByDictamen('%fooValue%'); // WHERE dictamen LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dictamen The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsidictQuery The current query, for fluid interface
     */
    public function filterByDictamen($dictamen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dictamen)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dictamen)) {
                $dictamen = str_replace('*', '%', $dictamen);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CsidictPeer::DICTAMEN, $dictamen, $comparison);
    }

    /**
     * Filter the query on the csi_cr column
     *
     * Example usage:
     * <code>
     * $query->filterByCsiCr('fooValue');   // WHERE csi_cr = 'fooValue'
     * $query->filterByCsiCr('%fooValue%'); // WHERE csi_cr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $csiCr The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsidictQuery The current query, for fluid interface
     */
    public function filterByCsiCr($csiCr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($csiCr)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $csiCr)) {
                $csiCr = str_replace('*', '%', $csiCr);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CsidictPeer::CSI_CR, $csiCr, $comparison);
    }

    /**
     * Filter the query on the csi_res column
     *
     * Example usage:
     * <code>
     * $query->filterByCsiRes('fooValue');   // WHERE csi_res = 'fooValue'
     * $query->filterByCsiRes('%fooValue%'); // WHERE csi_res LIKE '%fooValue%'
     * </code>
     *
     * @param     string $csiRes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsidictQuery The current query, for fluid interface
     */
    public function filterByCsiRes($csiRes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($csiRes)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $csiRes)) {
                $csiRes = str_replace('*', '%', $csiRes);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CsidictPeer::CSI_RES, $csiRes, $comparison);
    }

    /**
     * Filter the query on the csi_tipo column
     *
     * Example usage:
     * <code>
     * $query->filterByCsiTipo('fooValue');   // WHERE csi_tipo = 'fooValue'
     * $query->filterByCsiTipo('%fooValue%'); // WHERE csi_tipo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $csiTipo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CsidictQuery The current query, for fluid interface
     */
    public function filterByCsiTipo($csiTipo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($csiTipo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $csiTipo)) {
                $csiTipo = str_replace('*', '%', $csiTipo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CsidictPeer::CSI_TIPO, $csiTipo, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Csidict $csidict Object to remove from the list of results
     *
     * @return CsidictQuery The current query, for fluid interface
     */
    public function prune($csidict = null)
    {
        if ($csidict) {
            $this->addUsingAlias(CsidictPeer::DICTAMEN, $csidict->getDictamen(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
