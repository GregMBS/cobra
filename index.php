<?php

use cobra_salsa\PdoClass;
use cobra_salsa\LoginClass;

$local = $_SERVER['REMOTE_ADDR'];
$go = filter_input(INPUT_POST, 'go');
$capt = filter_input(INPUT_POST, 'capt');
$pw = filter_input(INPUT_POST, 'pwd');

if (!empty($go)) {
    require_once 'classes/PdoClass.php';
    require_once 'classes/LoginClass.php';
    $pd = new PdoClass();
    $pdo = $pd->dbConnectNobody();
    $lc = new LoginClass($pdo);
    $userData = $lc->getUserData($capt, $pw);
    $field = "ejecutivo_asignado_call_center";
    if (!empty($userData->TIPO)) {
        if ($userData->TIPO == 'visitador') {
            $field = "ejecutivo_asignado_domiciliario";
        }
        $cpw = $capt . sha1($pw) . date('U');
        if ($capt == "gmbs") {
            setcookie('auth', $cpw, time() + 60 * 60 * 24);
        } else {
            setcookie('auth', $cpw, time() + 60 * 60 * 11);
        }
        $enlace = $lc->runLogin($cpw, $capt, $userData, $local);
        $page = "Location: $enlace?find=$capt&field=$field&i=0&capt=$capt&go=ABINICIO";
        header($page);
    }
}
require_once 'views/indexView.php';