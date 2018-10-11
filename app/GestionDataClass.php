<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GestionDataClass
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
     * @param string $C_CVBA
     */
    private function setCCVBA(string $C_CVBA)
    {
        $this->C_CVBA = $C_CVBA;
    }

    /**
     * @return int
     */
    public function getCCONT(): int
    {
        return $this->C_CONT;
    }

    /**
     * @param int $C_CONT
     */
    private function setCCONT(int $C_CONT)
    {
        $this->C_CONT = $C_CONT;
    }

    /**
     * @return int
     */
    public function getCCAMP(): int
    {
        return $this->C_CAMP;
    }

    /**
     * @param int $C_CAMP
     */
    private function setCCAMP(int $C_CAMP)
    {
        $this->C_CAMP = $C_CAMP;
    }

    /**
     * @return string
     */
    public function getCHRIN(): string
    {
        return $this->C_HRIN;
    }

    /**
     * @param string $C_HRIN
     */
    public function setCHRIN(string $C_HRIN)
    {
        $this->C_HRIN = $C_HRIN;
    }

    /**
     * @return string
     */
    public function getCUENTA(): string
    {
        return $this->CUENTA;
    }

    /**
     * @param string $CUENTA
     */
    private function setCUENTA(string $CUENTA)
    {
        $this->CUENTA = $CUENTA;
    }

    /**
     * @return string
     */
    public function getCATTE()
    {
        return $this->C_ATTE;
    }

    /**
     * @param string $C_ATTE
     */
    public function setCATTE($C_ATTE)
    {
        $this->C_ATTE = $C_ATTE;
    }

    /**
     * @return string
     */
    public function getCCONTAN()
    {
        return $this->C_CONTAN;
    }

    /**
     * @param string $C_CONTAN
     */
    private function setCCONTAN($C_CONTAN)
    {
        $this->C_CONTAN = $C_CONTAN;
    }

    /**
     * @return string
     */
    public function getCEJE()
    {
        return $this->C_EJE;
    }

    /**
     * @param string $C_EJE
     */
    private function setCEJE($C_EJE)
    {
        $this->C_EJE = $C_EJE;
    }

    /**
     * @return string
     */
    public function getCCVGE(): string
    {
        return $this->C_CVGE;
    }

    /**
     * @param string $C_CVGE
     */
    public function setCCVGE(string $C_CVGE)
    {
        /** @var Builder $query */
        $query = User::whereIniciales($C_CVGE);
        try {
            /** @var User $user */
            $user = $query->firstOrFail();
            $this->C_CVGE = $user->iniciales;
            $this->setCCAMP($user->camp);
        } catch (ModelNotFoundException $e) {
            dd('C_CVGE'.$C_CVGE);
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
     * @param string $AUTH
     */
    public function setAUTH($AUTH)
    {
        $this->AUTH = $AUTH;
    }

    /**
     * @return string
     */
    public function getCTELE(): string
    {
        return $this->C_TELE;
    }

    /**
     * @param string $C_TELE
     */
    public function setCTELE(string $C_TELE)
    {
        if (empty($C_TELE)) {
            dd('C_TELE'.$C_TELE);
        }
        $this->C_TELE = $C_TELE;
    }

    /**
     * @return string
     */
    public function getCCARG()
    {
        return $this->C_CARG;
    }

    /**
     * @param string $C_CARG
     */
    public function setCCARG($C_CARG)
    {
        $this->C_CARG = $C_CARG;
    }

    /**
     * @return string
     */
    public function getCOBSE1(): string
    {
        return $this->C_OBSE1;
    }

    /**
     * @param string $C_OBSE1
     */
    public function setCOBSE1(string $C_OBSE1)
    {
        $this->C_OBSE1 = $C_OBSE1;
    }

    /**
     * @return string
     */
    public function getCACCION(): string
    {
        return $this->C_ACCION;
    }

    /**
     * @param string $C_ACCION
     */
    public function setCACCION(string $C_ACCION)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Accion::whereAccion($C_ACCION);
        $value = $query->first();
        if (empty($value)) {
            dd('C_ACCION'.$C_ACCION);
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
     * @param string $C_CVST
     */
    public function setCCVST(string $C_CVST)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Dictamen::whereDictamen($C_CVST);
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
     * @param string $C_CNP
     */
    public function setCCNP($C_CNP)
    {
        $this->C_CNP = $C_CNP;
    }

    /**
     * @return string
     */
    public function getCMOTIV()
    {
        return $this->C_MOTIV;
    }

    /**
     * @param string $C_MOTIV
     */
    public function setCMOTIV($C_MOTIV)
    {
        if (!empty($C_MOTIV)) {
            try {
                $value = Motivador::findOrFail($C_MOTIV);
            } catch (ModelNotFoundException $e) {
                $value = '';
            }
            if ($value !== $C_MOTIV) {
                dd('C_MOTIV' . $C_MOTIV);
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
     * @param string $CUANDO
     */
    public function setCUANDO($CUANDO)
    {
        $this->CUANDO = $CUANDO;
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
     * @param float $N_PROM1_OLD
     */
    public function setNPROM1OLD($N_PROM1_OLD)
    {
        $this->N_PROM1_OLD = $N_PROM1_OLD;
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
     * @param string $D_PROM1_OLD
     */
    public function setDPROM1OLD($D_PROM1_OLD)
    {
        $this->D_PROM1_OLD = $D_PROM1_OLD;
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
     * @param float $N_PROM2_OLD
     */
    public function setNPROM2OLD($N_PROM2_OLD)
    {
        $this->N_PROM2_OLD = $N_PROM2_OLD;
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
     * @param string $D_PROM2_OLD
     */
    public function setDPROM2OLD($D_PROM2_OLD)
    {
        $this->D_PROM2_OLD = $D_PROM2_OLD;
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
     * @param float $N_PROM3_OLD
     */
    public function setNPROM3OLD($N_PROM3_OLD)
    {
        $this->N_PROM3_OLD = $N_PROM3_OLD;
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
     * @param string $D_PROM3_OLD
     */
    public function setDPROM3OLD($D_PROM3_OLD)
    {
        $this->D_PROM3_OLD = $D_PROM3_OLD;
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
     * @param float $N_PROM4_OLD
     */
    public function setNPROM4OLD($N_PROM4_OLD)
    {
        $this->N_PROM4_OLD = $N_PROM4_OLD;
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
     * @param string $D_PROM4_OLD
     */
    public function setDPROM4OLD($D_PROM4_OLD)
    {
        $this->D_PROM4_OLD = $D_PROM4_OLD;
    }

    /**
     * @return string
     */
    public function getCPROM()
    {
        return $this->C_PROM;
    }

    /**
     * @param string $C_PROM
     */
    public function setCPROM($C_PROM)
    {
        $this->C_PROM = $C_PROM;
    }

    /**
     * @return float
     */
    public function getNPROMOLD(): float
    {
        return $this->N_PROM_OLD;
    }

    /**
     * @param float $N_PROM_OLD
     */
    public function setNPROMOLD($N_PROM_OLD)
    {
        $this->N_PROM_OLD = $N_PROM_OLD;
    }

    /**
     * @return int
     */
    public function getNPAGO(): int
    {
        return $this->N_PAGO;
    }

    /**
     * @param int $N_PAGO
     */
    public function setNPAGO($N_PAGO)
    {
        $this->N_PAGO = $N_PAGO;
    }

    /**
     * @return string
     */
    public function getDPAGO()
    {
        return $this->D_PAGO;
    }

    /**
     * @param string $D_PAGO
     */
    public function setDPAGO($D_PAGO)
    {
        $this->D_PAGO = $D_PAGO;
    }

    /**
     * @return string
     */
    public function getCNTEL()
    {
        return $this->C_NTEL;
    }

    /**
     * @param string $C_NTEL
     */
    public function setCNTEL($C_NTEL)
    {
        $this->C_NTEL = $C_NTEL;
    }

    /**
     * @return string
     */
    public function getCOBSE2()
    {
        return $this->C_OBSE2;
    }

    /**
     * @param string $C_OBSE2
     */
    public function setCOBSE2($C_OBSE2)
    {
        $this->C_OBSE2 = $C_OBSE2;
    }

    /**
     * @return string
     */
    public function getCNDIR()
    {
        return $this->C_NDIR;
    }

    /**
     * @param string $C_NDIR
     */
    public function setCNDIR($C_NDIR)
    {
        $this->C_NDIR = $C_NDIR;
    }

    /**
     * @return string
     */
    public function getCEMAIL()
    {
        return $this->C_EMAIL;
    }

    /**
     * @param string $C_EMAIL
     */
    public function setCEMAIL($C_EMAIL)
    {
        $this->C_EMAIL = $C_EMAIL;
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