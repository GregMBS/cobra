<?php
namespace App\Http\Controllers;

use App\PdoClass;
use App\QuickAhoraClass;
use App\QuickBreaksClass;
use App\QuickHoyClass;
use App\QuickPorHoraClass;
use Illuminate\Support\Facades\View;

class QuickController extends Controller
{

    /**
     *
     * @var PdoClass
     */
    private $pdoc;

    /**
     *
     * @var \PDO
     */
    private $pdo;
    
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
    
    public function __construct()
    {
        $this->pdoc = new PdoClass();
        $this->pdo = $this->pdoc->dbConnectAdmin();
        $this->qa = new QuickAhoraClass($this->pdo);
        $this->qh = new QuickHoyClass($this->pdo);
        $this->qb = new QuickBreaksClass($this->pdo);
        $this->qp = new QuickPorHoraClass($this->pdo);
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