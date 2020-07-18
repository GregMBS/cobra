<?php

use cobra_salsa\GestionClass;
use cobra_salsa\GestionObject;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenClass;
use cobra_salsa\ResumenQueuesClass;

$get = filter_input_array(INPUT_GET);
date_default_timezone_set('America/Monterrey');
setlocale(LC_MONETARY, 'en_US');

require_once 'classes/PdoClass.php';
require_once 'classes/GestionClass.php';
require_once 'classes/GestionObject.php';
require_once 'classes/ResumenClass.php';
require_once 'classes/ResumenQueuesClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectUser();
$gc = new GestionClass($pdo);
$rc = new ResumenClass($pdo);
$qc = new ResumenQueuesClass($pdo);
$capt = $pc->capt;
$mytipo = $pc->tipo;
$C_CVGE = $capt;
$pagAlert = 0;
if (!empty($mytipo)) {
    $oldgo = '';

    $go = filter_input(INPUT_GET, 'go');
    if ($go == 'ULTIMA') {
        $find = $rc->lastGestion($capt);
        $redirector = "Location: resumen.php?capt=$capt&find=$find&field=id_cuenta&go=FROMULTIMA";
        header($redirector);
    }
    $getUpdate = filter_has_var(INPUT_GET, 'find');
    $isOldId = filter_has_var(INPUT_GET, 'id_cuenta');
    if ($getUpdate) {
        $findGet = filter_input(INPUT_GET, 'find');
        $field = 'id_cuenta';
        $fieldGet = filter_input(INPUT_GET, 'field');
        if (isset($fieldGet)) {
            if ($rc->fieldCheck($fieldGet)) {
                $field = $fieldGet;
            }
        }
        $find = $rc->cleanFind($findGet);
    }

    $notes = $rc->notAlert($capt);

    if ($go == 'LOGOUT') {
        $page = "Location: logout.php?gone=&capt=" . $capt;
        header($page);
    }

    if (($go == 'CAPTURADO') && (!empty($get['C_CVST']))) {
        $C_HRIN = filter_input(INPUT_GET, 'C_VH') . ':' . filter_input(INPUT_GET, 'C_VMN');
        $C_HRFI = date('H:i:s');
        $C_CVGE = filter_input(INPUT_GET, 'C_CVGE');
        $C_CVBA = filter_input(INPUT_GET, 'C_CVBA');
        $C_CONT = filter_input(INPUT_GET, 'C_CONT');
        $C_CONTAN = filter_input(INPUT_GET, 'C_CONTAN');
        $C_CTIPO = filter_input(INPUT_GET, 'C_CTIPO');
        $C_COWN = filter_input(INPUT_GET, 'C_COWN');
        $C_CSTAT = filter_input(INPUT_GET, 'C_CSTAT');
        $CUENTA = filter_input(INPUT_GET, 'CUENTA');
        $C_OBSE1 = filter_input(INPUT_GET, 'C_OBSE1');
        $C_CALLE1 = filter_input(INPUT_GET, 'C_CALLE1');
        $C_CALLE2 = filter_input(INPUT_GET, 'C_CALLE2');
        $C_ATTE = filter_input(INPUT_GET, 'C_ATTE');
        $C_CARG = filter_input(INPUT_GET, 'C_CARG');
        $C_TELE = filter_input(INPUT_GET, 'C_TELE');
        $C_RCON = filter_input(INPUT_GET, 'C_RCON');
        $C_NSE = filter_input(INPUT_GET, 'C_NSE');
        $C_CNIV = filter_input(INPUT_GET, 'C_CNIV');
        $C_CFAC = filter_input(INPUT_GET, 'C_CFAC');
        $C_CPTA = filter_input(INPUT_GET, 'C_CPTA');
        $C_CREJ = filter_input(INPUT_GET, 'C_CREJ');
        $C_CPAT = filter_input(INPUT_GET, 'C_CPAT');
        $C_VISIT = filter_input(INPUT_GET, 'C_VISIT');
        $C_CVST = filter_input(INPUT_GET, 'C_CVST');
        $ACCION = filter_input(INPUT_GET, 'ACCION');
        $C_MOTIV = filter_input(INPUT_GET, 'C_MOTIV');
        $D_FECH = filter_input(INPUT_GET, 'C_VD');
        $D_PROM = filter_input(INPUT_GET, 'D_PROMv');
        $N_PROM0 = filter_input(INPUT_GET, 'N_PROMv');
        $D_PAGO = filter_input(INPUT_GET, 'D_PAGOv');
        $N_PAGO = filter_input(INPUT_GET, 'N_PAGOv');
        $C_PROM = filter_input(INPUT_GET, 'C_PROM');
        $C_NTEL = filter_input(INPUT_GET, 'C_NTEL');
        $C_NDIR = filter_input(INPUT_GET, 'C_NDIR');
        $C_EMAIL = filter_input(INPUT_GET, 'C_EMAIL');
        $C_OBSE2 = filter_input(INPUT_GET, 'C_OBSE2');
        $C_EJE = filter_input(INPUT_GET, 'C_EJE');
        if (empty($N_PROM0)) {
            $N_PROM0 = 0;
        }
        $N_PROM = $rc->demonetize($N_PROM0);
        $C_FREQ = filter_input(INPUT_GET, 'C_FREQ');
        $gc->doVisit($get);
    }
} else {
    $flagmsg = "Acceso sin autorización";
    include 'views/resumenErrorView.php';
    exit();
}
if ($go == 'NUEVOS') {
    $C_CONT = filter_input(INPUT_GET, 'C_CONT', FILTER_VALIDATE_INT);
    $C_NTEL = filter_input(INPUT_GET, 'C_NTEL');
    $C_NDIR = trim(filter_input(INPUT_GET, 'C_NDIR'));
    $C_OBSE2 = filter_input(INPUT_GET, 'C_OBSE2');
    if (!empty($C_NTEL)) {
        $gc->addNewTel($C_CONT, $C_NTEL);
    }
    if (!empty($C_NDIR)) {
        $gc->updateAddress($C_CONT, $C_NDIR);
    }
    if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
        $gc->addNewTel($C_CONT, $C_OBSE2);
    }
//$redirector = "Location: resumen.php?&capt=".$capt."&go=ULTIMA";
    $redirector = "Location: resumen.php?&capt=" . $capt;
    header($redirector);
}
if ($go == 'GUARDAR' && !empty($get['C_CVST'])) {
    $oldgo = filter_input(INPUT_GET, 'oldgo');
    $error = 0;
    $flag = filter_input(INPUT_GET, 'error');
    $C_CVGE = filter_input(INPUT_GET, 'C_CVGE');
    $AUTH = filter_input(INPUT_GET, 'AUTH');
    if ($C_CVGE != $capt) {
        $AUTH = $capt;
    }
    if ($mytipo == 'admin') {
        $AUTH = $capt;
    }
    if (empty($AUTH)) {
        $AUTH = '';
    }
    $C_CONT = filter_input(INPUT_GET, 'C_CONT');
    $C_CVST = filter_input(INPUT_GET, 'C_CVST');
    $C_CVBA = filter_input(INPUT_GET, 'C_CVBA');
    $ACCION = filter_input(INPUT_GET, 'ACCION');
    $C_MOTIV = filter_input(INPUT_GET, 'C_MOTIV');
    $D_FECH = filter_input(INPUT_GET, 'D_FECH');
    $C_HRIN = filter_input(INPUT_GET, 'C_HRIN');
    $C_HRFI = date('H:i:s');
    $C_TELE = filter_input(INPUT_GET, 'C_TELE');
    $CUANDO = filter_input(INPUT_GET, 'CUANDO');
    $CUENTA = filter_input(INPUT_GET, 'CUENTA');
    $C_OBSE1 = utf8_decode(strtoupper(filter_input(INPUT_GET, 'C_OBSE1')));
    $C_ATTE = filter_input(INPUT_GET, 'C_ATTE');
    $C_CNP = filter_input(INPUT_GET, 'C_CNP');
    $C_CONTAN = filter_input(INPUT_GET, 'C_CONTAN');
    $C_CARG = utf8_encode(filter_input(INPUT_GET, 'C_CARG'));
    $C_CAMP = filter_input(INPUT_GET, 'camp', FILTER_VALIDATE_INT);
    $D_PROM1 = filter_input(INPUT_GET, 'D_PROM1');
    $D_PROM2 = filter_input(INPUT_GET, 'D_PROM2');
    $D_PROM3 = filter_input(INPUT_GET, 'D_PROM3');
    $D_PROM4 = filter_input(INPUT_GET, 'D_PROM4');
    $D_PAGO = filter_input(INPUT_GET, 'D_PAGO');
    $N_PAGO = filter_input(INPUT_GET, 'N_PAGO', FILTER_VALIDATE_FLOAT);
    if (filter_has_var(INPUT_GET, 'D_MERC')) {
        $D_MERC = filter_input(INPUT_GET, 'D_MERC');
    } else {
        $D_MERC = '';
    }
    $C_PROM = filter_input(INPUT_GET, 'C_PROM');
    $N_PROM_OLD = filter_input(INPUT_GET, 'N_PROM_OLD', FILTER_VALIDATE_FLOAT);
    $N_PROM1 = filter_input(INPUT_GET, 'N_PROM1', FILTER_VALIDATE_FLOAT);
    $N_PROM2 = filter_input(INPUT_GET, 'N_PROM2', FILTER_VALIDATE_FLOAT);
    $N_PROM3 = filter_input(INPUT_GET, 'N_PROM3', FILTER_VALIDATE_FLOAT);
    $N_PROM4 = filter_input(INPUT_GET, 'N_PROM4', FILTER_VALIDATE_FLOAT);
    $N_PROM = $N_PROM1 + $N_PROM2 + $N_PROM3 + $N_PROM4;
    $C_NTEL = filter_input(INPUT_GET, 'C_NTEL');
    $C_NDIR = filter_input(INPUT_GET, 'C_NDIR');
    $C_EMAIL = trim(filter_input(INPUT_GET, 'C_EMAIL'));
    $C_OBSE2 = filter_input(INPUT_GET, 'C_OBSE2');
    $C_EJE = filter_input(INPUT_GET, 'C_EJE');
    $D_PROM = $D_PROM1;
    $flagmsg = "";
    $necesitanMontoPago = [
        'PAGANDO CONVENIO',
        'PAGO DE CONVENIO',
        'PAGO TOTAL',
        'PAGO PARCIAL'
    ];
    $necesitanMontoPromesa = [
        'PROMESA DE PAGO TOTAL',
        'PROMESA DE PAGO PARCIAL'
    ];
    if (($N_PAGO == 0) && (in_array($C_CVST, $necesitanMontoPago))) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if ((substr($C_CVST, 0, 11) == 'MENSAJE CON') && ($C_CARG == '')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "MENSAJE NECESITA PARENTESCO/CARGO";
    }
    if (($N_PROM == 0) && (in_array($C_CVST, $necesitanMontoPromesa))) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
    }
    if (($N_PROM > 0) && ($D_PROM == '0000-00-00')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA FECHA";
    }
    if (($N_PAGO > 0) && ($D_PAGO == '0000-00-00')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PAGO NECESITA FECHA";
    }
    if (($N_PROM > 0) && ($D_PROM == '')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA FECHA";
    }
    if (($N_PROM == 0) && ($D_PROM >= $D_FECH)) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
    }
    if (($N_PAGO == 0) && ($D_PAGO > '0000-00-00')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PAGO NECESITA MONTO";
    }
    if (($N_PROM1 == 0) && ($N_PROM2 > 0)) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "USA PROMESA INICIAL ANTES PROMESA TERMINAL";
    }
    if ($C_TELE == '') {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "GESTION NECESITA TELEFONO";
    }
$gestion = new GestionObject();
    $gestion->C_CVBA	=	$C_CVBA;
    $gestion->C_CVGE	=	$C_CVGE;
    $gestion->C_CONT	=	$C_CONT;
    $gestion->C_CVST	=	$C_CVST;
    $gestion->D_FECH	=	$D_FECH;
    $gestion->C_HRIN	=	$C_HRIN;
    $gestion->C_HRFI	=	$C_HRFI;
    $gestion->C_TELE	=	$C_TELE;
    $gestion->CUANDO	=	$CUANDO;
    $gestion->CUENTA	=	$CUENTA;
    $gestion->C_OBSE1	=	$C_OBSE1;
    $gestion->C_ATTE	=	$C_ATTE;
    $gestion->C_CARG	=	$C_CARG;
    $gestion->D_PROM	=	$D_PROM;
    $gestion->N_PROM	=	$N_PROM;
    $gestion->C_PROM	=	$C_PROM;
    $gestion->D_PROM1	=	$D_PROM1;
    $gestion->N_PROM1	=	$N_PROM1;
    $gestion->D_PROM2	=	$D_PROM2;
    $gestion->N_PROM2	=	$N_PROM2;
    $gestion->D_PROM3	=	$D_PROM3;
    $gestion->N_PROM3	=	$N_PROM3;
    $gestion->D_PROM4	=	$D_PROM4;
    $gestion->N_PROM4	=	$N_PROM4;
    $gestion->C_CONTAN	=	$C_CONTAN;
    $gestion->ACCION	=	$ACCION;
    $gestion->C_CNP	=	$C_CNP;
    $gestion->C_MOTIV	=	$C_MOTIV;
    $gestion->C_CAMP	=	$C_CAMP;
    $gestion->C_NTEL	=	$C_NTEL;
    $gestion->C_NDIR	=	$C_NDIR;
    $gestion->C_EMAIL	=	$C_EMAIL;
    $gestion->C_OBSE2	=	$C_OBSE2;
    $gestion->C_EJE	=	$C_EJE;
    $gestion->AUTH	=	$AUTH;

    if ($error == 0) {
        $pdo->beginTransaction();
        $gc->insertGestion($gestion);
        $gc->addHistoriaGestion($C_CVGE, $C_CONT, $D_FECH, $C_HRIN, $C_HRFI);
        if ($N_PAGO > 0) {
            $who = $gc->attributePayment($capt, $C_CONT);
            $gc->addPago($C_CONT, $D_PAGO, $N_PAGO, $who);
        }
        $gc->updateAllUltimoPagos();
        $best = $C_CVST;
        $best = $rc->getBest($C_CVST, $C_CONT);
        $gc->resumenStatusUpdate($C_CONT, $best);
        if (!empty($C_NTEL)) {
            $gc->addNewTel($C_CONT, $C_NTEL);
        }
        if (!empty($C_EMAIL)) {
            $gc->updateEmail($C_CONT, $C_EMAIL);
        }
        if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
            $gc->addNewTel($C_CONT, $C_OBSE2);
        }
        $pdo->commit();
        if ($N_PAGO > 0) {
            $who = $gc->attributePayment($capt, $C_CONT);
            $gc->addPago($C_CONT, $D_PAGO, $N_PAGO, $who);
        }
        $gc->updateAllUltimoPagos();

        if ($find == "/") {
            $find = NULL;
        }
        if ($capt == "/") {
            $capt = NULL;
        }
//}
        $redirector = "Location: resumen.php?capt=" . $capt;
        $fromelastix = (!empty($get['elastix']));
        if ($fromelastix) {
            $redirector = "Location: resumen.php?shutup=yes&capt=" . $capt;
        }
        header($redirector);
    } else {
        include 'views/resumenErrorView.php';
    }
}
$mynombre = '';
$userData = $rc->getUserData($capt);
if ($userData) {
    $mynombre = $userData['usuaria'];
    $mytipo = $userData['tipo'];
    $camp = $userData['camp'];
}
$id_cuenta = 0;
$qCount = 0;
$lockFlag = 0;
$sdc = '';
$cr = '';
$newQueue = $qc->getMyQueue($capt, $camp);
if ($newQueue) {
    $cliente = $newQueue['cliente'];
    $sdc = $newQueue['sdc'];
    $cr = $newQueue['cr'];
}
if (isset($cr)) {
    $codres = ' AND queue="' . $cr . '" ';
} else {
    $codres = '';
    $cr = '';
}
if ($cr == '') {
    $camp = 0;
}

list($row, $result) = $qc->getNextGestion($camp, $sdc, $cr, $cliente, $capt, $go, $find);

if ($result) {
    $row = mysqli_fetch_row($result);
}
$nombre_deudor = $row[0];
$domicilio_deudor = $row[1];
$colonia_deudor = $row[2];
$ciudad_deudor = $row[3];
$estado_deudor = $row[4];
$cp_deudor = $row[5];
$tel_1 = $row[8];
$tel_2 = $row[9];
$tel_3 = $row[10];
$tel_4 = $row[11];
$nombre_deudor_alterno = $row[12];

$domicilio_deudor_alterno = $row[13];
$colonia_deudor_alterno = $row[14];
$ciudad_deudor_alterno = $row[15];
$estado_deudor_alterno = $row[16];
$cp_deudor_alterno = $row[17];
$tel_1_alterno = $row[18];
$tel_2_alterno = $row[19];
$tel_3_alterno = $row[20];
$tel_4_alterno = $row[21];
$plazo = $row[22];
$dia_corte = $row[23];
$status_aarsa = $row[24];
$avapar = $row[25];
$referencias_1 = $row[26];
$nombre_referencia_1 = $row[27];
$domicilio_referencia_1 = $row[28];
$colonia_referencia_1 = $row[29];
$ciudad_referencia_1 = $row[30];
$estado_referencia_1 = $row[31];
$cp_referencia_1 = $row[32];
$tel_1_ref_1 = $row[33];
$tel_2_ref_1 = $row[34];
$referencias_2 = $row[35];
$nombre_referencia_2 = $row[36];
$domicilio_referencia_2 = $row[37];
$colonia_referencia_2 = $row[38];
$ciudad_referencia_2 = $row[39];
$estado_referencia_2 = $row[40];
$cp_referencia_2 = $row[41];
$tel_1_ref_2 = $row[42];
$tel_2_ref_2 = $row[43];
$referencias_3 = $row[44];
$nombre_referencia_3 = $row[45];
$domicilio_referencia_3 = $row[46];
$colonia_referencia_3 = $row[47];
$ciudad_referencia_3 = $row[48];
$estado_referencia_3 = $row[49];
$cp_referencia_3 = $row[50];
$tel_1_ref_3 = $row[51];
$tel_2_ref_3 = $row[52];
$referencias_4 = $row[53];
$nombre_referencia_4 = $row[54];
$domicilio_deudor_2 = $row[55];
$frecuencia = $row[56];
$ciudad_referencia_4 = $row[57];
$estado_referencia_4 = $row[58];
$cp_referencia_4 = $row[59];
$tel_1_ref_4 = $row[60];
$tel_2_ref_4 = $row[61];
$domicilio_laboral = $row[62];
$colonia_laboral = $row[63];
$ciudad_laboral = $row[64];
$estado_laboral = $row[65];
$cp_laboral = $row[66];
$tel_1_laboral = $row[67];
$tel_2_laboral = $row[68];
$gastos_de_cobranza = $row[69];
$fecha_de_actualizacion = $row[70];
$numero_de_cuenta = $row[71];
$numero_de_credito = $row[72];
$contrato = $row[73];
$saldo_total = $row[74];
$saldo_vencido = $row[75];
$saldo_descuento_1 = $row[76];
$saldo_descuento_2 = $row[77];
$fecha_corte = $row[78];
$fecha_1er_pago = $row[79];
$fecha_de_ultimo_pago = $row[80];
$monto_ultimo_pago = $row[81];
$producto = $row[82];
$subproducto = $row[83];
$cliente = $row[84];
$status_de_credito = $row[85];
if (empty($status_de_credito)) {
    $status_de_credito = '';
}
$pagos_vencidos = $row[86];
$monto_adeudado = $row[87];
$fecha_de_asignacion = $row[88];
$fecha_de_deasignacion = $row[89];
$cuenta_concentradora_1 = $row[90];
$saldo_cuota = $row[91];
if (empty($saldo_cuota)) {
    $saldo_cuota = 0;
}
$email_deudor = $row[92];
if (isset($row[93])) {
    $id_cuenta = $row[93];
    $rc->setSlice($capt, $id_cuenta);
}
$nss = $row[94];
$rfc_deudor = $row[95];
$telefonos_marcados = $row[96];
$tel_1_verif = $row[97];
$tel_2_verif = $row[98];
$tel_3_verif = $row[99];
$tel_4_verif = $row[100];
$telefono_de_ultimo_contacto = $row[101];
$dias_vencidos = $row[102];
$ejecutivo_asignado_call_center = $row[103];
$ejecutivo_asignado_domiciliario = $row[104];
$prioridad_de_gestion = $row[105];
$NRPP = $row[106];
$parentesco_aval = $row[107];
$localizar = $row[108];
$campo_libre_9 = $row[109];
$empresa = $row[110];
$fecha_convenio = $row[113];
$direccion_nueva = $row[115];

list($C_OBSE2, $ultimo_status_de_la_gestion, $CUANDO) = $rc->getLastData($id_cuenta);

if ($id_cuenta == 0) {
    $newCamp = $qc->getNewCamp($capt);
    $qc->updateQueue($newCamp, $capt);
}

list($N_PROM_OLD, $N_PROM1_OLD, $N_PROM2_OLD, $N_PROM3_OLD, $N_PROM4_OLD) = array_fill(1, 5, 0);
list($D_PROM_OLD, $D_PROM1_OLD, $D_PROM2_OLD, $D_PROM3_OLD, $D_PROM4_OLD) = array_fill(1, 5, '');

if ($id_cuenta > 0) {
    list($N_PROM_OLD, $N_PROM1_OLD, $N_PROM2_OLD, $N_PROM3_OLD, $N_PROM4_OLD,
        $D_PROM_OLD, $D_PROM1_OLD, $D_PROM2_OLD, $D_PROM3_OLD, $D_PROM4_OLD) = $rc->getOldProms($id_cuenta);
}

$nmerc = 0;
$timelock = '';
$locker = '';
$sofar = 0;
$answerCheck = $rc->getTimeCheck($id_cuenta);
if ($answerCheck) {
    $timelock = $answerCheck['timelock'];
    $locker = $answerCheck['locker'];
    $sofar = $answerCheck['sofar'];
}
$tl = date('r');
if ($mytipo != 'admin') {
    if (!(empty($locker)) && ($locker != $capt)) {
        $lockFlag = 1;
    } else {
        $rc->setLocks($capt, $id_cuenta, $mytipo);
        $tl = $rc->getTimelock($id_cuenta);
    }
}

if ($mytipo == 'admin') {
    $dday = date("Y-m-d", strtotime("+1 month"));
    $dday2 = date("Y-m-d", strtotime("+1 month"));
} else {
    $dday = date("Y-m-d", strtotime("+1 week"));
    $dday2 = date("Y-m-d", strtotime("+15 day"));
}
$CD = date("Y-m-d");
$CT = date("H:i:s");
$others = 0;

$resultfilt = $rc->getQueueList($capt);

$resultng = $rc->getNumGestiones($capt);

$querynp = "SELECT count(1) as cnp FROM historia 
WHERE c_cvge=:capt 
AND n_prom > 0 
AND d_fech=curdate()
AND c_cont <> 0
";
$stp = $pdo->prepare($querynp);
$stp->bindParam(':capt', $capt);
$stp->execute();
$resultnp = $stp->fetch();

$clientes = $rc->getClientList();

switch ($mytipo) {
    case 'admin':
        $resultAccion = $rc->getAccion();
        break;
    case 'visitador':
        $resultAccion = $rc->getAccionV();
        break;
    default:
        $resultAccion = $rc->getAccionCallcenter();
}



$resultMotiv = $rc->getMotiv();

$resultDictamen = $rc->getDict($mytipo);

$resultAccionV = $rc->getAccionV();

$resultDictamenV = $rc->getDictV();

$resultMotivV = $rc->getMotivV();

$resultGestorV = $rc->getVisitadorList();

$resultGestor = $rc->getGestorList();

if ($id_cuenta > 0) {
    $rowSub = $rc->getHistory($id_cuenta);
}

$t1 = '';
$t2 = '';
$t3 = '';
$t4 = '';
$t1r = '';
$t2r = '';
$t3r = '';
$t4r = '';
$t1r1 = '';
$t2r1 = '';
$t1r2 = '';
$t2r2 = '';
$t1r3 = '';
$t2r3 = '';
$t1r4 = '';
$t2r4 = '';
$t1l = '';
$t2l = '';
$t1v = '';
$t2v = '';
$t3v = '';
$t4v = '';
$tuc = '';
$resultBadNo = $rc->getBadNo($id_cuenta);
foreach ($resultBadNo as $answerBadNo) {
    $t1 = $answerBadNo[0];
    $t2 = $answerBadNo[1];
    $t3 = $answerBadNo[2];
    $t4 = $answerBadNo[3];
    $t1r = $answerBadNo[4];
    $t2r = $answerBadNo[5];
    $t3r = $answerBadNo[6];
    $t4r = $answerBadNo[7];
    $t1r1 = $answerBadNo[8];
    $t2r1 = $answerBadNo[9];
    $t1r2 = $answerBadNo[10];
    $t2r2 = $answerBadNo[11];
    $t1r3 = $answerBadNo[12];
    $t2r3 = $answerBadNo[13];
    $t1r4 = $answerBadNo[14];
    $t2r4 = $answerBadNo[15];
    $t1l = $answerBadNo[16];
    $t2l = $answerBadNo[17];
    $t1v = $answerBadNo[18];
    $t2v = $answerBadNo[19];
    $t3v = $answerBadNo[20];
    $t4v = $answerBadNo[21];
    $tuc = $answerBadNo[22];
}

$resultCnp = $rc->getCnp();

$hasPic = FALSE;
$picFile = '';
$path = dirname(__FILE__) . '/pics/' . $numero_de_cuenta . '.jpg';
if (realpath($path)) {
    $hasPic = TRUE;
    $picFile = 'pics/' . $numero_de_cuenta . '.jpg';
}
$gestiones = $rc->countGestiones($id_cuenta);
$promesas = $rc->countPromesas($id_cuenta);
$pagos = $rc->countPagos($id_cuenta);
include 'views/resumenView.php';
