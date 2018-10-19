<?php

namespace App\Http\Controllers;

use App\GestorDataClass;
use Illuminate\Http\Request;
use App\GestoradminClass;
use View;

class GestoradminController extends Controller
{
    /**
     * 
     * @var GestoradminClass
     */
    protected $gc;
    
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
        $data = new GestorDataClass();
        $data->setCompleto($r->completo);
        $data->setTipo($r->tipo);
        $data->setIniciales($r->iniciales);
        $data->setPass($r->passw);
        $this->gc->changeUserData($data);
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
        $data = new GestorDataClass();
        $data->setCompleto($r->completo);
        $data->setTipo($r->tipo);
        $data->setIniciales($r->iniciales);
        $data->setPass($r->passw);
        $this->gc->addUser($data);
        return $this->index();
    }
}
