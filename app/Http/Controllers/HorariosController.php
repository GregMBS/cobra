<?php

namespace App\Http\Controllers;

use View;
use App\HorariosClass;
use App\HorariosAllClass;
use App\HorariosDataClass;

class HorariosController extends Controller
{
    /**
     *
     * @var HorariosClass
     */
    protected $hc;

    /**
     *
     * @var HorariosAllClass
     */
    protected $hac;

    protected $yr;
    protected $mes;
    protected $yrmes;

    /**
     *
     * @var int
     */
    protected $dhoy;

    /**
     *
     * @var string
     */
    protected $hoy;

    /** @var array  */
    protected $views = [
        'index' => 'horarios',
        'indexV' => 'horariosV',
        'show' => 'horario',
        'showV' => 'horarioV'
    ];

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
            $output[$c_cvge] = $this->hc->packData($c_cvge, $this->dhoy);
        }
        for ($i = 1; $i <= $this->dhoy; $i++) {
            $dataSum = new HorariosDataClass($i);
            $mainSum = $this->hac->getCurrentMain($i);
            if ($mainSum) {
                $dataSum->gestiones = intval($mainSum['gestiones']);
                $dataSum->cuentas = intval($mainSum['cuentas']);
                $dataSum->contactos = intval($mainSum['contactos']);
                $dataSum->nocontactos = intval($mainSum['nocontactos']);
                $dataSum->promesas = intval($mainSum['promesas']);
            }
            $dataSum->pagos = $this->hac->getPagos($i);
            $summary[$i] = $dataSum;
        }
        $c_cvge = array_column($gestores, 'c_cvge');
        $view = view($this->views['index'])
            ->with('yrmes', $this->yrmes)
            ->with('gestores', $c_cvge)
            ->with('dhoy', $this->dhoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output)
            ->with('summary', $summary);
        return $view;
    }

    /**
     * @return View
     */
    public function indexV()
    {
        $output = array();
        $visitadores = $this->hc->listVisitadores();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        foreach ($visitadores as $visitador) {
            $c_visit = $visitador['iniciales'];
            $row = $this->hc->packVisit($c_visit, $this->dhoy);
            $output[$c_visit] = $row;
        }
        $c_visit = array_column($visitadores, 'iniciales');
        $view = view($this->views['indexV'])
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
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        $output = $this->hc->packData($c_cvge, $this->dhoy);
        $view = view($this->views['show'])
            ->with('yrmes', $this->yrmes)
            ->with('gestor', $c_cvge)
            ->with('dhoy', $this->dhoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }

    /**
     *
     * @param string $c_visit
     * @return View
     */
    public function showV($c_visit)
    {
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->dhoy);
        $output = $this->hc->packVisit($c_visit, $this->dhoy);
        $view = view($this->views['showV'])
            ->with('yrmes', $this->yrmes)
            ->with('visitador', $c_visit)
            ->with('dhoy', $this->dhoy)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }

}
