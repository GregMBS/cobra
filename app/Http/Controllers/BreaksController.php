<?php

namespace App\Http\Controllers;

use App\BreaksDataClass;
use App\UserClass;
use View;
use App\BreaksClass;
use Request;

class BreaksController extends Controller
{
    /**
     *
     * @var BreaksClass
     */
    private $bc;

    /**
     *
     * @var UserClass
     */
    private $uc;

    public function __construct() {
        $this->bc = new BreaksClass();
        $this->uc = new UserClass();
    }
    
    /**
     *
     * @param string $capt
     * @return View
     */
    public function index($capt) {
        $result = $this->bc->breaksPageData($capt);
        $view = view('breaks')->with('result', $result);
        return $view;
    }
    
    /**
     *
     * @return View
     */
    public function admindex() {
        $breaks = $this->bc->listBreaks();
        $gestores = $this->uc->listUsers();
        $view = view('breakAdmin')
        ->with('breaks', $breaks)
        ->with('gestores', $gestores);
        return $view;
    }

    /**
     * @param int $auto
     * @return View
     * @throws \Exception
     */
    public function borrar($auto) {
        $this->bc->deleteBreak($auto);
        return $this->admindex();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function cambiar(Request $r) {
        $r->validate([
            'auto' => 'required|exists:breaks|integer',
            'tipo' => 'required',
            'empieza' => 'required',
            'termina' => 'required'
        ]);
        $break = new BreaksDataClass();
        $break->setAuto($r->auto);
        $break->setTipo($r->tipo);
        $break->setEmpieza($r->empieza);
        $break->setTermina($r->termina);
        $this->bc->updateBreak($break);
        return $this->admindex();        
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function agregar(Request $r) {
        $r->validate([
            'gestor' => 'required',
            'tipo' => 'required',
            'empieza' => 'required',
            'termina' => 'required'
        ]);
        $break = new BreaksDataClass();
        $break->setGestor($r->gestor);
        $break->setTipo($r->tipo);
        $break->setEmpieza($r->empieza);
        $break->setTermina($r->termina);
        $this->bc->insertBreak($break);
        return $this->admindex();
    }
}
