<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT cuenta,DATE_FORMAT(d_fech,'%m%d%Y'),
codigo,DATE_FORMAT(d_prom1,'%m%d%Y'),n_prom1
,DATE_FORMAT(d_prom2,'%m%d%Y'),n_prom2 
from resumen 
join historia on c_cont=id_cuenta
left join cyberact on accion=c_accion 
where month(d_fech)=month(curdate() - interval 6 day) and year(d_fech)=year(curdate() - interval 6 day) 
and cliente='Credito Si' 
and c_cvst like 'PRO%DE%' and n_prom>0
and fecha_de_actualizacion>last_day(curdate() - interval 1 month)
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

$filename="6007206_".$fecha1.".txt";
$k=0;
$oldcta=0;
while ($answer=mysql_fetch_row($result)) {
$j=1;
$k++;
if($answer[6]>0) {$cod='PS';} else {$cod='PP';}
echo '6007'.$answer[0].' ADARSA '.$answer[2].$cod.$answer[1].
str_pad($k,3,"0",STR_PAD_LEFT).str_pad($j,3,"0",STR_PAD_LEFT).
str_pad($answer[3],8,"0",STR_PAD_LEFT).
str_pad(round($answer[4]*100),15,"0",STR_PAD_LEFT).'\n';
if($answer[6]>0) {
$j++;	
echo '6007'.$answer[0].' ADARSA '.$answer[2].$cod.$answer[1].
str_pad($k,3,"0",STR_PAD_LEFT).str_pad($j,3,"0",STR_PAD_LEFT).
str_pad($answer[5],8,"0",STR_PAD_LEFT).
str_pad(round($answer[6]*100),15,"0",STR_PAD_LEFT).'\n';
	}
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
