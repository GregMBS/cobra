<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PDO;
use PDOException;

/**
 * Last months hours
 *
 * @author gmbs
 */
class LastMonthClass extends BaseClass
{
    /**
     * @var false|string
     */
    public $yr;

    /**
     * @var false|string
     */
    public $mes;

    /**
     * @var false|string
     */
    public $diaHoy;

    /**
     * @var false|string
     */
    private $hoy;

    /**
     * @var false|string
     */
    private $start;

    /**
     * @var false|string
     */
    private $yrmes;

    public function __construct()
    {
        parent::__construct();
        $this->yr = date('Y', strtotime("last day of previous month"));
        $this->mes = date('m', strtotime("last day of previous month"));
        $this->diaHoy = date('d', strtotime("last day of previous month"));
        $this->hoy = date('Y-m-d', strtotime("last day of previous month"));
        $this->start = date('Y-m-d', strtotime("last day of two months ago"));
        $this->yrmes = date('Y-m-', strtotime("last day of previous month"));
    }

    /**
     *
     * @param float $dec
     * @return string
     */
    /*
	public function convertTime($dec)
	{
		$hour	 = floor($dec);
		$min	 = round(60 * ($dec - $hour));
		return $hour.':'.str_pad($min, 2, '0', STR_PAD_LEFT);
	}
    */

    /**
     *
     * @return array
     */
    public function listAgents()
    {
        $query = 'select distinct c_cvge from historia
            where d_fech > :start
            and d_fech <= :end
            and c_msge is null
            order by c_cvge limit 100;';
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':end', $this->hoy);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @return array
     */
    public function listVisitors()
    {
        $query = 'select distinct completo,iniciales
			from nombres join historia on iniciales=c_visit
            where d_fech > :start
            and d_fech <= :end
	    order by iniciales;';
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':end', $this->hoy);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $gestor
     * @param integer $dom
     * @return array
     */
    private function getStartStopDiff($gestor, $dom)
    {
        $query = "select min(C_HRIN) as start, max(C_HRFI) as stop,
            TIME_TO_SEC(TIMEDIFF(max(C_HRFI),min(C_HRIN))) as diff
            from historia
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null
            and D_FECH=:start + interval :dom day
            and c_cont=0
            group by D_FECH";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $gestor);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    private function getCurrentMain($gestor, $dom)
    {
        $query = "select count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null and c_cont>0
            and D_FECH=:start + interval :dom day
            group by D_FECH";
        try {
            $stq = $this->pdo->prepare($query);
            $stq->bindValue(':gestor', $gestor);
            $stq->bindValue(':start', $this->start);
            $stq->bindValue(':dom', $dom, PDO::PARAM_INT);
            $stq->execute();
            return $stq->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            dd($e);
        }
    }

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    private function getVisitorMain($visitador, $dom)
    {
        $query = "select count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_visit=:visitador and c_msge is null
            and c_cniv is not null and c_cont>0
            and D_FECH=:start + interval :dom day
            group by D_FECH";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':visitador', $visitador);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    private function getPayments($gestor, $dom)
    {
        $query = "select count(1) as ct from pagos
            where gestor=:gestor
            and fecha=:start + interval :dom day";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $gestor);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $yr
     * @param string $mes
     * @param int $dhoy
     * @return string[]
     */
    public function dowArray($yr, $mes, $dhoy)
    {
        $dow = array();
        for ($i = 1; $i <= $dhoy; $i++) {
            $dow[$i] = date("l", strtotime($yr . "-" . $mes . "-" . $i));
        }
        return $dow;
    }

    /**
     * @param string $c_cvge
     * @return array
     */
    public function packData(string $c_cvge)
    {
        $row = array();
        for ($i = 1; $i <= $this->diaHoy; $i++) {
            $data = new HoursDataClass($i);
            $startStop = $this->getStartStopDiff($c_cvge, $i);
            $data->start = $startStop['start'];
            $data->stop = $startStop['stop'];
            $data->diff = $startStop['diff'];
            $main = $this->getCurrentMain($c_cvge, $i);
            if ($main) {
                $data->gestiones = $main['gestiones'];
                $data->cuentas = $main['cuentas'];
                $data->contactos = $main['contactos'];
                $data->nocontactos = $main['nocontactos'];
                $data->promesas = $main['promesas'];
                $data->pagos = $this->getPayments($c_cvge, $i);
            }
            $row[$i] = $data;
        }
        return $row;
    }

    /**
     * @param string $c_visit
     * @return array
     */
    public function packVisit($c_visit): array
    {
        $row = array();
        for ($i = 1; $i <= $this->diaHoy; $i++) {
            $data = new HoursDataClass($i);
            $main = $this->getVisitorMain($c_visit, $i);
            $data->gestiones = $main['gestiones'];
            $data->cuentas = $main['cuentas'];
            $data->contactos = $main['contactos'];
            $data->nocontactos = $main['nocontactos'];
            $data->promesas = $main['promesas'];
            $data->pagos = 0;
            $row[$i] = $data;
        }
        return $row;
    }


}