<?php

namespace Tests\Unit;

use App\BestClass;
use Tests\ReportTest;

class BestClassTest extends ReportTest
{
    /**
     * @var array
     */
    protected $keys = [
        "id_cuenta",
        "numero_de_cuenta",
        "segmento",
        "saldo_total",
        "fecha_ultima_gestion",
        "nombre_deudor",
        "producto",
        "status_cuenta",
        "ultimo_status",
        "ultimo_tel",
        "ultimo_comentario",
        "mejor_status",
        "mejor_tel"
    ];

    protected $class;

    public function testGetReport()
    {
        $this->class = new BestClass();
        parent::testGetReport();
    }

}
