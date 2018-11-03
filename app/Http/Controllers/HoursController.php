<?php

namespace App\Http\Controllers;

use View;
use App\HoursClass;
use App\HoursAllClass;
use App\HoursDataClass;

class HoursController extends Controller
{
    /**
     *
     * @var HoursClass
     */
    protected $hc;

    /**
     *
     * @var HoursAllClass
     */
    protected $hac;

    protected $yr;
    protected $mes;
    protected $yearMonth;

    /**
     *
     * @var int
     */
    protected $todayDay;

    /**
     *
     * @var string
     */
    protected $hoy;

    /** @var array  */
    protected $views = [
        'index' => 'hours',
        'indexV' => 'hoursV',
        'show' => 'hour',
        'showV' => 'hourV'
    ];

    public function __construct()
    {
        $this->hc = new HoursClass();
        $this->hac = new HoursAllClass();
        $this->yr = date('Y');
        $this->mes = date('m');
        $this->todayDay = date('d');
        $this->hoy = date('Y-m-d');
        $this->yearMonth = date('Y-m-');
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $output = array();
        $summary = array();
        $agents = $this->hc->listAgents();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->todayDay);
        foreach ($agents as $agent) {
            $initials = $agent['c_cvge'];
            $output[$initials] = $this->hc->packData($initials, $this->todayDay);
        }
        for ($i = 1; $i <= $this->todayDay; $i++) {
            $dataSum = new HoursDataClass($i);
            $mainSum = $this->hac->getCurrentMain($i);
            if ($mainSum) {
                $dataSum->gestiones = intval($mainSum['gestiones']);
                $dataSum->cuentas = intval($mainSum['cuentas']);
                $dataSum->contactos = intval($mainSum['contactos']);
                $dataSum->nocontactos = intval($mainSum['nocontactos']);
                $dataSum->promesas = intval($mainSum['promesas']);
            }
            $dataSum->pagos = $this->hac->getPayments($i);
            $summary[$i] = $dataSum;
        }
        $initials = array_column($agents, 'c_cvge');
        $view = view($this->views['index'])
            ->with('yrmes', $this->yearMonth)
            ->with('gestores', $initials)
            ->with('todayDay', $this->todayDay)
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
        $visitors = $this->hc->listVisitors();
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->todayDay);
        foreach ($visitors as $visitor) {
            $initials = $visitor['iniciales'];
            $row = $this->hc->packVisit($initials, $this->todayDay);
            $output[$initials] = $row;
        }
        $initials = array_column($visitors, 'iniciales');
        $view = view($this->views['indexV'])
            ->with('yrmes', $this->yearMonth)
            ->with('visitadores', $initials)
            ->with('todayDay', $this->todayDay)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }

    /**
     *
     * @param string $initials
     * @return View
     */
    public function show($initials)
    {
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->todayDay);
        $output = $this->hc->packData($initials, $this->todayDay);
        $view = view($this->views['show'])
            ->with('yrmes', $this->yearMonth)
            ->with('gestor', $initials)
            ->with('todayDay', $this->todayDay)
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
        $dowArray = $this->hc->dowArray($this->yr, $this->mes, $this->todayDay);
        $output = $this->hc->packVisit($c_visit, $this->todayDay);
        $view = view($this->views['showV'])
            ->with('yrmes', $this->yearMonth)
            ->with('visitador', $c_visit)
            ->with('todayDay', $this->todayDay)
            ->with('dowArray', $dowArray)
            ->with('data', $output);
        return $view;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select()
    {
        $agents = $this->hc->listAgents();
        $view = view('chooseGestor')
            ->with('gestores', $agents);
        return $view;
    }
}
