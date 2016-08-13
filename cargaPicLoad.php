<?php
require_once 'pdoConnect.php';
$pdoc   = new pdoConnect();
$pdo    = $pdoc->dbConnectAdmin();
$capt   = filter_input(INPUT_POST, 'capt');
$cuenta = filter_input(INPUT_POST, 'cuenta');
if ($_FILES["file"]["error"] == 0) {
    $deststr = "/var/www/pics/".$cuenta.'.jpg';
    move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
    $result  = TRUE;
}

require_once 'cargaPic.php';
