<?php
require_once 'pdoConnect.php';
$pdoc    = new pdoConnect();
$pdo     = $pdoc->dbConnectAdmin();
$capt    = filter_input(INPUT_GET, 'capt');
$go      = filter_input(INPUT_GET, 'go');
$C_CONT  = filter_input(INPUT_GET, 'C_CONT');
$CLIENTE = filter_input(INPUT_GET, 'CLIENTE');
$cstring = '';
if (strlen($CLIENTE) > 2) {
    $cstring = " and cliente = :cliente ";
}

if ($go != 'CAMBIAR') {
    $field = filter_input(INPUT_GET, 'field');
    $find  = filter_input(INPUT_GET, 'find');
    $from  = filter_input(INPUT_GET, 'from');
}
if ($go == 'CAMBIAR') {
    $field     = 'id_cuenta';
    $find      = $C_CONT;
    $TAG0      = filter_input(INPUT_GET, 'SDC');
    $TAGA      = explode('-', $TAG0);
    $TAG       = trim($TAGA[0]);
    $TAGS      = $TAG;
    $INACTIVO  = !empty(filter_input(INPUT_GET, 'inactivo'));
    $LIQUIDADO = !empty(filter_input(INPUT_GET, 'liquidado'));
    if ($TAG != '') {
        if ($INACTIVO) {
            $TAGS = $TAG.'-inactivo';
        }
        if ($LIQUIDADO) {
            $TAGS = $TAG.'-liquidado';
        }
    } else {
        if ($INACTIVO) {
            $TAGS = $TAG.'Inactivo';
        }
        if ($LIQUIDADO) {
            $TAGS = $TAG.'Liquidado';
        }
    }
    $queryup = "UPDATE resumen
SET status_de_credito=:tags
WHERE id_cuenta=:c_cont";
    $stu     = $pdo->prepare($queryup);
    $stu->bindParam(':tags', $TAGS);
    $stu->bindParam(':c_cont', $C_CONT);
    $stu->execute();

    $queryup2 = "UPDATE rlook
SET status_de_credito=:tags
WHERE id_cuenta=:c_cont";
    $stuu     = $pdo->prepare($queryup2);
    $stuu->bindParam(':tags', $TAGS);
    $stuu->bindParam(':c_cont', $C_CONT);
    $stuu->execute();
}
$findFlag  = FALSE;
$querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where id_cuenta<0 ".$cstring;
if ($field == 'nombre_deudor') {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where nombre_deudor regexp :find ".$cstring;
    $findFlag  = TRUE;
}
if ($field == 'id_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where id_cuenta = :find ".$cstring;
    $findFlag  = TRUE;
}
if ($field == 'numero_de_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where numero_de_cuenta = :find ".$cstring." order by numero_de_cuenta";
    $findFlag  = TRUE;
}
$stm = $pdo->prepare($querymain);
if ($findFlag) {
    $stm->bindParam(':find', $find);
}
if ($cstring != '') {
    $stm->bindParam(':cliente', $CLIENTE);
}
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/changestView.php';