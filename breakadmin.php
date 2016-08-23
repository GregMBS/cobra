<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$tipo = filter_input(INPUT_GET, 'tipo');
$auto = filter_input(INPUT_GET, 'auto');
$gestor = filter_input(INPUT_GET, 'gestor');
$ehora = filter_input(INPUT_GET, 'ehora');
$emin = filter_input(INPUT_GET, 'emin');
$empieza = $ehora . ':' . $emin . ':00';
$thora = filter_input(INPUT_GET, 'thora');
$tmin = filter_input(INPUT_GET, 'tmin');
$termina = $thora . ':' . $tmin . ':00';

if ($go == "CAMBIAR") {
    $queryu = "UPDATE breaks
            SET tipo=:tipo,
            empieza=:empieza,
            termina=:termina
            WHERE auto=:auto";
    $stu = $pdo->prepare($queryu);
    $stu->bindParam(':auto', $auto, PDO::PARAM_INT);
    $stu->bindParam(':tipo', $tipo);
    $stu->bindParam(':empieza', $auto);
    $stu->bindParam(':termina', $auto);
    $stu->execute();
}

if ($go == "BORRAR") {
    $queryb = "DELETE FROM breaks WHERE auto=:auto";
    $stb = $pdo->prepare($queryb);
    $stb->bindParam(':auto', $auto, PDO::PARAM_INT);
    $stb->execute();
}

if ($go == "AGREGAR") {
    $queryin = "INSERT INTO breaks (gestor, tipo, empieza, termina)
	VALUES (:gestor,:tipo,:empieza,:termina)";
    $sta = $pdo->prepare($queryin);
    $sta->bindParam(':gestor', $gestor);
    $sta->bindParam(':tipo', $tipo);
    $sta->bindParam(':empieza', $auto);
    $sta->bindParam(':termina', $auto);
    $sta->execute();
}

$querymain = "SELECT auto, gestor, tipo, empieza, termina FROM breaks 
    order by gestor,empieza";
$result = $pdo->query($querymain);
$queryti = "SELECT iniciales FROM nombres "
        . "WHERE tipo NOT IN ('admin','visitador') "
        . "order by iniciales";
$resultti = $pdo->query($queryti);
require_once 'views/breakadminView.php';