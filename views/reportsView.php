<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cobra Administraci&oacute;n</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
        <div data-role="page" id='Administracion'>
        <div data-role="header">
            <div data-role="navbar">
                <UL>
                    <LI><A href="#Administracion" class="ui-btn-active">Administraci&oacute;n</A></LI>
                    <LI><A href="#Generales">Reportes Generales</A></LI>
                </UL>
            </div>
        </div>
            <div data-role="collapsible">
                <h2>Cargar</h2>
                <button onclick="window.location = 'carga2.php?capt=<?php echo $capt; ?>'">Cargar Cartera</button>
            </div>
            <div data-role="collapsible">
                <h2>Visitar</h2>
                <button onclick="window.location = 'checkout.php?capt=<?php echo $capt; ?>'">Asignar Visitas</button>
                <button onclick="window.location = 'checkin.php?capt=<?php echo $capt; ?>'">Recibir Visitas</button>
            </div>
            <div data-role="collapsible">
                <h2>Administrar</h2>
                <button onclick="window.location = 'gestoradmin.php?capt=<?php echo $capt; ?>'">Administrar Acesso</button>
                <button onclick="window.location = 'breakadmin.php?capt=<?php echo $capt; ?>'">Administrar Breaks</button>
                <button onclick="window.location = 'queues.php?capt=<?php echo $capt; ?>'">Administrar Queues</button>
                <button onclick="window.location = 'notadmin.php?capt=<?php echo $capt; ?>'">Administrar Notas</button>
                <button onclick="window.location = 'segmentadmin.php?capt=<?php echo $capt; ?>'">Administrar Segmetos</button>
                <button onclick="window.location = 'changest.php?capt=<?php echo $capt; ?>'">Cambiar Status de Credito</button>
                <button onclick="window.location = 'inactivar.php?capt=<?php echo $capt; ?>'">Inactivar Cuentas</button>
            </div>
	    <div data-role="footer">
		<button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
        </div>
        </div>
        <div data-role="page" id='Generales'>
	    <div data-role="header">
		<div data-role="navbar">
		    <UL>
			<LI><A href="#Administracion">Administraci&oacute;n</A></LI>
			<LI><A href="#Generales" class="ui-btn-active">Reportes Generales</A></LI>
			<LI><A href="#Specializados">DEMOS</A></LI>
			<LI><A href="#ROBOT-ELASTIX">ROBOT y ELASTIX</A></LI>
		    </UL>
		</div>
	    </div>
            <div data-role="collapsible">
                <h2>Estatus de cuentas</h2>
                <button onclick="window.location = 'queuesqc.php?capt=<?php echo $capt; ?>'">Queues por Cliente</button>
                <button onclick="window.location = 'latest_best.php?capt=<?php echo $capt; ?>'">Ultimo y Mejor Status</button>
            </div>
            <div data-role="collapsible">
                <h2>Promesas y Pagos</h2>
                <button onclick="window.location = 'rotas.php?capt=<?php echo $capt; ?>'">Promesas del Mes Actual</button>
                <button onclick="window.location = 'pagosum.php?capt=<?php echo $capt; ?>'">Pagos por Cliente</button>
                <button onclick="window.location = 'pagodet.xlsx.php?capt=<?php echo $capt; ?>'">Pagos este mes (XLSX)</button>
            </div>
            <div data-role="collapsible">
                <h2>Recursos Humanos</h2>
                <button onclick="window.location = 'horarios_clean.php?capt=<?php echo $capt; ?>'">Productividad este Mes</button>
                <button onclick="window.location = 'perfmes.php?capt=<?php echo $capt; ?>'">Productividad Mes Anterior</button>
                <button onclick="window.location = 'horariosv.php?capt=<?php echo $capt; ?>'">Productividad Visit. este Mes</button>
                <button onclick="window.location = 'perfmesv.php?capt=<?php echo $capt; ?>'">Productividad Visit. Mes Ant.</button>
                <button onclick="window.location = 'horarios_clean2.php?capt=<?php echo $capt; ?>'">Solo uno Empleo</button><br>
            </div>
            <div data-role="collapsible">
                <h2>Gestiones y Inventarios de Deascargar</h2>
                <button onclick="window.location = 'bigquery2.xls.php?capt=<?php echo $capt; ?>'">Query de las Gestiones XLS</button>
                <button onclick="window.location = 'bigproms.php?capt=<?php echo $capt; ?>'">Query de las Promesas XLS</button>
                <button onclick="window.location = 'inventario.xls.php?capt=<?php echo $capt; ?>'">Query del Inventario XLS</button>
                <button onclick="window.location = 'inventario-rapid.xls.php?capt=<?php echo $capt; ?>'">Query del Inventario Rapido XLS</button>
            </div>
            <div data-role="collapsible">
                <h2>Miscelánea</h2>
                <button onclick="window.location = 'comparativo.php?capt=<?php echo $capt; ?>'">Comparativo de 3 meses HTML</button><br>
                <button onclick="window.location = 'tels_contactados.php?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Contactados XLS</button>
                <button onclick="window.location = 'tels_marcados.php?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Marcados XLS</button>
            </div>
        </div>
        <div data-role="footer">
            <button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
            <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
            <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button><br>
        </div>
    </body>
</html>
