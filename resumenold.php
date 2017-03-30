<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\GestionClass;

$get = filter_input_array(INPUT_GET);
date_default_timezone_set('America/Monterrey');
setlocale(LC_MONETARY, 'en_US');

function highhist($stat, $visit) {
    $highstr = '';
    if (($stat == 'PROMESA DE PAGO TOTAL') || ($stat == 'PROMESA DE PAGO PARCIAL') || ($stat == 'CLIENTE NEGOCIANDO')) {
        $highstr = " class='deudor'";
    }
    if (!empty($visit)) {
        $highstr = " class='visit'";
    }
    return $highstr;
}

require_once 'classes/PdoClass.php';
require_once 'classes/GestionClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$con = $pdoc->dbConnectUserMysqli();
$gc = new GestionClass($pdo);
$capt = $pdoc->capt;
$mytipo = $pdoc->tipo;
/*
  if ($detect->isMobile()) {
  header("Location: resumen-mobile.php?capt=" . $capt);
  }
 */
$tcapt = $capt;
$C_CVGE = $capt;
if (!empty($mytipo)) {
    $oldgo = '';

    $go = filter_input(INPUT_GET, 'go');
    if ($go == 'ULTIMA') {
        $find = 0;
        $queryult = "SELECT c_cont FROM historia WHERE c_cvge = :capt "
                . "and c_cont <> '0' ORDER BY d_fech desc, c_hrfi desc LIMIT 1";
        $stu = $pdo->prepare($queryult);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
        $resultult = $stu->fetch(PDO::FETCH_ASSOC);
        if ($resultult) {
            $find = $resultult['c_cont'];
        }
        $redirector = "Location: resumen.php?capt=$capt&find=$find&field=id_cuenta&go=FROMULTIMA";
        header($redirector);
    }
    $getupdate = isset($get['find']);
    $isoldid = isset($get['id_cuenta']);
    if ($getupdate) {
        $findg = filter_input(INPUT_GET, 'find');
        $findu = mysqli_real_escape_string($con, $findg);
        if (isset($get['field'])) {
            $field = mysqli_real_escape_string($con, $get['field']);
        } else {
            $field = 'id_cuenta';
        }
//   $capt = mysqli_real_escape_string($con,$get['capt']);
        // We perform a bit of filtering
        $findU = strtoupper($findu);
        $findS = strip_tags($findU);
        $find = trim($findS);
    }

    $pagalert = 0;
    $querypagos = "select (c_cvst like 'PAG%'),c_cont from historia 
where c_cvge='" . $capt . "' and d_fech=curdate() and c_cvst like 'PAG%'
and (cuenta,c_cvba) not in (select cuenta,cliente from pagos)
order by d_fech desc,c_hrin desc limit 1";
    $resultpagos = mysqli_query($con, $querypagos) or die("ERROR RM1 - " . mysqli_error($con));
    while ($answerpagos = mysqli_fetch_row($resultpagos)) {
        $pagalert = $answerpagos[0];
        $pagid = $answerpagos[1];
        if (empty($pagalert)) {
            $pagalert = 0;
        }
        if ($mytipo == 'visitador') {
            $pagalert = 0;
        }
    }

    $notalert = '';
    $querynotas = "select min(concat_ws(' ',fecha,hora)<now()),min(concat_ws(' ',fecha,hora))
from notas 
where c_cvge='" . $capt . "' AND borrado=0 and fecha<>'0000-00-00'
AND concat_ws(' ',fecha,hora)<now()";
    $resultnotas = $pdo->query($querynotas);
    foreach ($resultnotas as $answernotas) {
        $notalert = $answernotas[0];
        $notalertt = $answernotas[1];
    }
    if (empty($notalert)) {
        $notalert = 0;
    } else {
        $querynotas2 = "select cuenta,nota,fuente
from notas 
where (c_cvge='" . $capt . "' OR c_cvge='todos')
AND borrado=0 AND concat(fecha,' ',hora)='" . $notalertt . "' LIMIT 1;";
        $resultnotas2 = mysqli_query($con, $querynotas2) or die("ERROR RM3 - " . mysqli_error($con));
        while ($answernotas2 = mysqli_fetch_row($resultnotas2)) {
            $alertcuenta = $answernotas2[0];
            $alertnota = $answernotas2[1];
            $alertfuente = $answernotas2[2];
        }
    }

    if ($go == 'LOGOUT') {
        $page = "Location: logout.php?gone=&capt=" . $capt;
        header($page);
    }

    if (($go == 'CAPTURADO') && (!empty($get['C_CVST']))) {
        $C_HRIN = mysqli_real_escape_string($con, $get['C_VH']) . ':' . mysqli_real_escape_string($con, $get['C_VMN']);
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
        $N_PROM = str_replace('$', '', $N_PROM0);
        $C_FREQ = filter_input(INPUT_GET, 'C_FREQ');
        $MERCv = filter_input(INPUT_GET, 'MERCv', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $gc->doVisit($get);
    }
} else {
    $flagmsg = "Acceso sin autorizaci&oacute;n";
    include 'resumenErrorView.php';
    exit();
}
if ($go == 'NUEVOS') {
    $C_CONT = mysqli_real_escape_string($con, $get['C_CONT']);
    $C_NTEL = mysqli_real_escape_string($con, $get['C_NTEL']);
    $C_NDIR = trim(mysqli_real_escape_string($con, $get['C_NDIR']));
    $C_OBSE2 = mysqli_real_escape_string($con, $get['C_OBSE2']);
    if (!empty($C_NTEL)) {
        $queryntel = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=" . $C_NTEL . " WHERE id_cuenta='" . $C_CONT . "'";
        mysqli_query($con, $queryntel) or die("ERROR RM17 - " . mysqli_error($con));
    }
    if (!empty($C_NDIR)) {
        $queryndir = "UPDATE resumen SET direccion_nueva='" . $C_NDIR . "' WHERE id_cuenta='" . $C_CONT . "'";
        mysqli_query($con, $queryndir) or die("ERROR RM18 - " . mysqli_error($con));
    }
    if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
        $querymemo = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=" . $C_OBSE2 . " WHERE id_cuenta='" . $C_CONT . "'";
        mysqli_query($con, $querymemo) or die("ERROR RM19 - " . mysqli_error($con));
    }
    if ($merciv > 0) {
        foreach ($MERCv as $MERCa) {
            if (!empty($MERCa)) {
                $queryins = "INSERT INTO sdhmerc (ID_CUENTA,MERC,FECHAMERC,FECHACAPT) 
    VALUES (" . $C_CONT . ",'" . $MERCa . "','" . $D_MERC . "',now())";
                mysqli_query($con, $queryins) or die("ERROR RM20 - " . mysqli_error($con));
            }
        }
    }
//$redirector = "Location: resumen.php?&capt=".$capt."&go=ULTIMA";
    $redirector = "Location: resumen.php?&capt=" . $capt;
    header($redirector);
}
if ($go == 'GUARDAR' && !empty($get['C_CVST'])) {
    $oldgo = mysqli_real_escape_string($con, $get['oldgo']);
    $error = 0;
    $flag = mysqli_real_escape_string($con, $get['error']);
    $C_CVGE = mysqli_real_escape_string($con, urldecode($get['C_CVGE']));
    $AUTH = mysqli_real_escape_string($con, $get['AUTH']);
    if ($C_CVGE != $capt) {
        $AUTH = $capt;
    }
    if ($mytipo == 'admin') {
        $AUTH = $capt;
    }
    if (empty($AUTH)) {
        $AUTH = '';
    }
    $C_CONT = mysqli_real_escape_string($con, $get['C_CONT']);
    $C_CVST = mysqli_real_escape_string($con, urldecode($get['C_CVST']));
    $C_CVBA = mysqli_real_escape_string($con, urldecode($get['C_CVBA']));
    $ACCION = mysqli_real_escape_string($con, urldecode($get['ACCION']));
    $C_MOTIV = mysqli_real_escape_string($con, urldecode($get['C_MOTIV']));
    $D_FECH = mysqli_real_escape_string($con, $get['D_FECH']);
    $C_HRIN = mysqli_real_escape_string($con, $get['C_HRIN']);
    $C_HRFI = date('H:i:s');
    $C_TELE = mysqli_real_escape_string($con, $get['C_TELE']);
    $CUANDO = mysqli_real_escape_string($con, $get['CUANDO']);
    $CUENTA = mysqli_real_escape_string($con, $get['CUENTA']);
    $C_OBSE1 = utf8_decode(strtoupper(mysqli_real_escape_string($con, $get['C_OBSE1'])));
    $C_ATTE = mysqli_real_escape_string($con, $get['C_ATTE']);
    $C_CNP = mysqli_real_escape_string($con, $get['C_CNP']);
//$C_CREJ=mysqli_real_escape_string($con,$get['C_CREJ']);
//$C_CPAT=mysqli_real_escape_string($con,$get['C_CPAT']);
    $C_CONTAN = mysqli_real_escape_string($con, urldecode($get['C_CONTAN']));
    $C_CARG = utf8_encode(mysqli_real_escape_string($con, urldecode($get['C_CARG'])));
    $C_CAMP = mysqli_real_escape_string($con, $get['camp']);
    $D_PROM1 = mysqli_real_escape_string($con, $get['D_PROM1']);
    $D_PROM2 = mysqli_real_escape_string($con, $get['D_PROM2']);
    $D_PROM3 = mysqli_real_escape_string($con, $get['D_PROM3']);
    $D_PROM4 = mysqli_real_escape_string($con, $get['D_PROM4']);
    $D_PAGO = mysqli_real_escape_string($con, $get['D_PAGO']);
    $N_PAGO = mysqli_real_escape_string($con, $get['N_PAGO']);
    if (isset($get['D_MERC'])) {
        $D_MERC = mysqli_real_escape_string($con, $get['D_MERC']);
    } else {
        $D_MERC = '';
    }
    if (isset($get['MERC'])) {
        for ($merci = 0; $merci < count($get['MERC']); $merci++) {
            $MERC[$merci] = mysqli_real_escape_string($con, $get['MERC'][$merci]);
        }
    }
    $C_PROM = mysqli_real_escape_string($con, $get['C_PROM']);
    $N_PROM_OLD = mysqli_real_escape_string($con, $get['N_PROM_OLD']);
    $N_PROM1 = mysqli_real_escape_string($con, $get['N_PROM1']);
    $N_PROM2 = mysqli_real_escape_string($con, $get['N_PROM2']);
    $N_PROM3 = mysqli_real_escape_string($con, $get['N_PROM3']);
    $N_PROM4 = mysqli_real_escape_string($con, $get['N_PROM4']);
    $N_PROM = $N_PROM1 + $N_PROM2 + $N_PROM3 + $N_PROM4;
//$C_FREQ=mysqli_real_escape_string($con,$get['C_FREQ']);
    $C_NTEL = mysqli_real_escape_string($con, $get['C_NTEL']);
    $C_NDIR = mysqli_real_escape_string($con, $get['C_NDIR']);
    $C_EMAIL = trim(mysqli_real_escape_string($con, $get['C_EMAIL']));
    $C_OBSE2 = mysqli_real_escape_string($con, $get['C_OBSE2']);
    $C_EJE = mysqli_real_escape_string($con, $get['C_EJE']);
    $montomax = 0;
    $fechamin = '2020-12-31';
    $fechamax = '2007-01-01';
    $queryult = "select max(n_prom),min(d_prom),max(d_prom) from historia where c_cont='" . $C_CONT . "' and n_prom>0;";
    $resultult = mysqli_query($con, $queryult) or die("ERROR RM21 - " . mysqli_error($con));
    while ($answerult = mysqli_fetch_row($resultult)) {
        $montomax = max($answerult[0], 0);
        $fechamin = $answerult[1];
        $fechamax = $answerult[2];
    }
    $D_PROM = $D_PROM1;
    $flagmsg = "";
    $querydup = "SELECT count(1) FROM historia 
WHERE c_cont=" . $C_CONT . " and d_fech='" . $D_FECH . "' 
and c_hrin='" . $C_HRIN . "' and c_cvst='" . $C_CVST . "' 
and c_cvge='" . $C_CVGE . "' and c_obse1='" . $C_OBSE1 . "';";
    $resultdup = mysqli_query($con, $querydup) or die("ERROR RM23 - " . mysqli_error($con));
    while ($answerdup = mysqli_fetch_row($resultdup)) {
        $error = $error + $answerdup[0];
        $flagmsg = "DOBLE ENTRANTE";
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGANDO CONVENIO J')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGANDO CONVENIO')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGO DE CONVENIO J')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGO DE CONVENIO')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGO TOTAL J')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGO TOTAL')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGO PARCIAL')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if (($N_PAGO == 0) && ($C_CVST == 'PAGO PARCIAL J')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
    }
    if ((substr($C_CVST, 0, 11) == 'MENSAJE CON') && ($C_CARG == '')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "MENSAJE NECESITA PARENTESCO/CARGO";
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROMESA DE PAGO TOTAL')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROMESA DE PAGO TOTAL J')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROMESA DE PAGO PARCIAL')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROMESA DE PAGO PARCIAL J')) {
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


    $qins = "INSERT INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
C_TELE,CUANDO,CUENTA,C_OBSE1,C_ATTE,C_CARG,D_PROM,N_PROM,C_PROM,
D_PROM1,N_PROM1,D_PROM2,N_PROM2,
D_PROM3,N_PROM3,D_PROM4,N_PROM4,
C_CONTAN,C_ACCION,C_CNP,C_MOTIV,C_CAMP,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE,AUTH) 
VALUES ('" . $C_CVBA . "','" .
            $C_CVGE . "','" .
            $C_CONT . "','" .
            $C_CVST . "',date('" .
            $D_FECH . "'),'" .
            $C_HRIN . "','" .
            $C_HRFI . "','" .
            $C_TELE . "','" .
            $CUANDO . "','" .
            $CUENTA . "','" .
            $C_OBSE1 . "','" .
            $C_ATTE . "','" .
            $C_CARG . "','" .
            $D_PROM . "','" .
            $N_PROM . "','" .
            $C_PROM . "','" .
            $D_PROM1 . "','" .
            $N_PROM1 . "','" .
            $D_PROM2 . "','" .
            $N_PROM2 . "','" .
            $D_PROM3 . "','" .
            $N_PROM3 . "','" .
            $D_PROM4 . "','" .
            $N_PROM4 . "','" .
            $C_CONTAN . "','" .
            $ACCION . "','" .
            $C_CNP . "','" .
            $C_MOTIV . "','" .
            $C_CAMP . "','" .
            $C_NTEL . "','" .
            $C_NDIR . "','" .
            $C_EMAIL . "','" .
            $C_OBSE2 . "','" .
            $C_EJE . "','" .
            $AUTH . "')";
    if ($error == 0) {
        mysqli_autocommit($con, FALSE);
        $queryins = str_replace(';', ' ', $qins);
        mysqli_query($con, $queryins) or die("ERROR RM24 - " . mysqli_error($con));
        $querygest = "INSERT ignore INTO histgest (auto,c_cvge) SELECT auto,'" . $C_CVGE . "' 
FROM historia 
WHERE c_cont=" . $C_CONT . " AND d_fech='" . $D_FECH . "'
AND c_hrin='" . $C_HRIN . "' AND c_hrfi='" . $C_HRFI . "'
;";
        mysqli_query($con, $querygest) or die("ERROR RM24a - " . mysqli_error($con));
        if ($N_PAGO > 0) {
            $who = $capt;
            $queryd = "select c_cvge from historia where n_prom>0 and c_cvge like 'PRO%'
    and c_cont=" . $C_CONT . " order by d_fech desc, c_hrin desc limit 1;";
            $resultd = mysqli_query($con, $queryd) or die("ERROR RM30 - " . mysqli_error($con));
            while ($rowd = mysqli_fetch_row($resultd)) {
                $who = $rowd[0];
            }
            $queryins = "INSERT IGNORE INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT numero_de_cuenta,'$D_PAGO','$N_PAGO',cliente,'$who',numero_de_credito,id_cuenta 
    FROM resumen WHERE id_cuenta=$C_CONT and (numero_de_cuenta,'$D_PAGO','$N_PAGO') not in (select cuenta,fecha,monto from pagos)";
            mysqli_query($con, $queryins) or die("ERROR RM31 - " . mysqli_error($con));

            $querylast = "select fecha,monto from pagos where (cuenta,cliente,fecha) in (select cuenta,cliente,max(fecha) from pagos where id_cuenta=" . $C_CONT . " group by id_cuenta);";
            $resultlast = mysqli_query($con, $querylast) or die("ERROR RM32 - " . mysqli_error($con));
            while ($answerlast = mysqli_fetch_row($resultlast)) {
                $mfecha = $answerlast[0];
                $mmonto = $answerlast[1];
            }
        }
        $querypupa = "update resumen,pagos set fecha_de_ultimo_pago=fecha,monto_ultimo_pago=monto 
where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta;";
        mysqli_query($con, $querypupa) or die("ERROR RM32a - " . mysqli_error($con));
        $best = $C_CVST;
        $querybest = "select c_cvst,v_cc from historia,dictamenes 
where v_cc=
(select min(v_cc) from historia,dictamenes where c_cont=" . $C_CONT . " 
and c_cvst=dictamen and left(c_cvba,2)=left('" . $C_CVBA . "',2)) 
and c_cont=" . $C_CONT . " and left(c_cvba,2)=left('" . $C_CVBA . "',2)
and (d_prom1>=curdate() or d_prom2>=curdate() or n_prom=0)
and c_cvst=dictamen;";
        $resultbest = mysqli_query($con, $querybest) or die("ERROR RM25 - " . mysqli_error($con));
        while ($answerbest = mysqli_fetch_row($resultbest)) {
            $best = $answerbest[0];
        }
//$querysa = "update resumen set status_aarsa='".$best."', especial=1,fecha_ultima_gestion=now() where id_cuenta='".$C_CONT."';";;
        $querysa = "update resumen set status_aarsa='" . $best . "',fecha_ultima_gestion=now() where id_cuenta='" . $C_CONT . "';";
        mysqli_query($con, $querysa) or die("ERROR RM26 - " . mysqli_error($con));
        $queryhot = "select c_cvst,v_cc from historia,dictamenes 
where c_cvst=dictamen and c_cont=" . $C_CONT . " and left(c_cvba,2)=left('" . $C_CVBA . "',2) 
and d_fech>last_day(curdate()-interval 1 month - interval 2 day)
order by v_cc LIMIT 1;";
        $resulthot = mysqli_query($con, $queryhot) or die("ERROR RM14a - " . mysqli_error($con));
        while ($answerhot = mysqli_fetch_row($resulthot)) {
            $hot = $answerhot[0];
        }
        $querysa = "update resumen set status_aarsa='" . $best . "' where id_cuenta=" . $C_CONT . ";";
        mysqli_query($con, $querysa) or die("ERROR RM15 - " . mysqli_error($con));
        $querysa3 = "update resumen set status_aarsa='" . $hot . "' 
where id_cuenta=" . $C_CONT . "
and cliente not like 'J%' and cliente not like '%JUR';";
        mysqli_query($con, $querysa3) or die("ERROR RM15c - " . mysqli_error($con));
        $querysa1 = "update cobracsi.resumen set status_aarsa='PROMESA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobracsi.historia where n_prom>0 
and d_prom>=curdate()) and cliente not like 'J%' and cliente not like '%JUR'
and id_cuenta in (select c_cont from cobracsi.historia where n_prom>0 
and d_prom<curdate()) 
and numero_de_cuenta not in 
(select cuenta from cobracsi.pagos where fecha>last_day(curdate()-interval 1 month)) 
and status_aarsa not regexp 'rota' and status_aarsa not regexp 'propuesta'
and (status_aarsa like 'PROMESA DE P%' or status_aarsa like 'CONFIRMA P%')
and id_cuenta=" . $C_CONT . ";";
        mysqli_query($con, $querysa1) or die("ERROR RM15a - " . mysqli_error($con));
        $querysa2 = "update resumen,dictamenes
set status_aarsa='PAGO DEL MES ANTERIOR' 
where status_aarsa=dictamen and cliente not like 'J%' and cliente not like '%JUR'
and queue='pagos'
and id_cuenta not in (
select c_cont from historia,dictamenes where c_cvst=dictamen
and queue='PAGOS'
and d_fech>last_day(curdate()-interval 1 month))
and id_cuenta not in (
select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and id_cuenta=" . $C_CONT . ";";
        mysqli_query($con, $querysa2) or die("ERROR RM15b - " . mysqli_error($con));
        if (!empty($C_NTEL)) {
            $queryntel = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=" . $C_NTEL . " WHERE id_cuenta='" . $C_CONT . "'";
            mysqli_query($con, $queryntel) or die("ERROR RM27 - " . mysqli_error($con));
        }
        if (!empty($C_EMAIL)) {
            $queryndir = "UPDATE resumen SET email_deudor='" . $C_EMAIL . "' WHERE id_cuenta='" . $C_CONT . "'";
            mysqli_query($con, $queryndir) or die("ERROR RM28 - " . mysqli_error($con));
        }
        if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
            $querymemo = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=" . $C_OBSE2 . " WHERE id_cuenta='" . $C_CONT . "'";
            mysqli_query($con, $querymemo) or die("ERROR RM29 - " . mysqli_error($con));
        }
        mysqli_commit($con);
        mysqli_autocommit($con, TRUE);
        if ($N_PAGO > 0) {
            $who = $capt;
            $queryd = "select c_cvge from historia where n_prom>0 and c_cvge like 'PRO%'
    and c_cont=" . $C_CONT . " order by d_fech desc, c_hrin desc limit 1;";
            $resultd = mysqli_query($con, $queryd) or die("ERROR RM30 - " . mysqli_error($con));
            while ($rowd = mysqli_fetch_row($resultd)) {
                $who = $rowd[0];
            }
            $queryins = "INSERT IGNORE INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,ID_CUENTA) 
    VALUES ('$CUENTA','$D_PAGO',$N_PAGO,'$C_CVBA','$who',$C_CONT)";
            mysqli_query($con, $queryins) or die("ERROR RM31 - " . mysqli_error($con));

            $querylast = "select fecha,monto from pagos where (cuenta,cliente,fecha) in (select cuenta,cliente,max(fecha) from pagos where id_cuenta=" . $C_CONT . " group by id_cuenta);";
            $resultlast = mysqli_query($con, $querylast) or die("ERROR RM32 - " . mysqli_error($con));
            while ($answerlast = mysqli_fetch_row($resultlast)) {
                $mfecha = $answerlast[0];
                $mmonto = $answerlast[1];
            }
        }
        $querypup = "update resumen,pagos set fecha_de_ultimo_pago=fecha,monto_ultimo_pago=monto 
where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta;";
        mysqli_query($con, $querypup) or die("ERROR RM32a - " . mysqli_error($con));

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
        include 'resumenErrorView.php';
    }
}
if (substr($capt, 0, 8) == "practica") {
    $tcapt = "practica";
} else {
    $tcapt = $capt;
}
$mynombre = '';
$queryg = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales='" . $capt . "';";
$resultg = mysqli_query($con, $queryg) or die("ERROR RM37 - " . mysqli_error($con));
while ($answerg = mysqli_fetch_row($resultg)) {
    $mynombre = $answerg[0];
    $mytipo = $answerg[1];
    $camp = $answerg[2];
}
if (empty($capt)) {
    $redirector = "Location: index.php";
    header($redirector);
}
$id_cuenta = 0;
$lockflag = 0;
$sdc = '';
$cr = '';
$queryquery = "SELECT cliente, status_aarsa, camp, 
orden1, updown1, orden2, updown2, orden3, updown3, sdc FROM queuelist 
WHERE gestor='" . $capt . "' AND camp='" . $camp . "'";
$resultquery = mysqli_query($con, $queryquery) or die("ERROR RM38 - " . mysqli_error($con));
while ($answerquery = mysqli_fetch_row($resultquery)) {
    $cliente = $answerquery[0];
    $sdc = $answerquery[9];
    $CR = $answerquery[1];
    $cr = $answerquery[1];
    $order1 = $answerquery[3];
    $updown1 = '';
    if ($answerquery[4] == 1) {
        $updown1 = ' desc';
    }
    $order2 = $answerquery[5];
    $updown2 = '';
    if ($answerquery[6] == 1) {
        $updown2 = ' desc';
    }
    $sep12 = '';
    $lockflag = 0;

    if ($order2 != '') {
        $sep12 = ',';
    }
    $order3 = $answerquery[7];
    $updown3 = '';
    if ($answerquery[8] == 1) {
        $updown3 = ' desc';
    }
    if (($order3 != '') && ($order1 . $order2 != '')) {
        $sep23 = ',';
    } else {
        $sep23 = '';
    }
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
if ($camp > 0) {
    $querymain = "SELECT * FROM resumen 
left join dictamenes on status_aarsa=dictamen
WHERE status_de_credito = '" . $sdc . "'
 AND locker is null
 ORDER BY fecha_ultima_gestion, vcc(status_aarsa), saldo_total desc LIMIT 1";
    if ($cr <> '') {
        $querymain = "SELECT * FROM resumen 
join dictamenes on dictamen=status_aarsa 
WHERE status_de_credito  = '" . $sdc . "' 
 AND locker is null
 AND cliente='" . $cliente . "'" . $codres .
                "
 ORDER BY " . $order1 . $updown1 . $sep12 . $order2 . $updown2 . $sep23 . $order3 . $updown3 . " LIMIT 1";
    }
    if ($cr == 'SIN GESTION') {
        $querymain = "SELECT * FROM resumen 
WHERE (status_de_credito  = '" . $sdc . "' 
 AND locker is null
 AND status_de_credito not regexp '[dv]o$'
 AND cliente='" . $cliente . "' 
 AND ((status_aarsa='') or (status_aarsa is null)))
 ORDER BY saldo_total desc LIMIT 1";
    }
    if ($cr == 'TOPS') {
        $querymain = "select * from (select * from resumen 
where cliente='" . $cliente . "' 
and status_de_credito  = '" . $sdc . "'
and fecha_de_actualizacion > last_day(curdate() - interval 6 week)
order by saldo_total desc limit 15) as tmp 
order by tmp.fecha_ultima_gestion limit 1";
    }

    if (($cr == 'INICIAL')) {
        $querymain = "SELECT * FROM resumen
WHERE status_de_credito not regexp '[dv]o$' 
AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO')
AND ejecutivo_asignado_call_center='" . $capt . "'
AND locker is null 
and fecha_ultima_gestion < curdate()
order by fecha_ultima_gestion  LIMIT 1
";
    }
    if (($cr == 'ESPECIAL')) {
        $querymain = "SELECT * FROM resumen
WHERE status_de_credito = '" . $sdc . "' 
AND cliente='" . $cliente . "'
 AND locker is null
AND fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day
order by fecha_ultima_gestion  LIMIT 1
";
        if ($sdc == '') {
            $querymain = "SELECT * FROM resumen
WHERE cliente='" . $cliente . "'
 AND locker is null
AND fecha_ultima_gestion<curdate()
order by fecha_ultima_gestion  LIMIT 1
";
        }
    }
} else {
    $clientestr = '';
    if (!empty($get['clientefilt'])) {
        $clientefilter = filter_input(INPUT_GET, 'clientefilt');
        $clientefilt = mysqli_real_escape_string($con, $clientefilter);
        if (strlen($clientefilt) > 1) {
            $clientestr = "AND cliente='" . $clientefilt . "' ";
        }
    }
    $gestorstr = "";
//if (($mytipo=='supervisor'||$mytipo=='admin')&&(substr($CR,0,4)!='SELF')) {$gestorstr='';}
    $querymain = "SELECT * FROM resumen 
WHERE status_de_credito  = '" . $sdc . "' 
 AND locker is null
 " . $clientestr . " 
ORDER BY fecha_ultima_gestion,saldo_total desc LIMIT 1";
}
if (($go == 'FROMBUSCAR') || ($go == 'FROMMIGO') || ($go == 'FROMULTIMA') || ($go == 'FROMPROM')) {
    $querymain = "SELECT * FROM resumen WHERE id_cuenta = '" . $find . "' LIMIT 1";
}
$qcount = 0;
if ($go == 'QUICKSEARCH' || $go == 'FROMALERT') {
    $querycount = "SELECT count(1) FROM resumen 
    WHERE " . $field . " = '" . $find . "';";
//if ($capt=='moises') {die(htmlentities($querymain));} 
    $resultcount = mysqli_query($con, $querycount) or die("ERROR RM39 - " . mysqli_error($con));
    while ($answercount = mysqli_fetch_row($resultcount)) {
        $qcount = $answercount[0];
    }
    $querymain = "SELECT * FROM resumen 
    WHERE " . $field . " = '" . $find . "' order by " . $field . " 
    LIMIT 1";
}
//if ($capt=='gmbs') {die(htmlentities($querymain));}
$row = array_fill(0, 200, '');
$result = mysqli_query($con, $querymain) or die("ERROR RM40 - " . mysqli_error($con) . htmlentities($querymain));
if ($result) {
    $row = mysqli_fetch_row($result);
}
$nombre_deudor = $row[0];
$domicilio_deudor = $row[1];
$colonia_deudor = $row[2];
$ciudad_deudor = $row[3];
$estado_deudor = $row[4];
$cp_deudor = $row[5];
$plano_guia_roji = $row[6];
$cuadrante_guia_roji = $row[7];
$tel_1 = $row[8];
$tel_2 = $row[9];
$tel_3 = $row[10];
$tel_4 = $row[11];
$nombre_deudor_alterno = $row[12];

$domicilio_deudor_alterno = $row[13];
$colonia_deudor_alterno = $row[14];
$ciudad_deudor_alterno = $row[15];
$estado_deudor_alterno = $row[16];
$cp_deudor_aterno = $row[17];
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
    $qsliced = "delete from rslice where user='" . $capt . "';";
    mysqli_query($con, $qsliced) or die("ERROR RM55 - " . mysqli_error($con));
    $qslice = "replace into rslice select *, '" . $capt . "', now() from resumen where id_cuenta=" . $id_cuenta;
    mysqli_query($con, $qslice) or die("ERROR RM55 - " . mysqli_error($con));
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
$nrpp = $row[106];
$parentesco_aval = $row[107];
$localizar = $row[108];
$campo_libre_9 = $row[109];
$empresa = $row[110];
$fecha_de_convenio = $row[113];
$direccion_nueva = $row[115];
$C_OBSE2 = '';
$CUANDO = '';
$querycom = "select c_obse2,c_cvst,cuando from historia where c_cont='" . $id_cuenta . "' order by d_fech desc, c_hrin desc limit 1";
$resultcom = mysqli_query($con, $querycom) or die("ERROR RM41 - " . mysqli_error($con));
while ($answercom = mysqli_fetch_row($resultcom)) {
    $C_OBSE2 = $answercom[0];
    $ultimo_status_de_la_gestion = $answercom[1];
    $CUANDO = $answercom[2];
}
if ($id_cuenta == 0) {
    $newcamp = 3;
    $querycamp = "SELECT queuelist.camp FROM nombres,queuelist 
WHERE gestor=iniciales and status_aarsa<>'' and queuelist.camp>nombres.camp
AND gestor='" . $capt . "' AND bloqueado=0
ORDER BY queuelist.camp LIMIT 1";
    $resultcamp = mysqli_query($con, $querycamp) or die("ERROR RM42 - " . mysqli_error($con));
    while ($answercamp = mysqli_fetch_row($resultcamp)) {
        $newcamp = $answercamp[0];
    }
    $queryccamp = "UPDATE nombres SET camp=" . $newcamp . " WHERE iniciales='" . $capt . "';";
    mysqli_query($con, $queryccamp) or die("ERROR RM43 - " . mysqli_error($con));
}
if ($id_cuenta > 0) {
    $queryprom = "select n_prom,d_prom,
        n_prom1,d_prom1,n_prom2,d_prom2,
        n_prom3,d_prom3,n_prom4,d_prom4,
        c_freq 
    from historia 
    where c_cont=" . $id_cuenta . " and n_prom>0 
    and c_cvst like 'PROM%DE%'
    order by d_fech desc, c_hrin desc limit 1";
    $resultprom = mysqli_query($con, $queryprom) or die("ERROR RM45 - " . mysqli_error($con));
    while ($answerprom = mysqli_fetch_row($resultprom)) {
        $N_PROM_OLD = $answerprom[0];
        $D_PROM_OLD = $answerprom[1];
        $N_PROM1_OLD = $answerprom[2];
        $D_PROM1_OLD = $answerprom[3];
        $N_PROM2_OLD = $answerprom[4];
        $D_PROM2_OLD = $answerprom[5];
        $N_PROM3_OLD = $answerprom[6];
        $D_PROM3_OLD = $answerprom[7];
        $N_PROM4_OLD = $answerprom[8];
        $D_PROM4_OLD = $answerprom[9];
    }
} else {
    $N_PROM_OLD = '';
    $D_PROM_OLD = '';
    $N_PROM1_OLD = '';
    $D_PROM1_OLD = '';
    $N_PROM2_OLD = '';
    $D_PROM2_OLD = '';
    $N_PROM3_OLD = '';
    $D_PROM3_OLD = '';
    $N_PROM4_OLD = '';
    $D_PROM4_OLD = '';
}
$nmerc = 0;
$querycheck = "SELECT timelock, locker,time_to_sec(timediff(now(),timelock))/60 from resumen  WHERE id_cuenta='" . $id_cuenta . "';";
$resultcheck = mysqli_query($con, $querycheck) or die("ERROR RM50 - " . mysqli_error($con));
while ($answercheck = mysqli_fetch_row($resultcheck)) {
    $timelock = $answercheck[0];
    $locker = $answercheck[1];
    $sofar = $answercheck[2];
}
$tl = date('r');
if ($mytipo != 'admin') {
    if (!(empty($locker)) && ($locker != $capt)) {
        $lockflag = 1;
    } else {
        $queryunlock = "UPDATE resumen SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
        $querylock = "UPDATE resumen SET timelock=now(),locker='" . $capt . "' WHERE id_cuenta='" . $id_cuenta . "';";
        if ($cliente == 'Surtidor del Hogar') {
            $querylock = "UPDATE resumen SET timelock=now(),locker='" . $capt . "' WHERE rfc_deudor='" . $rfc_deudor . "';";
        }
        if ($mytipo == 'admin') {
            $querylock = "SELECT 1;";
        }
        $queryunlock2 = "UPDATE rslice SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
        $querylock2 = "UPDATE rslice SET timelock=now(),locker='" . $capt . "' WHERE id_cuenta='" . $id_cuenta . "';";
        if ($cliente == 'Surtidor del Hogar') {
            $querylock2 = "UPDATE rslice SET timelock=now(),locker='" . $capt . "' WHERE rfc_deudor='" . $rfc_deudor . "';";
        }
        mysqli_autocommit($con, FALSE);
        mysqli_query($con, $queryunlock) or die("ERROR RM51 - " . mysqli_error($con));
        mysqli_query($con, $querylock) or die("ERROR RM52 - " . mysqli_error($con));
        mysqli_query($con, $queryunlock2) or die("ERROR RM51 - " . mysqli_error($con));
        mysqli_query($con, $querylock2) or die("ERROR RM52 - " . mysqli_error($con));
        mysqli_commit($con);
        $querytlock = "SELECT date_format(timelock,'%a, %d %b %Y %T') FROM 
resumen 
WHERE id_cuenta='" . $id_cuenta . "';";
        $resulttlock = mysqli_query($con, $querytlock) or die("ERROR RM53 - " . mysqli_error($con));
        if ($resulttlock) {
            while ($answertlock = mysqli_fetch_row($resulttlock)) {
                $tl = $answertlock[0];
            }
        }
    }
}
$queryeom = "select last_day(curdate())+interval 1 month";
$resulteom = mysqli_query($con, $queryeom) or die("ERROR RMeom - " . mysqli_error($con));
while ($roweom = mysqli_fetch_row($resulteom)) {
    $dday = $roweom[0];
    $dday2 = $roweom[0];
}
$CD = date("Y-m-d");
$CT = date("H:i:s");
$others = 0;
$queryothers = "select count(1) FROM resumen 
where nombre_deudor='$nombre_deudor'
and '$cliente'='Surtidor del Hogar';";
$resultothers = mysqli_query($con, $queryothers) or die("ERROR RMothers - " . mysqli_error($con));
while ($rowothers = mysqli_fetch_row($resultothers)) {
    $others = $rowothers[0];
}

$queryfilt = "SELECT cliente,sdc,queue FROM queuelist 
WHERE gestor=':capt' 
ORDER BY cliente,sdc,queue
;";
$stf = $pdo->prepare($queryfilt);
$stf->bindParam(':capt', $capt);
$stf->execute();
$resultfilt = $stf->fetchAll();

$queryng = "SELECT count(1) as cng FROM historia 
WHERE c_cvge=:capt 
AND d_fech=curdate()
AND c_cont <> 0
";
$stn = $pdo->prepare($queryng);
$stn->bindParam(':capt', $capt);
$stn->execute();
$resultng = $stn->fetch();

$queryextra = "SELECT *
 FROM resumen,sdhextras 
WHERE cuenta=numero_de_credito 
AND nombre_deudor=:nombre_deudor
AND :cliente='Surtidor del Hogar';";
$ste = $pdo->prepare($queryextra);
$ste->bindParam(':nombre_deudor', $nombre_deudor);
$ste->bindParam(':cliente', $cliente);
$ste->execute();
$resultextra = $ste->fetchAll();

$querycl = "SELECT cliente FROM clientes;";
$resultcl = $pdo->query($querycl);

$queryAccion = "SELECT accion FROM acciones where callcenter=1 order by accion";
if ($mytipo == 'admin') {
    $queryAccion = "SELECT accion FROM acciones order by accion";
}
$resultAccion = $pdo->query($queryAccion);

$queryMotiv = "SELECT motiv FROM motivadores;";
$resultMotiv = $pdo->query($queryMotiv);

$queryDictamen = "SELECT dictamen,v_cc,judicial FROM dictamenes "
        . "where callcenter=1 order by dictamen";
if ($mytipo == 'visitador') {
    $queryDictamen = "SELECT dictamen,v_cc,judicial FROM dictamenes "
            . "where visitas=1 order by dictamen";
}
if ($mytipo == 'admin') {
    $queryDictamen = "SELECT dictamen,v_cc,judicial FROM dictamenes "
            . "order by dictamen";
}
$resultDictamen = $pdo->query($queryDictamen);

$queryAccionV = "SELECT accion FROM acciones where visitas=1;";
$resultAccionV = $pdo->query($queryAccionV);

$queryDictamenV = "SELECT dictamen FROM dictamenes where visitas=1;";
$resultDictamenV = $pdo->query($queryDictamenV);

$queryMotivV = "SELECT motiv FROM motivadores where visitas=1;";
$resultMotivV = $pdo->query($queryMotivV);

$queryGestorV = "SELECT usuaria,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin')";
$resultGestorV = $pdo->query($queryGestorV);

$queryGestor = "SELECT usuaria,completo FROM nombres 
    ORDER BY usuaria";
$resultGestor = $pdo->query($queryGestor);

if ($id_cuenta > 0) {
    $querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin) as fecha,
                    c_cvge,c_tele,left(c_obse1,50) as short,c_obse1,
                    auto,c_cniv 
                    FROM historia 
                    WHERE historia.C_CONT=:id_cuenta   
                    ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
    $sts = $pdo->prepare($querysub);
    $sts->bindParam(':id_cuenta', $id_cuenta);
    $sts->execute();
    $rowsub = $sts->fetchAll();
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
$querybadno = "select if(tel_1 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_3 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_4 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_alterno in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_alterno in (select * from deadlines),' class=\"badno\" ',''),
if(tel_3_alterno in (select * from deadlines),' class=\"badno\" ',''),
if(tel_4_alterno in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_ref_1 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_ref_1 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_ref_2 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_ref_2 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_ref_3 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_ref_3 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_ref_4 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_ref_4 in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_laboral in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_laboral in (select * from deadlines),' class=\"badno\" ',''),
if(tel_1_verif in (select * from deadlines),' class=\"badno\" ',''),
if(tel_2_verif in (select * from deadlines),' class=\"badno\" ',''),
if(tel_3_verif in (select * from deadlines),' class=\"badno\" ',''),
if(tel_4_verif in (select * from deadlines),' class=\"badno\" ',''),
if(telefono_de_ultimo_contacto in (select * from deadlines),' class=\"badno\" ','')
from resumen
where id_cuenta=:id_cuenta;";
$stbn = $pdo->prepare($querybadno);
$stbn->bindParam(':id_cuenta', $id_cuenta);
$stbn->execute();
$resultbadno = $stbn->fetchAll();
foreach ($resultbadno as $answerbadno) {
    $t1 = $answerbadno[0];
    $t2 = $answerbadno[1];
    $t3 = $answerbadno[2];
    $t4 = $answerbadno[3];
    $t1r = $answerbadno[4];
    $t2r = $answerbadno[5];
    $t3r = $answerbadno[6];
    $t4r = $answerbadno[7];
    $t1r1 = $answerbadno[8];
    $t2r1 = $answerbadno[9];
    $t1r2 = $answerbadno[10];
    $t2r2 = $answerbadno[11];
    $t1r3 = $answerbadno[12];
    $t2r3 = $answerbadno[13];
    $t1r4 = $answerbadno[14];
    $t2r4 = $answerbadno[15];
    $t1l = $answerbadno[16];
    $t2l = $answerbadno[17];
    $t1v = $answerbadno[18];
    $t2v = $answerbadno[19];
    $t3v = $answerbadno[20];
    $t4v = $answerbadno[21];
    $tuc = $answerbadno[22];
}

$queryCnp = "SELECT status FROM cnp";
$resultCnp = $pdo->query($queryCnp);

$hasPic = FALSE;
$picFile = '';
$path = dirname(__FILE__) . '/pics/' . $numero_de_cuenta . '.jpg';
if (realpath($path)) {
    $hasPic = TRUE;
    $picFile = 'pics/' . $numero_de_cuenta . '.jpg';
}

include 'resumenView.php';
