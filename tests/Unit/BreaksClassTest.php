<?php

namespace Tests\Unit;

use App\BreaksClass;
use Tests\TestCase;

class BreaksClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListBreaks()
    {
        $testKeys = array(
            'auto',
            'gestor',
            'tipo',
            'empieza',
            'termina'
        );
        $bc = new BreaksClass();
        /**
         * @var array $result
         */
        $result = $bc->listBreaks();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testBreaksPageData()
    {
        $testKeys = array(
            'auto','c_cvge','c_cvst','c_hrin','diff'
        );
        $gestor = 'gmbs';
        $bc = new BreaksClass();
        /**
         * @var array $result
         */
        $result = $bc->breaksPageData($gestor);
        if (count($result) > 0) {
            $first = $result[0];
            $keys = array_keys($first);
            $this->assertEquals($testKeys, $keys);
        } else {
            $this->assertEquals(0, count($result));
        }
    }
}
