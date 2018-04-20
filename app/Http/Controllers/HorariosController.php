<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\HorariosClass;
use App\HorariosAllClass;
use App\HorariosDataClass;

class HorariosController extends Controller
{
    /**
     *
     * @var HorariosClass
     */
    private $hc;
    
    /**
     *
     * @var HorariosAllClass
     */
    private $hac;
    
    private $yr;
    private $mes;
    private $yrmes;
    
    /**
     * 
     * @var int
     */
    private $dhoy;
    
    /**
     * 
     * @var string
     */
    private $hoy;
    
    private $dst = '';
    
    
    public function __construct() {
        $this->hc = new HorariosClass();
        $this->hac = new HorariosAllClass();
        $this->yr              = date('Y');
        $this->mes             = date('m');
        $this->dhoy            = date('d');
        $this->hoy             = date('Y-m-d');
        $this->yrmes           = date('Y-m-');
    }
    
    /**
     * 
     * @return View
     */
    public function index()
    {
        $output = array();
        $gestores = $this->hc->listGestores();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        foreach ($gestores as $gestor) {
            $c_cvge = $gestor['c_cvge'];
            $row = array();
            for ($i = 1; $i <= $this->dhoy; $i++) {
                $data = new HorariosDataClass($i);
                $startStop = $this->hc->getStartStopDiff($c_cvge, $i);
                $data->start = $startStop['start'];
                $data->stop = $startStop['stop'];
                $data->diff = $startStop['diff'];
                $main = $this->hc->getCurrentMain($c_cvge, $i);
                $data->gestiones = $main['gestiones'];
                $data->cuentas = $main['cuentas'];
                $data->contactos = $main['contactos'];
                $data->nocontactos = $main['nocontactos'];
                $data->promesas = $main['promesas'];
                $data->pagos = 0;
                $row[$i] = $data;
            }
            $output[$c_cvge] = $row;
        }
        $view = view('horarios')
        ->with('yrmes', $this->yrmes)
        ->with('gestores', array_column($gestores, 'c_cvge'))
        ->with('dhoy', $this->dhoy)
        ->with('dowArray', $dowArray)
        ->with('data', $output);
        return $view;
    }
}
