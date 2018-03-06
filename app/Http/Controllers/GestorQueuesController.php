<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\QueuesgClass;

class GestorQueuesController extends Controller
{

    /**
     *
     * @var QueuesgClass
     */
    private $qc;

    public function __construct()
    {
        $this->qc = new QueuesgClass();
    }

    /**
     * 
     * @param Request $r
     * @return View
     */
    public function changeQueue(Request $r)
    {
        $msg = "<h2>Se elige queue bloqueado o equivocado.</h2>";
        $capt = auth()->user()->capt;
        $cliente = $r->cliente;
        $sdc = $r->sdc;
        $queue = $r->queue;
        $camp = $this->qc->getCamp($cliente, $queue, $sdc, $capt);
        if ($camp >= 0) {
            $this->qc->setCamp($camp, $capt);
            $msg = "<h2>Se elige queue " . $cliente . " " . $sdc . " " . $queue . "</h2>";
        }
        return $this->index($msg);
    }
    
    /**
     * 
     * @param string $msg
     * @return View
     */
    public function index($msg = '')
    {
        $capt = auth()->user()->capt;
        
        $resultc = $this->qc->getClients();
        $arrayc  = json_encode($resultc);
        
        $results=$this->qc->getSdcClients($capt);
        $arrays  = json_encode($results);
        
        $resultsa=$this->qc->getQueueSdcClients($capt);
        $arrayq = json_encode($resultsa);
        $view = view('queuesg')
        ->with('msg', $msg)
        ->with('capt', $capt)
        ->with('arrayc', $arrayc)
        ->with('arrays', $arrays)
        ->with('arrayq', $arrayq);
        return $view;
    }
}