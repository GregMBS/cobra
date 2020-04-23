<!DOCTYPE html>
<html>
    <head>
        <title>CobraMas - Buscar</title>
        <meta charset="utf-8">
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
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
    </head>
    <body>
        <h1>BUSCAR</h1>
        <button onClick="window.location = '<?php echo $from; ?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $C_CONT; ?>&capt=<?php echo $capt; ?>'">Regresar al resumen</button>
        <table class="ui-widget" id="buscarTable">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>CAMPAÑA</th>
                </tr>
            </thead>
            <tbody class="ui-widget-c">
                <?php
                $j = 0;

                foreach ($result as $row) {
                    $j = $j + 1;
                    $CUENTA = $row['numero_de_cuenta'];
                    $NOMBRE = $row['nombre_deudor'];
                    $CLIENTE = $row['cliente'];
                    $ID_CUENTA = $row['id_cuenta'];
                    $STATUS = $row['status_de_credito'];
                    ?>
                    <tr>
                        <td><a<?php if (preg_match('/-/', $STATUS)) { ?> style="color:#c0c0c0;"<?php } ?> href='<?php echo $from; ?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA; ?>&capt=<?php echo $capt; ?>&highlight=<?php echo $field ?>&hfind=<?php echo $find ?>'><?php echo $CUENTA; ?></a></td>
                        <td><?php echo htmlentities($NOMBRE); ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo $STATUS; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div id="searchBox">
            <h2>Buscar</h2>
            <form name="search" method="get" action=
                  "/buscar.php" id="search">Buscar a: <input type=
                                                      "text" name="find"> en <select name="field">
                    <option value="numero_de_cuenta">Cuenta</option>
                    <option value="numero_de_credito"># del Grupo</option>
                    <option value="nombre_deudor">Nombre</option>
                    <option value="domicilio_deudor">Direcci&oacute;n</option>
                    <option value="TELS">Telefonos</option>
                    <option value="ROBOT">Telefonos marcados</option>
                    <option value="REFS">Aval/Referencias</option>
                    <option value="id_cuenta">Expediente</option>
                </select><br>
                Client = <select name="cliente">
                    <option value=" ">Todos</option>
                    <?php
                    foreach ($resultcl as $answercl) {
                        ?>
                        <option value="<?php echo $answercl['cliente']; ?>"><?php echo $answercl[0]; ?>
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
