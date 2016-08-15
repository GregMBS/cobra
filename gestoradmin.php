<?php
require_once 'classes/pdoConnect.php';
$pc = new pdoConnect();
$pdo = $pc->dbConnectAdmin();

$go = filter_input(INPUT_GET, 'go');
$completo = filter_input(INPUT_GET, 'completo');
$tipo = filter_input(INPUT_GET, 'tipo');
$usuaria = filter_input(INPUT_GET, 'usuaria');
$passw = filter_input(INPUT_GET, 'passw');

if (!empty($go)) {
    if ($go == "GUARDAR") {
        $queryu = "UPDATE nombres
            SET completo = :completo
            tipo = :tipo
            WHERE usuaria = :usuaria";
        $stu = $pdo->prepare($queryu);
        $stu->bindParam(':completo', $completo);
        $stu->bindParam(':tipo', $tipo);
        $stu->bindParam(':usuaria', $usuaria);
        $stu->execute();
        $queryp = "UPDATE nombres
            SET passw = sha(:passw)
            WHERE usuaria = :usuaria
	    AND passw <> :passw";
        $stp = $pdo->prepare($queryp);
        $stp->bindParam(':passw', $passw);
        $stp->bindParam(':usuaria', $usuaria);
        $stp->execute();
    }

    if ($go == "BORRAR") {
        $queryb = "DELETE FROM nombres WHERE usuaria = :usuaria";
        $stb = $pdo->prepare($queryb);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
        $queryb2 = "DELETE FROM queuelist WHERE gestor = :usuaria";
        $stb2 = $pdo->prepare($queryb2);
        $stb2->bindParam(':usuaria', $usuaria);
        $stb2->execute();
        $queryb3 = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center = :usuaria";
        $stb3 = $pdo->prepare($queryb3);
        $stb3->bindParam(':usuaria', $usuaria);
        $stb3->execute();
    }

    if ($go == "AGREGAR") {
        $iniciales = strtolower($usuaria);
        $queryin = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW,
            TIPO, CAMP) 
	VALUES (:usuaria, :iniciales, :completo, sha(:passw), :tipo, 999999)";
        $sti = $pdo->prepare($queryin);
        $sti->bindParam(':completo', $completo);
        $sti->bindParam(':tipo', $tipo);
        $sti->bindParam(':usuaria', $usuaria);
        $sti->bindParam(':iniciales', $iniciales);
        $sti->bindParam(':passw', $passw);
        $sti->execute();
        $querylistin = "insert ignore into queuelist
		SELECT distinct null, :iniciales, cliente, status_aarsa, 999999,
		orden1, updown1, orden2, updown2, orden3, updown3,
		sdc, bloqueado
		FROM queuelist;";
        $stl = $pdo->prepare($querylistin);
        $stl->bindParam(':iniciales', $iniciales);
        $stl->execute();
        $querylistcamp = "update queuelist
            set camp=auto where camp=999999;";
        $resultlistcamp = $pdo->query($querylistcamp);
        header("Location: gestoradmin.php?capt=" . $capt);
    }
}
$querymain = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales <> 'gmbs'
    order by TIPO, USUARIA";
$result = $pdo->query($querymain);

$queryg = "SELECT grupo FROM grupos";
$groups = $pdo->query($queryg);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administraci&oacute;n de las cuentas de los gestores</title>
        <title>CobraMas - Cambio de Status</title>
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style>
            tr:hover {background-color: yellow;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <table summary="Gestores" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
            <form action="gestoradmin.php" method="get" name="migoorden">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <th>Gestor</a></th>
                <th>Completo</a></th>
                <th>Contrase&ntilde;a</a></th>
                <th>Tipo</a></th>
                </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    $j = 0;

                    while ($row = $result->fetch_row()) {
                        $j++;
                        $usuaria = $row[0];
                        $completo = $row[1];
                        $tipo = $row[2];
                        $camp = $row[3];
                        $gestor = $row[4];
                        $passw = $row[5];
                        ?>
                        <tr>
                    <form class="gestorchange"
                          name="gestorchange<?php echo $j; ?>"
                          method="get"
                          action="gestoradmin.php"
                          id="gestorchange<?php echo $j; ?>">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="j" value="<?php echo $j ?>">
                        <td><input type="text" name="usuaria" readonly="readonly" value="<?php echo $usuaria; ?>" /></td>
                        <td><input type="text" name="completo" value="<?php echo $completo; ?>" /></td>
                        <td><input type="password" name="passw" value="<?php echo $passw; ?>" /></td>
                        <td>
                            <select name="tipo">
                                <option value=""></option>
                                <?php
                                foreach ($groups as $g) {
                                    ?>
                                    <option value="<?php
                                    if (isset($g)) {
                                        echo $g;
                                    }
                                    ?>" style="font-size:120%;" <?php
                                            if (strtolower($g) == strtolower($tipo)) {
                                                echo "selected='selected'";
                                            }
                                            ?>>
                                                <?php
                                                if (isset($g)) {
                                                    echo $g;
                                                }
                                                ?></option>
                                <?php }
                                ?>
                            </select></td>
                        <td><input type="submit" name="go" value="GUARDAR">
                        </td>
                        <td><input type="submit" name="go" value="BORRAR">
                        </td>
                    </form>
                    </tr>
                <?php }
                ?>
                <tr>
                <form class="gestoradd"
                      name="gestoradd"
                      method="get"
                      action="gestoradmin.php"
                      id="gestoradd">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    <td><input type="text" name="usuaria"  value="" /></td>
                    <td><input type="text" name="completo" value="" /></td>
                    <td><input type="password" name="passw" value="" /></td>
                    <td>
                        <select name="tipo">
                            <option value=""></option>
                            <?php
                            foreach ($groups as $gr) {
                                ?>
                                <option value="<?php
                                if (isset($gr)) {
                                    echo $gr;
                                }
                                ?>" style="font-size:120%;">
                                    <?php
                                    if (isset($gr)) {
                                        echo $gr;
                                    }
                                    ?></option>
                            <?php }
                            ?>
                        </select></td>
                    <td><input type="submit" name="go" value="AGREGAR">
                    </td>
                </form>
                </tr>
                </tbody>
        </table>
    </body>
</html> 
