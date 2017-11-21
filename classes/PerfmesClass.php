<?php

namespace gregmbs\cobra;

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
class PerfmesClass
{
	/**
	 * @var \PDO $pdo
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
		$hour	 = floor($dec);
		$min	 = round(60 * ($dec - $hour));
		return $hour.':'.str_pad($min, 2, '0', STR_PAD_LEFT);
	}

	/**
	 *
	 * @return array
	 */
	public function listGestores()
	{
		$query	 = 'select distinct c_cvge from historia
            where d_fech>last_day(curdate() - interval 2 month)
            and d_fech<=last_day(curdate() - interval 1 month)
            and c_msge is null
            order by c_cvge limit 100;';
		$result	 = $this->pdo->query($query);
		return $result;
	}

	/**
	 *
	 * @return array
	 */
	public function listVisitadores()
	{
		$query	 = 'select distinct completo,iniciales
			from nombres join historia on iniciales=c_visit
            where d_fech>last_day(curdate() - interval 2 month)
            and d_fech<=last_day(curdate() - interval 1 month)
	    order by usuaria;';
		$result	 = $this->pdo->query($query);
		return $result;
	}

	/**
	 *
	 * @param string $gestor
	 * @param integer $dom
	 * @return array
	 */
	public function getStartStopDiff($gestor, $dom)
	{
		$query	 = "select min(C_HRIN) as start, max(C_HRFI) as stop,
            time_to_sec(timediff(max(C_HRFI),min(C_HRIN))) as diff
            from historia
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null
            and D_FECH=last_day(curdate() - interval 2 month) + interval :dom day
            and c_cont=0
            group by D_FECH";
		$stq	 = $this->pdo->prepare($query);
		$stq->bindParam(':gestor', $gestor);
		$stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
		$stq->execute();
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param string $gestor
	 * @param int $dom
	 * @return array
	 */
	public function getCurrentMain($gestor, $dom)
	{
		$query	 = "select count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null and c_cont>0
            and D_FECH=last_day(curdate() - interval 2 month) + interval :dom day
            group by D_FECH";
		$stq	 = $this->pdo->prepare($query);
		$stq->bindParam(':gestor', $gestor);
		$stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
		$stq->execute();
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param string $visitador
	 * @param int $dom
	 * @return array
	 */
	public function getVisitadorMain($visitador, $dom)
	{
		$query	 = "select count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_visit=:visitador and c_msge is null
            and c_cniv is not null and c_cont>0
            and D_FECH=last_day(curdate() - interval 2 month) + interval :dom day
            group by D_FECH";
		$stq	 = $this->pdo->prepare($query);
		$stq->bindParam(':visitador', $visitador);
		$stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
		$stq->execute();
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
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
		$query	 = "select c_hrin as tiempo,
            time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as diff
            from historia
            where c_cont=0 and c_cvge=:gestor
            and d_fech=last_day(curdate() - interval 2 month) + interval :dom day
            and c_cvst=:tipo
            order by c_cvge,c_cvst,c_hrin";
		$stq	 = $this->pdo->prepare($query);
		$stq->bindParam(':gestor', $gestor);
		$stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
		$stq->bindParam(':tipo', $tipo);
		$stq->execute();
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
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
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param string $gestor
	 * @param int $dom
	 * @return array
	 */
	public function getPagos($gestor, $dom)
	{
		$query	 = "select count(1) as ct from pagos
            where gestor=:gestor
            and fecha=last_day(curdate() - interval 2 month) + interval :dom day";
		$stq	 = $this->pdo->prepare($query);
		$stq->bindParam(':gestor', $gestor);
		$stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
		$stq->execute();
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param string $visitador
	 * @param int $dom
	 * @return array
	 */
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
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param string $visitador
	 * @param int $dom
	 * @return array
	 */
	public function countVisitsAssigned($visitador, $dom)
	{
		$query	 = "select count(fechaout) as co, count(fechain) as ci
			from vasign
			where gestor = :visitador
			and fechaout>last_day(curdate()-interval 2 month)
			and fechaout<last_day(curdate())+interval 1 month+interval 1 day
			and day(fechaout) = :dom";
		$stq	 = $this->pdo->prepare($query);
		$stq->bindParam(':visitador', $visitador);
		$stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
		$stq->execute();
		return $stq->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param string $gestor
	 * @return array
	 */
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
		return $stq->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @return array
	 */
	public function countVisitadorDays()
	{
		$query	 = "select sum(fs) as sfs,sum(ss) as sss from
(select distinct d_fech,dayofweek(d_fech)>1 and day(d_fech)<16 as fs,
dayofweek(d_fech)>1 and day(d_fech)>15 as ss from historia
where d_fech>last_day(curdate()-interval 2 month)
and d_fech<=last_day(curdate()-interval 1 month)
) as tmp";
		$result	 = $this->pdo->query($query);
		return $result;
	}
}
