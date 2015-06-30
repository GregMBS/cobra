<?php
$capt	 = filter_input(INPUT_GET, 'capt');
?>
<!DOCTYPE html>
<html>
    <head>
	<title>PBX Colas</title>
	<meta http-equiv="refresh" content="2"/>
	<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
	<script src="vendor/components/jquery/jquery.js" type="text/javascript"></script>
	<script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
	<div style="clear:both">
	    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
	    <a id='cell' href='cellcall2.php?capt=<?php echo $capt; ?>' target='_blank'>
		Llamada Celular</a>
	</div>
	<?php
	require "AsteriskManager.php";
	$params	 = array('server' => '192.168.0.102', 'port' => '5038');
	$ast	 = new Net_AsteriskManager($params);
	try {
		$ast->connect();
	} catch (PEAR_Exception $e) {
		echo $e;
	}
	try {
		$ast->login('admin', 'cs1pb1x12');
	} catch (PEAR_Exception $e) {
		echo $e;
	}
	?>
	<h2>Colas</h2>
	<pre>
	    <?php
	    try {
		    $qlist = $ast->command('queue show 900', '--END COMMAND--');
	    } catch (PEAR_Exception $e) {
		    echo $e;
	    }
	    $outputq = explode("\n", $qlist);
	    foreach ($outputq as $out) {
//		    if (preg_match("/^80/", $out)) {
			    echo substr($out, 0, 10)."\n";
//		    }
/*
                            if (preg_match("/wait/", $out)) {
			    echo $out."\n";
		    }
*/
  	    }

	    try {
		    $qlist2 = $ast->command('queue show 2002', '--END COMMAND--');
	    } catch (PEAR_Exception $e) {
		    echo $e;
	    }
	    $output2 = explode("\n", $qlist2);
	    foreach ($output2 as $out) {
		    if (preg_match("/^80/", $out)) {
			    echo substr($out, 0, 10)."\n";
		    }
		    if (preg_match("/wait/", $out)) {
			    echo $out."\n";
		    }
	    }
	    ?>
	</pre>
	<h2>Estacionmiento</h2>
	<pre>
	    <?php
	    try {
		    $outputp = $ast->command('parkedcalls show', '--END COMMAND--');
	    } catch (PEAR_Exception $e) {
		    echo $e;
		    $outputp = "";
	    }
	    $outputpp = explode("\n", $outputp);
	    foreach ($outputpp as $op) {
		    if (!preg_match("/e:/", $op)) {
			    echo $op."\n";
		    }
	    }
//echo $outputp;
	    ?></pre>
	<h2>IAX Troncales</h2>
	<pre>
	    <?php
	    try {
		    $outputt = $ast->command('iax2 show peers', '--END COMMAND--');
		    $outputt .= $ast->command('iax2 show registry', '--END COMMAND--');
	    } catch (PEAR_Exception $e) {
		    echo $e;
		    $outputt = "";
	    }
	    $outputtt = explode("\n", $outputt);
	    foreach ($outputtt as $ot) {
		    if (!preg_match("/e:/", $ot)) {
			    echo $ot."\n";
		    }
	    }
//echo $outputp;
	    ?></pre>
	<h2>SIP Troncales</h2>
	<pre>
	    <?php
	    try {
		    $outputS = $ast->command('sip show peers', '--END COMMAND--');
		    $outputS .= $ast->command('sip show registry', '--END COMMAND--');
	    } catch (PEAR_Exception $e) {
		    echo $e;
		    $outputS = "";
	    }
	    $outputSS = explode("\n", $outputS);
	    foreach ($outputSS as $oS) {
		    if (!preg_match("/e:/", $oS)) {
			    echo $oS."\n";
		    }
	    }
//echo $outputp;
	    ?></pre>
	<h2>Llamadas</h2>
	<pre>
	    <?php
	    try {
		    $outputli = $ast->command('core show channels verbose', '--END COMMAND--');
	    } catch (PEAR_Exception $e) {
		    echo $e;
		    $outputli = "";
	    }
	    $outputll = explode("\n", $outputli);
	    foreach ($outputll as $ol) {
		    echo $ol."\n";
	    }
//echo $outputp;
	    ?></pre>
    </div>
</body>
</html>
