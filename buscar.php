<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
set_time_limit(300);
$field = filter_input(INPUT_GET, 'field');
$find = filter_input(INPUT_GET, 'find');
$from = filter_input(INPUT_GET, 'from');
if (filter_has_var(INPUT_GET, 'C_CONT')) {
    $C_CONT = filter_input(INPUT_GET, 'C_CONT');
} else {
    $C_CONT = 0;
}
$CLIENTE = filter_input(INPUT_GET, 'cliente');
/*
  $querymain	 = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
  id_cuenta,status_de_credito from resumen where ".$field." like '%".$find."%'";
 */
$queryhead = "SELECT SQL_NO_CACHE numero_de_cuenta, nombre_deudor,
cliente, id_cuenta, status_de_credito from resumen ";
switch ($field) {
    case 'id_cuenta':
        $querymain = $queryhead . "where id_cuenta = :find order by id_cuenta;";
        break;
    case 'nombre_deudor':
        $querymain = $queryhead . "where nombre_deudor regexp :find ";
        break;
    case 'numero_de_cuenta':
        $querymain = $queryhead . "where numero_de_cuenta regexp :find ";
        break;
    case 'numero_de_credito':
        $querymain = $queryhead . "where numero_de_credito regexp :find ";
        break;
    case 'domicilio_deudor':
        $querymain = $queryhead . "where domicilio_deudor regexp :find ";
        break;
    case 'REFS':
        $querymain = $queryhead . "WHERE
(nombre_deudor_alterno regexp :find or
nombre_referencia_1 regexp :find or
nombre_referencia_2 regexp :find or
nombre_referencia_3 regexp :find or
nombre_referencia_4 regexp :find)";
        break;
    case 'TELS':
        $querymain = $queryhead . "WHERE
(tel_1 regexp :find or
tel_2 regexp :find or
tel_3 regexp :find or
tel_4 regexp :find or
tel_1_alterno regexp :find or
tel_2_alterno regexp :find or
tel_3_alterno regexp :find or
tel_4_alterno regexp :find or
tel_1_ref_1 regexp :find or
tel_2_ref_1 regexp :find or
tel_1_ref_2 regexp :find or
tel_2_ref_2 regexp :find or
tel_1_ref_3 regexp :find or
tel_2_ref_3 regexp :find or
tel_1_ref_4 regexp :find or
tel_2_ref_4 regexp :find or
tel_1_laboral regexp :find or
tel_2_laboral regexp :find or
tel_1_verif regexp :find or
tel_2_verif regexp :find or
tel_3_verif regexp :find or
tel_4_verif regexp :find or
telefonos_marcados regexp :find)";
        break;
    case 'ROBOT':
        $querymain = "SELECT SQL_NO_CACHE
			distinct numero_de_cuenta,nombre_deudor, cliente,
			id_cuenta, status_de_credito
			FROM resumen, historia
			WHERE c_tele REGEXP :find and c_cont=id_cuenta";
        break;

    default:
        break;
}
$cliFlag = 0;
if ((isset($querymain)) && (strlen($CLIENTE) > 1)) {
    $querymain = $querymain . " and cliente = :cliente ";
    $cliFlag = 1;
}
if (isset($querymain)) {
    try {
        $stm = $pdo->prepare($querymain);
        $stm->bindParam(':find', $find);
        if ($cliFlag == 1) {
            $stm->bindParam(':cliente', $CLIENTE);
        }
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
$querycl = "SELECT cliente FROM clientes;";
$resultcl = $pdo->query($querycl);
require_once 'views/buscarView.php';