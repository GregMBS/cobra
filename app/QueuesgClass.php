<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of QueuesgClass
 *
 * @author gmbs
 */
class QueuesgClass extends BaseClass {

    /**
     * 
     * @param string $cliente
     * @param string $queue
     * @param string $sdc
     * @param string $capt
     * @return int
     */
    public function getCamp($cliente, $queue, $sdc, $capt) {
        try {
            $qc = new Queuelist();
            /**
             * @var Queuelist $queuelist
             */
            $queuelist = $qc->whereCliente($cliente);
            $queuelist = $queuelist->whereStatusAarsa($queue);
            $queuelist = $queuelist->whereSdc($sdc);
            $queuelist = $queuelist->whereGestor($capt);
            $queuelist = $queuelist->whereBloqueado(0);
            $queuelist = $queuelist->firstOrFail();
            $camp = $queuelist->camp;
            return $camp;
        } catch (Exception $e) {
            return -1;
        }
    }
    
    /**
     * 
     * @return array
     */
    public function getClients() {
        /**
         * @var Queuelist|Builder $qc
         */
        $qc = new Queuelist();
        /**
         * @var Queuelist|Model|Builder $query
         */
        $query = $qc->distinct()->select(['cliente'])
            ->where('cliente', '<>', '');
        $clientes = $query->orderBy('cliente')->get();
        return $clientes->toArray();
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getSdcClients($capt) {
        /** @var Builder $qc */
        $qc = new Queuelist();
        /**
         * @var Queuelist|Builder $results
         */
        $results = $qc->distinct()->select(['cliente', 'sdc']);
        $results = $results->whereGestor($capt);
        $results = $results->whereBloqueado(0);
        $results = $results->where('cliente', '<>', '');
        $results = $results->orderBy('cliente');
        $results = $results->orderBy('sdc');
        $results = $results->get();
        return $results->toArray();
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getQueueSdcClients($capt) {
        /** @var Builder $qc */
        $qc = new Queuelist();
        /**
         * @var Queuelist|Builder $results
         */
        $results = $qc->distinct()->select(['cliente', 'sdc', 'status_aarsa']);
        $results = $results->whereGestor($capt);
        $results = $results->whereBloqueado(0);
        $results = $results->where('cliente', '<>', '');
        $results = $results->orderBy('cliente');
        $results = $results->orderBy('sdc');
        $results = $results->orderBy('status_aarsa');
        $results = $results->get();
        return $results->toArray();
    }
}
