<?php
use app\PdoClass;
$pdoc        = new PdoClass();
$pdo         = $pdoc->dbConnectAdmin();
$capt        = filter_input(INPUT_GET, 'capt');
$tempmonto   = "create temporary table tempmonto
    select c_cvge,c_cvba,c_cont,
substring_index(group_concat(n_prom order by d_fech desc),',',1) as np
from historia
where d_prom>=curdate() and c_cniv is null
and d_fech>last_day(curdate()-interval 1 month)
group by c_cvge,c_cont";
$pdo->query($tempmonto);
$querymonto  = "select c_cvge,
sum(np) as snp
from resumen
join tempmonto
on c_cont=id_cuenta
group by c_cvge";
$resultmonto = $pdo->query($querymonto);
$tempdet     = "create temporary table tempdet
                    select c_cont,max(concat(d_fech, ' ', c_hrfi)) as dp from historia
where n_prom>0
and d_prom>last_day(curdate()-interval 1 month)
and d_fech>last_day(curdate()-interval 1 month)
group by c_cont";
$querydet    = "select c_cvge as 'gestor', c_cvba as 'cliente', status_de_credito,
queue, numero_de_cuenta, status_aarsa, c_cvst, n_prom1, d_prom1, n_prom2, d_prom2,
nombre_deudor as 'nombre', d_fech
from resumen
join historia on c_cont=id_cuenta
join tempdet on date(dp)=d_fech and time(dp)=c_hrfi
left join dictamenes on status_aarsa=dictamen
where d_prom>=curdate()
group by resumen.id_cuenta
order by c_cvge,numero_de_cuenta";
$resultdet   = $pdo->query($querydet);
$tempven     = "create temporary table tempven
                    select c_cont,max(auto) as dp from historia
where n_prom>0
and d_fech>last_day(curdate()-interval 1 month)
group by c_cont";
$pdo->query($tempven);
$queryven    = "select c_cvge as 'gestor', c_cvba as 'cliente', status_de_credito,
queue, numero_de_cuenta, status_aarsa as 'status de cuenta',
c_cvst as 'status de gestion', n_prom1, d_prom1, n_prom2, d_prom2,
nombre_deudor as 'nombre', max(folio) as 'folio',
sum(monto),sum(monto*confirmado), d_fech
from resumen
join historia on c_cont=id_cuenta
join tempven on dp=auto
left join dictamenes on status_aarsa=dictamen
left join folios on folios.cuenta=numero_de_cuenta and folios.cliente=resumen.cliente
left join pagos on pagos.id_cuenta=resumen.id_cuenta and pagos.fecha>d_fech
where d_prom<curdate()
group by resumen.id_cuenta
order by c_cvge,numero_de_cuenta";
$resultven   = $pdo->query($queryven);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Promesas</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.js" type="text/javascript"></script>
        <style>
            .num { text-align: right; }
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <h2>Promesas Vigentes del Mes Actual</h2>
        <table id="summary">
            <thead>
                <tr>
                    <th>Gestor de captura</th>
                    <th>Promesas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $SCS         = 0;
                foreach ($resultmonto as $row) {
                    $GESTOR = $row['c_cvge'];
                    $MONTO  = number_format($row['snp'], 2);
                    $SCS    = $SCS + $row['snp'];
                    ?>
                    <tr>
                        <td><?php echo $GESTOR; ?></td>
                        <td class="num"><?php echo $MONTO; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th>SUM</th>
                    <th class="num"><?php echo number_format($SCS, 2); ?></th>
                </tr>
            </tbody>
        </table>
        <h2>Detalles Vigentes</h2>
        <table id="vigentes">
            <thead>
                <tr>
                    <th>Gestor</th>
                    <th>Cliente</th>
                    <th>Campa&ntilde;a</th>
                    <th>Queue</th>
                    <th>Cuenta</th>
                    <th>Status Cuenta</th>
                    <th>Status Gestion</th>
                    <th>Monto 1</th>
                    <th>Fecha 1</th>
                    <th>Monto 2</th>
                    <th>Fecha 2</th>
                    <th>Titular</th>
                    <th>Fecha de Gestion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultdet as $row) {
                    $GESTOR   = $row['gestor'];
                    $CLIENTE  = $row['cliente'];
                    $CAMP     = $row['status_de_credito'];
                    $QUEUE    = $row['queue'];
                    $CUENTA   = $row['numero_de_cuenta'];
                    $SC       = $row['status_aarsa'];
                    $SG       = $row['c_cvst'];
                    $MONTO1   = number_format($row['n_prom1'], 2);
                    $FECHA1   = $row['d_prom1'];
                    $MONTO2   = number_format($row['n_prom2'], 2);
                    $FECHA2   = $row['d_prom2'];
                    $ASIGNADO = $row['nombre'];
                    $FECHAG   = $row['d_fech'];
                    ?>
                    <tr>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $CAMP; ?></td>
                        <td><?php echo $QUEUE; ?></td>
                        <td><?php echo $CUENTA; ?></td>
                        <td><?php echo $SC; ?></td>
                        <td><?php echo $SG; ?></td>
                        <td class="num"><?php echo $MONTO1; ?></td>
                        <td><?php echo $FECHA1; ?></td>
                        <td class="num"><?php echo $MONTO2; ?></td>
                        <td><?php echo $FECHA2; ?></td>
                        <td><?php echo $ASIGNADO; ?></td>
                        <td><?php echo $FECHAG; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <h2>Detalles Vencidos y Pagados</h2>
        <table id="vencidos">
            <thead>
                <tr>
                    <th>Gestor</th>
                    <th>Cliente</th>
                    <th>Campa&ntilde;a</th>
                    <th>Queue</th>
                    <th>Cuenta</th>
                    <th>Status Cuenta</th>
                    <th>Status Gestion</th>
                    <th>Monto 1</th>
                    <th>Fecha 1</th>
                    <th>Monto 2</th>
                    <th>Fecha 2</th>
                    <th>Titular</th>
                    <th>Folio</th>
                    <th>Monto Pago</th>
                    <th>Monto Confirmado</th>
                    <th>Fecha de Gestion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultven as $row) {
                    $GESTOR   = $row['gestor'];
                    $CLIENTE  = $row['cliente'];
                    $CAMP     = $row['status_de_credito'];
                    $QUEUE    = $row['queue'];
                    $CUENTA   = $row['numero_de_cuenta'];
                    $SC       = $row['status_aarsa'];
                    $SG       = $row['c_cvst'];
                    $MONTO1   = number_format($row['n_prom1'], 2);
                    $FECHA1   = $row['d_prom1'];
                    $MONTO2   = number_format($row['n_prom2'], 2);
                    $FECHA2   = $row['d_prom2'];
                    $ASIGNADO = $row['nombre'];
                    $FECHAG   = $row['d_fech'];
                    ?>
                    <tr>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $CAMP; ?></td>
                        <td><?php echo $QUEUE; ?></td>
                        <td><?php echo $CUENTA; ?></td>
                        <td><?php echo $SC; ?></td>
                        <td><?php echo $SG; ?></td>
                        <td class="numcs"><?php echo $MONTO1; ?></td>
                        <td><?php echo $FECHA1; ?></td>
                        <td class="numcs"><?php echo $MONTO2; ?></td>
                        <td><?php echo $FECHA2; ?></td>
                        <td><?php echo $ASIGNADO; ?></td>
                        <td><?php echo $FOLIO; ?></td>
                        <td><?php echo $MONTO; ?></td>
                        <td><?php echo $MONTOC; ?></td>
                        <td><?php echo $FECHAG; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                    $('#summary').dataTable({
                            "bPaginate": false,
                            "oLanguage": {
                                    "sUrl": "espanol.txt"
                            }
                    });
                    $('#vigentes').dataTable({
                            "bPaginate": false,
                            "oLanguage": {
                                    "sUrl": "espanol.txt"
                            }
                    });
                    $('#vencidos').dataTable({
                            "bPaginate": false,
                            "oLanguage": {
                                    "sUrl": "espanol.txt"
                            }
                    });
            });
        </script>
    </body>
</html> 
