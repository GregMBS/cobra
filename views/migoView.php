<!DOCTYPE html>
<html lang="es">
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
                /** @var ResumenObject $row */

                use cobra_salsa\ResumenObject;

                foreach ($main as $row) {
                    ?>
                    <tr>
                        <td><a href='/resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php
                            echo $row->id_cuenta;
                            ?>&capt=<?php
                            echo $capt;
                            ?>'><?php
                                echo $row->numero_de_cuenta;
                                ?></a></td>
                        <td><?php echo htmlentities($row->nombre_deudor); ?></td>
                        <td><?php echo $row->cliente; ?></td>
                        <td><?php echo $row->status_de_credito; ?></td>
                        <td><?php echo $row->saldo_total; ?></td>
                        <td><?php echo $row->saldo_descuento_2; ?></td>
                        <td><?php echo $row->status_aarsa; ?></td>
                        <td><?php echo $row->fecha_ultima_gestion; ?></td>
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
