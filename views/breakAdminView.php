<?php
/**
 * @var BreaksObject[] $result
 */

use cobra_salsa\BreaksObject;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administración de breaks</title>
    <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php if (isset($capt)) {
    echo $capt;
} ?>'">Regresar a la pagina administrativa
</button>
<br>
<table class="ui-widget">
    <thead class="ui-widget-header">
    <tr>
        <th>Gestor</th>
        <th>Tipo</th>
        <th>Empieza</th>
        <th>Termina</th>
    </tr>
    </thead>
    <tbody class="ui-widget-content">
    <?php
    if (isset($result)) {
        foreach ($result as $row) { ?>
            <tr>
                <td>
                    <?php echo $row->gestor; ?>
                </td>
                <td>
                    <label><?php echo $row->tipo; ?>
                    <select form="cambiar<?php echo $row->auto; ?>" name="tipo">
                        <option value=""></option>
                        <option value="break"<?php
                        if ($row->tipo == 'hora') {
                            echo " selected='selected'";
                        }
                        ?>>hora (60 min)
                        </option>
                        <option value="break"<?php
                        if ($row->tipo == 'break') {
                            echo " selected='selected'";
                        }
                        ?>>break (30 min)
                        </option>
                        <option value="fumo"<?php
                        if ($row->tipo == 'fumo') {
                            echo " selected='selected'";
                        }
                        ?>>fumo (15 min)
                        </option>
                        <option value="bano"<?php
                        if ($row->tipo == 'bano') {
                            echo " selected='selected'";
                        }
                        ?>>baño (10 min)
                        </option>
                    </select></label>
                </td>
                <td>
                    <input form="cambiar<?php echo $row->auto; ?>" type="time" name="empieza" value="<?php echo $row->empieza; ?>">
                </td>
                <td>
                    <input form="cambiar<?php echo $row->auto; ?>" type="time" name="termina" value="<?php echo $row->termina; ?>">
                </td>
                <td>
                    <form method="post" action="/breakAdmin.php" name="cambiar<?php echo $row->auto; ?>">
                        <input type="submit" name="go" value="CAMBIAR"/>
                        <input type="hidden" name="auto" value="<?php echo $row->auto; ?>"/>
                        <input type="hidden" name="capt" value="<?php echo $capt; ?>"/>
                    </form>
                </td>
                <td>
                    <form method="post" action="/breakAdmin.php" name="borrar">
                        <input type="submit" name="go" value="BORRAR"/>
                        <input type="hidden" name="auto" value="<?php echo $row->auto; ?>"/>
                        <input type="hidden" name="capt" value="<?php echo $capt; ?>"/>
                    </form>
                </td>
            </tr>
        <?php }
    }
    ?>
    <tr>

        <td>
            <select name="gestor" form="agregar">
                <option value=""></option>
                <?php
                if (!empty($gestores)) {
                    foreach ($gestores as $gestor) {
                        ?>
                        <option value="<?php
                        if (isset($gestor)) {
                            echo $gestor;
                        }
                        ?>" style="font-size:120%;">
                            <?php
                            if (isset($gestor)) {
                                echo $gestor;
                            }
                            ?></option>
                    <?php }
                }
                ?>
            </select>

        </td>
        <td>
            <select name="tipo" form="agregar">
                <option value=""></option>
                <option value="hora">hora (60 min)</option>
                <option value="break">break (30 min)</option>
                <option value="fumo">fumo (15 min)</option>
                <option value="bano">baño (10 min)</option>
            </select>
        </td>
        <td>
            <input form="agregar" type="time" name="empieza" value="<?php echo $row->empieza; ?>">
        </td>
        <td>
            <input form="agregar" type="time" name="empieza" value="<?php echo $row->termina; ?>">
        </td>
        <td>
            <form name="agregar" method="post" action="/breakAdmin.php">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <input type="submit" name="go" value="AGREGAR">
            </form>
        </td>

    </tr>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html> 
