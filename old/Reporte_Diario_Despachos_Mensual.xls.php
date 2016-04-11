<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$queryayer="SELECT max(d_fech),year(max(d_fech)),month(max(d_fech)),day(max(d_fech)) FROM historia WHERE d_fech<curdate() and c_cvge<>'Milt';";
$resultayer=mysql_query($queryayer) or die(mysql_error);
while ($answerayer=mysql_fetch_row($resultayer)) {
        $ayer=$answerayer[0];
        $ano=$answerayer[1];
        $mes=$answerayer[2];
        $dia=$answerayer[3];
        }
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$filename="Reporte_Diario_Despachos_mensual.xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte CS');
$worksheet->setInputEncoding('ISO-8859-1');
$formatb =& $workbook->addFormat();
$formatb->setBgColor(15);
$formatb->setBold(100);
$worksheet->write(0, 0, 'Reporte Diario de Gestiones Telefónicas',$formatb);
$worksheet->mergeCells(0, 0, 0, 4);
$worksheet->write(1, 0, '1.-');
$worksheet->write(1, 1, 'Agencia:');
$worksheet->mergeCells(1, 1, 1, 2);
$worksheet->write(1, 3, 'Administracion Avanzada y Recuperacion',$formatb);
$worksheet->mergeCells(1, 3, 1, 5);
$worksheet->write(2, 0, '2.-');
$worksheet->write(2, 1, 'Reporte del día:');
$worksheet->mergeCells(2, 1, 2, 2);
$worksheet->write(2, 3, date('j \d\e M \d\e Y',mktime(0,0,0,$mes,$dia,$ano)),$formatb);
$worksheet->mergeCells(2, 3, 2, 5);
$worksheet->write(3, 0, '3.-');
$worksheet->write(3, 2, 'Campañas trabajadas:');
$worksheet->mergeCells(3, 2, 3, 3);
$worksheet->write(3, 4, 'Segmento:');
$worksheet->write(3, 5, '# Cuentas:');
$worksheet->write(3, 6, '$ Monto:');
$j=3;
$cuentass=0;
$capitals=0;
$cuentasgs=0;
$gestioness=0;
$efectivoss=0;
$promesass=0;
$montoproms=0;
$vocacions=0;
$querylp="CREATE TEMPORARY TABLE lastprom SELECT c_cont,max(auto) AS lp FROM historia 
WHERE (c_cvst like 'PROMESA DE%' OR c_cvst like 'PROPUESTA DE%')
AND (d_prom>=curdate() OR (cuenta,c_cvba) IN (select cuenta,cliente from pagos))
GROUP BY c_cont";
mysql_query($querylp) or die(mysql_error());
$queryq="SELECT '1er Gestion',left(status_de_credito,4),count(1), sum(saldo_descuento_2/1.1)
FROM resumen 
WHERE cliente='Credito Si'
AND status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado' 
GROUP BY status_de_credito;";
$resultq=mysql_query($queryq) or die(mysql_error());
while ($answerq=mysql_fetch_row($resultq)) {
$j++;
$queue=$answerq[0];
$segmentoq=$answerq[1];
$cuentasq=$answerq[2];
$montoq=$answerq[3];
$worksheet->write($j, 1, $j-3);
$worksheet->write($j, 2, $queue,$formatb);
$worksheet->mergeCells($j, 2, $j, 3);
$worksheet->write($j, 4, $segmentoq,$formatb);
$worksheet->write($j, 5, $cuentasq,$formatb);
$worksheet->write($j, 6, number_format($montoq,0),$formatb);
} 
$j++;
$worksheet->write($j, 0, '4.-');
$worksheet->write($j, 1, 'Operación Call center:');
$worksheet->mergeCells($j, 1, $j, 2);
$j++;
$worksheet->write($j, 2, 'Gestor',$formatb);
$worksheet->write($j, 3, 'Turno',$formatb);
$worksheet->write($j, 4, 'Segmento',$formatb);
$worksheet->write($j, 5, 'Cuentas Asignadas',$formatb);
$worksheet->write($j, 6, 'Capital Asignado',$formatb);
$worksheet->write($j, 7, 'Cuentas con Gestión',$formatb);
$worksheet->write($j, 8, 'Total de Gestiones',$formatb);
$worksheet->write($j, 9, 'Contactos Efectivos',$formatb);
$worksheet->write($j, 10, 'Promesas de Pago',$formatb);
$worksheet->write($j, 11, 'Monto en Promesas',$formatb);
$worksheet->write($j, 12, 'Vocación de Pago Positiva',$formatb);
$queryg="SELECT ejecutivo_asignado_call_center, turno, left(status_de_credito,4), 
count(id_cuenta), sum(saldo_descuento_2/1.1), 
sum(status_aarsa like 'PROMESA DE%' 
        OR status_aarsa like 'PROPUESTA DE%' 
        OR status_aarsa like 'ACLAR%' 
        OR status_aarsa like 'CONF%' 
        OR status_aarsa like 'PAG%' 
        OR status_aarsa like 'CLIENTE %' 
        OR status_aarsa like 'NEGATIVA%'),
sum(status_aarsa like 'PROMESA DE%' or status_aarsa like 'PROPUESTA DE%'),
sum(status_aarsa like 'CLIENTE N%'),
sum(id_cuenta in (select c_cont from historia where c_visit is null 

and d_fech='".$ayer."'))
FROM resumen 
JOIN nombres ON ejecutivo_asignado_call_center=usuaria
WHERE (tipo='callcenter' OR tipo='supervisor' OR tipo='admin')
AND cliente='Credito Si'
AND status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado'
GROUP BY ejecutivo_asignado_call_center, status_de_credito;";
$resultg=mysql_query($queryg) or die(mysql_error());
$i=$j;
while ($answerg=mysql_fetch_row($resultg)) {
$j++;
$gestor=$answerg[0];
$turno=$answerg[1];
$segmento=$answerg[2];
$cuentas=$answerg[3];
$cuentass+=$answerg[3];
$capital=$answerg[4];
$capitals+=$answerg[4];
$efectivos=$answerg[5];
$efectivoss+=$answerg[5];
$promesas=$answerg[6];
$promesass+=$answerg[6];
$vocacion=max(0,$answerg[7]);
$vocacions+=max(0,$answerg[7]);
$cuentasg=max(0,$answerg[8]);
$cuentasgs+=max(0,$answerg[8]);
$queryh="SELECT count(1),sum(n_prom*(d_prom>=curdate() OR (c_cvba,cuenta) IN (select cliente,cuenta from pagos))) FROM historia 
where 
c_cvge='".$gestor."' and c_cvba='Credito Si' 
and c_cont in (select id_cuenta from resumen where left(status_de_credito,4)='".$segmento."')
";
$resulth=mysql_query($queryh) or die(mysql_error());
while ($answerh=mysql_fetch_row($resulth)) {
$gestiones=$answerh[0];
$gestioness+=$answerh[0];
$montoprom=max(0,$answerh[1]);
$montoproms+=max(0,$answerh[1]);
$worksheet->write($j, 1, $j-$i);
$worksheet->write($j, 2, $gestor);
$worksheet->write($j, 3, $turno);
$worksheet->write($j, 4, $segmento);
$worksheet->write($j, 5, $cuentas);
$worksheet->write($j, 6, number_format($capital,0));
$worksheet->write($j, 7, $cuentasg);
$worksheet->write($j, 8, $gestiones);
$worksheet->write($j, 9, $efectivos);
$worksheet->write($j, 10, $promesas);
$worksheet->write($j, 11, number_format($montoprom,0));
$worksheet->write($j, 12, $vocacion);
 }
 }
$j++;
$worksheet->write($j, 5, $cuentass,$formatb);
$worksheet->write($j, 6, number_format($capitals,0),$formatb);
$worksheet->write($j, 7, $cuentasgs,$formatb);
$worksheet->write($j, 8, $gestioness,$formatb);
$worksheet->write($j, 9, $efectivoss,$formatb);
$worksheet->write($j, 10, $promesass,$formatb);
$worksheet->write($j, 11, number_format($montoproms,0),$formatb);
$worksheet->write($j, 12, $vocacions,$formatb);
$j++;
$worksheet->write($j, 1, 'Mensajes pre-grabados');
$worksheet->mergeCells($j, 1, $j, 2);
$queryrobot="select left(status_de_credito,4),count(1),sum(saldo_descuento_2/1.1)
from resumen 
where cliente='Credito Si'
AND status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado' 
group by status_de_credito;";
$resultrobot=mysql_query($queryrobot) or die(mysql_error());
while ($answerrobot=mysql_fetch_row($resultrobot)) {
$j++;
$sc=$answerrobot[0];
$scc=$answerrobot[1];
$scd=$answerrobot[2];
$worksheet->write($j, 1, 'Campaña '. $k);
$worksheet->write($j, 2, 'Iniciando gestion '. $sc,$formatb);
$worksheet->mergeCells($j, 2, $j, 3);
$worksheet->write($j, 4, '# Cuentas');
$worksheet->write($j, 5, $scc,$formatb);
$worksheet->write($j, 6, '$ Monto');
$worksheet->write($j, 7, number_format($scd,0),$formatb);
 }
$querylp2="DROP TABLE IF EXISTS lastprom";
mysql_query($querylp2) or die(mysql_error());
$workbook->close();
}
}
mysql_close();
?>
