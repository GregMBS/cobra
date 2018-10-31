<!DOCTYPE html>
<html>
    <head>
        <title>COBRA</title>
        <style type="text/css">
            body {text-align: center; background-color: #ffffff; width: 50em; color:#000000;}
            div.forma {margin-left:5.5cm; font-weight: bold;}
            fieldset {width: 21em; background-color: #c0c0c0;}
        </style>
    </head>
    <body>
        <h1>COBRA</h1>
        <em>versión 5.0 con Laravel</em>
        <div class="forma">
            <form action="/login" method="post" autocomplete="off">
            {{ csrf_field() }}
                <fieldset>
                    <div class="username">
                        <span class="formcap">Usuario:</span>
                        <input type="password" name="iniciales" value="" 
                               onchange="this.value = this.value.replace(/ /g, '');" />
                        <br>
                    </div>
                    <div class="contrasena">
                        <span class="formcap">Contrase&ntilde;a:</span>
                        <input type="password" name="password" value=""/><br>
                    </div>
                    <input type="submit" name="go" value="Empezar" />
                </fieldset>
            </form>
        </div>
        <p>&nbsp;</p>
        <a href="licencia.txt">
            <cite>&#169;Gregory Miles Blumenthal Scharf 2018</cite>
        </a>
    </body>
</html>