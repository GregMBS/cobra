<?php
include('admin_hdr_3.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain = "SELECT id,tel,msg,fechahora,camp FROM calllog ORDER BY fechahora DESC
";
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Robot Registro</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;table-layout:fixed;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
	div,p {clear:both}
	#next,#prev {float:left;clear:none;}
	#paging {font-weight:bold; font-size:110%}
 </style>

</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary="Log">
<thead>
<tr>
<th>ID CUENTA</th>
<th>TEL</th>
<th>Archivo de mensaje</th>
<th>Fecha/hora</th>
<th>Computadora</th>
</tr>
</thead>
<tbody>
<?php
while($row = mysql_fetch_row($result)) {
$ID=$row[0];
$TEL=$row[1];
$MSG=$row[2];
$FECHAHORA=$row[3];
$CAMP=$row[4];
?>
<tr>
<td><?php echo $ID;?></td>
<td><?php echo $TEL;?></td>
<td><?php echo $MSG;?></td>
<td><?php echo $FECHAHORA;?></td>
<td><?php echo $CAMP;?></td>
</tr>
<?php
}
}   
}
mysql_close($con);
?>
</tbody>
</table>
</body>
</html> 
