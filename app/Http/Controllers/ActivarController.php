<?php

namespace App\Http\Controllers;

use App\ActivarClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
        $ctas = $this->parseData($data);
        $this->ac->activateCuentas($ctas);
        $count = count($ctas);
        $msg = $count . 'cuentas activadas.';
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
        $ctas = $this->parseData($data);
        $this->ac->inactivateCuentas($ctas);
        $count = count($ctas);
        $msg = $count . 'cuentas inactivadas.';
        $view = view('inactivar')->with('msg', $msg);
        return $view;
    }

    /**
     *
     * @return View
     */
    public function actShow() {
        $view = view('activar')->with('msg', '');
        return $view;
    }
    
    /**
     *
     * @return View
     */
    public function inactShow() {
        $view = view('inactivar')->with('msg', '');
        return $view;
    }
}
