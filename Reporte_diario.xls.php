<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
	$now=date("Y-m-d");
$querydrop="DROP TABLE 	`cobra`.`gmbtemp`;";
$querymake="CREATE TABLE `cobra`.`gmbtemp` (
  `gestor` varchar(255)  NOT NULL,
  `pagando` decimal(10,2) ,
  `liquidado` decimal(10,2) ,
  `vigente` decimal(10,2) ,
  `vencido` decimal(10,2) ,
  `meta` decimal(10,2)  DEFAULT '0.01',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) ,
  PRIMARY KEY (`gestor`)
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$querynames="insert into gmbtemp (gestor) select iniciales from nombres order by iniciales;";
$querylist="select gestor from gmbtemp order by gestor;";
$queryparcial="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor',
monto as 'pmt1',pagos.fecha as 'fpmt1'
from historia h1
join pagos on c_cont=pagos.id_cuenta
join resumen on c_cont=resumen.id_cuenta
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and d_fech<=pagos.fecha
and status_aarsa<>'PAGO TOTAL' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0 
and h2.d_fech<=pagos.fecha) 
order by h1.c_cont,pagos.fecha
;";
$queryliquid="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor',
monto as 'pmt1',pagos.fecha as 'fpmt1'
from historia h1
join pagos on c_cont=pagos.id_cuenta
join resumen on c_cont=resumen.id_cuenta
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and d_fech<=pagos.fecha
and status_aarsa='PAGO TOTAL' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0 
and h2.d_fech<=pagos.fecha) 
order by h1.c_cont,pagos.fecha
;";
$queryvencido="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)) 
;";
$queryvigente="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom>=curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month));";

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Reporte_diario_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet1 =& $workbook->addWorksheet('resumen');
$worksheet1->setInputEncoding('utf-8');
$worksheet2 =& $workbook->addWorksheet('pagos');
$worksheet2->setInputEncoding('utf-8');
$worksheet3 =& $workbook->addWorksheet('liquidados');
$worksheet3->setInputEncoding('utf-8');
$worksheet4 =& $workbook->addWorksheet('vencidos');
$worksheet4->setInputEncoding('utf-8');
$worksheet5 =& $workbook->addWorksheet('vigentes');
$worksheet5->setInputEncoding('utf-8');

// resumen
mysql_query($querymake);
mysql_query($querynames);
$result=mysql_query($querylist);
while($answer=mysql_fetch_row($result))
{
$queryprep="update gmbtemp set pagando=0,liquidado=0,vencido=0,vigente=0
where gestor='".$answer[0]."';";
mysql_query($queryprep) or die(mysql_error());	
$querypup1="update gmbtemp set pagando=
(select ifnull(sum(monto),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_fech<=fecha
and status_aarsa<>'PAGO TOTAL' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querypup1) or die(mysql_error());
$querypup2="update gmbtemp set vencido=
(select ifnull(sum(greatest((n_prom1*(d_prom1<curdate()))+(n_prom2*(d_prom2<curdate()))-monto,0)),0) as vencido
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_fech<=fecha
and status_aarsa<>'PAGO TOTAL' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querypup2) or die(mysql_error());
$querypup3="update gmbtemp set vigente=
(select ifnull(n_prom,0)-ifnull(sum(greatest((n_prom1*(d_prom1<curdate()))+(n_prom2*(d_prom2<curdate()))-monto,0)),0) as vigente
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_fech<=fecha
and status_aarsa<>'PAGO TOTAL' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querypup3) or die(mysql_error());
$querylup="update gmbtemp set liquidado=
(select ifnull(sum(monto),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_fech<=fecha
and status_aarsa='PAGO TOTAL'  and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querylup) or die(mysql_error());
$queryveup1="update gmbtemp set vencido=vencido+
(select ifnull(sum(n_prom1),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom1<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($queryveup1) or die(mysql_error());
$queryveup2="update gmbtemp set vencido=vencido+
(select ifnull(sum(n_prom2),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom2<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($queryveup2) or die(mysql_error());
$queryviup="update gmbtemp set vigente=
(select ifnull(sum(n_prom2*(d_prom2>=curdate())),0)+ifnull(sum(n_prom1*(d_prom1>=curdate())),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)) 
and c_cvge='".$answer[0]."') 
where gestor='".$answer[0]."'
";	
mysql_query($queryviup) or die(mysql_error());
}
$querycalc="update gmbtemp,nombres
set gmbtemp.meta=nombres.meta,metap=(pagando+liquidado)/nombres.meta,
negociado=(vigente+vencido+pagando+liquidado),
cumplimentop=(pagando+liquidado)/(vigente+vencido+pagando+liquidado),
pronostico=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado))),
pronosticop=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado)))/nombres.meta;
where iniciales='".$answer[0]."';";
mysql_query($querycalc) or die(mysql_error());
$result=mysql_query("select * from gmbtemp order by gestor;");
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet1->write(0, $i, $var);
   }
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet1->write($ii, $j, $row[$j]);
    }
    $ii++;
    }
$result=mysql_query("select '', sum(pagando), sum(liquidado), sum(vigente),
sum(vencido), '', '', sum(negociado)
from gmbtemp;");
while ($row = mysql_fetch_row($result)) 
    {
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet1->write($ii, $j, $row[$j]);
    }
}
// pagos
$id=0;
$result=mysql_query($queryparcial);
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet2->write(0, $i, $var);
   }
$worksheet2->write(0, $i, 'pmt2');$i++;
$worksheet2->write(0, $i, 'fpmt2');$i++;
$worksheet2->write(0, $i, 'pmt3');$i++;
$worksheet2->write(0, $i, 'fpmt3');$i++;
$worksheet2->write(0, $i, 'suma vig.');$i++;
$worksheet2->write(0, $i, 'suma venc.');$i++;
$worksheet2->write(0, $i, 'suma pag.');$i++;
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
		if ($row[0]<>$id) {
			$id=$row[0];
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet2->write($ii, $j, $row[$j]);
    }
    $ii++;
	$k=$j;
	}
	else {
			$worksheet2->write($ii, $k, $row[$j-2]);
	$worksheet2->write(0, $k, 'monto');
			$worksheet2->write($ii, $k+1, $row[$j-1]);
	$worksheet2->write(0, $k+1, 'fecha');
			$k+$k+2;
	}
    }

// liquidados

$result=mysql_query($queryliquid);
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet3->write(0, $i, $var);
   }
$worksheet3->write(0, $i, 'pmt2');$i++;
$worksheet3->write(0, $i, 'fpmt2');$i++;
$worksheet3->write(0, $i, 'pmt3');$i++;
$worksheet3->write(0, $i, 'fpmt3');$i++;
$worksheet3->write(0, $i, 'suma vig.');$i++;
$worksheet3->write(0, $i, 'suma venc.');$i++;
$worksheet3->write(0, $i, 'suma pag.');$i++;
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
		if ($row[0]<>$id) {
			$id=$row[0];
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet3->write($ii, $j, $row[$j]);
    }
    $ii++;
	$k=$j;
	}
	else {
			$worksheet3->write($ii, $k, $row[$j-2]);
	$worksheet3->write(0, $k, 'monto');
			$worksheet3->write($ii, $k+1, $row[$j-1]);
	$worksheet3->write(0, $k+1, 'fecha');
			$k+$k+2;
	}
    }

// vencidos

$result=mysql_query($queryvencido);
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet4->write(0, $i, $var);
   }
$worksheet4->write(0, $i, 'pmt2');$i++;
$worksheet4->write(0, $i, 'fpmt2');$i++;
$worksheet4->write(0, $i, 'pmt3');$i++;
$worksheet4->write(0, $i, 'fpmt3');$i++;
$worksheet4->write(0, $i, 'suma vig.');$i++;
$worksheet4->write(0, $i, 'suma venc.');$i++;
$worksheet4->write(0, $i, 'suma pag.');$i++;
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet4->write($ii, $j, $row[$j]);
    }
    $ii++;
    }

// vigentes
$result=mysql_query($queryvigente);
$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet5->write(0, $i, $var);
   }
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet5->write($ii, $j, $row[$j]);
    }
    $ii++;
    }

// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
