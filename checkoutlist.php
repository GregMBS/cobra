<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$vst  = filter_input(INPUT_GET, 'visitador');
$visitstr = '';
$visitador = 'TODOS';
if (isset($vst)) {
    $queryn  = "SELECT completo FROM nombres
where iniciales=:vst
limit 1;";
    $stn     = $pdo->prepare($queryn);
    $stn->bindParam(':vst', $vst);
    $stn->execute();
    $resultn = $stn->fetch(PDO::FETCH_ASSOC);
    if ($resultn) {
        $visitador = $resultn['completo'];
        $visitstr  = " and gestor=:vst ";
    }
}

$querymain = "SELECT id_cuenta, gestor, cuenta, saldo_total, cliente,
    q(status_aarsa) as 'queue', nombre_deudor as nombre, fechaout, fechain
FROM vasign,resumen 
where (c_cont=id_cuenta)
and fechaout > last_day(curdate()) - interval 3 month - interval 1 day
".$visitstr."
order by gestor,fechaout,cuenta+0
;";
$stm       = $pdo->prepare($querymain);
if ($visitador != 'TODOS') {
    $stm->bindParam(':vst', $vst);
}
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA Visitador Checklist</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="vtable">
            <p>Visitador: <?php echo $visitador; ?><br>
                Autorizó por: <?php echo $capt; ?></p>
            Fecha: <?php echo date('d/m/Y'); ?></p>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>ID CUENTA</th>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SALDO TOTAL</th>
                    <th>QUEUE</th>
                    <th>GESTOR</th>
                    <th>FECHA DE ASIGNA</th>
                    <th>FECHA DE REGRESA</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $sc     = 0;
                $sm     = 0;
                if ($result) {
                    foreach ($result as $answer) {
                        $GESTOR   = $answer['gestor'];
                        $ID_CUENTA   = $answer['id_cuenta'];
                        $CUENTA   = $answer['cuenta'];
                        $ST       = $answer['saldo_total'];
                        $CLIENTE  = $answer['cliente'];
                        $QUEUE    = $answer['queue'];
                        $NOMBRE   = $answer['nombre'];
                        $FECHAOUT = $answer['fechaout'];
                        $FECHAIN  = $answer['fechain'];
                        $sc       = $sc + 1;
                        $sm       = $sm + $ST;
                        ?>
                        <tr>
                            <td><?php echo $ID_CUENTA; ?></td>
                            <td><?php echo $CUENTA; ?></td>
                            <td><?php echo $NOMBRE; ?></td>
                            <td><?php echo $CLIENTE; ?></td>
                            <td><?php echo number_format($ST, 0); ?></td>
                            <td><?php echo $QUEUE; ?></td>
                            <td><?php echo $GESTOR; ?></td>
                            <td><?php echo $FECHAOUT; ?></td>
                            <td><?php echo $FECHAIN; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td><?php echo $sc; ?> cuentas</td>
                    <td><?php echo number_format($sm, 0); ?></td>
                    <td colspan=3>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
</body>
</html> 
