<?php 
function select_more_than_x_payment_months ($x=0) {
	$idlist=0;
	if (is_int($x)) {
	if ($x>0) {
	$query="select id_cuenta from pagos 
where confirmado=1 
group by id_cuenta 
having count(distinct year(fecha),month(fecha))>".($x-1).";";
	$result=mysql_query($query) or die('Error SMxPM - '.mysql_error());
$ids = array();
while ($id = $mysql_fetch_array($result)) {
    $ids[] = $id;
}
$idlist = join(",", $ids);
}
}
return $idlist;
	}

function update_segmento_based_on_pago_months ($Old,$New,$count) {
	$idlist=0;
	if (is_int($count)) {
		$idlist=select_more_than_x_payment_months ($count);
		$query="update resumen 
		set status_de_credito=".$New." 
		where status_de_credito=".$Old." 
		and id_cuenta in (".$idlist.")
		;";
die($query);
		mysql_query($query) or die('Error USPM - '.mysql_error());
		}
	}
?>
