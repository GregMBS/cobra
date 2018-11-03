<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\InventoryClass;
use App\OutputClass;

class InventoryController extends Controller
{
    /**
     * 
     * @var InventoryClass
     */
    private $ic;
    
    public function __construct() {
        $this->ic = new InventoryClass();
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
        $client    = $r->cliente;
        $result = $this->ic->getFullInventoryReport($client);
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
        $client    = $r->cliente;
        $result = $this->ic->getInventoryReport($client);
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
        $clients = $this->ic->listClients();
        return view('inventario')->with('here', $here)->with('clientes', $clients);
    }
    
    /**
     *
     * @return View
     */
    public function indexRapid() {
        $here = '/inventarioRapid';
        $clients = $this->ic->listClients();
        return view('inventario')->with('here', $here)->with('clientes', $clients);
    }
}
