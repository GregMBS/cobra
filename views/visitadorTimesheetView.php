<!DOCTYPE html>
<html lang="es">
<head>
    <title>Visitas del Mes Actual</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="/css/timesheet.css" />
</head>
<body>
<h2>VISITAS DEL MES ACTUAL</h2>
<table>
<?php
    $to = $hc->visitPrep($dhoy);
    $resultnom = $hc->listVisitadores();
    $zeros = array_fill(1, $dhoy, 0);
    foreach ($resultnom

    as $answernom) {
    $gestor = $answernom['iniciales'];
    $visitador = $answernom['completo'];
    $c_visit = $answernom['iniciales'];
    ?>
    <thead>
    <tr>
        <th><?php echo $visitador; ?></th>
        <?php
        $accounts = $zeros;
        $calls = $zeros;
        $promises = $zeros;
        $payments = $zeros;
        for ($i = 1; $i <= $dhoy; $i++) {

            $main = $hc->getVisitadorMain($c_visit, $i);
            foreach ($main as $mainRow) {
                $accounts[$i] = $mainRow['cuentas'];
                $calls[$i] = $mainRow['gestiones'];
                $promises[$i] = $mainRow['promesas'];
                $sumg = 0;
                $sumgt = 0;
                $sumgt1 = 0;
                $sumgt2 = 0;
                $sumt = 0;
                $sumb = 0;
                $sumpp = 0;
                $sump = 0;
                $sumw = 0;
                $pay = $hc->getVisitadorPagos($c_visit, $i);
                foreach ($pay as $payRow) {
                    $payments[$i] = $payRow['ct'];
                }
            }

            $assignments = $hc->countVisitsAssigned($c_visit, $i);
            foreach ($assignments as $assign) {
                if (is_array($assign)) {
                    $co[$i] = $assign['co'];
                    $ci[$i] = $assign['ci'];
                } else {
                    $co[$i] = 0;
                    $ci[$i] = 0;
                }
            }
            $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
            ?>
            <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
        <?php } ?>
        <th>TOTAL</th>
        <th>QUIN.1</th>
        <th>QUIN.2</th>
    </tr>
    <tr>
        <td class="heavy">SALIDOS</td>
        <?php
        $sumco = 0;
        $co = array_fill(1, $dhoy, 0);
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php
                if ($co[$i] != 0) {
                    echo $co[$i];
                }
                ?></td>
            <?php
            $sumco = $sumco + $co[$i];
            $to->tsumco[$i] = $to->tsumco[$i] + $co[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $sumco; ?></td>
    <tr>
        <td class="heavy">RECIBIDOS</td>
        <?php
        $sumci = 0;
        $ci = array_fill(1, $dhoy, 0);
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php
                if ($ci[$i] != 0) {
                    echo $ci[$i];
                }
                ?></td>
            <?php
            $sumci = $sumci + $ci[$i];
            $to->tsumci[$i] = $to->tsumci[$i] + $ci[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $sumci; ?></td>
    </tr>
    <tr>
        <td class="heavy">VISITAS</td>
        <?php
        $sumgt = 0;
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light<?php
            if ($calls[$i] == 0) {
                echo ' zeros';
            }
            ?>">
                <?php echo $calls[$i]; ?></td>
            <?php
            $sumgt = $sumgt + $calls[$i];
            $to->tsumgt[$i] = $to->tsumgt[$i] + $calls[$i];
            if ($i < 16) {
                $sumgt1 = $sumgt1 + $calls[$i];
                $to->tsumgt1[$i] = $to->tsumgt1[$i] + $calls[$i];
            }
            if ($i > 15) {
                $sumgt2 = $sumgt2 + $calls[$i];
                $to->tsumgt2[$i] = $to->tsumgt2[$i] + $calls[$i];
            }
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $sumgt; ?></td>
        <td class="heavy"><?php echo $sumgt1; ?></td>
        <td class="heavy"><?php echo $sumgt2; ?></td>
    </tr>
    <tr>
        <td class="heavy">CONTACTOS</td>
        <?php
        $sumg = 0;
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light<?php
            if ($accounts[$i] == 0) {
                echo ' zeros';
            }
            ?>">
                <?php echo $accounts[$i]; ?></td>
            <?php
            $sumg = $sumg + $accounts[$i];
            $to->tsumg[$i] = $to->tsumg[$i] + $accounts[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $sumg; ?></td>
    </tr>
    <tr>
        <td class="heavy">PROMESAS</td>
        <?php
        $sumpp = 0;
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light<?php
            if ($promises[$i] == 0) {
                echo ' zeros';
            }
            ?>">
                <a href='<?php echo strtolower('pdh.php?capt=' . $capt . '&i=' . $promises[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                    <?php echo $promises[$i]; ?></a></td>
            <?php
            $sumpp = $sumpp + $promises[$i];
            $to->tsumpp[$i] = $to->tsumpp[$i] + $promises[$i];
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
            if ($payments[$i] == 0) {
                echo ' zeros';
            }
            ?>"><?php echo $payments[$i]; ?></td>
            <?php
            $sump = $sump + $payments[$i];
            $to->tsump[$i] = $to->tsump[$i] + $payments[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $sumw; ?></td>
    </tr>
    <tr>
        <td class="heavy">D&Iacute;AS LABORADOS</td>
        <?php
        $sumw = 0;
        for ($i = 1; $i <= $dhoy; $i++) {
            $work = 0;
            if ($calls[$i] > 5) {
                $work = 0.5;
            }
            if ($calls[$i] > 9) {
                $work = 1;
            }
            ?>
            <td class="light"><?php echo $work; ?></td>
            <?php
            $sumw = $sumw + $work;
            $to->tsumw[$i] = $to->tsumw[$i] + $work;
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $sumw; ?></td>
    </tr>
    <tr style="height:2em"></tr>
    <?php }
    ?>
    <tr>
        <th>TOTAL</th>
        <?php
        $ttsumt = 0;
        $ttsumb = 0;
        $ttsumg = 0;
        $ttsumco = 0;
        $ttsumci = 0;
        $ttsumgt = 0;
        $ttsumpp = 0;
        $ttsump = 0;
        $ttsumw = 0;
        for ($i = 1; $i <= $dhoy; $i++) {
            $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
            ?>
            <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
        <?php } ?>
        <th>TOTAL</th>
    </tr>
    <tr>
        <td class="heavy">ENVIADOS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsumco[$i]; ?></td>
            <?php
            $ttsumco = $ttsumco + $to->tsumco[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsumco; ?></td>
    </tr>
    <tr>
        <td class="heavy">RECIBIDOS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsumci[$i]; ?></td>
            <?php
            $ttsumci = $ttsumci + $to->tsumci[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsumci; ?></td>
    </tr>
    <tr>
        <td class="heavy">VISITAS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsumgt[$i]; ?></td>
            <?php
            $ttsumgt = $ttsumgt + $to->tsumgt[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsumgt; ?></td>
    </tr>
    <tr>
        <td class="heavy">CONTACTOS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsumg[$i]; ?></td>
            <?php
            $ttsumg = $ttsumg + $to->tsumg[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsumg; ?></td>
    </tr>
    <tr>
        <td class="heavy">PROMESAS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsumpp[$i]; ?></td>
            <?php
            $ttsumpp = $ttsumpp + $to->tsumpp[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsumpp; ?></td>
    </tr>
    <tr>
        <td class="heavy">PAGOS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsump[$i]; ?></td>
            <?php
            $ttsump = $ttsump + $to->tsump[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsump; ?></td>
    </tr>
    <tr>
        <td class="heavy">D&Iacute;AS TRABAJADOS</td>
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            ?>
            <td class="light"><?php echo $to->tsumw[$i]; ?></td>
            <?php
            $ttsumw = $ttsumw + $to->tsumw[$i];
            ?>
        <?php }
        ?>
        <td class="heavy"><?php echo $ttsumw; ?></td>
    </tr>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>
