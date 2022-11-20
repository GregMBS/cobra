<?php

use cobra_salsa\CarteritasClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CarteritasClass.php';

$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$capt = $pc->capt;
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);
$cc = new CarteritasClass($pdo);
$count = 0;
$dataCount = 0;
$error = '';
$go = $post['go'] ?? '';

if ($go === 'cargar') {
    if ($_FILES["file"]["error"] > 0) {
        $error = "<p>Error: " . $_FILES["file"]["error"] . "</p>";
    } else {
        $filename = $cc->moveLoadedFile();
        try {
            $prepareData = $cc->prepareData($filename);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        $dataCount = $prepareData->dataCount;
        $count = $prepareData->count;
        $fixVisitas = $cc->fix_visitas;
        $fixTels = $cc->fix_tels;
        $fixProms = $cc->fix_proms;
        try {
            $sqv = $pdo->prepare($fixVisitas);
            $sqv->execute();
            $sqt = $pdo->prepare($fixTels);
            $sqt->execute();
            $sqp = $pdo->prepare($fixProms);
            $sqp->execute();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    if ($count !== $dataCount) {
        $error = "<p>Error: Archivo guardado mal. Envialo a greg@gmbs-consulting.com para investigar.</p>";
    }
}
require_once 'views/carteritasView.php';