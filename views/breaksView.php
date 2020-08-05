<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Breaks del Hoy</title>
        <meta http-equiv="refresh" content="15"/>

        <style type="text/css">
            body {font-family: arial, helvetica, sans-serif; font-size: 24pt; background-color: #00a0f0;}
            table {border: 1pt solid #000000;background-color: #ffffff;border-collapse: collapse;
                   margin-left:auto;margin-right:auto;}
            tr:hover {background-color: #ffff00;}
            th,td {border: 1pt solid #000000;background-color: #ffffff;}
            th {font-weight:bold;}
            .late {background-color:#ffff00; font-weight:bold; text-decoration:blink;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'index.php'">LOGIN</button><br>
        <table>
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
                        extract($row);
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
    </body>
</html>
