<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    
    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
    };
    
    if (!empty($_GET['go'])) 
    {
        
        if ($_GET['go'] == "asignar") 
        {
            $msg = mysql_real_escape_string($_GET['msg']);
            $queue = mysql_real_escape_string($_GET['queue']);
            $sdc = mysql_real_escape_string($_GET['sdc']);
            $count = mysql_real_escape_string($_GET['count']);
            $tels = $_GET['tel'];
            $fields = $_POST['fields'];
            if (count($fields) > 0) {
                for ($h=0;$h<count($fields);$h++) {
for ($i=0;$i<$count;$i++) {
if (!empty($tels)) {
foreach ($tels as $tel) {
$query1="insert into robot.calllist (tel,id,msg,turno) 
select distinct right(".$tel.",8),numero_de_cuenta,msg,".$fields[$h]." 
from cobra4.resumen 
left join cobra4.historia on ".$tel."=c_tele
join dictamenes on status_aarsa=dictamen 
join robot.msglist on client=cliente
where length(".$tel.")=10 and left(".$tel.",2)=81
AND (queue like '%".$queue."%' and cliente=client and status_de_credito='".$sdc."')
AND msg='".$msg."'
AND (c_cvst is null or 
(c_cvst<>'TEL NO EXISTE O SUSPENDIDO' 
AND c_cvst<>'TERCERO NO CONOCE DEUDOR'
AND c_cvst<>'ILOCALIZABLE TELEFONICO')) 
";
if (!empty($_GET['local'])) {
mysql_query($query1) or die(mysql_error());
}
$query2="insert into robot.calllist (tel,id,msg,turno) 
select distinct ".$tel.",numero_de_cuenta,msg,".$fields[$h]." 
from cobra4.resumen 
left join cobra4.historia on ".$tel."=c_tele
join dictamenes on status_aarsa=dictamen 
join robot.msglist on client=cliente
where length(".$tel.")=10 and left(".$tel.",2)<>81
AND (queue like '%".$queue."%' and cliente=client and status_de_credito='".$sdc."')
AND msg='".$msg."'
AND (c_cvst is null or (c_cvst<>'TEL NO EXISTE O SUSPENDIDO' 
AND c_cvst<>'TERCERO NO CONOCE DEUDOR'
AND c_cvst<>'ILOCALIZABLE TELEFONICO'))";
if (!empty($_GET['nonlocal'])) {
mysql_query($query2) or die(mysql_error());
}
}
}
if ($queue=='ACTUALIZADOS') {
$query3="insert into robot.calllist (tel,id,msg,turno) 
select distinct right(tel_1_verif,8),numero_de_cuenta,msg,".$fields[$h]." 
from cobra4.resumen 
left join cobra4.historia on tel_1_verif=c_tele
join cobra4.dictamenes on status_aarsa=dictamen 
join robot.msglist on client=cliente
where (status_de_credito = '".$sdc."') 
AND (cliente=client)
AND (status_aarsa<>'PROPUESTA DE PAGO')
AND (status_aarsa<>'PAGANDO CONVENIO')
AND (status_aarsa<>'PAGO TOTAL')
AND msg='".$msg."'
and length(tel_1_verif)=10 and left(tel_1_verif,2)=81
AND (c_cvst is null or (c_cvst<>'TEL NO EXISTE O SUSPENDIDO' 
AND c_cvst<>'TERCERO NO CONOCE DEUDOR'
AND c_cvst<>'ILOCALIZABLE TELEFONICO'))";
if (!empty($_GET['local'])) {
mysql_query($query3) or die(mysql_error());
}
$query4="insert into robot.calllist (tel,id,msg,turno) 
select distinct tel_1_verif,numero_de_cuenta,msg,".$fields[$h]." 
from cobra4.resumen 
left join cobra4.historia on tel_1_verif=c_tele
join cobra4.dictamenes on status_aarsa=dictamen 
join robot.msglist on client=cliente
where (status_de_credito = '".$sdc."') 
AND (cliente=client)
AND (status_aarsa<>'PROPUESTA DE PAGO')
AND (status_aarsa<>'PAGANDO CONVENIO')
AND (status_aarsa<>'PAGO TOTAL')
AND msg='".$msg."'
and length(tel_1_verif)=10 and left(tel_1_verif,2)<>81
AND (c_cvst is null or (c_cvst<>'TEL NO EXISTE O SUSPENDIDO' 
AND c_cvst<>'TERCERO NO CONOCE DEUDOR'
AND c_cvst<>'ILOCALIZABLE TELEFONICO'))";
if (!empty($_GET['nonlocal'])) {
mysql_query($query4) or die(mysql_error());
}
}
}
}
        }
        }
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Asignar Queues a ROBOT</title>

<style type="text/css">
</style>
</head>
<body>
<?php if ($go=='asignar') { ?>
<p>Llamadas nuevas se asignaron al ROBOT</p>
<?php } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<p>Cliente <select name="msg">
<?php
    $querycl = "SELECT client,tipo,msg FROM robot.msglist;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    {?>
  <option value="<?php echo $answercl[2];?>" style="font-size:120%;">
  <?php echo $answercl[0].' '.$answercl[1];?></option>
<?php
    } ?>
</select>
</p>
<p>Queue <select name="queue">
  <option value="ACTUALIZADOS" style="font-size:120%;">ACTUALIZADOS</option>
  <option value="" style="font-size:120%;">TODOS</option>
<?php
    $queryq = "SELECT DISTINCT queue FROM dictamenes WHERE queue <> '' ORDER BY queue;";
    $resultq = mysql_query($queryq);
    
    while ($answerq = mysql_fetch_array($resultq)) 
    {?>
  <option value="<?php echo $answerq[0];?>" style="font-size:120%;">
  <?php echo $answerq[0];?></option>
<?php
    } ?>
</select>
</p>
<p>Campa&ntilde;a <select name="sdc">
<?php
    $queryc = "SELECT DISTINCT sdc,cliente FROM queuelist ORDER BY cliente,sdc;";
    $resultc = mysql_query($queryc);
    
    while ($answerc = mysql_fetch_array($resultc)) 
    {?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
  <?php echo $answerc[0].' - '.$answerc[1];?></option>
<?php
    } ?>
</select>
</p>
<p>Horas</p>
<table summary='hours'>
<?php for ($h=0;$h<24;$h++) { ?>
<input type="checkbox" name="fields[]" value="h">
<?php 
if ($h==0) {echo '12 AM';}
else if ($h<11) {echo $h.' AM';}
else if ($h==11) {echo $h.' AM<br>';}
else if ($h==12) {echo $h.' PM';}
else {echo ($h-12).' PM';};
} 
?>
</table>
<p>Cuantas veces por hora<select name="count">
<?php for ($v=1;$v<51;$v++) { ?>
<option value="<?php echo $v?>" style="font-size:120%;"><?php echo $v?></option>
<?php } ?>
</select>
</p>
<p>Telefonos</p>
<?php
    $queryt = "show columns from resumen where field like 'tel_%' and field not like '%marcados';";
    $resultt = mysql_query($queryt);
 $j=0;   
    while ($answert = mysql_fetch_array($resultt)) {
 $j++;
?>
<?php echo $answert[0]; ?>
<input type="checkbox" value="<?php echo $answert[0]; ?>" name="tel[]">
<?php if ($j==4) {$j=0; echo '<br>';}?>
<?php } ?>
<br>
<p>LADA</p>
<input type="checkbox" value="local" name="local">LOCAL
<br>
<input type="checkbox" value="nonlocal" name="nonlocal">NACIONAL
<br>
<input type="hidden" name="capt" value="<?php echo $capt ?>" />
<input type="submit" name="go" value="asignar" />
</form>
</body>
</html> 
<?php
}
}
mysql_close();
?>
