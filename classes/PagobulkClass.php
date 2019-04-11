<?php

namespace cobra_salsa;

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class PagobulkClass extends BaseClass {
    
    private function buildTemp() {
        $select = "SELECT numero_de_cuenta AS 'cuenta', 
                fecha_de_ultimo_pago AS 'fecha', 
                monto_ultimo_pago AS 'monto', 
                cliente, ejecutivo_asignado_call_center AS 'c_cvge', 
                1 AS 'confirmado', id_cuenta
                FROM resumen
                LIMIT 0";
        $queryBuildTemp = "CREATE TEMPORARY TABLE pagotemp " . $select;
        $this->pdo->query($queryBuildTemp);        
    }
    
    private function insertPagos() {
        $query = "INSERT IGNORE INTO pagos SELECT * FROM pagotemp";
        $this->pdo->query($query);
    }
    
    /**
     * 
     * @return \PDOStatement
     */
    private function prepareCleanOld() {
        $query = "delete from pagos
where confirmado=0 and cuenta=:cuenta
 and fecha<=:fecha";
        $stp = $this->pdo->prepare($query);
        return $stp;
    }

    /**
     * 
     * @return \PDOStatement
     */
    private function prepareAddTemp() {
        $select = "SELECT :cuenta, :fecha, :monto, 
                cliente, :c_cvge, 1 AS 'confirmado', id_cuenta
                FROM resumen
                WHERE numero_de_cuenta = :cuenta";
        $queryAddTemp = "INSERT INTO pagotemp " . $select;
        $stp = $this->pdo->prepare($queryAddTemp);
        return $stp;
    }

    /**
     * 
     * @return \PDOStatement
     */
    private function prepareFindGestor() {
        $queryFindGestor = "SELECT c_cvge 
FROM historia 
WHERE d_fech <= :fecha 
AND cuenta = :cuenta 
AND n_prom > 0 
ORDER BY d_fech DESC, c_hrin DESC 
LIMIT 1";
        $stp = $this->pdo->prepare($queryFindGestor);
        return $stp;
    }
    
    /**
     * 
     * @param \PDOStatement $stp
     * @param string $cuenta
     * @param string $fecha
     */
    private function runCleanOld($stp, $cuenta, $fecha) {
            $stp->bindValue(':cuenta', $cuenta);
            $stp->bindValue(':fecha', $fecha);
            $stp->execute();
    }

    /**
     * 
     * @param \PDOStatement $stp
     * @param string $cuenta
     * @param string $fecha
     * @param float $monto
     * @param string $c_cvge
     */
    private function runAddTemp($stp, $cuenta, $fecha, $monto, $c_cvge) {
            $stp->bindValue(':cuenta', $cuenta);
            $stp->bindValue(':fecha', $fecha);
            $stp->bindValue(':monto', $monto);
            $stp->bindValue(':c_cvge', $c_cvge);
            $stp->execute();
    }

    /**
     * 
     * @param \PDOStatement $stp
     * @param string $cuenta
     * @param string $fecha
     * 
     * @return array
     */
    private function runFindGestor($stp, $cuenta, $fecha) {
            $stp->bindValue(':cuenta', $cuenta);
            $stp->bindValue(':fecha', $fecha);
            $stp->execute();
            $result = $stp->fetch(\PDO::FETCH_ASSOC);
            return $result;
    }

    public function cargar($input) {

        $data = preg_split("/[\s,]+/", $input, 0, PREG_SPLIT_NO_EMPTY);
        $max = ceil(count($data) / 3);
        $this->buildTemp();
        $stc = $this->prepareCleanOld();
        $sta = $this->prepareAddTemp();
        $stf = $this->prepareFindGestor();
        for ($i = 0; $i < $max; $i++) {
            $cuenta = $i * 3;
            $fecha = $i * 3 + 1;
            $monto = $i * 3 + 2;
            $this->runCleanOld($stc, $data[$cuenta], $data[$fecha]);
            $result = $this->runFindGestor($stf, $data[$cuenta], $data[$fecha]);
            if ($result) {
                $c_cvge = $result['c_cvge'];
            } else {
                $c_cvge = '';
            }
            $this->runAddTemp($sta, $data[$cuenta], $data[$fecha], $data[$monto], $c_cvge);
        }
        $this->insertPagos();
    }

}
