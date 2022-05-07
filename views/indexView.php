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
        <link rel="manifest" href="/manifest.json">

        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="application-name" content="COBRA">
        <meta name="apple-mobile-web-app-title" content="COBRA">
        <meta name="msapplication-starturl" content="/">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            body {text-align: center; background-color: #ffffff; width: 50em; color:#000000;}
            div.forma {margin-left:5.5cm; font-weight: bold; font-size: large}
            fieldset {width: 21em; background-color: #c0c0c0;}
            fieldset div {margin: 1em}
        </style>
    </head>
    <body>
        <h1><?php echo $msg; ?></h1>
        <em>versi&oacute;n configurado para RIBEMI</em>
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
            <cite>&copy;Gregory Miles Blumenthal Scharf 2022</cite>
        </a>
    </body>
</html>