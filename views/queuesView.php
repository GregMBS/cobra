<!DOCTYPE html>
<html>
    <head>
        <title>Administraci&oacute;n de los queues</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <div style='clear:both;background-color:#ffffff;width:100%'>
            <div style='float:left;width:25%'>Gestor</div>
            <div style='float:left;width:50%'>Queue</div>
        </div>
        <div>
            <div style='clear:both;border:1pt black solid'>
                <form method='get' action='queues.php' name='todos'>
                    <div style='float:left;width:25%'>
                        <input name='gestor' type='text' readonly='readonly' value='todos'>
                    </div>
                    <div style='float:left;width:40%'>
                        <select name='queue'>
                            <?php
                            foreach ($resultq->fetchAll(PDO::FETCH_ASSOC) as $rowq) {
                                $CLIENTE = $rowq['cliente'];
                                $SDC = $rowq['sdc'];
                                $CR = $rowq['status_aarsa'];
                                if ($CR == '.') {
                                    $CR = 'todos';
                                }
                                $bloqueado = $rowq['bloqueado'];
                                $campsel = '';
                                ?>
                                <option value='<?php
                                echo $CLIENTE . ',' . $SDC . ',' . $CR;
                                ?>' <?php
                                        if ($bloqueado == 1) {
                                            echo "class='blocked'";
                                        }
                                        ?>><?php echo $CLIENTE . '-' . $SDC . '-' . $CR; ?></option>
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
            foreach ($resultlist->fetchAll(PDO::FETCH_ASSOC) as $rowlist) {
                $GESTOR = $rowlist['gestor'];
                $tipo = $rowlist['tipo'];
                $campnow = $rowlist['campnow'];
                ?>
                <div style='clear:both;border:1pt black solid'>
                    <form method='get' action='queues.php' name='<?php echo $GESTOR; ?>'>
                        <div style='float:left;width:25%'>
                            <input name='gestor' type='text' readonly='readonly' value='<?php echo $GESTOR; ?>'>
                        </div>
                        <div style='float:left;width:40%'>
                            <?php
                            $queryqc = "SELECT cliente, sdc, status_aarsa, 
                                nombres.camp as campnow
                                FROM queuelist, nombres 
                                WHERE gestor = :gestor and gestor=iniciales 
                                and nombres.camp=queuelist.camp
                                and cliente<>''
                                ORDER BY cliente,sdc,status_aarsa;";
                            $stqc = $pdo->prepare($queryqc);
                            $stqc->bindParam(':gestor', $GESTOR);
                            $stqc->execute();
                            $resultqc = $stqc->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($resultqc as $rowqc) {
                                $CLIENTEc = $rowqc['cliente'];
                                $SDCc = $rowqc['sdc'];
                                $CRc = $rowqc['status_aarsa'];
                                if ($CRc == '.') {
                                    $CRc = 'todos';
                                }
                                $CAMPc = $rowqc['campnow'];
                                echo $CLIENTEc . '-' . $SDCc . '-' . $CRc;
                            }
                            ?>
                            <br>
                            <select name='camp'>
                                <?php
                                $queryqa = "SELECT cliente, sdc, status_aarsa,
                                    camp, bloqueado
                                    FROM queuelist
                                    WHERE gestor = :gestor
                                    and cliente<>''
                                    ORDER BY cliente,sdc,camp;";
                                $stqa = $pdo->prepare($queryqa);
                                $stqa->bindParam(':gestor', $GESTOR);
                                $stqa->execute();
                                $resultqa = $stqa->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($resultqa as $rowq) {
                                    $CLIENTE = $rowq['cliente'];
                                    $SDC = $rowq['sdc'];
                                    $CR = $rowq['status_aarsa'];
                                    if ($CR == '.') {
                                        $CR = 'todos';
                                    }
                                    $CAMP = $rowq['camp'];
                                    $bloqueado = $rowq['bloqueado'];
                                    $campsel = '';
                                    ?>
                                    <option value='<?php echo $CAMP; ?>' <?php
                                    if ($bloqueado == 1) {
                                        echo "class='blocked'";
                                    }
                                    ?>><?php echo $CLIENTE . '-' . $SDC . '-' . $CR; ?></option>
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

