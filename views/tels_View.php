<?php
/**
 * @var DatePeriod $dateRange
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Query de las Tels</title>
    <meta charset="utf-8">
    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"
          type="text/css" media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php
echo $capt;
?>'">Regresar a la plantilla administrativa
</button>
<br>
<form action="/tels.php" method="get" name="queryparms">
    <input type="hidden" name="tipo" value="<?php echo $tipo ?>">
    <input type="hidden" name="capt" value="<?php echo $capt ?>">
    <p><label>HECHO de:
        <select name="fecha1">
            <?php
            foreach ($dateRange as $date) {
                ?>
                <option value="<?php echo $date->format('Y-m-d'); ?>" style="font-size:120%;">
                    <?php echo $date->format('Y-m-d'); ?></option>
                <?php
            }
            ?>
        </select></label>
        <label>a:
        <select name="fecha2">
            <?php
            foreach ($dateRange as $date) {
                ?>
                <option value="<?php echo $date->format('Y-m-d'); ?>" style="font-size:120%;">
                    <?php echo $date->format('Y-m-d'); ?></option>
                <?php
            }
            ?>
        </select></label>
    </p>
    <input type='submit' name='go' value='Telefonos'>
</form>
</body>
</html>
