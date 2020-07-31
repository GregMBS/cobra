<!DOCTYPE html>
<html lang="es">
<head>
    <title>Horarios</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
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
    $day_esp = ['DOM'.'LUN','MAR','MIE','JUE','VIE','SAB'];
    foreach ($gestores as $answernom) {
        $gestor = $answernom['iniciales'];
        $month = $sheet[$gestor];
        $monthSum = $sum[$gestor];
        ?>
        <table class="ui-widget">
            <thead class="ui-widget-header">
            <tr>
                <th>
                    <a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $gestor); ?>'><?php echo $gestor; ?></a>
                </th>
                <?php
                for ($i = 1; $i <= $dhoy; $i++) {
                    $day = $month[$i];
                    $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
                    ?>
                    <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
                <?php } ?>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody class="ui-widget-content">
            <?php
            echo $tv->timeRow('LOGIN', $month, $monthSum, 'start');
            echo $tv->timeRow('LOGOUT', $month, $monthSum, 'stop');
            echo $tv->timeRow('HORAS', $month, $monthSum, 'diff');
            echo $tv->timeRow('BREAK', $month, $monthSum, 'break');
            echo $tv->timeRow('BAÑO', $month, $monthSum, 'bano');
            echo $tv->countRow('GESTIONES', $month, $monthSum, 'tlla', $capt, $gestor, 'ddh');
            echo $tv->countRow('CUENTAS', $month, $monthSum, 'lla', $capt, $gestor, 'ddh');
            echo $tv->countRow('CONTACTOS', $month, $monthSum, 'ct', $capt, $gestor, '');
            echo $tv->countRow('NO CONTACTOS', $month, $monthSum, 'nct', $capt, $gestor, '');
            echo $tv->countRow('PROMESAS', $month, $monthSum, 'prom', $capt, $gestor, 'pdh');
            echo $tv->countRow('PAGOS', $month, $monthSum, 'pag', $capt, $gestor, '');
            ?>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</div>
</body>
</html>