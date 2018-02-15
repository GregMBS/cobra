<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of QueueManualClass
 *
 * @author gmbs
 */
class QueueManualClass extends BaseClass {

    /**
     * 
     */
    public function truncateManual() {
        $queryclean = "UPDATE resumen
SET especial=0
WHERE especial>0";
        $this->pdo->query($queryclean);
    }

    /**
     * 
     * @param string $dataPost
     * @param string $clientea
     */
    public function loadManual($dataPost, $clientea) {
        $queryins = "UPDATE resumen
SET especial=1
WHERE numero_de_cuenta=:data
AND cliente=:clientea";
        $sti = $this->pdo->prepare($queryins);
        $data = preg_split("/[\s,]+/", $dataPost, 0, PREG_SPLIT_NO_EMPTY);
        $max = count($data);
        for ($i = 0; $i < $max; $i++) {
            $sti->bindParam(':data', $data[$i]);
            $sti->bindParam(':clientea', $clientea);
            $sti->execute();
        }
    }

    /**
     * 
     * @return array
     */
    public function listClients() {
        $query = "SELECT cliente FROM clientes";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getReport() {
        $querymain = "SELECT
    cliente,
    status_de_credito AS segmento,
    ejecutivo_asignado_call_center as asignado,
    COUNT(1) AS total,
    SUM(fecha_ultima_gestion < NOW() - INTERVAL 1 HOUR) AS normal,
    SUM(fecha_ultima_gestion < CURDATE()) AS largo
FROM
    resumen
WHERE
    especial > 0
        AND status_de_credito NOT REGEXP '-'
GROUP BY cliente , status_de_credito , ejecutivo_asignado_call_center";
        $result = $this->pdo->query($querymain);
        return $result;
    }

}
