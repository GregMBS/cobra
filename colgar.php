<?php
$go=$_GET['go'];
$capt=$_GET['capt'];
$from=$_GET['from'];
$output="";
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
if (!empty($go)) {
$ext=$_GET['ext'];
$command='soft hangup '.$ext;
     try {
        $output=$ast->command($command);
        } 
    catch(PEAR_Exception $e) {
        echo $e;
    }
}
header('Location: '.$from.'.php?capt='.$capt);
?>
