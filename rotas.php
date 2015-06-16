<?php
require_once 'pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectUser();
$capt      = filter_input(INPUT_GET, 'capt');
$tipo      = $pdoc->tipo;
set_time_limit(300);
$gestorstr = " and (ejecutivo_asignado_call_center=:capt or c_cvge=:capt) ";
if ($tipo == 'admin') {
    $gestorstr = "";
}
$querymain = "select resumen.cliente,numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,c_cvge,
status_aarsa,n_prom1,d_prom1,n_prom2,d_prom2,
resumen.id_cuenta,datediff(curdate(),d_prom) as semaforo,d_fech,sum(monto) as sum_monto,
n_prom3,d_prom3,n_prom4,d_prom4
from resumen
join dictamenes on dictamen=status_aarsa
join historia h1 on id_cuenta=c_cont
left join pagos on pagos.id_cuenta=c_cont and fecha>=d_fech
where n_prom>0 and queue in ('CLIENTE NEGOCIANDO','PROMESAS', 'PROMESAS INCUMPLIDAS', 'PAGO PARCIAL')
and status_de_credito not regexp 'inactivo$'
and d_prom>last_day(curdate()-interval 1 month)
and d_fech>last_day(curdate()-interval 2 month)
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont 
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
".$gestorstr."
group by c_cvge,cliente,status_de_credito,numero_de_cuenta
order by c_cvge,sum(monto),d_prom
";
$stm       = $pdo->prepare($querymain);
if ($gestorstr !== '') {
    $stm->bindParam(':capt', $capt);
}
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Promesas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
        <script src="vendor/components/jquery/jquery.js" type="text/javascript"></script>
        <script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="cuentas">
            <thead>
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>CAMPA&Ntilde;A</th>
                    <th>GESTOR</th>
                    <th>SALDO TOTAL</th>
                    <th>RESULTADOS</th>
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
                $j      = 0;
                $oldc   = 0;
                $spr    = 0;
                $spa    = 0;
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
                    $spr               = $spr + $MONTO_PROMESA1 + $MONTO_PROMESA2
                        + $MONTO_PROMESA3 + $MONTO_PROMESA4;
                    $MONTO_PAGO        = $row['sum_monto'];
                    $spa               = $spa + $MONTO_PAGO;
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
                        $color   = 'green';
                        $semtext = 'PAGO';
                    }
                    if ($oldc != $ID_CUENTA) {
                        $oldc = $ID_CUENTA;
                        ?>
                        <tr>
                            <td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>'><?php echo $CUENTA; ?></a></td>
                            <td><?php echo htmlentities($NOMBRE); ?></td>
                            <td><?php echo $CLIENTE; ?></td>
                            <td><?php echo $STATUS_DE_CREDITO; ?></td>
                            <td><?php echo $GESTOR; ?></td>
                            <td class='num'><?php echo number_format($MONTOTOTAL, 0); ?></td>
                            <td><?php echo $STATUS_AARSA; ?></td>
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
            <tfoot>
                <tr>
                    <td colspan=10>&nbsp;</td>
                    <td class='num'><b><?php echo number_format($spr, 0); ?></b></td>
                    <td class='num'><b><?php echo number_format($spa, 0); ?></b></td>
                </tr>
            </tfoot>
        </table>
        <script>
            $(function() {
                $('#cuentas').dataTable({"bJQueryUI": true});
            });
        </script>
    </body>
</html>
