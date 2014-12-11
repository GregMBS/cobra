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
</div>
<?php
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
    } ?>
<h2>Colas</h2>
<pre>
<?php
    try {$qlist=$ast->command('queue show 800', '--END COMMAND--');}
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
    try {$qlist=$ast->command('queue show 801', '--END COMMAND--');}
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
        $outputp=$ast->command('show parkedcalls', '--END COMMAND--');
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
$cols=array(0,1,2,7,11);
    if (preg_match("/^DAHDI/",$output[$i])) {
    ?><tr class="dahdi"><?php
    $out=explode("!",$output[$i]);
    $tiempo=floor($out[10]/60).':'.sprintf("%02d", ($out[10]%60));
    for ($j=0;$j<count($out);$j++) {
    if (in_array($j,$cols)){
    $outs=$out[$j];
    if ($outs=='milt') {$outs='ROBOT';}
    if ($outs=='from-pstn') {$outs='SALIENTE';}
    if ($outs=='from-internal') {$outs='ELASTIX';}
    if ($outs=='from-internal-restricted') {$outs='ELASTIX';}
    if ($outs=='from-internal-xfer') {$outs='TRANSFER';}
    if ($outs=='from-internal-robot') {$outs='ROBOT';}
    if ($outs=='macro-dial') {$outs='ENTRANTE';}
    if ($outs=='830') {$outs='1300';}
    if ($outs=='831') {$outs='1500';}
    if ($outs=='832') {$outs='2500';}
    if ($outs=='833') {$outs='1100';}
    if ($outs=='834') {$outs='1200';}
    if ($outs=='836') {$outs='1400';}
    if ($outs=='837') {$outs='1700';}
    if ($outs=='838') {$outs='1800';}
    if ($outs=='839') {$outs='1900';}
    if ($outs=='840') {$outs='600';}
    if ($outs=='841') {$outs='1000';}
    if ($outs=='842') {$outs='2000';}
    if ($outs=='843') {$outs='3000';}
    if ($outs=='844') {$outs='4000';}
    if ($outs=='845') {$outs='5000';}
    if ($outs=='846') {$outs='6000';}
    if ($outs=='847') {$outs='7000';}
    if ($outs=='848') {$outs='8000';}
    if ($outs=='849') {$outs='9000';}
    if ($outs=='800') {$outs='Admin';}
    if ($outs=='801') {$outs='Gestores';}
    if ($outs=='ext-queues') {$outs='ENTRANTE';}
    if ($outs=='850') {$outs='ROBOT';}
    if ($outs=='s') {$outs='marcando';}
    if ($outs=='talk') {$outs='grabacion';}
    if ($outs=='(None)') {$outs='';}
    if ($j==0) {$outs=substr($outs,6);}
    if ($j==0) {$outs="CANAL ".substr($outs,0,stripos($outs,"-"));}
    if ($j==11) {$outs=substr($outs,stripos($outs,"/")+1,3);$ext0[$outs]=1;}
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
$cols=array(0,1,2,6,11);
$cols=array(0,1,2,6,11);
    if (preg_match("/^SIP/",$output[$i])) {
    ?><tr class="sip"><?php
    $out=explode("!",$output[$i]);
    $tiempo=floor($out[10]/60).':'.sprintf("%02d", ($out[10]%60));
    for ($j=0;$j<count($out);$j++) {
    if (in_array($j,$cols)){
    $outs=$out[$j];
    if ($outs=='milt') {$outs='ROBOT';}
    if ($outs=='from-pstn') {$outs='SALIENTE';}
    if ($outs=='from-internal') {$outs='ELASTIX';}
    if ($outs=='from-internal-xfer') {$outs='TRANSFER';}
    if ($outs=='from-internal-robot') {$outs='ROBOT';}
    if ($outs=='from-internal-restricted') {$outs='ENTRANTE';}
    if ($outs=='from-internal-short') {$outs='ENTRANTE';}
    if ($outs=='830') {$outs='1300';}
    if ($outs=='831') {$outs='1500';}
    if ($outs=='832') {$outs='2500';}
    if ($outs=='833') {$outs='1100';}
    if ($outs=='834') {$outs='1200';}
    if ($outs=='836') {$outs='1400';}
    if ($outs=='837') {$outs='1700';}
    if ($outs=='838') {$outs='1800';}
    if ($outs=='839') {$outs='1900';}
    if ($outs=='840') {$outs='600';}
    if ($outs=='841') {$outs='1000';}
    if ($outs=='842') {$outs='2000';}
    if ($outs=='843') {$outs='3000';}
    if ($outs=='844') {$outs='4000';}
    if ($outs=='845') {$outs='5000';}
    if ($outs=='846') {$outs='6000';}
    if ($outs=='847') {$outs='7000';}
    if ($outs=='848') {$outs='8000';}
    if ($outs=='849') {$outs='9000';}
    if ($outs=='800') {$outs='Admin';}
    if ($outs=='801') {$outs='Gestores';}
    if ($outs=='ext-queues') {$outs='ENTRANTE';}
    if ($outs=='850') {$outs='ROBOT';}
    if ($outs=='ext-queues') {$outs='ENTRANTE';}
    if ($outs=='71') {$outs='TRANSFER';}
    if ($outs=='s') {$outs='';}
    if ($outs=='macro-dialout-trunk') {$outs='SALIENTE';}
    if ($outs=='talk') {$outs='grabacion';}
    if ($outs=='(None)') {$outs='';}
    if ($j==0) {$outs=substr($outs,4,3);$ext[$outs]=1;}
    if (($j==11)&&(preg_match("/^DAHDI/",$outs))) {
        $outs=substr($outs,stripos($outs,"/")+1,3);
        $outs="CANAL ".substr($outs,0,stripos($outs,"-"));
        }
    if (($j==6)&&(preg_match("/^DAHDI/",$outs))) {
        $outs=substr($outs,stripos($outs,"/",6)+1,13);
        $outs=substr($outs,0,stripos($outs,"|"));
        }
    if (($j==11)&&(preg_match("/^Local/",$outs))) {
        $outs=substr($outs,stripos($outs,"/")+1,3);
        $outs="EXT ".$outs;
        }
    if (preg_match("/88889/",$outs)) {$outs="9000";}
    if (preg_match("/88888/",$outs)) {$outs="8000";}
    if (preg_match("/88887/",$outs)) {$outs="7000";}
    if (preg_match("/888860/",$outs)) {$outs="600";}
    if (preg_match("/888861/",$outs)) {$outs="600";}
    if (preg_match("/888826/",$outs)) {$outs="2000";}
    if (preg_match("/888825/",$outs)) {$outs="2500";}
    if (preg_match("/888815/",$outs)) {$outs="1500";}
    if (preg_match("/888836/",$outs)) {$outs="3000";}
    if (preg_match("/888813/",$outs)) {$outs="1300";}
    if (preg_match("/888817/",$outs)) {$outs="1700";}
    if (preg_match("/888818/",$outs)) {$outs="1800";}
    if (preg_match("/888819/",$outs)) {$outs="1900";}
    if (preg_match("/888814/",$outs)) {$outs="1400";}
    if (preg_match("/888812/",$outs)) {$outs="1200";}
    if (preg_match("/888811/",$outs)) {$outs="1100";}
    if (preg_match("/888846/",$outs)) {$outs="4000";}
    if (preg_match("/88885/",$outs)) {$outs="5000";}
    if (preg_match("/888866/",$outs)) {$outs="6000";}
    if (preg_match("/888816/",$outs)) {$outs="1000";}
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
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td colspan=2 style="<?php if (!empty($ext[500])) {echo 'background-color:yellow;';}if (!empty($ext0[500])) {echo 'font-weight:bold;';}?> " id="500"><p>500<BR>Admon</p></td>
<td colspan=2 style="<?php if (!empty($ext[600])) {echo 'background-color:yellow;';}if (!empty($ext0[600])) {echo 'font-weight:bold;';}?> " id="600"><p>600<BR>Direc</p></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[610])) {echo 'background-color:yellow;';}if (!empty($ext0[610])) {echo 'font-weight:bold;';}?> " id="610"><p>610</p></td>
<td style=" <?php if (!empty($ext[620])) {echo 'background-color:yellow;';}if (!empty($ext0[620])) {echo 'font-weight:bold;';}?> " id="620"><p>620</p></td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[607])) {echo 'background-color:yellow;';}if (!empty($ext0[607])) {echo 'font-weight:bold;';}?> " id="607"><p>607</p></td>
<td style=" <?php if (!empty($ext[604])) {echo 'background-color:yellow;';}if (!empty($ext0[604])) {echo 'font-weight:bold;';}?> " id="604"><p>604</p></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style="  ">
<p>&nbsp;</p>
</td>
<td style=" <?php if (!empty($ext[622])) {echo 'background-color:yellow;';}if (!empty($ext0[622])) {echo 'font-weight:bold;';}?> " id="622">
<p>622</p>
</td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[618])) {echo 'background-color:yellow;';}if (!empty($ext0[618])) {echo 'font-weight:bold;';}?> " id="618">
<p>618</p>
</td>
<td style=" <?php if (!empty($ext[615])) {echo 'background-color:yellow;';}if (!empty($ext0[615])) {echo 'font-weight:bold;';}?> " id="615">
<p>615</p>
</td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[613])) {echo 'background-color:yellow;';}if (!empty($ext0[613])) {echo 'font-weight:bold;';}?> " id="613">
<p>613</p>
</td>
<td style=" <?php if (!empty($ext[606])) {echo 'background-color:yellow;';}if (!empty($ext0[606])) {echo 'font-weight:bold;';}?> " id="606">
<p>606</p>
</td>
<td style=" " class="empty"></td>
<td rowspan="2" style="<?php if (!empty($ext[103])) {echo 'background-color:yellow;';}if (!empty($ext0[103])) {echo 'font-weight:bold;';}?> " id="103">
<p>103<BR>Sistem</p>
</td>
</tr>
<tr class="ro1">
<td style="  " class="ce5">
<p>&nbsp;</p>
</td>
<td style="  " class="ce7">
<p>&nbsp;</p>
</td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[608])) {echo 'background-color:yellow;';}if (!empty($ext0[608])) {echo 'font-weight:bold;';}?> " id="608">
<p>608</p>
</td>
<td style=" <?php if (!empty($ext[603])) {echo 'background-color:yellow;';}if (!empty($ext0[603])) {echo 'font-weight:bold;';}?> " id="603">
<p>603</p>
</td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[611])) {echo 'background-color:yellow;';}if (!empty($ext0[611])) {echo 'font-weight:bold;';}?> " id="611">
<p>611</p>
</td>
<td style=" <?php if (!empty($ext[602])) {echo 'background-color:yellow;';}if (!empty($ext0[602])) {echo 'font-weight:bold;';}?> " id="602">
<p>602</p>
</td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[612])) {echo 'background-color:yellow;';}if (!empty($ext0[612])) {echo 'font-weight:bold;';}?> " id="612">
<p>612</p>
</td>
<td style=" <?php if (!empty($ext[605])) {echo 'background-color:yellow;';}if (!empty($ext0[605])) {echo 'font-weight:bold;';}?> " id="603">
<p>605</p>
</td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[609])) {echo 'background-color:yellow;';}if (!empty($ext0[609])) {echo 'font-weight:bold;';}?> " id="609">
<p>609</p>
</td>
<td style=" <?php if (!empty($ext[621])) {echo 'background-color:yellow;';}if (!empty($ext0[621])) {echo 'font-weight:bold;';}?> " id="621">
<p>621</p>
</td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
</tr>
<tr class="ro1">
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" <?php if (!empty($ext[630])) {echo 'background-color:yellow;';}if (!empty($ext0[630])) {echo 'font-weight:bold;';}?> " id="630">
<p>630<BR>Super.</p>
</td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
<td style=" " class="empty"></td>
</tr>
</table>
</div>
</body>
</html>
