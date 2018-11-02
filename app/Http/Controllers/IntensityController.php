<?php

namespace App\Http\Controllers;

use Box\Spout\Writer\Common\Sheet;
use Box\Spout\Writer\XLSX\Writer;
use Illuminate\Http\Request;
use View;
use App\IntensityClass;
use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;

class IntensityController extends Controller
{
    /**
     * 
     * @var IntensityClass
     */
    private $ic;
    
    public function __construct() {
        $this->ic = new IntensityClass();
    }

    /**
     * @param Request $r
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     * @throws \Box\Spout\Writer\Exception\InvalidSheetNameException
     */
    public function makeReport(Request $r) {
        $fechaArray = array($r->fecha1, $r->fecha2);
        sort($fechaArray);
        $fecha1 = $fechaArray[0];
        $fecha2 = $fechaArray[1];
        $filename = "Query_de_intensidad_".$fecha1.'_'.$fecha2.".xlsx";
        $result = $this->ic->getByAccount($fecha1, $fecha2);
        $output   = array();
        $i = 0;
        
        foreach ($result as $row) {
            if ($i==0) {
                $output[] = array_keys($row);
            }
            $output[] = $row;
            $i++;
        }
        /**
         * @var Writer $writer
         */
        $wf = new WriterFactory();
        $writer = $wf->create(Type::XLSX);
        $writer->openToBrowser($filename); // stream data directly to the browser
        /**
         * @var Sheet $sheet
         */
        $sheet = $writer->getCurrentSheet();
        $sheet->setName('PorCuenta');
        $writer->addRows($output); // add multiple rows at a time
        $writer->addNewSheetAndMakeItCurrent();
        $newSheet = $writer->getCurrentSheet();
        $newSheet->setName('PorSegmento');
        
        $results = $this->ic->getBySegment($fecha1, $fecha2);
        
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
