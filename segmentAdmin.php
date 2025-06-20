<?php

use cobra_salsa\PdoClass;
use cobra_salsa\SegmentAdminClass;

require_once 'classes/PdoClass.php';
require_once 'classes/SegmentAdminClass.php';
$pc   = new PdoClass();
$pdo  = $pc->dbConnectAdmin();
$sc   = new SegmentAdminClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go   = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == "BORRAR") {
        $cliente     = filter_input(INPUT_GET, 'cliente');
        $segmento    = filter_input(INPUT_GET, 'segmento');
        $sc->borrarSegmento($cliente, $segmento);
    }

    if ($go == "AGREGAR") {
        $cliseg          = filter_input(INPUT_GET, 'cliseg');
        $clientesegmento = explode(';', $cliseg);
        $cliente         = $clientesegmento[0];
        $segmento        = $clientesegmento[1];
        $sc->agregarSegmento($cliente, $segmento);
        header("Location: segmentAdmin.php?capt=".$capt);
    }
    if ($go == "AGREGARALL") {
        $sc->addAllSegmentos();
        header("Location: segmentAdmin.php?capt=".$capt);
    }
}
$queued     = $sc->listQueuedSegmentos();
$unqueued    = $sc->listUnqueuedSegments();
require_once 'views/segmentAdminView.php';