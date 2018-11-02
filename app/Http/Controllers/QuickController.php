<?php
namespace App\Http\Controllers;

use App\QuickNowClass;
use App\QuickBreaksClass;
use App\QuickHoyClass;
use App\QuickPorHoraClass;
use View;

class QuickController extends Controller
{

    /**
     * 
     * @var QuickNowClass
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
    
    public function __construct()
    {
        $this->qa = new QuickNowClass();
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
        $resultNow = $this->qa->getNow();
        $resultHoy = $this->qh->getHoy();
        $resultBreaks = $this->qb->getBreaks();
        $resultPorHora = $this->qp->getPorHora();
        /** @var View $view */
        $view = view('quick')
        ->with('resultAhora', $resultNow)
        ->with('resultHoy', $resultHoy)
        ->with('resultBreaks', $resultBreaks);
        $view = $view->with('resultPorHora', $resultPorHora);
        return $view;
    }
}