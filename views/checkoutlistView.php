<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CobraMas Visitador Checklist</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" 
              href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" 
              type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="vtable">
            <p>Visitador: <?php echo $visitador; ?><br>
                Autorizó por: <?php echo $capt; ?><br>
            Fecha: <?php echo date('d/m/Y'); ?></p>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                        <th>ID_CUENTA</th>
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
$sc = 0;
$sm = 0;
if ($main) {
    foreach ($main as $answer) {
        $GESTOR = $answer['gestor'];
        $ID_CUENTA = $answer['id_cuenta'];
        $CUENTA = $answer['numero_de_cuenta'];
        $ST = $answer['saldo_total'];
        $CLIENTE = $answer['cliente'];
        $QUEUE = $answer['queue'];
        $NOMBRE = $answer['nombre_deudor'];
        $FECHAOUT = $answer['fechaout'];
        $FECHAIN = $answer['fechain'];
        $sc = $sc + 1;
        $sm = $sm + $ST;
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
    <button onclick="window.location = 'reports.php?capt=<?php 
    echo $capt;
    ?>'">Regresar a la pagina administrativa</button><br>
</body>
</html> 
