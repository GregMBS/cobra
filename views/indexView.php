<?php
$msg = 'CobraMas';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA</title>
        <?php
        $msg = 'COBRA';
        ?>
        <style type="text/css">
            body {text-align: center; background-color: #ffffff; width: 50em; color:#000000;}
            div.forma {margin-left:5.5cm; font-weight: bold;}
            div.logo {text-align:center; font-weight: bold;}
            fieldset {width: 21em; background-color: #c0c0c0;}
        </style>
    </head>
    <body>
        <h1><?php echo $msg; ?></h1>
        <em>versi&oacute;n configurado para VoIP Consulting</em>
        <div class="forma">
            <form action="index.php" method="post" autocomplete="off">
                <fieldset>
                    <div class="username">
                        <span class="formcap">Usuario:</span>
                        <input type="password" name="capt" value="" 
                               onchange="this.value = this.value.replace(/ /g, '');" />
                        <br>
                    </div>
                    <div class="contrasena">
                        <span class="formcap">Contrase&ntilde;a:</span><input type="password" name="pwd" value=""/><br>
                    </div>
                    <input type="submit" name="go" value="Empezar" />
                </fieldset>
            </form>
        </div>
        <p>&nbsp;</p>
        <a href="licencia.txt">
            <cite>&#169;Gregory Miles Blumenthal Scharf 2017</cite>
        </a>
    </body>
</html>