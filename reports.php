<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE html>
<html>
<head>
<title>Cobra Reports Menu</title>
		<link rel="Stylesheet" href="css/redmond/jquery-ui.css" />
		<script type="text/javascript" charset="utf8" src="js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" charset="utf8" src="js/jquery-ui-1.8.13.custom.min.js"></script>
</head>
<body id="demos">
<script>
	$(function() {
		$( "#tabs" ).tabs();
		$( "button" ).button();
		$( "button" ).css("vertical-align", "bottom");
		$( "button" ).width("4cm");
		$( "button" ).height("1.6cm");
		$( "body" ).css("font-size", "8pt");
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
<button onclick="window.location='gestoradmin.php?capt=<?php echo $capt;?>'">Administrar Acesso</button>
<button onclick="window.location='breakadmin.php?capt=<?php echo $capt;?>'">Administrar Breaks</button>
<button onclick="window.location='queues.php?capt=<?php echo $capt;?>'">Administrar Queues</button>
<button onclick="window.location='notadmin.php?capt=<?php echo $capt;?>'">Administrar Notas</button>
<button onclick="window.location='segmentadmin.php?capt=<?php echo $capt;?>'">Administrar Segmetos</button><br>
<button onclick="window.location='changest.php?capt=<?php echo $capt;?>'">Cambiar Status de Credito</button>
<button onclick="window.location='inactivar.php?capt=<?php echo $capt;?>'">Inactivar Cuentas</button><br>
	</div> 
	<div id="gen"> 
<h2>Reportes Generales</h2>
<!--<button onclick="window.location='reportequeues.php?capt=<?php echo $capt;?>'">Queues por Gestor (Rapido)</button>-->
<button onclick="window.location='queuesqc.php?capt=<?php echo $capt;?>'">Queues por Cliente</button><br>
<button onclick="window.location='latest_best.php?capt=<?php echo $capt;?>'">Ultimo y Mejor Status</button>
<button onclick="window.location='pagosum.php?capt=<?php echo $capt;?>'">Pagos por Cliente</button>
<button onclick="window.location='horarios-old.php?capt=<?php echo $capt;?>'">Productividad Total este Mes</button>
<button onclick="window.location='horarios_clean.php?capt=<?php echo $capt;?>'">Productividad este Mes</button>
<button onclick="window.location='perfmes.php?capt=<?php echo $capt;?>'">Productividad Mes Anterior</button>
<button onclick="window.location='horariosv.php?capt=<?php echo $capt;?>'">Productividad Visit. este Mes</button>
<button onclick="window.location='perfmesv.php?capt=<?php echo $capt;?>'">Productividad Visit. Mes Ant.</button>
<button onclick="window.location='horarios_clean2.php?capt=<?php echo $capt;?>'">Nomina Confidential</button><br>
<button onclick="window.location='bigquery2.xls.php?capt=<?php echo $capt;?>'">Query de las Gestiones XLS</button>
<button onclick="window.location='inventario.csv.php?capt=<?php echo $capt;?>'">Query del Inventario</button>
<button onclick="window.location='Reporte_diario_special.php?capt=<?php echo $capt;?>'">Promesas y Pagos autoconfigurado HTML</button>
<button onclick="window.location='comparativo.php?capt=<?php echo $capt;?>'">Comparativo de 3 meses HTML</button><br>
<button onclick="window.location='tels_contactados.php?capt=<?php echo $capt;?>'">Reporte de Tel&eacute;fonos Contactados XLS</button>
<button onclick="window.location='tels_marcados.php?capt=<?php echo $capt;?>'">Reporte de Tel&eacute;fonos Marcados XLS</button>
	</div> 
	<div id="spec"> 
<h2>Reportes Specializados</h2>
<button onclick="window.location='folios_new.php?capt=<?php echo $capt;?>'">Carga Folios</button><br>
<br>
<h3>Credito Real</h3>
<button onclick="window.location='CreditoRealReport.php'">Reporte Lunes, Miercoles, Viernes para Credito Real</button>
<button onclick="window.location='CreditoRealFdm.php'">Reporte Mensual</button>
<br>
<h3>Credito Si, Surtifirme, Sales Finance</h3>
<button onclick="window.location='folioadmin2.php?capt=<?php echo $capt;?>'">Administrar CS Folios</button>
<button onclick="window.location='folioadmins.php?capt=<?php echo $capt;?>'">Administrar SDH Folios</button>
<button onclick="window.location='folioadminsf.php?capt=<?php echo $capt;?>'">Administrar SF Folios</button><br>
<button onclick="window.location='Layout_carga_de_gestiones_cs_mensual_new.txt.php?capt=<?php echo $capt;?>'">Layout 200 CS TXT</button>
<button onclick="window.location='Layout_carga_de_promesas_cs_mensual.txt.php?capt=<?php echo $capt;?>'">Layout 600 CS TXT</button><br>
<button onclick="window.location='Layout_carga_de_gestiones_sdh_mensual_new.txt.php?capt=<?php echo $capt;?>'">Layout 200 SDH TXT</button>
<button onclick="window.location='Layout_carga_de_promesas_sdh_mensual.txt.php?capt=<?php echo $capt;?>'">Layout 600 SDH TXT</button><br>
<button onclick="window.location='Layout_carga_de_gestiones_sf_mensual_new.txt.php?capt=<?php echo $capt;?>'">Layout 200 SF TXT</button>
<button onclick="window.location='Layout_carga_de_promesas_sf_mensual.txt.php?capt=<?php echo $capt;?>'">Layout 600 SF TXT</button><br>
<button onclick="window.location='Productividad_CS.php?capt=<?php echo $capt;?>'">Productividad</button>
<button onclick="window.location='fdm-cs.php?capt=<?php echo $capt;?>'">Fin del Mes</button>
<button onclick="window.open('CS_daily.php?capt=<?php echo $capt;?>','Credito Si Auditario','width=400,height=200,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=yes')">Credito Si Auditario</button><br>
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
