<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
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
     * @return View
     */
    public function promesas($gestor, $fecha)
    {
        $result = $this->dc->getPromesas($gestor, $fecha);
        $view = view('pdhv')
        ->with('gestor', $gestor)
        ->with('fecha', $fecha)
        ->with('result', $result);
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
        $view = view('pdhv')
        ->with('gestor', $gestor)
        ->with('fecha', $fecha)
        ->with('result', $result);
        return $view;
    }
    
}
