<?php

namespace App\Http\Controllers;

use View;
use App\DhClass;

class DhController extends Controller
{
    /**
     * 
     * @var DhClass
     */
    private $dc;
    
    public function __construct() {
        $this->dc = new DhClass();
    }
    
    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return View
     */
    public function promesas($gestor, $fecha)
    {
        $result = $this->dc->getPromesas($gestor, $fecha);
        $view = view('pdh')
        ->with('gestor', $gestor)
        ->with('fecha', $fecha)
        ->with('results', $result);
        return $view;
    }
    
    /**
     *
     * @param string $gestor
     * @param string $fecha
     * @return View
     */
    public function gestiones($gestor, $fecha)
    {
        $result = $this->dc->getGestiones($gestor, $fecha);
        $view = view('ddh')
        ->with('gestor', $gestor)
        ->with('fecha', $fecha)
        ->with('results', $result);
        return $view;
    }
    
}
