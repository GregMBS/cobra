<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT numero_de_credito,DATE_FORMAT(d_fech,'%m%d%Y'),
DATE_FORMAT(c_hrin,'%H:%i:%s'),codigo,cr.csi_cr,'',
left(C_OBSE1,56),substring(C_OBSE1,57,56),substring(C_OBSE1,114,56),
substring(C_OBSE1,171,56),substring(C_OBSE1,229,56) 
from resumen 
join historia on c_cont=id_cuenta
left join cyberres cr on c_cvst=cr.dictamen 
left join cyberact on accion=c_accion 
where month(d_fech)=month(curdate() - interval 6 day) and year(d_fech)=year(curdate() - interval 6 day) 
and cliente='Credito Si' 
and numero_de_credito is not null
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

$fecha1=date("d\_M");
$filename="Layout_carga_de_gestiones_cs_".$fecha1.".xls";

echo "1,2,3,4,5,6,7,8,9,10\n";
echo "'Valor constante','Grupo','Número de cuenta','Fecha y hora de actividad',";
echo "'No. de secuencia,Usado para ordenar cómo se muestra en sesión. Esta secuencia se ignora si las actividades se clasifican por fecha y hora.',";
echo "'Código de acción','Código de resultado','Código de carta','Id agente o apellido paterno',";
echo "'Comentario'\n";
while ($answer=mysql_fetch_row($result)) {
$i=1;
$cc=$answer[5];
if ($cc=='') {$cc=' ';}
echo "2002".$answer[0].
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,3,"0",STR_PAD_LEFT).
$answer[3].$answer[4].$cc.
' ADARSA '.
$answer[6].'\n';
if ($answer[7]!='') {
$i++;
echo "2002".$answer[0].
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,3,"0",STR_PAD_LEFT).
$answer[3].$answer[4].$cc.
' ADARSA '.
$answer[7].'\n';
	}
if ($answer[8]!='') {
$i++;
echo "2002".$answer[0].
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,3,"0",STR_PAD_LEFT).
$answer[3].$answer[4].$cc.
' ADARSA '.
$answer[8].'\n';
	}
if ($answer[9]!='') {
$i++;
echo "2002".$answer[0].
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,3,"0",STR_PAD_LEFT).
$answer[3].$answer[4].$cc.
' ADARSA '.
$answer[9].'\n';
	}
if ($answer[10]!='') {
$i++;
echo "2002".$answer[0].
str_pad($answer[1],8,"0",STR_PAD_LEFT).
" ".$answer[2].
str_pad($i,3,"0",STR_PAD_LEFT).
$answer[3].$answer[4].$cc.
' ADARSA '.
$answer[10].'\n';
	}
}
}
}
mysql_close();
?>
