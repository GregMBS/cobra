<?php

namespace App\Http\Controllers;

use App\LastMonthAllClass;
use App\LastMonthClass;

class LastMonthController extends HoursController
{

    /** @var array  */
    protected $views = [
        'index' => 'perfmes',
        'indexV' => 'perfmesV'
    ];

    /**
     * LastMonthController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->hc = new LastMonthClass();
        $this->hac = new LastMonthAllClass();
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
