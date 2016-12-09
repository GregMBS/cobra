<!DOCTYPE HTML>

<html>
    <head>
        <title>ROBOT Control</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script> 
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" type="text/javascript"></script> 
        <style>
            div {float:left;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <div>
            <table summary='ACTUAL' class="ui-widget">
                <thead class="ui-widget-header">
                    <tr>
                        <th>Cliente</th>
                        <th>Cuentas</th>
                        <th>Tel&eacute;fonos</th>
                        <th>Registros</th>
                        <th>Lineas</th>
                        <th>% Marcado</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    foreach ($resulta as $rowa) {
                        $client = $rowa['msg'];
                        $ctas = $rowa['countid'];
                        $tels = $rowa['counttel'];
                        $lins = $rowa['lineas'];
                        $regs = $rowa['total'];
                        $pc = $rowa['percent'] . "%";
//                        $tiempo = $rowa['tiempo'];
                        ?>
                        <tr>
                            <td><?php echo $client; ?></td>
                            <td class="num"><?php echo $ctas; ?></td>
                            <td class="num"><?php echo $tels; ?></td>
                            <td class="num"><?php echo $regs; ?></td>
                            <td class="num"><?php echo $lins; ?></td>
                            <td class="num"><?php echo $pc; ?></td>->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div>
            <form action='#' method='get' name='kills'>
                <input type='hidden' name='capt' value='<?php echo $capt; ?>'>
                <input type='submit' name='killall' value='PARAR TODOS'>
            </form>
            <form action='#' method='get' name='resets'>
                <input type='hidden' name='capt' value='<?php echo $capt; ?>'>
                <input type='submit' name='countreset' value='CERO CONTADORES'>
            </form>
            <form action='#' method='get' name='cleans'>
                <input type='hidden' name='capt' value='<?php echo $capt; ?>'>
                <input type='submit' name='cleanslate' value='VACIAR LISTA'>
            </form>
<!--            <form action='roboclean.php' method='get' name='prepare'>
                <input type='hidden' name='capt' value='<?php echo $capt; ?>'>
                <input type='submit' name='prepares' value='PREPARAR LISTA'>
            </form>-->
            <button onclick="window.location = 'robocon.php?capt=<?php echo $capt; ?>'">RECARGA PAGINA</button>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <table summary='CHANGE' class="ui-widget">
                            <tr>
                                <th>Grabaci&oacute;n</th>
                                <th>Lineas</th>
                            </tr>
                            <?php
                            foreach ($result as $row) {
                                $msg = $row['msg'];
                                $lineas = (int) $row['lineas'];
                                $auto = (int) $row['auto'];
                                ?>
                                <form action='#' method='get' name='<?php echo $msg; ?>'>
                                    <input type='hidden' name='capt' value='<?php echo $capt; ?>'>
                                    <input type='hidden' name='auto' value='<?php echo $auto; ?>'>
                                    <tr>
                                        <td><?php echo $msg; ?></td>
                                        <td>
                                            <select name="lineas">
                                                <?php
                                                for ($i = 0; $i < 15; $i++) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>" style="font-size:120%;" <?php
                                                            if ($i == $lineas) {
                                                                echo "selected='selected'";
                                                            }
                                                            ?>>
                                                                <?php
                                                                echo $i;
                                                            }
                                                            ?></option>
                                            </select>
                                        </td>
                                        <td><input type='submit' name='go' value='CAMBIAR'></td>
                                        <td><input type='submit' name='go' value='BORRAR'></td>
                                    </tr>
                                </form>
<?php } ?>
                        </table>
                    </td>

                </tr>
            </table>
        </div>
        <script>
            $(function () {
                $("button").button();
                $("input[type=submit]").button();
            });
        </script>	
    </body>
</html>
