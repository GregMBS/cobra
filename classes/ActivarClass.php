<?php

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
     * @return int
     */
    public function activateCuentas(array $data): int
    {
        $query = "update resumen
set status_de_credito = substring_index(status_de_credito,'-',1)
where numero_de_cuenta = :cta";
        return $this->runProcess($data, $query);
    }

    /**
     *
     * @param array $data
     * @return int
     */
    public function inactivateCuentas(array $data): int
    {
        $query = "update resumen
set status_de_credito=concat(substring_index(status_de_credito,'-',1),'-inactivo') 
where status_de_credito not regexp '-' and numero_de_cuenta=:cta";
        return $this->runProcess($data, $query);
    }

    /**
     *
     * @param array $data
     * @param string $query
     * @return int
     */
    private function runProcess(array $data, string $query): int
    {
        $count = 0;
        $std = $this->pdo->prepare($query);
        foreach ($data as $d) {
            $std->bindParam(':cta', $d);
            $std->execute();
            $count += $std->rowCount();
        }
        return $count;
    }
}
