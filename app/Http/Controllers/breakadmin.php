<?php
use cobra_salsa\PdoClass;
$pdoc    = new PdoClass();
$pdo     = $pdoc->dbConnectAdmin();
$capt    = filter_input(INPUT_GET, 'capt');
$go      = filter_input(INPUT_GET, 'go');
$tipo    = filter_input(INPUT_GET, 'tipo');
$auto    = filter_input(INPUT_GET, 'auto', FILTER_SANITIZE_NUMBER_INT);
$gestor  = filter_input(INPUT_GET, 'gestor');
$empieza = filter_input(INPUT_GET, 'ehora').':'.filter_input(INPUT_GET, 'emin').':00';
$termina = filter_input(INPUT_GET, 'thora').':'.filter_input(INPUT_GET, 'tmin').':00';

if ($go == "CAMBIAR") {
    $queryu  = "UPDATE breaks
            SET tipo=:tipo,
            empieza=:empieza,
            termina=:termina
            WHERE auto=:auto";
    $stu = $pdo->prepare($queryu);
    $stu->bindParam(':tipo', $tipo);
    $stu->bindParam(':empieza', $empieza);
    $stu->bindParam(':termina', $termina);
    $stu->bindParam(':auto', $auto, PDO::PARAM_INT);
    $stu->execute();
}

if ($go == "BORRAR") {
    $queryb  = "DELETE FROM breaks WHERE auto=:auto";
    $stb = $pdo->prepare($queryb);
    $stb->bindParam(':auto', $auto, PDO::PARAM_INT);
    $resultb = $pdo->query($queryb);
}

if ($go == "AGREGAR") {
    $queryin  = "INSERT INTO breaks (gestor, tipo, empieza, termina)
	VALUES (:gestor, :tipo, :empieza, :termina)";
    $sti = $pdo->prepare($queryin);
    $sti->bindParam(':gestor', $gestor);
    $sti->bindParam(':tipo', $tipo);
    $sti->bindParam(':empieza', $empieza);
    $sti->bindParam(':termina', $termina);
    $sti->execute();
}
$querymain = "SELECT auto, gestor, tipo, empieza, termina FROM breaks
    order by gestor,empieza";
$result    = $pdo->query($querymain);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administraci&oacute;n de breaks</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <table summary="Gestores">
            <thead>
                <tr>
            <form action="breakadmin.php" method="get" name="migoorden">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <th>Gestor</a></th>
                <th>Tipo</a></th>
                <th>Empieza</a></th>
                <th>Termina</a></th>
                </tr>
                </thead>
                <tbody>
<?php
foreach ($result as $row) {
    $auto    = $row[0];
    $gestor  = $row[1];
    $tipo    = $row[2];
    $empieza = $row[3];
    $termina = $row[4];
    ?>
                        <tr>
                    <form class="gestorchange" name="gestorchange<?php echo $auto ?>" method="get" action=
                          "breakadmin.php" id="gestorchange<?php echo $auto ?>">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="auto" value="<?php echo $auto ?>">
                        <td>
                            <input type="text" name="gestor" readonly=readonly value="<?php echo $gestor; ?>"><br>
                        </td>
                        <td>
    <?php echo $tipo; ?><br>
                            <select name="tipo">
                                <option value=""></option>
                                <option value="break"<?php if ($tipo == 'break') {
        echo " selected='selected'";
    } ?>>break (30 min)</option>
                                <option value="bano"<?php if ($tipo == 'bano') {
        echo " selected='selected'";
    } ?>>baño (10 min)</option>
                            </select>
                        </td>
                        <td>
                            <?php echo $empieza; ?><br>
                            <select name="ehora">
                                <?php for ($i = 0; $i < 24; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
                                $i); ?></option>
    <?php } ?>
                            </select>
                            :
                            <select name="emin">
                                <?php for ($i = 0; $i < 60; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
                                $i); ?></option>
    <?php } ?>
                            </select>
                        </td>
                        <td>
                                <?php echo $termina; ?><br>
                            <select name="thora">
                                <?php for ($i = 0; $i < 24; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
                                $i); ?></option>
                                <?php } ?>
                            </select>
                            :
                            <select name="tmin">
    <?php for ($i = 0; $i < 60; $i++) { ?>
                                    <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
            $i); ?></option>
    <?php } ?>
                            </select>
                        </td>
                        <td><input type="submit" name="go" value="CAMBIAR">
                        </td>
                        <td><input type="submit" name="go" value="BORRAR">
                        </td>
                    </form>
                    </tr>
    <?php }
?>
                <tr>
                <form class="gestoradd" name="gestoradd" method="get"
                      action="breakadmin.php" id="gestoradd">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    <td>
                        <select name="gestor">
                            <option value=""></option>
                            <?php
                            $queryti  = "SELECT iniciales FROM nombres "
                                ."WHERE tipo<>'admin' "
                                ."and tipo <>'visitador' "
                                ."order by iniciales";
                            $resultti = $pdo->query($queryti);

                            foreach ($resultti as $answerti) {
                                ?>
                                <option value="<?php
                                    if (isset($answerti[0])) {
                                        echo $answerti[0];
                                    }
                                    ?>" style="font-size:120%;" >
                                    <?php
                                if (isset($answerti[0])) {
                                    echo $answerti[0];
                                }
                                ?></option>
    <?php }
?>
                        </select>

                    </td>
                    <td>
                        <select name="tipo">
                            <option value=""></option>
                            <option value="break">break (30 min)</option>
                            <option value="bano">baño (10 min)</option>
                        </select>
                    </td>
                    <td>
                        <select name="ehora">
<?php for ($i = 0; $i < 24; $i++) { ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
        $i); ?></option>
                            <?php } ?>
                        </select>
                        :
                        <select name="emin">
<?php for ($i = 0; $i < 60; $i++) { ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
        $i); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select name="thora">
                            <?php for ($i = 0; $i < 24; $i++) { ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
                                $i); ?></option>
<?php } ?>
                        </select>
                        :
                        <select name="tmin">
<?php for ($i = 0; $i < 60; $i++) { ?>
                                <option value='<?php echo sprintf("%02d", $i); ?>'><?php echo sprintf("%02d",
        $i); ?></option>
<?php } ?>
                        </select>
                    </td>
                    <td><input type="submit" name="go" value="AGREGAR">
                    </td>
                </form>
                </tr>
                </tbody>
        </table>
    </body>
</html>
