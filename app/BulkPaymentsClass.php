<?php

namespace App;

use PDOStatement;

/**
 * Description of BulkPaymentsClass
 *
 * @author gmbs
 */
class BulkPaymentsClass extends BaseClass
{

    private function buildTemp()
    {
        $queryDropTemp = "DROP TABLE IF EXISTS temp_pay";
        $this->pdo->query($queryDropTemp);
        $queryBuildTemp = "CREATE TABLE temp_pay 
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
    private function removeOld()
    {
        $query = "delete from pagos
where confirmado=0 and cuenta=:cuenta
 and fecha<=:fecha";
        $stp = $this->pdo->prepare($query);
        return $stp;
    }

    /**
     *
     * @return PDOStatement
     */
    private function addTemp()
    {
        $query = "INSERT INTO temp_pay 
                SELECT :cuenta, :fecha, :monto, 
                cliente, :c_cvge, 1 AS 'confirmado', id_cuenta
                FROM resumen
                WHERE numero_de_cuenta = :cuenta";
        $stp = $this->pdo->prepare($query);
        return $stp;
    }

    /**
     *
     * @return PDOStatement
     */
    private function findAgent()
    {
        $query = <<<SQL
        SELECT c_cvge FROM historia 
                WHERE d_fech <= :fecha 
                AND cuenta = :cuenta 
                AND n_prom > 0 
                ORDER BY d_fech DESC, c_hrin DESC 
                LIMIT 1
SQL;
        $stp = $this->pdo->prepare($query);
        return $stp;
    }

    /**
     *
     * @param string $input
     * @return array
     */
    private function dataToArray($input)
    {
        $array_csv = array();
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $array_csv[] = str_getcsv($line);
        }
        return $array_csv;
    }

    /**
     *
     * @param BulkPaymentsRowClass $rc
     */
    private function cleanPayments(BulkPaymentsRowClass $rc)
    {
        $stp = $this->removeOld();
        $stp->bindValue(':cuenta', $rc->getAccount());
        $stp->bindValue(':fecha', $rc->getDate());
        $stp->execute();
    }

    /**
     *
     * @param BulkPaymentsRowClass $rc
     *
     */
    private function getAgent(BulkPaymentsRowClass $rc)
    {
        $stp = $this->findAgent();
        $stp->bindValue(':cuenta', $rc->getAccount());
        $stp->bindValue(':fecha', $rc->getDate());
        $stp->execute();
        $result = $stp->fetch(\PDO::FETCH_ASSOC);
        $agent = '';
        if ($result) {
            $agent = $result['c_cvge'];
        }
        $rc->setAgent($agent);
    }

    /**
     *
     * @param BulkPaymentsRowClass $rc
     */
    private function fillTemp(BulkPaymentsRowClass $rc)
    {
        $stp = $this->addTemp();
        $stp->bindValue(':cuenta', $rc->getAccount());
        $stp->bindValue(':fecha', $rc->getDate());
        $stp->bindValue(':monto', $rc->getAmount());
        $stp->bindValue(':c_cvge', $rc->getAgent());
        $stp->execute();
    }

    /**
     *
     * @param string $input
     * @return string
     */
    public function main($input)
    {
        $array = $this->dataToArray($input);
        $iCount = count($array);
        $this->buildTemp();
        $count = 0;
        foreach ($array as $row) {
            $rc = new BulkPaymentsRowClass($row);
            if ($rc->valid()) {
                $this->cleanPayments($rc);
                $this->getAgent($rc);
                $this->fillTemp($rc);
                $count++;
            }
        }
        $counted = $this->finish();
        return $counted . " pagos cargados de $count validas de $iCount";
    }

    /**
     *
     * @return int
     */
    private function finish()
    {
        $query = "INSERT IGNORE INTO pagos 
        (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta) 
        SELECT cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta 
        FROM temp_pay";
        $q = $this->pdo->prepare($query);
        $q->execute();
        $count = $q->rowCount();
        return $count;
    }

}
