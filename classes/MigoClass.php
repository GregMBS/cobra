<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of MigoClass
 *
 * @author gmbs
 */
class MigoClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @return array
     */
    public function adminReport() {
        $querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
status_de_credito, cliente, status_aarsa,
saldo_descuento_2, id_cuenta,
fecha_ultima_gestion
FROM resumen
where status_de_credito not regexp '-'";
        $result = $this->pdo->query($querymain);
        return $result;
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function userReport($capt) {
        $querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
status_de_credito, cliente, status_aarsa,
saldo_descuento_2, id_cuenta,
fecha_ultima_gestion
FROM resumen
where status_de_credito not regexp '-'
and ejecutivo_asignado_call_center = :capt
";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':capt', $capt);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
