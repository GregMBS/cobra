<?php
require_once 'classes/pdoConnect.php';
$pc     = new pdoConnect();
$pdo    = $pc->dbConnectAdmin();
require_once 'DhClass.php';
$dc     = new DhClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');
$fecha  = filter_input(INPUT_GET, 'fecha');
set_time_limit(300);
$result = $dc->getPromesas($gestor, $fecha);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cuentas gestionado por <?php echo $gestor; ?> en <?php echo $fecha; ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="vendor/bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="bower_components/datatables/media/css/jquery.dataTables.css">
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="Cuentas">
            <thead>
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>GESTOR</th>
                    <th>PAGOS VENCIDOS</th>
                    <th>SALDO TOTAL</th>
                    <th>RESULTADOS</th>
                    <th>FECHA PROMESA</th>
                    <th>MONTO PROMESA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $row) {
                    $CUENTA    = $row['numero_de_cuenta'];
                    $CLIENTE   = $row['cliente'];
                    $GESTOR    = $row['ejecutivo_asignado_call_center'];
                    $ID_CUENTA = $row['id_cuenta'];

                    $STATUS_AARSA = $row['status_aarsa'];
                    $VALOR        = $row['vcc'];
                    if (empty($VALOR)) {
                        $VALOR = 99;
                    }
                    $FECHA_PROMESA     = $row['fecha_promesa'];
                    $MONTO_PROMESA     = $row['monto_promesa'];
                    $NOMBRE            = $row['nombre_deudor'];
                    $PV                = $row['pagos_vencidos'];
                    $STATUS_DE_CREDITO = $row['status_de_credito'];
                    $MONTODESC         = $row['saldo_descuento_1'];
                    $PRODUCTO          = $row['producto'];
                    $CIUDAD            = $row['ciudad_deudor'];
                    $MONTOTOTAL        = $row['saldo_total'];
                    ?>
                    <tr>
                        <td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo htmlentities($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $PV; ?></td>
                        <td class='num'><?php echo number_format($MONTOTOTAL, 0); ?></td>
                        <td><?php echo $STATUS_AARSA; ?></td>
                        <td><?php echo $FECHA_PROMESA; ?></td>
                        <td><?php echo number_format($MONTO_PROMESA, 0); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <script>
            $(function() {
                $('#Cuentas').dataTable({"bJQueryUI": true});
            });
        </script>
    </body>
</html>
