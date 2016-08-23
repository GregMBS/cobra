<?php
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$get = filter_input_array(INPUT_GET);
$field = '';
if (isset($get['go'])) {
    $go = $get['go'];
} else {
    $go = '';
}
if ($go == 'BUSCAR') {
    $field = $get['field'];
    $find = $get['find'];
}
if ($go == 'CAMBIAR') {
    $C_CONT = $get['C_CONT'];
    $CLIENTE = $get['CLIENTE'];
    $field = 'id_cuenta';
    $find = $C_CONT;
    $TAG0 = $get['SDC'];
    $TAGA = explode('-', $TAG0);
    $TAG = trim($TAGA[0]);
    $TAGS = $TAG;
    $INACTIVO = !empty($get['inactivo']);
    $LIQUIDADO = !empty($get['liquidado']);
    $QUITA = !empty($get['quita']);
    $REESTRUCTURA = !empty($get['reestructura']);
    $REGULARIZADA = !empty($get['regularizada']);
    if ($INACTIVO) {
        $TAGS = $TAG . '-inactivo';
    }
    if ($LIQUIDADO) {
        $TAGS = $TAG . '-liquidado';
    }
    if ($QUITA) {
        $TAGS = $TAG . '-quita';
    }
    if ($REESTRUCTURA) {
        $TAGS = $TAG . '-reestructura';
    }
    if ($REGULARIZADA) {
        $TAGS = $TAG . '-regularizada';
    }
    $queryup = "UPDATE resumen
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
    $stu = $pdo->prepare($queryup);
    $stu->bindParam(':tags', $TAGS);
    $stu->bindParam(':C_CONT', $C_CONT);
    $stu->execute();

    $queryup2 = "UPDATE rlook
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
    $stu2 = $pdo->prepare($queryup2);
    $stu2->bindParam(':tags', $TAGS);
    $stu2->bindParam(':C_CONT', $C_CONT);
    $stu2->execute();
}
$querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where id_cuenta<0 and :find=:find";
if ($field == 'nombre_deudor') {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where nombre_deudor regexp :find";
}
if ($field == 'id_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where id_cuenta = :find";
}
if ($field == 'numero_de_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where numero_de_cuenta = :find order by numero_de_cuenta";
}
if (isset($CLIENTE)) {
    if (strlen($CLIENTE) > 1) {
        $querymain = $querymain . " and cliente=:cliente";
    } else {
        $querymain = $querymain . " and :cliente<>'AA'";
    }
} else {
    $CLIENTE = '';
    $querymain = $querymain . " and :cliente<>'AA'";
}
$stm = $pdo->prepare($querymain);
$stm->bindParam(':find', $find);
$stm->bindParam(':cliente', $CLIENTE);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
$querycl = "SELECT cliente FROM clientes";
$resultcl = $pdo->query($querycl);
require_once 'views/changestView.php';