<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BigClass;
use App\BigDataClass;
use App\OutputClass;
use Illuminate\Support\Facades\View;

class BigpromsController extends Controller
{
    /**
     * 
     * @var BigClass
     */
    private $bc;
    
    public function __construct() {
        $this->bc = new BigClass();
    }
    
    /**
     * 
     * @param Request $r
     * @param OutputClass $oc
     */
    public function makeReport(Request $r, OutputClass $oc) {
        $bdc = new BigDataClass($r);
        $filename = "Query_de_promesas.xlsx";
        $data = $this->bc->getProms($bdc);
        if ($data) {
            $headers = array_keys($data[0]);
            $oc->writeXLSXFile($filename, $data, $headers);
        }
    }
    
    /**
     * 
     * @return View
     */
    public function index() {
        $gestores = $this->bc->getGestionGestores();
        $clientes = $this->bc->getGestionClientes();
        return view('bigproms')
        ->with('gestores', $gestores)
        ->with('clientes', $clientes);
    }
}
