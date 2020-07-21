<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>Activar Cuentas</title>
</head>
<body>
<form action="/activar.php?capt=<?php echo $capt; ?>" method="post" name="cargar">
    <label for="data">Usa numero de cuenta</label>
    <textarea name='data' id='data' rows='20' cols='50'></textarea>
    <input type="hidden" name="capt" value="<?php
    echo $capt
    ?>"/>
    <button type="submit" name="go" value="cargar">Cargar</button>
</form>
<?php echo $msg; ?>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
    Regresar a la plantilla administrativa
</button>
<br>
</body>
</html>
