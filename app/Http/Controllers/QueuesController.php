<?php
namespace App\Http\Controllers;

use View;
use App\QueuesClass;
use Illuminate\Http\Request;

class QueuesController extends Controller
{

    /**
     *
     * @var QueuesClass
     */
    private $qc;

    public function __construct()
    {
        $this->qc = new QueuesClass();
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $agents = $this->qc->getGestores();
        $queues = $this->qc->getQueues();
        $myQueue = [];
        $myQueueList = [];
        foreach ($agents as $agent) {
            $myQueue[$agent] = $this->qc->getMyQueue($agent);
            $myQueueList[$agent] = $this->qc->getMyQueuelist($agent);
        }
        $view = view('queues')->with('gestores', $agents)
            ->with('queues', $queues)
            ->with('myQueue', $myQueue)
            ->with('myQueueList', $myQueueList);
        return $view;
    }

    /**
     * 
     * @param string $agent
     * @param Request $r
     * @return View
     */
    public function change($agent, Request $r)
    {
        if ($agent == 'todos') {
            list ($client, $sdc, $status) = explode(',', $r->queue);
            switch ($r->go) {
                
                case 'INTRO TODOS':
                    $this->qc->updateQueueAll($client, $sdc, $status);
                    break;
                
                case 'BLOQUEAR TODOS':
                    $this->qc->blockQueueAll($client, $sdc, $status);
                    break;
                
                case 'DESBLOQUEAR TODOS':
                    $this->qc->unblockQueueAll($client, $sdc, $status);
                    break;
            }
        }
        if ($agent != 'todos') {
            
            switch ($r->go) {
                
                case 'INTRO':
                    $this->qc->updateQueue($r->camp, $agent);
                    break;
                
                case 'BLOQUEAR':
                    $this->qc->blockQueue($r->camp, $agent);
                    break;
                
                case 'DESBLOQUEAR':
                    $this->qc->unblockQueue($r->camp, $agent);
                    break;
            }
        }
        $view = $this->index();
        return $view;
    }
}