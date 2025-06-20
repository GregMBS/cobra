<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Tiempo Real</title>
        <meta http-equiv="refresh" content="120"/>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.jqueryui.min.css"
              integrity="sha512-etw+uKrmSM/SQGzslcglze3XP/gZHpQx00aeyBRxkJGMXuFsMPBYvP2zVTCx9WVLdKLjUla+Byz0xAjFtXivwQ=="
              crossorigin="anonymous" />
        <style>
            tr { text-align: center; }
            tr.odd { background-color: white }
            tr.even { background-color: #dddddd !important;}
            tfoot tr {
                background-color: beige;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div id="tab">
            <ul>
                <li><a href="#AHORA">AHORA</a></li>
                <li><a href="#BREAKS">BREAKS</a></li>
                <li><a href="#PORHORA">ULTIMA HORA</a></li>
                <li><a href="#PORDIA">HOY</a></li>
            </ul>
            <div id='AHORA'>
                <table class='ui-widget' id="AHORAtab">
                    <thead class='ui-widget-header'>
                        <tr>
                            <th>Gestor</th>
                            <th>Cuenta</th>
                            <th>Nombre<br>Deudor</th>
                            <th>Cliente</th>
                            <th>Camp</th>
                            <th>Status</th>
                            <th>Tiempo en este cuenta (min)</th>
                            <th>Queue</th>
                            <th>Sistema</th>
                            <th>Login</th>
                            <th>Logout</th>
                        </tr>
                    </thead>
                    <tbody class='ui-widget-content'>
                        <?php
                        foreach ($resultAhora as $rowAhora) {
                            if ($rowAhora['logout'] == $rowAhora['auto']) {
                                $url = 'logout.php?gone=forgot&capt=' . $rowAhora['gestor'];
                                $logout = '<a href=' . $url . ' target="_blank">LOGOUT</a>';
                            } else {
                                $logout = $rowAhora['logout'];
                            }
                            ?>
                            <tr<?php
                            if ($rowAhora['tiempo'] > 60) {
                                echo ' class="alert"';
                            }
                            ?>>
                                <td><?php echo $rowAhora['gestor']; ?></td>
                                <td><a href="/resumen.php?go=FromMigo&i=0&field=id_cuenta&find=<?php echo $rowAhora['id_cuenta']; ?>&capt=<?php echo $capt; ?>"><?php echo $rowAhora['cuenta']; ?></a></td>
                                <td><?php echo $rowAhora['nombre']; ?></td>
                                <td><?php echo $rowAhora['cliente']; ?></td>
                                <td><?php echo $rowAhora['camp']; ?></td>
                                <td><?php echo $rowAhora['status']; ?></td>
                                <td><?php echo $rowAhora['tiempo']; ?></td>
                                <td><?php echo $rowAhora['queue']; ?></td>
                                <td><?php echo $rowAhora['sistema']; ?></td>
                                <td><?php echo $rowAhora['login']; ?></td>
                                <td><?php echo $logout; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id='BREAKS'>
                <table class='ui-widget' id='BREAKStab'>
                    <thead class='ui-widget-header'>
                        <tr>
                            <th>Gestor</th>
                            <th>Tipo</th>
                            <th>de</th>
                            <th>a</th>
                            <th>Minutes</th>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        foreach ($resultBreaks as $rowBreaks) {
                            ?>
                            <tr>
                                <td><?php echo $rowBreaks['gestor']; ?></td>
                                <td><?php echo $rowBreaks['tipo']; ?></td>
                                <td><?php echo $rowBreaks['tiempo']; ?></td>
                                <td><?php echo $rowBreaks['ntp']; ?></td>
                                <td><?php echo $rowBreaks['diff']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id='PORHORA'>
                <table class="ui-widget" id='PORHORAtab'>
                    <thead class="ui-widget-header">
                        <tr>
                            <th></th>
                            <th>Contactos</th>
                            <th>Gestiones</th>
                            <th>Promesas</th>
                            <th>% Contactos</th>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        foreach ($resultPorHora as $rowPorHora) {
                            ?>
                            <tr>
                                <td><?php echo $rowPorHora['gestor']; ?></td>
                                <td><?php echo $rowPorHora['contactos']; ?></td>
                                <td><?php echo $rowPorHora['gestiones']; ?></td>
                                <td><?php echo $rowPorHora['promesas']; ?></td>
                                <td><?php echo $rowPorHora['porciento']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id='PORDIA'>
                <table class="ui-widget" id="PORDIAtab">
                    <thead class="ui-widget-header">
                        <tr>
                            <th></th>
                            <th>Gestiones</th>
                            <th>Promesas Hoy</th>
                            <th>$ Promesas Hoy</th>
                            <th>Negociaciones</th>
                            <th>Horas</th>
                            <th>Break (min)</th>
                            <th>Gestiones por hora</th>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        $sumGestiones = 0;
                        $sumPromesas = 0;
                        $sumMontos = 0;
                        $sumNegociaciones = 0;
                        $sumHoras = 0;
                        $sumBreak = 0;
                        $odd = 0;
                        foreach ($resultHoy as $rowHoy) {
                            ?>
                            <tr<?php
                            if ($odd == 1) {
                                echo ' class="odd"';
                            } else {
                                echo ' class="even"';
                            }
                            $odd = 1 - $odd;
                            ?>>
                                <th><?php echo $rowHoy['gestor']; ?></th>
                                <td><?php echo $rowHoy['Gestiones']; ?></td>
                                <td><?php echo $rowHoy['Promesas_Hoy']; ?></td>
                                <td><?php echo $rowHoy['Monto_Promesas_Hoy']; ?></td>
                                <td><?php echo $rowHoy['Negociaciones']; ?></td>
                                <td><?php echo $rowHoy['Horas']; ?></td>
                                <td><?php echo $rowHoy['Break_Minutos']; ?></td>
                                <td><?php echo $rowHoy['Gestiones_por_hora']; ?></td>
                            </tr>
                            <?php
                            $sumGestiones += $rowHoy['Gestiones'];
                            $sumPromesas += $rowHoy['Promesas_Hoy'];
                            $sumMontos += $rowHoy['Monto_Promesas_Hoy'];
                            $sumNegociaciones += $rowHoy['Negociaciones'];
                            $sumHoras += $rowHoy['Horas'];
                            $sumBreak += $rowHoy['Break_Minutos'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    <tr><th>&nbsp;</th>
                    <td><?php echo $sumGestiones; ?></td>
                    <td><?php echo $sumPromesas; ?></td>
                    <td><?php echo $sumMontos; ?></td>
                    <td><?php echo $sumNegociaciones; ?></td>
                        <td><?php echo $sumHoras; ?></td>
                        <td><?php echo $sumBreak; ?></td>
                    <td><?php echo number_format($sumGestiones / ($sumHoras + 1 / 3600)); ?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"
                integrity="sha512-JSdvzvKEAXKggB5Zoh4JTEKon1nRt6JXJE3bEEtYUyqfBZCFWMcYWyaoJraRIPmj9C7C9IXbwLuXK/jJ3ztitQ=="
                crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $("#tab").tabs();
                $("body").css("font-size", "10pt");
                $(".rightnow a,#pbx,#cell,input[submit],button").button();
                $('#AHORAtab').dataTable();
                $('#BREAKStab').dataTable();
                $('#PORHORAtab').dataTable();
                $('#PORDIAtab').dataTable();
            });
        </script>
    </body>
</html>
