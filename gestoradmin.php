<?php
require_once 'admin_hdr_i.php';
$go  = filter_input(INPUT_GET, 'go');
$get = filter_input_array(INPUT_GET);
if (!empty($go)) {
    if ($go == "GUARDAR") {
        $queryu  = "UPDATE nombres
            SET completo='".$con->real_escape_string($get['completo'])."',
            tipo='".$con->real_escape_string($get['tipo'])."'
            WHERE usuaria='".$con->real_escape_string($get['usuaria'])."'";
        $resultu = $con->query($queryu) or die($con->error);
        $queryp  = "UPDATE nombres
            SET passw=sha('".$con->real_escape_string($get['passw'])."')
            WHERE usuaria='".$con->real_escape_string($get['usuaria'])."'
	    AND passw <> '".$con->real_escape_string($get['passw'])."'";
        $resultp = $con->query($queryp) or die($con->error);
    }

    if ($go == "BORRAR") {
        $nombre   = $con->real_escape_string($get['usuaria']);
        $queryb   = "DELETE FROM nombres WHERE usuaria='".$nombre."'";
        $resultb  = $con->query($queryb) or die($con->error);
        $queryb2  = "DELETE FROM queuelist WHERE gestor='".$nombre."'";
        $resultb2 = $con->query($queryb2) or die($con->error);
        $queryb3  = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center='".$nombre."'";
        $resultb3 = $con->query($queryb3) or die($con->error);
    }

    if ($go == "AGREGAR") {
        $usuaria        = $con->real_escape_string($get['usuaria']);
        $completo       = $con->real_escape_string($get['completo']);
        $tipo           = $con->real_escape_string($get['tipo']);
        $passw          = $con->real_escape_string($get['passw']);
        $iniciales      = strtolower($usuaria);
        $queryin        = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW,
            TIPO, CAMP) 
	VALUES ('".$usuaria."','".$iniciales."','".$completo."',sha('".$passw."'),'".$tipo."', 999999)";
        $resultin       = $con->query($queryin) or die("nombre insert ".$con->error);
        $querylistin    = "insert ignore into queuelist
		SELECT distinct null, '".$iniciales."', cliente, status_aarsa, 999999,
		orden1, updown1, orden2, updown2, orden3, updown3,
		sdc, bloqueado
		FROM queuelist;";
        $resultlistin   = $con->query($querylistin) or die("queuelist insert ".$con->error);
        $querylistcamp  = "update queuelist
            set camp=auto where camp=999999;";
        $resultlistcamp = $con->query($querylistcamp) or die("queuelist numbering ".$con->error);
        header("Location: gestoradmin.php?capt=".$capt);
    }
}
$querymain = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales <> 'gmbs'
    order by TIPO, USUARIA";
$result    = $con->query($querymain) or die($con->error);
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
$j         = 0;

while ($row = $result->fetch_row()) {
    $j++;
    $usuaria  = $row[0];
    $completo = $row[1];
    $tipo     = $row[2];
    $camp     = $row[3];
    $gestor   = $row[4];
    $passw    = $row[5];
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
    $queryti  = "SELECT grupo FROM grupos";
    $resultti = $con->query($queryti);

    while ($answerti = $resultti->fetch_array()) {
        ?>
                                    <option value="<?php
                                    if (isset($answerti[0])) {
                                        echo $answerti[0];
                                    }
                                    ?>" style="font-size:120%;" <?php
                                    if (strtolower($answerti[0]) == strtolower($tipo)) {
                                        echo "selected='selected'";
                                    }
                                    ?>>
                                    <?php
                                            if (isset($answerti[0])) {
                                                echo $answerti[0];
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
$queryti  = "SELECT grupo FROM grupos";
$resultti = $con->query($queryti);

while ($answerti = $resultti->fetch_array()) {
    ?>
                                <option value="<?php
                                if (isset($answerti[0])) {
                                    echo $answerti[0];
                                }
                                ?>" style="font-size:120%;">
                                <?php
                                if (isset($answerti[0])) {
                                    echo $answerti[0];
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
