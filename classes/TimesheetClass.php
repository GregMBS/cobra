<?php

namespace cobra_salsa;

use PDO;


abstract class TimesheetClass
{
    /**
     * @var PDO $pdo
     */
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @param float $dec
     * @return string
     */
    public function convertTime($dec)
    {
        $hour = floor($dec);
        $min = round(60 * ($dec - $hour));
        return $hour . ':' . str_pad($min, 2, '0', STR_PAD_LEFT);
    }

    /**
     * @param int $diff
     * @return string
     */
    public function showTime(int $diff): string
    {
        $hrs = floor($diff / 3600);
        $min = round(($diff - $hrs * 3600) / 60);
        return $hrs . ':' . sprintf("%02s", $min);
    }

    /**
     *
     * @return array
     */
    public function listGestores()
    {
        $query = $this->queryGestores;
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function listVisitadores()
    {
        $query = $this->queryVisitadores;
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param integer $dom
     * @return array
     */
    public function getStartStopDiff($gestor, $dom)
    {
        $query = $this->queryStartStopDiff;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    public function getCurrentMain($gestor, $dom)
    {
        $query = $this->queryCurrentMain;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    public function getVisitadorMain($visitador, $dom)
    {
        $query = $this->queryVisitadorMain;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @param string $tipo
     * @return array
     */
    public function getTiempoDiff($gestor, $dom, $tipo)
    {
        $query = $this->queryTiempoDiff;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->bindParam(':tipo', $tipo);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dow
     * @param string $tiempo
     * @return array
     */
    public function getNTPDiff($gestor, $dow, $tiempo)
    {
        $query = $this->queryNTPDiff;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dow', $dow, PDO::PARAM_INT);
        $stq->bindParam(':tiempo', $tiempo);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    public function getPagos($gestor, $dom)
    {
        $query = $this->queryPagos;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    public function getVisitadorPagos($visitador, $dom)
    {
        $query = $this->queryVisitadorPagos;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    public function countVisitsAssigned($visitador, $dom)
    {
        $query = $this->queryCountVisitsAssigned;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @return array
     */
    public function countAccounts($gestor)
    {
        $query = $this->queryCountAccounts;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function countVisitadorDays()
    {
        $query = $this->queryCountVisitadorDays;
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param TimesheetDayObject[] $month
     * @return TimesheetDayObject
     */
    public function prepareMonthSum(array $month)
    {
        $sum = new TimesheetDayObject();
        $sum->diff = array_sum(array_column($month, 'diff'));
        $sum->bano = array_sum(array_column($month, 'bano'));
        $sum->break = array_sum(array_column($month, 'break'));
        $sum->lla = array_sum(array_column($month, 'lla'));
        $sum->tlla = array_sum(array_column($month, 'tlla'));
        $sum->prom = array_sum(array_column($month, 'prom'));
        $sum->pag = array_sum(array_column($month, 'pag'));
        $sum->ct = array_sum(array_column($month, 'ct'));
        $sum->nct = array_sum(array_column($month, 'nct'));
        $sum->lph = $sum->lla / ($sum->diff + 1 / 3600);
        return $sum;
    }

}