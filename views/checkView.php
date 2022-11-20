<!DOCTYPE html>
<html lang="es">
<head>
    <title>CobraMas Visitador Asignaciones y Recepciones</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</head>
<body onLoad="<?php
if (!empty($gestor)) {
    ?>
        document.getElementById('CUENTA').focus();
<?php } ?>">
<div id="vtable">
    <h1><?php echo $message; ?></h1>
    <form id='asigform' action='<?php
    echo $file;
    ?>' method='get'>
        <label for="gestor" class="formCap">Visitador:</label>
        <select name="gestor" id="gestor" onChange="document.getElementById('asigform').submit()">
            <option value='' <?php if ($gestor == '') { ?> selected='selected'<?php } ?>></option>
            <?php
            foreach ($result as $answer) {
                ?>
                <option value="<?php echo $answer->USUARIA; ?>" <?php if ($gestor == $answer->USUARIA) {
                    ?> selected='selected'<?php } ?>><?php echo htmlentities($answer->USUARIA . '-' . $answer->COMPLETO); ?>
                </option>
            <?php }
            ?>
        </select>
        <label><input type="text" id="CUENTA" name="CUENTA" value=""></label><br>
        <label for="id_cuenta">c&oacute;digo de barras</label>
        <input type="radio" id="id_cuenta" name="tipo" <?php
        if ($tipo === 'id_cuenta') {
        ?>checked="checked"<?php } ?> value="id_cuenta">
        <label for="numero_de_cuenta">numero de cuenta</label>
        <input type="radio" id="numero_de_cuenta" name="tipo" <?php if ($tipo === 'numero_de_cuenta') {
        ?>checked="checked"<?php } ?> value="numero_de_cuenta">
        <input type="hidden" name="capt" value="<?php echo $capt; ?>">
        <input type="hidden" name="go" value="<?php
        echo $label;
        ?>">
        <input type="submit" value="<?php
        echo $label;
        ?>">
    </form>
    <button onclick="window.location = 'checkoutList.php?capt=<?php echo $capt; ?>&visitador=<?php echo $gestor; ?>'">
        CHECKLIST
    </button>
    <?php
    if ($resultCount) {
        $ASIGNADO = $resultCount['countOut'];
        $RECIBIDO = $resultCount['countIn'];
    }
    ?>
    <p>Asignado: <?php echo $ASIGNADO; ?><br>
        Recibido: <?php echo $RECIBIDO; ?></p>
    <?php
    require_once __DIR__ . '/checkTable.php';
    ?>
</div>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button>
<br>
</body>
</html>