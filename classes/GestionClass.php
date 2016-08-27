<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of GestionClass
 *
 * @author gmbs
 */
class GestionClass {

    /**
     *
     * @var \PDO
     */
    private $pdo;

    /**
     *
     * @var string
     */
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

    /**
     *
     * @var string 
     */
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
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
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
     * @return array
     */
    public function countGestionErrors($gestion) {
        $error = 0;
        $flagmsg = "";
        $dupcount = $this->countDup($gestion);
        if ($dupcount > 0) {
            $error = $error + $dupcount;
            $flagmsg .= "DOBLE ENTRANTE";
        }
        $paid = array('PAGANDO CONVENIO', 'PAGO TOTAL', 'PAGO PARCIAL');
        $promised = array('PROMESA DE PAGO TOTAL', 'PROMESA DE PAGO PARCIAL');
        if (($gestion['N_PAGO'] == 0) && (in_array($gestion['C_CVST'], $paid))) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
        }
        if ((substr($gestion['C_CVST'], 0, 11) == 'MENSAJE CON') && ($gestion['C_CARG'] == '')) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "MENSAJE NECESITA PARENTESCO/CARGO";
        }
        if (($gestion['N_PROM'] == 0) && (in_array($gestion['C_CVST'], $promised))) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
        }
        if (($gestion['N_PROM'] > 0) && ($gestion['D_PROM'] == '0000-00-00')) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA FECHA";
        }
        if (($gestion['N_PAGO'] > 0) && ($gestion['D_PAGO'] == '0000-00-00')) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "PAGO NECESITA FECHA";
        }
        if (($gestion['N_PROM'] > 0) && ($gestion['D_PROM'] == '')) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA FECHA";
        }
        if (($gestion['N_PROM'] == 0) && ($gestion['D_PROM'] >= $gestion['D_FECH'])) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
        }
        if (($gestion['N_PROM1'] == 0) && ($gestion['N_PROM2'] > 0)) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "USA PROMESA INICIAL ANTES PROMESA TERMINAL";
        }
        if ($gestion['C_TELE'] == '') {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "GESTION NECESITA TELEFONO";
        }

        $output = array(
            'error' => $error,
            'flagmsg' => $flagmsg
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
        $stq->bindParam(':c_cvge', $c_cvge);
        $stq->execute();
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $tele
     */
    public function addNewTel($C_CONT, $tele) {
        $tel = filter_var($tele, FILTER_SANITIZE_NUMBER_INT);
        $queryntel = "UPDATE resumen "
                . "SET tel_4_verif = tel_3_verif,"
                . "tel_3_verif = tel_2_verif,"
                . "tel_2_verif = tel_1_verif,"
                . "tel_1_verif = :tel "
                . "WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryntel);
        $stn->bindParam(':tel', $tel);
        $stn->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $ndir
     */
    public function updateAddress($C_CONT, $ndir) {
        $queryndir = "UPDATE resumen SET direccion_nueva = :ndir WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryndir);
        $stn->bindParam(':ndir', $ndir);
        $stn->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $email
     */
    public function updateEmail($C_CONT, $email) {
        $queryndir = "UPDATE resumen SET email_deudor = :email WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryndir);
        $stn->bindParam(':email', $email);
        $stn->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     * 
     * @param string $capt
     * @param int $C_CONT
     * @return string
     */
    public function attributePayment($capt, $C_CONT) {
        $who = $capt;
        $queryd = "select c_cvge "
                . "from historia "
                . "where n_prom>0 "
                . "and c_cvge like 'PRO%' "
                . "and c_cont = :C_CONT "
                . "order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($queryd);
        $stn->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvge'])) {
            $who = $result['c_cvge'];
        }
        return $who;
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $D_PAGO
     * @param float $N_PAGO
     * @param string $who
     */
    public function addPago($C_CONT, $D_PAGO, $N_PAGO, $who) {
                $queryins = "INSERT IGNORE INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT numero_de_cuenta, :D_PAGO, :N_PAGO, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE id_cuenta = :C_CONT";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $sti->bindParam(':D_PAGO', $D_PAGO);
        $sti->bindParam(':N_PAGO', $N_PAGO);
        $sti->bindParam(':who', $who);
        $sti->execute();
    }
    
    /**
     * 
     */
    public function updateAllUltimoPagos() {
            $querypup = "update resumen,pagos 
                set fecha_de_ultimo_pago = fecha, monto_ultimo_pago = monto 
                where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta;";
            $this->pdo->query($querypup);
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
     * @param int $C_CONT
     * @param string $best
     */
    public function resumenStatusUpdate($C_CONT, $best) {
        $querysa = "update resumen set status_aarsa = :best where id_cuenta = :C_CONT";
        $stb = $this->pdo->prepare($$querysa);
        $stb->bindParam(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $stb->bindParam(':best', $best);
        $stb->execute();
        $sti = $this->pdo->prepare($this->setPromesaIncumplida);
        $sti->bindParam(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $sti->execute();

        $stp = $this->pdo->prepare($this->setPagoAnt);
        $stp->bindParam(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $stp->execute();
    }

}
