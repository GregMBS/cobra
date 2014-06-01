<?php 
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
//$con = mysql_connect('localhost') or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string(strtolower($_REQUEST['capt']));
$go="error";
$go=mysql_real_escape_string(strtolower($_REQUEST['gone']));
$queryunlock="UPDATE resumen SET timelock=NULL, locker=NULL WHERE locker='".$capt."';";
mysql_query($queryunlock) or die("ERROR LM1 - ".mysql_error());
if ($go!="") {
$queryins="INSERT INTO historia (C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI) 
    VALUES ('".$capt."','',0,0,'".$go."',curdate(),curtime(),curtime());";
if ($go=='forgot') {
$queryldt="select d_fech,c_hrfi from historia where c_cvge='".$capt."' 
order by d_fech desc,c_hrin desc limit 1;";
$resultldt = mysql_query($queryldt) or die("ERROR LM2 - ".mysql_error());
while ($answerldt=mysql_fetch_row($resultldt)) {
$queryins="INSERT INTO historia (C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI) 
    VALUES ('".$capt."','',0,0,'salir','$answerldt[0]','$answerldt[1]','$answerldt[1]');";
}
}
mysql_query($queryins);
$queryclr="UPDATE resumen SET locker=NULL, timelock=NULL 
    WHERE locker = '".$capt."';";
mysql_query($queryclr);
$queryclr2="DELETE from rslice WHERE user = '".$capt."';";
mysql_query($queryclr2);
$queryc="update nombres set ticket =null where iniciales='".$capt."';";
	$resultc = mysql_query($queryc) or die("ERROR LM3 - ".mysql_error());
		$page="Location: index.php";
if (($go!="salir")&&($go!="error")) {$page="Location: breaks.php?capt=".$capt;}
	        header($page);
		}
 ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LOGOUT de COBRA</title>
<style type="text/css">
			 fieldset {width: 21em; background-color: #c0c0c0; text-align: center;}
</style>
		<link rel="Stylesheet" href="css/redmond/jquery-ui.css" />
		<script type="text/javascript" charset="utf8" src="js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" charset="utf8" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
function aviso() {
}
$(document).ready(function () {
	$('button').button();
});
</script>
</head>
<body onLoad='aviso();'>
<div class="forma">
<form action='logout.php' method='get'>
<fieldset>
<h1>COBRA - LOGOUT</h1>
<input type='hidden' name='capt' value='<?php echo $capt ?>'>
<button name='gone' value='Bano'>BA&Ntilde;O</button><br>
<button name='gone' value='Junta'>JUNTA</button><br>
<!--<button name='gone' value='Oxxo'>OXXO</button><br>-->
<button name='gone' value='Braek'>BREAK</button><br>
<button name='gone' value='Salir'>SALIR</button><br>
</fieldset>
</form>
</div>
<div class="logo">
</div>
</body>
</html>
<?php
mysql_close();

