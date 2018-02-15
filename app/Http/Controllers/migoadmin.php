<?php
use cobra_salsa\PdoClass; // returns $pdo
$pdoc      = new PdoClass();
$pdo       = $pdoc->dbConnectAdmin();
$capt      = filter_input(INPUT_GET, 'capt');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cuentas Activas</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="Cuentas" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SEGMENTO</th>
                    <th>GESTOR</th>
                    <th>SALDO TOTAL</th>
                    <th>SALDO DESCUENTO</th>
                    <th>STATUS</th>
                    <th>ULT. GESTION</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#Cuentas').dataTable({
                    serverSide: true,
                    ajax: "/migoadmin_ajax.php?capt=<?php echo $capt; ?>",
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    }
                });
            });
        </script>
    </body>
</html> 
