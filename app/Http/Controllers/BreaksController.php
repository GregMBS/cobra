<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\BreaksClass;

class BreaksController extends Controller
{
    /**
     *
     * @var BreaksClass
     */
    private $bc;
    
    public function __construct() {
        $this->bc = new BreaksClass();
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
}
