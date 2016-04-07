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
<title>COBRA Carga</title>
</head>
<body>
<form action="carga2a.php" method="post" enctype="multipart/form-data" name="cargar">
<p>Filename:
<input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>" />
<input type="file" name="file" id="file"><br>
<button type="submit" name="go" value="cargar">Elegir archivo</button>
</p>
</form>
<?php
    
    if (!empty($_REQUEST['go'])) 
    {
        
        if ($_REQUEST['go'] == 'cargar') 
        {
            
            if ($_FILES["file"]["error"] > 0) 
            {
                echo "<p>Error: " . $_FILES["file"]["error"] . "</p>";
            }
            else
            {
                echo "<p>Upload: " . $_FILES["file"]["name"] . "<br>";
                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";
                echo "Stored in: " . $_FILES["file"]["tmp_name"];
                $deststr = "/tmp/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
                echo "Stored in: " . $deststr . "</p>";
?>
<p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="clientepick">
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
        
        if ($_REQUEST['go'] == 'clientepick') 
        {
?>
<p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="assoc">
<?php
            $cliente = mysql_real_escape_string($_REQUEST['cliente']);
            
            if (!empty($_REQUEST['reemplazar'])) 
            {
                $queryre = "delete from cargadex where cliente='" . $cliente . "';";
                $resultre = mysql_query($queryre) or die(mysql_error());
            };
            $fecha_de_actualizacion = mysql_real_escape_string($_REQUEST['fecha_de_actualizacion']);
            $filename = mysql_real_escape_string($_REQUEST['filename']);
            $handle = fopen($filename, "r");
            $row = 1;
            $data = fgetcsv($handle, 0, ",");
            $num = 0;
            
            while ($num == 0) 
            {
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
<p>
<table summary="Nuevo campos">
<?php
            $querypdex = "select position from cargadex where cliente='" . $cliente . "';";
            $resultpdex = mysql_query($querypdex) or die(mysql_error());
            $numdex = 0;
            
            while ($answerpdex = mysql_fetch_row($resultpdex)) 
            {
                $numdex++;
            }
            
            if ($numdex == 0) 
            {
                
                for ($c = 0;$c < $num;$c++) 
                {
                    
                    if (!empty($data[$c])) 
                    {
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
                        $queryres = "show columns from infextras";
                        $resultres = mysql_query($queryres) or die(mysql_error());
                        $k = 0;
                        
                        while ($answerres = mysql_fetch_row($resultres)) 
                        {
?>
<option value='<?php echo $k ?>'<?php if ($data[$c]==$answerres[0]) {echo " selected='selected'";}?>><?php echo $answerres[0]; ?></option>
<?php
                            $k++;
                        }
?>
</select></td></tr>
<?php
                    }
                    else
                    { ?>
						<input type="hidden" value="nousar" name="pos<?php
                        echo $c
?>"/>
						<?php
                    }
                }
            }
            else
            {
                $querydex = "select * from cargadex where cliente='" . $cliente . "';";
                $resultdex = mysql_query($querydex) or die(mysql_error());
                $c = 0;
                
                while ($answerdex = mysql_fetch_row($resultdex)) 
                {
                    echo $data[$c] . " " . $answerdex[1] . " " . $answerdex[2] . " " . $answerdex[3] . "<br>";
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
        
        if ($_REQUEST['go'] == 'asociar') 
        {
            $maxc = mysql_real_escape_string($_REQUEST['maxc']);
            $cliente = mysql_real_escape_string($_REQUEST['cliente']);
            $fecha_de_actualizacion = mysql_real_escape_string($_REQUEST['fecha_de_actualizacion']);
            $filename = mysql_real_escape_string($_REQUEST['filename']);
            
            if (!empty($_REQUEST['pos0'])) 
            {
                $queryres = "show columns from infextras";
                $resultres = mysql_query($queryres) or die(mysql_error());
                $k = 0;
                
                while ($answerres = mysql_fetch_row($resultres)) 
                {
                    $field[$k] = $answerres[0];
                    $type[$k] = $answerres[1];
                    $nullok[$k] = $answerres[2];
                    $position[$k] = $k;
                    $k++;
                }
                
                for ($f = 0;$f < $maxc;$f++) 
                {
                    $pos = mysql_real_escape_string($_REQUEST['pos' . $f]);
                    
                    if (stripos($pos, 'nousar') === 0) 
                    {
                        $nfield = 'nousar';
                        $ntype = '';
                        $nnullok = '';
                        $nposition = '';
                    }
                    else
                    {
                        $nfield = $field[$pos];
                        $ntype = $type[$pos];
                        $nnullok = $nullok[$pos];
                        $nposition = $pos;
                    }
                    $queryins = "insert into cargadex (field,type,nullok,position,cliente) values ('$nfield','$ntype','$nnullok','$nposition','$cliente');";
                    $resultins = mysql_query($queryins) or die(mysql_error());
                }
            }
            $querydrop = "DROP TABLE IF EXISTS `cobra4`.`temp`;";
            $resultdrop = mysql_query($querydrop) or die(mysql_error());
            $querydex = "select * from cargadex where cliente='" . $cliente . "';";
            $resultdex = mysql_query($querydex) or die(mysql_error());
            $c = 0;
            
            while ($answerdex = mysql_fetch_row($resultdex)) 
            {
                $field[$c] = $answerdex[1];
                $type[$c] = $answerdex[2];
                $c++;
                set_time_limit(300);
            }
            $querystart = "CREATE TABLE  `cobra4`.`temp` (";
            $queryend = ") ENGINE=INNODB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";
            
            for ($f = 0;$f < $c;$f++) 
            {
                
                if ($field[$f] != 'nousar') 
                {
                    $qline = $field[$f] . " " . $type[$f] . ",";
                }
                else
                {
                    $qline = "nousar" . $f . " varchar(1),";
                };
                $querystart = $querystart . $qline;
            }
//            die($querystart.$queryend);
            $resultcr = mysql_query(rtrim($querystart,',') . $queryend) or die(mysql_error());
            $queryindex="ALTER TABLE temp ADD INDEX nc(cuenta(50));";
            mysql_query($queryindex) or die(mysql_error());
            $filename = str_replace("\\", "/", $filename);
            $quote='"';
            $queryload = "LOAD DATA LOCAL INFILE '" . $filename . "' INTO TABLE cobra4.temp FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '".$quote."' LINES TERMINATED BY '\n';";
            $resultload = mysql_query($queryload) or die(mysql_error());
            $queryfcont = "show fields from temp 
where field not regexp '^nousar'
and field <> 'cuenta';";
            $resultfcont = mysql_query($queryfcont) or die(mysql_error());
            $fieldlist = '';
            $sep = '';
            
            while ($answerfcont = mysql_fetch_row($resultfcont)) 
            {
                $fieldlist = $fieldlist . $sep . 'infextras.' . $answerfcont[0] . '=temp.' . $answerfcont[0];
                $sep = ',';
            }
            $ncr='';
            $ncr1='';
            $ncr2='';
            $queryioff="ALTER TABLE infextras DISABLE KEYS";
            $queryion="ALTER TABLE infextras ENABLE KEYS";
            //mysql_query($queryioff) or die(mysql_error());
            $queryupd2 = "UPDATE temp, infextras 
			SET " . $fieldlist . " 
            where temp.cuenta=infextras.cuenta;";
            $resultupd2 = mysql_query($queryupd2) or die(mysql_error());
            //die(htmlentities($queryupd2));
            
            echo "Old fields updated.";
            $queryfused = "show fields from temp where field not regexp 'nousar';";
            $resultfused = mysql_query($queryfused) or die(mysql_error());
            $fieldlist = '';
            $sep = '';
            
            while ($answerfused = mysql_fetch_row($resultfused)) 
            {
                $fieldlist = $fieldlist . $sep . $answerfused[0];
                $sep = ',';
            }
            $queryins = "insert into infextras (" . $fieldlist . ") select " . $fieldlist . " from temp 
            where cuenta+0>0 and not exists (
            select * from infextras 
            where temp.cuenta=infextras.cuenta);";
            //die(htmlentities($queryins));
            //            $queryins = "insert into infextras (" . $fieldlist . ") select " . $fieldlist . " from temp;";
            $resultins = mysql_query($queryins) or die(mysql_error());

       }
    }
}
}
mysql_close($con);
?>
