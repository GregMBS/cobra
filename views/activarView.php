<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>Activar Cuentas</title>
</head>
<body>
<form action="/activar.php?capt=<?php
/** @var string $capt */
echo $capt;
?>" method="post" name="cargar">
    <label for="data">Usa numero de cuenta</label>
    <textarea name='data' id='data' rows='20' cols='50'></textarea>
    <input type="hidden" name="capt" value="<?php
    echo $capt
    ?>"/>
    <button type="submit" name="go" value="cargar">Cargar</button>
</form>
<?php
if (isset($msg)) {
    echo $msg;
}
?>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
    Regresar a la pagina administrativa
</button>
<br>
</body>
</html>
