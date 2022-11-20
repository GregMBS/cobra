<?php

namespace cobra_salsa;

use PDO;

require_once 'classes/ResumenObject.php';

/**
 * Description of SpeclistqcClass
 *
 * @author gmbs
 */
class SpeclistqcClass {

    /**
     * @var PDO $pdo
     */
    protected PDO $pdo;
    
    /**
     *
     * @var string
     */
    private string $queryHead = "SELECT distinct resumen.*
FROM resumen
JOIN dictamenes ON dictamen=status_aarsa
WHERE resumen.cliente=:cliente
AND queue=:queue ";
    
    /**
     *
     * @var string
     */
    private string $queryTail = " ORDER BY saldo_total desc";


    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $rato
     * @return string
     */
    private function getRatoString(string $rato): string
    {
        switch ($rato) {
            case 'diario':
                return " AND fecha_ultima_gestion > curdate() ";

            case 'semanal':
                return "AND fecha_ultima_gestion > (curdate() - interval 6 day) ";

            case 'mensual':
                return "AND fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day ";

            default:
                return "";
        }
    }

    /**
     * 
     * @param string $rato
     * @param string $cliente
     * @param string $sdc
     * @param string $queue
     * @return ResumenObject[]
     */
    public function getReport(string $rato, string $cliente, string $sdc, string $queue): array
    {
        $ratoString = $this->getRatoString($rato);
        $sdcString = 'AND status_de_credito not regexp "-" ';
        if (!(empty($sdc))) {
            $sdcString = "AND status_de_credito=:sdc ";
        }
        $queryMain = $this->queryHead . $sdcString . $ratoString . $this->queryTail;
        $stm = $this->pdo->prepare($queryMain);
        $stm->bindParam(':cliente', $cliente);
        $stm->bindParam(':queue', $queue);
        if (!(empty($sdc))) {
            $stm->bindParam(':sdc', $sdc);
        }
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_CLASS, ResumenObject::class);
        if ($result) {
            return $result;
        }
        return [
            new ResumenObject()
            ];
    }

}
