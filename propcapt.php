<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$tcapt=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
$queryg = "SELECT usuaria,tipo FROM nombres join grupos on tipo=grupo WHERE iniciales = '".$capt."';";
$resultg = mysql_query($queryg) or die(mysql_error());
while($answerg = mysql_fetch_row($resultg)) {$mynombre=$answerg[0];$mytipo=$answerg[1];}
if (!empty($mytipo)) {
setlocale(LC_MONETARY, 'en_US');
$go=mysql_real_escape_string($_GET['go']);
if ($go=='GUARDAR'&&!empty($_GET['C_CVST'])) {
$oldgo=mysql_real_escape_string($_GET['oldgo']);
$error=mysql_real_escape_string($_GET['error']);
$C_CVGE=mysql_real_escape_string($_GET['C_CVGE']);
$C_CVST=mysql_real_escape_string($_GET['C_CVST']);
$C_CVBA=mysql_real_escape_string($_GET['C_CVBA']);
$ACCION=mysql_real_escape_string($_GET['ACCION']);
$C_MOTIV=mysql_real_escape_string($_GET['MOTIV']);
$D_FECH=mysql_real_escape_string($_GET['D_FECH']);
$C_HRIN=mysql_real_escape_string($_GET['C_HRIN']);
$C_HRFI = date('H:i:s');
$C_TELE=mysql_real_escape_string($_GET['C_TELE']);
$CUANDO=mysql_real_escape_string($_GET['CUANDO']);
$CUENTA=mysql_real_escape_string($_GET['CUENTA']);
$C_OBSE1=mysql_real_escape_string($_GET['C_OBSE1']);
$C_ATTE=mysql_real_escape_string($_GET['C_ATTE']);
$C_CNP=mysql_real_escape_string($_GET['C_CNP']);
$C_CREJ=mysql_real_escape_string($_GET['C_CREJ']);
$C_CPAT=mysql_real_escape_string($_GET['C_CPAT']);
$C_CONTAN=mysql_real_escape_string($_GET['C_CONTAN']);
$C_CARG=utf8_encode(mysql_real_escape_string($_GET['C_CARG']));
$C_CAMP=mysql_real_escape_string($_GET['camp']);
$D_PROM1=mysql_real_escape_string($_GET['D_PROM1']);
$D_PROM2=mysql_real_escape_string($_GET['D_PROM2']);
$C_PROM='';
$N_PROM=mysql_real_escape_string($_GET['N_PROM']);
$N_PROM1=mysql_real_escape_string($_GET['N_PROM1']);
$N_PROM2=mysql_real_escape_string($_GET['N_PROM2']);
$C_FREQ=mysql_real_escape_string($_GET['C_FREQ']);
$C_NTEL=mysql_real_escape_string($_GET['C_NTEL']);
$C_NDIR=mysql_real_escape_string($_GET['C_NDIR']);
$C_OBSE2=mysql_real_escape_string($_GET['C_OBSE2']);
$montomax=0;
$fechamin='2020-12-31';
$fechamax='2007-01-01';
$querycc="select id_cuenta from resumen where numero_de_cuenta='".$CUENTA."' and cliente='Credito Si';";
$resultcc=mysql_query($querycc) or die(mysql_error());
while ($answercc=mysql_fetch_row($resultcc)) {
	$C_CONT=$answercc[0];
}
$queryult="select max(n_prom),min(d_prom),max(d_prom) from historia where c_cont='".$C_CONT."' and n_prom>0;";
$resultult=mysql_query($queryult) or die(mysql_error());
while ($answerult=mysql_fetch_row($resultult)) {
	$montomax=max($answerult[0],0);
	$fechamin=$answerult[1];
	$fechamax=$answerult[2];
}
$D_PROM=$D_PROM2;
if (empty($D_PROM)||($D_PROM1>$D_PROM)||($N_PROM2==0)) {$D_PROM=$D_PROM1;}
$qins = "INSERT INTO historia (C_CVBA,C_CVGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,
C_TELE,CUANDO,CUENTA,C_OBSE1,C_ATTE,C_CARG,D_PROM,N_PROM,D_PROM1,N_PROM1,D_PROM2,N_PROM2,
C_FREQ,C_CONTAN,C_ACCION,C_CNP,C_MOTIV,C_CAMP,C_NTEL,C_NDIR,C_OBSE2) 
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
$C_OBSE2."'
)";
if ($error==0) {
$queryins=str_replace(';',' ',$qins);
mysql_query($queryins) or die (mysql_error());
if (!empty($C_NTEL)) {
$queryntel="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_NTEL." WHERE id_cuenta='".$C_CONT."'";
mysql_query($queryntel) or die (mysql_error());
};
if (!empty($C_NDIR)) {
$queryndir="UPDATE resumen SET direccion_nueva=".$C_NDIR." WHERE id_cuenta='".$C_CONT."'";
mysql_query($queryndir) or die (mysql_error());
};
if (!empty($C_OBSE2)&&$C_OBSE2==filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
$querymemo="UPDATE resumen SET tel_4_verif=tel_3_verif,tel_3_verif=tel_2_verif,tel_2_verif=tel_1_verif,tel_1_verif=".$C_OBSE2." WHERE id_cuenta='".$C_CONT."'";
mysql_query($querymemo) or die (mysql_error());
};
$best=$C_CVST;
$querybest="select c_cvst,v_cc from historia join dictamenes on c_cvst=dictamen 
where v_cc=(select min(v_cc) from historia join dictamenes on c_cvst=dictamen 
where c_cont=".$C_CONT.");";
$resultbest=mysql_query($querybest) or die (mysql_error());
while ($answerbest=mysql_fetch_row($resultbest)) {$best=$answerbest[0];};
$querysa = "update resumen set status_aarsa='".$best."', especial=1,fecha_ultima_gestion=curdate() where id_cuenta='".$C_CONT."';";;
mysql_query($querysa) or die (mysql_error());
if (!empty($_GET['localizar'])) {
$queryloc = "update resumen set localizar=".mysql_real_escape_string($_GET['LOCALIZAR'])." where id_cuenta='".$c_cont."';";;
//mysql_query($queryloc) or die (mysql_error());
}
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if ($find=="/") {$find=NULL;};
if ($capt=="/") {$capt=NULL;};
}
$redirector = "Location: propcapt.php?&capt=".$capt."&go=ULTIMA";
header($redirector);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Para Capturar Propuestas</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
       body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0;color:#000000;}
       span.formcap {display: block; width: 13em; float: left; font-size: 100%; font-weight:bold;}
       #deudor {width: 7em;}
       span.formtit {display: block; width: 24em; float: left; font-size: 100%; font-weight:bold;}
       span.formfirst {display: block; width: 24em; float: left;}
	   select, input, button {font-family: verdana,arial, helvetica, sans-serif;font-size:100%}
	   #demobox input {font-family: verdana,arial, helvetica, sans-serif;font-size:100%;width:5cm; font-weight:bold;}
	   .togglebox input {font-family: verdana,arial, helvetica, sans-serif;font-size:100%;width:5cm; font-weight:bold;}
	   a:link {color:blue;}   
	   a:visited {color:green;}   
	   a:hover {color:red;}   
	   a:active {color:yellow;}   
	   #AXIcheck:link {color:blue;}   
	   #AXIcheck:visited {color:green;}   
	   #AXIcheck:hover {color:red;}   
	   #AXIcheck:active {color:yellow;}   
	   .togglebox {background-color:#999999;}   
	   .togglebox:hover {background-color:#ffffff;}   
	   .togglebox:active {background-color:#ff0000;}   
    #telefono2 {font-weight:bold;}   
      #telbox span.formcap {display: block; width: 14em; float: left;}
       div {border: 1pt black solid;background-color:#c0c0c0;}
       #demobox {float: left;}
       .telbox {float: left;}
       .verif {font-weight:bold; background-color:#00ff00;}
       #descbox {float: left;}
       #gestionbox {clear: right;}
       #capturabox {float: left;}
       #guardbox {float: left; width:42em;}
       #captresbox {float: left;}
       #nuevoboxt, #nuevobox, #nuevoboxt2, #nuevobox2, #databox, #prombox {float: left; width: 42em; clear:right;}
       #buttonbox {background-color:#00a0f0;}
       #historybox {float: left;}
       #notabox {float: left;}
       #visitboxt {clear:both;}
			 .hidebox {display:none;}
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
       .buttonbox form, .buttons {float: left}
             #tableContainer {height: 4cm; overflow: scroll;}
             .noshow { display: none; width: 0;}
#searchbox {z-index: 98; display: none; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #c0c0f0; text-align: center; padding: 1em; border: 2px black solid;}
       #searchbox input {color: #000000; background-color: #ffffff;}
#quicksearchbox {z-index: 98; display: none; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #c0c0f0; text-align: center; padding: 1em; border: 2px black solid;}
       #quicksearchbox input {color: #000000; background-color: #ffffff;}
#calm {z-index: 98; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #c0c0f0; text-align: center; padding: 1em; border: 2px black solid;}
       #calm input {color: #000000; background-color: #ffffff;}
<?php if ($notalert==1) {?> 
	#notas input {background-color: #ff0000;}
<?php }; 
if ((($status_de_credito=='Liquidado')
||($status_de_credito=='Inactivo')
||($id_cuenta==0))&&($mytipo<>'admin')&&($mytipo<>'supervisor')) {?> 
	#databox,#prombox,#nuevoboxt,#nuevoboxt2,#combox,#guardbox,#visitbox,#dtelboxt {display:none;}
	#avalboxt,#ref1boxt,#ref2boxt,#ref3boxt,#ref4boxt {display:none;}
	#laboralboxt,#contablesboxt,#miscboxt,#visitboxt {display:none;}
<?php }; ?>

</style>

<script language="JavaScript" type="text/javascript">
function validate_required(field,alerttxtval,alerttxt)
{
with (field)
{
  if (value==null||value==""||value==" "||value==0)
  {
  alerttxt.value=alerttxt.value+alerttxtval+'\n';return false;
  }
}
}

function gestionChange(thisform)
{
with (thisform) {
D_PROM.value=D_PROM1.value;
if (D_PROM.value<D_PROM2.value) {D_PROM.value=D_PROM2.value;}
N_PROM.value=parseFloat(N_PROM1.value)+parseFloat(N_PROM2.value);
}
}

function validate_form(thisform,evt)
{
flag=0;
alerttxt=new Object();
alerttxt.value='';
with (thisform)
{
C_OBSE1.value=C_OBSE1.value.toUpperCase();
if (C_CVBA.value=='Credito Si') {C_OBSE1.value=C_OBSE1.value.replace(/[.,#!¡¿\-]/g, " ");}
if (C_OBSE1.value.indexOf('CHING')!=-1)
	{alerttxt.value=alerttxt.value+'Moderar su lenguaje'+'\n';C_OBSE1.style.backgroundColor="yellow";flag=1;}
if (validate_required(C_TELE,"TELEFONO es necesario",alerttxt)==false)
  {C_TELE.style.backgroundColor="yellow";flag=1;}
if (validate_required(C_CVST,"STATUS es necesario",alerttxt)==false)
  {C_CVST.style.backgroundColor="yellow";flag=1;}
if (validate_required(C_OBSE1,"GESTION es necesario",alerttxt)==false)
  {C_OBSE1.style.backgroundColor="yellow";flag=1;}
if (validate_required(ACCION,"ACCION es necesario",alerttxt)==false)
  {ACCION.style.backgroundColor="yellow";flag=1;}
if (C_TELE=='Entrante') {
        if (validate_required(MOTIV,"MOTIVACION es necesario",alerttxt)==false)
          {MOTIV.style.backgroundColor="yellow";flag=1;}
          }
if (C_OBSE1.length>250) {alerttxt.value=alerttxt.value+'GESTION demasiado largo'+'\n';C_OBSE1.style.backgroundColor="yellow";flag=1;}
if (C_CVST.value.substr(0,10)=="PROMESA DE") 
   {if (validate_required(N_PROM,"Monto de promesa es necesario",alerttxt)==false)
        {N_PROM1.style.backgroundColor="yellow";N_PROM2.style.backgroundColor="yellow";flag=1;};
    if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
        {C_CARG.style.backgroundColor="yellow";flag=1;}
			}
if (C_CVST.value.substr(0,12)=="PROPUESTA DE") 
   {if (validate_required(N_PROM,"Monto de promesa es necesario",alerttxt)==false)
        {N_PROM1.style.backgroundColor="yellow";N_PROM2.style.backgroundColor="yellow";flag=1;};
    if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
        {C_CARG.style.backgroundColor="yellow";flag=1;}
			}
if (N_PROM.value.lastIndexOf(".")!=N_PROM.value.indexOf(".")){alerttxt.value=alerttxt.value+'No puede usarse un separador de miles'+'\n';N_PROM.style.backgroundColor="yellow";flag=1;}
if (N_PROM.value.match(/[^0-9.]/)){alerttxt.value=alerttxt.value+'No puede usarse un separador de miles'+'\n';N_PROM.style.backgroundColor="yellow";flag=1;}
if (C_NTEL.value.match(/[^0-9.]/)){alerttxt.value=alerttxt.value+'No puede usarse un separador o letras en telefonos'+'\n';C_NTEL.style.backgroundColor="yellow";flag=1;}
if ((C_NTEL.value.length!=0)&&(C_NTEL.value.length!=8)&&(C_NTEL.value.length!=10)&&(C_NTEL.value.length!=13)){
alerttxt.value=alerttxt.value+'Error en captura de telefono';
C_NTEL.style.backgroundColor="yellow";flag=1;}
if (N_PROM.value><?php echo max(0,$saldo_total);?>){alerttxt.value=alerttxt.value+'Monto de promesa es mas que saldo total'+'\n';N_PROM.style.backgroundColor="yellow";flag=1;}
if (N_PROM.value>0){
		if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
			{C_CARG.style.backgroundColor="yellow";flag=1;}
                if (N_PROM.value<10){alerttxt.value=alerttxt.value+'No puede usarse un separador de miles'+'\n';N_PROM.style.backgroundColor="yellow";flag=1;}
		if (Date.parse(D_PROM.value.replace(/-/g, "/"))<Date.parse(D_FECH.value.replace(/-/g, "/")))
			{alerttxt.value=alerttxt.value+'Fecha de promesa en pasado'+'\n';D_PROM1.style.backgroundColor="yellow";D_PROM2.style.backgroundColor="yellow";flag=1;}
			}
if (C_CVST.value.substr(0,11)=="MENSAJE CON")
    {if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
			{C_CARG.style.backgroundColor="yellow";flag=1;}
        if (C_CARG.value=='Deudor'){alerttxt.value=alerttxt.value+'El deudor no es un tercero'+'\n';C_CARG.style.backgroundColor="yellow";flag=1;}
	}
if (C_CVST.value.substr(0,4)=="ACLA")
    {if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
			{C_CARG.style.backgroundColor="yellow";flag=1;}
	}
if (C_CVST.value.substr(0,4)=="CLIE")
    {if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
			{C_CARG.style.backgroundColor="yellow";flag=1;}
	}
if (C_CVST.value.substr(0,4)=="NEGA")
    {if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
			{C_CARG.style.backgroundColor="yellow";flag=1;}
	}
if (C_CVST.value.substr(0,4)=="CONF")
    {if (validate_required(C_CARG,"Cargo del contacto es necesario",alerttxt)==false)
			{C_CARG.style.backgroundColor="yellow";flag=1;}
	}
alertstr="Gestion de cuenta " + CUENTA.value + " capturado con status " + C_CVST.value + ".\n";
if (N_PROM.value>0) {alertstr=alertstr+" Fecha de promisa 1: "+D_PROM1.value+"\n";}
if (N_PROM.value>0) {alertstr=alertstr+" Monto de promisa 1: $"+N_PROM1.value;}
if (N_PROM.value>0) {alertstr=alertstr+" Fecha de promisa 2: "+D_PROM2.value+"\n";}
if (N_PROM.value>0) {alertstr=alertstr+" Monto de promisa 2: $"+N_PROM2.value;}
if (N_PROM.value>0) {alertstr=alertstr+" Monto de promisa total: $"+N_PROM.value;}
if (alerttxt.value=='') {alert(alertstr);return true;} else {
  evt.stopPropagation();
  evt.preventDefault(); // DOM style
  alert(alerttxt.value);
  java.awt.Toolkit.getDefaultToolkit().beep();
  return false; // IE style
  }
}
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
window.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.substr(0,249);
confirm('GESTION demasiado largo');
window.document.getElementById("C_OBSE1").style.backgroundColor="yellow";
return false;}
}
function logout()
{
        window.location="<?php echo $_SERVER['PHP_SELF']; ?>?capt=<?php echo $capt; ?>&go='LOGOUT'";
}

</script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
</head>
<body>
<div id="gestionbox">
<form action="propcapt.php" method="get" name="gestion" id="gestion" 
onChange="gestionChange(this)" 
onSubmit="validate_form(this,event)">
<div id="databox">
<span class="formcap">Gestor</span>
<?php
    $query = "SELECT USUARIA FROM nombres;";
    $result = mysql_query($query);
    $j = 0;
    
    while ($answer = mysql_fetch_array($result)) 
    {
        $gestor[$j] = $answer[0];
        $j++;
    }
?>  
<select name="C_CVGE">
<?php
    
    for ($k = 0;$k < $j;$k++) 
    { ?>
  <option value="<?php echo $gestor[$k]; ?>" style="font-size:120%;"><?php echo $gestor[$k]; ?></option>
<?php
    } ?>
</select>
<br>
<span class="formcap">Cuenta</span>
<?php
    $query = "SELECT numero_de_cuenta FROM resumen WHERE cliente='Credito Si' order by numero_de_cuenta;";
    $result = mysql_query($query);
    $j = 0;
    
    while ($answer = mysql_fetch_array($result)) 
    {
        $cuenta[$j] = $answer[0];
        $j++;
    }
?>  
<select name="CUENTA">
<?php
    
    for ($k = 0;$k < $j;$k++) 
    { ?>
  <option value="<?php echo $cuenta[$k]; ?>" style="font-size:120%;"><?php echo $cuenta[$k]; ?></option>
<?php
    } ?>
</select>
<br>
<span class="formcap">Fecha firmó propuesta</span>
<SCRIPT LANGUAGE="JavaScript" ID="js1">
var cal1 = new CalendarPopup();
cal1.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal1.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal1.setWeekStartDay(1);
cal1.setTodayText("Hoy");
</SCRIPT>
<INPUT TYPE="text" NAME="D_FECH" ID="D_FECH" VALUE="" SIZE=15>
<BUTTON onClick="cal1.select(document.getElementById('D_FECH'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1">eligir</BUTTON>
<br>
<span class="formcap">Telefono</span>
<select name="C_TELE">
<option value=''>&nbsp;</option>
<option value='Entrante'>Llamada entrante</option>
<option value='040'>040</option>
<?php if (isset($tel_1)) {?><option value='<?php echo $tel_1?>'><?php echo $tel_1?></option><?php } ?>
<?php if (isset($tel_1_alterno)) {?><option value='<?php echo $tel_1_alterno?>'><?php echo $tel_1_alterno?></option><?php } ?>
<?php if (isset($tel_1_laboral)) {?><option value='<?php echo $tel_1_laboral;?>'><?php echo $tel_1_laboral;?></option><?php } ?>
<?php if (isset($tel_1_ref_1)) {?><option value='<?php echo $tel_1_ref_1;?>'><?php echo $tel_1_ref_1;?></option><?php } ?>
<?php if (isset($tel_1_ref_2)) {?><option value='<?php echo $tel_1_ref_2;?>'><?php echo $tel_1_ref_2;?></option><?php } ?>
<?php if (isset($tel_1_ref_3)) {?><option value='<?php echo $tel_1_ref_3;?>'><?php echo $tel_1_ref_3;?></option><?php } ?>
<?php if (isset($tel_1_ref_4)) {?><option value='<?php echo $tel_1_ref_4;?>'><?php echo $tel_1_ref_4;?></option><?php } ?>
<?php if (isset($tel_1_verif)) {?><option class='verif' value='<?php echo $tel_1_verif;?>'><?php echo $tel_1_verif;?></option><?php } ?>
<?php if (isset($tel_2)) {?><option value='<?php echo $tel_2;?>'><?php echo $tel_2;?></option><?php } ?>
<?php if (isset($tel_2_alterno)) {?><option value='<?php echo $tel_2_alterno;?>'><?php echo $tel_2_alterno;?></option><?php } ?>
<?php if (isset($tel_2_laboral)) {?><option value='<?php echo $tel_2_laboral;?>'><?php echo $tel_2_laboral;?></option><?php } ?>
<?php if (isset($tel_2_ref_1)) {?><option value='<?php echo $tel_2_ref_1;?>'><?php echo $tel_2_ref_1;?></option><?php } ?>
<?php if (isset($tel_2_ref_2)) {?><option value='<?php echo $tel_2_ref_2;?>'><?php echo $tel_2_ref_2;?></option><?php } ?>
<?php if (isset($tel_2_ref_3)) {?><option value='<?php echo $tel_2_ref_3;?>'><?php echo $tel_2_ref_3;?></option><?php } ?>
<?php if (isset($tel_2_ref_4)) {?><option value='<?php echo $tel_2_ref_4;?>'><?php echo $tel_2_ref_4;?></option><?php } ?>
<?php if (isset($tel_2_verif)) {?><option class='verif' value='<?php echo $tel_2_verif;?>'><?php echo $tel_2_verif;?></option><?php } ?>
<?php if (isset($tel_3)) {?><option value='<?php echo $tel_3;?>'><?php echo $tel_3;?></option><?php } ?>
<?php if (isset($tel_3_alterno)) {?><option value='<?php echo $tel_3_alterno;?>'><?php echo $tel_3_alterno;?></option><?php } ?>
<?php if (isset($tel_3_verif)) {?><option class='verif' value='<?php echo $tel_3_verif;?>'><?php echo $tel_3_verif;?></option><?php } ?>
<?php if (isset($tel_4)) {?><option value='<?php echo $tel_4;?>'><?php echo $tel_4;?></option><?php } ?>
<?php if (isset($tel_4_alterno)) {?><option value='<?php echo $tel_4_alterno;?>'><?php echo $tel_4_alterno;?></option><?php } ?>
<?php if (isset($tel_4_verif)) {?><option class='verif' value='<?php echo $tel_4_verif;?>'><?php echo $tel_4_verif;?></option><?php } ?>
<?php if (isset($telefono_de_ultimo_contacto)) {?><option value='<?php echo $telefono_de_ultimo_contacto;?>'><?php echo $telefono_de_ultimo_contacto;?></option><?php } ?>
</select>
<br>
<!--<span class="formcap">Atendio</span><input type="text" name="C_ATTE" ><br>-->
<span class="formcap" id="pcap2">Parentesco/Cargo</span>
<select name="C_CARG">
<option value="">&nbsp;</option>
<option value="Abuelo/a">Abuelo/a</option>
<option value="Administrador de la empresa">Administrador de la empresa</option>
<option value="Amigo/a">Amigo/a</option>
<option value="Aval">Aval</option>
<option value="Companero/a de trabajo">Compa&ntilde;ero/a de trabajo</option>
<option value="Conocido/a">Conocido/a</option>
<option value="Contador de la empresa">Contador de la empresa</option>
<option value="Concuno/a">Concu&ntilde;o/a</option>
<option value="Conyuge">C&oacute;nyuge</option>
<option value="Cunado/a">Cu&ntilde;ado/a</option>
<option value="Deudor">Deudor</option>
<option value="Empleado/a">Empleado/a</option>
<option value="Encargado de la empresa">Encargado de la empresa</option>
<option value="Gerente">Gerente</option>
<option value="Hermano/a">Hermano/a</option>
<option value="Hijo/a">Hijo/a</option>
<option value="Jefe">Jefe</option>
<option value="Madre">Madre</option>
<option value="Nieto/a">Nieto/a</option>
<option value="Novio/a">Novio/a</option>
<option value="Nuera">Nuera</option>
<option value="Otro">Otro</option>
<option value="Padre">Padre</option>
<option value="Pareja">Pareja</option>
<option value="Primo/a">Primo/a</option>
<option value="Representante legal">Representante legal</option>
<option value="Secretaria">Secretaria</option>
<option value="Sirvienta">Sirvienta</option>
<option value="Sobrino/a">Sobrino/a</option>
<option value="Suegro/a">Suegro/a</option>
<option value="Tio/a">T&iacute;o/a</option>
<option value="Vecino/a">Vecino/a</option>
<option value="Yerno">Yerno</option>
</select><br>
<span class="formcap">Gestion</span><textarea rows="7" cols="45" name="C_OBSE1" id='C_OBSE1' onkeypress="tooLong(this)"  onkeyup="valid(this,'special')" onblur="valid(this,'special')"></textarea><br>
<span class="formcap">Acci&oacute;n</span>
<select name="ACCION" id="ACCION">
<?php 
$query = "SELECT accion FROM acciones where callcenter=1";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) { ?>
  <option value="<?php echo $answer[0];?>" style="font-size:120%;"><?php if (isset($answer[0])) {echo $answer[0];}?></option>
<?php
}
?>
</select><br>
<span class="formcap">Status de la llamada</span>
<select name="C_CVST" onchange='validate_required(C_CVST,"STATUS es necesario")'>
<option value=''></option>
<?php 
$query = "SELECT dictamen FROM dictamenes where callcenter=1 order by dictamen";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) {?>
  <option value="<?php if (isset($answer[0])) {echo $answer[0];}?>" 
  <?php if ($answer[0]=='PROPUESTA DE PAGO') {?>
        onClick='JavaScript:alert("Una propuesta es un documento firmado. Sin firma, no es un propuesta. Capturar el monto total de promesa en campo Cantidad de pago y capturar el fecha de ultima pago prometido em campo Fecha promesa.");'
        <?php }?>
  style="font-size:120%;">
  <?php if (isset($answer[0])) {echo $answer[0];}?>
  </option>
<?php } ?>
</select>
<br>
<span class="formcap">Causa no pago</span>
<select name="C_CNP">
<?php 
$query = "SELECT status FROM cnp ";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) {?>
  <option value="<?php if (isset($answer[0])) {echo $answer[0];}?>" style="font-size:120%;"><?php if (isset($answer[0])) {echo $answer[0];}?></option>
<?php } ?>
</select>
<br>
<span class="formcap">Motivadores</span><select name="MOTIV">
<option value=" ">
<?php 
$query = "SELECT motiv FROM motivadores where callcenter=1";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) { ?>
  <option value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select><br>
<span class="formcap">Se necesita localizar</span><input type="checkbox" name="LOCALIZAR" id="localizar" <?php if (!empty($localizar)) { echo 'selected="selected"';}?>><br>
<span class="formcap">Localizable </span>
<input type="radio" name="CUANDO" value="madrugada" <?php if ($CUANDO=='madrugada') { echo 'selected="selected"';}?>>madrugada
<input type="radio" name="CUANDO" value="manana" <?php if ($CUANDO=='manana') { echo 'selected="selected"';}?>>ma&ntilde;ana
<input type="radio" name="CUANDO" value="tarde" <?php if ($CUANDO=='tarde') { echo 'selected="selected"';}?>>tarde
<input type="radio" name="CUANDO" value="noche" <?php if ($CUANDO=='noche') { echo 'selected="selected"';}?>>noche<br>
</div>
<div id="prombox">
<span class="formcap">Cantidad de pago inicial</span>$<input type="text" name="N_PROM1" value="0">$<input type="text" name="N_PROM1_OLD" readonly="readonly" value="<?php if (isset($N_PROM1_OLD)) {echo $N_PROM1_OLD;} ?>"><br>
<span class="formcap">Fecha promesa inicial</span><input type="text" name="D_PROM1_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php if (isset($D_PROM1_OLD)) {echo $D_PROM1_OLD;} ?>">
<SCRIPT LANGUAGE="JavaScript" ID="js4">
var cal4 = new CalendarPopup();
cal4.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal4.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal4.setWeekStartDay(1);
cal4.setTodayText("Hoy");
</SCRIPT>
<INPUT TYPE="text" NAME="D_PROM1" ID="D_PROM1" VALUE="" SIZE=15>
<BUTTON onClick="cal4.select(document.getElementById('D_PROM1'),'anchor4','yyyy-MM-dd'); return false;" NAME="anchor4" ID="anchor4">eligir</BUTTON>
<br>
<span class="formcap">Cantidad de pago final</span>$<input type="text" name="N_PROM2" value="0">$<input type="text" name="N_PROM2_OLD" readonly="readonly" value="<?php if (isset($N_PROM2_OLD)) {echo $N_PROM2_OLD;} ?>"><br>
<span class="formcap">Fecha promesa final</span><input type="text" name="D_PROM2_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php if (isset($D_PROM2_OLD)) {echo $D_PROM2_OLD;} ?>">
<SCRIPT LANGUAGE="JavaScript" ID="js5">
var cal5 = new CalendarPopup();
cal5.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal5.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal5.setWeekStartDay(1);
cal5.setTodayText("Hoy");
</SCRIPT>
<INPUT TYPE="text" NAME="D_PROM2" ID="D_PROM2" VALUE="" SIZE=15>
<BUTTON onClick="cal5.select(document.getElementById('D_PROM2'),'anchor5','yyyy-MM-dd'); return false;" NAME="anchor5" ID="anchor5">eligir</BUTTON>
<br>
<br>
<span class="formcap">Cantidad de pago total</span>
<input type="text" name="N_PROM" id="N_PROM" readonly="readonly" style="background-color:#c0c0c0;" value="">
<br>
<span class="formcap">Cantidad de pago prometido anterior</span>
<input type="text" name="N_PROM_OLD" id="N_PROM_OLD" readonly="readonly" style="background-color:#c0c0c0;" value="<?php if (isset($N_PROM)) {echo '$'.number_format($N_PROM);} ?>">
<br>
<input type="submit" name="submit" value="GUARDAR" onClick="this.disable=true">
<br>
</div>
</div>
<div class="noshow">
<input type="text" name="D_PROM" readonly="readonly" value="" ><br>
<input type="text" name="C_HRIN" readonly="readonly" value="12:00:01" ><br>
<input type="text" name="C_HRFI" readonly="readonly" value="12:00:02" ><br>
<input type="text" name="AUTO" readonly="readonly" value="" ><br>
<input type="text" name="error" readonly="readonly" value="0" ><br>
<input type="text" name="capt" readonly="readonly" value="gmbs" ><br>
<input type="text" name="camp" readonly="readonly" value="0" ><br>
<input type="text" name="C_CVBA" readonly="readonly" value="Credito Si" ><br>
<input type="text" name="C_ATTE" readonly="readonly" value="" ><br>
<input type="text" name="C_CONT" readonly="readonly" value="" ><br>
<input type="text" name="C_CONTAN" readonly="readonly" value="" ><br>
<input type="text" name="oldgo" readonly="readonly" value="<?php echo mysql_real_escape_string($_GET['go']);?>" ><br>
<input type="text" name="go" readonly="readonly" value="GUARDAR" ><br>
</div>
</form>
</div>
<?php   
}
mysql_close($con);
?>
</body>
</html> 
