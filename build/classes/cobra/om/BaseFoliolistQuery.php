<?php


/**
 * Base class that represents a query for the 'foliolist' table.
 *
 *
 *
 * @method FoliolistQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method FoliolistQuery orderByFolio($order = Criteria::ASC) Order by the folio column
 * @method FoliolistQuery orderByEnviado($order = Criteria::ASC) Order by the enviado column
 * @method FoliolistQuery orderByUpda($order = Criteria::ASC) Order by the upda column
 * @method FoliolistQuery orderByCrear($order = Criteria::ASC) Order by the crear column
 * @method FoliolistQuery orderByCuenta($order = Criteria::ASC) Order by the cuenta column
 * @method FoliolistQuery orderByNombreDeudor($order = Criteria::ASC) Order by the nombre_deudor column
 * @method FoliolistQuery orderByCapital($order = Criteria::ASC) Order by the capital column
 * @method FoliolistQuery orderBySaldoCan($order = Criteria::ASC) Order by the saldo_can column
 * @method FoliolistQuery orderByMora($order = Criteria::ASC) Order by the mora column
 * @method FoliolistQuery orderByNProm($order = Criteria::ASC) Order by the n_prom column
 * @method FoliolistQuery orderByDProm1($order = Criteria::ASC) Order by the d_prom1 column
 * @method FoliolistQuery orderByNProm1($order = Criteria::ASC) Order by the n_prom1 column
 * @method FoliolistQuery orderByDProm2($order = Criteria::ASC) Order by the d_prom2 column
 * @method FoliolistQuery orderByNProm2($order = Criteria::ASC) Order by the n_prom2 column
 * @method FoliolistQuery orderByCuentaConcentradora1($order = Criteria::ASC) Order by the cuenta_concentradora_1 column
 * @method FoliolistQuery orderByDFech($order = Criteria::ASC) Order by the d_fech column
 * @method FoliolistQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 * @method FoliolistQuery orderByCnp($order = Criteria::ASC) Order by the cnp column
 * @method FoliolistQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method FoliolistQuery orderByCiudadDeudor($order = Criteria::ASC) Order by the ciudad_deudor column
 * @method FoliolistQuery orderByEstadoDeudor($order = Criteria::ASC) Order by the estado_deudor column
 * @method FoliolistQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method FoliolistQuery orderBySdc($order = Criteria::ASC) Order by the sdc column
 * @method FoliolistQuery orderByUpd($order = Criteria::ASC) Order by the upd column
 * @method FoliolistQuery orderByCProm($order = Criteria::ASC) Order by the c_prom column
 * @method FoliolistQuery orderByCFreq($order = Criteria::ASC) Order by the c_freq column
 * @method FoliolistQuery orderByDiff($order = Criteria::ASC) Order by the diff column
 *
 * @method FoliolistQuery groupByCliente() Group by the cliente column
 * @method FoliolistQuery groupByFolio() Group by the folio column
 * @method FoliolistQuery groupByEnviado() Group by the enviado column
 * @method FoliolistQuery groupByUpda() Group by the upda column
 * @method FoliolistQuery groupByCrear() Group by the crear column
 * @method FoliolistQuery groupByCuenta() Group by the cuenta column
 * @method FoliolistQuery groupByNombreDeudor() Group by the nombre_deudor column
 * @method FoliolistQuery groupByCapital() Group by the capital column
 * @method FoliolistQuery groupBySaldoCan() Group by the saldo_can column
 * @method FoliolistQuery groupByMora() Group by the mora column
 * @method FoliolistQuery groupByNProm() Group by the n_prom column
 * @method FoliolistQuery groupByDProm1() Group by the d_prom1 column
 * @method FoliolistQuery groupByNProm1() Group by the n_prom1 column
 * @method FoliolistQuery groupByDProm2() Group by the d_prom2 column
 * @method FoliolistQuery groupByNProm2() Group by the n_prom2 column
 * @method FoliolistQuery groupByCuentaConcentradora1() Group by the cuenta_concentradora_1 column
 * @method FoliolistQuery groupByDFech() Group by the d_fech column
 * @method FoliolistQuery groupByIdCuenta() Group by the id_cuenta column
 * @method FoliolistQuery groupByCnp() Group by the cnp column
 * @method FoliolistQuery groupByAuto() Group by the auto column
 * @method FoliolistQuery groupByCiudadDeudor() Group by the ciudad_deudor column
 * @method FoliolistQuery groupByEstadoDeudor() Group by the estado_deudor column
 * @method FoliolistQuery groupByGestor() Group by the gestor column
 * @method FoliolistQuery groupBySdc() Group by the sdc column
 * @method FoliolistQuery groupByUpd() Group by the upd column
 * @method FoliolistQuery groupByCProm() Group by the c_prom column
 * @method FoliolistQuery groupByCFreq() Group by the c_freq column
 * @method FoliolistQuery groupByDiff() Group by the diff column
 *
 * @method FoliolistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FoliolistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FoliolistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Foliolist findOne(PropelPDO $con = null) Return the first Foliolist matching the query
 * @method Foliolist findOneOrCreate(PropelPDO $con = null) Return the first Foliolist matching the query, or a new Foliolist object populated from the query conditions when no match is found
 *
 * @method Foliolist findOneByCliente(string $cliente) Return the first Foliolist filtered by the cliente column
 * @method Foliolist findOneByFolio(int $folio) Return the first Foliolist filtered by the folio column
 * @method Foliolist findOneByEnviado(boolean $enviado) Return the first Foliolist filtered by the enviado column
 * @method Foliolist findOneByUpda(int $upda) Return the first Foliolist filtered by the upda column
 * @method Foliolist findOneByCrear(string $crear) Return the first Foliolist filtered by the crear column
 * @method Foliolist findOneByCuenta(string $cuenta) Return the first Foliolist filtered by the cuenta column
 * @method Foliolist findOneByNombreDeudor(string $nombre_deudor) Return the first Foliolist filtered by the nombre_deudor column
 * @method Foliolist findOneByCapital(string $capital) Return the first Foliolist filtered by the capital column
 * @method Foliolist findOneBySaldoCan(string $saldo_can) Return the first Foliolist filtered by the saldo_can column
 * @method Foliolist findOneByMora(int $mora) Return the first Foliolist filtered by the mora column
 * @method Foliolist findOneByNProm(string $n_prom) Return the first Foliolist filtered by the n_prom column
 * @method Foliolist findOneByDProm1(string $d_prom1) Return the first Foliolist filtered by the d_prom1 column
 * @method Foliolist findOneByNProm1(string $n_prom1) Return the first Foliolist filtered by the n_prom1 column
 * @method Foliolist findOneByDProm2(string $d_prom2) Return the first Foliolist filtered by the d_prom2 column
 * @method Foliolist findOneByNProm2(string $n_prom2) Return the first Foliolist filtered by the n_prom2 column
 * @method Foliolist findOneByCuentaConcentradora1(string $cuenta_concentradora_1) Return the first Foliolist filtered by the cuenta_concentradora_1 column
 * @method Foliolist findOneByDFech(string $d_fech) Return the first Foliolist filtered by the d_fech column
 * @method Foliolist findOneByIdCuenta(int $id_cuenta) Return the first Foliolist filtered by the id_cuenta column
 * @method Foliolist findOneByCnp(string $cnp) Return the first Foliolist filtered by the cnp column
 * @method Foliolist findOneByAuto(int $auto) Return the first Foliolist filtered by the auto column
 * @method Foliolist findOneByCiudadDeudor(string $ciudad_deudor) Return the first Foliolist filtered by the ciudad_deudor column
 * @method Foliolist findOneByEstadoDeudor(string $estado_deudor) Return the first Foliolist filtered by the estado_deudor column
 * @method Foliolist findOneByGestor(string $gestor) Return the first Foliolist filtered by the gestor column
 * @method Foliolist findOneBySdc(string $sdc) Return the first Foliolist filtered by the sdc column
 * @method Foliolist findOneByUpd(string $upd) Return the first Foliolist filtered by the upd column
 * @method Foliolist findOneByCProm(string $c_prom) Return the first Foliolist filtered by the c_prom column
 * @method Foliolist findOneByCFreq(string $c_freq) Return the first Foliolist filtered by the c_freq column
 * @method Foliolist findOneByDiff(int $diff) Return the first Foliolist filtered by the diff column
 *
 * @method array findByCliente(string $cliente) Return Foliolist objects filtered by the cliente column
 * @method array findByFolio(int $folio) Return Foliolist objects filtered by the folio column
 * @method array findByEnviado(boolean $enviado) Return Foliolist objects filtered by the enviado column
 * @method array findByUpda(int $upda) Return Foliolist objects filtered by the upda column
 * @method array findByCrear(string $crear) Return Foliolist objects filtered by the crear column
 * @method array findByCuenta(string $cuenta) Return Foliolist objects filtered by the cuenta column
 * @method array findByNombreDeudor(string $nombre_deudor) Return Foliolist objects filtered by the nombre_deudor column
 * @method array findByCapital(string $capital) Return Foliolist objects filtered by the capital column
 * @method array findBySaldoCan(string $saldo_can) Return Foliolist objects filtered by the saldo_can column
 * @method array findByMora(int $mora) Return Foliolist objects filtered by the mora column
 * @method array findByNProm(string $n_prom) Return Foliolist objects filtered by the n_prom column
 * @method array findByDProm1(string $d_prom1) Return Foliolist objects filtered by the d_prom1 column
 * @method array findByNProm1(string $n_prom1) Return Foliolist objects filtered by the n_prom1 column
 * @method array findByDProm2(string $d_prom2) Return Foliolist objects filtered by the d_prom2 column
 * @method array findByNProm2(string $n_prom2) Return Foliolist objects filtered by the n_prom2 column
 * @method array findByCuentaConcentradora1(string $cuenta_concentradora_1) Return Foliolist objects filtered by the cuenta_concentradora_1 column
 * @method array findByDFech(string $d_fech) Return Foliolist objects filtered by the d_fech column
 * @method array findByIdCuenta(int $id_cuenta) Return Foliolist objects filtered by the id_cuenta column
 * @method array findByCnp(string $cnp) Return Foliolist objects filtered by the cnp column
 * @method array findByAuto(int $auto) Return Foliolist objects filtered by the auto column
 * @method array findByCiudadDeudor(string $ciudad_deudor) Return Foliolist objects filtered by the ciudad_deudor column
 * @method array findByEstadoDeudor(string $estado_deudor) Return Foliolist objects filtered by the estado_deudor column
 * @method array findByGestor(string $gestor) Return Foliolist objects filtered by the gestor column
 * @method array findBySdc(string $sdc) Return Foliolist objects filtered by the sdc column
 * @method array findByUpd(string $upd) Return Foliolist objects filtered by the upd column
 * @method array findByCProm(string $c_prom) Return Foliolist objects filtered by the c_prom column
 * @method array findByCFreq(string $c_freq) Return Foliolist objects filtered by the c_freq column
 * @method array findByDiff(int $diff) Return Foliolist objects filtered by the diff column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseFoliolistQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFoliolistQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Foliolist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FoliolistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   FoliolistQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FoliolistQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FoliolistQuery) {
            return $criteria;
        }
        $query = new FoliolistQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$cliente, $folio]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Foliolist|Foliolist[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FoliolistPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FoliolistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Foliolist A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `cliente`, `folio`, `enviado`, `upda`, `crear`, `cuenta`, `nombre_deudor`, `capital`, `saldo_can`, `mora`, `n_prom`, `d_prom1`, `n_prom1`, `d_prom2`, `n_prom2`, `cuenta_concentradora_1`, `d_fech`, `id_cuenta`, `cnp`, `auto`, `ciudad_deudor`, `estado_deudor`, `gestor`, `sdc`, `upd`, `c_prom`, `c_freq`, `diff` FROM `foliolist` WHERE `cliente` = :p0 AND `folio` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Foliolist();
            $obj->hydrate($row);
            FoliolistPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Foliolist|Foliolist[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Foliolist[]|mixed the list of results, formatted by the current formatter
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(FoliolistPeer::CLIENTE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(FoliolistPeer::FOLIO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(FoliolistPeer::CLIENTE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(FoliolistPeer::FOLIO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return FoliolistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FoliolistPeer::CLIENTE, $cliente, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByFolio($folio = null, $comparison = null)
    {
        if (is_array($folio)) {
            $useMinMax = false;
            if (isset($folio['min'])) {
                $this->addUsingAlias(FoliolistPeer::FOLIO, $folio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folio['max'])) {
                $this->addUsingAlias(FoliolistPeer::FOLIO, $folio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::FOLIO, $folio, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByEnviado($enviado = null, $comparison = null)
    {
        if (is_string($enviado)) {
            $enviado = in_array(strtolower($enviado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FoliolistPeer::ENVIADO, $enviado, $comparison);
    }

    /**
     * Filter the query on the upda column
     *
     * Example usage:
     * <code>
     * $query->filterByUpda(1234); // WHERE upda = 1234
     * $query->filterByUpda(array(12, 34)); // WHERE upda IN (12, 34)
     * $query->filterByUpda(array('min' => 12)); // WHERE upda >= 12
     * $query->filterByUpda(array('max' => 12)); // WHERE upda <= 12
     * </code>
     *
     * @param     mixed $upda The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByUpda($upda = null, $comparison = null)
    {
        if (is_array($upda)) {
            $useMinMax = false;
            if (isset($upda['min'])) {
                $this->addUsingAlias(FoliolistPeer::UPDA, $upda['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upda['max'])) {
                $this->addUsingAlias(FoliolistPeer::UPDA, $upda['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::UPDA, $upda, $comparison);
    }

    /**
     * Filter the query on the crear column
     *
     * Example usage:
     * <code>
     * $query->filterByCrear('fooValue');   // WHERE crear = 'fooValue'
     * $query->filterByCrear('%fooValue%'); // WHERE crear LIKE '%fooValue%'
     * </code>
     *
     * @param     string $crear The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCrear($crear = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($crear)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $crear)) {
                $crear = str_replace('*', '%', $crear);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::CREAR, $crear, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FoliolistPeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the nombre_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreDeudor('fooValue');   // WHERE nombre_deudor = 'fooValue'
     * $query->filterByNombreDeudor('%fooValue%'); // WHERE nombre_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByNombreDeudor($nombreDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreDeudor)) {
                $nombreDeudor = str_replace('*', '%', $nombreDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::NOMBRE_DEUDOR, $nombreDeudor, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCapital($capital = null, $comparison = null)
    {
        if (is_array($capital)) {
            $useMinMax = false;
            if (isset($capital['min'])) {
                $this->addUsingAlias(FoliolistPeer::CAPITAL, $capital['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capital['max'])) {
                $this->addUsingAlias(FoliolistPeer::CAPITAL, $capital['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::CAPITAL, $capital, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterBySaldoCan($saldoCan = null, $comparison = null)
    {
        if (is_array($saldoCan)) {
            $useMinMax = false;
            if (isset($saldoCan['min'])) {
                $this->addUsingAlias(FoliolistPeer::SALDO_CAN, $saldoCan['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoCan['max'])) {
                $this->addUsingAlias(FoliolistPeer::SALDO_CAN, $saldoCan['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::SALDO_CAN, $saldoCan, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByMora($mora = null, $comparison = null)
    {
        if (is_array($mora)) {
            $useMinMax = false;
            if (isset($mora['min'])) {
                $this->addUsingAlias(FoliolistPeer::MORA, $mora['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mora['max'])) {
                $this->addUsingAlias(FoliolistPeer::MORA, $mora['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::MORA, $mora, $comparison);
    }

    /**
     * Filter the query on the n_prom column
     *
     * Example usage:
     * <code>
     * $query->filterByNProm(1234); // WHERE n_prom = 1234
     * $query->filterByNProm(array(12, 34)); // WHERE n_prom IN (12, 34)
     * $query->filterByNProm(array('min' => 12)); // WHERE n_prom >= 12
     * $query->filterByNProm(array('max' => 12)); // WHERE n_prom <= 12
     * </code>
     *
     * @param     mixed $nProm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByNProm($nProm = null, $comparison = null)
    {
        if (is_array($nProm)) {
            $useMinMax = false;
            if (isset($nProm['min'])) {
                $this->addUsingAlias(FoliolistPeer::N_PROM, $nProm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nProm['max'])) {
                $this->addUsingAlias(FoliolistPeer::N_PROM, $nProm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::N_PROM, $nProm, $comparison);
    }

    /**
     * Filter the query on the d_prom1 column
     *
     * Example usage:
     * <code>
     * $query->filterByDProm1('2011-03-14'); // WHERE d_prom1 = '2011-03-14'
     * $query->filterByDProm1('now'); // WHERE d_prom1 = '2011-03-14'
     * $query->filterByDProm1(array('max' => 'yesterday')); // WHERE d_prom1 > '2011-03-13'
     * </code>
     *
     * @param     mixed $dProm1 The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByDProm1($dProm1 = null, $comparison = null)
    {
        if (is_array($dProm1)) {
            $useMinMax = false;
            if (isset($dProm1['min'])) {
                $this->addUsingAlias(FoliolistPeer::D_PROM1, $dProm1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dProm1['max'])) {
                $this->addUsingAlias(FoliolistPeer::D_PROM1, $dProm1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::D_PROM1, $dProm1, $comparison);
    }

    /**
     * Filter the query on the n_prom1 column
     *
     * Example usage:
     * <code>
     * $query->filterByNProm1(1234); // WHERE n_prom1 = 1234
     * $query->filterByNProm1(array(12, 34)); // WHERE n_prom1 IN (12, 34)
     * $query->filterByNProm1(array('min' => 12)); // WHERE n_prom1 >= 12
     * $query->filterByNProm1(array('max' => 12)); // WHERE n_prom1 <= 12
     * </code>
     *
     * @param     mixed $nProm1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByNProm1($nProm1 = null, $comparison = null)
    {
        if (is_array($nProm1)) {
            $useMinMax = false;
            if (isset($nProm1['min'])) {
                $this->addUsingAlias(FoliolistPeer::N_PROM1, $nProm1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nProm1['max'])) {
                $this->addUsingAlias(FoliolistPeer::N_PROM1, $nProm1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::N_PROM1, $nProm1, $comparison);
    }

    /**
     * Filter the query on the d_prom2 column
     *
     * Example usage:
     * <code>
     * $query->filterByDProm2('2011-03-14'); // WHERE d_prom2 = '2011-03-14'
     * $query->filterByDProm2('now'); // WHERE d_prom2 = '2011-03-14'
     * $query->filterByDProm2(array('max' => 'yesterday')); // WHERE d_prom2 > '2011-03-13'
     * </code>
     *
     * @param     mixed $dProm2 The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByDProm2($dProm2 = null, $comparison = null)
    {
        if (is_array($dProm2)) {
            $useMinMax = false;
            if (isset($dProm2['min'])) {
                $this->addUsingAlias(FoliolistPeer::D_PROM2, $dProm2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dProm2['max'])) {
                $this->addUsingAlias(FoliolistPeer::D_PROM2, $dProm2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::D_PROM2, $dProm2, $comparison);
    }

    /**
     * Filter the query on the n_prom2 column
     *
     * Example usage:
     * <code>
     * $query->filterByNProm2(1234); // WHERE n_prom2 = 1234
     * $query->filterByNProm2(array(12, 34)); // WHERE n_prom2 IN (12, 34)
     * $query->filterByNProm2(array('min' => 12)); // WHERE n_prom2 >= 12
     * $query->filterByNProm2(array('max' => 12)); // WHERE n_prom2 <= 12
     * </code>
     *
     * @param     mixed $nProm2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByNProm2($nProm2 = null, $comparison = null)
    {
        if (is_array($nProm2)) {
            $useMinMax = false;
            if (isset($nProm2['min'])) {
                $this->addUsingAlias(FoliolistPeer::N_PROM2, $nProm2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nProm2['max'])) {
                $this->addUsingAlias(FoliolistPeer::N_PROM2, $nProm2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::N_PROM2, $nProm2, $comparison);
    }

    /**
     * Filter the query on the cuenta_concentradora_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCuentaConcentradora1('fooValue');   // WHERE cuenta_concentradora_1 = 'fooValue'
     * $query->filterByCuentaConcentradora1('%fooValue%'); // WHERE cuenta_concentradora_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuentaConcentradora1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCuentaConcentradora1($cuentaConcentradora1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuentaConcentradora1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuentaConcentradora1)) {
                $cuentaConcentradora1 = str_replace('*', '%', $cuentaConcentradora1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::CUENTA_CONCENTRADORA_1, $cuentaConcentradora1, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByDFech($dFech = null, $comparison = null)
    {
        if (is_array($dFech)) {
            $useMinMax = false;
            if (isset($dFech['min'])) {
                $this->addUsingAlias(FoliolistPeer::D_FECH, $dFech['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dFech['max'])) {
                $this->addUsingAlias(FoliolistPeer::D_FECH, $dFech['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::D_FECH, $dFech, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(FoliolistPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(FoliolistPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::ID_CUENTA, $idCuenta, $comparison);
    }

    /**
     * Filter the query on the cnp column
     *
     * Example usage:
     * <code>
     * $query->filterByCnp('fooValue');   // WHERE cnp = 'fooValue'
     * $query->filterByCnp('%fooValue%'); // WHERE cnp LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cnp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCnp($cnp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cnp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cnp)) {
                $cnp = str_replace('*', '%', $cnp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::CNP, $cnp, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(FoliolistPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(FoliolistPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the ciudad_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadDeudor('fooValue');   // WHERE ciudad_deudor = 'fooValue'
     * $query->filterByCiudadDeudor('%fooValue%'); // WHERE ciudad_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCiudadDeudor($ciudadDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadDeudor)) {
                $ciudadDeudor = str_replace('*', '%', $ciudadDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::CIUDAD_DEUDOR, $ciudadDeudor, $comparison);
    }

    /**
     * Filter the query on the estado_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoDeudor('fooValue');   // WHERE estado_deudor = 'fooValue'
     * $query->filterByEstadoDeudor('%fooValue%'); // WHERE estado_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByEstadoDeudor($estadoDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoDeudor)) {
                $estadoDeudor = str_replace('*', '%', $estadoDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::ESTADO_DEUDOR, $estadoDeudor, $comparison);
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
     * @return FoliolistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FoliolistPeer::GESTOR, $gestor, $comparison);
    }

    /**
     * Filter the query on the sdc column
     *
     * Example usage:
     * <code>
     * $query->filterBySdc('fooValue');   // WHERE sdc = 'fooValue'
     * $query->filterBySdc('%fooValue%'); // WHERE sdc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sdc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterBySdc($sdc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sdc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sdc)) {
                $sdc = str_replace('*', '%', $sdc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::SDC, $sdc, $comparison);
    }

    /**
     * Filter the query on the upd column
     *
     * Example usage:
     * <code>
     * $query->filterByUpd('fooValue');   // WHERE upd = 'fooValue'
     * $query->filterByUpd('%fooValue%'); // WHERE upd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upd The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByUpd($upd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upd)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upd)) {
                $upd = str_replace('*', '%', $upd);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::UPD, $upd, $comparison);
    }

    /**
     * Filter the query on the c_prom column
     *
     * Example usage:
     * <code>
     * $query->filterByCProm('fooValue');   // WHERE c_prom = 'fooValue'
     * $query->filterByCProm('%fooValue%'); // WHERE c_prom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cProm The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCProm($cProm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cProm)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cProm)) {
                $cProm = str_replace('*', '%', $cProm);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::C_PROM, $cProm, $comparison);
    }

    /**
     * Filter the query on the c_freq column
     *
     * Example usage:
     * <code>
     * $query->filterByCFreq('fooValue');   // WHERE c_freq = 'fooValue'
     * $query->filterByCFreq('%fooValue%'); // WHERE c_freq LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cFreq The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByCFreq($cFreq = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cFreq)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cFreq)) {
                $cFreq = str_replace('*', '%', $cFreq);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::C_FREQ, $cFreq, $comparison);
    }

    /**
     * Filter the query on the diff column
     *
     * Example usage:
     * <code>
     * $query->filterByDiff(1234); // WHERE diff = 1234
     * $query->filterByDiff(array(12, 34)); // WHERE diff IN (12, 34)
     * $query->filterByDiff(array('min' => 12)); // WHERE diff >= 12
     * $query->filterByDiff(array('max' => 12)); // WHERE diff <= 12
     * </code>
     *
     * @param     mixed $diff The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function filterByDiff($diff = null, $comparison = null)
    {
        if (is_array($diff)) {
            $useMinMax = false;
            if (isset($diff['min'])) {
                $this->addUsingAlias(FoliolistPeer::DIFF, $diff['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($diff['max'])) {
                $this->addUsingAlias(FoliolistPeer::DIFF, $diff['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FoliolistPeer::DIFF, $diff, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Foliolist $foliolist Object to remove from the list of results
     *
     * @return FoliolistQuery The current query, for fluid interface
     */
    public function prune($foliolist = null)
    {
        if ($foliolist) {
            $this->addCond('pruneCond0', $this->getAliasedColName(FoliolistPeer::CLIENTE), $foliolist->getCliente(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(FoliolistPeer::FOLIO), $foliolist->getFolio(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
