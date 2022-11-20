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
    <form id='asigform' action='/checkBoth.php' method='get'>
        <label for="gestor" class="formCap">Visitador:</label>
        <select name="gestor" id="gestor" onChange="document.getElementById('asigform').submit()">
            <option value='' <?php if ($gestor === '') { ?> selected='selected'<?php } ?>></option>
            <?php
            foreach ($result as $answer) {
                ?>
                <option value="<?php echo $answer->USUARIA; ?>" <?php if ($gestor === $answer->USUARIA) {
                    ?> selected='selected'<?php } ?>><?php echo htmlentities($answer->USUARIA . '-' . $answer->COMPLETO); ?>
                </option>
            <?php }
            ?>
        </select>
        <label>
            <select name="fechaout">
                <option value='' <?php if ($fechaout === '') { ?> selected='selected'<?php } ?>></option>
                <?php
                foreach ($resultD as $answerD) {
                    ?>
                    <option value="<?php echo $answerD; ?>" <?php
                    if ($fechaout === $answerD) {
                        ?> selected='selected'<?php } ?>><?php echo $answerD; ?>
                    </option>
                <?php }
                ?>
            </select></label>
        <label><input type="text" id="CUENTA" name="CUENTA" value=""></label>
        <input type="hidden" name="capt" value="<?php echo $capt; ?>">
        <input type="hidden" name="go" value="<?php
        echo $label;
        ?>">
        <input type="submit" value="<?php
        echo $label;
        ?>">
    </form>
    <p>Asignado: <?php echo $resultCount['countOut']; ?><br>
        Recibido: <?php echo $resultCount['countIn']; ?></p>
    <?php
    require_once __DIR__ . '/checkTable.php';
    ?>
</div>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button>
<br>
</body>
</html>