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
    public function insertVisitorAssignmentBoth(Collection $r)
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
    public function insertVisitorAssignment(Collection $r)
    {
        $cdc = new CheckDataClass($r);
        $assignment = new VisitAssignment();
        try {
            $assignment->CUENTA = $cdc->getAccount();
            $assignment->gestor = $cdc->getAgent();
            $assignment->fechaout = date('Y-m-d');
            $assignment->c_cont = $cdc->getId();
            $assignment->save();
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
     * @param string $agent
     * @return array
     */
    public function countInOut($agent)
    {
        $query = "select sum(fechaOut > curdate()) as asig,
    sum(fechaIn > curdate()) as recib 
    from vasign
where gestor=:agent";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':agent', $agent);
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $agent
     * @return array
     */
    public function listVisitorAssignment($agent = '')
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
        $rc = new Debtor();
        /** @var Builder $debtors */
        $debtors = $rc->join('vasign', 'id_cuenta', '=', 'c_cont')
            ->join('users', 'iniciales', '=', 'gestor')
            ->join('dictamenes', 'dictamen', '=', 'status_aarsa');
        if (!empty($agent)) {
            $debtors = $debtors->where('gestor', '=', $agent)
                ->orderByDesc('fechaIn');
            $result = $debtors->get()->toArray();
            return $result;
        }
        $noAgent = $debtors->orderBy('gestor')
            ->orderByDesc('fechaIn')
            ->orderByDesc('fechaOut')
            ->orderBy('numero_de_cuenta')
            ->select($columns);
        $result = $noAgent->get()->toArray();
        return $result;
    }

    /**
     * @param Collection $r
     */
    public function updateVisitorAssignment(Collection $r)
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
        $query = VisitAssignment::whereCCont($C_CONT)
            ->whereNull('fechaIn');
        /** @var VisitAssignment $assignment */
        $assignment = $query->get();
        foreach ($assignment as $v) {
            $v->fechaIn = $now;
            $v->save();
        }
    }

    /**
     *
     * @param string $initials
     * @return string
     * @throws \Exception
     */
    public function getFullName($initials)
    {
        /**
         * @var User $uc
         */
        $uc = new User();
        try {
            /** @var Builder $query */
            $query = $uc->whereIniciales($initials);
            /** @var User $result */
            $result = $query->get()->first();
            return $result->completo;
        } catch (\Exception $e) {
            return '';
        }
    }

}
