<?php
date_default_timezone_set('America/Monterrey');
function highhist($capt,$stat,$visit,$tipo) {
	$highstr='';
    if (($stat=='PROMESA DE PAGO TOTAL') || ($stat=='PROMESA DE PAGO PARCIAL') || ($stat=='CLIENTE NEGOCIANDO')) {
        $highstr=" class='deudor'";
        }
    if (!empty($visit)) {$highstr=" class='visit'";}
    return $highstr;
    }
include('usuario_hdr_i.php');
$tcapt=$capt;
$error=0;
$qs=0;
$C_CVGE=$capt;
if ((date("G")==7)&&($mytipo=='callcenter')&&($capt!='katia')) {
//	die("ERROR. Pregunta a Greg para detalles.");
	}
if (!empty($mytipo)) {
setlocale(LC_MONETARY, 'en_US');

$oldgo='';

$getupdate = (!empty($_GET['go']));
$postupdate = (!empty($_POST['go']));
$isoldid = (!empty($_GET['id_cuenta']));
if ($getupdate) {
//   $qs = mysqli_real_escape_string($con,$_GET['qs']);
$find='';
if (!empty($_GET['field'])) {
   $find = mysqli_real_escape_string($con,$_GET['find']);
   $field = mysqli_real_escape_string($con,$_GET['field']);
}
   $capt = mysqli_real_escape_string($con,$_GET['capt']);
   // We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);
};
if ($postupdate) {
   $find = mysqli_real_escape_string($con,$_POST['find']);
   $capt = mysqli_real_escape_string($con,$_POST['capt']);
   // We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);
};
$pagalert=0;
$querypagos="select (c_cvst like 'PAG%'),c_cont from historia 
where c_cvge='".$capt."' and d_fech=curdate() and c_cvst like 'PAG%'
and (cuenta,c_cvba) not in (select cuenta,cliente from pagos)
order by d_fech desc,c_hrin desc limit 1";
$resultpagos=mysqli_query($con,$querypagos) or die ("ERROR RM1 - ".mysqli_error($con));
while ($answerpagos=mysqli_fetch_row($resultpagos)) {
	$pagalert=$answerpagos[0];
	$pagid=$answerpagos[1];
	if (empty($pagalert)) {$pagalert=0;}
	if ($mytipo=='visitador') {$pagalert=0;}
	}
$notalert='';
$querynotas="select min(concat_ws(' ',fecha,hora)<now()),min(concat_ws(' ',fecha,hora))
from notas 
where c_cvge='".$capt."' AND borrado=0 and fecha<>'0000-00-00'
AND concat_ws(' ',fecha,hora)<now()";
$resultnotas=mysqli_query($con,$querynotas) or die ("ERROR RM2 - ".mysqli_error($con));
while ($answernotas=mysqli_fetch_row($resultnotas)) {
	$notalert=$answernotas[0];
	$notalertt=$answernotas[1];
	}
	if (empty($notaalert)) {$notalert=0;}
else {$query2="select cuenta,nota,fuente
from notas 
where (c_cvge='".$capt."' OR c_cvge='todos')
AND borrado=0 AND concat_ws(' ',fecha,hora)='".$notalertt."' LIMIT 1;";
$resultnotas2=mysqli_query($con,$querynotas2) or die ("ERROR RM3 - ".mysqli_error($con));
while ($answernotas2=mysqli_fetch_row($resultnotas2)) {
	$alertcuenta=$answernotas2[0];
	$alertnota=$answernotas2[1];
	$alertfuente=$answernotas2[2];
	}
	}
$go='';
if (!empty($_GET['go'])) {
$go=mysqli_real_escape_string($con,$_GET['go']);
}
if ($go=='ULTIMA') {
        $queryult="SELECT c_cont FROM historia WHERE c_cvge='".$capt.
        "' and c_cont <> '0' ORDER BY d_fech desc, C_hrfi desc LIMIT 1";
        $resultult=mysqli_query($con,$queryult) or die("ERROR RM4 - ".mysqli_error($con));
        while ($answerult=mysqli_fetch_row($resultult)) {$find=$answerult[0];}
        $redirector = "Location: /resumen.php?field=id_cuenta&find=".$find."&capt=".$capt."&go=FROMULTIMA";
        header($redirector);
} 
if ($go=='LOGOUT') {
	$page="Location: ".$uri."/logout.php?gone=&capt=".$capt;
	header($page);
} 
if ($go=='CAPTURADO'&&empty($_GET['C_CVSTv'])) {die("No hay status");}
if ($go=='CAPTURADO'&&!empty($_GET['C_CVSTv'])) {
   $C_CVGE = mysqli_real_escape_string($con,$_GET['C_CVGEv']);
   $C_CVBA = mysqli_real_escape_string($con,$_GET['C_CVBAv']);
   $error = mysqli_real_escape_string($con,$_GET['error']);
   $C_CONT = mysqli_real_escape_string($con,$_GET['C_CONTv']);
   $C_CONTAN = mysqli_real_escape_string($con,$_GET['C_CONTANv']);
  $C_CTIPO = mysqli_real_escape_string($con,$_GET['C_CTIPOv']);
  $C_COWN = mysqli_real_escape_string($con,$_GET['C_COWNv']);
  $C_CSTAT = mysqli_real_escape_string($con,$_GET['C_CSTATv']);
   $CUENTA = mysqli_real_escape_string($con,$_GET['CUENTAv']);
   $C_OBSE1 = utf8_decode (mysqli_real_escape_string($con,$_GET['C_OBSE1v']));
   $C_CALLE1 = mysqli_real_escape_string($con,$_GET['C_CALLE1v']);
   $C_CALLE2 = mysqli_real_escape_string($con,$_GET['C_CALLE2v']);
   $C_ATTE = mysqli_real_escape_string($con,$_GET['C_ATTEv']);
   $C_CARG = mysqli_real_escape_string($con,$_GET['C_CARGv']);
   $C_TELE = mysqli_real_escape_string($con,$_GET['C_TELEv']);
   $C_RCON = mysqli_real_escape_string($con,$_GET['C_RCONv']);
   $C_NSE = mysqli_real_escape_string($con,$_GET['C_NSEv']);
   $C_CNIV = mysqli_real_escape_string($con,$_GET['C_CNIVv']);
   $C_CFAC = mysqli_real_escape_string($con,$_GET['C_CFACv']);
	$C_CPTA = mysqli_real_escape_string($con,$_GET['C_CPTAv']);
 	$C_CREJ = mysqli_real_escape_string($con,$_GET['C_CREJv']);
 	$C_CPAT = mysqli_real_escape_string($con,$_GET['C_CPATv']);
   $C_VISIT = mysqli_real_escape_string($con,$_GET['C_VISITv']);
   $C_CVST = mysqli_real_escape_string($con,$_GET['C_CVSTv']);
  $ACCION = mysqli_real_escape_string($con,$_GET['ACCIONv']);
  $C_MOTIV = mysqli_real_escape_string($con,$_GET['C_MOTIVv']);
   $C_HRIN = mysqli_real_escape_string($con,$_GET['C_VHv']).':'.mysqli_real_escape_string($con,$_GET['C_VMNv']);
   $C_HRFI = date('H:i:s');
$D_FECH=mysqli_real_escape_string($con,$_GET['C_VDv']);
$D_PROM=mysqli_real_escape_string($con,$_GET['D_PROMv']);
$D_PROM1=$D_PROM;
$N_PROM=mysqli_real_escape_string($con,$_GET['N_PROMv']);
$N_PROM1=$N_PROM;
$C_PROM=mysqli_real_escape_string($con,$_GET['C_PROMv']);
$C_NTEL=mysqli_real_escape_string($con,$_GET['C_NTELv']);
$C_NDIR=trim(mysqli_real_escape_string($con,$_GET['C_NDIRv']));
$C_EMAIL=trim(mysqli_real_escape_string($con,$_GET['C_EMAILv']));
$C_OBSE2=mysqli_real_escape_string($con,$_GET['C_OBSE2v']);
$C_EJE=mysqli_real_escape_string($con,$_GET['C_EJEv']);
if (empty($N_PROM)) {$N_PROM=0;}
$N_PROM=str_replace('$', '', $N_PROM);
$C_FREQ=mysqli_real_escape_string($con,$_GET['C_FREQv']);
for ($merciv=0; $merciv<count($_GET['MERCv']); $merciv++){
$MERCv[$merciv]=mysqli_real_escape_string($con,$_GET['MERCv'][$merciv]);}
if ($error>0) {
	$PAGOTXT='';
	if (($C_CVST=="PROMESA DE PAGO TOTAL")||($C_CVST=="PROMESA DE PAGO TOTAL")) {
		$PAGOTXT=" con toda promesa de ".$N_PROM." y fecha primera ".$D_PROM;
		}
	$redirector = "Location: /closeme.php?msg=Checar que gestion de 
	cuenta ".$CUENTA." con status ".$C_CVST.$PAGOTXT."  
	está guardado corectamente.";
header($redirector);
}
$queryins = "INSERT INTO historia (C_CVGE,C_CVBA,C_CONT,C_CVST,D_FECH,C_HRIN,
C_HRFI,C_TELE,CUENTA,C_OBSE1,C_CONTAN,C_ATTE,C_CARG,C_RCON,C_NSE,C_CNIV,C_CFAC,
C_CPTA,C_CTIPO,C_COWN,C_CSTAT,C_VISIT,D_PROM,N_PROM,D_PROM1,N_PROM1,C_PROM,C_FREQ,C_ACCION,C_MOTIV,
C_CREJ,C_CPAT,C_CALLE1,C_CALLE2,C_NTEL,C_NDIR,C_EMAIL,C_OBSE2,C_EJE) 
VALUES ('$C_CVGE','$C_CVBA','$C_CONT','$C_CVST','$D_FECH','$C_HRIN','$C_HRFI',
'$C_TELE','$CUENTA','$C_OBSE1','$C_CONTAN','$C_ATTE','$C_CARG','$C_RCON','$C_NSE',
'$C_CNIV','$C_CFAC','$C_CPTA','$C_CTIPO','$C_COWN','$C_CSTAT','$C_VISIT','$D_PROM',
'$N_PROM','$D_PROM1',
'$N_PROM1','$C_PROM','$C_FREQ','$ACCION','$C_MOTIV','$C_CREJ','$C_CPAT','$C_CALLE1','$C_CALLE2',
'$C_NTEL','$C_NDIR','$C_EMAIL','$C_OBSE2','$C_EJE')";
if ($C_VISIT=='') {die($queryins);}
mysqli_query($con,$queryins) or die ("ERROR RM5 - ".mysqli_error($con));
$queryfech="INSERT INTO histdate (auto,d_fech) SELECT auto,curdate() 
FROM historia 
WHERE c_cont=".$C_CONT." AND d_fech='".$D_FECH."'
AND c_hrin='".$C_HRIN."' AND c_hrfi='".$C_HRFI."'
AND auto NOT IN (SELECT auto FROM histdate)
;";
mysqli_query($con,$queryfech) or die ("ERROR RM6 - ".mysqli_error($con));
$querygest="INSERT INTO histgest (auto,c_cvge) SELECT auto,'".$C_CVGE."' 
FROM historia 
WHERE c_cont=".$C_CONT." AND d_fech='".$D_FECH."'
AND c_hrin='".$C_HRIN."' AND c_hrfi='".$C_HRFI."'
AND auto NOT IN (SELECT auto FROM histgest)
;";
mysqli_query($con,$querygest) or die ("ERROR RM6a - ".mysqli_error($con));
if (!empty($C_NTEL)) {
$queryntel="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_NTEL." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$queryntel) or die ("ERROR RM7 - ".mysqli_error($con));
};
if (!empty($C_EMAIL)) {
$queryndir="UPDATE resumen SET email_deudor='".$C_EMAIL."' WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$queryndir) or die ("ERROR RM8 - ".mysqli_error($con));
};
if (!empty($C_OBSE2)&&$C_OBSE2==filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
$querymemo="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_OBSE2." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$querymemo) or die ("ERROR RM9 - ".mysqli_error($con));
};
if ($N_PAGO>0) {
    $who=$capt;
    $queryd="select c_cvge from historia where n_prom>0 and c_cvge like 'PRO%'
    and c_cont=".$C_CONT." order by d_fech desc, c_hrin desc limit 1;";
    $rowd=mysqli_query($con,$queryd) or die ("ERROR RM10 - ".mysqli_error($con)); 
    while ($rowd=mysqli_fetch_row($resultd)) {$who=$rowd[0];}
    $queryins = "INSERT INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA,FECHACAPT) 
    SELECT numero_de_cuenta,'$D_PAGO','$N_PAGO',cliente,'$who',numero_de_credito,id_cuenta,now() 
    FROM resumen WHERE id_cuenta=".$C_CONT." and ('$D_PAGO','$N_PAGO',id_cuenta) not in 
    (select fecha,monto,id_cuenta from pagos where confirmado=0)";
    mysqli_query($con,$queryins) or die ("ERROR RM11 - ".mysqli_error($con));

    $querylast= "select fecha,monto from pagos where (cuenta,cliente,fecha) in (select cuenta,cliente,max(fecha) from pagos where cuenta='".$CUENTA."' and cliente='".$C_CVBA."' group by cliente,cuenta);";
    $resultlast =mysqli_query($con,$querylast) or die ("ERROR RM12 - ".mysqli_error($con));
    while ($answerlast=mysqli_fetch_row($resultlast)) {
        $mfecha=$answerlast[0];
        $mmonto=$answerlast[1];
        };

}
$best=$C_CONTAN;
$querybest="select c_cvst,v_cc from historia,dictamenes 
where c_cont=".$C_CONT." 
and (d_prom>=curdate() or n_prom=0)
and c_cvst=dictamen
order by v_cc limit 1;
;";
$resultbest=mysqli_query($con,$querybest) or die ("ERROR RM14 - ".mysqli_error($con));
while ($answerbest=mysqli_fetch_row($resultbest)) {$best=$answerbest[0];};
$querysa = "update resumen set status_aarsa='".$best."' where id_cuenta=".$C_CONT.";";;
mysqli_query($con,$querysa) or die ("ERROR RM15 - ".mysqli_error($con));
$querysa1="update resumen
set status_aarsa='PAGO DEL MES ANTERIOR'
where status_aarsa like 'PAG%' and status_aarsa not like 'PAGO TOTAL%' 
and id_cuenta=".$C_CONT." 
and id_cuenta in (select id_cuenta from pagos)
and id_cuenta not in (select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and status_de_credito not like '%o';";
mysqli_query($con,$querysa1) or die ("ERROR RM15a - ".mysqli_error($con));
$querysa1a="update resumen
set status_aarsa='PAGO TOTAL DEL MES ANTERIOR'
where id_cuenta=".$C_CONT." 
and status_de_credito not like '%o'
and id_cuenta in (select id_cuenta from pagos
where fecha>last_day(curdate()-interval 2 month)
and fecha<=last_day(curdate()-interval 1 month))
and id_cuenta in (select c_cont from historia 
where c_cvst='pago total' 
and d_fech>last_day(curdate()-interval 2 month)
and d_fech<=last_day(curdate()-interval 1 month));";
mysqli_query($con,$querysa1a) or die ("ERROR RM15aa - ".mysqli_error($con));
$querysa2="update cobra4.resumen set status_aarsa='PROMESA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra4.historia where n_prom>0 
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra4.historia where n_prom>0 
and d_prom<curdate()) and id_cuenta=".$C_CONT." 
and id_cuenta not in 
(select id_cuenta from cobra4.pagos where fecha>last_day(curdate()-interval 1 month)) 
and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');";
mysqli_query($con,$querysa2) or die ("ERROR RM15b - ".mysqli_error($con));
$querysa3="update cobra4.resumen set status_aarsa='PROPUESTA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra4.historia where n_prom>0 
and d_prom>curdate())  and id_cuenta=".$C_CONT." 
and id_cuenta in (select c_cont from cobra4.historia where n_prom>0 
and d_prom<curdate()) 
and id_cuenta not in 
(select id_cuenta from cobra4.pagos where fecha>last_day(curdate()-interval 1 month))  
and status_aarsa in ('propuesta de pago','propuesta hoy');";
mysqli_query($con,$querysa3) or die ("ERROR RM15c - ".mysqli_error($con));
$redirector = "Location: /resumen.php?capt=".$capt."&go=FROMBUSCAR&i=0&field=id_cuenta&find=".$C_CONT;
header($redirector);}
}
if ($go=='NUEVOS') {
$C_CONT=mysqli_real_escape_string($con,$_GET['C_CONT']);
$C_NTEL=mysqli_real_escape_string($con,$_GET['C_NTEL']);
$C_NDIR=trim(mysqli_real_escape_string($con,$_GET['C_NDIR']));
$C_OBSE2=mysqli_real_escape_string($con,$_GET['C_OBSE2']);
if (!empty($C_NTEL)) {
$queryntel="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_NTEL." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$queryntel) or die ("ERROR RM17 - ".mysqli_error($con));
};
if (!empty($C_NDIR)) {
$queryndir="UPDATE resumen SET direccion_nueva=".$C_NDIR." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$queryndir) or die ("ERROR RM18 - ".mysqli_error($con));
};
if (!empty($C_OBSE2)&&$C_OBSE2==filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
$querymemo="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_OBSE2." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$querymemo) or die ("ERROR RM19 - ".mysqli_error($con));
};
if ($merciv>0) {
foreach ($MERCv as $MERCa) {
    if (!empty($MERCa)) {
    $queryins = "INSERT INTO sdhmerc (ID_CUENTA,MERC,FECHAMERC,FECHACAPT) 
    VALUES (".$C_CONT.",'".$MERCa."','".$D_MERC."',now())";
    mysqli_query($con,$queryins) or die ("ERROR RM20 - ".mysqli_error($con));
}
}
}
//$redirector = "Location: /resumen.php?&capt=".$capt."&go=ULTIMA";
$redirector = "Location: /resumen.php?&capt=".$capt;
header($redirector);
}
if ($go=='GUARDAR'&&!empty($_GET['C_CVST'])) {
$oldgo=mysqli_real_escape_string($con,$_GET['oldgo']);
$error=mysqli_real_escape_string($con,$_GET['error']);
$C_CVGE=mysqli_real_escape_string($con,urldecode($_GET['C_CVGE']));
$AUTH=mysqli_real_escape_string($con,$_GET['AUTH']);
if ($C_CVGE != $capt) {$AUTH=$capt;}
if ($mytipo == 'admin') {$AUTH=$capt;}
$C_CONT=mysqli_real_escape_string($con,$_GET['C_CONT']);
$C_CVST=mysqli_real_escape_string($con,urldecode($_GET['C_CVST']));
$C_CVBA=mysqli_real_escape_string($con,urldecode($_GET['C_CVBA']));
$ACCION=mysqli_real_escape_string($con,urldecode($_GET['ACCION']));
$C_MOTIV=mysqli_real_escape_string($con,urldecode($_GET['C_MOTIV']));
$D_FECH=mysqli_real_escape_string($con,$_GET['D_FECH']);
$C_HRIN=mysqli_real_escape_string($con,$_GET['C_HRIN']);
$C_HRFI = date('H:i:s');
$C_TELE=mysqli_real_escape_string($con,$_GET['C_TELE']);
$CUANDO=mysqli_real_escape_string($con,$_GET['CUANDO']);
$CUENTA=mysqli_real_escape_string($con,$_GET['CUENTA']);
$C_OBSE1=utf8_decode(strtoupper(mysqli_real_escape_string($con,$_GET['C_OBSE1'])));
$C_ATTE=mysqli_real_escape_string($con,$_GET['C_ATTE']);
$C_CNP=mysqli_real_escape_string($con,$_GET['C_CNP']);
$C_CONTAN=mysqli_real_escape_string($con,urldecode($_GET['C_CONTAN']));
$C_CARG=utf8_encode(mysqli_real_escape_string($con,urldecode($_GET['C_CARG'])));
$C_CAMP=mysqli_real_escape_string($con,$_GET['camp']);
$D_PROM1=mysqli_real_escape_string($con,$_GET['D_PROM1']);
$D_PROM2=mysqli_real_escape_string($con,$_GET['D_PROM2']);
$D_PAGO=mysqli_real_escape_string($con,$_GET['D_PAGO']);
$N_PAGO=mysqli_real_escape_string($con,$_GET['N_PAGO']);
$merci=0;
if (!empty($_GET['MERC'])) {
$D_MERC=mysqli_real_escape_string($con,$_GET['D_MERC']);
for ($merci=0; $merci<count($_GET['MERC']); $merci++){
$MERC[$merci]=mysqli_real_escape_string($con,$_GET['MERC'][$merci]);}}
$C_PROM=mysqli_real_escape_string($con,$_GET['C_PROM']);
$N_PROM_OLD=mysqli_real_escape_string($con,$_GET['N_PROM_OLD']);
$N_PROM1=mysqli_real_escape_string($con,$_GET['N_PROM1']);
$N_PROM2=mysqli_real_escape_string($con,$_GET['N_PROM2']);
$N_PROM=$N_PROM1+$N_PROM2;
$C_FREQ=mysqli_real_escape_string($con,$_GET['C_FREQ']);
$C_NTEL=mysqli_real_escape_string($con,$_GET['C_NTEL']);
$C_NDIR=mysqli_real_escape_string($con,$_GET['C_NDIR']);
$C_EMAIL=trim(mysqli_real_escape_string($con,$_GET['C_EMAIL']));
$C_OBSE2=mysqli_real_escape_string($con,$_GET['C_OBSE2']);
$C_EJE=mysqli_real_escape_string($con,$_GET['C_EJE']);
$montomax=0;
$fechamin='2020-12-31';
$fechamax='2007-01-01';
$queryult="select max(n_prom),min(d_prom),max(d_prom) from historia where c_cont='".$C_CONT."' and n_prom>0;";
$resultult=mysqli_query($con,$queryult) or die("ERROR RM21 - ".mysqli_error($con));
while ($answerult=mysqli_fetch_row($resultult)) {
	$montomax=max($answerult[0],0);
	$fechamin=$answerult[1];
	$fechamax=$answerult[2];
}
$D_PROM=$D_PROM1;
//$AUTHCODE=mysqli_real_escape_string($con,$_GET['AUTH']);
//$AUTHNAME="";
//$AUTHOK=0;
//$queryauthname="SELECT iniciales,count(1),tipo FROM nombres 
//WHERE authcode='".$AUTHCODE."' 
//and length(authcode)=6 
//and authcode+0>0
//and authcode <> '' LIMIT 1;";
//$resultauthname=mysqli_query($con,$queryauthname) or die ("ERROR RM22 - ".mysqli_error($con));
//while ($answerauthname=mysqli_fetch_row($resultauthname)) {
//$AUTHNAME=$answerauthname[0];
//$AUTHOK=$answerauthname[1];
//$AUTHTIPO=$answerauthname[2];
//}
$querydup="SELECT count(1) FROM historia 
WHERE c_cont=".$C_CONT." and d_fech='".$D_FECH."' 
and c_hrin='".$C_HRIN."' and c_cvst='".$C_CVST."' 
and c_cvge='".$C_CVGE."' and c_obse1='".$C_OBSE1."';"; 
$resultdup=mysqli_query($con,$querydup) or die ("ERROR RM23 - ".mysqli_error($con));
while ($answerdup=mysqli_fetch_row($resultdup)) {$error=$error+$answerdup[0];}
if (empty($D_PROM)||($D_PROM1>$D_PROM)||($N_PROM2==0)) {$D_PROM=$D_PROM1;}
if (($N_PAGO>0)&&($N_PROM==0)) {$DPROM='';}
$qins = "INSERT INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
C_TELE,CUANDO,CUENTA,C_OBSE1,C_ATTE,C_CARG,D_PROM,N_PROM,C_PROM,D_PROM1,N_PROM1,D_PROM2,N_PROM2,
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
$AUTH."'
)";
if (($error>0)&&($capt!='luupita')) {
	$PAGOTXT='';
	if (($C_CVST=="PROMESA DE PAGO TOTAL")||($C_CVST=="PROMESA DE PAGO TOTAL")) {
		$PAGOTXT=" con toda promesa de ".$N_PROM." y fecha primera ".$D_PROM1;
		}
	$redirector = "Location: /closeme.php?msg=Checar que gestion de 
	cuenta ".$CUENTA." con status ".$C_CVST.$PAGOTXT."  
	está guardado corectamente.";
header($redirector);
}
if (($error<1)||($capt=='lupita')) {
mysqli_autocommit($con, FALSE);
$queryins=str_replace(';',' ',$qins);
mysqli_query($con,$queryins) or die ("ERROR RM24 - ".mysqli_error($con));
$querygest="INSERT INTO histgest (auto,c_cvge) SELECT auto,'".$C_CVGE."' 
FROM historia 
WHERE c_cont=".$C_CONT." AND d_fech='".$D_FECH."'
AND c_hrin='".$C_HRIN."' AND c_hrfi='".$C_HRFI."'
AND auto NOT IN (SELECT auto FROM histgest)
;";
mysqli_query($con,$querygest) or die ("ERROR RM24a - ".mysqli_error($con));
$best=$C_CONTAN;
$querybest="select c_cvst,v_cc from historia,dictamenes 
where c_cont=".$C_CONT." 
and (d_prom>curdate() or n_prom=0)
and c_cvst=dictamen
order by v_cc limit 1;";
$resultbest=mysqli_query($con,$querybest) or die ("ERROR RM25 - ".mysqli_error($con));
while ($answerbest=mysqli_fetch_row($resultbest)) {$best=$answerbest[0];};
//$querysa = "update resumen set status_aarsa='".$best."', especial=1,fecha_ultima_gestion=now() where id_cuenta='".$C_CONT."';";;
$querysa = "update resumen set status_aarsa='".$best."',fecha_ultima_gestion=now() where id_cuenta='".$C_CONT."';";;
mysqli_query($con,$querysa) or die ("ERROR RM26 - ".mysqli_error($con));
$querysa1="update resumen
set status_aarsa='PAGO DEL MES ANTERIOR'
where status_aarsa like 'PAG%' and status_aarsa not like 'PAGO TOTAL%' 
and id_cuenta=".$C_CONT." 
and id_cuenta in (select id_cuenta from pagos)
and id_cuenta not in (select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and status_de_credito not like '%o';";
mysqli_query($con,$querysa1) or die ("ERROR RM26a - ".mysqli_error($con));
$querysa1a="update resumen
set status_aarsa='PAGO TOTAL DEL MES ANTERIOR'
where id_cuenta=".$C_CONT." 
and status_de_credito not like '%o'
and id_cuenta in (select id_cuenta from pagos
where fecha>last_day(curdate()-interval 2 month)
and fecha<=last_day(curdate()-interval 1 month))
and id_cuenta in (select c_cont from historia 
where c_cvst='pago total' 
and d_fech>last_day(curdate()-interval 2 month)
and d_fech<=last_day(curdate()-interval 1 month))";
mysqli_query($con,$querysa1a) or die ("ERROR RM26aa - ".mysqli_error($con));
$querysa2="update cobra4.resumen set status_aarsa='PROMESA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra4.historia where n_prom>0 
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra4.historia where n_prom>0 
and d_prom<curdate()) and id_cuenta=".$C_CONT." 
and id_cuenta not in 
(select id_cuenta from cobra4.pagos where fecha>last_day(curdate()-interval 1 month)) 
and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');";
mysqli_query($con,$querysa2) or die ("ERROR RM26b - ".mysqli_error($con));
$querysa3="update cobra4.resumen set status_aarsa='PROPUESTA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra4.historia where n_prom>0 
and d_prom>curdate())  and id_cuenta=".$C_CONT." 
and id_cuenta in (select c_cont from cobra4.historia where n_prom>0 
and d_prom<curdate()) 
and id_cuenta not in 
(select id_cuenta from cobra4.pagos where fecha>last_day(curdate()-interval 1 month))  
and status_aarsa in ('propuesta de pago','propuesta hoy');";
mysqli_query($con,$querysa3) or die ("ERROR RM26c - ".mysqli_error($con));
if (!empty($C_NTEL)) {
$queryntel="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_NTEL." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$queryntel) or die ("ERROR RM27 - ".mysqli_error($con));
};
if (!empty($C_EMAIL)) {
$queryndir="UPDATE resumen SET email_deudor='".$C_EMAIL."' WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$queryndir) or die ("ERROR RM28 - ".mysqli_error($con));
};
if (!empty($C_OBSE2)&&$C_OBSE2==filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
$querymemo="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_OBSE2." WHERE id_cuenta='".$C_CONT."'";
mysqli_query($con,$querymemo) or die ("ERROR RM29 - ".mysqli_error($con));
};
mysqli_commit($con);
mysqli_autocommit($con, TRUE);
if ($N_PAGO>0) {
    $who=$capt;
    $queryd="select c_cvge from historia where n_prom>0 and c_cvge like 'PRO%'
    and c_cont=".$C_CONT." order by d_fech desc, c_hrin desc limit 1;";
    $resultd=mysqli_query($con,$queryd) or die ("ERROR RM30 - ".mysqli_error($con)); 
    while ($rowd=mysqli_fetch_row($resultd)) {$who=$rowd[0];}
    $queryins = "INSERT INTO pagos (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,ID_CUENTA,FECHACAPT) 
    VALUES ('$CUENTA','$D_PAGO',$N_PAGO,'$C_CVBA','$who',$C_CONT,now())";
    mysqli_query($con,$queryins) or die ("ERROR RM31 - ".mysqli_error($con));

    $querylast= "select fecha,monto from pagos where (cuenta,cliente,fecha) in (select cuenta,cliente,max(fecha) from pagos where id_cuenta=".$C_CONT." group by id_cuenta);";
    $resultlast =mysqli_query($con,$querylast) or die ("ERROR RM32 - ".mysqli_error($con));
    while ($answerlast=mysqli_fetch_row($resultlast)) {
        $mfecha=$answerlast[0];
        $mmonto=$answerlast[1];
        };

}
if ($merci>0) {
foreach ($MERC as $MERCa) {
    if (!empty($MERCa)) {
    $queryins = "INSERT INTO sdhmerc (ID_CUENTA,MERC,FECHAMERC,FECHACAPT) 
    VALUES (".$C_CONT.",'".$MERCa."','".$D_MERC."',now())";
    mysqli_query($con,$queryins) or die ("ERROR RM34 - ".mysqli_error($con));
}
}
if (!empty($_GET['localizar'])) {
$queryloc = "update resumen set localizar=".mysqli_real_escape_string($con,$_GET['LOCALIZAR'])." where id_cuenta='".$c_cont."';";;
//mysqli_query($con,$queryloc) or die ("ERROR RM35 - ".mysqli_error($con));
}
}
}
	$queryups="update folios,historia,resumen 
set enviado=0,fecha=d_fech+interval (time_to_sec(c_hrfi)) second 
where c_cont=id and n_prom>0 and d_fech>fecha and c_cvst like 'promesa de%'
and c_cont=id_cuenta and n_prom>=saldo_descuento_2
and d_fech=curdate() and fecha>last_day(curdate()-interval 1 month);";
	mysqli_query($con,$queryups) or die ("ERROR FM4a - ".mysqli_error($con));
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if ($find=="/") {$find=NULL;};
if ($capt=="/") {$capt=NULL;};
//}
//$redirector = "Location: ".$uri."?&capt=".$capt."&go=ULTIMA";
$redirector = "Location: /resumen.php?capt=".$capt;
$fromelastix = (!empty($_GET['elastix']));
if ($fromelastix) {
$redirector = "Location: /resumen.php?shutup=yes&capt=".$capt;
}

if (($C_CVST=="PROMESA DE PAGO TOTAL")&&(($C_CVBA=='Credito Si B')||($C_CVBA=='Credito Si F'))) {
$redirector="/folios.php?capt=".$capt."&tipo=".$mytipo."&CUENTA=".$CUENTA."&CLIENTE=".$C_CVBA."&source=resumen&go=FOLIOS";
}
if ($error<1) {
header($redirector);}
}
//if (substr($capt,0,8)=="practica") {$tcapt="practica";}
$mynombre='';
$queryg = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales='".$capt."'";
$resultg = mysqli_query($con,$queryg) or die("ERROR RM37 - ".mysqli_error($con));
while($answerg = mysqli_fetch_row($resultg)) {
							 $mynombre=$answerg[0];
							 $mytipo=$answerg[1];
							 $camp=$answerg[2];
							 }
if (empty($capt))
{
$redirector = "Location: /index.php";
header($redirector);
}
$id_cuenta=0;
$lockflag=0;
$queryquery="SELECT cliente, status_aarsa, camp, 
orden1, updown1, orden2, updown2, orden3, updown3, sdc FROM queuelist 
WHERE gestor='".$capt."' AND camp='".$camp."'";
$resultquery=mysqli_query($con,$queryquery) or die("ERROR RM38 - ".mysqli_error($con));
while ($answerquery=mysqli_fetch_row($resultquery)) {
$cliente=$answerquery[0];
$sdc=$answerquery[9];
$CR=$answerquery[1];
$cr=$answerquery[1];
$order1=$answerquery[3];
$updown1='';
if ($answerquery[4]==1) {$updown1=' desc';};
$order2=$answerquery[5];
$updown2='';
if ($answerquery[6]==1) {$updown2=' desc';};
$sep12='';$lockflag=0;
$sep23='';
if ($order2!='') {$sep12=',';};
$order3=$answerquery[7];
$updown3='';
if ($answerquery[8]==1) {$updown3=' desc';};
if (($order3!='')&&($order1.$order2!='')) {$sep23=',';};
}
if (substr($CR,0,4)=='SELF') {$cr=substr($CR,4);}
$codres=' AND queue="'.$cr.'" ';
if ($cr=='') { $camp=0;}
if ($camp>0) {
if ($cr=='NOCTURNOS') { $codres=" AND (status_aarsa = 'NEGATIVA DE PAGO' 
        OR status_aarsa = 'PAGO VENCIDO' 
        OR status_aarsa = 'PROMESA INCUMPLIDA' 
        OR status_aarsa = 'PROPUESTA INCUMPLIDA' 
        OR status_aarsa = 'MENSAJE CON FAMILIAR' ) 
        ";}
if ($cr=='ACLARACION') { $codres=" AND (status_aarsa='ACLARACION')";}
if ($cr=='REFINANCIABLES') { $codres=" AND (saldo_cuota > 0)";}
//$gestorstr=" AND ejecutivo_asignado_call_center='".$tcapt."' ";
$gestorstr="";
	$sdctxt="AND status_de_credito='".$sdc."'";
	if ($sdc=='') {$sdctxt='';}
if ($capt=='gmbs') {$gestorstr='';}
if (($mytipo=='admin')&&($capt!='efren')) {$gestorstr='';}
if ($cr=='ACTUALIZADOS') { 
$codres=" AND (tel_1_verif IS NOT NULL)";
}
$querymain = "SELECT * FROM resumen ignore index (fecha)
left join dictamenes on status_aarsa=dictamen
WHERE status_de_credito not like '%o' ".$gestorstr."
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 ORDER BY fecha_ultima_gestion, v_cc, saldo_total desc LIMIT 1";
if ($cr<>'') {
$querymain = "SELECT * FROM resumen ignore index (fecha)
join dictamenes on dictamen=status_aarsa 
WHERE status_de_credito not like '%o' ".$gestorstr."
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 ".$sdctxt."
 AND cliente='".$cliente."'".$codres.
"ORDER BY ".$order1.$updown1.$sep12.$order2.$updown2.$sep23.$order3.$updown3." LIMIT 1";
 }
if ($cr=='SIN GESTION') {
$querymain = "SELECT * FROM resumen ignore index (fecha)
WHERE (status_de_credito not like '%o' ".$gestorstr."
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 AND status_de_credito not like '%o'
 AND cliente='".$cliente."' 
 AND ((status_aarsa='') or (status_aarsa is null)))
 ORDER BY saldo_total desc LIMIT 1";
 }
if ($cr=='LUPITA') {
$querymain = "SELECT resumen.* FROM resumen,historia 
WHERE (cliente='Credito Si' or cliente='Surtidor del Hogar')
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 AND status_de_credito not like '%o'
 AND status_aarsa='CLIENTE NEGOCIANDO' 
 AND c_cvge='".$capt."'
 AND c_cont=id_cuenta and c_cvst=status_aarsa and d_fech>last_day(curdate()-interval 1 month)
 ORDER BY fecha_ultima_gestion LIMIT 1";
 }
if ($cr=='ESPECIAL') {
$querymain = "SELECT resumen.* FROM resumen 
WHERE ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 AND cliente='".$cliente."'
 AND status_de_credito not like '%o' 
order by fecha_ultima_gestion
 LIMIT 1";}
if ($cr=='INCUMPLIDAS ESPECIAL') {
$querymain = "SELECT resumen.* FROM resumen 
WHERE ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 AND status_de_credito not like '%o'
 AND status_aarsa='PROMESA INCUMPLIDA' 
order by fecha_ultima_gestion
 LIMIT 1";}
if ($cr=='PROVIDENT OPERATIVO') {
$querymain = "SELECT * FROM resumen,dictamenes 
WHERE timelock is null and dictamen=status_aarsa
 AND status_de_credito not like '%o'
 AND cliente='Provident'
 AND queue like 'SIN%'
 AND tel_2 <> ''
 AND length(tel_1+0) in (1,12)
 order by fecha_ultima_gestion
 LIMIT 1"; }
if ($cr=='TOPS') {
$querymain = "select * from (select * from resumen,dictamenes 
where cliente='".$cliente."' and status_aarsa=dictamen
and status_de_credito not like '%o'
and queue <> 'PROMESAS'
and queue <> 'PAGOS'
and queue <> 'ACLARACION'
order by saldo_total desc limit 200) as tmp 
order by tmp.fecha_ultima_gestion limit 1";
 }
$noplay=0;
if (($cr=='MENSAJES DIRECTOS ESPECIAL') || ($cr=='CLIENTE NEGOCIANDO ESPECIAL')){$noplay=0;}
if ($cr=='CREDITO SI ESPECIAL') { 
$querymain = "SELECT resumen.* FROM resumen 
where status_de_credito not like '%o'
and cliente = '".$cliente."' 
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
and status_aarsa<>'PAGO TOTAL'
order by fecha_ultima_gestion, dias_vencidos
 limit 1";    }
if ($cr=='GE ESPECIAL') { 
$querymain = "SELECT resumen.* FROM resumen ignore index (fecha)
where status_de_credito not like '%o'
and cliente = 'GE Capital'
 AND timelock is null
order by fecha_ultima_gestion, saldo_total desc
 limit 1";    }
if ($cr=='CREDICLUB ESPECIAL') { 
$querymain = "SELECT * FROM resumen ignore index (fecha)  
where status_de_credito not like '%o'
and cliente = 'CrediClub'
 AND timelock is null
order by fecha_ultima_gestion
 limit 1";    }
if ($cr=='FIN DEL ANO ESPECIAL') { 
$querymain = "SELECT * FROM resumen 
left join dictamenes on status_aarsa=dictamen
where status_de_credito not regexp '-' and status_de_credito not regexp 'o'
and (cliente = 'Credito Si' or cliente = 'Surtidor del Hogar')
and queue='promesas'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
order by fecha_ultima_gestion
 limit 1";    }
if ($cr=='PROVIDENT ESPECIAL') { 
$querymain = "SELECT resumen.* FROM resumen 
where status_de_credito = ''
and cliente = 'Provident'
 AND timelock is null
order by fecha_ultima_gestion
 limit 1";    }
if ($cr=='CLIENTE NEGOCIANDO FIN DEL ANO ESPECIAL') {
$querymain = "SELECT * FROM resumen
left join dictamenes on status_aarsa=dictamen
where status_de_credito not regexp '-' and status_de_credito not regexp 'o'
and queue='CLIENTE NEGOCIANDO'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
order by fecha_ultima_gestion
 limit 1";    }
if ($cr=='MENSAJES DIRECTOS ESPECIAL') { 
$querymain = "SELECT * FROM resumen 
left join dictamenes on status_aarsa=dictamen
WHERE status_de_credito not like '%o'  
and queue='MENSAJES DIRECTOS'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 order by fecha_ultima_gestion LIMIT 1";
    }
if ($cr=='CLIENTE NEGOCIANDO ESPECIAL') {  
$querymain = "SELECT * FROM resumen 
left join dictamenes on status_aarsa=dictamen
WHERE (status_de_credito not like '%o') 
and queue='CLIENTE NEGOCIANDO'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
AND (cliente='Credito Si' or cliente='Surtidor del Hogar' or cliente='Prestamo Relampago')
 order by fecha_ultima_gestion LIMIT 1
";
    }
if (($cr=='ACTUALIZADOS') && ($cliente=='Vanguardia')) { 
$querymain = "SELECT * FROM resumen 
WHERE (tel_1_verif IS NOT NULL) AND cliente='Vanguardia'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 and fecha_ultima_gestion<curdate() LIMIT 1
";
    }
if (($cr=='MENSAJES DIRECTOS ESPECIAL') && ($sdc=='total')) { 
$querymain = "SELECT * FROM resumen 
left join dictamenes on status_aarsa=dictamen
WHERE status_de_credito not like '%o' and cliente='Credito Si' 
and queue='MENSAJES DIRECTOS'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 order by fecha_ultima_gestion  LIMIT 1
";
    }
if (($cr=='CLIENTE NEGOCIANDO ESPECIAL') && ($sdc=='total')) {  
$querymain = "SELECT * FROM resumen 
left join dictamenes on status_aarsa=dictamen
WHERE status_de_credito not like '%o' and cliente='Credito Si' 
and queue='CLIENTE NEGOCIANDO'
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 order by fecha_ultima_gestion  LIMIT 1
";
    }    
if (($cr=='INICIAL')) {  
$querymain = "SELECT resumen.* FROM resumen,historia h1,dictamenes
where c_cvst=dictamen and c_cont=id_cuenta
and d_fech>last_day(curdate()-interval 1 month) 
and queue in ('Promesas','Cliente negociando') and c_cvge='".$capt."' 
and not exists (select * from historia h2 where h2.c_cvst=dictamen
and h2.d_fech>last_day(curdate()-interval 1 month) 
and queue in ('Promesas','Cliente negociando') and h2.auto<h1.auto)
AND status_de_credito not like '%o' 
AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO')
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
order by fecha_ultima_gestion,d_fech  LIMIT 1
";
$querymain = "SELECT resumen.* FROM resumen
where status_de_credito not like '%o'
and status_aarsa=''
order by fecha_ultima_gestion,saldo_total desc LIMIT 1
";
    }    
    }
else {
$clientestr='';
if (!empty($_GET['clientefilt'])) {
	 $clientefilt=mysqli_real_escape_string($con,$_GET['clientefilt']);
	 if (strlen($clientefilt)>1) {$clientestr="AND cliente='".$clientefilt."' ";}
	 }
else {$clientefilt='';}	 
//$gestorstr=" AND ejecutivo_asignado_call_center='".$tcapt."' ";
//if (($mytipo=='supervisor'||$mytipo=='admin')&&(substr($CR,0,4)!='SELF')) {$gestorstr='';}
$querymain = "SELECT * FROM resumen 
WHERE status_de_credito not like '%o' ".$gestorstr."
 AND ((timelock is null or timelock<now()-interval 15 minute) OR (locker='".$capt."'))
 ".$clientestr." 
ORDER BY fecha_ultima_gestion,saldo_total desc LIMIT 1";
}
if (($go=='FROMBUSCAR')||($go=='FROMMIGO')||($go=='FROMULTIMA')||($go=='FROMPROM')) {
$querymain = "SELECT * FROM resumen WHERE id_cuenta = '".$find."' LIMIT 1";
}
if ($go=='QUICKSEARCH'||$go=='FROMALERT') {
$qcount=0;
$querycount = "SELECT count(1) FROM resumen 
    WHERE ".$field." = '".$find."';";
//if ($capt=='practica2') {die(htmlentities($querymain));} 
$resultcount = mysqli_query($con,$querycount) or die("ERROR RM39 - ".mysqli_error($con));
while ($answercount= mysqli_fetch_row($resultcount)) {$qcount=$answercount[0];}
$querymain = "SELECT * FROM resumen 
    WHERE ".$field." = '".$find."' order by ".$field." 
    LIMIT 1";}
if (($capt=='brendaverastegui')||('admin'=='admin')) {
$result = mysqli_query($con,$querymain) or die("ERROR RM40 - ".mysqli_error($con));
if ($capt=='stupid') {
$result='';}
while($row = mysqli_fetch_row($result)) {
$nombre_deudor=$row[0];
$domicilio_deudor=$row[1];
$colonia_deudor=$row[2];
$ciudad_deudor=$row[3];
$estado_deudor=$row[4];
$cp_deudor=$row[5];
$plano_guia_roji=$row[6];
$cuadrante_guia_roji=$row[7];
$tel_1=$row[8];
$tel_2=$row[9];
$tel_3=$row[10];
$tel_4=$row[11];
$nombre_deudor_alterno=$row[12];$lockflag=0;

$domicilio_deudor_alterno=$row[13];
$colonia_deudor_alterno=$row[14];
$ciudad_deudor_alterno=$row[15];
$estado_deudor_alterno=$row[16];
$cp_deudor_aterno=$row[17];
$tel_1_alterno=$row[18];
$tel_2_alterno=$row[19];
$tel_3_alterno=$row[20];
$tel_4_alterno=$row[21];
$plano_guia_roji_alterno=$row[22];
$cuadrante_guia_roji_alterno=$row[23];
$status_aarsa=$row[24];
$sucursal_cliente=$row[25];
$referencias_1=$row[26];
$nombre_referencia_1=$row[27];
$domicilio_referencia_1=$row[28];
$colonia_referencia_1=$row[29];
$ciudad_referencia_1=$row[30];
$estado_referencia_1=$row[31];
$cp_referencia_1=$row[32];
$tel_1_ref_1=$row[33];
$tel_2_ref_1=$row[34];
$referencias_2=$row[35];
$nombre_referencia_2=$row[36];
$domicilio_referencia_2=$row[37];
$colonia_referencia_2=$row[38];
$ciudad_referencia_2=$row[39];
$estado_referencia_2=$row[40];
$cp_referencia_2=$row[41];
$tel_1_ref_2=$row[42];
$tel_2_ref_2=$row[43];
$referencias_3=$row[44];
$nombre_referencia_3=$row[45];
$domicilio_referencia_3=$row[46];
$colonia_referencia_3=$row[47];
$ciudad_referencia_3=$row[48];
$estado_referencia_3=$row[49];
$cp_referencia_3=$row[50];
$tel_1_ref_3=$row[51];
$tel_2_ref_3=$row[52];
$referencias_4=$row[53];
$nombre_referencia_4=$row[54];
$domicilio_referencia_4=$row[55];
$frecuencia=$row[56];
$ciudad_referencia_4=$row[57];
$estado_referencia_4=$row[58];
$cp_referencia_4=$row[59];
$tel_1_ref_4=$row[60];
$tel_2_ref_4=$row[61];
$domicilio_laboral=$row[62];
$colonia_laboral=$row[63];
$ciudad_laboral=$row[64];
$estado_laboral=$row[65];
$cp_laboral=$row[66];
$tel_1_laboral=$row[67];
$tel_2_laboral=$row[68];
$gastos_de_cobranza=$row[69];
$fecha_de_actualizacion=$row[70];
$numero_de_cuenta=$row[71];
$numero_de_credito=$row[72];
$contrato=$row[73];
$saldo_total=$row[74];
$saldo_vencido=$row[75];
$saldo_descuento_1=$row[76];
$saldo_descuento_2=$row[77];
$fecha_corte=$row[78];
$fecha_limite=$row[79];
$fecha_de_ultimo_pago=$row[80];
$monto_ultimo_pago=$row[81];
$producto=$row[82];
$subproducto=$row[83];
$cliente=$row[84];
$status_de_credito='';
$status_de_credito=$row[85];
$pagos_vencidos=$row[86];
if ($cliente=='Surtidor del Hogar') {
$queryxmora="SELECT floor(max(xmora)/30.25) FROM sdhextras 
where cuenta='".$numero_de_cuenta."' order by subcuenta";
$resultxmora=mysqli_query($con,$queryxmora);
while ($answerxmora=mysqli_fetch_row($resultxmora))
{
$pagos_vencidos=$answerxmora[0];
}
}
$monto_adeudado=$row[87];
$fecha_de_asignacion=$row[88];
$fecha_de_deasignacion=$row[89];
$cuenta_concentradora_1=$row[90];
$saldo_cuota=$row[91];
if (empty($saldo_cuota)) {$saldo_cuota=0;};
$expediente=$row[92];
$id_cuenta=$row[93];
if (empty($id_cuenta)) {$id_cuenta=0;}
else {
$qsliced = "delete from rslice where user='".$capt."';"; 
mysqli_query($con,$qsliced) or die("ERROR RM55 - ".mysqli_error($con));
$qslice = "replace into rslice select *, '".$capt."', now() from resumen where id_cuenta=".$id_cuenta; 
mysqli_query($con,$qslice) or die("ERROR RM55 - ".mysqli_error($con));
};
$pago_pactado=$row[94];
$rfc_deudor=$row[95];
$telefonos_marcados=$row[96];
$tel_1_verif=$row[97];
$tel_2_verif=$row[98];
$tel_3_verif=$row[99];
$tel_4_verif=$row[100];
$telefono_de_ultimo_contacto=$row[101];
//$ultimo_status_de_la_gestion=$row[102];
$ejecutivo_asignado_call_center=$row[103];
$ejecutivo_asignado_domiciliario=$row[104];
$prioridad_de_gestion=$row[105];
$region_aarsa=$row[106];
$parentesco_aval=$row[107];
$localizar=$row[108];
$campo_libre_9=$row[109];
$empresa=$row[110];
$direccion_nueva=$row[115];
$C_OBSE2='';
$CUANDO='';
$querycom="select c_obse2,c_cvst,cuando from historia where c_cont='".$id_cuenta."' order by d_fech desc, c_hrin desc limit 1";
$resultcom = mysqli_query($con,$querycom) or die("ERROR RM41 - ".mysqli_error($con));
while ($answercom=mysqli_fetch_row($resultcom)) {
$C_OBSE2=$answercom[0];
$ultimo_status_de_la_gestion=$answercom[1];
$CUANDO=$answercom[2];
}
$breakflag=0;
if ($id_cuenta==0) {
$newcamp=3;
$querycamp="SELECT queuelist.camp FROM nombres,queuelist 
WHERE gestor=iniciales and status_aarsa<>'' and queuelist.camp>nombres.camp
AND gestor='".$capt."' AND bloqueado=0
ORDER BY queuelist.camp LIMIT 1";
$resultcamp=mysqli_query($con,$querycamp) or die("ERROR RM42 - ".mysqli_error($con));
while ($answercamp=mysqli_fetch_row($resultcamp)) {$newcamp=$answercamp[0];}
$queryccamp="UPDATE nombres SET camp=".$newcamp." WHERE iniciales='".$capt."';";
mysqli_query($con,$queryccamp) or die("ERROR RM43 - ".mysqli_error($con));
}
//$ia=0;
//$queryauth="select distinct authcode*curdate() from nombres where authcode is not null";
//$resultauth = mysqli_query($con,$queryauth) or die("ERROR RM44 - ".mysqli_error($con));
//while ($answerauth=mysqli_fetch_row($resultauth)) {
//			$authcode[$ia]=$answerauth[0];
//			$ia=$ia+1;
//			};
$querydg="select * from dgextras
where cuenta='".$numero_de_cuenta."' limit 1";
if ($cliente=='dguerra') {
$resultdg = mysqli_query($con,$querydg) or die("ERROR RM45a - ".mysqli_error($con));
while ($answerdg=mysqli_fetch_row($resultdg)) {
$nombre_deudor_alterno_2=$answerdg[1];
$domicilio_deudor_alterno_2=$answerdg[2];
$colonia_deudor_alterno_2=$answerdg[3];
$ciudad_deudor_alterno_2=$answerdg[4];
$estado_deudor_alterno_2=$answerdg[5];
$cp_deudor_aterno_2=$answerdg[6];
$domicilio_deudor_2=$answerdg[7];
$colonia_deudor_2=$answerdg[8];
$ciudad_deudor_2=$answerdg[9];
$domicilio_deudor_alterno_2a=$answerdg[10];
$colonia_deudor_alterno_2a=$answerdg[11];
$ciudad_deudor_alterno_2a=$answerdg[12];
$domicilio_deudor_alterno_2b=$answerdg[13];
$colonia_deudor_alterno_2b=$answerdg[14];
			};
			}
$queryprom="select n_prom,d_prom,n_prom1,d_prom1,n_prom2,d_prom2,c_freq 
from historia 
where c_cont=".$id_cuenta." and n_prom>0 
and c_cvst like 'PROM%DE%'
order by d_fech desc, c_hrin desc limit 1";
$resultprom = mysqli_query($con,$queryprom) or die("ERROR RM45 - ".mysqli_error($con));
while ($answerprom=mysqli_fetch_row($resultprom)) {
			$N_PROM_OLD=$answerprom[0];
			$D_PROM_OLD=$answerprom[1];
			$N_PROM1_OLD=$answerprom[2];
			$D_PROM1_OLD=$answerprom[3];
			$N_PROM2_OLD=$answerprom[4];
			$D_PROM2_OLD=$answerprom[5];
			};
$folio="";
$nmerc=0;
$nfolio=0;
$queryfolio="SELECT max(folio) FROM folios WHERE id='".$id_cuenta."'
AND id>0 and mercancia=0 and fecha>last_day(curdate()-interval 1 month) order by fecha desc,folio desc limit 1
;";
$resultfolio = mysqli_query($con,$queryfolio) or die("ERROR RM46 - ".mysqli_error($con));
while ($answerfolio=mysqli_fetch_row($resultfolio)) {$folio=$answerfolio[0];}
$querynmerc="SELECT min(folio) FROM folios WHERE cliente='".$cliente."'
and usado=0 and mercancia=1;";
$resultnmerc = mysqli_query($con,$querynmerc) or die("ERROR RM47 - ".mysqli_error($con));
while ($answernmerc=mysqli_fetch_row($resultnmerc)) {$nmerc=$answernmerc[0];}
$querynfolio="SELECT min(folio) FROM folios WHERE cliente='".$cliente."'
and usado=0 and mercancia=0;";
$resultnfolio = mysqli_query($con,$querynfolio) or die("ERROR RM48 - ".mysqli_error($con));
while ($answernfolio=mysqli_fetch_row($resultnfolio)) {$nfolio=$answernfolio[0];}
$nproms=0;
$querynproms="SELECT count(1) FROM historia WHERE c_cont=".$id_cuenta."
and n_prom>0;";
$resultnproms = mysqli_query($con,$querynproms) or die("ERROR RM48a - ".mysqli_error($con));
while ($answernproms=mysqli_fetch_row($resultnproms)) {$nproms=$answernproms[0];}
$npagos=0;
$querynpagos="SELECT count(1) FROM pagos WHERE id_cuenta=".$id_cuenta.";";
$resultnpagos = mysqli_query($con,$querynpagos) or die("ERROR RM48b - ".mysqli_error($con));
while ($answernpagos=mysqli_fetch_row($resultnpagos)) {$npagos=$answernpagos[0];}
$querycheck="SELECT timelock, locker,time_to_sec(timediff(now(),timelock))/60 from resumen  WHERE id_cuenta='".$id_cuenta."';";
$resultcheck = mysqli_query($con,$querycheck) or die("ERROR RM50 - ".mysqli_error($con));
while ($answercheck=mysqli_fetch_row($resultcheck)) {
			$timelock=$answercheck[0];
			$locker=$answercheck[1];
			$sofar=$answercheck[2];
			};
if ($mytipo=='admin') {$tl=date('r');}
if ($mytipo!='admin') {
if (!(empty($locker)) && ($locker!=$capt)) {$lockflag=1;$tl=date('r');$breakflag=0;}
else {
$queryunlock="UPDATE resumen SET timelock=NULL, locker=NULL 
WHERE locker='".$capt."';";
$querylock="UPDATE resumen SET timelock=now(),locker='".$capt."' WHERE id_cuenta='".$id_cuenta."';";
$queryunlock2="UPDATE rslice SET timelock=NULL, locker=NULL 
WHERE locker='".$capt."';";
$querylock2="UPDATE rslice SET timelock=now(),locker='".$capt."' WHERE id_cuenta='".$id_cuenta."';";
mysqli_autocommit($con, FALSE);
mysqli_query($con,$queryunlock) or die("ERROR RM51 - ".mysqli_error($con));
mysqli_query($con,$querylock) or die("ERROR RM52 - ".mysqli_error($con));
mysqli_query($con,$queryunlock2) or die("ERROR RM51 - ".mysqli_error($con));
mysqli_query($con,$querylock2) or die("ERROR RM52 - ".mysqli_error($con));
mysqli_commit($con);
$querytlock="SELECT date_format(timelock,'%a, %d %b %Y %T') FROM 
resumen 
WHERE id_cuenta='".$id_cuenta."';";
$resulttlock=mysqli_query($con,$querytlock) or die("ERROR RM53 - ".mysqli_error($con));
while ($answertlock=mysqli_fetch_row($resulttlock)) {$tl=$answertlock[0];}
$breakflag=0;
$querybreak="SELECT tipo,empieza,termina FROM breaks 
WHERE time(now()) between empieza and termina and gestor='".$capt."';";
$resultbreak=mysqli_query($con,$querybreak) or die("ERROR RM54 - ".mysqli_error($con));
while ($answerbreak=mysqli_fetch_row($resultbreak)) {
$breakflag=1;
$btipo=$answerbreak[0];
$bemp=$answerbreak[1];
$bterm=$answerbreak[2];
}
}
}
};
$queryd="select curdate()-interval 1 day as yesterday,
least(last_day(curdate()+interval 1 day)+interval 15 day,
last_day(curdate()-interval 1 month)+interval 47 day) as dend,
last_day(curdate()+interval 1 month) as denda,
least(last_day(curdate()+interval 1 day)+interval 15 day,
last_day(curdate()-interval 1 month)+interval 47 day) as dend2;";
$resultd=mysqli_query($con,$queryd) or die ("ERROR EMqd - ".mysqli_error($con));
while ($answerd=mysqli_fetch_row($resultd)) {
	$yesterday=$answerd[0];
	$dend=$answerd[1];
	$dend2=$answerd[3];
	if ($mytipo=='admin') {$dend=$answerd[2];$dend2=$answerd[2];}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Resumen</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
       div {border: 1pt black solid;background-color:#ffffff;}
       #demobox {float: left;}
       .telbox {float: left;}
       .verif {font-weight:bold; background-color:#00ff00;}
       .badno {font-weight:normal; font-style:italic; background-color:#ff0000;}
       .nono {font-weight:normal; font-style:italic; background-color:#ffff00;}
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
#quicksearchbox {z-index: 98; display: none; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
       #quicksearchbox input {color: #000000; background-color: #ffffff;}
#calm {z-index: 98; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
       #calm input {color: #000000; background-color: #ffffff;}
       #pagocapt td {background-color: #ffff00;}
       #pagocapt2 td {background-color: #ffff00;}
       .visitable td {border:0; background-color: transparent;width:auto;}
       #buttonbox form {float:left}
       .buttons {float:left;width:auto}
       .buttons input {float:left}
       .buttons button {float:left;width:auto}
<?php if ($notalert>0) {?> 
	#notasq input {background-color: #ff0000;}
<?php }; 
if ($pagalert>0) {?> 
	#pagos input {background-color: #ff0000;}
<?php }; 
if (((preg_match('/o/', $status_de_credito))
||(preg_match('/o/', $status_de_credito))
||($id_cuenta==0))&&($mytipo<>'admin')&&($capt<>'karen')) {?> 
<?php }; ?>
<?php 
if ($mytipo=='visitador') {?> 
	#databox,#prombox,#nuevoboxt,#combox,#guardbox,#dtelboxt,#clock {display:none;}
	#visitboxt,#visitbox {display:block;}
<?php }; ?>
    .deudor {color: #ff0000;}
    .visit {color: #00aa00;}
       #avalbox input {font-size: 85%}
       #avalbox .shortinp {width: 5em;}
ul.tabs 
	{ list-style-type: none; padding: 0; margin: 0;} 
ul.tabs li 
	{ float: left; padding: 0; margin: 0; padding-top: 0; background: url(tab_right.png) no-repeat right top; margin-right: 1px; } 
ul.tabs li a 
	{ display: block; padding: 0px 10px; color: #fff; text-decoration: none; background: url(tab_left.png) no-repeat left top; } 
ul.tabs li a:hover 
	{ color: #ff0; }		
</style>
<script type="text/javascript" src="dom-drag.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
function trim(str)
{
    if(!str || typeof str != 'string')
        {return null;}
else {
    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');}
}
function beep() {}
function aviso() {
<?php if ($go=='ABINICIOLO') {?>
alert("Fecha de cierra es 17 Diciembre para todas cuentas.");
<?php } ?>
}
function paging(pageid) {
document.getElementById("TELEFONOS").style.display="none";
document.getElementById("REFERENCIAS").style.display="none";
document.getElementById("LABORAL").style.display="none";
document.getElementById("CONTABLES").style.display="none";
document.getElementById("MISCELANEA").style.display="none";
<?php if (($cliente=='FISA')||($cliente=='Surtidor del Hogar')) {?>
document.getElementById("EXTRAS").style.display="none";
<?php } ?>
document.getElementById("VISITA").style.display="none";
document.getElementById("HISTORIA").style.display="none";
document.getElementById(pageid).style.display="block";
if (document.getElementById("GESTION")) 
{document.getElementById("GESTION").style.display="block";}
if (pageid=="VISITA") {
document.getElementById("GESTION").style.display="none";
}
<?php if ($error>0) {?>
alert("Buscar para checar que gestion de cuenta <?php echo $CUENTA; ?> está guardado.");
<?php } ?>
}
function npromChange(thisform)
{
with (thisform) {
N_PROM.value=(N_PROM1.value*1)+(N_PROM2.value*1);
}
}
function statusChange(thisform)
{
with (thisform) {
if ((C_CVST.value=='PAGO TOTAL')||(C_CVST.value=='PAGO PARCIAL')||(C_CVST.value=='PAGANDO CONVENIO')) {
document.getElementById("pagocapt").style.display="table-row";
document.getElementById("pagocapt2").style.display="table-row";
}
}
}

function clock() {
var d=new Date();
var tn=d.getTime();
var tll = new Date('<?php echo $tl;?>');
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
if (!empty($qcount)) {
if ($qcount>1)
 {?>
        alert("ERROR RA3 - Hay <?php echo $qcount;?> cuentas con este número.");
<?php } }
if ($breakflag==1)
 {?>
        alert("Tiene <?php echo $btipo; ?> entre <?php echo $bemp; ?> y <?php echo $bterm; ?>");
<?php }
if ($notalert==10)
 {?>
        var goalert = confirm("Tiene alerta pendiente <?php echo $notalertt; ?> para cuenta <?php echo $alertcuenta; ?> Quiere verlo?");
        if(goalert==true)
    {
        window.location="resumen.php?find=<?php echo $alertcuenta; ?>&field=numero_de_cuenta&capt=<?php echo $capt; ?>&go=FROMALERT&from=%2F<?php echo $_SERVER['PHP_SELF'] ?>&go1=FROMALERT";
    }
<?php }
if ((preg_match('/o$/', $status_de_credito))
||(preg_match('/o$/', $status_de_credito)))
 {?>
        alert("Esta cuenta está <?php echo $status_de_credito ?>");
<?php }
if (($lockflag==0)&&(!empty($_GET['hfind']))) {
	$nn=0;
	$xfield[0]=mysqli_real_escape_string($con,$_GET['highlight']);
	$xfind="/".mysqli_real_escape_string($con,$_GET['hfind'])."/";
	$ofield=$xfield[0];
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1))) {$xfield[$nn]='tel_1';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2))) {$xfield[$nn]='tel_2';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_3))) {$xfield[$nn]='tel_3';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_4))) {$xfield[$nn]='tel_4';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_alterno))) {$xfield[$nn]='tel_1_alterno';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_alterno))) {$xfield[$nn]='tel_2_alterno';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_3_alterno))) {$xfield[$nn]='tel_3_alterno';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_4_alterno))) {$xfield[$nn]='tel_4_alterno';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_verif))) {$xfield[$nn]='tel_1_verif';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_verif))) {$xfield[$nn]='tel_2_verif';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_3_verif))) {$xfield[$nn]='tel_3_verif';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_4_verif))) {$xfield[$nn]='tel_4_verif';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_laboral))) {$xfield[$nn]='tel_1_laboral';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_laboral))) {$xfield[$nn]='tel_2_laboral';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_ref_1))) {$xfield[$nn]='tel_1_ref_1';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_ref_1))) {$xfield[$nn]='tel_2_ref_1';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_ref_2))) {$xfield[$nn]='tel_1_ref_2';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_ref_2))) {$xfield[$nn]='tel_2_ref_2';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_ref_3))) {$xfield[$nn]='tel_1_ref_3';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_ref_3))) {$xfield[$nn]='tel_2_ref_3';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_1_ref_4))) {$xfield[$nn]='tel_1_ref_4';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$tel_2_ref_4))) {$xfield[$nn]='tel_2_ref_4';$nn=$nn+1;}
	if (($ofield=='TELS')&&(preg_match($xfind,$telefonos_marcados))) {$xfield[$nn]='telefonos_marcados';$nn=$nn+1;}
	if (($ofield=='REFS')&&(preg_match($xfind,$nombre_deudor_alterno))) {$xfield[$nn]='nombre_deudor_alterno';$nn=$nn+1;}
	if (($ofield=='REFS')&&(preg_match($xfind,$nombre_referencia_1))) {$xfield[$nn]='nombre_referencia_1';$nn=$nn+1;}
	if (($ofield=='REFS')&&(preg_match($xfind,$nombre_referencia_2))) {$xfield[$nn]='nombre_referencia_2';$nn=$nn+1;}
	if (($ofield=='REFS')&&(preg_match($xfind,$nombre_referencia_3))) {$xfield[$nn]='nombre_referencia_3';$nn=$nn+1;}
	if (($ofield=='REFS')&&(preg_match($xfind,$nombre_referencia_4))) {$xfield[$nn]='nombre_referencia_4';$nn=$nn+1;}
	if ($ofield=='ROBOT') {$xfield[$nn]='historybody';$nn=$nn+1;}
for ($n=0;$n<$nn;$n++) {
if ($xfield[$n]!='') {?>
	document.getElementById("<?php echo $xfield[$n]?>").style.backgroundColor="yellow";
	document.getElementById("<?php echo $xfield[$n]?>").style.fontWeight="bold";
	document.getElementById("<?php echo $xfield[$n]?>").parentNode.style.display="block";
<?php
}
}
}
if ($lockflag==1) {
?>
alert("ERROR RA4 - Esta record está en uso de <?php echo $locker ?>");
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
function tooLongv(e)
{
if (window.document.getElementById("C_OBSE1v").value.length>250) {
window.document.getElementById("C_OBSE1v").value=window.document.getElementById("C_OBSE1v").value.replace('  ',' ');
window.document.getElementById("C_OBSE1v").value=window.document.getElementById("C_OBSE1v").value.substr(0,200);
confirm('GESTION demasiado largo');
window.document.getElementById("C_OBSE1v").style.backgroundColor="yellow";
return false;}
}
function logout()
{
        window.location="resumen.php?capt=<?php echo $capt; ?>&go='LOGOUT'";
}

function showsearch()
{
if (document.buscar.qs.checked)
{
document.getElementById('quicksearchbox').style.display="block";
document.getElementById('findq').focus();
}
else
{
document.getElementById('searchbox').style.display="block";
document.getElementById('find').focus();
}
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
    if (!parseInt(tel)){alert('ERROR RA5 - No es numero.');}
    else if ((tel.length!=8) && (tel.length!=10) && (tel.length!=12) && (tel.length!=13)) {
        alert('ERROR RA6 - Telefono invalido.');
        }
    else {
    dialstr="dial2.php?capt="+capt+"&cta="+cta+"&tel="+tel;
    window.open(dialstr);
    }
    }
</SCRIPT>
<script type="text/javascript" src="depuracion.js"></script>
<script type="text/javascript" src="depuracionv5.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
</head>
<body onLoad="alerttxt=new String('');paging('HISTORIA');openSearch();aviso();" id="todos">
<div id="buttonbox">
<form class="buttons" name="seg" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="seg">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
<input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
<input type="submit" name="go" value="SEG"></form>
<?php if ($mytipo=='supervisor'||$mytipo=='admin') { ?>
<form class="buttons" name="skip" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="skip">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
<input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
<input type="submit" name="go" value="SALTAR"></form>
<?php } ?>
<form class="buttons" name="ultima" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="ultima">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
<input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
<input type="submit" name="go" value="ULTIMA"></form>

<form class="buttons" name="buscar" action="#" id="buscar">
Cuenta rapido<input type='checkbox' name="qs" id="qs" value="qs" 
<?php if (!empty($_GET['qs'])) {echo 'checked="checked"';}?>
>
<button type="button" value="buscar" onclick=
"showsearch();">BUSCAR</button>
</form>
<form class="buttons" name="visitlist" method="get" action=
"visitlist.php" id="visitlist" target="_blank">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>"> 
<input type="hidden" name="ejecutivo_asignado_call_center" value="<?php echo $ejecutivo_asignado_call_center ?>"> 
<input type="submit" name="go" value="VISITAS"></form>
<form class="buttons" name="rotas" method="get" action=
"rotas.php" id="rotas">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="submit" name="go" value="PROMESAS"></form>
<!--
<form class="buttons" name="quien" method="get" action="receive.php" 
id="pagos" target="_blank">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo 
$capt;}?>"
<input type="submit" name="go" value="QUIEN ES"></form>
-->
<form class="buttons" name="pagos" method="get" action="pagos.php" id="pagos" target="_blank">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="id_cuenta" value="<?php if (isset($id_cuenta)) {echo $id_cuenta;} ?>">
<input type="submit" name="go" value="PAGOS"></form>
<form class="buttons" name="white" method="get" action="white.php" id="white" target="_blank">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="submit" name="go" value="PAGINAS BLANCAS"></form>
<?php if (($mytipo=='admin'||$mytipo=='supervisor)')&&$cliente=='UR') { ?>
<form class="buttons" name="notificacion" method="get" action="carta_UR.php" id="notificacion" target="_blank">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="C_CONT" value="<?php if (isset($id_cuenta)) {echo $id_cuenta;} ?>">
<input type="submit" name="go" value="NOTIFICACION"></form>
<?php } 
$CTA=$numero_de_credito;
if ($cliente!='Prestamo Relampago') {$CTA=$numero_de_cuenta;}
if (($cliente=='Credito Si B')||(($cliente=='Credito Si F'))) {
?>
<form class="buttons" name="folios" method="get" action="folios.php" id="folios">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>"> 
<input type="hidden" name="tipo" value="<?php if (isset($mytipo)) {echo $mytipo;} ?>"> 
<input type="hidden" name="CUENTA" value="<?php echo $CTA; ?>">
<input type="hidden" name="CLIENTE" value="<?php echo $cliente; ?>">
<input type="hidden" name="source" value="resumen">
<input type="submit" name="go" value="FOLIOS"></form>
<?php } ?>
<form class="buttons" name="notasq" method="get" action="notas.php" id="notas" target="_blank"><input type="hidden"
name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>"> 
<input type="hidden" name="CUENTA" value="<?php if (isset($numero_de_cuenta)) {echo $numero_de_cuenta;} ?>">
<input type="hidden" name="C_CONT" value="<?php if (isset($id_cuenta)) {echo $id_cuenta;} ?>">
<input type="submit" name="go" value="NOTAS"></form>
<?php if (($cr!='INICIAL')||($id_cuenta==0)||(1==1)) {?>
<form class="buttons" name="queuesg" method="get" action=
"queuesg.php" id="queuesg" target="_blank">
<input type="hidden"
name="mytipo" value="<?php if (isset($mytipo)) {echo $mytipo;} ?>">
<input type="hidden"
name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>"> 
<input type="submit" name="go" value="QUEUES"></form>
<?php } ?>
<form class="buttons" name="logout" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="logout">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>"> 
<input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
<input type="submit" name="go" value="LOGOUT"></form>
<?php if ($camp==0) {?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
<select name="clientefilt" onChange="this.form.submit()">
<option value="" <?php if ($clientefilt=='') {?> selected="selected"<?php } ?>>todos</option>
<?php 
$queryfilt = "SELECT DISTINCT cliente FROM resumen 
WHERE ejecutivo_asignado_call_center='".$tcapt."' 
ORDER BY cliente
LIMIT 100
;";
$resultfilt = mysqli_query($con,$queryfilt);
while ($answerfilt = mysqli_fetch_array($resultfilt)) {?>
<option value="<?php echo $answerfilt[0];?>" <?php if ($clientefilt==$answerfilt[0]) {?> selected='selected'<?php } ?>><?php echo $answerfilt[0];?>
</option>
<?php  } ?>
</select>
</form>
<?php  }
else { ?>
<button><?php echo $cliente ?></BUTTON>
<?php } 
if ($mytipo=='admin') { ?>
<form action="reports.php" method="get">
<input type="hidden" name="capt" value="<?php echo $capt; ?>">
<input type="submit" value="REPORTES">
</form>
<?php } ?>

<span style='font-weight:bold;font-size:120%;'><?php echo $capt; ?></span>
<?php if (!empty($cliente)) {?>
<span onmouseover='this.style.visibility="hidden";'><img style="position:absolute;top:0;right:0" height=50 alt="client logo" src='<?php echo $cliente ?>.jpg'></span>
<?php } 
if ($nfolio>0) { echo $nfolio; ?>
&nbsp;es folio sig.
<?php } ?>
<?php if (($nmerc>0) and ($mytipo!='callcenter')) { echo $nmerc; ?>
&nbsp;es mercancia sig.
<?php } ?>
<form class="buttons" name="trouble" method="get" action="trouble.php" id="trouble" target="_blank">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>"> 
<input type="submit" name="go" value="ERROR">
</form>
</div>
<div class="clearbox">
	<UL class='tabs'>
		<LI><A onClick="paging('TELEFONOS')">TELEFONOS</A></LI>
		<LI><A onClick="paging('REFERENCIAS')">REFERENCIAS</A></LI>
		<LI><A onClick="paging('LABORAL')">LABORAL</A></LI>
		<LI><A onClick="paging('CONTABLES')">CONTABLES</A></LI>
		<LI><A onClick="paging('MISCELANEA')">MISCELANEA</A></LI>
<?php if (($cliente=='FISA')||($cliente=='Surtidor del Hogar')) {?>
		<LI><A onClick="paging('EXTRAS');">EXTRAS</A></LI>
<?php } ?>
		<LI><A onClick="paging('VISITA')">VISITA</A></LI>
		<LI><A onClick="paging('HISTORIA')">HISTORIA</A></LI>
	</UL>
</div>
<form action="#" method="post" name="resumenform" id=
"resumenform">
<div id="GENERAL">
<table summary="demograficas">
<tr>
<td>
<span class='formcapa' id='deudor'>Deudor</span><input type='text' size=50 style='width:7.1cm' name=nombre_deudor id="nombre_deudor" readonly='readonly' value='<?php if (isset($nombre_deudor)) {echo htmlentities($nombre_deudor);} ?>'><br>
</td>
<td>
<span class='formcapa' id='domicilio'>Domicilio</span>
<textarea name=domicilio_deudor id=domicilio_deudor readonly='readonly' rows=5 cols=20>
<?php echo $domicilio_deudor."\n".$colonia_deudor."\n".$ciudad_deudor.", ".$estado_deudor.'  '.$cp_deudor; ?>
<?php if (!empty($domicilio_deudor_2)) {echo "\n o \n".$domicilio_deudor_2."\n".$colonia_deudor_2."\n".$ciudad_deudor_2.", ".$estado_deudor_2.'  '.$cp_deudor_2;} ?>
</textarea>
</td>
<tr>
<td>
<span class='formcapa'>Gestor - call center</span><input type='text' name=ejecutivo_asignado_call_center readonly='readonly' value='<?php if (isset($ejecutivo_asignado_call_center)) {echo $ejecutivo_asignado_call_center;} ?>'><br>
<span class='formcapa'>Numero de cuenta</span><input type='text' name=numero_de_cuenta id="numero_de_cuenta" readonly='readonly' value='<?php if (isset($numero_de_cuenta)) {echo $numero_de_cuenta;} ?>'><br>
<span class='formcapa'>status_aarsa</span><input type='text' name=status_aarsa readonly='readonly' value='<?php if (isset($status_aarsa)) {echo $status_aarsa;} ?>'><br>
</td>
<td>
<div id='clock'>
<input type="hidden" name="timer" id="timer" readonly="readonly" value="0">:
<input type="text" name="timerm" id="timerm" readonly="readonly" value="0" size="3">:
<input type="text" name="timers" id="timers" readonly="readonly" value="0" size="3"><br>
<?php
$numgest=0;
$queryng = "SELECT count(1) FROM historia 
WHERE c_cvge='".$capt."' 
AND d_fech=curdate()
AND c_cont <> '0'
";
$resultng=mysqli_query($con,$queryng);
$campoc=" style='background-color:red; color:white;'";
while ($answerng=mysqli_fetch_row($resultng)) {
$numgest=$answerng[0];
if ($numgest>20) {$campoc=" style='background-color:yellow; color:black;'";}
if ($numgest>40) {$campoc=" style='background-color:green; color:white;'";}
}
?>
<input type="text"<?php echo $campoc;?> name="numgest" id="numgest" readonly="readonly" value="<?php echo $numgest.' gestiones'; ?>">
</div>
<div id='yolanda'>
PROMESAS:<input type="text" name="nproms" id="nproms" readonly="readonly" value="<?php echo $nproms; ?>" size="3">
PAGOS:<input type="text" name="npagos" id="npagos" readonly="readonly" value="<?php echo $npagos; ?>" size="3"><br>
</div>
</td>
</tr>
</table>
</div>
<div id="TELEFONOS">
<span class='formcap'>Tel 1</span><input type='text' name=tel_1 id="tel_1" readonly='readonly' value='<?php if (isset($tel_1)) {echo $tel_1;} ?>'><br>
<span class='formcap'>Tel 2</span><input type='text' name=tel_2 id="tel_2" readonly='readonly' value='<?php if (isset($tel_2)) {echo $tel_2;} ?>'><br>
<span class='formcap'>Tel 3</span><input type='text' name=tel_3 id="tel_3" readonly='readonly' value='<?php if (isset($tel_3)) {echo $tel_3;} ?>'><br>
<span class='formcap'>Tel 4</span><input type='text' name=tel_4 id="tel_4" readonly='readonly' value='<?php if (isset($tel_4)) {echo $tel_4;} ?>'><br>
<span class='formcap'>E-mail</span><input type='text' name=email_deudor readonly='readonly' value='<?php if (isset($email_deudor)) {echo $email_deudor;} ?>'><br>
</div>
<div id="REFERENCIAS">
<?php if (isset($nombre_deudor_alterno)) {?>
<span class='formcaps'>Aval</span><input type='text' name=nombre_deudor_alterno id="nombre_deudor_alterno" readonly='readonly' value='<?php if (isset($nombre_deudor_alterno)) {echo htmlentities($nombre_deudor_alterno);} ?>'>
<?php }
if (isset($domicilio_deudor_alterno)) {?>
<br><span class='formcaps'>Dirección Aval</span>
<textarea readonly='readonly'><?php echo $domicilio_deudor_alterno."\n".
$colonia_deudor_alterno."\n".
$ciudad_deudor_alterno."\n".
$estado_deudor_alterno; ?>
</textarea>
<?php }
if (isset($domicilio_deudor_alterno_2a)) {?>
<textarea readonly='readonly'><?php echo $domicilio_deudor_alterno_2a."\n".
$colonia_deudor_alterno_2a."\n".
$ciudad_deudor_alterno_2a."\n".
$estado_deudor_alterno_2a; ?>
</textarea>
<?php }
if (isset($nombre_deudor_alterno_2)) {?>
<br><span class='formcaps'>Aval 2</span><input type='text' name=nombre_deudor_alterno_2 
id="nombre_deudor_alterno_2" readonly='readonly' 
value='<?php if (isset($nombre_deudor_alterno_2)) {echo htmlentities($nombre_deudor_alterno_2);} ?>'>
<?php }
if (isset($domicilio_deudor_alterno_2)) {?>
<br><span class='formcaps'>Dirección Aval 2</span>
<textarea readonly='readonly'><?php echo $domicilio_deudor_alterno_2."\n".
$colonia_deudor_alterno_2."\n".
$ciudad_deudor_alterno_2."\n".
$estado_deudor_alterno_2; ?>
</textarea>
<?php }
if (isset($domicilio_deudor_alterno_2b)) {?>
<textarea readonly='readonly'><?php echo $domicilio_deudor_alterno_2b."\n".
$colonia_deudor_alterno_2b."\n".
$ciudad_deudor_alterno_2b."\n".
$estado_deudor_alterno_2b; ?>
</textarea>
<?php }
if (isset($parentesco_aval)) {?>
<input type='text' name=parentesco_aval class='shortinp' readonly='readonly' value='<?php if (isset($parentesco_aval)) {echo $parentesco_aval;} ?>'><br>
<?php }  ?>
<br>
<?php 
if (isset($tel_1_alterno)) {?>
<span class='formcaps'>Tel 1</span><input type='text' name=tel_1_alterno id="tel_1_alterno" readonly='readonly' value='<?php if (isset($tel_1_alterno)) {echo $tel_1_alterno;} ?>'><br>
<?php } 
if (isset($tel_2_alterno)) {?>
<span class='formcaps'>Tel 2</span><input type='text' name=tel_2_alterno id="tel_2_alterno" readonly='readonly' value='<?php if (isset($tel_2_alterno)) {echo $tel_2_alterno;} ?>'><br>
<?php } 
if (isset($tel_3_alterno)) {?>
<span class='formcaps'>Tel 3</span><input type='text' name=tel_3_alterno id="tel_3_alterno" readonly='readonly' value='<?php if (isset($tel_3_alterno)) {echo $tel_3_alterno;} ?>'><br>
<?php } 
if (isset($tel_4_alterno)) {?>
<span class='formcaps'>Tel 4</span><input type='text' name=tel_4_alterno id="tel_4_alterno" readonly='readonly' value='<?php if (isset($tel_4_alterno)) {echo $tel_4_alterno;} ?>'><br>
<?php 
}
if ($cliente=='UR') { ?>
<span class='formcap'>Madre</span>
<?php } else {?>
<span class='formcaps'>Ref 1</span>
<?php } 
if (isset($nombre_referencia_1)) {?>
<input type='text' size=40 name=nombre_referencia_1 id="nombre_referencia_1" readonly='readonly' value='<?php if (isset($nombre_referencia_1)) {echo htmlentities($nombre_referencia_1);} ?>'>
<?php } 
if (isset($referencias_1)) {?>
<input type='text' name=referencias_1 class='shortinp' readonly='readonly' value='<?php if (isset($referencias_1)) {echo $referencias_1;} ?>'><br>
<?php } ?>
<br>
<?php if (isset($tel_1_ref_1)) {?>
<span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_1 id="tel_1_ref_1" readonly='readonly' value='<?php if (isset($tel_1_ref_1)) {echo $tel_1_ref_1;} ?>'><br>
<?php } 
if (isset($tel_2_ref_1)) {?>
<span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_1 id="tel_2_ref_1" readonly='readonly' value='<?php if (isset($tel_2_ref_1)) {echo $tel_2_ref_1;} ?>'><br>
<?php 
}
if ($cliente=='UR') { ?>
<span class='formcap'>Padre</span>
<?php } else {?>
<span class='formcaps'>Ref 2</span>
<?php } 
if (isset($nombre_referencia_2)) {?>
<input type='text' size=40 name=nombre_referencia_2 id="nombre_referencia_2" readonly='readonly' value='<?php if (isset($nombre_referencia_2)) {echo htmlentities($nombre_referencia_2);} ?>'>
<?php } 
if (isset($referencias_2)) {?>
<input type='text' name=referencias_2  class='shortinp' readonly='readonly' value='<?php if (isset($referencias_2)) {echo $referencias_2;} ?>'><br>
<?php }?>
<br>
<?php if (isset($tel_1_ref_2)) {?>
<span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_2 id="tel_1_ref_2" readonly='readonly' value='<?php if (isset($tel_1_ref_2)) {echo $tel_1_ref_2;} ?>'><br>
<?php } 
if (isset($tel_2_ref_2)) {?>
<span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_2 id="tel_2_ref_2" readonly='readonly' value='<?php if (isset($tel_2_ref_2)) {echo $tel_2_ref_2;} ?>'><br>
<?php 
}
if ($cliente=='UR') { ?>
<span class='formcap'>Tutor</span>
<?php } else {?>
<span class='formcaps'>Ref 3</span>
<?php } 
if (isset($nombre_referencia_3)) {?>
<input type='text' size=40 name=nombre_referencia_3 id="nombre_referencia_3" readonly='readonly' value='<?php if (isset($nombre_referencia_3)) {echo htmlentities($nombre_referencia_3);} ?>'>
<?php } 
if (isset($referencias_3)) {?>
<input type='text' name=referencias_3  class='shortinp' readonly='readonly' value='<?php if (isset($referencias_3)) {echo $referencias_3;} ?>'><br>
<?php } ?>
<br>
<?php if (isset($tel_1_ref_3)) {?>
<span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_3 id="tel_1_ref_3" readonly='readonly' value='<?php if (isset($tel_1_ref_3)) {echo $tel_1_ref_3;} ?>'><br>
<?php } 
if (isset($tel_2_ref_3)) {?>
<span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_3 id="tel_2_ref_3" readonly='readonly' value='<?php if (isset($tel_2_ref_3)) {echo $tel_2_ref_3;} ?>'><br>
<?php } 
if (isset($nombre_referencia_4)) {?>
<span class='formcaps'>Ref 4</span>
<input type='text' size=40 name=nombre_referencia_4 id="nombre_referencia_4" readonly='readonly' value='<?php if (isset($nombre_referencia_4)) {echo htmlentities($nombre_referencia_4);} ?>'>
<?php } 
if (isset($referencias_4)) {?>
<input type='text' name=referencias_4  class='shortinp' readonly='readonly' value='<?php if (isset($referencias_4)) {echo $referencias_4;} ?>'><br>
<?php } ?>
<br>
<?php if (isset($tel_1_ref_4)) {?>
<span class='formcaps'>Tel 1</span><input type='text' name=tel_1_ref_4 id="tel_1_ref_4" readonly='readonly' value='<?php if (isset($tel_1_ref_4)) {echo $tel_1_ref_4;} ?>'><br>
<?php } 
if (isset($tel_2_ref_4)) {?>
<span class='formcaps'>Tel 2</span><input type='text' name=tel_2_ref_4 id="tel_2_ref_4" readonly='readonly' value='<?php if (isset($tel_2_ref_4)) {echo $tel_2_ref_4;} ?>'><br>
<?php } ?>
</div>

<div id="LABORAL">
<span class='formcap'>Empresa</span><input type='text' name=empresa readonly='readonly' value='<?php if (isset($empresa)) {echo $empresa;} ?>'><br>
<span class='formcap'>Domicilio</span><input type='text' name=domicilio_laboral readonly='readonly' value='<?php if (isset($domicilio_laboral)) {echo $domicilio_laboral;} ?>'><br>
<span class='formcap'>Colonia</span><input type='text' name=colonia_laboral readonly='readonly' value='<?php if (isset($colonia_laboral)) {echo $colonia_laboral;} ?>'><br>
<span class='formcap'>Ciudad</span><input type='text' name=ciudad_laboral readonly='readonly' value='<?php if (isset($ciudad_laboral)) {echo $ciudad_laboral;} ?>'><br>
<span class='formcap'>Estado</span><input type='text' name=estado_laboral readonly='readonly' value='<?php if (isset($estado_laboral)) {echo $estado_laboral;} ?>'><br>
<span class='formcap'>CP</span><input type='text' name=cp_laboral readonly='readonly' value='<?php if (isset($cp_laboral)) {echo $cp_laboral;} ?>'><br>
<span class='formcap'>Tel 1</span><input type='text' name=tel_1_laboral id="tel_1_laboral" readonly='readonly' value='<?php if (isset($tel_1_laboral)) {echo $tel_1_laboral;} ?>'><br>
<span class='formcap'>Tel 2</span><input type='text' name=tel_2_laboral id="tel_2_laboral" readonly='readonly' value='<?php if (isset($tel_2_laboral)) {echo $tel_2_laboral;} ?>'><br>
</div>
<?php
if ($cliente=='FISA') {
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
$prods="";
$querysdh="SELECT grupo,mora,mora/30.25,c_bmx,a_bmx,a_bbva,a_conexia,a_fisa
 FROM fisa_extras 
where credito='".$numero_de_credito."'";
$resultsdh=mysqli_query($con,$querysdh);
while ($answersdh=mysqli_fetch_row($resultsdh))
{
?>
<tr>
<td><?php echo $answersdh[0];?></td>
<td><?php echo $answersdh[1];?></td>
<td><?php echo $answersdh[2];?></td>
<td><?php echo $answersdh[3];?></td>
<td><?php echo $answersdh[4];?></td>
<td><?php echo $answersdh[5];?></td>
<td><?php echo $answersdh[6];?></td>
<td><?php echo $answersdh[7];?></td>
</tr>
<?php
};
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
<td><input type='text' name=numero_de_credito readonly='readonly' value='<?php if (isset($numero_de_credito)) {echo $numero_de_credito;} ?>'></td>
<?php if (($cliente!='GE Capital')&&($cliente!='CrediClub')) { ?>
<td>Ultimo folio</td>
<td><?php if ($folio!='') { ?>
<input type='text' name='folio' id='folio' readonly='readonly' value='<?php echo 
$folio; ?>'></td>
<?php }
} 
if ($cliente=='GE Capital') { ?>
<td>Convenio CIE Bancomer</td>
<td style='font-weight:bold'>632236-<?php echo $numero_de_cuenta; ?><br></td>
<?php } 
if ($cliente=='Provident') { ?>
<td>BANCO BANAMEX<br>
CUENTA 28552<br>
SUCURSAL 4778<br>
REFERENCIA <?php echo $numero_de_cuenta; ?></td>
<td>BANCO SANTANDER SERFIN 65502341276<br>
REFERENCIA <?php echo $numero_de_cuenta; ?></td>
<?php } 
if ($cliente=='CrediClub') { ?>
<td>Convenio CIE Banorte</td>
<td style='font-weight:bold'>44568-<?php echo substr($numero_de_credito,-8); ?><br></td>
<?php }
?>
<td>ID cuenta</td>
<td><input type='text' name="id_cuenta" id="id_cuenta" readonly='readonly' value='<?php if (isset($id_cuenta)) {echo $id_cuenta;} ?>'></td>
</tr>
<tr>
<td>Fecha de asignacion</td>
<td><input type='text' name=fecha_de_asignacion readonly='readonly' value='<?php if (isset($fecha_de_asignacion)) {echo $fecha_de_asignacion;} ?>'></td>
<td>Fecha de actualizacion</td>
<td><input type='text' name=fecha_de_actualizacion readonly='readonly' value='<?php if (isset($fecha_de_actualizacion)) {echo $fecha_de_actualizacion;} ?>'></td>
<td>RFC deudor</td>
<td><input type='text' name=rfc_deudor readonly='readonly' value='<?php if (isset($rfc_deudor)) {echo $rfc_deudor;} ?>'></td>
</tr>
<tr>
<td>Contrato</td>
<td><input type='text' name=contrato readonly='readonly' value='<?php if (isset($contrato)) {echo $contrato;} ?>'></td>
<?php if ($cliente=='GE Capital') {?>
<td>Monto asignado</td>
<td><input type='text' name=saldo_cuota readonly='readonly' value='<?php if (isset($saldo_cuota)) {echo '$'.number_format($saldo_cuota);} ?>'></td>
</tr>
<?php } ?>
<?php if (($cliente=='Credito Si B')||($cliente=='Credito Si F')) {?>
<td>Saldo cuota</td>
<td><input type='text' name=saldo_cuota readonly='readonly' value='<?php if (isset($saldo_cuota)) {echo '$'.number_format($saldo_cuota);} ?>'></td></tr>
<?php } ?>
</tr>
<tr>
<td>Saldo total</td>
<td><input type='text' name=saldo_total readonly='readonly' value='<?php if (isset($saldo_total)) {echo '$'.number_format($saldo_total);} ?>'></td>
<?php if ($cliente<>'GE Capital') {?>
<td>Monto adeudado</td>
<td><input type='text' name=monto_adeudado readonly='readonly' value='<?php if (isset($monto_adeudado)) {echo '$'.number_format($monto_adeudado);} ?>'></td>
</tr>
<tr>
<td>Saldo vencido</td>
<td><input type='text' name=saldo_vencido readonly='readonly' value='<?php if ($cliente!='GE Capital') {echo '$'.number_format($saldo_vencido);} ?>'></td>
<?php } ?>
<?php if (($cliente=='Credito Si B')||($cliente=='Credito Si F')) {?>
<td>Saldo descuento 1</td>
<td><input type='text' name=saldo_descuento_1 readonly='readonly' value='<?php if (isset($saldo_descuento_1)) {echo '$'.number_format($saldo_descuento_1);} ?>'>
<?php } ?>
</td>
<td>Saldo descuento <?php if (($cliente=='Credito Si B')||($cliente=='Credito Si F')) { echo '2'; } ?></td>
<td><input type='text' 
name=saldo_descuento_2 readonly='readonly' value='<?php if 
(isset($saldo_descuento_2)) {echo 
'$'.number_format($saldo_descuento_2+0.51);} ?>'></td>
</tr>
<?php if (($cliente!='Credito Si B')&&($cliente!='Credito Si F')) { ?>
<tr>
<td>Fecha - ultimo pago</td>
<td><input type='text' name=fecha_de_ultimo_pago readonly='readonly' value='<?php if (isset($fecha_de_ultimo_pago)) {echo $fecha_de_ultimo_pago;} ?>'></td>
<td>Monto ultimo pago</td>
<td><input type='text' name=monto_ultimo_pago readonly='readonly' value='<?php if (isset($monto_ultimo_pago)) {echo '$'.number_format($monto_ultimo_pago);} ?>'></td>
<td>Producto</td>
<td><input type='text' name=producto readonly='readonly' value='<?php if (!empty($prods)) {echo $prods;} else {echo htmlentities($producto);} ?>'></td>
</tr>
<?php } ?>
<tr>
<?php if ($cliente=='FISA') { ?>
<td>Grupo</td>
<?php } else { ?>
<td>Subproducto</td>
<?php } ?>
<td><input type='text' name=subproducto readonly='readonly' value='<?php if (isset($subproducto)) {echo htmlentities($subproducto);} ?>'><br>
<td>Status de credito</td>
<td><input type='text' name=status_de_credito readonly='readonly' value='<?php if (isset($status_de_credito)) {echo $status_de_credito;} ?>'></td>
<td>Meses vencidos</td>
<td><input type='text' name=pagos_vencidos readonly='readonly' value='<?php if (isset($pagos_vencidos)) {echo $pagos_vencidos;} ?>'><br>
</tr>
</table>
</div>
<div id="MISCELANEA">
<span class='formcap'>Telefonos marcados</span><input type='text' name="telefonos_marcados" id="telefonos_marcados" readonly='readonly' value='<?php if (isset($telefonos_marcados)) {echo $telefonos_marcados;} ?>'><br>
<span class='formcap'>Tel 1 verificado</span><input type='text' name="tel_1_verif" id="tel_1_verif" readonly='readonly' value='<?php if (isset($tel_1_verif)) {echo $tel_1_verif;} ?>'><br>
<span class='formcap'>Tel 2 verificado</span><input type='text' name="tel_2_verif" id="tel_2_verif" readonly='readonly' value='<?php if (isset($tel_2_verif)) {echo $tel_2_verif;} ?>'><br>
<span class='formcap'>Tel 3 verificado</span><input type='text' name="tel_3_verif" id="tel_3_verif" readonly='readonly' value='<?php if (isset($tel_3_verif)) {echo $tel_3_verif;} ?>'><br>
<span class='formcap'>Tel 4 verificado</span><input type='text' name="tel_4_verif" id="tel_4_verif" readonly='readonly' value='<?php if (isset($tel_4_verif)) {echo $tel_4_verif;} ?>'><br>
<span class='formcap'>Tel de ult. contacto</span><input type='text' name="telefono_de_ultimo_contacto" readonly='readonly' value='<?php if (isset($telefono_de_ultimo_contacto)) {echo $telefono_de_ultimo_contacto;} ?>'><br>
<span class='formcap'>Ultimo status</span><input type='text' name='ultimo_status_de_la_gestion' readonly='readonly' value='<?php if (isset($ultimo_status_de_la_gestion)) {echo $ultimo_status_de_la_gestion;} ?>'><br>
</div>

</form>
<?php 
if (($id_cuenta==0) && ($mytipo=='callcenter')) { ?>
<div id='calm'>
<!--<form class="buttons" name="segq" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="segq">
-->
<p>Termino de queue <?php echo $cr; ?>
</p>
<!--
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
<input type="submit" name="go" value="SEG"></form>
-->
</div>
</form>
<?php } ?>
<div id="quicksearchbox">
<h2>Buscar Rapida</h2>
<form name="search" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="quicksearch">Buscar a: <input type=
"text" name="find" id="findq"><br>
<?php if ($cliente=='Prestamo Relampago') { ?>
<input type="hidden" name="field" value="numero_de_cuenta">
<?php } else { ?>
<input type="hidden" name="field" value="numero_de_cuenta">
<?php } ?>
<input type="hidden" name="qs" value="qs">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="go" value="QUICKSEARCH">
<input type="hidden" name="from" value="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="go1" value="QUICKSEARCH">
<input type="button" name="cancel" onclick="cancelbox('quicksearchbox')"
value="Cancel"> 
</form>
</div>
<div id="searchbox">
<h2>Buscar</h2>
<form name="search" method="get" action=
"buscar.php" id="search">Buscar a: <input type=
"text" name="find" id="find"> en <select name="field">
<option value="nombre_deudor">Nombre</option>
<option value="domicilio_deudor">Direcci&oacute;n</option>
<option value="numero_de_cuenta">Cuenta</option>
<option value="numero_de_credito">Credito</option>
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
$querycl = "SELECT cliente FROM clientes;";
$resultcl = mysqli_query($con,$querycl);
while ($answercl = mysqli_fetch_array($resultcl)) {?>
<option value="<?php echo $answercl[0];?>"><?php echo $answercl[0];?>
</option>
<?php  } ?>
</select><br>
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="C_CONT" value="<?php if (isset($id_cuenta)) {echo $id_cuenta;} ?>">
<input type="hidden" name="go" value="BUSCAR">
<input type="hidden" name="from" value="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="go1" value="BUSCAR">
<input type="button" name="cancel" onclick="cancelbox('searchbox')"
value="Cancel"> 
</form>
</div>
<div class="togglebox" id="VISITA">
<form action="#" method="get" id="capturaform" 
onSubmit="return validate_form2(this,event,<?php echo $saldo_descuento_2+0;?>,<?php 
if (($mytipo=='admin')||(!empty($AUTH))) {echo 1;} else {echo 0;}
?>,<?php echo 1000000;?>);">
<div class="noshow">
<input type="text" name="error" readonly="readonly" value="1" ><br>
<input type="text" name="C_HRFIv" readonly="readonly" value="<?php if (isset($CT)) {echo $CT;}?>" ><br>
<input type="text" name="AUTO" readonly="readonly" value="" ><br>
<input type="text" name="find" readonly="readonly" value="<?php if (isset($find)) {echo $find;}?>" ><br>
<input type="text" name="field" readonly="readonly" value="<?php if (isset($field)) {echo $field;}?>" ><br>
<input type="text" name="capt" readonly="readonly" value="<?php if (isset($capt)) {echo $capt;}?>" ><br>
<input type="text" name="camp" readonly="readonly" value="<?php if (isset($camp)) {echo $camp;}?>" ><br>
<input type="text" name="neworder" readonly="readonly" value="<?php if (isset($neworder)) {echo $neworder;}?>" ><br>
<input type="text" name="C_CVGEv" readonly="readonly" value="<?php if (isset($C_CVGE)) {echo $C_CVGE;}?>" ><br>
<input type="text" name="C_CVBAv" readonly="readonly" value="<?php if (isset($cliente)) {echo $cliente;}?>" ><br>
<input type="text" name="C_ATTEv" readonly="readonly" value="" ><br>
<input type="text" name="C_CONTv" readonly="readonly" value="<?php if (isset($id_cuenta)) {echo $id_cuenta;}?>" ><br>
<input type="text" name="C_CONTANv" readonly="readonly" value="<?php if (isset($status_aarsa)) {echo $status_aarsa;}?>" ><br>
<input type="text" name="CUENTAv" id="CUENTA2" readonly="readonly" value="<?php if (isset($numero_de_cuenta)) {echo $numero_de_cuenta;}?>" ><br>
<input type="text" name="C_EJEv" readonly="readonly" value="<?php if (isset($ejecutivo_asignado_call_center)) {echo $ejecutivo_asignado_call_center;}?>" ><br>
<input type="text" name="oldgo" readonly="readonly" value="<?php echo mysqli_real_escape_string($con,$go);?>" ><br>
</div>
<p>DICTAMEN DOMICILIO PARTICULAR</p>
<table class='visitable'>
<tr>
<th>Tipo:</th>
<td><label><input type="checkbox" name="domtipo" value="casa" id="casa"> Casa</label></td>
<td><label><input type="checkbox" name="domtipo" value="departamento" id="departamento"> Departamento</label></td>
<td><label><input type="checkbox" name="domtipo" value="terreno" id="terreno"> Terreno</label></td>
<td><label><input type="checkbox" name="domtipo" value="trabajo" id="trabajo"> Trabajo/Oficina</label></td>
</tr>
<tr>
<th>Propio:</th>
<td><label><input type="checkbox" name="domown" value="propio" id="propio"> Propio</label></td>
<td><label><input type="checkbox" name="domown" value="rentado" id="rentado"> Rentado</label></td>
<td><label><input type="checkbox" name="domown" value="abandonado" id="abandonado"> Abandonado</label></td>
<td><label><input type="checkbox" name="domown" value="deshabilitado" id="deshabilitado"> Deshabilitado</label></td>
<td><label><input type="checkbox" name="domown" value="invadido" id="invadido"> Invadido</label></td>
<td><label><input type="checkbox" name="domown" value="prestado" id="prestado"> Prestado</label></td>
<td><label><input type="checkbox" name="domown" value="laborando" id="laborando"> Laborando</label></td>
</tr>
<tr>
<th>Nivel:</th>
<td><label><input type="checkbox" name="C_NSEv" value="alto" id="alto">Alto</label></td>
<td><label><input type="checkbox" name="C_NSEv" value="medio" id="medio">Medio</label></td>
<td><label><input type="checkbox" name="C_NSEv" value="bajo" id="bajo">Bajo</label></td>
</tr>
<tr>
<th>Estado:</th>
<td><label><input type="checkbox" name="domstat" value="malo" id="malo">Malo</label></td>
<td><label><input type="checkbox" name="domstat" value="regular" id="regular">Regular</label></td>
<td><label><input type="checkbox" name="domstat" value="bueno" id="bueno">Bueno</label></td>
<td><label><input type="checkbox" name="domstat" value="excelente" id="excelente">Excelente</label></td>
</tr>
</table>
<p>SE&Ntilde;AS:</p>
<span class="formcap">Color:</span>
<select name="C_CFACv">
<option value="no">No especifica</option>
<option value="Amarilla">Amarilla</option>
<option value="Azul">Azul</option>
<option value="Beige">Beige</option>
<option value="Blanca">Blanca</option>
<option value="Cafe">Cafe</option>
<option value="Cantera">Cantera</option>
<option value="Celeste">Celeste</option>
<option value="Crema">Crema</option>
<option value="Forja">Forja</option>
<option value="Gris">Gris</option>
<option value="Ladrillo">Ladrillo</option>
<option value="Madera">Madera</option>
<option value="Melon">Melon</option>
<option value="Metalica">Metalica</option>
<option value="Morada">Morada</option>
<option value="Naranja">Naranja</option>
<option value="Negra">Negra</option>
<option value="Roja">Roja</option>
<option value="Rosa">Rosa</option>
<option value="Verde">Verde</option>
</select><br>
<span class="formcap">Puerta:</span>
<select name="C_CPTAv">
<option value="no">No especifica</option>
<option value="no_tiene">No tiene</option>
<option value="Amarilla">Amarilla</option>
<option value="Azul">Azul</option>
<option value="Beige">Beige</option>
<option value="Blanca">Blanca</option>
<option value="Cafe">Cafe</option>
<option value="Celeste">Celeste</option>
<option value="Crema">Crema</option>
<option value="Forja">Forja</option>
<option value="Gris">Gris</option>
<option value="Ladrillo">Ladrillo</option>
<option value="Madera">Madera</option>
<option value="Melon">Melon</option>
<option value="Metalica">Metalica</option>
<option value="Morada">Morada</option>
<option value="Naranja">Naranja</option>
<option value="Negra">Negra</option>
<option value="Roja">Roja</option>
<option value="Rosa">Rosa</option>
<option value="Verde">Verde</option>
</select><br>
<span class="formcap">Reja/Barandal:</span>
<select name="C_CREJv">
<option value="no">No especifica</option>
<option value="No">No tiene</option>
<option value="Amarilla">Amarilla</option>
<option value="Azul">Azul</option>
<option value="Beige">Beige</option>
<option value="Blanca">Blanca</option>
<option value="Cafe">Cafe</option>
<option value="Celeste">Celeste</option>
<option value="Crema">Crema</option>
<option value="Gris">Gris</option>
<option value="Ladrillo">Ladrillo</option>
<option value="Madera">Madera</option>
<option value="Melon">Melon</option>
<option value="Metalica">Metalica</option>
<option value="Morada">Morada</option>
<option value="Naranja">Naranja</option>
<option value="Negra">Negra</option>
<option value="Roja">Roja</option>
<option value="Rosa">Rosa</option>
<option value="Verde">Verde</option>
</select><br>
<span class="formcap">Patio/Jard&iacute;n:</span>
<select name="C_CPATv">
<option value="no">No especifica</option>
<option value="si">S&iacute;</option>
<option value="no">No</option>
</select><br>
<span class="formcap">Pisos:</span>
<select name="C_CNIVv">
<option value="planta baja">planta baja</option>
<option value="planta alta">planta alta</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value=">3">>3</option>
</select><br>
<p>DATOS DE LA GESTION</p>
<span class="formcap">Hora:</span>
<SELECT NAME="C_VHv">
<OPTION VALUE=0>0</option>
<OPTION VALUE=1>1</option>
<OPTION VALUE=2>2</option>
<OPTION VALUE=3>3</option>
<OPTION VALUE=4>4</option>
<OPTION VALUE=5>5</option>
<OPTION VALUE=6>6</option>
<OPTION VALUE=7>7</option>
<OPTION VALUE=8>8</option>
<OPTION VALUE=9>9</option>
<OPTION VALUE=10>10</option>
<OPTION VALUE=11>11</option>
<OPTION VALUE=12>12</option>
<OPTION VALUE=13>13</option>
<OPTION VALUE=14>14</option>
<OPTION VALUE=15>15</option>
<OPTION VALUE=16>16</option>
<OPTION VALUE=17>17</option>
<OPTION VALUE=18>18</option>
<OPTION VALUE=19>19</option>
<OPTION VALUE=20>20</option>
<OPTION VALUE=21>21</option>
<OPTION VALUE=22>22</option>
<OPTION VALUE=23>23</option>
</select>:
<SELECT NAME="C_VMNv">
<OPTION VALUE=00>00</option>
<OPTION VALUE=01>01</option>
<OPTION VALUE=02>02</option>
<OPTION VALUE=03>03</option>
<OPTION VALUE=04>04</option>
<OPTION VALUE=05>05</option>
<OPTION VALUE=06>06</option>
<OPTION VALUE=07>07</option>
<OPTION VALUE=08>08</option>
<OPTION VALUE=09>09</option>
<OPTION VALUE=10>10</option>
<OPTION VALUE=11>11</option>
<OPTION VALUE=12>12</option>
<OPTION VALUE=13>13</option>
<OPTION VALUE=14>14</option>
<OPTION VALUE=15>15</option>
<OPTION VALUE=16>16</option>
<OPTION VALUE=17>17</option>
<OPTION VALUE=18>18</option>
<OPTION VALUE=19>19</option>
<OPTION VALUE=20>20</option>
<OPTION VALUE=21>21</option>
<OPTION VALUE=22>22</option>
<OPTION VALUE=23>23</option>
<OPTION VALUE=24>24</option>
<OPTION VALUE=25>25</option>
<OPTION VALUE=26>26</option>
<OPTION VALUE=27>27</option>
<OPTION VALUE=28>28</option>
<OPTION VALUE=29>29</option>
<OPTION VALUE=30>30</option>
<OPTION VALUE=31>31</option>
<OPTION VALUE=32>32</option>
<OPTION VALUE=33>33</option>
<OPTION VALUE=34>34</option>
<OPTION VALUE=35>35</option>
<OPTION VALUE=36>36</option>
<OPTION VALUE=37>37</option>
<OPTION VALUE=38>38</option>
<OPTION VALUE=39>39</option>
<OPTION VALUE=40>40</option>
<OPTION VALUE=41>41</option>
<OPTION VALUE=42>42</option>
<OPTION VALUE=43>43</option>
<OPTION VALUE=44>44</option>
<OPTION VALUE=45>45</option>
<OPTION VALUE=46>46</option>
<OPTION VALUE=47>47</option>
<OPTION VALUE=48>48</option>
<OPTION VALUE=49>49</option>
<OPTION VALUE=50>50</option>
<OPTION VALUE=51>51</option>
<OPTION VALUE=52>52</option>
<OPTION VALUE=53>53</option>
<OPTION VALUE=54>54</option>
<OPTION VALUE=55>55</option>
<OPTION VALUE=56>56</option>
<OPTION VALUE=57>57</option>
<OPTION VALUE=58>58</option>
<OPTION VALUE=59>59</option>
</select>
<br>
<span class="formcap">Fecha:</span>
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cal6 = new CalendarPopup();
cal6.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal6.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal6.setWeekStartDay(1);
cal6.setTodayText("Hoy");
</SCRIPT>
<INPUT TYPE="text" NAME="C_VDv" ID="C_VDv" VALUE="<?php echo date("Y-m-d") ?>" SIZE=15>
<BUTTON onClick="cal6.select(document.getElementById('C_VDv'),'anchor6','yyyy-MM-dd'); return false;" NAME="anchor6" ID="anchor6">eligir</BUTTON>
<br>
<span class="formcap" id="pcap">Parentesco/Cargo</span>
<select name="C_CARGv">
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
</select><br>
<span class="formcap">Gestion</span><textarea rows="2" cols="40" name="C_OBSE1v" id='C_OBSE12' onkeypress="tooLongv(this)"></textarea><br>
<span class="formcap">Acci&oacute;n:</span>
<select name="ACCION" style="width: 8cm;">
<?php 
$query = "SELECT accion FROM acciones where visitas=1";
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option style='width: 12cm;' value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select><br>
<span class="formcap">Status:</span>
<select name="C_CVSTv" style="width: 8cm;">
<option value="" selected="selected"> </option>
<?php 
$query = "SELECT dictamen FROM dictamenes where visitas=1 order by dictamen";
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option style='width: 12cm;' value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select><br>
<span class="formcap">Motivadores:</span>
<select name="MOTIVv" style="width: 8cm;">
<option style='width: 12cm;' value=" ">
<?php 
$query = "SELECT motiv FROM motivadores where visitas=1";
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option style='width: 12cm;' value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select><br><?php if ($cliente=='Surtidor del Hogar') { 
$merci=0;
$querymerc="select productos from sdhextras where cuenta='".$numero_de_cuenta."';";
$resultmerc=mysqli_query($con,$querymerc);
while ($answermerc=mysqli_fetch_array($resultmerc, MYSQLI_NUM)) {
$merca[$merci]=$answermerc[0];
$merci++;
}
?>
<p>
<?php 
for ($mercii=0;$mercii<$merci;$mercii++) {
?>
Mercancia <?php echo $mercii+1; ?>
<select name="MERCv[]">
<option value="" style="font-size:120%;">&nbsp;</option>
<?php 
foreach ($merca as $merc) { ?>
  <option value="<?php echo $merc;?>" style="font-size:120%;">
  <?php if (isset($merc)) {echo $merc;}?>
  </option>
<?php } ?>
</select>
<?php } ?>
Fecha Recib&iacute;o
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cala = new CalendarPopup();
cala.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cala.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cala.setWeekStartDay(1);
cala.setTodayText("Hoy");
</SCRIPT>
<INPUT TYPE="text" NAME="D_MERC" ID="D_MERC" VALUE="" SIZE=15> 
<BUTTON onClick="cala.select(document.getElementById('D_MERC'),'anchora','yyyy-MM-dd'); return false;" NAME="anchora" ID="anchora">eligir</BUTTON></td>
</p>
<?php 
}?>

<span class="formcap">Fecha promesa</span>
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cal7 = new CalendarPopup();
cal7.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal7.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal7.setWeekStartDay(1);
cal7.setTodayText("Hoy");
</SCRIPT>
<INPUT TYPE="text" NAME="D_PROMv" ID="D_PROMv" VALUE="" SIZE=15>
<BUTTON onClick="cal7.select(document.getElementById('D_PROMv'),'anchor7','yyyy-MM-dd'); return false;" NAME="anchor7" ID="anchor7">eligir</BUTTON>
<br>
<span class="formcap">Cantidad de pago</span>
<input type="text" name="N_PROM_OLDv" readonly="readonly" style="background-color:#c0c0c0;" value="<?php if (isset($N_PROM)) {echo '$'.number_format($N_PROM);} ?>">
$<input type="text" name="N_PROMv" value=""><br>
<span class="formcap">Comentario de pago</span>
<input type="text" name="C_PROMv" value=""><br>
<span class="formcap">Frecuencia de pago</span>
<input type="text" name="C_FREQ_OLD" readonly="readonly" style="background-color:#c0c0c0;" value="<?php if (isset($C_FREQ)) {echo $C_FREQ;} ?>">
<select name="C_FREQv">
<option value="" selected="selected">&nbsp;</option>
<?php if (($cliente=='Credito Si B')||($cliente=='Credito Si B')) { ?>
<option value="mensuales">Unico</option>
<option value="semanales">Semanales (&lt; 14 d&iacute;as)</option>
<option value="quincenales">Quincenales (14 - 20 d&iacute;as)</option>
<option value="mensuales">Mensuales (21+ d&iacute;as)</option>
<?php } else { ?>
<option value="unico">Unico</option>
<option value="dos pagos">2 pagos</option>
<option value="multiples">M&uacute;ltiples pagos</option>
<?php } ?>
</select>
<br>
<span class="formcap">Visitador:</span>
<select name="C_VISITv" id="C_VISITv">
<option value=''></option>
<?php 
$query = "SELECT usuaria,completo FROM nombres where completo<>'' 
and (tipo='visitador' or tipo='admin')";
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) {?>
  <option value="<?php echo $answer[0];?>"><?php echo htmlentities($answer[1]);?></option>
<?php }
?>
</select>
<br>
<span class="formcap">ENTRE CALLE</span><input type="text" name="C_CALLE1v"> Y <input type="text" name="C_CALLE2v">
<br>
<div class="togglebox" id="nuevoboxt2">
<span class="formcap">Actualizaci&oacute;n de datos</span><br>
<span class="formcap">Tel.</span><input type="text" name="C_NTELv" value=""><br>
<span class="formcap">Tel 2.</span><input type="text" size=50 name="C_OBSE2v" value=""><br>
<span class="formcap">Direcci&oacute;n</span><input type="text" size=50 name="C_NDIRv" value=""><br>
</div>
<input type="hidden" name="qs" value=""><br>
<input type="hidden" name="go" value="CAPTURADO">
<input type="submit" name="CAPTURADO" value="CAPTURADO">
</form>
</div>
<!--</div>-->

<div id="HISTORIA">
<table summary="historiahead" border='0' cellpadding='0' cellspacing=
'0' width='100%' id="historyhead">
<tr>
<?php 
$fieldnames = array("Status","Fecha/Hora","Gestor","Telefono","Gestion","Gestion");
$fieldsize = array("status", "timestamp",    "chico", "telefono",  "gestion","hidebox");
                  for ($j=0; $j<5; $j++) { 
                    $fieldname = $fieldnames[$j]; ?>
                    <th<?php echo ' class="'.$fieldsize[$j].'"';?>><?php if (isset($fieldname)) {echo $fieldname;} ?></th> <?php
                  }
                ?></tr>
</table>
<?php if ($id_cuenta>0) { 
$querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin),if(c_visit is null,c_cvge,c_visit),c_tele,left(c_obse1,50),c_obse1,auto,c_cniv FROM historia 
WHERE historia.C_CONT=".$id_cuenta." and c_cvst <> 'Milt' 
and (c_visit is null or d_fech>'2011-02-01')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
$rowsub = mysqli_query($con,$querysub);
if (!(empty($rowsub))) {
?>
<div id='tableContainer' class='tableContainer'>
<table summary="historia" border='0' cellpadding='0' cellspacing=
'0' width='100%' id='historybody'>
<tbody class="scrollContent">
<?php
                $j=0;
				$c=0;
                while ($answer = mysqli_fetch_array($rowsub)) { 
$auto=$answer[6];
$visit=$answer[7];
$gestor=utf8_encode($answer[2]);
$gestion=utf8_encode($answer[5]);
$timestamp=utf8_encode($answer[1]);
$stat=utf8_encode($answer[0]);
?>
<tr<?php echo highhist($capt,$stat,$visit,$mytipo);?>><?php 
                   for ($k=0; $k<5; $k++) { 
                    $ank = utf8_encode($answer[$k]);
							      if (is_null($ank)) {$ank="&nbsp;";};
                    $ank=str_replace('00:00:00', '', $ank);
                    $jscode='';
                    if ($fieldsize[$k]=="gestion") {
											$jscode1=" onClick='alert(";
											$jscode2=")'";
											$jscode=$jscode1.'"'.ereg_replace("[\n\r]", " ", $timestamp.': '.$gestion).'"'.$jscode2;
											}
										?>
                    <td<?php if ($c==1) {echo " style='background-color:#dddddd'";}; echo ' class="'.$fieldsize[$k].'"'.$jscode;?>>
					<?php
					if (isset($ank)) {echo $ank;} 
					?>
					</td> 
					<?php
					} $c=1-$c;
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
<?php }  ?>
</div>
<div id="GESTION">
<form action="#" method="get" id="gestionform" 
onSubmit="return validate_form(this,event,<?php echo $saldo_descuento_2+0;?>,<?php 
if (($mytipo=='admin')||(!empty($AUTH))) {echo 1;} else {echo 0;}
?>,<?php echo 1000000;?>);">
<table id="databox">
<?php if ($mytipo=='admin'||$mytipo=='supervisor') {?>
<tr>
<td>Gestor</td>
<td><select name="C_CVGE">
<?php
    $query = "SELECT usuaria,iniciales FROM nombres ORDER BY usuaria;";
    $result = mysqli_query($con,$query);
    $j = 0;
    
    while ($answer = mysqli_fetch_array($result)) 
    { ?>
  <option value="<?php echo $answer[1]; ?>" <?php if ($answer[1]==$capt) { ?>selected="selected"<?php } ?>><?php echo $answer[0]; ?></option>
<?php
    } ?>
</select></td>
</tr>
<?php } else { ?>
<input type="hidden" name="C_CVGE" readonly="readonly" value="<?php if (isset($C_CVGE)) {echo $C_CVGE;}?>" >
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
<?php 
$querybadno="select if(tel_1 in (select * from deadlines),' class=\"badno\" ',''),
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
where id_cuenta=".$id_cuenta;
$resultbadno=mysqli_query($con,$querybadno) or die($querybadno."\n".mysqli_error($con));
while ($answerbadno=mysqli_fetch_row($resultbadno)) {
$t1=$answerbadno[0];
$t2=$answerbadno[1];
$t3=$answerbadno[2];
$t4=$answerbadno[3];
$t1r=$answerbadno[4];
$t2r=$answerbadno[5];
$t3r=$answerbadno[6];
$t4r=$answerbadno[7];
$t1r1=$answerbadno[8];
$t2r1=$answerbadno[9];
$t1r2=$answerbadno[10];
$t2r2=$answerbadno[11];
$t1r3=$answerbadno[12];
$t2r3=$answerbadno[13];
$t1r4=$answerbadno[14];
$t2r4=$answerbadno[15];
$t1l=$answerbadno[16];
$t2l=$answerbadno[17];
$t1v=$answerbadno[18];
$t2v=$answerbadno[19];
$t3v=$answerbadno[20];
$t4v=$answerbadno[21];
$tuc=$answerbadno[22];
}
$querynono="select if(tel_1 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1." ',' class=\"nono\" '),
if(tel_2 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2." ',' class=\"nono\" '),
if(tel_3 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t3." ',' class=\"nono\" '),
if(tel_4 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t4." ',' class=\"nono\" '),
if(tel_1_alterno in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1r." ',' class=\"nono\" '),
if(tel_2_alterno in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2r." ',' class=\"nono\" '),
if(tel_3_alterno in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t3r." ',' class=\"nono\" '),
if(tel_4_alterno in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t4r." ',' class=\"nono\" '),
if(tel_1_ref_1 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1r1." ',' class=\"nono\" '),
if(tel_2_ref_1 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2r1." ',' class=\"nono\" '),
if(tel_1_ref_2 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1r2." ',' class=\"nono\" '),
if(tel_2_ref_2 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2r2." ',' class=\"nono\" '),
if(tel_1_ref_3 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1r3." ',' class=\"nono\" '),
if(tel_2_ref_3 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2r3." ',' class=\"nono\" '),
if(tel_1_ref_4 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1r4." ',' class=\"nono\" '),
if(tel_2_ref_4 in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2r4." ',' class=\"nono\" '),
if(tel_1_laboral in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1l." ',' class=\"nono\" '),
if(tel_2_laboral in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2l." ',' class=\"nono\" '),
if(tel_1_verif in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t1v." ',' class=\"nono\" '),
if(tel_2_verif in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t2v." ',' class=\"nono\" '),
if(tel_3_verif in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t3v." ',' class=\"nono\" '),
if(tel_4_verif in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$t4v." ',' class=\"nono\" '),
if(telefono_de_ultimo_contacto in (select c_tele from historia where c_cont=".$id_cuenta."),' ".$tuc." ',' class=\"nono\" ')
from resumen
where id_cuenta=".$id_cuenta;
$resultnono=mysqli_query($con,$querynono) or die($querynono."\n".mysqli_error($con));
while ($answernono=mysqli_fetch_row($resultbadno)) {
$t1=$answernono[0];
$t2=$answernono[1];
$t3=$answernono[2];
$t4=$answernono[3];
$t1r=$answernono[4];
$t2r=$answernono[5];
$t3r=$answernono[6];
$t4r=$answernono[7];
$t1r1=$answernono[8];
$t2r1=$answernono[9];
$t1r2=$answernono[10];
$t2r2=$answernono[11];
$t1r3=$answernono[12];
$t2r3=$answernono[13];
$t1r4=$answernono[14];
$t2r4=$answernono[15];
$t1l=$answernono[16];
$t2l=$answernono[17];
$t1v=$answernono[18];
$t2v=$answernono[19];
$t3v=$answernono[20];
$t4v=$answernono[21];
$tuc=$answernono[22];
}
if (isset($tel_1)) {?><option <?php echo $t1; ?>value='<?php echo $tel_1?>'>TEL 1 - <?php echo $tel_1?></option><?php } ?>
<?php if (isset($tel_1_alterno)) {?><option <?php echo $t1r; ?>value='<?php echo $tel_1_alterno?>'>TEL ALT 1 - <?php echo $nombre_deudor_alterno.' - '.$tel_1_alterno?></option><?php } ?>
<?php if (isset($tel_1_laboral)) {?><option <?php echo $t1l; ?>value='<?php echo $tel_1_laboral;?>'>TEL LABORAL 1 - <?php echo $empresa.' - '.$tel_1_laboral;?></option><?php } ?>
<?php if (isset($tel_1_ref_1)) {?><option <?php echo $t1r1; ?>value='<?php echo $tel_1_ref_1;?>'>TEL 1 REF 1 - <?php echo $nombre_referencia_1.' - '.$tel_1_ref_1;?></option><?php } ?>
<?php if (isset($tel_1_ref_2)) {?><option <?php echo $t1r2; ?>value='<?php echo $tel_1_ref_2;?>'>TEL 1 REF 2 - <?php echo $nombre_referencia_2.' - '.$tel_1_ref_2;?></option><?php } ?>
<?php if (isset($tel_1_ref_3)) {?><option <?php echo $t1r3; ?>value='<?php echo $tel_1_ref_3;?>'>TEL 1 REF 3 - <?php echo $nombre_referencia_3.' - '.$tel_1_ref_3;?></option><?php } ?>
<?php if (isset($tel_1_ref_4)) {?><option <?php echo $t1r4; ?>value='<?php echo $tel_1_ref_4;?>'>TEL 1 REF 4 - <?php echo $nombre_referencia_4.' - '.$tel_1_ref_4;?></option><?php } ?>
<?php if (isset($tel_1_verif)) {?><option class='verif' <?php echo $t1v; ?>value='<?php echo $tel_1_verif;?>'>TEL 1 VERIF - <?php echo $tel_1_verif;?></option><?php } ?>
<?php if (isset($tel_2)) {?><option <?php echo $t2; ?>value='<?php echo $tel_2;?>'>CELULAR - <?php echo $tel_2;?></option><?php } ?>
<?php if (isset($tel_2_alterno)) {?><option <?php echo $t2r; ?>value='<?php echo $tel_2_alterno;?>'>TEL ALT 1 - <?php echo $nombre_deudor_alterno.' - '.$tel_2_alterno;?></option><?php } ?>
<?php if (isset($tel_2_laboral)) {?><option <?php echo $t2l; ?>value='<?php echo $tel_2_laboral;?>'>TEL LABORAL 2 - <?php echo $empresa.' - '.$tel_2_laboral;?></option><?php } ?>
<?php if (isset($tel_2_ref_1)) {?><option <?php echo $t2r1; ?>value='<?php echo $tel_2_ref_1;?>'>TEL 2 REF 1 - <?php echo $nombre_referencia_1.' - '.$tel_2_ref_1;?></option><?php } ?>
<?php if (isset($tel_2_ref_2)) {?><option <?php echo $t2r2; ?>value='<?php echo $tel_2_ref_2;?>'>TEL 2 REF 2 - <?php echo $nombre_referencia_2.' - '.$tel_2_ref_2;?></option><?php } ?>
<?php if (isset($tel_2_ref_3)) {?><option <?php echo $t2r3; ?>value='<?php echo $tel_2_ref_3;?>'>TEL 2 REF 3 - <?php echo $nombre_referencia_3.' - '.$tel_2_ref_3;?></option><?php } ?>
<?php if (isset($tel_2_ref_4)) {?><option <?php echo $t2r4; ?>value='<?php echo $tel_2_ref_4;?>'>TEL 2 REF 4 - <?php echo $nombre_referencia_4.' - '.$tel_2_ref_4;?></option><?php } ?>
<?php if (isset($tel_2_verif)) {?><option class='verif' <?php echo $t2v; ?>value='<?php echo $tel_2_verif;?>'>TEL 2 VERIF - <?php echo $tel_2_verif;?></option><?php } ?>
<?php if (isset($tel_3)) {?><option <?php echo $t3; ?>value='<?php echo $tel_3;?>'>TEL 3 - <?php echo $tel_3;?></option><?php } ?>
<?php if (isset($tel_3_alterno)) {?><option <?php echo $t3r; ?>value='<?php echo $tel_3_alterno;?>'>TEL ALT 3 - <?php echo $nombre_deudor_alterno.' - '.$tel_3_alterno;?></option><?php } ?>
<?php if (isset($tel_3_verif)) {?><option class='verif' <?php echo $t3v; ?>value='<?php echo $tel_3_verif;?>'>TEL 3 VERIF - <?php echo $tel_3_verif;?></option><?php } ?>
<?php if (isset($tel_4)) {?><option <?php echo $t4; ?>value='<?php echo $tel_4;?>'>TEL 4 - <?php echo $tel_4;?></option><?php } ?>
<?php if (isset($tel_4_alterno)) {?><option <?php echo $t4r; ?>value='<?php echo $tel_4_alterno;?>'>TEL ALT 4 - <?php echo $nombre_deudor_alterno.' - '.$tel_4_alterno;?></option><?php } ?>
<?php if (isset($tel_4_verif)) {?><option class='verif' <?php echo $t4v; ?>value='<?php echo $tel_4_verif;?>'>TEL 4 VERIF - <?php echo $tel_4_verif;?></option><?php } ?>
<?php if (isset($telefono_de_ultimo_contacto)) {?><option <?php echo $tuc; ?>value='<?php echo $telefono_de_ultimo_contacto;?>'>TEL DE ULT. CONT. - <?php echo $telefono_de_ultimo_contacto;?></option><?php } ?>
</select> 
<!--<a href="JavaScript: dial('<?php echo $capt ?>',<?php echo $numero_de_cuenta ?>)">CELULAR</a>-->
</td>
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
$CD = date("Y-m-d");
$CT = date("H:i:s");
 ?> 
<tr>
<td>Gestion</td>
<td><textarea rows="4" cols="50" name="C_OBSE1" id='C_OBSE1' 
onkeypress="tooLong(this)" onkeyup="valid(this,'special')" onmouseover='this.focus();'
onblur="valid(this,'special')" onmousedown='this.focus();'></textarea></td>
<td colspan=2>Acci&oacute;n 
<select name="ACCION" id="ACCION">
<?php 
$query = "SELECT accion FROM acciones where callcenter=1 order by (accion not regexp 'domic')";
if (($mytipo=='abogado'||$capt=='edgar')&&$cliente=='Vanguardia') {
$query = "SELECT accion FROM acciones where callcenter=1 or judicial=1 order by (accion not regexp 'domic')";
}
if ($capt=='gmbs') {
$query = "SELECT accion FROM acciones order by accion";
}
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option value="<?php echo $answer[0];?>" style="font-size:120%;"><?php if (isset($answer[0])) {echo $answer[0];}?></option>
<?php
}
?>
</select>
<br>
Status 
<select name="C_CVST" id="C_CVST" onblur="statusChange(this.form);">
<option value=''></option>
<?php 
$statustype=0;
$query = "SELECT dictamen,v_cc,judicial FROM dictamenes where callcenter=1 and creditosi=0 order by creditosi,dictamen";
if (($capt=='karla'||$capt=='edgar')&&$cliente=='Vanguardia') {
$query = "SELECT dictamen,v_cc,judicial FROM dictamenes where (callcenter=1 or judicial=1) and creditosi=0 order by creditosi,(callcenter=0),(judicial=0),dictamen";
}
if ($capt=='gmbs') {
$query = "SELECT dictamen,v_cc,judicial FROM dictamenes where creditosi=0 order by creditosi,(callcenter=0),(judicial=0),dictamen";
}
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) {
?>
  <option value="<?php if (isset($answer[0])) {echo htmlentities($answer[0]);}?>" 
  style="font-size:120%;">
  <?php if (isset($answer[0])) {echo htmlentities($answer[0]);}?>
  </option>
<?php } ?>
</select><br>
Causa no pago
<select name="C_CNP" id="C_CNP">
<option value="" style="font-size:120%;">&nbsp;</option>
<?php 
$query = "SELECT status FROM cnp";
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option value="<?php echo $answer[0];?>" style="font-size:120%;"><?php if (isset($answer[0])) {echo htmlentities($answer[0]);}?></option>
<?php
}
?>
</select>
<br>
Medio de pago
<select name="C_PROM" id="C_PROM">
<option value="" style="font-size:120%;">&nbsp;</option>
<?php 
$query = "SELECT status,acr FROM mdp";
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option value="<?php echo $answer[1];?>" style="font-size:120%;"><?php if (isset($answer[0])) {echo htmlentities($answer[0]);}?></option>
<?php
}
?>
</select>
</td>
<?php if ($cliente=='Surtidor del Hogar') { 
$merci=0;
$querymerc="select productos from sdhextras where cuenta='".$numero_de_cuenta."';";
$resultmerc=mysqli_query($con,$querymerc);
while ($answermerc=mysqli_fetch_array($resultmerc, MYSQLI_NUM)) {
$merca[$merci]=$answermerc[0];
$merci++;
}
?>
<tr style="display:none">
<?php 
for ($mercii=0;$mercii<$merci;$mercii++) {
?>
<td>Mercancia <?php echo $mercii+1; ?></td>
<td><select name="MERCv[]">
<option value="" style="font-size:120%;">&nbsp;</option>
<?php 
foreach ($merca as $merc) { ?>
  <option value="<?php echo $merc;?>" style="font-size:120%;">
  <?php if (isset($merc)) {echo $merc;}?>
  </option>
<?php } ?>
</select></td>
<?php } ?>
</tr>
<tr style="display:none">
<td>Fecha Recib&iacute;o
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cala = new CalendarPopup();
cala.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cala.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cala.setWeekStartDay(1);
cala.setTodayText("Hoy");
</SCRIPT></td>
<td><INPUT TYPE="text" NAME="D_MERC" ID="D_MERC" VALUE="" SIZE=15> 
<BUTTON onClick="cala.select(document.getElementById('D_MERC'),'anchora','yyyy-MM-dd'); return false;" NAME="anchora" ID="anchora">eligir</BUTTON></td>
</tr>
<?php 
}?>
</tr>
<tr id="pagocapt" style="display:none">
<td>Monto Pag&oacute;</td>
<td>$<input type="text" name="N_PAGO" id="N_PAGO" value="0" onmouseover='this.focus();'></td>
</tr>
<tr id="pagocapt2" style="display:none">
<td>Fecha Pag&oacute;
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cal9 = new CalendarPopup();
cal9.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal9.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal9.setWeekStartDay(1);
cal9.setTodayText("Hoy");
</SCRIPT></td>
<td><INPUT TYPE="text" NAME="D_PAGO" ID="D_PAGOi" VALUE="" SIZE=15> 
<BUTTON onClick="cal9.select(document.getElementById('D_PAGOi'),'anchor9','yyyy-MM-dd'); return false;" NAME="anchor9" ID="anchor9">eligir</BUTTON></td>
</tr>
<tr>
<td>Motivadores</td>
<td><select id="C_MOTIV" name="C_MOTIV">
<option value=" ">
<?php 
$query = "SELECT motiv FROM motivadores where callcenter=1";
if ($capt=='gmbs') {$query = "SELECT motiv FROM motivadores";}
$result = mysqli_query($con,$query);
while ($answer = mysqli_fetch_array($result)) { ?>
  <option value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>Se necesita localizar <input type="checkbox" name="LOCALIZAR" id="localizar" <?php if (!empty($localizar)) { echo 'selected="selected"';}?>></td>
<td colspan=2>Localizable <select name='CUANDO'>
<option value=""></option>
<option value="madrugada" <?php if ($CUANDO=='madrugada') { echo 'selected="selected"';}?>>madrugada</option>
<option value="manana" <?php if ($CUANDO=='manana') { echo 'selected="selected"';}?>>ma&ntilde;ana</option>
<option value="tarde" <?php if ($CUANDO=='tarde') { echo 'selected="selected"';}?>>tarde</option>
<option value="noche" <?php if ($CUANDO=='noche') { echo 'selected="selected"';}?>>noche</option>
<option value="robot" <?php if ($CUANDO=='robot') { echo 
'selected="selected"';}?>>robot</option>
<option value="visita" <?php if ($CUANDO=='visita') { echo 
'selected="selected"';}?>>visita</option>
</select></td>
</tr>
<tr>
<td>Cant. de pago unico o inicial</td>
<td>$<input type="text" name="N_PROM1" value="0" size="8" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
<td>$<input type="text" name="N_PROM1_OLD" readonly="readonly" size="8" value="<?php if (isset($N_PROM1_OLD)) {echo $N_PROM1_OLD;} ?>"></td>
</tr>
<tr>
<td>Fecha promesa unico o inicial
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cal4 = new CalendarPopup();
cal4.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal4.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal4.setWeekStartDay(1);
cal4.setTodayText("Hoy");
cal4.addDisabledDates(null,'<?php echo $yesterday; ?>');
cal4.addDisabledDates('<?php echo $dend; ?>',null);
</SCRIPT></td>
<td><INPUT TYPE="text" NAME="D_PROM1" ID="D_PROM1" VALUE="" SIZE=15> <BUTTON onClick="cal4.select(document.getElementById('D_PROM1'),'anchor4','yyyy-MM-dd'); return false;" NAME="anchor4" ID="anchor4">eligir</BUTTON></td>
<td><input type="text" name="D_PROM1_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php if (isset($D_PROM1_OLD)) {echo $D_PROM1_OLD;} ?>"></td>
</tr>
<tr>
<td>Cant. de pago final</td>
<td>$<input type="text" name="N_PROM2" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
<td>$<input type="text" name="N_PROM2_OLD" size="8" readonly="readonly" value="<?php if (isset($N_PROM2_OLD)) {echo $N_PROM2_OLD;} ?>"><br>
</tr>
<tr>
<td>Fecha promesa final
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cal5 = new CalendarPopup();
cal5.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal5.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal5.setWeekStartDay(1);
cal5.setTodayText("Hoy");
cal5.addDisabledDates(null,'<?php echo $yesterday; ?>');
cal5.addDisabledDates('<?php echo $dend2; ?>',null);
</SCRIPT></td>
<td><INPUT TYPE="text" NAME="D_PROM2" ID="D_PROM2" VALUE="" SIZE=15> 
<BUTTON onClick="cal5.select(document.getElementById('D_PROM2'),'anchor5','yyyy-MM-dd'); return false;" NAME="anchor5" ID="anchor5">eligir</BUTTON></td>
<td><input type="text" name="D_PROM2_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php if (isset($D_PROM2_OLD)) {echo $D_PROM2_OLD;} ?>"></td>
</tr>
<tr>
<td>Frecuencia de pago</td>
<td><select name="C_FREQ" id="C_FREQ">
<option selected="selected" value="">&nbsp;</option>
<?php 
if (($cliente=='Credito Si B')||($cliente=='Credito Si F')) {
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
<td><input type="text" name="N_PROM" id="N_PROM" readonly="readonly" style="background-color:#c0c0c0;" value=""></td>
<td>Cant. de pago prometido anterior</td>
<td><input type="text" name="N_PROM_OLD" id="N_PROM_OLD" readonly="readonly" style="background-color:#c0c0c0;" value="<?php if (isset($N_PROM_OLD)) {echo floor($N_PROM_OLD);} ?>"></td>
</tr>
<tr>
<td colspan=2>Actualizaci&oacute;n de Datos</td>
</tr>
<tr>
<td>Tel.</td>
<td><input type="text" name="C_NTEL" value=""  onmouseover='this.focus();'
onChange="addToTels(1,this)"></td>
</tr>
<tr>
<td>Tel 2.</td>
<td><input type="text" size=50 name="C_OBSE2" value="" onmouseover='this.focus();'
onChange="addToTels(2,this)"></td>
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
<input type="submit" name="GUARDAR" value="GUARDAR" ondblclick="return false;">
<button type="button" value="RESET" onclick="this.form.GUARDAR.disabled=false">RESET</button>
<br>
</div>
</div>
<div class="noshow">
<input type="text" name="from" readonly="readonly" value="<?php echo $_SERVER['PHP_SELF']; ?>" ><br>
<input type="text" name="D_FECH" readonly="readonly" value="<?php if (isset($CD)) {echo $CD;}?>" ><br>
<!--<input type="text" name="D_PROM" readonly="readonly" value="<?php if (isset($CD)) {echo $CD;}?>" ><br>-->
<input type="text" name="C_HRIN" readonly="readonly" value="<?php if (isset($CT)) {echo $CT;}?>" ><br>
<input type="text" name="C_HRFI" readonly="readonly" value="<?php if (isset($CT)) {echo $CT;}?>" ><br>
<input type="text" name="AUTO" readonly="readonly" value="" ><br>
<input type="text" name="find" readonly="readonly" value="<?php if (isset($find)) {echo $find;}?>" ><br>
<input type="text" name="field" readonly="readonly" value="<?php if (isset($field)) {echo $field;}?>" ><br>
<input type="text" name="capt" readonly="readonly" value="<?php if (isset($capt)) {echo $capt;}?>" ><br>
<input type="text" name="camp" readonly="readonly" value="<?php if (isset($camp)) {echo $camp;}?>" ><br>
<input type="text" name="neworder" readonly="readonly" value="<?php if (isset($neworder)) {echo $neworder;}?>" ><br>
<input type="text" name="C_CVBA" readonly="readonly" value="<?php if (isset($cliente)) {echo $cliente;}?>" ><br>
<input type="text" name="C_ATTE" readonly="readonly" value="" ><br>
<input type="text" name="C_CONT" readonly="readonly" value="<?php if (isset($id_cuenta)) {echo $id_cuenta;}?>" ><br>
<input type="text" name="C_CONTAN" readonly="readonly" value="<?php if (isset($status_aarsa)) {echo $status_aarsa;}?>" ><br>
<input type="text" name="CUENTA" id="CUENTA" readonly="readonly" value="<?php if (isset($numero_de_cuenta)) {echo $numero_de_cuenta;}?>" ><br>
<input type="text" name="C_EJE" id="C_EJE" readonly="readonly" value="<?php if (isset($ejecutivo_asignado_call_center)) {echo $ejecutivo_asignado_call_center;}?>" ><br>
<input type="text" name="oldgo" readonly="readonly" value="<?php echo mysqli_real_escape_string($con,$go);?>" ><br>
<input type="text" name="error" readonly="readonly" value="1" ><br>
<input type="text" name="go" readonly="readonly" value="GUARDAR" ><br>
</div>
</form>
</div>
<?php   
}
mysqli_close($con);
?>
</body>
</html> 
