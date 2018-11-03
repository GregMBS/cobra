<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 *
 * @author gmbs
 *        
 */
class ReferenceClass extends BaseClass
{
    /**
     * 
     * @param int $id
     * @return string[][]
     */
    public function index($id) {
        $rc = new Reference();
        /**
         * @var Builder $query
         */
        $query = $rc->whereIdCuenta($id);
        $result = $query->get();
        return $result->toArray();
    }

    public function load()
    {
        $query = <<<SQL
INSERT IGNORE INTO referencias (id_cuenta, nombre, tel_1, tel_2) 
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

