<?php
namespace App\Http\Controllers;

use App\QuickAhoraClass;
use App\QuickBreaksClass;
use App\QuickHoyClass;
use App\QuickPorHoraClass;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class QuickController extends Controller
{

    /**
     * 
     * @var QuickAhoraClass
     */
    private $qa;
    
    /**
     * 
     * @var QuickHoyClass
     */
    private $qh;
    
    /**
     * 
     * @var QuickBreaksClass
     */
    private $qb;
    
    /**
     * 
     * @var QuickPorHoraClass
     */
    private $qp;
    
    /**
     * 
     * @param Request $r
     */
    public function __construct(Request $r)
    {
        $this->qa = new QuickAhoraClass();
        $this->qh = new QuickHoyClass();
        $this->qb = new QuickBreaksClass();
        $this->qp = new QuickPorHoraClass();
    }

    /**
     * 
     * @return View
     */
    public function index()
    {
        $resultAhora = $this->qa->getAhora();
        $resultHoy = $this->qh->getHoy();
        $resultBreaks = $this->qb->getBreaks();
        $resultPorHora = $this->qp->getPorHora();
        $view = view('quick')
        ->with('resultAhora', $resultAhora)
        ->with('resultHoy', $resultHoy)
        ->with('resultBreaks', $resultBreaks)
        ->with('resultPorHora', $resultPorHora);
        return $view;
    }
}