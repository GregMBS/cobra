<?php
use cobra_salsa\PdoClass; // returns $pdo
$pdoc		 = new PdoClass();
$pdo		 = $pdoc->dbConnectUser();
$capt		 = filter_input(INPUT_GET, 'capt');
$ID_CUENTA	 = filter_input(INPUT_GET, 'id_cuenta', FILTER_VALIDATE_INT);
$querycc	 = "SELECT numero_de_cuenta, cliente,
ejecutivo_asignado_call_center, numero_de_credito 
FROM resumen 
WHERE id_cuenta = :id_cuenta";
$stc		 = $pdo->prepare($querycc);
$stc->bindParam(':id_cuenta', $ID_CUENTA);
$stc->execute();
$resultcc	 = $stc->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultcc as $answercc) {
	$CUENTA	 = $answercc['numero_de_cuenta'];
	$CLIENTE = $answercc['cliente'];
	$GESTOR	 = $answercc['ejecutivo_asignado_call_center'];
	$CREDITO = $answercc['numero_de_credito'];
}
$querysub	 = "SELECT fecha, monto, confirmado
FROM pagos
WHERE id_cuenta=:id_cuenta
ORDER BY fecha";
$sts		 = $pdo->prepare($querysub);
$sts->bindParam(':id_cuenta', $ID_CUENTA);
$sts->execute();
$resultsub	 = $sts->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
	<title>COBRA Pagos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
	<div id="pagobox">
	    <p>
		CUENTA:&nbsp;&nbsp;<?php echo $CUENTA ?><br>
		CLIENTE:&nbsp;<?php echo $CLIENTE ?>
	    </p>
	    <table id="pagosTable" class="ui-widget">
		<thead class='ui-widget-header'>
		    <tr>
			<th>FECHA</th>
			<th>MONTO</th>
			<th>CONFIRMADO</th>
		    </tr>
		</thead>
		<?php
		if (!(empty($resultsub))) {
			?>
			<tbody class="ui-widget-content">
			    <?php
			    foreach ($resultsub as $answer) {
				    $CF = "NO";
				    if ($answer['confirmado'] == 1) {
					    $CF = "S&Iacute;";
				    }
				    ?>
				    <tr>
					<td><?php echo $answer['fecha']; ?></td>
					<td><?php echo $answer['monto']; ?></td>
					<td><?php echo $CF; ?></td>
				    </tr>
			    <?php } ?>
			</tbody>
		    </table>
		</div>
	<?php } ?>
	<button onClick='window.close()'>CIERRA</button>
    </body>
</html> 
