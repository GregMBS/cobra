<?php
use cobra_salsa\PdoClass;
$pc	 = new PdoClass();
$pdo	 = $pc->dbConnectAdmin();
$capt	 = filter_input(INPUT_GET, 'capt');
?>
<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cobra Administraci&oacute;n</title>
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
        <div data-role="page" id='Administracion'>
	    <div data-role="header">
		<div data-role="navbar">
		    <UL>
			<LI><A href="#Administracion" class="ui-btn-active">Administraci&oacute;n</A></LI>
			<LI><A href="#Generales">Reportes Generales</A></LI>
			<LI><A href="#Specializados">DEMOS</A></LI>
			<LI><A href="#ROBOT-ELASTIX">ROBOT/PREDICTIVO</A></LI>
		    </UL>
		</div>
	    </div>
	    <div data-role="collapsible">
		<h2>Cargar</h2>
		<button onclick="window.location = 'carga2.php?capt=<?php echo $capt; ?>'">Cargar Cartera</button>
		<button onclick="window.location = 'carga_extras.php?capt=<?php echo $capt; ?>'">Cargar Productos</button>
		<button onclick="window.location = 'pagobulk.php?capt=<?php echo $capt; ?>'">Cargar Pagos Confirmados</button>
		<button onclick="window.location = 'upload.php?capt=<?php echo $capt; ?>'">Cargar Visitas desde INFONAVIT</button>
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
		<h3>Queues</h3>
		<button onclick="window.location = 'reportequeues.php?capt=<?php echo $capt; ?>'">Queues por Gestor (Rapido)</button>
		<button onclick="window.location = 'queuesqc.php?capt=<?php echo $capt; ?>'">Queues por Cliente</button>
            </div>
	    <div data-role="collapsible">
		<h2>Promesas / Pagos</h2>
		<button onclick="window.location = 'pagosum.php?capt=<?php echo $capt; ?>'">Pagos por Cliente</button>
		<button onclick="window.location = 'pagoporgestor.php?capt=<?php echo $capt; ?>'">Pagos por Gestor</button>
		<button onclick="window.location = 'promesaporgestor.php?capt=<?php echo $capt; ?>'">Promesas por Gestor</button>
            </div>
	    <div data-role="collapsible">
		<h2>Recursos Humanos</h2>
		<button onclick="window.location = 'horarios_clean.php?capt=<?php echo $capt; ?>'">Productividad este Mes</button>
		<button onclick="window.location = 'horariosv.php?capt=<?php echo $capt; ?>'">Productividad de Visitadores este Mes</button>
		<button onclick="window.location = 'perfmes.php?capt=<?php echo $capt; ?>'">Productividad Mes Anterior</button>
		<button onclick="window.location = 'perfmesv.php?capt=<?php echo $capt; ?>'">Productividad Visitadores Mes Anterior</button>
		<button onclick="window.location = 'horarios_clean2.php?capt=<?php echo $capt; ?>'">Nomina Confidential</button>
            </div>
	    <div data-role="collapsible">
		<h2>Gestiones</h2>
		<button onclick="window.location = 'bigquery2.xls.php?capt=<?php echo $capt; ?>'">Query de las Gestiones (XLS)</button>
		<button onclick="window.location = 'bigproms.php?capt=<?php echo $capt; ?>'">Query de las Promesas/Propuestas</button>
		<button onclick="window.location = 'gestiones_semanales.php?capt=<?php echo $capt; ?>'">Query de las Gestiones esta Semana</button>
		<button onclick="window.location = 'gestiones_semana_anterior.php?capt=<?php echo $capt; ?>'">Query de las Gestiones la Semana Anterior</button>
		<button onclick="window.location = 'gestiones_ayer.php?capt=<?php echo $capt; ?>'">Query de las Gestiones de Ayer</button>
                <button onclick="window.location = 'intensidad.php?capt=<?php echo $capt; ?>'">Query del Intensidad XLSX</button>
	    </div>
	    <div data-role="collapsible">
		<h2>Mejor Estatus</h2>
		<button onclick="window.location = 'latest_best.xls.php?capt=<?php echo $capt; ?>'">Ultimo y Mejor Status (Excel)</button>

		<button onclick="window.location = 'bigbest.xls.php?capt=<?php echo $capt; ?>'">Query de las Gestiones Mejoras (XLS)</button>
            </div>
	    <div data-role="collapsible">
		<h2>Inventarios</h2>
		<button onclick="window.location = 'inventario.xls.php?capt=<?php echo $capt; ?>'">Query del Inventario (XLSX)</button>
		<button onclick="window.location = 'inventario-rapid.xls.php?capt=<?php echo $capt; ?>'">Inventario R&aacute;pido (XLSX)</button>
            </div>
	    <div data-role="collapsible">
		<h2>Tel&eacute;fonos</h2>
		<button onclick="window.location = 'efectivos.xls.php?capt=<?php echo $capt; ?>'">Telefonos Efectivos (XLS)</button>
		<button onclick="window.location = 'efectivos_linear.xls.php?capt=<?php echo $capt; ?>'">Telefonos Efectivos - 1 columna (XLS)</button>
	    </div>
	    <div data-role="footer">
		<button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
	    </div>
        </div>
        <div data-role="page" id='Specializados'>
	    <div data-role="header">
		<div data-role="navbar">
		    <UL>
			<LI><A href="#Administracion">Administraci&oacute;n</A></LI>
			<LI><A href="#Generales">Reportes Generales</A></LI>
			<LI><A href="#Specializados" class="ui-btn-active">DEMOS</A></LI>
			<LI><A href="#ROBOT-ELASTIX">ROBOT y ELASTIX</A></LI>
		    </UL>
		</div>
	    </div>
	    <div data-role="footer">
		<button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
	    </div>
        </div>
        <div data-role="page" id='ROBOT-ELASTIX'>
	    <div data-role="header">
		<div data-role="navbar">
		    <UL>
			<LI><A href="#Administracion">Administraci&oacute;n</A></LI>
			<LI><A href="#Generales">Reportes Generales</A></LI>
			<LI><A href="#Specializados">DEMOS</A></LI>
			<LI><A href="#ROBOT-ELASTIX" class="ui-btn-active">ROBOT y ELASTIX</A></LI>
		    </UL>
		</div>
	    </div>
	    <div data-role="collapsible">
		<h3>ROBOT</h3>
		<button onclick="window.location = '#'">CARGAR ROBOT</button>
		<button onclick="window.location = '#'">CONTROLAR ROBOT</button>
		<button onclick="window.location = '#'">QUITAR de ROBOT</button>
		<button onclick="window.location = '#'">CONTACTOS para ROBOT</button>
            </div>
	    <!--
	    <div data-role="collapsible">
		<h3>ELASTIX</h3>
		<button onclick="window.location = '#'">PBX Rapido</button>
		<button onclick="window.location = '#'">ELASTIX Rapido</button>
		<button onclick="window.location = '#'">CONTACTOS para ELASTIX</button>
		<button onclick="window.location = '#'">SIN GESTIONES para ELASTIX</button>
		<button onclick="window.location = '#'">NEGOCIACIONES y PROMESAS para ELASTIX</button>
		<button onclick="window.location = '#'">MENSAJES para ELASTIX</button>
		<button onclick="window.location = '#'">TEL 1 REF 1 para ELASTIX</button>
		<button onclick="window.location = '#'">TEL 1 REF 2 para ELASTIX</button>
		<button onclick="window.location = '#'">QUITAR de ELASTIX</button>
		<button onclick="window.location = '#'">Marca Celulares</button>
            </div>
	    -->
	    <div data-role="collapsible">
		<h3>REPORTES</h3>
		<button onclick="window.location = '#'">LLAMADAS DESCONOCIDAS</button>
		<button onclick="window.location = '#'">LLAMADAS DESCONOCIDAS DE AYER</button>
	    </div>
	    <div data-role="footer">
		<button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
		<button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
	    </div>
        </div>
    </body>
</html>
