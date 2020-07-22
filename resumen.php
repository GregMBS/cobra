<?php

use cobra_salsa\BuscarClass;
use cobra_salsa\GestionClass;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenClass;
use cobra_salsa\ResumenQueuesClass;

$get = filter_input_array(INPUT_GET);
date_default_timezone_set('America/Monterrey');
setlocale(LC_MONETARY, 'en_US');

require_once 'classes/PdoClass.php';
require_once 'classes/GestionClass.php';
require_once 'classes/ResumenClass.php';
require_once 'classes/ResumenQueuesClass.php';
require_once 'classes/BuscarClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectUser();
$con = $pc->dbConnectUserMysqli();
$gc = new GestionClass($pdo);
$rc = new ResumenClass($pdo);
$qc = new ResumenQueuesClass($pdo);
$bc = new BuscarClass($pdo);
$capt = $pc->capt;
$mytipo = $pc->tipo;
$C_CVGE = $capt;
$flag = 0;
$flagmsg = '';
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
    $notalertt = '';
    $alertcuenta = '';
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
    $C_PROM = mysqli_real_escape_string($con, $get['C_PROM']);
    $N_PROM_OLD = mysqli_real_escape_string($con, $get['N_PROM_OLD']);
    $N_PROM1 = (float)mysqli_real_escape_string($con, $get['N_PROM1']);
    $N_PROM2 = (float)mysqli_real_escape_string($con, $get['N_PROM2']);
    $N_PROM3 = (float)mysqli_real_escape_string($con, $get['N_PROM3']);
    $N_PROM4 = (float)mysqli_real_escape_string($con, $get['N_PROM4']);
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
    //while ($answerdup = mysqli_fetch_row($resultdup)) {
    //$error = $error + $answerdup[0];
    //$flagmsg = "DOBLE ENTRANTE";
    //}
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
        $querysa1 = "update resumen set status_aarsa='PROMESA INCUMPLIDA' 
where id_cuenta not in (select c_cont from historia where n_prom>0 
and d_prom>=curdate()) and cliente not like 'J%' and cliente not like '%JUR'
and id_cuenta in (select c_cont from historia where n_prom>0 
and d_prom<curdate()) 
and numero_de_cuenta not in 
(select cuenta from pagos where fecha>last_day(curdate()-interval 1 month)) 
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
$mynombre = '';
$queryg = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales='" . $capt . "';";
$resultg = mysqli_query($con, $queryg) or die("ERROR RM37 - " . mysqli_error($con));
while ($answerg = mysqli_fetch_row($resultg)) {
    $mynombre = $answerg[0];
    $mytipo = $answerg[1];
    $camp = $answerg[2];
}
$id_cuenta = 0;
$lockflag = 0;
$queue = $qc->getMyQueue($capt, $camp);
$cliente = $queue->cliente;
$sdc = $queue->sdc;
$cr = $queue->status_aarsa;
$sql = $qc->getQueryString($queue);
$quickArray = ['FROMBUSCAR', 'FROMMIGO', 'FROMULTIMA', 'FROMPROM'];
if (in_array($go, $quickArray)) {
    $sql = $qc->getQuickString($id_cuenta);
}

$row = $qc->getAccount($sql);

$nombre_deudor = $row->nombre_deudor;
$domicilio_deudor = $row->domicilio_deudor;
$colonia_deudor = $row->colonia_deudor;
$ciudad_deudor = $row->ciudad_deudor;
$estado_deudor = $row->estado_deudor;
$cp_deudor = $row->cp_deudor;
$plano_guia_roji = $row->plano_guia_roji;
$cuadrante_guia_roji = $row->cuadrante_guia_roji;
$tel_1 = $row->tel_1;
$tel_2 = $row->tel_2;
$tel_3 = $row->tel_3;
$tel_4 = $row->tel_4;
$nombre_deudor_alterno = $row->nombre_deudor_alterno;
$domicilio_deudor_alterno = $row->domicilio_deudor_alterno;
$colonia_deudor_alterno = $row->colonia_deudor_alterno;
$ciudad_deudor_alterno = $row->ciudad_deudor_alterno;
$estado_deudor_alterno = $row->estado_deudor_alterno;
$cp_deudor_alterno = $row->cp_deudor_alterno;
$tel_1_alterno = $row->tel_1_alterno;
$tel_2_alterno = $row->tel_2_alterno;
$tel_3_alterno = $row->tel_3_alterno;
$tel_4_alterno = $row->tel_4_alterno;
$plazo = $row->plano_guia_roji_alterno;
$dia_corte = $row->cuadrante_guia_roji_alterno;
$status_aarsa = $row->status_aarsa;
$avapar = $row->avapar;
$referencias_1 = $row->parentesco_ref_1;
$nombre_referencia_1 = $row->nombre_referencia_1;
$domicilio_referencia_1 = $row->domicilio_referencia_1;
$colonia_referencia_1 = $row->colonia_referencia_1;
$ciudad_referencia_1 = $row->ciudad_referencia_1;
$estado_referencia_1 = $row->estado_referencia_1;
$cp_referencia_1 = $row->cp_referencia_1;
$tel_1_ref_1 = $row->tel_1_ref_1;
$tel_2_ref_1 = $row->tel_2_ref_1;
$referencias_2 = $row->parentesco_ref_2;
$nombre_referencia_2 = $row->nombre_referencia_2;
$domicilio_referencia_2 = $row->domicilio_referencia_2;
$colonia_referencia_2 = $row->colonia_referencia_2;
$ciudad_referencia_2 = $row->ciudad_referencia_2;
$estado_referencia_2 = $row->estado_referencia_2;
$cp_referencia_2 = $row->cp_referencia_2;
$tel_1_ref_2 = $row->tel_1_ref_2;
$tel_2_ref_2 = $row->tel_2_ref_2;
$referencias_3 = $row->parentesco_ref_3;
$nombre_referencia_3 = $row->nombre_referencia_3;
$domicilio_referencia_3 = $row->domicilio_referencia_3;
$colonia_referencia_3 = $row->colonia_referencia_3;
$ciudad_referencia_3 = $row->ciudad_referencia_3;
$estado_referencia_3 = $row->estado_referencia_3;
$cp_referencia_3 = $row->cp_referencia_3;
$tel_1_ref_3 = $row->tel_1_ref_3;
$tel_2_ref_3 = $row->tel_2_ref_3;
$referencias_4 = $row->parentesco_ref_4;
$nombre_referencia_4 = $row->nombre_referencia_4;
$domicilio_deudor_2 = $row->originacion;
$frecuencia = $row->multiestrategia;
$ciudad_referencia_4 = $row->ciudad_referencia_4;
$estado_referencia_4 = $row->estado_referencia_4;
$cp_referencia_4 = $row->cp_referencia_4;
$tel_1_ref_4 = $row->tel_1_ref_4;
$tel_2_ref_4 = $row->tel_2_ref_4;
$domicilio_laboral = $row->domicilio_laboral;
$colonia_laboral = $row->colonia_laboral;
$ciudad_laboral = $row->ciudad_laboral;
$estado_laboral = $row->estado_laboral;
$cp_laboral = $row->cp_laboral;
$tel_1_laboral = $row->tel_1_laboral;
$tel_2_laboral = $row->tel_2_laboral;
$gastos_de_cobranza = $row->saldo_corriente;
$fecha_de_actualizacion = $row->fecha_de_actualizacion;
$numero_de_cuenta = $row->numero_de_cuenta;
$numero_de_credito = $row->numero_de_credito;
$contrato = $row->contrato;
$saldo_total = $row->saldo_total;
$saldo_vencido = $row->saldo_vencido;
$saldo_descuento_1 = $row->saldo_descuento_1;
$saldo_descuento_2 = $row->saldo_descuento_2;
$fecha_corte = $row->fecha_corte;
$fecha_1er_pago = $row->fecha_limite;
$fecha_de_ultimo_pago = $row->fecha_de_ultimo_pago;
$monto_ultimo_pago = $row->monto_ultimo_pago;
$producto = $row->producto;
$subproducto = $row->subproducto;
$cliente = $row->cliente;
$status_de_credito = $row->status_de_credito;
$pagos_vencidos = $row->pagos_vencidos;
$monto_adeudado = $row->monto_adeudado;
$fecha_de_asignacion = $row->fecha_de_asignacion;
$fecha_de_deasignacion = $row->fecha_de_deasignacion;
$cuenta_concentradora_1 = $row->cuenta_concentradora_1;
$saldo_cuota = $row->saldo_cuota;
$email_deudor = $row->email_deudor;
$id_cuenta = $row->id_cuenta;
$nss = $row->nss;
$rfc_deudor = $row->rfc_deudor;
$telefonos_marcados = $row->telefonos_marcados;
$tel_1_verif = $row->tel_1_verif;
$tel_2_verif = $row->tel_2_verif;
$tel_3_verif = $row->tel_3_verif;
$tel_4_verif = $row->tel_4_verif;
$telefono_de_ultimo_contacto = $row->telefono_de_ultimo_contacto;
$dias_vencidos = $row->dias_vencidos;
$ejecutivo_asignado_call_center = $row->ejecutivo_asignado_call_center;
$ejecutivo_asignado_domiciliario = $row->ejecutivo_asignado_domiciliario;
$prioridad_de_gestion = $row->prioridad_de_gestion;
$nrpp = $row->nrpp;
$parentesco_aval = $row->parentesco_aval;
$localizar = $row->localizar;
$fecha_ultima_gestion = $row->fecha_ultima_gestion;
$empresa = $row->empresa;
$fecha_convenio = $row->fecha_convenio;
$direccion_nueva = $row->direccion_nueva;
$timelock = $row->timelock;
$locker = $row->locker;
$fecha_convenio = $row->fecha_convenio;
$especial = $row->especial;
$direccion_nueva = $row->direccion_nueva;
$norobot = $row->norobot;

$latest = $rc->getLastStatus($id_cuenta);

$C_OBSE2 = $latest->C_OBSE2;
$ultimo_status_de_la_gestion = $latest->C_CVST;
$CUANDO = $latest->CUANDO;

if ($id_cuenta == 0) {
    $newcamp = $rc->leaveEmptyQueue($capt);
}
if ($id_cuenta > 0) {
    $lastProm = $rc->getPromData($id_cuenta);
    $N_PROM_OLD = $lastProm->N_PROM;
    $D_PROM_OLD = $lastProm->D_PROM;
    $N_PROM1_OLD = $lastProm->N_PROM1;
    $D_PROM1_OLD = $lastProm->D_PROM1;
    $N_PROM2_OLD = $lastProm->N_PROM2;
    $D_PROM2_OLD = $lastProm->D_PROM2;
    $N_PROM3_OLD = $lastProm->N_PROM3;
    $D_PROM3_OLD = $lastProm->D_PROM3;
    $N_PROM4_OLD = $lastProm->N_PROM4;
    $D_PROM4_OLD = $lastProm->D_PROM4;
}
try {
    $lockDate = new DateTime($timelock);
    $nowDate = new DateTime();
    $sofar = $nowDate->diff($lockDate);
} catch (Exception $e) {
    die($e->getMessage());
}

$tl = date('r');
if ($mytipo != 'admin') {
    if (!(empty($locker)) && ($locker != $capt)) {
        $lockflag = 1;
    } else {
        $rc->setLocks($capt, $id_cuenta, $mytipo);
        if ($timelock) {
            $tl = date('D M d Y H:i:s O',strtotime($timelock));
        }
    }
}

$CD = date("Y-m-d");
$CT = date("H:i:s");
$others = 0;

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

$clientes = $bc->listClients();

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
$gestiones = $rc->countGestiones($id_cuenta);
$promesas = $rc->countPromesas($id_cuenta);
$pagos = $rc->countPagos($id_cuenta);
if (empty($row->nombre_deudor)) {
    var_dump($row);
    die();
}
include __DIR__ . '/views/resumenView.php';
