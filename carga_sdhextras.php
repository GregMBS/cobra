<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>COBRA Carga SDH Extras</title>
</head>
<body>
<form action="carga_sdhextras.php" method="post" enctype="multipart/form-data" name="cargar">
<p>Filename:
<input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>" />
<input type="file" name="file" id="file"><br>
<button type="submit" name="go" value="cargar">Elegir archivo</button>
</p>
</form>
<?php
    
    if (!empty($_REQUEST['go'])) {
		if ($_FILES["file"]["error"] > 0) {
			echo "<p>Error: " . $_FILES["file"]["error"] . "</p>";
			}
        else {
			echo "<p>Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"];
            $deststr = "/tmp/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
            echo "Stored in: " . $deststr . "</p>";
                
            $queryclear="truncate sdhextras;";    
			mysql_query($querclear) or die('Remove old: '.mysql_error());
			
            $handle = fopen($deststr, "r");
            $data = fgetcsv($handle, 0, ",");
            $num = 0;
			fclose($handle);
			foreach ($data as $d) {
				if ($num==0) {
					$columns=str_replace('"','',$d);
					$num++;
					}
				else {
					$queryins="INSERT INTO sdhextras ($columns)	VALUES ($d);";
					mysql_query($querclear) or die('Add new: '.mysql_error());
					$num++;
					}
				}
			$querysum = "select cuenta, sum(st) as sts, sum(sv) as svs, sum(sd) as sds, sum(sdd) as sdds
				from sdhextras
				groupby cuenta;";
			$resultsum = mysql_query($querysum) or die('Get sums: '.mysql_error());
			while ($sums = mysql_fetch_array($resultsum)) {
				$querysdh = "update resumen
					set saldo_total=".$sums['sts'].",
					saldo_vencido=".$sums['svs'].",
					saldo_descuento_1=".$sums['sds'].",
					saldo_descuento_2=".$sums['sdds']." 
					where numero_de_cuenta=".$sums['cuenta']-" and cliente='Surtidor del Hogar';";
				$resultsdh = mysql_query($querysdh) or die('Save sums: '.mysql_error());
				}
}
}
}
}
mysql_close($con);
?>
