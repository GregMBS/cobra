<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cobra Reports Menu</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
</head>
<body id="demos">
<script>
	$(function() {
		$( "#tabs" ).tabs();
		$( "button" ).button();
		$( "button" ).width("5cm");
		$( "button" ).height("2cm");
		$( "button" ).css("vertical-align", "bottom")
		$( "body" ).css("font-size", "10pt")
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
<button onclick="window.location='carga2.php?capt=<?php echo $capt;?>'">Cargar Cartera</button>
<button onclick="window.location='pagobulk.php?capt=<?php echo $capt;?>'">Cargar Pagos Confirmados</button>
<button onclick="window.location='carga_cedula.php?capt=<?php echo $capt;?>'">Cargar y imprimir Cedulas</button><br>
<h2>Visitas</h2>
<button onclick="window.location='checkout.php?capt=<?php echo $capt;?>'">Asignar Visitas</button>
<button onclick="window.location='checkin.php?capt=<?php echo $capt;?>'">Recibir Visitas</button><br>
<h2>Administraci&oacute;n</h2>
<button onclick="window.location='gestoradmin.php?capt=<?php echo $capt;?>'">Administrar Acceso</button>
<button onclick="window.location='breakadmin.php?capt=<?php echo $capt;?>'">Administrar Breaks</button>
<button onclick="window.location='queues.php?capt=<?php echo $capt;?>'">Administrar Queues</button>
<button onclick="window.location='notadmin.php?capt=<?php echo $capt;?>'">Administrar Notas</button><br>
<button onclick="window.location='changest.php?capt=<?php echo $capt;?>'">Cambiar Status de Credito</button><br>
	</div> 
	<div id="gen"> 
<h2>Reportes Generales</h2>
<!--<button onclick="window.location='reportequeues.php?capt=<?php echo $capt;?>'">Queues por Gestor (Rapido)</button>-->
<button onclick="window.location='queuesq.php?capt=<?php echo $capt;?>'">Queues por Gestor</button>
<button onclick="window.location='queuesqc.php?capt=<?php echo $capt;?>'">Queues por Cliente</button><br>
<button onclick="window.location='latest_best.php?capt=<?php echo $capt;?>'">Ultimo y Mejor Status</button>
<button onclick="window.location='pagosum.php?capt=<?php echo $capt;?>'">Pagos por Cliente</button>
<button onclick="window.location='pagoporgestor.php?capt=<?php echo $capt;?>'">Pagos por Gestor</button>
<button onclick="window.location='promesaporgestor.php?capt=<?php echo $capt;?>'">Promesas por Gestor</button><br>
<button onclick="window.location='horarios.php?capt=<?php echo $capt;?>'">Productividad Total este Mes</button>
<button onclick="window.location='horarios_clean.php?capt=<?php echo $capt;?>'">Productividad este Mes</button>
<button onclick="window.location='perfmes.php?capt=<?php echo $capt;?>'">Productividad Mes Anterior</button>
<button onclick="window.location='horariosv.php?capt=<?php echo $capt;?>'">Productividad Visit. este Mes</button>
<button onclick="window.location='perfmesv.php?capt=<?php echo $capt;?>'">Productividad Visit. Mes Ant.</button>
<button onclick="window.location='horarios_clean2.php?capt=<?php echo $capt;?>'">Nomina Confidential</button><br>
<button onclick="window.location='bigquery2.xls.php?capt=<?php echo $capt;?>'">Query de las Gestiones XLS</button>
<button onclick="window.location='inventario.xls.php?capt=<?php echo $capt;?>'">Query del Inventario XLS</button>
<button onclick="window.location='bigproms.php?capt=<?php echo $capt;?>'">Query de las Promesas</button>
<button onclick="window.location='bigpromsv.php?capt=<?php echo $capt;?>'">Query de las Promesas Visit.</button>
<!--<button onclick="window.location='Reporte_diario.xls.php?capt=<?php echo $capt;?>'">Promesas y Pagos XLS</button>-->
<!--<button onclick="window.location='Reporte_diario.php?capt=<?php echo $capt;?>'">Promesas y Pagos HTML</button>
-->
<button onclick="window.location='Reporte_diario_special.php?capt=<?php echo $capt;?>'">Promesas y Pagos autoconfigurado HTML</button>
<!--
<button onclick="window.location='Reporte_mes_anterior.php?capt=<?php echo $capt;?>'">Promesas y Pagos del mes anterior HTML</button>
<button onclick="window.location='Reporte_mes_anterior_special.php?capt=<?php echo $capt;?>'">Promesas y Pagos del mes anterior sin ultimo d&iacute;a HTML</button>
<button onclick="window.location='Reporte_mes_anterior_extraspecial.php?capt=<?php echo $capt;?>'">Promesas y Pagos del mes anterior hasta mismo dia como hoy HTML</button><br>
-->
<button onclick="window.location='Reporte_diario_anterior.php?capt=<?php echo $capt;?>'">Promesas y Pagos del mes anterior HTML</button><br>
<button onclick="window.location='tels_contactados.php?capt=<?php echo $capt;?>'">Reporte de Tel&eacute;fonos Contactados XLS</button>
<button onclick="window.location='tels_marcados.php?capt=<?php echo $capt;?>'">Reporte de Tel&eacute;fonos Marcados XLS</button>
<!--<button onclick="window.location='gestiones_semanales.php?capt=<?php echo $capt;?>'">Query de las Gestiones esta Semana</button>
<button onclick="window.location='gestiones_semana_anterior.php?capt=<?php echo $capt;?>'">Query de las Gestiones la Semana Anterior</button>
<button onclick="window.location='gestiones_ayer.php?capt=<?php echo $capt;?>'">Query de las Gestiones de Ayer</button>-->
	</div> 
	<div id="spec"> 
<h2>Reportes Specializados</h2>
<button onclick="window.location='folioadmin.php?capt=<?php echo $capt;?>'">Folios</button><br>
<br>
<h3>Credito Si</h3>
<button onclick="window.location='Layout_carga_de_gestiones_diarias.xls.php?capt=<?php echo $capt;?>'">Layout Diario XLS</button>
<button onclick="window.location='Layout_carga_de_gestiones_semanal.xls.php?capt=<?php echo $capt;?>'">Layout Semanal XLS</button>
<button onclick="window.location='Layout_carga_de_gestiones_cs_mensual_new.txt.php?capt=<?php echo $capt;?>'">Layout Mensual TXT</button>
<button onclick="window.location='Layout_carga_de_gestiones_cs_mensual_old.xls.php?capt=<?php echo $capt;?>'">Layout Mensual XLS</button>
<button onclick="window.location='Layout_carga_de_promesas_cs_mensual.txt.php?capt=<?php echo $capt;?>'">Layout Promesas Mensual TXT</button>
<button onclick="window.location='Productividad_CS.php?capt=<?php echo $capt;?>'">Productividad</button>
<button onclick="window.location='fdm-cs.php?capt=<?php echo $capt;?>'">Fin del Mes</button><br>
<h3>GE Capital</h3>
<button onclick="window.location='GE_sumario_operaciones.xls.php?capt=<?php echo $capt;?>'">Sumario Operaciones XLS</button>
<button onclick="window.location='GE_promesas_convenios.xls.php?capt=<?php echo $capt;?>'">Promesas y Convenios XLS</button>
	</div> 
	<div id="bot"> 
<h2>Controlar ROBOT y ELASTIX</h2>
<h3>ROBOT</h3>
<button onclick="window.location='cargatel.php?capt=<?php echo $capt;?>'">CARGAR ROBOT</button>
<button onclick="window.location='robocon.php?capt=<?php echo $capt;?>'">CONTROLAR ROBOT</button>
<button onclick="window.location='callfileedit.php?capt=<?php echo $capt;?>'">QUITAR de ROBOT</button>
<button onclick="window.location='robot_contactos.php?capt=<?php echo $capt;?>'">CONTACTOS para ROBOT</button>
<button onclick="window.location='robot_sin_contactos.php?capt=<?php echo $capt;?>'">SIN CONTACTOS para ROBOT</button>
<button onclick="window.location='robot_negociaciones.php?capt=<?php echo $capt;?>'">NEGOCIACIONES para ROBOT</button><br>
<h3>ELASTIX</h3>
<button onclick="window.location='pbxqueues.php?capt=<?php echo $capt;?>'">PBX Rapido</button>
<button onclick="window.location='elasticount.php?capt=<?php echo $capt;?>'">ELASTIX Rapido</button>
<button onclick="window.location='elastix.php?capt=<?php echo $capt;?>'">CONTACTOS para ELASTIX 90 D&Iacute;AS</button>
<button onclick="window.location='elastix_fresh.php?capt=<?php echo $capt;?>'">CONTACTOS para ELASTIX MES ACTUAL</button>
<button onclick="window.location='elastix2.php?capt=<?php echo $capt;?>'">SIN GESTIONES para ELASTIX</button>
<button onclick="window.location='elastix_cnp.php?capt=<?php echo $capt;?>'">NEGOCIACIONES y PROMESAS para ELASTIX</button>
<button onclick="window.location='elastix_msg.php?capt=<?php echo $capt;?>'">MENSAJES para ELASTIX</button>
<button onclick="window.location='elastix_sc.php?capt=<?php echo $capt;?>'">SIN CONTACTOS para ELASTIX</button>
<button onclick="window.location='elastix_tcasa.php?capt=<?php echo $capt;?>'">TEL CASA sin marcarpara ELASTIX</button>
<button onclick="window.location='elastix_tlab.php?capt=<?php echo $capt;?>'">TEL LABOTAL sin marcarpara ELASTIX</button>
<button onclick="window.location='elastix_tref.php?capt=<?php echo $capt;?>'">TEL REF sin marcar para ELASTIX</button>
<button onclick="window.location='elastikill.php?capt=<?php echo $capt;?>'">QUITAR de ELASTIX</button>
<button onclick="window.location='cellcall2.php?capt=<?php echo $capt;?>'">Marca Celulares</button>
<h3>OTROS</h3>
<button onclick="window.location='llamadas_desconocidas.php?capt=<?php echo $capt;?>'">LLAMADAS DESCONOCIDAS</button>
<button onclick="window.location='llamadas_desconocidas_ayer.php?capt=<?php echo $capt;?>'">LLAMADAS DESCONOCIDAS DE AYER</button><br>
	</div> 
</div> 
<p>
<button onclick="window.location='quick.php?capt=<?php echo $capt;?>'">Tiempo Real</button>
<button onclick="window.location='resumen.php?capt=<?php echo $capt;?>'">Las Cuentas</button>
<button onclick="window.location='resumen.php?capt=<?php echo $capt;?>&go=LOGOUT'">LOGOUT</button><br>
</p>
</body>
</html>
<?php
}
}
mysql_close();
?>
