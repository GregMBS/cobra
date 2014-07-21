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

if (date('w')==1) {
	$startday=4;
	} 
else {
	$startday=2;
	}
header ('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
header ('Content-Type: text/plain; charset=windows-1252'); 
header ("Content-Disposition: attachment; filename='Reporte 200.txt'");
$querymain="SELECT numero_de_cuenta,DATE_FORMAT(d_fech,'%m%d%Y'),
DATE_FORMAT(c_hrin,'%H:%i:%s'),codigo,cr.csi_cr,'',
left(C_OBSE1,56),substring(C_OBSE1,57,56),substring(C_OBSE1,114,56),
substring(C_OBSE1,171,56),substring(C_OBSE1,229,56) 
from resumen 
join historia on c_cont=id_cuenta
left join cyberres cr on c_cvst=cr.dictamen 
left join cyberact on accion=c_accion 
where d_fech<curdate() and d_fech>(curdate() - interval ".$startday." day) 
and cliente regexp 'Surti' 
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

while ($answer=mysql_fetch_row($result)) {
$i=1;
$cc=$answer[5];
if ($cc=='') {$cc='  ';}
echo "2007".str_pad($answer[0],25," ",STR_PAD_RIGHT).
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,5,"0",STR_PAD_LEFT).
$answer[3].str_pad($answer[4],2," ",STR_PAD_RIGHT).str_pad($cc,2," ",STR_PAD_RIGHT).
"COBINTEG".
cleanup($answer[6])."\r\n";
if ($answer[7]!='') {
$i++;
echo "2007".str_pad($answer[0],25," ",STR_PAD_RIGHT).
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,5,"0",STR_PAD_LEFT).
$answer[3].str_pad($answer[4],2," ",STR_PAD_RIGHT).str_pad($cc,2," ",STR_PAD_RIGHT).
"COBINTEG".
cleanup($answer[7])."\r\n";
	}
if ($answer[8]!='') {
$i++;
echo "2007".str_pad($answer[0],25," ",STR_PAD_RIGHT).
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,5,"0",STR_PAD_LEFT).
$answer[3].str_pad($answer[4],2," ",STR_PAD_RIGHT).str_pad($cc,2," ",STR_PAD_RIGHT).
"COBINTEG".
cleanup($answer[8])."\r\n";
	}
if ($answer[9]!='') {
$i++;
echo "2007".str_pad($answer[0],25," ",STR_PAD_RIGHT).
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,5,"0",STR_PAD_LEFT).
$answer[3].str_pad($answer[4],2," ",STR_PAD_RIGHT).str_pad($cc,2," ",STR_PAD_RIGHT).
"COBINTEG".
cleanup($answer[9])."\r\n";
	}
if ($answer[10]!='') {
$i++;
echo "2007".str_pad($answer[0],25," ",STR_PAD_RIGHT).
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,5,"0",STR_PAD_LEFT).
$answer[3].str_pad($answer[4],2," ",STR_PAD_RIGHT).str_pad($cc,2," ",STR_PAD_RIGHT).
"COBINTEG".
cleanup($answer[10])."\r\n";
	}
}
}
}

