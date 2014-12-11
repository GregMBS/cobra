<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
set_time_limit(300);
$go='';
if (!empty($_GET['client'])) {
$start=mysql_real_escape_string($_GET['start']);
$end=mysql_real_escape_string($_GET['end']);
$client=mysql_real_escape_string($_GET['client']);
$merc=0;
if ($client=='Surtidor del Hogar') {$merc=1;}
If ($start>$end) {list($start,$end) = array($end,$start);}
for ($i=$start;$i<$end+1;$i++) {
	$qins="INSERT IGNORE INTO folios (folio,cliente,mercancia)
		VALUES ($i,'$client',$merc);";
	mysql_query($qins) or die('Insert new folios: '.mysql_error());
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Crear Folios Nuevos</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="vendor/components/jquery/jquery.js" type="text/javascript"></script> 
			<script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
</head>
<body>
<p>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la Pagina Administrativa</button>
</p>
<div>
<form action="folios_new.php" method="get" name="newfolios">
cliente <select name="client">
<option value="" style="font-size:120%;"></option>
<?php
        $queryc = "SELECT distinct cliente FROM clientes 
        order by cliente
        ";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
        <?php echo $answerc[0];?></option>
<?php
        } ?>
</select><br />
# empieza <input type='text' name='start' id='start' /><br />
# termina <input type='text' name='end' id='end' /><br />
<input type='hidden' name='capt' value='<?php echo $capt; ?>' id='capt' 
/>
<input type='submit' value='CREAR' />
</form>
</div>
</body>
</html> 
<?php
}  
} 
mysql_close($con);
?>
