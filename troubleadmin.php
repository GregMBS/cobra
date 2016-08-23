<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == 'RESOLVER') {
        $auto = filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
        $reparacion = filter_input(INPUT_GET, 'reparacion');
        $queryup = "UPDATE cobra.trouble
            set fechacomp=now(),
            it_guy=:capt,
            reparacion=:reparacion
            where auto=:auto;";
        $stu = $pdo->prepare($queryup);
        $stu->bindParam(':capt', $capt);
        $stu->bindParam(':reparacion', $reparacion);
        $stu->bindParam(':auto', $auto);
        $stu->execute();
    }
}
$querysub = "SELECT * FROM trouble ORDER BY fechahora desc";
$rowsub = $pdo->query($querysub);
require_once 'views/troubleadminView.php';