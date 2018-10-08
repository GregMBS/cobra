<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database Class for perfmes
 *
 * @author gmbs
 */
class PerfmesClass extends BaseClass
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
    public function listGestores()
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
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @return array
     */
    public function listVisitadores()
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
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
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
        $stq->bindValue(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
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
            $stq->bindValue(':dom', $dom, \PDO::PARAM_INT);
            $stq->execute();
            $result = $stq->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            dd($e);
        }
        return array();
    }

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    private function getVisitadorMain($visitador, $dom)
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
        $stq->bindValue(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @param string $tipo
     * @return array
     */
    /*
    public function getTiempoDiff($gestor, $dom, $tipo)
    {
        $query	 = "select c_hrin as tiempo,
            time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as diff
            from historia
            where c_cont=0 and c_cvge=:gestor
            and d_fech=:start + interval :dom day
            and c_cvst=:tipo
            order by c_cvge,c_cvst,c_hrin";
        $stq	 = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $gestor);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':dom', $dom, \PDO::PARAM_INT);
        $stq->bindValue(':tipo', $tipo);
        $stq->execute();
        return $stq->fetchAll(\PDO::FETCH_ASSOC);
    }
    */

    /**
     *
     * @param string $gestor
     * @param int $dow
     * @param string $tiempo
     * @return array
     */
    /*
    public function getNTPDiff($gestor, $dow, $tiempo)
    {
        $query	 = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as diff,
            min(c_hrin) as ntp
            from historia
            where c_cvge = :gestor
            and d_fech = last_day(curdate() - interval 2 month) + interval :dow day
            and c_hrin>:tiempo";
        $stq	 = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dow', $dow, \PDO::PARAM_INT);
        $stq->bindParam(':tiempo', $tiempo);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }
    */

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    private function getPagos($gestor, $dom)
    {
        $query = "select count(1) as ct from pagos
            where gestor=:gestor
            and fecha=:start + interval :dom day";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $gestor);
        $stq->bindValue(':start', $this->start);
        $stq->bindValue(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    /*
    public function getVisitadorPagos($visitador, $dom)
    {
        $query	 = "select count(distinct pagos.auto) as ct from pagos
            join historia on c_cont=id_cuenta
            where c_visit = :visitador
            and fecha>last_day(curdate()-interval 2 month)
            and fecha<=last_day(curdate()-interval 1 month)
            and day(fecha) = :dom";
        $stq	 = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }
    */

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return array
     */
    /*
    public function countVisitsAssigned($visitador, $dom)
    {
        $query	 = "select count(fechaOut) as co, count(fechaIn) as ci
            from vasign
            where gestor = :visitador
            and fechaOut>last_day(curdate()-interval 2 month)
            and fechaOut<last_day(curdate())+interval 1 month+interval 1 day
            and day(fechaOut) = :dom";
        $stq	 = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }
    */

    /**
     *
     * @param string $gestor
     * @return array
     */
    /*
    public function countAccounts($gestor)
    {
        $query	 = "select count(distinct c_cont) as ct
            from historia
            where c_cvge=:gestor and c_cont>0
            and c_cniv is null and c_msge is null
            and D_FECH>last_day(curdate() - interval 2 month)
            and D_FECH>=last_day(curdate() - interval 1 month)";
        $stq	 = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }
    */

    /**
     *
     * @return array
     */
    /*
    public function countVisitadorDays()
    {
        $query	 = "select sum(fs) as sfs,sum(ss) as sss from
(select distinct d_fech,DAYOFWEEK(d_fech)>1 and day(d_fech)<16 as fs,
DAYOFWEEK(d_fech)>1 and day(d_fech)>15 as ss from historia
where d_fech>last_day(curdate()-interval 2 month)
and d_fech<=last_day(curdate()-interval 1 month)
) as tmp";
        $result	 = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    */

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
            $data = new HorariosDataClass($i);
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
                $data->pagos = $this->getPagos($c_cvge, $i);
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
            $data = new HorariosDataClass($i);
            $main = $this->getVisitadorMain($c_visit, $i);
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