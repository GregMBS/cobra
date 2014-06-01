<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT if(left(numero_de_cuenta,2)='30',numero_de_cuenta,
numero_de_credito),DATE_FORMAT(d_fech,'%m%d%Y'),codigo,
DATE_FORMAT(d_prom1,'%m%d%Y'),n_prom1,
DATE_FORMAT(d_prom2,'%m%d%Y'),n_prom2,
(d_prom1>=curdate()-interval 1 day)+(d_prom2>=curdate()-interval 1 day), 
DATE_FORMAT(d_fech+interval 1 day,'%m%d%Y'),
DATE_FORMAT(d_prom1+interval 1 day,'%m%d%Y'),
DATE_FORMAT(least(d_prom2+interval 1 day,last_day(curdate())),'%m%d%Y'),
DATE_FORMAT(curdate(),'%m%d%Y')
from resumen 
join historia on c_cont=id_cuenta
left join cyberact on accion=c_accion 
where month(d_fech)=month(curdate() - interval 6 day) and year(d_fech)=year(curdate() - interval 6 day) 
and cliente regexp 'Credito Si' 
and c_cvst like 'PRO%DE%' and n_prom>0 
and concat(d_fech,' ',c_hrin) between curdate() - interval 3 day + interval 18 hour and curdate()
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

$filename="6007206_".$fecha1.".txt";
echo '<pre>';
$k=0;
$oldcta=0;
while ($answer=mysql_fetch_row($result)) {
$j=1;
$k++;
if($answer[7]>1) {$cod='PS';$cn='002';} else {$cod='LH';$cn='001';}
$fechag=$answer[1];
$fechap=$answer[3];
if($answer[1]<$answer[11]){$fechag=$answer[8];}
if($answer[3]<$answer[11]){$fechap=$answer[9];}
if($fechap<=$answer[1]){$fechap=$answer[9];}
$monto=$answer[4];
if(($answer[7]==1)&&($answer[6]>0)){
$fechag=$answer[3];
$fechap=$answer[5];
if($answer[3]<$answer[11]){$fechag=$answer[10];}
if($answer[5]<$answer[11]){$fechap=$answer[11];}
if($fechap<=$fechag){$fechap=$answer[11];}
$monto=$answer[6];
}
echo "600,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
"ADARSA  ','".$cod."','PP','".str_pad($fechag,8,"0",STR_PAD_LEFT)."','".
$cn."','".str_pad($j,3,"0",STR_PAD_LEFT)."','".
str_pad($fechap,8,"0",STR_PAD_LEFT)."','".
str_pad(round($monto*100),15,"0",STR_PAD_LEFT)."'\r\n";
if($answer[7]>1) {
$j++;	
echo "600,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
"ADARSA  ','".$cod."','PP','".str_pad($answer[9],8,"0",STR_PAD_LEFT)."','".
$cn."','".str_pad($j,3,"0",STR_PAD_LEFT)."','".
str_pad($answer[10],8,"0",STR_PAD_LEFT)."','".
str_pad(round($answer[6]*100),15,"0",STR_PAD_LEFT)."'\r\n";
	}
}
// Let's send the file
//$workbook->close();
}
}
echo '</pre>';
mysql_close();
?>
