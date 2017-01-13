<!DOCTYPE html>
<html>
    <head>
        <title>Query de las Gestiones</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="bigquery2.xls.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>Gestor: <?php
                if (isset($gestor)) {
                    echo $gestor;
                }
                ?>
                <select name="gestor">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
                    foreach ($resultg as $answerg) {
                        ?>
                        <option value="<?php echo $answerg[0]; ?>" style="font-size:120%;">
                            <?php echo $answerg[0]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>Cliente:
                <select name="cliente">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
                    foreach ($resultc as $answerc) {
                        ?>
                        <option value="<?php echo $answerc[0]; ?>" style="font-size:120%;">
                            <?php echo $answerc[0]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>HECHO de:
                <?php
                if (isset($fecha1)) {
                    echo $fecha1;
                }
                ?>
                <input name="fecha1" id="fecha1" readonly="readonly" />
                a:
                <input name="fecha2" id="fecha2" readonly="readonly" />
            </p>
            <label for='visits'>Visitas</label>
            <input type='radio' name='tipo' id='visits' value='visits' /><br>
            <label for='telef'>Telefonica</label>
            <input type='radio' name='tipo' id='telef' value='telef' /><br>
            <label for='todos'>Todos</label>
            <input type='radio' name='tipo' id='todos' value='todos' /><br>
            <input type='submit' name='go' value='Query Gestiones'>
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
