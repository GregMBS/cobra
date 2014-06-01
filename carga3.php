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
<form action="carga3.php" method="post" enctype="multipart/form-data" name="cargar">
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
<?php
            }
        }
        
        if (1==1) 
        {
?>
<p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="assoc">
<?php
//            $cliente = mysql_real_escape_string($_REQUEST['cliente']);
            
            if (1==1) 
            {
                $queryre = "truncate cargadex;";
                $resultre = mysql_query($queryre) or die(mysql_error());
            };
            $fecha_de_actualizacion = mysql_real_escape_string($_REQUEST['fecha_de_actualizacion']);
            $filename = $deststr;
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
            $querypdex = "select position from cargadex;";
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
                        $queryres = "show columns from resumen";
                        $resultres = mysql_query($queryres) or die(mysql_error());
                        $k = 0;
                        
                        while ($answerres = mysql_fetch_row($resultres)) 
                        {
?>
<option value='<?php echo $k ?>'<?php if ($data[$c]==$answerres[0]) {echo " selected='selected'";}?>><?php echo $answerres[0]; ?></option>
<?php
                            $k++;
                        }
                        $queryres = "show columns from infextras";
                        $resultres = mysql_query($queryres) or die(mysql_error());
                        
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
                $querydex = "select * from cargadex;";
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
            $fecha_de_actualizacion = mysql_real_escape_string($_REQUEST['fecha_de_actualizacion']);
            $filename = mysql_real_escape_string($_REQUEST['filename']);
            
            if (!empty($_REQUEST['pos0'])) 
            {
                $queryres = "show columns from resumen";
                $resultres = mysql_query($queryres) or die(mysql_error());
                $k = 0;
                
                while ($answerres = mysql_fetch_row($resultres)) 
                {
                    $field[$k] = $answerres[0];
                    $type[$k] = $answerres[1];
                    $nullok[$k] = $answerres[2];
                    $position[$k] = $k;
                    $table[$k] = 'resumen';
                    $k++;
                }
                 $queryres = "show columns from infextras";
                $resultres = mysql_query($queryres) or die(mysql_error());
                
                while ($answerres = mysql_fetch_row($resultres)) 
                {
                    $field[$k] = $answerres[0];
                    $type[$k] = $answerres[1];
                    $nullok[$k] = $answerres[2];
                    $position[$k] = $k;
                    $table[$k] = 'infextras';
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
                        $ntable = '';
                    }
                    else
                    {
                        $nfield = $field[$pos];
                        $ntype = $type[$pos];
                        $nnullok = $nullok[$pos];
                        $ntable = $table[$pos];
                        $nposition = $pos;
                    }
                    $queryins = "insert into cargadex (field,type,nullok,position,cliente,ktable) values ('$nfield','$ntype','$nnullok','$nposition','','$ntable');";
                    $resultins = mysql_query($queryins) or die(mysql_error());
                }
            }
            $querydrop = "DROP TABLE IF EXISTS `cobra`.`temp`;";
            $resultdrop = mysql_query($querydrop) or die(mysql_error());
            $querydex = "select position,field,type,ktable from cargadex;";
            $resultdex = mysql_query($querydex) or die(mysql_error());
            $c = 0;
            
            while ($answerdex = mysql_fetch_row($resultdex)) 
            {
                $field[$c] = $answerdex[1];
                $type[$c] = $answerdex[2];
                $table[$c] = $answerdex[3];
                $c++;
                set_time_limit(300);
            }
            $querystart = "CREATE TABLE  `cobra`.`temp` (";
            $queryend = "`fecha_de_actualizacion` date
) ENGINE=INNODB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";
            
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
            $resultcr = mysql_query($querystart . $queryend) or die(mysql_error());
            $queryindex="ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50));";
            mysql_query($queryindex) or die(mysql_error());
            $filename = str_replace("\\", "/", $filename);
            $quote='"';
            $queryload = "LOAD DATA LOCAL INFILE '" . $filename . "' INTO TABLE cobra.temp FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '".$quote."' LINES TERMINATED BY '\n';";
            $resultload = mysql_query($queryload) or die(mysql_error());
            $querycff = "UPDATE temp set fecha_de_actualizacion=curdate();";
            $resultcff = mysql_query($querycff) or die(mysql_error());
            $queryfcont = "show fields from temp 
where field not regexp '^nousar'
and field not regexp 'cuenta$';";
            $resultfcont = mysql_query($queryfcont) or die(mysql_error());
            $fieldlist = '';
            $fieldlist2 = '';
            $sep = '';
            $sep2 = '';
            
            while ($answerfcont = mysql_fetch_row($resultfcont)) 
            {
		$querytable="select ktable from cargadex where field='".$answerfcont[0]."' limit 1;";
		$resulttable=mysql_query($querytable) or die(mysql_error());
		while ($answertable = mysql_fetch_row($resulttable)) {$ktable=$answertable[0];}
			if ($ktable=='resumen') {
				$fieldlist=$fieldlist.$sep.'resumen.'.$answerfcont[0].'=temp.'.$answerfcont[0];
				$sep = ',';
				}
			if ($ktable=='infextras') {
				$fieldlist2=$fieldlist2.$sep2.'infextras.'.$answerfcont[0].'=temp.'.$answerfcont[0];
				$sep2 =',';
				}
                
            }
            $ncr='';
            $ncr1='';
            $ncr2='';
            $queryioff="ALTER TABLE resumen DISABLE KEYS";
            $queryion="ALTER TABLE resumen ENABLE KEYS";
            //mysql_query($queryioff) or die(mysql_error());
            $queryupd2 = "UPDATE temp, resumen 
	    use index (cligest)
            SET " . $fieldlist . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta;";
//            die(htmlentities($queryupd2));
            $resultupd2 = mysql_query($queryupd2) or die(mysql_error());
            $queryupd3 = "UPDATE temp, infextras 
            SET " . $fieldlist2 . " 
            where numero_de_cuenta=cuenta;";
//            die(htmlentities($queryupd3));
            $resultupd3 = mysql_query($queryupd3) or die(mysql_error());
            
            echo "Old fields updated.";
            $queryfused = "show fields from temp where field not regexp 'nousar';";
            $resultfused = mysql_query($queryfused) or die(mysql_error());
            $fieldlist = '';
            $fieldlist2 = '';
            $sep = '';
            $sep2 = '';
            
            while ($answerfused = mysql_fetch_row($resultfused)) 
            {
		$querytable="select ktable from cargadex where field='".$answerfused[0]."' limit 1;";
		$resulttable=mysql_query($querytable) or die(mysql_error());
		while ($answertable = mysql_fetch_row($resulttable)) {$ktable=$answertable[0];}
			if ($ktable=='resumen') {
				$fieldlist=$fieldlist.$sep.$answerfused[0];
				$sep = ',';
				}
			if ($ktable=='infextras') {
				$fieldlist2=$fieldlist2.$sep2.$answerfused[0];
				$sep2 =',';
				}
                $fieldlist = $fieldlist . $sep . $answerfused[0];
                $sep = ',';
            }
            $queryins = "insert into resumen (" . $fieldlist . ") select " . $fieldlist . " from temp 
            where numero_de_cuenta+0>0 and not exists (
            select * from resumen 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta);";
 //           die(htmlentities($queryins));
            $resultins = mysql_query($queryins) or die(mysql_error());
            $queryins2 = "insert into infextras (" . $fieldlist2 . ") select " . $fieldlist2 . " from temp 
            where numero_de_cuenta+0>0 and not exists (
            select * from infextras 
            where numero_de_cuenta=infextras.cuenta);";
            die(htmlentities($queryins2));
            $resultins2 = mysql_query($queryins2) or die(mysql_error());
            echo "New fields inserted.";
            $querykill = "update resumen  
            set status_de_credito=concat(status_de_credito,'-Liquidado') 
            where saldo_total=0 and status_de_credito not like '%do' and fecha_de_actualizacion=curdate()";
//            $resultkill = mysql_query($querykill) or die(mysql_error());
            $queryoverkill="UPDATE resumen 
            SET status_de_credito=REPLACE(status_de_credito,'o-Liquidado','o') 
            WHERE status_de_credito like '%o-Liquidado' and fecha_de_actualizacion=curdate();";
//            $resultoverkill = mysql_query($queryoverkill) or die(mysql_error());
            //mysql_query($queryioff) or die(mysql_error());
//            echo "Paid accounts inactivated.";
$querypagoins="insert into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select numero_de_cuenta, fecha_de_ultimo_pago, 
monto_ultimo_pago, cliente, c_cvge, 1, id_cuenta 
from resumen 
left join historia h1 on c_cont=id_cuenta and n_prom>0
where fecha_de_ultimo_pago>last_day(curdate() - INTERVAL 31 day) 
AND monto_ultimo_pago>0 
and (numero_de_cuenta,fecha_de_ultimo_pago,monto_ultimo_pago,cliente) 
not in (select cuenta,fecha,monto,cliente from pagos 
where confirmado=1) 
and not exists (select * from historia h2 
where h2.d_fech>h1.d_fech and h2.c_cont=h1.c_cont and h2.n_prom>0) 
and fecha_de_ultimo_pago<fecha_de_actualizacion 
group by id_cuenta,c_cvge having fecha_de_ultimo_pago>min(d_fech)";
mysql_query($querypagoins) or die(mysql_error());
            $queryrlist1="truncate cobra.rlook;";
            mysql_query($queryrlist1) or die(mysql_error());
            $queryrlist2="insert into cobra.rlook
select id_cuenta,numero_de_cuenta,nombre_deudor,cliente,status_de_credito,
nombre_referencia_1,nombre_referencia_2,nombre_referencia_3,nombre_referencia_4,
tel_1,tel_2,tel_3,tel_4,
tel_1_alterno,tel_2_alterno,tel_3_alterno,tel_4_alterno,
tel_1_verif,tel_2_verif,tel_3_verif,tel_4_verif,
tel_1_ref_1,tel_2_ref_1,
tel_1_ref_2,tel_2_ref_2,
tel_1_ref_3,tel_2_ref_3,
tel_1_ref_4,tel_2_ref_4,
tel_1_laboral,tel_2_laboral,telefonos_marcados
from cobra.resumen;
";
mysql_query($queryrlist2) or die(mysql_error());        }
    }
}
}
mysql_close($con);
?>
