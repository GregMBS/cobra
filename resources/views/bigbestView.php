<!DOCTYPE html>
<html>
    <head>
        <title>Query de las Promesas/Propuestas</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php 
        echo $capt;
        ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="bigbest.xls.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>Gestor:
                <select name="gestor">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
foreach ($resultgestor as $answerc) {
                        ?>
                        <option value="<?php echo $answerc[0]; ?>" style="font-size:120%;">
                            <?php echo $answerc[0]; ?></option>
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

                <select name="fecha1">
                    <?php
foreach ($resultfechastart as $answerma) {
                        ?>
                        <option value="<?php echo $answerma[0]; ?>" style="font-size:120%;">
                            <?php echo $answerma[0]; ?></option>
                    <?php 
} ?>
                </select>
                a:

                <select name="fecha2">
                    <?php
foreach ($resultma as $answerma) {
                        ?>
                        <option value="<?php echo $answerma[0]; ?>" style="font-size:120%;">
                            <?php echo $answerma[0]; ?></option>
                        <?php 
} ?>
                </select>
            </p>
            <input type='submit' name='go' value='Query Gestiones'>
        </form>
    </body>
</html>
