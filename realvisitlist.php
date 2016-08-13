<?php
require_once 'classes/pdoConnect.php'; // returns $pdo
$pdoc		 = new pdoConnect();
$pdo		 = $pdoc->dbConnectUser();
$capt		 = filter_input(INPUT_GET, 'capt');
$ID_CUENTA	 = filter_input(INPUT_GET, 'id_cuenta');
$querysub	 = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id_cuenta) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
$sts		 = $pdo->prepare($querysub);
$sts->bindParam(':id_cuenta', $ID_CUENTA);
$sts->execute();
$rowsub	 = $sts->fetchAll(PDO::FETCH_ASSOC);
if (!(empty($rowsub))) {
	?>
	<!DOCTYPE html>
	<html>
	    <head>
		<title>Visitas</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="public/bower_resources/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
		<style>
		    th {width: 9em;}
		    th.gestion {width: 32em;}
		    th.status {width: 16em;}
		    th.timestamp {width: 8em;}
		    th.telefono {width: 8em;}
		    th.chico {width: 5em;}
		    td {width:10em;}
		    td.gestion {width: 32em;height: 1em;overflow:hidden;}
		    td.status {width: 16em;}
		    td.timestamp {width: 8em;}
		    td.telefono {width: 8em;}
		    td.chico {width: 5em;}
		</style>
		<script src="public/bower_resources/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="public/bower_resources/jqueryui/jquery-ui.js" type="text/javascript"></script>
	    </head>
	    <body>
		<div id="historybox">
		    <table class="ui-widget" id="historyhead">
			<thead class="ui-widget-header">
			    <tr>
				<?php
				$fields	 = array("c_cvst", "fh", "gestor", "short", "Gestion");
				$fieldnames	 = array("Status", "Fecha/Hora", "Visitador", "Gestion", "Gestion");
				$fieldsize	 = array("status", "timestamp", "chico", "gestion", "hidebox");
				for ($j = 0; $j < 4; $j++) {
					$fieldname = $fieldnames[$j];
					?>
					<th<?php echo ' class="'.$fieldsize[$j].'"'; ?>><?php
					    if (isset($fieldname)) {
						    echo $fieldname;
					    }
					    ?></th> <?php
		}
		?></tr>
			</thead>
			<tbody class="ui-widget-content"><?php
			    $j	 = 0;
			    $c	 = 0;
			    foreach ($rowsub as $answer) {
				    $auto	 = $answer['auto'];
				    $gestor	 = utf8_encode($answer['gestor']);
				    $gestion = utf8_encode($answer['c_obse1']);
				    ?>
				    <tr>
					<?php
					for ($k = 0; $k < 4; $k++) {
						$field = $fields[$k];
						$anku = utf8_encode($answer[$field]);
						if (is_null($anku)) {
							$anku = "&nbsp;";
						}
						$ank	 = str_replace('00:00:00', '', $anku);
						$jscode	 = '';
						if ($field == "short") {
							$jscode1 = " onClick='alert(";
							$jscode2 = ")'";
							$jscode	 = $jscode1.'"'.ereg_replace("[\n\r]", " ", $gestion).'"'.$jscode2;
						}
						?>
						<td<?php
						    if ($c == 1) {
							    echo " style='background-color:#dddddd'";
						    }
						    echo ' class="'.$fieldsize[$k].'"'.$jscode;
						    ?>>
							<?php
							if (isset($ank)) {
								echo $ank;
							}
							?>
						</td>
					    <?php
				    } $c = 1 - $c;
				    ?>
				    </tr>
		<?php
		$j++;
	}
	?>
			</tbody>
		    </table>
		</div>
<?php } ?>
    </div>
    <button onClick='window.close()'>CIERRA</button>
</body>
</html> 

