<?php

namespace Tests\Unit;

use App\Resumen;
use App\SegmentadminClass;
use Tests\TestCase;

class SegmentadminClassTest extends TestCase
{
    public function testListQueuedSegmentos()
    {
        $testKeys = [
            0 => 'cliente',
            1 => 'sdc',
            2 => 'cnt',
            3 => 'id'
        ];
        $sc = new SegmentadminClass();
        $result = $sc->listQueuedSegmentos();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testListUnqueuedSegmentos()
    {
        $testKeys = [
            0 => 'cliente',
            1 => 'sdc',
            2 => 'count(1)'
        ];
        $sc = new SegmentadminClass();
        $result = $sc->listUnqueuedSegments();
        if (count($result) > 0) {
            $first = $result[0];
            $keys = array_keys($first);
            $this->assertEquals($testKeys, $keys);
        } else {
            $this->assertEquals(0, count($result));
        }
    }

    public function testAddAllSegmentos()
    {
        $sc = new SegmentadminClass();
        $sc->addAllSegmentos();
        $result = $sc->listUnqueuedSegments();
        $this->assertEquals(0, count($result));
    }

    /**
     * @throws \Exception
     */
    public function testAgregarBorrarSegmento()
    {
        $sc = new SegmentadminClass();
        $cliente = 'testClient';
        $segmento = 'testSegment';
        $sc->agregarSegmento($cliente, $segmento);
        $this->assertDatabaseHas('queuelist', [
            'cliente' => $cliente,
            'sdc' => $segmento
        ]);
        $sc->borrarSegmento($cliente, $segmento);
        $this->assertDatabaseMissing('queuelist', [
            'cliente' => $cliente,
            'sdc' => $segmento
        ]);
    }

    /**
     * @param string $cliente
     * @param string $segmento
     */
    private function reactivarSegmento($cliente, $segmento)
    {
        $rc = new Resumen();
        /** @var Resumen $query */
        $query = $rc->where('cliente','=' ,$cliente);
        $query = $query->where('status_de_credito', '=', $segmento.'-inactivo');
        $query->update(array('status_de_credito' => $segmento));
    }

    /**
     * @throws \Exception
     */
    public function testInactivarSegmento()
    {
        $sc = new SegmentadminClass();
        $cliente = 'GORDILLO';
        $segmento = 'CIERRE AGOSTO ';
        $sc->inactivarSegmento($cliente, $segmento);
        $this->assertDatabaseMissing('resumen', [
           'cliente' => $cliente,
           'status_de_credito' => $segmento
        ]);
        $newSegmento = $segmento . '-inactivo';
        $this->assertDatabaseHas('resumen', [
            'cliente' => $cliente,
            'status_de_credito' => $newSegmento
        ]);
        $this->reactivarSegmento($cliente, $segmento);
        $this->assertDatabaseMissing('resumen', [
            'cliente' => $cliente,
            'status_de_credito' => $newSegmento
        ]);
    }
}
