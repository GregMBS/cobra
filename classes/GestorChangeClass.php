<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ResumenObject.php';

class GestorChangeClass extends BaseClass {

    /**
     *
     * @param array $data
     * @return ResumenObject[]
     */
    public function listCuentas($data) {
        $query = "SELECT * FROM resumen 
        WHERE numero_de_cuenta IN (:cta)";
        return $this->runProcess($data, $query);
    }

    /**
     *
     * @param string $cliente
     * @param string $cuenta
     * @param string $gestor
     * @param string $sdc
     * @return bool
     */
    public function changeGestor(string $cliente, string $cuenta, string $gestor, string $sdc) {
        $query = "UPDATE resumen
SET ejecutivo_asignado_call_center = :gestor, status_de_credito = :sdc, fecha_de_actualizacion = CURDATE()
WHERE cliente = :cliente AND numero_de_cuenta = :cuenta";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':gestor', $gestor);
        $stu->bindValue(':sdc', $sdc);
        $stu->bindValue(':cliente', $cliente);
        $stu->bindValue(':cuenta', $cuenta);
        return $stu->execute();
    }

    /**
     *
     * @param array $data
     * @param string $query
     * @return ResumenObject[]
     */
    private function runProcess($data, $query)
    {
        $output = array();
        $std = $this->pdo->prepare($query);
        foreach ($data as $d) {
            $std->bindParam(':cta', $d);
            $std->execute();
            $result = $std->fetchAll(PDO::FETCH_CLASS, ResumenObject::class);
            foreach ($result as $row) {
                $output[] = $row;
            }
        }
        return $output;
    }
}
