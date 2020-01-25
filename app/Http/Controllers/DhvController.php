<?php

namespace App\Http\Controllers;

use View;
use App\DhvClass;

class DhvController extends Controller
{
    /**
     * 
     * @var DhvClass
     */
    private $dc;
    
    public function __construct() {
        $this->dc = new DhvClass();
    }
    
    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return View|\Illuminate\View\View
     */
    public function promesas($gestor, $fecha)
    {
        $result = $this->dc->getPromesas($gestor, $fecha);
        $view = view('pdhv')
        ->with('gestor', $gestor)
        ->with('fecha', $fecha)
        ->with('results', $result);
        return $view;
    }
    
    /**
     *
     * @param string $gestor
     * @param string $fecha
     * @return View|\Illuminate\View\View
     */
    public function gestiones($gestor, $fecha)
    {
        $result = $this->dc->getGestiones($gestor, $fecha);
        $view = view('ddhv')
        ->with('gestor', $gestor)
        ->with('fecha', $fecha)
        ->with('results', $result);
        return $view;
    }
    
}
