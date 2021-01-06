<?php

namespace Tests\Unit;

use App\Resumen;
use App\SegmentAdminClass;
use DB;
use Exception;
use PDO;
use PDOException;
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
        $sc = new SegmentAdminClass();
        $result = $sc->listQueuedSegments();
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
        $sc = new SegmentAdminClass();
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
        $sc = new SegmentAdminClass();
        $sc->addAllSegments();
        $result = $sc->listUnqueuedSegments();
        $this->assertEquals(0, count($result));
    }

    /**
     * @throws Exception
     */
    public function testAgregarBorrarSegmento()
    {
        $sc = new SegmentAdminClass();
        $cliente = 'testClient';
        $segmento = 'testSegment';
        $sc->addSegment($cliente, $segmento);
        $this->assertDatabaseHas('queuelist', [
            'cliente' => $cliente,
            'sdc' => $segmento
        ]);
        $sc->eraseSegment($cliente, $segmento);
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
     * @throws Exception
     */
    public function testInactivarSegmento()
    {
        /** @var PDO $pdo */
        $pdo = DB::getPdo();
        $query = "select cliente, 
substring_index(status_de_credito, '-', 1) as sdc, 
sum(substring_index(status_de_credito, '-', 1) = status_de_credito) as activo, 
sum(substring_index(status_de_credito, '-', 1) <> status_de_credito) as inactivo
from resumen
where cliente <> ''
group by cliente,sdc
having activo > 0 and inactivo = 0";
        try {
            $stq = $pdo->prepare($query);
            $stq->execute();
            $result = $stq->fetch();
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
        if ($result) {
            $sc = new SegmentAdminClass();
            $cliente = $result['cliente'];
            $segmento = $result['sdc'];
            $sc->inactivateSegment($cliente, $segmento);
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
        $this->assertTrue(true);
    }
}
