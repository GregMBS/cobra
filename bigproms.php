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
        $fecha3 = mysql_real_escape_string($_REQUEST['fecha3']);
        $fecha4 = mysql_real_escape_string($_REQUEST['fecha4']);
        if ($fecha2<$fecha1) {list($fecha1, $fecha2) = array($fecha2, $fecha1);}
        if ($fecha4<$fecha3) {list($fecha3, $fecha4) = array($fecha4, $fecha3);}
$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
$clientestr='';
if ($gestor!='todos') {$gestorstr=" and ejecutivo_asignado_call_center='".$gestor."' ";}
if ($cliente!='todos') {$clientestr=" and resumen.cliente='".$cliente."' ";}
    $querymain = "select Status_aarsa AS 'STATUS',c_cvge AS 'GESTOR',
    numero_de_cuenta as 'CUENTA',nombre_deudor as 'NOMBRE',
    saldo_descuento_1 as 'SALDO CAPITAL s/i',saldo_total as 'SALDO TOTAL',
    pagos_vencidos*30 as 'MORA',n_prom as 'TOTAL PROMESA', 
    d_prom1 as 'FECHA PROMESA 1',n_prom1 as 'MONTO PROMESA 1', 
    d_prom2 as 'FECHA PROMESA 2',n_prom2 as 'MONTO PROMESA 2', 
    max(folio) AS 'FOLIO',c_motiv AS 'MOTIVADOR',c_cnp AS 'CAUSA NO PAGO',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'CAMPANA',d_fech AS 'FECHA GESTION',
    max(pagos.fecha) AS 'FECHA PAGO',sum(monto) AS 'MONTO PAGO',max(confirmado) as 'CONFIRMADO'
from resumen join historia h1 on c_cont=id_cuenta
left join folios on id=id_cuenta and fecha>=d_fech
left join pagos using (id_cuenta)
where n_prom>0 
and d_fech between '".$fecha1."' and '".$fecha2."'
and d_prom between '".$fecha3."' and '".$fecha4."'
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont 
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
".$gestorstr.$clientestr." 
and status_de_credito not like '%tivo' and c_cniv is null
group by id_cuenta ORDER BY d_fech,c_hrin
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
<form action="bigproms.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Gestor: <?php echo $gestor;?>
<select name="gestor">
<option value="todos" style="font-size:120%;">todos</option>
<?php
        $queryc = "SELECT distinct c_cvge FROM historia 
        join nombres on c_cvge=iniciales
        where d_fech>last_day(curdate()-interval 2 month)
        and n_prom>0 order by c_cvge
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
        join nombres on c_cvge=iniciales
        where d_fech>last_day(curdate()-interval 2 month) and n_prom>0
        order by c_cvba
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
<p>HECHO de:
<select name="fecha1">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 6 month) and n_prom>0
        ORDER BY d_fech limit 360";
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
        where d_fech>last_day(curdate()-interval 1 month) and n_prom>0
        ORDER BY d_fech desc limit 60";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
</p>
<p>VENCIDO de:
<select name="fecha3">
<?php
        $queryma = "SELECT distinct d_prom FROM historia 
        where d_prom>last_day(curdate()-interval 1 month) and n_prom>0
        ORDER BY d_prom limit 60";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
a:
<select name="fecha4">
<?php
        $queryma = "SELECT distinct d_prom FROM historia 
        where d_prom>last_day(curdate()-interval 1 month) and n_prom>0
        ORDER BY d_prom desc limit 60";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
</p>
<input type='submit' name='go' value='Query Prom'>
</form>
<?php
    if (!empty($_REQUEST['go'])) 
    {
?>
<table>
<tr>
<?php
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
       if ($var=='CUENTA') {$ii=$i;}
       echo '<th>'.$var.'</th>';
   }
?>
</tr>
<?php    
while ($row = mysql_fetch_row($result)) 
    {
    echo '<tr>';
    $ij=0;
    foreach ($row as $cell) {
       if ($ij==$ii) { ?>
       <td>
       <a href="resumen.php?find=<?php echo $cell;?>&field=numero_de_cuenta&qs=qs&capt=<?php echo $capt;?>&go=QUICKSEARCH&from=%2Fbigpromsv.php&go1=QUICKSEARCH">  
       <?php echo $cell;?></a></td>
       <?php  }
       else {echo '<td>'.$cell.'</td>';}
       $ij++;
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
