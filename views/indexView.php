<?php
$msg = 'CobraMas';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>COBRA</title>
        <?php
        $msg = 'COBRA';
        ?>
        <style>
            body {text-align: center; background-color: #ebd5b3; width: 50em; color:#000000;}
            div.forma {margin-left:5.5cm; font-weight: bold;}
            fieldset {width: 21em; background-color: #c0c0c0;}
        </style>
    </head>
    <body>
        <h1><?php echo $msg; ?></h1>
        <em>versi&oacute;n configurado para RBM</em>
        <div class="forma">
            <form action="/index.php" method="post" autocomplete="off">
                <fieldset>
                    <div class="username">
                        <label for="capt" class="formCap">Usuario:</label>
                        <input type="text" name="capt" id="capt" value=""
                               onchange="this.value = this.value.replace(/ /g, '');" />
                        <br>
                    </div>
                    <div class="contrasena">
                        <label for="pwd" class="formCap">Contrase&ntilde;a:</label>
                        <input type="password" name="pwd" id="pwd" value=""/><br>
                    </div>
                    <input type="submit" name="go" value="Empezar" />
                </fieldset>
            </form>
        </div>
        <p>&nbsp;</p>
        <a href="/licencia.txt">
            <cite>&copy;GMBS Consulting 2022</cite>
        </a>
    </body>
</html>