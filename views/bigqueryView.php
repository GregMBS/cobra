<!DOCTYPE html>
<html>
    <head>
        <title>Query de las Promesas/Propuestas</title>
        <link rel="Stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="bower_components/jquery/dist/jquery.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/jqueryui/jquery-ui.js"></script>
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
                    $queryg = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        and c_cvge <> ''
        order by c_cvge
        limit 1000
	";
                    $resultg = $pdo->query($queryg);
                    foreach ($resultg as $answerg) {
                        ?>
                        <option value="<?php echo $answerg['c_cvge']; ?>" style="font-size:120%;">
                            <?php echo $answerg['c_cvge']; ?></option>
                    <?php }
                    ?>
                </select>
            </p>
            <h2>Cliente:</h2>
            <p><?php
                if (isset($cliente)) {
                    echo $cliente;
                }
                ?>
                <?php
                $queryc = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvba
        limit 100
	";
                $resultc = $pdo->query($queryc);
                foreach ($resultc as $answerc) {
                    ?>
                    <input type="checkbox" name="cliente[]" value="<?php echo $answerc['c_cvba']; ?>" />
                    <?php echo $answerc['c_cvba']; ?><br>
                <?php }
                ?>
            </p>
            <p>HECHO de:
                <?php
                if (isset($fecha1)) {
                    echo $fecha1;
                }
                ?>
                <select name="fecha1">
                    <?php
                    $queryf1 = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 6 month)
        ORDER BY d_fech limit 360";
                    $resultf1 = $pdo->query($queryf1);
                    foreach ($resultf1 as $answerf1) {
                        ?>
                        <option value="<?php echo $answerf1[0]; ?>" style="font-size:120%;">
                            <?php echo $answerf1[0]; ?></option>
                    <?php } ?>
                </select>
                a:
                <?php
                if (isset($fecha2)) {
                    echo $fecha2;
                }
                ?>
                <select name="fecha2">
                    <?php
                    $queryf2 = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 6 month)
        ORDER BY d_fech desc limit 60";
                    $resultf2 = $pdo->query($queryf2);
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
            <label for='admin'>Visitas y Telefonica</label>
            <input type='radio' name='tipo' id='noadmin' value='noadmin' /><br>
            <label for='admin'>ROBOT/Carteo</label>
            <input type='radio' name='tipo' id='admin' value='admin' /><br>
            <label for='todos'>Todos</label>
            <input type='radio' name='tipo' id='todos' value='todos' /><br>
            <input type='submit' name='go' value='Query Gestiones'>
        </form>
    </body>
</html>
