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
     * @param int $id_cuenta
     * @return View
     */
    public function index($id_cuenta)
    {
        $historia = $this->rc->listVisits($id_cuenta);
        $view = view('visits')->with('historia', $historia);
        return $view;
    }

}