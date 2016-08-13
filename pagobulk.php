<?php
require_once 'classes/pdoConnect.php';
$pdoc	 = new pdoConnect();
$pdo	 = $pdoc->dbConnectAdmin();
$capt	 = filter_input(INPUT_GET, 'capt');
if (empty($capt)) {
	$capt	 = filter_input(INPUT_POST, 'capt');
}
$go	 = filter_input(INPUT_POST, 'go');
$data	 = filter_input(INPUT_POST, 'data');
$message = '';
if ($go == 'cargar') {

	$data		 = preg_split("/[\s,]+/", $data, 0, PREG_SPLIT_NO_EMPTY);
	$max		 = ceil(count($data) / 3);
	$queryload	 = '';
	$querypagoclean	 = "delete from pagos
where confirmado=0 and cuenta=:cuenta
 and fecha<=:fecha";
	$stpc		 = $pdo->prepare($querypagoclean);
	$querypagoins	 = "insert into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select :cuenta, :fecha, :monto, cliente, c_cvge, 1, id_cuenta
from resumen
left join historia h1 on cuenta=:cuenta
and q(c_cvst) in ('PROMESAS','CLIENTE NEGOCIANDO')
and d_fech>last_day(curdate() - INTERVAL 31 day)
where (:cuenta, :fecha, :monto)
not in (select cuenta,fecha,monto from pagos where confirmado=1)
and numero_de_cuenta=:cuenta
and not exists
(select * from historia h2 where h1.c_cont=h2.c_cont
and concat(h2.d_fech,h2.c_hrfi)<concat(h1.d_fech,h1.c_hrfi)
and q(h2.c_cvst) in ('PROMESAS','CLIENTE NEGOCIANDO'))
";
	$stpi		 = $pdo->prepare($querypagoins);
	for ($i = 0; $i < $max; $i++) {
		$cuenta	 = $i * 3;
		$fecha	 = $i * 3 + 1;
		$monto	 = $i * 3 + 2;
		$stpc->bindParam(':cuenta', $data[$cuenta]);
		$stpc->bindParam(':fecha', $data[$fecha]);
		$stpc->execute();
		$stpi->bindParam(':cuenta', $data[$cuenta]);
		$stpi->bindParam(':fecha', $data[$fecha]);
		$stpi->bindParam(':monto', $data[$monto]);
		$stpi->execute();
	}
	/*
	 * INFONABIT-SPECIFIC CODE
	 *
	  $querypi = "update resumen
	  set status_aarsa='PAGO INFONAVIT'
	  where id_cuenta in (select id_cuenta from pagos
	  where confirmado=1 and fecha>=last_day(curdate()-interval 1 month))
	  and resumen.cliente not like 'j%'";
	  $pdo->query($querypi);
	  $message = '<p>Pagos est&aacute;n guardados</p>';
	  $query	 = 'drop table if exists ipptemp;';
	  $pdo->query($query);
	  $query	 = 'drop table if exists mantemp;';
	  $pdo->query($query);
	  $query	 = 'create temporary table ipptemp
	  select id_cuenta as idc from pagos
	  where confirmado=1
	  group by id_cuenta
	  having count(distinct year(fecha),month(fecha))>2;';
	  $pdo->query($query);
	  $query	 = 'create temporary table mantemp
	  select id_cuenta as idc from pagos
	  where confirmado=1
	  group by id_cuenta
	  having count(distinct year(fecha),month(fecha))>8;';
	  $pdo->query($query);
	  $query	 = "update resumen,ipptemp
	  SET status_de_credito='MANTENMIENTO'
	  where idc=id_cuenta
	  and status_de_credito='IR POR PAGO';";
	  $pdo->query($query);
	  $query	 = "update resumen,mantemp
	  SET status_de_credito='CURADO'
	  where idc=id_cuenta
	  and status_de_credito='MANTENMIENTO';";
	  $pdo->query($query);
	 *
	 */
}
?>
<!DOCTYPE HTML>

<html>
    <head>
	<title>Capturar Pagos Confirmados</title>
        <link href="public/bower_resources/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="public/bower_resources/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="public/bower_resources/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
	<form action="pagobulk.php" method="post" name="cargar">
	    <p>Usa formato CUENTA,FECHA(2011-01-31),MONTO(1234.56)</p>
	    <textarea name='data' rows='20' cols='50'></textarea>
	    <input type="hidden" name="capt" value="<?php
	    echo $capt
	    ?>" />
	    <button type="submit" name="go" value="cargar">Cargar</button>
	</p>
    </form>
    <?php echo $message; ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
	Regresar a la plantilla administrativa
    </button>
    <br>
</body>
</html>
