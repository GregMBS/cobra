<?php

namespace App\Http\Controllers;

use App\PerfmesAllClass;
use App\PerfmesClass;
use Illuminate\Support\Facades\View;
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
    private $dhoy;

    /**
     *
     * @var string
     */
    private $hoy;

    public function __construct()
    {
        $this->hc = new PerfmesClass();
        $this->hac = new PerfmesAllClass();
        $this->yr = date('Y',strtotime("last day of previous month"));
        $this->mes = date('m',strtotime("last day of previous month"));
        $this->dhoy = date('d',strtotime("last day of previous month"));
        $this->hoy = date('Y-m-d',strtotime("last day of previous month"));
        $this->yrmes = date('Y-m-',strtotime("last day of previous month"));
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $output = array();
        $summary = array();
        $gestores = $this->hc->listGestores();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        foreach ($gestores as $gestor) {
            $c_cvge = $gestor['c_cvge'];
            $row = array();
            for ($i = 1; $i <= $this->dhoy; $i++) {
                $data = new HorariosDataClass($i);
                $startStop = $this->hc->getStartStopDiff($c_cvge, $i);
                $data->start = $startStop['start'];
                $data->stop = $startStop['stop'];
                $data->diff = $startStop['diff'];
                $main = $this->hc->getCurrentMain($c_cvge, $i);
                if ($main) {
                    $data->gestiones = $main['gestiones'];
                    $data->cuentas = $main['cuentas'];
                    $data->contactos = $main['contactos'];
                    $data->nocontactos = $main['nocontactos'];
                    $data->promesas = $main['promesas'];
                    $data->pagos = 0;
                }
                $row[$i] = $data;
            }
            $output[$c_cvge] = $row;
        }
        for ($i = 1; $i <= $this->dhoy; $i++) {
            $dataSum = new HorariosDataClass($i);
            $mainSum = $this->hac->getCurrentMain($i);
            if ($mainSum) {
                $dataSum->gestiones = $mainSum['gestiones'];
                $dataSum->cuentas = $mainSum['cuentas'];
                $dataSum->contactos = $mainSum['contactos'];
                $dataSum->nocontactos = $mainSum['nocontactos'];
                $dataSum->promesas = $mainSum['promesas'];
                $dataSum->pagos = $this->hac->getPagos($i);
            }
            $summary[$i] = $dataSum;
        }
        $c_cvge = array_column($gestores, 'c_cvge');
        $view = view('perfmes')
            ->with('yrmes', $this->yrmes)
            ->with('gestores', $c_cvge)
            ->with('dhoy', $this->dhoy)
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
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        foreach ($visitadores as $visitador) {
            $c_visit = $visitador['iniciales'];
            $row = $this->packVisit($c_visit);
            $output[$c_visit] = $row;
        }
        $c_visit = array_column($visitadores, 'iniciales');
        $view = view('perfmesV')
            ->with('yrmes', $this->yrmes)
            ->with('visitadores', $c_visit)
            ->with('dhoy', $this->dhoy)
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
        for ($i = 1; $i <= $this->dhoy; $i++) {
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
