<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CobraMas Visitador Asignaciones y Recepciones</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body onLoad="<?php if (!empty($gestor)) { ?>
            document.getElementById('CUENTA').focus()
    <?php } else { ?>
                document.getElementById('CUENTA').disabled = true
    <?php } ?>
          ">
        <div id="vtable">
            <h1><?php echo $message; ?></h1>
            <form id='asigform' action='/checkboth.php' method='get'>
                <span class="formcap">Visitador:</span>
                <select name="gestor" onChange="document.getElementById('asigform').submit()">
                    <option value='' <?php if ($gestor == '') { ?> selected='selected'<?php } ?>></option>
                    <?php
                    foreach ($main as $answer) {
                        ?>
                        <option value="<?php echo $answer['usuaria']; ?>" <?php
                        if ($gestor == $answer['usuaria']) {
                            ?> selected='selected'<?php } ?>><?php echo htmlentities($answer['completo']); ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <select name="fechaout">
                    <option value='' <?php if ($fechaout == '') { ?> selected='selected'<?php } ?>></option>
                    <?php
                    foreach ($resultd as $answerd) {
                        ?>
                        <option value="<?php echo $answerd; ?>" <?php
                        if ($fechaout == $answerd) {
                            ?> selected='selected'<?php } ?>><?php echo $answerd; ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <input type="text" id="CUENTA" name="CUENTA" value="">
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <input type="submit" name="go" value="RECIBIR">
            </form>
            <p>Asignado: <?php echo $resultcount['countOut']; ?><br>
                Recibido: <?php echo $resultcount['countIn']; ?></p>
            <table class="ui-widget">
                <thead class="ui-widget-header">
                    <tr>
                        <th>ID_CUENTA</th>
                        <th>CUENTA</th>
                        <th>NOMBRE</th>
                        <th>CLIENTE</th>
                        <th>SALDO TOTAL</th>
                        <th>QUEUE</th>
                        <th>GESTOR</th>
                        <th>ASIG.</th>
                        <th>RECIB.</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    foreach ($resultmain as $answermain) {
                        $ID_CUENTA = $answermain['id_cuenta'];
                        $CUENTA = $answermain['numero_de_cuenta'];
                        $NOMBRE = $answermain['nombre_deudor'];
                        $CLIENTE = $answermain['cliente'];
                        $ST = $answermain['saldo_total'];
                        $QUEUE = $answermain['queue'];
                        $GESTOR = $answermain['completo'];
                        $FECHAOUT = $answermain['fechaout'];
                        $FECHAIN = $answermain['fechain'];
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
    </body>
</html>
