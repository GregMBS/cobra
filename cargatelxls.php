<?php
require_once 'pdoConnect.php';
$pdoc	 = new pdoConnect();
$pdo	 = $pdoc->dbConnectAdmin();
$capt	 = filter_input(INPUT_GET, 'capt');
$captp	 = filter_input(INPUT_POST, 'capt');
if (empty($capt)) {
	$capt = $captp;
}
include('vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
?>
<!DOCTYPE HTML>

<html>
    <head>
	<title>ROBOT Carga por Excel</title>
	<link rel="Stylesheet" href="css/redmond/jquery-ui.css" />
	<script type="text/javascript" charset="utf8" src="vendor/components/jquery/jquery.js"></script>
	<script type="text/javascript" charset="utf8" src="vendor/components/jqueryui/jquery-ui.js"></script>
    </head>
    <body>
	<form action="cargatelxls.php" method="post"
	      enctype="multipart/form-data" name="cargar">
	    <p>Usa columnas CUENTA y TELE</p>
	    <input type="file" name="file" id="file" />
	    <p>Mensaje <select name="msgtag">
		    <?php
		    $querycl	 = "SELECT client,tipo FROM robot.msglist;";
		    $resultcl	 = $pdo->query($querycl);

		    foreach ($resultcl as $answercl) {
			    ?>
			    <option value="<?php echo $answercl['client'].','.$answercl['tipo']; ?>" style="font-size:120%;">
				<?php echo $answercl['client'].','.$answercl['tipo']; ?></option>
			<?php }
			?>
		</select>
	    </p>
	    <input type="hidden" name="capt" value="<?php echo $capt; ?>" />
	    <button type="submit" name="go" value="cargar">Cargar</button>
	</p>
    </form>
    <?php
    $go	 = filter_input(INPUT_POST, 'go');
    $msgtag	 = filter_input(INPUT_POST, 'msgtag');
    if (!empty($go)) {

	    if ($go == 'cargar') {

		    $querytemp1	 = 'DROP TABLE IF EXISTS robot.tempc';
		    $pdo->query($querytemp1);
		    $querytemp2	 = 'CREATE TABLE robot.tempc (
  `id` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `turno` varchar(50)
)';
		    $pdo->query($querytemp2);
		    //Check valid spreadsheet has been uploaded
		    if ($_FILES["file"]["error"] > 0) {
			    echo "<p>Error: ".$_FILES["file"]["error"]."</p>";
		    } else {
			    echo "<p>Upload: ".$_FILES["file"]["name"]."<br>";
			    echo "Type: ".$_FILES["file"]["type"]."<br>";
			    echo "Size: ".($_FILES["file"]["size"] / 1024)." Kb<br>";
			    echo "Stored in: ".$_FILES["file"]["tmp_name"];
			    $deststr = "/tmp/".$_FILES['file']['name'];
			    move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
			    echo "Stored in: ".$deststr."</p>";

			    $inputFile	 = $deststr;
			    $extension	 = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
			    if ($extension == 'XLSX' || $extension == 'ODS' || $extension == 'XLS') {

				    //Read spreadsheeet workbook
				    try {
					    $inputFileType	 = PHPExcel_IOFactory::identify($inputFile);
					    $objReader	 = PHPExcel_IOFactory::createReader($inputFileType);
					    $objPHPExcel	 = $objReader->load($inputFile);
				    } catch (Exception $e) {
					    die($e->getMessage());
				    }

				    //Get worksheet dimensions
				    $sheet		 = $objPHPExcel->getSheet(0);
				    $highestRow	 = $sheet->getHighestRow();
				    //$highestColumn = $sheet->getHighestColumn();
				    $highestColumn	 = 'B';

				    //Loop through each row of the worksheet in turn
				    //for ($row = 1; $row <= $highestRow; $row++) {
				    //  Read a row of data into an array
				    $array = $sheet->rangeToArray('A1:B'.$highestRow, NULL, TRUE, FALSE);

				    foreach ($array as $data) {
					    $cta		 = $data[0];
					    $tel		 = substr($data[1], -12);
					    $queryload	 = "INSERT INTO robot.tempc (id,tel) VALUES (:cta, :tel);";
					    $stl		 = $pdo->prepare($queryload);
					    $stl->bindParam(':cta', $cta);
					    $stl->bindParam(':tel', $tel);
					    $stl->execute();
				    }
			    } else {
				    echo "Favor de usar XLSX, ODS, o XLS";
			    }

			    $querycleantrim = "UPDATE robot.tempc "
				."SET tel = RIGHT(TRIM(tel),12);";
			    $pdo->query($querycleantrim);

			    $querycleanletters = "DELETE FROM robot.tempc "
				."WHERE tel REGEXP '[A-Z]';";
			    $pdo->query($querycleanletters);

			    $querycleanzeropad = "UPDATE robot.tempc "
				."SET tel = CONCAT('0', tel) "
				."WHERE length(tel) = 11 "
				."OR (length(tel)=12 AND LEFT(tel,2) IN ('44', '45'));";
			    $pdo->query($querycleanzeropad);

			    $querycleanlength = "DELETE FROM robot.tempc "
				."WHERE length(tel) < 8 "
				."OR length(tel) >13;";
			    $pdo->query($querycleanlength);

			    $queryput1 = "INSERT INTO robot.calllist (id,tel,msg,turno)
                            SELECT id,tel,msg,0 
                            FROM robot.tempc 
                            LEFT JOIN (
                            SELECT msg FROM robot.msglist 
                            WHERE concat_ws(',',client,tipo)='".$msgtag."') as tmp 
                                ON 1=1;";
			    $pdo->query($queryput1);
			    ?>
			    <p>Llamadas están guardados</p>
			    <?php
		    }
	    }
    }
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
</body>
</html>

