<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
header ('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
header ('Content-Type: text/plain; charset=windows-1252'); 
header ("Content-Disposition: attachment; filename='Reporte 600.txt'");
$querymain="SELECT numero_de_cuenta,DATE_FORMAT(d_fech,'%m%d%Y'),codigo,
DATE_FORMAT(d_prom1,'%m%d%Y'),n_prom1,
DATE_FORMAT(d_prom2,'%m%d%Y'),n_prom2,
(d_prom1>=curdate()-interval 1 day)+(d_prom2>=curdate()-interval 1 day), 
DATE_FORMAT(d_fech,'%m%d%Y'),
DATE_FORMAT(d_prom1+interval 1 day,'%m%d%Y'),
DATE_FORMAT(d_prom2+interval 1 day,'%m%d%Y'),
DATE_FORMAT(curdate(),'%m%d%Y')
from resumen 
join historia h1 on c_cont=id_cuenta
left join cyberact on accion=c_accion 
where d_fech>last_day(curdate() - interval 5 week)
and cliente = 'Surtifirme' 
and c_cvst like 'PRO%DE%' and n_prom>0 
and not exists (select auto from historia h2 where h2.c_cont=id_cuenta and h2.n_prom>0 and h2.d_fech=h1.d_fech and h2.c_hrfi>h1.c_hrfi)
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

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
$monto=$answer[4];
if(($answer[7]==1)&&($answer[6]>0)){
$fechag=$answer[3];
$fechap=$answer[5];
if($answer[3]<$answer[11]){$fechag=$answer[9];}
if($answer[5]<$answer[11]){$fechap=$answer[10];}
$monto=$answer[6];
}
echo "600,7,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
"COBINTEG','".$cod."','PP','".str_pad($fechag,8,"0",STR_PAD_LEFT)."','".
$cn."','".str_pad($j,3,"0",STR_PAD_LEFT)."','".
str_pad($fechap,8,"0",STR_PAD_LEFT)."','".
str_pad(round($monto*100),15,"0",STR_PAD_LEFT)."'\r\n";
if($answer[7]>1) {
$j++;	
echo "600,7,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
"COBINTEG','".$cod."','PP','".str_pad($answer[9],8,"0",STR_PAD_LEFT)."','".
$cn."','".str_pad($j,3,"0",STR_PAD_LEFT)."','".
str_pad($answer[10],8,"0",STR_PAD_LEFT)."','".
str_pad(round($answer[6]*100),15,"0",STR_PAD_LEFT)."'\r\n";
	}
}
// Let's send the file
//$workbook->close();
}
}
mysql_close();
?>
