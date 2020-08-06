<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Cuentas gestionado por <?php 
        echo $gestor;
        ?> en <?php 
        echo $fecha;
        ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" 
              href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" 
              type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="Cuentas">
            <thead>
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
            <tbody>
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
                        <td><?php echo number_format($row->saldo_total, 0); ?></td>
                        <td><?php echo $row->status_aarsa; ?></td>
                        <td><?php echo $row->d_prom; ?></td>
                        <td><?php echo number_format($row->n_prom, 0); ?></td>
                        <td><?php echo $row->c_hrin; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <script>
            $(function () {
                $('#Cuentas').dataTable({"bJQueryUI": true});
            });
        </script>
    </body>
</html>
