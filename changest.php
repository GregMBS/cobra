<?php
include('admin_hdr_i.php');
$get     = filter_input_array(INPUT_GET);
$C_CONT  = mysql_real_escape_string($get['C_CONT']);
$CLIENTE = mysql_real_escape_string($get['cliente']);
$go      = $get['go'];
if (!empty($go)) {
    if ($go != 'CAMBIAR') {
        $field = $get['field'];
        $find  = mysql_real_escape_string($get['find']);
        $from  = $get['from'];
    }
    if ($go == 'CAMBIAR') {
        $field     = 'id_cuenta';
        $find      = $C_CONT;
        $TAG0      = mysql_real_escape_string($get['SDC']);
        $TAGA      = explode('-', $TAG0);
        $TAG       = trim($TAGA[0]);
        $TAGS      = $TAG;
        $INACTIVO  = !empty($get['inactivo']);
        $LIQUIDADO = !empty($get['liquidado']);
        if ($TAG != '') {
            if ($INACTIVO) {
                $TAGS = $TAG.'-inactivo';
            }
            if ($LIQUIDADO) {
                $TAGS = $TAG.'-liquidado';
            }
        } else {
            if ($INACTIVO) {
                $TAGS = $TAG.'Inactivo';
            }
            if ($LIQUIDADO) {
                $TAGS = $TAG.'Liquidado';
            }
        }
        $queryup = "UPDATE resumen
SET status_de_credito='".$TAGS."' 
WHERE id_cuenta=".$C_CONT;

        mysql_query($queryup) or die(mysql_error());
        $queryup2 = "UPDATE rlook
SET status_de_credito='".$TAGS."' 
WHERE id_cuenta=".$C_CONT;
        mysql_query($queryup) or die(mysql_error());
    }
}
$querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen 
where id_cuenta<0";
if ($field == 'nombre_deudor') {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen 
where nombre_deudor regexp '".$find."'";
}
if ($field == 'id_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen 
where id_cuenta = ".$find;
}
if ($field == 'numero_de_cuenta') {
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen 
where numero_de_cuenta = '".$find."' order by numero_de_cuenta";
}
if ($CLIENTE != 'Todos') {
    $querymain = $querymain." and cliente='".$CLIENTE."'";
}

$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>COBRA - Cambio de Status</title>

        <style type="text/css">
            body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
            table {border: 1pt solid #000000;background-color: #c0c0c0;}
            tr:hover {background-color: #ff0000;}
            th {border: 1pt solid #000000;background-color: #c0c0c0;}
            .loud {text-align:center; font-weight:bold; color:red;}
            .num {text-align:right;}
        </style>

    </head>
    <body>
        <h1>CAMBIO DE STATUS</h1>
        <button onClick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar al panel administrativo</button>
        <table summary="Cuentas">
            <thead>
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>CAMPAÑA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $j      = 0;
                while ($row    = mysql_fetch_row($result)) {
                    $j         = $j + 1;
                    $CUENTA    = $row[0];
                    $NOMBRE    = utf8_decode($row[1]);
                    $CLIENTE   = $row[2];
                    $ID_CUENTA = $row[3];
                    $STATUS    = $row[4];
                    $STATUSC   = $row[5];
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
                    ?>
                    <tr>
                        <td><a href='<?php echo $from; ?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>&highlight=<?php echo $field ?>&hfind=<?php echo $find ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo utf8_decode($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $STATUS; ?><br>
                            <form method='get' action='changest.php' name='<?php echo $ID_CUENTA; ?>'>
                                INACTIVO<input type="checkbox" name="inactivo" value="inactivo"<?php if ($INACTIVO
                    == 1) {
                        ?> checked=checked<?php } ?>><br>
                                LIQUIDADO<input type="checkbox" name="liquidado" value="liquidado"<?php if ($LIQUIDADO
                                           == 1) {
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
                    <option value="Todos">Todos</option>
                    <?php
                    $querycl  = "SELECT cliente FROM clientes;";
                    $resultcl = mysql_query($querycl);
                    while ($answercl = mysql_fetch_array($resultcl)) {
                        ?>
                        <option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
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
