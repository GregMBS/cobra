<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\QueuesqcClass;

class QueueReportController extends Controller
{
    /**
     * @var QueuesqcClass 
     */
    private $qc;
    
    public function __construct()
    {
        $this->qc = new QueuesqcClass();
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