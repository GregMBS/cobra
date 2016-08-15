<?php
require_once 'classes/pdoConnect.php';
$pc     = new pdoConnect();
$pdo    = $pc->dbConnectUser();
require_once 'classes/rotasClass.php';
$rc     = new rotasClass($pdo);
$capt   = filter_input(INPUT_GET, 'capt');
$result = $rc->getRotas($capt, '');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Promesas</title>
        <link href="bower_components/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="bower_components/datatables/media/css/jquery.dataTables.css">
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style>
            body { font-size: 10pt }
            #rotasTable th, #rotasTable td { padding: 0 }
            #rotasTable tr.even { background-color: white }
            #rotasTable tr.odd { background-color: #dddddd }
            td { text-align: center }
            .alert { background-color: red }
        </style>
    </head>
    <body>
        <table id="rotasTable">
            <thead>
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>RESULTADOS</th>
                    <th>GESTOR</th>
                    <th>FECHA PROMESA 1</th>
                    <th>MONTO PROMESA 1</th>
                    <th>FECHA PROMESA 2</th>
                    <th>MONTO PROMESA 2</th>
                    <th>FECHA PROMESA 3</th>
                    <th>MONTO PROMESA 3</th>
                    <th>FECHA PROMESA 4</th>
                    <th>MONTO PROMESA 4</th>
                    <th>MONTO PAGO</th>
                    <th>SEMAFORO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $oldc   = 0;
                foreach ($result as $row) {
                    $CUENTA            = $row['numero_de_cuenta'];
                    $CLIENTE           = $row['cliente'];
                    $GESTOR            = $row['c_cvge'];
                    $ID_CUENTA         = $row['id_cuenta'];
                    $STATUS_AARSA      = $row['status_aarsa'];
                    $FECHA_PROMESA1    = $row['d_prom1'];
                    $MONTO_PROMESA1    = $row['n_prom1'];
                    $FECHA_PROMESA2    = $row['d_prom2'];
                    $MONTO_PROMESA2    = $row['n_prom2'];
                    $FECHA_PROMESA3    = $row['d_prom3'];
                    $MONTO_PROMESA3    = $row['n_prom3'];
                    $FECHA_PROMESA4    = $row['d_prom4'];
                    $MONTO_PROMESA4    = $row['n_prom4'];
                    $MONTO_PAGO        = $row['sum_monto'];
                    $NOMBRE            = $row['nombre_deudor'];
                    $STATUS_DE_CREDITO = $row['status_de_credito'];
                    $MONTOTOTAL        = $row['saldo_total'];
                    $VENC              = $row['semaforo'];
                    $color             = 'white';
                    $semtext           = '';
                    if ($VENC > 0) {
                        $color   = 'red';
                        $semtext = 'VENCIDO';
                    }
                    if ($VENC <= 0) {
                        $color   = 'blue';
                        $semtext = 'VIGENTE';
                    }
                    if ($MONTO_PAGO > 10) {
                        if ($STATUS_AARSA == 'PAGO TOTAL') {
                            $color   = 'green';
                            $semtext = 'PAGO';
                        } else {
                            $color   = 'yellow';
                            $semtext = 'PAGANDO';
                        }
                    }
                    if ($oldc != $ID_CUENTA) {
                        $oldc = $ID_CUENTA;
                        ?>
                        <tr>
                            <td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                            <td><?php echo htmlentities($NOMBRE); ?></td>
                            <td><?php echo $CLIENTE; ?></td>
                            <td><?php echo $STATUS_AARSA; ?></td>
                            <td><?php echo $GESTOR; ?></td>
                            <td><?php echo $FECHA_PROMESA1; ?></td>
                            <td class='num'><?php echo number_format($MONTO_PROMESA1, 0); ?></td>
                            <td><?php echo $FECHA_PROMESA2; ?></td>
                            <td class='num'><?php echo number_format($MONTO_PROMESA2, 0); ?></td>
                            <td><?php echo $FECHA_PROMESA3; ?></td>
                            <td class='num'><?php echo number_format($MONTO_PROMESA3, 0); ?></td>
                            <td><?php echo $FECHA_PROMESA4; ?></td>
                            <td class='num'><?php echo number_format($MONTO_PROMESA4, 0); ?></td>
                            <td class='num'><?php echo number_format($MONTO_PAGO, 0); ?></td>
                            <td style='background-color:<?php echo $color; ?>'><?php echo $semtext; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <script>
            $('#rotasTable').dataTable({
                "bPaginate": false
            });
            $('tr:odd').addClass('odd');
        </script>
    </body>
</html>
