<?php
namespace cobra_salsa;

use PDO;

/**
 *
 * @author gmbs
 *        
 */
class ReferenciaClass extends BaseClass
{
    /**
     * 
     * @param int $id_cuenta
     * @return string[][]
     */
    public function index($id_cuenta) {
        $query = "SELECT * FROM referencias 
                    WHERE id_cuenta = :id_cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

