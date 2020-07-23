<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ResumenObject.php';

/**
 * Description of SpeclistqcClass
 *
 * @author gmbs
 */
class SpeclistqcClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;
    
    /**
     *
     * @var string
     */
    private $queryHead = "SELECT distinct resumen.*
FROM resumen
JOIN dictamenes ON dictamen=status_aarsa
WHERE resumen.cliente=:cliente
AND queue=:queue ";
    
    /**
     *
     * @var string
     */
    private $queryTail = " ORDER BY saldo_total desc";


    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $rato
     * @return string
     */
    private function getRatoString($rato) {
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
    public function getReport($rato, $cliente, $sdc, $queue) {
        $ratoString = $this->getRatoString($rato);
        $sdcString = 'AND status_de_credito not regexp "-" ';
        if (!(empty($sdc))) {
            $sdcString = "AND status_de_credito=:sdc ";
        }
        $querymain = $this->queryHead . $sdcString . $ratoString . $this->queryTail;
        $stm = $this->pdo->prepare($querymain);
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
