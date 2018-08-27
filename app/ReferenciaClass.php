<?php

namespace App;

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
        $stq->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function load()
    {
        $query = <<<SQL
INSERT IGNORE INTO referencias 
SELECT id_cuenta, nombre_referencia_1 as nombre, tel_1_ref_1 as 'tel_1', tel_2_ref_1 as 'tel_2'
        FROM resumen 
        where tel_1_ref_1 <> ''
        UNION 
        SELECT id_cuenta, nombre_referencia_2 as nombre, tel_1_ref_2 as 'tel_1', tel_2_ref_2 as 'tel_2'
        FROM resumen 
        where tel_1_ref_2 <> ''
        UNION 
        SELECT id_cuenta, nombre_referencia_3 as nombre, tel_1_ref_3 as 'tel_1', tel_2_ref_3 as 'tel_2'
        FROM resumen 
        where tel_1_ref_3 <> ''
        UNION 
        SELECT id_cuenta, nombre_referencia_4 as nombre, tel_1_ref_4 as 'tel_1', tel_2_ref_4 as 'tel_2'
        FROM resumen
        where tel_1_ref_4 <> ''
SQL;
        $this->pdo->query($query);
    }
}

