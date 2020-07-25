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
        </table>
        <script>
            $(document).ready(function () {
                $('#Cuentas').dataTable({
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    },
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'get',
                    'ajax': {
                        'url':'migoAjax.php',
                        data: { capt: '<?php echo $pd->capt; ?>' }
                    },
                    'columns': [
                        <?php
                        foreach ($mc->keys as $key) {
                        ?>
                        { data: '<?php echo $key; ?>' },
                        <?php
                        }
                        ?>
                    ]
                });
            });
        </script>
    </body>
</html>
