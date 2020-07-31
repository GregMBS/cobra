<!DOCTYPE html>
<html lang="es">
<head>
    <title>Visitas del Mes Actual</title>
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
<h2>VISITAS DEL MES ACTUAL</h2>
<table>
    <?php
    $day_esp = ['DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
    foreach ($visitadores as $answernom) {
    $visitador = $answernom['c_visit'];
    $month = $sheet[$gestor];
    $monthSum = $sum[$gestor];
    ?>
    <thead>
    <tr>
        <th><?php echo $visitador; ?></th>
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
    echo $tv->countRow('VISITAS', $month, $monthSum, 'tlla', $visitador, $capt, 'ddh');
    echo $tv->countRow('CUENTAS', $month, $monthSum, 'lla', $visitador, $capt, 'ddh');
    echo $tv->countRow('CONTACTOS', $month, $monthSum, 'ct', $visitador, $capt, '');
    echo $tv->countRow('NO CONTACTOS', $month, $monthSum, 'nct', $visitador, $capt, '');
    echo $tv->countRow('PROMESAS', $month, $monthSum, 'prom', $visitador, $capt, 'pdh');
    echo $tv->countRow('PAGOS', $month, $monthSum, 'pag', $visitador, $capt, '');
    ?>
    <tr style="height:2em"></tr>
    </tbody>
</table>
<?php } ?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>