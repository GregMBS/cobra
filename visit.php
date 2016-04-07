<?php  
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$C_CONT = mysql_real_escape_string($_REQUEST['C_CONT']);
   $field = mysql_real_escape_string($_REQUEST['field']);
   $find = mysql_real_escape_string($_REQUEST['find']);
   $i = mysql_real_escape_string($_REQUEST['i']);
if (empty($i)) {$i=0;};
   $capt =mysql_real_escape_string($_REQUEST['capt']);
if (isset($C_CONT)) {
$querymain = "SELECT cliente,id_cuenta,numero_de_cuenta,
nombre_deudor,domicilio_deudor,colonia_deudor,ciudad_deudor,estado_deudor,
cp_deudor,saldo_total,saldo_vencido,saldo_descuento_1,saldo_descuento_2,status_de_credito
FROM resumen WHERE id_cuenta='$C_CONT'";
$result = mysql_query($querymain) or die(mysql_error());
while ($row = mysql_fetch_row($result)) {
$CLIENTE=$row[0];
$ID_CUENTA=$row[1];
$CUENTA=$row[2];
$NOMBRE=$row[3];
$DOMI=$row[4];
$COLONIA=$row[5];
$CIUDAD=$row[6];   
$CP=$row[7];
$ESTADO=$row[8];
$ST=$row[9];
$SV=$row[10];
$SD1=$row[11];
$SD2=$row[12];
$SDC=$row[13];
$MONTODESC=min($SD1,$SD2);
if ($MONTODESC==0) {$MONTODESC=max($SD1,$SD2);}
};
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Visit Sheet</title>
<style type="text/css">
        body {font-size:10pt;}
        table {width:100%}
        .box  {border: 1pt black solid;}
</style>
</head>
<body>
<div class="report">
<div class="demobox">
<table class='box'>
<tr>
<td>Nombre: </td>
<td><b><?php if (isset($NOMBRE)) {echo strtoupper($NOMBRE);} ?></b></td>
<td style='text-align:right;font-family:"free 3 of 9";font-size:48pt;'>
<?php if (isset($ID_CUENTA)) {echo strtoupper($ID_CUENTA);} ?>
</td></tr>
<tr>
<td>Domicilio: </td>
<td><b><?php if (isset($DOMI)) {echo $DOMI;} ?></b></td>
<td>Colonia: <b><?php if (isset($COLONIA)) {echo $COLONIA;} ?></b></td></tr>
<tr><td>Ciudad: </td>
<td><b><?php if (isset($CIUDAD)) {echo $CIUDAD;} ?>&nbsp;<?php if (isset($ESTADO)) {echo $ESTADO;} ?>&nbsp;C.P.&nbsp;<?php if (isset($CP)) {echo $CP;} ?></b></td>
</tr>
</table>
<table class='box'>
<tr><td>Saldo Total: <b>$ <?php if (isset($ST)) {echo number_format($ST,0);} ?></b></td>
<td>$ Vencido: <b>$ <?php if (isset($SV)) {echo number_format($SV,0);} ?></b></td>
<td>$ Descuento: <b>$ <?php if (isset($MONTODESC)) {echo number_format($MONTODESC);} ?></b></td>
</tr>
<tr><td>MORA: <b><?php if (isset($SDC)) {echo $SDC;} ?></b></td>
<td>CUENTA O CREDITO: <b><?php if (isset($CUENTA)) {echo $CUENTA;} ?></b>
</tr>
</table>
</div>
<div class="demobox">
<p>DICTAMEN DOMICILIO PARTICULAR</p>
<table>
<tr>
<td></td>
<td><span class='box'>Casa</span></td>
<td><span class='box'>Departamento</span></td>
<td><span class='box'>Terreno</span></td>
</tr>
<tr>
<td></td>
<td><span class='box'>Propio</span></td>
<td><span class='box'>Rentado</span></td>
<td><span class='box'>Abandonado</span></td>
<td><span class='box'>Deshabilitado</span></td>
<td><span class='box'>Invadido</span></td>
<td><span class='box'>Prestado</span></td>
</tr>
<tr>
<td>Nivel:</td> 
<td><span class='box'>Alto</span></td> 
<td><span class='box'>Medio</span></td> 
<td><span class='box'>Bajo</span></td> 
</tr>
<tr>
<td>Estado:</td>
<td><span class='box'>Malo</span></td>
<td><span class='box'>Regular</span></td>
<td><span class='box'>Bueno</span></td>
<td><span class='box'>Excelente</span></td>
</tr>
<tr>
<td>Se&ntilde;as:</td>
<td>Color:</td>
<td>Puerta:</td>
<td>Reja/Barandal:</td>
<td>Patio/Jard&iacute;n:</td>
<td>Pisos:</td>
</tr>
<tr>
<td class='box'>&nbsp;</td>
<td class='box'></td>
<td class='box'></td>
<td class='box'></td>
<td class='box'></td>
<td class='box'></td>
</tr>
</table>
</div>
<div class="demobox">
<table>
<tr><td colspan=5>DICTAMEN DOMICILIO LAVORAL</td></tr>
<tr><td>Empresa:</td><td>Puesto:</td><td>Area:</td></tr>
<tr><td>Telefono:</td><td> _ _ _ _ _ _ _ _ _ _ _ _ Ext.</td><td>Jefe:</td><td>Horario de __:__ a __:__</td></tr>
<tr><td colspan=5>DATOS DE LA GESTION</td></tr>
<tr>
<td>Hora:</td>
<td>Fecha:</td>
<td>Contacto con:</td>
</tr>
<tr>
<td>Tel&eacute;fonos:</td>
<td class='box'></td>
<td class='box'></td>
<td class='box'></td>
</tr>
<tr><td class='box' colspan=10>&nbsp;</td></tr>
<tr><td class='box' colspan=10>&nbsp;</td></tr>
<tr><td class='box' colspan=10>&nbsp;</td></tr>
<tr><td class='box' colspan=10>&nbsp;</td></tr>
<tr><td class='box' colspan=10>&nbsp;</td></tr>
<tr>
<td>ENTRE CALLE</td>
<td class='box'></td>
<td> Y </td>
<td class='box'></td>
</tr>
<td class="forprint statuslist">STATUS: <br>
<span class='box'>Mensaje con familiar</span><br>
<span class='box'>Mensaje con tercero</span><br>
<span class='box'>Aclaracion</span><br>
<span class='box'>Negativa de pago</span><br>
<span class='box'>Fallecido</span><br>
<span class='box'>Notificaci&oacute;n sin contacto</span><br>
<span class='box'>Domicilio no existe</span><br>
<span class='box'>Domicilio deshabilitado</span><br>
<span class='box'>Pago total</span><br>
<span class='box'>Pago parcial</span><br>
<span class='box'>Promesa de pago</span><br>
Fecha de PP:__________<br>
Monto PP:_____________<br>
Gestor:_______________</td>
<td colspan=8>
<img src='entrecalles.png'>
</td>
</tr>
</table>
</form>
</div>
</div>
<?php 
mysql_close($con);
?>
</body>
</html>
