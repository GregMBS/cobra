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
        $this->capt = $this->pdoc->capt;
    }
    
    /**
     * 
     * @return View
     */
    public function adminList() {
        if ($this->pdoc->getUserType($this->capt) == 'admin') {
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
        $result = $this->mc->userReport($this->capt);
        $view = view('migo')->with('result', $result)->with('capt', $this->capt);
        return $view;
    }
}
