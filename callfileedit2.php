<?php  
include('admin_hdr_2.php');
$i=0;
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (!empty($_GET['go'])) {
$wherestr='';
$wherestr2='';
$cliente=mysql_real_escape_string($_GET['cliente']);
$wherestring=$wherestring.' msg IN (select msg from robot.msglist where client="'.$cliente.'")';
$wherestring2=$wherestring2.' cliente="'.$cliente.'")';
$nombre=mysql_real_escape_string($_GET['nombre']);
if (!empty($nombre)) {
$wherestring=$wherestring.' AND id IN (select numero_de_cuenta from cobra4.resumen where nombre_deudor="'.$nombre.'")';
$wherestring2=$wherestring2.' AND nombre_deudor="'.$nombre.'"';
}
$cuenta=mysql_real_escape_string($_GET['cuenta']);
if (!empty($cuenta)) {
$wherestring=$wherestring.' AND id = "'.$cuenta.'"';
$wherestring2=$wherestring2.' AND numero_de_cuenta = "'.$cuenta.'"';
}
$tel=mysql_real_escape_string($_GET['tel']);
if (!empty($tel)) {$wherestring=$wherestring.' AND tel="'.$tel.'"';}
$querydel="DELETE FROM robot.calllist WHERE ".$wherestring;
mysql_query($querydel);
$querydel2="update cobra4.resumen set norobot=1 WHERE ".$wherestring;
mysql_query($querydel2);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>ROBOT Edit</title>
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
   var tout=ajaxRequest.responseText;
    parser=new DOMParser();
  out=parser.parseFromString(tout,"text/xml");
  x=out.getElementsByTagName("field");
  for (var i = 0; i < x.length; i++) {   
    text=x[i].childNodes[0].nodeValue;     
    newel=document.createElement('option');
    newtext=document.createTextNode(text);
    newel.appendChild(newtext);
    newel.setAttribute("onmousedown","fill('"+field+"','"+text+"');");
    box.appendChild(newel);
    out.removeChild(out.firstChild);
 };	

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
	ajaxRequest.open("GET", "getrobot2.php" + queryString, true);
	ajaxRequest.send(null); 
}


</script></head>
<body>
<?php if (!empty($_GET['go'])) {?>
<p>Llamadas estan quitado</p>
<?php } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form id="quitar" name="quitar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<p>Cliente <input type='text' name='cliente' id='cliente' onkeyup="lookup('cliente');">
</p>
<p>Nombre <input type='text' name='nombre_deudor' id='nombre_deudor' onkeyup="lookup('nombre_deudor');">
</p>
<p>Cuenta <input type='text' name='id' id='id' onkeyup="lookup('id');">
</p>
<p>Tel&eacute;fono <input type='text' name='tel' id='tel' onkeyup="lookup('tel');">
</p>
<select id='list'>
<option>vacio</option>
</select>
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
