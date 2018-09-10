<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Support\Collection;

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
    private $queryhead = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
	status_aarsa, ejecutivo_asignado_call_center, sum(monto) as sm,
	status_de_credito, producto, estado_deudor, ciudad_deudor,
	resumen.cliente as cli, resumen.id_cuenta as idc,
	fecha_ultima_gestion, saldo_vencido
FROM resumen
JOIN dictamenes ON dictamen=status_aarsa
LEFT JOIN pagos using (id_cuenta)
WHERE resumen.cliente=:cliente
AND queue=:queue ";
    
    /**
     *
     * @var string
     */
    private $querytail = " GROUP BY id_cuenta
ORDER BY saldo_total desc";


    /**
     * 
     * @param string $rato
     * @return string
     */
    private function getRatostr($rato) {
        switch ($rato) {
            case 'diario':
                $ratostr = " AND fecha_ultima_gestion>curdate() ";
                break;
            case 'semanal':
                $ratostr = "AND week(fecha_ultima_gestion)=week(curdate())
        AND year(fecha_ultima_gestion)=year(curdate()) ";
                break;
            case 'mensual':
                $ratostr = "AND fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day ";
                break;
            default:
                $ratostr = "";
                break;
        }
        return $ratostr;
    }

    /**
     * @param Collection $data
     * @return array
     */
    public function getSpecListReport(Collection $data) {
        $ratoStr = $this->getRatostr($data->rato);
        $sdcStr = 'AND status_de_credito not regexp "-" ';
        if (!(empty($data->sdc))) {
            $sdcStr = "AND status_de_credito=:sdc ";
        }
        $querymain = $this->queryhead . $sdcStr . $ratoStr . $this->querytail;
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':cliente', $data->cliente);
        $stm->bindParam(':queue', $data->queue);
        if (!(empty($data->sdc))) {
            $stm->bindParam(':sdc', $data->sdc);
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
