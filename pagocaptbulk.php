<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_POST['auto']))||(!empty($_POST['auto']));
if ($attack) {die('ATTACK!');}
if (empty($_REQUEST['capt']))
{
$redirector = "Location: ".$uri."/index.php";
header($redirector);
}
$capt=mysql_real_escape_string($_REQUEST['capt']);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go=mysql_real_escape_string($_POST['go']);
if ($go=='PAGO') {
{
            
            $querytemp1 = 'DROP TABLE IF EXISTS temppay';
mysql_query($querytemp1) or die(mysql_error());
            $querytemp2 = 'CREATE TABLE temppay (
  `cuenta` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(10,2) NOT NULL
)';
mysql_query($querytemp2) or die(mysql_error());
$data = preg_split("/[\s,]+/", $_POST['data'],0,PREG_SPLIT_NO_EMPTY);
$max=ceil(count($data)/3);
$queryload='';
for ($i=0;$i<$max;$i++) {
$cuenta=$data[$i*3];
$fecha=date('Y-m-d',strtotime($data[$i*3+1]));
$monto=$data[$i*3+2];
$queryload = "INSERT INTO tempc (cuenta,fecha,monto) VALUES ('".$data[$a]."','".$data[$b]."');";
mysql_query($queryload) or die(mysql_error());
$queryload2 = "update cobra4.resumen set norobot=0 
where numero_de_cuenta='".$data[$a]."' and cliente=cobra4.q('$msgtag');";
mysql_query($queryload2) or die(mysql_error());
}
            $fields = $_POST['fields'];
$queryput1 = "INSERT INTO robot.calllist (id,tel,msg,turno) 
SELECT id,tel,msg,0 FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)='".$msgtag."') as tmp on 1=1
;";
$queryput2 = "INSERT INTO robot.calllist (id,tel,msg,turno) 
SELECT id,tel,msg,0 FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)='".$msgtag."') as tmp on 1=1
;";
mysql_query($queryput1) or die(mysql_error());
//echo $queryput1.'<br>';
//mysql_query($queryput2) or die(mysql_error());
//echo $queryput2.'<br>';
?>
<p>Llamadas estan guardado</p>
<?php } } 
$queryadd="insert into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,credito,id_cuenta)
select numero_de_cuenta, '".$FECHA."', ".$MONTO.", cliente, 
c_cvge, 1, numero_de_credito,id_cuenta from resumen 
left join historia h1 on c_cont=id_cuenta and n_prom>0 and d_fech<='".$FECHA."'
where numero_de_cuenta='".$CUENTA."' 
and cliente='".$CLIENTE."'
and (numero_de_cuenta,'".$FECHA."','".$MONTO."',cliente) 
not in (select cuenta,fecha,monto,cliente from pagos where confirmado=1) 
group by id_cuenta,c_cvge  
order by d_fech desc,c_hrin desc limit 1";
$resultadd=mysql_query($queryadd) or die (mysql_error());
$queryadd2="update resumen,pagos
set fecha_de_ultimo_pago=fecha,monto_ultimo_pago=monto 
where resumen.id_cuenta=pagos.id_cuenta and confirmado=1 
and fecha>fecha_de_ultimo_pago";
$resultadd2=mysql_query($queryadd2) or die (mysql_error());
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Pagos Bulk</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff;color:#000000;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #c0c0c0;background-color: #c0c0c0; width:12em;color:black;}
	#tableContainer {height: 3cm; overflow: scroll;}
<?php
        if (substr($stc, -8)=='iquidado') {
?>
        #capturar {display:none}
<?php
}
?>
</style>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
</head>
<body>
<div>
<form action='#' method='POST' id='payment'>
<input type='hidden' name='go' value='PAGO'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<p>Usa formato CUENTA,FECHA,MONTO</p>
<textarea name='data' rows='20' cols='50'></textarea>
CLIENTE <select name="CLIENTE" style="width: 8cm;">
<option value="" selected="selected"> </option>
<?php 
$query = "SELECT cliente FROM clientes order by cliente";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) { ?>
  <option style='width: 12cm;' value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select><br>
<input type='submit' name='PAGO' value='PAGO'>
</form>
</div>
<button onClick='window.close()'>CIERRA</button>
<?php   
}
?>
</body>
</html> 
