<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class PagobulkClass extends BaseClass {
    
    private function buildTemp(): void
    {
        $select = "SELECT null AS 'auto',
                numero_de_cuenta AS 'cuenta', 
                fecha_de_ultimo_pago AS 'fecha', 
                monto_ultimo_pago AS 'monto', 
                cliente, 
                ejecutivo_asignado_call_center AS 'gestor', 
                1 AS 'confirmado', 
                '' as 'credito',
                id_cuenta,
                now() as 'fechacapt'
                FROM resumen
                LIMIT 0";
        $queryBuildTemp = "CREATE TEMPORARY TABLE pagotemp " . $select;
        $this->pdo->query($queryBuildTemp);        
    }
    
    private function insertPagos(): void
    {
        $query = "INSERT IGNORE INTO pagos SELECT * FROM pagotemp";
        $this->pdo->query($query);
    }
    
    /**
     * 
     * @return PDOStatement
     */
    private function prepareCleanOld(): PDOStatement
    {
        $query = "delete from pagos
where confirmado=0 and cuenta=:cuenta
 and fecha<=:fecha";
        return $this->pdo->prepare($query);
    }

    /**
     * 
     * @return PDOStatement
     */
    private function prepareAddTemp(): PDOStatement
    {
        $select = "SELECT :cuenta, :fecha, :monto, 
                cliente, :c_cvge, 1 AS 'confirmado', id_cuenta
                FROM resumen
                WHERE numero_de_cuenta = :cuenta";
        $queryAddTemp = "INSERT INTO pagotemp " . $select;
        return $this->pdo->prepare($queryAddTemp);
    }

    /**
     * 
     * @return PDOStatement
     */
    private function prepareFindGestor(): PDOStatement
    {
        $queryFindGestor = "SELECT c_cvge 
FROM historia 
WHERE d_fech <= :fecha 
AND cuenta = :cuenta 
AND n_prom > 0 
ORDER BY d_fech DESC, c_hrin DESC 
LIMIT 1";
        return $this->pdo->prepare($queryFindGestor);
    }
    
    /**
     * 
     * @param PDOStatement $stp
     * @param string $cuenta
     * @param string $fecha
     */
    private function runCleanOld(PDOStatement $stp, string $cuenta, string $fecha): void
    {
            $stp->bindValue(':cuenta', $cuenta);
            $stp->bindValue(':fecha', $fecha);
            $stp->execute();
    }

    /**
     * 
     * @param PDOStatement $stp
     * @param string $cuenta
     * @param string $fecha
     * @param float $monto
     * @param string $c_cvge
     */
    private function runAddTemp(PDOStatement $stp, string $cuenta, string $fecha, float $monto, string $c_cvge): void
    {
            $stp->bindValue(':cuenta', $cuenta);
            $stp->bindValue(':fecha', $fecha);
            $stp->bindValue(':monto', $monto);
            $stp->bindValue(':c_cvge', $c_cvge);
            $stp->execute();
    }

    /**
     * 
     * @param PDOStatement $stp
     * @param string $cuenta
     * @param string $fecha
     * 
     * @return array
     */
    private function runFindGestor(PDOStatement $stp, string $cuenta, string $fecha): array
    {
            $stp->bindValue(':cuenta', $cuenta);
            $stp->bindValue(':fecha', $fecha);
            $stp->execute();
        return $stp->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $input
     * @return void
     */
    public function cargar(string $input): void
    {

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
            $c_cvge = '';
            if ($result) {
                $c_cvge = $result['c_cvge'];
            }
            $this->runAddTemp($sta, $data[$cuenta], $data[$fecha], $data[$monto], $c_cvge);
        }
        $this->insertPagos();
    }

}
