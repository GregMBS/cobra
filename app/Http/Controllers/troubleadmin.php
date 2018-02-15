<?php
use cobra_salsa\PdoClass;

$pc   = new PdoClass();
$pdo  = $pc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go   = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == 'RESOLVER') {
        $auto       = filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
        $reparacion = filter_input(INPUT_GET, 'reparacion');
        $queryup    = "UPDATE trouble
            set fechacomp=now(),
            it_guy=:capt,
            reparacion=:reparacion
            where auto=:auto;";
        $stu        = $pdo->prepare($queryup);
        $stu->bindParam(':capt', $capt);
        $stu->bindParam(':reparacion', $reparacion);
        $stu->bindParam(':auto', $auto);
        $stu->execute();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA Trouble Admin</title>
        <meta http-equiv="refresh" content="60"/>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="troublebox">
            <table class="ui-widget" id="notahead">
                <thead class='ui-widget-header'>
                    <tr>
                        <th>Fecha/hora</th>
                        <th>Sistema</th>
                        <th>Usuario</th>
                        <th>Fuente</th>
                        <th>Descripcion</th>
                        <th>Error Mensaje</th>
                        <th>Reparacion</th>
                        <th>Arreglado?</th>
                    </tr>
                </thead>
                <?php
                $querysub = "SELECT * FROM trouble ORDER BY fechahora desc";
                $rowsub   = $pdo->query($querysub);
                if ($rowsub) {
                    ?>
                    <tbody class="ui-widget-content">
                        <?php foreach ($rowsub as $answer) { ?>
                            <tr>
                                <td><?php echo $answer['fechahora']; ?></th>
                                <td><?php echo $answer['sistema']; ?></th>
                                <td><?php echo $answer['usuario']; ?></th>
                                <td><?php echo $answer['fuente']; ?></th>
                                <td><?php echo $answer['descripcion']; ?></th>
                                <td><?php echo $answer['error_msg']; ?></th>
                                <td>
                                    <?php if (empty($answer['it_guy'])) { ?>
                                        <form action="troubleadmin.php" method="get" name="lista<?php echo $answer['auto']; ?>">
                                            <input type="hidden" name="which" readonly="readonly" value=<?php echo $answer['auto']; ?> />
                                            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> />
                                            <input type="text" name="reparacion" /></th>
                                        </form>
                                        <?php
                                    } else {
                                        echo $answer['reparacion'];
                                    }
                                    ?>
                                <td>
                                    <?php if (empty($answer['it_guy'])) { ?>
                                        <input type="submit" name="go" value="RESOLVER">
                                        <?php
                                    } else {
                                        echo $answer['fechacomp'].' '.$answer['IT_guy'];
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </body>
</html> 
