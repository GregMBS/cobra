<?php
/*
  include 'elastix.conf';

  $cols=array(0,1,2,7,11);
  $host = $server;
  $user = $mysql_user;
  $pwd = $mysql_pass;
  $db = $mysql_db;

  if ($elastix==1) {
  $cone = mysql_connect($host,$user,$pwd);
  if ($cone) {
  mysql_select_db($db,$cone) or die ("Could not select $db database");
  $querycell="SELECT sum(billsec)/60 from cdr
  where dst like '04___________'
  and date(calldate)>last_day(curdate()-interval 1 month)";
  $resultcell=mysql_query($querycell);
  while ($answercell=mysql_fetch_row($resultcell)) {$celltime=$answercell[0];}
  mysql_close($cone);
  }
  }
 */
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$get  = filter_input_array(INPUT_GET);

$folios = 0;
$errors = 0;
if ($capt == 'gmbs') {
    $querytrouble  = "select count(1) as ct
        from trouble  
        where it_guy is null
        ;";
    $resulttrouble = $pdo->query($querytrouble);
    foreach ($resulttrouble as $answertrouble) {
        $errors = $answertrouble['ct'];
    }
}
$fout       = 9999;
$queryfout  = "select count(distinct folio) as folct
        from folios  
        where usado = 0 
        and enviado = 0 
        and cliente like 'Credito Si%' 
        ;";
$resultfout = $pdo->query($queryfout);
foreach ($resultfout as $answerfout) {
    $fout = $answerfout['folct'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quick Performance</title>
        <meta http-equiv="refresh" content="60"/>
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="bower_components/datatables/media/css/jquery.dataTables.css">
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style>
            tr.odd { background-color: white }
            tr.even { background-color: #dddddd }
        </style>
    </head>
    <body>
        <script>
            $(function () {
                $("#tab").tabs();
                $("body").css("font-size", "10pt");
                $(".rightnow a,#pbx,input[submit],button").button();
                $('#AHORAtab').dataTable({
                    "sAjaxSource": "quick_ahora_ajax.php",
                    "bPaginate": false,
                    "bLengthChange": false,
                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        url = 'logout.php?gone=forgot&capt=' + aData[0];
                        if (aData[10] === aData[0]) {
                            $('td:eq(10)', nRow).html('<a href=' + url + ' target="_blank">LOGOUT</a>');
                        }
                        else {
                            $('td:eq(10)', nRow).html(aData[10]);
                        }
                        if (aData[1]) {
                            $('td:eq(1)', nRow).html('<a href="resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=' + aData[11] + '&capt=<?php echo $capt; ?>">' + aData[1] + '</a>');
                        }
                        if ((aData[6] + 0) > 60) {
                            $('td:eq(6)', nRow).css('background-color', 'red');
                        }
                        return nRow;
                    },
                    "bJQueryUI": true});
                $('#PORHORAtab').dataTable({
                    "sAjaxSource": "quick_porhora_ajax.php",
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bJQueryUI": true});
                $('#PORDIAtab').dataTable({
                    "sAjaxSource": "quick_hoy_ajax.php",
                    "bPaginate": false,
                    "bLengthChange": false,
                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        if (aData[6] * 1 > aData[5] * 6) {
                            $('td:eq(6)', nRow).css('background-color', 'red');
                        }
                        return nRow;
                    },
                    "bJQueryUI": true});
                $('#BREAKStab').dataTable({
                    "sAjaxSource": "quick_breaks_ajax.php",
                    "bJQueryUI": true
                });
                $(".rightnow a,#pbx,#cell,input[submit],button").button();
            });
        </script>
        <div id="tab">
            <ul>
                <li><a href="#AHORA">AHORA</a></li>
                <li><a href="#BREAKS">BREAKS</a></li>
                <li><a href="#PORHORA">ULTIMA HORA</a></li>
                <li><a href="#PORDIA">HOY</a></li>
            </ul>
            <div id='AHORA'>
                <table summary="right now" id="AHORAtab">
                    <thead>
                        <tr>
                            <th>Gestor</th>
                            <th>Cuenta</th>
                            <th>Nombre<br>Deudor</th>
                            <th>Cliente</th>
                            <th>Camp</th>
                            <th>Status</th>
                            <th>Tiempo en este cuenta (min)</th>
                            <th>Queue</th>
                            <th>Sistema</th>
                            <th>Login</th>
                            <th>Logout</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div id='BREAKS'>
                <table summary="Braeks" id='BREAKStab'>
                    <thead>
                        <tr>
                            <th>Gestor</th>
                            <th>Tipo</th>
                            <th>de</th>
                            <th>a</th>
                            <th>Minutes</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div id='PORHORA'>
                <table summary="Hora" id='PORHORAtab'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Contactos</th>
                            <th>Gestiones</th>
                            <th>Promesas</th>
                            <th>% Contactos</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div id='PORDIA'>
                <table summary="Hoy" id="PORDIAtab">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Gestiones</th>
                            <th>Promesas Hoy</th>
                            <th>$ Promesas Hoy</th>
                            <th>Negociaciones</th>
                            <th>Horas</th>
                            <th>Break min</th>
                            <th>Gestiones por hora</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <?php
            if ($folios > 0) {
                echo '<p><a class="butt" href="folioadmin.php?capt='.$capt.'#here0">'.$folios.' folios pendiente</a></p>';
            }
            if ($fout < 10) {
                echo '<h4>Solo tenemos '.$fout.'  disponible para Credito Si</h4>';
            }
//if ($celltime>0) {echo '<h4>Hemos usado '.ceil($celltime).' minutos de celular este mes</h4>';}
            ?>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <p>
            <a id='pbx' href='pbxqueues.php?capt=<?php echo $capt; ?>' target='_blank'>
                Control de PBX</a>
            <a id='cell' href='cellcall2.php?capt=<?php echo $capt; ?>' target='_blank'>
                Llamada Celular</a>
        </p>
    </body>
</html>
