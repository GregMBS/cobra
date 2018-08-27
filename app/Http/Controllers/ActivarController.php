<?php

namespace App\Http\Controllers;

use App\ActivarClass;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ActivarController extends Controller
{
    /**
     * 
     * @var ActivarClass
     */
    private $ac;
    
    public function __construct() {
        $this->ac = new ActivarClass();
    }
    
    /**
     * 
     * @param string $data
     * @return array
     */
    private function parseData($data) {
        $string = preg_replace('/\s/', ',', $data);
        $dat = explode(',', $string);
        return $dat;
    }
    
    /**
     *
     * @param Request $r
     * @return View
     */
    public function activar(Request $r) {
        $data = $r->data;
        $cuentas = $this->parseData($data);
        $count = $this->ac->activateCuentas($cuentas);
        $msg = $count['active'] . 'cuentas activadas de ' . count($cuentas);
        $view = view('activar')->with('msg', $msg);
        return $view;
    }
    
    /**
     *
     * @param Request $r
     * @return View
     */
    public function inactivar(Request $r) {
        $data = $r->data;
        /**
         * @var array
         */
        $cuentas = $this->parseData($data);
        $count = $this->ac->inactivateCuentas($cuentas);
        $msg = $count['inactive'] . 'cuentas inactivadas de ' . count($cuentas);
        $view = view('inactivar')->with('msg', $msg);
        return $view;
    }

    /**
     *
     * @return View
     */
    public function activeShow() {
        $view = view('activar')->with('msg', '');
        return $view;
    }
    
    /**
     *
     * @return View
     */
    public function inactiveShow() {
        $view = view('inactivar')->with('msg', '');
        return $view;
    }
}
