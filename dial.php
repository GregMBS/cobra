<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
$redirector = "Location: index.php";
header($redirector);
}
else {
    $local=$_SERVER['REMOTE_ADDR'];
    $tel=mysql_real_escape_string($_REQUEST['tel']);
    $cta=mysql_real_escape_string($_REQUEST['cta']);
    $querydel="update callme set completado=1 where ext='".$local."';";
    mysql_query($querydel) or die (mysql_error());
    $querymain="insert into callme (gestor,cuenta,tel,ext,tiempo) 
    values ('".$capt."','".$cta."','".$tel."','".$local."',now())";
    mysql_query($querymain) or die (mysql_error());
     }
}
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Marcar</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
 </style>
</head>
<body onLoad='window.close()'>
<button onClick='window.close()'>CIERRA</button>
</body>
</html> 
