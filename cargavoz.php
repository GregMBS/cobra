<?php
include('admin_hdr_2.php');
if (!empty($_GET['capt'])) 
{
    $capt = mysql_real_escape_string($_GET['capt']);
}

if (!empty($_POST['capt'])) 
{
    $capt = mysql_real_escape_string($_POST['capt']);
}
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>COBRA Carga</title>
<style type='text/css'>
td {border:black 1pt solid;;border-collapse: collapse;}
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary='List_messages'>
<tr>
<th>Cliente</th>
<th>Tipo</th>
</tr>
<?php 
$querylist="SELECT client,tipo FROM robot.msglist ORDER BY client,tipo";
$resultlist = mysql_query($querylist);
while ($answerlist = mysql_fetch_array($resultlist))
{ 
?>
<tr>
<td><?php echo $answerlist[0]; ?></td>
<td><?php echo $answerlist[1]; ?></td>
</tr>
<?php } ?>
</table>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
enctype="multipart/form-data" name="cargar">
<p>Filename:
<input type="file" name="file" id="file"><br>
<input type="hidden" name="capt" value="<?php
    echo $capt
?>" />
<button type="submit" name="go" value="cargar">Elegir archivo</button>
</p>
</form>
<?php
    
    if (!empty($_POST['go'])) 
    {
        
        if ($_POST['go'] == 'cargar') 
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
                $deststr = "/tmp/soundfile.wav";
                move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
                echo "Stored in: " . $deststr . "</p>";
?>
<p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="clientepick">
<table summary="Eligir cliente y descripcion">
<tr><td>Client</td>
<td>
<select name='cliente'>
<?php
    $querycl = "SELECT cliente FROM cobra4.clientes;";
    $resultcl = mysql_query($querycl);
    while ($answercl = mysql_fetch_array($resultcl)) 
    {?>
  <option value="<?php echo $answercl[0];?>" style="font-size:120%;">
  <?php echo $answercl[0];?></option>
<?php
    } ?>
</select>
<input type="hidden" name="filename" value="/tmp/soundfile.wav" />
<input type="hidden" name="capt" value="<?php
                echo $capt
?>" />
</td></tr>
<tr><td>Descripci&oacute;n</td>
<td><input type="text" name="describe" value="" />
</td></tr>
<tr><td>Reemplazar lo anterior <input type="checkbox" name="reemplazar" id="reemplazar"></td></tr>
</table>
<button type="submit" name="go" value="guardar">Guardar</button>
</form>
<?php
            }
            }
        }
        
        if ($_POST['go'] == 'guardar') 
        {
?>
<p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="assoc">
<?php
            $cliente = mysql_real_escape_string($_POST['cliente']);
            $tipo = mysql_real_escape_string($_POST['describe']);
            $filename_local = '/home/gmbs/'.$cliente.'-'.$tipo.'.rmd';
            $filename = '/home/gmbs/'.$cliente.'-'.$tipo.'.rmd';
            exec('touch '.$filename);
            exec('sox -v 0.8 /tmp/soundfile.wav -r 8000 -c 1 /tmp/soundfile2.wav');
            exec('wavtopvf -16 /tmp/soundfile2.wav /tmp/soundfile.pvf');
            exec('pvftormd V253modem 6 /tmp/soundfile.pvf '.$filename);
            
      // Print results
      print "Thank you, your file has been uploaded.";
            if (!empty($_POST['reemplazar'])) 
            {
                $queryre = "delete from robot.msglist 
                where client='" . $cliente . "'
                and tipo='".$tipo."' 
                ;";
                $resultre = mysql_query($queryre) or die(mysql_error());
            };
            $queryins = "insert into robot.msglist (client,msg,tipo) values ('$cliente','$filename_local','$tipo');";
            $resultins = mysql_query($queryins) or die(mysql_error());
            }
}
}
mysql_close($con);
?>
