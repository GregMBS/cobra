<?php
namespace App\Http\Controllers;

use App\ComparativoClass;
use View;

/**
 *
 * @author gmbs
 *        
 */
class ComparativoController extends Controller
{

    /**
     * 
     * @var ComparativoClass
     */
    private $cc;
    
    /**
     */
    public function __construct()
    {
        $this->cc = new ComparativoClass();
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

