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
        $gestor = mysql_real_escape_string($_REQUEST['gestor']);
        $cliente = mysql_real_escape_string($_REQUEST['cliente']);
        $fecha1 = mysql_real_escape_string($_REQUEST['fecha1']);
        $fecha2 = mysql_real_escape_string($_REQUEST['fecha2']);
        if ($fecha2<$fecha1) {list($fecha1, $fecha2) = array($fecha2, $fecha1);}
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
$gestorstr='';
$clientestr='';
if ($gestor!='todos') {$gestorstr=" and c_cvge='".$gestor."' ";}
if ($cliente!='todos') {$clientestr=" and c_cvba='".$cliente."' ";}
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,queue,h1.* 
    from resumen join historia h1 on c_cont=id_cuenta
join dictamenes on status_aarsa=dictamen
where d_fech between '".$fecha1."' and '".$fecha2."'
".$gestorstr.$clientestr." 
and status_de_credito not like '%tivo'
ORDER BY d_fech,c_hrin
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query de las Promesas/Propuestas</title>

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
<form action="bigquery2.csv.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Gestor: <?php echo $gestor;?><
<select name="gestor">
<option value="todos" style="font-size:120%;">todos</option>
<?php
        $queryc = "SELECT distinct c_cvge FROM historia 
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 100
	";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
</select>
</p>
<p>Cliente: <?php echo $cliente;?>
<select name="cliente">
<option value="todos" style="font-size:120%;">todos</option>
<?php
        $queryc = "SELECT distinct c_cvba FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        limit 10
	";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
</select>
</p>
<p>HECHO de:
<?php echo $fecha1;?>
<select name="fecha1">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech limit 360";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
a:
<?php echo $fecha2;?>
<select name="fecha2">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech desc limit 60";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
</p>
<input type='submit' name='go' value='Query Gestiones'>
</form>
<?php
    if (!empty($_REQUEST['go'])) 
    {
?>
<pre><?php
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
       if ($var=='numero_de_cuenta') {$ii=$i;echo $var;}
       else {echo ','.$var;}
   }
?>
<br>
<?php    
while ($row = mysql_fetch_row($result)) 
    {
    $ij=0;
    foreach ($row as $cell) {
       if ($ij==$ii) {echo $cell;}
       else {echo ','.$cell;}
       $ij++;
    }
    echo '<br>';
    }
?>
</pre>
<?php } ?>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
