<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();

$go = filter_input(INPUT_GET, 'go');
$completo = filter_input(INPUT_GET, 'completo');
$tipo = filter_input(INPUT_GET, 'tipo');
$usuaria = filter_input(INPUT_GET, 'usuaria');
$passw = filter_input(INPUT_GET, 'passw');

if (!empty($go)) {
    if ($go == "GUARDAR") {
        $queryu = "UPDATE nombres
            SET completo = :completo
            tipo = :tipo
            WHERE usuaria = :usuaria";
        $stu = $pdo->prepare($queryu);
        $stu->bindParam(':completo', $completo);
        $stu->bindParam(':tipo', $tipo);
        $stu->bindParam(':usuaria', $usuaria);
        $stu->execute();
        $queryp = "UPDATE nombres
            SET passw = sha(:passw)
            WHERE usuaria = :usuaria
	    AND passw <> :passw";
        $stp = $pdo->prepare($queryp);
        $stp->bindParam(':passw', $passw);
        $stp->bindParam(':usuaria', $usuaria);
        $stp->execute();
    }

    if ($go == "BORRAR") {
        $queryb = "DELETE FROM nombres WHERE usuaria = :usuaria";
        $stb = $pdo->prepare($queryb);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
        $queryb2 = "DELETE FROM queuelist WHERE gestor = :usuaria";
        $stb2 = $pdo->prepare($queryb2);
        $stb2->bindParam(':usuaria', $usuaria);
        $stb2->execute();
        $queryb3 = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center = :usuaria";
        $stb3 = $pdo->prepare($queryb3);
        $stb3->bindParam(':usuaria', $usuaria);
        $stb3->execute();
    }

    if ($go == "AGREGAR") {
        $iniciales = strtolower($usuaria);
        $queryin = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW,
            TIPO, CAMP) 
	VALUES (:usuaria, :iniciales, :completo, sha(:passw), :tipo, 999999)";
        $sti = $pdo->prepare($queryin);
        $sti->bindParam(':completo', $completo);
        $sti->bindParam(':tipo', $tipo);
        $sti->bindParam(':usuaria', $usuaria);
        $sti->bindParam(':iniciales', $iniciales);
        $sti->bindParam(':passw', $passw);
        $sti->execute();
        $querylistin = "insert ignore into queuelist
		SELECT distinct null, :iniciales, cliente, status_aarsa, 999999,
		orden1, updown1, orden2, updown2, orden3, updown3,
		sdc, bloqueado
		FROM queuelist;";
        $stl = $pdo->prepare($querylistin);
        $stl->bindParam(':iniciales', $iniciales);
        $stl->execute();
        $querylistcamp = "update queuelist
            set camp=auto where camp=999999;";
        $resultlistcamp = $pdo->query($querylistcamp);
        header("Location: gestoradmin.php?capt=" . $capt);
    }
}
$querymain = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales <> 'gmbs'
    order by TIPO, USUARIA";
$result = $pdo->query($querymain);

$queryg = "SELECT grupo FROM grupos";
$resultg = $pdo->query($queryg) or die($pdo->error);
$groups = $resultg->fetchAll(PDO::FETCH_ASSOC) or die($resultg->error);
require_once 'views/gestoradminView.php';