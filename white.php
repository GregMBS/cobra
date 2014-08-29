<?php
require_once 'pdo_connect.php'; // returns $pdo
require_once 'userCheckClass.php';
$capt        = filter_input(INPUT_GET, 'capt');
$uc          = new userCheckClass($pdo);
$mytipo      = $uc->userCheck();
$queryswitch = "USE dnt";
$pdo->query($queryswitch);
$go          = filter_input(INPUT_GET, 'go');
$find        = '';
if ($go == 'FROMBUSCAR') {
    $find = filter_input(INPUT_GET, 'find');
}
$querymain = "SELECT tel, nombre_deudor, cp_deudor, domicilio_deudor, "
    ."colonia_deudor, ciudad_deudor, estado_deudor "
    ."FROM gray "
    ."WHERE tel = :find "
    ."LIMIT 1";
$stm       = $pdo->prepare($querymain);
$stm->bindParam(':find', $find);
$stm->execute();
$result    = $stm->fetch(PDO::FETCH_ASSOC);
$tel       = $row['tel'];
$nombre    = $row['nombre_deudor'];
$cp        = $row['cp_deudor'];
$calle     = $row['domicilio_deudor'];
$colonia   = $row['colonia_deudor'];
$ciudad    = $row['ciudad_deudor'];
$estado    = $row['estado_deudor'];
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
                <input type='text' name='nombre' id="nombre" value='<?php echo $nombre; ?>'><br>
                <label for="tel">Teléfono</label>
                <input type='text' name='tel' id='tel' value='<?php echo $tel; ?>'><br>
                <label for="calle">Calle</label>
                <input type='text' name='calle' id='calle' value='<?php echo $calle; ?>'><br>
                <label for="colonia">Colonia</label>
                <input type='text' name='colonia' id='colonia' value='<?php echo $colonia; ?>'><br>
                <label for="ciudad">Ciudad</label>
                <input type='text' name='ciudad' id='ciudad' value='<?php echo $ciudad; ?>'><br>
                <label for="estado">Estado</label>
                <input type='text' name='estado' id='estado' value='<?php echo $estado; ?>'><br>
                <label for="cp">CP</label>
                <input type='text' name='cp' id='cp' value='<?php echo $cp; ?>'><br>
                <input type="submit" value="BUSCAR">
                <a href="javascript:window.location='white.php?capt=<?php echo $capt ?>';">CLARO</a>
            </form>
        </div>
    </body>
</html> 
