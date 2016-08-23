<?php

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == 'GUARDAR') {
        $HORA = filter_input(INPUT_GET, 'HORA');
        $NOTA = filter_input(INPUT_GET, 'NOTA');
        $target = filter_input(INPUT_GET, 'target');
        $year = filter_input(INPUT_GET, 'formYear', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/0-9/")));
        $month = filter_input(INPUT_GET, 'formMonth', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/0-9/")));
        $day = filter_input(INPUT_GET, 'formDay', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/0-9/")));
        $FECHA = date($year . '-' . $month . '-' . $day);
        $queryins = "INSERT INTO cobra.notas
            (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA)
            VALUES
            (:target, :capt, curdate(), curtime(), :fecha, :hora, :nota)";
        $sti = $pdo->prepare($queryins);
        $sti->bindParam(':target', $target);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':fecha', $FECHA);
        $sti->bindParam(':hora', $HORA);
        $sti->bindParam(':nota', $NOTA);
        $sti->execute();
        $redirector = "Location: notadmin.php?capt=" . $capt;
        header($redirector);
    }
    if ($go == 'BORRAR') {
        $AUTO = filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
        $queryupd = "UPDATE cobra.notas "
                . "SET borrado=1 "
                . "WHERE auto=:auto";
        $stu = $pdo->prepare($queryupd);
        $stu->bindParam(':auto', $AUTO, PDO::PARAM_INT);
        $stu->execute();
        $redirector = "Location: notadmin.php?capt=" . $capt;
        header($redirector);
    }
}
$querysub = "SELECT auto,fecha,hora,nota,c_cvge "
        . "FROM notas "
        . "WHERE borrado=0 ORDER BY fecha desc,hora desc";
$rowsub = $pdo->query($querysub);
$queryt = "SELECT iniciales FROM nombres "
        . "ORDER BY iniciales";
$rowt = $pdo->query($queryt);
require_once 'views/notadminView.php';
