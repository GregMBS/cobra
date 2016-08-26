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

}
