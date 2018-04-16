<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\PagobulkClass;

class PagobulkController extends Controller
{
    /**
     *
     * @var PagobulkClass
     */
    private $bc;
    
        
    public function __construct() {
        $this->bc = new PagobulkClass();
    }

    /**
     * 
     * @param string $message
     * @return View
     */
    public function index($message = '') {
        $view = view('pagobulk')->with('message', $message);
        return $view;
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function confirm(Request $r) {
        $input = $r->data;
        $message = $this->bc->main($input);
        return $this->index($message);
    }
}
