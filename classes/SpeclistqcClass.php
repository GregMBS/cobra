<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gregmbs\cobra;

/**
 * Description of SpeclistqcClass
 *
 * @author gmbs
 */
class SpeclistqcClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;
    
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
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

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
     * 
     * @param string $rato
     * @param string $cliente
     * @param string $sdc
     * @param string $queue
     * @return array
     */
    public function getReport($rato, $cliente, $sdc, $queue) {
        $ratostr = $this->getRatostr($rato);
        $sdcstr = 'AND status_de_credito not regexp "-" ';
        if (!(empty($sdc))) {
            $sdcstr = "AND status_de_credito=:sdc ";
        }
        $querymain = $this->queryhead . $sdcstr . $ratostr . $this->querytail;
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':cliente', $cliente);
        $stm->bindParam(':queue', $queue);
        if (!(empty($sdc))) {
            $stm->bindParam(':sdc', $sdc);
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
