<?php
require_once 'pdoConnect.php';
$pdoc	 = new pdoConnect();
$pdo	 = $pdoc->dbConnectUser();
$capt	 = filter_input(INPUT_GET, 'capt');
set_time_limit(300);
$field	 = filter_input(INPUT_GET, 'field');
$find	 = filter_input(INPUT_GET, 'find');
$from	 = filter_input(INPUT_GET, 'from');
if (filter_has_var(INPUT_GET, 'C_CONT')) {
	$C_CONT = filter_input(INPUT_GET, 'C_CONT');
} else {
	$C_CONT = 0;
}
$CLIENTE	 = filter_input(INPUT_GET, 'cliente');
/*
  $querymain	 = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito from resumen where ".$field." like '%".$find."%'";
 */
$queryhead	 = "SELECT SQL_NO_CACHE numero_de_cuenta, nombre_deudor,
cliente, id_cuenta, status_de_credito from resumen ";
switch ($field) {
	case 'id_cuenta':
		$querymain	 = $queryhead."where id_cuenta = :find order by id_cuenta;";
		break;
	case 'nombre_deudor':
		$querymain	 = $queryhead."where nombre_deudor regexp :find ";
		break;
	case 'numero_de_cuenta':
		$querymain	 = $queryhead."where numero_de_cuenta regexp :find ";
		break;
	case 'numero_de_credito':
		$querymain	 = $queryhead."where numero_de_credito regexp :find ";
		break;
	case 'domicilio_deudor':
		$querymain	 = $queryhead."where domicilio_deudor regexp :find ";
		break;
	case 'REFS':
		$querymain	 = $queryhead."WHERE
(nombre_deudor_alterno regexp :find or
nombre_referencia_1 regexp :find or
nombre_referencia_2 regexp :find or
nombre_referencia_3 regexp :find or
nombre_referencia_4 regexp :find)";
		break;
	case 'TELS':
		$querymain	 = $queryhead."WHERE
(tel_1 regexp :find or
tel_2 regexp :find or
tel_3 regexp :find or
tel_4 regexp :find or
tel_1_alterno regexp :find or
tel_2_alterno regexp :find or
tel_3_alterno regexp :find or
tel_4_alterno regexp :find or
tel_1_ref_1 regexp :find or
tel_2_ref_1 regexp :find or
tel_1_ref_2 regexp :find or
tel_2_ref_2 regexp :find or
tel_1_ref_3 regexp :find or
tel_2_ref_3 regexp :find or
tel_1_ref_4 regexp :find or
tel_2_ref_4 regexp :find or
tel_1_laboral regexp :find or
tel_2_laboral regexp :find or
tel_1_verif regexp :find or
tel_2_verif regexp :find or
tel_3_verif regexp :find or
tel_4_verif regexp :find or
telefonos_marcados regexp :find)";
		break;
	case 'ROBOT':
		$querymain	 = "SELECT SQL_NO_CACHE
			distinct numero_de_cuenta,nombre_deudor, cliente,
			id_cuenta, status_de_credito
			FROM resumen, historia
			WHERE c_tele REGEXP :find and c_cont=id_cuenta";
		break;

	default:
		break;
        }
$cliFlag = 0;
if ((isset($querymain)) && (strlen($CLIENTE) > 1)) {
	$querymain	 = $querymain." and cliente = :cliente ";
	$cliFlag	 = 1;
        }
if (isset($querymain)) {
	try {
	$stm = $pdo->prepare($querymain);
	$stm->bindParam(':find', $find);
	if ($cliFlag == 1) {
		$stm->bindParam(':cliente', $CLIENTE);
        }
	$stm->execute();
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		die($e->getMessage());
        }
        }
        ?>
<!DOCTYPE html>
        <html>
            <head>
                <title>CobraMas - Buscar</title>
        <meta charset="utf-8">
	<link href="bower_components/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<link href="bower_components/datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
	<script src="bower_components/datatables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <script>
            $(function() {
                $('#buscarTable').dataTable({
			"bPaginate": false,
			"bJQueryUI": true
		});
            });
        </script>
            </head>
            <body>
                <h1>BUSCAR</h1>
                <button onClick="window.location = '<?php echo $from; ?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $C_CONT; ?>&capt=<?php echo $capt; ?>'">Regresar al resumen</button>
	<table class="ui-widget" id="buscarTable">
	    <thead class="ui-widget-header">
                        <tr>
                            <th>CUENTA</th>
                            <th>NOMBRE</th>
                            <th>CLIENTE</th>
                            <th>CAMPAÑA</th>
                        </tr>
                    </thead>
	    <tbody class="ui-widget-c">
        <?php
		$j = 0;
		if ($result) {
			foreach ($result as $row) {
				$j		 = $j + 1;
				$CUENTA		 = $row['numero_de_cuenta'];
				$NOMBRE		 = $row['nombre_deudor'];
				$CLIENTE	 = $row['cliente'];
				$ID_CUENTA	 = $row['id_cuenta'];
				$STATUS		 = $row['status_de_credito'];
            ?>
                            <tr>
				    <td><a<?php if (preg_match('/-/', $STATUS)) { ?> style="color:#c0c0c0;"<?php } ?> href='<?php echo $from; ?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>&highlight=<?php echo $field ?>&hfind=<?php echo $find ?>'><?php echo $CUENTA; ?></a></td>
				    <td><?php echo htmlentities($NOMBRE); ?></td>
                                <td><?php echo $CLIENTE; ?></td>
                                <td><?php echo $STATUS; ?></td>
                            </tr>
				<?php
			}
		}
		?>
                    </tbody>
                </table>
                <div id="searchbox">
                    <h2>Buscar</h2>
                    <form name="search" method="get" action=
                          "buscar.php" id="search">Buscar a: <input type=
                                                              "text" name="find"> en <select name="field">
                            <option value="numero_de_cuenta">Cuenta</option>
		    <option value="numero_de_credito"># del Grupo</option>
                            <option value="nombre_deudor">Nombre</option>
                            <option value="domicilio_deudor">Direcci&oacute;n</option>
                            <option value="TELS">Telefonos</option>
                            <option value="ROBOT">Telefonos marcados</option>
                            <option value="REFS">Aval/Referencias</option>
                            <option value="id_cuenta">Expediente</option>
                        </select><br>
                        Client = <select name="cliente">
                            <option value=" ">Todos</option>
        <?php
		    $querycl	 = "SELECT cliente FROM clientes;";
		    $resultcl	 = $pdo->query($querycl);
		    foreach ($resultcl as $answercl) {
            ?>
			    <option value="<?php echo $answercl['cliente']; ?>"><?php echo $answercl[0]; ?>
                                </option>
                <?php } ?>
                        </select><br>
                        <input type="hidden" name="i" value="0">
		<input type="hidden" name="capt" value="<?php
		if (isset($capt)) {
            echo $capt;
		}
		?>">
                        <input type="hidden" name="go" value="BUSCAR">
                        <input type="hidden" name="from" value="resumen.php">
                        <input type="submit" name="go1" value="BUSCAR">
                        <input type="button" name="cancel" onclick="cancelbox('searchbox')"
                               value="Cancel">
                    </form>
                </div>
    </body>
</html> 
