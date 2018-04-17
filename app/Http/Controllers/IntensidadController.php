<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\IntensidadClass;
use App\OutputClass;
use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;

class IntensidadController extends Controller
{
    /**
     * 
     * @var IntensidadClass
     */
    private $ic;
    
    public function __construct() {
        $this->ic = new IntensidadClass();
    }
    
    /**
     * 
     * @param Request $r
     * @param OutputClass $oc
     * @return View
     */
    public function makeReport(Request $r, OutputClass $oc) {
        $fechaArray = array($r->fecha1, $r->fecha2);
        sort($fechaArray);
        $fecha1 = $fechaArray[0];
        $fecha2 = $fechaArray[1];
        $filename = "Query_de_intensidad_".$fecha1.'_'.$fecha2.".xlsx";
        $result = $this->ic->getByCuenta($fecha1, $fecha2);
        $output   = array();
        $i = 0;
        
        foreach ($result as $row) {
            if ($i==0) {
                $output[] = array_keys($row);
            }
            $output[] = $row;
            $i++;
        }
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser($filename); // stream data directly to the browser
        $sheet = $writer->getCurrentSheet();
        $sheet->setName('PorCuenta');
        $writer->addRows($output); // add multiple rows at a time
        $writer->addNewSheetAndMakeItCurrent();
        $newsheet = $writer->getCurrentSheet();
        $newsheet->setName('PorSegmento');
        
        $results = $this->ic->getBySegmento($fecha1, $fecha2);
        
        $outputs   = array();
        $j = 0;
        
        foreach ($results as $rows) {
            if ($j==0) {
                $outputs[] = array_keys($rows);
            }
            $outputs[] = $rows;
            $j++;
        }
        $writer->addRows($outputs);
        $writer->close();
    }
    
    /**
     * 
     * @return View
     */
    public function index() {
        return view('intensidad');
    }
}