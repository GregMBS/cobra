<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT if(left(numero_de_cuenta,2)='30',numero_de_cuenta,
numero_de_credito),d_fech,codigo,
d_prom1,n_prom1,
d_prom2,n_prom2
from resumen 
join historia on c_cont=id_cuenta
left join cyberact on accion=c_accion 
where month(d_fech)=month(curdate() - interval 6 day) and year(d_fech)=year(curdate() - interval 6 day) 
and cliente regexp 'Credito Si' 
and c_cvst like 'PRO%DE%' and n_prom>0 
and d_fech=curdate()-1
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
if($answer[6]>0) {$cod='PS';$cn='002';} else {$cod='LH';$cn='001';}
$fechag=date("mdY",strtotime($answer[1]));
$fechap=date("mdY",strtotime($answer[3]));
while($answer[3]<=$answer[1]){
	$answer[3]=date("Y-m-d",strtotime($answer[3])+60*60*24);
	$fechap=date("mdY",strtotime($answer[3]));
	}
$monto=$answer[4];
if($answer[6]>0){
$answer[3]=date("Y-m-d",strtotime($answer[3])+60*60*24);
$fechag1=date("mdY",strtotime($answer[3]));
$fechap1=date("mdY",strtotime($answer[5]));
while($answer[5]<=$answer[3]){
	$answer[5]=date("Y-m-d",strtotime($answer[5])+60*60*24);
	$fechap1=date("mdY",strtotime($answer[5]));
	die($fechap1);
}
$monto=$answer[6];
}
echo "600,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
"ADARSA  ','".$cod."','PP','".str_pad($fechag,8,"0",STR_PAD_LEFT)."','".
$cn."','".str_pad($j,3,"0",STR_PAD_LEFT)."','".
str_pad($fechap,8,"0",STR_PAD_LEFT)."','".
str_pad(round($monto*100),15,"0",STR_PAD_LEFT)."'\r\n";
if($answer[6]>0) {
$j++;	
echo "600,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
"ADARSA  ','".$cod."','PP','".str_pad($fechag1,8,"0",STR_PAD_LEFT)."','".
$cn."','".str_pad($j,3,"0",STR_PAD_LEFT)."','".
str_pad($fechap1,8,"0",STR_PAD_LEFT)."','".
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
