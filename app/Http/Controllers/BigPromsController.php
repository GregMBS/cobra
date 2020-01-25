<?php

namespace App\Http\Controllers;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Exception;
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
        $filename = "Query_de_promesas.xlsx";
        $data = $this->bc->getProms($bdc);
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
        $gestores = $this->bc->getPromGestores();
        $clientes = $this->bc->getPromClientes();
        return view('bigProms')
        ->with('gestores', $gestores)
        ->with('clientes', $clientes);
    }
}
