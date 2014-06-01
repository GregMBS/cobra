<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
$redirector = "Location: index.php";
header($redirector);
}
else {
    $local=$_SERVER['REMOTE_ADDR'];
    $tel=mysql_real_escape_string($_GET['tel']);
    $cta=mysql_real_escape_string($_GET['cta']);
    $querydel="update callme set completado=1 where ext='".$local."';";
    mysql_query($querydel) or die (mysql_error());
$howmany=0;
$error=0;
$queryck="select count(1) from callme 
where gestor='".$capt."'
and tel='".$tel."'
and tiempo>now()-interval 4 hour;";
$resultck=mysql_query($queryck) or die (mysql_error());
while ($answerck=mysql_fetch_row($resultck)) {
	$howmany=$answerck[0];}
if ($howmany<10) {
    $querymain="insert into callme (gestor,cuenta,tel,ext,tiempo) 
    values ('".$capt."','".$cta."','".$tel."','".$local."',now())";
    mysql_query($querymain) or die (mysql_error());

$querycell="select gestor,tel,ext,tiempo from callme 
where completado=0
order by tiempo limit 1";
$resultcell=mysql_query($querycell) or die (mysql_error());
while ($answercell=mysql_fetch_row($resultcell)) {
	$gestor=$answercell[0];
	$cel=trim($answercell[1]);
	$extn= split ("\.", $answercell[2]);
	$extl= 600+$extn[3];
$celular=$cel;
	if (strlen($cel)==13) {$celular=$cel;}
	if ((strlen($cel)==12)&&(substr($cel,0,2)=='44')) {$celular='0'.$cel;}
	if ((strlen($cel)==12)&&(substr($cel,0,2)=='45')) {$celular='0'.$cel;}
	if ((strlen($cel)==10)&&(substr($cel,0,2)=='81')) {$celular='044'.$cel;}
	if ((strlen($cel)==10)&&(substr($cel,0,2)!='81')) {$celular='045'.$cel;}
}
require "AsteriskManager.php";
$params = array('server' => '192.168.1.60', 'port' => '5038');
$ast = new Net_AsteriskManager($params);
    try {
        $ast->connect();
    } 
    catch (PEAR_Exception $e) {
    echo $e;
    }
    try {
	$ast->login('phpagi','phpagi');
    } 
    catch(PEAR_Exception $e) {
    echo $e;
    }
$tele=$celular;
$extension='9'.$tele;
    $querydel="update callme set completado=1 where right(tel,8)=right('".$tele."',8)";
    mysql_query($querydel) or die (mysql_error());
$channel='SIP/'.$extl;
$context='from-internal';
$cid=$extl;
     try {
        $output=$ast->originateCall($extension, 
                           $channel, 
                           $context, 
                           $cid, 
                           $priority = 1, 
                           $timeout = 30000, 
                           $variables = null, 
                           $action_id = null);
        } 
    catch(PEAR_Exception $e) {
        echo $e;
    }
     }
     else {$error=1;}
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
<body<?php if ($error==0) {?> onLoad='window.close()'<?php } ?>>
<p><?php echo $capt." tiene ".$howmany." llamadas contra ".$tel;?></p>
<button onClick='window.close()'>CIERRA</button>
</body>
</html> 
