<?php 
/**
 * @var string $capt user
 * @var string[][] $resultc clientes
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Query de Pagos</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
        <form action="/pagosquery.php" method="get" name="queryParams">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p><label>Cliente:
                <select name="cliente">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
                    foreach ($resultc as $answerc) {
                        ?>
                        <option value="<?php echo $answerc['cliente']; ?>" style="font-size:120%;">
                            <?php echo $answerc['cliente']; ?></option>
                        <?php
                    }
                    ?>
                </select></label>
            </p>
            <p><label>HECHO de:
                    <input name="fecha1" id="fecha1" readonly="readonly" /></label>
                <label>a:
                <input name="fecha2" id="fecha2" readonly="readonly" /></label>
            </p>
            <input type='submit' name='go' value='Query_Pagos'>
        </form>
        <script src="/js/datepicker_mx.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $.datepicker.setDefaults(getMx());
                $('#fecha1').datepicker();
                $('#fecha2').datepicker();
            });
        </script>
    </body>
</html>
