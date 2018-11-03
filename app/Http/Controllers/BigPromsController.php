<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BigPromClass;
use App\BigDataClass;
use App\OutputClass;
use View;

class BigPromsController extends Controller
{
    /**
     * 
     * @var BigPromClass
     */
    private $bc;
    
    public function __construct() {
        $this->bc = new BigPromClass();
    }

    /**
     * @param Request $r
     * @param OutputClass $oc
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
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
        $agents = $this->bc->getPromiseAgents();
        $clients = $this->bc->getPromiseClients();
        return view('bigProms')
        ->with('gestores', $agents)
        ->with('clientes', $clients);
    }
}
