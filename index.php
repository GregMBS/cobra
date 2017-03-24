<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\LoginClass;

$local = $_SERVER['REMOTE_ADDR'];
$go = filter_input(INPUT_POST, 'go');
$capt = filter_input(INPUT_POST, 'capt');
$pw = filter_input(INPUT_POST, 'pwd');
if (!empty($go)) {
    require_once 'classes/PdoClass.php';
    require_once 'classes/LoginClass.php';
    $pdoc = new PdoClass();
    $pdo = $pdoc->dbConnectNobody();
    $lc = new LoginClass($pdo);
    $userData = $lc->getUserData($capt, $pw);
    if (isset($userData['tipo'])) {
        switch ($userData['tipo']) {
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
        $cpw = $capt . sha1($pw) . date('U');
        if ($capt == "gmbs") {
            setcookie('auth', $cpw, time() + 60 * 60 * 24);
        } else {
            setcookie('auth', $cpw, time() + 60 * 60 * 11);
        }
        $lc->setTicket($cpw, $capt, $userData['tipo']);
        $lc->setInitialQueue($capt);
        $lc->setUserlog($capt, $local);
        $lc->insertPermalog($capt, $local);
        $lc->insertHistoria($capt);
        $enlace = $userData['enlace'];
        $page = "Location: $enlace?find=$capt&field=$field&i=0&capt=$capt&go=ABINICIO";
        header($page);
    }
}
require_once 'views/indexView.php';
