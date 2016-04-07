<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$id_cuenta=mysql_real_escape_string($_REQUEST['id_cuenta']);
$ejecutivo_asignado_call_center=mysql_real_escape_string($_REQUEST['ejecutivo_asignado_call_center']);
$tcapt=$capt;
$C_CVGE=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
$queryg = "SELECT usuaria,tipo FROM nombres join grupos on tipo=grupo WHERE iniciales = '".$capt."';";
$resultg = mysql_query($queryg) or die(mysql_error());
while($answerg = mysql_fetch_row($resultg)) {$mynombre=$answerg[0];$mytipo=$answerg[1];}
if (!empty($mytipo)) {
$querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin),if(c_visit is null,c_cvge,c_visit),left(c_obse1,50),c_obse1,auto FROM historia 
WHERE (historia.C_CONT=".$id_cuenta.") AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
$rowsub = mysql_query($querysub);
if (!(empty($rowsub))) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Visitas</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
    body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #ffffff;color:#000000;}
	table {color:#000000;}
	tr {height:2em;}
	th {width: 9em;}
	th.gestion {width: 32em;}
	th.status {width: 16em;}
	th.timestamp {width: 8em;}
	th.telefono {width: 8em;}
	th.chico {width: 5em;}
  td {border: 1pt solid #000000;background-color: #ffffff; width:10em;}
	td.gestion {width: 32em;height: 1em;overflow:hidden;}
	td.status {width: 16em;}
	td.timestamp {width: 8em;}
	td.telefono {width: 8em;}
	td.chico {width: 5em;}
    #tableContainer {height: 100%; overflow: scroll;}
</style>
</head>
<body>
<div id="historybox">
<table summary="historiahead" border='0' cellpadding='0' cellspacing=
'0' width='100%' id="historyhead">
<tr>
<?php 
$fieldnames = array("Status","Fecha/Hora","Visitador","Gestion","Gestion");
$fieldsize = array("status", "timestamp",    "chico",   "gestion","hidebox");
                  for ($j=0; $j<4; $j++) { 
                    $fieldname = $fieldnames[$j]; ?>
                    <th<?php echo ' class="'.$fieldsize[$j].'"';?>><?php if (isset($fieldname)) {echo $fieldname;} ?></th> <?php
                  }
                ?></tr>
</table>
<div id='tableContainer' class='tableContainer'>
<table summary="historia" border='0' cellpadding='0' cellspacing=
'0' width='100%' id='historybody'>
<tbody class="scrollContent"><?php
                $j=0;
				$c=0;
                while ($answer = mysql_fetch_array($rowsub)) { 
$auto=$answer[5];
$gestor=utf8_encode($answer[2]);
$gestion=utf8_encode($answer[4]);
?>
<tr>
<?php 
                   for ($k=0; $k<4; $k++) { 
                    $ank = utf8_encode($answer[$k]);
							      if (is_null($ank)) {$ank="&nbsp;";};
                    $ank=str_replace('00:00:00', '', $ank);
                    $jscode='';
                    if ($fieldsize[$k]=="gestion") {
											$jscode1=" onClick='alert(";
											$jscode2=")'";
											$jscode=$jscode1.'"'.ereg_replace("[\n\r]", " ", $gestion).'"'.$jscode2;
											}
										?>
                    <td<?php if ($c==1) {echo " style='background-color:#dddddd'";}; echo ' class="'.$fieldsize[$k].'"'.$jscode;?>>
					<?php
					if (isset($ank)) {echo $ank;} 
					?>
					</td> 
					<?php
					} $c=1-$c;
					?>
                  </tr> 
				  <?php 
                  $j++;
                }  
              ?>
			  </tbody>
</table>
</div>
<?php }  ?>
</div>
<button onClick='window.close()'>CIERRA</button>
<?php   
}
mysql_close($con);
?>
</body>
</html> 


