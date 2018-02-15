<?php
use App\PdoClass;
$pdoc	 = new PdoClass();
$pdo	 = $pdoc->dbConnectAdmin();
$capt	 = filter_input(INPUT_GET, 'capt');
$tipo	 = filter_input(INPUT_GET, 'tipo');
$get	 = filter_input_array(INPUT_GET);
$gestor	 = filter_input(INPUT_GET, 'gestor');
$CUENTA	 = trim(filter_input(INPUT_GET, 'CUENTA'));
if (empty($tipo)) {
	$tipo = 'id_cuenta';
}
$message = '';
$go	 = filter_input(INPUT_GET, 'go');
if ($go == 'RECIBIR') {
	$CUENTA = trim(filter_input(INPUT_GET, 'cuenta'));
	if (!empty($CUENTA)) {
		if ($tipo == 'id_cuenta') {
			$querycta = "select id_cuenta from resumen where id_cuenta = :cuenta";
		} else {
			$querycta = "select id_cuenta from resumen where numero_de_cuenta = :cuenta";
		}
		$stc		 = $pdo->prepare($querycc);
		$stc->bindParam(':cuenta', $CUENTA);
		$stc->execute();
		$resultcc	 = $stc->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultcc as $answercc) {
			$C_CONT	 = $answercc['id_cuenta'];
			$CTA	 = $answercc['numero_de_cuenta'];
		}
		$queryins	 = "update vasign set fechain=now()
	where c_cont = :id_cuenta
	and fechain is null
	limit 1";
		$sti		 = $pdo->prepare($queryins);
		$sti->bindParam(':id_cuenta', $C_CONT);
		$sti->execute();
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
	<title>COBRA Visitador Asignaciones y Recepciones</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body onLoad="<?php if (!empty($gestor)) { ?>
			    document.getElementById('CUENTA').focus();
	  <?php } ?>">
	<div id="vtable">
	    <h1><?php echo $message; ?></h1>
	    <form id='asigform' action='checkin.php' method='get'>
		<span class="formcap">Visitador:</span>
		<select name="gestor" id="gestor" onChange="$('#asigform').submit();">
		    <option></option>
		    <?php
		    $query	 = "SELECT usuaria,completo
			    FROM nombres
			    where usuaria in
				(select gestor from vasign
				where fechain is null)
			    order by usuaria";
		    $result	 = $pdo->query($query);
		    foreach ($result as $answer) {
			    ?>
			    <option value="<?php echo $answer['usuaria']; ?>" <?php if ($gestor == $answer['usuaria']) {
				    ?> selected='selected'<?php } ?>><?php echo htmlentities($answer['usuaria'].'-'.$answer['completo']); ?>
			    </option>
		    <?php }
		    ?>
		</select>
		<input type="text" id="CUENTA" name="CUENTA" value=""><br>
		c&oacute;digo de barras<input type="radio" id="CUENTA" name="tipo" <?php
		if ($tipo == 'id_cuenta') {
			?>checked="checked"<?php } ?> value="id_cuenta">
		numero de credito<input type="radio" id="CUENTA" name="tipo" <?php if ($tipo == 'numero_de_cuenta') {
			?>checked="checked"<?php } ?> value="numero_de_cuenta">
		<input type="hidden" name="capt" value="<?php echo $capt; ?>">
		<input type="hidden" name="go" value="RECIBIR">
		<input type="submit" value="RECIBIR">
	    </form>
	    <button onclick="window.location = 'checkoutlist.php?capt=<?php echo $capt; ?>&visitador=<?php echo $gestor; ?>'">CHECKLIST</button>
	    <?php
	    $querycount	 = "select sum(fechaout>curdate()) as asig,
		    sum(fechain>curdate()) as recib
		    from vasign
		    where gestor = :gestor;";
	    $stn		 = $pdo->prepare($querycount);
	    $stn->bindParam(':gestor', $gestor);
	    $stn->execute();
	    $resultcount	 = $stn->fetchAll(PDO::FETCH_ASSOC);
	    foreach ($resultcount as $answercount) {
		    $ASIG	 = $answercount['asig'];
		    $RECIB	 = $answercount['recib'];
	    }
	    ?>
	    <p>Asignado: <?php echo $ASIG; ?><br>
		Recibido: <?php echo $RECIB; ?></p>
	    <table class="ui-widget">
		<thead class="ui-widget-header">
		    <tr>
			<th>ID CUENTA</th>
			<th>CUENTA</th>
			<th>NOMBRE</th>
			<th>CLIENTE</th>
			<th>SALDO TOTAL</th>
			<th>QUEUE</th>
			<th>GESTOR</th>
			<th>FECHA DE ASIGNA</th>
			<th>FECHA DE REGRESA</th>
		    </tr>
		</thead>
		<tbody class="ui-widget-content">
		    <?php
		    if (!empty($gestor)) {
			    $querycc	 = "select id_cuenta, numero_de_cuenta as cuenta,
				    nombre_deudor as nombre, resumen.cliente,
				    saldo_total, q(status_aarsa) as queue,
				    completo as gestor, fechaout, fechain
from resumen join vasign on c_cont=id_cuenta 
join nombres on iniciales=gestor 
where gestor = :gestor 
order by fechain desc";
			    $stm		 = $pdo->prepare($querycc);
			    $stm->bindParam(':gestor', $gestor);
			    $stm->execute();
			    $resultcc	 = $stm->fetchAll(PDO::FETCH_ASSOC);
			    foreach ($resultcc as $answer) {
				    $GESTOR		 = $answer['gestor'];
				    $ID_CUENTA	 = $answer['id_cuenta'];
				    $CUENTA		 = $answer['cuenta'];
				    $ST		 = $answer['saldo_total'];
				    $CLIENTE	 = $answer['cliente'];
				    $QUEUE		 = $answer['queue'];
				    $NOMBRE		 = $answer['nombre'];
				    $FECHAOUT	 = $answer['fechaout'];
				    $FECHAIN	 = $answer['fechain'];
				    ?>
				    <tr>
					<td><?php echo $ID_CUENTA; ?></td>
					<td><?php echo $CUENTA; ?></td>
					<td><?php echo $NOMBRE; ?></td>
					<td><?php echo $CLIENTE; ?></td>
					<td><?php echo number_format($ST, 0); ?></td>
					<td><?php echo $QUEUE; ?></td>
					<td><?php echo $GESTOR; ?></td>
					<td><?php echo $FECHAOUT; ?></td>
					<td><?php echo $FECHAIN; ?></td>
				    </tr>
				    <?php
			    }
		    }
		    ?>
		</tbody>
	    </table>
	</div>
	<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
    </body>
</html>