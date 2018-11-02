<?php
namespace App\Http\Controllers;

use App\DebtorClass;
use View;

class VisitController extends Controller
{

    /**
     *
     * @var DebtorClass
     */
    private $rc;
    
    public function __construct()
    {
        $this->rc = new DebtorClass();
    }

    /**
     * 
     * @param int $id
     * @return View
     */
    public function index($id)
    {
        $history = $this->rc->listVisits($id);
        $view = view('visits')->with('historia', $history);
        return $view;
    }

}