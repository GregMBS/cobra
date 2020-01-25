<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use View;
use App\BulkPaymentsClass;

class BulkPaymentsController extends Controller
{
    /**
     *
     * @var BulkPaymentsClass
     */
    private $bc;
    
        
    public function __construct() {
        $this->bc = new BulkPaymentsClass();
    }

    /**
     * 
     * @param string $message
     * @return View|\Illuminate\View\View
     */
    public function index($message = '') {
        $view = view('pagobulk')->with('message', $message);
        return $view;
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws Exception
     */
    public function confirm(Request $r) {
        $input = $r->data;
        $message = $this->bc->main($input);
        return $this->index($message);
    }
}
