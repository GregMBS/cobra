<?php
require_once 'classes/pdoConnect.php';
require_once 'classes/segmentadminClass.php';
$pc   = new pdoConnect();
$pdo  = $pc->dbConnectAdmin();
$sc   = new segmentadminClass($pdo);
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
        header("Location: segmentadmin.php?capt=".$capt);
    }
    if ($go == "AGREGARALL") {
        $sc->addAllSegmentos();
        header("Location: segmentadmin.php?capt=".$capt);
    }
}
$result     = $sc->listQueuedSegmentos();
$result2    = $sc->listUnqueuedSegments();
require_once 'views/segmentadminView.php';