<?php
require_once 'pdoConnect.php';
$pdoc  = new pdoConnect();
$pdo   = $pdoc->dbConnectAdmin();
$capt  = filter_input(INPUT_GET, 'capt');
$get   = filter_input_array(INPUT_GET);
$field = '';
if (isset($get['go'])) {
    $go = $get['go'];
} else {
    $go = '';
}
if ($go == 'BUSCAR') {
    $field = $get['field'];
    $find  = $get['find'];
}
if ($go == 'CAMBIAR') {
    $C_CONT       = $get['C_CONT'];
    $CLIENTE      = $get['CLIENTE'];
    $field        = 'id_cuenta';
    $find         = $C_CONT;
    $TAG0         = $get['SDC'];
    $TAGA         = explode('-', $TAG0);
    $TAG          = trim($TAGA[0]);
    $TAGS         = $TAG;
    $INACTIVO     = !empty($get['inactivo']);
    $LIQUIDADO    = !empty($get['liquidado']);
    $QUITA        = !empty($get['quita']);
    $REESTRUCTURA = !empty($get['reestructura']);
    $REGULARIZADA = !empty($get['regularizada']);
    if ($INACTIVO) {
        $TAGS = $TAG.'-inactivo';
    }
    if ($LIQUIDADO) {
        $TAGS = $TAG.'-liquidado';
    }
    if ($QUITA) {
        $TAGS = $TAG.'-quita';
    }
    if ($REESTRUCTURA) {
        $TAGS = $TAG.'-reestructura';
    }
    if ($REGULARIZADA) {
        $TAGS = $TAG.'-regularizada';
    }
    $queryup = "UPDATE resumen
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
    $stu     = $pdo->prepare($queryup);
    $stu->bindParam(':tags', $TAGS);
    $stu->bindParam(':C_CONT', $C_CONT);
    $stu->execute();

    $queryup2 = "UPDATE rlook
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
    $stu2     = $pdo->prepare($queryup2);
    $stu2->bindParam(':tags', $TAGS);
    $stu2->bindParam(':C_CONT', $C_CONT);
    $stu2->execute();
}
$querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where id_cuenta<0 and :find=:find";
if ($field == 'nombre_deudor') {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where nombre_deudor regexp :find";
}
if ($field == 'id_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where id_cuenta = :find";
}
if ($field == 'numero_de_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen
where numero_de_cuenta = :find order by numero_de_cuenta";
}
if (isset($CLIENTE)) {
    if (strlen($CLIENTE) > 1) {
        $querymain = $querymain." and cliente=:cliente";
    } else {
        $querymain = $querymain." and :cliente<>'AA'";
    }
} else {
    $CLIENTE   = '';
    $querymain = $querymain." and :cliente<>'AA'";
}
$stm    = $pdo->prepare($querymain);
$stm->bindParam(':find', $find);
$stm->bindParam(':cliente', $CLIENTE);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CobraMas - Cambio de Status</title>
        <link href="bower_components/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>CAMBIO DE STATUS</h1>
        <button onClick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar al panel administrativo</button>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>CAMPAÑA</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $j      = 0;
                foreach ($result as $row) {
                    $j         = $j + 1;
                    $CUENTA    = $row['numero_de_cuenta'];
                    $NOMBRE    = utf8_decode($row['nombre_deudor']);
                    $CLIENTE   = $row['cliente'];
                    $ID_CUENTA = $row['id_cuenta'];
                    $STATUS    = $row['status_de_credito'];
                    $STATUSC   = $row['status_aarsa'];
                    if (preg_match('/activo$/', $STATUS)) {
                        $INACTIVO = 1;
                    } else {
                        $INACTIVO = 0;
                    }
                    if (preg_match('/quidado$/', $STATUS)) {
                        $LIQUIDADO = 1;
                    } else {
                        $LIQUIDADO = 0;
                    }
                    if (preg_match('/quita$/', $STATUS)) {
                        $QUITA = 1;
                    } else {
                        $QUITA = 0;
                    }
                    if (preg_match('/reestructura$/', $STATUS)) {
                        $REESTRUCTURA = 1;
                    } else {
                        $REESTRUCTURA = 0;
                    }
                    if (preg_match('/regularizada$/', $STATUS)) {
                        $REGULARIZADA = 1;
                    } else {
                        $REGULARIZADA = 0;
                    }
                    ?>
                    <tr>
                        <td><a href='resumen.php?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>&highlight=<?php echo $field ?>&hfind=<?php echo $find ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo utf8_decode($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $STATUS; ?><br>
                            <form method='get' action='changest.php' name='<?php echo $ID_CUENTA; ?>'>
                                INACTIVO<input type="checkbox" name="inactivo" value="inactivo"<?php
                                if ($INACTIVO == 1) {
                                    ?> checked=checked<?php } ?>><br>
                                LIQUIDADO<input type="checkbox" name="liquidado" value="liquidado"<?php
                                if ($LIQUIDADO == 1) {
                                    ?> checked=checked<?php } ?>><br>
                                QUITA<input type="checkbox" name="quita" value="quita"<?php
                                if ($QUITA == 1) {
                                    ?> checked=checked<?php } ?>><br>
                                REESTRUCTURA<input type="checkbox" name="reestructura" value="reestructura"<?php
                                if ($REESTRUCTURA == 1) {
                                    ?> checked=checked<?php } ?>><br>
                                REGULARIZADA<input type="checkbox" name="regularizada" value="regularizada"<?php
                                if ($REGULARIZADA == 1) {
                                    ?> checked=checked<?php } ?>><br>
                                <input type="hidden" name="C_CONT" value="<?php echo $ID_CUENTA; ?>">
                                <input type="hidden" name="CLIENTE" value="<?php echo $CLIENTE; ?>">
                                <input type="hidden" name="SDC" value="<?php echo $STATUS; ?>">
                                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                                <input type="submit" name="go" value="CAMBIAR">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div id="searchbox">
            <h2>Buscar</h2>
            <form name="search" method="get" action=
                  "changest.php" id="search">Buscar a: <input type=
                                                        "text" name="find"> en <select name="field">
                    <option value="nombre_deudor">Nombre</option>
                    <option value="numero_de_cuenta">Cuenta</option>
                    <option value="id_cuenta">Expediente</option>
                </select><br>
                Client = <select name="cliente">
                    <option value=" ">Todos</option>
                    <?php
                    $querycl  = "SELECT cliente FROM clientes;";
                    $resultcl = $pdo->query($querycl);
                    foreach ($resultcl as $answercl) {
                        ?>
                        <option value="<?php echo $answercl['cliente']; ?>">
                            <?php echo $answercl['cliente']; ?>
                        </option>
                    <?php } ?>
                </select><br>
                <input type="hidden" name="i" value="0">
                <input type="hidden" name="capt" value="<?php
                if (isset($capt)) {
                    echo $capt;
                }
                ?>">
                <input type="hidden" name="go" value="BUSCAR">
                <input type="hidden" name="from" value="resumen.php">
                <input type="submit" name="go1" value="BUSCAR">
                <input type="button" name="cancel" onclick="cancelbox('searchbox')"
                       value="Cancel">
            </form>
        </div>
    </body>
</html>
