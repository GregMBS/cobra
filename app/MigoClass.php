<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of MigoClass
 *
 * @author gmbs
 */
class MigoClass extends BaseClass
{

    /**
     *
     * @return array
     */
    public function adminReport()
    {
        /** @var Builder $rc */
        $rc = new Resumen();
        /** @var Builder $query */
        $query = $rc->where('status_de_credito', 'NOT REGEXP', '-');
        $result = $query->get();
        return $result->toArray();
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function userReport($capt)
    {
        /** @var Resumen|Builder $rc */
        $rc = new Resumen();
        /** @var Builder $resumen */
        $resumen = $rc->whereEjecutivoAsignadoCallCenter($capt);
        $query = $resumen->where('status_de_credito', 'NOT REGEXP', '-');
        $result = $query->get();
        return $result->toArray();
    }

}
