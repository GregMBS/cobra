<?php
require_once 'pdoConnect.php';
$pdoc    = new pdoConnect();
$pdo     = $pdoc->dbConnectAdmin();
$capt    = filter_input(INPUT_GET, 'capt');
$go      = filter_input(INPUT_GET, 'go');
$tipo    = filter_input(INPUT_GET, 'tipo');
$auto    = filter_input(INPUT_GET, 'auto');
$gestor  = filter_input(INPUT_GET, 'gestor');
$ehora   = filter_input(INPUT_GET, 'ehora');
$emin    = filter_input(INPUT_GET, 'emin');
$empieza = $ehora.':'.$emin.':00';
$thora   = filter_input(INPUT_GET, 'thora');
$tmin    = filter_input(INPUT_GET, 'tmin');
$termina = $thora.':'.$tmin.':00';

if ($go == "CAMBIAR") {
    $queryu = "UPDATE breaks
            SET tipo=:tipo,
            empieza=:empieza,
            termina=:termina
            WHERE auto=:auto";
    $stu    = $pdo->prepare($queryu);
    $stu->bindParam(':auto', $auto, PDO::PARAM_INT);
    $stu->bindParam(':tipo', $tipo);
    $stu->bindParam(':empieza', $auto);
    $stu->bindParam(':termina', $auto);
    $stu->execute();
}

if ($go == "BORRAR") {
    $queryb = "DELETE FROM breaks WHERE auto=:auto";
    $stb    = $pdo->prepare($queryb);
    $stb->bindParam(':auto', $auto, PDO::PARAM_INT);
    $stb->execute();
}

if ($go == "AGREGAR") {
    $queryin = "INSERT INTO breaks (gestor, tipo, empieza, termina)
	VALUES (:gestor,:tipo,:empieza,:termina)";
    $sta     = $pdo->prepare($queryin);
    $sta->bindParam(':gestor', $gestor);
    $sta->bindParam(':tipo', $tipo);
    $sta->bindParam(':empieza', $auto);
    $sta->bindParam(':termina', $auto);
    $sta->execute();
}

$querymain = "SELECT auto, gestor, tipo, empieza, termina FROM breaks 
    order by gestor,empieza";
$result    = $pdo->query($querymain);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administraci&oacute;n de breaks</title>
        <link href="bower_components/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>Gestor</a></th>
                    <th>Tipo</a></th>
                    <th>Empieza</a></th>
                    <th>Termina</a></th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($result as $row) {
                    $auto    = $row['auto'];
                    $gestor  = $row['gestor'];
                    $tipo    = $row['tipo'];
                    $empieza = $row['empieza'];
                    $termina = $row['termina'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $gestor; ?>
                        </td>
                        <td>
                            <?php echo $tipo; ?><br>
                            <select name="tipo" form="cambiar">
                                <option value=""></option>
                                <option value="break"<?php
                                if ($tipo == 'hora') {
                                    echo " selected='selected'";
                                }
                                ?>>hora (60 min)</option>
                                <option value="break"<?php
                                if ($tipo == 'break') {
                                    echo " selected='selected'";
                                }
                                ?>>break (30 min)</option>
                                <option value="fumo"<?php
                                if ($tipo == 'fumo') {
                                    echo " selected='selected'";
                                }
                                ?>>fumo (15 min)</option>
                                <option value="bano"<?php
                                if ($tipo == 'bano') {
                                    echo " selected='selected'";
                                }
                                ?>>baño (10 min)</option>
                            </select>
                        </td>
                        <td>
                            <?php echo $empieza; ?><br>
                            <select name="ehora" form="cambiar">
                                <?php for ($i = 0; $i
                                    < 24; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php
                                        echo sprintf("%02d", $i);
                                        ?></option>
    <?php } ?>
                            </select>
                            :
                            <select name="emin" form="cambiar">
                                    <?php for ($i
                                    = 0; $i < 60; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php
                                    echo sprintf("%02d", $i);
                                    ?></option>
    <?php } ?>
                            </select>
                        </td>
                        <td>
                                <?php echo $termina; ?><br>
                            <select name="thora" form="cambiar">
                                <?php
                                for ($i = 0; $i < 24; $i++) {
                                    ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php
                                    echo sprintf("%02d", $i);
                                    ?></option>
    <?php } ?>
                            </select>
                            :
                            <select name="tmin" form="cambiar">
                                    <?php for ($i
                                    = 0; $i < 60; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php
                            echo sprintf("%02d", $i);
                            ?></option>
    <?php } ?>
                            </select>
                        </td>
                        <td>
                            <form method="get" action="breakadmin.php" name="cambiar">
                                <input type="submit" name="go" value="CAMBIAR" />
                                <input type="hidden" name="capt" value="<?php echo $capt; ?>"
                            </form>
                        </td>
                        <td>
                            <form method="get" action="breakadmin.php" name="borrar">
                                <input type="submit" name="go" value="BORRAR" />
                                <input type="hidden" name="capt" value="<?php echo $capt; ?>"
                            </form>
                        </td>
                        </form>
                    </tr>
<?php }
?>
                <tr>

                    <td>
                        <select name="gestor" form="agregar">
                            <option value=""></option>
                            <?php
                            $queryti  = "SELECT iniciales FROM nombres "
                                ."WHERE tipo NOT IN ('admin','visitador') "
                                ."order by iniciales";
                            $resultti = $pdo->query($queryti);

                            foreach ($resultti as $answerti) {
                                ?>
                                <option value="<?php
                                        if (isset($answerti['iniciales'])) {
                                            echo $answerti['iniciales'];
                                        }
                                        ?>" style="font-size:120%;" >
                                    <?php
                                    if (isset($answerti['iniciales'])) {
                                        echo $answerti['iniciales'];
                                    }
                                    ?></option>
<?php }
?>
                        </select>

                    </td>
                    <td>
                        <select name="tipo" form="agregar">
                            <option value=""></option>
                            <option value="hora">hora (60 min)</option>
                            <option value="break">break (30 min)</option>
                            <option value="fumo">fumo (15 min)</option>
                            <option value="bano">baño (10 min)</option>
                        </select>
                    </td>
                    <td>
                        <select name="ehora" form="agregar">
                                <?php for ($i = 0; $i
                                    < 24; $i++) {
                                    ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php
                                echo sprintf("%02d", $i);
                                ?></option>
                            <?php } ?>
                        </select>
                        :
                        <select name="emin" form="agregar">
                                <?php for ($i = 0; $i
                                    < 60; $i++) {
                                    ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php
                            echo sprintf("%02d", $i);
                            ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select name="thora" form="agregar">
<?php for ($i = 0; $i < 24; $i++) { ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php
    echo sprintf("%02d", $i);
    ?></option>
                                <?php } ?>
                        </select>
                        :
                        <select name="tmin" form="agregar">
<?php for ($i = 0; $i < 60; $i++) { ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php
    echo sprintf("%02d", $i);
    ?></option>
<?php } ?>
                        </select>
                    </td>
                    <td>
                        <form name="agregar" method="get" action="breakadmin.php">
                            <input type="hidden" name="capt" value="<?php echo $capt ?>">
                            <input type="submit" name="go" value="AGREGAR">
                        </form>
                    </td>

                </tr>
            </tbody>
        </table>
    </body>
</html> 
