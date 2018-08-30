<?php

namespace App\Http\Controllers;

use App\UserClass;
use Illuminate\Support\Facades\View;
use App\BreaksClass;
use Illuminate\Http\Request;

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
        $view = view('breakadmin')
        ->with('breaks', $breaks)
        ->with('gestores', $gestores);
        return $view;
    }
    
    /**
     * 
     * @param int $auto
     * @return View
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
        $this->bc->updateBreak($r->auto, $r->tipo, $r->empieza, $r->termina);
        return $this->admindex();        
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function agregar(Request $r) {
        $this->bc->insertBreak($r->gestor, $r->tipo, $r->empieza, $r->termina);
        return $this->admindex();
    }
}
