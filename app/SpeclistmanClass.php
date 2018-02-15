<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of SpeclistmanClass
 *
 * @author gmbs
 */
class SpeclistmanClass extends BaseClass {

    /**
     * 
     * @param string $cliente
     * @param string $sdc
     * @return array
     */
    public function getReport($cliente, $sdc) {
        $querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total, status_aarsa,
ejecutivo_asignado_call_center, status_de_credito, 
resumen.cliente as cli, fecha_ultima_gestion, especial 
FROM resumen 
JOIN dictamenes ON dictamen = status_aarsa
LEFT JOIN pagos using (id_cuenta)
WHERE resumen.cliente = :cliente
AND status_de_credito = :sdc
AND especial > 0
GROUP BY id_cuenta
ORDER BY especial, saldo_descuento_1 desc";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':cliente', $cliente);
        $stm->bindParam(':sdc', $sdc);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
