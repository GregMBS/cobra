<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$desp = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querydown='select count(1) from resumen
where cliente="GE Capital" and fecha_de_actualizacion>last_day(curdate()-interval 5 week);';
$resultdown = mysql_query($querydown) or die(mysql_error());
while ($answerdown = mysql_fetch_row($resultdown)) {$download=$answerdown[0];}
$querymain="select d_fech,sum(c_tele is not null) as Dial,sum(c_carg<>'' and c_tele is not null) as Connect, 
sum(c_carg='Deudor' and c_tele is not null) as RPC, sum(n_prom>0 and c_tele is not null) as PTP, 
count(distinct hour(c_hrin),c_cvge) as 'System Hours', 
sum(c_carg<>'' and c_tele is not null)/sum(c_tele is not null) as 'Connect Rate',
sum(c_carg='Deudor' and c_tele is not null)/sum(c_carg<>'' and c_tele is not null) as 'RPC Rate', 
count(distinct c_cvge) as Agentes,
sum(n_prom>0 and c_tele is not null)/sum(c_carg='Deudor' and c_tele is not null) as 'Promise Rate', 
sum(exists (select * from pagos where c_cont=id_cuenta and fecha>last_day(curdate()-interval 5 week)))/sum(n_prom>0 and c_tele is not null),
sum(c_visit is not null) as Visits,
sum(c_carg='Deudor' and c_visit is not null)/sum(c_visit is not null) as vRPC,
sum(n_prom>0 and c_visit is not null)/(sum(c_carg='Deudor' and c_visit is not null)+0.001) as vPTP
from historia
where c_cvba='GE Capital' and d_fech>last_day(curdate()-interval 5 week)
group by d_fech
;";
$result=mysql_query($querymain) or die(mysql_error);

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Sumario_de_operaciones_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte');
$worksheet->setInputEncoding('ISO-8859-1');
$format_title1 =& $workbook->addFormat();
$format_title1->setBold();
$format_title1->setAlign('merge');
$format_title2 =& $workbook->addFormat();
$format_title2->setBold();
$format_title2->setAlign('merge');
$format_title3 =& $workbook->addFormat();
$format_title3->setBold();

// The actual data
$worksheet->write(0, 0, '', $format_title3);
$worksheet->write(1, 0, '', $format_title3);
$worksheet->write(2, 0, 'Primera Asig', $format_title3);
$worksheet->write(3, 0, '', $format_title3);
$worksheet->write(4, 0, ' ', $format_title3);
$worksheet->write(5, 0, '1.- DIALER EFICIENCY', $format_title3);
$worksheet->write(6, 0, '   1.0 Total Download', $format_title3);
$worksheet->write(7, 0, '   1.1 Total Dials', $format_title3);
$worksheet->write(8, 0, '   1.2 Total Connects', $format_title3);
$worksheet->write(9, 0, '   1.3 Total RPCs', $format_title3);
$worksheet->write(10, 0, '   1.4 Total PTPs', $format_title3);
$worksheet->write(11, 0, '   1.5  Total System Hours', $format_title3);
$worksheet->write(12, 0, '   1.6  Penetration Rate', $format_title3);
$worksheet->write(13, 0, '   1.7  Connect  Rate', $format_title3);
$worksheet->write(14, 0, '   1.8 RPC Rate', $format_title3);
$worksheet->write(15, 0, '   1.9 Agentes', $format_title3);
$worksheet->write(16, 0, '2.- DIALER COLLECTOR EFFICIENCY', $format_title3);
$worksheet->write(17, 0, '   2.0 Promise Rate', $format_title3);
$worksheet->write(18, 0, '   2.1 Kept Promise', $format_title3);
$worksheet->write(19, 0, '3.- DOOR TO DOOR', $format_title3);
$worksheet->write(20, 0, '   3.0  Visits', $format_title3);
$worksheet->write(21, 0, '   3.1  Visits/Accs.', $format_title3);
$worksheet->write(22, 0, '   3.2   % RPC/Accs. ', $format_title3);
$worksheet->write(23, 0, '   3.3  % PTP/RPC', $format_title3);
$worksheet->write(24, 0, '   3.4  % KP/PTP', $format_title3);
$i=1;
while ($answerop=mysql_fetch_row($result)) {
$i++;
$date = new DateTime($answerop[0]);
$fech=$date->format('d-m');
$dow=$desp[$date->format('w')];
$dial=$answerop[1];
$connect=$answerop[2];
$RPC=$answerop[3];
$PTP=$answerop[4];
$shours=$answerop[5];
$penetration=round($dial/$download*100)."%";
$crate=round($answerop[6]*100)."%";
$rrate=round($answerop[7]*100)."%";
$agentes=$answerop[8];
$prate=round($answerop[9]*100)."%";
$krate=$answerop[10];
$visits=$answerop[11];
$vrate=round($visits/$download*100)."%";
$vRPC=round($answerop[12]*100)."%";
$vPTP=round($answerop[13]*100)."%";
$worksheet->write(3, $i, $fech);
$worksheet->write(4, $i, $dow);

$worksheet->write(6, $i, $download);
$worksheet->write(7, $i, $dial);
$worksheet->write(8, $i, $connect);
$worksheet->write(9, $i, $RPC);
$worksheet->write(10, $i, $PTP);
$worksheet->write(11, $i, $shours);
$worksheet->write(12, $i, $penetration);
$worksheet->write(13, $i, $crate);
$worksheet->write(14, $i, $rrate);
$worksheet->write(15, $i, $agentes);

$worksheet->write(17, $i, $prate);
$worksheet->write(18, $i, $krate);

$worksheet->write(20, $i, $visits);
$worksheet->write(21, $i, $vrate);
$worksheet->write(22, $i, $vRPC);
$worksheet->write(23, $i, $vPTP);
$worksheet->write(24, $i, '');
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
