<?php
namespace App\Http\Controllers;

use App\StatusListDataClass;
use View;
use App\StatusListClass;
use Illuminate\Http\Request;

class StatusListController extends Controller
{
    /**
     * 
     * @var StatusListClass
     */
    private $sc;
    
    public function __construct()
    {
        $this->sc = new StatusListClass();
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $data = new StatusListDataClass($request->all());
        $result = $this->sc->getReport($data);
        $view = view('speclistqc')
        ->with('result', $result);
        return $view;
    }
}