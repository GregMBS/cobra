<?php
use app\PdoClass;
$pc      = new PdoClass();
$pdo     = $pc->dbConnectUser();
$sistema = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
$capt    = filter_input(INPUT_GET, 'capt');
$usuario = $capt;
$get     = filter_input_array(INPUT_GET);
$go      = $get['go'];
if ($go == 'ENVIAR') {
    $fechahora   = date('Y-m-d H:i:s');
    $fuente      = $get['fuente'];
    $descripcion = $get['descripcion'];
    $error_msg   = $get['error_msg'];
    $queryins    = "INSERT INTO trouble (sistema,usuario,fechahora,fuente,descripcion,error_msg)
VALUES (:sistema, :usuario, now(), :fuente, :descripcion, :error_msg)";
    $sti         = $pdo->prepare($queryins);
    $sti->bindParam(':sistema', $sistema);
    $sti->bindParam(':usuario', $usuario);
    $sti->bindParam(':fuente', $fuente);
    $sti->bindParam(':descripcion', $descripcion);
    $sti->bindParam(':error_msg', $error_msg);
    $sti->execute();
    $message     = 'Error en '.$fuente.' de sistema '.$sistema.' y usuario '.$usuario.' enviado '.$fechahora;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA Trouble</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
<?php if ($go == 'ENVIAR') { ?>
                alert('<?php echo $message; ?>');
<?php } ?>
        </SCRIPT>
    </head>
    <body>
        <form action="trouble.php" method="get" name="trouble">
            <span class="formcap">Fuente de problema</span><select name='fuente'>
                <option value='COBRA'>COBRA</option>
                <option value='EKIGA'>EKIGA</option>
                <option value='ELASTIX'>ELASTIX</option>
                <option value='DIADEMA'>DIADEMA</option>
                <option value='COMPUTADORA'>COMPUTADORA</option>
                <option value='MONITOR'>MONITOR</option>
                <option value='TECLADO'>TECLADO</option>
                <option value='RATON'>RATON</option>
                <option value='otro'>otro</option>
            </select>
            <br>
            <span class="formcap">Descripción</span><textarea rows="6" cols="60" name="descripcion">Cuando yo:

        Veo:

        Sin embargo, espero:

            </textarea><br>
            <span class="formcap">Error mensajes (texto <em>EXACTO</em>)</span><textarea rows="2" cols="40" name="error_msg"></textarea><br>
            <input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $get['C_CONT']; ?> /><br>
            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="submit" name="go" value="ENVIAR">
        </form>
        <button onClick='window.close()'>CIERRA</button>
    </body>
</html>
