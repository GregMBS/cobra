<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDOStatement;

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
     * @return false|PDOStatement
     */
    public function adminReport() {
        $query = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
status_de_credito, cliente, status_aarsa,
saldo_descuento_2, id_cuenta,
fecha_ultima_gestion
FROM resumen
where status_de_credito not regexp '-'";
        return $this->pdo->query($query);
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function userReport($capt) {
        $query = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
status_de_credito, cliente, status_aarsa,
saldo_descuento_2, id_cuenta,
fecha_ultima_gestion
FROM resumen
where status_de_credito not regexp '-'
and ejecutivo_asignado_call_center = :capt
";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':capt', $capt);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

}
