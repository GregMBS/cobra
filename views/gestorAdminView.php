<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administraci&oacute;n de las cuentas de los gestores</title>
        <title>CobraMas - Cambio de Status</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style>
            tr:hover {background-color: yellow;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                <th>Gestor</th>
                <th>Completo</th>
                <th>Contrase&ntilde;a</th>
                <th>Tipo</th>
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

                        <td><form class="gestorChange"
                                  name="gestorChange<?php echo $j; ?>"
                                  method="get"
                                  action="/gestorAdmin.php"
                                  id="gestorChange<?php echo $j; ?>">
                                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                                <input type="hidden" name="j" value="<?php echo $j ?>">
                                <label><input type="text" name="usuaria" readonly="readonly" value="<?php echo $usuaria; ?>" /></label>
                            </form>
                        </td>
                        <td><label><input form="gestorChange<?php echo $j; ?>" type="text" name="completo" value="<?php echo $completo; ?>" /></label></td>
                        <td><label><input form="gestorChange<?php echo $j; ?>" type="password" name="passw" value="<?php echo $passw; ?>" /></label></td>
                        <td><label>
                            <select form="gestorChange<?php echo $j; ?>" name="tipo">
                                <option value=""></option>
                                <?php
                                foreach ($groups as $g) {
                                    $group = $g['grupo'];
                                    ?>
                                    <option value="<?php
                                    if (isset($group)) {
                                        echo $group;
                                    }
                                    ?>" style="font-size:120%;" <?php
                                            if (strtolower($group) == strtolower($tipo)) {
                                                echo "selected='selected'";
                                            }
                                            ?>>
                                                <?php
                                                if (isset($group)) {
                                                    echo $group;
                                                }
                                                ?></option>
                                <?php }
                                ?>
                            </select></label></td>
                        <td><input form="gestorChange<?php echo $j; ?>" type="submit" name="go" value="GUARDAR">
                        </td>
                        <td><input form="gestorChange<?php echo $j; ?>" type="submit" name="go" value="BORRAR">
                        </td>
                    </tr>
                <?php }
                ?>
                <tr>
                <td><form class="gestorAdd"
                              name="gestorAdd"
                              method="get"
                              action="/gestorAdmin.php"
                              id="gestorAdd">
                            <input type="hidden" name="capt" value="<?php echo $capt ?>">
                            <label><input type="text" name="usuaria"  value="" /></label>
                    </form></td>
                    <td><label><input form="gestorAdd" type="text" name="completo" value="" /></label></td>
                    <td><label><input form="gestorAdd" type="password" name="passw" value="" /></label></td>
                    <td><label>
                        <select form="gestorAdd" name="tipo">
                            <option value=""></option>
                            <?php
                            foreach ($groups as $g) {
                                    $group = $g['grupo'];
                                ?>
                                <option value="<?php
                                if (isset($group)) {
                                    echo $group;
                                }
                                ?>" style="font-size:120%;">
                                    <?php
                                    if (isset($group)) {
                                        echo $group;
                                    }
                                    ?></option>
                            <?php }
                            ?>
                        </select></label></td>
                    <td><input form="gestorAdd" type="submit" name="go" value="AGREGAR">
                    </td>
                </tr>
                </tbody>
        </table>
    </body>
</html> 
