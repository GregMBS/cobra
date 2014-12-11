<?php
$capt=$_GET['capt'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PBX Colas</title>
<meta http-equiv="refresh" content="2"/>
	<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
	<script src="vendor/components/jquery/jquery.js" type="text/javascript"></script> 
	<script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
<style type="text/css">
		body {font-size:75%}
       pre {font-weight:bold;width:100%;border: 1pt solid #fff;background-color: #000;font-size:8pt;color:#ff0}
 	tr:hover {background-color: #ffff00;}
       th,.heavy {font-weight:bold;font-size:10pt;}
       .light {}
       .rightnow {background-color:#777777;}
       .callcenter {background-color:#ffffff;}
       .late {background-color:#ffff00; font-weight:bold; text-decoration:blink;}
       .verylate {background-color:#ff0000; font-weight:bold; text-decoration:blink;}
       .sip td {background-color:#ffff00;}
       .dahdi td {background-color:#bbbb33;}
	   .ta1 td {padding-left:1pt;padding-right:1pt;text-align:center;border: solid 1pt #00a0f0;}
	   .empty {background-color:#00a0f0;border:0}
</style>
</head>
<body>
<div style="clear:both">
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<a id='cell' href='cellcall2.php?capt=<?php echo $capt;?>' target='_blank'>
Llamada Celular</a>
</div>
<?php
require "AsteriskManager.php";
$params = array('server' => '192.168.0.102', 'port' => '5038');
$ast = new Net_AsteriskManager($params);
    try {
        $ast->connect();
    } 
    catch (PEAR_Exception $e) {
    echo $e;
    }
    try {
	$ast->login('admin','amp111');
    } 
    catch(PEAR_Exception $e) {
    echo $e;
    } ?>
<h2>Colas</h2>
<pre>
<?php
    try {$qlist=$ast->command('queue show 900', '--END COMMAND--');}
    catch(PEAR_Exception $e) {
        echo $e;
    }
$output=explode("\n",$qlist);
foreach ($output as $out) {
if (preg_match("/^80/",$out)) {
    echo substr($out,0,10)."\n";
    }
if (preg_match("/wait/",$out)) {
    echo $out."\n";
    }
    }
    try {$qlist=$ast->command('queue show 2002', '--END COMMAND--');}
    catch(PEAR_Exception $e) {
        echo $e;
    }
$output=explode("\n",$qlist);
foreach ($output as $out) {
if (preg_match("/^80/",$out)) {
    echo substr($out,0,10)."\n";
    }
if (preg_match("/wait/",$out)) {
    echo $out."\n";
    }
    }
?>
</pre>
<h2>Estacionmiento</h2>
<pre>
<?php    
$outputp="";
     try {
        $outputp=$ast->command('parkedcalls show', '--END COMMAND--');
        } 
    catch(PEAR_Exception $e) {
        echo $e;
    }
$outputpp=explode("\n",$outputp);
foreach ($outputpp as $op) {
if (!preg_match("/e:/",$op)) {
echo $op."\n";
}
}
//echo $outputp;
?></pre>
<h2>Lineas</h2>
<div style="float:left">
<table>
<?php
     try {
        $outputc=$ast->command('core show channels concise', '--END COMMAND--');
        } 
    catch(PEAR_Exception $e) {
        echo $e;
    }
$output=explode("\n",$outputc);
$outputs=sort($output);
for ($i=0;$i<count($output);$i++) {
$cols=array(0,1,2,7);
    if (preg_match("/^IAX2/",$output[$i])) {
    ?><tr class="dahdi"><?php
    $out=explode("!",$output[$i]);
    $tiempo=floor($out[11]/60).':'.sprintf("%02d", ($out[11]%60));
    for ($j=0;$j<count($out);$j++) {
    if (in_array($j,$cols)){
    $outs=$out[$j];
    if ($outs=='milt') {$outs='ROBOT';}
    if ($outs=='from-trunk') {$outs='SALIENTE';}
    if ($outs=='from-internal-xfer') {$outs='TRANSFER';}
    if ($outs=='from-internal-robot') {$outs='ROBOT';}
    if ($outs=='from-pstn') {$outs='ROBOT';}
    if ($outs=='macro-dial') {$outs='ENTRANTE';}
    if ($outs=='ext-queues') {$outs='ENTRANTE';}
    if ($outs=='s') {$outs='marcando';}
    if ($outs=='(None)') {$outs='';}
/*
    if ($j==0) {$outs=substr($outs,6);}
    if ($j==0) {$outs="CANAL ".substr($outs,0,stripos($outs,"-"));}
*/
    if ($j==11) {$outs=substr($outs,stripos($outs,"/")+1,4);$ext0[$outs]=1;}
    echo "<td>".$outs."</td>";
     }}
    echo "<td>".$tiempo."</td>";
    ?>
    <td>
    <form name="hangup" method="get" action="colgar.php" id="hangup">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="ext" value="<?php echo $out[0];?>">
<input type="hidden" name="from" value="pbxqueues">
<input type="submit" name="go" value="CUELGALO"></form>
</td>
</tr>
<?php } 
$cols=array(0,1,2,6);
    if (preg_match("/^SIP/",$output[$i])) {
    ?><tr class="sip"><?php
    $out=explode("!",$output[$i]);
    $tiempo=floor($out[11]/60).':'.sprintf("%02d", ($out[11]%60));
    for ($j=0;$j<count($out);$j++) {
    if (in_array($j,$cols)){
    $outs=$out[$j];
    if ($outs=='from-trunk') {$outs='SALIENTE';}
    if ($outs=='from-internal') {$outs='ELASTIX';}
    if ($outs=='from-internal-xfer') {$outs='TRANSFER';}
    if ($outs=='from-internal-robot') {$outs='ROBOT';}
    if ($outs=='from-pstn') {$outs='ROBOT';}
    if ($outs=='from-internal-short') {$outs='ENTRANTE';}
    if ($outs=='ext-queues') {$outs='ENTRANTE';}
    if ($outs=='s') {$outs='';}
    if ($outs=='macro-dialout-trunk') {$outs='SALIENTE';}
    if ($outs=='talk') {$outs='grabacion';}
    if ($outs=='(None)') {$outs='';}
//    if ($j==0) {$outs=substr($outs,4,4);$ext[$outs]=1;}
    if (($j==11)&&(preg_match("/^Local/",$outs))) {
        $outs=substr($outs,stripos($outs,"/")+1,3);
        $outs="EXT ".$outs;
        }
    echo "<td>".$outs."</td>";
     }}
    echo "<td>".$tiempo."</td>";
    ?>
    <td>
    <form name="hangup" method="get" action="colgar.php" id="hangup">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="ext" value="<?php echo $out[0];?>">
<input type="hidden" name="from" value="pbxqueues">
<input type="submit" name="go" value="CUELGALO"></form>
</td>
</tr>
<?php } 
} ?>
</table>
</div>
<div style="float:left">
<table border="0" cellspacing="0" cellpadding="0" class="ta1">
<tr class="ro2">
<td class="empty"></td>
<td colspan=2 style="<?php if (!empty($ext[1101])) {echo 'background-color:yellow;';}if (!empty($ext0[1101])) {echo 
'font-weight:bold;';}?> " id="1101"><p>1101<BR>Admon</p></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[1005])) {echo 'background-color:yellow;';}if (!empty($ext0[1005])) {echo 
'font-weight:bold;';}?> " id="1005"><p>1005</p></td>
<td style=" <?php if (!empty($ext[1010])) {echo 'background-color:yellow;';}if (!empty($ext0[1010])) {echo 
'font-weight:bold;';}?> " id="1010"><p>1010</p></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[1004])) {echo 'background-color:yellow;';}if (!empty($ext0[1004])) {echo
'font-weight:bold;';}?> " id="1004"><p>1004</p></td>
<td style=" <?php if (!empty($ext[1009])) {echo 'background-color:yellow;';}if (!empty($ext0[1009])) {echo
'font-weight:bold;';}?> " id="1009"><p>1009</p></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[1003])) {echo 'background-color:yellow;';}if (!empty($ext0[1003])) {echo
'font-weight:bold;';}?> " id="1003"><p>1003</p></td>
<td style=" <?php if (!empty($ext[1008])) {echo 'background-color:yellow;';}if (!empty($ext0[1008])) {echo
'font-weight:bold;';}?> " id="1008"><p>1008</p></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[1002])) {echo 'background-color:yellow;';}if (!empty($ext0[1002])) {echo
'font-weight:bold;';}?> " id="1002"><p>1002</p></td>
<td style=" <?php if (!empty($ext[1007])) {echo 'background-color:yellow;';}if (!empty($ext0[1007])) {echo
'font-weight:bold;';}?> " id="1007"><p>1007</p></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[1001])) {echo 'background-color:yellow;';}if (!empty($ext0[1001])) {echo
'font-weight:bold;';}?> " id="1001"><p>1001</p></td>
<td style=" <?php if (!empty($ext[1006])) {echo 'background-color:yellow;';}if (!empty($ext0[1006])) {echo
'font-weight:bold;';}?> " id="1006"><p>1006</p></td>
<td style=" " class="empty"></td>
</tr>
</table>
</div>
</body>
</html>
