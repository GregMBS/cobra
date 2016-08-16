<!DOCTYPE html>
<html>
    <head>
        <title>Query de las Promesas/Propuestas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="tels_contactados.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>HECHO de:
                <select name="fecha1">
                    <?php
                    foreach ($daterange as $date) {
                        ?>
                        <option value="<?php echo $date->format('Y-m-d'); ?>" style="font-size:120%;">
                            <?php echo $date->format('Y-m-d'); ?></option>
                    <?php } ?>
                </select>
                a:
                <select name="fecha2">
                    <?php
                    foreach ($daterange as $date) {
                        ?>
                        <option value="<?php echo $date->format('Y-m-d'); ?>" style="font-size:120%;">
                            <?php echo $date->format('Y-m-d'); ?></option>
                        <?php } ?>
                </select>
            </p>
            <input type='submit' name='go' value='Telefonos'>
        </form>
    </body>
</html>
