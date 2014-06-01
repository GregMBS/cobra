<?php 
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        
      
        if ($go == "BORRAR") 
        {
			$cliente=mysql_real_escape_string($_GET['cliente']);
			$segmento=mysql_real_escape_string($_GET['segmento']);
            $queryb = "DELETE FROM queuelist 
            WHERE cliente='" . $cliente . "'
            AND sdc='" . $segmento . "'        
            ";
            mysql_query($queryb) or die("queuelist borrar ".mysql_error());
        }
        
        if ($go == "AGREGAR") 
        {
            $cliseg = mysql_real_escape_string($_GET['cliseg']);
			$clientesegmento = explode(';',$cliseg);
			$cliente=$clientesegmento[0];
			$segmento=$clientesegmento[1];
            $querylistin = "INSERT INTO queuelist 
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc, bloqueado)  
            SELECT distinct gestor,'".$cliente."',status_aarsa, updown1, orden1, 9999999, '".$segmento."', 0 
            FROM queuelist;";
            $resultlistin = mysql_query($querylistin) or die("queuelist insert ".mysql_error());
            $querylistcamp = "update queuelist 
            set camp=auto where camp=9999999;";
            $resultlistcamp = mysql_query($querylistcamp) or die("queuelist numbering ".mysql_error());
            header("Location: segmentadmin.php?capt=".$capt);
        }
    }
    $querymain = "SELECT q.cliente,sdc,count(distinct id_cuenta) 
    FROM queuelist q
    LEFT JOIN resumen r
    ON q.cliente=r.cliente and sdc=status_de_credito and status_de_credito not regexp '-'
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    group by q.cliente,sdc
    ";
    $result = mysql_query($querymain) or die(mysql_error());
    $querymain2 = "SELECT r.cliente,status_de_credito,count(1) 
    FROM resumen r
    LEFT JOIN queuelist q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE auto is null
    AND r.cliente <> ''
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    ";
    $result2 = mysql_query($querymain2) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administraci&oacute;n de las segmentos</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
<style>
	tr:hover {background-color: yellow;}
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary="Segmentos" class="ui-widget">
<thead class="ui-widget-header">
<tr>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="migoorden">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<th>CLIENTE</a></th>
<th>SEGMENTO</a></th>
<th>CUENTAS</a></th>
<th>&nbsp;</a></th>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
    $j = 0;
    
    while ($row = mysql_fetch_row($result)) 
    {
        $j = $j + 1;
        $cliente = $row[0];
        $segmento = $row[1];
        $count = $row[2];
?>
<tr>
<form class="gestorchange" name="gestorchange<?php echo $j ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestorchange<?php echo $j ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="j" value="<?php echo $j ?>"> 
<td><input type="text" name="cliente" readonly="readonly" value="<?php echo $cliente; ?>" /></td>
<td><input type="text" name="segmento" readonly="readonly" value="<?php echo $segmento; ?>" /></td>
<td><?php echo $count; ?></td>
<?php if ($count==0) {?>
<td><input type="submit" name="go" value="BORRAR"></td>
<?php } ?>
</form>
</tr>
<?php
    } ?>
<tr>
<form class="gestoradd" name="gestoradd" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestoradd">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<td colspan=3>
<select name="cliseg">
<?php 
    while ($row2 = mysql_fetch_array($result2)) 
    { 
        $cliente2 = $row2[0];
        $segmento2 = $row2[1];
		?>
  <option value="<?php echo $cliente2.';'.$segmento2;?>"><?php echo $cliente2.' - '.$segmento2;?></option>
  <?php } ?>
</select></td>
<td><input type="submit" name="go" value="AGREGAR">
</td>
</form>
</tr>
</tbody>
</table>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
