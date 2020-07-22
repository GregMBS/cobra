<?php

namespace cobra_salsa;

use DateTime;
use PDO;

require_once __DIR__ . '/HistoriaObject.php';

/**
 * Description of ResumenClass
 *
 * @author gmbs
 */
class ResumenClass {

    /**
     *
     * @var PDO
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
     * @param PDO $pdo
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
    public function lastMyGestion($capt) {
        $query = "SELECT c_cont FROM historia WHERE c_cvge = :capt
         AND c_cont <> 0
         ORDER BY d_fech DESC, c_hrfi DESC LIMIT 1";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
        $result = $stu->fetch(PDO::FETCH_ASSOC);
        return $result['c_cont'];
    }

    /**
     * 
     * @param string $dirty
     * @return string
     */
    public function cleanFind($dirty) {
        $upper = strtoupper($dirty);
        $stripped = strip_tags($upper);
        return trim($stripped);
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
        return $stn->fetch(PDO::FETCH_ASSOC);
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
        $result = $stn->fetch(PDO::FETCH_ASSOC);
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
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getDictV() {
        $mytipo = 'visitador';
        return $this->getDict($mytipo);
    }

    /**
     * 
     * @return array
     */
    public function getMotiv() {
        $query = "SELECT motiv FROM motivadores order by motiv";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getMotivV() {
        $query = "SELECT motiv FROM motivadores where visitas = 1 order by motiv";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getCnp() {
        $query = "SELECT status FROM cnp";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getAccion() {
        $query = "SELECT accion FROM acciones where callcenter=1";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getAccionV() {
        $query = "SELECT accion FROM acciones where visitas=1";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getBadNo($id_cuenta) {
        $stbn = $this->pdo->prepare($this->badNoQuery);
        $stbn->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stbn->execute();
        return $stbn->fetch();
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
        $sts->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $sts->execute();
        return $sts->fetchAll();
    }

    /**
     * 
     * @return array
     */
    public function getGestorList() {
        $query = "SELECT usuaria,completo FROM nombres 
    ORDER BY usuaria";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getVisitadorList() {
        $query = "SELECT usuaria,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin')";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getClientList() {
        $query = "SELECT cliente FROM clientes;";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
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
        return $stn->fetch(PDO::FETCH_ASSOC);
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
        return $stf->fetchAll();
    }

    /**
     * 
     * @param int $id_cuenta
     * @return string
     */
    public function getTimelock($id_cuenta) {
        $query = "SELECT date_format(timelock,'%a, %d %b %Y %T') as tl
            FROM resumen 
            WHERE id_cuenta = :id_cuenta";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $sts->execute();
        $result = $sts->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['tl'];
        }
        $date = new DateTime();
        return $date->format('%a, %d %b %Y %T');
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
        $stb->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $result = $stb->fetch(PDO::FETCH_ASSOC);
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
        return $stg->fetch(PDO::FETCH_ASSOC);
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
        $sts->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $sts->execute();
    }

    /**
     *
     * @param int $id_cuenta
     * @return HistoriaObject
     */
    public function getLastStatus($id_cuenta): HistoriaObject
    {
        $query = "select * from historia where c_cont = :id_cuenta 
        order by d_fech desc, c_hrin desc limit 1";
        $stl = $this->pdo->prepare($query);
        $stl->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stl->execute();
        $result = $stl->fetchObject(HistoriaObject::class);
        if ($result) {
            return $result;
        }
        return new HistoriaObject();
    }

    /**
     * 
     * @param int $id_cuenta
     * @return HistoriaObject
     */
    public function getPromData($id_cuenta): HistoriaObject
    {
        $query = "select *
from historia 
where c_cont = :id_cuenta 
and n_prom > 0 
and c_cvst like 'PROMESA DE%'
order by d_fech desc, c_hrin desc limit 1";
        $stp = $this->pdo->prepare($query);
        $stp->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stp->execute();
        return $stp->fetchObject(HistoriaObject::class);
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
        $stc->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stc->execute();
        return $stc->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $capt
     * @param int $id_cuenta
     * @param string $myTipo
     */
    public function setLocks($capt, $id_cuenta, $myTipo) {
        $queryUnlock = "UPDATE resumen SET timelock = NULL, locker = NULL "
                . "WHERE locker = :capt";
        $stu = $this->pdo->prepare($queryUnlock);
        $stu->bindParam(':capt', $capt);
        $queryLock = "UPDATE resumen SET timelock = now(), locker = :capt "
                . "WHERE id_cuenta = :id_cuenta";
        if ($myTipo == 'admin') {
            $queryLock = "SELECT :capt, :id_cuenta";
        }
        $stl = $this->pdo->prepare($queryLock);
        $stl->bindParam(':capt', $capt);
        $stl->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $queryUnlockSlice = "UPDATE rslice SET timelock = NULL, locker = NULL "
                . "WHERE locker = :capt";
        $sts = $this->pdo->prepare($queryUnlockSlice);
        $sts->bindParam(':capt', $capt);
        $queryLockSlice = "UPDATE rslice SET timelock = now(), locker = :capt "
                . "WHERE id_cuenta= :id_cuenta";
        $str = $this->pdo->prepare($queryLockSlice);
        $str->bindParam(':capt', $capt);
        $str->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $this->pdo->beginTransaction();
        $stu->execute();
        $stl->execute();
        $sts->execute();
        $str->execute();
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
        $sts->bindParam(':id_cuenta', $ID_CUENTA, PDO::PARAM_INT);
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param int $id_cuenta
     * @return int
     */
    public function countGestiones($id_cuenta) {
        $query = "SELECT COUNT(1) as gest FROM historia 
                WHERE c_cont = :id_cuenta
                AND c_cont > 0";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['gest'];
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return int
     */
    public function countPromesas($id_cuenta) {
        $query = "SELECT COUNT(1) as prom FROM historia 
                WHERE c_cont = :id_cuenta 
                AND n_prom > 0";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['prom'];
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return int
     */
    public function countPagos($id_cuenta) {
        $query = "SELECT COUNT(1) as pag FROM pagos 
                WHERE id_cuenta = :id_cuenta";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['pag'];
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    /**
     * @param string $capt
     * @return int
     */
    function leaveEmptyQueue(string $capt): int
    {
        $newCamp = 3;
        $query = "SELECT queuelist.camp as cp 
        FROM nombres, queuelist 
WHERE gestor = iniciales and status_aarsa <> '' and queuelist.camp > nombres.camp
AND gestor = :capt AND bloqueado = 0
ORDER BY queuelist.camp LIMIT 1";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':capt', $capt);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $newCamp = $result['cp'];
        }
        $querySet = "UPDATE nombres SET camp = :camp WHERE iniciales =:capt";
        $stu = $this->pdo->prepare($querySet);
        $stu->bindValue(':camp', $newCamp);
        $stu->bindValue(':capt', $capt);
        $stu->execute();
        return $newCamp;
    }

}
