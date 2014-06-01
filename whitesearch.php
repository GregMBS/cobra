<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]==11) {echo 'ERROR';}
else {
$queryswitch="USE dnt";
mysql_query($queryswitch) or die("ERROR WSM1 - ".mysql_error());
$searchstr='';
$tel=mysql_real_escape_string ($_REQUEST['tel']);
if (!empty($tel)) {$searchstr.=' AND tel regexp "'.$tel.'"';}
$nombre=mysql_real_escape_string ($_REQUEST['nombre']);
if (!empty($nombre)) {$searchstr.=' AND nombre regexp "'.$nombre.'"';}
$calle=mysql_real_escape_string ($_REQUEST['calle']);
if (!empty($calle)) {$searchstr.=' AND calle regexp "'.$calle.'"';}
$colonia=mysql_real_escape_string ($_REQUEST['colonia']);
if (!empty($colonia)) {$searchstr.=' AND colonia regexp "'.$colonia.'"';}
$ciudad=mysql_real_escape_string ($_REQUEST['ciudad']);
if (!empty($ciudad)) {$searchstr.=' AND ciudad regexp "'.$ciudad.'"';}
$estado=mysql_real_escape_string ($_REQUEST['estado']);
if (!empty($estado)) {$searchstr.=' AND estado regexp "'.$estado.'"';}
$cp=mysql_real_escape_string ($_REQUEST['cp']);
if (!empty($cp)) {$searchstr.=' AND cp regexp "'.$cp.'"';}
$querymain = "SELECT SQL_NO_CACHE * FROM gray WHERE tel IS NOT NULL".$searchstr;
$result = mysql_query($querymain) or die("ERROR WSM2 - ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Directorio - Buscar</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>

</head>
<body>
<h1>BUSCAR</h1>
<table summary="Cuentas">
<thead>
<tr>
<th>TEL&Eacute;FONO</th>
<th>NOMBRE</th>
<th>CALLE</th>
<th>COLONIA</th>
<th>CIUDAD</th>
<th>ESTADO</th>
<th>CP</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$tel=$row[0];
$nombre=$row[1];
$cp=$row[3];
$calle=$row[2];
$colonia=$row[4];
$ciudad=$row[5];
$estado=$row[6];
?>
<tr>
<td><a href='white.php?go=FROMBUSCAR&find=<?php echo $tel;?>&capt=<?php echo $capt;?>'><?php echo $tel;?></a></td>
<td><?php echo utf8_decode($nombre);?></td>
<td><?php echo utf8_decode($calle);?></td>
<td><?php echo utf8_decode($colonia);?></td>
<td><?php echo utf8_decode($ciudad);?></td>
<td><?php echo utf8_decode($estado);?></td>
<td><?php echo $cp;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<button type="button" value="white" onclick=
"window.location='white.php?capt=<?php echo $capt ?>';"><-</button>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
