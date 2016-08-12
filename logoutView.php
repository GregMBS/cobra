<!DOCTYPE html>
<html>
    <head>
	<title>LOGOUT de CobraMas</title>
	<link href="public/bower_resources/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="public/bower_resources/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="public/bower_resources/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
	<h1>CobraMas - LOGOUT</h1>
	<div class="forma">
	    <form action='logout.php' method='get'>
		<input type='hidden' name='capt' value='<?php echo $capt ?>'>
		<button name='gone' value='Bano'>BA&Ntilde;O</button><br>
		<button name='gone' value='Junta'>JUNTA</button><br>
		<button name='gone' value='Break'>BREAK</button><br>
		<button name='gone' value='Salir'>SALIR</button><br>
	    </form>
	</div>
	<div class="logo">
	</div>
    </body>
</html>
