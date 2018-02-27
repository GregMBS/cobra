<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\QueuesClass;

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
        $view = view('queues')
        ->with('gestores', $gestores)
        ->with('queues', $queues)
        ->with('myQueue', $myQueue)
        ->with('myQueueList', $myQueueList);
        return $view;
    }
}