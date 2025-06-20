<?php
/**
 * @var string $here
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Query del Inventario</title>

        <style>
            body {font-family: arial, helvetica, sans-serif; font-size: 8pt; }
            table {border: 1pt solid #000000;background-color: #c0c0c0;}
            tr:hover {background-color: #ff0000;}
            th {border: 1pt solid #000000;background-color: #c0c0c0;}
            .loud {text-align:center; font-weight:bold; color:red;}
            .num {text-align:right;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php
        echo $capt;
        ?>'">Regresar a la pagina administrativa</button><br>
        <form action="<?php echo $here; ?>" method="get" name="queryParams">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p><label>Cliente:
                <select name="cliente">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
foreach ($clientes as $cliente) {
                        ?>
                        <option value="<?php echo $cliente; ?>" style="font-size:120%;">
                            <?php echo $cliente; ?></option>
                        <?php
}
                        ?>
                </select></label>
            </p>
            <input type='submit' name='go' value='Query Inventario'>
        </form>
    </body>
</html>
