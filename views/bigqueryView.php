<!DOCTYPE html>
<html>
    <head>
        <title>Query de las Promesas/Propuestas</title>
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
                    foreach ($resultf2 as $answerf2) {
                        ?>
                        <option value="<?php echo $answerf2[0]; ?>" style="font-size:120%;">
                            <?php echo $answerf2[0]; ?></option>
                    <?php } ?>
                </select>
            </p>
            <label for='visits'>Visitas</label>
            <input type='radio' name='tipo' id='visits' value='visits' /><br>
            <label for='telef'>Telefonica</label>
            <input type='radio' name='tipo' id='telef' value='telef' /><br>
            <label for='todos'>Todos</label>
            <input type='radio' name='tipo' id='todos' value='todos' /><br>
            <input type='submit' name='go' value='Query Gestiones'>
        </form>
    </body>
</html>
