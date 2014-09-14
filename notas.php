<?php
$host = "localhost";
$user = "root";
$pswd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_REQUEST['capt']);
$CUENTA=mysql_real_escape_string($_REQUEST['CUENTA']);
$C_CONT=mysql_real_escape_string($_REQUEST['C_CONT']);
if ($_REQUEST['go']=='GUARDAR') {
$D_FECH=date('Y-m-d');
$C_HORA= date('H:i:s');
$HORA='';
if (mysql_real_escape_string($_REQUEST['HORA'])!='00') {
$HORA=mysql_real_escape_string($_REQUEST['HORA']).':'.mysql_real_escape_string($_REQUEST['MIN']).':00';
}
$NOTA=mysql_real_escape_string($_REQUEST['NOTA']);
$FECHA=mysql_real_escape_string($_REQUEST['FECHA']);
$querybor = "UPDATE cobra.notas SET borrado=1 
WHERE c_cvge='".$capt."' and c_cont='".$C_CONT."'";
mysql_query($querybor) or die (mysql_error());
$queryins = "INSERT INTO cobra.notas (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT) 
VALUES ('$capt','$capt',date('$D_FECH'),'$C_HORA','$FECHA','$HORA','$NOTA','$CUENTA','$C_CONT')";
//mysql_query($queryins) or die (mysql_error());
die($queryins);
$redirector = "Location: notas.php?capt='".$capt."'&go=FROMGUARDAR";
header($redirector);
};
if ($_REQUEST['go']=='BORRAR') {
$AUTO=mysql_real_escape_string($_REQUEST['which']);
$queryins = "UPDATE cobra.notas set borrado=1 where AUTO='$AUTO' and C_CVGE='$capt'";
mysql_query($queryins) or die (mysql_error());
$redirector = "Location: notas.php?capt=".$capt."&go=FROMBORRAR";
header($redirector);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Notas</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff;color:#000000;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #c0c0c0;background-color: #c0c0c0; width:12em;color:black;}
	#tableContainer {height: 6cm; overflow: scroll;}
</style>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
</head>
<body>
<div id="notabox">
<table summary="notahead" border='0' cellpadding='0' cellspacing=
'0' width='100%' id="notahead">
<thead class='fixedHeader'>
<tr>
<th>FECHA</th>
<th>HORA</th>
<th>CUENTA</th>
<th colspan=5>NOTA</th>
<th>BORRAR</th>
</tr>
</thead>
</table>
<?php 
                $querysub = "SELECT auto,fecha,hora,nota,c_cvge,cuenta FROM cobra.notas WHERE (c_cvge='$capt' OR c_cvge='todos') AND borrado=0 ORDER BY fecha desc,hora desc";
                $rowsub = mysql_query($querysub);
if (!(empty($rowsub))) {
?>
<div id='tableContainer' class='tableContainer'>
<table summary="notas" border='0' cellpadding='0' cellspacing=
'0' width='100%' id='notabody'>
<tbody class="scrollContent">
<?php
while ($answer = mysql_fetch_array($rowsub)) { ?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="lista<?echo $answer[0];?>">
<input type="hidden" name="which" readonly="readonly" value=<?php echo $answer[0];?> /><br>
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> /><br>
<tr>
<td><?php echo $answer[1];?></td>
<td><?php echo $answer[2];?></td>
<td><?php echo $answer[5];?></td>
<td colspan=5><?php echo htmlentities($answer[3],null,'utf-8');?></td>
<td><?php if ($answer[4]==$capt) {?><input type="submit" name="go" value="BORRAR"><?php } ?>
</td>
</tr>
</form>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="notas">
<SCRIPT LANGUAGE="JavaScript" ID="js4">
var cal4 = new CalendarPopup();
cal4.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal4.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal4.setWeekStartDay(1);
cal4.setTodayText("Hoy");
</SCRIPT>
<span class="formcap">Fecha</span><INPUT TYPE="text" NAME="FECHA" ID="FECHA" VALUE="" SIZE=15>
<BUTTON onClick="cal4.select(document.getElementById('FECHA'),'anchor4','yyyy-MM-dd'); return false;" NAME="anchor4" ID="anchor4">eligir</BUTTON>
<br>
<span class="formcap">Hora</span><select name='HORA'>
<option value='00'>&nbsp;</option>
<option value='06'>6 AM</option>
<option value='07'>7 AM</option>
<option value='08'>8 AM</option>
<option value='09'>9 AM</option>
<option value='10'>10 AM</option>
<option value='11'>11 AM</option>
<option value='12'>12</option>
<option value='13'>1 PM</option>
<option value='14'>2 PM</option>
<option value='15'>3 PM</option>
<option value='16'>4 PM</option>
<option value='17'>5 PM</option>
<option value='18'>6 PM</option>
<option value='19'>7 PM</option>
<option value='20'>8 PM</option>
<option value='21'>9 PM</option>
</select>
<span class="formcap">Min</span><select name='MIN'>
<option value='00'>&nbsp;</option>
<option value='00'>0</option>
<option value='05'>5</option>
<option value='10'>10</option>
<option value='15'>15</option>
<option value='20'>20</option>
<option value='25'>25</option>
<option value='30'>30</option>
<option value='35'>35</option>
<option value='40'>40</option>
<option value='45'>45</option>
<option value='50'>50</option>
<option value='55'>55</option>
</select>
<br>
<span class="formcap">Cuenta</span><input type="text" name="CUENTA" readonly="readonly" value=<?php echo $CUENTA;?>></input><br>
<span class="formcap">Nota</span><textarea rows="2" cols="40" name="NOTA"></textarea><br>
<input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $C_CONT;?> /><br>
<input type="hidden" name="D_FECH" readonly="readonly" value=<?php echo date('Y-m-d');?> /><br>
<input type="hidden" name="C_HORA" readonly="readonly" value=<?php echo date('H:i:s');?> /><br>
<input type="hidden" name="AUTO" readonly="readonly" value="" /><br>
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> /><br>
<input type="submit" name="go" value="GUARDAR">
</form>
<button onClick='window.close()'>CIERRA</button>
</body>
</html> 
<?php 
//}  
//}
mysql_close($con);
?>

