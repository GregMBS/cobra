<?php
namespace App\Http\Controllers;

use View;
use App\QueuesReportClass;

class QueueReportController extends Controller
{
    /**
     * @var QueuesReportClass
     */
    private $qc;
    
    public function __construct()
    {
        $this->qc = new QueuesReportClass();
    }

    /**
     * 
     * @return View
     */
    public function index()
    {
        $normal = $this->qc->normalQueues();
        $special = $this->qc->specialQueues();
        $capt = auth()->user()->iniciales;
        $view = view('queuesqc')
        ->with('capt', $capt)
        ->with('normal', $normal)
        ->with('special', $special);
        return $view;
    }
}