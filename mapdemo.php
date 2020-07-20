<?php
$lat=$_REQUEST['lat'];
if (empty($lat)) {$lat=30;}
$long=$_REQUEST['long'];
if (empty($long)) {$long=90;}
$zoom=$_REQUEST['zoom'];
if (empty($zoom)) {$zoom=13;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>Maps DEMO</title>
</head>
<body>
<p>
<form action='#' method='get'>
lat<input type='text' name='lat'><?php echo $lat;?><br>
long<input type='text' name='long'><?php echo $long;?><br>
zoom<input type='text' name='zoom'><?php echo $zoom;?><br>
<input type='submit'>
</form>
</p>
<img src="http://maps.google.com/maps/api/staticmap?zoom=<?php echo $zoom;?>
&size=512x512&maptype=roadmap
&center=<?php echo $lat;?>,-<?php echo $long;?>
&markers=color:blue|<?php echo $lat;?>,-<?php echo $long;?>&sensor=false" >
</body>
</html>

