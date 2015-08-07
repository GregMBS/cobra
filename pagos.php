<?php
require_once 'pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectUser();
$capt      = filter_input(INPUT_GET, 'capt');
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$querycc   = "SELECT numero_de_cuenta, cliente
FROM resumen 
WHERE id_cuenta=:id";
$stc       = $pdo->prepare($querycc);
$stc->bindParam(':id', $ID_CUENTA);
$stc->execute();
$resultcc  = $stc->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultcc as $answercc) {
    $CUENTA  = $answercc['numero_de_cuenta'];
    $CLIENTE = $answercc['cliente'];
}
$querysub = "SELECT fecha,monto,confirmado
FROM cobra.pagos
WHERE id_cuenta=:id
ORDER BY fecha";
$sts      = $pdo->prepare($querysub);
$sts->bindParam(':id', $ID_CUENTA);
$sts->execute();
$rowsub   = $sts->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA Pagos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <link href="vendor/datatables/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="vendor/components/jquery/jquery.js" type="text/javascript"></script>
        <script src="vendor/datatables/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="pagobox">
            <p>
                CUENTA:&nbsp;&nbsp;<?php echo $CUENTA ?><br>
                CLIENTE:&nbsp;<?php echo $CLIENTE ?>
            </p>
            <table class="ui-widget" id="pagohead">
                <thead class='ui-widget-header'>
                    <tr>
                        <th>FECHA</th>
                        <th>MONTO</th>
                        <th>CONFIRMADO</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    foreach ($rowsub as $answer) {
                        $CF = "NO";
                        if ($answer['confirmado'] == 1) {
                            $CF = "S&Iacute;";
                        }
                        ?>
                        <tr>
                            <td><?php echo $answer['fecha']; ?></td>
                            <td><?php echo (float) $answer['monto']; ?></td>
                            <td><?php echo $CF; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <button onClick='window.close()'>CIERRA</button>
    </body>
</html> 
