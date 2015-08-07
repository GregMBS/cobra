<?php
require_once 'pdoConnect.php';
$pdoc	 = new pdoConnect();
$pdo	 = $pdoc->dbConnectAdmin();
$capt	 = filter_input(INPUT_GET, 'capt');
$go	 = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
	if ($go == "BORRAR") {
		$cliente	 = filter_input(INPUT_GET, 'cliente');
		$segmento	 = filter_input(INPUT_GET, 'segmento');
		$queryb		 = "DELETE FROM queuelist
            WHERE cliente = :cliente
            AND sdc = :segmento
            ";
		$stb		 = $pdo->prepare($queryb);
		$stb->bindParam(':cliente', $cliente);
		$stb->bindParam(':segmento', $segmento);
		$stb->execute();
	}

	if ($go == "AGREGAR") {
		$cliseg		 = filter_input(INPUT_GET, 'cliseg');
		$clientesegmento = explode(';', $cliseg);
		$cliente	 = $clientesegmento[0];
		$segmento	 = $clientesegmento[1];
		$querylistin	 = "INSERT INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc, bloqueado)  
            SELECT distinct gestor, :cliente, status_aarsa, updown1, orden1,
	    9999999, :segmento, 0
            FROM queuelist;";
		try {
			$sti		 = $pdo->prepare($querylistin);
			$sti->bindParam(':cliente', $cliente);
			$sti->bindParam(':segmento', $segmento);
			$sti->execute();
			$querylistcamp	 = "update queuelist
            set camp=auto where camp=9999999;";
			$pdo->query($querylistcamp);
		} catch (PDOException $e) {
			die($e->getMessage());
		}

		header("Location: segmentadmin.php?capt=".$capt);
	}
}
$querymain	 = "SELECT q.cliente,sdc,count(distinct id_cuenta)
    FROM queuelist q
    LEFT JOIN resumen r
    ON q.cliente=r.cliente and sdc=status_de_credito
    and status_de_credito not regexp '-'
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    group by q.cliente,sdc
    ";
$result		 = $pdo->query($querymain);
$querymain2	 = "SELECT r.cliente,status_de_credito,count(1)
    FROM resumen r
    LEFT JOIN queuelist q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE auto is null
    AND r.cliente <> ''
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    ";
$result2	 = $pdo->query($querymain2);
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Administraci&oacute;n de las segmentos</title>
	<link rel="stylesheet" href="bower_components/jqueryui/themes/vader/jquery-ui.css" type="text/css" media="all" />
	<script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
	<script src="bower_components/jqueryui/jquery-ui.min.js" type="text/javascript"></script>
	<style>
	    tr:hover {background-color: yellow;}
	</style>
    </head>
    <body>
	<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
	<table summary="Segmentos" class="ui-widget">
	    <thead class="ui-widget-header">
		<tr>
	    <form action="segmentadmin.php" method="get" name="migoorden">
		<input type="hidden" name="capt" value="<?php echo $capt ?>">
		<th>CLIENTE</a></th>
		<th>SEGMENTO</a></th>
		<th>CUENTAS</a></th>
		<th>&nbsp;</a></th>
		</tr>
		</thead>
		<tbody class="ui-widget-content">
		    <?php
		    $j		 = 0;

		    while ($row = $result->fetch(PDO::FETCH_NUM)) {
			    $j		 = $j + 1;
			    $cliente	 = $row[0];
			    $segmento	 = $row[1];
			    $count		 = $row[2];
			    ?>
			    <tr>
			<form class="gestorchange" name="gestorchange<?php echo $j ?>" method="get" action=
			      "segmentadmin.php" id="gestorchange<?php echo $j ?>">
			    <input type="hidden" name="capt" value="<?php echo $capt ?>">
			    <input type="hidden" name="j" value="<?php echo $j ?>">
			    <td><input type="text" name="cliente" readonly="readonly" value="<?php echo $cliente; ?>" /></td>
			    <td><input type="text" name="segmento" readonly="readonly" value="<?php echo $segmento; ?>" /></td>
			    <td><?php echo $count; ?></td>
			    <?php if ($count == 0) { ?>
				    <td><input type="submit" name="go" value="BORRAR"></td>
			    <?php } ?>
			</form>
			</tr>
		<?php }
		?>
		<tr>
		<form class="gestoradd" name="gestoradd" method="get" action="segmentadmin.php" id="gestoradd">
		    <input type="hidden" name="capt" value="<?php echo $capt ?>">
		    <td colspan=3>
			<select name="cliseg">
			    <?php
			    while ($row2 = $result2->fetch(PDO::FETCH_NUM)) {
				    $cliente2	 = $row2[0];
				    $segmento2	 = $row2[1];
				    ?>
				    <option value="<?php echo $cliente2.';'.$segmento2; ?>"><?php echo $cliente2.' - '.$segmento2; ?></option>
			    <?php } ?>
			</select></td>
		    <td><input type="submit" name="go" value="AGREGAR">
		    </td>
		</form>
		</tr>
		</tbody>
	</table>
    </body>
</html>
