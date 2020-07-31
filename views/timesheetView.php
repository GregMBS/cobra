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
    $day_esp = ['DOM','LUN','MAR','MIE','JUE','VIE','SAB'];
    foreach ($gestores as $answernom) {
        $gestor = $answernom['c_cvge'];
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
            echo $tv->countRow('GESTIONES', $month, $monthSum, 'tlla', $gestor, $capt, 'ddh');
            echo $tv->countRow('CUENTAS', $month, $monthSum, 'lla', $gestor, $capt, 'ddh');
            echo $tv->countRow('CONTACTOS', $month, $monthSum, 'ct', $gestor, $capt, '');
            echo $tv->countRow('NO CONTACTOS', $month, $monthSum, 'nct', $gestor, $capt, '');
            echo $tv->countRow('PROMESAS', $month, $monthSum, 'prom', $gestor, $capt, 'pdh');
            echo $tv->countRow('PAGOS', $month, $monthSum, 'pag', $gestor, $capt, '');
            ?>
            <tr style="height:2em"></tr>
            </tbody>
        </table>
    <?php } ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</div>
</body>
</html>