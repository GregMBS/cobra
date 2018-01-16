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
                <button onclick="window.location = 'cargaPic.php?capt=<?php echo $capt; ?>'">Cargar Foto</button><br>
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
                <button onclick="window.location='queuemanual.php?capt=<?php echo $capt;?>'">Carga Queue MANUAL</button>
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
                <button onclick="window.location = 'pagodetant.xlsx.php?capt=<?php echo $capt; ?>'">Pagos mes anterior (XLSX)</button>
                <button onclick="window.location = 'horarios_clean.php?capt=<?php echo $capt; ?>'">Productividad este Mes</button>
                <button onclick="window.location = 'perfmes.php?capt=<?php echo $capt; ?>'">Productividad Mes Anterior</button>
                <button onclick="window.location = 'horariosv.php?capt=<?php echo $capt; ?>'">Productividad Visit. este Mes</button>
                <button onclick="window.location = 'perfmesv.php?capt=<?php echo $capt; ?>'">Productividad Visit. Mes Ant.</button>
                <button onclick="window.location = 'horarios_clean2.php?capt=<?php echo $capt; ?>'">Nomina Confidential</button><br>
                <button onclick="window.location = 'bigquery2.xls.php?capt=<?php echo $capt; ?>'">Query de las Gestiones XLS</button>
                <button onclick="window.location = 'bigproms.php?capt=<?php echo $capt; ?>'">Query de las Promesas XLS</button>
                <button onclick="window.location = 'pagosquery.php?capt=<?php echo $capt; ?>'">Query de Pagos XLS</button>
                <button onclick="window.location = 'inventario.xls.php?capt=<?php echo $capt; ?>'">Query del Inventario XLS</button>
                <button onclick="window.location = 'inventario-rapid.php?capt=<?php echo $capt; ?>'">Query del Inventario Rapido XLS</button>
<!--                <button onclick="window.location = 'Reporte_diario_special.php?capt=<?php echo $capt; ?>'">Promesas y Pagos autoconfigurado HTML</button>
                <button onclick="window.location = 'Reporte_diario_hace_mes.php?capt=<?php echo $capt; ?>'">Promesas y Pagos hace un mes HTML</button>-->
                <button onclick="window.location = 'comparativo.php?capt=<?php echo $capt; ?>'">Comparativo de 3 meses HTML</button><br>
                <button onclick="window.location = 'tels_contactados.php?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Contactados XLS</button>
                <button onclick="window.location = 'tels_marcados.php?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Marcados XLS</button>
            </div>
            <div id="spec">
                <h2>Reportes Specializados</h2>
<!--                <button onclick="window.location = 'folios_new.php?capt=<?php echo $capt; ?>'">Carga Folios</button><br>
                <br>-->
<!--                <h3>Credito Real</h3>
                <button onclick="window.location = 'CreditoRealReport.php?capt=<?php echo $capt; ?>'">Reporte Lunes, Miercoles, Viernes para Credito Real</button>
                <button onclick="window.location = 'CreditoRealFdm.php?capt=<?php echo $capt; ?>'">Reporte Mensual</button>
                <br>-->
<!--                <h3>Credito Si</h3>
                <button onclick="window.location = 'folioadmin2.php?capt=<?php echo $capt; ?>'">Administrar CS Folios</button>
                
                <button onclick="window.location='folioadmins.php?capt=<?php echo $capt; ?>'">Administrar SDH Folios</button><br>
                
                <button onclick="window.location = 'Layout_carga_de_gestiones_cs_mensual_new.txt.php?capt=<?php echo $capt; ?>'">Layout 200 CS Mensual TXT</button>
                <button onclick="window.location = 'Layout_carga_de_promesas_cs_mensual.txt.php?capt=<?php echo $capt; ?>'">Layout 600 CS Mensual TXT</button><br>
                <button onclick="window.location = 'Layout_carga_de_gestiones_cs_daily_new.txt.php?capt=<?php echo $capt; ?>'">Layout 200 CS Diario TXT</button>
                <button onclick="window.location = 'Layout_carga_de_promesas_cs_daily.txt.php?capt=<?php echo $capt; ?>'">Layout 600 CS Diario TXT</button><br>
                <button onclick="window.location = 'Layout_carga_de_gestiones_sdh_mensual_new.txt.php?capt=<?php echo $capt; ?>'">Layout 200 SDH Mensual TXT</button>
                <button onclick="window.location = 'Layout_carga_de_promesas_sdh_mensual.txt.php?capt=<?php echo $capt; ?>'">Layout 600 SDH Mensual TXT</button><br>
                <button onclick="window.location = 'Layout_carga_de_gestiones_sdh_daily_new.txt.php?capt=<?php echo $capt; ?>'">Layout 200 SDH Diario TXT</button>
                <button onclick="window.location = 'Layout_carga_de_promesas_sdh_daily.txt.php?capt=<?php echo $capt; ?>'">Layout 600 SDH Diario TXT</button><br>
                <button onclick="window.location = 'Productividad_CS.php?capt=<?php echo $capt; ?>'">Productividad</button>
                <button onclick="window.location = 'fdm-cs.php?capt=<?php echo $capt; ?>'">Fin del Mes</button>
                <button onclick="window.open('CS_daily.php?capt=<?php echo $capt; ?>', 'Credito Si Auditario', 'width=400,height=200,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=yes')">Credito Si Auditario</button><br>
                <h3>DIMEX</h3>
                <button onclick="window.location = 'DIMEXReport.php?capt=<?php echo $capt; ?>'">Reporte de DIMEX</button>
                <h3>Prestamo Familiar</h3>
                <button onclick="window.location = 'CartasFiniquitos.php?capt=<?php echo $capt; ?>'">Cartas Finiquitos</button>-->
            </div>
            <div id="bot">
                <h2>Controlar ROBOT y ELASTIX</h2>
                <h3>ROBOT</h3>
<!--                <button onclick="window.location = 'cargatel.php?capt=<?php echo $capt; ?>'">CARGAR ROBOT</button>
                <button onclick="window.location = 'robocon.php?capt=<?php echo $capt; ?>'">CONTROLAR ROBOT</button>-->
            </div>
        </div>
        <p>
            <button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
            <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
            <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button><br>
        </p>
    </body>
</html>
