<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

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
            /**
             * @var Queuelist $queuelist
             */
            $queuelist = Queuelist::whereCliente($cliente);
            $queuelist = $queuelist->whereStatusAarsa($queue);
            $queuelist = $queuelist->whereSdc($sdc);
            $queuelist = $queuelist->whereGestor($capt);
            $queuelist = $queuelist->whereBloqueado(0);
            $queuelist = $queuelist->firstOrFail();
            $camp = $queuelist->camp;
            return $camp;
        } catch (\Exception $e) {
            return -1;
        }
    }
    
    /**
     * 
     * @return array
     */
    public function getClients() {
        /**
         * @var Cliente $clientes
         */
        $clientes = Queuelist::distinct()->select(['cliente'])
            ->where('cliente', '<>', '');
        $clientes = $clientes->orderBy('cliente')->get()->pluck('cliente');
        return $clientes->toArray();
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getSdcClients($capt) {
        /**
         * @var Queuelist $results
         */
        $results = Queuelist::distinct()->select(['cliente', 'sdc'])
            ->whereGestor($capt);
        $results = $results->whereBloqueado(0);
        $results = $results->where('cliente', '<>', '');
        $results = $results->orderBy('cliente');
        $results = $results->orderBy('sdc');
        $results = $results->get()->pluck(['cliente', 'sdc']);
        return $results;
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getQueueSdcClients($capt) {
        /**
         * @var Queuelist $results
         */
        $results = Queuelist::distinct()->select(['cliente', 'sdc', 'status_aarsa'])
            ->whereGestor($capt);
        $results = $results->whereBloqueado(0);
        $results = $results->where('cliente', '<>', '');
        $results = $results->orderBy('cliente');
        $results = $results->orderBy('sdc');
        $results = $results->orderBy('status_aarsa');
        $results = $results->get()->pluck(['cliente', 'sdc', 'status_aarsa']);
        return $results;
    }
}
