<?php
$day_esp	 = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
include('pdoConnect.php');
$pdac		 = new pdoConnect();
$pdo		 = $pdac->dbConnectAdmin();
require_once 'PerfmesClass.php';
$pc		 = new PerfmesClass($pdo);
require_once 'PerfmesAllClass.php';
$pac		 = new PerfmesAllClass($pdo);
$yr		 = date('Y', strtotime('last day of previous month'));
$mes		 = date('m', strtotime('last day of previous month'));
$dhoy		 = date('d', strtotime('last day of previous month'));
$hoy		 = date('Y-m-d', strtotime('last day of previous month'));
$capt		 = filter_input(INPUT_GET, 'capt');
$resultwd	 = $pc->countVisitadorDays();
foreach ($resultwd as $answerwd) {
	$expw1	 = $answerwd['sfs'] * 15;
	$expw2	 = $answerwd['sss'] * 15;
}
$dst = '';
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Visitas del Mes Actual</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style type="text/css">
            tr:hover {background-color: #ffff00;}
            .heavy {font-weight:bold;font-size:10pt;}
            .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
            .light {text-align:right;}
            .zeros {color:red;}
        </style>
    </head>
    <body>
	<h2>VISITAS DEL MES ACTUAL</h2>
	<table summary="LpH">
	    <?php
	    for ($i = 1; $i <= $dhoy; $i++) {
		    $tsumt[$i]	 = 0;
		    $tsumb[$i]	 = 0;
		    $tsumg[$i]	 = 0;
		    $tsumgt[$i]	 = 0;
		    $tsumpp[$i]	 = 0;
		    $tsump[$i]	 = 0;
		    $tsumw[$i]	 = 0;
		    $tsumci[$i]	 = 0;
	    }
	    $resultnom = $pc->listVisitadores();
	    foreach ($resultnom as $answernom) {
		    $visitador	 = $answernom[0];
		    $c_visit	 = $answernom[1];
		    ?>
		    <thead>
			<tr>
			    <th><?php echo $visitador; ?></th>
			    <?php
			    for ($i = 1; $i <= $dhoy; $i++) {
				    $lla[$i]	 = 0;
				    $tlla[$i]	 = 0;
				    $prom[$i]	 = 0;
				    $pag[$i]	 = 0;
				    $lph[$i]	 = 0;
				    $queryss	 = "select 0,0,
0,
sum(distinct c_carg<>''),sum(c_cvst like 'PRO% DE%'),count(1)
from historia where c_visit='$c_visit'
and c_msge is null and c_cont<>'0'
and c_cniv is not null and year(D_FECH)=year(curdate()-interval 1 month)
and d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
and day(D_FECH)=$i  group by D_FECH";
				    $resultss	 = $pc->getVisitadorMain($c_visit, $i);
				    foreach ($resultss as $answerss) {
					    $lla[$i]	 = $answerss['cuentas'];
					    $tlla[$i]	 = $answerss['gestiones'];
					    $prom[$i]	 = $answerss['promesas'];
					    $lph[$i]	 = $lla[$i] / ($diff[$i] + 1 / 3600);
					    $sumg		 = 0;
					    $sumgt		 = 0;
					    $sumgt1		 = 0;
					    $sumgt2		 = 0;
					    $sumt		 = 0;
					    $sumb		 = 0;
					    $sumpp		 = 0;
					    $sump		 = 0;
					    $sumw		 = 0;
					    $resultp	 = $pc->getVisitadorPagos($c_visit, $i);
					    foreach ($resultp as $answerp) {
						    $pag[$i] = $answerp['ct'];
					    }
				    }

				    $resultco	 = $pc->countVisitsAssigned($c_visit, $i);
				    foreach ($resultco as $answerco) {
					    $co[$i] = $answerco['co'];
					    $ci[$i] = $answerco['ci'];
				    }
				    $dow = date("w", strtotime($yr."-".$mes."-".$i));
				    ?>
				    <th><?php echo $day_esp[$dow]." ".$i; ?></th>
	<?php } ?>
			    <th>TOTAL</th>
			    <th>QUIN.1</th>
			    <th>QUIN.2</th>
			</tr>
			<tr><td class="heavy">SALIDOS</td>
			    <?php
			    $sumco = 0;
			    for ($i = 1; $i <= $dhoy; $i++) {
				    ?>
				    <td class="light"><?php if ($co[$i] != 0) {
					    echo $co[$i];
				    } ?></td>
				    <?php
				    $sumco		 = $sumco + $co[$i];
				    $tsumco[$i]	 = $tsumco[$i] + $co[$i];
				    ?>
			    <?php }
			    ?>
			    <td class="heavy"><?php echo $sumco; ?></td>
			<tr><td class="heavy">RECIBIDOS</td>
			    <?php
			    $sumci = 0;
			    for ($i = 1; $i <= $dhoy; $i++) {
				    ?>
				    <td class="light"><?php if ($ci[$i] != 0) {
			    echo $ci[$i];
		    } ?></td>
				    <?php
				    $sumci		 = $sumci + $ci[$i];
				    $tsumci[$i]	 = $tsumci[$i] + $ci[$i];
				    ?>
			    <?php }
			    ?>
			    <td class="heavy"><?php echo $sumci; ?></td>
			</tr>
			<tr><td class="heavy">VISITAS</td>
				<?php
			    $sumgt = 0;
			    for ($i = 1; $i <= $dhoy; $i++) {
				    ?>
				    <td class="light<?php if ($tlla[$i] == 0) {
			    echo ' zeros';
		    } ?>">
				    <?php echo $tlla[$i]; ?></td>
				    <?php
				    $sumgt		 = $sumgt + $tlla[$i];
				    $tsumgt[$i]	 = $tsumgt[$i] + $tlla[$i];
				    if ($i < 16) {
					    $sumgt1		 = $sumgt1 + $tlla[$i];
					    $tsumgt1[$i]	 = $tsumgt1[$i] + $tlla[$i];
				    }
				    if ($i > 15) {
					    $sumgt2		 = $sumgt2 + $tlla[$i];
					    $tsumgt2[$i]	 = $tsumgt2[$i] + $tlla[$i];
				    }
				    ?>
			    <?php }
			    ?>
			    <td class="heavy"><?php echo $sumgt; ?></td>
			    <td class="heavy"><?php echo $sumgt1; ?></td>
			    <td class="heavy"><?php echo $sumgt2; ?></td>
			</tr>
			<tr><td class="heavy">CONTACTOS</td>
			    <?php
			    $sumg = 0;
			    for ($i = 1; $i <= $dhoy; $i++) {
				    ?>
				    <td class="light<?php if ($lla[$i] == 0) {
			    echo ' zeros';
		    } ?>">
				    <?php echo $lla[$i]; ?></td>
				    <?php
				    $sumg		 = $sumg + $lla[$i];
				    $tsumg[$i]	 = $tsumg[$i] + $lla[$i];
				    ?>
	<?php }
	?>
			    <td class="heavy"><?php echo $sumg; ?></td>
			</tr>
			<tr><td class="heavy">PROMESAS</td>
			    <?php
			    $sumpp = 0;
			    for ($i = 1; $i <= $dhoy; $i++) {
				    ?>
				    <td class="light<?php if ($prom[$i] == 0) {
			    echo ' zeros';
		    } ?>">
					<a href='<?php echo strtolower('pdh.php?capt='.$capt.'&i='.$prom[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i); ?>'>
				    <?php echo $prom[$i]; ?></a></td>
				    <?php
				    $sumpp		 = $sumpp + $prom[$i];
				    $tsumpp[$i]	 = $tsumpp[$i] + $prom[$i];
				    ?>
			    <?php }
			    ?>
			    <td class="heavy"><?php echo $sumpp; ?></td>
			</tr>
			<tr><td class="heavy">PAGOS</td>
	<?php
	$sump = 0;
	for ($i = 1; $i <= $dhoy; $i++) {
		?>
				    <td class="light<?php if ($pag[$i] == 0) {
			    echo ' zeros';
		    } ?>"><?php echo $pag[$i]; ?></td>
				    <?php
				    $sump		 = $sump + $pag[$i];
				    $tsump[$i]	 = $tsump[$i] + $pag[$i];
				    ?>
			    <?php }
			    ?>
			    <td class="heavy"><?php echo $sumw; ?></td>
			</tr>
			<tr><td class="heavy">D&Iacute;AS LABORADOS</td>
			    <?php
			    $sumw = 0;
			    for ($i = 1; $i <= $dhoy; $i++) {
				    $work = 0;
				    if ($tlla[$i] > 5) {
					    $work = 0.5;
				    }
				    if ($tlla[$i] > 9) {
					    $work = 1;
				    }
				    ?>
				    <td class="light"><?php echo $work; ?></td>
				    <?php
				    $sumw		 = $sumw + $work;
				    $tsumw[$i]	 = $tsumw[$i] + $work;
				    ?>
			    <?php }
			    ?>
			    <td class="heavy"><?php echo $sumw; ?></td>
			    <td class="heavy"><?php echo number_format($sumgt1 / ($expw1 + 0.0001) * 100,
			0).'%'; ?></td>
			    <td class="heavy"><?php echo number_format($sumgt2 / ($expw2 + 0.0001) * 100,
			0).'%'; ?></td>
			</tr>
			<tr style="height:2em"></tr>
<?php }
?>
		<tr>
		    <th>TOTAL</th>
		    <?php
		    $ttsumt	 = 0;
		    $ttsumb	 = 0;
		    $ttsumg	 = 0;
		    $ttsumco = 0;
		    $ttsumci = 0;
		    $ttsumgt = 0;
		    $ttsumpp = 0;
		    $ttsump	 = 0;
		    $ttsumw	 = 0;
		    for ($i = 1; $i <= $dhoy; $i++) {
			    $dow = date("w", strtotime($yr."-".$mes."-".$i));
			    ?>
			    <th><?php echo $day_esp[$dow]." ".$i; ?></th>
		    <?php } ?>
		    <th>TOTAL</th>
		</tr>
		<tr><td class="heavy">ENVIADOS</td>
		    <?php
		    for ($i = 1; $i <= $dhoy; $i++) {
			    ?>
			    <td class="light"><?php echo $tsumco[$i]; ?></td>
			    <?php
			    $ttsumco = $ttsumco + $tsumco[$i];
			    ?>
		    <?php }
		    ?>
		    <td class="heavy"><?php echo $ttsumco; ?></td>
		</tr>
		<tr><td class="heavy">RECIBIDOS</td>
		    <?php
		    for ($i = 1; $i <= $dhoy; $i++) {
			    ?>
			    <td class="light"><?php echo $tsumci[$i]; ?></td>
			    <?php
			    $ttsumci = $ttsumci + $tsumci[$i];
			    ?>
		    <?php }
		    ?>
		    <td class="heavy"><?php echo $ttsumci; ?></td>
		</tr>
		<tr><td class="heavy">VISITAS</td>
		    <?php
		    for ($i = 1; $i <= $dhoy; $i++) {
			    ?>
			    <td class="light"><?php echo $tsumgt[$i]; ?></td>
			    <?php
			    $ttsumgt = $ttsumgt + $tsumgt[$i];
			    ?>
		    <?php }
		    ?>
		    <td class="heavy"><?php echo $ttsumgt; ?></td>
		</tr>
		<tr><td class="heavy">CONTACTOS</td>
		    <?php
		    for ($i = 1; $i <= $dhoy; $i++) {
			    ?>
			    <td class="light"><?php echo $tsumg[$i]; ?></td>
			    <?php
			    $ttsumg = $ttsumg + $tsumg[$i];
			    ?>
		    <?php }
		    ?>
		    <td class="heavy"><?php echo $ttsumg; ?></td>
		</tr>
		<tr><td class="heavy">PROMESAS</td>
		    <?php
		    for ($i = 1; $i <= $dhoy; $i++) {
			    ?>
			    <td class="light"><?php echo $tsumpp[$i]; ?></td>
			    <?php
			    $ttsumpp = $ttsumpp + $tsumpp[$i];
			    ?>
		    <?php }
		    ?>
		    <td class="heavy"><?php echo $ttsumpp; ?></td>
		</tr>
		<tr><td class="heavy">PAGOS</td>
		    <?php
		    for ($i = 1; $i <= $dhoy; $i++) {
			    ?>
			    <td class="light"><?php echo $tsump[$i]; ?></td>
	<?php
	$ttsump = $ttsump + $tsump[$i];
	?>
<?php }
?>
		    <td class="heavy"><?php echo $ttsump; ?></td>
		</tr>
		<tr><td class="heavy">D&Iacute;AS TRABAJADOS</td>
<?php
for ($i = 1; $i <= $dhoy; $i++) {
	?>
			    <td class="light"><?php echo $tsumw[$i]; ?></td>
	<?php
	$ttsumw = $ttsumw + $tsumw[$i];
	?>
<?php }
?>
		    <td class="heavy"><?php echo $ttsumw; ?></td>
		</tr>
	</table>
    </body>
</html>
