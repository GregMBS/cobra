<!DOCTYPE html>
<html lang="es">
<head>
    <title>Breaks del Hoy</title>
    <meta http-equiv="refresh" content="15"/>
    <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .late {
            background-color: #ffff00;
            font-weight: bold;
            text-decoration: blink;
        }
    </style>
</head>
<body>
<button onclick="window.location = 'index.php'">LOGIN</button>
<br>
<table id="breaksTable">
    <thead>
    <tr>
        <th>Gestor</th>
        <th>Tipo</th>
        <th>de</th>
        <th>a</th>
        <th>Minutos</th>
    </tr>
    </thead>
    <tbody>
    <?php

    if (!empty($output)) {
        foreach ($output as $row) {
            /**
             * @var string $formatLate
             * @var string $c_cvge
             * @var string $c_cvst
             * @var string $c_hrin
             * @var string $NTP
             * @var int $DIFF
             */
            extract($row, EXTR_OVERWRITE);
            ?>
            <tr<?php echo $formatLate; ?>>
                <td><?php echo $c_cvge; ?></td>
                <td><?php echo $c_cvst; ?></td>
                <td><?php echo $c_hrin; ?></td>
                <td><?php echo $NTP; ?></td>
                <td><?php echo round($DIFF / 60); ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('#breaksTable').dataTable({
            "bPaginate": false,
            "bJQueryUI": true
        });
    });
</script>
</body>
</html>
