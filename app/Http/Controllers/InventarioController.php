<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\InventarioClass;
use App\OutputClass;

class InventarioController extends Controller
{
    /**
     * 
     * @var InventarioClass
     */
    private $ic;
    
    public function __construct() {
        $this->ic = new InventarioClass();
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
        $cliente    = $r->cliente;
        $result = $this->ic->getFullInventarioReport($cliente);
        $filename = "Query_de_inventario_".date('ymd').".xlsx";
        $headers  = array_keys($result[0]);
        $oc->writeXLSXFile($filename, $result, $headers);
    }

    /**
     * @param Request $r
     * @param OutputClass $oc
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function makeRapidReport(Request $r, OutputClass $oc) {
        $cliente    = $r->cliente;
        $result = $this->ic->getInventarioReport($cliente);
        $filename = "Query_de_inventario_".date('ymd').".xlsx";
        $headers  = array_keys($result[0]);
        $oc->writeXLSXFile($filename, $result, $headers);
    }
    
/**
     *
     * @return View
     */
    public function index() {
        $here = '/inventario';
        $clientes = $this->ic->listClients();
        return view('inventario')->with('here', $here)->with('clientes', $clientes);
    }
    
    /**
     *
     * @return View
     */
    public function indexRapid() {
        $here = '/inventarioRapid';
        $clientes = $this->ic->listClients();
        return view('inventario')->with('here', $here)->with('clientes', $clientes);
    }
}
