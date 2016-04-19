<?php


/**
 * Base class that represents a query for the 'rlook' table.
 *
 *
 *
 * @method RlookQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 * @method RlookQuery orderByNumeroDeCuenta($order = Criteria::ASC) Order by the numero_de_cuenta column
 * @method RlookQuery orderByNombreDeudor($order = Criteria::ASC) Order by the nombre_deudor column
 * @method RlookQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method RlookQuery orderByStatusDeCredito($order = Criteria::ASC) Order by the status_de_credito column
 * @method RlookQuery orderByNombreReferencia1($order = Criteria::ASC) Order by the nombre_referencia_1 column
 * @method RlookQuery orderByNombreReferencia2($order = Criteria::ASC) Order by the nombre_referencia_2 column
 * @method RlookQuery orderByNombreReferencia3($order = Criteria::ASC) Order by the nombre_referencia_3 column
 * @method RlookQuery orderByNombreReferencia4($order = Criteria::ASC) Order by the nombre_referencia_4 column
 * @method RlookQuery orderByTel1($order = Criteria::ASC) Order by the tel_1 column
 * @method RlookQuery orderByTel2($order = Criteria::ASC) Order by the tel_2 column
 * @method RlookQuery orderByTel3($order = Criteria::ASC) Order by the tel_3 column
 * @method RlookQuery orderByTel4($order = Criteria::ASC) Order by the tel_4 column
 * @method RlookQuery orderByTel1Alterno($order = Criteria::ASC) Order by the tel_1_alterno column
 * @method RlookQuery orderByTel2Alterno($order = Criteria::ASC) Order by the tel_2_alterno column
 * @method RlookQuery orderByTel3Alterno($order = Criteria::ASC) Order by the tel_3_alterno column
 * @method RlookQuery orderByTel4Alterno($order = Criteria::ASC) Order by the tel_4_alterno column
 * @method RlookQuery orderByTel1Verif($order = Criteria::ASC) Order by the tel_1_verif column
 * @method RlookQuery orderByTel2Verif($order = Criteria::ASC) Order by the tel_2_verif column
 * @method RlookQuery orderByTel3Verif($order = Criteria::ASC) Order by the tel_3_verif column
 * @method RlookQuery orderByTel4Verif($order = Criteria::ASC) Order by the tel_4_verif column
 * @method RlookQuery orderByTel1Ref1($order = Criteria::ASC) Order by the tel_1_ref_1 column
 * @method RlookQuery orderByTel2Ref1($order = Criteria::ASC) Order by the tel_2_ref_1 column
 * @method RlookQuery orderByTel1Ref2($order = Criteria::ASC) Order by the tel_1_ref_2 column
 * @method RlookQuery orderByTel2Ref2($order = Criteria::ASC) Order by the tel_2_ref_2 column
 * @method RlookQuery orderByTel1Ref3($order = Criteria::ASC) Order by the tel_1_ref_3 column
 * @method RlookQuery orderByTel2Ref3($order = Criteria::ASC) Order by the tel_2_ref_3 column
 * @method RlookQuery orderByTel1Ref4($order = Criteria::ASC) Order by the tel_1_ref_4 column
 * @method RlookQuery orderByTel2Ref4($order = Criteria::ASC) Order by the tel_2_ref_4 column
 * @method RlookQuery orderByTel1Laboral($order = Criteria::ASC) Order by the tel_1_laboral column
 * @method RlookQuery orderByTel2Laboral($order = Criteria::ASC) Order by the tel_2_laboral column
 * @method RlookQuery orderByTelefonosMarcados($order = Criteria::ASC) Order by the telefonos_marcados column
 *
 * @method RlookQuery groupByIdCuenta() Group by the id_cuenta column
 * @method RlookQuery groupByNumeroDeCuenta() Group by the numero_de_cuenta column
 * @method RlookQuery groupByNombreDeudor() Group by the nombre_deudor column
 * @method RlookQuery groupByCliente() Group by the cliente column
 * @method RlookQuery groupByStatusDeCredito() Group by the status_de_credito column
 * @method RlookQuery groupByNombreReferencia1() Group by the nombre_referencia_1 column
 * @method RlookQuery groupByNombreReferencia2() Group by the nombre_referencia_2 column
 * @method RlookQuery groupByNombreReferencia3() Group by the nombre_referencia_3 column
 * @method RlookQuery groupByNombreReferencia4() Group by the nombre_referencia_4 column
 * @method RlookQuery groupByTel1() Group by the tel_1 column
 * @method RlookQuery groupByTel2() Group by the tel_2 column
 * @method RlookQuery groupByTel3() Group by the tel_3 column
 * @method RlookQuery groupByTel4() Group by the tel_4 column
 * @method RlookQuery groupByTel1Alterno() Group by the tel_1_alterno column
 * @method RlookQuery groupByTel2Alterno() Group by the tel_2_alterno column
 * @method RlookQuery groupByTel3Alterno() Group by the tel_3_alterno column
 * @method RlookQuery groupByTel4Alterno() Group by the tel_4_alterno column
 * @method RlookQuery groupByTel1Verif() Group by the tel_1_verif column
 * @method RlookQuery groupByTel2Verif() Group by the tel_2_verif column
 * @method RlookQuery groupByTel3Verif() Group by the tel_3_verif column
 * @method RlookQuery groupByTel4Verif() Group by the tel_4_verif column
 * @method RlookQuery groupByTel1Ref1() Group by the tel_1_ref_1 column
 * @method RlookQuery groupByTel2Ref1() Group by the tel_2_ref_1 column
 * @method RlookQuery groupByTel1Ref2() Group by the tel_1_ref_2 column
 * @method RlookQuery groupByTel2Ref2() Group by the tel_2_ref_2 column
 * @method RlookQuery groupByTel1Ref3() Group by the tel_1_ref_3 column
 * @method RlookQuery groupByTel2Ref3() Group by the tel_2_ref_3 column
 * @method RlookQuery groupByTel1Ref4() Group by the tel_1_ref_4 column
 * @method RlookQuery groupByTel2Ref4() Group by the tel_2_ref_4 column
 * @method RlookQuery groupByTel1Laboral() Group by the tel_1_laboral column
 * @method RlookQuery groupByTel2Laboral() Group by the tel_2_laboral column
 * @method RlookQuery groupByTelefonosMarcados() Group by the telefonos_marcados column
 *
 * @method RlookQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RlookQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RlookQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Rlook findOne(PropelPDO $con = null) Return the first Rlook matching the query
 * @method Rlook findOneOrCreate(PropelPDO $con = null) Return the first Rlook matching the query, or a new Rlook object populated from the query conditions when no match is found
 *
 * @method Rlook findOneByNumeroDeCuenta(string $numero_de_cuenta) Return the first Rlook filtered by the numero_de_cuenta column
 * @method Rlook findOneByNombreDeudor(string $nombre_deudor) Return the first Rlook filtered by the nombre_deudor column
 * @method Rlook findOneByCliente(string $cliente) Return the first Rlook filtered by the cliente column
 * @method Rlook findOneByStatusDeCredito(string $status_de_credito) Return the first Rlook filtered by the status_de_credito column
 * @method Rlook findOneByNombreReferencia1(string $nombre_referencia_1) Return the first Rlook filtered by the nombre_referencia_1 column
 * @method Rlook findOneByNombreReferencia2(string $nombre_referencia_2) Return the first Rlook filtered by the nombre_referencia_2 column
 * @method Rlook findOneByNombreReferencia3(string $nombre_referencia_3) Return the first Rlook filtered by the nombre_referencia_3 column
 * @method Rlook findOneByNombreReferencia4(string $nombre_referencia_4) Return the first Rlook filtered by the nombre_referencia_4 column
 * @method Rlook findOneByTel1(string $tel_1) Return the first Rlook filtered by the tel_1 column
 * @method Rlook findOneByTel2(string $tel_2) Return the first Rlook filtered by the tel_2 column
 * @method Rlook findOneByTel3(string $tel_3) Return the first Rlook filtered by the tel_3 column
 * @method Rlook findOneByTel4(string $tel_4) Return the first Rlook filtered by the tel_4 column
 * @method Rlook findOneByTel1Alterno(string $tel_1_alterno) Return the first Rlook filtered by the tel_1_alterno column
 * @method Rlook findOneByTel2Alterno(string $tel_2_alterno) Return the first Rlook filtered by the tel_2_alterno column
 * @method Rlook findOneByTel3Alterno(string $tel_3_alterno) Return the first Rlook filtered by the tel_3_alterno column
 * @method Rlook findOneByTel4Alterno(string $tel_4_alterno) Return the first Rlook filtered by the tel_4_alterno column
 * @method Rlook findOneByTel1Verif(string $tel_1_verif) Return the first Rlook filtered by the tel_1_verif column
 * @method Rlook findOneByTel2Verif(string $tel_2_verif) Return the first Rlook filtered by the tel_2_verif column
 * @method Rlook findOneByTel3Verif(string $tel_3_verif) Return the first Rlook filtered by the tel_3_verif column
 * @method Rlook findOneByTel4Verif(string $tel_4_verif) Return the first Rlook filtered by the tel_4_verif column
 * @method Rlook findOneByTel1Ref1(string $tel_1_ref_1) Return the first Rlook filtered by the tel_1_ref_1 column
 * @method Rlook findOneByTel2Ref1(string $tel_2_ref_1) Return the first Rlook filtered by the tel_2_ref_1 column
 * @method Rlook findOneByTel1Ref2(string $tel_1_ref_2) Return the first Rlook filtered by the tel_1_ref_2 column
 * @method Rlook findOneByTel2Ref2(string $tel_2_ref_2) Return the first Rlook filtered by the tel_2_ref_2 column
 * @method Rlook findOneByTel1Ref3(string $tel_1_ref_3) Return the first Rlook filtered by the tel_1_ref_3 column
 * @method Rlook findOneByTel2Ref3(string $tel_2_ref_3) Return the first Rlook filtered by the tel_2_ref_3 column
 * @method Rlook findOneByTel1Ref4(string $tel_1_ref_4) Return the first Rlook filtered by the tel_1_ref_4 column
 * @method Rlook findOneByTel2Ref4(string $tel_2_ref_4) Return the first Rlook filtered by the tel_2_ref_4 column
 * @method Rlook findOneByTel1Laboral(string $tel_1_laboral) Return the first Rlook filtered by the tel_1_laboral column
 * @method Rlook findOneByTel2Laboral(string $tel_2_laboral) Return the first Rlook filtered by the tel_2_laboral column
 * @method Rlook findOneByTelefonosMarcados(string $telefonos_marcados) Return the first Rlook filtered by the telefonos_marcados column
 *
 * @method array findByIdCuenta(int $id_cuenta) Return Rlook objects filtered by the id_cuenta column
 * @method array findByNumeroDeCuenta(string $numero_de_cuenta) Return Rlook objects filtered by the numero_de_cuenta column
 * @method array findByNombreDeudor(string $nombre_deudor) Return Rlook objects filtered by the nombre_deudor column
 * @method array findByCliente(string $cliente) Return Rlook objects filtered by the cliente column
 * @method array findByStatusDeCredito(string $status_de_credito) Return Rlook objects filtered by the status_de_credito column
 * @method array findByNombreReferencia1(string $nombre_referencia_1) Return Rlook objects filtered by the nombre_referencia_1 column
 * @method array findByNombreReferencia2(string $nombre_referencia_2) Return Rlook objects filtered by the nombre_referencia_2 column
 * @method array findByNombreReferencia3(string $nombre_referencia_3) Return Rlook objects filtered by the nombre_referencia_3 column
 * @method array findByNombreReferencia4(string $nombre_referencia_4) Return Rlook objects filtered by the nombre_referencia_4 column
 * @method array findByTel1(string $tel_1) Return Rlook objects filtered by the tel_1 column
 * @method array findByTel2(string $tel_2) Return Rlook objects filtered by the tel_2 column
 * @method array findByTel3(string $tel_3) Return Rlook objects filtered by the tel_3 column
 * @method array findByTel4(string $tel_4) Return Rlook objects filtered by the tel_4 column
 * @method array findByTel1Alterno(string $tel_1_alterno) Return Rlook objects filtered by the tel_1_alterno column
 * @method array findByTel2Alterno(string $tel_2_alterno) Return Rlook objects filtered by the tel_2_alterno column
 * @method array findByTel3Alterno(string $tel_3_alterno) Return Rlook objects filtered by the tel_3_alterno column
 * @method array findByTel4Alterno(string $tel_4_alterno) Return Rlook objects filtered by the tel_4_alterno column
 * @method array findByTel1Verif(string $tel_1_verif) Return Rlook objects filtered by the tel_1_verif column
 * @method array findByTel2Verif(string $tel_2_verif) Return Rlook objects filtered by the tel_2_verif column
 * @method array findByTel3Verif(string $tel_3_verif) Return Rlook objects filtered by the tel_3_verif column
 * @method array findByTel4Verif(string $tel_4_verif) Return Rlook objects filtered by the tel_4_verif column
 * @method array findByTel1Ref1(string $tel_1_ref_1) Return Rlook objects filtered by the tel_1_ref_1 column
 * @method array findByTel2Ref1(string $tel_2_ref_1) Return Rlook objects filtered by the tel_2_ref_1 column
 * @method array findByTel1Ref2(string $tel_1_ref_2) Return Rlook objects filtered by the tel_1_ref_2 column
 * @method array findByTel2Ref2(string $tel_2_ref_2) Return Rlook objects filtered by the tel_2_ref_2 column
 * @method array findByTel1Ref3(string $tel_1_ref_3) Return Rlook objects filtered by the tel_1_ref_3 column
 * @method array findByTel2Ref3(string $tel_2_ref_3) Return Rlook objects filtered by the tel_2_ref_3 column
 * @method array findByTel1Ref4(string $tel_1_ref_4) Return Rlook objects filtered by the tel_1_ref_4 column
 * @method array findByTel2Ref4(string $tel_2_ref_4) Return Rlook objects filtered by the tel_2_ref_4 column
 * @method array findByTel1Laboral(string $tel_1_laboral) Return Rlook objects filtered by the tel_1_laboral column
 * @method array findByTel2Laboral(string $tel_2_laboral) Return Rlook objects filtered by the tel_2_laboral column
 * @method array findByTelefonosMarcados(string $telefonos_marcados) Return Rlook objects filtered by the telefonos_marcados column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseRlookQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRlookQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Rlook', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RlookQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RlookQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RlookQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RlookQuery) {
            return $criteria;
        }
        $query = new RlookQuery();
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
     * @return   Rlook|Rlook[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RlookPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Rlook A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdCuenta($key, $con = null)
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
     * @return                 Rlook A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_cuenta`, `numero_de_cuenta`, `nombre_deudor`, `cliente`, `status_de_credito`, `nombre_referencia_1`, `nombre_referencia_2`, `nombre_referencia_3`, `nombre_referencia_4`, `tel_1`, `tel_2`, `tel_3`, `tel_4`, `tel_1_alterno`, `tel_2_alterno`, `tel_3_alterno`, `tel_4_alterno`, `tel_1_verif`, `tel_2_verif`, `tel_3_verif`, `tel_4_verif`, `tel_1_ref_1`, `tel_2_ref_1`, `tel_1_ref_2`, `tel_2_ref_2`, `tel_1_ref_3`, `tel_2_ref_3`, `tel_1_ref_4`, `tel_2_ref_4`, `tel_1_laboral`, `tel_2_laboral`, `telefonos_marcados` FROM `rlook` WHERE `id_cuenta` = :p0';
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
            $obj = new Rlook();
            $obj->hydrate($row);
            RlookPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Rlook|Rlook[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Rlook[]|mixed the list of results, formatted by the current formatter
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
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RlookPeer::ID_CUENTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RlookPeer::ID_CUENTA, $keys, Criteria::IN);
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
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(RlookPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(RlookPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RlookPeer::ID_CUENTA, $idCuenta, $comparison);
    }

    /**
     * Filter the query on the numero_de_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroDeCuenta('fooValue');   // WHERE numero_de_cuenta = 'fooValue'
     * $query->filterByNumeroDeCuenta('%fooValue%'); // WHERE numero_de_cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numeroDeCuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByNumeroDeCuenta($numeroDeCuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numeroDeCuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $numeroDeCuenta)) {
                $numeroDeCuenta = str_replace('*', '%', $numeroDeCuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::NUMERO_DE_CUENTA, $numeroDeCuenta, $comparison);
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
     * @return RlookQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RlookPeer::NOMBRE_DEUDOR, $nombreDeudor, $comparison);
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
     * @return RlookQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RlookPeer::CLIENTE, $cliente, $comparison);
    }

    /**
     * Filter the query on the status_de_credito column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusDeCredito('fooValue');   // WHERE status_de_credito = 'fooValue'
     * $query->filterByStatusDeCredito('%fooValue%'); // WHERE status_de_credito LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusDeCredito The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByStatusDeCredito($statusDeCredito = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusDeCredito)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $statusDeCredito)) {
                $statusDeCredito = str_replace('*', '%', $statusDeCredito);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::STATUS_DE_CREDITO, $statusDeCredito, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia1('fooValue');   // WHERE nombre_referencia_1 = 'fooValue'
     * $query->filterByNombreReferencia1('%fooValue%'); // WHERE nombre_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia1($nombreReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia1)) {
                $nombreReferencia1 = str_replace('*', '%', $nombreReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::NOMBRE_REFERENCIA_1, $nombreReferencia1, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia2('fooValue');   // WHERE nombre_referencia_2 = 'fooValue'
     * $query->filterByNombreReferencia2('%fooValue%'); // WHERE nombre_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia2($nombreReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia2)) {
                $nombreReferencia2 = str_replace('*', '%', $nombreReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::NOMBRE_REFERENCIA_2, $nombreReferencia2, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia3('fooValue');   // WHERE nombre_referencia_3 = 'fooValue'
     * $query->filterByNombreReferencia3('%fooValue%'); // WHERE nombre_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia3($nombreReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia3)) {
                $nombreReferencia3 = str_replace('*', '%', $nombreReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::NOMBRE_REFERENCIA_3, $nombreReferencia3, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia4('fooValue');   // WHERE nombre_referencia_4 = 'fooValue'
     * $query->filterByNombreReferencia4('%fooValue%'); // WHERE nombre_referencia_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia4($nombreReferencia4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia4)) {
                $nombreReferencia4 = str_replace('*', '%', $nombreReferencia4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::NOMBRE_REFERENCIA_4, $nombreReferencia4, $comparison);
    }

    /**
     * Filter the query on the tel_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1('fooValue');   // WHERE tel_1 = 'fooValue'
     * $query->filterByTel1('%fooValue%'); // WHERE tel_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1($tel1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1)) {
                $tel1 = str_replace('*', '%', $tel1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1, $tel1, $comparison);
    }

    /**
     * Filter the query on the tel_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2('fooValue');   // WHERE tel_2 = 'fooValue'
     * $query->filterByTel2('%fooValue%'); // WHERE tel_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2($tel2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2)) {
                $tel2 = str_replace('*', '%', $tel2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2, $tel2, $comparison);
    }

    /**
     * Filter the query on the tel_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel3('fooValue');   // WHERE tel_3 = 'fooValue'
     * $query->filterByTel3('%fooValue%'); // WHERE tel_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel3($tel3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel3)) {
                $tel3 = str_replace('*', '%', $tel3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_3, $tel3, $comparison);
    }

    /**
     * Filter the query on the tel_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel4('fooValue');   // WHERE tel_4 = 'fooValue'
     * $query->filterByTel4('%fooValue%'); // WHERE tel_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel4($tel4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel4)) {
                $tel4 = str_replace('*', '%', $tel4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_4, $tel4, $comparison);
    }

    /**
     * Filter the query on the tel_1_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Alterno('fooValue');   // WHERE tel_1_alterno = 'fooValue'
     * $query->filterByTel1Alterno('%fooValue%'); // WHERE tel_1_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Alterno($tel1Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Alterno)) {
                $tel1Alterno = str_replace('*', '%', $tel1Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_ALTERNO, $tel1Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_2_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Alterno('fooValue');   // WHERE tel_2_alterno = 'fooValue'
     * $query->filterByTel2Alterno('%fooValue%'); // WHERE tel_2_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Alterno($tel2Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Alterno)) {
                $tel2Alterno = str_replace('*', '%', $tel2Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_ALTERNO, $tel2Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_3_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel3Alterno('fooValue');   // WHERE tel_3_alterno = 'fooValue'
     * $query->filterByTel3Alterno('%fooValue%'); // WHERE tel_3_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel3Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel3Alterno($tel3Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel3Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel3Alterno)) {
                $tel3Alterno = str_replace('*', '%', $tel3Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_3_ALTERNO, $tel3Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_4_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel4Alterno('fooValue');   // WHERE tel_4_alterno = 'fooValue'
     * $query->filterByTel4Alterno('%fooValue%'); // WHERE tel_4_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel4Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel4Alterno($tel4Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel4Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel4Alterno)) {
                $tel4Alterno = str_replace('*', '%', $tel4Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_4_ALTERNO, $tel4Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_1_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Verif('fooValue');   // WHERE tel_1_verif = 'fooValue'
     * $query->filterByTel1Verif('%fooValue%'); // WHERE tel_1_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Verif($tel1Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Verif)) {
                $tel1Verif = str_replace('*', '%', $tel1Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_VERIF, $tel1Verif, $comparison);
    }

    /**
     * Filter the query on the tel_2_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Verif('fooValue');   // WHERE tel_2_verif = 'fooValue'
     * $query->filterByTel2Verif('%fooValue%'); // WHERE tel_2_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Verif($tel2Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Verif)) {
                $tel2Verif = str_replace('*', '%', $tel2Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_VERIF, $tel2Verif, $comparison);
    }

    /**
     * Filter the query on the tel_3_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel3Verif('fooValue');   // WHERE tel_3_verif = 'fooValue'
     * $query->filterByTel3Verif('%fooValue%'); // WHERE tel_3_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel3Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel3Verif($tel3Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel3Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel3Verif)) {
                $tel3Verif = str_replace('*', '%', $tel3Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_3_VERIF, $tel3Verif, $comparison);
    }

    /**
     * Filter the query on the tel_4_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel4Verif('fooValue');   // WHERE tel_4_verif = 'fooValue'
     * $query->filterByTel4Verif('%fooValue%'); // WHERE tel_4_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel4Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel4Verif($tel4Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel4Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel4Verif)) {
                $tel4Verif = str_replace('*', '%', $tel4Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_4_VERIF, $tel4Verif, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref1('fooValue');   // WHERE tel_1_ref_1 = 'fooValue'
     * $query->filterByTel1Ref1('%fooValue%'); // WHERE tel_1_ref_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Ref1($tel1Ref1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref1)) {
                $tel1Ref1 = str_replace('*', '%', $tel1Ref1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_REF_1, $tel1Ref1, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref1('fooValue');   // WHERE tel_2_ref_1 = 'fooValue'
     * $query->filterByTel2Ref1('%fooValue%'); // WHERE tel_2_ref_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Ref1($tel2Ref1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref1)) {
                $tel2Ref1 = str_replace('*', '%', $tel2Ref1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_REF_1, $tel2Ref1, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref2('fooValue');   // WHERE tel_1_ref_2 = 'fooValue'
     * $query->filterByTel1Ref2('%fooValue%'); // WHERE tel_1_ref_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Ref2($tel1Ref2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref2)) {
                $tel1Ref2 = str_replace('*', '%', $tel1Ref2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_REF_2, $tel1Ref2, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref2('fooValue');   // WHERE tel_2_ref_2 = 'fooValue'
     * $query->filterByTel2Ref2('%fooValue%'); // WHERE tel_2_ref_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Ref2($tel2Ref2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref2)) {
                $tel2Ref2 = str_replace('*', '%', $tel2Ref2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_REF_2, $tel2Ref2, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref3('fooValue');   // WHERE tel_1_ref_3 = 'fooValue'
     * $query->filterByTel1Ref3('%fooValue%'); // WHERE tel_1_ref_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Ref3($tel1Ref3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref3)) {
                $tel1Ref3 = str_replace('*', '%', $tel1Ref3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_REF_3, $tel1Ref3, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref3('fooValue');   // WHERE tel_2_ref_3 = 'fooValue'
     * $query->filterByTel2Ref3('%fooValue%'); // WHERE tel_2_ref_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Ref3($tel2Ref3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref3)) {
                $tel2Ref3 = str_replace('*', '%', $tel2Ref3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_REF_3, $tel2Ref3, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref4('fooValue');   // WHERE tel_1_ref_4 = 'fooValue'
     * $query->filterByTel1Ref4('%fooValue%'); // WHERE tel_1_ref_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Ref4($tel1Ref4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref4)) {
                $tel1Ref4 = str_replace('*', '%', $tel1Ref4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_REF_4, $tel1Ref4, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref4('fooValue');   // WHERE tel_2_ref_4 = 'fooValue'
     * $query->filterByTel2Ref4('%fooValue%'); // WHERE tel_2_ref_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Ref4($tel2Ref4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref4)) {
                $tel2Ref4 = str_replace('*', '%', $tel2Ref4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_REF_4, $tel2Ref4, $comparison);
    }

    /**
     * Filter the query on the tel_1_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Laboral('fooValue');   // WHERE tel_1_laboral = 'fooValue'
     * $query->filterByTel1Laboral('%fooValue%'); // WHERE tel_1_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Laboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel1Laboral($tel1Laboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Laboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Laboral)) {
                $tel1Laboral = str_replace('*', '%', $tel1Laboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_1_LABORAL, $tel1Laboral, $comparison);
    }

    /**
     * Filter the query on the tel_2_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Laboral('fooValue');   // WHERE tel_2_laboral = 'fooValue'
     * $query->filterByTel2Laboral('%fooValue%'); // WHERE tel_2_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Laboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTel2Laboral($tel2Laboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Laboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Laboral)) {
                $tel2Laboral = str_replace('*', '%', $tel2Laboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TEL_2_LABORAL, $tel2Laboral, $comparison);
    }

    /**
     * Filter the query on the telefonos_marcados column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonosMarcados('fooValue');   // WHERE telefonos_marcados = 'fooValue'
     * $query->filterByTelefonosMarcados('%fooValue%'); // WHERE telefonos_marcados LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonosMarcados The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function filterByTelefonosMarcados($telefonosMarcados = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonosMarcados)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefonosMarcados)) {
                $telefonosMarcados = str_replace('*', '%', $telefonosMarcados);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RlookPeer::TELEFONOS_MARCADOS, $telefonosMarcados, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Rlook $rlook Object to remove from the list of results
     *
     * @return RlookQuery The current query, for fluid interface
     */
    public function prune($rlook = null)
    {
        if ($rlook) {
            $this->addUsingAlias(RlookPeer::ID_CUENTA, $rlook->getIdCuenta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
