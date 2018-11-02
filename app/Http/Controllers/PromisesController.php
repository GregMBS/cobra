<?php

namespace App\Http\Controllers;

use App\PromisesClass;
use View;

class PromisesController extends Controller
{
    /**
     * 
     * @param PromisesClass $rc
     * @return View
     */
    public function index(PromisesClass $rc) {
        $capt = auth()->user()->iniciales;
        $type = auth()->user()->tipo;
        $result = $rc->getPromises($type, $capt);
        $view = view('rotas')->with('result', $result)->with('tipo', $type);
        return $view;
    }
}