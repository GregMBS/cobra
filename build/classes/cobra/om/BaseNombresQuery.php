<?php


/**
 * Base class that represents a query for the 'nombres' table.
 *
 *
 *
 * @method NombresQuery orderByUsuaria($order = Criteria::ASC) Order by the USUARIA column
 * @method NombresQuery orderByIniciales($order = Criteria::ASC) Order by the INICIALES column
 * @method NombresQuery orderByCompleto($order = Criteria::ASC) Order by the COMPLETO column
 * @method NombresQuery orderByTipo($order = Criteria::ASC) Order by the TIPO column
 * @method NombresQuery orderByTicket($order = Criteria::ASC) Order by the TICKET column
 * @method NombresQuery orderByCamp($order = Criteria::ASC) Order by the camp column
 * @method NombresQuery orderByTurno($order = Criteria::ASC) Order by the turno column
 * @method NombresQuery orderByAuthcode($order = Criteria::ASC) Order by the authcode column
 * @method NombresQuery orderByPassw($order = Criteria::ASC) Order by the passw column
 * @method NombresQuery orderByPolicy($order = Criteria::ASC) Order by the policy column
 *
 * @method NombresQuery groupByUsuaria() Group by the USUARIA column
 * @method NombresQuery groupByIniciales() Group by the INICIALES column
 * @method NombresQuery groupByCompleto() Group by the COMPLETO column
 * @method NombresQuery groupByTipo() Group by the TIPO column
 * @method NombresQuery groupByTicket() Group by the TICKET column
 * @method NombresQuery groupByCamp() Group by the camp column
 * @method NombresQuery groupByTurno() Group by the turno column
 * @method NombresQuery groupByAuthcode() Group by the authcode column
 * @method NombresQuery groupByPassw() Group by the passw column
 * @method NombresQuery groupByPolicy() Group by the policy column
 *
 * @method NombresQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NombresQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NombresQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Nombres findOne(PropelPDO $con = null) Return the first Nombres matching the query
 * @method Nombres findOneOrCreate(PropelPDO $con = null) Return the first Nombres matching the query, or a new Nombres object populated from the query conditions when no match is found
 *
 * @method Nombres findOneByIniciales(string $INICIALES) Return the first Nombres filtered by the INICIALES column
 * @method Nombres findOneByCompleto(string $COMPLETO) Return the first Nombres filtered by the COMPLETO column
 * @method Nombres findOneByTipo(string $TIPO) Return the first Nombres filtered by the TIPO column
 * @method Nombres findOneByTicket(string $TICKET) Return the first Nombres filtered by the TICKET column
 * @method Nombres findOneByCamp(int $camp) Return the first Nombres filtered by the camp column
 * @method Nombres findOneByTurno(string $turno) Return the first Nombres filtered by the turno column
 * @method Nombres findOneByAuthcode(string $authcode) Return the first Nombres filtered by the authcode column
 * @method Nombres findOneByPassw(string $passw) Return the first Nombres filtered by the passw column
 * @method Nombres findOneByPolicy(int $policy) Return the first Nombres filtered by the policy column
 *
 * @method array findByUsuaria(string $USUARIA) Return Nombres objects filtered by the USUARIA column
 * @method array findByIniciales(string $INICIALES) Return Nombres objects filtered by the INICIALES column
 * @method array findByCompleto(string $COMPLETO) Return Nombres objects filtered by the COMPLETO column
 * @method array findByTipo(string $TIPO) Return Nombres objects filtered by the TIPO column
 * @method array findByTicket(string $TICKET) Return Nombres objects filtered by the TICKET column
 * @method array findByCamp(int $camp) Return Nombres objects filtered by the camp column
 * @method array findByTurno(string $turno) Return Nombres objects filtered by the turno column
 * @method array findByAuthcode(string $authcode) Return Nombres objects filtered by the authcode column
 * @method array findByPassw(string $passw) Return Nombres objects filtered by the passw column
 * @method array findByPolicy(int $policy) Return Nombres objects filtered by the policy column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseNombresQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNombresQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Nombres', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NombresQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NombresQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NombresQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NombresQuery) {
            return $criteria;
        }
        $query = new NombresQuery();
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
     * @return   Nombres|Nombres[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NombresPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NombresPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Nombres A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByUsuaria($key, $con = null)
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
     * @return                 Nombres A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USUARIA`, `INICIALES`, `COMPLETO`, `TIPO`, `TICKET`, `camp`, `turno`, `authcode`, `passw`, `policy` FROM `nombres` WHERE `USUARIA` = :p0';
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
            $obj = new Nombres();
            $obj->hydrate($row);
            NombresPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Nombres|Nombres[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Nombres[]|mixed the list of results, formatted by the current formatter
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
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NombresPeer::USUARIA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NombresPeer::USUARIA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the USUARIA column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuaria('fooValue');   // WHERE USUARIA = 'fooValue'
     * $query->filterByUsuaria('%fooValue%'); // WHERE USUARIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuaria The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByUsuaria($usuaria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuaria)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuaria)) {
                $usuaria = str_replace('*', '%', $usuaria);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::USUARIA, $usuaria, $comparison);
    }

    /**
     * Filter the query on the INICIALES column
     *
     * Example usage:
     * <code>
     * $query->filterByIniciales('fooValue');   // WHERE INICIALES = 'fooValue'
     * $query->filterByIniciales('%fooValue%'); // WHERE INICIALES LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iniciales The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByIniciales($iniciales = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iniciales)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $iniciales)) {
                $iniciales = str_replace('*', '%', $iniciales);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::INICIALES, $iniciales, $comparison);
    }

    /**
     * Filter the query on the COMPLETO column
     *
     * Example usage:
     * <code>
     * $query->filterByCompleto('fooValue');   // WHERE COMPLETO = 'fooValue'
     * $query->filterByCompleto('%fooValue%'); // WHERE COMPLETO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $completo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByCompleto($completo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($completo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $completo)) {
                $completo = str_replace('*', '%', $completo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::COMPLETO, $completo, $comparison);
    }

    /**
     * Filter the query on the TIPO column
     *
     * Example usage:
     * <code>
     * $query->filterByTipo('fooValue');   // WHERE TIPO = 'fooValue'
     * $query->filterByTipo('%fooValue%'); // WHERE TIPO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByTipo($tipo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tipo)) {
                $tipo = str_replace('*', '%', $tipo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::TIPO, $tipo, $comparison);
    }

    /**
     * Filter the query on the TICKET column
     *
     * Example usage:
     * <code>
     * $query->filterByTicket('fooValue');   // WHERE TICKET = 'fooValue'
     * $query->filterByTicket('%fooValue%'); // WHERE TICKET LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ticket The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByTicket($ticket = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ticket)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ticket)) {
                $ticket = str_replace('*', '%', $ticket);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::TICKET, $ticket, $comparison);
    }

    /**
     * Filter the query on the camp column
     *
     * Example usage:
     * <code>
     * $query->filterByCamp(1234); // WHERE camp = 1234
     * $query->filterByCamp(array(12, 34)); // WHERE camp IN (12, 34)
     * $query->filterByCamp(array('min' => 12)); // WHERE camp >= 12
     * $query->filterByCamp(array('max' => 12)); // WHERE camp <= 12
     * </code>
     *
     * @param     mixed $camp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByCamp($camp = null, $comparison = null)
    {
        if (is_array($camp)) {
            $useMinMax = false;
            if (isset($camp['min'])) {
                $this->addUsingAlias(NombresPeer::CAMP, $camp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($camp['max'])) {
                $this->addUsingAlias(NombresPeer::CAMP, $camp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NombresPeer::CAMP, $camp, $comparison);
    }

    /**
     * Filter the query on the turno column
     *
     * Example usage:
     * <code>
     * $query->filterByTurno('fooValue');   // WHERE turno = 'fooValue'
     * $query->filterByTurno('%fooValue%'); // WHERE turno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $turno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByTurno($turno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($turno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $turno)) {
                $turno = str_replace('*', '%', $turno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::TURNO, $turno, $comparison);
    }

    /**
     * Filter the query on the authcode column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthcode('fooValue');   // WHERE authcode = 'fooValue'
     * $query->filterByAuthcode('%fooValue%'); // WHERE authcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $authcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByAuthcode($authcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($authcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $authcode)) {
                $authcode = str_replace('*', '%', $authcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::AUTHCODE, $authcode, $comparison);
    }

    /**
     * Filter the query on the passw column
     *
     * Example usage:
     * <code>
     * $query->filterByPassw('fooValue');   // WHERE passw = 'fooValue'
     * $query->filterByPassw('%fooValue%'); // WHERE passw LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passw The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByPassw($passw = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passw)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $passw)) {
                $passw = str_replace('*', '%', $passw);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NombresPeer::PASSW, $passw, $comparison);
    }

    /**
     * Filter the query on the policy column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicy(1234); // WHERE policy = 1234
     * $query->filterByPolicy(array(12, 34)); // WHERE policy IN (12, 34)
     * $query->filterByPolicy(array('min' => 12)); // WHERE policy >= 12
     * $query->filterByPolicy(array('max' => 12)); // WHERE policy <= 12
     * </code>
     *
     * @param     mixed $policy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function filterByPolicy($policy = null, $comparison = null)
    {
        if (is_array($policy)) {
            $useMinMax = false;
            if (isset($policy['min'])) {
                $this->addUsingAlias(NombresPeer::POLICY, $policy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($policy['max'])) {
                $this->addUsingAlias(NombresPeer::POLICY, $policy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NombresPeer::POLICY, $policy, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Nombres $nombres Object to remove from the list of results
     *
     * @return NombresQuery The current query, for fluid interface
     */
    public function prune($nombres = null)
    {
        if ($nombres) {
            $this->addUsingAlias(NombresPeer::USUARIA, $nombres->getUsuaria(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
