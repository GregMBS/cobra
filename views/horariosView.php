<!DOCTYPE html>
<html>
    <head>
        <title>Horarios</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.4/themes/redmond/jquery-ui.css" type="text/css" media="all" />
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
            foreach ($resultnom as $answernom) {
                $gestor = $answernom['c_cvge'];
                ?>
                <table class="ui-widget">
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        $tsumt[$i] = 0;
                        $tsumb[$i] = 0;
                        $tsumbn[$i] = 0;
                        $tsumg[$i] = 0;
                        $tsumgt[$i] = 0;
                        $tsumct[$i] = 0;
                        $tsumnct[$i] = 0;
                        $tsumpp[$i] = 0;
                        $tsump[$i] = 0;
                    }
                    ?>
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            require_once 'horariosViewCommon.php';
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
                                    <a href='<?php echo strtolower('pdh.php?capt=' . $capt . '&i=' . $prom[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
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
                                    $sump = $sump + $pag[$i];
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
                            $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
                            ?>
                            <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
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
                                echo $hc->convertTime($hours_all[$i] / 3600);
                                ?></td>
                            <?php
                            $hours_total += $hours_all[$i] / 3600;
                        }
                        ?>
                        <td class="heavy"><?php echo $hc->convertTime($hours_total); ?></td>
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
                            $cuentas_all = $hac->countAccountsPerDay($i);
                            ?>
                            <td class="light"><?php echo $cuentas_all; ?></td>
                            <?php
                            $cuentas_total = $hac->countAccounts();
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

