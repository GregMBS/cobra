<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use PDOStatement;

/**
 * Description of PagobulkClass
 *
 * @author gmbs
 */
class PagobulkClass extends BaseClass {

    private function buildTemp() {
        $queryDropTemp = "DROP TABLE IF EXISTS pagotemp";
        $this->pdo->query($queryDropTemp);
        $queryBuildTemp = "CREATE TABLE pagotemp 
                SELECT numero_de_cuenta AS 'cuenta', 
                fecha_de_ultimo_pago AS 'fecha', 
                monto_ultimo_pago AS 'monto', 
                cliente, ejecutivo_asignado_call_center AS 'gestor', 
                1 AS 'confirmado', id_cuenta
                FROM resumen
                LIMIT 0";
        $this->pdo->query($queryBuildTemp);
    }

    /**
     * 
     * @return PDOStatement
     */
    private function pagoClean() {
        $querypagoclean = "delete from pagos
where confirmado=0 and cuenta=:cuenta
 and fecha<=:fecha";
        $stpc = $this->pdo->prepare($querypagoclean);
        return $stpc;
    }

    /**
     * 
     * @return PDOStatement
     */
    private function addTemp() {
        $queryAddTemp = "INSERT INTO pagotemp 
                SELECT :cuenta, :fecha, :monto, 
                cliente, :c_cvge, 1 AS 'confirmado', id_cuenta
                FROM resumen
                WHERE numero_de_cuenta = :cuenta";
        $stpa = $this->pdo->prepare($queryAddTemp);
        return $stpa;
    }

    /**
     * 
     * @return PDOStatement
     */
    private function findGestor() {
        $queryFindGestor = "SELECT c_cvge FROM historia "
                . "WHERE d_fech <= :fecha "
                . "AND cuenta = :cuenta "
                . "AND n_prom > 0"
                . "ORDER BY d_fech DESC, c_hrin DESC "
                . "LIMIT 1";
        $stpf = $this->pdo->prepare($queryFindGestor);
        return $stpf;
    }

    /**
     * 
     * @param PDOStatement $stm
     * @return boolean
     */
    private function testPDOStatement($stm) {
        if (is_a($stm, 'PDOStatement')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $input
     * @return array
     */
    private function dataToArray($input) {
        $array_csv = array();
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $array_csv[] = str_getcsv($line);
        }
        return $array_csv;
    }

    /**
     * 
     * @param PagobulkRowClass $rc
     */
    private function cleanPago(PagobulkRowClass $rc) {
        $stpc = $this->pagoClean();
        $stpc->bindParam(':cuenta', $rc->getCuenta());
        $stpc->bindParam(':fecha', $rc->getFecha());
        $stpc->execute();
    }

    /**
     * 
     * @param PagobulkRowClass $rc
     * 
     */
    private function getGestor(PagobulkRowClass $rc) {
        $stpf = $this->findGestor();
        $stpf->bindParam(':cuenta', $rc->getCuenta());
        $stpf->bindParam(':fecha', $rc->getFecha());
        $stpf->execute();
        $result = $stpf->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            $c_cvge = $result['c_cvge'];
        } else {
            $c_cvge = '';
        }
        $rc->setGestor($c_cvge);
    }

    /**
     * 
     * @param PagobulkRowClass $rc
     */
    private function fillTemp(PagobulkRowClass $rc) {
        $stpa = $this->addTemp();
        $stpa->bindParam(':cuenta', $rc->getCuenta());
        $stpa->bindParam(':fecha', $rc->getFecha());
        $stpa->bindParam(':monto', $rc->getMonto());
        $stpa->bindParam(':c_cvge', $rc->getGestor());
        $stpa->execute();
    }

    /**
     * 
     * @param string $input
     * @return string
     */
    public function main($input) {
        $array = $this->dataToArray($input);
        $icount=count($array);
        $this->buildTemp();
        $count = 0;
        foreach ($array as $row) {
            $rc = new PagobulkRowClass($row);
            if ($rc->valid()) {
                $this->cleanPago($rc);
                $this->getGestor($rc);
                $this->fillTemp($rc);
                $count++;
            }
        }
        $countfin = $this->finish();
        return $countfin . " pagos cargados de $count validas de $icount" ;
    }

    /**
     * 
     * @return int
     */
    private function finish() {
        $querypagoins = "INSERT IGNORE INTO pagos "
                . "(cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta) "
                . "SELECT cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta "
                . "FROM pagotemp";
        $q = $this->pdo->prepare($querypagoins);
        $q->execute();
        $count = $q->rowCount();
        return $count;
    }

}
