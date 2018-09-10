<?php
namespace App\Http\Controllers;

use View;
use App\SpeclistqcClass;
use Request;

class SpeclistController extends Controller
{
    /**
     * 
     * @var SpeclistqcClass
     */
    private $sc;
    
    public function __construct()
    {
        $this->sc = new SpeclistqcClass();
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function index(Request $r)
    {
        $data = collect($r->all());
        $result = $this->sc->getSpecListReport($data);
        $view = view('speclistqc')
        ->with('result', $result);
        return $view;
    }
}