<!DOCTYPE html>
<html lang="es">
<head>
    <title>CobraMas Visitador Checklist</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"
          type="text/css" media="all"/>
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
        if ($resultMain) {
            foreach ($resultMain as $row) {
                $sc = $sc + 1;
                $sm = $sm + $row->saldo_total;
                ?>
                <tr>
                    <td><?php echo $row->id_cuenta; ?></td>
                    <td><?php echo $row->numero_de_cuenta; ?></td>
                    <td><?php echo $row->nombre_deudor; ?></td>
                    <td><?php echo $row->cliente; ?></td>
                    <td><?php echo number_format($row->saldo_total, 0); ?></td>
                    <td><?php echo $row->queue; ?></td>
                    <td><?php echo $row->gestor; ?></td>
                    <td><?php echo $row->fechaout; ?></td>
                    <td><?php echo $row->fechain; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td><?php echo $sc; ?> cuentas</td>
            <td><?php echo number_format($sm, 0); ?></td>
            <td colspan=3>&nbsp;</td>
        </tr>
        </tfoot>
    </table>
</div>
<button onclick="window.location = 'reports.php?capt=<?php
echo $capt;
?>'">Regresar a la pagina administrativa
</button>
<br>
</body>
</html> 
