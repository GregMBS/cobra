<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain1="select distinct CLIENTE,status_de_credito as 'CAMPAÑA',
ejecutivo_asignado_call_center as 'GESTOR',numero_de_cuenta as 'CUENTA',
nombre_deudor as 'NOMBRE',saldo_total as SALDO,QUEUE
from resumen left join dictamenes on dictamen=status_aarsa
where fecha_ultima_gestion<=last_day(curdate() - interval 1 month - interval 1 week)
and status_de_credito not regexp 'tivo'
order by cliente,status_de_credito,queue;";
$querymain1s="select CLIENTE,q(status_aarsa) as 'QUEUE',
sum(fecha_ultima_gestion<last_day(curdate() - interval 1 month) + interval 1 day) as 'CUENTAS_SIN_GESTION',
sum(saldo_total*(fecha_ultima_gestion<last_day(curdate() - interval 1 month) + interval 1 day)) as 'SALDO CAPITAL',
substring_index(status_de_credito,'-',1) as 'STATUS',sum(fecha_ultima_gestion='0000-00-00') as 'SIEMPRE',count(1)
from resumen 
where status_de_credito not regexp 'tivo'
group by cliente,status,queue;";

$querymain2="select distinct CLIENTE,sdc as 'CAMPAÑA',status_aarsa as queue,
(1-bloqueado) as 'ACTIVO'
from queuelist 
order by cliente,sdc,queue,bloqueado;";

$querymain3="select resumen.CLIENTE,status_de_credito as 'CAMPAÑA',QUEUE,
who(ejecutivo_asignado_call_center) as 'GESTOR',
CUENTA,nombre_deudor as 'NOMBRE',FECHA,MONTO 
from resumen
join pagos on resumen.cliente=pagos.cliente and cuenta=numero_de_cuenta
left join dictamenes on dictamen=status_aarsa
where month(fecha)=month(curdate() - interval 1 week)
order by gestor,cuenta,fecha;
";
$querymain3s="select resumen.CLIENTE,
who(ejecutivo_asignado_call_center) as 'GESTORl',
count(distinct id_cuenta) as 'CUENTAS_PAGO',
sum(saldo_total) as 'SALDO_CAPITAL', 
who(status_de_credito) AS 'STATUS',
sum(monto) 
from resumen
join pagos on resumen.cliente=pagos.cliente and cuenta=numero_de_cuenta
where month(fecha)=month(curdate() - interval 1 week)
group by cliente,status,gestorl;";

$querymain4="select CLIENTE,status_de_credito as 'CAMPAÑA',c_cvge as 'GESTOR',
CUENTA,nombre_deudor as 'NOMBRE',d_prom1 as 'fecha_1',n_prom1 as 'monto_1',
d_prom2 as 'FECHA_2',n_prom2 as 'MONTO_2',status_aarsa as 'status' 
from resumen
join historia on c_cont=id_cuenta
where d_prom>=curdate()
order by cliente,gestor;";
$querymain4b="create temporary table lastprom (UNIQUE (id_cuenta)) select id_cuenta,fup(id_cuenta) as fp 
from resumen having fp is not null and fp>curdate();";
$querymain4s="select c_cvba,c_cvge,0,
sum((n_prom>0) and (concat_ws(' ',d_prom,c_hrin)=fp))+0,sum(n_prom * (concat_ws(' ',d_prom,c_hrin)=fp)),status_de_credito,
sum(d_prom<=last_day(curdate()) and concat_ws(' ',d_prom,c_hrin)=fp),sum(n_prom*((d_prom<=last_day(curdate()) and concat_ws(' ',d_prom,c_hrin)=fp))),
sum(d_prom>last_day(curdate()) and concat_ws(' ',d_prom,c_hrin)=fp AND d_prom<=last_day(curdate() + interval 1 month)),sum(n_prom*(d_prom>last_day(curdate()) and concat_ws(' ',d_prom,c_hrin)=fp AND d_prom<=last_day(curdate() + interval 1 month))),
sum(c_cvst='PROMESA DE PAGO TOTAL'),sum(c_cvst='PROMESA DE PAGO PARCIAL'),sum(c_cvst='PAGANDO CONVENIO')
from resumen join historia on c_cont=id_cuenta left join lastprom using (id_cuenta)
where (d_fech>last_day(curdate() - interval 1 month) and c_cont>0 and c_cvge<>'Milt' and c_cniv is null)
group by cliente,status_de_credito,c_cvge";

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$formata =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'center',
                                      'Color' => 'blue',
                                      'FgColor' => 'white'));
$formata->setFontFamily('Calibri');
$formatbighead =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'left',
                                      'Color' => 'blue',
                                      'FgColor' => 'white'));
$formatbighead->setFontFamily('Calibri');
$formatsumhead =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'center',
                                      'Color' => 'blue',
                                      'FgColor' => 22));
$formatsumhead->setFontFamily('Calibri');
$formatsumhead->setBorder('2');
$formatsumbody =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'center',
                                      'Color' => 'blue',
                                      'FgColor' => 22));
$formatsumbody->setFontFamily('Calibri');
$formatsumbody->setBorder('1');
$fsbr =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'center',
                                      'Color' => 'black',
                                      'FgColor' => 'yellow'));
$fsbr->setFontFamily('Calibri');
$fsbr->setBorder('1');
$formatsumleft =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'left',
                                      'Color' => 'blue',
                                      'FgColor' => 22));
$formatsumleft->setFontFamily('Calibri');
$formatsumleft->setBorder('1');
$fslr =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'left',
                                      'Color' => 'black',
                                      'FgColor' => 'yellow'));
$fslr->setFontFamily('Calibri');
$fslr->setBorder('1');
$formatdethead =& $workbook->addFormat(array('Size' => 11,
                                      'Align' => 'center',
                                      'Color' => 'white',
                                      'FgColor' => 'blue'));
$formatdethead->setFontFamily('Arial Narrow');
$formatdethead->setBold('1');
$formatdethead->setBorder('2');
$formatdetbody =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'center',
                                      'Color' => 'black',
                                      'FgColor' => 'white'));
$formatdetbody->setFontFamily('Arial Narrow');
$formatdetbody->setBorder('1');
$fdbr =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'center',
                                      'Color' => 'black',
                                      'FgColor' => 'yellow'));
$fdbr->setFontFamily('Arial Narrow');
$fdbr->setBorder('1');
$formatdetleft =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'left',
                                      'Color' => 'black',
                                      'FgColor' => 'white'));
$formatdetleft->setFontFamily('Arial Narrow');
$formatdetleft->setBorder('1');
$fdlr =& $workbook->addFormat(array('Size' => 8,
                                      'Align' => 'left',
                                      'Color' => 'black',
                                      'FgColor' => 'yellow'));
$fdlr->setFontFamily('Arial Narrow');
$fdlr->setBorder('1');

$fecha1=date("d\_M");

$filename="Reporte_diario_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet1 =& $workbook->addWorksheet('SIN GESTION');
$worksheet1->setInputEncoding('utf-8');
$worksheet2 =& $workbook->addWorksheet('QUEUES');
$worksheet2->setInputEncoding('utf-8');
$worksheet3 =& $workbook->addWorksheet('PAGOS');
$worksheet3->setInputEncoding('utf-8');
$worksheet4 =& $workbook->addWorksheet('PROMESAS');
$worksheet4->setInputEncoding('utf-8');

// SIN GESTION
$worksheet1->write(2, 3, 'CHECK LIST',$formata);
$worksheet1->write(2, 12, 'DETALLE DE SIN GESTION',$formatsumhead);
$worksheet1->write(4, 1, '1.- CUENTAS SIN GESTION',$formatbighead);
$worksheet1->write(5, 1, 'CLIENTE',$formatsumhead);
$worksheet1->write(5, 2, 'QUEUE',$formatsumhead);
$worksheet1->write(5, 3, 'CUENTAS',$formatsumhead);
$worksheet1->write(5, 4, 'CUENTAS SIN GESTION',$formatsumhead);
$worksheet1->write(5, 5, 'SALDO CAPITAL',$formatsumhead);
$worksheet1->write(5, 6, 'STATUS',$formatsumhead);
$worksheet1->write(5, 7, 'ESTE MES',$formatsumhead);
$worksheet1->write(5, 8, 'EN COBRA',$formatsumhead);
$worksheet1->write(5, 9, 'CLIENTE',$formatdethead);
$worksheet1->write(5, 10, 'CAMPAÑA',$formatdethead);
$worksheet1->write(5, 11, 'GESTOR',$formatdethead);
$worksheet1->write(5, 12, 'CUENTA',$formatdethead);
$worksheet1->write(5, 13, 'NOMBRE',$formatdethead);
$worksheet1->write(5, 14, 'SALDO',$formatdethead);
$worksheet1->write(5, 15, 'QUEUE',$formatdethead);
$result1=mysql_query($querymain1);						  
$i=5;
while ($answer1=mysql_fetch_row($result1)) {
$i++;
$worksheet1->write($i, 9, $answer1[0],$formatdetleft);
$worksheet1->write($i, 10, $answer1[1],$formatdetleft);
$worksheet1->write($i, 11, $answer1[2],$formatdetbody);
$worksheet1->write($i, 12, $answer1[3],$formatdetbody);
$worksheet1->write($i, 13, $answer1[4],$formatdetbody);
$worksheet1->write($i, 14, $answer1[5],$formatdetbody);
$worksheet1->write($i, 15, $answer1[6],$formatdetbody);
}
$result1s=mysql_query($querymain1s);						  
$i=5;
while ($answer1s=mysql_fetch_row($result1s)) {
$i++;
$worksheet1->write($i, 1, $answer1s[0],$formatsumleft);
$worksheet1->write($i, 2, $answer1s[1],$formatsumleft);
$worksheet1->write($i, 3, $answer1s[6],$formatsumbody);
$worksheet1->write($i, 4, $answer1s[2],$formatsumbody);
$worksheet1->write($i, 5, $answer1s[3],$formatsumbody);
$worksheet1->write($i, 6, $answer1s[4],$formatsumbody);
$worksheet1->write($i, 7, $answer1s[2]-$answer1s[5],$formatsumbody);
$worksheet1->write($i, 8, $answer1s[5],$formatsumbody);
}
// QUEUES
$worksheet2->write(2, 3, 'QUEUES',$formata);
$worksheet2->write(2, 12, 'DETALLE DE QUEUES',$formatbighead);
$worksheet2->write(4, 1, '2.- STATUS DE QUEUES',$formatbighead);
$worksheet2->write(5, 1, 'CLIENTE',$formatsumhead);
$worksheet2->write(5, 2, 'QUEUE',$formatsumhead);
$worksheet2->write(5, 3, 'ACTIVO',$formatsumhead);
$worksheet2->write(5, 4, 'CUENTAS',$formatsumhead);
$worksheet2->write(5, 5, 'SALDO CAPITAL',$formatsumhead);
$worksheet2->write(5, 6, 'STATUS',$formatsumhead);
$worksheet2->write(5, 9, 'CLIENTE',$formatdethead);
$worksheet2->write(5, 10, 'CAMPAÑA',$formatdethead);
$worksheet2->write(5, 11, 'QUEUE',$formatdethead);
$worksheet2->write(5, 12, 'ACTIVO',$formatdethead);
$result2=mysql_query($querymain2);						  
$i=5;
while ($answer2=mysql_fetch_row($result2)) {
$i++;
$active='SI';
$qname=$answer2[2];
if ($qname=='') {$qname=$answer2[1];}
if ($answer2[3]==1) {$active='NO';};
$worksheet2->write($i, 9, $answer2[0],$formatdetleft);
$worksheet2->write($i, 10, $answer2[1],$formatdetleft);
$worksheet2->write($i, 11, $qname,$formatdetbody);
$worksheet2->write($i, 12, $active,$formatdetbody);
$worksheet2->write($i, 1, $answer2[0],$formatsumleft);
$worksheet2->write($i, 2, $qname,$formatsumleft);
$worksheet2->write($i, 3, $active,$formatsumbody);
$worksheet2->write($i, 6, $answer2[1],$formatsumbody);
$querymain2s="select count(1),sum(saldo_total) as 'SALDO_CAPITAL'
from resumen join dictamenes on dictamen=status_aarsa
where cliente='".$answer2[0]."' and status_de_credito='".$answer2[1]."' and queue='".$answer2[2]."' 
group by cliente,status_de_credito,queue;";
$result2s=mysql_query($querymain2s) or die(mysql_error());						  
while ($answer2s=mysql_fetch_row($result2s)) {
$worksheet2->write($i, 4, $answer2s[0],$formatsumbody);
$worksheet2->write($i, 5, $answer2s[1],$formatsumbody);
}
}
// PAGOS
$worksheet3->write(2, 3, 'PAGOS X GESTOR Y CLIENTE',$formata);
$worksheet3->write(2, 12, 'DETALLE DE PAGOS',$formatbighead);
$worksheet3->write(4, 1, '3.- PAGOS',$formatbighead);
$worksheet3->write(5, 1, 'CLIENTE',$formatsumhead);
$worksheet3->write(5, 2, 'GESTOR',$formatsumhead);
$worksheet3->write(5, 3, 'CUENTAS PAGO',$formatsumhead);
$worksheet3->write(5, 4, 'SALDO CAPITAL',$formatsumhead);
$worksheet3->write(5, 5, 'MONTO PAGO',$formatsumhead);
$worksheet3->write(5, 6, 'STATUS',$formatsumhead);
$worksheet3->write(5, 9, 'CLIENTE',$formatdethead);
$worksheet3->write(5, 10, 'CAMPAÑA',$formatdethead);
$worksheet3->write(5, 11, 'QUEUE',$formatdethead);
$worksheet3->write(5, 12, 'GESTOR',$formatdethead);
$worksheet3->write(5, 13, 'CUENTA',$formatdethead);
$worksheet3->write(5, 14, 'NOMBRE',$formatdethead);
$worksheet3->write(5, 15, 'FECHA',$formatdethead);
$worksheet3->write(5, 16, 'MONTO',$formatdethead);
$result3=mysql_query($querymain3);						  
$i=5;
while ($answer3=mysql_fetch_row($result3)) {
$i++;
$worksheet3->write($i, 9, $answer3[0],$formatdetleft);
$worksheet3->write($i, 10, $answer3[1],$formatdetleft);
$worksheet3->write($i, 11, $answer3[2],$formatdetbody);
$worksheet3->write($i, 12, $answer3[3],$formatdetbody);
$worksheet3->write($i, 13, $answer3[4],$formatdetbody);
$worksheet3->write($i, 14, $answer3[5],$formatdetbody);
$worksheet3->write($i, 15, $answer3[6],$formatdetbody);
$worksheet3->write($i, 16, $answer3[7],$formatdetbody);
}
$result3s=mysql_query($querymain3s);						  
$i=5;
while ($answer3s=mysql_fetch_row($result3s)) {
$i++;
$worksheet3->write($i, 1, $answer3s[0],$formatsumleft);
$worksheet3->write($i, 2, $answer3s[1],$formatsumleft);
$worksheet3->write($i, 3, $answer3s[2],$formatsumbody);
$worksheet3->write($i, 4, $answer3s[3],$formatsumbody);
$worksheet3->write($i, 5, $answer3s[5],$formatsumbody);
$worksheet3->write($i, 6, $answer3s[4],$formatsumbody);
}
// PROMESAS
$worksheet4->write(2, 3, 'PROMESAS X GESTOR Y CLIENTE',$formata);
$worksheet4->write(2, 16, 'DETALLE DE PROMESAS',$formatbighead);
$worksheet4->write(4, 1, '4.- PROMESAS',$formatbighead);
$worksheet4->write(5, 1, 'CLIENTE',$formatsumhead);
$worksheet4->write(5, 2, 'GESTOR',$formatsumhead);
$worksheet4->write(5, 3, 'CUENTAS PROMESA',$formatsumhead);
$worksheet4->write(5, 4, 'SALDO CAPITAL',$formatsumhead);
$worksheet4->write(5, 5, 'STATUS',$formatsumhead);
$worksheet4->write(5, 6, 'CIERRA ESTE MES',$formatsumhead);
$worksheet4->write(5, 7, 'MONTO ESTE MES',$formatsumhead);
$worksheet4->write(5, 8, 'CIERRA SEG MES',$formatsumhead);
$worksheet4->write(5, 9, 'MONTO SEG MES',$formatsumhead);
$worksheet4->write(5, 10, 'P TOTAL',$formatsumhead);
$worksheet4->write(5, 11, 'P PARCIAL',$formatsumhead);
$worksheet4->write(5, 12, 'P CONVENIO',$formatsumhead);
$worksheet4->write(5, 14, 'CLIENTE',$formatdethead);
$worksheet4->write(5, 15, 'CAMPAÑA',$formatdethead);
$worksheet4->write(5, 16, 'GESTOR',$formatdethead);
$worksheet4->write(5, 17, 'CUENTA',$formatdethead);
$worksheet4->write(5, 18, 'NOMBRE',$formatdethead);
$worksheet4->write(5, 19, 'FECHA 1',$formatdethead);
$worksheet4->write(5, 20, 'MONTO 1',$formatdethead);
$worksheet4->write(5, 21, 'FECHA 2',$formatdethead);
$worksheet4->write(5, 22, 'MONTO 2',$formatdethead);
$worksheet4->write(5, 23, 'STATUS',$formatdethead);
$result4=mysql_query($querymain4);						  
$i=5;
while ($answer4=mysql_fetch_row($result4)) {
$i++;
if (($answer4[6]>0) && (preg_match('/nactiv/i', $answer4[1]))) {
$worksheet4->write($i, 14, $answer4[0],$fdlr);
$worksheet4->write($i, 15, $answer4[1],$fdlr);
$worksheet4->write($i, 16, $answer4[2],$fdbr);
$worksheet4->write($i, 17, $answer4[3],$fdbr);
$worksheet4->write($i, 18, $answer4[4],$fdbr);
$worksheet4->write($i, 19, $answer4[5],$fdbr);
$worksheet4->write($i, 20, $answer4[6],$fdbr);
$worksheet4->write($i, 21, $answer4[7],$fdbr);
$worksheet4->write($i, 22, $answer4[8],$fdbr);
$worksheet4->write($i, 23, $answer4[9],$fdbr);
}
else {
$worksheet4->write($i, 14, $answer4[0],$formatdetleft);
$worksheet4->write($i, 15, $answer4[1],$formatdetleft);
$worksheet4->write($i, 16, $answer4[2],$formatdetbody);
$worksheet4->write($i, 17, $answer4[3],$formatdetbody);
$worksheet4->write($i, 18, $answer4[4],$formatdetbody);
$worksheet4->write($i, 19, $answer4[5],$formatdetbody);
$worksheet4->write($i, 20, $answer4[6],$formatdetbody);
$worksheet4->write($i, 21, $answer4[7],$formatdetbody);
$worksheet4->write($i, 22, $answer4[8],$formatdetbody);
$worksheet4->write($i, 23, $answer4[9],$formatdetbody);
}
}
$result4a=mysql_query($querymain4a);						  
$result4b=mysql_query($querymain4b);						  
$result4s=mysql_query($querymain4s);						  
$i=5;
while ($answer4s=mysql_fetch_row($result4s)) {
$i++;
if (($answer4s[3]>0) && (preg_match('/nactiv/i', $answer4s[5]))) {
$worksheet4->write($i, 1, $answer4s[0],$fslr);
$worksheet4->write($i, 2, $answer4s[1],$fslr);
$worksheet4->write($i, 3, $answer4s[3],$fsbr);
$worksheet4->write($i, 4, $answer4s[4],$fsbr);
$worksheet4->write($i, 5, $answer4s[5],$fsbr);
$worksheet4->write($i, 6, $answer4s[6],$fsbr);
$worksheet4->write($i, 7, $answer4s[7],$fsbr);
$worksheet4->write($i, 8, $answer4s[8],$fsbr);
$worksheet4->write($i, 9, $answer4s[9],$fsbr);
$worksheet4->write($i, 10, $answer4s[10],$fsbr);
$worksheet4->write($i, 11, $answer4s[11],$fsbr);
$worksheet4->write($i, 12, $answer4s[12],$fsbr);
}
else {
$worksheet4->write($i, 1, $answer4s[0],$formatsumleft);
$worksheet4->write($i, 2, $answer4s[1],$formatsumleft);
$worksheet4->write($i, 3, $answer4s[3],$formatsumbody);
$worksheet4->write($i, 4, $answer4s[4],$formatsumbody);
$worksheet4->write($i, 5, $answer4s[5],$formatsumbody);
$worksheet4->write($i, 6, $answer4s[6],$formatsumbody);
$worksheet4->write($i, 7, $answer4s[7],$formatsumbody);
$worksheet4->write($i, 8, $answer4s[8],$formatsumbody);
$worksheet4->write($i, 9, $answer4s[9],$formatsumbody);
$worksheet4->write($i, 10, $answer4s[10],$formatsumbody);
$worksheet4->write($i, 11, $answer4s[11],$formatsumbody);
$worksheet4->write($i, 12, $answer4s[12],$formatsumbody);
//$worksheet4->write($i, 13, $answer4s[13],$formatsumbody);
}
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
