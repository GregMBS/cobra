<?php

namespace App\Http\Controllers;

use App\BestClass;
use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;

class BestController extends Controller
{
    /**
     *
     * @var BestClass
     */
    private $bc;
    
    /**
     *
     * @var string
     */
    private $filename;
    
    public function __construct() {
        $this->bc = new BestClass();
    }
    
    /**
     * 
     * @param array $output
     */
    private function writeXLSX(array $output) {
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser($this->filename); // stream data directly to the browser
        $writer->addRows($output); // add multiple rows at a time
        $writer->close();
    }
    
    public function index() {
        $data = [];
        $this->filename = "Ultimo_y_mejor_".date('ymd').".xlsx";
        $resumen = $this->bc->getResumenData();
        foreach ($resumen as $row) {
            $id_cuenta = $row['id_cuenta'];
            $ultimo = $this->bc->getLastHistoriaData($id_cuenta);
            if (empty($ultimo)) {
                $ultimo['ultimo_status']       = '';
                $ultimo['ultimo_tel']          = '';
                $ultimo['ultimo_comentario']   = '';                
            }
            $mejor = $this->bc->getBestHistoriaData($id_cuenta);
            if (empty($mejor)) {
                $mejor['mejor_status']        = '';
                $mejor['mejor_tel']           = '';
            }
            $data[] = array_merge($row, $ultimo, $mejor);
        }
        $header = array_keys($data[0]);
        $output = array_merge($header, $data);
        $this->writeXLSX($output);
    }
}
