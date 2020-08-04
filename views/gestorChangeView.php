<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>Cambia de Gestores</title>
</head>
<body>
<form action="" method="post" name="cambiar">
    <label for="data">Usa numero de cuenta</label>
    <textarea name='data' id='data' rows='20' cols='50'></textarea>
    <input type="hidden" name="capt" value="<?php
    echo $capt
    ?>"/>
    <button type="submit" name="go" value="cargar">Cambiar</button>
</form>
<?php
if (isset($report)) {
    ?>
    <div>
        <?php
        foreach ($report as $row) {
            ?>
            <form method="post" action="/gestorChange.php">
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <dl>
                    <dt>
                        <span><?php echo $row->numero_de_cuenta; ?></span>
                        <input type="hidden" name="numero_de_cuenta" value="<?php echo $row->numero_de_cuenta; ?>">
                        <input type="hidden" name="cliente" value="<?php echo $row->cliente; ?>">
                    </dt>
                    <dd>
                        <label><?php echo $row->ejecutivo_asignado_call_center; ?>
                            <select name="ejecutivo_asignado_call_center"></select></label>
                        <label><?php echo $row->status_de_credito; ?>
                            <input type="text" id="sdc" name="status_de_credito" value="<?php echo $row->status_de_credito; ?>"></label>
                        <input type="submit" name="go" value="cambiar">
                    </dd>
                </dl>
            </form>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
    Regresar a la pagina administrativa
</button>
<br>
</body>
</html>
