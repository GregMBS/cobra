<?php

namespace cobra_salsa;

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class PagobulkClass extends BaseClass {
    
    private function buildTemp() {
        $queryBuildTemp = "CREATE TEMPORARY TABLE pagotemp 
                SELECT numero_de_cuenta AS 'cuenta', 
                fecha_de_ultimo_pago AS 'fecha', 
                monto_ultimo_pago AS 'monto', 
                cliente, ejecutivo_aasignado_call_center AS 'c_cvge', 
                1 AS 'confirmado, id_cuenta
                FROM resumen
                LIMIT 0";
        $this->pdo->query($queryBuildTemp);        
    }
    
    private function insertPagos() {
        $querypagoins = "INSERT IGNORE INTO pagos SELECT * FROM pagotemp";
        $this->pdo->query($querypagoins);        
    }
    
    /**
     * 
     * @return \PDOStatement
     */
    private function prepareCleanOld() {
        $querypagoclean = "delete from pagos
where confirmado=0 and cuenta=:cuenta
 and fecha<=:fecha";
        $stpc = $this->pdo->prepare($querypagoclean);
        return $stpc;
    }

    /**
     * 
     * @return \PDOStatement
     */
    private function prepareAddTemp() {
        $queryAddTemp = "INSERT INTO pagotemp 
                SELECT :cuenta, :fecha, :monto, 
                cliente, :c_cvge, 1 AS 'confirmado, id_cuenta
                FROM resumen
                WHERE numero_de_cuenta = :cuenta";
        $stpa = $this->pdo->prepare($queryAddTemp);
        return $stpa;
    }

    /**
     * 
     * @return \PDOStatement
     */
    private function prepareFindGestor() {
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
     * @param \PDOStatement $stpc
     * @param string $cuenta
     * @param string $fecha
     */
    private function runCleanOld($stpc, $cuenta, $fecha) {
            $stpc->bindParam(':cuenta', $cuenta);
            $stpc->bindParam(':fecha', $fecha);
            $stpc->execute();
    }

    /**
     * 
     * @param \PDOStatement $stpa
     * @param string $cuenta
     * @param string $fecha
     * @param float $monto
     * @param string $c_cvge
     */
    private function runAddTemp($stpa, $cuenta, $fecha, $monto, $c_cvge) {
            $stpa->bindParam(':cuenta', $$cuenta);
            $stpa->bindParam(':fecha', $fecha);
            $stpa->bindParam(':monto', $monto);
            $stpa->bindParam(':c_cvge', $c_cvge);
            $stpa->execute();
    }

    /**
     * 
     * @param \PDOStatement $stpf
     * @param string $cuenta
     * @param typstringe $fecha
     * 
     * @return array
     */
    private function runFindGestor($stpf, $cuenta, $fecha) {
            $stpf->bindParam(':cuenta', $cuenta);
            $stpf->bindParam(':fecha', $fecha);
            $stpf->execute();
            $result = $stpf->fetch(PDO::FETCH_ASSOC);
            return $result;
    }

    public function cargar($input) {

        $data = preg_split("/[\s,]+/", $input, 0, PREG_SPLIT_NO_EMPTY);
        $max = ceil(count($data) / 3);
        $this->buildTemp();
        $stpc = $this->prepareCleanOld();
        $stpa = $this->prepareAddTemp();
        $stpf = $this->prepareFindGestor();
        for ($i = 0; $i < $max; $i++) {
            $cuenta = $i * 3;
            $fecha = $i * 3 + 1;
            $monto = $i * 3 + 2;
            $this->runCleanOld($stpc, $data[$cuenta], $data[$fecha]);
            $result = $this->runFindGestor($stpf, $data[$cuenta], $data[$fecha]);
            if ($result) {
                $c_cvge = $result['c_cvge'];
            } else {
                $c_cvge = '';
            }
            $this->runAddTemp($stpa, $data[$cuenta], $data[$fecha], $data[$monto], $data[$c_cvge]);
        }
        $this->insertPagos();
    }

}
