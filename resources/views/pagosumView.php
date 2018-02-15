<!DOCTYPE html>
<html>
    <head>
	<title>Pagos del mes actual</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
	<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
	<h2>Mes Actual</h2>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Cliente</th>
		    <th>Campa&ntilde;a</th>
		    <th>Monto Pago Capturado</th>
		    <th>Monto Pago Confirmado</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		foreach ($resultAct as $row) {
			$CLIENTE = $row['cli'];
			$SDC	 = $row['sdc'];
			if (empty($SDC)) {
				$SDC = 'total';
			}
			$PAGO	 = number_format($row['sm'], 2);
			$CONF	 = number_format($row['smc'], 2);
			?>
			<tr>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $SDC; ?></td>
			    <td><?php echo $PAGO; ?></td>
			    <td><?php echo $CONF; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Monto Pago Capturado</th>
		    <th>Monto Pago Confirmado</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		foreach ($resultActGest as $row) {
			$GESTOR	 = $row['gestor'];
			$CLIENTE = $row['cliente'];
			$PAGO	 = number_format($row['sm'], 2);
			$CONF	 = number_format($row['smc'], 2);
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td class="num"><?php echo $PAGO; ?></td>
			    <td class="num"><?php echo $CONF; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Cuenta</th>
		    <th>Fecha</th>
		    <th>Monto</th>
		    <th>Cliente</th>
		    <th>Gestor</th>
		    <th>Confirmado</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		foreach ($resultActDet as $row) {
			$CUENTA	 = $row['cuenta'];
			$FECHA	 = $row['fecha'];
			$MONTO	 = number_format($row['monto'], 2);
			$CLIENTE = $row['cliente'];
			$GESTOR	 = $row['gestor'];
			$CONF	 = $row['confirmado'];
			?>
			<tr>
			    <td><?php echo $CUENTA; ?></td>
			    <td><?php echo $FECHA; ?></td>
			    <td class="num"><?php echo $MONTO; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CONF; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
	<h2>Mes Anterior</h2>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Cliente</th>
		    <th>Campa&ntilde;a</th>
		    <th>Monto Pago Capturado</th>
		    <th>Monto Pago Confirmado</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		foreach ($resultAnt as $row) {
			$CLIENTE = $row['cli'];
			$SDC	 = $row['sdc'];
			if (empty($SDC)) {
				$SDC = 'total';
			}
			$PAGO	 = number_format($row['sm'], 2);
			$CONF	 = number_format($row['smc'], 2);
			?>
			<tr>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $SDC; ?></td>
			    <td><?php echo $PAGO; ?></td>
			    <td><?php echo $CONF; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Gestor</th>
		    <th>Cliente</th>
		    <th>Monto Pago Capturado</th>
		    <th>Monto Pago Confirmado</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		foreach ($resultAntGest as $row) {
			$GESTOR	 = $row['gestor'];
			$CLIENTE = $row['cliente'];
			$PAGO	 = number_format($row['sm'], 2);
			$CONF	 = number_format($row['smc'], 2);
			?>
			<tr>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td class="num"><?php echo $PAGO; ?></td>
			    <td class="num"><?php echo $CONF; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
	<table class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
		    <th>Cuenta</th>
		    <th>Fecha</th>
		    <th>Monto</th>
		    <th>Cliente</th>
		    <th>Gestor</th>
		    <th>Confirmado</th>
		</tr>
	    </thead>
	    <tbody class="ui-widget-content">
		<?php
		foreach ($resultAntDet as $row) {
			$CUENTA	 = $row['cuenta'];
			$FECHA	 = $row['fecha'];
			$MONTO	 = number_format($row['monto'], 2);
			$CLIENTE = $row['cliente'];
			$GESTOR	 = $row['gestor'];
			$CONF	 = $row['confirmado'];
			?>
			<tr>
			    <td><?php echo $CUENTA; ?></td>
			    <td><?php echo $FECHA; ?></td>
			    <td class="num"><?php echo $MONTO; ?></td>
			    <td><?php echo $CLIENTE; ?></td>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $CONF; ?></td>
			</tr>
		<?php } ?>
	    </tbody>
	</table>
    </body>
</html>
