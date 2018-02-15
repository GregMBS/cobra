<?php
$day_esp         = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
use cobra_salsa\PdoClass;
use cobra_salsa\PerfmesClass;
use cobra_salsa\PerfmesAllClass;
$pdc              = new PdoClass();
$pdo             = $pdc->dbConnectAdmin();
$pc              = new PerfmesClass($pdo);
$pac             = new PerfmesAllClass($pdo);
$yr              = date('Y', strtotime('last day of previous month'));
$mes             = date('m', strtotime('last day of previous month'));
$dhoy            = date('d', strtotime('last day of previous month'));
$hoy             = date('Y-m-d', strtotime('last day of previous month'));
$capt            = filter_input(INPUT_GET, 'capt');
$dst             = '';
$hours_all       = array_fill(1, $dhoy, 0);
$gestiones_all   = array_fill(1, $dhoy, 0);
$contactos_all   = array_fill(1, $dhoy, 0);
$nocontactos_all = array_fill(1, $dhoy, 0);
$promesas_all    = array_fill(1, $dhoy, 0);
$pagos_all       = array_fill(1, $dhoy, 0);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Horarios mes anterior</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr:hover {background-color: #ffff00;}
            .heavy {font-weight:bold;font-size:10pt;}
            .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
            .light {text-align:right;}
            .zeros {color:red;}
        </style>
    </head>
    <body>
        <h2>HORARIOS</h2>
        <div>
            <?php
            $resultnom       = $pc->listGestores();
            foreach ($resultnom as $answernom) {
                $gestor = $answernom['c_cvge'];
                ?>
                <table class="ui-widget">
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        $tsumt[$i]   = 0;
                        $tsumb[$i]   = 0;
                        $tsumbn[$i]  = 0;
                        $tsumg[$i]   = 0;
                        $tsumgt[$i]  = 0;
                        $tsumct[$i]  = 0;
                        $tsumnct[$i] = 0;
                        $tsumpp[$i]  = 0;
                        $tsump[$i]   = 0;
                    }
                    ?>
                    <thead class="ui-widget-header">
                        <tr>
                            <th><a href='<?php echo strtolower('gestor.php?capt='.$capt.'&gestor='.$gestor); ?>'><?php echo $gestor; ?></a></th>
                            <?php
                            for ($i = 1; $i <= $dhoy; $i++) {
                                $start[$i] = ' ';
                                $stop[$i]  = ' ';
                                $diff[$i]  = 0;
                                $break[$i] = 0;
                                $bano[$i]  = 0;
                                $lla[$i]   = 0;
                                $tlla[$i]  = 0;
                                $prom[$i]  = 0;
                                $pag[$i]   = 0;
                                $lph[$i]   = 0;
                                $ct[$i]    = 0;
                                $nct[$i]   = 0;
                                $resultssd = $pc->getStartStopDiff($gestor, $i);
                                foreach ($resultssd as $answerssd) {
                                    $start[$i] = substr($answerssd['start'], 0,
                                        5);
                                    $stop[$i]  = substr($answerssd['stop'], 0, 5);
                                    $diff[$i]  = $answerssd['diff'];
                                }
                                $resultss = $pc->getCurrentMain($gestor, $i);
                                foreach ($resultss as $answerss) {
                                    $break[$i]   = 0;
                                    $resultbreak = $pc->getTiempoDiff($gestor,
                                        $i, 'break');
                                    foreach ($resultbreak as $answerpi) {
                                        $TIEMPO  = $answerpi['tiempo'];
                                        $DIFF    = $answerpi['diff'];
                                        $resultq = $pc->getNTPDiff($gestor, $i,
                                            $TIEMPO);
                                        if ($resultq) {
                                            foreach ($resultq as $answerq) {
                                                $DIFF = $answerq['diff'];
                                                $NTP  = $answerq['ntp'];
                                                $break[$i]+=$DIFF;
                                            }
                                        }
                                    }
                                    $bano[$i] = 0;
                                    $resultpo = $pc->getTiempoDiff($gestor, $i,
                                        'bano');
                                    foreach ($resultpo as $answerpo) {
                                        $TIEMPO  = $answerpo['tiempo'];
                                        $DIFF    = $answerpo['diff'];
                                        $resultq = $pc->getNTPDiff($gestor, $i,
                                            $TIEMPO);
                                        if ($resultq) {
                                            foreach ($resultq as $answerq) {
                                                $DIFF = $answerq['diff'];
                                                $NTP  = $answerq['ntp'];
                                                $bano[$i]+=$DIFF;
                                            }
                                        }
                                    }
                                    $lla[$i]  = $answerss['cuentas'];
                                    $tlla[$i] = $answerss['gestiones'];
                                    $ct[$i]   = $answerss['nocontactos'];
                                    $nct[$i]  = $answerss['contactos'];
                                    $prom[$i] = $answerss['promesas'];
                                    $lph[$i]  = $lla[$i] / ($diff[$i] + 1 / 3600);
                                    $sumg     = 0;
                                    $sumgt    = 0;
                                    $sumt     = 0;
                                    $sumb     = 0;
                                    $sumbn    = 0;
                                    $sumct    = 0;
                                    $sumnct   = 0;
                                    $sumpp    = 0;
                                    $sump     = 0;
                                    $resultp  = $pc->getPagos($gestor, $i);
                                    foreach ($resultp as $answerp) {
                                        $pag[$i] = $answerp['ct'];
                                    }
                                }
                                $dow = date("w", strtotime($yr."-".$mes."-".$i));
                                ?>
                                <th><?php echo $day_esp[$dow]." ".$i; ?></th>
                            <?php } ?>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <tr><td class="heavy">LOGIN</td>
                            <?php
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($start[$i] == '00:00') {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $start[$i]; ?></td>
                                <?php } ?>
                        </tr>
                        <tr><td class="heavy">LOGOUT</td>
                            <?php
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($stop[$i] == '00:00') {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $stop[$i]; ?></td>
                                    <?php
                                }
                                ?>
                        </tr>
                        <tr><td class="heavy">HORAS</td>
                            <?php
                            $sumt = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($diff[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php
                                        $hrs  = floor($diff[$i] / 3600);
                                        $mins = round(($diff[$i] - $hrs * 3600) / 60);
                                        echo $hrs.':'.sprintf("%02s", $mins);
                                        ?></td>
                                <?php
                                $sumt += $diff[$i];
                                $tsumt[$i] += $diff[$i];
                                $hours_all[$i] += $diff[$i];
                            }
                            ?>
                            <td class="heavy"><?php
                                $hrst  = floor($sumt / 3600);
                                $minst = round(($sumt - $hrs * 3600) / 60);
                                echo $hrst.':'.sprintf("%02s", $minst);
                                ?></td>
                        </tr>
                        <tr><td class="heavy">TIEMPO BREAK</td>
                            <?php
                            $sumb  = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($break[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php
                                        $hrs       = floor($break[$i] / 3600);
                                        $mins      = round(($break[$i] - $hrs * 3600)
                                            / 60);
                                        echo $hrs.':'.sprintf("%02s", $mins);
                                        ?></td>
                                <?php
                                $sumb      = $sumb + $break[$i];
                                $tsumb[$i] = $tsumb[$i] + $break[$i];
                            }
                            ?>
                            <td class="heavy"><?php
                                $hrsb  = floor($sumb / 3600);
                                $minsb = round(($sumb - $hrs * 3600) / 60);
                                echo $hrsb.':'.sprintf("%02s", $minsb);
                                ?></td>
                        </tr>
                        <tr><td class="heavy">TIEMPO BAÑO</td>
                            <?php
                            $sumbn = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($bano[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php
                                        $hrs        = floor($bano[$i] / 3600);
                                        $mins       = round(($bano[$i] - $hrs * 3600)
                                            / 60);
                                        echo $hrs.':'.sprintf("%02s", $mins);
                                        ?></td>
                                <?php
                                $sumbn      = $sumbn + $bano[$i];
                                $tsumbn[$i] = $tsumbn[$i] + $bano[$i];
                            }
                            ?>
                            <td class="heavy"><?php
                                $hrs   = floor($sumbn / 3600);
                                $mins  = round(($sumbn - $hrs * 3600) / 60);
                                echo $hrs.':'.sprintf("%02s", $mins);
                                ?></td>
                        </tr>
                        <tr><td class="heavy">GESTIONES</td>
                            <?php
                            $sumgt = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($tlla[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>">
                                    <a href='<?php echo strtolower('ddh.php?capt='.$capt.'&i='.$tlla[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i); ?>'>
                                        <?php echo $tlla[$i]; ?></a></td>
                                <?php
                                $sumgt += $tlla[$i];
                                $tsumgt[$i] += $tlla[$i];
                                $gestiones_all[$i] += $tlla[$i];
                                ?>
                            <?php }
                            ?>
                            <td class="heavy"><?php echo $sumgt; ?></td>
                        </tr>
                        <tr><td class="heavy">CUENTAS</td>
                            <?php
                            $sumg = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($lla[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>">
                                    <a href='<?php echo strtolower('ddh.php?capt='.$capt.'&i='.$lla[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i); ?>'>
                                        <?php echo $lla[$i]; ?></a></td>
                                <?php
                            }
                            $resultsumg = $pc->countAccounts($gestor);
                            foreach ($resultsumg as $answersumg) {
                                $sumg = $answersumg['ct'];
                            }
                            ?>
                            <td class="heavy"><?php echo $sumg; ?></td>
                        </tr>
                        <tr><td class="heavy">CONTACTOS</td>
                            <?php
                            $sumct = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($ct[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $ct[$i]; ?></td>
                                    <?php
                                    $sumct += $ct[$i];
                                    $tsumct[$i] += $ct[$i];
                                    $contactos_all[$i] += $ct[$i];
                                    ?>
                                <?php }
                                ?>
                            <td class="heavy"><?php echo $sumct; ?></td>
                        </tr>
                        <tr><td class="heavy">NO CONTACTOS</td>
                            <?php
                            $sumnct = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($nct[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $nct[$i]; ?></td>
                                    <?php
                                    $sumnct += $nct[$i];
                                    $tsumnct[$i] += $nct[$i];
                                    $nocontactos_all[$i] += $nct[$i];
                                    ?>
                                <?php }
                                ?>
                            <td class="heavy"><?php echo $sumnct; ?></td>
                        </tr>
                        <tr><td class="heavy">PROMESAS</td>
                            <?php
                            $sumpp = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($prom[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>">
                                    <a href='<?php echo strtolower('pdh.php?capt='.$capt.'&i='.$prom[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i); ?>'>
                                        <?php echo $prom[$i]; ?></a></td>
                                <?php
                                $sumpp += $prom[$i];
                                $tsumpp[$i] += $prom[$i];
                                $promesas_all[$i] += $prom[$i];
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
                                <td class="light<?php
                                if ($pag[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $pag[$i]; ?></td>
                                    <?php
                                    $sump      = $sump + $pag[$i];
                                    $tsump[$i] = $tsump[$i] + $pag[$i];
                                    $pagos_all[$i] += $pag[$i];
                                    ?>
                                <?php }
                                ?>
                            <td class="heavy"><?php echo $sump; ?></td>
                        </tr>
                        <tr style="height:2em"></tr>
                    </tbody>
                </table>
            <?php } ?>
            <table class="ui-widget">
                <thead class="ui-widget-header">
                    <tr>
                        <th>TOTAL</th>
                        <?php
                        for ($i = 1; $i <= $dhoy; $i++) {
                            $dow = date("w", strtotime($yr."-".$mes."-".$i));
                            ?>
                            <th><?php echo $day_esp[$dow]." ".$i; ?></th>
                        <?php } ?>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <tr><td class="heavy">HORAS</td>
                        <?php
                        $hours_total = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php
                                echo $pc->convertTime($hours_all[$i] / 3600);
                                ?></td>
                            <?php
                            $hours_total += $hours_all[$i] / 3600;
                        }
                        ?>
                        <td class="heavy"><?php echo $pc->convertTime($hours_total); ?></td>
                    </tr>
                    <tr><td class="heavy">GESTIONES</td>
                        <?php
                        $gestiones_total = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php echo $gestiones_all[$i]; ?></td>
                            <?php
                            $gestiones_total += $gestiones_all[$i];
                        }
                        ?>
                        <td class="heavy"><?php echo $gestiones_total; ?></td>
                    </tr>
                    <tr><td class="heavy">CUENTAS</td>
                        <?php
                        for ($i = 1; $i <= $dhoy; $i++) {
                            $cuentas_all   = $pac->countAccountsPerDay($i);
                            ?>
                            <td class="light"><?php echo $cuentas_all; ?></td>
                            <?php
                            $cuentas_total = $pac->countAccounts();
                        }
                        ?>
                        <td class="heavy"><?php echo $cuentas_total; ?></td>
                    </tr>
                    <tr><td class="heavy">CONTACTOS</td>
                        <?php
                        $contactos_total = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php echo $contactos_all[$i]; ?></td>
                            <?php
                            $contactos_total += $contactos_all[$i];
                        }
                        ?>
                        <td class="heavy"><?php echo $contactos_total; ?></td>
                    </tr>
                    <tr><td class="heavy">NO CONTACTOS</td>
                        <?php
                        $nocontactos_total = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php echo $nocontactos_all[$i]; ?></td>
                            <?php
                            $nocontactos_total += $nocontactos_all[$i];
                        }
                        ?>
                        <td class="heavy"><?php echo $nocontactos_total; ?></td>
                    </tr>
                    <tr><td class="heavy">PROMESAS</td>
                        <?php
                        $promesas_total = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php echo $promesas_all[$i]; ?></td>
                            <?php
                            $promesas_total += $promesas_all[$i];
                        }
                        ?>
                        <td class="heavy"><?php echo $promesas_total; ?></td>
                    </tr>
                    <tr><td class="heavy">PAGOS</td>
                        <?php
                        $pagos_total = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php echo $pagos_all[$i]; ?></td>
                            <?php
                            $pagos_total += $pagos_all[$i];
                        }
                        ?>
                        <td class="heavy"><?php echo $pagos_total; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </body>
</html>
