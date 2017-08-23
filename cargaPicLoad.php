<?php

use cobra_salsa\PdoClass;
use PDO;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
/* @var $pdo PDO */
$pdo = $pdoc->dbConnectUser();
$capt = $pdoc->capt;
$cuenta = filter_input(INPUT_POST, 'cuenta');
$cliente = filter_input(INPUT_POST, 'cliente');
$query = "SELECT id_cuenta FROM resumen 
        WHERE ciente = :clliente
        AND numero_de_cuenta = :cuenta";
$sti = $pdo->prepare($query);
$sti->bindParam(':cliente', $cliente);
$sti->bindParam(':cuenta', $cuenta);
$sti->execute();
$qresult = $sti->fetch(PDO::FETCH_ASSOC);
$id_cuenta = $qresult['id_cuenta'];
if ($id_cuenta) {
    if ($_FILES["file"]["error"] == 0) {
        $deststr = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $id_cuenta . '.jpg';
        move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
        $result = TRUE;
    }
} else {
    $result = FALSE;
}
include 'cargaPic.php';
