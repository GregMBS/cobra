<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CallDataClass
{
    /** @var string */
    private $creditor;

    /** @var int */
    private $id;

    /** @var int */
    private $campaign;

    /** @var string */
    private $startTime;

    /** @var string */
    private $endTime;

    /** @var string */
    private $account;

    /** @var string */
    private $responder = '';

    /** @var string */
    private $previousStatus = '';

    /** @var string */
    private $assigned = '';

    /** @var string */
    private $initials;

    /** @var string */
    private $authorized = '';

    /** @var string */
    private $called;

    /** @var string */
    private $relationship = '';

    /** @var string */
    private $text;

    /** @var string */
    private $action;

    /** @var string */
    private $status;

    /** @var string */
    private $excuse = '';

    /** @var string */
    private $motive = '';

    /** @var string */
    private $availability = '';

    /** @var float */
    private $N_PROM1 = 0;

    /** @var float */
    private $N_PROM1_OLD = 0;

    /** @var string */
    private $D_PROM1 = '';

    /** @var string */
    private $D_PROM1_OLD = '';

    /** @var float */
    private $N_PROM2 = 0;

    /** @var float */
    private $N_PROM2_OLD = 0;

    /** @var string */
    private $D_PROM2 = '';

    /** @var string */
    private $D_PROM2_OLD = '';

    /** @var float */
    private $N_PROM3 = 0;

    /** @var float */
    private $N_PROM3_OLD = 0;

    /** @var string */
    private $D_PROM3 = '';

    /** @var string */
    private $D_PROM3_OLD = '';

    /** @var float */
    private $N_PROM4 = 0;

    /** @var float */
    private $N_PROM4_OLD = 0;

    /** @var string */
    private $D_PROM4 = '';

    /** @var string */
    private $D_PROM4_OLD = '';

    /** @var string */
    private $C_PROM = '';

    /** @var float */
    private $N_PROM_OLD;

    /** @var int  */
    private $amountPaid = 0;

    /** @var string */
    private $datePaid = '';

    /** @var string */
    private $newTel = '';

    /** @var string */
    private $newTel2 = '';

    /** @var string */
    private $newAddress = '';

    /** @var string */
    private $email = '';

    /** @var string */
    private $date;

    /** @var int  */
    private $floors = 0;

    public function __construct(int $C_CONT)
    {
        $this->setDate();
        $this->setEndTime();
        /** @var Builder $query */
        $query = Debtor::whereIdCuenta($C_CONT);
        $debtor = $query->first();
        $this->setCCONT($debtor->id_cuenta);
        $this->setCCVBA($debtor->cliente);
        $this->setCUENTA($debtor->numero_de_cuenta);
        $this->setCCONTAN($debtor->status_aarsa);
        $this->setCEJE($debtor->ejecutivo_asignado_call_center);
    }

    /**
     * @return int
     */
    public function getFloors(): int
    {
        return $this->floors;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    private function setDate()
    {
        $this->date = date('Y-m-d');
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }

    private function setEndTime()
    {
        $this->endTime = date('H:i:s');
    }

    /**
     * @return float
     */
    public function getNPROM()
    {
        $sum = array_sum([
            $this->N_PROM1,
            $this->N_PROM2,
            $this->N_PROM3,
            $this->N_PROM4
        ]);
        return $sum;
    }

    /**
     * @return string
     */
    public function getDPROM()
    {
        return $this->getDPROM1();
    }

    /**
     * @return string
     */
    public function getCCVBA(): string
    {
        return $this->creditor;
    }

    /**
     * @param string $creditor
     */
    private function setCCVBA(string $creditor)
    {
        $this->creditor = $creditor;
    }

    /**
     * @return int
     */
    public function getCCONT(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setCCONT(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCCAMP(): int
    {
        return $this->campaign;
    }

    /**
     * @param int $campaign
     */
    private function setCCAMP(int $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * @return string
     */
    public function getCHRIN(): string
    {
        return $this->startTime;
    }

    /**
     * @param string $startTime
     */
    public function setCHRIN(string $startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @param string $accountNumber
     */
    private function setCUENTA(string $accountNumber)
    {
        $this->account = $accountNumber;
    }

    /**
     * @return string
     */
    public function getCATTE()
    {
        return $this->responder;
    }

    /**
     * @param string $responder
     */
    public function setCATTE($responder)
    {
        $this->responder = $responder;
    }

    /**
     * @return string
     */
    public function getCCONTAN()
    {
        return $this->previousStatus;
    }

    /**
     * @param string $previousStatus
     */
    private function setCCONTAN($previousStatus)
    {
        $this->previousStatus = $previousStatus;
    }

    /**
     * @return string
     */
    public function getCEJE()
    {
        return $this->assigned;
    }

    /**
     * @param string $assigned
     */
    private function setCEJE($assigned)
    {
        $this->assigned = $assigned;
    }

    /**
     * @return string
     */
    public function getCCVGE(): string
    {
        return $this->initials;
    }

    /**
     * @param string $agent
     */
    public function setCCVGE(string $agent)
    {
        /** @var Builder $query */
        $query = User::whereIniciales($agent);
        try {
            /** @var User $user */
            $user = $query->firstOrFail();
            $this->initials = $user->iniciales;
            $this->setCCAMP($user->camp);
        } catch (ModelNotFoundException $e) {
            dd('C_CVGE'.$agent);
        }
    }

    /**
     * @return string
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }

    /**
     * @param string $authorized
     */
    public function setAuthorized($authorized)
    {
        $this->authorized = $authorized;
    }

    /**
     * @return string
     */
    public function getCTELE(): string
    {
        return $this->called;
    }

    /**
     * @param string $telCalled
     */
    public function setCTELE(string $telCalled)
    {
        if (empty($telCalled)) {
            dd('C_TELE'.$telCalled);
        }
        $this->called = $telCalled;
    }

    /**
     * @return string
     */
    public function getCCARG()
    {
        return $this->relationship;
    }

    /**
     * @param string $relationship
     */
    public function setCCARG($relationship)
    {
        $this->relationship = $relationship;
    }

    /**
     * @return string
     */
    public function getCOBSE1(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setCOBSE1(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getCACCION(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setCACCION(string $action)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Action::whereAccion($action);
        $value = $query->first();
        if (empty($value)) {
            dd('C_ACCION'.$action);
        }
        $code = $value->accion;
        $this->action = $code;
    }

    /**
     * @return string
     */
    public function getCCVST(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setCCVST(string $status)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Status::whereDictamen($status);
        $value = $query->first();
        if (empty($value)) {
            dd('C_CVST'.$value);
        }
        $code = $value->dictamen;
        $this->status = $code;
    }

    /**
     * @return string
     */
    public function getCCNP()
    {
        return $this->excuse;
    }

    /**
     * @param string $excuse
     */
    public function setCCNP($excuse)
    {
        $this->excuse = $excuse;
    }

    /**
     * @return string
     */
    public function getCMOTIV()
    {
        return $this->motive;
    }

    /**
     * @param string $motive
     */
    public function setCMOTIV($motive)
    {
        if (!empty($motive)) {
            try {
                $value = Motive::findOrFail($motive);
            } catch (ModelNotFoundException $e) {
                $value = '';
            }
            if ($value !== $motive) {
                dd('C_MOTIV' . $motive);
            }
            $this->motive = $value;
        }
    }

    /**
     * @return string
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param string $availability
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     * @return float
     */
    public function getNPROM1(): float
    {
        return $this->N_PROM1;
    }

    /**
     * @return float
     */
    public function getNPROM1OLD(): float
    {
        return $this->N_PROM1_OLD;
    }

    /**
     * @param float $oldPromiseAmount1
     */
    public function setNPROM1OLD($oldPromiseAmount1)
    {
        $this->N_PROM1_OLD = $oldPromiseAmount1;
    }

    /**
     * @return string
     */
    public function getDPROM1()
    {
        return $this->D_PROM1;
    }

    /**
     * @return string
     */
    public function getDPROM1OLD()
    {
        return $this->D_PROM1_OLD;
    }

    /**
     * @param string $oldPromiseDate1
     */
    public function setDPROM1OLD($oldPromiseDate1)
    {
        $this->D_PROM1_OLD = $oldPromiseDate1;
    }

    /**
     * @return float
     */
    public function getNPROM2(): float
    {
        return $this->N_PROM2;
    }

    /**
     * @return float
     */
    public function getNPROM2OLD(): float
    {
        return $this->N_PROM2_OLD;
    }

    /**
     * @param float $oldPromiseAmount2
     */
    public function setNPROM2OLD($oldPromiseAmount2)
    {
        $this->N_PROM2_OLD = $oldPromiseAmount2;
    }

    /**
     * @return string
     */
    public function getDPROM2()
    {
        return $this->D_PROM2;
    }

    /**
     * @return string
     */
    public function getDPROM2OLD()
    {
        return $this->D_PROM2_OLD;
    }

    /**
     * @param string $oldPromiseDate2
     */
    public function setDPROM2OLD($oldPromiseDate2)
    {
        $this->D_PROM2_OLD = $oldPromiseDate2;
    }

    /**
     * @return float
     */
    public function getNPROM3(): float
    {
        return $this->N_PROM3;
    }

    /**
     * @return float
     */
    public function getNPROM3OLD(): float
    {
        return $this->N_PROM3_OLD;
    }

    /**
     * @param float $oldPromiseAmount3
     */
    public function setNPROM3OLD($oldPromiseAmount3)
    {
        $this->N_PROM3_OLD = $oldPromiseAmount3;
    }

    /**
     * @return string
     */
    public function getDPROM3()
    {
        return $this->D_PROM3;
    }

    /**
     * @return string
     */
    public function getDPROM3OLD()
    {
        return $this->D_PROM3_OLD;
    }

    /**
     * @param string $oldPromiseDate3
     */
    public function setDPROM3OLD($oldPromiseDate3)
    {
        $this->D_PROM3_OLD = $oldPromiseDate3;
    }

    /**
     * @return float
     */
    public function getNPROM4(): float
    {
        return $this->N_PROM4;
    }

    /**
     * @return float
     */
    public function getNPROM4OLD(): float
    {
        return $this->N_PROM4_OLD;
    }

    /**
     * @param float $oldPromiseAmount4
     */
    public function setNPROM4OLD($oldPromiseAmount4)
    {
        $this->N_PROM4_OLD = $oldPromiseAmount4;
    }

    /**
     * @return string
     */
    public function getDPROM4()
    {
        return $this->D_PROM4;
    }

    /**
     * @return string
     */
    public function getDPROM4OLD()
    {
        return $this->D_PROM4_OLD;
    }

    /**
     * @param string $oldPromiseDate4
     */
    public function setDPROM4OLD($oldPromiseDate4)
    {
        $this->D_PROM4_OLD = $oldPromiseDate4;
    }

    /**
     * @return string
     */
    public function getCPROM()
    {
        return $this->C_PROM;
    }

    /**
     * @param string $paymentFrequency
     */
    public function setCPROM($paymentFrequency)
    {
        $this->C_PROM = $paymentFrequency;
    }

    /**
     * @return float
     */
    public function getNPROMOLD(): float
    {
        return $this->N_PROM_OLD;
    }

    /**
     * @param float $oldPromiseAmountTotal
     */
    public function setNPROMOLD($oldPromiseAmountTotal)
    {
        $this->N_PROM_OLD = $oldPromiseAmountTotal;
    }

    /**
     * @return int
     */
    public function getNPAGO(): int
    {
        return $this->amountPaid;
    }

    /**
     * @param int $amountPaid
     */
    public function setNPAGO($amountPaid)
    {
        $this->amountPaid = $amountPaid;
    }

    /**
     * @return string
     */
    public function getDPAGO()
    {
        return $this->datePaid;
    }

    /**
     * @param string $datePaid
     */
    public function setDPAGO($datePaid)
    {
        $this->datePaid = $datePaid;
    }

    /**
     * @return string
     */
    public function getCNTEL()
    {
        return $this->newTel;
    }

    /**
     * @param string $newTel
     */
    public function setCNTEL($newTel)
    {
        $this->newTel = $newTel;
    }

    /**
     * @return string
     */
    public function getCOBSE2()
    {
        return $this->newTel2;
    }

    /**
     * @param string $newTel2
     */
    public function setCOBSE2($newTel2)
    {
        $this->newTel2 = $newTel2;
    }

    /**
     * @return string
     */
    public function getCNDIR()
    {
        return $this->newAddress;
    }

    /**
     * @param string $newAddress
     */
    public function setCNDIR($newAddress)
    {
        $this->newAddress = $newAddress;
    }

    /**
     * @return string
     */
    public function getCEMAIL()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setCEMAIL($email)
    {
        $this->email = $email;
    }

    /**
     * @param array $proms
     */
    public function setProms(array $proms)
    {
        foreach($proms as $key => $value) {
            if ($value['n'] === 0) {
                unset($proms[$key]);
            }
        }
        $nProm  = array_column($proms, 'n');
        $dProm = array_column($proms, 'd');
        array_multisort($nProm, SORT_ASC, $dProm, SORT_DESC, $proms);
        for ($i=0;$i<count($nProm);$i++) {
            $nName = 'N_PROM'.($i + 1);
            $dName = 'D_PROM'.($i + 1);
            $this->$nName = $nProm[$i];
            $this->$dName = $dProm[$i];
        }
    }
}