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
                    </UL>
                </div>
            </div>
            <div data-role="collapsible">
                <h2>Cargar</h2>
                <button onclick="window.location = 'carga?capt=<?php echo $capt; ?>'">Cargar Cartera</button>
            </div>
            <div data-role="collapsible">
                <h2>Visitar</h2>
                <button onclick="window.location = 'checkout?capt=<?php echo $capt; ?>'">Asignar Visitas</button>
                <button onclick="window.location = 'checkin?capt=<?php echo $capt; ?>'">Recibir Visitas</button>
            </div>
            <div data-role="collapsible">
                <h2>Administrar</h2>
                <button onclick="window.location = 'gestoradmin?capt=<?php echo $capt; ?>'">Administrar Acesso</button>
                <button onclick="window.location = 'breakadmin?capt=<?php echo $capt; ?>'">Administrar Breaks</button>
                <button onclick="window.location = 'queues?capt=<?php echo $capt; ?>'">Administrar Queues</button>
                <button onclick="window.location = 'notadmin?capt=<?php echo $capt; ?>'">Administrar Notas</button>
                <button onclick="window.location = 'segmentadmin?capt=<?php echo $capt; ?>'">Administrar Segmetos</button>
                <button onclick="window.location = 'changest?capt=<?php echo $capt; ?>'">Cambiar Status de Credito</button>
                <button onclick="window.location = 'inactivar?capt=<?php echo $capt; ?>'">Inactivar Cuentas</button>
                <button onclick="window.location = 'queuemanual?capt=<?php echo $capt; ?>'">Cargar Queue MANUAL</button>
                <button onclick="window.location = 'reporteManual?capt=<?php echo $capt; ?>'">Reporte Queue MANUAL</button>
            </div>
            <div data-role="footer">
                <button onclick="window.location = 'quick?capt=<?php echo $capt; ?>'">Tiempo Real</button>
                <button onclick="window.location = 'resumen?capt=<?php echo $capt; ?>'">Las Cuentas</button>
                <button onclick="window.location = 'resumen?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
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
                <button onclick="window.location = 'queuesqc?capt=<?php echo $capt; ?>'">Queues por Cliente</button>
                <button onclick="window.location = 'latest_best?capt=<?php echo $capt; ?>'">Ultimo y Mejor Status</button>
            </div>
            <div data-role="collapsible">
                <h2>Promesas y Pagos</h2>
                <button onclick="window.location = 'rotas?capt=<?php echo $capt; ?>'">Promesas del Mes Actual</button>
                <button onclick="window.location = 'pagosum?capt=<?php echo $capt; ?>'">Pagos por Cliente</button>
                <button onclick="window.location = 'pagodet?capt=<?php echo $capt; ?>'">Pagos este mes (XLSX)</button>
            </div>
            <div data-role="collapsible">
                <h2>Recursos Humanos</h2>
                <button onclick="window.location = 'horarios?capt=<?php echo $capt; ?>'">Productividad este Mes</button>
                <button onclick="window.location = 'perfmes?capt=<?php echo $capt; ?>'">Productividad Mes Anterior</button>
                <button onclick="window.location = 'horariosv?capt=<?php echo $capt; ?>'">Productividad Visit. este Mes</button>
                <button onclick="window.location = 'perfmesv?capt=<?php echo $capt; ?>'">Productividad Visit. Mes Ant.</button>
                <button onclick="window.location = 'horario?capt=<?php echo $capt; ?>'">Solo uno Empleo</button><br>
            </div>
            <div data-role="collapsible">
                <h2>Gestiones y Inventarios de Deascargar</h2>
                <button onclick="window.location = 'bigquery?capt=<?php echo $capt; ?>'">Query de las Gestiones XLSX</button>
                <button onclick="window.location = 'bigproms?capt=<?php echo $capt; ?>'">Query de las Promesas XLSX</button>
                <button onclick="window.location = 'inventario?capt=<?php echo $capt; ?>'">Query del Inventario XLSX</button>
                <button onclick="window.location = 'inventario-rapid?capt=<?php echo $capt; ?>'">Query del Inventario Rapido XLSX</button>
                <button onclick="window.location = 'intensidad?capt=<?php echo $capt; ?>'">Query del Intensidad XLSX</button>
            </div>
            <div data-role="collapsible">
                <h2>Miscelánea</h2>
                <button onclick="window.location = 'comparativo?capt=<?php echo $capt; ?>'">Comparativo de 3 meses HTML</button><br>
                <button onclick="window.location = 'contactados?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Contactados XLS</button>
                <button onclick="window.location = 'marcados?capt=<?php echo $capt; ?>'">Reporte de Tel&eacute;fonos Marcados XLS</button>
            </div>
        </div>
        <div data-role="footer">
            <button onclick="window.location = 'quick?capt=<?php echo $capt; ?>'">Tiempo Real</button>
            <button onclick="window.location = 'resumen?capt=<?php echo $capt; ?>'">Las Cuentas</button>
            <button onclick="window.location = 'logout?capt=<?php echo $capt; ?>'">LOGOUT</button><br>
        </div>
    </body>
</html>
