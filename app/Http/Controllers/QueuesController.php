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
        $gestores = $this->qc->getGestores();
        $queues = $this->qc->getQueues();
        $myQueue = [];
        $myQueueList = [];
        foreach ($gestores as $gestor) {
            $myQueue[$gestor] = $this->qc->getMyQueue($gestor);
            $myQueueList[$gestor] = $this->qc->getMyQueuelist($gestor);
        }
        $view = view('queues')->with('gestores', $gestores)
            ->with('queues', $queues)
            ->with('myQueue', $myQueue)
            ->with('myQueueList', $myQueueList);
        return $view;
    }

    /**
     * 
     * @param string $gestor
     * @param Request $r
     * @return View
     */
    public function change($gestor, Request $r)
    {
        if ($gestor == 'todos') {
            list ($cliente, $sdc, $status) = explode(',', $r->queue);
            switch ($r->go) {
                
                case 'INTRO TODOS':
                    $this->qc->updateQueueAll($cliente, $sdc, $status);
                    break;
                
                case 'BLOQUEAR TODOS':
                    $this->qc->blockQueueAll($cliente, $sdc, $status);
                    break;
                
                case 'DESBLOQUEAR TODOS':
                    $this->qc->unblockQueueAll($cliente, $sdc, $status);
                    break;
            }
        }
        if ($gestor != 'todos') {
            
            switch ($r->go) {
                
                case 'INTRO':
                    $this->qc->updateQueue($r->camp, $gestor);
                    break;
                
                case 'BLOQUEAR':
                    $this->qc->blockQueue($r->camp, $gestor);
                    break;
                
                case 'DESBLOQUEAR':
                    $this->qc->unblockQueue($r->camp, $gestor);
                    break;
            }
        }
        $view = $this->index();
        return $view;
    }
}