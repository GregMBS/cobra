<!DOCTYPE html>
<html>
    <head>
        <title>Visitas del Mes Actual</title>
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
        <h2>VISITAS DEL MES ACTUAL</h2>
        <table summary="LpH">
            <?php
            $zeros = array_fill($i, $dhoy, 0);
            $tsumt = $zeros;
            $tsumb = $zeros;
            $tsumg = $zeros;
            $tsumgt = $zeros;
            $tsumgt1 = $zeros;
            $tsumgt2 = $zeros;
            $tsump = $zeros;
            $tsumpp = $zeros;
            $tsumw = $zeros;
            $tsumci = $zeros;
            $tsumco = $zeros;
            $resultnom = $hc->listVisitadores();
            foreach ($resultnom as $answernom) {
                $gestor = $answernom['iniciales'];
                $visitador = $answernom['completo'];
                $c_visit = $answernom['iniciales'];
                ?>
                <thead>
                    <tr>
                        <th><?php echo $visitador; ?></th>
                        <?php
                        for ($i = 1; $i <= $dhoy; $i++) {
                            $lla[$i] = 0;
                            $tlla[$i] = 0;
                            $prom[$i] = 0;
                            $pag[$i] = 0;
                            $resultss = $hc->getVisitadorMain($c_visit, $i);
                            foreach ($resultss as $answerss) {
                                $lla[$i] = $answerss['cuentas'];
                                $tlla[$i] = $answerss['gestiones'];
                                $prom[$i] = $answerss['promesas'];
                                $sumg = 0;
                                $sumgt = 0;
                                $sumgt1 = 0;
                                $sumgt2 = 0;
                                $sumt = 0;
                                $sumb = 0;
                                $sumpp = 0;
                                $sump = 0;
                                $sumw = 0;
                                $resultp = $hc->getVisitadorPagos($c_visit, $i);
                                foreach ($resultp as $answerp) {
                                    $pag[$i] = $answerp['ct'];
                                }
                            }

                            $resultco = $hc->countVisitsAssigned($c_visit, $i);
                            foreach ($resultco as $answerco) {
                                if (is_array($answerco)) {
                                    $co[$i] = $answerco['co'];
                                    $ci[$i] = $answerco['ci'];
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
                    <tr><td class="heavy">SALIDOS</td>
                        <?php
                        $sumco = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php
                                if ($co[$i] != 0) {
                                    echo $co[$i];
                                }
                                ?></td>
                            <?php
                            $sumco = $sumco + $co[$i];
                            $tsumco[$i] = $tsumco[$i] + $co[$i];
                            ?>
    <?php }
    ?>
                        <td class="heavy"><?php echo $sumco; ?></td>
                    <tr><td class="heavy">RECIBIDOS</td>
                        <?php
                        $sumci = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php
                            if ($ci[$i] != 0) {
                                echo $ci[$i];
                            }
                            ?></td>
                            <?php
                            $sumci = $sumci + $ci[$i];
                            $tsumci[$i] = $tsumci[$i] + $ci[$i];
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
                            <td class="light<?php
                            if ($tlla[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>">
                            <?php echo $tlla[$i]; ?></td>
                            <?php
                            $sumgt = $sumgt + $tlla[$i];
                            $tsumgt[$i] = $tsumgt[$i] + $tlla[$i];
                            if ($i < 16) {
                                $sumgt1 = $sumgt1 + $tlla[$i];
                                $tsumgt1[$i] = $tsumgt1[$i] + $tlla[$i];
                            }
                            if ($i > 15) {
                                $sumgt2 = $sumgt2 + $tlla[$i];
                                $tsumgt2[$i] = $tsumgt2[$i] + $tlla[$i];
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
                            <td class="light<?php
                            if ($lla[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>">
        <?php echo $lla[$i]; ?></td>
                            <?php
                            $sumg = $sumg + $lla[$i];
                            $tsumg[$i] = $tsumg[$i] + $lla[$i];
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
                            <td class="light<?php
                            if ($prom[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>">
                                <a href='<?php echo strtolower('pdh.php?capt=' . $capt . '&i=' . $prom[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                            <?php echo $prom[$i]; ?></a></td>
                            <?php
                            $sumpp = $sumpp + $prom[$i];
                            $tsumpp[$i] = $tsumpp[$i] + $prom[$i];
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
                            $sump = $sump + $pag[$i];
                            $tsump[$i] = $tsump[$i] + $pag[$i];
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
                        $sumw = $sumw + $work;
                        $tsumw[$i] = $tsumw[$i] + $work;
                        ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumw; ?></td>
                        <td class="heavy"><?php echo number_format($sumgt1 / ($expw1 + 0.0001) * 100, 0) . '%';
                        ?></td>
                        <td class="heavy"><?php echo number_format($sumgt2 / ($expw2 + 0.0001) * 100, 0) . '%';
                        ?></td>
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
