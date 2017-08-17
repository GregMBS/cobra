<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_demo;

use PHPUnit\Framework\TestCase;
use cobra_salsa\BigInputObject;

include_once '../classes/BigInputObject.php';

/**
 * @covers BigInputClass
 */
class BigInputClassTests extends TestCase
{
    public function testValidDateBlank()
    {
        $bic = new BigInputObject('', '', '', '', '', '');
        $result = $bic->validDate('');
        $this->assertFalse($result);
    }

    public function testValidDateNull()
    {
        $bic = new BigInputObject('', '', '', '', '', '');
        $result = $bic->validDate(null);
        $this->assertFalse($result);
    }

    public function testValidDateOk()
    {
        $bic = new BigInputObject('', '', '', '', '', '');
        $result = $bic->validDate('2017-08-10');
        $this->assertTrue($result);
    }

    public function testFixDateBlank()
    {
        $bic = new BigInputObject('', '', '', '', '', '');
        $result = $bic->fixDate('', $bic->maxDate);
        $this->assertEquals('2020-12-31', $result);
    }

    public function testFixDateNull()
    {
        $bic = new BigInputObject('', '', '', '', '', '');
        $result = $bic->fixDate('', $bic->maxDate);
        $this->assertEquals('2020-12-31', $result);
    }

    public function testFixDateOk()
    {
        $bic = new BigInputObject('', '', '', '', '', '');
        $result = $bic->fixDate('2017-08-10', $bic->maxDate);
        $this->assertEquals('2017-08-10', $result);
    }

}