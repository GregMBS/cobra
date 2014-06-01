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
            $queryu = "UPDATE nombres 
            SET completo='" . mysql_real_escape_string($_GET['completo']) . "',
            passw=sha('" . mysql_real_escape_string($_GET['passw']) . "'),
            tipo='" . mysql_real_escape_string($_GET['tipo']) . "' 
            WHERE usuaria='" . mysql_real_escape_string($_GET['usuaria']) . "'";
            $resultu = mysql_query($queryu) or die(mysql_error());
        }
        
        if ($go == "BORRAR") 
        {
            $nombre = mysql_real_escape_string($_GET['usuaria']);
            $queryb = "DELETE FROM nombres WHERE usuaria='" . $nombre . "'";
            $resultb = mysql_query($queryb) or die(mysql_error());
            $queryb2 = "DELETE FROM queuelist WHERE gestor='" . $nombre . "'";
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
	VALUES ('" . $usuaria . "','" . $iniciales . "','" . $completo . "',sha('" . $passw . "'),'" . $tipo . "','" . $camp . "')";
            $resultin = mysql_query($queryin) or die("nombre insert ".mysql_error());
            $querylistin = "INSERT INTO queuelist 
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc)  
            SELECT distinct '".$iniciales."',cliente,status_aarsa, updown1, orden1, 0, sdc 
            FROM queuelist where gestor in (select iniciales from nombres where tipo='callcenter');";
            $resultlistin = mysql_query($querylistin) or die("queuelist insert ".mysql_error());
            $querylistcamp = "update queuelist 
            set camp=auto where gestor = '".$iniciales."';";
            $resultlistcamp = mysql_query($querylistcamp) or die("queuelist numbering ".mysql_error());
            header("Location: gestoradmin.php?capt=".$capt);
        }
    }
    $querymain = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales <> 'gmbs'
    order by TIPO, USUARIA";
    $result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administraci&oacute;n de las cuentas de los gestores</title>
<title>COBRA - Cambio de Status</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
<style>
	tr:hover {background-color: yellow;}
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary="Gestores" class="ui-widget">
<thead class="ui-widget-header">
<tr>
<form action="gestoradmin.php" method="get" name="migoorden">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<th>Gestor</a></th>
<th>Completo</a></th>
<th>Contrase&ntilde;a</a></th>
<th>Tipo</a></th>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
    $j = 0;
    
    while ($row = mysql_fetch_row($result)) 
    {
        $j = $j + 1;
        $usuaria = $row[0];
        $completo = $row[1];
        $tipo = $row[2];
        $camp = $row[3];
        $gestor = $row[4];
        $passw = $row[5];
?>
<tr>
<form class="gestorchange" name="gestorchange<?php echo $j ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestorchange<?php echo $j ?>">
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
<form class="gestoradd" name="gestoradd" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestoradd">
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
