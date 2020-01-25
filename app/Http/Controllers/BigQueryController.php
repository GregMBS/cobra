<?php

namespace App\Http\Controllers;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Exception;
use Illuminate\Http\Request;
use App\BigCallClass;
use App\BigDataClass;
use App\OutputClass;
use View;

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
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws UnsupportedTypeException
     * @throws WriterNotOpenedException
     * @throws Exception
     */
    public function makeReport(Request $r, OutputClass $oc) {
        try {
            $bdc = new BigDataClass($r);
        } catch (Exception $e) {
            throw $e;
        }
        $filename = "Query_de_gestiones.xlsx";
        $data = $this->bc->getAllCalls($bdc);
        if ($data) {
            $headers = array_keys($data[0]);
            $oc->writeXLSXFile($filename, $data, $headers);
        }
    }
    
    /**
     * 
     * @return View|\Illuminate\View\View
     */
    public function index() {
        $gestores = $this->bc->getCallGestores();
        $clientes = $this->bc->getCallClientes();
        return view('bigQuery')
        ->with('gestores', $gestores)
        ->with('clientes', $clientes);
    }
}
