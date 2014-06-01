<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT cuenta,DATE_FORMAT(d_fech,'%m%d%Y'),
DATE_FORMAT(c_hrin,'%H:%i:%s'),codigo,cr.csi_cr,'',
left(C_OBSE1,56),substring(C_OBSE1,57,56),substring(C_OBSE1,114,56),
substring(C_OBSE1,171,56),substring(C_OBSE1,229,56) 
from resumen 
join historia on c_cont=id_cuenta
left join cyberres cr on c_cvst=cr.dictamen
left join cyberact on accion=c_accion 
where month(d_fech)=month(curdate() - interval 6 day) and year(d_fech)=year(curdate() - interval 6 day) 
and cliente='Surtidor del Hogar' 
and fecha_de_actualizacion>last_day(curdate() - interval 1 month)
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Layout_carga_de_gestiones_sdh_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte CS');
$worksheet->setInputEncoding('ISO-8859-1');

// The actual data
$worksheet->write(0, 0, 1);
$worksheet->write(0, 1, 2);
$worksheet->write(0, 2, 3);
$worksheet->write(0, 3, 4);
$worksheet->write(0, 4, 5);
$worksheet->write(0, 5, 6);
$worksheet->write(0, 6, 7);
$worksheet->write(0, 7, 8);
$worksheet->write(0, 8, 9);
$worksheet->write(0, 9, 10);
$worksheet->write(1, 0, 'Valor constante ');
$worksheet->write(1, 1, 'Grupo');
$worksheet->write(1, 2, 'Numero de cuenta');
$worksheet->write(1, 3, 'Fecha y hora de actividad');
$worksheet->write(1, 4, 'No. de secuencia. Usado para ordenar cómo se muestra en sesión. Esta secuencia se ignora si las actividades se clasifican por fecha y hora.');
$worksheet->write(1, 5, 'Código de acción');
$worksheet->write(1, 6, 'Código de resultado');
$worksheet->write(1, 7, 'Código de carta');
$worksheet->write(1, 8, 'Id agente o apellido paterno');
$worksheet->write(1, 9, 'Comentario');
$i=1;
while ($answer=mysql_fetch_row($result)) {
$i++;
$j=1;
$worksheet->write($i, 0, 200);
$worksheet->write($i, 1, 7);
$worksheet->write($i, 2, $answer[0]);
$worksheet->write($i, 3, $answer[1]." ".$answer[2]);
$worksheet->write($i, 4, $j);
$worksheet->write($i, 5, $answer[3]);
$worksheet->write($i, 6, $answer[4]);
$worksheet->write($i, 7, $answer[5]);
$worksheet->write($i, 8, 'ADARSA');
$worksheet->write($i, 9, $answer[6]);
if ($answer[7]!='') {
$i++;
$j++;
$worksheet->write($i, 0, 200);
$worksheet->write($i, 1, 7);
$worksheet->write($i, 2, $answer[0]);
$worksheet->write($i, 3, $answer[1]." ".$answer[2]);
$worksheet->write($i, 4, $j);
$worksheet->write($i, 5, $answer[3]);
$worksheet->write($i, 6, $answer[4]);
$worksheet->write($i, 7, $answer[5]);
$worksheet->write($i, 8, 'ADARSA');
$worksheet->write($i, 9, $answer[7]);
	}
if ($answer[8]!='') {
$i++;
$j++;
$worksheet->write($i, 0, 200);
$worksheet->write($i, 1, 7);
$worksheet->write($i, 2, $answer[0]);
$worksheet->write($i, 3, $answer[1]." ".$answer[2]);
$worksheet->write($i, 4, $j);
$worksheet->write($i, 5, $answer[3]);
$worksheet->write($i, 6, $answer[4]);
$worksheet->write($i, 7, $answer[5]);
$worksheet->write($i, 8, 'ADARSA');
$worksheet->write($i, 9, $answer[8]);
	}
if ($answer[9]!='') {
$i++;
$j++;
$worksheet->write($i, 0, 200);
$worksheet->write($i, 1, 7);
$worksheet->write($i, 2, $answer[0]);
$worksheet->write($i, 3, $answer[1]." ".$answer[2]);
$worksheet->write($i, 4, $j);
$worksheet->write($i, 5, $answer[3]);
$worksheet->write($i, 6, $answer[4]);
$worksheet->write($i, 7, $answer[5]);
$worksheet->write($i, 8, 'ADARSA');
$worksheet->write($i, 9, $answer[9]);
	}
if ($answer[10]!='') {
$i++;
$j++;
$worksheet->write($i, 0, 200);
$worksheet->write($i, 1, 7);
$worksheet->write($i, 2, $answer[0]);
$worksheet->write($i, 3, $answer[1]." ".$answer[2]);
$worksheet->write($i, 4, $j);
$worksheet->write($i, 5, $answer[3]);
$worksheet->write($i, 6, $answer[4]);
$worksheet->write($i, 7, $answer[5]);
$worksheet->write($i, 8, 'ADARSA');
$worksheet->write($i, 9, $answer[10]);
	}
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
