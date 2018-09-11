<?php

namespace App\Http\Controllers;

use App\PerfmesAllClass;
use App\PerfmesClass;
use View;
use App\HorariosDataClass;

class PerfmesController extends Controller
{
    /**
     *
     * @var PerfmesClass
     */
    private $hc;

    /**
     *
     * @var PerfmesAllClass
     */
    private $hac;

    private $yr;
    private $mes;
    private $yrmes;

    /**
     *
     * @var int
     */
    private $diaHoy;

    /**
     *
     * @var string
     */
    private $hoy;

    /**
     * PerfmesController constructor.
     */
    public function __construct()
    {
        $this->hc = new PerfmesClass();
        $this->hac = new PerfmesAllClass();
        $this->yr = date('Y',strtotime("last day of previous month"));
        $this->mes = date('m',strtotime("last day of previous month"));
        $this->diaHoy = date('d',strtotime("last day of previous month"));
        $this->hoy = date('Y-m-d',strtotime("last day of previous month"));
        $this->yrmes = date('Y-m-',strtotime("last day of previous month"));
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $output = $this->hc->getReport();
        $diaHoy = $this->hc->diaHoy;
        $yr = $this->hc->yr;
        $mes = $this->hc->mes;
        $summary = $this->hac->getReport($diaHoy);
        $gestores = $this->hc->listGestores();
        $dowArray = $this->hc->dowArray($yr, $mes, $diaHoy);
        $c_cvge = array_column($gestores, 'c_cvge');
        $view = view('perfmes')
            ->with('yrmes', $this->yrmes)
            ->with('gestores', $c_cvge)
            ->with('dhoy', $this->diaHoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output)
            ->with('summary', $summary);
        return $view;
    }

    /**
     *
     * @return View
     */
    public function indexV()
    {
        $output = array();
        $visitadores = $this->hc->listVisitadores();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->diaHoy);
        foreach ($visitadores as $visitador) {
            $c_visit = $visitador['iniciales'];
            $row = $this->packVisit($c_visit);
            $output[$c_visit] = $row;
        }
        $c_visit = array_column($visitadores, 'iniciales');
        $view = view('perfmesV')
            ->with('yrmes', $this->yrmes)
            ->with('visitadores', $c_visit)
            ->with('dhoy', $this->diaHoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }

    /**
     * @param $c_visit
     * @return array
     */
    private function packVisit($c_visit): array
    {
        $row = array();
        for ($i = 1; $i <= $this->diaHoy; $i++) {
            $data = new HorariosDataClass($i);
            $main = $this->hc->getVisitadorMain($c_visit, $i);
            $data->gestiones = $main['gestiones'];
            $data->cuentas = $main['cuentas'];
            $data->contactos = $main['contactos'];
            $data->nocontactos = $main['nocontactos'];
            $data->promesas = $main['promesas'];
            $data->pagos = 0;
            $row[$i] = $data;
        }
        return $row;
    }
}
