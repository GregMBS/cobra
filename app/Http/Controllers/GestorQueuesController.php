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

        $resultc = $this->qc->getClients();
        $arrayc = json_encode($resultc);

        $results = $this->qc->getSdcClients($capt);
        $arrays = json_encode($results);

        $resultsa = $this->qc->getQueueSdcClients($capt);
        $arrayq = json_encode($resultsa);

        $view = view('queuesg')->with('msg', $msg)
            ->with('capt', $capt)
            ->with('arrayc', $arrayc)
            ->with('arrays', $arrays)
            ->with('arrayq', $arrayq);
        return $view;
    }
}