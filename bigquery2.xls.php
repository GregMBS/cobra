<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');

function MesNom($n)
{
	$timestamp = mktime(0, 0, 0, $n, 1, 2005);

	return date("M", $timestamp);
}
$go = filter_input(INPUT_GET, 'go');
if (isset($go)) {
	$cliente = filter_input(INPUT_GET, 'cliente');
	$gestor	 = filter_input(INPUT_GET, 'gestor');
	$fecha1	 = filter_input(INPUT_GET, 'fecha1');
	$fecha2	 = filter_input(INPUT_GET, 'fecha2');
	$tipo	 = filter_input(INPUT_GET, 'tipo');
	if ($fecha2 < $fecha1) {
		list($fecha1, $fecha2) = array($fecha2, $fecha1);
	}
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
	$gestorstr	 = '';
	$clientestr	 = '';
	if ($gestor != 'todos') {
		$gestorstr = " and c_cvge=:gestor ";
	}
	if ($tipo == 'visits') {
		$gestorstr .= " and c_visit <> '' ";
	}
	if ($tipo == 'telef') {
		$gestorstr .= " and c_visit IS NULL ";
	}
	if ($cliente != 'todos') {
		$clientestr = " and c_cvba=:cliente and resumen.cliente=:cliente ";
	}
	$querymain	 = "SELECT numero_de_cuenta as 'cuenta',nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento',
    saldo_total,d1.queue,h1.*,d2.v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,pagos.fecha as 'fecha pago', 
    pagos.monto as 'monto pago'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between '".$fecha1."' and '".$fecha2."'
".$gestorstr.$clientestr." 
ORDER BY d_fech,c_hrin
    ;";
	$std		 = $pdo->prepare($querymain);
	if ($gestor != 'todos') {
		$std->bindParam(':gestor', $gestor);
	}
	if ($cliente != 'todos') {
		$std->bindParam(':cliente', $cliente);
	}
	$std->execute();
    $result = $std->fetchAll(PDO::FETCH_ASSOC);
// Creating a workbook
	$filename	 = "Query_de_gestiones_".$fecha1."_".$fecha2.".xlsx";
$output   = array();
$output[] = array_keys($result[0]);
foreach ($result as $row) {
    $row['saldo_total'] = (float) $row['saldo_total'];
    $row['monto pago'] = (float) $row['monto pago'];
    $output[]     = $row;
}
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($filename); // stream data directly to the browser
$writer->addRows($output); // add multiple rows at a time
$writer->close();

} else {
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Query de las Gestiones</title>

	<style type="text/css">
	    body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
	    table {border: 1pt solid #000000;background-color: #c0c0c0;}
	    tr:hover {background-color: #ff0000;}
	    th {border: 1pt solid #000000;background-color: #c0c0c0;}
	    .loud {text-align:center; font-weight:bold; color:red;}
	    .num {text-align:right;}
	</style>
    </head>
    <body>
	<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
	<form action="bigquery2.xls.php" method="get" name="queryparms">
	    <input type="hidden" name="capt" value="<?php echo $capt ?>">
	    <p>Gestor: <?php
		    if (isset($gestor)) {
			    echo $gestor;
		    }
		    ?>
		<select name="gestor">
		    <option value="todos" style="font-size:120%;">todos</option>
			<?php
			$queryg	 = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000
	";
			$resultg = $pdo->query($queryg);
			foreach ($resultg as $answerg) {
				?>
			    <option value="<?php echo $answerg['c_cvge']; ?>" style="font-size:120%;">
			<?php echo $answerg['c_cvge']; ?></option>
	<?php }
?>
		</select>
	    </p>
	    <p>Cliente: <?php
		    if (isset($cliente)) {
			    echo $cliente;
		    }
		    ?>
		<select name="cliente">
		    <option value="todos" style="font-size:120%;">todos</option>
			<?php
			$queryc	 = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 1 year) 
        order by c_cvba
        limit 100
	";
			$resultc = $pdo->query($queryc);
			foreach ($resultc as $answerc) {
				?>
			    <option value="<?php echo $answerc['c_cvba']; ?>" style="font-size:120%;">
			<?php echo $answerc['c_cvba']; ?></option>
			<?php }
		?>
		</select>
	    </p>
	    <p>HECHO de:
		    <?php
		    if (isset($fecha1)) {
			    echo $fecha1;
		    }
		    ?>
		<select name="fecha1">
		    <?php
		    $queryfu	 = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 10 year)
        ORDER BY d_fech limit 3600";
		    $resultfu	 = $pdo->query($queryfu);
		    foreach ($resultfu as $answerfu) {
			    ?>
			    <option value="<?php echo $answerfu['d_fech']; ?>" style="font-size:120%;">
			    <?php echo $answerfu['d_fech']; ?></option>
		    <?php } ?>
		</select>
		a:
		    <?php
		    if (isset($fecha2)) {
			    echo $fecha2;
		    }
		    ?>
		<select name="fecha2">
		    <?php
		    $queryfd	 = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech desc limit 60";
		    $resultfd	 = $pdo->query($queryfd);
		    foreach ($resultfd as $answerfd) {
			    ?>
			    <option value="<?php echo $answerfd['d_fech']; ?>" style="font-size:120%;">
	<?php echo $answerfd['d_fech']; ?></option>
<?php } ?>
		</select>
	    </p>
	    <label for='visits'>Visitas</label>
	    <input type='radio' name='tipo' id='visits' value='visits' /><br>
	    <label for='telef'>Telefonica</label>
	    <input type='radio' name='tipo' id='telef' value='telef' /><br>
	    <input type='submit' name='go' value='Query Gestiones'>
	</form>
    </body>
</html> 
    <?php
}
