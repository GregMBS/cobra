<?php
namespace App\Http\Controllers;

use App\ComparisonClass;
use View;

/**
 *
 * @author gmbs
 *        
 */
class ComparisonController extends Controller
{

    /**
     * 
     * @var ComparisonClass
     */
    private $cc;
    
    /**
     */
    public function __construct()
    {
        $this->cc = new ComparisonClass();
    }
    
    /**
     * 
     * @return View
     */
    public function index() {
        $result = $this->cc->getReport();
        $view = view('comparativo')->with('result', $result);
        return $view;
    }
}

