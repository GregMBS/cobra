<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ResumenObject.php';

/**
 * Description of MigoClass
 *
 * @author gmbs
 */
class MigoClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @return array
     */
    public function adminReport() {
        $query = "SELECT *
FROM resumen
where status_de_credito not regexp '-'";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, ResumenObject::class);
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function userReport($capt) {
        $query = "SELECT *
FROM resumen
where status_de_credito not regexp '-'
and ejecutivo_asignado_call_center = :capt
";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':capt', $capt);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, ResumenObject::class);
    }

}
