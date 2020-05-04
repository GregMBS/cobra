<!DOCTYPE HTML>

<html lang='es'>
    <head>
        <title>ROBOT Carga</title>
        <style>
            body {background-color:blue;}
            textarea,select,option {background-color:white;}
            form {margin-left:auto;margin-right:auto;}
            p {background-color:gray;}
        </style>
    </head>
    <body>
        <form action="/cargatel.php?capt=<?php echo $capt; ?>" method="post" name="cargar">
            <p><label for="data">Usa formato CUENTA,TELE</label></p>
            <textarea id='data' name='data' rows='20' cols='50'></textarea>
            <p><label for="msgtag">Mensaje </label><select id="msgtag" name="msgtag">
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
        </form>
    <?php
    echo $msg;
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
</body>
</html>
