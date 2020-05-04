<!DOCTYPE html>
<html lang='es'>
    <head>
        <title>CobraMas Trouble</title>
        <meta charset="utf-8">
        <link rel="stylesheet" 
              href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" 
              type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <SCRIPT>
<?php 
if ($go == 'ENVIAR') { ?>
                alert('<?php echo $message; ?>');
    <?php 
}
    ?>
        </SCRIPT>
    </head>
    <body>
        <form action="/trouble.php" method="get" name="trouble">
            <span class="formcap">Fuente de problema</span><select name='fuente'>
                <option value='CobraMas'>CobraMas</option>
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
            <span class="formcap">Error mensajes (texto <em>EXACTO</em>)</span>
            <textarea rows="2" cols="40" name="error_msg"></textarea><br>
            <input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $C_CONT; ?> /><br>
            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="submit" name="go" value="ENVIAR">
        </form>
        <button onClick='window.close()'>CIERRA</button>
    </body>
</html> 
