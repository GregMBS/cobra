<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Description of CheckClass
 *
 * @author gmbs
 */
class CheckClass extends BaseClass
{

    /**
     * @param Collection $r
     */
    public function insertVasignBoth(Collection $r)
    {
        $cdc = new CheckDataClass($r);
        $query = "INSERT INTO vasign (cuenta, gestor, fechaOut, fechaIn, c_cont)
VALUES (:cuenta, :gestor, :fechaOut, now(), :id_cuenta)";
        try {
            $sti = $this->pdo->prepare($query);
            $sti->bindValue(':cuenta', $cdc->getAccount());
            $sti->bindValue(':gestor', $cdc->getAgent());
            $sti->bindValue(':fechaOut', $cdc->getDateOut());
            $sti->bindValue(':id_cuenta', $cdc->getId());
            $sti->execute();
        } catch (\PDOException $p) {
            dd($p->getMessage());
        }
    }

    /**
     * @param Collection $r
     */
    public function insertVasign(Collection $r)
    {
        $cdc = new CheckDataClass($r);
        $vasign = new Vasign();
        try {
            $vasign->CUENTA = $cdc->getAccount();
            $vasign->gestor = $cdc->getAgent();
            $vasign->fechaout = date('Y-m-d');
            $vasign->c_cont = $cdc->getId();
            $vasign->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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
        $stc->bindValue(':gestor', $gestor);
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
        $columns = array(
            'id_cuenta',
            "numero_de_cuenta",
            "nombre_deudor",
            "cliente",
            "saldo_total",
            "queue",
            "gestor",
            "fechaOut",
            "fechaIn"
        );
        /** @var Builder $rc */
        $rc = new Resumen();
        /** @var Builder $cuentas */
        $cuentas = $rc->join('vasign', 'id_cuenta', '=', 'c_cont')
            ->join('users', 'iniciales', '=', 'gestor')
            ->join('dictamenes', 'dictamen', '=', 'status_aarsa');
        if (!empty($gestor)) {
            $cuentas = $cuentas->where('gestor', '=', $gestor)
                ->orderByDesc('fechaIn');
            $result = $cuentas->get()->toArray();
            return $result;
        }
        $noGestor = $cuentas->orderBy('gestor')
            ->orderByDesc('fechaIn')
            ->orderByDesc('fechaOut')
            ->orderBy('numero_de_cuenta')
            ->select($columns);
        $result = $noGestor->get()->toArray();
        return $result;
    }

    /**
     * @param Collection $r
     */
    public function updateVasign(Collection $r)
    {
        $cdc = new CheckDataClass($r);
        /**
         * @var int $C_CONT
         */
        $C_CONT = $cdc->getId();
        /**
         * @var string $now
         */
        $now = date('Y-m-d');
        /** @var Builder $query */
        $query = Vasign::whereCCont($C_CONT)
            ->whereNull('fechaIn');
        /** @var Vasign $vasign */
        $vasign = $query->get();
        foreach ($vasign as $v) {
            $v->fechaIn = $now;
            $v->save();
        }
    }

    /**
     *
     * @param string $gestor
     * @return string
     * @throws \Exception
     */
    public function getCompleto($gestor)
    {
        /**
         * @var User $uc
         */
        $uc = new User();
        try {
            /** @var Builder $query */
            $query = $uc->whereIniciales($gestor);
            /** @var User $result */
            $result = $query->get()->first();
            return $result->completo;
        } catch (\Exception $e) {
            return '';
        }
    }

}
