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
    <form action='/horarios_single.php' method='get'>
        <label for="selectGestor">Gestor: </label>
        <select name='gestor' id="selectGestor">
            <?php
            if (!empty($gestores)) {
                foreach ($gestores as $answernom) {
                    $nombre = $answernom['c_cvge'];
                    $month = $sheet[$gestor];
                    $monthSum = $sum[$gestor];
                    ?>
                    <option value='<?php echo $nombre; ?>'><?php echo $nombre; ?></option>
                <?php }
            } ?>
            <option value='total'>total</option>
        </select>
        <input type='hidden' name='capt' value='<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>'>
        <input type='submit' name='go' value='gestor'>
    </form>
</div>
<?php

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
            $month = $hc->prepareSheet($hc, $gestor, $dhoy);
            for ($i = 1; $i < $dhoy; $i++) {
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
        echo $tv->diffRow('HORAS', $month, $monthSum, 'diff');
        echo $tv->diffRow('BREAK', $month, $monthSum, 'break');
        echo $tv->diffRow('BAÑO', $month, $monthSum, 'bano');
        echo $tv->countRow('GESTIONES', $month, $monthSum, 'tlla', $gestor, $capt, 'ddh');
        echo $tv->countRow('CUENTAS', $month, $monthSum, 'lla', $gestor, $capt, 'ddh');
        echo $tv->countRow('CONTACTOS', $month, $monthSum, 'ct', $gestor, $capt, '');
        echo $tv->countRow('NO CONTACTOS', $month, $monthSum, 'nct', $gestor, $capt, '');
        echo $tv->countRow('PROMESAS', $month, $monthSum, 'prom', $gestor, $capt, 'pdh');
        echo $tv->countRow('PAGOS', $month, $monthSum, 'pag', $gestor, $capt, '');
        ?>
        </tbody>
    </table>
    <?php } ?>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>

