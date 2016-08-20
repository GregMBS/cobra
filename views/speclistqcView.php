<!DOCTYPE html">
<html>
    <head>
        <title>Listado por Gestor y Status</title>
        <link href="https://code.jquery.com/ui/1.12.4/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr:hover {background-color: #ff0000;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'queuesqc.php?capt=<?php echo $capt; ?>'">Regressar al Reporte de Queues</button><br>
        <table id="cuentas" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SEGMENTO</th>
                    <th>MONTO PAGO</th>
                    <th>SALDO TOTAL</th>
                    <th>QUEUE</th>
                    <th>GESTOR</a</th>
                    <th>ULT. GESTI&Oacute;N</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $j = 0;
                foreach ($result as $row) {
                    $j = $j + 1;
                    $CUENTA = $row['numero_de_cuenta'];
                    $CLIENTE = $row['cli'];
                    $ID_CUENTA = $row['idc'];
                    $FUG = $row['fecha_ultima_gestion'];
                    $NOMBRE = $row['nombre_deudor'];
                    $GESTOR = $row['ejecutivo_asignado_call_center'];
                    $MONTO = $row['sm'];
                    $SEGMENTO = $row['status_de_credito'];
                    $STATUS = $row['status_aarsa'];
                    $PRODUCTO = $row['producto'];
                    $CIUDAD = $row['ciudad_deudor'];
                    $MONTOTOTAL = $row['saldo_total'];
                    ?>
                    <tr>
                        <td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo utf8_decode($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $SEGMENTO; ?></td>
                        <td class='num'><?php echo number_format($MONTO, 2); ?></td>
                        <td class='num'><?php echo number_format($MONTOTOTAL, 2); ?></td>
                        <td><?php echo $STATUS; ?></td>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $FUG; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $('#cuentas').DataTable();
        </script>
    </body>
</html>
