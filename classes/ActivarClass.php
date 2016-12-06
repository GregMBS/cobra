<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class ActivarClass extends BaseClass {

    /**
     * 
     * @param array $data
     */
    public function activateCuentas($data) {
        $querydie = "update resumen
set status_de_credito=substring_index(status_de_credito,'-',1)
where numero_de_cuenta=:cta";
        $std = $this->pdo->prepare($querydie);
        foreach ($data as $d) {
            $std->bindParam(':cta', $d);
            $std->execute();
        }
    }

    /**
     * 
     * @param array $data
     */
    public function inactivateCuentas($data) {
        $querydie = "update resumen
set status_de_credito=concat(substring_index(status_de_credito,'-',1),'-inactivo') 
where status_de_credito not regexp '-' and numero_de_cuenta=:cta";
        $std = $this->pdo->prepare($querydie);
        foreach ($data as $d) {
            $std->bindParam(':cta', $d);
            $std->execute();
        }
    }
}
