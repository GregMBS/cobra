<?php

namespace App\Http\Controllers;

use App\MigoClass;
use Illuminate\Support\Facades\View;

class MigoController extends Controller
{
    /**
     *
     * @var MigoClass
     */
    private $mc;
    
    /**
     * @var string
     */
    private $capt;
    
    public function __construct() {
        $this->mc = new MigoClass();
    }
    
    /**
     * 
     * @return View
     */
    public function adminList() {
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
    public function userList() {
        $result = $this->mc->userReport(auth()->user()->capt);
        $view = view('migo')->with('result', $result)->with('capt', auth()->user()->capt);
        return $view;
    }
}
