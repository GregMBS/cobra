<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {mysql_close($con);}
else {
$querya="select cliente,count(1),
sum(not exists (select * from historia where c_cont=id_cuenta and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_cont=id_cuenta and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_cont=id_cuenta and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' 
group by cliente";
$resulta=mysql_query($querya) or die(mysql_error());
$i=0;
while ($row=mysql_fetch_row($resulta)) {
$cta[$i][0]=$row[0];
$cta[$i][1]=$row[1];
$cta[$i][2]=$row[2];
$cta[$i][3]=$row[3];
$cta[$i][4]=$row[4];
$i++;}
$queryb="select count(1),
sum(not exists (select * from historia where c_tele=tel_1 and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_1 and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_1 and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1+1>1
group by cliente";
$resultb=mysql_query($queryb) or die(mysql_error());
$i=0;
while ($row=mysql_fetch_row($resultb)) {
$tel1[$i][0]=$row[0];
$tel1[$i][1]=$row[1];
$tel1[$i][2]=$row[2];
$tel1[$i][3]=$row[3];
$i++;}
$queryc="select count(1),
sum(not exists (select * from historia where c_tele=tel_1_alterno and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_1_alterno and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_1_alterno and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1_alterno+1>1
group by cliente";
$resultc=mysql_query($queryc) or die(mysql_error());
$i=0;
while ($row=mysql_fetch_row($resultc)) {
$tel1a[$i][0]=$row[0];
$tel1a[$i][1]=$row[1];
$tel1a[$i][2]=$row[2];
$tel1a[$i][3]=$row[3];
$i++;}
$queryd="select count(1),
sum(not exists (select * from historia where c_tele=tel_1_laboral and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_1_laboral and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_1_laboral and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1_laboral+1>1
group by cliente";
$resultd=mysql_query($queryd) or die(mysql_error());
$i=0;
while ($row=mysql_fetch_row($resultd)) {
$tel1l[$i][0]=$row[0];
$tel1l[$i][1]=$row[1];
$tel1l[$i][2]=$row[2];
$tel1l[$i][3]=$row[3];
$i++;}
$querye="select count(1),
sum(not exists (select * from historia where c_tele=tel_1_ref_1 and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_1_ref_1 and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_1_ref_1 and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1_ref_1+1>1
group by cliente";
$resulte=mysql_query($querye) or die(mysql_error());
$i=0;
while ($tel1r1[$i]=mysql_fetch_row($resulte)) {$i++;}
$queryf="select count(1),
sum(not exists (select * from historia where c_tele=tel_1_ref_2 and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_1_ref_2 and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_1_ref_2 and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1_ref_2+1>1
group by cliente";
$resultf=mysql_query($queryf) or die(mysql_error());
$i=0;
while ($tel1r2[$i]=mysql_fetch_row($resultf)) {$i++;}
$queryg="select count(1),
sum(not exists (select * from historia where c_tele=tel_1_verif and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_1_verif and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_1_verif and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1_verif+1>1
group by cliente";
$resultg=mysql_query($queryg) or die(mysql_error());
$i=0;
while ($tel1v[$i]=mysql_fetch_row($resultg)) {$i++;}
$queryh="select count(1),
sum(not exists (select * from historia where c_tele=tel_2_verif and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_2_verif and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_2_verif and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_1_verif+1>1
group by cliente";
$resulth=mysql_query($queryh) or die(mysql_error());
$i=0;
while ($tel2v[$i]=mysql_fetch_row($resulth)) {$i++;}
$queryi="select count(1),
sum(not exists (select * from historia where c_tele=tel_2 and c_msge is null and d_fech>='2010-11-01' and d_fech<'2010-12-01')) as nov,
sum(not exists (select * from historia where c_tele=tel_2 and c_msge is null and d_fech>='2010-12-01')) as dic,
sum(not exists (select * from historia where c_tele=tel_2 and c_msge is null)) as ever
from resumen
where status_de_credito not regexp '[dv]o$' and tel_2+1>1
group by cliente";
$resulti=mysql_query($queryi) or die(mysql_error());
$i=0;
while ($tel2[$i]=mysql_fetch_row($resulti)) {$i++;}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Elastix Queues</title>
<style>
    body {background-color:blue;}
    .num {text-align:right}
    table, tr, td {background-color:white;}
    table {margin-left:auto;margin-right:auto;}
    th {background-color:gray;}
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary='ACTUAL'>
<tr>
<th>&nbsp;</th>
<th colspan=4>Cuentas</th>
<th colspan=4>Tel 1</th>
<th colspan=4>Tel 2</th>
<th colspan=4>Tel 1 Alterno</th>
<th colspan=4>Tel 1 Laboral</th>
<th colspan=4>Tel 1 Ref 1</th>
<th colspan=4>Tel 1 Ref 2</th>
<th colspan=4>Tel 1 Verif</th>
<th colspan=4>Tel 1 Verif</th>
</tr>
<tr>
<th>Cliente</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
<th>Total</th>
<th>Nov</th>
<th>Dic</th>
<th>Nunca</th>
</tr>
<?php 
for ($k=0;$k<5;$k++) {
?>
<tr>
<td><?php echo $cta[$k][0]; ?></td>
<td><?php echo $cta[$k][1]; ?></td>
<td><?php echo $cta[$k][2]; ?></td>
<td><?php echo $cta[$k][3]; ?></td>
<td><?php echo $cta[$k][4]; ?></td>
<td><?php echo $tel1[$k][0]; ?></td>
<td><?php echo $tel1[$k][1]; ?></td>
<td><?php echo $tel1[$k][2]; ?></td>
<td><?php echo $tel1[$k][3]; ?></td>
<td><?php echo $tel2[$k][0]; ?></td>
<td><?php echo $tel2[$k][1]; ?></td>
<td><?php echo $tel2[$k][2]; ?></td>
<td><?php echo $tel2[$k][3]; ?></td>
<td><?php echo $tel1a[$k][0]; ?></td>
<td><?php echo $tel1a[$k][1]; ?></td>
<td><?php echo $tel1a[$k][2]; ?></td>
<td><?php echo $tel1a[$k][3]; ?></td>
<td><?php echo $tel1l[$k][0]; ?></td>
<td><?php echo $tel1l[$k][1]; ?></td>
<td><?php echo $tel1l[$k][2]; ?></td>
<td><?php echo $tel1l[$k][3]; ?></td>
<td><?php echo $tel1r1[$k][0]; ?></td>
<td><?php echo $tel1r1[$k][1]; ?></td>
<td><?php echo $tel1r1[$k][2]; ?></td>
<td><?php echo $tel1r1[$k][3]; ?></td>
<td><?php echo $tel1r2[$k][0]; ?></td>
<td><?php echo $tel1r2[$k][1]; ?></td>
<td><?php echo $tel1r2[$k][2]; ?></td>
<td><?php echo $tel1r2[$k][3]; ?></td>
<td><?php echo $tel1v[$k][0]; ?></td>
<td><?php echo $tel1v[$k][1]; ?></td>
<td><?php echo $tel1v[$k][2]; ?></td>
<td><?php echo $tel1v[$k][3]; ?></td>
<td><?php echo $tel2v[$k][0]; ?></td>
<td><?php echo $tel2v[$k][1]; ?></td>
<td><?php echo $tel2v[$k][2]; ?></td>
<td><?php echo $tel2v[$k][3]; ?></td>
</tr>
<?php } }?>
</table>

    </body>
    </html>
<?php 
}
mysql_close($con);
?>
