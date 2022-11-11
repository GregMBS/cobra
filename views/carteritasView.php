<?php
/**
 * @var int $count
 * @var int $dataCount
 * @var string $error
 */
?>
<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>COBRA Carga de Gestiones</title>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa
</button>
<br>
<h1>COBRA Carga de Gestiones</h1>
<form action="/carteritas.php" method="post" enctype="multipart/form-data" name="cargar">
    <p>Filename:
        <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>"/>
        <input type="file" name="file" id="file"><br>
        <button type="submit" name="go" value="cargar">Elegir archivo</button>
    </p>
</form>
<?php
if ($dataCount > 0) {
    ?>
    <h2><?php echo $count; ?> de <?php echo $dataCount; ?> gestiones cargadas</h2>
    <?php
}
if (!empty($error)) {
    echo $error;
}
?>
</body>
</html>
