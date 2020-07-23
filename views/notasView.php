<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CobraMas Notas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="notabox">
            <table id="notahead" class='ui-widget'>
                <thead class='ui-widget-header'>
                    <tr>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>CUENTA</th>
                        <th colspan=5>NOTA</th>
                        <th>BORRAR</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content"><?php
                    if ($main) {
                        foreach ($main as $answer) {
                            ?>
                            <tr>
                                <td><?php echo $answer['fecha']; ?></td>
                                <td><?php echo $answer['hora']; ?></td>
                                <td><?php echo $answer['cuenta']; ?></td>
                                <td colspan=5><?php echo $answer['nota']; ?></td>
                                <td><?php if ($answer['c_cvge'] == $capt) { ?>
                                        <form action="/notas.php" method="get" name="lista<?php echo $answer['auto'];?>" >
                                            <input type="hidden" name="which" readonly="readonly" value=<?php echo $answer['auto']; ?> />
                                            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> />
                                            <input type="submit" name="go" value="BORRAR">
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php } ?>
        <form action="/notas.php" method="get" name="notas">
            <label for='FECHA'>Fecha</label>
            <input type="text" name="FECHA" id="FECHA" value="" SIZE=15 /><br>
            <label for='HORA'>Hora</label>
            <input type="text" name="HORA" id="HORA" value="" />
            <label for='MIN'>Min</label>
            <input type="text" name="MIN" id="MIN" value="" /><br>
            <label for='CUENTA'>Cuenta</label>
            <input type="text" name="CUENTA" id="CUENTA" readonly="readonly" value=<?php echo $CUENTA; ?> /><br>
            <label for='NOTA'>Nota</label>
            <textarea rows="2" cols="40" name="NOTA" id="NOTA"></textarea><br>
            <input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $C_CONT; ?> /><br>
            <input type="hidden" name="D_FECH" readonly="readonly" value=<?php echo date('Y-m-d'); ?> /><br>
            <input type="hidden" name="C_HORA" readonly="readonly" value=<?php echo date('H:i:s'); ?> /><br>
            <input type="hidden" name="AUTO" readonly="readonly" value="" /><br>
            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="submit" name="go" value="GUARDAR">
        </form>
        <button onClick='window.close()'>CIERRA</button>
        <script>
            $(function () {
                $('#HORA').spinner({
                    min: 0,
                    max: 23
                });
                $('#MIN').spinner({
                    min: 0,
                    max: 55,
                    step: 5
                });
                $('#FECHA').datepicker();
            });
        </script>
    </body>
</html> 

