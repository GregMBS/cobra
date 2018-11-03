<?php
namespace App\Http\Controllers;

use App\UserClass;
use View;
use Illuminate\Http\Request;
use App\AgentQueuesClass;

class AgentQueuesController extends Controller
{

    /**
     *
     * @var AgentQueuesClass
     */
    private $qc;

    /**
     *
     * @var UserClass
     */
    private $uc;

    public function __construct()
    {
        $this->qc = new AgentQueuesClass();
        $this->uc = new UserClass();
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function changeQueue(Request $r)
    {
        $msg = "Se elige queue bloqueado o equivocado.";
        $capt = auth()->user()->iniciales;
        $client = $r->cliente;
        $sdc = $r->sdc;
        $queue = $r->queue;
        $campaign = $this->qc->getCamp($client, $queue, $sdc, $capt);
        if ($campaign >= 0) {
            $this->uc->setCamp($campaign, $capt);
            $msg = "Se elige queue " . $client . " " . $sdc . " " . $queue;
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
        $capt = auth()->user()->iniciales;

        $resultClients = $this->qc->getClients();
        $arrayClients = json_encode($resultClients);

        $resultSdc = $this->qc->getSdcClients($capt);
        $arrayStatus = json_encode($resultSdc);

        $resultQueue = $this->qc->getQueueSdcClients($capt);
        $arrayQueue = json_encode($resultQueue);

        /** @var View $view */
        $view = view('queuesg')->with('msg', $msg);
        $view = $view->with('capt', $capt);
        $view = $view->with('arrayc', $arrayClients);
        $view = $view->with('arrays', $arrayStatus);
        $view = $view->with('arrayq', $arrayQueue);
        return $view;
    }
}