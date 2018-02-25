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
        $capt = auth()->user()->capt;
        $tipo = auth()->user()->tipo;
        $result = $rc->getRotas($capt, $tipo);
        $view = view('rotas')->with('result', $result)->with('tipo', $tipo);
        return $view;
    }
}