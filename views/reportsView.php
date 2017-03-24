<!DOCTYPE html>
<html>
    <head>
        <title>Cobra Reports Menu</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    </head>
    <body id="demos">
        <script>
	    $(function () {
		    $("#tabs").tabs();
		    $("button").button();
	    });
        </script>
        <div id="tabs">
            <ul>
                <li><a href="#admin">Administraci&oacute;n</a></li>
                <li><a href="#gen">Reportes Generales</a></li>
                <li><a href="#spec">Reportes por Clientes</a></li>
                <li><a href="#bot">ROBOT y ELASTIX</a></li>
            </ul>
            <div id="admin">
                <h2>Cargas</h2>
                <button onclick="window.location = 'carga2.php?capt=<?php echo $capt; ?>'">Cargar Cartera</button>
                <button onclick="window.location = 'pagobulk.php?capt=<?php echo $capt; ?>'">Cargar Pagos Confirmados</button>
                <h2>Visitas</h2>
                <button onclick="window.location = 'checkout.php?capt=<?php echo $capt; ?>'">Asignar Visitas</button>
                <button onclick="window.location = 'checkin.php?capt=<?php echo $capt; ?>'">Recibir Visitas</button>
                <button onclick="window.location = 'checkoutlist.php?capt=<?php echo $capt; ?>'">Check List</button><br>
                <h2>Administraci&oacute;n</h2>
                <button onclick="window.location = 'gestoradmin.php?capt=<?php echo $capt; ?>'">Administrar Acesso</button>
                <button onclick="window.location = 'breakadmin.php?capt=<?php echo $capt; ?>'">Administrar Breaks</button>
                <button onclick="window.location = 'queues.php?capt=<?php echo $capt; ?>'">Administrar Queues</button>
                <button onclick="window.location = 'notadmin.php?capt=<?php echo $capt; ?>'">Administrar Notas</button>
                <button onclick="window.location = 'segmentadmin.php?capt=<?php echo $capt; ?>'">Administrar Segmetos</button><br>
                <button onclick="window.location = 'changest.php?capt=<?php echo $capt; ?>'">
                    Cambiar Status de Credito</button>
                <!--
                <button onclick="window.location='changegest.php?capt=<?php echo $capt; ?>'">
                Cambiar Gestor Asignado</button>
                -->
                <button onclick="window.location = 'inactivar.php?capt=<?php echo $capt; ?>'">Inactivar Cuentas</button><br>
                <button onclick="window.location = 'activar.php?capt=<?php echo $capt; ?>'">Activar Cuentas</button><br>
            </div>
            <div id="gen">
                <h2>Reportes Generales</h2>
                <!--<button onclick="window.location='queuesqcg.php?capt=<?php echo $capt; ?>'">Queues por Gestor</button>-->
                <button onclick="window.location = 'queuesqc.php?capt=<?php echo $capt; ?>'">Queues por Cliente</button>
                <!--<button onclick="window.location='queueReview.php?capt=<?php echo $capt; ?>'">Reporte de Queues</button><br>-->
                <button onclick="window.location = 'latest_best.php?capt=<?php echo $capt; ?>'">Ultimo y Mejor Status</button>
                <button onclick="window.location = 'rotas.php?capt=<?php echo $capt; ?>'">Promesas del Mes Actual</button>
                <button onclick="window.location = 'pagosum.php?capt=<?php echo $capt; ?>'">Pagos por Cliente</button>
                <button onclick="window.location = 'pagodet.xlsx.php?capt=<?php echo $capt; ?>'">Pagos este mes (XLSX)</button>
                <button onclick="window.location = 'horarios_clean.php?capt=<?php echo $capt; ?>'">Productividad este Mes</button>
                <button onclick="window.location = 'perfmes.php?capt=<?php echo $capt; ?>'">Productividad Mes Anterior</button>
                <button onclick="window.location = 'horariosv.php?capt=<?php echo $capt; ?>'">Productividad Visit. este Mes</button>
                <button onclick="window.location = 'perfmesv.php?capt=<?php echo $capt; ?>'">Productividad Visit. Mes Ant.</button>
                <button onclick="window.location = 'comparativo.php?capt=<?php echo $capt; ?>'">Comparativo de 3 meses HTML</button><br>
                <button onclick="window.location = 'tels_contactados.php?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Contactados XLS</button>
                <button onclick="window.location = 'tels_marcados.php?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Marcados XLS</button>
            </div>
    </body>
</html>
