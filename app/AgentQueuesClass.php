<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of AgentQueuesClass
 *
 * @author gmbs
 */
class AgentQueuesClass extends BaseClass {

    /**
     * 
     * @param string $client
     * @param string $queue
     * @param string $sdc
     * @param string $capt
     * @return int
     */
    public function getCamp($client, $queue, $sdc, $capt) {
        try {
            $qc = new Queuelist();
            /**
             * @var Queuelist $queues
             */
            $queues = $qc->whereCliente($client);
            $queues = $queues->whereStatusAarsa($queue);
            $queues = $queues->whereSdc($sdc);
            $queues = $queues->whereGestor($capt);
            $queues = $queues->whereBloqueado(0);
            $queues = $queues->firstOrFail();
            $camp = $queues->camp;
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
         * @var Queuelist|Builder $qc
         */
        $qc = new Queuelist();
        /**
         * @var Queuelist|Model|Builder $query
         */
        $query = $qc->distinct()->select(['cliente'])
            ->where('cliente', '<>', '');
        $clients = $query->orderBy('cliente')->get();
        return $clients->toArray();
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
