<?php

$querygact	 = "select gestor, pagos.cliente as cli, sum(monto) as sm, 
	sum(monto*confirmado) as smc, who(status_de_credito) as who
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month-interval 1 week)
and fecha<=last_day(curdate()-interval 1 week)
group by gestor,cli,who";
$resultgact	 = $pdo->query($querygact);
$querygant	 = "select gestor, cliente as cli, sum(monto) as sm,
	sum(monto*confirmado) as smc
from pagos 
where fecha>last_day(curdate()-interval 2 month-interval 1 week)
and fecha<=last_day(curdate()-interval 1 month-interval 1 week)
group by gestor,cli";
$resultgant	 = $pdo->query($querygant);
$querydact	 = "select gestor, pagos.cliente as cli, status_de_credito as sdc,
q(status_aarsa) as queue, cuenta, status_aarsa, fecha, monto, monto*confirmado as mc,
nombre_deudor 
from pagos join resumen on cuenta=numero_de_cuenta 
and pagos.cliente=resumen.cliente 
where fecha>last_day(curdate()-interval 1 month-interval 1 week)
and fecha<last_day(curdate()-interval 1 week)
order by gestor,confirmado,fecha";
		$resultdact	 = $pdo->query($querydact);
$querydant	 = "select gestor, pagos.cliente as cli, status_de_credito as sdc,
q(status_aarsa) as queue, cuenta, status_aarsa, fecha, monto, monto*confirmado as mc,
nombre_deudor 
from pagos join resumen on cuenta=numero_de_cuenta 
and pagos.cliente=resumen.cliente 
where fecha between last_day(curdate()-interval 2 month-interval 1 week)+interval 1 day
and last_day(curdate()-interval 1 month-interval 1 week)
order by gestor,confirmado,fecha";
		$resultdant	 = $pdo->query($querydant);
		?>
<!DOCTYPE html>
<html>
    <head>
	<title>Pagos</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
	<style>
		td {text-align: center;}
		td.num {text-align: right;}
	</style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.js" type="text/javascript"></script>
    </head>
    <body>
	<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
	<h2>Mes actual (<?php echo strftime("%h", strtotime("last week")); ?>)</h2>
	<table id="gestorActual">
	    <thead>
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Camp</th>
		    <th>Monto Pago</th>
		    <th>Monto Confirmado</th>
		</tr>
	    </thead>
	    <tbody>
		<?php
		foreach ($resultgact as $row) {
			$GESTOR	 = $row['gestor'];
			$CLIENTE = $row['cli'];
			$SDC	 = $row['who'];
			$MONTO	 = number_format($row['sm'], 2);
			$MONTOC	 = number_format($row['smc'], 2);
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $SDC; ?></td>
			    <td class="num"><?php echo $MONTO; ?></td>
			    <td class="num"><?php echo $MONTOC; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
		<tfoot>
		    <tr>
			<th colspan="3" style="text-align:right">Total:</th>
			<th></th>
		    </tr>
		</tfoot>
	</table>
	<h2>Mes anterior (<?php echo strftime("%h", strtotime("5 weeks ago")); ?>)</h2>
	<table id="gestorAnterior">
	    <thead>
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Monto Pago</th>
		    <th>Monto Confirmado</th>
		</tr>
	    </thead>
	    <tbody>
		<?php
		foreach ($resultgant as $row) {
			$GESTOR	 = $row['gestor'];
			$CLIENTE = $row['cli'];
			$SDC	 = $row['who'];
			$MONTO	 = number_format($row['sm'], 2);
			$MONTOC	 = number_format($row['smc'], 2);
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td class="num"><?php echo $MONTO; ?></td>
			    <td class="num"><?php echo $MONTOC; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
		<tfoot>
		    <tr>
			<th colspan="3" style="text-align:right">Total:</th>
			<th></th>
		    </tr>
		</tfoot>
	</table>
	<h2>Detalles del mes actual (<?php echo date("M", strtotime("last week")); ?>)</h2>
	<table id="detailsActual">
	    <thead>
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Campa&ntilde;a</th>
		    <th>Queue</th>
		    <th>Cuenta</th>
		    <th>Status</th>
		    <th>Fecha Pag&oacute;</th>
		    <th>Monto Pag&oacute;</th>
		    <th>Monto Confirmado</th>
		    <th>Titular</th>
		</tr>
	    </thead>
	    <tbody>
		<?php
		foreach ($resultdact as $row) {
			$GESTOR	 = $row['gestor'];
			$CLIENTE = $row['cli'];
			$CAMP	 = $row['sdc'];
			$QUEUE	 = $row['queue'];
			$CUENTA	 = $row['cuenta'];
			$STATUS	 = $row['status_aarsa'];
			$FECHA	 = $row['fecha'];
			$MONTO	 = number_format($row['montp'], 2);
			$MONTOC	 = number_format($row['mc'], 2);
			$NOMBRE	 = $row['nombre_deudor'];
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $CAMP; ?></td>
			    <td><?php echo $QUEUE; ?></td>
			    <td><?php echo $CUENTA; ?></td>
			    <td><?php echo $STATUS; ?></td>
			    <td><?php echo $FECHA; ?></td>
			    <td class="num"><?php echo $MONTO; ?></td>
			    <td class="num"><?php echo $MONTOC; ?></td>
			    <td><?php echo $NOMBRE; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
	<h2>Detalles del mes anterior (<?php echo date("M", strtotime("5 weeks ago")); ?>)</h2>
	<table id="detailsAnterior">
	    <thead>
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Campa&ntilde;a</th>
		    <th>Queue</th>
		    <th>Cuenta</th>
		    <th>Status</th>
		    <th>Fecha Pag&oacute;</th>
		    <th>Monto Pag&oacute;</th>
		    <th>Monto Confirmado</th>
		    <th>Titular</th>
		</tr>
	    </thead>
	    <tbody>
		<?php
		foreach ($resultdant as $row) {
			$GESTOR	 = $row['gestor'];
			$CLIENTE = $row['cli'];
			$CAMP	 = $row['sdc'];
			$QUEUE	 = $row['queue'];
			$CUENTA	 = $row['cuenta'];
			$STATUS	 = $row['status_aarsa'];
			$FECHA	 = $row['fecha'];
			$MONTO	 = number_format($row['montp'], 2);
			$MONTOC	 = number_format($row['mc'], 2);
			$NOMBRE	 = $row['nombre_deudor']
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $CAMP; ?></td>
			    <td><?php echo $QUEUE; ?></td>
			    <td><?php echo $CUENTA; ?></td>
			    <td><?php echo $STATUS; ?></td>
			    <td><?php echo $FECHA; ?></td>
			    <td class="num"><?php echo $MONTO; ?></td>
			    <td class="num"><?php echo $MONTOC; ?></td>
			    <td><?php echo $NOMBRE; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
        <script>
            $(document).ready(function () {
                $('#gestorActual').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );

            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }

                });
                $('#gestorAnterior').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );

            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 2 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
                });
                $('#detailsActual').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    }
                });
                $('#detailsAnterior').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    }
                });
            });
        </script>
    </body>
</html> 
