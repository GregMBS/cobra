<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Request;

/**
 * Description of CheckClass
 *
 * @author gmbs
 */
class CheckClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $CUENTA;

    /**
     *
     * @var string
     */
    private $gestor;

    /**
     *
     * @var int
     */
    private $id_cuenta;

    /**
     *
     * @var string
     */
    private $tipo;

    /**
     *
     * @var Carbon
     */
    private $fechaOut;

    /**
     * @param Request $r
     */
    private function setVars(Request $r)
    {
        $this->gestor = $r->gestor;
        $this->tipo = $r->tipo;
        if ($this->tipo == 'numero_de_cuenta') {
            $this->CUENTA = $r->CUENTA;
            $this->id_cuenta = $this->getIdCuentaFromCuenta($this->CUENTA);
        } else {
            $this->id_cuenta = $r->CUENTA;
            $this->CUENTA = $this->getCuentaFromIdCuenta($this->id_cuenta);
        }
        $this->fechaOut = new Carbon($r->fechaout);
    }

    /**
     *
     * @param string $cuenta
     * @return int
     */
    private function getIdCuentaFromCuenta($cuenta)
    {
        /**
         * @var Collection $resumen
         * @method Resumen whereNumeroDeCuenta($cuenta)
         */
        $resumen = Resumen::whereNumeroDeCuenta($cuenta)
            ->where('status_de_credito', 'NOT REGEXP', '-')->get();
        if (count($resumen) >0) {
            $cuenta = $resumen->first();
            $id_cuenta = $cuenta->id_cuenta;
        } else {
            $id_cuenta = 0;
        }
        return $id_cuenta;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    private function getCuentaFromIdCuenta($id_cuenta)
    {
        /**
         * @var Collection $resumen
         * @method Resumen whereIdCuenta($id_cuenta)
         */
        $resumen = Resumen::whereIdCuenta($id_cuenta)
            ->where('status_de_credito', 'NOT REGEXP', '-')->get();
        if (count($resumen) >0) {
            $cuenta = $resumen->first();
            $numero_de_cuenta = $cuenta->numero_de_cuenta;
        } else {
            $numero_de_cuenta = '';
        }
        return $numero_de_cuenta;
    }

    /**
     * @param $r
     */
    public function insertVasignBoth($r)
    {
        $this->setVars($r);
        $query = "INSERT INTO vasign (cuenta, gestor, fechaOut, fechaIn, c_cont)
VALUES (:cuenta, :gestor, :fechaOut, now(), :id_cuenta)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':cuenta', $this->CUENTA);
        $sti->bindParam(':gestor', $this->gestor);
        $sti->bindParam(':fechaOut', $this->fechaOut);
        $sti->bindParam(':id_cuenta', $this->id_cuenta);
        $sti->execute();
    }

    public function insertVasign()
    {
        $query = "INSERT INTO vasign
			(cuenta, gestor, fechaOut, c_cont)
			VALUES 
			(:cuenta, :gestor, now(), :id_cuenta)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':cuenta', $this->CUENTA);
        $sti->bindParam(':gestor', $this->gestor);
        $sti->bindParam(':id_cuenta', $this->id_cuenta);
        $sti->execute();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getOneMonth()
    {
        $output = array();
        $end = new \DateTime();
        $begin = new \DateTime();
        $begin = $begin->modify('-1 month');

        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($begin, $interval, $end);

        /**
         * @var \DateTime $date
         */
        foreach ($dateRange as $date) {
            $output[] = $date->format("Y-m-d");
        }
        return $output;
    }

    /**
     *
     * @param string $gestor
     * @return array
     */
    public function countInOut($gestor)
    {
        $query = "select sum(fechaOut > curdate()) as asig,
    sum(fechaIn > curdate()) as recib 
    from vasign
where gestor=:gestor";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':gestor', $gestor);
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $gestor
     * @return array
     */
    public function listVasign($gestor = '')
    {
        $cuentas = Resumen::join('vasign', 'id_cuenta', '=', 'c_cont')
            ->join('users', 'iniciales', '=', 'gestor')
            ->join('dictamenes', 'dictamen', '=', 'status_aarsa');
        if (empty($gestor)) {
            $cuentas = $cuentas->orderBy('gestor')
                ->orderByDesc('fechaIn')
                ->orderByDesc('fechaOut')
                ->orderBy('numero_de_cuenta');
        } else {
            $cuentas = $cuentas->where('gestor', '=', $gestor)
                ->orderByDesc('fechaIn');
        }
        $result = $cuentas->get()->toArray();
        return $result;
    }

    /**
     * @param $r
     * @return mixed
     */
    public function updateVasign($r)
    {
        $this->setVars($r);
        /**
         * @var int $C_CONT
         */
        $C_CONT = $this->id_cuenta;
        /**
         * @var string $now
         */
        $now = date('Y-m-d');
        /**
         * @var Vasign $vasign
         */
        $vasign = Vasign::whereCuenta($C_CONT)
            ->whereNull('fechaIn')
            ->get();
        if (count($vasign) > 0) {
            $vasign->fechaIn = $now;
            $vasign->save;
        }
        return $vasign->toArray();
    }

    /**
     *
     * @param string $gestor
     * @return string
     * @throws \Exception
     */
    public function getCompleto($gestor)
    {
        try {
            $result = User::whereIniciales($gestor)->get()->first();
            return $result->completo;
        } catch (\Exception $e) {
            return '';
        }
    }

}
