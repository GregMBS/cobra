<?php


/**
 * Base class that represents a query for the 'folios' table.
 *
 *
 *
 * @method FoliosQuery orderByFolio($order = Criteria::ASC) Order by the folio column
 * @method FoliosQuery orderByUsado($order = Criteria::ASC) Order by the usado column
 * @method FoliosQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method FoliosQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method FoliosQuery orderByEnviado($order = Criteria::ASC) Order by the enviado column
 * @method FoliosQuery orderByFecha($order = Criteria::ASC) Order by the fecha column
 * @method FoliosQuery orderByMora($order = Criteria::ASC) Order by the mora column
 * @method FoliosQuery orderByCapital($order = Criteria::ASC) Order by the capital column
 * @method FoliosQuery orderBySaldoCan($order = Criteria::ASC) Order by the saldo_can column
 * @method FoliosQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method FoliosQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method FoliosQuery orderByMercancia($order = Criteria::ASC) Order by the mercancia column
 * @method FoliosQuery orderById($order = Criteria::ASC) Order by the id column
 *
 * @method FoliosQuery groupByFolio() Group by the folio column
 * @method FoliosQuery groupByUsado() Group by the usado column
 * @method FoliosQuery groupByCuenta() Group by the cuenta column
 * @method FoliosQuery groupByGestor() Group by the gestor column
 * @method FoliosQuery groupByEnviado() Group by the enviado column
 * @method FoliosQuery groupByFecha() Group by the fecha column
 * @method FoliosQuery groupByMora() Group by the mora column
 * @method FoliosQuery groupByCapital() Group by the capital column
 * @method FoliosQuery groupBySaldoCan() Group by the saldo_can column
 * @method FoliosQuery groupByCliente() Group by the cliente column
 * @method FoliosQuery groupByAuto() Group by the auto column
 * @method FoliosQuery groupByMercancia() Group by the mercancia column
 * @method FoliosQuery groupById() Group by the id column
 *
 * @method FoliosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FoliosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FoliosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Folios findOne(PropelPDO $con = null) Return the first Folios matching the query
 * @method Folios findOneOrCreate(PropelPDO $con = null) Return the first Folios matching the query, or a new Folios object populated from the query conditions when no match is found
 *
 * @method Folios findOneByFolio(int $folio) Return the first Folios filtered by the folio column
 * @method Folios findOneByUsado(boolean $usado) Return the first Folios filtered by the usado column
 * @method Folios findOneByCuenta(string $cuenta) Return the first Folios filtered by the cuenta column
 * @method Folios findOneByGestor(string $gestor) Return the first Folios filtered by the gestor column
 * @method Folios findOneByEnviado(boolean $enviado) Return the first Folios filtered by the enviado column
 * @method Folios findOneByFecha(string $fecha) Return the first Folios filtered by the fecha column
 * @method Folios findOneByMora(int $mora) Return the first Folios filtered by the mora column
 * @method Folios findOneByCapital(string $capital) Return the first Folios filtered by the capital column
 * @method Folios findOneBySaldoCan(string $saldo_can) Return the first Folios filtered by the saldo_can column
 * @method Folios findOneByCliente(string $cliente) Return the first Folios filtered by the cliente column
 * @method Folios findOneByMercancia(int $mercancia) Return the first Folios filtered by the mercancia column
 * @method Folios findOneById(int $id) Return the first Folios filtered by the id column
 *
 * @method array findByFolio(int $folio) Return Folios objects filtered by the folio column
 * @method array findByUsado(boolean $usado) Return Folios objects filtered by the usado column
 * @method array findByCuenta(string $cuenta) Return Folios objects filtered by the cuenta column
 * @method array findByGestor(string $gestor) Return Folios objects filtered by the gestor column
 * @method array findByEnviado(boolean $enviado) Return Folios objects filtered by the enviado column
 * @method array findByFecha(string $fecha) Return Folios objects filtered by the fecha column
 * @method array findByMora(int $mora) Return Folios objects filtered by the mora column
 * @method array findByCapital(string $capital) Return Folios objects filtered by the capital column
 * @method array findBySaldoCan(string $saldo_can) Return Folios objects filtered by the saldo_can column
 * @method array findByCliente(string $cliente) Return Folios objects filtered by the cliente column
 * @method array findByAuto(int $auto) Return Folios objects filtered by the auto column
 * @method array findByMercancia(int $mercancia) Return Folios objects filtered by the mercancia column
 * @method array findById(int $id) Return Folios objects filtered by the id column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseFoliosQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFoliosQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Folios', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FoliosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   FoliosQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FoliosQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FoliosQuery) {
            return $criteria;
        }
        $query = new FoliosQuery();
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
     * @return   Folios|Folios[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FoliosPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FoliosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Folios A model object, or null if the key is not found
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
     * @return                 Folios A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `folio`, `usado`, `cuenta`, `gestor`, `enviado`, `fecha`, `mora`, `capital`, `saldo_can`, `cliente`, `auto`, `mercancia`, `id` FROM `folios` WHERE `auto` = :p0';
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
            $obj = new Folios();
            $obj->hydrate($row);
            FoliosPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Folios|Folios[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Folios[]|mixed the list of results, formatted by the current formatter
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
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FoliosPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FoliosPeer::AUTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the folio column
     *
     * Example usage:
     * <code>
     * $query->filterByFolio(1234); // WHERE folio = 1234
     * $query->filterByFolio(array(12, 34)); // WHERE folio IN (12, 34)
     * $query->filterByFolio(array('min' => 12)); // WHERE folio >= 12
     * $query->filterByFolio(array('max' => 12)); // WHERE folio <= 12
     * </code>
     *
     * @param     mixed $folio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByFolio($folio = null, $comparison = null)
    {
        if (is_array($folio)) {
            $useMinMax = false;
            if (isset($folio['min'])) {
                $this->addUsingAlias(FoliosPeer::FOLIO, $folio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folio['max'])) {
                $this->addUsingAlias(FoliosPeer::FOLIO, $folio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::FOLIO, $folio, $comparison);
    }

    /**
     * Filter the query on the usado column
     *
     * Example usage:
     * <code>
     * $query->filterByUsado(true); // WHERE usado = true
     * $query->filterByUsado('yes'); // WHERE usado = true
     * </code>
     *
     * @param     boolean|string $usado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByUsado($usado = null, $comparison = null)
    {
        if (is_string($usado)) {
            $usado = in_array(strtolower($usado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FoliosPeer::USADO, $usado, $comparison);
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
     * @return FoliosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FoliosPeer::CUENTA, $cuenta, $comparison);
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
     * @return FoliosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FoliosPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Filter the query on the enviado column
     *
     * Example usage:
     * <code>
     * $query->filterByEnviado(true); // WHERE enviado = true
     * $query->filterByEnviado('yes'); // WHERE enviado = true
     * </code>
     *
     * @param     boolean|string $enviado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByEnviado($enviado = null, $comparison = null)
    {
        if (is_string($enviado)) {
            $enviado = in_array(strtolower($enviado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FoliosPeer::ENVIADO, $enviado, $comparison);
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
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(FoliosPeer::FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(FoliosPeer::FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the mora column
     *
     * Example usage:
     * <code>
     * $query->filterByMora(1234); // WHERE mora = 1234
     * $query->filterByMora(array(12, 34)); // WHERE mora IN (12, 34)
     * $query->filterByMora(array('min' => 12)); // WHERE mora >= 12
     * $query->filterByMora(array('max' => 12)); // WHERE mora <= 12
     * </code>
     *
     * @param     mixed $mora The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByMora($mora = null, $comparison = null)
    {
        if (is_array($mora)) {
            $useMinMax = false;
            if (isset($mora['min'])) {
                $this->addUsingAlias(FoliosPeer::MORA, $mora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mora['max'])) {
                $this->addUsingAlias(FoliosPeer::MORA, $mora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::MORA, $mora, $comparison);
    }

    /**
     * Filter the query on the capital column
     *
     * Example usage:
     * <code>
     * $query->filterByCapital(1234); // WHERE capital = 1234
     * $query->filterByCapital(array(12, 34)); // WHERE capital IN (12, 34)
     * $query->filterByCapital(array('min' => 12)); // WHERE capital >= 12
     * $query->filterByCapital(array('max' => 12)); // WHERE capital <= 12
     * </code>
     *
     * @param     mixed $capital The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByCapital($capital = null, $comparison = null)
    {
        if (is_array($capital)) {
            $useMinMax = false;
            if (isset($capital['min'])) {
                $this->addUsingAlias(FoliosPeer::CAPITAL, $capital['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capital['max'])) {
                $this->addUsingAlias(FoliosPeer::CAPITAL, $capital['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::CAPITAL, $capital, $comparison);
    }

    /**
     * Filter the query on the saldo_can column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoCan(1234); // WHERE saldo_can = 1234
     * $query->filterBySaldoCan(array(12, 34)); // WHERE saldo_can IN (12, 34)
     * $query->filterBySaldoCan(array('min' => 12)); // WHERE saldo_can >= 12
     * $query->filterBySaldoCan(array('max' => 12)); // WHERE saldo_can <= 12
     * </code>
     *
     * @param     mixed $saldoCan The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterBySaldoCan($saldoCan = null, $comparison = null)
    {
        if (is_array($saldoCan)) {
            $useMinMax = false;
            if (isset($saldoCan['min'])) {
                $this->addUsingAlias(FoliosPeer::SALDO_CAN, $saldoCan['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoCan['max'])) {
                $this->addUsingAlias(FoliosPeer::SALDO_CAN, $saldoCan['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::SALDO_CAN, $saldoCan, $comparison);
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
     * @return FoliosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FoliosPeer::CLIENTE, $cliente, $comparison);
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
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(FoliosPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(FoliosPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the mercancia column
     *
     * Example usage:
     * <code>
     * $query->filterByMercancia(1234); // WHERE mercancia = 1234
     * $query->filterByMercancia(array(12, 34)); // WHERE mercancia IN (12, 34)
     * $query->filterByMercancia(array('min' => 12)); // WHERE mercancia >= 12
     * $query->filterByMercancia(array('max' => 12)); // WHERE mercancia <= 12
     * </code>
     *
     * @param     mixed $mercancia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterByMercancia($mercancia = null, $comparison = null)
    {
        if (is_array($mercancia)) {
            $useMinMax = false;
            if (isset($mercancia['min'])) {
                $this->addUsingAlias(FoliosPeer::MERCANCIA, $mercancia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mercancia['max'])) {
                $this->addUsingAlias(FoliosPeer::MERCANCIA, $mercancia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::MERCANCIA, $mercancia, $comparison);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FoliosPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FoliosPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliosPeer::ID, $id, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Folios $folios Object to remove from the list of results
     *
     * @return FoliosQuery The current query, for fluid interface
     */
    public function prune($folios = null)
    {
        if ($folios) {
            $this->addUsingAlias(FoliosPeer::AUTO, $folios->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
