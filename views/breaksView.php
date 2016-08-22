<!DOCTYPE html>
<html>
    <head>
        <title>Breaks del Hoy</title>
        <meta http-equiv="refresh" content="15"/>

        <style type="text/css">
            body {font-family: arial, helvetica, sans-serif; font-size: 24pt; background-color: #00a0f0;}
            table {border: 1pt solid #000000;background-color: #ffffff;border-collapse: collapse;
                   margin-left:auto;margin-right:auto;}
            tr:hover {background-color: #ffff00;}
            th,td {border: 1pt solid #000000;background-color: #ffffff;}
            th,.heavy {font-weight:bold;}
            .light {text-align:right;}
            .rightnow {background-color:#ffff00;}
            .late {background-color:#ffff00; font-weight:bold; text-decoration:blink;}
            .verylate {background-color:#ff0000; font-weight:bold; text-decoration:blink;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'index.php'">LOGIN</button><br>
        <table summary="Breaks">
            <thead>
                <tr>
                    <th>Gestor</th>
                    <th>Tipo</th>
                    <th>de</th>
                    <th>a</th>
                    <th>Minutes</th>
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($resultp as $answerp) {
    $AUTO = $answerp['auto'];
    $GESTOR = $answerp['c_cvge'];
    $TIPO = $answerp['c_cvst'];
    $TIEMPO = $answerp['c_hrin'];
    $DIFF = $answerp['diff'];
    $formatstr = ' class="late"';
    $NTP = date('H:i:s');
    $resultq = getTimes($pdo, $formatstr, $queryp);
    foreach ($resultq as $answerq) {
        if (!empty($answerq['diff'])) {
            $DIFF = $answerq['diff'];
            $NTP = $answerq['minhr'];
            $formatstr = '';
        }
    }
                    ?>
                    <tr<?php echo $formatstr; ?>>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $TIPO; ?></td>
                        <td><?php echo $TIEMPO; ?></td>
                        <td><?php echo $NTP; ?></td>
                        <td><?php echo round($DIFF / 60); ?></td>
                    </tr>
                    <?php
}
                ?>
            </tbody>
        </table>
    </body>
</html>
