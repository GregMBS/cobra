<?php  
include('admin_hdr_2.php');
$i=0;
$myFile = "/tmp/callfile.csv";
$fh = fopen($myFile, 'w') or die("can't open file");
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$COMI="sleep 5s;\n";
$COMW='';
for ($j=0;$j<10;$j++) {
$TEL='';
$query1="select distinct right(tel_1,8),id_cuenta from resumen left join historia on tel_1=c_tele
where (status_de_credito='360s') 
and length(tel_1)=10 and left(tel_1,2)=81
AND (status_aarsa = 'NEGATIVA DE PAGO'
OR status_aarsa = 'MENSAJE CON FAMILIAR')
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
$result1=mysql_query($query1) or die(mysql_error());
 while ($answer1 = mysql_fetch_row($result1)) { 
$TEL=$answer1[0];
if (!empty($TEL)) {
$id_cuenta=$answer1[1];
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl ".$TEL." /home/gmbs/cs.rmd ".$id_cuenta.";";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
$i++;
}
if ($i%50==0) {
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl 83335558 /home/gmbs/cs.rmd 0;";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
}
}
$query2="select distinct tel_1,id_cuenta from resumen left join historia on tel_1=c_tele
where (status_de_credito='360s') 
and length(tel_1)=10 and left(tel_1,2)<>81
AND (status_aarsa = 'NEGATIVA DE PAGO'
OR status_aarsa = 'MENSAJE CON FAMILIAR')
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
$result2=mysql_query($query2) or die(mysql_error());
 while ($answer2 = mysql_fetch_row($result2)) { 
$TEL="01".$answer2[0];
if (!empty($TEL)) {
$id_cuenta=$answer2[1];
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl ".$TEL." /home/gmbs/cs.rmd ".$id_cuenta.";";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
$i++;
}
if ($i%50==0) {
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl 83335558 /home/gmbs/cs.rmd 0;";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
}
}
$query3="select distinct right(tel_1_verif,8),id_cuenta from resumen left join historia on tel_1_verif=c_tele
where (status_de_credito='360s') 
and length(tel_1_verif)=10 and left(tel_1_verif,2)=81
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
$result3=mysql_query($query3) or die(mysql_error());
 while ($answer3 = mysql_fetch_row($result3)) { 
$TEL=$answer3[0];
if (!empty($TEL)) {
$id_cuenta=$answer3[1];
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl ".$TEL." /home/gmbs/cs.rmd ".$id_cuenta.";";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
$i++;
}
if ($i%50==0) {
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl 83335558 /home/gmbs/cs.rmd 0;";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
}
}
$query4="select distinct tel_1_verif,id_cuenta from resumen left join historia on tel_1_verif=c_tele
where (status_de_credito='360s') 
and length(tel_1_verif)=10 and left(tel_1_verif,2)<>81
AND (c_cvst is null or c_cvst<>'TEL NO EXISTE O SUSPENDIDO') 
";
$result4=mysql_query($query4) or die(mysql_error());
 while ($answer4 = mysql_fetch_row($result4)) { 
$TEL="01".$answer4[0];
if (!empty($TEL)) {
$id_cuenta=$answer4[1];
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl ".$TEL." /home/gmbs/cs.rmd ".$id_cuenta.";";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
$i++;
}
if ($i%50==0) {
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl 83335558 /home/gmbs/cs.rmd 0;";
//$OUTS=$COMW.$COMD.$COMI;
$OUTS=$id_cuenta.",".$TEL.",/home/gmbs/cs.rmd\n";
fwrite($fh, $OUTS);
echo $OUTS;
}
}
}
}
}
fclose($fh);
mysql_close()
?>
