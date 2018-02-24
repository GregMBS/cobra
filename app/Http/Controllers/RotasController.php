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
        $result = $rc->getRotas();
        $view = view('rotas')->with('result', $result);
        return $view;
    }
}