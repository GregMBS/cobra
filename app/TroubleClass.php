<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of TroubleClass
 *
 * @author gmbs
 */
class TroubleClass extends BaseClass {

    /**
     * @param TroubleDataClass $tdc
     * @param string $capt
     */
    public function updateTrouble(TroubleDataClass $tdc, $capt) {
        $now = date('Y-m-d');
        /** @var Builder $tc */
        $tc = new Trouble();
        /**
         * @var Trouble $query
         */
        $query = $tc->find($tdc->auto);
        $query->fechacomp = $now;
        $query->it_guy = $capt;
        $query->reparacion = $tdc->reparacion;
        $query->save();
   }

    /**
     * 
     * @return array
     */
    public function listTrouble() {
        /** @var Builder $tc */
        $tc = new Trouble();
        /** @var Trouble $query */
        $query = $tc->orderByDesc('fechahora')->get();
        $result = $query->toArray();
        return $result;
    }

    /**
     * @param TroubleDataClass $tdc
     * @return Trouble
     */
    public function insertTrouble(TroubleDataClass $tdc) {
        $now = date('Y-m-d');
        /**
         * @var Trouble $query
         */
        $query = new Trouble();
        $query->sistema = $tdc->sistema;
        $query->usuario = $tdc->usuario;
        $query->fechahora = $now;
        $query->fuente = $tdc->fuente;
        $query->descripcion = $tdc->descripcion;
        $query->error_msg = $tdc->error_msg;
        $query->save();
        return $query;
    }

}
