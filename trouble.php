<?php
require_once 'pdoConnect.php';
$pdoc    = new pdoConnect();
$pdo     = $pdoc->dbConnectUser();
$capt    = filter_input(INPUT_GET, 'capt');
$sistema = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
$get     = filter_input_array(INPUT_GET);
$go      = filter_input(INPUT_GET, 'go');
if ($go == 'ENVIAR') {
    $fechahora   = date('Y-m-d H:i:s');
    $fuente      = filter_input(INPUT_GET, 'fuente');
    $descripcion = filter_input(INPUT_GET, 'descripcion');
    $error_msg   = filter_input(INPUT_GET, 'error_msg');
    $queryins    = "INSERT INTO cobra.trouble (sistema,usuario,fechahora,fuente,descripcion,error_msg)
VALUES (:sistema, :capt, now(), :fuente, :descripcion, :error_msg)";
    $sti         = $pdo->prepare($queryins);
    $sti->bindParam(':sistema', $sistema);
    $sti->bindParam(':capt', $capt);
    $sti->bindParam(':fuente', $fuente);
    $sti->bindParam(':descripcion', $descripcion);
    $sti->bindParam(':error_msg', $error_msg);
    $sti->exeute();
    $message     = 'Error en '.$fuente.' de sistema '.$sistema.' y usuario '.$usuario.' enviado '.$fechahora;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA Trouble</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="vendor/components/jquery/jquery,js" type="text/javascript"></script>
        <script src="vendor/components/jqueryui/jquery-ui,js" type="text/javascript"></script>
        <SCRIPT>
<?php if ($go == 'ENVIAR') { ?>
                alert('<?php echo $message; ?>');
<?php } ?>
        </SCRIPT>
    </head>
    <body>
        <form action="trouble.php" method="get" name="trouble">
            <span class="formcap">Fuente de problema</span><select name='fuente'>
                <option value='COBRA'>COBRA</option>
                <option value='SIPCLIENT'>SFLPHONE</option>
                <option value='PBX'>CONMUTADOR</option>
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
            <input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $go['C_CONT']; ?> /><br>
            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="submit" name="go" value="ENVIAR">
        </form>
        <button onClick='window.close()'>CIERRA</button>
    </body>
</html> 
