<?php
include('admin_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($answercheck[0]);}
else {
function validate_required($value)
{
  if ($value==null||$value==""||$value==" ")
  {
        return false;
  }
  else
  {
        return true;
  }
};
function validate_not_required($value)
{
  if ($value!=null&&$value!=""&&$value!=" ")
  {
        return false;
  }
  else
  {
        return true;
  }
};
$tcapt=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
setlocale(LC_MONETARY, 'en_US');
$oldgo='';
$getupdate = (!empty($_REQUEST['go']));
$postupdate = (!empty($_REQUEST['go']));
if ($getupdate) {
   $find = mysql_real_escape_string($_REQUEST['find']);
   $capt = mysql_real_escape_string($_REQUEST['capt']);
   // We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);
};
if ($postupdate) {
   $find = mysql_real_escape_string($_REQUEST['find']);
   $capt = mysql_real_escape_string($_REQUEST['capt']);
   // We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);
};
$go=mysql_real_escape_string($_REQUEST['go']);
if ($go=='CAPTURAR') {
if (function_exists (validate_required)) {$flag=0.0;} else {$flag=1;}
   $qs = mysql_real_escape_string($_REQUEST['qs']);
   $C_CVGE = mysql_real_escape_string($_REQUEST['capt']);
   $C_CVBA = mysql_real_escape_string($_REQUEST['C_CVBA']);
   $C_CONT = mysql_real_escape_string($_REQUEST['C_CONT']);
   $C_CTIPO = mysql_real_escape_string($_REQUEST['domtipo']);
   $C_COWN = mysql_real_escape_string($_REQUEST['domown']);
   $C_CSTAT = mysql_real_escape_string($_REQUEST['domstat']);
   $CUENTA = mysql_real_escape_string($_REQUEST['CUENTA']);
   $C_OBSE1 = mysql_real_escape_string($_REQUEST['C_OBSE1']);
   $C_CALLE1 = mysql_real_escape_string($_REQUEST['C_CALLE1']);
   $C_CALLE2 = mysql_real_escape_string($_REQUEST['C_CALLE2']);
   $C_ATTE = mysql_real_escape_string($_REQUEST['C_ATTE']);
   $C_CARG = mysql_real_escape_string($_REQUEST['C_CARG']);
   $C_TELE = mysql_real_escape_string($_REQUEST['C_TELE']);
   $C_RCON = mysql_real_escape_string($_REQUEST['C_RCON']);
   $C_NSE = mysql_real_escape_string($_REQUEST['C_NSE']);
   $C_CNIV = mysql_real_escape_string($_REQUEST['C_CNIV']);
   $C_CFAC = mysql_real_escape_string($_REQUEST['C_CFAC']);
   $C_CPTA = mysql_real_escape_string($_REQUEST['C_CPTA']);
   $C_CREJ = mysql_real_escape_string($_REQUEST['C_CREJ']);
   $C_CPAT = mysql_real_escape_string($_REQUEST['C_CPAT']);
   $C_VISIT = mysql_real_escape_string($_REQUEST['C_VISIT']);
   $C_CVST = mysql_real_escape_string($_REQUEST['C_CVST']);
   $ACCION = mysql_real_escape_string($_REQUEST['ACCION']);
   $C_MOTIV = mysql_real_escape_string($_REQUEST['MOTIV']);
   $C_HRIN = mysql_real_escape_string($_REQUEST['C_VH']).":".mysql_real_escape_string($_REQUEST['C_VMN']).":00";
   $C_HRFI = date('H:i:s');
$D_FECH=mysql_real_escape_string($_REQUEST['C_VD']);
$N_PROM=mysql_real_escape_string($_REQUEST['N_PROM']);
$N_PROM1=mysql_real_escape_string($_REQUEST['N_PROM']);
$D_PROM=mysql_real_escape_string($_REQUEST['D_PROM']);
$D_PROM1=mysql_real_escape_string($_REQUEST['D_PROM']);
if (empty($N_PROM)) {$N_PROM=0;}
$N_PROM=str_replace('$', '', $N_PROM);
$C_FREQ=mysql_real_escape_string($_REQUEST['C_FREQ']);

$oldgo=mysql_real_escape_string($_REQUEST['oldgo']);
$error=mysql_real_escape_string($_REQUEST['error']);
$montomax=0;
$fechamin='2020-12-31';
$fechamax='2007-01-01';
$errortext='';
if (substr_count(strtolower($C_OBSE1),"ching")>0)
	{$errortext .=  "<h1>Moderar su lenguaje.</h1>";$flag=1;}
if (validate_required($C_CVST)==false)
  {$errortext.="<h1>STATUS es necesario</h1>";$flag=1;}
if (validate_required($C_OBSE1)==false)
  {$errortext.="<h1>GESTION es necesario</h1>";$flag=1;}
if (strlen($C_OBSE1)>250) {
        $errortext .=  "<h1>GESTION demasiado larga.</h1>";
        $flag=1;
        }
if ((substr_count(strtolower($C_CVST),"promesa de")>0)
        &&(validate_required($N_PROM)==false))
  {$errortext.="<h1>MONTO DE PROMESA es necesario</h1>";$flag=1;}
if ((substr_count(strtolower($C_CVST),"promesa de")>0)
        &&(validate_required($C_CARG)==false))
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
if (substr_count(strtolower($N_PROM),".")>1){
        $errortext .=  "<h1>No puede usarse un separador de miles.</h1>";
        $flag=1;
        }
if ($N_PROM!=filter_var($N_PROM, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)){
        $errortext .=  "<h1>No puede usarse un separador de miles.</h1>";
        $flag=1;
        }
if ($C_NTEL!=filter_var($C_NTEL, FILTER_SANITIZE_NUMBER_FLOAT)){
        $errortext .=  "<h1>Solo puede usarse numeros en telefonos</h1>";
        $flag=1;
        }
if ($N_PROM<10&&$N_PROM>0){
                        $errortext .=  "<h1>No puede usarse un separador de miles.</h1>";
                        $flag=1;
                        }
if (substr_count(strtolower($C_CVST),"mensaje con")>0)
    {if (validate_required($C_CARG)==false)
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
        else {if ($C_CARG=='Deudor'){
                $errortext .=  "<h1>El deudor no es un tercero</h1>";
                $flag=1;
                }
	}
	}
if (substr_count(strtolower($C_CVST),"acla")>0)
    {if (validate_required($C_CARG)==false)
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
	}
if (substr_count(strtolower($C_CVST),"clie")>0)
    {if (validate_required($C_CARG)==false)
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
	}
if (substr_count(strtolower($C_CVST),"negat")>0)
    {if (validate_required($C_CARG)==false)
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
	}
if (substr_count(strtolower($C_CVST),"confi")>0)
    {if (validate_required($C_CARG)==false)
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
	}
if ($D_PROM==0)
    {$D_PROM='2008-01-01';
	}
if ($flag==0) {
$outstring="?qs=".$qs."&C_CARG=".$C_CARG."&C_OBSE1=".$C_OBSE1."&ACCION=".$ACCION.
"&C_CVST=".$C_CVST."&C_CNP=".$C_CNP."&MOTIV=".$C_MOTIV.
"&CUANDO=".$CUANDO.
"&D_PROM=".$D_PROM."&formDay=".$formDay."&formMonth=".$formMonth.
"&formYear=".$formYear."&N_PROM_OLD=".$N_PROM_OLD."&N_PROM=".$N_PROM.
"&C_FREQ=".$C_FREQ."&D_FECH=".$D_FECH."&C_VISIT=".$C_VISIT.
"&C_CTIPO=".$C_CTIPO."&C_COWN=".$C_COWN."&C_CSTAT=".$C_CSTAT.
"&C_NSE=".$C_NSE."&C_CFAC=".$C_CFAC."&C_CPTA=".$C_CPTA.
"&C_CREJ=".$C_CREJ."&C_CPAT=".$C_CPAT."&C_CNIV=".$C_CNIV.
"&C_CALLE1=".$C_CALLE1."&C_CALLE2=".$C_CALLE2.
"&C_HRIN=".$C_HRIN."&C_HRFI=".$C_HRFI."&AUTO=".$AUTO.
"&error=".$error."&find=".$find."&field=".$field."&capt=".$capt."&camp=".$camp.
"&neworder=".$neworder."&C_CVGE=".$C_CVGE."&C_CVBA=".$C_CVBA."&C_ATTE=".$C_ATTE.
"&C_CONT=".$C_CONT."&C_CONTAN=".$C_CONTAN."&CUENTA=".$CUENTA."&go=CAPTURADO";
$redirector = "Location: http://".$_SERVER['SERVER_NAME']."/resumen.php".$outstring;
header($redirector);
}
if ($flag==1) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Gestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
       body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0;color:#000000;}
       span.formcap {display: block; width: 13em; float: left; font-size: 100%; font-weight:bold;}
       span.formtit {display: block; width: 24em; float: left; font-size: 100%; font-weight:bold;}
	   select, input, button {font-family: verdana,arial, helvetica, sans-serif;font-size:100%}
	   .togglebox input {font-family: verdana,arial, helvetica, sans-serif;font-size:100%;width:5cm; font-weight:bold;}
	   a:link {color:blue;}   
	   a:visited {color:green;}   
	   a:hover {color:red;}   
	   a:active {color:yellow;}   
	   .togglebox {background-color:#999999;}   
	   .togglebox:hover {background-color:#ffffff;}   
       div {border: 1pt black solid;background-color:#c0c0c0;}
			 .hidebox {display:none;}
       .clearbox {clear: both; text-align: center;}
	table {color:#000000;}
	tr {height:2em;}
	th {width: 9em;}
  td {border: 1pt solid #000000;background-color: #ffffff; width:10em;}
             .noshow { display: none; width: 0;}
</style>
</head>
<body>
<p>
<?php echo $errortext; ?>
</p>
<form action="resumen.php" method="get" name="captura" id="captura">
<div id="databox">
<span class="formcap" id="pcap">Parentesco/Cargo</span>
<input type="text" name="C_CARG" readonly="readonly" value="<?php if (isset($C_CARG)) {echo $C_CARG;}?>" >
<br>
<?php 
$CD = date("y-m-d");
$CT = date("H:i:s");
 ?> 
<span class="formcap">Gestion</span>
<span style="background-color:#e0e0e0;"><?php if (isset($C_OBSE1)) {echo $C_OBSE1;}?></span>
<br>
<span class="formcap">Acci&oacute;n</span>
<input type="text" name="ACCION" readonly="readonly" value="<?php if (isset($C_ACCION)) {echo $C_ACCION;}?>" >
<br>
<span class="formcap">Status de la llamada</span>
<input type="text" name="C_CVST" readonly="readonly" value="<?php if (isset($C_CVST)) {echo $C_CVST;}?>" >
<br>
<span class="formcap">Causa no pago</span>
<input type="text" name="C_CNP" readonly="readonly" value="<?php if (isset($C_CNP)) {echo $C_CNP;}?>" >
<br>
<span class="formcap">Motivadores</span>
<input type="text" name="MOTIV" readonly="readonly" value="<?php if (isset($C_MOTIV)) {echo $C_MOTIV;}?>" >
<br>
</div>
<div id="prombox">
<span class="formcap">Fecha promesa</span>
<input type="text" name="D_PROM" readonly="readonly" value="<?php if (isset($D_PROM)) {echo $D_PROM;} ?>">
<br>
<span class="formcap">Cantidad de pago</span>
<input type="text" name="N_PROM" readonly="readonly" value="<?php if (isset($N_PROM)) {echo '$'.number_format($N_PROM);} ?>"/>
<br>
<span class="formcap">Frecuencia de pago</span>
<input type="text" name="C_FREQ" readonly="readonly" value="<?php if (isset($C_FREQ)) {echo $C_FREQ;} ?>">
<br>
</div>
</div>
<div class="noshow">
<input type="text" name="D_FECH" readonly="readonly" value="<?php if (isset($D_FECH)) {echo $D_FECH;}?>" ><br>
<input type="text" name="D_PROM" readonly="readonly" value="<?php if (isset($D_PROM)) {echo $D_PROM;}?>" ><br>
<input type="text" name="C_HRIN" readonly="readonly" value="<?php if (isset($C_HRIN)) {echo $C_HRIN;}?>" ><br>
<input type="text" name="AUTO" readonly="readonly" value="" ><br>
<input type="text" name="error" readonly="readonly" value="0" ><br>
<input type="text" name="find" readonly="readonly" value="<?php if (isset($find)) {echo $find;}?>" ><br>
<input type="text" name="field" readonly="readonly" value="<?php if (isset($field)) {echo $field;}?>" ><br>
<input type="text" name="capt" readonly="readonly" value="<?php if (isset($capt)) {echo $capt;}?>" ><br>
<input type="text" name="camp" readonly="readonly" value="<?php if (isset($camp)) {echo $camp;}?>" ><br>
<input type="text" name="neworder" readonly="readonly" value="<?php if (isset($neworder)) {echo $neworder;}?>" ><br>
<input type="text" name="C_CVGE" readonly="readonly" value="<?php if (isset($capt)) {echo $capt;}?>" ><br>
<input type="text" name="C_CVBA" readonly="readonly" value="<?php if (isset($C_CVBA)) {echo $C_CVBA;}?>" ><br>
<input type="text" name="C_CONT" readonly="readonly" value="<?php if (isset($C_CONT)) {echo $C_CONT;}?>" ><br>
<input type="text" name="C_OBSE1" readonly="readonly" value="<?php if (isset($C_OBSE1)) {echo $C_OBSE1;}?>" ><br>
<input type="text" name="CUENTA" readonly="readonly" value="<?php if (isset($CUENTA)) {echo $CUENTA;}?>" ><br>
<input type="text" name="qs" readonly="readonly" value="<?php if (isset($qs)) {echo $qs;}?>" ><br>
<input type="text" name="oldgo" readonly="readonly" value="<?php echo mysql_real_escape_string($_REQUEST['go']);?>" ><br>
<input type="text" name="go" readonly="readonly" value="GUARDADO"><br>
</div>
<div class="clearbox" id="guardbox">
<input type="submit" name="submit" value="CORECTO">
</form>
<form action="resumen.php" method="get" name="captura2" id="captura2">
<div class="noshow">
<input type="text" name="capt" readonly="readonly" value="<?php if (isset($capt)) {echo $capt;}?>" ><br>
<input type="text" name="i" readonly="readonly" value="0" ><br>
<input type="text" name="field" readonly="readonly" value="id_cuenta" ><br>
<input type="text" name="find" readonly="readonly" value="<?php echo $C_CONT;?>" ><br>
<input type="text" name="go" readonly="readonly" value="FROMBUSCAR"><br>
</div>
<input type="submit" name="submit" value="EQUIVOCADO">
</div>
</form>
</body>
</html><?php   
}
}
}
}
mysql_close($con);
?>

