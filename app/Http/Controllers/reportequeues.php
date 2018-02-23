<!DOCTYPE html">
<html>
    <head>
	<title>Reporte de los queues</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style>
            tr:hover {background-color: yellow;}
        </style>
    </head>
    <body>
	<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Campa&ntilde;a</th>
		    <th>Queue</th>
		    <th>Menos Reci&eacute;n</th>
		    <th>Mas Reci&eacute;n</th>
		    <th>Cuentas</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		$OG	 = '';
		$query	 = "select ejecutivo_asignado_call_center as 'gestor',
			status_de_credito, queue,
date(min(fecha_ultima_gestion)) as 'menos',
date(max(fecha_ultima_gestion)) as 'mas',
count(1) as 'cuentas', 
cliente
from resumen
join dictamenes on dictamen=status_aarsa
where (fecha_de_actualizacion>last_day(curdate()-interval 1 month-interval 1 week) 
or fecha_ultima_gestion>last_day(curdate()-interval 1 month-interval 1 week))
and status_de_credito not regexp '-'
group by ejecutivo_asignado_call_center,cliente,status_de_credito,queue";
		$result	 = $pdo->query($query);
		foreach ($result as $row) {
			$GESTOR	 = $row['gestor'];
			$SDC	 = $row['status_de_credito'];
			$QUEUE	 = $row['queue'];
			$CUENTAS = $row['cuentas'];
			$MENOS	 = $row['menos'];
			$MAS	 = $row['mas'];
			$CLIENTE = $row['cliente'];
			if ($OG <> $GESTOR) {
				$OG = $GESTOR;
				?>
				<tr>
				    <td colspan=5>&nbsp;</td>
				</tr>
				<?php
			}
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $SDC; ?></td>
			    <td><?php echo $QUEUE; ?></td>
			    <td><?php echo $MENOS; ?></td>
			    <td><?php echo $MAS; ?></td>
			    <td><?php echo $CUENTAS; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
    </body>
</html> 
