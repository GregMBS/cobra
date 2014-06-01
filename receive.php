<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt);}
else {
$output="";
$local=gethostbyaddr($_SERVER['REMOTE_ADDR']);
$queryl="select extension from userlog where usuario='".$local."';";
$resultl = mysql_query($queryl) or die(mysql_error());
while ($answerl=mysql_fetch_row($resultl)) {$ext=$answerl[0];}
    require "AsteriskManager.php";
    $params = array('server' => '192.168.1.60', 'port' => '5038');
    $ast = new Net_AsteriskManager($params);
    try {
        $ast->connect();
    } catch (PEAR_Exception $e) {
    echo $e;
    }
    try {
	$ast->login('phpagi','phpagi');
    } catch(PEAR_Exception $e) {
    echo $e;
    }
     try {
        $output=$ast->command('core show channels concise');
        } catch(PEAR_Exception $e) {
        echo $e;
    }
     }
$searchstr="/IAX2\/".$ext."/";
$out1 = explode("\n",str_replace(" ",".",$output));
//print_r($out1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA - Quien es</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size:
8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
        .loud {text-align:center; font-weight:bold; color:red;}
        .num {text-align:right;}
 </style>
</head>
<body>
<h1>BUSCAR</h1>
<button onClick="window.location='<?php echo
$from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo
$C_CONT;?>&capt=<?php echo $capt;?>'">Regresar al resumen</button>
<?php 
foreach ($out1 as $outline) {
//print_r($outline);
if (preg_match($searchstr,$outline)) {
	$out2=explode('!',$outline);
//	print_r($out2);
	$find=substr($out2[7],-8);
	if (strlen($find)==8) {
$querymain = "SELECT SQL_NO_CACHE 
numero_de_cuenta,nombre_deudor,cliente,id_cuenta,status_de_credito 
FROM resumen WHERE 
(tel_1 like '%".$find."' or 
tel_2 like '%".$find."' or 
tel_3 like '%".$find."' or 
tel_4 like '%".$find."' or 
tel_1_alterno like '%".$find."' or 
tel_2_alterno like '%".$find."' or 
tel_3_alterno like '%".$find."' or 
tel_4_alterno like '%".$find."' or 
tel_1_ref_1 like '%".$find."' or 
tel_2_ref_1 like '%".$find."' or 
tel_1_ref_2 like '%".$find."' or 
tel_2_ref_2 like '%".$find."' or 
tel_1_ref_3 like '%".$find."' or 
tel_2_ref_3 like '%".$find."' or 
tel_1_ref_4 like '%".$find."' or 
tel_2_ref_4 like '%".$find."' or 
tel_1_laboral like '%".$find."' or 
tel_2_laboral like '%".$find."' or 
tel_1_verif regexp '".$find."' or 
tel_2_verif regexp '".$find."' or 
tel_3_verif regexp '".$find."' or 
tel_4_verif regexp '".$find."' or 
telefonos_marcados regexp '".$find."')";    
//die($querymain);
$result = mysql_query($querymain) or die(mysql_error());
?>
<table summary="Cuentas">
<thead>
<tr>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$CUENTA=$row[0];
$NOMBRE=utf8_decode($row[1]);
$CLIENTE=$row[2];
$ID_CUENTA=$row[3];
$STATUS=$row[4];
?>
<tr>
<td><a<?php if (preg_match("/nactivo/", $STATUS)) { ?> 
style="color:#ffffff;"<?php } ?> href='resumen.php?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo 
$ID_CUENTA;?>&capt=<?php echo $capt;?>&highlight=<?php echo 
$field?>&hfind=<?php echo $find?>'><?php echo $CUENTA;?></a></td>
<td><?php echo utf8_decode($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } } } ?>
<div id="searchbox">
<h2>Buscar</h2>
<form name="search" method="get" action=
"buscar.php" id="search">Buscar a: <input type=
"text" name="find"> en <select name="field">
<option value="nombre_deudor">Nombre</option>
<option value="numero_de_cuenta">Cuenta</option>
<option value="TELS">Telefonos</option>
<option value="REFS">Referencias</option>
<option value="id_cuenta">Expediente</option>
</select><br>
Client = <select name="cliente">
<option value=" ">Todos</option>
<?php 
$querycl = "SELECT cliente FROM clientes;";
$resultcl = mysql_query($querycl);
while ($answercl = mysql_fetch_array($resultcl)) {?>
<option value="<?php echo $answercl[0];?>"><?php echo $answercl[0];?>
</option>
<?php  } ?>
</select><br>
<input type="hidden" name="i" value="0">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo 
$capt;} ?>">
<input type="hidden" name="go" value="BUSCAR">
<input type="hidden" name="from" value="resumen.php">
<input type="submit" name="go1" value="BUSCAR">
<input type="button" name="cancel" onclick="cancelbox('searchbox')"
value="Cancel"> 
</form>
</div>
<?php 
}
mysql_close($con);
?>
</body>
</html>
