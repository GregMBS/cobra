<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administraci&oacute;n de los queues</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la plantilla administrativa</button><br>
        <div style='clear:both;background-color:#ffffff;width:100%'>
            <div style='float:left;width:25%'>Gestor</div>
            <div style='float:left;width:50%'>Queue</div>
        </div>
        <div>
            <div style='clear:both;border:1pt black solid'>
                <form method='get' action='/queues.php' name='todos'>
                    <div style='float:left;width:25%'>
                        <input name='gestor' type='text' readonly='readonly' value='todos'>
                    </div>
                    <div style='float:left;width:40%'>
                        <select name='queue'>
                            <?php
                            foreach ($queues as $rowQ) {
                                $CR = $rowQ['status_aarsa'];
                                if ($CR == '.') {
                                    $CR = 'todos';
                                }
                                ?>
                                <option value='<?php
                                echo $rowQ['cliente'] . ',' . $rowQ['sdc'] . ',' . $CR;
                                ?>' <?php
                                        if ($rowQ['bloqueado'] == 1) {
                                            echo "class='blocked'";
                                        }
                                        ?>><?php echo $rowQ['cliente'] . '-' . $rowQ['sdc'] . '-' . $CR; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div style='float:left;width:30%'>
                        <input type="submit" name="go" value="INTRO TODOS"><br>
                        <input type="submit" name="go" value="BLOQUEAR TODOS"><br>
                        <input type="submit" name="go" value="DESBLOQUEAR TODOS">
                    </div>
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                </form>
            </div>
        </div>
        <div>
            <?php
            foreach ($resultlist as $rowlist) {
                ?>
                <div style='clear:both;border:1pt black solid'>
                    <form method='get' action='/queues.php' name='<?php echo $rowlist['gestor']; ?>'>
                        <div style='float:left;width:25%'>
                            <input name='gestor' type='text' readonly='readonly' value='<?php echo $rowlist['gestor']; ?>'>
                        </div>
                        <div style='float:left;width:40%'>
                            <?php
                            $rowqc = $qc->getMyQueue($rowlist['gestor']);
                            if (is_array($rowqc)) {
                                $CRc = $rowqc['status_aarsa'];
                                if ($CRc == '.') {
                                    $CRc = 'todos';
                                }
                                echo $rowqc['cliente'] . '-' . $rowqc['sdc'] . '-' . $CRc;
                            }
                            ?>
                            <br>
                            <select name='camp'>
                                <?php
                                $resultqa = $qc->getMyQueuelist($rowlist['gestor']);
                                foreach ($resultqa as $rowQ) {
                                    $CR = $rowQ['status_aarsa'];
                                    if ($CR == '.') {
                                        $CR = 'todos';
                                    }
                                    ?>
                                    <option value='<?php echo $rowQ['camp']; ?>' <?php
                                    if ($rowQ['bloqueado'] == 1) {
                                        echo "class='blocked'";
                                    }
                                    ?>><?php echo $rowQ['cliente'] . '-' . $rowQ['sdc'] . '-' . $CR; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                        <div style='float:left;width:30%'>
                            <input type="submit" name="go" value="INTRO">
                            <input type="submit" name="go" value="BLOQUEAR">
                            <input type="submit" name="go" value="DESBLOQUEAR">
                        </div>
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    </form>
                </div>
            <?php } ?>
        </div>
    </body>
</html> 

