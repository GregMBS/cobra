<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\HorariosClass;
use App\HorariosAllClass;
use App\HorariosDataClass;

class HorariosController extends Controller
{
    /**
     *
     * @var HorariosClass
     */
    private $hc;

    /**
     *
     * @var HorariosAllClass
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
        $this->hc = new HorariosClass();
        $this->hac = new HorariosAllClass();
        $this->yr = date('Y');
        $this->mes = date('m');
        $this->dhoy = date('d');
        $this->hoy = date('Y-m-d');
        $this->yrmes = date('Y-m-');
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
                $data->gestiones = $main['gestiones'];
                $data->cuentas = $main['cuentas'];
                $data->contactos = $main['contactos'];
                $data->nocontactos = $main['nocontactos'];
                $data->promesas = $main['promesas'];
                $data->pagos = 0;
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
            }
            $dataSum->pagos = $this->hac->getPagos($i);
            $summary[$i] = $dataSum;
        }
        $c_cvge = array_column($gestores, 'c_cvge');
        $view = view('horarios')
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
        $summary = array();
        $visitadores = $this->hc->listVisitadores();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        foreach ($visitadores as $visitador) {
            $c_visit = $visitador['iniciales'];
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
            $output[$c_visit] = $row;
        }
        $c_visit = array_column($visitadores, 'iniciales');
        $view = view('horariosV')
            ->with('yrmes', $this->yrmes)
            ->with('visitadores', $c_visit)
            ->with('dhoy', $this->dhoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }

    /**
     *
     * @param string $c_cvge
     * @return View
     */
    public function show($c_cvge)
    {
        $output = array();
        $row = array();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        for ($i = 1; $i <= $this->dhoy; $i++) {
            $data = new HorariosDataClass($i);
            $startStop = $this->hc->getStartStopDiff($c_cvge, $i);
            $data->start = $startStop['start'];
            $data->stop = $startStop['stop'];
            $data->diff = $startStop['diff'];
            $main = $this->hc->getCurrentMain($c_cvge, $i);
            $data->gestiones = $main['gestiones'];
            $data->cuentas = $main['cuentas'];
            $data->contactos = $main['contactos'];
            $data->nocontactos = $main['nocontactos'];
            $data->promesas = $main['promesas'];
            $data->pagos = 0;
            $row[$i] = $data;
        }
        $output[] = $row;
        $view = view('horario')
            ->with('yrmes', $this->yrmes)
            ->with('gestor', $c_cvge)
            ->with('dhoy', $this->dhoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }
}
