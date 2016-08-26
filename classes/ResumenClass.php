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
    private $setPromesaIncumplida = "update cobra.resumen
		set status_aarsa='PROMESA INCUMPLIDA'
		where id_cuenta not in (
			select c_cont from cobra.historia
			where n_prom>0
			and d_prom>=curdate())
		and id_cuenta in (
			select c_cont from cobra.historia
			where n_prom>0
			and d_prom<curdate())
		and numero_de_cuenta not in (
			select cuenta from cobra.pagos
			where fecha>last_day(curdate()-interval 1 month))
		and status_aarsa IN (
			'PROMESA DE PAGO PARCIAL',
			'PROMESA DE PAGO TOTAL',
			'CONFIRMA PROMESA')
		and id_cuenta = :c_cont";
    private $setPagoAnt = "update resumen,dictamenes
set status_aarsa='PAGO DEL MES ANTERIOR'
where status_aarsa=dictamen and cliente not like 'J%' and cliente not like '%JUR'
and queue='pagos'
and id_cuenta not in (
select c_cont from historia,dictamenes where c_cvst=dictamen
and queue='PAGOS'
and d_fech>last_day(curdate()-interval 1 month))
and id_cuenta not in (
select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and id_cuenta = :c_cont";

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

    private $visitInsertQuery = "INSERT INTO historia (C_CVGE,C_CVBA,C_CONT,C_CVST,D_FECH,C_HRIN,
C_HRFI,C_TELE,CUENTA,C_OBSE1,C_CONTAN,C_ATTE,C_CARG,C_RCON,C_NSE,C_CNIV,C_CFAC,
C_CPTA,C_CTIPO,C_COWN,C_CSTAT,C_VISIT,D_PROM,N_PROM,D_PROM1,N_PROM1,C_PROM,C_FREQ,C_ACCION,C_MOTIV,
C_CREJ,C_CPAT,C_CALLE1,C_CALLE2,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE) 
VALUES (:C_CVGE, :C_CVBA, :C_CONT, :C_CVST, :D_FECH, :C_HRIN, :C_HRFI, 
:C_TELE, :CUENTA, :C_OBSE1, :C_CONTAN, :C_ATTE, :C_CARG, :C_RCON, :C_NSE,
:C_CNIV, :C_CFAC, :C_CPTA, :C_CTIPO, :C_COWN, :C_CSTAT, :C_VISIT, :D_PROM,
:N_PROM, :D_PROM,
:N_PROM, :C_PROM, :C_FREQ, :ACCION, :C_MOTIV, :C_CREJ, :C_CPAT, :C_CALLE1, :C_CALLE2,
:C_NTEL, :C_NDIR, :C_EMAIL, :C_OBSE2, :C_EJE)";
    
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
        $stu->bindParam(':camp', $capt);
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
            if ($row->Field == $field) {
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
        }
        $output = array(
            'notalert' => $result['alert'],
            'notalertt' => $result['fechahora'],
            'cuenta' => $notaData['cuenta'],
            'nota' => $notaData['nota'],
            'fuente' => $notaData['fuente']
        );
        return $output;
    }

    /**
     * 
     */
    public function resumenUpdatePagos() {
        $querypup = "update resumen,pagos
            set fecha_de_ultimo_pago=fecha,monto_ultimo_pago=monto
            where fecha_de_ultimo_pago<fecha
            and pagos.id_cuenta=resumen.id_cuenta;";
        $this->pdo->query($querypup);
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
     * @param int $C_CONT
     */
    public function resumenStatusUpdate($C_CONT) {
        $sti = $this->pdo->prepare($this->setPromesaIncumplida);
        $sti->bindParam(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $sti->execute();

        $stp = $this->pdo->prepare($this->setPagoAnt);
        $stp->bindParam(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $stp->execute();
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
     * @param array $gestion
     * @return int
     */
    public function countDup($gestion) {
        $querydup = "SELECT count(1) as ct FROM historia 
WHERE c_cont = :c_cont and d_fech = :d_fech 
and c_hrin = :c_hrin and c_cvst = :c_cvst 
and c_cvge = :c_cvge and c_obse1 = :c_obse1";
        $std = $this->pdo->prepare($querydup);
        $std->bindParam(':c_cont', $gestion['C_CONT'], \PDO::PARAM_INT);
        $std->bindParam(':d_fech', $gestion['D_FECH']);
        $std->bindParam(':c_hrin', $gestion['C_HRIN']);
        $std->bindParam(':c_cvst', $gestion['C_CVST']);
        $std->bindParam(':c_cvge', $gestion['C_CVGE']);
        $std->bindParam(':c_obse1', $gestion['C:OBSE1']);
        $std->execute();
        $result = $std->fetch(\PDO::FETCH_ASSOC);
        return $result['ct'];
    }
    
    /**
     * 
     * @param array $gestion
     * @return array
     */
    public function countVisitErrors($gestion) {
        $errorv = 0;
        $flagmsgv = "";
        $dupcount = $this->countDup($gestion);
        if ($dupcount > 0) {
            $errorv = $errorv + $dupcount;
            $flagmsgv .= "DOBLE ENTRANTE";
        }
        if (($gestion['N_PROM'] == 0) && ($gestion['C_CVST'] == 'PROMESA DE PAGO TOTAL')) {
            $errorv = $errorv + 1;
            $flagmsgv = $flagmsgv . '<BR>' . "PROMESA NECESITA MONTO";
        }
        if (($gestion['N_PROM'] == 0) && ($gestion['C_CVST'] == 'PROMESA DE PAGO PARCIAL')) {
            $errorv = $errorv + 1;
            $flagmsgv = $flagmsgv . '<BR>' . "PROMESA NECESITA MONTO";
        }
        if (($gestion['N_PROM'] > 0) && ($gestion['D_PROM'] == '0000-00-00')) {
            $errorv = $errorv + 1;
            $flagmsgv = $flagmsgv . '<BR>' . "PROMESA NECESITA FECHA";
        }
        if (($gestion['N_PROM'] == 0) && ($gestion['D_PROM'] >= $gestion['D_FECH'])) {
            $errorv = $errorv + 1;
            $flagmsgv = $flagmsgv . '<BR>' . "PROMESA NECESITA MONTO";
        }
        if ($gestion['C_VISIT'] == '') {
            $errorv = $errorv + 1;
            $flagmsgv = $flagmsgv . '<BR>' . "GESTION NECESITA VISITADOR";
        }
        $output = array(
            'errorv' => $errorv,
            'flagmsgv' => $flagmsgv
        );
        return $output;
    }
    
    /**
     * 
     * @param array $gestion
     * @return int
     */
    public function insertVisit($gestion) {
        $sti = $this->pdo->prepare($this->visitInsertQuery);
        $sti->bindParam(':C_CVGE', $gestion['C_CVGE']);
        $sti->bindParam(':C_CVBA', $gestion['C_CVBA']);
        $sti->bindParam(':C_CONT', $gestion['C_CONT'], \PDO::PARAM_INT);
        $sti->bindParam(':C_CVST', $gestion['C_CVST']);
        $sti->bindParam(':D_FECH', $gestion['D_FECH']);
        $sti->bindParam(':C_HRIN', $gestion['C_HRIN']);
        $sti->bindParam(':C_HRFI', $gestion['C_HRFI']);
        $sti->bindParam(':C_TELE', $gestion['C_TELE']);
        $sti->bindParam(':CUENTA', $gestion['CUENTA']);
        $sti->bindParam(':C_CONTAN', $gestion['C_CONTAN']);
        $sti->bindParam(':C_ATTE', $gestion['C_ATTE']);
        $sti->bindParam(':C_CARG', $gestion['C_CARG']);
        $sti->bindParam(':C_RCON', $gestion['C_RCON']);
        $sti->bindParam(':C_NSE', $gestion['C_NSE']);
        $sti->bindParam(':C_CNIV', $gestion['C_CNIV']);
        $sti->bindParam(':C_CFAC', $gestion['C_CFAC']);
        $sti->bindParam(':C_CPTA', $gestion['C_CPTA']);
        $sti->bindParam(':C_CTIPO', $gestion['C_CTIPO']);
        $sti->bindParam(':C_COWN', $gestion['C_COWN']);
        $sti->bindParam(':C_CSTAT', $gestion['C_CSTAT']);
        $sti->bindParam(':C_VISIT', $gestion['C_VISIT']);
        $sti->bindParam(':D_PROM', $gestion['D_PROM']);
        $sti->bindParam(':N_PROM', $gestion['N_PROM']);
        $sti->bindParam(':C_PROM', $gestion['C_PROM']);
        $sti->bindParam(':C_FREQ', $gestion['C_FREQ']);
        $sti->bindParam(':ACCION', $gestion['ACCION']);
        $sti->bindParam(':C_MOTIV', $gestion['C_MOTIV']);
        $sti->bindParam(':C_CREJ', $gestion['C_CREJ']);
        $sti->bindParam(':C_CPAT', $gestion['C_CPAT']);
        $sti->bindParam(':C_CALLE1', $gestion['C_CALLE1']);
        $sti->bindParam(':C_CALLE2', $gestion['C_CALLE2']);
        $sti->bindParam(':C_NTEL', $gestion['C_NTEL']);
        $sti->bindParam(':C_NDIR', $gestion['C_NDIR']);
        $sti->bindParam(':C_EMAIL', $gestion['C_EMAIL']);
        $sti->bindParam(':C_OBSE2', $gestion['C_OBSE2']);
        $sti->bindParam(':C_EJE', $gestion['C_EJE']);
        $sti->execute();
        $auto = $this->pdo->lastInsertId();
        return $auto;
    }
    
    /**
     * 
     * @param int $auto
     */
    public function addHistdate($auto) {
        $query = "INSERT IGNORE INTO histdate VALUES (:auto, CURDATE())";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':auto', $auto, \PDO::PARAM_INT);
        $stq->execute();
    }
    
    /**
     * 
     * @param int $auto
     */
    public function addHistgest($auto, $c_cvge) {
        $query = "INSERT IGNORE INTO histgest VALUES (:auto, :c_cvge)";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':auto', $auto, \PDO::PARAM_INT);
        $stq->bindParam(':c_cvge', $c_cvge, \PDO::PARAM_INT);
        $stq->execute();
    }
    
}
