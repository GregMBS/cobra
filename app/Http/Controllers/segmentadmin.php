<?php


use App\SegmentadminClass;

$sac = new SegmentadminClass();
$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == "BORRAR") {
        $cliente = filter_input(INPUT_GET, 'cliente');
        $segmento = filter_input(INPUT_GET, 'segmento');
        $sac->borrarSegmento($cliente, $segmento);
    }

    if ($go == "INACTIVAR") {
        $cliente = filter_input(INPUT_GET, 'cliente');
        $segmento = filter_input(INPUT_GET, 'segmento');
        $sac->inactivateSegmento($cliente, $segmento);
    }

    if ($go == "AGREGAR") {
        $cliseg = filter_input(INPUT_GET, 'cliseg');
        $clientesegmento = explode(';', $cliseg);
        $cliente = $clientesegmento[0];
        if (!empty($cliente)) {
            if (count($clientesegmento) > 1) {
                $segmento = $clientesegmento[1];
            } else {
                $segmento = '';
            }
            $sac->agregarSegmento($cliente, $segmento);
        }
        header("Location: segmentadmin.php?capt=" . $capt);
    }
    if ($go == "AGREGARALL") {
        $sac->addAllSegmentos();
        header("Location: segmentadmin.php?capt=" . $capt);
    }
}
$result = $sac->listQueuedSegmentos();
$result2 = $sac->listUnqueuedSegments();
require_once 'views/segmentadminView.php';
