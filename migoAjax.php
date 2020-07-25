<?php

use cobra_salsa\MigoClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$mc = new MigoClass($pdo);
$capt = $pd->capt;
$tipo = $pd->tipo;
$keys = [
    'numero_de_cuenta',
    'nombre_deudor',
    'cliente',
    'status_de_credito',
    'saldo_total',
    'saldo_descuento_2',
    'saldo_aarsa',
    'fecha_ultima_gestion'
];
if ($tipo == 'admin') {
    $main = $mc->adminReport();
    while ($row = $main->fetch(PDO::FETCH_ASSOC)) {
        var_dump($row);
        die();
        $data = array_values(array_intersect_key($row, $keys));
        echo json_encode($data);
    }
} else {
    $main = $mc->userReport($capt);
    while ($row = $main->fetch(PDO::FETCH_ASSOC)) {
        $data = array_values(array_intersect_key($row, $keys));
        echo json_encode($data);
    }
}
