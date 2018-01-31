<?php
use cobra_salsa\PdoClass;

date_default_timezone_set('America/Monterrey');
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$con = $pdoc->dbConnectUserMysqli();
$capt = $pdoc->capt;
$mytipo = $pdoc->tipo;
//include 'config.php';
$tcapt  = $capt;
$C_CVGE = $capt;
$elast  = filter_input(INPUT_GET, 'elastix');
$find  = filter_input(INPUT_GET, 'find');
$get    = filter_input_array(INPUT_GET);
if (isset($elast)) {
    $elastix = mysqli_real_escape_string($con, $elast);
}
if (substr($capt, 0, 8) == "practica") {
    $tcapt = "practica";
}
if (!empty($mytipo)) {
    setlocale(LC_MONETARY, 'en_US');

    function highhist($stat, $visit)
    {
        $highstr = "";
        if (($stat == 'PROMESA DE PAGO TOTAL') || ($stat == 'PROMESA DE PAGO PARCIAL')
            || ($stat == 'CLIENTE NEGOCIANDO')) {
            $highstr = " class='deudor'";
        }
        if (!empty($visit)) {
            $highstr = " class='visit'";
        }
        return $highstr;
    }
    $oldgo  = '';
    $shutup = 0;
    if (!empty($get['shutup'])) {
        $shutup = 1;
    }
}
$pagalert    = 0;
$querypagos  = "select (c_cvst like 'PAG%'),c_cont from historia
where c_cvge='".$capt."' and d_fech=curdate() and c_cvst like 'PAG%'
and (cuenta,c_cvba) not in (select cuenta,cliente from pagos)
order by d_fech desc,c_hrin desc limit 1";
$resultpagos = mysqli_query($con, $querypagos) or die("ERROR EM14 - ".mysqli_error($con));
while ($answerpagos = mysqli_fetch_row($resultpagos)) {
    $pagalert = $answerpagos[0];
    if (empty($pagalert)) {
        $pagalert = 0;
    }
    if ($mytipo == 'visitador') {
        $pagalert = 0;
    }
}
$notalert = 0;
$go       = mysqli_real_escape_string($con, $get['go']);
if ($go == 'ULTIMA') {
    $queryult  = "SELECT c_cont FROM historia WHERE c_cvge='".$capt.
        "' and c_cont <> '0' ORDER BY d_fech desc, C_hrfi desc LIMIT 1";
    $resultult = mysqli_query($con, $queryult) or die("ERROR EM16 - ".mysqli_error($con));
    while ($answerult = mysqli_fetch_row($resultult)) {
        $find = $answerult[0];
    }
    $redirector = "Location: resumen-elastix.php?find=".$find."&capt=".$capt."&go=FROMULTIMA";
    header($redirector);
}
if ($go == 'LOGOUT') {
    $page = "Location: logout.php?gone=&capt=".$capt;
    header($page);
}
if ($go == 'GUARDAR' && !empty($get['C_CVST'])) {
    $oldgo           = mysqli_real_escape_string($con, $get['oldgo']);
    $error           = 0;
    $C_CVGE          = mysqli_real_escape_string($con, urldecode($get['C_CVGE']));
    $C_CONT          = mysqli_real_escape_string($con, $get['C_CONT']);
    $C_CVST          = mysqli_real_escape_string($con, urldecode($get['C_CVST']));
    $C_CVBA          = mysqli_real_escape_string($con, urldecode($get['C_CVBA']));
    $ACCION          = mysqli_real_escape_string($con, urldecode($get['ACCION']));
    $C_MOTIV         = mysqli_real_escape_string($con,
        urldecode($get['C_MOTIV']));
    $D_FECH          = mysqli_real_escape_string($con, $get['D_FECH']);
    $C_HRIN          = mysqli_real_escape_string($con, $get['C_HRIN']);
    $C_HRFI          = date('H:i:s');
    $C_TELE          = mysqli_real_escape_string($con, $get['C_TELE']);
    $CUANDO          = mysqli_real_escape_string($con, $get['CUANDO']);
    $CUENTA          = mysqli_real_escape_string($con, $get['CUENTA']);
    $C_OBSE1         = utf8_decode(strtoupper(mysqli_real_escape_string($con,
                $get['C_OBSE1'])));
    $C_ATTE          = mysqli_real_escape_string($con, $get['C_ATTE']);
    $C_CNP           = mysqli_real_escape_string($con, $get['C_CNP']);
    $C_CONTAN        = mysqli_real_escape_string($con,
        urldecode($get['C_CONTAN']));
    $C_CARG          = utf8_encode(mysqli_real_escape_string($con,
            urldecode($get['C_CARG'])));
    $C_CAMP          = mysqli_real_escape_string($con, $get['camp']);
    $D_PROM1         = mysqli_real_escape_string($con, $get['D_PROM1']);
    $D_PROM2         = mysqli_real_escape_string($con, $get['D_PROM2']);
    $D_PROM3         = mysqli_real_escape_string($con, $get['D_PROM3']);
    $D_PROM4         = mysqli_real_escape_string($con, $get['D_PROM4']);
    $D_PAGO          = mysqli_real_escape_string($con, $get['D_PAGO']);
    $N_PAGO          = mysqli_real_escape_string($con, $get['N_PAGO']);
    $numero_sucursal = mysqli_real_escape_string($con, $get['numero_sucursal']);
    $nombre_sucursal = mysqli_real_escape_string($con, $get['nombre_sucursal']);
    /*
      $merci = 0;
      if (!empty($get['MERC'])) {
      $D_MERC = mysqli_real_escape_string($con, $get['D_MERC']);
      for ($merci = 0; $merci < count($get['MERC']); $merci++) {
      $MERC[$merci] = mysqli_real_escape_string($con, $get['MERC'][$merci]);
      }
      }
     */
    $C_PROM          = mysqli_real_escape_string($con, $get['C_PROM']);
    $N_PROM_OLD      = mysqli_real_escape_string($con, $get['N_PROM_OLD']);
    $N_PROM1         = mysqli_real_escape_string($con, $get['N_PROM1']);
    $N_PROM2         = mysqli_real_escape_string($con, $get['N_PROM2']);
    $N_PROM3         = mysqli_real_escape_string($con, $get['N_PROM3']);
    $N_PROM4         = mysqli_real_escape_string($con, $get['N_PROM4']);
    $N_PROM          = $N_PROM1 + $N_PROM2 + $N_PROM3 + $N_PROM4;
    $C_FREQ          = mysqli_real_escape_string($con, $get['C_FREQ']);
    $C_NTEL          = mysqli_real_escape_string($con, $get['C_NTEL']);
    $C_NDIR          = mysqli_real_escape_string($con, $get['C_NDIR']);
    $C_EMAIL         = trim(mysqli_real_escape_string($con, $get['C_EMAIL']));
    $C_OBSE2         = mysqli_real_escape_string($con, $get['C_OBSE2']);
    $C_EJE           = mysqli_real_escape_string($con, $get['C_EJE']);
//    $AUTH = mysqli_real_escape_string($con, $get['AUTH']);
    $montomax        = 0;
    $fechamin        = '2020-12-31';
    $fechamax        = '2007-01-01';
    $queryult        = "select max(n_prom),min(d_prom),max(d_prom) from historia where c_cont='".$C_CONT."' and n_prom>0;";
    $resultult       = mysqli_query($con, $queryult) or die("ERROR RM21 - ".mysqli_error($con));
    while ($answerult       = mysqli_fetch_row($resultult)) {
        $montomax = max($answerult[0], 0);
        $fechamin = $answerult[1];
        $fechamax = $answerult[2];
    }
    $D_PROM         = $D_PROM1;
    $AUTHCODE       = mysqli_real_escape_string($con, $get['AUTH']);
    $AUTHNAME       = "";
    $AUTHOK         = 0;
    $queryauthname  = "SELECT iniciales,count(1),tipo FROM nombres
WHERE authcode='".$AUTHCODE."' 
and length(authcode)=6 
and authcode+0>0
and authcode <> '' LIMIT 1;";
    $resultauthname = mysqli_query($con, $queryauthname) or die("ERROR RM22 - ".mysqli_error($con));
    while ($answerauthname = mysqli_fetch_row($resultauthname)) {
        $AUTHNAME = $answerauthname[0];
        $AUTHOK   = $answerauthname[1];
//        $AUTHTIPO = $answerauthname[2];
    }
    $querydup  = "SELECT count(1) FROM historia
WHERE c_cont=".$C_CONT." and d_fech='".$D_FECH."' 
and c_hrin='".$C_HRIN."' and c_cvst='".$C_CVST."' 
and c_cvge='".$C_CVGE."' and c_obse1='".$C_OBSE1."';";
    $resultdup = mysqli_query($con, $querydup) or die("EM14a - ".mysqli_error($con));
    while ($answerdup = mysqli_fetch_row($resultdup)) {
        $error = $error + $answerdup[0];
    }
    if (empty($C_CVGE)) {
        $error = $error + 1;
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
C_TELE,CUANDO,CUENTA,C_OBSE1,C_ATTE,C_CARG,D_PROM,N_PROM,C_PROM,
D_PROM1,N_PROM1,D_PROM2,N_PROM2,
D_PROM3,N_PROM3,D_PROM4,N_PROM4,
C_FREQ,C_CONTAN,C_ACCION,C_CNP,C_MOTIV,C_CAMP,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE,AUTH) 
VALUES ('".$C_CVBA."','".
        $C_CVGE."','".
        $C_CONT."','".
        $C_CVST."',date('".
        $D_FECH."'),'".
        $C_HRIN."','".
        $C_HRFI."','".
        $C_TELE."','".
        $CUANDO."','".
        $CUENTA."','".
        $C_OBSE1."','".
        $C_ATTE."','".
        $C_CARG."','".
        $D_PROM."','".
        $N_PROM."','".
        $C_PROM."','".
        $D_PROM1."','".
        $N_PROM1."','".
        $D_PROM2."','".
        $N_PROM2."','".
        $D_PROM3."','".
        $N_PROM3."','".
        $D_PROM4."','".
        $N_PROM4."','".
        $C_FREQ."','".
        $C_CONTAN."','".
        $ACCION."','".
        $C_CNP."','".
        $C_MOTIV."','".
        $C_CAMP."','".
        $C_NTEL."','".
        $C_NDIR."','".
        $C_EMAIL."','".
        $C_OBSE2."','".
        $C_EJE."','".
        $AUTHNAME."'
)";
    if ($error < 1) {
        mysqli_autocommit($con, FALSE);
        $queryins   = str_replace(';', ' ', $qins);
        mysqli_query($con, $queryins) or die("ERROR EM15 - ".mysqli_error($con));
        $querygest  = "INSERT INTO histgest (auto,c_cvge) SELECT auto,'".$C_CVGE."'
FROM historia 
WHERE c_cont=".$C_CONT." AND d_fech='".$D_FECH."'
AND c_hrin='".$C_HRIN."' AND c_hrfi='".$C_HRFI."'
AND auto NOT IN (SELECT auto FROM histgest)
;";
        mysqli_query($con, $querygest) or die("ERROR RM6 - ".mysqli_error($con));
        $best       = $C_CONTAN;
        $querybest  = "select c_cvst, v_cc
            from historia,dictamenes
            where c_cont=".$C_CONT."
            and (d_prom>=curdate() or n_prom=0)
            and d_fech > curdate() - interval 2 month
            and c_cvst=dictamen
            order by v_cc limit 1;";
        $resultbest = mysqli_query($con, $querybest) or die("ERROR EM4 - ".mysqli_error($con));
        while ($answerbest = mysqli_fetch_row($resultbest)) {
            $best = $answerbest[0];
        }
        $querysa = "update resumen set status_aarsa='".$best."',fecha_ultima_gestion=now() where id_cuenta='".$C_CONT."';";

        mysqli_query($con, $querysa) or die("ERROR EM5 - ".mysqli_error($con));
        /*
          $querysa1 = "update resumen
          set status_aarsa='PAGO DEL MES ANTERIOR'
          where status_aarsa like 'PAG%' and status_aarsa not like 'PAGO TOTAL%'
          and id_cuenta=" . $C_CONT . "
          and id_cuenta in (select id_cuenta from pagos)
          and id_cuenta not in (select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
          and status_de_credito not like '%ivo';";
          mysqli_query($con,$querysa1) or die ("ERROR EM5a - ".mysqli_error($con));
         */
        $querysa1a = "update resumen
set status_aarsa='PAGO TOTAL DEL MES ANTERIOR'
where id_cuenta=".$C_CONT." 
and status_de_credito not like '%ivo'
and id_cuenta in (select id_cuenta from pagos
where fecha>last_day(curdate()-interval 2 month)
and fecha<=last_day(curdate()-interval 1 month))
and id_cuenta in (select c_cont from historia 
where c_cvst LIKE 'pago tota%' 
and d_fech>last_day(curdate()-interval 2 month)
and d_fech<=last_day(curdate()-interval 1 month))";
        mysqli_query($con, $querysa1a) or die("ERROR EM5aa - ".mysqli_error($con));
        /*
          $querysa2 = "
          update cobra.resumen set status_aarsa='PROMESA INCUMPLIDA'
          where id_cuenta=" . $C_CONT . "
          and id_cuenta not in (select c_cont from cobra.historia where n_prom>0
          and d_prom>=curdate())
          and id_cuenta in (select c_cont from cobra.historia where n_prom>0
          and d_prom<curdate())
          and id_cuenta not in (select c_cont from cobra.historia where n_prom2>0
          and d_prom2>=curdate())
          and id_cuenta not in (select c_cont from cobra.historia where c_cvst like 'PAGO TOTA%')
          and not exists (select * from pagos where fecha>=fecha_ultima_gestion
          and resumen.id_cuenta=pagos.id_cuenta)
          and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');
          ";
          mysqli_query($con,$querysa2) or die ("ERROR EM5b - ".mysqli_error($con));
         */
        $querysa2a = " 
update cobra.resumen set status_aarsa='PROMESA INCUMPLIDA DEL MES ANTERIOR'
where id_cuenta=".$C_CONT."
and id_cuenta not in (select c_cont from cobra.historia where n_prom>0
and d_prom>=curdate())
and id_cuenta in (select c_cont from cobra.historia where n_prom>0
and d_prom<=(last_day(curdate()-interval 1 month)))
and id_cuenta not in (select c_cont from cobra.historia 
where (n_prom2>0 and d_prom2>=curdate())
or (n_prom3>0 and d_prom3>=curdate())
or (n_prom4>0 and d_prom4>=curdate())
)
and id_cuenta not in (select c_cont from cobra.historia where c_cvst like 'PAGO TOTA%')
and not exists (select * from cobra.pagos where fecha>=fecha_ultima_gestion
and resumen.id_cuenta=pagos.id_cuenta)
and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');
";
        mysqli_query($con, $querysa2a) or die("ERROR EM5b1 - ".mysqli_error($con));

        $querysa2b = "update resumen, historia h1
set status_aarsa = 'PROMESA INCUMPLIDA'
where id_cuenta=".$C_CONT."
and c_cont=id_cuenta
and n_prom1>0
and d_prom1<curdate()
and status_de_credito not regexp '-'
and not exists (select * from historia h2 where h2.c_cont=id_cuenta and h2.n_prom>0 and h2.auto>h1.auto)
and not exists (select * from pagos where pagos.id_cuenta=resumen.id_cuenta and fecha<= h1.d_prom1)
and status_aarsa not like 'PAGO TOTA%';";
        mysqli_query($con, $querysa2b) or die("ERROR EM5b2 - ".mysqli_error($con));


        $querysa3 = "update resumen,historia
set status_aarsa = 'PROMESA HOY'
where status_aarsa <> 'PROMESA HOY'
AND d_prom=curdate()
and c_cont=id_cuenta
AND id_cuenta = $C_CONT
and fecha_de_ultimo_pago<last_day(curdate() - interval 1 month)
and fecha_ultima_gestion>curdate();";
        mysqli_query($con, $querysa3) or die("ERROR EM5c - ".mysqli_error($con));
        if (!empty($C_NTEL)) {
            $queryntel = "UPDATE resumen 
SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_NTEL." 
WHERE id_cuenta='".$C_CONT."'";
            mysqli_query($con, $queryntel) or die("ERROR EM6 - ".mysqli_error($con));
        }
        if (!empty($C_EMAIL)) {
            $queryndir = "UPDATE resumen SET email_deudor='".$C_EMAIL."' WHERE id_cuenta='".$C_CONT."'";
            mysqli_query($con, $queryndir) or die("ERROR EM7 - ".mysqli_error($con));
        }
        if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2,
                FILTER_SANITIZE_NUMBER_FLOAT)) {
            $querymemo = "UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_OBSE2." 
WHERE id_cuenta='".$C_CONT."'";
            mysqli_query($con, $querymemo) or die("ERROR EM8 - ".mysqli_error($con));
        }
        mysqli_commit($con);
        mysqli_autocommit($con, TRUE);
        if ($N_PAGO > 0) {
            $queryins = "INSERT INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA,FECHACAPT) 
    SELECT numero_de_cuenta,'$D_PAGO','$N_PAGO',cliente,'$capt',numero_de_credito,id_cuenta,now() 
    FROM resumen WHERE id_cuenta=".$C_CONT." and ('$D_PAGO','$N_PAGO',id_cuenta) not in 
    (select fecha,monto,id_cuenta from pagos where confirmado=0))";
            mysqli_query($con, $queryins) or die("ERROR EM9 - ".mysqli_error($con));

            $querysuc = "UPDATE resumen "
                ."SET numero_sucursal = '$numero_sucursal', "
                ."nombre_sucursal = '$nombre_sucursal' "
                ."WHERE id_cuenta=$C_CONT "
                ."AND '$C_CVST' like 'PAGO T%';";
            mysqli_query($con, $querysuc) or die("ERROR EM9a - ".mysqli_error($con));

            $querylast  = "select fecha,monto from pagos where (cuenta,cliente,fecha) in (select cuenta,cliente,max(fecha) from pagos where id_cuenta=".$C_CONT." group by id_cuenta);";
            $resultlast = mysqli_query($con, $querylast) or die("ERROR EM10 - ".mysqli_error($con));
            while ($answerlast = mysqli_fetch_row($resultlast)) {
//                $mfecha = $answerlast[0];
//                $mmonto = $answerlast[1];
            }
        }
        /*
          if ($merci > 0) {
          foreach ($MERC as $MERCa) {
          if (!empty($MERCa)) {
          $queryins = "INSERT INTO sdhmerc (ID_CUENTA,MERC,FECHAMERC,FECHACAPT)
          VALUES (" . $C_CONT . ",'" . $MERCa . "','" . $D_MERC . "',now())";
          mysqli_query($con, $queryins) or die("ERROR EM12 - " . mysqli_error($con));
          }
          }
          }
         */
        if (!empty($get['localizar'])) {
//            $queryloc = "update resumen set localizar=" . mysqli_real_escape_string($con, $get['LOCALIZAR']) . " where id_cuenta='" . $c_cont . "';";
//mysqli_query($con,$queryloc) or die ("ERROR EM13 - ".mysqli_error($con));
        }
        $queryups = "update folios,historia,resumen 
set enviado=0,fecha=d_fech+interval (time_to_sec(c_hrfi)) second 
where c_cont=id and n_prom>0 and d_fech>fecha and c_cvst like 'promesa de%'
and c_cont=id_cuenta and n_prom>=saldo_descuento_2
and d_fech=curdate() and fecha>last_day(curdate()-interval 1 month);";
        mysqli_query($con, $queryups) or die("ERROR FM4a - ".mysqli_error($con));

        if ($find == "/") {
            $find = NULL;
        }
        if ($capt == "/") {
            $capt = NULL;
        }
//$redirector = "Location: ".$uri."?&capt=".$capt."&go=ULTIMA";
        $redirector = "Location: closeme.php?msg=Usuario+no+es+valido";
//if ($N_PROM>0) {
//$redirector="/folios.php?capt=$capt&tipo=$mytipo&CUENTA=$CUENTA&CLIENTE=$C_CVBA&source=resumen-elastix&go=FOLIOS";
//}
        if ($C_CVST == "PROMESA DE PAGO TOTAL") {
            $redirector = "/folios.php?capt=$capt&tipo=$mytipo&CUENTA=$CUENTA&CLIENTE=$C_CVBA&source=resumen-elastix&go=FOLIOS";
        }
    }
    if ($error > 0) {
        $PAGOTXT = '';
        if (($C_CVST == "PROMESA DE PAGO TOTAL") || ($C_CVST == "PROMESA DE PAGO TOTAL")) {
            $PAGOTXT = " con toda promesa de ".$N_PROM." y fecha primera ".$D_PROM1;
        }
        if (empty($C_CVGE)) {
            $PAGOTXT = " y sin gestor ";
        }
        $redirector = "Location: closeme.php?msg=Checar que gestion de 
	cuenta ".$CUENTA." con status ".$C_CVST.$PAGOTXT."  
	está guardado corectamente.";
    }
    header($redirector);
}
if (substr($capt, 0, 8) == "practica") {
    $tcapt = "practica";
}
$mynombre = '';
$queryg   = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales='".$capt."'";
$resultg  = mysqli_query($con, $queryg) or die("ERROR EM18 - ".mysqli_error($con));
while ($answerg  = mysqli_fetch_row($resultg)) {
    $mynombre = $answerg[0];
    $mytipo   = $answerg[1];
    $camp     = $answerg[2];
}
$camp = 1;
if (empty($capt)) {
    $redirector = "Location: index.php";
    header($redirector);
}
if (empty($elastix)) {
    $redirector = "Location: closeme.php?msg=Gesti&oacute;n+guardado";
    header($redirector);
}
$id_cuenta = 0;
$lockflag  = 0;
$querymain = "SELECT * FROM resumen WHERE id_cuenta = '".$find."' LIMIT 1";
$result    = mysqli_query($con, $querymain) or die("ERROR EM19 - ".mysqli_error($con));
while ($row       = mysqli_fetch_row($result)) {
    $nombre_deudor          = $row[0];
    $domicilio_deudor       = $row[1];
    $colonia_deudor         = $row[2];
    $ciudad_deudor          = $row[3];
    $estado_deudor          = $row[4];
    $cp_deudor              = $row[5];
//    $plano_guia_roji = $row[6];
//    $cuadrante_guia_roji = $row[7];
    $tel_1                  = $row[8];
    $tel_2                  = $row[9];
    $tel_3                  = $row[10];
    $tel_4                  = $row[11];
    $nombre_deudor_alterno  = $row[12];
    $lockflag               = 0;
    /*
      $domicilio_deudor_alterno = $row[13];
      $colonia_deudor_alterno = $row[14];
      $ciudad_deudor_alterno = $row[15];
      $estado_deudor_alterno = $row[16];
      $cp_deudor_aterno = $row[17];
     */
    $tel_1_alterno          = $row[18];
    $tel_2_alterno          = $row[19];
    $tel_3_alterno          = $row[20];
    $tel_4_alterno          = $row[21];
//    $plano_guia_roji_alterno = $row[22];
//    $cuadrante_guia_roji_alterno = $row[23];
    $status_aarsa           = $row[24];
//    $sucursal_cliente = $row[25];
    $referencias_1          = $row[26];
    $nombre_referencia_1    = $row[27];
    /*
      $domicilio_referencia_1 = $row[28];
      $colonia_referencia_1 = $row[29];
      $ciudad_referencia_1 = $row[30];
      $estado_referencia_1 = $row[31];
      $cp_referencia_1 = $row[32];
     */
    $tel_1_ref_1            = $row[33];
    $tel_2_ref_1            = $row[34];
    $referencias_2          = $row[35];
    $nombre_referencia_2    = $row[36];
    /*
      $domicilio_referencia_2 = $row[37];
      $colonia_referencia_2 = $row[38];
      $ciudad_referencia_2 = $row[39];
      $estado_referencia_2 = $row[40];
      $cp_referencia_2 = $row[41];
     */
    $tel_1_ref_2            = $row[42];
    $tel_2_ref_2            = $row[43];
    $referencias_3          = $row[44];
    $nombre_referencia_3    = $row[45];
    /*
      $domicilio_referencia_3 = $row[46];
      $colonia_referencia_3 = $row[47];
      $ciudad_referencia_3 = $row[48];
      $estado_referencia_3 = $row[49];
      $cp_referencia_3 = $row[50];
     */
    $tel_1_ref_3            = $row[51];
    $tel_2_ref_3            = $row[52];
    $referencias_4          = $row[53];
    $nombre_referencia_4    = $row[54];
    /*
      $domicilio_referencia_4 = $row[55];
      $colonia_referencia_4 = $row[56];
      $ciudad_referencia_4 = $row[57];
      $estado_referencia_4 = $row[58];
      $cp_referencia_4 = $row[59];
     */
    $tel_1_ref_4            = $row[60];
    $tel_2_ref_4            = $row[61];
    $domicilio_laboral      = $row[62];
    $colonia_laboral        = $row[63];
    $ciudad_laboral         = $row[64];
    $estado_laboral         = $row[65];
    $cp_laboral             = $row[66];
    $tel_1_laboral          = $row[67];
    $tel_2_laboral          = $row[68];
//    $saldo_corriente = $row[69];
    $fecha_de_actualizacion = $row[70];
    $numero_de_cuenta       = $row[71];
    $numero_de_credito      = $row[72];
    $contrato               = $row[73];
    $saldo_total            = $row[74];
    $saldo_vencido          = $row[75];
    $saldo_descuento_1      = $row[76];
    $saldo_descuento_2      = $row[77];
//    $fecha_corte = $row[78];
//    $fecha_limite = $row[79];
    $fecha_de_ultimo_pago   = $row[80];
    $monto_ultimo_pago      = $row[81];
    $producto               = $row[82];
    $subproducto            = $row[83];
    $cliente                = $row[84];
//    $status_de_credito = '';
    $status_de_credito      = $row[85];
    $pagos_vencidos         = $row[86];
    if ($cliente == 'Surtidor del Hogar') {
        $queryxmora  = "SELECT floor(max(xmora)/30.25) FROM sdhextras
where cuenta='".$numero_de_cuenta."' order by subcuenta";
        $resultxmora = mysqli_query($con, $queryxmora);
        while ($answerxmora = mysqli_fetch_row($resultxmora)) {
            $pagos_vencidos = $answerxmora[0];
        }
    }
    $monto_adeudado      = $row[87];
    $fecha_de_asignacion = $row[88];
//    $fecha_de_deasignacion = $row[89];
//    $cuenta_concentradora_1 = $row[90];
    $saldo_cuota         = $row[91];
    if (empty($saldo_cuota)) {
        $saldo_cuota = 0;
    }
//    $expediente = $row[92];
    $id_cuenta = $row[93];
    if (empty($id_cuenta)) {
        $id_cuenta  = 0;
        $redirector = "Location: closeme.php?msg=id_cuenta+no+es+valido";
        header($redirector);
    } else {
        mysqli_autocommit($con, FALSE);
        $qsliced = "delete from rslice where user='".$capt."';";
        mysqli_query($con, $qsliced) or die("ERROR RM55 - ".mysqli_error($con));
        $qslice  = "replace into rslice select *, '".$capt."', now() from resumen where id_cuenta=".$id_cuenta;
        mysqli_query($con, $qslice) or die("ERROR EM55 - ".mysqli_error($con));
        mysqli_commit($con);
        mysqli_autocommit($con, TRUE);
    }
//    $pago_pactado = $row[94];
    $rfc_deudor                     = $row[95];
    $telefonos_marcados             = $row[96];
    $tel_1_verif                    = $row[97];
    $tel_2_verif                    = $row[98];
    $tel_3_verif                    = $row[99];
    $tel_4_verif                    = $row[100];
    $telefono_de_ultimo_contacto    = $row[101];
    $dias_vencidos                  = $row[102];
    $ejecutivo_asignado_call_center = $row[103];

//      $ejecutivo_asignado_domiciliario = $row[104];
    $numero_sucursal = $row[105];
//      $region_aarsa = $row[106];

    $parentesco_aval = $row[107];
    $localizar       = $row[108];
//    $campo_libre_9 = $row[109];
    $empresa         = $row[110];
//    $direccion_nueva = $row[115];
    $C_OBSE2         = '';
    $CUANDO          = '';
    $querycom        = "select c_obse2,c_cvst,cuando from historia where c_cont='".$id_cuenta."' order by d_fech desc, c_hrin desc limit 1";
    $resultcom       = mysqli_query($con, $querycom) or die("ERROR EM20 - ".mysqli_error($con));
    while ($answercom       = mysqli_fetch_row($resultcom)) {
        $C_OBSE2                     = $answercom[0];
        $ultimo_status_de_la_gestion = $answercom[1];
        $CUANDO                      = $answercom[2];
    }
    $ia         = 0;
    $queryauth  = "select distinct authcode*curdate() from nombres where authcode is not null";
    $resultauth = mysqli_query($con, $queryauth) or die("ERROR EM21 - ".mysqli_error($con));
    while ($answerauth = mysqli_fetch_row($resultauth)) {
//        $authcode[$ia] = $answerauth[0];
        $ia++;
    }
    $querycounts  = "select count(1),sum(n_prom>0) from historia where c_cont=".$id_cuenta.";";
    $resultcounts = mysqli_query($con, $querycounts) or die("ERROR RM44 - ".mysqli_error($con));
    while ($answercounts = mysqli_fetch_row($resultcounts)) {
        $countg  = $answercounts[0];
        $countpr = $answercounts[1];
    }
    $queryprom  = "select n_prom,d_prom,
        n_prom1,d_prom1,n_prom2,d_prom2,
        n_prom3,d_prom3,n_prom4,d_prom4,
        c_freq 
from historia 
where c_cont=".$id_cuenta." and n_prom>0 
and c_cvst like 'PROM%DE%'
order by d_fech desc, c_hrin desc limit 1";
    $resultprom = mysqli_query($con, $queryprom) or die("ERROR EM22 - ".mysqli_error($con));
    while ($answerprom = mysqli_fetch_assoc($resultprom)) {
        $N_PROM_OLD  = $answerprom['n_prom'];
//        $D_PROM_OLD = $answerprom[1];
        $N_PROM1_OLD = $answerprom['n_prom1'];
        $D_PROM1_OLD = $answerprom['d_prom1'];
        $N_PROM2_OLD = $answerprom['n_prom2'];
        $D_PROM2_OLD = $answerprom['d_prom2'];
        $N_PROM3_OLD = $answerprom['n_prom3'];
        $D_PROM3_OLD = $answerprom['d_prom3'];
        $N_PROM4_OLD = $answerprom['n_prom4'];
        $D_PROM4_OLD = $answerprom['d_prom4'];
    }
    $folio       = "";
    $nmerc       = 0;
    $nfolio      = 0;
    $queryfolio  = "SELECT max(folio) FROM folios WHERE id='".$id_cuenta."'
AND id>0 and mercancia=0 and fecha>last_day(curdate()-interval 1 month) order by fecha desc,folio desc limit 1
;";
    $resultfolio = mysqli_query($con, $queryfolio) or die("ERROR EM23 - ".mysqli_error($con));
    while ($answerfolio = mysqli_fetch_row($resultfolio)) {
        $folio = $answerfolio[0];
    }
    $querynmerc   = "SELECT min(folio) FROM folios WHERE cliente='".$cliente."'
and usado=0 and mercancia=1;";
    $npagos       = 0;
    $querynpagos  = "SELECT count(1) FROM pagos WHERE id_cuenta=".$id_cuenta.";";
    $resultnpagos = mysqli_query($con, $querynpagos) or die("ERROR RM48b - ".mysqli_error($con));
    while ($answernpagos = mysqli_fetch_row($resultnpagos)) {
        $npagos = $answernpagos[0];
    }
    $resultnmerc = mysqli_query($con, $querynmerc) or die("ERROR EM24 - ".mysqli_error($con));
    while ($answernmerc = mysqli_fetch_row($resultnmerc)) {
        $nmerc = $answernmerc[0];
    }
    $querynfolio  = "SELECT min(folio) FROM folios WHERE cliente='".$cliente."'
and usado=0 and mercancia=0;";
    $resultnfolio = mysqli_query($con, $querynfolio) or die("ERROR EM25 - ".mysqli_error($con));
    while ($answernfolio = mysqli_fetch_row($resultnfolio)) {
        $nfolio = $answernfolio[0];
    }
    $querycheck  = "SELECT timelock, locker,time_to_sec(timediff(now(),timelock))/60 from resumen  WHERE id_cuenta='".$id_cuenta."';";
    $resultcheck = mysqli_query($con, $querycheck) or die("ERROR EM27 - ".mysqli_error($con));
    while ($answercheck = mysqli_fetch_row($resultcheck)) {
//        $timelock = $answercheck[0];
        $locker = $answercheck[1];
//        $sofar = $answercheck[2];
    }
    $tl          = date('r');
    $queryunlock = "UPDATE resumen SET timelock=NULL, locker=NULL 
WHERE locker='".$capt."';";
    mysqli_query($con, $queryunlock) or die("ERROR EM28 - ".mysqli_error($con));
    if (1 == 1) {
        if (!(empty($locker)) && ($locker != $capt)) {
            $lockflag = 1;
        } else {
            $queryunlock  = "UPDATE resumen SET timelock=NULL, locker=NULL
WHERE locker='".$capt."';";
            $querylock    = "UPDATE resumen SET timelock=now(),locker='".$capt."' WHERE id_cuenta='".$id_cuenta."';";
            $queryunlock2 = "UPDATE rslice SET timelock=NULL, locker=NULL 
WHERE locker='".$capt."';";
            $querylock2   = "UPDATE rslice SET timelock=now(),locker='".$capt."' WHERE id_cuenta='".$id_cuenta."';";
            mysqli_autocommit($con, FALSE);
            mysqli_query($con, $queryunlock) or die("ERROR EM29 - ".mysqli_error($con));
            mysqli_query($con, $querylock) or die("ERROR EM30 - ".mysqli_error($con));
            mysqli_query($con, $queryunlock2) or die("ERROR RM51 - ".mysqli_error($con));
            mysqli_query($con, $querylock2) or die("ERROR RM52 - ".mysqli_error($con));
            mysqli_commit($con);
            $querytlock   = "SELECT date_format(timelock,'%a, %d %b %Y %T') FROM
resumen 
WHERE id_cuenta='".$id_cuenta."';";
            $resulttlock  = mysqli_query($con, $querytlock) or die("ERROR EM31 - ".mysqli_error($con));
            while ($answertlock  = mysqli_fetch_row($resulttlock)) {
                $tl = $answertlock[0];
            }
            $breakflag   = 0;
            $querybreak  = "SELECT tipo,empieza,termina FROM breaks
WHERE time(now()) between empieza and termina and gestor='".$capt."';";
            $resultbreak = mysqli_query($con, $querybreak) or die("ERROR EM32 - ".mysqli_error($con));
            while ($answerbreak = mysqli_fetch_row($resultbreak)) {
                $breakflag = 1;
                $btipo     = $answerbreak[0];
                $bemp      = $answerbreak[1];
                $bterm     = $answerbreak[2];
            }
        }
    }
}
$queryd  = "select curdate()-interval 1 day as yesterday,
least(last_day(curdate()+interval 1 day),
curdate()+interval 7 day) as dend,
last_day(curdate()+interval 1 month) as denda,
least(last_day(curdate()+interval 1 day),
curdate()+interval 15 day) as dend2;";
$resultd = mysqli_query($con, $queryd) or die("ERROR EMqd - ".mysqli_error($con));
while ($answerd = mysqli_fetch_row($resultd)) {
    $yesterday = $answerd[0];
    $dday      = $answerd[1];
    $dday2     = $answerd[3];
    if ($mytipo == 'admin') {
        $dday  = $answerd[2];
        $dday2 = $answerd[2];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Resumen desde ELASTIX</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
        <script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
        <style type="text/css">
            body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #ffffff;color:#000000;}
            .hidebox {display:none}
            div {clear:both}
            span.formcap {display: block; width: 20em; float: left; font-size: 100%; font-weight:bold;}
            span.formcapa {display: block; width: 13em; float: left; font-size: 100%; font-weight:bold;}
            span.formcaps {display: block; width: 6em; float: left; font-size: 100%; font-weight:bold;}
            #deudor {width: 7em;}
            #domicilio {width: 7em;}
            span.formtit {display: block; width: 24em; float: left; font-size: 100%; font-weight:bold;}
            span.formfirst {display: block; width: 24em; float: left;}
            select, input, button {font-family: verdana,arial, helvetica, sans-serif;font-size:100%}
            input {font-family: verdana,arial, helvetica, sans-serif;font-size:100%; font-weight:bold;}
            #GESTION input {font-size:80%; width:auto}
            #GENERAL textarea {font-family: verdana,arial, helvetica, sans-serif;font-size:90%;width:9cm; font-weight:normal;}
            #GENERAL table {width:100%}
            #GENERAL td {border:0}
            #CONTABLES table {width:100%}
            #CONTABLES td {border:0; font-weight:normal; font-size:90%;}
            #GESTION table {width:100%;background-color:#ddffdd}
            #GESTION tr {background-color:#ddffdd}
            #GESTION td {border:0; font-weight:bold; font-size:80%; background-color:#ddffdd}
            #VISITA table {width:100%}
            #VISITA td {border:0; font-weight:normal; font-size:90%;}
            a:link {color:blue;}   
            a:visited {color:green;}   
            a:hover {color:red;}   
            a:active {color:yellow;}   
            #telefono2 {font-weight:bold;}   
            #telbox span.formcap {display: block; width: 14em; float: left;}
            #demobox {float: left;}
            .telbox {float: left;}
            .verif {font-weight:bold; background-color:#00ff00;}
            #descbox {float: left;}
            #gestionbox {clear: right;}
            #capturabox {float: left;}
            #guardbox {float: left; width:42em;}
            #captresbox {float: left;}
            #notabox {float: left;}
            .clearbox {clear: both; text-align: center;}
            table {color:#000000;}
            tr {height:2em;}
            th {width: 9em;}
            th.gestion {width: 32em;}
            th.status {width: 16em;}
            th.timestamp {width: 8em;}
            th.telefono {width: 8em;}
            th.chico {width: 5em;}
            td {border: 1pt solid #000000;background-color: #ffffff; width:10em;}
            td.gestion {width: 32em;height: 1em;overflow:hidden;}
            td.status {width: 16em;}
            td.timestamp {width: 8em;}
            td.telefono {width: 8em;}
            td.chico {width: 5em;}
            #tableContainer {height: 4cm; overflow: scroll;}
            .noshow { display: none; width: 0;}
            #searchbox {z-index: 98; display: none; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
            #searchbox input {color: #000000; background-color: #ffffff;}
            #calm {z-index: 98; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
            #calm input {color: #000000; background-color: #ffffff;}
            #pagocapt td {background-color: #ffff00;}
            #pagocapt2 td {background-color: #ffff00;}
            .visitable td {border:0; background-color: transparent;width:auto;}
            #buttonbox form {float:left}
            .buttons {float:left;width:auto}
            .buttons input {float:left}
            .buttons button {float:left;width:auto}
            <?php if ($notalert > 0) { ?> 
                #notasq input {background-color: #ff0000;}
                <?php
            }
            if ($pagalert > 0) {
                ?> 
                #pagos input {background-color: #ff0000;}
                <?php
            }
            if ($mytipo == 'visitador') { ?> 
                #databox,#prombox,#nuevoboxt,#combox,#guardbox,#dtelboxt,#clock {display:none;}
                #visitboxt,#visitbox {display:block;}
<?php
}
if ($cliente != "Prestamo Familiar") {
    ?>
                .PrestamoFamiliar { visibility:hidden;}
    <?php
}
?>
            .deudor {color: #ff0000;}
            .visit {color: #00aa00;}
            #avalbox input {font-size: 85%}
            #avalbox .shortinp {width: 5em;}
        </style>
        <script type="text/javascript" src="dom-drag.js"></script>
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
            $(function() {
            $( "#tab" ).tabs();
            $( ".buttons button" ).button();
            $( ".buttons input[name='go']" ).button();
            $( "#inactivo" ).dialog({ 
            autoOpen: false, 
            modal: true, 
            buttons: { "Ok": function() { $(this).dialog("close"); } } });
<?php
if ((preg_match('/o$/', $status_de_credito)) || (preg_match('/o$/',
        $status_de_credito))) {
    ?>
                $("#inactivo").dialog("open")
<?php } ?>

            });
            function trim(str)
            {
            if(!str || typeof str != 'string')
            return null;

            return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
            }function beep() {}
            function paging(pageid) {
            document.getElementById("TELEFONOS").style.display="none";
            document.getElementById("REFERENCIAS").style.display="none";
            document.getElementById("LABORAL").style.display="none";
            document.getElementById("CONTABLES").style.display="none";
            document.getElementById("MISCELANEA").style.display="none";
<?php if (($cliente == 'FISA') || ($cliente == 'Surtidor del Hogar')) { ?>
                document.getElementById("EXTRAS").style.display="none";
<?php } ?>
            document.getElementById("HISTORIA").style.display="none";
            document.getElementById(pageid).style.display="block";
            document.getElementById("GESTION").style.display="block";
            }
            function gestionChange(thisform)
            {
            with (thisform) {
            N_PROM.value=(N_PROM1.value*1)+(N_PROM2.value*1)+(N_PROM3.value*1)+(N_PROM4.value*1);
            if ((C_CVST.value=='PAGO TOTAL')||(C_CVST.value=='PAGO PARCIAL')||(C_CVST.value=='PAGANDO CONVENIO')||(C_CVST.value=='REESTRUCTURADA')||(C_CVST.value=='REGULARIZADA')) {
            document.getElementById("pagocapt").style.display="table-row";document.getElementById("pagocapt2").style.display="table-row";
            }
            }
            }

            function clock() {
            var d=new Date();
            var tn=d.getTime();
            var tll = new Date('<?php echo $tl; ?>');
            var tl=tll.getTime();
            document.getElementById("timer").value=tn-tl;
            document.getElementById("timers").value=parseInt(parseInt(document.getElementById("timer").value)/1000)%60;
            document.getElementById("timerm").value=parseInt(parseInt(document.getElementById("timer").value)/1000/60);
            if (document.getElementById("timerm").value>2) {
            document.getElementById("clock").style.backgroundColor="yellow";
            }
            if (document.getElementById("timerm").value>4) {
            document.getElementById("clock").style.backgroundColor="red";
            }
            if (document.getElementById("timer").value%2==0) {
            document.getElementById("clock").style.backgroundColor="green";
            }
            }
            function openSearch() {
            setInterval('clock()',1000);
            <?php
            if (isset($breakflag)) {
                if ($breakflag == 1) {
                    ?>
                    alert("Tiene <?php echo $btipo; ?> entre <?php echo $bemp; ?> y <?php echo $bterm; ?>");
        <?php
    }
}
if ($lockflag == 1) {
    ?>
                alert("ERROR EA5 - Esta record está en uso de <?php echo $locker ?>");
<?php } ?>
            }

            var r={
            'special':/[\W]/g,
            'quotes':/['\''&'\"']/g,
            'notnumbers':/[^\d]/g
            }

            function valid(o,w){
            o.value = o.value.replace(r[w],' ');
            }

            function tooLong(e)
            {
            if (window.document.getElementById("C_OBSE1").value.length>250) {
            window.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.replace('  ',' ');
            window.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.substr(0,200);
            confirm('GESTION demasiado largo');
            window.document.getElementById("C_OBSE1").style.backgroundColor="yellow";
            return false;}
            }
            function logout()
            {
            window.location="resumen-elastix.php?capt=<?php echo $capt; ?>&go='LOGOUT'";
            }

            function showsearch()
            {
            document.getElementById('searchbox').style.display="block";
            document.getElementById('find').focus();
            }
            function showbox(boxname)
            {
            document.getElementById(boxname).style.display="block";
            }
            function cancelbox(boxname)
            {
            document.getElementById(boxname).style.display="none";
            searching="";
            }
            function addToTels(pos,tel) {
            document.getElementById("C_TELE").options[pos]=new Option(tel.value, tel.value, true, true);
            document.getElementById("C_TELE").options[pos].style.fontWeight="bold";
            document.getElementById("C_TELE").options[pos].style.backgroundColor="#00FF00";
            }
            function dial(capt,cta) {
            tel=document.gestion.C_TELE.value;
            if (!parseInt(tel)){alert('ERROR EA6 - No es numero.');}
            else if ((tel.length!=8) && (tel.length!=10) && (tel.length!=12) && (tel.length!=13)) {
            alert('ERROR EA7 - Telefono invalido.');
            }
            else {
            dialstr="dial2.php?capt="+capt+"&cta="+cta+"&tel="+tel;
            window.open(dialstr);
            }
            }
        </SCRIPT>
        <script type="text/javascript" src="depuracion.js"></script>
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
    </head>
    <body onLoad="alerttxt = new String('');
            paging('HISTORIA');
            openSearch();<?php ?>" id="todos">
        <div id="buttonbox">
                <?php if (true) { ?>
                <form class="buttons" name="visitlist" method="get" action=
                      "visitlist.php" id="visitlist" target="_blank">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    <input type="hidden" name="ejecutivo_asignado_call_center" value="<?php echo $ejecutivo_asignado_call_center ?>">
                    <input type="submit" name="go" value="VISITAS"></form>
                <form class="buttons" name="pagos" method="get" action="pagos.php" id="pagos" target="_blank">
                    <input type="hidden" name="capt" value="<?php
                           if (isset($capt)) {
                               echo $capt;
                           }
                           ?>">
                    <input type="hidden" name="id_cuenta" value="<?php
                        if (isset($id_cuenta)) {
                            echo $id_cuenta;
                        }
                        ?>">
                    <input type="submit" name="go" value="PAGOS"></form>
                    <?php
                    $CTA = $numero_de_credito;
                    if ($cliente != 'Prestamo Relampago') {
                        $CTA = $numero_de_cuenta;
                    }
                    if (($cliente == 'Credito Si B') || ($cliente == 'Credito Si F')) {
                        ?>
                    <form class="buttons" name="folios" method="get" action="folios.php" id="folios" target="_blank">
                        <input type="hidden" name="capt" value="<?php
                               if (isset($capt)) {
                                   echo $capt;
                               }
                               ?>">
                        <input type="hidden" name="tipo" value="<?php
                    if (isset($mytipo)) {
                        echo $mytipo;
                    }
                    ?>">
                        <input type="hidden" name="CUENTA" value="<?php echo $CTA; ?>">
                        <input type="hidden" name="CLIENTE" value="<?php echo $cliente; ?>">
                        <input type="hidden" name="source" value="resumen-elastix">
                        <input type="submit" name="go" value="FOLIOS"></form>
                    <?php } ?>
                <form class="buttons" name="notas" method="get" action="notas.php" id="notas" target="_blank"><input type="hidden"
                                                                                                                     name="capt" value="<?php
                           if (isset($capt)) {
                               echo $capt;
                           }
                           ?>">
                    <input type="hidden" name="CUENTA" value="<?php
                           if (isset($numero_de_cuenta)) {
                               echo $numero_de_cuenta;
                           }
                           ?>">
                    <input type="hidden" name="C_CONT" value="<?php
                    if (isset($id_cuenta)) {
                        echo $id_cuenta;
                    }
                    ?>">
                    <input type="submit" name="go" value="NOTAS"></form>
                <form class="buttons" name="logout" method="get" action=
                      "resumen-elastix.php" id="logout">
                    <input type="hidden" name="capt" value="<?php
                       if (isset($capt)) {
                           echo $capt;
                       }
                       ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    <input type="submit" name="go" value="LOGOUT"></form>
                <button><?php echo $cliente ?></BUTTON>
                <?php if ($mytipo == 'admin') { ?>
                    <form class="buttons" action="reports.php" method="get">
                        <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                        <input type="submit" value="REPORTES">
                    </form>
                <?php } ?>

                <span style='font-weight:bold;font-size:120%;'><?php echo $capt; ?></span>
                <?php if (!empty($cliente)) { ?>
                    <span onmouseover='this.style.visibility = "hidden";'><img style="position:absolute;top:0;right:0" height=50 alt="client logo" src='<?php echo $cliente ?>.jpg'></span>
                        <?php
                    }
                    if ($nfolio > 0) {
                        echo $nfolio;
                        ?>
                    &nbsp;es folio sig.
                           <?php } ?>
                <form class="buttons" name="trouble" method="get" action="trouble.php" id="trouble" target="_blank">
                    <input type="hidden" name="capt" value="<?php
                       if (isset($capt)) {
                           echo $capt;
                       }
                       ?>">
    <?php
    include 'privacidadInclude.php';
    ?>
                    <input type="submit" name="go" value="ERROR">
                </form>
            </div>
            <form action="#" method="post" name="resumenform" id=
                  "resumenform">
                <div id="GENERAL">
                    <table summary="demograficas">
                        <tr>
                            <td>
                                <span class='formcapa' id='deudor'>Deudor</span><input type='text' size=50 style='width:7.1cm' name=nombre_deudor id="nombre_deudor" readonly='readonly' value='<?php
                                    if (isset($nombre_deudor)) {
                                        echo htmlentities($nombre_deudor);
                                    }
                                    ?>'><br>
                            </td>
                            <td>
                                <span class='formcapa' id='domicilio'>Domicilio</span>
                                <textarea name=domicilio_deudor id=domicilio_deudor readonly='readonly' rows=5 cols=20>
                                <?php echo $domicilio_deudor."\n".$colonia_deudor."\n".$ciudad_deudor.", ".$estado_deudor.'  '.$cp_deudor; ?>
                                </textarea>
                            </td>
                        <tr>
                            <td>
                                <span class='formcapa'>Gestor - call center</span><input type='text' name=ejecutivo_asignado_call_center readonly='readonly' value='<?php
                                                                                     if (isset($ejecutivo_asignado_call_center)) {
                                                                                         echo $ejecutivo_asignado_call_center;
                                                                                     }
                                                                                     ?>'><br>
                                <span class='formcapa'>Numero de cuenta</span><input type='text' name=numero_de_cuenta id="numero_de_cuenta" readonly='readonly' value='<?php
                                if (isset($numero_de_cuenta)) {
                                    echo $numero_de_cuenta;
                                }
                                ?>'><br>
                                <span class='formcapa'>Gestiones: <?php echo $countg; ?></span>&nbsp;<span class='formcapa'>Promesas: <?php echo $countpr; ?></span><span class='formcapa'>Pagos: <?php echo $npagos; ?></span><br>
                                <span class='formcapa'>Status de la Cuenta</span><input type='text' name=status_aarsa readonly='readonly' value='<?php
                                if (isset($status_aarsa)) {
                                    echo $status_aarsa;
                                }
                                ?>'><br>
                            </td>
                            <td>
                                <div id='clock'>
                                    <input type="hidden" name="timer" id="timer" readonly="readonly" value="0">:
                                    <input type="text" name="timerm" id="timerm" readonly="readonly" value="0" size="3">:
                                    <input type="text" name="timers" id="timers" readonly="readonly" value="0" size="3"><br>
                                    <?php
                                    $numgest  = 0;
                                    $numprom  = 0;
                                    $queryng  = "SELECT count(1),sum(n_prom>0) FROM historia
WHERE c_cvge='".$capt."' 
AND d_fech=curdate()
AND c_cont <> '0'
";
                                    $resultng = mysqli_query($con, $queryng);
                                    $campoc   = " style='background-color:red; color:white;'";
                                    while ($answerng = mysqli_fetch_row($resultng)) {
                                        $numgest = $answerng[0];
                                        $numprom = $answerng[1] + 0;
                                        if ($numgest > 20) {
                                            $campoc = " style='background-color:yellow; color:black;'";
                                        }
                                        if ($numgest > 40) {
                                            $campoc = " style='background-color:green; color:white;'";
                                        }
                                    }
                                    ?>
                                    <input type="text"<?php echo $campoc; ?> name="numgest" id="numgest" readonly="readonly" value="<?php echo $numgest.' gestiones'; ?>">
                                    <input type="text" name="numprom" id="numprom" readonly="readonly" value="<?php echo $numprom.' promesas'; ?>">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="clearbox" id="tab">
                    <UL class='tabs'>
                        <LI><A onClick="paging('TELEFONOS');">TELEFONOS</A></LI>
                        <LI><A onClick="paging('REFERENCIAS');">REFERENCIAS</A></LI>
                        <LI><A onClick="paging('LABORAL');">LABORAL</A></LI>
                        <LI><A onClick="paging('CONTABLES');">CONTABLES</A></LI>
                        <LI><A onClick="paging('MISCELANEA');">MISCELANEA</A></LI>
                    <?php if (($cliente == 'FISA') || ($cliente
                        == 'Surtidor del Hogar')) { ?>
                            <LI><A onClick="paging('EXTRAS');">EXTRAS</A></LI>
                                                             <?php } ?>
                        <LI><A onClick="paging('HISTORIA');">HISTORIA</A></LI>
                    </UL>
                </div>
                <div id="TELEFONOS">
                    <span class='formcap'>Tel 1</span><input type='text' name=tel_1 id="tel_1" readonly='readonly' value='<?php
                                                         if (isset($tel_1)) {
                                                             echo $tel_1;
                                                         }
                                                             ?>'><br>
                    <span class='formcap'>Tel 2</span><input type='text' name=tel_2 id="tel_2" readonly='readonly' value='<?php
                if (isset($tel_2)) {
                    echo $tel_2;
                }
                                                             ?>'><br>
                    <span class='formcap'>Tel 3</span><input type='text' name=tel_3 id="tel_3" readonly='readonly' value='<?php
                if (isset($tel_3)) {
                    echo $tel_3;
                }
                ?>'><br>
                    <span class='formcap'>Tel 4</span><input type='text' name=tel_4 id="tel_4" readonly='readonly' value='<?php
                    if (isset($tel_4)) {
                        echo $tel_4;
                    }
                    ?>'><br>
                </div>
                <div id="REFERENCIAS">
                                                             <?php if (isset($nombre_deudor_alterno)) { ?>
                        <span class='formcaps'>Aval</span><input type='text' name=nombre_deudor_alterno id="nombre_deudor_alterno" readonly='readonly' value='<?php
                        if (isset($nombre_deudor_alterno)) {
                            echo htmlentities($nombre_deudor_alterno);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($parentesco_aval)) {
                               ?>
                        <input type='text' name=parentesco_aval class='shortinp' readonly='readonly' value='<?php
                        if (isset($parentesco_aval)) {
                            echo $parentesco_aval;
                        }
                        ?>'><br>
                                                              <?php } ?>
                    <br>
                                                              <?php if (isset($tel_1_alterno)) { ?>
                        <span class='formcaps'>Tel 1</span><input type='text' name=tel_1_alterno id="tel_1_alterno" readonly='readonly' value='<?php
                        if (isset($tel_1_alterno)) {
                            echo $tel_1_alterno;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_2_alterno)) {
                                                                  ?>
                        <span class='formcaps'>Tel 2</span><input type='text' name=tel_2_alterno id="tel_2_alterno" readonly='readonly' value='<?php
                        if (isset($tel_2_alterno)) {
                            echo $tel_2_alterno;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_3_alterno)) {
                                                                  ?>
                        <span class='formcaps'>Tel 3</span><input type='text' name=tel_3_alterno id="tel_3_alterno" readonly='readonly' value='<?php
                        if (isset($tel_3_alterno)) {
                            echo $tel_3_alterno;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_4_alterno)) {
                                                                  ?>
                        <span class='formcaps'>Tel 4</span><input type='text' name=tel_4_alterno id="tel_4_alterno" readonly='readonly' value='<?php
                        if (isset($tel_4_alterno)) {
                            echo $tel_4_alterno;
                        }
                        ?>'><br>
                        <?php
                    }
                    if ($cliente == 'UR') {
                        ?>
                        <span class='formcap'>Madre</span>
                    <?php } else { ?>
                        <span class='formcaps'>Ref 1</span>
                               <?php
                           }
                           if (isset($nombre_referencia_1)) {
                               ?>
                        <input type='text' size=40 name=nombre_referencia_1 id="nombre_referencia_1" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_1)) {
                            echo htmlentities($nombre_referencia_1);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_1)) {
                               ?>
                        <input type='text' name=referencias_1 class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_1)) {
                            echo $referencias_1;
                        }
                        ?>'><br>
                                                              <?php } ?>
                    <br>
                                                              <?php if (isset($tel_1_ref_1)) { ?>
                        <span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_1 id="tel_1_ref_1" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_1)) {
                            echo $tel_1_ref_1;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_2_ref_1)) {
                                                                  ?>
                        <span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_1 id="tel_2_ref_1" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_1)) {
                            echo $tel_2_ref_1;
                        }
                        ?>'><br>
                        <?php
                    }
                    if ($cliente == 'UR') {
                        ?>
                        <span class='formcap'>Padre</span>
                    <?php } else { ?>
                        <span class='formcaps'>Ref 2</span>
                               <?php
                           }
                           if (isset($nombre_referencia_2)) {
                               ?>
                        <input type='text' size=40 name=nombre_referencia_2 id="nombre_referencia_2" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_2)) {
                            echo htmlentities($nombre_referencia_2);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_2)) {
                               ?>
                        <input type='text' name=referencias_2  class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_2)) {
                            echo $referencias_2;
                        }
                        ?>'><br>
                                                              <?php } ?>
                    <br>
                                                              <?php if (isset($tel_1_ref_2)) { ?>
                        <span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_2 id="tel_1_ref_2" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_2)) {
                            echo $tel_1_ref_2;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_2_ref_2)) {
                                                                  ?>
                        <span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_2 id="tel_2_ref_2" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_2)) {
                            echo $tel_2_ref_2;
                        }
                        ?>'><br>
                        <?php
                    }
                    if ($cliente == 'UR') {
                        ?>
                        <span class='formcap'>Tutor</span>
                    <?php } else { ?>
                        <span class='formcaps'>Ref 3</span>
                               <?php
                           }
                           if (isset($nombre_referencia_3)) {
                               ?>
                        <input type='text' size=40 name=nombre_referencia_3 id="nombre_referencia_3" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_3)) {
                            echo htmlentities($nombre_referencia_3);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_3)) {
                               ?>
                        <input type='text' name=referencias_3  class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_3)) {
                            echo $referencias_3;
                        }
                        ?>'><br>
                                                              <?php } ?>
                    <br>
                                                              <?php if (isset($tel_1_ref_3)) { ?>
                        <span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_3 id="tel_1_ref_3" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_3)) {
                            echo $tel_1_ref_3;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_2_ref_3)) {
                                                                  ?>
                        <span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_3 id="tel_2_ref_3" readonly='readonly' value='<?php
                                                          if (isset($tel_2_ref_3)) {
                                                              echo $tel_2_ref_3;
                                                          }
                                                                  ?>'><br>
                               <?php
                           }
                           if (isset($nombre_referencia_4)) {
                               ?>
                        <span class='formcaps'>Cosolicitante</span>
                        <input type='text' size=40 name=nombre_referencia_4 id="nombre_referencia_4" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_4)) {
                            echo htmlentities($nombre_referencia_4);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_4)) {
                               ?>
                        <input type='text' name=referencias_4  class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_4)) {
                            echo $referencias_4;
                        }
                        ?>'><br>
                                                              <?php } ?>
                    <br>
                                                              <?php if (isset($tel_1_ref_4)) { ?>
                        <span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_4 id="tel_1_ref_4" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_4)) {
                            echo $tel_1_ref_4;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_2_ref_4)) {
                                                                  ?>
                        <span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_4 id="tel_2_ref_4" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_4)) {
                            echo $tel_2_ref_4;
                        }
                        ?>'><br>
                    <?php } ?>
                </div>

                <div id="LABORAL">
                    <span class='formcap'>Empresa</span><input type='text' name=empresa readonly='readonly' value='<?php
                    if (isset($empresa)) {
                        echo $empresa;
                    }
                    ?>'><br>
                    <span class='formcap'>Domicilio</span><input type='text' name=domicilio_laboral readonly='readonly' value='<?php
                if (isset($domicilio_laboral)) {
                    echo $domicilio_laboral;
                }
                    ?>'><br>
                    <span class='formcap'>Colonia</span><input type='text' name=colonia_laboral readonly='readonly' value='<?php
                if (isset($colonia_laboral)) {
                    echo $colonia_laboral;
                }
                    ?>'><br>
                    <span class='formcap'>Ciudad</span><input type='text' name=ciudad_laboral readonly='readonly' value='<?php
                if (isset($ciudad_laboral)) {
                    echo $ciudad_laboral;
                }
                    ?>'><br>
                    <span class='formcap'>Estado</span><input type='text' name=estado_laboral readonly='readonly' value='<?php
                if (isset($estado_laboral)) {
                    echo $estado_laboral;
                }
                    ?>'><br>
                    <span class='formcap'>CP</span><input type='text' name=cp_laboral readonly='readonly' value='<?php
                if (isset($cp_laboral)) {
                    echo $cp_laboral;
                }
                    ?>'><br>
                    <span class='formcap'>Tel 1</span><input type='text' name=tel_1_laboral id="tel_1_laboral" readonly='readonly' value='<?php
                if (isset($tel_1_laboral)) {
                    echo $tel_1_laboral;
                }
                    ?>'><br>
                    <span class='formcap'>Tel 2</span><input type='text' name=tel_2_laboral id="tel_2_laboral" readonly='readonly' value='<?php
            if (isset($tel_2_laboral)) {
                echo $tel_2_laboral;
            }
            ?>'><br>
                </div>
    <?php
    if ($cliente == 'FISA') {
        ?>
                    <div id="EXTRAS">
                        <table summary="sdh extras">
                            <tr>
                                <th>Grupo</th>
                                <th>Dias Vencidos</th>
                                <th>Meses Vencidos</th>
                                <th>Cuenta Banamex</th>
                                <th>Ref. Banamex</th>
                                <th>Ref. BBVA</th>
                                <th>Ref. Conexia</th>
                                <th>Ref. FISA</th>
                            </tr>
        <?php
        $prods     = "";
        $querysdh  = "SELECT grupo,mora,mora/30.25,c_bmx,a_bmx,a_bbva,a_conexia,a_fisa
 FROM fisa_extras 
where credito='".$numero_de_credito."'";
        $resultsdh = mysqli_query($con, $querysdh);
        while ($answersdh = mysqli_fetch_row($resultsdh)) {
            ?>
                                <tr>
                                    <td><?php echo $answersdh[0]; ?></td>
                                    <td><?php echo $answersdh[1]; ?></td>
                                    <td><?php echo $answersdh[2]; ?></td>
                                    <td><?php echo $answersdh[3]; ?></td>
                                    <td><?php echo $answersdh[4]; ?></td>
                                    <td><?php echo $answersdh[5]; ?></td>
                                    <td><?php echo $answersdh[6]; ?></td>
                                    <td><?php echo $answersdh[7]; ?></td>
                                </tr>
            <?php
        }
        ?>
                        </table>
                    </div>
                                <?php } ?>
                <br>
                </div>

                <div id="CONTABLES">
                    <table summary="contables">
                        <tr>
                            <td>Numero de credito</td>
                            <td><input type='text' name=numero_de_credito readonly='readonly' value='<?php
                                if (isset($numero_de_credito)) {
                                    echo $numero_de_credito;
                                }
                                ?>'></td>
                                <?php if (($cliente
                                    != 'GE Capital') && ($cliente != 'CrediClub')) { ?>
                                <td>Ultimo folio</td>
                                <td><?php if ($folio != '') { ?>
                                        <input type='text' name='folio' id='folio' readonly='readonly' value='<?php
                                    echo
                                    $folio;
                                    ?>'></td>
                                    <?php
                                }
                            }
                            if ($cliente == 'GE Capital') {
                                ?>
                                <td>Convenio CIE Bancomer</td>
                                <td style='font-weight:bold'>632236-<?php echo $numero_de_cuenta; ?><br></td>
                                <?php
                            }
                            if ($cliente == 'Provident') {
                                ?>
                                <td>BANCO BANAMEX<br>
                                    CUENTA 28552<br>
                                    SUCURSAL 4778<br>
                                    REFERENCIA <?php echo $numero_de_cuenta; ?></td>
                                <td>BANCO SANTANDER SERFIN 65502341276<br>
                                    REFERENCIA <?php echo $numero_de_cuenta; ?></td>
                                    <?php
                                }
                                if ($cliente == 'CrediClub') {
                                    ?>
                                <td>Convenio CIE Banorte</td>
                                <td style='font-weight:bold'>44568-<?php echo substr($numero_de_credito,
                                -8); ?><br></td>
    <?php }
    ?>

                            <td>ID cuenta</td>
                            <td><input type='text' name="id_cuenta" id="id_cuenta" readonly='readonly' value='<?php
                                       if (isset($id_cuenta)) {
                                           echo $id_cuenta;
                                       }
                                       ?>'></td>
                        </tr>
                        <tr>
                            <td>Fecha de asignacion</td>
                            <td><input type='text' name=fecha_de_asignacion readonly='readonly' value='<?php
                            if (isset($fecha_de_asignacion)) {
                                echo $fecha_de_asignacion;
                            }
                                       ?>'></td>
                            <td>Fecha de actualizacion</td>
                            <td><input type='text' name=fecha_de_actualizacion readonly='readonly' value='<?php
                            if (isset($fecha_de_actualizacion)) {
                                echo $fecha_de_actualizacion;
                            }
                                       ?>'></td>
                            <td>RFC deudor</td>
                            <td><input type='text' name=rfc_deudor readonly='readonly' value='<?php
                                       if (isset($rfc_deudor)) {
                                           echo $rfc_deudor;
                                       }
                                       ?>'></td>
                        </tr>
                        <tr>
                            <td>Pagado a la Fecha</td>
                            <td><input type='text' name=contrato readonly='readonly' value='<?php
                                       if (isset($contrato)) {
                                           echo $contrato;
                                       }
                                       ?>'></td>
                            <?php if ($cliente == 'GE Capital') { ?>
                                <td>Monto asignado</td>
                                <td><input type='text' name=saldo_cuota readonly='readonly' value='<?php
                                if (isset($saldo_cuota)) {
                                    echo '$'.number_format($saldo_cuota);
                                }
                                ?>'></td>
                            </tr>
    <?php } ?>
                                <?php if (($cliente == 'Credito Si B')
                                    || ($cliente == 'Credito Si F')) { ?>
                            <td>Saldo cuota</td>
                            <td><input type='text' name=saldo_cuota readonly='readonly' value='<?php
                                           if (isset($saldo_cuota)) {
                                               echo '$'.number_format($saldo_cuota);
                                           }
                                           ?>'></td></tr>
                                <?php } ?>
                        </tr>
                        <tr>
                            <td>Saldo total</td>
                            <td><input type='text' name=saldo_total readonly='readonly' value='<?php
                            if (isset($saldo_total)) {
                                echo '$'.number_format($saldo_total);
                            }
                                ?>'></td>
                                <?php if ($cliente
                                    <> 'GE Capital') { ?>
                                <td>Monto adeudado</td>
                                <td><input type='text' name=monto_adeudado readonly='readonly' value='<?php
                                    if (isset($monto_adeudado)) {
                                        echo '$'.number_format($monto_adeudado);
                                    }
                                    ?>'></td>
                            </tr>
                            <tr>
                                <td>Saldo vencido</td>
                                <td><input type='text' name=saldo_vencido readonly='readonly' value='<?php
                            if ($cliente != 'GE Capital') {
                                echo '$'.number_format($saldo_vencido);
                            }
                                    ?>'></td>
                                <?php } ?>
                                <?php if (($cliente
                                    == 'Credito Si B') || ($cliente == 'Credito Si F')) { ?>
                                <td>Saldo capital</td>
                                <td><input type='text' name=saldo_descuento_1 readonly='readonly' value='<?php
                                           if (isset($saldo_descuento_1)) {
                                               echo '$'.number_format($saldo_descuento_1);
                                           }
                                           ?>'>
                                       <?php } ?>
                            </td>
                            <td>Saldo descuento <?php
                                if (($cliente == 'Credito Si B') || ($cliente == 'Credito Si F')) {
                                    echo '2';
                                }
                                ?></td>
                            <td><input type='text'
                                       name=saldo_descuento_2 readonly='readonly' value='<?php
                                       if
                                       (isset($saldo_descuento_2)) {
                                           echo
                                           '$'.number_format($saldo_descuento_2 + 0.51);
                                       }
                                       ?>'></td>
                            <td>Intereses moratorios</td>
                            <td><input type='text' name=monto_adeudado readonly='readonly' value='<?php
                                echo '$'.number_format($saldo_total - $saldo_descuento_1);
                                ?>'></td>
                            <td>% descuento</td>
                            <td><input type='text' name=descuento readonly='readonly' value='<?php
                                echo number_format(100 - ($saldo_descuento_2 / ($saldo_descuento_1
                                    + 0.001)) * 100)."%";
                                ?>'></td>
                        </tr>
    <?php if (($cliente != 'Credito Si B') && ($cliente
        != 'Credito Si F')) { ?>
                            <tr>
                                <td>Fecha - ultimo pago</td>
                                <td><input type='text' name=fecha_de_ultimo_pago readonly='readonly' value='<?php
                                    if (isset($fecha_de_ultimo_pago)) {
                                        echo $fecha_de_ultimo_pago;
                                    }
                                    ?>'></td>
                                <td>Monto ultimo pago</td>
                                <td><input type='text' name=monto_ultimo_pago readonly='readonly' value='<?php
                                if (isset($monto_ultimo_pago)) {
                                    echo '$'.number_format($monto_ultimo_pago);
                                }
                                ?>'></td>
                                <td>Producto</td>
                                <td><input type='text' name=producto readonly='readonly' value='<?php
                                    if (!empty($prods)) {
                                        echo $prods;
                                    } else {
                                        echo htmlentities($producto);
                                    }
                                    ?>'></td>
                            </tr>
                                <?php } ?>
                        <tr>
                                       <?php if ($cliente
                                           == 'FISA') { ?>
                                <td>Grupo</td>
                                <?php } else { ?>
                                <td>Subproducto</td>
                                <?php } ?>
                            <td><input type='text' name=subproducto readonly='readonly' value='<?php
                            if (isset($subproducto)) {
                                echo htmlentities($subproducto);
                            }
                            ?>'><br>
                            <td>Status de credito</td>
                            <td><input type='text' name=status_de_credito readonly='readonly' value='<?php
                    if (isset($status_de_credito)) {
                        echo $status_de_credito;
                    }
                    ?>'></td>
                            <td>D&iacute;s vencidos</td>
                            <td><input type='text' name=dias_vencidos readonly='readonly' value='<?php
                    if (isset($dias_vencidos)) {
                        echo $dias_vencidos;
                    }
                    ?>'><br>
                        </tr>
                    </table>
                </div>
                <div id="MISCELANEA">
                    <span class='formcap'>Telefonos marcados</span><input type='text' name="telefonos_marcados" id="telefonos_marcados" readonly='readonly' value='<?php
                    if (isset($telefonos_marcados)) {
                        echo $telefonos_marcados;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 1 verificado</span><input type='text' name="tel_1_verif" id="tel_1_verif" readonly='readonly' value='<?php
                    if (isset($tel_1_verif)) {
                        echo $tel_1_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 2 verificado</span><input type='text' name="tel_2_verif" id="tel_2_verif" readonly='readonly' value='<?php
                    if (isset($tel_2_verif)) {
                        echo $tel_2_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 3 verificado</span><input type='text' name="tel_3_verif" id="tel_3_verif" readonly='readonly' value='<?php
                    if (isset($tel_3_verif)) {
                        echo $tel_3_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 4 verificado</span><input type='text' name="tel_4_verif" id="tel_4_verif" readonly='readonly' value='<?php
                    if (isset($tel_4_verif)) {
                        echo $tel_4_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel de ult. contacto</span><input type='text' name="telefono_de_ultimo_contacto" readonly='readonly' value='<?php
                    if (isset($telefono_de_ultimo_contacto)) {
                        echo $telefono_de_ultimo_contacto;
                    }
                    ?>'><br>
                    <span class='formcap'>Ultimo status</span><input type='text' name='ultimo_status_de_la_gestion' readonly='readonly' value='<?php
                    if (isset($ultimo_status_de_la_gestion)) {
                        echo $ultimo_status_de_la_gestion;
                    }
                    ?>'><br>
                </div>

            </form>
    <?php if (($id_cuenta == 0) && ($mytipo <> 'callcenter')) { ?>
                <div id='calm'>
                    <!--<form class="buttons" name="segq" method="get" action=
                    "resumen-elastix.php" id="segq">
                    -->
                    <p>Termino de queue</p>
                    <!--
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
                    <input type="submit" name="go" value="SEG"></form>
                    -->
                </div>
            </form>
    <?php } ?>
        <div id="searchbox">
            <h2>Buscar</h2>
            <form name="search" method="get" action=
                  "buscar.php" id="search">Buscar a: <input type=
                                                      "text" name="find" id="find"> en <select name="field">
                    <option value="nombre_deudor">Nombre</option>
                    <option value="domicilio_deudor">Direcci&oacute;n</option>
                    <option value="numero_de_cuenta">Cuenta</option>
                    <option value="TELS">Telefonos</option>
                    <option value="ROBOT">Telefonos marcados</option>
                    <option value="REFS">Aval/Referencias</option>
                    <option value="id_cuenta">Expediente</option>
                    <option value="producto">Producto</option>
                    <option value="subproducto">Subproducto/Grupo</option>
                </select><br>
                Client = <select name="cliente">
                    <option value=" ">Todos</option>
                <?php
                $querycl  = "SELECT cliente FROM clientes;";
                $resultcl = mysqli_query($con, $querycl);
                while ($answercl = mysqli_fetch_array($resultcl)) {
                    ?>
                        <option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
                        </option>
    <?php } ?>
                </select><br>
                <input type="hidden" name="capt" value="<?php
    if (isset($capt)) {
        echo $capt;
    }
    ?>">
                <input type="hidden" name="C_CONT" value="<?php
                    if (isset($id_cuenta)) {
                        echo $id_cuenta;
                    }
                    ?>">
                <input type="hidden" name="go" value="BUSCAR">
                <input type="hidden" name="from" value="resumen-elastix.php">
                <input type="submit" name="go1" value="BUSCAR">
                <input type="button" name="cancel" onclick="cancelbox('searchbox');"
                       value="Cancel">
            </form>
        </div>

        <div id="HISTORIA">
            <table summary="historiahead" border='0' cellpadding='0' cellspacing=
                   '0' width='100%' id="historyhead">
                <tr>
            <?php
            $fieldnames = array("Status", "Fecha/Hora", "Gestor", "Telefono", "Gestion",
                "Gestion");
            $fieldsize  = array("status", "timestamp", "chico", "telefono", "gestion",
                "hidebox");
            for ($j = 0; $j < 5; $j++) {
                $fieldname = $fieldnames[$j];
                ?>
                        <th<?php echo ' class="'.$fieldsize[$j].'"'; ?>><?php
                if (isset($fieldname)) {
                    echo $fieldname;
                }
                ?></th> <?php
                        }
                        ?></tr>
            </table>
                        <?php
                        if ($id_cuenta > 0) {
                            $querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin),if(c_visit is null,c_cvge,c_visit),c_tele,left(c_obse1,50),c_obse1,auto,c_cniv FROM historia
WHERE (historia.C_CONT=".$id_cuenta.") AND ((c_cvge <> 'Milt') or (c_cont in (select id_cuenta from resumen where status_de_credito ='720s'))) 
and (c_visit is null or d_fech>'2011-02-01')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
                            $rowsub   = mysqli_query($con, $querysub);
                            if (!(empty($rowsub))) {
                                ?>
                    <div id='tableContainer' class='tableContainer'>
                        <table summary="historia" border='0' cellpadding='0' cellspacing=
                               '0' width='100%' id='historybody'>
                            <tbody class="scrollContent">
                                    <?php
                                    $j      = 0;
                                    $c      = 0;
                                    while ($answer = mysqli_fetch_array($rowsub)) {
//                                    $auto = $answer[6];
                                        $visit     = $answer[7];
//                                    $gestor = utf8_encode($answer[2]);
                                        $gestion   = utf8_encode($answer[5]);
                                        $timestamp = utf8_encode($answer[1]);
                                        $stat      = utf8_encode($answer[0]);
                                        ?>
                                    <tr<?php echo highhist($stat, $visit); ?>><?php
                                            for ($k = 0; $k < 5; $k++) {
                                                $anko = utf8_encode($answer[$k]);
                                                if (is_null($anko)) {
                                                    $anko = "&nbsp;";
                                                }
                                                $ank    = str_replace('00:00:00',
                                                    '', $anko);
                                                $jscode = '';
                                                if ($fieldsize[$k] == "gestion") {
                                                    $jscode1 = " onClick='alert(";
                                                    $jscode2 = ")'";
                                                    $jscode  = $jscode1.'"'.preg_replace("/[\n\r]/",
                                                            " ",
                                                            $timestamp.': '.$gestion).'"'.$jscode2;
                                                }
                                                ?>
                                            <td<?php
                                                if ($c == 1) {
                                                    echo " style='background-color:#dddddd'";
                                                }
                                                echo ' class="'.$fieldsize[$k].'"'.$jscode;
                                                ?>>
                    <?php
                    if (isset($ank)) {
                        echo $ank;
                    }
                    ?>
                                            </td>
                                                <?php
                                            } $c = 1 - $c;
                                            ?>
                                    </tr>
                                            <?php
                                            $j++;
                                        }
                                        ?>
                                <tr><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                        <?php } ?>
            </div>
            <div id="GESTION">
                <form action="#" method="get" id="gestionform"
                      onSubmit="return validate_form(this, event,<?php echo $saldo_descuento_2
                        + 0; ?>, '<?php echo $mytipo; ?>');">
                    <table id="databox">
                               <?php if ($mytipo == 'admin'
                                   || $mytipo == 'supervisor') { ?>
                            <tr>
                                <td>Gestor</td>
                                <td><select name="C_CVGE">
            <?php
            $query  = "SELECT usuaria,iniciales FROM nombres ORDER BY usuaria;";
            $result = mysqli_query($con, $query);
            $j      = 0;

            while ($answer = mysqli_fetch_array($result)) {
                ?>
                                            <option value="<?php echo $answer[1]; ?>" <?php if ($answer[1]
                                == $capt) { ?>selected="selected"<?php } ?>><?php echo $answer[0]; ?></option>
                                        <?php }
                                        ?>
                                    </select></td>
                            </tr>
                                    <?php } else { ?>
                            <input type="hidden" name="C_CVGE" readonly="readonly" value="<?php
                                        if (isset($C_CVGE)) {
                                            echo $C_CVGE;
                                        }
                                        ?>" >
                                    <?php } ?>
                        <tr id='authbox' class="hidebox">
                            <td>Autorizaci&oacute;n</td>
                            <td><input type="password" name="AUTH" id="AUTH" value=""></td>
                        </tr>
                        <tr>
                            <td>Telefono</td>
                            <td colspan=2><select id="C_TELE" name="C_TELE">
                                    <option value=''>&nbsp;</option>
                                    <option value=''>Nuevo Tel. 1</option>
                                    <option value=''>Nuevo Tel. 2</option>
        <?php if (isset($tel_1)) { ?><option value='<?php echo $tel_1 ?>'>TEL 1 - <?php echo $tel_1 ?></option><?php } ?>
        <?php if (isset($tel_1_alterno)) { ?><option value='<?php echo $tel_1_alterno ?>'>TEL ALT 1 - <?php echo $nombre_deudor_alterno.' - '.$tel_1_alterno ?></option><?php } ?>
        <?php if (isset($tel_1_laboral)) { ?><option value='<?php echo $tel_1_laboral; ?>'>TEL LABORAL 1 - <?php echo $empresa.' - '.$tel_1_laboral; ?></option><?php } ?>
        <?php if (isset($tel_1_ref_1)) { ?><option value='<?php echo $tel_1_ref_1; ?>'>TEL 1 REF 1 - <?php echo $nombre_referencia_1.' - '.$tel_1_ref_1; ?></option><?php } ?>
        <?php if (isset($tel_1_ref_2)) { ?><option value='<?php echo $tel_1_ref_2; ?>'>TEL 1 REF 2 - <?php echo $nombre_referencia_2.' - '.$tel_1_ref_2; ?></option><?php } ?>
        <?php if (isset($tel_1_ref_3)) { ?><option value='<?php echo $tel_1_ref_3; ?>'>TEL 1 REF 3 - <?php echo $nombre_referencia_3.' - '.$tel_1_ref_3; ?></option><?php } ?>
        <?php if (isset($tel_1_ref_4)) { ?><option value='<?php echo $tel_1_ref_4; ?>'>TEL 1 REF 4 - <?php echo $nombre_referencia_4.' - '.$tel_1_ref_4; ?></option><?php } ?>
        <?php if (isset($tel_1_verif)) { ?><option class='verif' value='<?php echo $tel_1_verif; ?>'>TEL 1 VERIF - <?php echo $tel_1_verif; ?></option><?php } ?>
        <?php if (isset($tel_2)) { ?><option value='<?php echo $tel_2; ?>'>CELULAR - <?php echo $tel_2; ?></option><?php } ?>
        <?php if (isset($tel_2_alterno)) { ?><option value='<?php echo $tel_2_alterno; ?>'>TEL ALT 1 - <?php echo $nombre_deudor_alterno.' - '.$tel_2_alterno; ?></option><?php } ?>
        <?php if (isset($tel_2_laboral)) { ?><option value='<?php echo $tel_2_laboral; ?>'>TEL LABORAL 2 - <?php echo $empresa.' - '.$tel_2_laboral; ?></option><?php } ?>
        <?php if (isset($tel_2_ref_1)) { ?><option value='<?php echo $tel_2_ref_1; ?>'>TEL 2 REF 1 - <?php echo $nombre_referencia_1.' - '.$tel_2_ref_1; ?></option><?php } ?>
        <?php if (isset($tel_2_ref_2)) { ?><option value='<?php echo $tel_2_ref_2; ?>'>TEL 2 REF 2 - <?php echo $nombre_referencia_2.' - '.$tel_2_ref_2; ?></option><?php } ?>
        <?php if (isset($tel_2_ref_3)) { ?><option value='<?php echo $tel_2_ref_3; ?>'>TEL 2 REF 3 - <?php echo $nombre_referencia_3.' - '.$tel_2_ref_3; ?></option><?php } ?>
        <?php if (isset($tel_2_ref_4)) { ?><option value='<?php echo $tel_2_ref_4; ?>'>TEL 2 REF 4 - <?php echo $nombre_referencia_4.' - '.$tel_2_ref_4; ?></option><?php } ?>
        <?php if (isset($tel_2_verif)) { ?><option class='verif' value='<?php echo $tel_2_verif; ?>'>TEL 2 VERIF - <?php echo $tel_2_verif; ?></option><?php } ?>
        <?php if (isset($tel_3)) { ?><option value='<?php echo $tel_3; ?>'>TEL 3 - <?php echo $tel_3; ?></option><?php } ?>
                        <?php if (isset($tel_3_alterno)) { ?><option value='<?php echo $tel_3_alterno; ?>'>TEL ALT 3 - <?php echo $nombre_deudor_alterno.' - '.$tel_3_alterno; ?></option><?php } ?>
                        <?php if (isset($tel_3_verif)) { ?><option class='verif' value='<?php echo $tel_3_verif; ?>'>TEL 3 VERIF - <?php echo $tel_3_verif; ?></option><?php } ?>
                        <?php if (isset($tel_4)) { ?><option value='<?php echo $tel_4; ?>'>TEL 4 - <?php echo $tel_4; ?></option><?php } ?>
                        <?php if (isset($tel_4_alterno)) { ?><option value='<?php echo $tel_4_alterno; ?>'>TEL ALT 4 - <?php echo $nombre_deudor_alterno.' - '.$tel_4_alterno; ?></option><?php } ?>
                        <?php if (isset($tel_4_verif)) { ?><option class='verif' value='<?php echo $tel_4_verif; ?>'>TEL 4 VERIF - <?php echo $tel_4_verif; ?></option><?php } ?>
        <?php if (isset($telefono_de_ultimo_contacto)) { ?><option value='<?php echo $telefono_de_ultimo_contacto; ?>'>TEL DE ULT. CONT. - <?php echo $telefono_de_ultimo_contacto; ?></option><?php } ?>
                                    <option value='Creditor'>Desde Creditor</option>
                                </select> <a href="JavaScript: dial('<?php echo $capt ?>',<?php echo $numero_de_cuenta ?>)">CELULAR</a></td>
                        </tr>
                        <tr>
                            <td id="pcap2">Parentesco/Cargo</td>
                            <td><select name="C_CARG">
                                    <option value="">&nbsp;</option>
                                    <option value="Aval">Aval</option>
                                    <option value="Conyuge">C&oacute;nyuge</option>
                                    <option value="Deudor">Deudor</option>
                                    <option value="Familiar">Familiar</option>
                                    <option value="Hermano/a">Hermano/a</option>
                                    <option value="Hijo/a">Hijo/a</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Otro">Otro</option>
                                    <option value="Padre">Padre</option>
                                    <option value="Vecino/a">Vecino/a</option>
                                </select></td>
                        </tr>
                                        <?php
                                        $CD    = date("Y-m-d");
                                        $CT    = date("H:i:s");
                                        ?>
                        <tr>
                            <td>Gestion</td>
                            <td><textarea rows="4" cols="50" name="C_OBSE1" id='C_OBSE1'
                                          onkeypress="tooLong(this);" onkeyup="valid(this, 'special');" onmouseover='this.focus();'
                                          onblur="valid(this, 'special');" onmousedown='this.focus();'></textarea></td>
                            <td colspan=2>Acci&oacute;n
                                <select name="ACCION" id="ACCION">
                                    <option></option>
                                    <?php
                                    $query = "SELECT accion FROM acciones where callcenter=1 order by (accion not regexp 'domic')";
                                    if (($mytipo == 'abogado' || $capt == 'edgar')
                                        && $cliente == 'Vanguardia') {
                                        $query = "SELECT accion FROM acciones where callcenter=1 or judicial=1 order by (accion not regexp 'domic')";
                                    }
                                    if ($capt == 'gmbs') {
                                        $query = "SELECT accion FROM acciones order by accion";
                                    }
                                    $result = mysqli_query($con, $query);
                                    while ($answer = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $answer[0]; ?>" style="font-size:120%;"><?php
                                                    if (isset($answer[0])) {
                                                        echo $answer[0];
                                                    }
                                                    ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                Status
                                <select name="C_CVST" id="C_CVST" onchange='gestionChange(this.form);'>
                                    <option value=''></option>
                                    <?php
                                    $querydi  = "SELECT dictamen FROM dictamenes "
                                        . "where callcenter=1 or $mytipo='admin' "
                                        . "order by dictamen";
                                    $resultdi = mysqli_query($con, $querydi);
                                    while ($answer   = mysqli_fetch_array($resultdi)) {
                                        ?>
                                        <option value="<?php
                                            if (isset($answer[0])) {
                                                echo htmlentities($answer[0]);
                                            }
                                            ?>"
                                                style="font-size:120%;">
                                <?php
                                if (isset($answer[0])) {
                                    echo htmlentities($answer[0]);
                                }
                                ?>
                                        </option>
                            <?php } ?>
                                </select><br>
                                Causa no pago
                                <select name="C_CNP" id="C_CNP">
                                    <option value="" style="font-size:120%;">&nbsp;</option>
                            <?php
                            $querycnp  = "SELECT status FROM cnp";
                            $resultcnp = mysqli_query($con, $querycnp);
                            while ($answer    = mysqli_fetch_array($resultcnp)) {
                                ?>
                                        <option value="<?php echo $answer[0]; ?>" style="font-size:120%;"><?php
                                if (isset($answer[0])) {
                                    echo htmlentities($answer[0]);
                                }
                                ?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>
                        <tr id="pagocapt" style="display:none">
                            <td>Monto Pag&oacute;</td>
                            <td>$<input type="text" name="N_PAGO" value="0" onmouseover='this.focus();'></td>
                            <td class="PrestamoFamiliar"># Sucursal</td>
                            <td class="PrestamoFamiliar"><input class="PrestamoFamiliar" type="text" name="numero_sucursal" id="numero_sucursal" value="" onmouseover='this.focus();'></td>
                        </tr>
                        <tr id="pagocapt2" style="display:none">
                            <td>Fecha Pag&oacute;
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal9 = new CalendarPopup();
                                    cal9.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal9.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal9.setWeekStartDay(1);
                                    cal9.setTodayText("Hoy");
                                </SCRIPT></td>
                            <td><INPUT TYPE="text" NAME="D_PAGO" ID="D_PAGOi" VALUE="" SIZE=15>
                                <BUTTON onClick="cal9.select(document.getElementById('D_PAGOi'), 'anchor9', 'yyyy-MM-dd');
                                                return false;" NAME="anchor9" ID="anchor9">eligir</BUTTON>
                                <BUTTON onClick="document.getElementById('D_PAGOi').value = '';
                                                return false;">BORRAR</BUTTON></td>
                            <td class="PrestamoFamiliar">Nombre Sucursal</td>
                            <td class="PrestamoFamiliar"><input class="PrestamoFamiliar" type="text" name="nombre_sucursal" id="nombre_sucursal" value="" onmouseover='this.focus();'></td>
                        </tr>
                        <tr>
                            <td>Motivadores</td>
                            <td><select id="C_MOTIV" name="C_MOTIV">
                                    <option value=" ">
                                            <?php
                                            $querymot = "SELECT motiv FROM motivadores where callcenter=1";
                                            if ($capt == 'gmbs') {
                                                $querymot = "SELECT motiv FROM motivadores";
                                            }
                                            $resultmot = mysqli_query($con,
                                                $querymot);
                                            while ($answer    = mysqli_fetch_array($resultmot)) {
                                                ?>
                                        <option value="<?php echo $answer[0]; ?>"><?php echo $answer[0]; ?></option>
                                                <?php
                                            }
                                            ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Se necesita localizar <input type="checkbox" name="LOCALIZAR" id="localizar" <?php
                                    if (!empty($localizar)) {
                                        echo 'selected="selected"';
                                    }
                                    ?>></td>
                            <td colspan=2>Localizable <select name='CUANDO'>
                                    <option value=""></option>
                                    <option value="madrugada" <?php
                                    if ($CUANDO == 'madrugada') {
                                        echo 'selected="selected"';
                                    }
                                    ?>>madrugada</option>
                                    <option value="manana" <?php
                                    if ($CUANDO == 'manana') {
                                        echo 'selected="selected"';
                                    }
                                    ?>>ma&ntilde;ana</option>
                                    <option value="tarde" <?php
                                if ($CUANDO == 'tarde') {
                                    echo 'selected="selected"';
                                }
                                ?>>tarde</option>
                                    <option value="noche" <?php
                                if ($CUANDO == 'noche') {
                                    echo 'selected="selected"';
                                }
                                ?>>noche</option>
                                    <option value="robot" <?php
                                if ($CUANDO == 'robot') {
                                    echo
                                    'selected="selected"';
                                }
                                ?>>robot</option>
                                    <option value="visita" <?php
                                if ($CUANDO == 'visita') {
                                    echo
                                    'selected="selected"';
                                }
                                ?>>visita</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Cant. de pago inicial</td>
                            <td>$<input type="text" name="N_PROM1" value="0" size="8" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM1_OLD" readonly="readonly" size="8" value="<?php
                                if (isset($N_PROM1_OLD)) {
                                    echo $N_PROM1_OLD;
                                }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Fecha promesa única o 1a
                            <td><INPUT class="maxWhen" readonly="readonly" TYPE="text" readonly="readonly" NAME="D_PROM1" ID="D_PROM1" VALUE="" SIZE=15>
                                <BUTTON onClick="document.getElementById('D_PROM1').value = '';
                                                return false;">BORRAR</BUTTON></td>
                            <td><input type="text" name="D_PROM1_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                        if (isset($D_PROM1_OLD)) {
                            echo $D_PROM1_OLD;
                        }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Cant. de 2a promesa</td>
                            <td>$<input type="text" name="N_PROM2" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM2_OLD" size="8" readonly="readonly" value="<?php
                        if (isset($N_PROM2_OLD)) {
                            echo $N_PROM2_OLD;
                        }
                                ?>"><br>
                        </tr>
                        <tr>
                            <td>Fecha 2a promesa
                            </td>
                            <td><INPUT class="maxWhen2" readonly="readonly" TYPE="text" readonly="readonly" NAME="D_PROM2" ID="D_PROM2" VALUE="" SIZE=15>
                                <BUTTON onClick="document.getElementById('D_PROM2').value = '';
                                                return false;">BORRAR</BUTTON></td>
                            <td><input type="text" name="D_PROM2_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                        if (isset($D_PROM2_OLD)) {
                            echo $D_PROM2_OLD;
                        }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Cant. de 3a promesa</td>
                            <td>$<input type="text" name="N_PROM3" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM3_OLD" size="8" readonly="readonly" value="<?php
                        if (isset($N_PROM3_OLD)) {
                            echo $N_PROM3_OLD;
                        }
                                ?>"><br>
                        </tr>
                        <tr>
                            <td>Fecha 3a promesa
                            </td>
                            <td><INPUT class="maxWhen2" readonly="readonly" TYPE="text" readonly="readonly" NAME="D_PROM3" ID="D_PROM3" VALUE="" SIZE=15>
                                <BUTTON onClick="document.getElementById('D_PROM3').value = '';
                                                return false;">BORRAR</BUTTON></td>
                            <td><input type="text" name="D_PROM3_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                        if (isset($D_PROM3_OLD)) {
                            echo $D_PROM3_OLD;
                        }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Cant. de 4a promesa</td>
                            <td>$<input type="text" name="N_PROM4" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM4_OLD" size="8" readonly="readonly" value="<?php
                        if (isset($N_PROM4_OLD)) {
                            echo $N_PROM4_OLD;
                        }
                                ?>"><br>
                        </tr>
                        <tr>
                            <td>Fecha 4a promesa
                            </td>
                            <td><INPUT class="maxWhen2" readonly="readonly" TYPE="text" readonly="readonly" NAME="D_PROM4" ID="D_PROM4" VALUE="" SIZE=15>
                                <BUTTON onClick="document.getElementById('D_PROM4').value = '';
                                                return false;">BORRAR</BUTTON></td>
                            <td><input type="text" name="D_PROM4_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                                if (isset($D_PROM4_OLD)) {
                                    echo $D_PROM4_OLD;
                                }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Frecuencia de pago</td>
                            <td><select name="C_FREQ" id="C_FREQ">
                                    <option selected="selected" value="">&nbsp;</option>
        <?php
        if (($cliente == 'Credito Si B') || ($cliente == 'Credito Si F')) {
            ?>
                                        <option value="mensuales">Unico</option>
                                        <option value="semanales">Semanales (&lt; 14 d&iacute;as)</option>
                                        <option value="quincenales">Quincenales (14 - 20 d&iacute;as)</option>
                                        <option value="mensuales">Mensuales (21+ d&iacute;as)</option>
        <?php } else { ?>
                                        <option value="unico">Unico</option>
                                        <option value="dos pagos">2 pagos</option>
                                        <option value="multiples">M&uacute;ltiples pagos</option>
        <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Cant. de pago total</td>
                            <td><input type="text" name="N_PROM" readonly="readonly" style="background-color:#c0c0c0;" value=""></td>
                            <td>Cant. de pago prometido anterior</td>
                            <td><input type="text" name="N_PROM_OLD" readonly="readonly" style="background-color:#c0c0c0;" value="<?php
        if (isset($N_PROM_OLD)) {
            echo floor($N_PROM_OLD);
        }
        ?>"></td>
                        </tr>
                        <tr>
                            <td colspan=2>Actualizaci&oacute;n de Datos</td>
                        </tr>
                        <tr>
                            <td>Tel.</td>
                            <td><input type="text" name="C_NTEL" value=""  onmouseover='this.focus();'
                                       onChange="addToTels(1, this);"></td>
                        </tr>
                        <tr>
                            <td>Tel 2.</td>
                            <td><input type="text" size=50 name="C_OBSE2" value="" onmouseover='this.focus();'
                                       onChange="addToTels(2, this);"></td>
                        </tr>
                        <tr>
                            <td>Direcci&oacute;n</td>
                            <td><input type="text" size=50 name="C_NDIR" value="" onmouseover='this.focus();'></td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td><input type="text" name="C_EMAIL" value="" onmouseover='this.focus();'></td>
                        </tr>
                    </table>
                    <input type="submit" name="GUARDAR" value="GUARDAR">
                    <button type="button" value="RESET" onclick="this.form.GUARDAR.disabled = false;">RESET</button>
                    <br>
                    </div>
                    </div>
                    <div class="noshow">
                        <input type="text" name="from" readonly="readonly" value="resumen-elastix.php" ><br>
                        <input type="text" name="D_FECH" readonly="readonly" value="<?php
                        if (isset($CD)) {
                            echo $CD;
                        }
                        ?>" ><br>
                        <input type="text" name="D_PROM" readonly="readonly" value="<?php
                        if (isset($CD)) {
                            echo $CD;
                        }
                        ?>" ><br>
                        <input type="text" name="C_PROM" readonly="readonly" value="elastix" ><br>
                        <input type="text" name="C_HRIN" readonly="readonly" value="<?php
                        if (isset($CT)) {
                            echo $CT;
                        }
                        ?>" ><br>
                        <input type="text" name="C_HRFI" readonly="readonly" value="<?php
                        if (isset($CT)) {
                            echo $CT;
                        }
                        ?>" ><br>
                        <input type="text" name="AUTO" readonly="readonly" value="" ><br>
                        <input type="text" name="find" readonly="readonly" value="<?php
                        if (isset($find)) {
                            echo $find;
                        }
                        ?>" ><br>
                        <input type="text" name="capt" readonly="readonly" value="<?php
                        if (isset($capt)) {
                            echo $capt;
                        }
                        ?>" ><br>
                        <input type="text" name="camp" readonly="readonly" value="<?php
                        if (isset($camp)) {
                            echo $camp;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CVBA" readonly="readonly" value="<?php
                        if (isset($cliente)) {
                            echo $cliente;
                        }
                        ?>" ><br>
                        <input type="text" name="C_ATTE" readonly="readonly" value="" ><br>
                        <input type="text" name="C_CONT" readonly="readonly" value="<?php
                        if (isset($id_cuenta)) {
                            echo $id_cuenta;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CONTAN" readonly="readonly" value="<?php
            if (isset($status_aarsa)) {
                echo $status_aarsa;
            }
            ?>" ><br>
                        <input type="text" name="CUENTA" id="CUENTA" readonly="readonly" value="<?php
            if (isset($numero_de_cuenta)) {
                echo $numero_de_cuenta;
            }
            ?>" ><br>
                        <input type="text" name="C_EJE" id="C_EJE" readonly="readonly" value="<?php
            if (isset($ejecutivo_asignado_call_center)) {
                echo $ejecutivo_asignado_call_center;
            }
            ?>" ><br>
                        <input type="text" name="saldo_total" readonly="readonly" value="<?php echo $saldo_total; ?>"><br>
                        <input type="text" name="oldgo" readonly="readonly" value="<?php echo mysqli_real_escape_string($con,
                $get['go']); ?>" ><br>
                        <input type="text" name="error" readonly="readonly" value="1" ><br>
                        <input type="text" name="go" readonly="readonly" value="GUARDAR" ><br>
                    </div>
                </form>
            </div>
            <SCRIPT>
                $('.calendar').datepicker({
                    showOn: 'button',
                    buttonText: 'Elegir',
                    dateFormat: 'yy-mm-dd',
                    constrainInput: true
                });
                $('.maxNow').datepicker({
                    showOn: 'button',
                    buttonText: 'Elegir',
                    dateFormat: 'yy-mm-dd',
                    constrainInput: true,
                    maxDate: 0
                });
                $('.minNow').datepicker({
                    showOn: 'button',
                    buttonText: 'Elegir',
                    dateFormat: 'yy-mm-dd',
                    constrainInput: true,
                    minDate: 0
                });
                $('.maxWhen').datepicker({
                    showOn: 'button',
                    buttonText: 'Elegir',
                    dateFormat: 'yy-mm-dd',
                    constrainInput: true,
                    minDate: 0,
                    maxDate: '<?php echo $dday; ?>'
                });
                $('.maxWhen2').datepicker({
                    showOn: 'button',
                    buttonText: 'Elegir',
                    dateFormat: 'yy-mm-dd',
                    constrainInput: true,
                    minDate: 0,
                    maxDate: '<?php echo $dday2; ?>'
                });
                $('#buttonbox input[type="submit"]').button();
                $('#buttonbox button').button();
            </script>
        <?php
    }
}
mysqli_close($con);
?>
</body>
</html> 

