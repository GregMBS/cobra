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
    <form action='/horarios_clean2.php' method='get'>
        <label for="selectGestor">Gestor: </label>
        <select name='gestor' id="selectGestor">
            <?php

            if (!empty($gestores)) {
                foreach ($gestores as $nombres) {
                    $nombre = $nombres['c_cvge'];
                    ?>
                    <option value='<?php echo $nombre; ?>'><?php echo $nombre; ?></option>
                <?php }
            } ?>
            <option value='total'>total</option>
        </select>
        <input type='hidden' name='capt' value='<?php if (isset($capt)) {
            echo $capt;
        } ?>'>'
        <input type='submit' name='go' value='gestor'>'
    </form>
</div>
<?php /**
 * @param $hc
 * @param $gestor
 * @param int $i
 * @param array $start
 * @param array $stop
 * @param array $diff
 * @param array $break
 * @param array $bano
 * @param array $lla
 * @param array $tlla
 * @param array $ct
 * @param array $nct
 * @param array $prom
 * @param array $lph
 * @param array $pag
 * @param string $yr
 * @param string $mes
 * @return array
 */
function prepareSheet($hc, $gestor, int $i, array $start, array $stop, array $diff, array $break, array $bano, array $lla, array $tlla, array $ct, array $nct, array $prom, array $lph, array $pag, string $yr, string $mes): array
{
    $resultssd = $hc->getStartStopDiff($gestor, $i);
    foreach ($resultssd as $answerssd) {
        $start[$i] = substr($answerssd['start'], 0, 5);
        $stop[$i] = substr($answerssd['stop'], 0, 5);
        $diff[$i] = $answerssd['diff'];
    }
    $resultss = $hc->getCurrentMain($gestor, $i);
    foreach ($resultss as $answerss) {
        $resultpo = $hc->getTiempoDiff($gestor, $i, 'bano');
        foreach ($resultpo as $answerpo) {
            $TIEMPO = $answerpo['tiempo'];
            $resultNTP = $hc->getNTPDiff($gestor, $i, $TIEMPO);
            if ($resultNTP) {
                foreach ($resultNTP as $NTP) {
                    $DIFF = $NTP['diff'];
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
        $sumt = 0;
        $sumb = 0;
        $sumbn = 0;
        $sumpp = 0;
        $sump = 0;
        $resultp = $hc->getPagos($gestor, $i);
        foreach ($resultp as $answerp) {
            $pag[$i] = $answerp['ct'];
        }
    }
    $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
    return array($start, $stop, $diff, $break, $bano, $lla, $tlla, $ct, $nct, $prom, $sumg, $sumt, $sumb, $sumbn, $sumpp, $sump, $pag, $dow);
}

$go = filter_input(INPUT_GET, 'go');
if ($go == 'gestor') { ?>
<div>
    <table class="ui-widget">
        <thead class="ui-widget-header">
        <tr>
            <?php
            if (isset($gestor)) {
            ?>
            <th>
                <a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $gestor . '&c_cvge=' . $gestor); ?>'><?php echo $gestor; ?></a>
            </th>
            <?php
            }
            $day_esp = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
            $start = array_fill(1, $dhoy, ' ');
            $stop = array_fill(1, $dhoy, ' ');
            $diff = array_fill(1, $dhoy, 0);
            $break = array_fill(1, $dhoy, 0);
            $bano = array_fill(1, $dhoy, 0);
            $lla = array_fill(1, $dhoy, 0);
            $tlla = array_fill(1, $dhoy, 0);
            $prom = array_fill(1, $dhoy, 0);
            $pag = array_fill(1, $dhoy, 0);
            $lph = array_fill(1, $dhoy, 0);
            $ct = array_fill(1, $dhoy, 0);
            $nct = array_fill(1, $dhoy, 0);
            for ($i = 1; $i <= $dhoy; $i++) {
                list($start, $stop, $diff, $break, $bano, $lla, $tlla, $ct, $nct, $prom, $sumg, $sumt, $sumb, $sumbn, $sumpp, $sump, $pag, $dow) = prepareSheet($hc, $gestor, $i, $start, $stop, $diff, $break, $bano, $lla, $tlla, $ct, $nct, $prom, $lph, $pag, $yr, $mes);
                ?>
                <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
            <?php } ?>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody class="ui-widget-content">
        <?php
        echo $tv->timeRow('LOGIN', $start);
        echo $tv->timeRow('LOGOUT', $stop);
        ?>

        <tr>
            <td class="heavy">TOTA HORAS</td>
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
                $sumt = $sumt + $diff[$i];
                $hours_all[$i] = $hours_all[$i] + $diff[$i];
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
                    $mins = round(($break[$i] - $hrs * 3600) / 60);
                    echo $hrs . ':' . sprintf("%02s", $mins);
                    ?></td>
                <?php
                $sumb = $sumb + $break[$i];
                $breaks_all[$i] += $break[$i];
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
                    $mins = round(($bano[$i] - $hrs * 3600) / 60);
                    echo $hrs . ':' . sprintf("%02s", $mins);
                    ?></td>
                <?php
                $sumbn = $sumbn + $bano[$i];
                $bano_all[$i] += $bano[$i];
            }
            ?>
            <td class="heavy"><?php
                $hrs = floor($sumbn / 3600);
                $mins = round(($sumbn - $hrs * 3600) / 60);
                echo $hrs . ':' . sprintf("%02s", $mins);
                ?></td>
        </tr>
        <?php
        echo $tv->countRow('TOTAL GESTIONES', $tlla, $capt, $gestor, $gestiones_all, 'ddh');
        ?>
        <tr>
            <td class="heavy">TOTAL CUENTAS</td>
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
        <?php
        echo $tv->countRow('CONTACTOS', $ct, $capt, $gestor, $contactos_all, 'ddh');
        echo $tv->countRow('NO CONTACTOS', $nct, $capt, $gestor, $nocontactos_all, 'ddh');
        ?>
        <tr>
            <td class="heavy">PROMESAS</td>
            <?php
            $sumpp = 0;
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
                $sumpp = $sumpp + $prom[$i];
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
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($pag[$i] == 0) {
                    echo ' zeros';
                }
                ?>"><?php echo $pag[$i]; ?></td>
                <?php
                $sump = $sump + $pag[$i];
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
</div>
</body>
</html>

