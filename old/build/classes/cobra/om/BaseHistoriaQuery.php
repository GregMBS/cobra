<?php


/**
 * Base class that represents a query for the 'historia' table.
 *
 *
 *
 * @method HistoriaQuery orderByAuto($order = Criteria::ASC) Order by the Auto column
 * @method HistoriaQuery orderByCCvge($order = Criteria::ASC) Order by the C_CVGE column
 * @method HistoriaQuery orderByCCvba($order = Criteria::ASC) Order by the C_CVBA column
 * @method HistoriaQuery orderByCCont($order = Criteria::ASC) Order by the C_CONT column
 * @method HistoriaQuery orderByCCvst($order = Criteria::ASC) Order by the C_CVST column
 * @method HistoriaQuery orderByDFech($order = Criteria::ASC) Order by the D_FECH column
 * @method HistoriaQuery orderByCHrin($order = Criteria::ASC) Order by the C_HRIN column
 * @method HistoriaQuery orderByCHrfi($order = Criteria::ASC) Order by the C_HRFI column
 * @method HistoriaQuery orderByCTele($order = Criteria::ASC) Order by the C_TELE column
 * @method HistoriaQuery orderByCMsge($order = Criteria::ASC) Order by the C_MSGE column
 * @method HistoriaQuery orderByCuenta($order = Criteria::ASC) Order by the CUENTA column
 * @method HistoriaQuery orderByCObse1($order = Criteria::ASC) Order by the C_OBSE1 column
 * @method HistoriaQuery orderByCObse2($order = Criteria::ASC) Order by the C_OBSE2 column
 * @method HistoriaQuery orderByCContan($order = Criteria::ASC) Order by the C_CONTAN column
 * @method HistoriaQuery orderByCNse($order = Criteria::ASC) Order by the C_NSE column
 * @method HistoriaQuery orderByCVisit($order = Criteria::ASC) Order by the C_VISIT column
 * @method HistoriaQuery orderByCAtte($order = Criteria::ASC) Order by the C_ATTE column
 * @method HistoriaQuery orderByCCniv($order = Criteria::ASC) Order by the C_CNIV column
 * @method HistoriaQuery orderByCCarg($order = Criteria::ASC) Order by the C_CARG column
 * @method HistoriaQuery orderByCCfac($order = Criteria::ASC) Order by the C_CFAC column
 * @method HistoriaQuery orderByCCpta($order = Criteria::ASC) Order by the C_CPTA column
 * @method HistoriaQuery orderByCRcon($order = Criteria::ASC) Order by the C_RCON column
 * @method HistoriaQuery orderByAuth($order = Criteria::ASC) Order by the AUTH column
 * @method HistoriaQuery orderByCargado($order = Criteria::ASC) Order by the CARGADO column
 * @method HistoriaQuery orderByCuando($order = Criteria::ASC) Order by the CUANDO column
 * @method HistoriaQuery orderByDProm($order = Criteria::ASC) Order by the D_PROM column
 * @method HistoriaQuery orderByCProm($order = Criteria::ASC) Order by the C_PROM column
 * @method HistoriaQuery orderByNProm($order = Criteria::ASC) Order by the N_PROM column
 * @method HistoriaQuery orderByCCalle1($order = Criteria::ASC) Order by the C_CALLE1 column
 * @method HistoriaQuery orderByCCalle2($order = Criteria::ASC) Order by the C_CALLE2 column
 * @method HistoriaQuery orderByCCnp($order = Criteria::ASC) Order by the C_CNP column
 * @method HistoriaQuery orderByCEmail($order = Criteria::ASC) Order by the C_EMAIL column
 * @method HistoriaQuery orderByCNtel($order = Criteria::ASC) Order by the C_NTEL column
 * @method HistoriaQuery orderByCNdir($order = Criteria::ASC) Order by the C_NDIR column
 * @method HistoriaQuery orderByCFreq($order = Criteria::ASC) Order by the C_FREQ column
 * @method HistoriaQuery orderByCCtipo($order = Criteria::ASC) Order by the C_CTIPO column
 * @method HistoriaQuery orderByCCown($order = Criteria::ASC) Order by the C_COWN column
 * @method HistoriaQuery orderByCCstat($order = Criteria::ASC) Order by the C_CSTAT column
 * @method HistoriaQuery orderByCCrej($order = Criteria::ASC) Order by the C_CREJ column
 * @method HistoriaQuery orderByCCpat($order = Criteria::ASC) Order by the C_CPAT column
 * @method HistoriaQuery orderByCAccion($order = Criteria::ASC) Order by the C_ACCION column
 * @method HistoriaQuery orderByCMotiv($order = Criteria::ASC) Order by the C_MOTIV column
 * @method HistoriaQuery orderByCCamp($order = Criteria::ASC) Order by the C_CAMP column
 * @method HistoriaQuery orderByDProm1($order = Criteria::ASC) Order by the D_PROM1 column
 * @method HistoriaQuery orderByNProm1($order = Criteria::ASC) Order by the N_PROM1 column
 * @method HistoriaQuery orderByDProm2($order = Criteria::ASC) Order by the D_PROM2 column
 * @method HistoriaQuery orderByNProm2($order = Criteria::ASC) Order by the N_PROM2 column
 * @method HistoriaQuery orderByCEje($order = Criteria::ASC) Order by the C_EJE column
 * @method HistoriaQuery orderByError($order = Criteria::ASC) Order by the error column
 *
 * @method HistoriaQuery groupByAuto() Group by the Auto column
 * @method HistoriaQuery groupByCCvge() Group by the C_CVGE column
 * @method HistoriaQuery groupByCCvba() Group by the C_CVBA column
 * @method HistoriaQuery groupByCCont() Group by the C_CONT column
 * @method HistoriaQuery groupByCCvst() Group by the C_CVST column
 * @method HistoriaQuery groupByDFech() Group by the D_FECH column
 * @method HistoriaQuery groupByCHrin() Group by the C_HRIN column
 * @method HistoriaQuery groupByCHrfi() Group by the C_HRFI column
 * @method HistoriaQuery groupByCTele() Group by the C_TELE column
 * @method HistoriaQuery groupByCMsge() Group by the C_MSGE column
 * @method HistoriaQuery groupByCuenta() Group by the CUENTA column
 * @method HistoriaQuery groupByCObse1() Group by the C_OBSE1 column
 * @method HistoriaQuery groupByCObse2() Group by the C_OBSE2 column
 * @method HistoriaQuery groupByCContan() Group by the C_CONTAN column
 * @method HistoriaQuery groupByCNse() Group by the C_NSE column
 * @method HistoriaQuery groupByCVisit() Group by the C_VISIT column
 * @method HistoriaQuery groupByCAtte() Group by the C_ATTE column
 * @method HistoriaQuery groupByCCniv() Group by the C_CNIV column
 * @method HistoriaQuery groupByCCarg() Group by the C_CARG column
 * @method HistoriaQuery groupByCCfac() Group by the C_CFAC column
 * @method HistoriaQuery groupByCCpta() Group by the C_CPTA column
 * @method HistoriaQuery groupByCRcon() Group by the C_RCON column
 * @method HistoriaQuery groupByAuth() Group by the AUTH column
 * @method HistoriaQuery groupByCargado() Group by the CARGADO column
 * @method HistoriaQuery groupByCuando() Group by the CUANDO column
 * @method HistoriaQuery groupByDProm() Group by the D_PROM column
 * @method HistoriaQuery groupByCProm() Group by the C_PROM column
 * @method HistoriaQuery groupByNProm() Group by the N_PROM column
 * @method HistoriaQuery groupByCCalle1() Group by the C_CALLE1 column
 * @method HistoriaQuery groupByCCalle2() Group by the C_CALLE2 column
 * @method HistoriaQuery groupByCCnp() Group by the C_CNP column
 * @method HistoriaQuery groupByCEmail() Group by the C_EMAIL column
 * @method HistoriaQuery groupByCNtel() Group by the C_NTEL column
 * @method HistoriaQuery groupByCNdir() Group by the C_NDIR column
 * @method HistoriaQuery groupByCFreq() Group by the C_FREQ column
 * @method HistoriaQuery groupByCCtipo() Group by the C_CTIPO column
 * @method HistoriaQuery groupByCCown() Group by the C_COWN column
 * @method HistoriaQuery groupByCCstat() Group by the C_CSTAT column
 * @method HistoriaQuery groupByCCrej() Group by the C_CREJ column
 * @method HistoriaQuery groupByCCpat() Group by the C_CPAT column
 * @method HistoriaQuery groupByCAccion() Group by the C_ACCION column
 * @method HistoriaQuery groupByCMotiv() Group by the C_MOTIV column
 * @method HistoriaQuery groupByCCamp() Group by the C_CAMP column
 * @method HistoriaQuery groupByDProm1() Group by the D_PROM1 column
 * @method HistoriaQuery groupByNProm1() Group by the N_PROM1 column
 * @method HistoriaQuery groupByDProm2() Group by the D_PROM2 column
 * @method HistoriaQuery groupByNProm2() Group by the N_PROM2 column
 * @method HistoriaQuery groupByCEje() Group by the C_EJE column
 * @method HistoriaQuery groupByError() Group by the error column
 *
 * @method HistoriaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method HistoriaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method HistoriaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Historia findOne(PropelPDO $con = null) Return the first Historia matching the query
 * @method Historia findOneOrCreate(PropelPDO $con = null) Return the first Historia matching the query, or a new Historia object populated from the query conditions when no match is found
 *
 * @method Historia findOneByCCvge(string $C_CVGE) Return the first Historia filtered by the C_CVGE column
 * @method Historia findOneByCCvba(string $C_CVBA) Return the first Historia filtered by the C_CVBA column
 * @method Historia findOneByCCont(int $C_CONT) Return the first Historia filtered by the C_CONT column
 * @method Historia findOneByCCvst(string $C_CVST) Return the first Historia filtered by the C_CVST column
 * @method Historia findOneByDFech(string $D_FECH) Return the first Historia filtered by the D_FECH column
 * @method Historia findOneByCHrin(string $C_HRIN) Return the first Historia filtered by the C_HRIN column
 * @method Historia findOneByCHrfi(string $C_HRFI) Return the first Historia filtered by the C_HRFI column
 * @method Historia findOneByCTele(string $C_TELE) Return the first Historia filtered by the C_TELE column
 * @method Historia findOneByCMsge(string $C_MSGE) Return the first Historia filtered by the C_MSGE column
 * @method Historia findOneByCuenta(string $CUENTA) Return the first Historia filtered by the CUENTA column
 * @method Historia findOneByCObse1(string $C_OBSE1) Return the first Historia filtered by the C_OBSE1 column
 * @method Historia findOneByCObse2(string $C_OBSE2) Return the first Historia filtered by the C_OBSE2 column
 * @method Historia findOneByCContan(string $C_CONTAN) Return the first Historia filtered by the C_CONTAN column
 * @method Historia findOneByCNse(string $C_NSE) Return the first Historia filtered by the C_NSE column
 * @method Historia findOneByCVisit(string $C_VISIT) Return the first Historia filtered by the C_VISIT column
 * @method Historia findOneByCAtte(string $C_ATTE) Return the first Historia filtered by the C_ATTE column
 * @method Historia findOneByCCniv(string $C_CNIV) Return the first Historia filtered by the C_CNIV column
 * @method Historia findOneByCCarg(string $C_CARG) Return the first Historia filtered by the C_CARG column
 * @method Historia findOneByCCfac(string $C_CFAC) Return the first Historia filtered by the C_CFAC column
 * @method Historia findOneByCCpta(string $C_CPTA) Return the first Historia filtered by the C_CPTA column
 * @method Historia findOneByCRcon(string $C_RCON) Return the first Historia filtered by the C_RCON column
 * @method Historia findOneByAuth(string $AUTH) Return the first Historia filtered by the AUTH column
 * @method Historia findOneByCargado(string $CARGADO) Return the first Historia filtered by the CARGADO column
 * @method Historia findOneByCuando(string $CUANDO) Return the first Historia filtered by the CUANDO column
 * @method Historia findOneByDProm(string $D_PROM) Return the first Historia filtered by the D_PROM column
 * @method Historia findOneByCProm(string $C_PROM) Return the first Historia filtered by the C_PROM column
 * @method Historia findOneByNProm(string $N_PROM) Return the first Historia filtered by the N_PROM column
 * @method Historia findOneByCCalle1(string $C_CALLE1) Return the first Historia filtered by the C_CALLE1 column
 * @method Historia findOneByCCalle2(string $C_CALLE2) Return the first Historia filtered by the C_CALLE2 column
 * @method Historia findOneByCCnp(string $C_CNP) Return the first Historia filtered by the C_CNP column
 * @method Historia findOneByCEmail(string $C_EMAIL) Return the first Historia filtered by the C_EMAIL column
 * @method Historia findOneByCNtel(string $C_NTEL) Return the first Historia filtered by the C_NTEL column
 * @method Historia findOneByCNdir(string $C_NDIR) Return the first Historia filtered by the C_NDIR column
 * @method Historia findOneByCFreq(string $C_FREQ) Return the first Historia filtered by the C_FREQ column
 * @method Historia findOneByCCtipo(string $C_CTIPO) Return the first Historia filtered by the C_CTIPO column
 * @method Historia findOneByCCown(string $C_COWN) Return the first Historia filtered by the C_COWN column
 * @method Historia findOneByCCstat(string $C_CSTAT) Return the first Historia filtered by the C_CSTAT column
 * @method Historia findOneByCCrej(string $C_CREJ) Return the first Historia filtered by the C_CREJ column
 * @method Historia findOneByCCpat(string $C_CPAT) Return the first Historia filtered by the C_CPAT column
 * @method Historia findOneByCAccion(string $C_ACCION) Return the first Historia filtered by the C_ACCION column
 * @method Historia findOneByCMotiv(string $C_MOTIV) Return the first Historia filtered by the C_MOTIV column
 * @method Historia findOneByCCamp(string $C_CAMP) Return the first Historia filtered by the C_CAMP column
 * @method Historia findOneByDProm1(string $D_PROM1) Return the first Historia filtered by the D_PROM1 column
 * @method Historia findOneByNProm1(string $N_PROM1) Return the first Historia filtered by the N_PROM1 column
 * @method Historia findOneByDProm2(string $D_PROM2) Return the first Historia filtered by the D_PROM2 column
 * @method Historia findOneByNProm2(string $N_PROM2) Return the first Historia filtered by the N_PROM2 column
 * @method Historia findOneByCEje(string $C_EJE) Return the first Historia filtered by the C_EJE column
 * @method Historia findOneByError(int $error) Return the first Historia filtered by the error column
 *
 * @method array findByAuto(int $Auto) Return Historia objects filtered by the Auto column
 * @method array findByCCvge(string $C_CVGE) Return Historia objects filtered by the C_CVGE column
 * @method array findByCCvba(string $C_CVBA) Return Historia objects filtered by the C_CVBA column
 * @method array findByCCont(int $C_CONT) Return Historia objects filtered by the C_CONT column
 * @method array findByCCvst(string $C_CVST) Return Historia objects filtered by the C_CVST column
 * @method array findByDFech(string $D_FECH) Return Historia objects filtered by the D_FECH column
 * @method array findByCHrin(string $C_HRIN) Return Historia objects filtered by the C_HRIN column
 * @method array findByCHrfi(string $C_HRFI) Return Historia objects filtered by the C_HRFI column
 * @method array findByCTele(string $C_TELE) Return Historia objects filtered by the C_TELE column
 * @method array findByCMsge(string $C_MSGE) Return Historia objects filtered by the C_MSGE column
 * @method array findByCuenta(string $CUENTA) Return Historia objects filtered by the CUENTA column
 * @method array findByCObse1(string $C_OBSE1) Return Historia objects filtered by the C_OBSE1 column
 * @method array findByCObse2(string $C_OBSE2) Return Historia objects filtered by the C_OBSE2 column
 * @method array findByCContan(string $C_CONTAN) Return Historia objects filtered by the C_CONTAN column
 * @method array findByCNse(string $C_NSE) Return Historia objects filtered by the C_NSE column
 * @method array findByCVisit(string $C_VISIT) Return Historia objects filtered by the C_VISIT column
 * @method array findByCAtte(string $C_ATTE) Return Historia objects filtered by the C_ATTE column
 * @method array findByCCniv(string $C_CNIV) Return Historia objects filtered by the C_CNIV column
 * @method array findByCCarg(string $C_CARG) Return Historia objects filtered by the C_CARG column
 * @method array findByCCfac(string $C_CFAC) Return Historia objects filtered by the C_CFAC column
 * @method array findByCCpta(string $C_CPTA) Return Historia objects filtered by the C_CPTA column
 * @method array findByCRcon(string $C_RCON) Return Historia objects filtered by the C_RCON column
 * @method array findByAuth(string $AUTH) Return Historia objects filtered by the AUTH column
 * @method array findByCargado(string $CARGADO) Return Historia objects filtered by the CARGADO column
 * @method array findByCuando(string $CUANDO) Return Historia objects filtered by the CUANDO column
 * @method array findByDProm(string $D_PROM) Return Historia objects filtered by the D_PROM column
 * @method array findByCProm(string $C_PROM) Return Historia objects filtered by the C_PROM column
 * @method array findByNProm(string $N_PROM) Return Historia objects filtered by the N_PROM column
 * @method array findByCCalle1(string $C_CALLE1) Return Historia objects filtered by the C_CALLE1 column
 * @method array findByCCalle2(string $C_CALLE2) Return Historia objects filtered by the C_CALLE2 column
 * @method array findByCCnp(string $C_CNP) Return Historia objects filtered by the C_CNP column
 * @method array findByCEmail(string $C_EMAIL) Return Historia objects filtered by the C_EMAIL column
 * @method array findByCNtel(string $C_NTEL) Return Historia objects filtered by the C_NTEL column
 * @method array findByCNdir(string $C_NDIR) Return Historia objects filtered by the C_NDIR column
 * @method array findByCFreq(string $C_FREQ) Return Historia objects filtered by the C_FREQ column
 * @method array findByCCtipo(string $C_CTIPO) Return Historia objects filtered by the C_CTIPO column
 * @method array findByCCown(string $C_COWN) Return Historia objects filtered by the C_COWN column
 * @method array findByCCstat(string $C_CSTAT) Return Historia objects filtered by the C_CSTAT column
 * @method array findByCCrej(string $C_CREJ) Return Historia objects filtered by the C_CREJ column
 * @method array findByCCpat(string $C_CPAT) Return Historia objects filtered by the C_CPAT column
 * @method array findByCAccion(string $C_ACCION) Return Historia objects filtered by the C_ACCION column
 * @method array findByCMotiv(string $C_MOTIV) Return Historia objects filtered by the C_MOTIV column
 * @method array findByCCamp(string $C_CAMP) Return Historia objects filtered by the C_CAMP column
 * @method array findByDProm1(string $D_PROM1) Return Historia objects filtered by the D_PROM1 column
 * @method array findByNProm1(string $N_PROM1) Return Historia objects filtered by the N_PROM1 column
 * @method array findByDProm2(string $D_PROM2) Return Historia objects filtered by the D_PROM2 column
 * @method array findByNProm2(string $N_PROM2) Return Historia objects filtered by the N_PROM2 column
 * @method array findByCEje(string $C_EJE) Return Historia objects filtered by the C_EJE column
 * @method array findByError(int $error) Return Historia objects filtered by the error column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseHistoriaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseHistoriaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Historia', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new HistoriaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   HistoriaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return HistoriaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof HistoriaQuery) {
            return $criteria;
        }
        $query = new HistoriaQuery();
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
     * @return   Historia|Historia[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = HistoriaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(HistoriaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Historia A model object, or null if the key is not found
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
     * @return                 Historia A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `Auto`, `C_CVGE`, `C_CVBA`, `C_CONT`, `C_CVST`, `D_FECH`, `C_HRIN`, `C_HRFI`, `C_TELE`, `C_MSGE`, `CUENTA`, `C_OBSE1`, `C_OBSE2`, `C_CONTAN`, `C_NSE`, `C_VISIT`, `C_ATTE`, `C_CNIV`, `C_CARG`, `C_CFAC`, `C_CPTA`, `C_RCON`, `AUTH`, `CARGADO`, `CUANDO`, `D_PROM`, `C_PROM`, `N_PROM`, `C_CALLE1`, `C_CALLE2`, `C_CNP`, `C_EMAIL`, `C_NTEL`, `C_NDIR`, `C_FREQ`, `C_CTIPO`, `C_COWN`, `C_CSTAT`, `C_CREJ`, `C_CPAT`, `C_ACCION`, `C_MOTIV`, `C_CAMP`, `D_PROM1`, `N_PROM1`, `D_PROM2`, `N_PROM2`, `C_EJE`, `error` FROM `historia` WHERE `Auto` = :p0';
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
            $obj = new Historia();
            $obj->hydrate($row);
            HistoriaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Historia|Historia[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Historia[]|mixed the list of results, formatted by the current formatter
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
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HistoriaPeer::AUTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HistoriaPeer::AUTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the Auto column
     *
     * Example usage:
     * <code>
     * $query->filterByAuto(1234); // WHERE Auto = 1234
     * $query->filterByAuto(array(12, 34)); // WHERE Auto IN (12, 34)
     * $query->filterByAuto(array('min' => 12)); // WHERE Auto >= 12
     * $query->filterByAuto(array('max' => 12)); // WHERE Auto <= 12
     * </code>
     *
     * @param     mixed $auto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (is_array($auto)) {
            $useMinMax = false;
            if (isset($auto['min'])) {
                $this->addUsingAlias(HistoriaPeer::AUTO, $auto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auto['max'])) {
                $this->addUsingAlias(HistoriaPeer::AUTO, $auto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the C_CVGE column
     *
     * Example usage:
     * <code>
     * $query->filterByCCvge('fooValue');   // WHERE C_CVGE = 'fooValue'
     * $query->filterByCCvge('%fooValue%'); // WHERE C_CVGE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCvge The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(HistoriaPeer::C_CVGE, $cCvge, $comparison);
    }

    /**
     * Filter the query on the C_CVBA column
     *
     * Example usage:
     * <code>
     * $query->filterByCCvba('fooValue');   // WHERE C_CVBA = 'fooValue'
     * $query->filterByCCvba('%fooValue%'); // WHERE C_CVBA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCvba The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCvba($cCvba = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCvba)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCvba)) {
                $cCvba = str_replace('*', '%', $cCvba);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CVBA, $cCvba, $comparison);
    }

    /**
     * Filter the query on the C_CONT column
     *
     * Example usage:
     * <code>
     * $query->filterByCCont(1234); // WHERE C_CONT = 1234
     * $query->filterByCCont(array(12, 34)); // WHERE C_CONT IN (12, 34)
     * $query->filterByCCont(array('min' => 12)); // WHERE C_CONT >= 12
     * $query->filterByCCont(array('max' => 12)); // WHERE C_CONT <= 12
     * </code>
     *
     * @param     mixed $cCont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCont($cCont = null, $comparison = null)
    {
        if (is_array($cCont)) {
            $useMinMax = false;
            if (isset($cCont['min'])) {
                $this->addUsingAlias(HistoriaPeer::C_CONT, $cCont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cCont['max'])) {
                $this->addUsingAlias(HistoriaPeer::C_CONT, $cCont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CONT, $cCont, $comparison);
    }

    /**
     * Filter the query on the C_CVST column
     *
     * Example usage:
     * <code>
     * $query->filterByCCvst('fooValue');   // WHERE C_CVST = 'fooValue'
     * $query->filterByCCvst('%fooValue%'); // WHERE C_CVST LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCvst The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCvst($cCvst = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCvst)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCvst)) {
                $cCvst = str_replace('*', '%', $cCvst);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CVST, $cCvst, $comparison);
    }

    /**
     * Filter the query on the D_FECH column
     *
     * Example usage:
     * <code>
     * $query->filterByDFech('2011-03-14'); // WHERE D_FECH = '2011-03-14'
     * $query->filterByDFech('now'); // WHERE D_FECH = '2011-03-14'
     * $query->filterByDFech(array('max' => 'yesterday')); // WHERE D_FECH > '2011-03-13'
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
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByDFech($dFech = null, $comparison = null)
    {
        if (is_array($dFech)) {
            $useMinMax = false;
            if (isset($dFech['min'])) {
                $this->addUsingAlias(HistoriaPeer::D_FECH, $dFech['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dFech['max'])) {
                $this->addUsingAlias(HistoriaPeer::D_FECH, $dFech['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::D_FECH, $dFech, $comparison);
    }

    /**
     * Filter the query on the C_HRIN column
     *
     * Example usage:
     * <code>
     * $query->filterByCHrin('2011-03-14'); // WHERE C_HRIN = '2011-03-14'
     * $query->filterByCHrin('now'); // WHERE C_HRIN = '2011-03-14'
     * $query->filterByCHrin(array('max' => 'yesterday')); // WHERE C_HRIN > '2011-03-13'
     * </code>
     *
     * @param     mixed $cHrin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCHrin($cHrin = null, $comparison = null)
    {
        if (is_array($cHrin)) {
            $useMinMax = false;
            if (isset($cHrin['min'])) {
                $this->addUsingAlias(HistoriaPeer::C_HRIN, $cHrin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cHrin['max'])) {
                $this->addUsingAlias(HistoriaPeer::C_HRIN, $cHrin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_HRIN, $cHrin, $comparison);
    }

    /**
     * Filter the query on the C_HRFI column
     *
     * Example usage:
     * <code>
     * $query->filterByCHrfi('2011-03-14'); // WHERE C_HRFI = '2011-03-14'
     * $query->filterByCHrfi('now'); // WHERE C_HRFI = '2011-03-14'
     * $query->filterByCHrfi(array('max' => 'yesterday')); // WHERE C_HRFI > '2011-03-13'
     * </code>
     *
     * @param     mixed $cHrfi The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCHrfi($cHrfi = null, $comparison = null)
    {
        if (is_array($cHrfi)) {
            $useMinMax = false;
            if (isset($cHrfi['min'])) {
                $this->addUsingAlias(HistoriaPeer::C_HRFI, $cHrfi['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cHrfi['max'])) {
                $this->addUsingAlias(HistoriaPeer::C_HRFI, $cHrfi['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_HRFI, $cHrfi, $comparison);
    }

    /**
     * Filter the query on the C_TELE column
     *
     * Example usage:
     * <code>
     * $query->filterByCTele('fooValue');   // WHERE C_TELE = 'fooValue'
     * $query->filterByCTele('%fooValue%'); // WHERE C_TELE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cTele The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCTele($cTele = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cTele)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cTele)) {
                $cTele = str_replace('*', '%', $cTele);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_TELE, $cTele, $comparison);
    }

    /**
     * Filter the query on the C_MSGE column
     *
     * Example usage:
     * <code>
     * $query->filterByCMsge('fooValue');   // WHERE C_MSGE = 'fooValue'
     * $query->filterByCMsge('%fooValue%'); // WHERE C_MSGE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cMsge The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCMsge($cMsge = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cMsge)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cMsge)) {
                $cMsge = str_replace('*', '%', $cMsge);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_MSGE, $cMsge, $comparison);
    }

    /**
     * Filter the query on the CUENTA column
     *
     * Example usage:
     * <code>
     * $query->filterByCuenta('fooValue');   // WHERE CUENTA = 'fooValue'
     * $query->filterByCuenta('%fooValue%'); // WHERE CUENTA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(HistoriaPeer::CUENTA, $cuenta, $comparison);
    }

    /**
     * Filter the query on the C_OBSE1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCObse1('fooValue');   // WHERE C_OBSE1 = 'fooValue'
     * $query->filterByCObse1('%fooValue%'); // WHERE C_OBSE1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cObse1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCObse1($cObse1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cObse1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cObse1)) {
                $cObse1 = str_replace('*', '%', $cObse1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_OBSE1, $cObse1, $comparison);
    }

    /**
     * Filter the query on the C_OBSE2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCObse2('fooValue');   // WHERE C_OBSE2 = 'fooValue'
     * $query->filterByCObse2('%fooValue%'); // WHERE C_OBSE2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cObse2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCObse2($cObse2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cObse2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cObse2)) {
                $cObse2 = str_replace('*', '%', $cObse2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_OBSE2, $cObse2, $comparison);
    }

    /**
     * Filter the query on the C_CONTAN column
     *
     * Example usage:
     * <code>
     * $query->filterByCContan('fooValue');   // WHERE C_CONTAN = 'fooValue'
     * $query->filterByCContan('%fooValue%'); // WHERE C_CONTAN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cContan The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCContan($cContan = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cContan)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cContan)) {
                $cContan = str_replace('*', '%', $cContan);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CONTAN, $cContan, $comparison);
    }

    /**
     * Filter the query on the C_NSE column
     *
     * Example usage:
     * <code>
     * $query->filterByCNse('fooValue');   // WHERE C_NSE = 'fooValue'
     * $query->filterByCNse('%fooValue%'); // WHERE C_NSE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cNse The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCNse($cNse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cNse)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cNse)) {
                $cNse = str_replace('*', '%', $cNse);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_NSE, $cNse, $comparison);
    }

    /**
     * Filter the query on the C_VISIT column
     *
     * Example usage:
     * <code>
     * $query->filterByCVisit('fooValue');   // WHERE C_VISIT = 'fooValue'
     * $query->filterByCVisit('%fooValue%'); // WHERE C_VISIT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cVisit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCVisit($cVisit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cVisit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cVisit)) {
                $cVisit = str_replace('*', '%', $cVisit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_VISIT, $cVisit, $comparison);
    }

    /**
     * Filter the query on the C_ATTE column
     *
     * Example usage:
     * <code>
     * $query->filterByCAtte('fooValue');   // WHERE C_ATTE = 'fooValue'
     * $query->filterByCAtte('%fooValue%'); // WHERE C_ATTE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cAtte The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCAtte($cAtte = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cAtte)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cAtte)) {
                $cAtte = str_replace('*', '%', $cAtte);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_ATTE, $cAtte, $comparison);
    }

    /**
     * Filter the query on the C_CNIV column
     *
     * Example usage:
     * <code>
     * $query->filterByCCniv('fooValue');   // WHERE C_CNIV = 'fooValue'
     * $query->filterByCCniv('%fooValue%'); // WHERE C_CNIV LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCniv The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCniv($cCniv = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCniv)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCniv)) {
                $cCniv = str_replace('*', '%', $cCniv);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CNIV, $cCniv, $comparison);
    }

    /**
     * Filter the query on the C_CARG column
     *
     * Example usage:
     * <code>
     * $query->filterByCCarg('fooValue');   // WHERE C_CARG = 'fooValue'
     * $query->filterByCCarg('%fooValue%'); // WHERE C_CARG LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCarg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCarg($cCarg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCarg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCarg)) {
                $cCarg = str_replace('*', '%', $cCarg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CARG, $cCarg, $comparison);
    }

    /**
     * Filter the query on the C_CFAC column
     *
     * Example usage:
     * <code>
     * $query->filterByCCfac('fooValue');   // WHERE C_CFAC = 'fooValue'
     * $query->filterByCCfac('%fooValue%'); // WHERE C_CFAC LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCfac The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCfac($cCfac = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCfac)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCfac)) {
                $cCfac = str_replace('*', '%', $cCfac);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CFAC, $cCfac, $comparison);
    }

    /**
     * Filter the query on the C_CPTA column
     *
     * Example usage:
     * <code>
     * $query->filterByCCpta('fooValue');   // WHERE C_CPTA = 'fooValue'
     * $query->filterByCCpta('%fooValue%'); // WHERE C_CPTA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCpta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCpta($cCpta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCpta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCpta)) {
                $cCpta = str_replace('*', '%', $cCpta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CPTA, $cCpta, $comparison);
    }

    /**
     * Filter the query on the C_RCON column
     *
     * Example usage:
     * <code>
     * $query->filterByCRcon('fooValue');   // WHERE C_RCON = 'fooValue'
     * $query->filterByCRcon('%fooValue%'); // WHERE C_RCON LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cRcon The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCRcon($cRcon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cRcon)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cRcon)) {
                $cRcon = str_replace('*', '%', $cRcon);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_RCON, $cRcon, $comparison);
    }

    /**
     * Filter the query on the AUTH column
     *
     * Example usage:
     * <code>
     * $query->filterByAuth('fooValue');   // WHERE AUTH = 'fooValue'
     * $query->filterByAuth('%fooValue%'); // WHERE AUTH LIKE '%fooValue%'
     * </code>
     *
     * @param     string $auth The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByAuth($auth = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($auth)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $auth)) {
                $auth = str_replace('*', '%', $auth);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::AUTH, $auth, $comparison);
    }

    /**
     * Filter the query on the CARGADO column
     *
     * Example usage:
     * <code>
     * $query->filterByCargado('fooValue');   // WHERE CARGADO = 'fooValue'
     * $query->filterByCargado('%fooValue%'); // WHERE CARGADO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cargado The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCargado($cargado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cargado)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cargado)) {
                $cargado = str_replace('*', '%', $cargado);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::CARGADO, $cargado, $comparison);
    }

    /**
     * Filter the query on the CUANDO column
     *
     * Example usage:
     * <code>
     * $query->filterByCuando('fooValue');   // WHERE CUANDO = 'fooValue'
     * $query->filterByCuando('%fooValue%'); // WHERE CUANDO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuando The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCuando($cuando = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuando)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuando)) {
                $cuando = str_replace('*', '%', $cuando);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::CUANDO, $cuando, $comparison);
    }

    /**
     * Filter the query on the D_PROM column
     *
     * Example usage:
     * <code>
     * $query->filterByDProm('2011-03-14'); // WHERE D_PROM = '2011-03-14'
     * $query->filterByDProm('now'); // WHERE D_PROM = '2011-03-14'
     * $query->filterByDProm(array('max' => 'yesterday')); // WHERE D_PROM > '2011-03-13'
     * </code>
     *
     * @param     mixed $dProm The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByDProm($dProm = null, $comparison = null)
    {
        if (is_array($dProm)) {
            $useMinMax = false;
            if (isset($dProm['min'])) {
                $this->addUsingAlias(HistoriaPeer::D_PROM, $dProm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dProm['max'])) {
                $this->addUsingAlias(HistoriaPeer::D_PROM, $dProm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::D_PROM, $dProm, $comparison);
    }

    /**
     * Filter the query on the C_PROM column
     *
     * Example usage:
     * <code>
     * $query->filterByCProm('fooValue');   // WHERE C_PROM = 'fooValue'
     * $query->filterByCProm('%fooValue%'); // WHERE C_PROM LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cProm The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(HistoriaPeer::C_PROM, $cProm, $comparison);
    }

    /**
     * Filter the query on the N_PROM column
     *
     * Example usage:
     * <code>
     * $query->filterByNProm(1234); // WHERE N_PROM = 1234
     * $query->filterByNProm(array(12, 34)); // WHERE N_PROM IN (12, 34)
     * $query->filterByNProm(array('min' => 12)); // WHERE N_PROM >= 12
     * $query->filterByNProm(array('max' => 12)); // WHERE N_PROM <= 12
     * </code>
     *
     * @param     mixed $nProm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByNProm($nProm = null, $comparison = null)
    {
        if (is_array($nProm)) {
            $useMinMax = false;
            if (isset($nProm['min'])) {
                $this->addUsingAlias(HistoriaPeer::N_PROM, $nProm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nProm['max'])) {
                $this->addUsingAlias(HistoriaPeer::N_PROM, $nProm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::N_PROM, $nProm, $comparison);
    }

    /**
     * Filter the query on the C_CALLE1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCCalle1('fooValue');   // WHERE C_CALLE1 = 'fooValue'
     * $query->filterByCCalle1('%fooValue%'); // WHERE C_CALLE1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCalle1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCalle1($cCalle1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCalle1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCalle1)) {
                $cCalle1 = str_replace('*', '%', $cCalle1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CALLE1, $cCalle1, $comparison);
    }

    /**
     * Filter the query on the C_CALLE2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCCalle2('fooValue');   // WHERE C_CALLE2 = 'fooValue'
     * $query->filterByCCalle2('%fooValue%'); // WHERE C_CALLE2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCalle2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCalle2($cCalle2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCalle2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCalle2)) {
                $cCalle2 = str_replace('*', '%', $cCalle2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CALLE2, $cCalle2, $comparison);
    }

    /**
     * Filter the query on the C_CNP column
     *
     * Example usage:
     * <code>
     * $query->filterByCCnp('fooValue');   // WHERE C_CNP = 'fooValue'
     * $query->filterByCCnp('%fooValue%'); // WHERE C_CNP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCnp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCnp($cCnp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCnp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCnp)) {
                $cCnp = str_replace('*', '%', $cCnp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CNP, $cCnp, $comparison);
    }

    /**
     * Filter the query on the C_EMAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByCEmail('fooValue');   // WHERE C_EMAIL = 'fooValue'
     * $query->filterByCEmail('%fooValue%'); // WHERE C_EMAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCEmail($cEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cEmail)) {
                $cEmail = str_replace('*', '%', $cEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_EMAIL, $cEmail, $comparison);
    }

    /**
     * Filter the query on the C_NTEL column
     *
     * Example usage:
     * <code>
     * $query->filterByCNtel('fooValue');   // WHERE C_NTEL = 'fooValue'
     * $query->filterByCNtel('%fooValue%'); // WHERE C_NTEL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cNtel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCNtel($cNtel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cNtel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cNtel)) {
                $cNtel = str_replace('*', '%', $cNtel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_NTEL, $cNtel, $comparison);
    }

    /**
     * Filter the query on the C_NDIR column
     *
     * Example usage:
     * <code>
     * $query->filterByCNdir('fooValue');   // WHERE C_NDIR = 'fooValue'
     * $query->filterByCNdir('%fooValue%'); // WHERE C_NDIR LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cNdir The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCNdir($cNdir = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cNdir)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cNdir)) {
                $cNdir = str_replace('*', '%', $cNdir);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_NDIR, $cNdir, $comparison);
    }

    /**
     * Filter the query on the C_FREQ column
     *
     * Example usage:
     * <code>
     * $query->filterByCFreq('fooValue');   // WHERE C_FREQ = 'fooValue'
     * $query->filterByCFreq('%fooValue%'); // WHERE C_FREQ LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cFreq The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(HistoriaPeer::C_FREQ, $cFreq, $comparison);
    }

    /**
     * Filter the query on the C_CTIPO column
     *
     * Example usage:
     * <code>
     * $query->filterByCCtipo('fooValue');   // WHERE C_CTIPO = 'fooValue'
     * $query->filterByCCtipo('%fooValue%'); // WHERE C_CTIPO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCtipo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCtipo($cCtipo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCtipo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCtipo)) {
                $cCtipo = str_replace('*', '%', $cCtipo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CTIPO, $cCtipo, $comparison);
    }

    /**
     * Filter the query on the C_COWN column
     *
     * Example usage:
     * <code>
     * $query->filterByCCown('fooValue');   // WHERE C_COWN = 'fooValue'
     * $query->filterByCCown('%fooValue%'); // WHERE C_COWN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCown The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCown($cCown = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCown)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCown)) {
                $cCown = str_replace('*', '%', $cCown);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_COWN, $cCown, $comparison);
    }

    /**
     * Filter the query on the C_CSTAT column
     *
     * Example usage:
     * <code>
     * $query->filterByCCstat('fooValue');   // WHERE C_CSTAT = 'fooValue'
     * $query->filterByCCstat('%fooValue%'); // WHERE C_CSTAT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCstat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCstat($cCstat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCstat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCstat)) {
                $cCstat = str_replace('*', '%', $cCstat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CSTAT, $cCstat, $comparison);
    }

    /**
     * Filter the query on the C_CREJ column
     *
     * Example usage:
     * <code>
     * $query->filterByCCrej('fooValue');   // WHERE C_CREJ = 'fooValue'
     * $query->filterByCCrej('%fooValue%'); // WHERE C_CREJ LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCrej The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCrej($cCrej = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCrej)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCrej)) {
                $cCrej = str_replace('*', '%', $cCrej);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CREJ, $cCrej, $comparison);
    }

    /**
     * Filter the query on the C_CPAT column
     *
     * Example usage:
     * <code>
     * $query->filterByCCpat('fooValue');   // WHERE C_CPAT = 'fooValue'
     * $query->filterByCCpat('%fooValue%'); // WHERE C_CPAT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCpat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCpat($cCpat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCpat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCpat)) {
                $cCpat = str_replace('*', '%', $cCpat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CPAT, $cCpat, $comparison);
    }

    /**
     * Filter the query on the C_ACCION column
     *
     * Example usage:
     * <code>
     * $query->filterByCAccion('fooValue');   // WHERE C_ACCION = 'fooValue'
     * $query->filterByCAccion('%fooValue%'); // WHERE C_ACCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cAccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCAccion($cAccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cAccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cAccion)) {
                $cAccion = str_replace('*', '%', $cAccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_ACCION, $cAccion, $comparison);
    }

    /**
     * Filter the query on the C_MOTIV column
     *
     * Example usage:
     * <code>
     * $query->filterByCMotiv('fooValue');   // WHERE C_MOTIV = 'fooValue'
     * $query->filterByCMotiv('%fooValue%'); // WHERE C_MOTIV LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cMotiv The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCMotiv($cMotiv = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cMotiv)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cMotiv)) {
                $cMotiv = str_replace('*', '%', $cMotiv);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_MOTIV, $cMotiv, $comparison);
    }

    /**
     * Filter the query on the C_CAMP column
     *
     * Example usage:
     * <code>
     * $query->filterByCCamp('fooValue');   // WHERE C_CAMP = 'fooValue'
     * $query->filterByCCamp('%fooValue%'); // WHERE C_CAMP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cCamp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCCamp($cCamp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cCamp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cCamp)) {
                $cCamp = str_replace('*', '%', $cCamp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_CAMP, $cCamp, $comparison);
    }

    /**
     * Filter the query on the D_PROM1 column
     *
     * Example usage:
     * <code>
     * $query->filterByDProm1('2011-03-14'); // WHERE D_PROM1 = '2011-03-14'
     * $query->filterByDProm1('now'); // WHERE D_PROM1 = '2011-03-14'
     * $query->filterByDProm1(array('max' => 'yesterday')); // WHERE D_PROM1 > '2011-03-13'
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
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByDProm1($dProm1 = null, $comparison = null)
    {
        if (is_array($dProm1)) {
            $useMinMax = false;
            if (isset($dProm1['min'])) {
                $this->addUsingAlias(HistoriaPeer::D_PROM1, $dProm1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dProm1['max'])) {
                $this->addUsingAlias(HistoriaPeer::D_PROM1, $dProm1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::D_PROM1, $dProm1, $comparison);
    }

    /**
     * Filter the query on the N_PROM1 column
     *
     * Example usage:
     * <code>
     * $query->filterByNProm1(1234); // WHERE N_PROM1 = 1234
     * $query->filterByNProm1(array(12, 34)); // WHERE N_PROM1 IN (12, 34)
     * $query->filterByNProm1(array('min' => 12)); // WHERE N_PROM1 >= 12
     * $query->filterByNProm1(array('max' => 12)); // WHERE N_PROM1 <= 12
     * </code>
     *
     * @param     mixed $nProm1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByNProm1($nProm1 = null, $comparison = null)
    {
        if (is_array($nProm1)) {
            $useMinMax = false;
            if (isset($nProm1['min'])) {
                $this->addUsingAlias(HistoriaPeer::N_PROM1, $nProm1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nProm1['max'])) {
                $this->addUsingAlias(HistoriaPeer::N_PROM1, $nProm1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::N_PROM1, $nProm1, $comparison);
    }

    /**
     * Filter the query on the D_PROM2 column
     *
     * Example usage:
     * <code>
     * $query->filterByDProm2('2011-03-14'); // WHERE D_PROM2 = '2011-03-14'
     * $query->filterByDProm2('now'); // WHERE D_PROM2 = '2011-03-14'
     * $query->filterByDProm2(array('max' => 'yesterday')); // WHERE D_PROM2 > '2011-03-13'
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
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByDProm2($dProm2 = null, $comparison = null)
    {
        if (is_array($dProm2)) {
            $useMinMax = false;
            if (isset($dProm2['min'])) {
                $this->addUsingAlias(HistoriaPeer::D_PROM2, $dProm2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dProm2['max'])) {
                $this->addUsingAlias(HistoriaPeer::D_PROM2, $dProm2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::D_PROM2, $dProm2, $comparison);
    }

    /**
     * Filter the query on the N_PROM2 column
     *
     * Example usage:
     * <code>
     * $query->filterByNProm2(1234); // WHERE N_PROM2 = 1234
     * $query->filterByNProm2(array(12, 34)); // WHERE N_PROM2 IN (12, 34)
     * $query->filterByNProm2(array('min' => 12)); // WHERE N_PROM2 >= 12
     * $query->filterByNProm2(array('max' => 12)); // WHERE N_PROM2 <= 12
     * </code>
     *
     * @param     mixed $nProm2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByNProm2($nProm2 = null, $comparison = null)
    {
        if (is_array($nProm2)) {
            $useMinMax = false;
            if (isset($nProm2['min'])) {
                $this->addUsingAlias(HistoriaPeer::N_PROM2, $nProm2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nProm2['max'])) {
                $this->addUsingAlias(HistoriaPeer::N_PROM2, $nProm2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::N_PROM2, $nProm2, $comparison);
    }

    /**
     * Filter the query on the C_EJE column
     *
     * Example usage:
     * <code>
     * $query->filterByCEje('fooValue');   // WHERE C_EJE = 'fooValue'
     * $query->filterByCEje('%fooValue%'); // WHERE C_EJE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cEje The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByCEje($cEje = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cEje)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cEje)) {
                $cEje = str_replace('*', '%', $cEje);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::C_EJE, $cEje, $comparison);
    }

    /**
     * Filter the query on the error column
     *
     * Example usage:
     * <code>
     * $query->filterByError(1234); // WHERE error = 1234
     * $query->filterByError(array(12, 34)); // WHERE error IN (12, 34)
     * $query->filterByError(array('min' => 12)); // WHERE error >= 12
     * $query->filterByError(array('max' => 12)); // WHERE error <= 12
     * </code>
     *
     * @param     mixed $error The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function filterByError($error = null, $comparison = null)
    {
        if (is_array($error)) {
            $useMinMax = false;
            if (isset($error['min'])) {
                $this->addUsingAlias(HistoriaPeer::ERROR, $error['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($error['max'])) {
                $this->addUsingAlias(HistoriaPeer::ERROR, $error['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HistoriaPeer::ERROR, $error, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Historia $historia Object to remove from the list of results
     *
     * @return HistoriaQuery The current query, for fluid interface
     */
    public function prune($historia = null)
    {
        if ($historia) {
            $this->addUsingAlias(HistoriaPeer::AUTO, $historia->getAuto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
