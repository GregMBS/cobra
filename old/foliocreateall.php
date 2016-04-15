<?php
$resultcheck = '';
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
//$folio=mysql_real_escape_string($_GET['folio']);
$foliolist='folios';
$today=date('Ymd');
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('propuestas');
$worksheet->setInputEncoding('ISO-8859-1');
$formata =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'lrft',
                                      'Bold' => 1,
                                      'Color' => 'black',
                                      'FgColor' => 'white'));
$formata->setFontFamily('Calibri');
$formatb =& $workbook->addFormat(array('Size' => 8,
                                      'Bold' => 0,
                                      'Color' => 'black',
                                      'FgColor' => 'white'));
$formatb->setFontFamily('Calibri');
$dateFormat =& $workbook->addFormat(array('Size' => 8,
                                      'Bold' => 0,
                                      'Color' => 'black',
                                      'FgColor' => 'white'));
$dateFormat->setFontFamily('Calibri');
$dateFormat->setNumFormat('DD/MM/YY');
$i=0;
// The actual data
$degree=utf8_decode('°');
$iacute=utf8_decode('ì');
$oacute=utf8_decode('ó');
$worksheet->write(0, 0, 'N'.$degree.' Credito',$formata);
$worksheet->write(0, 1, 'Nombre del Cliente',$formata);
$worksheet->write(0, 2, 'Capital',$formata);
$worksheet->write(0, 3, 'Saldo Cancelaci'.$oacute.'n',$formata);
$worksheet->write(0, 4, 'D'.$iacute.'as de Mora',$formata);
$worksheet->write(0, 5, 'Importe Negociado',$formata);
$worksheet->write(0, 6, 'Fecha de pago 1',$formata);
$worksheet->write(0, 7, 'Monto de pago 1 ',$formata);
$worksheet->write(0, 8, 'Fecha de pago 2',$formata);
$worksheet->write(0, 9, 'Monto de pago 2',$formata);
$worksheet->write(0, 10, 'Fecha de pago 3',$formata);
$worksheet->write(0, 11, 'Monto de pago 3',$formata);
$worksheet->write(0, 12, 'Fecha de pago 4',$formata);
$worksheet->write(0, 13, 'Monto de pago 4',$formata);
$worksheet->write(0, 14, 'Folio Conv',$formata);
$worksheet->write(0, 15, 'Motivo de atraso',$formata);
$worksheet->write(0, 16, 'Medio de pago',$formata);
$worksheet->write(0, 17, 'Asignaci'.$oacute.'n',$formata);
$querymaina = "create temporary table foliolist 
select distinct resumen.cliente,folio,enviado,ifnull(numero_de_credito,numero_de_cuenta),nombre_deudor,capital,saldo_can,
mora,h1.n_prom1+h1.n_prom2+h1.n_prom3+h1.n_prom4,datediff(h1.d_prom1,'1970-01-01'),h1.n_prom1,
datediff(h1.d_prom2,'1970-01-01'),h1.n_prom2,
datediff(h1.d_prom3,'1970-01-01'),h1.n_prom3,
datediff(h1.d_prom4,'1970-01-01'),h1.n_prom4,
cuenta_concentradora_1,
h1.d_fech,resumen.id_cuenta,
h1.c_cnp,folios.auto,h1.c_prom,h1.c_freq,
to_days(h1.d_prom2)-to_days(h1.d_prom1)
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 and folios.fecha>h2.d_fech
and h2.c_cvst like 'PRO%DE%' and h2.auto>h1.auto
left join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) and pagos.fecha<h1.d_fech
and exists (
select * from historia where pagos.fecha between d_fech and d_prom
and id=c_cont
)
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and monto is null and h2.auto is null
and folios.cliente regexp 'Credito Si' 
and h1.c_cvst like 'PROMESA DE%'";
mysql_query($querymaina) or die(mysql_error());
$querymainb = "insert into foliolist 
select distinct resumen.cliente,folio,enviado,ifnull(numero_de_credito,numero_de_cuenta),nombre_deudor,
capital,saldo_can,mora,
h1.n_prom1+sum(pagos.monto),
datediff(max(pagos.fecha),'1970-01-01'),sum(pagos.monto),
datediff(h1.d_prom1,'1970-01-01'),h1.n_prom1,
datediff(h1.d_prom2,'1970-01-01'),h1.n_prom2,
datediff(h1.d_prom3,'1970-01-01'),h1.n_prom3,
cuenta_concentradora_1,
h1.d_fech,resumen.id_cuenta,
h1.c_cnp,folios.auto,h1.c_prom,h1.c_freq,
to_days(h1.d_prom1)-to_days(max(pagos.fecha))
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and h2.d_fech > h1.d_fech and folios.fecha>h2.d_fech 
and h2.c_cvst like 'PRO%DE%'
join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and exists (
select * from historia where pagos.fecha between d_fech and d_prom
and id=c_cont
)
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and h2.auto is null
and folios.cliente regexp 'Credito Si' group by folio
";
mysql_query($querymainb) or die(mysql_error());
$querymain="select * from foliolist 
order by folio;";
$result = mysql_query($querymain) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$CLIENTE=$row[0];
$FOLIO=$row[1];
$foliolist=$foliolist.'.'.$FOLIO;
//$ENVIADO=$row[2];
$CUENTA=$row[3];
$NOMBRE=$row[4];
$SD=$row[5];
$ST=$row[6];
$DV=$row[7];
$NP=$row[8];
$DP1 = $row[9]+25569; 
$NP1=$row[10];
$DP2 = $row[11]+25569; 
$NP2=$row[12];
if ($NP2==0) {$DP2='';}
$DP3 = $row[13]+25569; 
$NP3=$row[14];
if ($NP3==0) {$DP3='';}
$DP4 = $row[15]+25569; 
$NP4=$row[16];
if ($NP4==0) {$DP4='';}
$COBRADOR=$row[17];
if ($CLIENTE=='Prestamo Relampago') {$COBRADOR='ADARSA';}
//$DFECH=$row[14];
//$ID_CUENTA=$row[15];
$CNP=trim($row[20]);
//$auto=$row[17];
$MDP=$row[22];
$FREQ='quincenal';
$DIFF=$row[24];
if ($DIFF<14) {$FREQ='semanal';}
if ($DIFF>20) {$FREQ='mensual';}
if (empty($DIFF)) {$FREQ='mensual';}
$CNPA='MD';
setlocale(LC_MONETARY, 'en_US');
if ($CLIENTE=='Credito Si') {
$querycnp="select csi_cr from csidict where dictamen sounds like '".$CNP."';";
$resultcnp = mysql_query($querycnp) or die(mysql_error());
while($rowcnp = mysql_fetch_row($resultcnp)) {$CNPA=$rowcnp[0];}
}
$i=$i+1;
$worksheet->write($i, 0, $CUENTA,$formatb);
$worksheet->write($i, 1, $NOMBRE,$formatb);
$worksheet->write($i, 2, money_format('%.2n',$SD),$formatb);
$worksheet->write($i, 3, money_format('%.2n',$ST),$formatb);
$worksheet->write($i, 4, $DV+0,$formatb);
$worksheet->write($i, 5, money_format('%n',$NP),$formatb);
$worksheet->write($i, 6, $DP1,$dateFormat);
$worksheet->write($i, 7, money_format('%n',$NP1),$formatb);
if ($NP2>0) {
$worksheet->write($i, 8, $DP2,$dateFormat);
$worksheet->write($i, 9, money_format('%n',$NP2),$formatb);
}
else {
$worksheet->write($i, 8, '');
$worksheet->write($i, 9, 0);
}
if ($NP3>0) {
$worksheet->write($i, 10, $DP3,$dateFormat);
$worksheet->write($i, 11, money_format('%n',$NP3),$formatb);
}
else {
$worksheet->write($i, 10, '');
$worksheet->write($i, 11, 0);
}
if ($NP4>0) {
$worksheet->write($i, 12, $DP4,$dateFormat);
$worksheet->write($i, 13, money_format('%n',$NP4),$formatb);
}
else {
$worksheet->write($i, 12, '');
$worksheet->write($i, 13, 0);
}
$worksheet->write($i, 14, $FOLIO,$formatb);
$worksheet->write($i, 15, $CNPA,$formatb);
$worksheet->write($i, 16, $MDP,$formatb);
$worksheet->write($i, 17, $COBRADOR,$formatb);
}
}
}
// Let's send the file
$filename="folioscs_".$today.".xls";
// sending HTTP headers
$workbook->send($filename);
$workbook->close();
mysql_close();
?>
