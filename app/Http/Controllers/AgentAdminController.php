<?php

namespace App\Http\Controllers;

use App\AgentDataClass;
use Illuminate\Http\Request;
use App\AgentAdminClass;
use View;

class AgentAdminController extends Controller
{
    /**
     * 
     * @var AgentAdminClass
     */
    protected $gc;
    
    public function __construct() {
        $this->gc = new AgentAdminClass();
    }
    
    /**
     * 
     * @return View|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->gc->getNames();
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
    public function change(Request $r) {
        $data = new AgentDataClass();
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
    public function erase(Request $r) {
        $this->gc->removeUser($r->iniciales);
        return $this->index();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function add(Request $r) {
        $data = new AgentDataClass();
        $data->setCompleto($r->completo);
        $data->setTipo($r->tipo);
        $data->setIniciales($r->iniciales);
        $data->setPass($r->passw);
        $this->gc->addUser($data);
        return $this->index();
    }
}
