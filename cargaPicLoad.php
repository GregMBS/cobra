<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$capt = $pdoc->capt;
$cuenta = filter_input(INPUT_POST, 'cuenta');
if ($_FILES["file"]["error"] == 0) {
    $deststr = $_SERVER['DOCUMENT_ROOT']."/uploads/".$cuenta.'.jpg';
    die($deststr);
    move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
    $result  = TRUE;
}

include 'cargaPic.php';
