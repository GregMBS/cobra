<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tiempo Real</title>
    <meta http-equiv="refresh" content="60"/>
    <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
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
                    <td>
                        <a href="/resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $rowAhora['id_cuenta']; ?>&capt=<?php echo $capt; ?>"><?php echo $rowAhora['cuenta']; ?></a>
                    </td>
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
            /** @var PDOStatement $resultBreaks */
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
            /** @var PDOStatement $resultPorHora */
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
                <th>Break min</th>
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
            /** @var PDOStatement $resultHoy */
            foreach ($resultHoy as $rowHoy) {
                ?>
                <tr<?php
                if ($rowHoy['Horas'] < $rowHoy['Break_min'] * 6) {
                    echo ' class="alert"';
                }
                ?>>
                    <td><?php echo $rowHoy['gestor']; ?></td>
                    <td><?php echo $rowHoy['Gestiones']; ?></td>
                    <td><?php echo $rowHoy['Promesas_Hoy']; ?></td>
                    <td><?php echo $rowHoy['Monto_Promesas_Hoy']; ?></td>
                    <td><?php echo $rowHoy['Negociaciones']; ?></td>
                    <td><?php echo $rowHoy['Horas']; ?></td>
                    <td><?php echo $rowHoy['Break_min']; ?></td>
                    <td><?php echo $rowHoy['Gestiones_por_hora']; ?></td>
                </tr>
                <?php
                $sumGestiones += $rowHoy['Gestiones'];
                $sumPromesas += $rowHoy['Promesas_Hoy'];
                $sumMontos += $rowHoy['Monto_Promesas_Hoy'];
                $sumNegociaciones += $rowHoy['Negociaciones'];
                $sumHoras += $rowHoy['Horas'];
                $sumBreak += $rowHoy['Gestiones_por_hora'];
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>&nbsp;</th>
                <th><?php echo $sumGestiones; ?></th>
                <th><?php echo $sumPromesas; ?></th>
                <th><?php echo $sumMontos; ?></th>
                <th><?php echo $sumNegociaciones; ?></th>
                <th><?php echo $sumHoras; ?></th>
                <th><?php echo $sumBreak; ?></th>
                <th><?php echo number_format($sumGestiones / ($sumHoras + 1 / 3600)); ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button>
<br>
<script>
    $(function () {
        $("#tab").tabs();
        $("body").css("font-size", "10pt");
        $(".rightnow a,#pbx,#cell,input[submit],button").button();
        $('#PORDIAtab').dataTable();
    });
</script>
</body>
</html>
