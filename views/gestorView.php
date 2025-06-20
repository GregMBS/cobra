<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php echo strtoupper($gestor); ?></title>
        <meta http-equiv="refresh" content="900"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style>
            .right { text-align: right }
        </style>
    </head>
    <body>
        <h2>PROMESAS Y PAGOS PARA <?php echo strtoupper($gestor); ?></h2>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>Fecha Prom.</th>
                    <th>Cuenta</th>
                    <th>Cliente</th>
                    <th>Monto Prom.</th>
                    <th>Monto Venc.</th>
                    <th>Saldo Desc.</th>
                    <th>Gestor de Prom.</th>
                    <th>Gestor Asig.</th>
                    <th>Monto Pago</th>
                    <th>Fecha Pago</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $sumpr = 0;
                $sump = 0;
                foreach ($result as $answerstart) {
                    $D_PROM = $answerstart['d_prom'];
                    $CUENTA = $answerstart['cuenta'];
                    $N_PROM = $answerstart['n_prom'];
                    $sumpr+=$N_PROM;
                    $C_CVGE = $answerstart['c_cvge'];
                    $GESTOR = $answerstart['ejecutivo_asignado_call_center'];
                    $STATUS = $answerstart['status_aarsa'];
                    $MSGC = $answerstart['saldo_vencido'];
                    $CLIENTE = $answerstart['cliente'];
                    $ID_CUENTA = $answerstart['id_cuenta'];
                    $S_D = $answerstart['saldo_descuento_1'];
                    $resultp = $gc->getPagos($CUENTA, $CLIENTE);
                    $MONTO = 0;
                    $FECHA = '';
                    foreach ($resultp as $answerp) {
                        $MONTO = $answerp['sm'];
                        $sump+=$MONTO;
                        if ($MONTO > 0) {
                            $FECHA = $answerp['mf'];
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $D_PROM; ?></td>
                        <td><a href='/resumen.php?go=FromProm&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td class="right"><?php echo number_format($N_PROM, 2); ?></td>
                        <td class="right"><?php echo number_format($MSGC, 2); ?></td>
                        <td class="right"><?php echo number_format($S_D, 2); ?></td>
                        <td><?php echo $C_CVGE; ?></td>
                        <td><?php echo $GESTOR; ?></td>
                        <td class="right"><?php echo number_format($MONTO, 2); ?></td>
                        <td><?php echo $FECHA; ?></td>
                        <td><?php echo $STATUS; ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td>SUM</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <th class="right"><?php echo number_format($sumpr, 2); ?></th>
                    <td class="right">&nbsp;</td>
                    <td class="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <th class="right"><?php echo number_format($sump, 2); ?></th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
