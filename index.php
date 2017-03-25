<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\LoginClass;

$local = $_SERVER['REMOTE_ADDR'];
$go = filter_input(INPUT_POST, 'go');
if (!empty($go)) {
    $capt = filter_input(INPUT_POST, 'capt');
    $pw = filter_input(INPUT_POST, 'pwd');
    require_once 'classes/PdoClass.php';
    require_once 'classes/LoginClass.php';
    $pdoc = new PdoClass();
    $pdo = $pdoc->dbConnectNobody();
    $lc = new LoginClass($pdo);
    $lc->doLogin($cpw, $field, $local);
    $userData = $lc->getUserData($capt, $pw);
    $tipo = $userData['tipo'];
    if (isset($tipo)) {
        switch ($tipo) {
            case "callcenter":
            $field = "ejecutivo_asignado_call_center";
                break;

            case "visitador":
            $field = "ejecutivo_asignado_domiciliario";
                break;

            case "admin":
            $field = "ejecutivo_asignado_call_center";
                break;

            default:
                break;
        }
        $cpw = sha1($capt . $pw);
        if ($capt == "gmbs") {
            setcookie('auth', $cpw, time() + 60 * 60 * 24, "/", "demo.gmbs-consulting.com", 0, 1);
        } else {
            setcookie('auth', $cpw, time() + 60 * 60 * 11, "/", "demo.gmbs-consulting.com", 0, 1);
        }
        $enlace = $userData['enlace'];
        $page = "Location: $enlace?find=$capt&field=$field&i=0&capt=$capt&go=ABINICIO";
        header($page);
    }
}
require_once 'views/indexView.php';
