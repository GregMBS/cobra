<?php

namespace Tests;

use App\ComparativoClass;


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
        $this->class = new ComparativoClass();
        parent::testGetReport();
    }
}
