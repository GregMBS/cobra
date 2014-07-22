<?php


/**
 * Base class that represents a query for the 'pagos' table.
 *
 *
 *
 * @method PagosQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method PagosQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method PagosQuery orderByFecha($order = Criteria::ASC) Order by the fecha column
 * @method PagosQuery orderByMonto($order = Criteria::ASC) Order by the monto column
 * @method PagosQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method PagosQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method PagosQuery orderByConfirmado($order = Criteria::ASC) Order by the confirmado column
 * @method PagosQuery orderByCredito($order = Criteria::ASC) Order by the credito column
 * @method PagosQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 *
 * @method PagosQuery groupByAuto() Group by the auto column
 * @method PagosQuery groupByCuenta() Group by the cuenta column
 * @method PagosQuery groupByFecha() Group by the fecha column
 * @method PagosQuery groupByMonto() Group by the monto column
 * @method PagosQuery groupByCliente() Group by the cliente column
 * @method PagosQuery groupByGestor() Group by the gestor column
 * @method PagosQuery groupByConfirmado() Group by the confirmado column
 * @method PagosQuery groupByCredito() Group by the credito column
 * @method PagosQuery groupByIdCuenta() Group by the id_cuenta column
 *
 * @method PagosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PagosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PagosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Pagos findOne(PropelPDO $con = null) Return the first Pagos matching the query
 * @method Pagos findOneOrCreate(PropelPDO $con = null) Return the first Pagos matching the query, or a new Pagos object populated from the query conditions when no match is found
 *
 * @method Pagos findOneByCuenta(string $cuenta) Return the first Pagos filtered by the cuenta column
 * @method Pagos findOneByFecha(string $fecha) Return the first Pagos filtered by the fecha column
 * @method Pagos findOneByMonto(string $monto) Return the first Pagos filtered by the monto column
 * @method Pagos findOneByCliente(string $cliente) Return the first Pagos filtered by the cliente column
 * @method Pagos findOneByGestor(string $gestor) Return the first Pagos filtered by the gestor column
 * @method Pagos findOneByConfirmado(boolean $confirmado) Return the first Pagos filtered by the confirmado column
 * @method Pagos findOneByCredito(string $credito) Return the first Pagos filtered by the credito column
 * @method Pagos findOneByIdCuenta(int $id_cuenta) Return the first Pagos filtered by the id_cuenta column
 *
 * @method array findByAuto(int $auto) Return Pagos objects filtered by the auto column
 * @method array findByCuenta(string $cuenta) Return Pagos objects filtered by the cuenta column
 * @method array findByFecha(string $fecha) Return Pagos objects filtered by the fecha column
 * @method array findByMonto(string $monto) Return Pagos objects filtered by the monto column
 * @method array findByCliente(string $cliente) Return Pagos objects filtered by the cliente column
 * @method array findByGestor(string $gestor) Return Pagos objects filtered by the gestor column
 * @method array findByConfirmado(boolean $confirmado) Return Pagos objects filtered by the confirmado column
 * @method array findByCredito(string $credito) Return Pagos objects filtered by the credito column
 * @method array findByIdCuenta(int $id_cuenta) Return Pagos objects filtered by the id_cuenta column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BasePagosQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePagosQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Pagos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PagosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PagosQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PagosQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PagosQuery) {
            return $criteria;
        }
        $query = new PagosQuery();
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
     * @return   Pagos|Pagos[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PagosPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PagosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Pagos A model object, or null if the key is not found
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
     * @return                 Pagos A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `cuenta`, `fecha`, `monto`, `cliente`, `gestor`, `confirmado`, `credito`, `id_cuenta` FROM `pagos` WHERE `auto` = :p0';
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
            $obj = new Pagos();
            $obj->hydrate($row);
            PagosPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Pagos|Pagos[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Pagos[]|mixed the list of results, formatted by the current formatter
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
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PagosPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PagosPeer::AUTO, $keys, Criteria::IN);
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
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(PagosPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(PagosPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagosPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByCuenta('fooValue');   // WHERE cuenta = 'fooValue'
     * $query->filterByCuenta('%fooValue%'); // WHERE cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByCuenta($cuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuenta)) {
                $cuenta = str_replace('*', '%', $cuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagosPeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the fecha column
     *
     * Example usage:
     * <code>
     * $query->filterByFecha('2011-03-14'); // WHERE fecha = '2011-03-14'
     * $query->filterByFecha('now'); // WHERE fecha = '2011-03-14'
     * $query->filterByFecha(array('max' => 'yesterday')); // WHERE fecha > '2011-03-13'
     * </code>
     *
     * @param     mixed $fecha The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(PagosPeer::FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(PagosPeer::FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagosPeer::FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the monto column
     *
     * Example usage:
     * <code>
     * $query->filterByMonto(1234); // WHERE monto = 1234
     * $query->filterByMonto(array(12, 34)); // WHERE monto IN (12, 34)
     * $query->filterByMonto(array('min' => 12)); // WHERE monto >= 12
     * $query->filterByMonto(array('max' => 12)); // WHERE monto <= 12
     * </code>
     *
     * @param     mixed $monto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByMonto($monto = null, $comparison = null)
    {
        if (is_array($monto)) {
            $useMinMax = false;
            if (isset($monto['min'])) {
                $this->addUsingAlias(PagosPeer::MONTO, $monto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($monto['max'])) {
                $this->addUsingAlias(PagosPeer::MONTO, $monto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagosPeer::MONTO, $monto, $comparison);
    }

    /**
     * Filter the query on the cliente column
     *
     * Example usage:
     * <code>
     * $query->filterByCliente('fooValue');   // WHERE cliente = 'fooValue'
     * $query->filterByCliente('%fooValue%'); // WHERE cliente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByCliente($cliente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliente)) {
                $cliente = str_replace('*', '%', $cliente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagosPeer::CLIENTE, $cliente, $comparison);
    }

    /**
     * Filter the query on the gestor column
     *
     * Example usage:
     * <code>
     * $query->filterByGestor('fooValue');   // WHERE gestor = 'fooValue'
     * $query->filterByGestor('%fooValue%'); // WHERE gestor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gestor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByGestor($gestor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gestor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gestor)) {
                $gestor = str_replace('*', '%', $gestor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagosPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Filter the query on the confirmado column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmado(true); // WHERE confirmado = true
     * $query->filterByConfirmado('yes'); // WHERE confirmado = true
     * </code>
     *
     * @param     boolean|string $confirmado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByConfirmado($confirmado = null, $comparison = null)
    {
        if (is_string($confirmado)) {
            $confirmado = in_array(strtolower($confirmado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PagosPeer::CONFIRMADO, $confirmado, $comparison);
    }

    /**
     * Filter the query on the credito column
     *
     * Example usage:
     * <code>
     * $query->filterByCredito('fooValue');   // WHERE credito = 'fooValue'
     * $query->filterByCredito('%fooValue%'); // WHERE credito LIKE '%fooValue%'
     * </code>
     *
     * @param     string $credito The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByCredito($credito = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($credito)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $credito)) {
                $credito = str_replace('*', '%', $credito);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagosPeer::CREDITO, $credito, $comparison);
    }

    /**
     * Filter the query on the id_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCuenta(1234); // WHERE id_cuenta = 1234
     * $query->filterByIdCuenta(array(12, 34)); // WHERE id_cuenta IN (12, 34)
     * $query->filterByIdCuenta(array('min' => 12)); // WHERE id_cuenta >= 12
     * $query->filterByIdCuenta(array('max' => 12)); // WHERE id_cuenta <= 12
     * </code>
     *
     * @param     mixed $idCuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(PagosPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(PagosPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagosPeer::ID_CUENTA, $idCuenta, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Pagos $pagos Object to remove from the list of results
     *
     * @return PagosQuery The current query, for fluid interface
     */
    public function prune($pagos = null)
    {
        if ($pagos) {
            $this->addUsingAlias(PagosPeer::AUTO, $pagos->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
