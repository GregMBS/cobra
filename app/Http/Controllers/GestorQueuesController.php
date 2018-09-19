<?php
namespace App\Http\Controllers;

use App\UserClass;
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

    /**
     *
     * @var UserClass
     */
    private $uc;

    public function __construct()
    {
        $this->qc = new QueuesgClass();
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
        $cliente = $r->cliente;
        $sdc = $r->sdc;
        $queue = $r->queue;
        $camp = $this->qc->getCamp($cliente, $queue, $sdc, $capt);
        if ($camp >= 0) {
            $this->uc->setCamp($camp, $capt);
            $msg = "Se elige queue " . $cliente . " " . $sdc . " " . $queue;
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
        $arrayc = json_encode($resultClients);

        $resultSdc = $this->qc->getSdcClients($capt);
        $arrays = json_encode($resultSdc);

        $resultQueue = $this->qc->getQueueSdcClients($capt);
        $arrayq = json_encode($resultQueue);

        $view = view('queuesg')->with('msg', $msg);
        $view = $view->with('capt', $capt);
        $view = $view->with('arrayc', $arrayc);
        $view = $view->with('arrays', $arrays);
        $view = $view->with('arrayq', $arrayq);
        return $view;
    }
}