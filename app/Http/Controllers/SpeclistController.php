<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\SpeclistqcClass;
use Illuminate\Http\Request;

class SpeclistController extends Controller
{
    /**
     * 
     * @var SpeclistqcClass
     */
    private $sc;
    
    public function __construct()
    {
        $this->sc = new SpeclistqcClass();
    }

    /**
     * 
     * @return View
     */
    public function index(Request $r)
    {
        $cliente = $r->cliente;
        $queue	 = $r->queue;
        $sdc	 = $r->status_de_credito;
        $rato	 = $r->rato;
        $result = $this->sc->getReport($rato, $cliente, $sdc, $queue);
        $view = view('speclistqc')
        ->with('result', $result);
        return $view;
    }
}