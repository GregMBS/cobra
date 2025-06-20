<!DOCTYPE html>
<html lang="es">
<head>
        <title>Cuentas gestionado por <?php
            /** @var string $gestor */
            echo $gestor;
        ?> en <?php
            /** @var string $fecha */
            echo $fecha;
        ?></title>
    <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css"
          rel="stylesheet" type="text/css"/>
    <style>
        .numeric {
            text-align: right;
        }
    </style>
</head>
<body>
<table class="ui-widget">
    <thead class="ui-widget-header">
    <tr>
        <th>CUENTA</th>
        <th>NOMBRE</th>
        <th>CLIENTE</th>
        <th>CAMPAÑA</th>
        <th>DIAS VENCIDOS</th>
        <th>SALDO TOTAL</th>
        <th>RESULTADOS</th>
        <th>FECHA PROMESA</th>
        <th>MONTO PROMESA</th>
        <th>HORA DE GESTION</th>
    </tr>
    </thead>
    <tbody class="ui-widget-content">
    <?php
                foreach ($result as $row) { ?>
        <tr>
            <td><a href='/resumen.php?go=FromMigo&i=0&field=id_cuenta&find=<?php
                echo $row->id_cuenta;
                ?>&capt=<?php
                if (isset($capt)) {
                    echo $capt;
                }
                ?>'><?php
                    echo $row->numero_de_cuenta;
                    ?></a></td>
            <td><?php echo htmlentities($row->nombre_deudor); ?></td>
            <td><?php echo $row->cliente; ?></td>
            <td><?php echo $row->status_de_credito; ?></td>
            <td><?php echo $row->dias_vencidos; ?></td>
            <td class="numeric"><?php echo number_format($row->saldo_total, 0); ?></td>
            <td><?php echo $row->status_aarsa; ?></td>
            <td><?php echo $row->d_prom; ?></td>
            <td class="numeric"><?php echo number_format($row->n_prom, 2); ?></td>
            <td><?php echo $row->c_hrin; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th><?php echo count($result); ?> cuentas</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th class="numeric">$<?php echo number_format($sumSaldo, 0); ?></th>
        <th></th>
        <th></th>
        <th class="numeric">$<?php echo number_format($sumProm, 2); ?></th>
        <th></th>
    </tr>
    </tfoot>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('table').dataTable({
            "bPaginate": false,
            "bJQueryUI": true
        });
    });
</script>
</body>
</html> 
