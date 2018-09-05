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
        $gestorstr = $bdc->getGestorString();
        $clientestr = $bdc->getClienteString();
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
        $querymain = $start . $gestorstr . $clientestr . $end;
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':fecha1', $bdc->fecha1);
        $stm->bindParam(':fecha2', $bdc->fecha2);
        $stm->bindParam(':fecha3', $bdc->fecha3);
        $stm->bindParam(':fecha4', $bdc->fecha4);
        if ($bdc->hasGestor()) {
            $stm->bindParam(':gestor', $bdc->gestor);
        }
        if ($bdc->hasCliente()) {
            $stm->bindParam(':cliente', $bdc->cliente);
        }
        $stm->execute();
        $main = $stm->fetchAll(\PDO::FETCH_ASSOC);
        $querypagos = "SELECT MAX(fecha) AS 'FECHA PAGO',
            SUM(monto) AS 'MONTO PAGO',MAX(confirmado) as 'CONFIRMADO'
            FROM pagos WHERE id_cuenta = :id";
        $stp = $this->pdo->prepare($querypagos);
        foreach ($main as $m) {
            $obj = (object)$m;
            $id_cuenta = $obj->id_cuenta;
            $stp->bindParam(':id', $id_cuenta);
            $stp->execute();
            $pagos = $stp->fetch(\PDO::FETCH_ASSOC);
            $merged = array_merge($m, $pagos);
            array_push($result, $merged);
        }
        return $result;
    }

    /**
     *
     * @return string[]
     */
    public function getPromClientes()
    {
        $query = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        and N_PROM>0
        limit 10
	";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $clientes = array_column($result, 'c_cvba');
        return $clientes;
    }

    /**
     *
     * @return string[]
     */
    public function getPromGestores()
    {
        $query = "SELECT c_cvge, count(1) FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        and N_PROM>0
        group by c_cvge";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $gestores = array_column($result, 'c_cvge');
        return $gestores;
    }

}
