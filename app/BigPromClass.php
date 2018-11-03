<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database queries for 'big' reports
 *
 * @author gmbs
 *
 */
class BigPromClass extends BaseClass
{

    /**
     *
     * @param string $direction
     * @return string
     */
    private function cleanDirection($direction)
    {
        $haystack = array('asc', 'ASC', 'desc', 'DESC');
        if (!in_array($direction, $haystack)) {
            $direction = 'ASC';
        }
        return $direction;
    }

    /**
     *
     * @param string $direction
     * @return array
     */
    public function getPromDates($direction)
    {
        $dir = $this->cleanDirection($direction);
        $start = <<<SQL
SELECT distinct d_prom FROM historia
        where n_prom > 0
        ORDER BY d_prom 
SQL;
        $end = " limit 60";
        $query = $start . $dir . $end;
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param BigDataClass $bdc
     * @return array
     */
    public function getProms($bdc)
    {
        $result = [];
        $agentString = $bdc->getAgentString();
        $clientString = $bdc->getClientString();
        $start = <<<SQL
select id_cuenta, Status_aarsa AS 'STATUS',c_cvge AS 'GESTOR',
    numero_de_cuenta as 'CUENTA',nombre_deudor as 'NOMBRE',
    saldo_descuento_1 as 'SALDO CAPITAL s/i',saldo_total as 'SALDO TOTAL',
    pagos_vencidos*30 as 'MORA',n_prom as 'TOTAL PROMESA',
    d_prom1 as 'FECHA PROMESA 1',n_prom1 as 'MONTO PROMESA 1',
    d_prom2 as 'FECHA PROMESA 2',n_prom2 as 'MONTO PROMESA 2',
    c_motiv AS 'MOTIVADOR',c_cnp AS 'CAUSA NO PAGO',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'CAMPANA',d_fech AS 'FECHA GESTION'
from resumen join historia h1 on c_cont=id_cuenta
left join pagos using (id_cuenta)
where n_prom>0
and d_fech between :fecha1 and :fecha2
and d_prom between :fecha3 and :fecha4
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
SQL;
        $end = " and status_de_credito NOT REGEXP '-' and c_visit is null 
        ORDER BY d_fech,c_hrin";
        $query = $start . $agentString . $clientString . $end;
        $stm = $this->pdo->prepare($query);
        $stm->bindValue(':fecha1', $bdc->date1);
        $stm->bindValue(':fecha2', $bdc->date2);
        $stm->bindValue(':fecha3', $bdc->date3);
        $stm->bindValue(':fecha4', $bdc->date4);
        if ($bdc->hasAgent()) {
            $stm->bindValue(':gestor', $bdc->agent);
        }
        if ($bdc->hasClient()) {
            $stm->bindValue(':cliente', $bdc->client);
        }
        $stm->execute();
        $main = $stm->fetchAll(\PDO::FETCH_ASSOC);
        $queryPayments = "SELECT MAX(fecha) AS 'FECHA PAGO',
            SUM(monto) AS 'MONTO PAGO',MAX(confirmado) as 'CONFIRMADO'
            FROM pagos WHERE id_cuenta = :id";
        $stp = $this->pdo->prepare($queryPayments);
        foreach ($main as $m) {
            $obj = (object)$m;
            $id = $obj->id_cuenta;
            $stp->bindValue(':id', $id);
            $stp->execute();
            $payments = $stp->fetch(\PDO::FETCH_ASSOC);
            $merged = array_merge($m, $payments);
            array_push($result, $merged);
        }
        return $result;
    }

    /**
     *
     * @return string[]
     */
    public function getPromiseClients()
    {
        $query = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        and N_PROM>0
        limit 10
	";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $clients = array_column($result, 'c_cvba');
        return $clients;
    }

    /**
     *
     * @return string[]
     */
    public function getPromiseAgents()
    {
        $query = "SELECT c_cvge, count(1) FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        and N_PROM>0
        group by c_cvge";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $agents = array_column($result, 'c_cvge');
        return $agents;
    }

}
