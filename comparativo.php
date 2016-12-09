<?php
require_once 'pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectAdmin();
$capt      = filter_input(INPUT_GET, 'capt');
$querymain = "select c_cvba, mdf, sum(gest) as sg, sum(contact) as sc,
    sum(prom) as sp, count(distinct c_cvge) as cg,
    count(distinct c_cvge,hour(c_hrin)) as ch
from (
select c_cvba,month(d_fech) as mdf,c_cont,1 as tot,
max(if(c_msge is null,1,0)) as gest,
max(if(c_carg <>'',1,0)) as contact,
max(if(n_prom >0,1,0)) as prom,c_cvge,c_hrin
from historia where d_fech>=curdate()-interval 3 month 
and day(d_fech)<day(curdate())
and c_cont>0
group by c_cont,mdf) as tmp
group by c_cvba,mdf;
";
$result    = $pdo->query($querymain);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Comparativo de 3 Meses</title>

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.jqueryui.min.js" type="text/javascript"></script>
        <style>
            tr.odd { background-color: white }
            tr.even { background-color: #dddddd }
            tr.now { background-color: yellow }
        </style>

    </head>
    <body>
        <script>
            $(function() {
                $( "input:submit, a, button" ).button();
                $( "body" ).css("font-size", "10pt");
            });
        </script>
        <h1>COMPARATIVO</h1>
        <button onClick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar al administraci&oacute;n</button>
        <table summary="Cuentas" id='buscartab' class='ui-widget'>
            <thead class='ui-widget-header'>
                <tr>
                    <th>CLIENTE</th>
                    <th>MES</th>
                    <th>GESTIONES</th>
                    <th>CONTACTOS</th>
                    <th>% CONTACT</th>
                    <th>PROMESAS</th>
                    <th>% PROMESAS POR CONTACT</th>
                    <th>GESTORES</th>
                    <th>HORAS-HOMBRES</th>
                </tr>
            </thead>
            <tbody class='ui-widget-content'>
                <?php
                $class     = array('now', 'odd', 'even');
                $i         = 0;
                foreach ($result as $answer) {
                    $i         = ($i + 1) % 3;
                    $cliente   = $answer['c_cvba'];
                    $mes       = $answer['mdf'];
                    $gestiones = $answer['sg'];
                    $contactos = $answer['sc'];
                    $pc        = round($contactos / $gestiones * 100);
                    $promesas  = $answer['sp'];
                    $pp        = round($promesas / $contactos * 100);
                    $gestores  = $answer['cg'];
                    $manhours  = $answer['ch'];
                    ?>
                    <tr class='<?php echo $class[$i]; ?>'>
                        <td><?php echo $cliente; ?></td>
                        <td><?php echo $mes; ?></td>
                        <td><?php echo $gestiones; ?></td>
                        <td><?php echo $contactos; ?></td>
                        <td><?php echo $pc; ?>%</td>
                        <td><?php echo $promesas; ?></td>
                        <td><?php echo $pp; ?>%</td>
                        <td><?php echo $gestores; ?></td>
                        <td><?php echo $manhours; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html> 
