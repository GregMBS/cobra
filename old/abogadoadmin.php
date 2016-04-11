<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        
        if ($go == "GUARDAR") 
        {
            $queryu = "UPDATE abogados 
            SET completo='" . mysql_real_escape_string($_GET['completo']) . "',
            passw='" . mysql_real_escape_string($_GET['passw']) . "',
            tipo='" . mysql_real_escape_string($_GET['tipo']) . "' 
            WHERE usuaria='" . mysql_real_escape_string($_GET['usuaria']) . "'";
            $resultu = mysql_query($queryu) or die(mysql_error());
        }
        
        if ($go == "BORRAR") 
        {
            $nombre = mysql_real_escape_string($_GET['usuaria']);
            $queryb = "DELETE FROM nombres WHERE usuaria='" . $nombre . "'";
            $resultb = mysql_query($queryb) or die(mysql_error());
            $queryb2 = "DELETE FROM queuelist WHERE abogado='" . $nombre . "'";
            $resultb2 = mysql_query($queryb2) or die(mysql_error());
            $queryb3 = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig' 
            WHERE ejecutivo_asignado_call_center='" . $nombre . "'";
            $resultb3 = mysql_query($queryb3) or die(mysql_error());
        }
        
        if ($go == "AGREGAR") 
        {
            $usuaria = mysql_real_escape_string($_GET['usuaria']);
            $completo = mysql_real_escape_string($_GET['completo']);
            $tipo = mysql_real_escape_string($_GET['tipo']);
            $passw = mysql_real_escape_string($_GET['passw']);
            $iniciales = strtolower($usuaria);
            $queryin = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW, 
            TIPO, CAMP) 
	VALUES ('" . $usuaria . "','" . $iniciales . "','" . $completo . "','" . $passw . "','" . $tipo . "','" . $camp . "')";
            $resultin = mysql_query($queryin) or die("nombre insert ".mysql_error());
            $querylistin = "INSERT INTO queuelist 
            (abogado, cliente, status_aarsa, updown1, orden1, camp, sdc)  
            SELECT distinct '".$iniciales."',cliente,status_aarsa, updown1, orden1, 0, sdc 
            FROM queuelist where abogado in (select iniciales from nombres where tipo='callcenter');";
            $resultlistin = mysql_query($querylistin) or die("queuelist insert ".mysql_error());
            $querylistcamp = "update queuelist 
            set camp=auto where abogado = '".$iniciales."';";
            $resultlistcamp = mysql_query($querylistcamp) or die("queuelist numbering ".mysql_error());
            header("Location: abogadoadmin.php?capt=".$capt);
        }
	}
    $querymain = "SELECT id, nombre, email, telefono, nextel, celular 
    FROM judicial.Abogado order by id";
    $result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administraci&oacute;n de las cuentas de los abogadoes</title>

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
<table summary="abogadoes">
<thead>
<tr>
<form action="abogadoadmin.php" method="get" name="migoorden">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
			<th>id</th> 
			<th>nombre</th> 
			<th>email</th> 
			<th>telefono</th> 
			<th>nextel</th> 
			<th>celular</th> 
</tr>
</thead>
<tbody>
<?php
    $j = 0;
    
    while ($row = mysql_fetch_row($result)) 
    {
        $j = $j + 1;
        $id = $row[0];
        $nombre = $row[1];
        $email = $row[2];
        $telefono = $row[3];
        $nextel = $row[4];
        $celular = $row[5];
?>
<tr>
<form class="abogadochange" name="abogadochange<?php echo $j ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="abogadochange<?php echo $j ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="j" value="<?php echo $j ?>"> 
<td><input type="text" name="usuaria" readonly="readonly" value="<?php echo $usuaria; ?>" /></td>
<td><input type="text" name="completo" value="<?php echo $completo; ?>" /></td>
<td><input type="password" name="passw" value="<?php echo $passw; ?>" /></td>
<td>
<select name="tipo">
<option value=""></option>
<?php
        $queryti = "SELECT grupo FROM grupos";
        $resultti = mysql_query($queryti);
        
        while ($answerti = mysql_fetch_array($resultti)) 
        { ?>
  <option value="<?php 
            if (isset($answerti[0])) 
            {
                echo $answerti[0];
            } ?>" style="font-size:120%;" <?php 
            if (strtolower($answerti[0]) == strtolower($tipo)) 
            {
                echo "selected='selected'";
            } ?>>
	<?php 
            if (isset($answerti[0])) 
            {
                echo $answerti[0];
            } ?></option>
<?php
        } ?>
</select></td>
<td><input type="submit" name="go" value="GUARDAR">
</td>
<td><input type="submit" name="go" value="BORRAR">
</td>
</form>
</tr>
<?php
    } ?>
<tr>
<form class="abogadoadd" name="abogadoadd" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="abogadoadd">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<td><input type="text" name="usuaria"  value="" /></td>
<td><input type="text" name="completo" value="" /></td>
<td><input type="password" name="passw" value="" /></td>
<td>
<select name="tipo">
<option value=""></option>
<?php
    $queryti = "SELECT grupo FROM grupos";
    $resultti = mysql_query($queryti);
    
    while ($answerti = mysql_fetch_array($resultti)) 
    { ?>
  <option value="<?php 
        if (isset($answerti[0])) 
        {
            echo $answerti[0];
        } ?>" style="font-size:120%;">
	<?php 
        if (isset($answerti[0])) 
        {
            echo $answerti[0];
        } ?></option>
<?php
    } ?>
</select></td>
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
