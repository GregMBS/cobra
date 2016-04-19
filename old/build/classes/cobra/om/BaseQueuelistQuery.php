<?php


/**
 * Base class that represents a query for the 'queuelist' table.
 *
 *
 *
 * @method QueuelistQuery orderByAuto($order = Criteria::ASC) Order by the auto column
 * @method QueuelistQuery orderByGestor($order = Criteria::ASC) Order by the gestor column
 * @method QueuelistQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method QueuelistQuery orderByStatusAarsa($order = Criteria::ASC) Order by the status_aarsa column
 * @method QueuelistQuery orderByCamp($order = Criteria::ASC) Order by the camp column
 * @method QueuelistQuery orderByOrden1($order = Criteria::ASC) Order by the orden1 column
 * @method QueuelistQuery orderByUpdown1($order = Criteria::ASC) Order by the updown1 column
 * @method QueuelistQuery orderByOrden2($order = Criteria::ASC) Order by the orden2 column
 * @method QueuelistQuery orderByUpdown2($order = Criteria::ASC) Order by the updown2 column
 * @method QueuelistQuery orderByOrden3($order = Criteria::ASC) Order by the orden3 column
 * @method QueuelistQuery orderByUpdown3($order = Criteria::ASC) Order by the updown3 column
 * @method QueuelistQuery orderBySdc($order = Criteria::ASC) Order by the sdc column
 * @method QueuelistQuery orderByBloqueado($order = Criteria::ASC) Order by the bloqueado column
 *
 * @method QueuelistQuery groupByAuto() Group by the auto column
 * @method QueuelistQuery groupByGestor() Group by the gestor column
 * @method QueuelistQuery groupByCliente() Group by the cliente column
 * @method QueuelistQuery groupByStatusAarsa() Group by the status_aarsa column
 * @method QueuelistQuery groupByCamp() Group by the camp column
 * @method QueuelistQuery groupByOrden1() Group by the orden1 column
 * @method QueuelistQuery groupByUpdown1() Group by the updown1 column
 * @method QueuelistQuery groupByOrden2() Group by the orden2 column
 * @method QueuelistQuery groupByUpdown2() Group by the updown2 column
 * @method QueuelistQuery groupByOrden3() Group by the orden3 column
 * @method QueuelistQuery groupByUpdown3() Group by the updown3 column
 * @method QueuelistQuery groupBySdc() Group by the sdc column
 * @method QueuelistQuery groupByBloqueado() Group by the bloqueado column
 *
 * @method QueuelistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method QueuelistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method QueuelistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Queuelist findOne(PropelPDO $con = null) Return the first Queuelist matching the query
 * @method Queuelist findOneOrCreate(PropelPDO $con = null) Return the first Queuelist matching the query, or a new Queuelist object populated from the query conditions when no match is found
 *
 * @method Queuelist findOneByGestor(string $gestor) Return the first Queuelist filtered by the gestor column
 * @method Queuelist findOneByCliente(string $cliente) Return the first Queuelist filtered by the cliente column
 * @method Queuelist findOneByStatusAarsa(string $status_aarsa) Return the first Queuelist filtered by the status_aarsa column
 * @method Queuelist findOneByCamp(int $camp) Return the first Queuelist filtered by the camp column
 * @method Queuelist findOneByOrden1(string $orden1) Return the first Queuelist filtered by the orden1 column
 * @method Queuelist findOneByUpdown1(boolean $updown1) Return the first Queuelist filtered by the updown1 column
 * @method Queuelist findOneByOrden2(string $orden2) Return the first Queuelist filtered by the orden2 column
 * @method Queuelist findOneByUpdown2(boolean $updown2) Return the first Queuelist filtered by the updown2 column
 * @method Queuelist findOneByOrden3(string $orden3) Return the first Queuelist filtered by the orden3 column
 * @method Queuelist findOneByUpdown3(boolean $updown3) Return the first Queuelist filtered by the updown3 column
 * @method Queuelist findOneBySdc(string $sdc) Return the first Queuelist filtered by the sdc column
 * @method Queuelist findOneByBloqueado(boolean $bloqueado) Return the first Queuelist filtered by the bloqueado column
 *
 * @method array findByAuto(int $auto) Return Queuelist objects filtered by the auto column
 * @method array findByGestor(string $gestor) Return Queuelist objects filtered by the gestor column
 * @method array findByCliente(string $cliente) Return Queuelist objects filtered by the cliente column
 * @method array findByStatusAarsa(string $status_aarsa) Return Queuelist objects filtered by the status_aarsa column
 * @method array findByCamp(int $camp) Return Queuelist objects filtered by the camp column
 * @method array findByOrden1(string $orden1) Return Queuelist objects filtered by the orden1 column
 * @method array findByUpdown1(boolean $updown1) Return Queuelist objects filtered by the updown1 column
 * @method array findByOrden2(string $orden2) Return Queuelist objects filtered by the orden2 column
 * @method array findByUpdown2(boolean $updown2) Return Queuelist objects filtered by the updown2 column
 * @method array findByOrden3(string $orden3) Return Queuelist objects filtered by the orden3 column
 * @method array findByUpdown3(boolean $updown3) Return Queuelist objects filtered by the updown3 column
 * @method array findBySdc(string $sdc) Return Queuelist objects filtered by the sdc column
 * @method array findByBloqueado(boolean $bloqueado) Return Queuelist objects filtered by the bloqueado column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseQueuelistQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseQueuelistQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Queuelist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new QueuelistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   QueuelistQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return QueuelistQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof QueuelistQuery) {
            return $criteria;
        }
        $query = new QueuelistQuery();
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
     * @return   Queuelist|Queuelist[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = QueuelistPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(QueuelistPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Queuelist A model object, or null if the key is not found
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
     * @return                 Queuelist A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `auto`, `gestor`, `cliente`, `status_aarsa`, `camp`, `orden1`, `updown1`, `orden2`, `updown2`, `orden3`, `updown3`, `sdc`, `bloqueado` FROM `queuelist` WHERE `auto` = :p0';
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
            $obj = new Queuelist();
            $obj->hydrate($row);
            QueuelistPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Queuelist|Queuelist[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Queuelist[]|mixed the list of results, formatted by the current formatter
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
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QueuelistPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QueuelistPeer::AUTO, $keys, Criteria::IN);
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
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(QueuelistPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(QueuelistPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QueuelistPeer::AUTO, $auto, $comparison);
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
     * @return QueuelistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(QueuelistPeer::GESTOR, $gestor, $comparison);
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
     * @return QueuelistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(QueuelistPeer::CLIENTE, $cliente, $comparison);
    }

    /**
     * Filter the query on the status_aarsa column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusAarsa('fooValue');   // WHERE status_aarsa = 'fooValue'
     * $query->filterByStatusAarsa('%fooValue%'); // WHERE status_aarsa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusAarsa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByStatusAarsa($statusAarsa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusAarsa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $statusAarsa)) {
                $statusAarsa = str_replace('*', '%', $statusAarsa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(QueuelistPeer::STATUS_AARSA, $statusAarsa, $comparison);
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
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByCamp($camp = null, $comparison = null)
    {
        if (is_array($camp)) {
            $useMinMax = false;
            if (isset($camp['min'])) {
                $this->addUsingAlias(QueuelistPeer::CAMP, $camp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($camp['max'])) {
                $this->addUsingAlias(QueuelistPeer::CAMP, $camp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QueuelistPeer::CAMP, $camp, $comparison);
    }

    /**
     * Filter the query on the orden1 column
     *
     * Example usage:
     * <code>
     * $query->filterByOrden1('fooValue');   // WHERE orden1 = 'fooValue'
     * $query->filterByOrden1('%fooValue%'); // WHERE orden1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $orden1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByOrden1($orden1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orden1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $orden1)) {
                $orden1 = str_replace('*', '%', $orden1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(QueuelistPeer::ORDEN1, $orden1, $comparison);
    }

    /**
     * Filter the query on the updown1 column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdown1(true); // WHERE updown1 = true
     * $query->filterByUpdown1('yes'); // WHERE updown1 = true
     * </code>
     *
     * @param     boolean|string $updown1 The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByUpdown1($updown1 = null, $comparison = null)
    {
        if (is_string($updown1)) {
            $updown1 = in_array(strtolower($updown1), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(QueuelistPeer::UPDOWN1, $updown1, $comparison);
    }

    /**
     * Filter the query on the orden2 column
     *
     * Example usage:
     * <code>
     * $query->filterByOrden2('fooValue');   // WHERE orden2 = 'fooValue'
     * $query->filterByOrden2('%fooValue%'); // WHERE orden2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $orden2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByOrden2($orden2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orden2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $orden2)) {
                $orden2 = str_replace('*', '%', $orden2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(QueuelistPeer::ORDEN2, $orden2, $comparison);
    }

    /**
     * Filter the query on the updown2 column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdown2(true); // WHERE updown2 = true
     * $query->filterByUpdown2('yes'); // WHERE updown2 = true
     * </code>
     *
     * @param     boolean|string $updown2 The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByUpdown2($updown2 = null, $comparison = null)
    {
        if (is_string($updown2)) {
            $updown2 = in_array(strtolower($updown2), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(QueuelistPeer::UPDOWN2, $updown2, $comparison);
    }

    /**
     * Filter the query on the orden3 column
     *
     * Example usage:
     * <code>
     * $query->filterByOrden3('fooValue');   // WHERE orden3 = 'fooValue'
     * $query->filterByOrden3('%fooValue%'); // WHERE orden3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $orden3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByOrden3($orden3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orden3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $orden3)) {
                $orden3 = str_replace('*', '%', $orden3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(QueuelistPeer::ORDEN3, $orden3, $comparison);
    }

    /**
     * Filter the query on the updown3 column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdown3(true); // WHERE updown3 = true
     * $query->filterByUpdown3('yes'); // WHERE updown3 = true
     * </code>
     *
     * @param     boolean|string $updown3 The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByUpdown3($updown3 = null, $comparison = null)
    {
        if (is_string($updown3)) {
            $updown3 = in_array(strtolower($updown3), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(QueuelistPeer::UPDOWN3, $updown3, $comparison);
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
     * @return QueuelistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(QueuelistPeer::SDC, $sdc, $comparison);
    }

    /**
     * Filter the query on the bloqueado column
     *
     * Example usage:
     * <code>
     * $query->filterByBloqueado(true); // WHERE bloqueado = true
     * $query->filterByBloqueado('yes'); // WHERE bloqueado = true
     * </code>
     *
     * @param     boolean|string $bloqueado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function filterByBloqueado($bloqueado = null, $comparison = null)
    {
        if (is_string($bloqueado)) {
            $bloqueado = in_array(strtolower($bloqueado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(QueuelistPeer::BLOQUEADO, $bloqueado, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Queuelist $queuelist Object to remove from the list of results
     *
     * @return QueuelistQuery The current query, for fluid interface
     */
    public function prune($queuelist = null)
    {
        if ($queuelist) {
            $this->addUsingAlias(QueuelistPeer::AUTO, $queuelist->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
