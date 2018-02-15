<?php
include('admin_hdr_i.php');
$post                   = filter_input_array(INPUT_POST);
$go                     = filter_input(INPUT_POST, 'go');
$reemplazar             = filter_input(INPUT_POST, 'reemplazar');
$cliente                = $con->real_escape_string(filter_input(INPUT_POST,
        'cliente'));
$fecha_de_actualizacion = filter_input(INPUT_POST, 'fecha_de_actualizacion',
    FILTER_VALIDATE_REGEXP,
    array("options" => array("regexp" => "/\d{4}-[01]\d-[0-3]\d/")));
$filename               = filter_input(INPUT_POST, 'filename');
$maxc                   = filter_input(INPUT_POST, 'maxc');
$fieldlist              = '';
$sep                    = '';
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>COBRA Productos Carga</title>
    </head>
    <body>
        <form action="carga_extras.php" method="post" enctype="multipart/form-data" name="cargar">
            <p>Filename:
                <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>" />
                <input type="file" name="file" id="file"><br>
                <button type="submit" name="go" value="cargar">Elegir archivo</button>
            </p>
        </form>
        <?php
        if (!empty($go)) {

            if ($go == 'cargar') {

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
                    ?>
                    <p>
                    <form action="carga_extras.php" method="post" name="clientepick">
                        <table summary="Eligir cliente">
                            <tr><td>Client</td>
                                <td><input type="text" name="cliente" />
                                    <input type="hidden" name="filename" value="<?php
                                           echo $deststr
                                           ?>" />
                                    <input type="hidden" name="capt" value="<?php echo $capt ?>" />
                                </td></tr>
                            <tr><td>Reemplazar lo anterior <input type="checkbox" name="reemplazar" id="reemplazar"></td></tr>
                        </table>
                        <button type="submit" name="go" value="clientepick">Elegir cliente</button>
                    </form>
                    <?php
                }
            }

            if ($go == 'clientepick') {
                ?>
                <p>
                <form action="carga_extras.php" method="post" name="assoc">
                    <?php
                    if (!empty($reemplazar)) {
                        $queryre  = "truncate extradex;";
                        $resultre = $con->query($queryre) or die($con->error);
                    }
                    $handle = fopen($filename, "r");
                    $row    = 1;
                    $data   = fgetcsv($handle, 0, ",");
                    $num    = 0;

                    while ($num == 0) {
                        $num = count($data);
                    }
                    $row++;
                    ?>
                    <input name="cliente" type="hidden" value="<?php
                           echo $cliente
                           ?>" />
                    <input name="fecha_de_actualizacion" type="hidden" value="<?php
                           echo $fecha_de_actualizacion
                           ?>" />
                    <input type="hidden" name="filename" value='<?php
                           echo $filename
                           ?>' />
                    <input type="hidden" name="capt" value="<?php echo $capt ?>" />
                </p>
    <?php } ?>
            <p>
            <table summary="Nuevo campos">
                <?php
                $querypdex  = "select position from extradex;";
                $resultpdex = $con->query($querypdex) or die($con->error);
                $numdex     = 0;

                while ($answerpdex = $resultpdex->fetch_row()) {
                    $numdex++;
                }

                if ($numdex == 0) {

                    for ($c = 0; $c < $num; $c++) {

                        if (!empty($data[$c])) {
                            ?>
                            <tr><td><?php
                                    echo $data[$c]
                                    ?></td>
                                <td>
                                    <select name="pos<?php
                                            echo $c
                                            ?>">
                                        <option value='nousar<?php echo $c ?>'>no usar</option>
                                        <?php
                                        $queryres  = "show columns from infextras";
                                        $resultres = $con->query($queryres) or die($con->error);
                                        $k         = 0;

                                        while ($answerres = $resultres->fetch_row()) {
                                            ?>
                                            <option value='<?php echo $k ?>'<?php
                                            if ($data[$c] == $answerres[0]) {
                                                echo " selected='selected'";
                                            }
                                            ?>><?php echo $answerres[0]; ?></option>
                                                    <?php
                                                    $k++;
                                                }
                                                ?>
                                    </select></td></tr>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" value="nousar" name="pos<?php
                                   echo $c
                                   ?>"/>
                                   <?php
                               }
                           }
                       } else {
                           $querydex  = "select * from extradex;";
                           $resultdex = $con->query($querydex) or die($con->error);
                           $c         = 0;

                           while ($answerdex = $resultdex->fetch_row()) {
                               echo $data[$c]." ".$answerdex[1]." ".$answerdex[2]." ".$answerdex[3]."<br>";
                               $c++;
                           }
                       }
                       ?>
                </p>
                <p>
                    <input type="hidden" name="maxc" value="<?php echo $c ?>" />
                    <input type="hidden" name="capt" value="<?php echo $capt ?>" />
                    <input type="submit" name="go" value="asociar" />
                </p>
        </form>
        <?php
    }

    if ($go == 'asociar') {
        $queryres  = "show columns from infextras";
        $resultres = $con->query($queryres) or die($con->error);
        $k         = 0;

        while ($answerres = $resultres->fetch_row()) {
            $field[$k]    = $answerres[0];
            $type[$k]     = $answerres[1];
            $nullok[$k]   = $answerres[2];
            $position[$k] = $k;
            $k++;
        }

        for ($f = 0; $f < $maxc; $f++) {
            $pos = filter_input(INPUT_POST, 'pos'.$f);

            if (stripos($pos, 'nousar') === 0) {
                $nfield    = 'nousar';
                $ntype     = '';
                $nnullok   = '';
                $nposition = '';
            } else {
                $nfield    = $field[$pos];
                $ntype     = $type[$pos];
                $nnullok   = $nullok[$pos];
                $nposition = $pos;
            }
            $queryins  = "insert into extradex (field,type,nullok,position) values ('$nfield','$ntype','$nnullok','$nposition');";
//die($queryins);
            $resultins = $con->query($queryins) or die($con->error);
        }

        $querydrop  = "DROP TABLE IF EXISTS `inftemp`;";
        $resultdrop = $con->query($querydrop) or die($con->error);
        $querydex   = "select * from extradex;";
        $resultdex  = $con->query($querydex) or die($con->error);
        $c          = 0;

        while ($answerdex = $resultdex->fetch_row()) {
            $field[$c] = $answerdex[1];
            $type[$c]  = $answerdex[2];
            $c++;
            set_time_limit(300);
        }
        $querystart = "CREATE TABLE `inftemp` (";
        $queryend   = "`fecha_de_actualizacion` date
) ENGINE=INNODB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";

        for ($f = 0; $f < $c; $f++) {

            if ($field[$f] != 'nousar') {
                $qline = $field[$f]." ".$type[$f].",";
            } else {
                $qline = "nousar".$f." varchar(1),";
            }
            $querystart = $querystart.$qline;
        }
//            die($querystart.$queryend);
        $resultcr    = $con->query($querystart.$queryend) or die($con->error);
        $queryindex  = "ALTER TABLE inftemp ADD INDEX nc(cuenta(50));";
        $con->query($queryindex) or die($con->error);
        $filename    = str_replace("\\", "/", $filename);
        $quote       = '"';
        $queryload   = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE inftemp FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '".$quote."' LINES TERMINATED BY '\n';";
        $resultload  = $con->query($queryload) or die($con->error);
        $queryfcont  = "show fields from inftemp
where field not regexp '^nousar'
and field not regexp 'actualizacion$'
and field not regexp 'cuenta';";
        $resultfcont = $con->query($queryfcont) or die($con->error);

        while ($answerfcont = $resultfcont->fetch_row()) {
            $fieldlist = $fieldlist.$sep.'infextras.'.$answerfcont[0].'=inftemp.'.$answerfcont[0];
            $sep       = ',';
        }
        $ncr        = '';
        $ncr1       = '';
        $ncr2       = '';
        $queryioff  = "ALTER TABLE infextras DISABLE KEYS";
        $queryion   = "ALTER TABLE infextras ENABLE KEYS";
        //$con->query($queryioff) or die($con->error);
        $queryupd2  = "UPDATE inftemp, infextras
	        SET ".$fieldlist."
            where inftemp.cuenta=infextras.cuenta;";
        $resultupd2 = $con->query($queryupd2) or die($con->error);
        //die(htmlentities($queryupd2));

        echo "Old fields updated.";
        $queryfused  = "show fields from inftemp
            where field not regexp 'nousar'
            and field not regexp 'actualizacion';";
        $resultfused = $con->query($queryfused) or die($con->error);
        $fieldlist   = '';
        $sep         = '';

        while ($answerfused = $resultfused->fetch_row()) {
            $fieldlist = $fieldlist.$sep.$answerfused[0];
            $sep       = ',';
        }
        $queryins  = "insert into infextras (".$fieldlist.") select ".$fieldlist." from inftemp
            where cuenta+0>0 and not exists (
            select * from infextras
            where inftemp.cuenta=infextras.cuenta);";
        //die(htmlentities($queryins));
        $resultins = $con->query($queryins) or die($con->error);
        echo "New fields inserted.";
    }
