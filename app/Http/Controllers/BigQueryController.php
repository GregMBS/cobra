<?php

namespace App\Http\Controllers;

use App\BigCallClass;
use App\BigDataClass;
use App\OutputClass;
use View;
use Illuminate\Http\Request;

class BigQueryController extends Controller
{
    /**
     * 
     * @var BigCallClass
     */
    private $bc;
    
    public function __construct() {
        $this->bc = new BigCallClass();
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
        $filename = "Query_de_gestiones.xlsx";
        $data = $this->bc->getAllCalls($bdc);
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
        $agents = $this->bc->getCallAgents();
        $clients = $this->bc->getCallClients();
        return view('bigQuery')
        ->with('gestores', $agents)
        ->with('clientes', $clients);
    }
}
