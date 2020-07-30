<!DOCTYPE html>
<html lang="es">
<head>
    <title>Horarios</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    <style type="text/css">
        tr:hover {
            background-color: #ffff00;
        }

        .heavy {
            font-weight: bold;
            font-size: 10pt;
        }

        .heavytot {
            font-weight: bold;
            font-size: 10pt;
            text-align: right;
        }

        .light {
            text-align: right;
        }

        .zeros {
            color: red;
        }
    </style>
</head>
<body>
<h2>HORARIOS</h2>
<div>
    <?php

    use cobra_salsa\TimesheetDayObject;

    require_once __DIR__ . '/../classes/TimesheetDayObject.php';

    $to = $hc->visitPrep($dhoy);
    foreach ($gestores as $answernom) {
        $gestor = $answernom['c_cvge'];
        ?>
        <table class="ui-widget">
            <thead class="ui-widget-header">
            <tr>
                <th>
                    <a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $gestor); ?>'><?php echo $gestor; ?></a>
                </th>
                <?php
                for ($i = 1; $i <= $dhoy; $i++) {
                    $day = new TimesheetDayObject();
                    $startStopDiff = $hc->getStartStopDiff($gestor, $i);
                    foreach ($startStopDiff as $ssd) {
                        if (isset($ssd['start'])) {
                            $day->start = substr($ssd['start'], 0,
                                5);
                        }
                        if (isset($ssd['stop'])) {
                            $day->stop = substr($ssd['stop'], 0, 5);
                        }
                        if (isset($ssd['diff'])) {
                            $day->diff = $ssd['diff'];
                        }
                    }
                    $startStop = $hc->getCurrentMain($gestor, $i);
                    foreach ($startStop as $ss) {
                        $resultBreak = $hc->getTiempoDiff($gestor, $i, 'break');
                        foreach ($resultBreak as $breaks) {
                            $TIEMPO = $breaks['tiempo'];
                            $DIFF = $breaks['diff'];
                            $ntp = $hc->getNTPDiff($gestor, $i, $TIEMPO);
                            if ($ntp) {
                                foreach ($ntp as $ntpDiff) {
                                    $DIFF = $ntpDiff['diff'];
                                    $NTP = $ntpDiff['ntp'];
                                    $day->break += $DIFF;
                                }
                            }
                        }
                        $resultBano = $hc->getTiempoDiff($gestor, $i, 'bano');
                        foreach ($resultBano as $banos) {
                            $TIEMPO = $banos['tiempo'];
                            $DIFF = $banos['diff'];
                            $ntp = $hc->getNTPDiff($gestor, $i,
                                $TIEMPO);
                            if ($ntp) {
                                foreach ($ntp as $ntpDiff) {
                                    $DIFF = $ntpDiff['diff'];
                                    $NTP = $ntpDiff['ntp'];
                                    $day->bano += $DIFF;
                                }
                            }
                        }
                        $day->lla = $ss['cuentas'];
                        $day->tlla = $ss['gestiones'];
                        $day->ct = $ss['nocontactos'];
                        $day->nct = $ss['contactos'];
                        $day->prom = $ss['promesas'];
                        $day->lph = $day->lla / ($day->diff + 1 / 3600);
                        $resultPagos = $hc->getPagos($gestor, $i);
                        foreach ($resultPagos as $pagos) {
                            $day->pag = $pagos['ct'];
                        }
                    }
                    $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
                    ?>
                    <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
                <?php } ?>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody class="ui-widget-content">
            <?php
            echo $tv->timeRow('LOGIN', $day->start);
            echo $tv->timeRow('LOGOUT', $day->stop);
            ?>
            <tr>
                <td class="heavy">HORAS</td>
                <?php
                $sumt = 0;
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($diff[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>"><?php
                        $hrs = floor($diff[$i] / 3600);
                        $mins = round(($diff[$i] - $hrs * 3600) / 60);
                        echo $hrs . ':' . sprintf("%02s", $mins);
                        ?></td>
                    <?php
                    $sumt += $diff[$i];
                    $to->tsumt[$i] += $diff[$i];
                    $hours_all[$i] += $diff[$i];
                }
                ?>
                <td class="heavy"><?php
                    $hrst = floor($sumt / 3600);
                    $minst = round(($sumt - $hrs * 3600) / 60);
                    echo $hrst . ':' . sprintf("%02s", $minst);
                    ?></td>
            </tr>
            <tr>
                <td class="heavy">TIEMPO BREAK</td>
                <?php
                $sumb = 0;
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($break[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>"><?php
                        $hrs = floor($break[$i] / 3600);
                        $mins = round(($break[$i] - $hrs * 3600)
                            / 60);
                        echo $hrs . ':' . sprintf("%02s", $mins);
                        ?></td>
                    <?php
                    $sumb = $sumb + $break[$i];
                    $to->tsumb[$i] = $to->tsumb[$i] + $break[$i];
                }
                ?>
                <td class="heavy"><?php
                    $hrsb = floor($sumb / 3600);
                    $minsb = round(($sumb - $hrs * 3600) / 60);
                    echo $hrsb . ':' . sprintf("%02s", $minsb);
                    ?></td>
            </tr>
            <tr>
                <td class="heavy">TIEMPO BAÑO</td>
                <?php
                $sumbn = 0;
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($bano[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>"><?php
                        $hrs = floor($bano[$i] / 3600);
                        $mins = round(($bano[$i] - $hrs * 3600)
                            / 60);
                        echo $hrs . ':' . sprintf("%02s", $mins);
                        ?></td>
                    <?php
                    $sumbn = $sumbn + $bano[$i];
                    $to->tsumbn[$i] = $to->tsumbn[$i] + $bano[$i];
                }
                ?>
                <td class="heavy"><?php
                    $hrs = floor($sumbn / 3600);
                    $mins = round(($sumbn - $hrs * 3600) / 60);
                    echo $hrs . ':' . sprintf("%02s", $mins);
                    ?></td>
            </tr>
            <tr>
                <td class="heavy">GESTIONES</td>
                <?php
                $sumgt = 0;
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($tlla[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>">
                        <a href='<?php echo strtolower('ddh.php?capt=' . $capt . '&i=' . $tlla[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                            <?php echo $tlla[$i]; ?></a></td>
                    <?php
                    $sumgt += $tlla[$i];
                    $to->tsumgt[$i] += $tlla[$i];
                    $gestiones_all[$i] += $tlla[$i];
                    ?>
                <?php }
                ?>
                <td class="heavy"><?php echo $sumgt; ?></td>
            </tr>
            <tr>
                <td class="heavy">CUENTAS</td>
                <?php
                $sumg = 0;
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($lla[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>">
                        <a href='<?php echo strtolower('ddh.php?capt=' . $capt . '&i=' . $lla[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                            <?php echo $lla[$i]; ?></a></td>
                    <?php
                }
                $resultsumg = $hc->countAccounts($gestor);
                foreach ($resultsumg as $answersumg) {
                    $sumg = $answersumg['ct'];
                }
                ?>
                <td class="heavy"><?php echo $sumg; ?></td>
            </tr>
            <tr>
                <td class="heavy">CONTACTOS</td>
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
                    $to->tsumct[$i] += $ct[$i];
                    $contactos_all[$i] += $ct[$i];
                    ?>
                <?php }
                ?>
                <td class="heavy"><?php echo $sumct; ?></td>
            </tr>
            <tr>
                <td class="heavy">NO CONTACTOS</td>
                <?php
                $sumnct = 0;
                $nct = array_fill(1, $dhoy, 0);
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($nct[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>"><?php echo $nct[$i]; ?></td>
                    <?php
                    $sumnct += $nct[$i];
                    $to->tsumnct[$i] += $nct[$i];
                    $nocontactos_all[$i] += $nct[$i];
                    ?>
                <?php }
                ?>
                <td class="heavy"><?php echo $sumnct; ?></td>
            </tr>
            <tr>
                <td class="heavy">PROMESAS</td>
                <?php
                $sumpp = 0;
                $prom = array_fill(1, $dhoy, 0);
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($prom[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>">
                        <a href='<?php echo strtolower('pdh.php?capt=' . $capt . '&i=' . $prom[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                            <?php echo $prom[$i]; ?></a></td>
                    <?php
                    $sumpp += $prom[$i];
                    $to->tsumpp[$i] += $prom[$i];
                    $promesas_all[$i] += $prom[$i];
                    ?>
                <?php }
                ?>
                <td class="heavy"><?php echo $sumpp; ?></td>
            </tr>
            <tr>
                <td class="heavy">PAGOS</td>
                <?php
                $sump = 0;
                $pag = array_fill(1, $dhoy, 0);
                for ($i = 1; $i <= $dhoy; $i++) {
                    ?>
                    <td class="light<?php
                    if ($pag[$i] == 0) {
                        echo ' zeros';
                    }
                    ?>"><?php echo $pag[$i]; ?></td>
                    <?php
                    $sump = $sump + $pag[$i];
                    $to->tsump[$i] = $to->tsump[$i] + $pag[$i];
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
                $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
                ?>
                <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
            <?php } ?>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody class="ui-widget-content">
        <tr>
            <td class="heavy">HORAS</td>
            <?php
            $hours_total = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light"><?php
                    echo $hc->convertTime($hours_all[$i] / 3600);
                    ?></td>
                <?php
                $hours_total += $hours_all[$i] / 3600;
            }
            ?>
            <td class="heavy"><?php echo $hc->convertTime($hours_total); ?></td>
        </tr>
        <tr>
            <td class="heavy">GESTIONES</td>
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
        <tr>
            <td class="heavy">CUENTAS</td>
            <?php
            for ($i = 1; $i <= $dhoy; $i++) {
                $cuentas_all = $hac->countAccountsPerDay($i);
                ?>
                <td class="light"><?php echo $cuentas_all; ?></td>
                <?php
                $cuentas_total = $hac->countAccounts();
            }
            ?>
            <td class="heavy"><?php echo $cuentas_total; ?></td>
        </tr>
        <tr>
            <td class="heavy">CONTACTOS</td>
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
        <tr>
            <td class="heavy">NO CONTACTOS</td>
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
        <tr>
            <td class="heavy">PROMESAS</td>
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
        <tr>
            <td class="heavy">PAGOS</td>
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