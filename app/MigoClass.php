<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
        /**
         * @var Builder $query
         * @var Collection $result
         */
        $rc = new Resumen();
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
        /**
         * @var Resumen $resumen
         * @var Builder $query
         * @var Collection $result
         */
        $rc = new Resumen();
        $resumen = $rc->whereEjecutivoAsignadoCallCenter($capt);
        $query = $resumen->where('status_de_credito', 'NOT REGEXP', '-');
        $result = $query->get();
        return $result->toArray();
    }

}
