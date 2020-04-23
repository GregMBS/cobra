<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;
use PDOException;

/**
 * Description of GestionClass
 *
 * @author gmbs
 */
class GestionClass {

    /**
     *
     * @var PDO
     */
    private $pdo;
    private $gestionInsertQuery = "INSERT INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
C_TELE,CUANDO,CUENTA,C_OBSE1,C_ATTE,C_CARG,D_PROM,N_PROM,C_PROM,
D_PROM1,N_PROM1,D_PROM2,N_PROM2,
D_PROM3,N_PROM3,D_PROM4,N_PROM4,
C_CONTAN,C_ACCION,C_CNP,C_MOTIV,C_CAMP,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE,AUTH) 
VALUES (:C_CVBA, :C_CVGE, :C_CONT, :C_CVST,date(:D_FECH),
:C_HRIN, :C_HRFI, :C_TELE, :CUANDO, :CUENTA, :C_OBSE1, :C_ATTE, :C_CARG, :D_PROM, 
:N_PROM, :C_PROM, :D_PROM1, :N_PROM1, :D_PROM2, :N_PROM2, :D_PROM3, :N_PROM3, 
:D_PROM4, :N_PROM4, :C_CONTAN, :ACCION, :C_CNP, :C_MOTIV, :C_CAMP, :C_NTEL, :C_NDIR, 
:C_EMAIL, :C_OBSE2, :C_EJE, :AUTH)";

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
    private $setPromesaIncumplida = "update resumen
		set status_aarsa='PROMESA INCUMPLIDA'
		where id_cuenta not in (
			select c_cont from historia
			where n_prom>0
			and d_prom>=curdate())
		and id_cuenta in (
			select c_cont from historia
			where n_prom>0
			and d_prom<curdate())
		and numero_de_cuenta not in (
			select cuenta from pagos
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
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param array $gestion
     * @return int
     */
    private function insertVisit($gestion) {
        $hora = $gestion['C_VH'].':'.$gestion['C_VMN'];
        $sti = $this->pdo->prepare($this->visitInsertQuery);
        $sti->bindParam(':C_CVGE', $gestion['C_CVGE']);
        $sti->bindParam(':C_CVBA', $gestion['C_CVBA']);
        $sti->bindParam(':C_CONT', $gestion['C_CONT'], PDO::PARAM_INT);
        $sti->bindParam(':C_CVST', $gestion['C_CVST']);
        $sti->bindParam(':D_FECH', $gestion['C_VD']);
        $sti->bindParam(':C_HRIN', $hora);
        $sti->bindParam(':C_HRFI', $gestion['C_HRFI']);
        $sti->bindParam(':C_TELE', $gestion['C_TELE']);
        $sti->bindParam(':CUENTA', $gestion['CUENTA']);
        $sti->bindParam(':C_OBSE1', $gestion['C_OBSE1']);
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
    private function addHistdate($auto) {
        $query = "INSERT IGNORE INTO histdate VALUES (:auto, CURDATE())";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stq->execute();
    }

    /**
     *
     * @param int $auto
     * @param string $c_cvge
     */
    public function addHistgest($auto, $c_cvge) {
        $query = "INSERT IGNORE INTO histgest VALUES (:auto, :c_cvge)";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':auto', $auto, PDO::PARAM_INT);
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
        $stn->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
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
        $stn->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $email
     */
    private function updateEmail($C_CONT, $email) {
        $queryndir = "UPDATE resumen SET email_deudor = :email WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryndir);
        $stn->bindParam(':email', $email);
        $stn->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
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
        $query = "select c_cvge from historia 
        where n_prom>0 and c_cvge like 'PRO%' and c_cont = :C_CONT 
        order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $stn->execute();
        $result = $stn->fetch(PDO::FETCH_ASSOC);
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
        $sti->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $sti->bindParam(':D_PAGO', $D_PAGO);
        $sti->bindParam(':N_PAGO', $N_PAGO);
        $sti->bindParam(':who', $who);
        $sti->execute();
    }

    /**
     * 
     */
    private function updateAllUltimoPagos() {
        $querypup = "update resumen,pagos 
                set fecha_de_ultimo_pago = fecha, monto_ultimo_pago = monto 
                where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta;";
        $this->pdo->query($querypup);
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $best
     */
    private function resumenStatusUpdate($C_CONT, $best = '') {
        $querysa = "update resumen set status_aarsa = :best where id_cuenta = :C_CONT";
        $stb = $this->pdo->prepare($querysa);
        $stb->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $stb->bindParam(':best', $best);
        $stb->execute();
        $sti = $this->pdo->prepare($this->setPromesaIncumplida);
        $sti->bindParam(':c_cont', $C_CONT, PDO::PARAM_INT);
        $sti->execute();

        $stp = $this->pdo->prepare($this->setPagoAnt);
        $stp->bindParam(':c_cont', $C_CONT, PDO::PARAM_INT);
        $stp->execute();
    }

    /**
     * 
     * @param array $gestion
     * @return int
     */
    private function insertGestion($gestion) {
        try {
            $sti = $this->pdo->prepare($this->gestionInsertQuery);
            $sti->bindParam(':C_CVBA', $gestion['C_CVBA']);
            $sti->bindParam(':C_CVGE', $gestion['C_CVGE']);
            $sti->bindParam(':C_CONT', $gestion['C_CONT'], PDO::PARAM_INT);
            $sti->bindParam(':C_CVST', $gestion['C_CVST']);
            $sti->bindParam(':D_FECH', $gestion['D_FECH']);
            $sti->bindParam(':C_HRIN', $gestion['C_HRIN']);
            $sti->bindValue(':C_HRFI', date('H:i:s'));
            $sti->bindParam(':C_TELE', $gestion['C_TELE']);
            $sti->bindParam(':CUANDO', $gestion['CUANDO']);
            $sti->bindParam(':CUENTA', $gestion['CUENTA']);
            $sti->bindParam(':C_OBSE1', $gestion['C_OBSE1']);
            $sti->bindParam(':C_ATTE', $gestion['C_ATTE']);
            $sti->bindParam(':C_CARG', $gestion['C_CARG']);
            $sti->bindParam(':D_PROM', $gestion['D_PROM']);
            $sti->bindParam(':N_PROM', $gestion['N_PROM']);
            $sti->bindParam(':C_PROM', $gestion['C_PROM']);
            $sti->bindParam(':D_PROM1', $gestion['D_PROM1']);
            $sti->bindParam(':N_PROM1', $gestion['N_PROM1']);
            $sti->bindParam(':D_PROM2', $gestion['D_PROM2']);
            $sti->bindParam(':N_PROM2', $gestion['N_PROM2']);
            $sti->bindParam(':D_PROM3', $gestion['D_PROM3']);
            $sti->bindParam(':N_PROM3', $gestion['N_PROM3']);
            $sti->bindParam(':D_PROM4', $gestion['D_PROM4']);
            $sti->bindParam(':N_PROM4', $gestion['N_PROM4']);
            $sti->bindParam(':C_CONTAN', $gestion['C_CONTAN']);
            $sti->bindParam(':ACCION', $gestion['ACCION']);
            $sti->bindParam(':C_CNP', $gestion['C_CNP']);
            $sti->bindParam(':C_MOTIV', $gestion['C_MOTIV']);
            $sti->bindParam(':C_CAMP', $gestion['camp']);
            $sti->bindParam(':C_NTEL', $gestion['C_NTEL']);
            $sti->bindParam(':C_NDIR', $gestion['C_NDIR']);
            $sti->bindParam(':C_EMAIL', $gestion['C_EMAIL']);
            $sti->bindParam(':C_OBSE2', $gestion['C_OBSE2']);
            $sti->bindParam(':C_EJE', $gestion['C_EJE']);
            $sti->bindParam(':AUTH', $gestion['AUTH']);
            $sti->execute();
        } catch (PDOException $exc) {
            //$auto = 0;
            var_dump($exc);
            die();
        }
        $auto = $this->pdo->lastInsertId();
        return $auto;
    }

    private function beginTransaction() {
        $this->pdo->beginTransaction();
    }

    private function commitTransaction() {
        $this->pdo->commit();
    }

    /**
     * 
     * @param int $auto
     * @param array $gestion
     */
    private function doCommon($auto, $gestion) {
        $this->addHistgest($auto, $gestion['C_CVGE']);
        if (!empty($gestion['C_NTEL'])) {
            $this->addNewTel($gestion['C_CONT'], $gestion['C_NTEL']);
        }
        if (!empty($gestion['C_OBSE2'])) {
            $this->addNewTel($gestion['C_CONT'], $gestion['C_OBSE2']);
        }
        if (!empty($gestion['C_NDIR'])) {
            $this->updateAddress($gestion['C_CONT'], $gestion['C_NDIR']);
        }
        if (!empty($gestion['C_EMAIL'])) {
            $this->updateEmail($gestion['C_CONT'], $gestion['C_EMAIL']);
        }
        if ($gestion['N_PAGO'] > 0) {
            $who = $this->attributePayment($gestion['C_CVGE'], $gestion['C_CONT']);
            $this->addPago($gestion['C_CONT'], $gestion['D_PAGO'], $gestion['N_PAGO'], $who);
        }
        $this->updateAllUltimoPagos();

        $best = $this->getBest($gestion['C_CVST'], $gestion['C_CONT']);
        $this->resumenStatusUpdate($gestion['C_CONT'], $best);
    }

    public function doVisit($gestion) {
        $auto = $this->insertVisit($gestion);
        $this->addHistdate($auto);
        $this->doCommon($auto, $gestion);
    }

    public function doGestion($gestion) {
        $this->beginTransaction();
        $auto = $this->insertGestion($gestion);
        if ($auto == 0) {
            var_dump($gestion);
            die();
        }
        $this->doCommon($auto, $gestion);
        $this->commitTransaction();
    }

    /**
     * 
     * @param string $c_cvst
     * @param int $c_cont
     * @return string
     */
    public function getBest($c_cvst, $c_cont) {
        $query = "SELECT c_cvst FROM historia, dictamenes "
                . "WHERE d_fech > CURDATE() - INTERVAL 30 DAY "
                . "AND c_cvst = dictamen "
                . "AND c_cont = :c_cont "
                . "ORDER BY v_cc "
                . "LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont, PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        if (isset($result['c_cvst'])) {
            $c_cvst = $result['c_cvst'];
        }
        return $c_cvst;
    }

}
