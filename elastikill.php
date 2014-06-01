<?php  
include('admin_hdr_2.php');
$i=0;
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {mysql_close();}
else {
$cliente=mysql_real_escape_string($_GET['cliente']);
$nombre_deudor=mysql_real_escape_string($_GET['nombre_deudor']);
$cuenta=mysql_real_escape_string($_GET['cuenta']);
$numero_de_cuenta=mysql_real_escape_string($_GET['numero_de_cuenta']);
$id=mysql_real_escape_string($_GET['id']);
$tel=mysql_real_escape_string($_GET['tel']);
mysql_close();
$host = "192.168.1.60:13306";
$user = "root";
$pswd = "eLaStIx.2oo7";
$db = "call_center";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
if (!empty($_GET['go'])) {
$queryt="truncate killem;";
mysql_query($queryt);
$wherestring=" columna='tt' and length(value)>12;";
if (!empty($nombre_deudor)) {
$wherestring=" columna='nombre_deudor' and value='".$nombre_deudor."';";
}
if (!empty($id)) {
$wherestring=" columna='numero_de_cuenta' and value='".$id."';";
}
if (!empty($tel)) {
$wherestring=" columna='tt' and value='".$tel."';";
}
$queryload="insert into killem select id_call from call_attribute WHERE ".$wherestring;
mysql_query($queryload);
$queryfire1="delete from call_attribute where id_call in (select * from killem);";
mysql_query($queryfire1);
$queryfire2="delete from calls where id in (select * from killem) and start_time is null;";
mysql_query($queryfire2);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Elastix Edit</title>
<script type="text/javascript">

function fill(field,thisValue) {
   var x=document.getElementById("quitar")
for (var i=0;i<x.length;i++)
  {if (x.elements[i].id==field) {
        x.elements[i].value=thisValue;}
        }
    }

function lookup(field){
    var ajaxRequest;  // The variable that makes Ajax possible!
    var fields=field+"s";	
    var fieldl=fields+"List";
    var box=document.getElementById('list');
    while (box.firstChild) 
 {
    //The list is LIVE so it will re-index each call
    box.removeChild(box.firstChild);
 };	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
   var out=ajaxRequest.responseText;
   box.innerHTML=out;
    }
	}
switch(field)
{
case "tel":
  var find = document.getElementById('tel').value;
  break;
case "id":
  var find = document.getElementById('id').value;
  break;
case "cliente":
  var find = document.getElementById('cliente').value;
  break;
case "nombre_deudor":
  var find = document.getElementById('nombre_deudor').value;
  break;
default:
  var find = document.getElementById('tel').value;
}	
	var queryString = "?capt=<?php echo $capt;?>&field=" + field + "&find=" + find;
	ajaxRequest.open("GET", "getrobot.php" + queryString, true);
	ajaxRequest.send(null); 
}


</script></head>
<body>
<?php if (!empty($_GET['go'])) {?>
<p>Llamadas estan quitado</p>
<?php } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form id="quitar" name="quitar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<p>Cliente <input type='text' name='cliente' id='cliente' value='<?php echo $cliente;?>' onkeyup="lookup('cliente');">
</p>
<p>Nombre <input type='text' name='nombre_deudor' id='nombre_deudor' value='<?php echo $nombre_deudor;?>' onkeyup="lookup('nombre_deudor');">
</p>
<p>Cuenta <input type='text' name='id' id='id' value='<?php echo $id;?>' onkeyup="lookup('id');">
</p>
<p>Tel&eacute;fono <input type='text' name='tel' id='tel' value='<?php echo $tel;?>' onkeyup="lookup('tel');">
</p>
<p id='list'>
</p>
<input type="hidden" name="capt" value="<?php echo $capt ?>" />
<input type="submit" name="go" value="quitar" />
</form>
</body>
</html>
<?php
}
}
mysql_close()
?>
