<?php
namespace App\Http\Controllers;

use App\SpeclistDataClass;
use View;
use App\SpeclistqcClass;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $data = new SpeclistDataClass($request->all());
        $result = $this->sc->getSpecListReport($data);
        $view = view('speclistqc')
        ->with('result', $result);
        return $view;
    }
}