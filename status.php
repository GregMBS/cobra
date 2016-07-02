<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        
        if ($go == "KILL") 
        {
            $queryu = "KILL " . mysql_real_escape_string($_GET['ID']).";";
            $resultu = mysql_query($queryu) or die(mysql_error());
        }
	}
    $querymain = "show processlist;";
    $result = mysql_query($querymain) or die(mysql_error());
	$querytab = "SELECT * FROM information_schema.`TABLES` T 
where table_schema='cobrajdlr'
order by data_length desc;";
    $resulttab = mysql_query($querytab) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Database Status</title>
			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
<style>
	tr:hover {background-color: yellow;}
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary="Processlist" class="ui-widget">
<thead class="ui-widget-header">
<tr>
<th>ID</a></th>
<th>User</a></th>
<th>Host</a></th>
<th>db</a></th>
<th>Command</a></th>
<th>Time</a></th>
<th>State</a></th>
<th>Info</a></th>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
    $j = 0;
    
    while ($row = mysql_fetch_row($result)) 
    {
        $j = $j + 1;
        $ID = $row[0];
        $User = $row[1];
        $Host = $row[2];
        $db = $row[3];
        $Command = $row[4];
        $Time = $row[5];
        $State = $row[6];
        $Info = $row[7];
?>
<tr>
<form class="kill" name="kill<?php echo $ID ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="kill<?php echo $ID ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<td><input type="text" readonly="readonly" name="ID" value="<?php echo $ID; ?>" /></td> 
<td><?php echo $User; ?></td> 
<td><?php echo $Host; ?></td> 
<td><?php echo $db; ?></td> 
<td><?php echo $Command; ?></td> 
<td><?php echo $Time; ?></td> 
<td><?php echo $State; ?></td> 
<td><?php echo $Info; ?></td> 
<td><input type="submit" name="go" value="KILL">
</td>
</form>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Processlist" class="ui-widget">
<thead class="ui-widget-header">
<tr>
<th>Table</a></th>
<th>Rows</a></th>
<th>Data</a></th>
<th>Index</a></th>
<th>D/I</a></th>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
    $j = 0;
    
    while ($row = mysql_fetch_row($resulttab)) 
    {
        $Table = $row[2];
        $Rows = $row[7];
        $Data = $row[9];
        $Index = $row[11];
        $DI = $Data/($Index+1);
?>
<tr>
<td><?php echo $Table; ?></td> 
<td><?php echo $Rows; ?></td> 
<td><?php echo $Data; ?></td> 
<td><?php echo $Index; ?></td> 
<td><?php echo $DI; ?></td> 
</td>
</form>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
