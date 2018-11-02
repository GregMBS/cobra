<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CallDataClass
{
    /** @var string */
    private $C_CVBA;

    /** @var int */
    private $C_CONT;

    /** @var int */
    private $C_CAMP;

    /** @var string */
    private $C_HRIN;

    /** @var string */
    private $C_HRFI;

    /** @var string */
    private $CUENTA;

    /** @var string */
    private $C_ATTE = '';

    /** @var string */
    private $C_CONTAN = '';

    /** @var string */
    private $C_EJE = '';

    /** @var string */
    private $C_CVGE;

    /** @var string */
    private $AUTH = '';

    /** @var string */
    private $C_TELE;

    /** @var string */
    private $C_CARG = '';

    /** @var string */
    private $C_OBSE1;

    /** @var string */
    private $C_ACCION;

    /** @var string */
    private $C_CVST;

    /** @var string */
    private $C_CNP = '';

    /** @var string */
    private $C_MOTIV = '';

    /** @var string */
    private $CUANDO = '';

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
    private $N_PAGO = 0;

    /** @var string */
    private $D_PAGO = '';

    /** @var string */
    private $C_NTEL = '';

    /** @var string */
    private $C_OBSE2 = '';

    /** @var string */
    private $C_NDIR = '';

    /** @var string */
    private $C_EMAIL = '';

    /** @var string */
    private $D_FECH;

    /** @var int  */
    private $C_CNIV = 0;

    public function __construct(int $C_CONT)
    {
        $this->setDFECH();
        $this->setCHRFI();
        /** @var Builder $query */
        $query = Resumen::whereIdCuenta($C_CONT);
        $cuenta = $query->first();
        $this->setCCONT($cuenta->id_cuenta);
        $this->setCCVBA($cuenta->cliente);
        $this->setCUENTA($cuenta->numero_de_cuenta);
        $this->setCCONTAN($cuenta->status_aarsa);
        $this->setCEJE($cuenta->ejecutivo_asignado_call_center);
    }

    /**
     * @return int
     */
    public function getCCNIV(): int
    {
        return $this->C_CNIV;
    }

    /**
     * @return string
     */
    public function getDFECH(): string
    {
        return $this->D_FECH;
    }

    private function setDFECH()
    {
        $this->D_FECH = date('Y-m-d');
    }

    /**
     * @return string
     */
    public function getCHRFI(): string
    {
        return $this->C_HRFI;
    }

    private function setCHRFI()
    {
        $this->C_HRFI = date('H:i:s');
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
        return $this->C_CVBA;
    }

    /**
     * @param string $creditor
     */
    private function setCCVBA(string $creditor)
    {
        $this->C_CVBA = $creditor;
    }

    /**
     * @return int
     */
    public function getCCONT(): int
    {
        return $this->C_CONT;
    }

    /**
     * @param int $id
     */
    private function setCCONT(int $id)
    {
        $this->C_CONT = $id;
    }

    /**
     * @return int
     */
    public function getCCAMP(): int
    {
        return $this->C_CAMP;
    }

    /**
     * @param int $campaign
     */
    private function setCCAMP(int $campaign)
    {
        $this->C_CAMP = $campaign;
    }

    /**
     * @return string
     */
    public function getCHRIN(): string
    {
        return $this->C_HRIN;
    }

    /**
     * @param string $startTime
     */
    public function setCHRIN(string $startTime)
    {
        $this->C_HRIN = $startTime;
    }

    /**
     * @return string
     */
    public function getCUENTA(): string
    {
        return $this->CUENTA;
    }

    /**
     * @param string $accountNumber
     */
    private function setCUENTA(string $accountNumber)
    {
        $this->CUENTA = $accountNumber;
    }

    /**
     * @return string
     */
    public function getCATTE()
    {
        return $this->C_ATTE;
    }

    /**
     * @param string $responder
     */
    public function setCATTE($responder)
    {
        $this->C_ATTE = $responder;
    }

    /**
     * @return string
     */
    public function getCCONTAN()
    {
        return $this->C_CONTAN;
    }

    /**
     * @param string $previousStatus
     */
    private function setCCONTAN($previousStatus)
    {
        $this->C_CONTAN = $previousStatus;
    }

    /**
     * @return string
     */
    public function getCEJE()
    {
        return $this->C_EJE;
    }

    /**
     * @param string $assigned
     */
    private function setCEJE($assigned)
    {
        $this->C_EJE = $assigned;
    }

    /**
     * @return string
     */
    public function getCCVGE(): string
    {
        return $this->C_CVGE;
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
            $this->C_CVGE = $user->iniciales;
            $this->setCCAMP($user->camp);
        } catch (ModelNotFoundException $e) {
            dd('C_CVGE'.$agent);
        }
    }

    /**
     * @return string
     */
    public function getAUTH()
    {
        return $this->AUTH;
    }

    /**
     * @param string $authorized
     */
    public function setAUTH($authorized)
    {
        $this->AUTH = $authorized;
    }

    /**
     * @return string
     */
    public function getCTELE(): string
    {
        return $this->C_TELE;
    }

    /**
     * @param string $telCalled
     */
    public function setCTELE(string $telCalled)
    {
        if (empty($telCalled)) {
            dd('C_TELE'.$telCalled);
        }
        $this->C_TELE = $telCalled;
    }

    /**
     * @return string
     */
    public function getCCARG()
    {
        return $this->C_CARG;
    }

    /**
     * @param string $relationship
     */
    public function setCCARG($relationship)
    {
        $this->C_CARG = $relationship;
    }

    /**
     * @return string
     */
    public function getCOBSE1(): string
    {
        return $this->C_OBSE1;
    }

    /**
     * @param string $text
     */
    public function setCOBSE1(string $text)
    {
        $this->C_OBSE1 = $text;
    }

    /**
     * @return string
     */
    public function getCACCION(): string
    {
        return $this->C_ACCION;
    }

    /**
     * @param string $action
     */
    public function setCACCION(string $action)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Accion::whereAccion($action);
        $value = $query->first();
        if (empty($value)) {
            dd('C_ACCION'.$action);
        }
        $code = $value->accion;
        $this->C_ACCION = $code;
    }

    /**
     * @return string
     */
    public function getCCVST(): string
    {
        return $this->C_CVST;
    }

    /**
     * @param string $status
     */
    public function setCCVST(string $status)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Dictamen::whereDictamen($status);
        $value = $query->first();
        if (empty($value)) {
            dd('C_CVST'.$value);
        }
        $code = $value->dictamen;
        $this->C_CVST = $code;
    }

    /**
     * @return string
     */
    public function getCCNP()
    {
        return $this->C_CNP;
    }

    /**
     * @param string $excuse
     */
    public function setCCNP($excuse)
    {
        $this->C_CNP = $excuse;
    }

    /**
     * @return string
     */
    public function getCMOTIV()
    {
        return $this->C_MOTIV;
    }

    /**
     * @param string $motive
     */
    public function setCMOTIV($motive)
    {
        if (!empty($motive)) {
            try {
                $value = Motivador::findOrFail($motive);
            } catch (ModelNotFoundException $e) {
                $value = '';
            }
            if ($value !== $motive) {
                dd('C_MOTIV' . $motive);
            }
            $this->C_MOTIV = $value;
        }
    }

    /**
     * @return string
     */
    public function getCUANDO()
    {
        return $this->CUANDO;
    }

    /**
     * @param string $availability
     */
    public function setCUANDO($availability)
    {
        $this->CUANDO = $availability;
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
        return $this->N_PAGO;
    }

    /**
     * @param int $amountPaid
     */
    public function setNPAGO($amountPaid)
    {
        $this->N_PAGO = $amountPaid;
    }

    /**
     * @return string
     */
    public function getDPAGO()
    {
        return $this->D_PAGO;
    }

    /**
     * @param string $datePaid
     */
    public function setDPAGO($datePaid)
    {
        $this->D_PAGO = $datePaid;
    }

    /**
     * @return string
     */
    public function getCNTEL()
    {
        return $this->C_NTEL;
    }

    /**
     * @param string $newTel
     */
    public function setCNTEL($newTel)
    {
        $this->C_NTEL = $newTel;
    }

    /**
     * @return string
     */
    public function getCOBSE2()
    {
        return $this->C_OBSE2;
    }

    /**
     * @param string $newTel2
     */
    public function setCOBSE2($newTel2)
    {
        $this->C_OBSE2 = $newTel2;
    }

    /**
     * @return string
     */
    public function getCNDIR()
    {
        return $this->C_NDIR;
    }

    /**
     * @param string $newAddress
     */
    public function setCNDIR($newAddress)
    {
        $this->C_NDIR = $newAddress;
    }

    /**
     * @return string
     */
    public function getCEMAIL()
    {
        return $this->C_EMAIL;
    }

    /**
     * @param string $email
     */
    public function setCEMAIL($email)
    {
        $this->C_EMAIL = $email;
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