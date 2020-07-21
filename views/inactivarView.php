<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Inactivar Cuentas</title>
    </head>
    <body>
        <form action="/inactivar.php?capt=<?php echo $capt; ?>" method="post" name="cargar">
            <label>Usa numero de cuenta
            <textarea name='data' rows='20' cols='50'></textarea></label>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>
    </form>
    <?php echo $msg; ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
        Regresar a la plantilla administrativa
    </button><br>
</body>
</html>
