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
     * @param VisitDataClass $visit
     * @return int
     */
    private function insertVisit(VisitDataClass $visit)
    {
        $history = new Historia();
        $history->C_CVGE = $visit->getCCVGE();
        $history->C_CVBA = $visit->getCCVBA();
        $history->C_CONT = $visit->getCCONT();
        $history->C_CVST = $visit->getCCVST();
        $history->D_FECH = $visit->getDFECH();
        $history->C_HRIN = $visit->getCHRIN();
        $history->C_HRFI = $visit->getCHRFI();
        $history->C_TELE = $visit->getCTELE();
        $history->CUENTA = $visit->getCUENTA();
        $history->C_OBSE1 = $visit->getCOBSE1();
        $history->C_CONTAN = $visit->getCCONTAN();
        $history->C_ATTE = $visit->getCATTE();
        $history->C_CARG = $visit->getCCARG();
        $history->C_RCON = $visit->getCRCON();
        $history->C_NSE = $visit->getCNSE();
        $history->C_CNIV = $visit->getCCNIV();
        $history->C_CFAC = $visit->getCCFAC();
        $history->C_CPTA = $visit->getCCPTA();
        $history->C_VISIT = $visit->getCVISIT();
        $history->D_PROM = $visit->getDPROM();
        $history->N_PROM = $visit->getNPROM();
        $history->D_PROM = $visit->getDPROM();
        $history->N_PROM = $visit->getNPROM();
        $history->C_PROM = $visit->getCPROM();
        $history->C_FREQ = '';
        $history->C_ACCION = $visit->getCACCION();
        $history->C_MOTIV = $visit->getCMOTIV();
        $history->C_CREJ = $visit->getCCREJ();
        $history->C_CPAT = $visit->getCCPAT();
        $history->C_CALLE1 = $visit->getCCALLE1();
        $history->C_CALLE2 = $visit->getCCALLE2();
        $history->C_NTEL = $visit->getCNTEL();
        $history->C_NDIR = $visit->getCNDIR();
        $history->C_EMAIL = $visit->getCEMAIL();
        $history->C_OBSE2 = $visit->getCOBSE2();
        $history->C_EJE = $visit->getCEJE();
        $history->save();
        $auto = $history->auto;
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
     * @param string $telData
     * @return array
     */
    public function addNewTel($id, $telData = '')
    {
        if (!empty($telData)) {
            $tel = filter_var($telData, FILTER_SANITIZE_NUMBER_INT);
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
         * @var Resumen $account
         */
        $account = $result->first();
        $data = $account->toArray();
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
     * @param CallDataClass $call
     * @return int
     */
    private function insertCall(CallDataClass $call)
    {
        $sti = $this->pdo->prepare($this->historyInsertQuery);
        $sti->bindValue(':C_CVBA', $call->getCCVBA());
        $sti->bindValue(':C_CVGE', $call->getCCVGE());
        $sti->bindValue(':C_CONT', $call->getCCONT(), \PDO::PARAM_INT);
        $sti->bindValue(':C_CVST', $call->getCCVST());
        $sti->bindValue(':D_FECH', $call->getDate());
        $sti->bindValue(':C_HRIN', $call->getCHRIN());
        $sti->bindValue(':C_HRFI', $call->getCHRFI());
        $sti->bindValue(':C_TELE', $call->getCTELE());
        $sti->bindValue(':CUANDO', $call->getAvailability());
        $sti->bindValue(':CUENTA', $call->getAccount());
        $sti->bindValue(':C_OBSE1', $call->getCOBSE1());
        $sti->bindValue(':C_ATTE', $call->getCATTE());
        $sti->bindValue(':C_CARG', $call->getCCARG());
        $sti->bindValue(':D_PROM', $call->getDPROM());
        $sti->bindValue(':N_PROM', $call->getNPROM());
        $sti->bindValue(':C_PROM', $call->getCPROM());
        $sti->bindValue(':D_PROM1', $call->getDPROM1());
        $sti->bindValue(':N_PROM1', $call->getNPROM1());
        $sti->bindValue(':D_PROM2', $call->getDPROM2());
        $sti->bindValue(':N_PROM2', $call->getNPROM2());
        $sti->bindValue(':D_PROM3', $call->getDPROM3());
        $sti->bindValue(':N_PROM3', $call->getNPROM3());
        $sti->bindValue(':D_PROM4', $call->getDPROM4());
        $sti->bindValue(':N_PROM4', $call->getNPROM4());
        $sti->bindValue(':C_CONTAN', $call->getCCONTAN());
        $sti->bindValue(':ACCION', $call->getCACCION());
        $sti->bindValue(':C_CNP', $call->getCCNP());
        $sti->bindValue(':C_MOTIV', $call->getCMOTIV());
        $sti->bindValue(':C_CAMP', $call->getCCAMP());
        $sti->bindValue(':C_NTEL', $call->getCNTEL());
        $sti->bindValue(':C_NDIR', $call->getCNDIR());
        $sti->bindValue(':C_EMAIL', $call->getCEMAIL());
        $sti->bindValue(':C_OBSE2', $call->getCOBSE2());
        $sti->bindValue(':C_EJE', $call->getCEJE());
        $sti->bindValue(':AUTH', $call->getAuthorized());
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
     * @param array $history
     */
    private function doCommon($auto, $history)
    {
        $this->addCapturingAgent($auto, $history['C_CVGE']);
        if (!empty($history['C_NTEL'])) {
            $this->addNewTel($history['C_CONT'], $history['C_NTEL']);
        }
        if (!empty($history['C_OBSE2'])) {
            $this->addNewTel($history['C_CONT'], $history['C_OBSE2']);
        }
        if (!empty($history['C_NDIR'])) {
            $this->updateAddress($history['C_CONT'], $history['C_NDIR']);
        }
        if (!empty($history['C_EMAIL'])) {
            $this->updateEmail($history['C_CONT'], $history['C_EMAIL']);
        }
        if ($history['N_PAGO'] > 0) {
            $who = $this->attributePayment($history['C_CVGE'], $history['C_CONT']);
            $this->addPayment($history['C_CONT'], $history['D_PAGO'], $history['N_PAGO'], $who);
        }
        $this->updateLastPayments();
        
        $best = $this->getBest($history['C_CVST'], $history['C_CONT']);
        $this->statusUpdate($history['C_CONT'], $best);
    }

    /**
     * 90 days
     *
     * @param string $status
     * @param int $id
     * @return string
     */
    private function getBest($status, $id)
    {
        $best = $status;
        $query = <<<SQL
select c_cvst,v_cc from historia,dictamenes
        where c_cvst=dictamen and c_cont = :id
        and d_fech>last_day(curdate()-interval 90 day)
        order by v_cc LIMIT 1
SQL;
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':id', $id, \PDO::PARAM_INT);
        $result = $stb->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvst'])) {
            $best = $result['c_cvst'];
        }
        return $best;
    }



    /**
     * 
     * @param array $visit
     * @return ValidationErrorClass|bool
     */
    public function doVisit($visit)
    {
        $vc = new ValidationClass();
        $valid = $vc->countVisitErrors($visit);
        if ($valid->flag) {
            return $valid;
        }
        $vdc = new VisitDataClass($visit['C_CONT']);
        $vdc->setCCVST($visit['C_CVST']);
        $vdc->setCCVGE($visit['C_CVGE']);
        $vdc->setCACCION($visit['C_ACCION']);
        $vdc->setAUTH($visit['AUTH']);
        $vdc->setCVISIT($visit['C_VISIT']);
        $vdc->setCCARG($visit['C_CARG']);
        $vdc->setCCNP($visit['C_CNP']);
        $vdc->setCEMAIL($visit['C_EMAIL']);
        $vdc->setCHRIN($visit['C_HRIN']);
        $vdc->setCMOTIV($visit['C_MOTIV']);
        $vdc->setCNDIR($visit['C_NDIR']);
        $vdc->setCNTEL($visit['C_NTEL']);
        $vdc->setCOBSE1($visit['C_OBSE1']);
        $vdc->setCOBSE2($visit['C_OBSE2']);
        $vdc->setDFECH($visit['D_FECH']);
        $vdc->setCPROM($visit['C_PROM']);
        $vdc->setCOBSE1($visit['C_OBSE1']);
        $vdc->setNPAGO($visit['N_PAGO']);
        $vdc->setDPAGO($visit['D_PAGO']);
        $vdc->setCUANDO($visit['CUANDO']);
        $proms = $this->loadProms($visit);
        $vdc->setProms($proms);
        $this->beginTransaction();
        $auto = $this->insertVisit($vdc);
        $this->addDateOfCapture($auto);
        $this->doCommon($auto, $visit);
        $this->commitTransaction();
        return true;
    }

    /**
     * @param array $history
     * @return array
     */
    private function loadProms(array $history)
    {
        $proms = array();
        for ($i=1; $i<5; $i++) {
            $proms[] = array('n' => $history['N_PROM'.$i], 'd' => $history['D_PROM'.$i]);
        }
        return $proms;
    }

    /**
     * @param array $call
     * @return ValidationErrorClass|boolean
     * @throws \UnexpectedValueException
     */
    public function doCall(array $call)
    {
        $vc = new ValidationClass();
        $valid = $vc->countCallErrors($call);
        if ($valid->flag) {
            return $valid;
        }
        $gdc = new CallDataClass($call['C_CONT']);
        $gdc->setCCVST($call['C_CVST']);
        $gdc->setCCVGE($call['C_CVGE']);
        $gdc->setCACCION($call['C_ACCION']);
        $gdc->setAuthorized($call['AUTH']);
        $gdc->setCCARG($call['C_CARG']);
        $gdc->setCCNP($call['C_CNP']);
        $gdc->setCEMAIL($call['C_EMAIL']);
        $gdc->setCHRIN($call['C_HRIN']);
        $gdc->setCMOTIV($call['C_MOTIV']);
        $gdc->setCNDIR($call['C_NDIR']);
        $gdc->setCNTEL($call['C_NTEL']);
        $gdc->setCOBSE1($call['C_OBSE1']);
        $gdc->setCOBSE2($call['C_OBSE2']);
        $gdc->setCTELE($call['C_TELE']);
        $gdc->setCPROM($call['C_PROM']);
        $gdc->setCOBSE1($call['C_OBSE1']);
        $gdc->setNPAGO($call['N_PAGO']);
        $gdc->setDPAGO($call['D_PAGO']);
        $gdc->setAvailability($call['CUANDO']);
        $proms = $this->loadProms($call);
        $gdc->setProms($proms);
        $this->beginTransaction();
        $auto = $this->insertCall($gdc);
        $this->doCommon($auto, $call);
        $this->commitTransaction();
        return true;
    }
}
