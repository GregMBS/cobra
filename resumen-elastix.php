<?php

date_default_timezone_set('America/Monterrey');
$con = '';
$capt = '';
$mytipo = '';
include('usuario_hdr_i.php');
$tcapt = $capt;
$C_CVGE = $capt;
$gets = $_SERVER['QUERY_STRING'];
parse_str($gets, $get);
if (!empty($get['elastix'])) {
    $elastix = mysqli_real_escape_string($con, $get['elastix']);
}
if (substr($capt, 0, 8) == "practica") {
    $tcapt = "practica";
}
if (!empty($mytipo)) {
    setlocale(LC_MONETARY, 'en_US');

    function highhist($stat, $visit) {
        $highstr = "";
        if (($stat == 'PROMESA DE PAGO TOTAL') || ($stat == 'PROMESA DE PAGO PARCIAL') || ($stat == 'CLIENTE NEGOCIANDO')) {
            $highstr = " class='deudor'";
        }
        if (!empty($visit)) {
            $highstr = " class='visit'";
        }
        return $highstr;
    }

    $oldgo = '';

    $getupdate = (!empty($get['go']));
    $isoldid = (!empty($get['id_cuenta']));
    $shutup = 0;
    if (!empty($get['shutup'])) {
        $shutup = 1;
    }
    $find0 = mysqli_real_escape_string($con, $get['find']);
    $capt = mysqli_real_escape_string($con, $get['capt']);
    // We perform a bit of filtering
    $find1 = strtoupper($find0);
    $find2 = strip_tags($find1);
    $find = trim($find2);
}
$pagalert = 0;
$querypagos = "select (c_cvst like 'PAG%'),c_cont from historia 
where c_cvge='" . $capt . "' and d_fech=curdate() and c_cvst like 'PAG%'
and (cuenta,c_cvba) not in (select cuenta,cliente from pagos)
order by d_fech desc,c_hrin desc limit 1";
$resultpagos = mysqli_query($con, $querypagos) or die("ERROR EM14 - " . mysqli_error($con));
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
$notalert = 0;
$go = mysqli_real_escape_string($con, $get['go']);
if ($go == 'ULTIMA') {
    $queryult = "SELECT c_cont FROM historia WHERE c_cvge='" . $capt .
            "' and c_cont <> '0' ORDER BY d_fech desc, C_hrfi desc LIMIT 1";
    $resultult = mysqli_query($con, $queryult) or die("ERROR EM16 - " . mysqli_error($con));
    while ($answerult = mysqli_fetch_row($resultult)) {
        $find = $answerult[0];
    }
    $redirector = "Location: resumen-elastix.php?find=" . $find . "&capt=" . $capt . "&qs=" . $qs . "&go=FROMULTIMA";
    header($redirector);
}
if ($go == 'LOGOUT') {
    $page = "Location: logout.php?gone=&capt=" . $capt;
    header($page);
}
if ($go == 'GUARDAR' && !empty($get['C_CVST'])) {
    $oldgo = mysqli_real_escape_string($con, $get['oldgo']);
    $error = 0;
    $C_CVGE = mysqli_real_escape_string($con, urldecode($get['C_CVGE']));
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
    $C_CONTAN = mysqli_real_escape_string($con, urldecode($get['C_CONTAN']));
    $C_CARG = utf8_encode(mysqli_real_escape_string($con, urldecode($get['C_CARG'])));
    $C_CAMP = mysqli_real_escape_string($con, $get['camp']);
    $D_PROM1 = mysqli_real_escape_string($con, $get['D_PROM1']);
    $D_PROM2 = mysqli_real_escape_string($con, $get['D_PROM2']);
    $D_PAGO = mysqli_real_escape_string($con, $get['D_PAGO']);
    $N_PAGO = mysqli_real_escape_string($con, $get['N_PAGO']);
    $merci = 0;
    if (!empty($get['MERC'])) {
        $D_MERC = mysqli_real_escape_string($con, $get['D_MERC']);
        for ($merci = 0; $merci < count($get['MERC']); $merci++) {
            $MERC[$merci] = mysqli_real_escape_string($con, $get['MERC'][$merci]);
        }
    }
    $C_PROM = mysqli_real_escape_string($con, $get['C_PROM']);
    $N_PROM_OLD = mysqli_real_escape_string($con, $get['N_PROM_OLD']);
    $N_PROM1 = mysqli_real_escape_string($con, $get['N_PROM1']);
    $N_PROM2 = mysqli_real_escape_string($con, $get['N_PROM2']);
    $N_PROM = $N_PROM1 + $N_PROM2;
    $C_FREQ = mysqli_real_escape_string($con, $get['C_FREQ']);
    $C_NTEL = mysqli_real_escape_string($con, $get['C_NTEL']);
    $C_NDIR = mysqli_real_escape_string($con, $get['C_NDIR']);
    $C_EMAIL = trim(mysqli_real_escape_string($con, $get['C_EMAIL']));
    $C_OBSE2 = mysqli_real_escape_string($con, $get['C_OBSE2']);
    $C_EJE = mysqli_real_escape_string($con, $get['C_EJE']);
    $AUTH = mysqli_real_escape_string($con, $get['AUTH']);
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
    $AUTHCODE = mysqli_real_escape_string($con, $get['AUTH']);
    $AUTHNAME = "";
    $AUTHOK = 0;
    $queryauthname = "SELECT iniciales,count(1),tipo FROM nombres 
WHERE authcode='" . $AUTHCODE . "' 
and length(authcode)=6 
and authcode+0>0
and authcode <> '' LIMIT 1;";
    $resultauthname = mysqli_query($con, $queryauthname) or die("ERROR RM22 - " . mysqli_error($con));
    while ($answerauthname = mysqli_fetch_row($resultauthname)) {
        $AUTHNAME = $answerauthname[0];
        $AUTHOK = $answerauthname[1];
        $AUTHTIPO = $answerauthname[2];
    }
    $querydup = "SELECT count(1) FROM historia 
WHERE c_cont=" . $C_CONT . " and d_fech='" . $D_FECH . "' 
and c_hrin='" . $C_HRIN . "' and c_cvst='" . $C_CVST . "' 
and c_cvge='" . $C_CVGE . "' and c_obse1='" . $C_OBSE1 . "';";
    $resultdup = mysqli_query($con, $querydup) or die("EM14a - " . mysqli_error($con));
    while ($answerdup = mysqli_fetch_row($resultdup)) {
        $error = $error + $answerdup[0];
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROMESA DE PAGO TOTAL')) {
        $error = $error + 1;
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROMESA DE PAGO PARCIAL')) {
        $error = $error + 1;
    }
    if (($N_PROM == 0) && ($C_CVST == 'PROPUESTA DE PAGO')) {
        $error = $error + 1;
    }
    if (empty($D_PROM) || ($D_PROM1 > $D_PROM) || ($N_PROM2 == 0)) {
        $D_PROM = $D_PROM1;
    }
    $qins = "INSERT INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
C_TELE,CUANDO,CUENTA,C_OBSE1,C_ATTE,C_CARG,D_PROM,N_PROM,C_PROM,D_PROM1,N_PROM1,D_PROM2,N_PROM2,
C_FREQ,C_CONTAN,C_ACCION,C_CNP,C_MOTIV,C_CAMP,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE,AUTH) 
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
            $C_FREQ . "','" .
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
            $AUTHNAME . "'
)";
    if ($error < 1) {
        mysqli_autocommit($con, FALSE);
        $queryins = str_replace(';', ' ', $qins);
        mysqli_query($con, $queryins) or die("ERROR EM15 - " . mysqli_error($con));
        $querygest = "INSERT INTO histgest (auto,c_cvge) SELECT auto,'" . $C_CVGE . "' 
FROM historia 
WHERE c_cont=" . $C_CONT . " AND d_fech='" . $D_FECH . "'
AND c_hrin='" . $C_HRIN . "' AND c_hrfi='" . $C_HRFI . "'
AND auto NOT IN (SELECT auto FROM histgest)
;";
        mysqli_query($con, $querygest) or die("ERROR RM6 - " . mysqli_error($con));
        $best = $C_CONTAN;
        $querybest = "select c_cvst,v_cc from historia,dictamenes 
where c_cont=" . $C_CONT . " 
and (d_prom>=curdate() or n_prom=0)
and c_cvst=dictamen
order by v_cc limit 1;";
        $resultbest = mysqli_query($con, $querybest) or die("ERROR EM4 - " . mysqli_error($con));
        while ($answerbest = mysqli_fetch_row($resultbest)) {
            $best = $answerbest[0];
        }
        $querysa = "update resumen set status_aarsa='" . $best . "',fecha_ultima_gestion=now() where id_cuenta='" . $C_CONT . "';";

        mysqli_query($con, $querysa) or die("ERROR EM5 - " . mysqli_error($con));
        $querysa1 = "update resumen
set status_aarsa='PAGO DEL MES ANTERIOR'
where status_aarsa like 'PAG%' and status_aarsa not like 'PAGO TOTAL%' 
and id_cuenta=" . $C_CONT . " 
and id_cuenta in (select id_cuenta from pagos)
and id_cuenta not in (select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and status_de_credito not like '%o';";
        mysqli_query($con, $querysa1) or die("ERROR EM5a - " . mysqli_error($con));
        $querysa1a = "update resumen
set status_aarsa='PAGO TOTAL DEL MES ANTERIOR'
where id_cuenta=" . $C_CONT . " 
and status_de_credito not like '%o'
and id_cuenta in (select id_cuenta from pagos
where fecha>last_day(curdate()-interval 2 month)
and fecha<=last_day(curdate()-interval 1 month))
and id_cuenta in (select c_cont from historia 
where c_cvst='pago total' 
and d_fech>last_day(curdate()-interval 2 month)
and d_fech<=last_day(curdate()-interval 1 month))";
        mysqli_query($con, $querysa1a) or die("ERROR EM5aa - " . mysqli_error($con));
        $querysa2 = "update cobra.resumen set status_aarsa='PROMESA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom<curdate()) and id_cuenta=" . $C_CONT . " 
and id_cuenta not in 
(select id_cuenta from cobra.pagos where fecha>last_day(curdate()-interval 1 month)) 
and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');";
        mysqli_query($con, $querysa2) or die("ERROR EM5b - " . mysqli_error($con));
        $querysa3 = "update cobra.resumen set status_aarsa='PROPUESTA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and d_prom>curdate())  and id_cuenta=" . $C_CONT . " 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom<curdate()) 
and id_cuenta not in 
(select id_cuenta from cobra.pagos where fecha>last_day(curdate()-interval 1 month))  
and status_aarsa in ('propuesta de pago','propuesta hoy');";
        mysqli_query($con, $querysa3) or die("ERROR EM5c - " . mysqli_error($con));
        if (!empty($C_NTEL)) {
            $queryntel = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=" . $C_NTEL . " WHERE id_cuenta='" . $C_CONT . "'";
            mysqli_query($con, $queryntel) or die("ERROR EM6 - " . mysqli_error($con));
        }
        if (!empty($C_EMAIL)) {
            $queryndir = "UPDATE resumen SET email_deudor='" . $C_EMAIL . "' WHERE id_cuenta='" . $C_CONT . "'";
            mysqli_query($con, $queryndir) or die("ERROR EM7 - " . mysqli_error($con));
        }
        if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
            $querymemo = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=" . $C_OBSE2 . " WHERE id_cuenta='" . $C_CONT . "'";
            mysqli_query($con, $querymemo) or die("ERROR EM8 - " . mysqli_error($con));
        }
        mysqli_commit($con);
        mysqli_autocommit($con, TRUE);
        if ($N_PAGO > 0) {
            $queryins = "INSERT INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA,FECHACAPT) 
    SELECT numero_de_cuenta,'$D_PAGO','$N_PAGO',cliente,'$who',numero_de_credito,id_cuenta,now() 
    FROM resumen WHERE id_cuenta=" . $C_CONT . " and ('$D_PAGO','$N_PAGO',id_cuenta) not in 
    (select fecha,monto,id_cuenta from pagos where confirmado=0))";
            mysqli_query($con, $queryins) or die("ERROR EM9 - " . mysqli_error($con));

            $querylast = "select fecha,monto from pagos where (cuenta,cliente,fecha) in (select cuenta,cliente,max(fecha) from pagos where id_cuenta=" . $C_CONT . " group by id_cuenta);";
            $resultlast = mysqli_query($con, $querylast) or die("ERROR EM10 - " . mysqli_error($con));
            while ($answerlast = mysqli_fetch_row($resultlast)) {
                $mfecha = $answerlast[0];
                $mmonto = $answerlast[1];
            }
        }
        if ($merci > 0) {
            foreach ($MERC as $MERCa) {
                if (!empty($MERCa)) {
                    $queryins = "INSERT INTO sdhmerc (ID_CUENTA,MERC,FECHAMERC,FECHACAPT) 
    VALUES (" . $C_CONT . ",'" . $MERCa . "','" . $D_MERC . "',now())";
                    mysqli_query($con, $queryins) or die("ERROR EM12 - " . mysqli_error($con));
                }
            }
        }
        if (!empty($get['localizar'])) {
            $queryloc = "update resumen set localizar=" . mysqli_real_escape_string($con, $get['LOCALIZAR']) . " where id_cuenta='" . $c_cont . "';";

//mysqli_query($con,$queryloc) or die ("ERROR EM13 - ".mysqli_error($con));
        }
        $queryups = "update folios,historia,resumen 
set enviado=0,fecha=d_fech+interval (time_to_sec(c_hrfi)) second 
where c_cont=id and n_prom>0 and d_fech>fecha and c_cvst like 'promesa de%'
and c_cont=id_cuenta and n_prom>=saldo_descuento_2
and d_fech=curdate() and fecha>last_day(curdate()-interval 1 month);";
        mysqli_query($con, $queryups) or die("ERROR FM4a - " . mysqli_error($con));

        if ($find == "/") {
            $find = NULL;
        }
        if ($capt == "/") {
            $capt = NULL;
        }

        $redirector = "Location: closeme.html";
//if ($N_PROM>0) {
//$redirector="/folios.php?capt=$capt&tipo=$mytipo&CUENTA=$CUENTA&CLIENTE=$C_CVBA&source=resumen-elastix&go=FOLIOS";
//}
        if ($C_CVST == "PROMESA DE PAGO TOTAL") {
            $FC = $C_CVBA;
            $redirector = "folios.php?capt=$capt&tipo=$mytipo&CUENTA=$CUENTA&CLIENTE=$C_CVBA&source=resumen&go=FOLIOS&fc=$FC";
        }
    }
    if ($error > 0) {
        $PAGOTXT = '';
        if (($C_CVST == "PROMESA DE PAGO TOTAL") || ($C_CVST == "PROMESA DE PAGO TOTAL")) {
            $PAGOTXT = " con toda promesa de " . $N_PROM . " y fecha primera " . $D_PROM1;
        }
        $redirector = "Location: closeme.php?msg=Checar que gestion de 
	cuenta " . $CUENTA . " con status " . $C_CVST . $PAGOTXT . "  
	está guardado corectamente.";
    }
    header($redirector);
}
if (substr($capt, 0, 8) == "practica") {
    $tcapt = "practica";
}
$mynombre = '';
$queryg = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales='" . $capt . "'";
$resultg = mysqli_query($con, $queryg) or die("ERROR EM18 - " . mysqli_error($con));
while ($answerg = mysqli_fetch_row($resultg)) {
    $mynombre = $answerg[0];
    $mytipo = $answerg[1];
    $camp = $answerg[2];
}
$camp = 1;
if (empty($capt)) {
    $redirector = "Location: index.php";
    header($redirector);
}
if (empty($elastix)) {
    $redirector = "Location: closeme.html";
    header($redirector);
}
$id_cuenta = 0;
$lockflag = 0;
$querymain = "SELECT * FROM resumen WHERE id_cuenta = '" . $find . "' LIMIT 1";
$result = mysqli_query($con, $querymain) or die("ERROR EM19 - " . mysqli_error($con));
while ($row = mysqli_fetch_row($result)) {
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
    $lockflag = 0;

    $domicilio_deudor_alterno = $row[13];
    $colonia_deudor_alterno = $row[14];
    $ciudad_deudor_alterno = $row[15];
    $estado_deudor_alterno = $row[16];
    $cp_deudor_aterno = $row[17];
    $tel_1_alterno = $row[18];
    $tel_2_alterno = $row[19];
    $tel_3_alterno = $row[20];
    $tel_4_alterno = $row[21];
    $plano_guia_roji_alterno = $row[22];
    $cuadrante_guia_roji_alterno = $row[23];
    $status_aarsa = $row[24];
    $sucursal_cliente = $row[25];
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
    $domicilio_referencia_4 = $row[55];
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
    $fecha_limite = $row[79];
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
    if ($cliente == 'Surtidor del Hogar') {
        $queryxmora = "SELECT floor(max(xmora)/30.25) FROM sdhextras 
where cuenta='" . $numero_de_cuenta . "' order by subcuenta";
        $resultxmora = mysqli_query($con, $queryxmora);
        while ($answerxmora = mysqli_fetch_row($resultxmora)) {
            $pagos_vencidos = $answerxmora[0];
        }
    }
    $monto_adeudado = $row[87];
    $fecha_de_asignacion = $row[88];
    $fecha_de_deasignacion = $row[89];
    $cuenta_concentradora_1 = $row[90];
    $saldo_cuota = $row[91];
    if (empty($saldo_cuota)) {
        $saldo_cuota = 0;
    }
    $expediente = $row[92];
    $id_cuenta = $row[93];
    if (empty($id_cuenta)) {
        $id_cuenta = 0;
    } else {
        $qsliced = "delete from rslice where user='" . $capt . "';";
        mysqli_query($con, $qsliced) or die("ERROR RM55 - " . mysqli_error($con));
        $qslice = "replace into rslice select *, '" . $capt . "', now() from resumen where id_cuenta=" . $id_cuenta;
        mysqli_query($con, $qslice) or die("ERROR EM55 - " . mysqli_error($con));
    }
    $pago_pactado = $row[94];
    $rfc_deudor = $row[95];
    $telefonos_marcados = $row[96];
    $tel_1_verif = $row[97];
    $tel_2_verif = $row[98];
    $tel_3_verif = $row[99];
    $tel_4_verif = $row[100];
    $telefono_de_ultimo_contacto = $row[101];
//$ultimo_status_de_la_gestion=$row[102];
    $ejecutivo_asignado_call_center = $row[103];
    $ejecutivo_asignado_domiciliario = $row[104];
    $prioridad_de_gestion = $row[105];
    $region_aarsa = $row[106];
    $parentesco_aval = $row[107];
    $localizar = $row[108];
    $campo_libre_9 = $row[109];
    $empresa = $row[110];
    $direccion_nueva = $row[115];
    $C_OBSE2 = '';
    $CUANDO = '';
    $querycom = "select c_obse2,c_cvst,cuando from historia where c_cont='" . $id_cuenta . "' order by d_fech desc, c_hrin desc limit 1";
    $resultcom = mysqli_query($con, $querycom) or die("ERROR EM20 - " . mysqli_error($con));
    while ($answercom = mysqli_fetch_row($resultcom)) {
        $C_OBSE2 = $answercom[0];
        $ultimo_status_de_la_gestion = $answercom[1];
        $CUANDO = $answercom[2];
    }
    $ia = 0;
    $queryauth = "select distinct authcode*curdate() from nombres where authcode is not null";
    $resultauth = mysqli_query($con, $queryauth) or die("ERROR EM21 - " . mysqli_error($con));
    while ($answerauth = mysqli_fetch_row($resultauth)) {
        $authcode[$ia] = $answerauth[0];
        $ia++;
    }
    $queryprom = "select n_prom,d_prom,n_prom1,d_prom1,n_prom2,d_prom2,c_freq 
from historia 
where c_cont=" . $id_cuenta . " and n_prom>0 
and c_cvst like 'PROM%DE%'
order by d_fech desc, c_hrin desc limit 1";
    $resultprom = mysqli_query($con, $queryprom) or die("ERROR EM22 - " . mysqli_error($con));
    while ($answerprom = mysqli_fetch_row($resultprom)) {
        $N_PROM_OLD = $answerprom[0];
        $D_PROM_OLD = $answerprom[1];
        $N_PROM1_OLD = $answerprom[2];
        $D_PROM1_OLD = $answerprom[3];
        $N_PROM2_OLD = $answerprom[4];
        $D_PROM2_OLD = $answerprom[5];
    }
    $folio = "";
    $nmerc = 0;
    $nfolio = 0;
    $queryfolio = "SELECT max(folio) FROM folios WHERE id='" . $id_cuenta . "'
AND id>0 and mercancia=0 and fecha>last_day(curdate()-interval 1 month) order by fecha desc,folio desc limit 1
;";
    $resultfolio = mysqli_query($con, $queryfolio) or die("ERROR EM23 - " . mysqli_error($con));
    while ($answerfolio = mysqli_fetch_row($resultfolio)) {
        $folio = $answerfolio[0];
    }
    $querynmerc = "SELECT min(folio) FROM folios WHERE cliente='" . $cliente . "'
and usado=0 and mercancia=1;";
    $nproms = 0;
    $querynproms = "SELECT count(1) FROM historia WHERE c_cont=" . $id_cuenta . "
and n_prom>0;";
    $resultnproms = mysqli_query($con, $querynproms) or die("ERROR RM48a - " . mysqli_error($con));
    while ($answernproms = mysqli_fetch_row($resultnproms)) {
        $nproms = $answernproms[0];
    }
    $npagos = 0;
    $querynpagos = "SELECT count(1) FROM pagos WHERE id_cuenta=" . $id_cuenta . ";";
    $resultnpagos = mysqli_query($con, $querynpagos) or die("ERROR RM48b - " . mysqli_error($con));
    while ($answernpagos = mysqli_fetch_row($resultnpagos)) {
        $npagos = $answernpagos[0];
    }
    $resultnmerc = mysqli_query($con, $querynmerc) or die("ERROR EM24 - " . mysqli_error($con));
    while ($answernmerc = mysqli_fetch_row($resultnmerc)) {
        $nmerc = $answernmerc[0];
    }
    $querynfolio = "SELECT min(folio) FROM folios WHERE cliente='" . $cliente . "'
and usado=0 and mercancia=0;";
    $resultnfolio = mysqli_query($con, $querynfolio) or die("ERROR EM25 - " . mysqli_error($con));
    while ($answernfolio = mysqli_fetch_row($resultnfolio)) {
        $nfolio = $answernfolio[0];
    }
    $querycheck = "SELECT timelock, locker,time_to_sec(timediff(now(),timelock))/60 from resumen  WHERE id_cuenta='" . $id_cuenta . "';";
    $resultcheck = mysqli_query($con, $querycheck) or die("ERROR EM27 - " . mysqli_error($con));
    while ($answercheck = mysqli_fetch_row($resultcheck)) {
        $timelock = $answercheck[0];
        $locker = $answercheck[1];
        $sofar = $answercheck[2];
    }
    $tl = date('r');
    $queryunlock = "UPDATE resumen SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
    mysqli_query($con, $queryunlock) or die("ERROR EM28 - " . mysqli_error($con));
    if (1 == 1) {
        if (!(empty($locker)) && ($locker != $capt)) {
            $lockflag = 1;
        } else {
            $queryunlock = "UPDATE resumen SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
            $querylock = "UPDATE resumen SET timelock=now(),locker='" . $capt . "' WHERE id_cuenta='" . $id_cuenta . "';";
            $queryunlock2 = "UPDATE rslice SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
            $querylock2 = "UPDATE rslice SET timelock=now(),locker='" . $capt . "' WHERE id_cuenta='" . $id_cuenta . "';";
            mysqli_autocommit($con, FALSE);
            mysqli_query($con, $queryunlock) or die("ERROR EM29 - " . mysqli_error($con));
            mysqli_query($con, $querylock) or die("ERROR EM30 - " . mysqli_error($con));
            mysqli_query($con, $queryunlock2) or die("ERROR RM51 - " . mysqli_error($con));
            mysqli_query($con, $querylock2) or die("ERROR RM52 - " . mysqli_error($con));
            mysqli_commit($con);
            $querytlock = "SELECT date_format(timelock,'%a, %d %b %Y %T') FROM 
resumen 
WHERE id_cuenta='" . $id_cuenta . "';";
            $resulttlock = mysqli_query($con, $querytlock) or die("ERROR EM31 - " . mysqli_error($con));
            while ($answertlock = mysqli_fetch_row($resulttlock)) {
                $tl = $answertlock[0];
            }
            $breakflag = 0;
            $querybreak = "SELECT tipo,empieza,termina FROM breaks 
WHERE time(now()) between empieza and termina and gestor='" . $capt . "';";
            $resultbreak = mysqli_query($con, $querybreak) or die("ERROR EM32 - " . mysqli_error($con));
            while ($answerbreak = mysqli_fetch_row($resultbreak)) {
                $breakflag = 1;
                $btipo = $answerbreak[0];
                $bemp = $answerbreak[1];
                $bterm = $answerbreak[2];
            }
        }
    }
}
$queryd = "select curdate()-interval 1 day as yesterday,
last_day(curdate()+interval 1 month) as dend,
last_day(curdate()+interval 1 month) as denda,
last_day(curdate()+interval 1 month) as dend2;";
$resultd = mysqli_query($con, $queryd) or die("ERROR EMqd - " . mysqli_error($con));
while ($answerd = mysqli_fetch_row($resultd)) {
    $yesterday = $answerd[0];
    $dend = $answerd[1];
    $dend2 = $answerd[3];
    if ($mytipo == 'admin') {
        $dend = $answerd[2];
        $dend2 = $answerd[2];
    }
}
include 'resumenView.php';
