<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of ResumenClass
 *
 * @author gmbs
 */
class ResumenClass {

    /**
     *
     * @var \PDO
     */
    private $pdo;

    /**
     *
     * @var string
     */
    private $notesQuery = "select min(concat_ws(' ',fecha,hora)<now()) as alert,
            min(concat_ws(' ',fecha,hora)) as fechahora
from notas 
where c_cvge = :capt 
AND borrado=0 
and fecha<>'0000-00-00'
AND concat_ws(' ',fecha,hora)<now()
ORDER BY fecha, hora LIMIT 1";

    /**
     *
     * @var string
     */
    private $notasDataQuery = "select cuenta,nota,fuente
from notas 
where c_cvge IN (:capt,'todos')
AND borrado=0 
AND concat(fecha,' ',hora) = :fechahora 
LIMIT 1";

    /**
     *
     * @var string
     */
    private $badNoQuery = "select if(tel_1 in (select * from deadlines),' class=\"badno\" ','') as t1,
if(tel_2 in (select * from deadlines),' class=\"badno\" ','') as t2,
if(tel_3 in (select * from deadlines),' class=\"badno\" ','') as t3,
if(tel_4 in (select * from deadlines),' class=\"badno\" ','') as t4,
if(tel_1_alterno in (select * from deadlines),' class=\"badno\" ','') as t1a,
if(tel_2_alterno in (select * from deadlines),' class=\"badno\" ','') as t2a,
if(tel_3_alterno in (select * from deadlines),' class=\"badno\" ','') as t3a,
if(tel_4_alterno in (select * from deadlines),' class=\"badno\" ','') as t4a,
if(tel_1_ref_1 in (select * from deadlines),' class=\"badno\" ','') as t1r1,
if(tel_2_ref_1 in (select * from deadlines),' class=\"badno\" ','') as t2r1,
if(tel_1_ref_2 in (select * from deadlines),' class=\"badno\" ','') as t1r2,
if(tel_2_ref_2 in (select * from deadlines),' class=\"badno\" ','') as t2r2,
if(tel_1_ref_3 in (select * from deadlines),' class=\"badno\" ','') as t1r3,
if(tel_2_ref_3 in (select * from deadlines),' class=\"badno\" ','') as t2r3,
if(tel_1_ref_4 in (select * from deadlines),' class=\"badno\" ','') as t1r4,
if(tel_2_ref_4 in (select * from deadlines),' class=\"badno\" ','') as t2r4,
if(tel_1_laboral in (select * from deadlines),' class=\"badno\" ','') as t1l,
if(tel_2_laboral in (select * from deadlines),' class=\"badno\" ','') as t2l,
if(tel_1_verif in (select * from deadlines),' class=\"badno\" ','') as t1v,
if(tel_2_verif in (select * from deadlines),' class=\"badno\" ','') as t2v,
if(tel_3_verif in (select * from deadlines),' class=\"badno\" ','') as t3v,
if(tel_4_verif in (select * from deadlines),' class=\"badno\" ','') as t4v
from resumen
where id_cuenta=:id_cuenta LIMIT 1";

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $stat
     * @param string $visit
     * @return string
     */
    public function highhist($stat, $visit) {
        $highstr = '';
        if (($stat == 'PROMESA DE PAGO TOTAL') || ($stat == 'PROMESA DE PAGO PARCIAL') || ($stat == 'CLIENTE NEGOCIANDO')) {
            $highstr = " class='deudor'";
        }
        if (!empty($visit)) {
            $highstr = " class='visit'";
        }
        return $highstr;
    }

    /**
     * 
     * @param string $capt
     * @return int
     */
    public function lastGestion($capt) {
        $queryult = "SELECT c_cont FROM historia WHERE c_cvge = :capt"
                . " AND c_cont <> 0"
                . " ORDER BY d_fech DESC, c_hrfi DESC LIMIT 1";
        $stu = $this->pdo->prepare($queryult);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
        $result = $stu->fetch(\PDO::FETCH_ASSOC);
        $find = $result['c_cont'];
        return $find;
    }

    /**
     * 
     * @param string $dirty
     * @return string
     */
    public function cleanFind($dirty) {
        $upper = strtoupper($dirty);
        $stripped = strip_tags($upper);
        $trimmed = trim($stripped);
        return $trimmed;
    }

    /**
     * 
     * @param string $field
     * @return boolean
     */
    public function fieldCheck($field) {
        $valid = false;
        $q = $this->pdo->query("SHOW FIELDS FROM resumen");
        foreach ($q as $row) {
            if ($row['Field'] == $field) {
                $valid = true;
                break;
            }
        }
        return $valid;
    }

    /**
     * 
     * @param string $capt
     * @param string $fechahora
     * @return array
     */
    private function notaData($capt, $fechahora) {
        $stn = $this->pdo->prepare($this->notasDataQuery);
        $stn->bindParam(':capt', $capt);
        $stn->bindParam(':fechahora', $fechahora);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function notAlert($capt) {
        $stn = $this->pdo->prepare($this->notesQuery);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['alert'])) {
            $notaData = $this->notaData($capt, $result['fechahora']);
            $output = array(
                'notalert' => $result['alert'],
                'notalertt' => $result['fechahora'],
                'cuenta' => $notaData['cuenta'],
                'nota' => $notaData['nota'],
                'fuente' => $notaData['fuente']
            );
        } else {
            $output = array(
                'notalert' => '',
                'notalertt' => '',
                'cuenta' => '',
                'nota' => '',
                'fuente' => ''
            );
        }
        return $output;
    }

    /**
     * 
     * @param string $mytipo
     * @return array
     */
    public function getDict($mytipo) {
        $query = "SELECT dictamen,v_cc,judicial "
                . "FROM dictamenes "
                . "where callcenter=1 "
                . "order by dictamen";
        if ($mytipo == 'visitador') {
            $query = "SELECT dictamen,v_cc,judicial "
                    . "FROM dictamenes "
                    . "where visitas=1 "
                    . "order by dictamen";
        }
        if ($mytipo == 'admin') {
            $query = "SELECT dictamen,v_cc,judicial "
                    . "FROM dictamenes "
                    . "order by dictamen";
        }
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getDictV() {
        $mytipo = 'visitador';
        $result = $this->getDict($mytipo);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getMotiv() {
        $query = "SELECT motiv FROM motivadores order by motiv";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getMotivV() {
        $query = "SELECT motiv FROM motivadores where visitas = 1 order by motiv";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getCnp() {
        $query = "SELECT status FROM cnp";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getAccion() {
        $query = "SELECT accion FROM acciones where callcenter=1";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getAccionV() {
        $query = "SELECT accion FROM acciones where visitas=1";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getBadNo($id_cuenta) {
        $stbn = $this->pdo->prepare($this->badNoQuery);
        $stbn->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stbn->execute();
        $answerbadno = $stbn->fetch();
        return $answerbadno;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getHistory($id_cuenta) {
        $querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin) as fecha,
                    c_cvge,c_tele,left(c_obse1,50) as short,c_obse1,
                    auto,c_cniv 
                    FROM historia 
                    WHERE historia.C_CONT=:id_cuenta   
                    ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
        $rowsub = $sts->fetchAll();
        return $rowsub;
    }

    /**
     * 
     * @return array
     */
    public function getGestorList() {
        $queryGestor = "SELECT usuaria,completo FROM nombres 
    ORDER BY usuaria";
        $resultGestor = $this->pdo->query($queryGestor);
        return $resultGestor;
    }

    /**
     * 
     * @return array
     */
    public function getVisitadorList() {
        $queryGestorV = "SELECT usuaria,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin')";
        $resultGestorV = $this->pdo->query($queryGestorV);
        return $resultGestorV;
    }

    /**
     * 
     * @return array
     */
    public function getClientList() {
        $querycl = "SELECT cliente FROM clientes;";
        $resultcl = $this->pdo->query($querycl);
        return $resultcl;
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getNumGests($capt) {
        $queryng = "SELECT count(1) as cng FROM historia 
WHERE c_cvge=:capt 
AND d_fech=curdate()
AND c_cont <> 0
";
        $stn = $this->pdo->prepare($queryng);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
        $resultng = $stn->fetch();
        return $resultng;
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getQueueList($capt) {
        $queryfilt = "SELECT cliente,sdc,queue FROM queuelist 
WHERE gestor = :capt 
ORDER BY cliente,sdc,queue";
        $stf = $this->pdo->prepare($queryfilt);
        $stf->bindParam(':capt', $capt);
        $stf->execute();
        $resultfilt = $stf->fetchAll();
        return $resultfilt;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return string
     */
    public function getTimelock($id_cuenta) {
        $querytlock = "SELECT date_format(timelock,'%a, %d %b %Y %T') as tl
            FROM resumen 
            WHERE id_cuenta = :id_cuenta";
        $sts = $this->pdo->prepare($querytlock);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
        $result = $sts->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            $tl = $result['tl'];
        }
        return $tl;
    }

    /**
     * 
     * @param string $string
     * @return float
     */
    public function demonitize($string) {
        $number = str_replace('$', '', str_replace(',', '', $string));
        return $number;
    }

    /**
     * 90 days
     * 
     * @param string $C_CVST
     * @param int $C_CONT
     * @return string
     */
    public function getBest($C_CVST, $C_CONT) {
        $best = $C_CVST;
        $querybest = "select c_cvst,v_cc from historia,dictamenes"
                . " where c_cvst=dictamen and c_cont = :C_CONT"
                . " and d_fech>last_day(curdate()-interval 90 day)"
                . " order by v_cc LIMIT 1";
        $stb = $this->pdo->prepare($querybest);
        $stb->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $result = $stb->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvst'])) {
            $best = $result['c_cvst'];
        }
        return $best;
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getUserData($capt) {
        $queryg = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales = :capt LIMIT 1";
        $stg = $this->pdo->prepare($queryg);
        $stg->bindParam(':capt', $capt);
        $stg->execute();
        $result = $stg->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $capt
     * @param int $id_cuenta
     */
    public function setSlice($capt, $id_cuenta) {
        $qsliced = "delete from rslice where user = :capt";
        $std = $this->pdo->prepare($qsliced);
        $std->bindParam(':capt', $capt);
        $std->execute();

        $qslice = "replace into rslice select *, :capt, now() from resumen "
                . "where id_cuenta = :id_cuenta";
        $sts = $this->pdo->prepare($qslice);
        $sts->bindParam(':capt', $capt);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getLastStatus($id_cuenta) {
        $querycom = "select c_cvst,cuando from historia where c_cont = :id_cuenta "
                . "order by d_fech desc, c_hrin desc limit 1";
        $stl = $this->pdo->prepare($querycom);
        $stl->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stl->execute();
        $result = $stl->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getPromData($id_cuenta) {
        $queryprom = "select n_prom as N_PROM_OLD, d_prom as D_PROM_OLD,
    n_prom1 as N_PROM1_OLD, d_prom1 as D_PROM1_OLD,
    n_prom2 as N_PROM2_OLD, d_prom2 as D_PROM2_OLD,
    n_prom3 as N_PROM3_OLD, d_prom1 as D_PROM1_OLD,
    n_prom1 as N_PROM1_OLD, d_prom1 as D_PROM1_OLD
from historia 
where c_cont = :id_cuenta 
and n_prom>0 
and c_cvst like 'PROMESA DE%'
order by d_fech desc, c_hrin desc limit 1";
        $stp = $this->pdo->prepare($queryprom);
        $stp->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stp->execute();
        $result = $stp->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getTimeCheck($id_cuenta) {
        $querycheck = "SELECT timelock, locker, time_to_sec(timediff(now(),timelock))/60 as sofar "
                . "FROM resumen "
                . "WHERE id_cuenta = :id_cuenta";
        $stc = $this->pdo->prepare($querycheck);
        $stc->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $capt
     * @param int $id_cuenta
     * @param string $mytipo
     */
    public function setLocks($capt, $id_cuenta, $mytipo) {
        $queryunlock = "UPDATE resumen SET timelock = NULL, locker = NULL "
                . "WHERE locker = :capt";
        $stu = $this->pdo->prepare($queryunlock);
        $stu->bindParam(':capt', $capt);
        $querylock = "UPDATE resumen SET timelock = now(), locker = :capt "
                . "WHERE id_cuenta = :id_cuenta";
        if ($mytipo == 'admin') {
            $querylock = "SELECT :capt, :id_cuenta";
        }
        $stl = $this->pdo->prepare($querylock);
        $stl->bindParam(':capt', $capt);
        $stl->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $queryunlockslice = "UPDATE rslice SET timelock = NULL, locker = NULL "
                . "WHERE locker = :capt";
        $stus = $this->pdo->prepare($queryunlockslice);
        $stus->bindParam(':capt', $capt);
        $querylockslice = "UPDATE rslice SET timelock = now(), locker = :capt "
                . "WHERE id_cuenta= :id_cuenta";
        $stls = $this->pdo->prepare($querylockslice);
        $stls->bindParam(':capt', $capt);
        $stls->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $this->pdo->beginTransaction();
        $stu->execute();
        $stl->execute();
        $stus->execute();
        $stls->execute();
        $this->pdo->commit();
    }

    /**
     * 
     * @param int $ID_CUENTA
     * @return array
     */
    public function listVisits($ID_CUENTA) {
        $querysub = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id_cuenta) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':id_cuenta', $ID_CUENTA, \PDO::PARAM_INT);
        $sts->execute();
        $rowsub = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $rowsub;
    }

}
