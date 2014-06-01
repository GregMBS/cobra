<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$quote='"';
$querybig="select Nombre_deudor,	Domicilio_Deudor,	Colonia_Deudor,
Ciudad_Deudor,	Estado_Deudor,	CP_deudor,	Plano_Guia_Roji,
Cuadrante_Guia_Roji,	Tel_1,	Tel_2,	Numero_de_cuenta,
Numero_de_Credito,	Contrato,	Saldo_Total,	Saldo_Vencido,
Saldo_Descuento_1,	Saldo_Descuento_2,	Fecha_Corte,
Fecha_Limite,	Fecha_de_Ultimo_Pago,	Monto_Ultimo_Pago,
Producto,	Subproducto,	Cliente,	Status_de_Credito,
Pagos_Vencidos,	pc_de_Descuento,	Fecha_de_Asignacion,
	Expediente,
ID_CUENTA,	c_cvst,	c_motiv,	c_ACCION,
c_obse1,	d_fech, c_Hrin,	c_cvge,	n_prom,	d_prom, c_cnp
from resumen join historia on id_cuenta=c_cont 
where year(d_fech)=year(curdate()) and month(d_fech)=month(curdate())
order by id_cuenta into outfile '/tmp/advanced.csv' 
FIELDS TERMINATED BY ',' ENCLOSED BY '".$quote."' LINES TERMINATED BY '\n';";
$resultbig=mysql_query($querybig) or die(mysql_error());
}
}
mysql_close($con);
?>
