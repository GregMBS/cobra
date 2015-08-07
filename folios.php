<?php
$host = "localhost";
$user = "root";
$pswd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$go=mysql_real_escape_string($_GET['go']);
$capt=mysql_real_escape_string($_GET['capt']);
if (isset($_GET['source'])) {
	$source=mysql_real_escape_string($_GET['source']);
} else {
	$source='resumen';
}
if (isset($_GET['tipo'])) {
        $tipo=mysql_real_escape_string($_GET['tipo']);
}
$CUENTA=mysql_real_escape_string($_GET['CUENTA']);
$CTA=explode("-", $CUENTA);
$CLIENTE=mysql_real_escape_string($_GET['CLIENTE']);
setcookie('cliente',str_replace('+',' ',$CLIENTE));
if (isset($_GET['FOLIO'])) {
        $FOLIO=mysql_real_escape_string($_GET['FOLIO']);
}
$MSG="";
if ($go=='ELIGIR') {
$N_PROM=0;
$OK=0;
$querymp = "select n_prom,c_cont from historia join resumen on c_cont=id_cuenta
where n_prom>0 and numero_de_cuenta='".$CUENTA."' and d_prom>=curdate()
order by d_fech desc, c_hrin desc";
$resultmp=mysql_query($querymp) or die ("ERROR FM1 - ".mysql_error());
while ($answermp=mysql_fetch_row($resultmp)) {$N_PROM+=$answermp[0];$ID=$answermp[1];}
$querycheck = "select count(1) from resumen 
join historia on c_cont=id_cuenta 
left join folios on id=id_cuenta and fecha>d_fech
where d_fech>last_day(curdate()-interval 1 month) and d_prom>=curdate()
and folio is null and numero_de_cuenta='".$CUENTA."'";
$resultcheck=mysql_query($querycheck) or die ("ERROR FM2 - ".mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {$OK=$answercheck[0];}
if ($tipo=='admin') {$OK = 1;}
$mora=0;
$queryres = "SELECT saldo_descuento_1,saldo_total,dias_vencidos,saldo_descuento_2
FROM resumen WHERE numero_de_cuenta='".$CUENTA."';";
$resultres=mysql_query($queryres) or die ("ERROR FM3 - ".mysql_error());
while ($answerres=mysql_fetch_row($resultres)) {
$capital=$answerres[3];
$saldo_can=$answerres[1];
$mora=$answerres[2];
$capital=$answerres[0];
$queryins = "update folios SET usado=1, fecha=now(), cuenta=".$CUENTA.", gestor='".$capt."',
 capital=".$capital.", saldo_can=".$saldo_can.", mora=".$mora.", cliente= '".$CLIENTE."',
 id=".$ID." 
WHERE cliente = '".$CLIENTE."'  and folio=".$FOLIO;
//die($queryins);
if (($OK>0)&&($go=='ELIGIR')) {
	mysql_query($queryins) or die ("ERROR FM4 - ".mysql_error());
	} 
else {$MSG="Error de asignar folio. No hay no promesa valido guardado. Es posible que monto no es suficiente, o que ya tiene folio vigente que refleja esta promesa.";}
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if ($capt=="/") {$capt=NULL;
$redirector = "Location: folios.php?capt=".$capt."&CUENTA=".$CUENTA."&CLIENTE=".$CLIENTE."&go=FROMGUARDAR";
if ($tipo=='admin') {
$redirector = "Location: folioadmin.php?capt=".$capt;
}
header($redirector);
}
}
$querymp = "select n_prom,d_prom from historia 
where n_prom>0 and cuenta=".$CUENTA." 
order by d_fech desc, c_hrin desc limit 1";
$resultmp=mysql_query($querymp) or die ("ERROR FM5 - ".mysql_error());
while ($answermp=mysql_fetch_row($resultmp)) {$N_PROM=$answermp[0];$D_PROM=$answermp[1];}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Folios</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
			<script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<style>
	<!--
	td {width:10em; text-align: center;}
tr.odd { background-color: white }
tr.even { background-color: #dddddd }
	-->
</style>

</head>
<body <?php if ($go=='ELIGIR') {
$amsg = "folio ".$FOLIO." asignado a cuenta ".$CUENTA;
echo 'onload=alert("'.$amsg.'")';
}?>>
<script>
	$(function() {
		$('#foliotab').dataTable({
			"sAjaxSource": "folios_ajax.php?cliente=<?php echo $CLIENTE;?>",
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				var buttonurl='folios.php?go=ELIGIR&capt=<?php echo $capt;?>&CUENTA=<?php echo $CUENTA;?>&CLIENTE='+aData[1]+'&FOLIO='+aData[0];
				$('td:eq(2)', nRow).html( '<button onclick="window.location=(\''+buttonurl+'\')">ELEGIR</button>' );
				return nRow;
		},
			"bJQueryUI": true
			});
		});
</script>
<h2><?php echo $MSG;?></h2>
<div id="foliobox">
<table summary="foliotab" id="foliotab">
<thead>
<tr>
<th>FOLIO</th>
<th>CLIENTE</th>
<th>ELIGIR</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<?php if ($source=='') {$source='resumen';}?>
<button onClick='window.location = "<?php echo $source;?>.php?capt=<?php echo $capt;?>&go=ULTIMA"'>CIERRA</button>
</body>
</html> 
<?php 
mysql_close($con);

