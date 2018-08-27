<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class ActivarClass extends BaseClass {

    /**
     * @param array $data
     * @return int
     */
    private function countActive(array $data) {
        $count = 0;
        $queryCheck = "select 1 as fail from resumen 
where numero_de_cuenta = :cta 
and status_de_credito not regexp '-'";
        $stc = $this->pdo->prepare($queryCheck);
        foreach ($data as $d) {
            $stc->bindParam(':cta', $d);
            $stc->execute();
            $fail = $stc->fetch(\PDO::FETCH_ASSOC);
            $count += $fail['fail'];
        }
        return $count;
    }

    /**
     * @param array $data
     * @return int
     */
    private function countInactive(array $data) {
        $count = 0;
        $queryCheck = "select 1 as fail from resumen 
where numero_de_cuenta = :cta 
and status_de_credito regexp '-'";
        $stc = $this->pdo->prepare($queryCheck);
        foreach ($data as $d) {
            $stc->bindParam(':cta', $d);
            $stc->execute();
            $fail = $stc->fetch(\PDO::FETCH_ASSOC);
            $count += $fail['fail'];
        }
        return $count;
    }

    /**
     * @param array $data
     * @return array
     */
    public function activateCuentas(array $data) {
        $query = "update resumen
set status_de_credito=substring_index(status_de_credito,'-',1)
where numero_de_cuenta=:cta";
        $std = $this->pdo->prepare($query);
        foreach ($data as $d) {
            $std->bindParam(':cta', $d);
            $std->execute();
        }
        $count = [
            'active' => $this->countActive($data),
            'inactive' => $this->countInactive($data)
        ];
        return $count;
    }

    /**
     * @param array $data
     * @return array
     */
    public function inactivateCuentas(array $data) {
        $query = "update resumen
set status_de_credito=concat(substring_index(status_de_credito,'-',1),'-inactivo') 
where status_de_credito not regexp '-' and numero_de_cuenta=:cta";
        $std = $this->pdo->prepare($query);
        foreach ($data as $d) {
            $std->bindParam(':cta', $d);
            $std->execute();
        }
        $count = [
            'active' => $this->countActive($data),
            'inactive' => $this->countInactive($data)
        ];
        return $count;
    }
}
