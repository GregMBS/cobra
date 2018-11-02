<?php

namespace App\Http\Controllers;

use App\ActivateClass;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ActivateController extends Controller
{
    /**
     * 
     * @var ActivateClass
     */
    private $ac;
    
    public function __construct() {
        $this->ac = new ActivateClass();
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
    public function activate(Request $r) {
        $data = $r->data;
        $accounts = $this->parseData($data);
        $count = $this->ac->activateAccounts($accounts);
        $msg = $count['active'] . 'cuentas activadas de ' . count($accounts);
        $view = view('activate')->with('msg', $msg);
        return $view;
    }
    
    /**
     *
     * @param Request $r
     * @return View
     */
    public function inactivate(Request $r) {
        $data = $r->data;
        /**
         * @var array
         */
        $accounts = $this->parseData($data);
        $count = $this->ac->inactivateAccounts($accounts);
        $msg = $count['inactive'] . 'cuentas inactivadas de ' . count($accounts);
        $view = view('inactivate')->with('msg', $msg);
        return $view;
    }

    /**
     *
     * @return View
     */
    public function activeShow() {
        $view = view('activate')->with('msg', '');
        return $view;
    }
    
    /**
     *
     * @return View
     */
    public function inactiveShow() {
        $view = view('inactivate')->with('msg', '');
        return $view;
    }
}
