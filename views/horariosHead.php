<th>
    <a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $gestor . '&c_cvge=' . $gestor); ?>'><?php echo $gestor; ?></a></th>
<?php
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
$blanks = array_fill(1, $dhoy, ' ');
$zeros = array_fill(1, $dhoy, 0);
$start = $blanks;
$stop = $blanks;
$diff = $zeros;
$break = $zeros;
$bano = $zeros;
$lla = $zeros;
$tlla = $zeros;
$tsumt = $zeros;
$tsumb = $zeros;
$tsumbn = $zeros;
$tsumgt = $zeros;
$tsumct = $zeros;
$ct = $zeros;
for ($i = 1; $i <= $dhoy; $i++) {
    $prom[$i] = 0;
    $pag[$i] = 0;
    $lph[$i] = 0;
    $ct[$i] = 0;
    $nct[$i] = 0;
    $resultssd = $hc->getStartStopDiff($gestor, $i);
    foreach ($resultssd as $answerssd) {
        $start[$i] = substr($answerssd['start'], 0, 5);
        $stop[$i] = substr($answerssd['stop'], 0, 5);
        $diff[$i] = $answerssd['diff'];
    }
    $resultss = $hc->getCurrentMain($gestor, $i);
    foreach ($resultss as $answerss) {
        $break[$i] = 0;
        $resultbreak = $hc->getTiempoDiff($gestor, $i, 'break');
        foreach ($resultbreak as $answerpi) {
            $TIEMPO = $answerpi['tiempo'];
            $DIFF = $answerpi['diff'];
            $resultq = $hc->getNTPDiff($gestor, $i, $TIEMPO);
            if ($resultq) {
                foreach ($resultq as $answerq) {
                    $DIFF = $answerq['diff'];
                    $NTP = $answerq['ntp'];
                    $break[$i] += $DIFF;
                }
            }
        }
        $bano[$i] = 0;
        $resultpo = $hc->getTiempoDiff($gestor, $i, 'bano');
        foreach ($resultpo as $answerpo) {
            $TIEMPO = $answerpo['tiempo'];
            $DIFF = $answerpo['diff'];
            $resultq = $hc->getNTPDiff($gestor, $i, $TIEMPO);
            if ($resultq) {
                foreach ($resultq as $answerq) {
                    $DIFF = $answerq['diff'];
                    $NTP = $answerq['ntp'];
                    $bano[$i] += $DIFF;
                }
            }
        }
        $lla[$i] = $answerss['cuentas'];
        $tlla[$i] = $answerss['gestiones'];
        $ct[$i] = $answerss['nocontactos'];
        $nct[$i] = $answerss['contactos'];
        $prom[$i] = $answerss['promesas'];
        $lph[$i] = $lla[$i] / ($diff[$i] + 1 / 3600);
        $sumg = 0;
        $sumgt = 0;
        $sumt = 0;
        $sumb = 0;
        $sumbn = 0;
        $sumct = 0;
        $sumnct = 0;
        $sumpp = 0;
        $sump = 0;
        $resultp = $hc->getPagos($gestor, $i);
        foreach ($resultp as $answerp) {
            $pag[$i] = $answerp['ct'];
        }
    }
    $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
    ?>
    <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
<?php } ?>
<th>TOTAL</th>
