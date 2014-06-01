<?php  
include('admin_hdr_2.php');
$query1="insert into robot.calllist (tel,id,msg) 
select distinct right(tel_1,8),id_cuenta,msg 
from cobra.resumen 
left join cobra.historia on tel_1=c_tele
join robot.msglist on client=cliente
where (status_de_credito='360s') 
and length(tel_1)=10 and left(tel_1,2)=81
AND (status_aarsa = 'NEGATIVA DE PAGO'
OR status_aarsa = 'MENSAJE CON FAMILIAR')
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
mysql_query($query1) or die(mysql_error());
$query2="insert into robot.calllist (tel,id,msg) 
select distinct right(tel_1,8),id_cuenta,msg 
from cobra.resumen 
left join cobra.historia on tel_1=c_tele
join robot.msglist on client=cliente
where (status_de_credito='360s') 
and length(tel_1)=10 and left(tel_1,2)<>81
AND (status_aarsa = 'NEGATIVA DE PAGO'
OR status_aarsa = 'MENSAJE CON FAMILIAR')
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
mysql_query($query2) or die(mysql_error());
$query3="insert into robot.calllist (tel,id,msg) 
select distinct right(tel_1_verif,8),id_cuenta,msg 
from cobra.resumen 
left join cobra.historia on tel_1_verif=c_tele
join robot.msglist on client=cliente
where (status_de_credito='360s') 
and length(tel_1_verif)=10 and left(tel_1_verif,2)=81
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
mysql_query($query3) or die(mysql_error());
$query4="insert into robot.calllist (tel,id,msg) 
select distinct right(tel_1_verif,8),id_cuenta,msg 
from cobra.resumen 
left join cobra.historia on tel_1_verif=c_tele
join robot.msglist on client=cliente
where (status_de_credito='360s') 
and length(tel_1_verif)=10 and left(tel_1_verif,2)<>81
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
mysql_query($query4) or die(mysql_error());
mysql_close(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>ROBOT Carga</title>
</head>
<body>
<p>Llamadas de Credito Si estan guardado</p>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
</body>
</html>

