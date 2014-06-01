<?php
set_time_limit(300);
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {mysql_close();}
else {
if (!empty($_GET['fecha1'])) {	
$fecha1=$_GET['fecha1'];
$fecha2=$_GET['fecha2'];
$queryclean="truncate marcados;";
mysql_query($queryclean) or die(mysql_error());
$queryfill="insert into marcados select distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not like '%o'
and c_msge is null
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between '".$fecha1."' and '".$fecha2."'
order by c_tele";
mysql_query($queryfill) or die(mysql_error());
$querymain='select cliente,nombre_deudor,concat(" ",numero_de_cuenta) as "numero_de_cuenta",
concat(" ",tel_1) as "tel 1",tel_1 in (select c_tele from marcados) as tel_1_marcado,
concat(" ",tel_2) as "tel 2",tel_2 in (select c_tele from marcados) as tel_2_marcado,
concat(" ",tel_3) as "tel 3",tel_3 in (select c_tele from marcados) as tel_3_marcado,
concat(" ",tel_4) as "tel 4",tel_4 in (select c_tele from marcados) as tel_4_marcado,
concat(" ",tel_1_alterno) as "tel 1 alterno",tel_1_alterno in (select c_tele from marcados) as tel_1_alterno_marcado,
concat(" ",tel_2_alterno) as "tel 2 alterno",tel_2_alterno in (select c_tele from marcados) as tel_2_alterno_marcado,
concat(" ",tel_3_alterno) as "tel 3 alterno",tel_3_alterno in (select c_tele from marcados) as tel_3_alterno_marcado,
concat(" ",tel_4_alterno) as "tel 4 alterno",tel_4_alterno in (select c_tele from marcados) as tel_4_alterno_marcado,
concat(" ",tel_1_laboral) as "tel 1 laboral",tel_1_laboral in (select c_tele from marcados) as tel_1_laboral_marcado,
concat(" ",tel_2_laboral) as "tel 2 laboral",tel_2_laboral in (select c_tele from marcados) as tel_2_laboral_marcado,
concat(" ",tel_1_ref_1) as "tel 1 ref 1",tel_1_ref_1 in (select c_tele from marcados) as tel_1_ref_1_marcado,
concat(" ",tel_1_ref_2) as "tel 1 ref 2",tel_1_ref_2 in (select c_tele from marcados) as tel_1_ref_2_marcado,
concat(" ",tel_1_ref_3) as "tel 1 ref 3",tel_1_ref_3 in (select c_tele from marcados) as tel_1_ref_3_marcado,
concat(" ",tel_1_ref_4) as "tel 1 ref 4",tel_1_ref_4 in (select c_tele from marcados) as tel_1_ref_4_marcado
from resumen
where status_de_credito not like "%o"
order by cliente,numero_de_cuenta
;';

$result=mysql_query($querymain) or die(mysql_error());
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$filename="Query_de_telefonos_".date('ymd').".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('telefonos');
$worksheet->setInputEncoding('ISO-8859-1');
//echo "<html><head></head><body><table>";

$ii=0;
$numberfields = mysql_num_fields($result);
//echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet->write(0, $i, $var);
//echo "<th>".$var."</th>";
   }
//echo "</tr>";
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
//echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet->write($ii, $j, $row[$j]);
//echo "<td>".$row[$j]."</td>";
    }
    $ii++;
//echo "</tr>";
    }
$workbook->close();
//echo "</table></body></html>";
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query de las Tels Marcados</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="tels_marcados.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>HECHO de:
<?php echo $fecha1;?>
<select name="fecha1">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech limit 360";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
a:
<?php echo $fecha2;?>
<select name="fecha2">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech desc limit 60";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
</p>
<input type='submit' name='go' value='Telefonos'>
</form>
</body>
</html> 
<?php
		}
}
}
mysql_close();
?>

