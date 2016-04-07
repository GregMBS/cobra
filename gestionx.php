<?php
function validate_required($value)
{
  if ($value==null||$value==""||$value==" "||$value=="0")
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
$host = ":/var/run/mysqld/mysqld.sock";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd));
mysql_query("USE $db");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$tcapt=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
setlocale(LC_MONETARY, 'en_US');
$oldgo='';
$getupdate = (!empty($_GET['go']));
$postupdate = (!empty($_POST['go']));
if ($getupdate) {
   $find = mysql_real_escape_string($_GET['find']);
   $capt = mysql_real_escape_string($_GET['capt']);
   // We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);
};
if ($postupdate) {
   $find = mysql_real_escape_string($_POST['find']);
   $capt = mysql_real_escape_string($_POST['capt']);
   // We perform a bit of filtering
$find = strtoupper($find);
$find = strip_tags($find);
$find = trim ($find);
};
$go=mysql_real_escape_string($_GET['go']);
if ($go=='GUARDAR') {
if (function_exists (validate_required)) {$flag=0.0;} else {$flag=1;}
$oldgo=mysql_real_escape_string($_GET['oldgo']);
$error=mysql_real_escape_string($_GET['error']);
$C_CVGE=mysql_real_escape_string($_GET['C_CVGE']);
$C_CONT=mysql_real_escape_string($_GET['C_CONT']);
$C_CVST=mysql_real_escape_string(urldecode($_GET['C_CVST']));
$C_CVBA=mysql_real_escape_string(urldecode($_GET['C_CVBA']));
$ACCION=mysql_real_escape_string($_GET['ACCION']);
$C_MOTIV=mysql_real_escape_string($_GET['MOTIV']);
$D_FECH=mysql_real_escape_string($_GET['D_FECH']);
$C_HRIN=mysql_real_escape_string($_GET['C_HRIN']);
$C_HRFI = date('H:i:s');
$C_TELE=mysql_real_escape_string($_GET['C_TELE']);
$CUANDO=mysql_real_escape_string($_GET['CUANDO']);
$CUENTA=mysql_real_escape_string($_GET['CUENTA']);
$C_OBSE1=mysql_real_escape_string($_GET['C_OBSE1']);
$C_OBSE2=mysql_real_escape_string($_GET['C_OBSE2']);
$C_ATTE=mysql_real_escape_string($_GET['C_ATTE']);
$C_CNP=mysql_real_escape_string($_GET['C_CNP']);
$C_CONTAN=mysql_real_escape_string($_GET['C_CONTAN']);
$C_CARG=utf8_encode(mysql_real_escape_string($_GET['C_CARG']));
$C_CAMP=mysql_real_escape_string($_GET['camp']);
$D_PROM1=mysql_real_escape_string($_GET['D_PROM1']);
$D_PROM2=mysql_real_escape_string($_GET['D_PROM2']);
$D_PROM=mysql_real_escape_string($_GET['D_PROM']);
$C_VISIT=mysql_real_escape_string($_GET['C_VISIT']);
$C_PROM='';
$N_PROM=mysql_real_escape_string($_GET['N_PROM']);
$N_PROM1=mysql_real_escape_string($_GET['N_PROM1']);
$N_PROM2=mysql_real_escape_string($_GET['N_PROM2']);
$C_FREQ=mysql_real_escape_string($_GET['C_FREQ']);
$C_NTEL=trim(mysql_real_escape_string($_GET['C_NTEL']));
$C_NDIR=mysql_real_escape_string($_GET['C_NCALLE'])." ".mysql_real_escape_string($_GET['C_NCOL'])." ".mysql_real_escape_string($_GET['C_NCIU']);
$C_EMAIL=mysql_real_escape_string($_GET['C_EMAIL']);
$montomax=0;
$fechamin='2020-12-31';
$fechamax='2007-01-01';
$errortext='';
$querydup="SELECT count(1) FROM historia 
WHERE c_cvge='".$C_CVGE."' AND c_cont='".$C_CONT."' 
AND c_cvst='".$C_CVST."' 
AND d_fech=curdate() AND c_hrin='".$C_HRIN."';";
$resultdup=mysql_query($querydup) or die(mysql_error());
while ($answerdup=mysql_fetch_row($resultdup)) {
        if ($answerdup[0]>0) {
        $errortext .=  "<h1>Ya ha guardadolo.</h1>";
        $flag=1;
                }
        } 
if ($C_OBSE1<>strtoupper($C_OBSE1)) {$errortext.="<h1>Error de captura. Reintenetalo.</h1>";}
if ($N_PROM>0&&$D_PROM<$D_PROM1) {$errortext.="<h1>Error en fecha de promesa.</h1>";}
if (substr_count(strtolower($C_OBSE1),"ching")>0)
	{$errortext .=  "<h1>Moderar su lenguaje.</h1>";$flag=1;}
if (empty($C_VISIT)&&validate_required($C_TELE)==false)
  {$errortext.="<h1>TELEFONO es necesario</h1>";$flag=1;}
if (validate_required($C_CVST)==false)
  {$errortext.="<h1>STATUS es necesario</h1>";$flag=1;}
if (validate_required($C_OBSE1)==false)
  {$errortext.="<h1>GESTION es necesario</h1>";$flag=1;}
if (strlen($C_OBSE1)>250) {
        $errortext .=  "<h1>GESTION demasiado larga.</h1>";
        $flag=1;
        }
if ((substr_count(strtolower($C_CVST),"propuesta de")>0)
        &&(validate_required($N_PROM)==false))
  {$errortext.="<h1>MONTO DE PROMESA es necesario</h1>";$flag=1;}
if ((substr_count(strtolower($C_CVST),"propuesta de")>0)
        &&(validate_required($C_CARG)==false))
  {$errortext.="<h1>CARGO DE CONTACTO es necesario</h1>";$flag=1;}
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
if (substr_count(strtolower($C_CVST),"tel ")>0)
    {if (validate_not_required($C_CARG)==false)
  {$errortext.="<h1>CARGO DE CONTACTO no es necesario</h1>";$flag=1;}
	}
$querydup="select count(1) from historia 
where c_cont='".$C_CONT."' and d_fech=curdate() 
and c_carg='".$C_CARG."' and c_tele='".$C_TELE."' 
and d_prom='".$D_PROM."' and n_prom='".$N_PROM."' 
and c_cvst='".$C_CVST."' and c_obse1='".$C_OBSE1."' 
;";
};
$resultdup=mysql_query($querydup) or die (mysql_error());
$dup=0;
while ($answerdup=mysql_fetch_row($resultdup)) {$dup=$answerdup[0];}
if (($dup>0)&&($c_cvge=='lucio')) {$errortext.="<h1>Ya esta guardado, Lucio</h1>";$flag=1;}
if ($flag==0) {
$outstring="?C_TELE=".$C_TELE."&C_CARG=".$C_CARG."&C_OBSE1=".$C_OBSE1."&ACCION=".$ACCION.
"&C_CVST=".$C_CVST."&C_CNP=".$C_CNP."&MOTIV=".$C_MOTIV."&LOCALIZAR=".$LOCALIZAR.
"&CUANDO=".$CUANDO."&CUANDO=".$CUANDO."&CUANDO=".$CUANDO."&CUANDO=".$CUANDO.
"&D_PROM=".$D_PROM."&N_PROM_OLD=".$N_PROM_OLD."&N_PROM=".$N_PROM.
"&N_PROM1=".$N_PROM1."&N_PROM2=".$N_PROM2.
"&C_FREQ=".$C_FREQ."&C_NTEL=".$C_NTEL."&C_NCALLE=".$C_NCALLE."&C_NCOL=".$C_NCOL.
"&C_NCIU=".$C_NCIU."&C_EMAIL=".$C_EMAIL."&C_OBSE2=".$C_OBSE2."&D_FECH=".$D_FECH.
"&C_VISIT=".$C_VISIT."&D_PROM1=".$D_PROM1."&D_PROM2=".$D_PROM2.
"&D_PROM=".$D_PROM."&C_HRIN=".$C_HRIN."&C_HRFI=".$C_HRFI."&AUTO=".$AUTO.
"&error=".$error."&find=".$find."&field=".$field."&capt=".$capt."&camp=".$camp.
"&neworder=".$neworder."&C_CVGE=".$C_CVGE."&C_CVBA=".$C_CVBA."&C_ATTE=".$C_ATTE.
"&C_CONT=".$C_CONT."&C_CONTAN=".$C_CONTAN."&CUENTA=".$CUENTA."&oldgo=".$oldgo."&go=GUARDADO";
//die($outstring);
$redirector = "Location: https://servidor1.adarsa.mx/resumenx.php".$outstring;
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
<span class="formcap">Telefono</span>
<input type="text" name="C_TELE" readonly="readonly" value="<?php if (isset($C_TELE)) {echo $C_TELE;}?>" >
<br>
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
<span class="formcap">Se necesita localizar</span><input type="checkbox" name="LOCALIZAR" id="localizar" readonly="readonly" <?php if (!empty($localizar)) { echo 'selected="selected"';}?>><br>
<span class="formcap">Localizable </span>
<input type="radio" name="CUANDO" id="CUANDO" value="madrugada" readonly="readonly" <?php if ($CUANDO=='madrugada') { echo 'selected="selected"';}?>>madrugada
<input type="radio" name="CUANDO" id="CUANDO" value="manana" readonly="readonly" <?php if ($CUANDO=='manana') { echo 'selected="selected"';}?>>ma&ntilde;ana
<input type="radio" name="CUANDO" id="CUANDO" value="tarde" readonly="readonly" <?php if ($CUANDO=='tarde') { echo 'selected="selected"';}?>>tarde
<input type="radio" name="CUANDO" id="CUANDO" value="noche" readonly="readonly" <?php if ($CUANDO=='noche') { echo 'selected="selected"';}?>>noche<br>
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
<div class="togglebox" id="nuevoboxt">
<P><span class="formtit">Actualizaci&oacute;n de Datos</span></P><br>
<div id="nuevobox">
<span class="formcap">Tel.</span><input type="text" name="C_NTEL" value="<?php if (isset($C_NTEL)) {echo $C_NTEL;} ?>"><br>
<span class="formcap">Calle y Numero</span><input type="text" name="C_NCALLE"value="<?php if (isset($C_NCALLE)) {echo $C_NCALLE;} ?>"><br>
<span class="formcap">Colonia</span><input type="text" name="C_NCOL" value="<?php if (isset($C_NCOL)) {echo $C_NCOL;} ?>"><br>
<span class="formcap">Ciudad</span><input type="text" name="C_NCIU" value="<?php if (isset($C_NCIU)) {echo $C_NCIU;} ?>"><br>
<span class="formcap">E-mail</span><input type="text" name="C_EMAIL" value="<?php if (isset($C_EMAIL)) {echo $C_EMAIL;} ?>"><br>
<span class="formcap">Memorandum</span><input type="text" size=50 name="C_OBSE2" value="<?php if (isset($C_OBSE2)) {echo $C_OBSE2;} ?>"><br>
<span class="formcap">Telefono contacto</span><input type="text" name="telefono_de_ultimo_contacto" value="<?php if (isset($telefono_de_ultimo_contact)) {echo $telefono_de_ultimo_contact;} ?>"><br>
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
<input type="text" name="C_CVGE" readonly="readonly" value="<?php if (isset($C_CVGE)) {echo $C_CVGE;}?>" ><br>
<input type="text" name="C_CVBA" readonly="readonly" value="<?php if (isset($C_CVBA)) {echo $C_CVBA;}?>" ><br>
<input type="text" name="C_CONT" readonly="readonly" value="<?php if (isset($C_CONT)) {echo $C_CONT;}?>" ><br>
<input type="text" name="C_OBSE1" readonly="readonly" value="<?php if (isset($C_OBSE1)) {echo $C_OBSE1;}?>" ><br>
<input type="text" name="CUENTA" readonly="readonly" value="<?php if (isset($CUENTA)) {echo $CUENTA;}?>" ><br>
<input type="text" name="oldgo" readonly="readonly" value="<?php echo mysql_real_escape_string($_GET['go']);?>" ><br>
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
mysql_close($con);
?>

