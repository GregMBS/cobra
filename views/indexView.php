<?php
$msg = 'CobraMas';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>COBRA</title>
        <style type="text/css">
            body {text-align: center; background-color: #ffffff; width: 50em; color:#000000;}
            div.forma {margin-left:5.5cm; font-weight: bold;}
            fieldset {width: 21em; background-color: #c0c0c0;}
            sub {color:red;}
        </style>
    </head>
    <body>
        <h1>COBRA<sub>5</sub></h1>
        <em>versi&oacute;n configurado para RIBEMI</em>
        <div class="forma">
            <form action="/index.php" method="post" autocomplete="off">
                <fieldset>
                    <div class="username">
                        <label for="capt" class="formcap">Usuario:</label>
                        <input type="password" id="capt" name="capt" value=""
                               onchange="this.value = this.value.replace(/ /g, '');" />
                        <br>
                    </div>
                    <div class="contrasena">
                        <label for="pwd" class="formcap">Contrase&ntilde;a:</label>
                        <input type="password" id="pwd" name="pwd" value=""/><br>
                    </div>
                    <input type="submit" name="go" value="Empezar" />
                </fieldset>
            </form>
        </div>
        <p>&nbsp;</p>
        <a href="/licencia.txt">
            <cite>&#169;GMBS Consulting 2020</cite>
        </a>
    </body>
</html>