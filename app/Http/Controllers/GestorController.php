<?php

namespace App\Http\Controllers;

use App\GestorClass;
use Illuminate\Support\Facades\View;

class GestorController extends Controller
{
    /**
     * @var GestorClass
     */
    private $gc;

    public function __construct()
    {
        $this->gc = new GestorClass();
    }

    /**
     * @param $gestor
     * @return View
     */
    public function show($gestor)
    {
        $result = $this->gc->getPagosReport($gestor);
        $view = view('gestor')->with('result', $result);
        return $view;
    }
}
