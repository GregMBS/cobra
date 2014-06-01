<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    if (!empty($_REQUEST['go'])) 
    {
        $go = mysql_real_escape_string($_REQUEST['go']);
        $tipo=mysql_real_escape_string($_REQUEST['tipo']);
        $auto=mysql_real_escape_string($_REQUEST['auto']);
        $gestor=mysql_real_escape_string($_REQUEST['gestor']);
        $empieza=mysql_real_escape_string($_REQUEST['ehora']).':'.mysql_real_escape_string($_REQUEST['emin']).':00';
        $termina=mysql_real_escape_string($_REQUEST['thora']).':'.mysql_real_escape_string($_REQUEST['tmin']).':00';

        if ($go == "CAMBIAR") 
        {
        $queryu = "UPDATE breaks 
            SET tipo='" . $tipo . "',
            empieza='" . $empieza . "',
            termina='" . $termina . "',
            tipo='" . $tipo . "' 
            WHERE auto='" . $auto . "'";
            $resultu = mysql_query($queryu) or die(mysql_error());
        }
        
        if ($go == "BORRAR") 
        {
            $queryb = "DELETE FROM breaks WHERE auto='" . $auto . "'";
            $resultb = mysql_query($queryb) or die(mysql_error());
        }
        
        if ($go == "AGREGAR") 
        {
            $queryin = "INSERT INTO breaks (gestor, tipo, empieza, termina) 
	VALUES ('" . $gestor . "','" . $tipo . "','" . $empieza . "','" . $termina . "')";
            $resultin = mysql_query($queryin) or die(mysql_error());
        }
    }
    $querymain = "SELECT auto, gestor, tipo, empieza, termina FROM breaks 
    order by gestor,empieza";
    $result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administraci&oacute;n de breaks</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary="Gestores">
<thead>
<tr>
<form action="breakadmin.php" method="get" name="migoorden">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<th>Gestor</a></th>
<th>Tipo</a></th>
<th>Empieza</a></th>
<th>Termina</a></th>
</tr>
</thead>
<tbody>
<?php
    while ($row = mysql_fetch_row($result)) 
    {
        $auto = $row[0];
        $gestor = $row[1];
        $tipo = $row[2];
        $empieza = $row[3];
        $termina = $row[4];
?>
<tr>
<form class="gestorchange" name="gestorchange<?php echo $auto ?>" method="get" action=
"breakadmin.php" id="gestorchange<?php echo $auto ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="auto" value="<?php echo $auto ?>"> 
<td>
<input type="text" name="gestor" readonly=readonly value="<?php echo $gestor;?>"><br>
</td>
<td>
<?php echo $tipo;?><br>
<select name="tipo">
<option value=""></option>
<option value="break"<?php if ($tipo=='break') {echo " selected='selected'";} ?>>break (30 min)</option>
<option value="bano"<?php if ($tipo=='bano') {echo " selected='selected'";} ?>>baño (10 min)</option>
</select>
</td>
<td>
<?php echo $empieza;?><br>
<select name="ehora">
<?php for ($i=0;$i<24;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
:
<select name="emin">
<?php for ($i=0;$i<60;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
</td>
<td>
<?php echo $termina;?><br>
<select name="thora">
<?php for ($i=0;$i<24;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
:
<select name="tmin">
<?php for ($i=0;$i<60;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
</td>
<td><input type="submit" name="go" value="CAMBIAR">
</td>
<td><input type="submit" name="go" value="BORRAR">
</td>
</form>
</tr>
<?php
    } ?>
<tr>
<form class="gestoradd" name="gestoradd" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestoradd">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<td>
<select name="gestor">
<option value=""></option>
<?php
        $queryti = "SELECT iniciales FROM nombres WHERE tipo<>'admin' and tipo <>'visitador' order by iniciales";
        $resultti = mysql_query($queryti);
        
        while ($answerti = mysql_fetch_array($resultti)) 
        { ?>
  <option value="<?php 
            if (isset($answerti[0])) 
            {
                echo $answerti[0];
            } ?>" style="font-size:120%;" >
	<?php 
            if (isset($answerti[0])) 
            {
                echo $answerti[0];
            } ?></option>
<?php
        } ?>
</select>

</td>
<td>
<select name="tipo">
<option value=""></option>
<option value="break">break (30 min)</option>
<option value="bano">baño (10 min)</option>
</select>
</td>
<td>
<select name="ehora">
<?php for ($i=0;$i<24;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
:
<select name="emin">
<?php for ($i=0;$i<60;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
</td>
<td>
<select name="thora">
<?php for ($i=0;$i<24;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
:
<select name="tmin">
<?php for ($i=0;$i<60;$i++) { ?>
<option value='<?php echo sprintf("%02d",$i);?>'><?php echo sprintf("%02d",$i);?></option>
<?php } ?>
</select>
</td>
<td><input type="submit" name="go" value="AGREGAR">
</td>
</form>
</tr>
</tbody>
</table>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
