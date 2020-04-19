<!DOCTYPE HTML>

<html>
    <head>
        <title>Queue Manual</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
    </head>
    <body>
        <form action="/queuemanual.php" method="post" name="cargar">
            <p>Usa formato CUENTA,CUENTA,CUENTA,...</p>
            <label for="clientea">CLIENTE PARA CARGAR</label>
            <select name="clientea" id="cliente">
                <?php
                foreach ($clientes as $row) {
                    ?>
                    <option value="<?php echo $row['cliente']; ?>"><?php echo $row['cliente']; ?></option>
                <?php } ?>
            </select><br>
            <textarea name='data' rows='20' cols='50'></textarea>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" /><br>
            <button type="submit" name="go" value="cargar">Cargar</button>
            <hr>
            <p>BORRAR QUEUE MANUAL (opcional)</p>
            <button type="submit" name="go" value="borrar">Borrar</button>
        </form>
    <?php
    if ($go == 'borrar') {
        ?>
        <p>Queue MANUAL borrado.</p>
        <?php
    }
    if ($go == 'cargar') {
        ?>
        <p>Queue MANUAL cargado</p>
        <?php
    }
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
</body>
</html>
