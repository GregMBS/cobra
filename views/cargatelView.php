<!DOCTYPE HTML>

<html lang="es">
    <head>
        <title>ROBOT Carga</title>
        <style>
            body {background-color:blue;}
            .num {text-align:right}
            textarea,select,option {background-color:white;}
            form {margin-left:auto;margin-right:auto;}
            p {background-color:gray;}
        </style>
    </head>
    <body>
        <form action="/cargatel.php?capt=<?php if (isset($capt)) {
            echo $capt;
        } ?>" method="post" name="cargar">
            <label>Usa formato CUENTA,TELE
            <textarea name='data' rows='20' cols='50'></textarea></label>
            <label>Mensaje <select name="msgtag">
                    <?php
                    /** @var $msgList */
                    foreach ($msgList as $msg) {
                        ?>
                        <option value="<?php echo $msg['client'] . ',' . $msg['tipo']; ?>" style="font-size:120%;">
                            <?php echo $msg['client'] . ',' . $msg['tipo']; ?></option>
                        <?php }
                        ?>
                </select>
            </label>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>

    </form>
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
</body>
</html>
