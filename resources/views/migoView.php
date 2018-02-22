<!DOCTYPE html>
<html>
    <head>
        <title>Cuentas Migo</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="Cuentas" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SEGMENTO</th>
                    <th>SALDO TOTAL</th>
                    <th>SALDO DESCUENTO</th>
                    <th>STATUS</th>
                    <th>ULT. GESTION</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($result as $row) {
                    $CUENTA = $row['numero_de_cuenta'];
                    $NOMBRE = $row['nombre_deudor'];
                    $CLIENTE = $row['cliente'];
                    $SEGMENTO = $row['status_de_credito'];
                    $SALDO_TOTAL = (float) $row['saldo_total'];
                    $SALDO_DESC = (float) $row['saldo_descuento_2'];
                    $STATUS_AARSA = $row['status_aarsa'];
                    $FECHA_ULT_GESTION = $row['fecha_ultima_gestion'];
                    $ID_CUENTA = $row['id_cuenta'];
                    ?>
                    <tr>
                        <td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo htmlentities($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $SEGMENTO; ?></td>
                        <td><?php echo $SALDO_TOTAL; ?></td>
                        <td><?php echo $SALDO_DESC; ?></td>
                        <td><?php echo $STATUS_AARSA; ?></td>
                        <td><?php echo $FECHA_ULT_GESTION; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $('#Cuentas').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    }
                });
            });
        </script>
    </body>
</html>
