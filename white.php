<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Directorio</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div>
            <form action='whitesearch.php' method='get'>
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <input type="hidden" name="go" value="BUSCAR">
                <label for="nombre">Nombre</label>
                <input type='text' name='nombre' id="nombre" value=''><br>
                <label for="tel">Teléfono</label>
                <input type='text' name='tel' id='tel' value=''><br>
                <label for="calle">Calle</label>
                <input type='text' name='calle' id='calle' value=''><br>
                <label for="colonia">Colonia</label>
                <input type='text' name='colonia' id='colonia' value=''><br>
                <label for="ciudad">Ciudad</label>
                <input type='text' name='ciudad' id='ciudad' value=''><br>
                <label for="estado">Estado</label>
                <input type='text' name='estado' id='estado' value=''><br>
                <label for="cp">CP</label>
                <input type='text' name='cp' id='cp' value=""><br>
                <input type="submit" value="BUSCAR">
                <a href="javascript:window.location='white.php?capt=<?php echo $capt ?>';">CLARO</a>
            </form>
        </div>
    </body>
</html> 
