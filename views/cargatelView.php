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
        <form action="/cargatel.php?capt=<?php echo $capt; ?>" method="post" name="cargar">
            <p>Usa formato CUENTA,TELE</p>
            <textarea name='data' rows='20' cols='50'></textarea>
            <p>Mensaje <select name="msgtag">
                    <?php
                    foreach ($resultcl as $answercl) {
                        ?>
                        <option value="<?php echo $answercl['client'] . ',' . $answercl['tipo']; ?>" style="font-size:120%;">
                            <?php echo $answercl['client'] . ',' . $answercl['tipo']; ?></option>
                        <?php }
                        ?>
                </select>
            </p>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>
        </p>
    </form>
    <?php
    echo $msg;
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
</body>
</html>
