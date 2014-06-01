<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    
    return date("M", $timestamp);
}
    if (!empty($_REQUEST['go'])) 
    {
        $go = mysql_real_escape_string($_REQUEST['go']);
        $cliente = mysql_real_escape_string($_REQUEST['cliente']);
        $fecha1 = mysql_real_escape_string($_REQUEST['fecha1']);
        $fecha2 = mysql_real_escape_string($_REQUEST['fecha2']);
        if ($fecha2<$fecha1) {list($fecha1, $fecha2) = array($fecha2, $fecha1);}
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,status_de_credito,
    ejecutivo_asignado_call_center,queue,historia.* 
    FROM resumen JOIN historia ON c_cont=id_cuenta
    JOIN dictamenes ON dictamen=status_aarsa
    where d_fech between '".$fecha1."' and '".$fecha2."'  
    and c_cvba='".$cliente."' and c_cvge<>'Milt'
    ORDER BY d_fech,c_hrin
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query de las Gestiones</title>

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
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="bigquery.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Cliente:
<select name="cliente">
<?php
        $queryc = "SELECT cliente FROM clientes order by cliente";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
</select>
</p>
<p>de:
<select name="fecha1">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>'2008-01-01'
        ORDER BY d_fech desc";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
a:
<select name="fecha2">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>'2008-01-01'
        ORDER BY d_fech desc";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
</p>
<input type='submit' name='go' value='Query Grande'>
</form>
<?php
    if (!empty($_REQUEST['go'])) 
    {
?>
<table>
<tr>
<?php
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
       echo '<th>'.$var.'</th>';
   }
?>
</tr>
<?php    
while ($row = mysql_fetch_row($result)) 
    {
    echo '<tr>';
    foreach ($row as $cell) {
        echo '<td>'.$cell.'</td>';
    }
    echo '</tr>';
    }
?>
</table>
<?php } ?>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
