<?php

namespace App\Http\Controllers;

use App\AccountsClass;
use View;

class AccountsController extends Controller
{
    /**
     *
     * @var AccountsClass
     */
    private $mc;
    
    public function __construct() {
        $this->mc = new AccountsClass();
    }
    
    /**
     * 
     * @return View
     */
    public function getList() {
        if (auth()->user()->tipo == 'admin') {
            $result = $this->mc->adminReport();
            /* @var View $view */
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
        /* @var View $view */
        $view = view('migo')->with('result', $result)->with('capt', auth()->user()->iniciales);
        return $view;
    }
}
