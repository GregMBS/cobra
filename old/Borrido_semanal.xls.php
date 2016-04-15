<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="select 'ADARSA', numero_de_cuenta, nombre_deudor, fecha_de_asignacion, 
who(status_de_credito), saldo_cuota, subproducto, producto, ciudad_deudor, estado_deudor, 
'Asignacion Special',
saldo_vencido, pagos_vencidos*30, saldo_total, c_accion, c_cvst, status_aarsa, 
if (q(c_cvst)<>'SIN CONTACTOS' AND c_visit is not null,'si','no'), 
if (q(c_cvst)<>'SIN CONTACTOS' AND c_tele is not null,'si','no'),ge_stat, 
if(n_prom>0,d_fech,'no'),if(n_prom>0,n_prom,'no'),if(n_prom>0,d_prom,'no'), 
if(c_ndir<>'', c_ndir,'no'),'no', if(c_ntel<>'',c_ntel,'no'),'no', 
if(c_obse2<>'',c_obse2, 'no'), 'no', 'no', mc, mv
from resumen join historia on c_cont=id_cuenta
left join gedict on c_cvst=dictamen
left join (select c_cont, from_days(to_days(max(d_fech*(c_tele is not null)))) as mc, 
from_days(to_days(max(d_fech*(c_visit is not null)))) as mv
from historia where c_cvba='GE Capital' group by c_cont) as tmp1 on (tmp1.c_cont=id_cuenta)
where c_cvba='GE Capital' and d_fech>=last_day(curdate()-interval 5 week)
;";
$result=mysql_query($querymain) or die(mysql_error);

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Borrido_semanal_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte');
$worksheet->setInputEncoding('ISO-8859-1');

// The actual data
$worksheet->write(0, 0, 'Agencia');
$worksheet->write(0, 1, 'No Cuenta');
$worksheet->write(0, 2, 'Nombre del Cliente');
$worksheet->write(0, 3, 'Fecha Asignación');
$worksheet->write(0, 4, 'Bucket Asignado');
$worksheet->write(0, 5, 'Balance Asignado');
$worksheet->write(0, 6, 'Producto');
$worksheet->write(0, 7, 'RETAIL');
$worksheet->write(0, 8, 'Ciudad');
$worksheet->write(0, 9, 'Estado');
$worksheet->write(0, 10, 'Tipo Asigna');
$worksheet->write(0, 11, 'Saldo Vencido (CURRENT)');
$worksheet->write(0, 12, 'Bucket / DPD actual');
$worksheet->write(0, 13, 'Balance Actual');
$worksheet->write(0, 14, 'TIPO DE GESTION');
$worksheet->write(0, 15, 'STATUS');
$worksheet->write(0, 16, 'Resumen de Gestiones');
$worksheet->write(0, 17, 'Confirma domicilio');
$worksheet->write(0, 18, 'Confirma Teléfono');
$worksheet->write(0, 19, 'RESULTADO DE GESTION');
$worksheet->write(0, 20, 'PROMESA VIGENTE AL  (fecha de reporte)');
$worksheet->write(0, 21, 'MONTO DE PROMESA');
$worksheet->write(0, 22, 'FECHA DE PROMESA DE PAGO ');
$worksheet->write(0, 23, 'Otro Domicilio Particular');
$worksheet->write(0, 24, 'Otro Domicilio de Trabajo');
$worksheet->write(0, 25, 'Otro Telefono Particular');
$worksheet->write(0, 26, 'Otro Telefono de Trabajo');
$worksheet->write(0, 27, 'Telefono Adicional 1');
$worksheet->write(0, 28, 'Telefono Adicional 2');
$worksheet->write(0, 29, 'Telefono Adicional 3');
$worksheet->write(0, 30, 'Fecha de Ultima Gestion Telefonica');
$worksheet->write(0, 31, 'Fecha de Ultima Visita');
$i=0;
while ($answer=mysql_fetch_row($result)) {
$i++;
$worksheet->write($i, 0, $answer[0]);
$worksheet->write($i, 1, "'".$answer[1]);
$worksheet->write($i, 2, $answer[2]);
$worksheet->write($i, 3, $answer[3]);
$worksheet->write($i, 4, $answer[4]);
$worksheet->write($i, 5, $answer[5]);
$worksheet->write($i, 6, $answer[6]);
$worksheet->write($i, 7, $answer[7]);
$worksheet->write($i, 8, $answer[8]);
$worksheet->write($i, 9, $answer[9]);
$worksheet->write($i, 10, $answer[10]);
$worksheet->write($i, 11, $answer[11]);
$worksheet->write($i, 12, $answer[12]);
$worksheet->write($i, 13, $answer[13]);
$worksheet->write($i, 14, $answer[14]);
$worksheet->write($i, 15, $answer[15]);
$worksheet->write($i, 16, $answer[16]);
$worksheet->write($i, 17, $answer[17]);
$worksheet->write($i, 18, $answer[18]);
$worksheet->write($i, 19, $answer[19]);
$worksheet->write($i, 20, $answer[20]);
$worksheet->write($i, 21, $answer[21]);
$worksheet->write($i, 22, $answer[22]);
$worksheet->write($i, 23, $answer[23]);
$worksheet->write($i, 24, $answer[24]);
$worksheet->write($i, 25, $answer[25]." ");
$worksheet->write($i, 26, $answer[26]." ");
$worksheet->write($i, 27, $answer[27]." ");
$worksheet->write($i, 28, $answer[28]." ");
$worksheet->write($i, 29, $answer[29]." ");
if (empty($answer[30])) {$worksheet->write($i, 30, 'no');}
else {$worksheet->write($i, 30, $answer[30]);}
if (empty($answer[31])) {$worksheet->write($i, 31, 'no');}
else {$worksheet->write($i, 31, $answer[31]);}
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
