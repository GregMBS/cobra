<!DOCTYPE html>
<html>
    <head>
        <title>Cuentas gestionado por <?php echo $gestor; ?> en <?php echo $fecha; ?></title>
        <link href="bower_components/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="bower_components/datatables/media/bower_components/datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <script src="bower_components/datatables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('table').dataTable({
                    "bPaginate": false,
                    "bJQueryUI": true
                });
            });
        </script>
    </head>
    <body>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>STATUS DE LA CUENTA</th>
                    <th>DIAS VENCIDOS</th>
                    <th>SALDO TOTAL</th>
                    <th>RESULTADOS</th>
                    <th>FECHA PROMESA</th>
                    <th>MONTO PROMESA</th>
                    <th>HORA DE GESTI&Oacute;N</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($result as $row) {
                    $CUENTA            = $row['numero_de_cuenta'];
                    $CLIENTE           = $row['cliente'];
                    $GESTOR            = $row['status_aarsa'];
                    $ID_CUENTA         = $row['id_cuenta'];
                    $STATUS_AARSA      = $row['c_cvst'];
                    $VALOR             = $row['vcc'];
                    $FECHA_PROMESA     = $row['d_prom'];
                    $MONTO_PROMESA     = $row['n_prom'];
                    $NOMBRE            = $row['nombre_deudor'];
                    $DV                = $row['dias_vencidos'];
                    $STATUS_DE_CREDITO = $row['status_de_credito'];
                    $MONTODESC         = $row['saldo_descuento_2'];
                    $PRODUCTO          = $row['producto'];
                    $CIUDAD            = $row['ciudad_deudor'];
                    $MONTOTOTAL        = $row['saldo_total'];
                    $HORA              = $row['c_hrin'];
                    ?>
                    <tr>
                        <td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo htmlentities($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $DV; ?></td>
                        <td><?php echo number_format($MONTOTOTAL, 0); ?></td>
                        <td><?php echo $STATUS_AARSA; ?></td>
                        <td><?php echo $FECHA_PROMESA; ?></td>
                        <td><?php echo number_format($MONTO_PROMESA, 0); ?></td>
                        <td><?php echo $HORA; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html> 