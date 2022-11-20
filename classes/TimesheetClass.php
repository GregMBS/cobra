<?php

namespace cobra_salsa;

use BadMethodCallException;
use PDO;


abstract class TimesheetClass
{
    /**
     * @var PDO $pdo
     */
    protected PDO $pdo;

    /**
     * @var string
     */
    protected string $queryStartStopDiff;

    /**
     * @var string
     */
    protected string $queryTiempoDiff;

    /**
     * @var string
     */
    protected string $queryNTPDiff;

    /**
     * @var string
     */
    protected string $queryCountVisitadorDays;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @return array
     */
    public function listGestores(): array
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
    public function listVisitadores(): array
    {
        $query = $this->queryVisitadores;
        $stm = $this->pdo->query($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_COLUMN);
        if (!empty($result)) {
            return $result;
        }
        return [
            'gmbs'
        ];
    }

    /**
     *
     * @param string $gestor
     * @param integer $dom
     * @return array
     */
    public function getStartStopDiff(string $gestor, int $dom): array
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
    public function getCurrentMain(string $gestor, int $dom): array
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
     * @param string $gestor
     * @param int $dom
     * @param string $tipo
     * @return array
     */
    public function getTiempoDiff(string $gestor, int $dom, string $tipo): array
    {
        $query = $this->queryTiempoDiff;
        if (!$query) {
            return array();
        }
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
    public function getNTPDiff(string $gestor, int $dow, string $tiempo): array
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
    public function getPagos(string $gestor, int $dom): array
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
//    public function getVisitadorPagos($visitador, $dom)
//    {
//        $query = $this->queryVisitadorPagos;
//        $stq = $this->pdo->prepare($query);
//        $stq->bindParam(':visitador', $visitador);
//        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
//        $stq->execute();
//        return $stq->fetchAll(PDO::FETCH_ASSOC);
//    }

    /**
     *
     * @param string $gestor
     * @return array
     */
//    public function countAccounts($gestor)
//    {
//        $query = $this->queryCountAccounts;
//        $stq = $this->pdo->prepare($query);
//        $stq->bindParam(':gestor', $gestor);
//        $stq->execute();
//        return $stq->fetchAll(PDO::FETCH_ASSOC);
//    }

    /**
     *
     * @return array
     */
    public function countVisitadorDays(): array
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
    public function prepareMonthSum(array $month): TimesheetDayObject
    {
        $sum = new TimesheetDayObject();
        $sum->diff = array_sum(array_column($month, 'diff'));
        $sum->bano = array_sum(array_column($month, 'bano'));
        $sum->break = array_sum(array_column($month, 'break'));
        return $this->prepareMonthSumCounts($month, $sum);
    }


    /**
     * @param string $gestor
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    public function prepareSheet(string $gestor, int $hoy): array
    {
        $month = [];
        for ($i = 1; $i <= $hoy; $i++) {
            $day = new TimesheetDayObject();
            $resultStartStopDiff = $this->getStartStopDiff($gestor, $i);
            foreach ($resultStartStopDiff as $answerStartStopDiff) {
                $day->start = substr($answerStartStopDiff['start'], 0, 5);
                $day->stop = substr($answerStartStopDiff['stop'], 0, 5);
                $day->diff = $answerStartStopDiff['diff'];
            }
            $resultStartStop = $this->getCurrentMain($gestor, $i);
            foreach ($resultStartStop as $answerStartStop) {
                $this->breakLoop($gestor, $i, $day, 'break');
                $this->breakLoop($gestor, $i, $day, 'bano');
                $this->loadDay($gestor, $i, $answerStartStop, $day);
            }
            $month[$i] = $day;
        }
        return $month;
    }

    /**
     * @param $gestor
     * @param int $dayNumber
     * @param $answerStartStop
     * @param TimesheetDayObject $day
     */
    protected function loadDay($gestor, int $dayNumber, $answerStartStop, TimesheetDayObject $day): void
    {
        $result = $this->getPagos($gestor, $dayNumber);
        $day->lla = $answerStartStop['cuentas'];
        $day->tlla = $answerStartStop['gestiones'];
        $day->ct = $answerStartStop['nocontactos'];
        $day->nct = $answerStartStop['contactos'];
        $day->prom = $answerStartStop['promesas'];
        $day->lph = $day->lla / ($day->diff + 1 / 3600);
        foreach ($result as $answer) {
            $day->pag = $answer['ct'];
        }
    }

    /**
     * @param $gestor
     * @param int $dayNumber
     * @param TimesheetDayObject $day
     * @param string $tipo
     */
    protected function breakLoop($gestor, int $dayNumber, TimesheetDayObject $day, string $tipo): void
    {
        $result = $this->getTiempoDiff($gestor, $dayNumber, $tipo);
        foreach ($result as $answer) {
            $TIEMPO = $answer['tiempo'];
            $ntp = $this->getNTPDiff($gestor, $dayNumber, $TIEMPO);
            if ($ntp) {
                foreach ($ntp as $ntpDiff) {
                    $day->bano += $ntpDiff['diff'];
                }
            }
        }
    }

    /**
     * @param array $month
     * @param TimesheetDayObject $sum
     * @return TimesheetDayObject
     */
    protected function prepareMonthSumCounts(array $month, TimesheetDayObject $sum): TimesheetDayObject
    {
        $sum->lla = array_sum(array_column($month, 'lla'));
        $sum->tlla = array_sum(array_column($month, 'tlla'));
        $sum->prom = array_sum(array_column($month, 'prom'));
        $sum->pag = array_sum(array_column($month, 'pag'));
        $sum->ct = array_sum(array_column($month, 'ct'));
        $sum->nct = array_sum(array_column($month, 'nct'));
        $sum->lph = $sum->lla / ($sum->diff + 1 / 3600);
        return $sum;
    }

    /**
     * @param $gestor
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    protected function prepareAllSheet($gestor, int $hoy): array
    {
        if (!empty($gestor)) {
            throw new BadMethodCallException('Why is there something here?');
        }
        $month = [];
        for ($i = 1; $i <= $hoy; $i++) {
            $day = new TimesheetDayObject();
            $month[$i] = $day;
        }
        return $month;
    }

    /**
     * @param string $visitador
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    public function prepareVisitSheet(string $visitador, int $hoy): array
    {
        $month = [];
        for ($i = 1; $i <= $hoy; $i++) {
            $day = new TimesheetDayObject();
            $resultStartStop = $this->getVisitadorMain($visitador, $i);
            foreach ($resultStartStop as $answerStartStop) {
                $this->loadDay($visitador, $i, $answerStartStop, $day);
            }
            $month[$i] = $day;
        }
        return $month;
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    public function getVisitadorMain(string $gestor, int $dom): array
    {
        $query = $this->queryVisitMain;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
        return [
            'cuentas' => 0,
            'promesas' => 0,
            'gestiones' => 0,
            'nocontactos' => 0,
            'contactos' => 0
        ];
    }

}
