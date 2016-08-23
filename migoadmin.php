<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go   = filter_input(INPUT_GET, 'go');

$querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
status_de_credito, cliente, status_aarsa,
saldo_descuento_2, id_cuenta,
fecha_ultima_gestion
FROM resumen
where status_de_credito not regexp '-'";
$result    = $pdo->query($querymain);
require_once 'views/migoView.php';