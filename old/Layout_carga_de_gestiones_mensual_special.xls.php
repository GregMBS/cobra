<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT cuenta,DATE_FORMAT(d_fech,'%d/%m/%Y'),DATE_FORMAT(c_hrin,'%H:%i'),
status_de_credito,if (c_visit is not null,'DV','DT'),codigo,csi_tipo,csi_cr,
if (n_prom>0,DATE_FORMAT(d_prom,'%d/%m/%Y'),''),if (n_prom>0,floor(n_prom),''),
left(c_obse1,200),ejecutivo_asignado_call_center,cuenta_concentradora_1 
from historia left join csidict on c_cvst=dictamen left join csilugar on accion=c_accion 
join resumen on c_cont=id_cuenta
where month(d_fech)=month(curdate() - interval 10 day) and year(d_fech)=year(curdate() - interval 10 day) 
and cliente='Credito Si' 
and fecha_de_actualizacion>last_day(curdate() - interval 1 month)
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error);

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Layout_carga_de_gestiones_cs_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte CS');
$worksheet->setInputEncoding('ISO-8859-1');

// The actual data
$worksheet->write(0, 0, 'Numero de Credito');
$worksheet->write(0, 1, 'Fecha de gestion');
$worksheet->write(0, 2, 'Hora de gestion');
$worksheet->write(0, 3, 'Cobrador');
$worksheet->write(0, 4, 'Codigo de gestion');
$worksheet->write(0, 5, 'Lugar de gestion');
$worksheet->write(0, 6, 'Tipo de contacto');
$worksheet->write(0, 7, 'Resultado de la gestion');
$worksheet->write(0, 8, 'Fecha Promesa de Pago');
$worksheet->write(0, 9, 'Monto Promesa de Pago');
$worksheet->write(0, 10, 'Comentario');
$i=0;
while ($answer=mysql_fetch_row($result)) {
$i++;
$C_HRIN=$answer[2];
if  (date('G',$C_HRIN)>22) {$C_HRIN=strtotime("-17 hours",$C_HRIN);}
if  (date('G',$C_HRIN)<6) {$C_HRIN=strtotime("+6 hours",$C_HRIN);}
$COBRADOR=$answer[0];
$worksheet->write($i, 0, $answer[0]);
$worksheet->write($i, 1, $answer[1]);
$worksheet->write($i, 2, $C_HRIN);
$worksheet->write($i, 3, $answer[12]);
$worksheet->write($i, 4, $answer[4]);
$worksheet->write($i, 5, $answer[5]);
$worksheet->write($i, 6, $answer[6]);
$worksheet->write($i, 7, $answer[7]);
$worksheet->write($i, 8, $answer[8]);
$worksheet->write($i, 9, $answer[9]);
$worksheet->write($i, 10, $answer[10]);
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
