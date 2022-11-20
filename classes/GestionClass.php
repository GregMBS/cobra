<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Exception;
use PDO;
use PDOException;
use RuntimeException;

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
    private PDO $pdo;
    private string $gestionInsertQuery = "INSERT IGNORE INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
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
    private string $visitInsertQuery = "INSERT INTO historia (C_CVGE,C_CVBA,C_CONT,C_CVST,D_FECH,C_HRIN,
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
    private string $setPromesaIncumplida = "update resumen
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
			'PROMESA DE PAGO RECURRENTE',
			'PROMESA DE PAGO TOTAL',
			'CONFIRMA PROMESA')
		and id_cuenta = :c_cont";

    /**
     *
     * @var string 
     */
    private string $setPagoAnt = "update resumen,dictamenes
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
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param array $gestion
     * @return int
     */
    private function insertVisit(array $gestion): int
    {
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
        return intval($this->pdo->lastInsertId());
    }

    /**
     * 
     * @param int $auto
     */
    private function addHistdate(int $auto) {
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
    private function addHistgest(int $auto, string $c_cvge) {
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
    public function addNewTel(int $C_CONT, string $tele) {
        $tel = filter_var($tele, FILTER_SANITIZE_NUMBER_INT);
        $query = "UPDATE resumen 
        SET tel_4_verif = tel_3_verif, 
        tel_3_verif = tel_2_verif, 
        tel_2_verif = tel_1_verif, 
        tel_1_verif = :tel 
        WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':tel', $tel);
        $stn->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $ndir
     */
    public function updateAddress(int $C_CONT, string $ndir) {
        $query = "UPDATE resumen SET direccion_nueva = :ndir WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':ndir', $ndir);
        $stn->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $email
     */
    private function updateEmail(int $C_CONT, string $email) {
        $query = "UPDATE resumen SET email_deudor = :email WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($query);
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
    private function attributePayment(string $capt, int $C_CONT): string
    {
        $who = $capt;
        $query = "select c_cvge 
        from historia 
        where n_prom > 0
        and c_cont = :C_CONT 
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
    private function addPago(int $C_CONT, string $D_PAGO, float $N_PAGO, string $who) {
        $query = "INSERT IGNORE INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT numero_de_cuenta, :D_PAGO, :N_PAGO, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE id_cuenta = :C_CONT";
        $sti = $this->pdo->prepare($query);
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
        $query = "update resumen,pagos 
                set fecha_de_ultimo_pago = fecha, monto_ultimo_pago = monto 
                where fecha_de_ultimo_pago < fecha and pagos.id_cuenta = resumen.id_cuenta";
        $this->pdo->query($query);
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $best
     */
    private function resumenStatusUpdate(int $C_CONT, string $best = '') {
        $query = "UPDATE resumen SET status_aarsa = :best, fecha_ultima_gestion = NOW() 
        WHERE id_cuenta = :C_CONT";
        $stb = $this->pdo->prepare($query);
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
     * @throws Exception
     */
    private function insertGestion(array $gestion): int
    {
        try {
            $sti = $this->pdo->prepare($this->gestionInsertQuery);
            $sti->bindValue(':C_CVBA', $gestion['C_CVBA']);
            $sti->bindValue(':C_CVGE', $gestion['C_CVGE']);
            $sti->bindValue(':C_CONT', $gestion['C_CONT'], PDO::PARAM_INT);
            $sti->bindValue(':C_CVST', $gestion['C_CVST']);
            $sti->bindValue(':D_FECH', $gestion['D_FECH']);
            $sti->bindValue(':C_HRIN', $gestion['C_HRIN']);
            $sti->bindValue(':C_HRFI', date('H:i:s'));
            $sti->bindValue(':C_TELE', $gestion['C_TELE']);
            $sti->bindValue(':CUANDO', $gestion['CUANDO']);
            $sti->bindValue(':CUENTA', $gestion['CUENTA']);
            $sti->bindValue(':C_OBSE1', $gestion['C_OBSE1']);
            $sti->bindValue(':C_ATTE', $gestion['C_ATTE']);
            $sti->bindValue(':C_CARG', $gestion['C_CARG']);
            $sti->bindValue(':D_PROM', $gestion['D_PROM1']);
            $sti->bindValue(':N_PROM', (float) $gestion['N_PROM']);
            $sti->bindValue(':C_PROM', $gestion['C_PROM']);
            $sti->bindValue(':D_PROM1', $gestion['D_PROM1']);
            $sti->bindValue(':N_PROM1', (float) $gestion['N_PROM1']);
            $sti->bindValue(':D_PROM2', $gestion['D_PROM2']);
            $sti->bindValue(':N_PROM2', (float) $gestion['N_PROM2']);
            $sti->bindValue(':D_PROM3', $gestion['D_PROM3']);
            $sti->bindValue(':N_PROM3', (float) $gestion['N_PROM3']);
            $sti->bindValue(':D_PROM4', $gestion['D_PROM4']);
            $sti->bindValue(':N_PROM4', (float) $gestion['N_PROM4']);
            $sti->bindValue(':C_CONTAN', $gestion['C_CONTAN']);
            $sti->bindValue(':ACCION', $gestion['ACCION']);
            $sti->bindValue(':C_CNP', $gestion['C_CNP']);
            $sti->bindValue(':C_MOTIV', $gestion['C_MOTIV']);
            $sti->bindValue(':C_CAMP', $gestion['camp']);
            $sti->bindValue(':C_NTEL', $gestion['C_NTEL']);
            $sti->bindValue(':C_NDIR', $gestion['C_NDIR']);
            $sti->bindValue(':C_EMAIL', $gestion['C_EMAIL']);
            $sti->bindValue(':C_OBSE2', $gestion['C_OBSE2']);
            $sti->bindValue(':C_EJE', $gestion['C_EJE']);
            $sti->bindValue(':AUTH', $gestion['AUTH']);
            $sti->execute();
            $auto = intval($this->pdo->lastInsertId());
            if ($auto > 0) {
                return $auto;
            }
            throw new Exception(json_encode($sti->errorInfo()));
        } catch (PDOException $exc) {
            throw new Exception($exc);
        }
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
    private function doCommon(int $auto, array $gestion) {
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

    /**
     * @param array $gestion
     */
    public function doVisit(array $gestion) {
        $auto = $this->insertVisit($gestion);
        $this->addHistdate($auto);
        $this->doCommon($auto, $gestion);
    }

    /**
     * @param array $gestion
     * @throws Exception
     */
    public function doGestion(array $gestion) {
        $this->beginTransaction();
        $auto = $this->insertGestion($gestion);
        if ($auto === 0) {
            throw new RuntimeException('INPUT GESTION FAILS');
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
    private function getBest(string $c_cvst, int $c_cont): string
    {
        $checkAclaracion = "SELECT count(1) as ct FROM historia 
        WHERE c_cvst IN ('ACLARACION', 'QUEJA CONDUSEF')
        AND c_cont = :c_cont
        AND d_fech > (curdate() - interval 1 year)";
        $sta = $this->pdo->prepare($checkAclaracion);
        $sta->bindParam(':c_cont', $c_cont, PDO::PARAM_INT);
        $sta->execute();
        $count = $sta->fetch(PDO::FETCH_ASSOC);
        if ($count['ct'] > 0) {
            return 'ACLARACION';
        }
        $query = "SELECT c_cvst FROM historia, dictamenes 
        WHERE c_cvst = dictamen 
        AND c_cont = :c_cont 
        ORDER BY v_cc 
        LIMIT 1";
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
