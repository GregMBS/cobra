<?php

namespace App\Http\Controllers;

use App\BestClass;
use App\OutputClass;

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
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function index() {
        $filename = "Ultimo_y_mejor_".date('ymd').".xlsx";
        $data = $this->bc->getReport();
        $header = array(array_keys($data[0]));
        $this->oc->writeXLSXFile($filename, $data, $header);
    }
}
