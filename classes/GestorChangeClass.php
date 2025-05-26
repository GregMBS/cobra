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
    public function listCuentas(array $data) {
        $query = "SELECT * FROM resumen 
        WHERE numero_de_cuenta IN (:cta)";
        return $this->runProcess($data, $query);
    }

    /**
     * @return string[]
     */
    public function listGestores() {
        $query = "SELECT iniciales FROM nombres 
        ORDER BY iniciales";
        $stu = $this->pdo->prepare($query);
        $stu->execute();
        return $stu->fetchAll(PDO::FETCH_COLUMN,0);
    }

    /**
     *
     * @param int $id_cuenta
     * @param string $gestor
     * @param string $sdc
     * @return ResumenObject
     */
    public function changeGestor(int $id_cuenta, string $gestor, string $sdc) {
        $query = "UPDATE resumen
SET ejecutivo_asignado_call_center = :gestor, status_de_credito = :sdc, fecha_de_actualizacion = CURDATE()
WHERE id_cuenta = :id_cuenta";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':gestor', $gestor);
        $stu->bindValue(':sdc', $sdc);
        $stu->bindValue(':id_cuenta', $id_cuenta);
        $stu->execute();
        $queryId = "SELECT * FROM resumen 
        WHERE id_cuenta = :id_cuenta";
        $sti = $this->pdo->prepare($queryId);
        $sti->bindValue(':id_cuenta', $id_cuenta);
        $sti->execute();
        $result = $sti->fetchObject(ResumenObject::class);
        if ($result) {
            return $result;
        }
        return new ResumenObject();
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
