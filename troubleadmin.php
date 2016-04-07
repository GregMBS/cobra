<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {echo 'Error. llame Greg';}
else {
if (!empty($_REQUEST['go'])) {
if ($_REQUEST['go']=='RESOLVER') {
$AUTO=mysql_real_escape_string($_REQUEST['which']);
$reparacion=mysql_real_escape_string($_REQUEST['reparacion']);
$queryup = "UPDATE cobra4.trouble 
set fechacomp=now(),
it_guy='".$capt."',
reparacion='".$reparacion."'
where AUTO=".$AUTO;
mysql_query($queryup) or die (mysql_error());
};
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Trouble Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
       body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #ffffff;color:#000000;}
       span.formcap {display: block; width: 20em; float: left; font-size: 100%; font-weight:bold;}
	th {width: 12em;}
	td {border: 1pt solid #000000;background-color: #ffffff; width:12em;color:black;}
 </style>

</head>
<body>
<div id="troublebox">
<table summary="notahead" border='0' cellpadding='0' cellspacing=
'0' width='100%' id="notahead">
<thead class='fixedHeader'>
<tr>
<th>Fecha/hora</th>
<th>Sistema</th>
<th>Usuario</th>
<th>Fuente</th>
<th>Descripcion</th>
<th>Error Mensaje</th>
<th>Reparacion</th>
<th>Arreglado?</th>
</tr>
</thead>
<?php 
                $querysub = "SELECT * FROM trouble ORDER BY fechahora desc";
                $rowsub = mysql_query($querysub);
if (!(empty($rowsub))) {
?>
<tbody class="scrollContent">
<?php
while ($answer = mysql_fetch_array($rowsub)) { ?>
<form action="#" method="get" name="lista<?echo $answer['auto'];?>">
<input type="hidden" name="which" readonly="readonly" value=<?php echo $answer['auto'];?> />
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> />
<tr>
<td><?php echo $answer['fechahora'];?></th>
<td><?php echo $answer['sistema'];?></th>
<td><?php echo $answer['usuario'];?></th>
<td><?php echo $answer['fuente'];?></th>
<td><?php echo $answer['descripcion'];?></th>
<td><?php echo $answer['error_msg'];?></th>
<td>
<?php if (empty($answer['it_guy'])) { ?>
<input type="text" name="reparacion" /></th>
<?php } else {echo $answer['reparacion'];} ?>
<td>
<?php if (empty($answer['it_guy'])) { ?>
<input type="submit" name="go" value="RESOLVER">
<?php } else {echo $answer['fechacomp'].' '.$answer['IT_guy'];} ?>
</td>
</tr>
</form>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>

</body>
</html> 
<?php 
}
}
mysql_close();
?>
