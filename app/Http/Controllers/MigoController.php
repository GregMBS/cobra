<?php

namespace App\Http\Controllers;

use App\MigoClass;
use View;

class MigoController extends Controller
{
    /**
     *
     * @var MigoClass
     */
    private $mc;
    
    public function __construct() {
        $this->mc = new MigoClass();
    }
    
    /**
     * 
     * @return View
     */
    public function getList() {
        if (auth()->user()->tipo == 'admin') {
            $result = $this->mc->adminReport();
            $view = view('migo')->with('result', $result);
            return $view;
        }
        return $this->userList();
    }
    
    /**
     *
     * @return View
     */
    private function userList() {
        $result = $this->mc->userReport(auth()->user()->iniciales);
        $view = view('migo')->with('result', $result)->with('capt', auth()->user()->iniciales);
        return $view;
    }
}
