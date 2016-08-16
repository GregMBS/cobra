<!DOCTYPE html>
<html>
    <head>
        <title>CobraMas Trouble Admin</title>
        <meta http-equiv="refresh" content="60"/>
        <link href="public/bower_resources/jqueryui/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="public/bower_resources/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="public/bower_resources/jqueryui/jquery-ui.js" type="text/javascript"></script>
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
                                        <form action="troubleadmin.php" method="get" name="lista<?echo $answer['auto'];?>">
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
                                        echo $answer['fechacomp'] . ' ' . $answer['IT_guy'];
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
