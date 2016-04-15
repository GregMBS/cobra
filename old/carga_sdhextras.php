<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_POST, 'go');
?>
<!DOCTYPE HTML>

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
        if (!empty($go)) {
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

                $queryclear = "truncate sdhextras;";
                $pdo->query($queryclear);

                $handle = fopen($deststr, "r");
                $num    = 0;
                while ($data   = fgetcsv($handle, 0, ",")) {
                    $values = array();
                    $imp    = implode(",", $data);
                    if ($num == 0) {
                        $columns = str_replace('"', '', $imp);
                        $num++;
                    } else {
                        foreach ($data as $d) {
                            if (is_numeric($d)) {
                                array_push($values, $d);
                            } else {
                                $s = str_replace("''", '', $d);
                                array_push($values, "'".$s."'");
                            }
                        }
                        $impv     = implode(',', $values);
                        $queryins = "INSERT INTO sdhextras ($columns) "
                            ."VALUES ($impv);";
                        echo $queryins."<br>";
                        $num++;
                    }
                }
                fclose($handle);
                /*
                  $querysum = "select cuenta, sum(st) as sts, sum(sv) as svs, sum(sd) as sds, sum(sdd) as sdds
                  from sdhextras
                  group by cuenta;";
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
                 */
            }
        }

