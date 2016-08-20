<!DOCTYPE html>
<html>
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
            <form id='asigform' action='checkboth.php' method='get'>
                <span class="formcap">Visitador:</span>
                <select name="gestor" onChange="document.getElementById('asigform').submit()">
                    <option value='' <?php if ($gestor == '') { ?> selected='selected'<?php } ?>></option>
                    <?php
                    foreach ($result as $answer) {
                        ?>
                        <option value="<?php echo $answer[0]; ?>" <?php
                        if ($gestor == $answer[0]) {
                            ?> selected='selected'<?php } ?>><?php echo htmlentities($answer[1]); ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <select name="fechaout">
                    <option value='' <?php if ($fechaout == '') { ?> selected='selected'<?php } ?>></option>
                    <?php
                    foreach ($resultd as $answerd) {
                        ?>
                        <option value="<?php echo $answerd[0]; ?>" <?php
                        if ($fechaout == $answerd[0]) {
                            ?> selected='selected'<?php } ?>><?php echo $answerd[0]; ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <input type="text" id="CUENTA" name="CUENTA" value="">
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <input type="submit" name="go" value="RECIBIR">
            </form>
            <?php
            foreach ($resultcount as $answercount) {
                $ASIG = $answercount[0];
                $RECIB = $answercount[1];
            }
            ?>
            <p>Asignado: <?php echo $ASIG; ?><br>
                Recibido: <?php echo $RECIB; ?></p>
            <table>
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
                <?php
                $gstring = '';
                if (!empty($gestor)) {
                    $gstring = " where gestor = :gestor order by fechain desc";
                }
                foreach ($resultmain as $answermain) {
                    $ID_CUENTA = $answermain[0];
                    $CUENTA = $answermain[1];
                    $NOMBRE = $answermain[2];
                    $CLIENTE = $answermain[3];
                    $ST = $answermain[4];
                    $QUEUE = $answermain[5];
                    $GESTOR = $answermain[6];
                    $FECHAOUT = $answermain[7];
                    $FECHAIN = $answermain[8];
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
            </table>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
    </body>
</html>
