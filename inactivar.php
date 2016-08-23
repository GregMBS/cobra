<?php
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_POST, 'go');
$dataRaw = filter_input(INPUT_POST, 'data');
$msg = '';
if (!empty($go)) {

    if ($go == 'cargar') {

        $data = preg_split("/[\s,]+/", $dataRaw, 0, PREG_SPLIT_NO_EMPTY);
        $max = count($data);
        $queryload = '';
        $querydie = "update resumen
set status_de_credito=concat(trim(status_de_credito),'-inactivo') 
where status_de_credito not regexp '-' and numero_de_cuenta=:cta";
        $std = $pdo->prepare($querydie);
        for ($i = 0; $i < $max; $i++) {
            $std->bindParam(':cta', $data[$i]);
            $std->execute();
        }
        $msg = '<p>Cuentas est&aacute;n inactivadas</p>';
    }
}
require_once 'views/inactivarView.php';