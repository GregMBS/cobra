<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Description of CallClass
 *
 * @author gmbs
 */
class CallClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $historyInsertQuery = "INSERT INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
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
    private $setPromiseFailed = "update resumen
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
		and id_cuenta = :id";

    /**
     *
     * @var string
     */
    private $setOldPayment = "update resumen,dictamenes
set status_aarsa='PAGO DEL MES ANTERIOR'
where status_aarsa=dictamen and cliente not like 'J%' and cliente not like '%JUR'
and queue='pagos'
and id_cuenta not in (
select c_cont from historia,dictamenes where c_cvst=dictamen
and queue='PAGOS'
and d_fech>last_day(curdate()-interval 1 month))
and id_cuenta not in (
select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and id_cuenta = :id";

    /**
     *
     * @param VisitDataClass $gestion
     * @return int
     */
    private function insertVisit(VisitDataClass $gestion)
    {
        $visit = new Historia();
        $visit->C_CVGE = $gestion->getCCVGE();
        $visit->C_CVBA = $gestion->getCCVBA();
        $visit->C_CONT = $gestion->getCCONT();
        $visit->C_CVST = $gestion->getCCVST();
        $visit->D_FECH = $gestion->getDFECH();
        $visit->C_HRIN = $gestion->getCHRIN();
        $visit->C_HRFI = $gestion->getCHRFI();
        $visit->C_TELE = $gestion->getCTELE();
        $visit->CUENTA = $gestion->getCUENTA();
        $visit->C_OBSE1 = $gestion->getCOBSE1();
        $visit->C_CONTAN = $gestion->getCCONTAN();
        $visit->C_ATTE = $gestion->getCATTE();
        $visit->C_CARG = $gestion->getCCARG();
        $visit->C_RCON = $gestion->getCRCON();
        $visit->C_NSE = $gestion->getCNSE();
        $visit->C_CNIV = $gestion->getCCNIV();
        $visit->C_CFAC = $gestion->getCCFAC();
        $visit->C_CPTA = $gestion->getCCPTA();
        $visit->C_VISIT = $gestion->getCVISIT();
        $visit->D_PROM = $gestion->getDPROM();
        $visit->N_PROM = $gestion->getNPROM();
        $visit->D_PROM = $gestion->getDPROM();
        $visit->N_PROM = $gestion->getNPROM();
        $visit->C_PROM = $gestion->getCPROM();
        $visit->C_FREQ = '';
        $visit->C_ACCION = $gestion->getCACCION();
        $visit->C_MOTIV = $gestion->getCMOTIV();
        $visit->C_CREJ = $gestion->getCCREJ();
        $visit->C_CPAT = $gestion->getCCPAT();
        $visit->C_CALLE1 = $gestion->getCCALLE1();
        $visit->C_CALLE2 = $gestion->getCCALLE2();
        $visit->C_NTEL = $gestion->getCNTEL();
        $visit->C_NDIR = $gestion->getCNDIR();
        $visit->C_EMAIL = $gestion->getCEMAIL();
        $visit->C_OBSE2 = $gestion->getCOBSE2();
        $visit->C_EJE = $gestion->getCEJE();
        $visit->save();
        $auto = $visit->auto;
        return $auto;
    }

    /**
     *
     * @param int $auto
     */
    private function addDateOfCapture($auto)
    {
        $query = "INSERT IGNORE INTO histdate VALUES (:auto, CURDATE())";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':auto', $auto, \PDO::PARAM_INT);
        $stq->execute();
    }

    /**
     * @param int $auto
     * @param string $agent
     */
    private function addCapturingAgent($auto, $agent)
    {
        $query = "INSERT IGNORE INTO histgest VALUES (:auto, :agent)";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':auto', $auto, \PDO::PARAM_INT);
        $stq->bindValue(':agent', $agent);
        $stq->execute();
    }

    /**
     *
     * @param int $id
     * @param string $tele
     * @return array
     */
    public function addNewTel($id, $tele = '')
    {
        if (!empty($tele)) {
            $tel = filter_var($tele, FILTER_SANITIZE_NUMBER_INT);
            $query = "UPDATE resumen 
SET tel_4_verif = tel_3_verif,
tel_3_verif = tel_2_verif,
tel_2_verif = tel_1_verif,
tel_1_verif = :tel 
WHERE id_cuenta = :id";
            $stn = $this->pdo->prepare($query);
            $stn->bindValue(':tel', $tel);
            $stn->bindValue(':id', $id, \PDO::PARAM_INT);
            $stn->execute();
        }
        $rc = new Resumen();
        /**
         * @var Builder $query
         */
        $query = $rc->whereIdCuenta($id);
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
     * @param int $id
     * @param string $dir
     */
    public function updateAddress($id, $dir)
    {
        $query = "UPDATE resumen SET direccion_nueva = :dir WHERE id_cuenta = :id";
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':dir', $dir);
        $stn->bindValue(':id', $id, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     *
     * @param int $id
     * @param string $email
     */
    private function updateEmail($id, $email)
    {
        $query = "UPDATE resumen SET email_deudor = :email WHERE id_cuenta = :id";
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':email', $email);
        $stn->bindValue(':id', $id, \PDO::PARAM_INT);
        $stn->execute();
    }

    /**
     *
     * @param string $capt
     * @param int $id
     * @return string
     */
    private function attributePayment($capt, $id)
    {
        $who = $capt;
        $query = "select c_cvge from historia 
        where n_prom>0 and c_cvge like 'PRO%' and c_cont = :id 
        order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':id', $id, \PDO::PARAM_INT);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvge'])) {
            $who = $result['c_cvge'];
        }
        return $who;
    }

    /**
     *
     * @param int $id
     * @param string $date
     * @param float $amount
     * @param string $who
     */
    private function addPayment($id, $date, $amount, $who)
    {
        $query = "INSERT IGNORE INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT numero_de_cuenta, :date, :amount, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE id_cuenta = :id";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':id', $id, \PDO::PARAM_INT);
        $sti->bindValue(':date', $date);
        $sti->bindValue(':amount', $amount);
        $sti->bindValue(':who', $who);
        $sti->execute();
    }

    /**
     */
    private function updateLastPayments()
    {
        $query = "update resumen,pagos 
                set fecha_de_ultimo_pago = fecha, monto_ultimo_pago = monto 
                where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta";
        $this->pdo->query($query);
    }

    /**
     *
     * @param int $id
     * @param string $best
     */
    private function statusUpdate($id, $best)
    {
        $query = "update resumen set status_aarsa = :best where id_cuenta = :id";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':id', $id, \PDO::PARAM_INT);
        $stb->bindValue(':best', $best);
        $stb->execute();
        $sti = $this->pdo->prepare($this->setPromiseFailed);
        $sti->bindValue(':id', $id, \PDO::PARAM_INT);
        $sti->execute();
        
        $stp = $this->pdo->prepare($this->setOldPayment);
        $stp->bindValue(':id', $id, \PDO::PARAM_INT);
        $stp->execute();
    }

    /**
     *
     * @param CallDataClass $gestion
     * @return int
     */
    private function insertCall(CallDataClass $gestion)
    {
        $sti = $this->pdo->prepare($this->historyInsertQuery);
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
        $this->addCapturingAgent($auto, $gestion['C_CVGE']);
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
            $this->addPayment($gestion['C_CONT'], $gestion['D_PAGO'], $gestion['N_PAGO'], $who);
        }
        $this->updateLastPayments();
        
        $best = $this->getBest($gestion['C_CVST'], $gestion['C_CONT']);
        $this->statusUpdate($gestion['C_CONT'], $best);
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
        $query = <<<SQL
select c_cvst,v_cc from historia,dictamenes
        where c_cvst=dictamen and c_cont = :C_CONT
        and d_fech>last_day(curdate()-interval 90 day)
        order by v_cc LIMIT 1
SQL;
        $stb = $this->pdo->prepare($query);
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
     * @return ValidationErrorClass|bool
     */
    public function doVisit($gestion)
    {
        $vc = new ValidationClass();
        $valid = $vc->countVisitErrors($gestion);
        if ($valid->flag) {
            return $valid;
        }
        $vdc = new VisitDataClass($gestion['C_CONT']);
        $vdc->setCCVST($gestion['C_CVST']);
        $vdc->setCCVGE($gestion['C_CVGE']);
        $vdc->setCACCION($gestion['C_ACCION']);
        $vdc->setAUTH($gestion['AUTH']);
        $vdc->setCVISIT($gestion['C_VISIT']);
        $vdc->setCCARG($gestion['C_CARG']);
        $vdc->setCCNP($gestion['C_CNP']);
        $vdc->setCEMAIL($gestion['C_EMAIL']);
        $vdc->setCHRIN($gestion['C_HRIN']);
        $vdc->setCMOTIV($gestion['C_MOTIV']);
        $vdc->setCNDIR($gestion['C_NDIR']);
        $vdc->setCNTEL($gestion['C_NTEL']);
        $vdc->setCOBSE1($gestion['C_OBSE1']);
        $vdc->setCOBSE2($gestion['C_OBSE2']);
        $vdc->setDFECH($gestion['D_FECH']);
        $vdc->setCPROM($gestion['C_PROM']);
        $vdc->setCOBSE1($gestion['C_OBSE1']);
        $vdc->setNPAGO($gestion['N_PAGO']);
        $vdc->setDPAGO($gestion['D_PAGO']);
        $vdc->setCUANDO($gestion['CUANDO']);
        $proms = $this->loadProms($gestion);
        $vdc->setProms($proms);
        $this->beginTransaction();
        $auto = $this->insertVisit($vdc);
        $this->addDateOfCapture($auto);
        $this->doCommon($auto, $gestion);
        $this->commitTransaction();
        return true;
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
    public function doCall(array $gestion)
    {
        $vc = new ValidationClass();
        $valid = $vc->countGestionErrors($gestion);
        if ($valid->flag) {
            return $valid;
        }
        $gdc = new CallDataClass($gestion['C_CONT']);
        $gdc->setCCVST($gestion['C_CVST']);
        $gdc->setCCVGE($gestion['C_CVGE']);
        $gdc->setCACCION($gestion['C_ACCION']);
        $gdc->setAUTH($gestion['AUTH']);
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
        $auto = $this->insertCall($gdc);
        $this->doCommon($auto, $gestion);
        $this->commitTransaction();
        return true;
    }
}
