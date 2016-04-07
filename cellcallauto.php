<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
require "AsteriskManager.php";
while (1==1) {
$querycell="select gestor,tel,ext,tiempo from callme 
where completado=0
order by tiempo limit 1";
$resultcell=mysql_query($querycell) or die (mysql_error());
while ($answercell=mysql_fetch_row($resultcell)) {
	$gestor=$answercell[0];
	$cel=$answercell[1];
	$extn= split ("\.", $answercell[2]);
	$extl= 600+$extn[3];
$celular=0;
	if (strlen($cel)==13) {$celular=$cel;}
	if ((strlen($cel)==12)&&(substr($cel,0,2)=='44')) {$celular='0'.$cel;}
	if ((strlen($cel)==12)&&(substr($cel,0,2)=='45')) {$celular='0'.$cel;}
	if ((strlen($cel)==10)&&(substr($cel,0,2)=='81')) {$celular='044'.$cel;}
	if ((strlen($cel)==10)&&(substr($cel,0,2)!='81')) {$celular='045'.$cel;}
}
$output="";
if (!empty($celular)) {
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
$tele=$celular;
$extension='9'.$tele;
    $querydel="update callme set completado=1 where right(tel,8)=right('".$tele."',8)";
    mysql_query($querydel) or die (mysql_error());
$channel='SIP/'.$extl;
$context='from-internal';
$cid=mysql_real_escape_string($_GET['ext']);
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
    unset($ast);
}
}
} 
mysql_close($con);
?>
