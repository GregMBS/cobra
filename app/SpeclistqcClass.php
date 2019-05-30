<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;


/**
 * Description of SpeclistqcClass
 *
 * @author gmbs
 */
class SpeclistqcClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $queryHead = <<<SQL
SELECT numero_de_cuenta, nombre_deudor, saldo_total,
	status_aarsa, ejecutivo_asignado_call_center, sum(monto) as sm,
	status_de_credito, producto, estado_deudor, ciudad_deudor,
	resumen.cliente as cli, resumen.id_cuenta as idc,
	fecha_ultima_gestion, saldo_vencido
FROM resumen
JOIN dictamenes ON dictamen=status_aarsa
LEFT JOIN pagos using (id_cuenta)
WHERE resumen.cliente=:cliente
AND queue=:queue 
SQL;

    
    /**
     *
     * @var string
     */
    private $queryTail = " GROUP BY cli, numero_de_cuenta
ORDER BY saldo_total desc";

    /**
     * @param SpeclistDataClass $data
     * @return array
     */
    public function getSpecListReport(SpeclistDataClass $data) {
        $client = $data->cliente;
        $queue = $data->queue;
        $status = $data->sdc;
        $rateString = $data->rateString;
        $statusString = $data->statusString;
        $querymain = $this->queryHead . $statusString . $rateString . $this->queryTail;
        $stm = $this->pdo->prepare($querymain);
        $stm->bindValue(':cliente', $client);
        $stm->bindValue(':queue', $queue);
        if (!(empty($data->sdc))) {
            $stm->bindValue(':sdc', $status);
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
