<!DOCTYPE html>
<html lang='es'>
    <head>
        <title>CobraMas Visitador Asignaciones y Recepciones</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body onLoad="<?php if (!empty($gestor)) { ?>
            document.getElementById('CUENTA').focus();
          <?php } ?>">
        <div id="vtable">
            <h1><?php echo $message; ?></h1>
            <form id='asigform' action='/checkin.php' method='get'>
                <span class="formcap">Visitador:</span>
                <select name="gestor" id="gestor" onChange="$('#asigform').submit();">
                    <option></option>
                    <?php
                    foreach ($result as $answer) {
                        ?>
                        <option value="<?php echo $answer['usuaria']; ?>" <?php if ($gestor == $answer['usuaria']) {
                            ?> selected='selected'<?php } ?>><?php echo htmlentities($answer['usuaria'] . '-' . $answer['completo']); ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <input type="text" id="CUENTA" name="CUENTA" value=""><br>
                c&oacute;digo de barras<input type="radio" id="CUENTA" name="tipo" <?php
                if ($tipo == 'id_cuenta') {
                    ?>checked="checked"<?php } ?> value="id_cuenta">
                numero de credito<input type="radio" id="CUENTA" name="tipo" <?php if ($tipo == 'numero_de_cuenta') {
                    ?>checked="checked"<?php } ?> value="numero_de_cuenta">
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <input type="hidden" name="go" value="RECIBIR">
                <input type="submit" value="RECIBIR">
            </form>
            <button onclick="window.location = 'checkoutlist.php?capt=<?php echo $capt; ?>&visitador=<?php echo $gestor; ?>'">CHECKLIST</button>
            <?php
            if ($resultcount) {
                $ASIG = $resultcount['countOut'];
                $RECIB = $resultcount['countIn'];
            }
            ?>
            <p>Asignado: <?php echo $ASIG; ?><br>
                Recibido: <?php echo $RECIB; ?></p>
            <table class="ui-widget">
                <thead class="ui-widget-header">
                    <tr>
                        <th>ID CUENTA</th>
                        <th>CUENTA</th>
                        <th>NOMBRE</th>
                        <th>CLIENTE</th>
                        <th>SALDO TOTAL</th>
                        <th>QUEUE</th>
                        <th>GESTOR</th>
                        <th>FECHA DE ASIGNA</th>
                        <th>FECHA DE REGRESA</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    if (!empty($gestor)) {
                        foreach ($resultcc as $answer) {
                            $GESTOR = $answer['gestor'];
                            $ID_CUENTA = $answer['id_cuenta'];
                            $CUENTA = $answer['numero_de_cuenta'];
                            $ST = $answer['saldo_total'];
                            $CLIENTE = $answer['cliente'];
                            $QUEUE = $answer['queue'];
                            $NOMBRE = $answer['nombre_deudor'];
                            $FECHAOUT = $answer['fechaout'];
                            $FECHAIN = $answer['fechain'];
                            ?>
                            <tr>
                                <td><?php echo $ID_CUENTA; ?></td>
                                <td><?php echo $CUENTA; ?></td>
                                <td><?php echo $NOMBRE; ?></td>
                                <td><?php echo $CLIENTE; ?></td>
                                <td><?php echo number_format($ST, 0); ?></td>
                                <td><?php echo $QUEUE; ?></td>
                                <td><?php echo $GESTOR; ?></td>
                                <td><?php echo $FECHAOUT; ?></td>
                                <td><?php echo $FECHAIN; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
    </body>
</html>