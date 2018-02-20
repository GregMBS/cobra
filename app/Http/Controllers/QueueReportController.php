<?php
namespace App\Http\Controllers;

use App\PdoClass;
use Illuminate\Support\Facades\View;
use App\QueuesqcClass;

class QueueReportController extends Controller
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
    
    
    public function __construct()
    {
        $this->pdoc = new PdoClass();
        $this->pdo = $this->pdoc->dbConnectAdmin();
        $this->qc = new QueuesqcClass($this->pdo);
    }

    /**
     * 
     * @return View
     */
    public function index()
    {
        $normal = $this->qc->normalQueues();
        $special = $this->qc->specialQueues();
        $capt = $this->pdoc->capt;
        $view = view('queuesqc')
        ->with('capt', $capt)
        ->with('normal', $normal)
        ->with('special', $special);
        return $view;
    }
}