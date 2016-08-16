<!DOCTYPE html>
<html>
    <head>
        <title>Administraci&oacute;n de las cuentas de los gestores</title>
        <title>CobraMas - Cambio de Status</title>
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style>
            tr:hover {background-color: yellow;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <table summary="Gestores" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
            <form action="gestoradmin.php" method="get" name="migoorden">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <th>Gestor</a></th>
                <th>Completo</a></th>
                <th>Contrase&ntilde;a</a></th>
                <th>Tipo</a></th>
                </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    $j = 0;

                    foreach ($result as $row) {
                        $j++; 
                        $usuaria = $row['USUARIA'];
                        $completo = $row['COMPLETO'];
                        $tipo = $row['TIPO'];
                        $camp = $row['CAMP'];
                        $gestor = $row['INICIALES'];
                        $passw = $row['PASSW'];
                        ?>
                        <tr>
                    <form class="gestorchange"
                          name="gestorchange<?php echo $j; ?>"
                          method="get"
                          action="gestoradmin.php"
                          id="gestorchange<?php echo $j; ?>">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="j" value="<?php echo $j ?>">
                        <td><input type="text" name="usuaria" readonly="readonly" value="<?php echo $usuaria; ?>" /></td>
                        <td><input type="text" name="completo" value="<?php echo $completo; ?>" /></td>
                        <td><input type="password" name="passw" value="<?php echo $passw; ?>" /></td>
                        <td>
                            <select name="tipo">
                                <option value=""></option>
                                <?php
                                foreach ($groups as $g) {
                                    ?>
                                    <option value="<?php
                                    if (isset($g)) {
                                        echo $g;
                                    }
                                    ?>" style="font-size:120%;" <?php
                                            if (strtolower($g) == strtolower($tipo)) {
                                                echo "selected='selected'";
                                            }
                                            ?>>
                                                <?php
                                                if (isset($g)) {
                                                    echo $g;
                                                }
                                                ?></option>
                                <?php }
                                ?>
                            </select></td>
                        <td><input type="submit" name="go" value="GUARDAR">
                        </td>
                        <td><input type="submit" name="go" value="BORRAR">
                        </td>
                    </form>
                    </tr>
                <?php }
                ?>
                <tr>
                <form class="gestoradd"
                      name="gestoradd"
                      method="get"
                      action="gestoradmin.php"
                      id="gestoradd">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    <td><input type="text" name="usuaria"  value="" /></td>
                    <td><input type="text" name="completo" value="" /></td>
                    <td><input type="password" name="passw" value="" /></td>
                    <td>
                        <select name="tipo">
                            <option value=""></option>
                            <?php
                            foreach ($groups as $gr) {
                                ?>
                                <option value="<?php
                                if (isset($gr)) {
                                    echo $gr;
                                }
                                ?>" style="font-size:120%;">
                                    <?php
                                    if (isset($gr)) {
                                        echo $gr;
                                    }
                                    ?></option>
                            <?php }
                            ?>
                        </select></td>
                    <td><input type="submit" name="go" value="AGREGAR">
                    </td>
                </form>
                </tr>
                </tbody>
        </table>
    </body>
</html> 
