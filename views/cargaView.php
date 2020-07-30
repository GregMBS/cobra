<!DOCTYPE HTML>

<html lang="es">
    <head>
        <title>CobraMas Carga</title>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php
        /** @var string $capt */
        echo $capt;
        ?>'">Regresar a la pagina administrativa</button><br>
        <form action="/carga2.php" method="post" enctype="multipart/form-data" name="cargar">
            <p>Filename:
                <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>" />
                <input type="file" name="file" id="file"><br>
                <button type="submit" name="go" value="cargar">Elegir archivo</button>
            </p>
        </form>
