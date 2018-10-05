<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * Description of GestionClass
 *
 * @author gmbs
 */
class GestionClass extends BaseClass
{

    /**
     *
     * @var string
     */
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
C_CPTA,C_VISIT,D_PROM,N_PROM,D_PROM1,N_PROM1,C_PROM,C_FREQ,C_ACCION,C_MOTIV,
C_CREJ,C_CPAT,C_CALLE1,C_CALLE2,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE) 
VALUES (:C_CVGE, :C_CVBA, :C_CONT, :C_CVST, :D_FECH, :C_HRIN, :C_HRFI, 
:C_TELE, :CUENTA, :C_OBSE1, :C_CONTAN, :C_ATTE, :C_CARG, :C_RCON, :C_NSE,
:C_CNIV, :C_CFAC, :C_CPTA, :C_VISIT, :D_PROM,
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
     * @param array $gestion
     * @return int
     */
    private function insertVisit($gestion)
    {
        $sti = $this->pdo->prepare($this->visitInsertQuery);
        $sti->bindValue(':C_CVGE', $gestion['C_CVGE']);
        $sti->bindValue(':C_CVBA', $gestion['C_CVBA']);
        $sti->bindValue(':C_CONT', $gestion['C_CONT'], \PDO::PARAM_INT);
        $sti->bindValue(':C_CVST', $gestion['C_CVST']);
        $sti->bindValue(':D_FECH', $gestion['D_FECH']);
        $sti->bindValue(':C_HRIN', $gestion['C_HRIN']);
        $sti->bindValue(':C_HRFI', $gestion['C_HRFI']);
        $sti->bindValue(':C_TELE', $gestion['C_TELE']);
        $sti->bindValue(':CUENTA', $gestion['CUENTA']);
        $sti->bindValue(':C_OBSE1', $gestion['C_OBSE1']);
        $sti->bindValue(':C_CONTAN', $gestion['C_CONTAN']);
        $sti->bindValue(':C_ATTE', $gestion['C_ATTE']);
        $sti->bindValue(':C_CARG', $gestion['C_CARG']);
        $sti->bindValue(':C_RCON', $gestion['C_RCON']);
        $sti->bindValue(':C_NSE', $gestion['C_NSE']);
        $sti->bindValue(':C_CNIV', $gestion['C_CNIV']);
        $sti->bindValue(':C_CFAC', $gestion['C_CFAC']);
        $sti->bindValue(':C_CPTA', $gestion['C_CPTA']);
        $sti->bindValue(':C_CTIPO', $gestion['C_CTIPO']);
        $sti->bindValue(':C_COWN', $gestion['C_COWN']);
        $sti->bindValue(':C_CSTAT', $gestion['C_CSTAT']);
        $sti->bindValue(':C_VISIT', $gestion['C_VISIT']);
        $sti->bindValue(':D_PROM', $gestion['D_PROM']);
        $sti->bindValue(':N_PROM', $gestion['N_PROM']);
        $sti->bindValue(':C_PROM', $gestion['C_PROM']);
        $sti->bindValue(':C_FREQ', $gestion['C_FREQ']);
        $sti->bindValue(':ACCION', $gestion['C_ACCION']);
        $sti->bindValue(':C_MOTIV', $gestion['C_MOTIV']);
        $sti->bindValue(':C_CREJ', $gestion['C_CREJ']);
        $sti->bindValue(':C_CPAT', $gestion['C_CPAT']);
        $sti->bindValue(':C_CALLE1', $gestion['C_CALLE1']);
        $sti->bindValue(':C_CALLE2', $gestion['C_CALLE2']);
        $sti->bindValue(':C_NTEL', $gestion['C_NTEL']);
        $sti->bindValue(':C_NDIR', $gestion['C_NDIR']);
        $sti->bindValue(':C_EMAIL', $gestion['C_EMAIL']);
        $sti->bindValue(':C_OBSE2', $gestion['C_OBSE2']);
        $sti->bindValue(':C_EJE', $gestion['C_EJE']);
        $sti->execute();
        $auto = $this->pdo->lastInsertId();
        return $auto;
    }

    /**
     *
     * @param int $auto
     */
    private function addHistdate($auto)
    {
        $query = "INSERT IGNORE INTO histdate VALUES (:auto, CURDATE())";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':auto', $auto, \PDO::PARAM_INT);
        $stq->execute();
    }

    /**
     * @param int $auto
     * @param string $c_cvge
     */
    private function addHistgest($auto, $c_cvge)
    {
        $query = "INSERT IGNORE INTO histgest VALUES (:auto, :c_cvge)";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':auto', $auto, \PDO::PARAM_INT);
        $stq->bindValue(':c_cvge', $c_cvge);
        $stq->execute();
    }

    /**
     *
     * @param int $C_CONT
     * @param string $tele
     * @return array
     */
    public function addNewTel($C_CONT, $tele = '')
    {
        if (!empty($tele)) {
            $tel = filter_var($tele, FILTER_SANITIZE_NUMBER_INT);
            $query = "UPDATE resumen " . "SET tel_4_verif = tel_3_verif," . "tel_3_verif = tel_2_verif," . "tel_2_verif = tel_1_verif," . "tel_1_verif = :tel " . "WHERE id_cuenta = :C_CONT";
            $stn = $this->pdo->prepare($query);
            $stn->bindValue(':tel', $tel);
            $stn->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
            $stn->execute();
        }
        $rc = new Resumen();
        /**
         * @var Resumen $query
         */
        $query = $rc->whereIdCuenta($C_CONT);
        /**
         * @var Collection $result
         */
        $result = $query->get();
        /**
         * @var Resumen $cuenta
         */
        $cuenta = $result->first();
        $data = $cuenta->toArray();
        $keys = array_flip(['tel_1_verif', 'tel_2_verif', 'tel_3_verif', 'tel_4_verif']);
        $output = array_intersect_key($data, $keys);
        return $output;
    }

    /**
     *
     * @param int $C_CONT
     * @param string $ndir
     */
    public function updateAddress($C_CONT, $ndir)
    {
        $queryndir = "UPDATE resumen SET direccion_nueva = :ndir WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryndir);
        $stn->bindValue(':ndir', $ndir);
        $stn->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     *
     * @param int $C_CONT
     * @param string $email
     */
    private function updateEmail($C_CONT, $email)
    {
        $queryndir = "UPDATE resumen SET email_deudor = :email WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryndir);
        $stn->bindValue(':email', $email);
        $stn->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     *
     * @param string $capt
     * @param int $C_CONT
     * @return string
     */
    private function attributePayment($capt, $C_CONT)
    {
        $who = $capt;
        $queryd = "select c_cvge " . "from historia " . "where n_prom>0 " . "and c_cvge like 'PRO%' " . "and c_cont = :C_CONT " . "order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($queryd);
        $stn->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
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
    private function addPago($C_CONT, $D_PAGO, $N_PAGO, $who)
    {
        $queryins = "INSERT IGNORE INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT numero_de_cuenta, :D_PAGO, :N_PAGO, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE id_cuenta = :C_CONT";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $sti->bindValue(':D_PAGO', $D_PAGO);
        $sti->bindValue(':N_PAGO', $N_PAGO);
        $sti->bindValue(':who', $who);
        $sti->execute();
    }

    /**
     */
    private function updateAllUltimoPagos()
    {
        $querypup = "update resumen,pagos 
                set fecha_de_ultimo_pago = fecha, monto_ultimo_pago = monto 
                where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta";
        $this->pdo->query($querypup);
    }

    /**
     *
     * @param int $C_CONT
     * @param string $best
     */
    private function resumenStatusUpdate($C_CONT, $best)
    {
        $querysa = "update resumen set status_aarsa = :best where id_cuenta = :c_cont";
        $stb = $this->pdo->prepare($querysa);
        $stb->bindValue(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $stb->bindValue(':best', $best);
        $stb->execute();
        $sti = $this->pdo->prepare($this->setPromesaIncumplida);
        $sti->bindValue(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $sti->execute();
        
        $stp = $this->pdo->prepare($this->setPagoAnt);
        $stp->bindValue(':c_cont', $C_CONT, \PDO::PARAM_INT);
        $stp->execute();
    }

    /**
     *
     * @param GestionDataClass $gestion
     * @return int
     */
    private function insertGestion(GestionDataClass $gestion)
    {
        $sti = $this->pdo->prepare($this->gestionInsertQuery);
        $sti->bindValue(':C_CVBA', $gestion->getCCVBA());
        $sti->bindValue(':C_CVGE', $gestion->getCCVGE());
        $sti->bindValue(':C_CONT', $gestion->getCCONT(), \PDO::PARAM_INT);
        $sti->bindValue(':C_CVST', $gestion->getCCVST());
        $sti->bindValue(':D_FECH', $gestion->getDFECH());
        $sti->bindValue(':C_HRIN', $gestion->getCHRIN());
        $sti->bindValue(':C_HRFI', $gestion->getCHRFI());
        $sti->bindValue(':C_TELE', $gestion->getCTELE());
        $sti->bindValue(':CUANDO', $gestion->getCUANDO());
        $sti->bindValue(':CUENTA', $gestion->getCUENTA());
        $sti->bindValue(':C_OBSE1', $gestion->getCOBSE1());
        $sti->bindValue(':C_ATTE', $gestion->getCATTE());
        $sti->bindValue(':C_CARG', $gestion->getCCARG());
        $sti->bindValue(':D_PROM', $gestion->getDPROM());
        $sti->bindValue(':N_PROM', $gestion->getNPROM());
        $sti->bindValue(':C_PROM', $gestion->getCPROM());
        $sti->bindValue(':D_PROM1', $gestion->getDPROM1());
        $sti->bindValue(':N_PROM1', $gestion->getNPROM1());
        $sti->bindValue(':D_PROM2', $gestion->getDPROM2());
        $sti->bindValue(':N_PROM2', $gestion->getNPROM2());
        $sti->bindValue(':D_PROM3', $gestion->getDPROM3());
        $sti->bindValue(':N_PROM3', $gestion->getNPROM3());
        $sti->bindValue(':D_PROM4', $gestion->getDPROM4());
        $sti->bindValue(':N_PROM4', $gestion->getNPROM4());
        $sti->bindValue(':C_CONTAN', $gestion->getCCONTAN());
        $sti->bindValue(':ACCION', $gestion->getCACCION());
        $sti->bindValue(':C_CNP', $gestion->getCCNP());
        $sti->bindValue(':C_MOTIV', $gestion->getCMOTIV());
        $sti->bindValue(':C_CAMP', $gestion->getCCAMP());
        $sti->bindValue(':C_NTEL', $gestion->getCNTEL());
        $sti->bindValue(':C_NDIR', $gestion->getCNDIR());
        $sti->bindValue(':C_EMAIL', $gestion->getCEMAIL());
        $sti->bindValue(':C_OBSE2', $gestion->getCOBSE2());
        $sti->bindValue(':C_EJE', $gestion->getCEJE());
        $sti->bindValue(':AUTH', $gestion->getAUTH());
        $sti->execute();
        dd($sti);
        $auto = $this->pdo->lastInsertId();
        return $auto;
    }

    private function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    private function commitTransaction()
    {
        $this->pdo->commit();
    }

    /**
     *
     * @param int $auto
     * @param array $gestion
     */
    private function doCommon($auto, $gestion)
    {
        $this->addHistgest($auto, $gestion['C_CVGE']);
        if (! empty($gestion['C_NTEL'])) {
            $this->addNewTel($gestion['C_CONT'], $gestion['C_NTEL']);
        }
        if (! empty($gestion['C_OBSE2'])) {
            $this->addNewTel($gestion['C_CONT'], $gestion['C_OBSE2']);
        }
        if (! empty($gestion['C_NDIR'])) {
            $this->updateAddress($gestion['C_CONT'], $gestion['C_NDIR']);
        }
        if (! empty($gestion['C_EMAIL'])) {
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
     * 90 days
     *
     * @param string $C_CVST
     * @param int $C_CONT
     * @return string
     */
    private function getBest($C_CVST, $C_CONT)
    {
        $best = $C_CVST;
        $querybest = "select c_cvst,v_cc from historia,dictamenes"
            . " where c_cvst=dictamen and c_cont = :C_CONT"
            . " and d_fech>last_day(curdate()-interval 90 day)"
            . " order by v_cc LIMIT 1";
        $stb = $this->pdo->prepare($querybest);
        $stb->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $result = $stb->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvst'])) {
            $best = $result['c_cvst'];
        }
        return $best;
    }



    /**
     * 
     * @param array $gestion
     * @return ValidationErrorClass
     */
    public function doVisit($gestion)
    {
        $vc = new ValidationClass();
        $valid = $vc->countVisitErrors($gestion);
        if ($valid->flag) {
            return $valid;
        }
        $auto = $this->insertVisit($gestion);
        $this->addHistdate($auto);
        $this->doCommon($auto, $gestion);
        return $valid;
    }

    /**
     * @param array $gestion
     * @return array
     */
    private function loadProms(array $gestion)
    {
        $proms = array();
        for ($i=1; $i<5; $i++) {
            $proms[] = array('n' => $gestion['N_PROM'.$i], 'd' => $gestion['D_PROM'.$i]);
        }
        return $proms;
    }

    /**
     * @param array $gestion
     * @return ValidationErrorClass|boolean
     * @throws \UnexpectedValueException
     */
    public function doGestion(array $gestion)
    {
        $vc = new ValidationClass();
        $valid = $vc->countGestionErrors($gestion);
        if ($valid->flag) {
            return $valid;
        }
        $gdc = new GestionDataClass($gestion['C_CONT']);
        $gdc->setCCVST($gestion['C_CVST']);
        $gdc->setCCVGE($gestion['C_CVGE']);
        $gdc->setCACCION($gestion['C_ACCION']);
        $gdc->setAUTH($gestion['AUTH']);
        //$gdc->setCATTE($gestion['C_ATTE']);
        $gdc->setCCARG($gestion['C_CARG']);
        $gdc->setCCNP($gestion['C_CNP']);
        $gdc->setCEMAIL($gestion['C_EMAIL']);
        $gdc->setCHRIN($gestion['C_HRIN']);
        $gdc->setCMOTIV($gestion['C_MOTIV']);
        $gdc->setCNDIR($gestion['C_NDIR']);
        $gdc->setCNTEL($gestion['C_NTEL']);
        $gdc->setCOBSE1($gestion['C_OBSE1']);
        $gdc->setCOBSE2($gestion['C_OBSE2']);
        $gdc->setCTELE($gestion['C_TELE']);
        $gdc->setCPROM($gestion['C_PROM']);
        $gdc->setCOBSE1($gestion['C_OBSE1']);
        $gdc->setNPAGO($gestion['N_PAGO']);
        $gdc->setDPAGO($gestion['D_PAGO']);
        $gdc->setCUANDO($gestion['CUANDO']);
        $proms = $this->loadProms($gestion);
        $gdc->setProms($proms);
        $this->beginTransaction();
        $auto = $this->insertGestion($gdc);
        $this->doCommon($auto, $gestion);
        $this->commitTransaction();
        return true;
    }
}
