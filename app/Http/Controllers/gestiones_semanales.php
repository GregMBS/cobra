<!DOCTYPE html>
<html>
    <head>
        <title>Reporte de Gestiones de la semana actual</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <style>
            .num {text-align: right;}
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#General').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    }
                });
            });
        </script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la plantilla administrativa</button><br>
        <h1><?php
            $when   = date_create("yesterday");
            echo date_format($when, 'd M Y')
            ?></h1>
        <table id="General" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>Gestor</th>
                    <th>Gestiones</th>
                    <th>Contactos</th>
                    <th>Sin contactos</th>
                    <th>% de Penetraci&oacute;n</th>
                    <th>PTP</th>
                    <th>% PTP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $CG     = 0;
                $SG     = 0;
                $SC     = 0;
                $SNC    = 0;
                $SPTP   = 0;
                $query  = "select c_cvge as 'gestor',
count(1) as 'gestiones',sum(c_carg<>'') as 'contactos',
count(1)-sum(c_carg<>'') as 'sincontactos',
sum(c_carg<>'')/count(1) as 'penetracion',
sum(queue like 'PR%') as 'PTP', 
sum(queue like 'PR%')/sum(c_carg<>'') as 'pcPTP'
from historia 
join dictamenes on dictamen=c_cvst
where week(d_fech)=week(curdate())
and year(d_fech)=year(curdate())
and c_cont>0 group by c_cvge";
                $result = $pdo->query($query);
                foreach ($result as $row) {
                    $GESTOR      = $row['gestor'];
                    $CG++;
                    $GESTIONES   = $row['gestiones'];
                    $SG          = $SG + $GESTIONES;
                    $CONTACTOS   = $row['contactos'];
                    $SC          = $SC + $CONTACTOS;
                    $NOCONTACTOS = $row['sincontactos'];
                    $SNC         = $SNC + $NOCONTACTOS;
                    $PCP         = number_format($row['penetracion'] * 100, 0);
                    $SPCP        = number_format($SC / $SG * 100, 0);
                    $PTP         = $row['PTP'];
                    $SPTP        = $SPTP + $PTP;
                    $PCPTP       = number_format($row['pcPTP'] * 100, 0);
                    $SPCPTP      = number_format($SPTP / $SC * 100, 0);
                    ?>
                    <tr>
                        <td><?php echo $GESTOR; ?></td>
                        <td class="num"><?php echo $GESTIONES; ?></td>
                        <td class="num"><?php echo $CONTACTOS; ?></td>
                        <td class="num"><?php echo $NOCONTACTOS; ?></td>
                        <td class="num"><?php echo $PCP; ?>%</td>
                        <td class="num"><?php echo $PTP; ?></td>
                        <td class="num"><?php echo $PCPTP; ?>%</td>
                    </tr>
                <?php } ?>
            <tfoot>
                <tr>
                    <th><?php echo $CG; ?> GESTORES</th>
                    <th class="num"><?php echo $SG; ?></th>
                    <th class="num"><?php echo $SC; ?></th>
                    <th class="num"><?php echo $SNC; ?></th>
                    <th class="num"><?php echo $SPCP; ?>%</th>
                    <th class="num"><?php echo $SPTP; ?></th>
                    <th class="num"><?php echo $SPCPTP; ?>%</th>
                </tr>
            </tfoot>
            </tbody>
        </table>
    </tbody>
</table>
</body>
</html>
