<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {echo 'Error. llame Greg';}
else {
if (!empty($_REQUEST['go'])) {
if ($_REQUEST['go']=='GUARDAR') {
$D_FECH=date('Y-m-d');
$C_HORA= date('H:i:s');
$HORA=mysql_real_escape_string($_REQUEST['HORA']);
$NOTA=mysql_real_escape_string($_REQUEST['NOTA']);
$target=mysql_real_escape_string($_REQUEST['target']);
$FECHA=date(mysql_real_escape_string($_REQUEST['formYear']).'-'.mysql_real_escape_string($_REQUEST['formMonth']).'-'.mysql_real_escape_string($_REQUEST['formDay']));
$queryins = "INSERT INTO cobra.notas (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA) 
VALUES ('$target','$capt',date('$D_FECH'),'$C_HORA','$FECHA','$HORA','$NOTA')";
mysql_query($queryins) or die (mysql_error());
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if ($find=="/") {$find=NULL;};
$redirector = "Location: notadmin.php?capt=".$capt;
header($redirector);
};
if ($_REQUEST['go']=='BORRAR') {
$AUTO=mysql_real_escape_string($_REQUEST['which']);
$queryins = "UPDATE cobra.notas set borrado=1 where AUTO='$AUTO'";
mysql_query($queryins) or die (mysql_error());
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if ($find=="/") {$find=NULL;};
$redirector = "Location: notadmin.php?capt=".$capt;
header($redirector);
};
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Nota Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #000000;color:#ffffff;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #000000;background-color: #ffffff; width:12em;color:black;}
	#tableContainer {height: 4cm; overflow: scroll;}
 </style>

</head>
<body>
<div id="notabox">
<table summary="notahead" border='0' cellpadding='0' cellspacing=
'0' width='100%' id="notahead">
<thead class='fixedHeader'>
<tr>
<th>GESTOR</th>
<th>FECHA</th>
<th>HORA</th>
<th colspan=5>NOTA</th>
<th>BORRAR</th>
</tr>
</thead>
</table>
<?php 
                $querysub = "SELECT auto,fecha,hora,nota,c_cvge FROM notas WHERE borrado=0 ORDER BY fecha desc,hora desc";
                $rowsub = mysql_query($querysub);
if (!(empty($rowsub))) {
?>
<div id='tableContainer' class='tableContainer'>
<table summary="notas" border='0' cellpadding='0' cellspacing=
'0' width='100%' id='notabody'>
<tbody class="scrollContent">
<?php
while ($answer = mysql_fetch_array($rowsub)) { ?>
<form action="<?php echo $page ?>" method="get" name="lista<?echo $answer[0];?>">
<input type="hidden" name="which" readonly="readonly" value=<?php echo $answer[0];?> />
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> />
<input type="hidden" name="C_CVGE" readonly="readonly" value=<?php echo $capt;?> /><br>
<input type="hidden" name="AUTO" readonly="readonly" value="" />
<tr>
<td><?php echo $answer[4];?></th>
<td><?php echo $answer[1];?></th>
<td><?php echo $answer[2];?></th>
<td colspan=5><?php echo htmlentities($answer[3],null,'utf-8');?></th>
<td><input type="submit" name="go" value="BORRAR"></td>
</th>
</tr>
</form>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>
<form action="<?php echo $page ?>" method="get" name="notas">
<span class="formcap">Gestor</span><SELECT NAME="target">
<OPTION VALUE='todos'>todos</option>
<?php 
$queryt = "SELECT iniciales FROM nombres order by iniciales";
$rowt = mysql_query($queryt);
while ($answert=mysql_fetch_row($rowt)) {
?>
<option value='<?php echo $answert[0];?>'><?php echo $answert[0];?></option>
<?php } ?>
</SELECT><br>
<span class="formcap">Fecha</span><SELECT NAME="formDay">
<OPTION VALUE='01'>1</option>
<OPTION VALUE='02'>2</option>
<OPTION VALUE='03'>3</option>
<OPTION VALUE='04'>4</option>
<OPTION VALUE='05'>5</option>
<OPTION VALUE='06'>6</option>
<OPTION VALUE='07'>7</option>
<OPTION VALUE='08'>8</option>
<OPTION VALUE='09'>9</option>
<OPTION VALUE='10'>10</option>
<OPTION VALUE='11'>11</option>
<OPTION VALUE='12'>12</option>
<OPTION VALUE='13'>13</option>
<OPTION VALUE='14'>14</option>
<OPTION VALUE='15'>15</option>
<OPTION VALUE='16'>16</option>
<OPTION VALUE='17'>17</option>
<OPTION VALUE='18'>18</option>
<OPTION VALUE='19'>19</option>
<OPTION VALUE='20'>20</option>
<OPTION VALUE='21'>21</option>
<OPTION VALUE='22'>22</option>
<OPTION VALUE='23'>23</option>
<OPTION VALUE='24'>24</option>
<OPTION VALUE='25'>25</option>
<OPTION VALUE='26'>26</option>
<OPTION VALUE='27'>27</option>
<OPTION VALUE='28'>28</option>
<OPTION VALUE='29'>29</option>
<OPTION VALUE='30'>30</option>
<OPTION VALUE='31'>31</option>
</SELECT>
<SELECT NAME="formMonth">
<OPTION VALUE='01'>enero</option>
<OPTION VALUE='02'>febrero</option>
<OPTION VALUE='03'>marzo</option>
<OPTION VALUE='04'>abril</option>
<OPTION VALUE='05'>mayo</option>
<OPTION VALUE='06'>junio</option>
<OPTION VALUE='07'>julio</option>
<OPTION VALUE='08'>agosto</option>
<OPTION VALUE='09'>septiembre</option>
<OPTION VALUE='10'>octubre</option>
<OPTION VALUE='11'>noviembre</option>
<OPTION VALUE='12'>diciembre</option>
</SELECT>
<SELECT NAME="formYear">
<OPTION VALUE='2008'>2008</option>
<OPTION VALUE='2009'>2009</option><!--
<OPTION VALUE=2010>2010</option>-->
</SELECT><br>
<span class="formcap">Hora</span><select name='HORA'>
<option value=''>&nbsp;</option>
<option value='06:00:00'>6 AM</option>
<option value='07:00:00'>7 AM</option>
<option value='08:00:00'>8 AM</option>
<option value='09:00:00'>9 AM</option>
<option value='10:00:00'>10 AM</option>
<option value='11:00:00'>11 AM</option>
<option value='12:00:00'>12</option>
<option value='13:00:00'>1 PM</option>
<option value='14:00:00'>2 PM</option>
<option value='15:00:00'>3 PM</option>
<option value='16:00:00'>4 PM</option>
<option value='17:00:00'>5 PM</option>
<option value='18:00:00'>6 PM</option>
<option value='19:00:00'>7 PM</option>
<option value='20:00:00'>8 PM</option>
<option value='21:00:00'>9 PM</option>
</select><br>
<span class="formcap">Nota</span><textarea rows="2" cols="40" name="NOTA"></textarea><br>
<input type="hidden" name="D_FECH" readonly="readonly" value=<?php echo date('Y-m-d');?> /><br>
<input type="hidden" name="C_HORA" readonly="readonly" value=<?php echo date('H:i:s');?> /><br>
<input type="hidden" name="C_CVGE" readonly="readonly" value=<?php echo $capt;?> /><br>
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> /><br>
<input type="hidden" name="AUTO" readonly="readonly" value="" /><br>
<input type="submit" name="go" value="GUARDAR">
</body>
</html> 
<?php 
}
}
mysql_close();
?>
