<?php


use cobra_salsa\SegmentAdminClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/SegmentAdminClass.php';

class SegmentAdminClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var SegmentAdminClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new SegmentAdminClass($this->pdo);
    }

    public function testListUnqueuedSegments()
    {
        $unqueued = $this->cc->listUnqueuedSegments();
        $this->assertIsArray($unqueued);
        $first = array_pop($unqueued);
        if ($first) {
            $this->assertArrayHasKey('cliente', $first);
            $this->assertArrayHasKey('sdc', $first);
            $this->assertArrayHasKey('cnt', $first);
        }
        $this->assertNull($first);
    }

    public function testListQueuedSegmentos()
    {
        $queued = $this->cc->listQueuedSegmentos();
        $this->assertIsArray($queued);
        if (count($queued) > 0) {
            $first = array_pop($queued);
            $this->assertArrayHasKey('cliente', $first);
            $this->assertArrayHasKey('sdc', $first);
            $this->assertArrayHasKey('cnt', $first);
        }
    }
}
