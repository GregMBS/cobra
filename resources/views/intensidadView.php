<!DOCTYPE html>
<html>
    <head>
        <title>Query de las Intensidad</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="intensidad.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>HECHO de:
                <?php
                if (isset($fecha1)) {
                    echo $fecha1;
                }
                ?>
                <select name="fecha1">
                    <?php
                    foreach ($resultdf as $answerdf) {
                        ?>
                        <option value="<?php echo $answerdf[0]; ?>" style="font-size:120%;">
                            <?php echo $answerdf[0]; ?></option>
                        <?php }
                    ?>
                </select>
                a:
                <select name="fecha2">
                    <?php
                    foreach ($resultfd as $answerfd) {
                        ?>
                        <option value="<?php echo $answerfd[0]; ?>" style="font-size:120%;">
                            <?php echo $answerfd[0]; ?></option>
                        <?php
                    }
                    foreach ($resultfd as $answerf2) {
                        ?>
                        <option value="<?php echo $answerf2[0]; ?>" style="font-size:120%;">
                            <?php echo $answerf2[0]; ?></option>
                    <?php } ?>
                </select>
            </p>
            <input type='submit' name='go' value='Query Intensidad'>
        </form>
    </body>
</html>
