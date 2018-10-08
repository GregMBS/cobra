<?php

namespace App\Http\Controllers;

use App\PerfmesAllClass;
use App\PerfmesClass;

class PerfmesController extends HorariosController
{

    /** @var array  */
    protected $views = [
        'index' => 'perfmes',
        'indexV' => 'perfmesV'
    ];

    /**
     * PerfmesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->hc = new PerfmesClass();
        $this->hac = new PerfmesAllClass();
        $this->yr = date('Y',strtotime("last day of previous month"));
        $this->mes = date('m',strtotime("last day of previous month"));
        $this->diaHoy = date('d',strtotime("last day of previous month"));
        $this->hoy = date('Y-m-d',strtotime("last day of previous month"));
        $this->yrmes = date('Y-m-',strtotime("last day of previous month"));
    }

    public function show($c_cvge)
    {
        return [$c_cvge];
    }
}
