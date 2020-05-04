<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectUser();
$capt = $pc->capt;
$cuenta = filter_input(INPUT_POST, 'cuenta');
$cliente = filter_input(INPUT_POST, 'cliente');
$query = "SELECT id_cuenta FROM resumen 
        WHERE cliente = :cliente
        AND numero_de_cuenta = :cuenta";
$sti = $pdo->prepare($query);
$sti->bindParam(':cliente', $cliente);
$sti->bindParam(':cuenta', $cuenta);
$sti->execute();
$result = $sti->fetch(PDO::FETCH_ASSOC);
$id_cuenta = $result['id_cuenta'];
if ($id_cuenta) {
    if ($_FILES["file"]["error"] == 0) {
        $deststr = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $id_cuenta . '.jpg';
        move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
        $flag = TRUE;
    }
} else {
    $flag = FALSE;
}
include 'cargaPic.php';
