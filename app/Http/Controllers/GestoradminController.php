<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestoradminClass;
use Illuminate\Support\Facades\View;

class GestoradminController extends Controller
{
    /**
     * 
     * @var GestoradminClass
     */
    private $gc;
    
    public function __construct() {
        $this->gc = new GestoradminClass();
    }
    
    /**
     * 
     * @return View
     */
    public function index()
    {
        $result = $this->gc->getNombres();
        $groups = $this->gc->getGroups();
        $view = view('gestoradmin')
        ->with('result', $result)
        ->with('groups', $groups);
        return $view;
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function cambiar(Request $r) {
        $this->gc->changeUserData($r->completo, $r->tipo, $r->iniciales, $r->passwd);
        return $this->index();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function borrar(Request $r) {
        $this->gc->removeUser($r->iniciales);
        return $this->index();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function agregar(Request $r) {
        $this->gc->addUser($r->completo, $r->tipo, $r->iniciales, $r->passw);
        return $this->index();
    }
}
