<?php


/**
 * Base class that represents a query for the 'notas' table.
 *
 *
 *
 * @method NotasQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method NotasQuery orderByCCvge($order = Criteria::ASC) Order by the c_cvge column
 * @method NotasQuery orderByDFech($order = Criteria::ASC) Order by the d_fech column
 * @method NotasQuery orderByCHora($order = Criteria::ASC) Order by the c_hora column
 * @method NotasQuery orderByFecha($order = Criteria::ASC) Order by the fecha column
 * @method NotasQuery orderByHora($order = Criteria::ASC) Order by the hora column
 * @method NotasQuery orderByNota($order = Criteria::ASC) Order by the nota column
 * @method NotasQuery orderByBorrado($order = Criteria::ASC) Order by the borrado column
 * @method NotasQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method NotasQuery orderByFuente($order = Criteria::ASC) Order by the fuente column
 * @method NotasQuery orderByCCont($order = Criteria::ASC) Order by the c_cont column
 *
 * @method NotasQuery groupByAuto() Group by the auto column
 * @method NotasQuery groupByCCvge() Group by the c_cvge column
 * @method NotasQuery groupByDFech() Group by the d_fech column
 * @method NotasQuery groupByCHora() Group by the c_hora column
 * @method NotasQuery groupByFecha() Group by the fecha column
 * @method NotasQuery groupByHora() Group by the hora column
 * @method NotasQuery groupByNota() Group by the nota column
 * @method NotasQuery groupByBorrado() Group by the borrado column
 * @method NotasQuery groupByCuenta() Group by the cuenta column
 * @method NotasQuery groupByFuente() Group by the fuente column
 * @method NotasQuery groupByCCont() Group by the c_cont column
 *
 * @method NotasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NotasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NotasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Notas findOne(PropelPDO $con = null) Return the first Notas matching the query
 * @method Notas findOneOrCreate(PropelPDO $con = null) Return the first Notas matching the query, or a new Notas object populated from the query conditions when no match is found
 *
 * @method Notas findOneByCCvge(string $c_cvge) Return the first Notas filtered by the c_cvge column
 * @method Notas findOneByDFech(string $d_fech) Return the first Notas filtered by the d_fech column
 * @method Notas findOneByCHora(string $c_hora) Return the first Notas filtered by the c_hora column
 * @method Notas findOneByFecha(string $fecha) Return the first Notas filtered by the fecha column
 * @method Notas findOneByHora(string $hora) Return the first Notas filtered by the hora column
 * @method Notas findOneByNota(string $nota) Return the first Notas filtered by the nota column
 * @method Notas findOneByBorrado(boolean $borrado) Return the first Notas filtered by the borrado column
 * @method Notas findOneByCuenta(int $cuenta) Return the first Notas filtered by the cuenta column
 * @method Notas findOneByFuente(string $fuente) Return the first Notas filtered by the fuente column
 * @method Notas findOneByCCont(int $c_cont) Return the first Notas filtered by the c_cont column
 *
 * @method array findByAuto(int $auto) Return Notas objects filtered by the auto column
 * @method array findByCCvge(string $c_cvge) Return Notas objects filtered by the c_cvge column
 * @method array findByDFech(string $d_fech) Return Notas objects filtered by the d_fech column
 * @method array findByCHora(string $c_hora) Return Notas objects filtered by the c_hora column
 * @method array findByFecha(string $fecha) Return Notas objects filtered by the fecha column
 * @method array findByHora(string $hora) Return Notas objects filtered by the hora column
 * @method array findByNota(string $nota) Return Notas objects filtered by the nota column
 * @method array findByBorrado(boolean $borrado) Return Notas objects filtered by the borrado column
 * @method array findByCuenta(int $cuenta) Return Notas objects filtered by the cuenta column
 * @method array findByFuente(string $fuente) Return Notas objects filtered by the fuente column
 * @method array findByCCont(int $c_cont) Return Notas objects filtered by the c_cont column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseNotasQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNotasQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Notas', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NotasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NotasQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NotasQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NotasQuery) {
            return $criteria;
        }
        $query = new NotasQuery();
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
     * @return   Notas|Notas[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotasPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NotasPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Notas A model object, or null if the key is not found
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
     * @return                 Notas A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `c_cvge`, `d_fech`, `c_hora`, `fecha`, `hora`, `nota`, `borrado`, `cuenta`, `fuente`, `c_cont` FROM `notas` WHERE `auto` = :p0';
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
            $obj = new Notas();
            $obj->hydrate($row);
            NotasPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Notas|Notas[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Notas[]|mixed the list of results, formatted by the current formatter
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
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NotasPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NotasPeer::AUTO, $keys, Criteria::IN);
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
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(NotasPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(NotasPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::AUTO, $auto, $comparison);
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
     * @return NotasQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NotasPeer::C_CVGE, $cCvge, $comparison);
    }

    /**
     * Filter the query on the d_fech column
     *
     * Example usage:
     * <code>
     * $query->filterByDFech('2011-03-14'); // WHERE d_fech = '2011-03-14'
     * $query->filterByDFech('now'); // WHERE d_fech = '2011-03-14'
     * $query->filterByDFech(array('max' => 'yesterday')); // WHERE d_fech > '2011-03-13'
     * </code>
     *
     * @param     mixed $dFech The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByDFech($dFech = null, $comparison = null)
    {
        if (is_array($dFech)) {
            $useMinMax = false;
            if (isset($dFech['min'])) {
                $this->addUsingAlias(NotasPeer::D_FECH, $dFech['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dFech['max'])) {
                $this->addUsingAlias(NotasPeer::D_FECH, $dFech['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::D_FECH, $dFech, $comparison);
    }

    /**
     * Filter the query on the c_hora column
     *
     * Example usage:
     * <code>
     * $query->filterByCHora('2011-03-14'); // WHERE c_hora = '2011-03-14'
     * $query->filterByCHora('now'); // WHERE c_hora = '2011-03-14'
     * $query->filterByCHora(array('max' => 'yesterday')); // WHERE c_hora > '2011-03-13'
     * </code>
     *
     * @param     mixed $cHora The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByCHora($cHora = null, $comparison = null)
    {
        if (is_array($cHora)) {
            $useMinMax = false;
            if (isset($cHora['min'])) {
                $this->addUsingAlias(NotasPeer::C_HORA, $cHora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cHora['max'])) {
                $this->addUsingAlias(NotasPeer::C_HORA, $cHora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::C_HORA, $cHora, $comparison);
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
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(NotasPeer::FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(NotasPeer::FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the hora column
     *
     * Example usage:
     * <code>
     * $query->filterByHora('2011-03-14'); // WHERE hora = '2011-03-14'
     * $query->filterByHora('now'); // WHERE hora = '2011-03-14'
     * $query->filterByHora(array('max' => 'yesterday')); // WHERE hora > '2011-03-13'
     * </code>
     *
     * @param     mixed $hora The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByHora($hora = null, $comparison = null)
    {
        if (is_array($hora)) {
            $useMinMax = false;
            if (isset($hora['min'])) {
                $this->addUsingAlias(NotasPeer::HORA, $hora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hora['max'])) {
                $this->addUsingAlias(NotasPeer::HORA, $hora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::HORA, $hora, $comparison);
    }

    /**
     * Filter the query on the nota column
     *
     * Example usage:
     * <code>
     * $query->filterByNota('fooValue');   // WHERE nota = 'fooValue'
     * $query->filterByNota('%fooValue%'); // WHERE nota LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nota The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByNota($nota = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nota)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nota)) {
                $nota = str_replace('*', '%', $nota);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotasPeer::NOTA, $nota, $comparison);
    }

    /**
     * Filter the query on the borrado column
     *
     * Example usage:
     * <code>
     * $query->filterByBorrado(true); // WHERE borrado = true
     * $query->filterByBorrado('yes'); // WHERE borrado = true
     * </code>
     *
     * @param     boolean|string $borrado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByBorrado($borrado = null, $comparison = null)
    {
        if (is_string($borrado)) {
            $borrado = in_array(strtolower($borrado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(NotasPeer::BORRADO, $borrado, $comparison);
    }

    /**
     * Filter the query on the cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByCuenta(1234); // WHERE cuenta = 1234
     * $query->filterByCuenta(array(12, 34)); // WHERE cuenta IN (12, 34)
     * $query->filterByCuenta(array('min' => 12)); // WHERE cuenta >= 12
     * $query->filterByCuenta(array('max' => 12)); // WHERE cuenta <= 12
     * </code>
     *
     * @param     mixed $cuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByCuenta($cuenta = null, $comparison = null)
    {
        if (is_array($cuenta)) {
            $useMinMax = false;
            if (isset($cuenta['min'])) {
                $this->addUsingAlias(NotasPeer::CUENTA, $cuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cuenta['max'])) {
                $this->addUsingAlias(NotasPeer::CUENTA, $cuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the fuente column
     *
     * Example usage:
     * <code>
     * $query->filterByFuente('fooValue');   // WHERE fuente = 'fooValue'
     * $query->filterByFuente('%fooValue%'); // WHERE fuente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fuente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByFuente($fuente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fuente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fuente)) {
                $fuente = str_replace('*', '%', $fuente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotasPeer::FUENTE, $fuente, $comparison);
    }

    /**
     * Filter the query on the c_cont column
     *
     * Example usage:
     * <code>
     * $query->filterByCCont(1234); // WHERE c_cont = 1234
     * $query->filterByCCont(array(12, 34)); // WHERE c_cont IN (12, 34)
     * $query->filterByCCont(array('min' => 12)); // WHERE c_cont >= 12
     * $query->filterByCCont(array('max' => 12)); // WHERE c_cont <= 12
     * </code>
     *
     * @param     mixed $cCont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function filterByCCont($cCont = null, $comparison = null)
    {
        if (is_array($cCont)) {
            $useMinMax = false;
            if (isset($cCont['min'])) {
                $this->addUsingAlias(NotasPeer::C_CONT, $cCont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cCont['max'])) {
                $this->addUsingAlias(NotasPeer::C_CONT, $cCont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotasPeer::C_CONT, $cCont, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Notas $notas Object to remove from the list of results
     *
     * @return NotasQuery The current query, for fluid interface
     */
    public function prune($notas = null)
    {
        if ($notas) {
            $this->addUsingAlias(NotasPeer::AUTO, $notas->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
