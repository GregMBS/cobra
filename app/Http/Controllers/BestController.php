<?php

namespace App\Http\Controllers;

use App\BestClass;
use App\OutputClass;
use Exception;

class BestController extends Controller
{
    /**
     *
     * @var BestClass
     */
    private $bc;

    /**
     *
     * @var OutputClass
     */
    private $oc;

    public function __construct() {
        $this->bc = new BestClass();
        $this->oc = new OutputClass();
    }

    /**
     * @throws Exception
     */
    public function index() {
        $filename = "Ultimo_y_mejor_".date('ymd').".csv";
        $data = $this->bc->getReport();
        $header = array_keys($data[0]);
        $this->oc->writeXLSXFile($filename, $data, $header);
    }
}
