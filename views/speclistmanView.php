<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Listado de Queue Manual</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style>
            td { text-align: center; }
            td.number {
                text-align: right;
                padding-right: 1em;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
    </head>
    <body>
        <button onclick="window.location = 'reporteManual.php?capt=<?php echo $capt; ?>'">Regressar al Reporte de los Queues MANUAL</button><br>
        <table id="qm" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SEGMENTO</th>
                    <th>SALDO TOTAL</th>
                    <th>STATUS</th>
                    <th>GESTOR</th>
                    <th>ULT GESTI&Oacute;N</th>
                    <th>VECES GESTIONADOS HOY</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td class="number"><?php echo $row['numero_de_cuenta']; ?></td>
                        <td><?php echo $row['nombre_deudor']; ?></td>
                        <td><?php echo $row['cli']; ?></td>
                        <td><?php echo $row['status_de_credito']; ?></td>
                        <td class="number"><?php echo $row['saldo_total']; ?></td>
                        <td><?php echo $row['status_aarsa']; ?></td>
                        <td><?php echo $row['ejecutivo_asignado_call_center']; ?></td>
                        <td><?php echo $row['fecha_ultima_gestion']; ?></td>
                        <td><?php echo ($row['especial'] - 1); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $('#qm').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    }
                });
            });
        </script>
    </body>
</html> 
