<?php

namespace Tests\Unit;

use App\ComparisonClass;
use Tests\ReportTest;


class ComparativoClassTest extends ReportTest
{
    /**
     * @var array
     */
    protected $keys = [
        "c_cvba",
        "mdf",
        "sg",
        "sc",
        "sp",
        "cg",
        "ch"
    ];

    protected $class;

    public function testGetReport()
    {
        $this->class = new ComparisonClass();
        parent::testGetReport();
    }
}
