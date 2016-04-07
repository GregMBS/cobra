<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (!empty($_GET['capt'])) 
{
    $capt = mysql_real_escape_string($_GET['capt']);
}
if (!empty($_POST['capt'])) 
{
    $capt = mysql_real_escape_string($_POST['capt']);
}
            $queryins = "insert into cobra4.historia (c_tele, d_fech, c_hrin, c_cont, 
            cuenta,c_cvba,c_cvst,c_obse1,c_cvge,c_accion,d_prom,n_prom,c_camp)
            select tel, DATE_FORMAT(fechahora, '%X-%m-%d'), 
            DATE_FORMAT(fechahora, '%H:%i:%s'), id_cuenta, numero_de_cuenta, client, 
            'MENSAJE EN BUZON',concat_ws(' ','MENSAJE EN BUZON',DATE_FORMAT(fechahora, '%H:%i:%s'),tel,DATE_FORMAT(fechahora, '%X-%m-%d')),
            'Milt','LLAMADA A DOMICILIO','2008-01-01',0,camp 
            from robot.calllog join robot.msglist using (msg) 
            join cobra4.resumen on id=numero_de_cuenta and client=cliente;";
            mysql_query($queryins) or die(mysql_error());
            $queryt = "truncate robot.calllog;";
            mysql_query($queryt) or die(mysql_error());
        }
    }
mysql_close($con);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>GUARDAR Registro</title>
</head>
<body>
<p>Registro se guard&oacute;</p>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
</body>
</html>
