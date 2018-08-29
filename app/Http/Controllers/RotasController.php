<?php

namespace App\Http\Controllers;

use App\RotasClass;
use Illuminate\Support\Facades\View;

class RotasController extends Controller
{
    /**
     * 
     * @param RotasClass $rc
     * @return View
     */
    public function index(RotasClass $rc) {
        $capt = auth()->user()->iniciales;
        $tipo = auth()->user()->tipo;
        $result = $rc->getRotas($tipo, $capt);
        $view = view('rotas')->with('result', $result)->with('tipo', $tipo);
        return $view;
    }
}