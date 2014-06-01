<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
function cleanup($str) {
	$res = preg_replace("/[^a-zA-Z0-9 ]/", "", $str);
    $res2 = trim($res);	
    return $res2;
	}

$querymain="SELECT if(left(numero_de_cuenta,2)='30',numero_de_cuenta,numero_de_credito),DATE_FORMAT(historia.d_fech,'%m%d%Y'),
DATE_FORMAT(c_hrin,'%H:%i:%s'),codigo,cr.csi_cr,'',
left(C_OBSE1,56),substring(C_OBSE1,57,56),substring(C_OBSE1,114,56),
substring(C_OBSE1,171,56),substring(C_OBSE1,229,56) 
from resumen 
join historia on c_cont=id_cuenta
join histdate on historia.auto=histdate.auto and historia.d_fech<histdate.d_fech
and histdate.d_fech>='2011-09-23'
left join cyberres cr on c_cvst=cr.dictamen 
left join cyberact on accion=c_accion 
where month(historia.d_fech)=month(curdate() - interval 1 day) 
and year(historia.d_fech)=year(curdate() - interval 1 day) 
and concat(historia.d_fech,' ',c_hrfi)<now()
and cliente regexp 'Credito Si' 
and numero_de_credito is not null
order by historia.d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

$filename="Layout_carga_de_gestiones_cs_".$fecha1.".txt";
echo '<pre>';
while ($answer=mysql_fetch_row($result)) {
$i=1;
$cc=$answer[5];
if ($cc=='') {$cc='  ';}
echo "200,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2]."','".
str_pad($i,5,"0",STR_PAD_LEFT)."','".
$answer[3]."','".$answer[4]."','".$cc."','".
"ADARSA  ','".
cleanup($answer[6])."'\r\n";
if ($answer[7]!='') {
$i++;
echo "200,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2]."','".
str_pad($i,5,"0",STR_PAD_LEFT)."','".
$answer[3]."','".$answer[4]."','".$cc."','".
"ADARSA  ','".
cleanup($answer[7])."'\r\n";
	}
if ($answer[8]!='') {
$i++;
echo "200,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2]."','".
str_pad($i,5,"0",STR_PAD_LEFT)."','".
$answer[3]."','".$answer[4]."','".$cc."','".
"ADARSA  ','".
cleanup($answer[8])."'\r\n";
	}
if ($answer[9]!='') {
$i++;
echo "200,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2]."','".
str_pad($i,5,"0",STR_PAD_LEFT)."','".
$answer[3]."','".$answer[4]."','".$cc."','".
"ADARSA  ','".
cleanup($answer[9])."'\r\n";
	}
if ($answer[10]!='') {
$i++;
echo "200,2,'".str_pad($answer[0],25," ",STR_PAD_RIGHT)."','".
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2]."','".
str_pad($i,5,"0",STR_PAD_LEFT)."','".
$answer[3]."','".$answer[4]."','".$cc."','".
"ADARSA  ','".
cleanup($answer[10])."'\r\n";
	}
}
}
}
echo '</pre>';
mysql_close();
?>
