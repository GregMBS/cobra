<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/HistoriaObject.php';
require_once __DIR__ . '/UserDataObject.php';
require_once __DIR__ . '/BadNoObject.php';

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
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $stat
     * @param string $visit
     * @return string
     */
    public function highlight($stat, $visit) {
        if (!empty($visit)) {
            return 'visit';
        }
        if (($stat == 'PROMESA DE PAGO TOTAL') || ($stat == 'PROMESA DE PAGO RECURRENTE') || ($stat == 'PROMESA DE PAGO PARCIAL') || ($stat == 'CLIENTE NEGOCIANDO')) {
            return 'deudor';
        }
        return '';
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
        if ($result) {
            return $result['c_cont'];
        }
        return 0;
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
        $output = array(
            'notalert' => '',
            'notalertt' => '',
            'cuenta' => '',
            'nota' => '',
            'fuente' => ''
        );
        if (isset($result['alert'])) {
            $notaData = $this->notaData($capt, $result['fechahora']);
            $output = array(
                'notalert' => $result['alert'],
                'notalertt' => $result['fechahora'],
                'cuenta' => $notaData['cuenta'],
                'nota' => $notaData['nota'],
                'fuente' => $notaData['fuente']
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
        $query = "SELECT dictamen,v_cc,judicial 
        FROM dictamenes 
        where callcenter=1 
        order by dictamen";
        if ($mytipo == 'visitador') {
            $query = "SELECT dictamen,v_cc,judicial 
            FROM dictamenes 
            where visitas=1 
            order by dictamen";
        }
        if ($mytipo == 'admin') {
            $query = "SELECT dictamen,v_cc,judicial 
            FROM dictamenes 
            order by dictamen";
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
        return $this->getDict('visitador');
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
     * @return BadNoObject
     */
    public function getBadNo(int $id_cuenta): BadNoObject
    {
        $stb = $this->pdo->prepare($this->badNoQuery);
        $stb->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stb->execute();
        $badNo = $stb->fetchObject(BadNoObject::class);
        if ($badNo) {
            return $badNo;
        }
        return new BadNoObject();
    }

    /**
     * 
     * @param int $id_cuenta
     * @return array
     */
    public function getHistory($id_cuenta) {
        $query = "SELECT c_cvst,concat(d_fech,' ',c_hrin) as fecha,
                    c_cvge,c_tele,left(c_obse1,50) as short,c_obse1,
                    auto,c_cniv 
                    FROM historia 
                    WHERE historia.C_CONT=:id_cuenta   
                    ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $sts->execute();
        return $sts->fetchAll();
    }

    /**
     * 
     * @return array
     */
    public function getGestorList() {
        $query = "SELECT iniciales,completo FROM nombres 
    ORDER BY iniciales";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getVisitadorList() {
        $query = "SELECT iniciales,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin')";
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
        $query = "SELECT count(1) as cng FROM historia 
WHERE c_cvge=:capt 
AND d_fech=curdate()
AND c_cont <> 0
";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
        return $stn->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function getNumProm($capt) {
        $query = "SELECT count(1) as cnp FROM historia 
WHERE c_cvge=:capt 
AND n_prom > 0 
AND d_fech=curdate()
AND c_cont <> 0
";
        $stn = $this->pdo->prepare($query);
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
        $query = "SELECT cliente,sdc,status_aarsa as 'queue' FROM queuelist 
WHERE gestor = :capt 
ORDER BY cliente,sdc,queue";
        $stf = $this->pdo->prepare($query);
        $stf->bindParam(':capt', $capt);
        $stf->execute();
        return $stf->fetchAll();
    }

    /**
     * 
     * @param string $capt
     * @return UserDataObject
     */
    public function getUserData($capt): UserDataObject
    {
        $query = "SELECT * FROM nombres WHERE iniciales = :capt LIMIT 1";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':capt', $capt);
        $stg->execute();
        return $stg->fetchObject(UserDataObject::class);
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
order by d_fech desc, c_hrin desc limit 1";
        $stp = $this->pdo->prepare($query);
        $stp->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stp->execute();
        $result = $stp->fetchObject(HistoriaObject::class);
        if ($result) {
            return $result;
        }
        return new HistoriaObject();
    }

    /**
     * 
     * @param string $capt
     * @param int $id_cuenta
     */
    public function setLocks($capt, $id_cuenta) {
        $queryUnlock = "UPDATE resumen SET timelock = NULL, locker = NULL "
                . "WHERE locker = :capt";
        $stu = $this->pdo->prepare($queryUnlock);
        $stu->bindParam(':capt', $capt);
        $queryLock = "UPDATE resumen SET timelock = now(), locker = :capt 
        WHERE id_cuenta = :id_cuenta";
        if ($capt == 'gmbs') {
            $queryLock = "SELECT :capt, :id_cuenta";
        }
        $stl = $this->pdo->prepare($queryLock);
        $stl->bindParam(':capt', $capt);
        $stl->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $this->pdo->beginTransaction();
        $stu->execute();
        $stl->execute();
        $this->pdo->commit();
    }

    /**
     * 
     * @param int $ID_CUENTA
     * @return array
     */
    public function listVisits($ID_CUENTA) {
        $query = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id_cuenta) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($query);
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
        $query = "SELECT COUNT(1) as gestiones FROM historia 
                WHERE c_cont = :id_cuenta
                AND c_cont > 0";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['gestiones'];
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
