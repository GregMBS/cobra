<!DOCTYPE html>
<html lang='es'>
    <head>
        <title>CobraMas - Cambio de Status</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>CAMBIO DE STATUS</h1>
        <button onClick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar al panel administrativo</button>
        <table class="ui-widget" id="buscarTable">
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
                $j = 0;
                foreach ($result as $row) {
                    $j = $j + 1;
                    $CUENTA = $row['numero_de_cuenta'];
                    $NOMBRE = utf8_decode($row['nombre_deudor']);
                    $CLIENTE = $row['cliente'];
                    $ID_CUENTA = $row['id_cuenta'];
                    $STATUS = $row['status_de_credito'];
                    $STATUSC = $row['status_aarsa'];
                    if (preg_match('/-/', $STATUS)) {
                        $INACTIVO = 1;
                    } else {
                        $INACTIVO = 0;
                    }
                    ?>
                    <tr>
                        <td><a href='/resumen.php?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>&highlight=<?php echo $field ?>&hfind=<?php echo $find ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo utf8_decode($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $STATUS; ?><br>
                            <form method='get' action='/changest.php' name='<?php echo $ID_CUENTA; ?>'>
                                INACTIVO<input type="checkbox" name="inactivo" value="inactivo"<?php
                                if ($INACTIVO == 1) {
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
        <div id="searchBox">
            <h2>Buscar</h2>
            <form name="search" method="get" action=
                  "/changest.php" id="search">Buscar a: <input type=
                                                        "text" name="find"> en <select name="field">
                    <option value="nombre_deudor">Nombre</option>
                    <option value="numero_de_cuenta">Cuenta</option>
                    <option value="id_cuenta">Expediente</option>
                </select><br>
                Client = <select name="cliente">
                    <option value=" ">Todos</option>
                    <?php
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
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('#buscarTable').dataTable({
                    "bPaginate": false,
                    "bJQueryUI": true
                });
            });
        </script>
    </body>
</html>
