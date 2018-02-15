<!DOCTYPE html">
<html>
    <head>
        <title>Query de las Pagos</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="bigpagos.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="{{ $capt }}">
            <p>Gestor:
                <select name="gestor">
                    <option value="todos" style="font-size:120%;">todos</option>
                    @include('tools.optionLoop', ['array' => $resultGestores])
                </select>
            </p>
            <p>Cliente:
                <select name="cliente">
                    <option value="todos" style="font-size:120%;">todos</option>
                    @include('tools.optionLoop', ['array' => $resultClientes])
                </select>
            </p>
            <p>PAG&Oacute; de:
                <select name="fecha1">
                @include('tools.optionLoop', ['array' => $$datesAsc])
                </select>
                a:
                <select name="fecha2">
                    <?php
                    foreach ($datesDesc as $date) {
                        ?>
                        <option value="<?php echo $date[0]; ?>" style="font-size:120%;">
                            <?php echo $date[0]; ?></option>
                        <?php } ?>
                </select>
            </p>
            <input type='submit' name='go' value='Query Pagos'>
        </form>
        <?php
        if (!empty($get['go'])) {
            ?>
            <table>
                <tr>
                    <?php
                    $cuentaPos = 0;
                    $i         = 0;
                    $row       = $result[0];
                    foreach ($row as $key => $value) {
                        if ($key == 'CUENTA') {
                            $cuentaPos = $i;
                        }
                        echo '<th>'.$key.'</th>';
                        $i++;
                    }
                    ?>
                </tr>
                <?php
                foreach ($result as $row) {
                    echo '<tr>';
                    $ij = 0;
                    foreach ($row as $cell) {
                        if ($ij == $cuentaPos) {
                            ?>
                            <td>
                                <a href="resumen.php?find=<?php echo $cell; ?>&field=numero_de_cuenta&qs=qs&capt=<?php echo $capt; ?>&go=QUICKSEARCH&from=%2Fbigpagos.php&go1=QUICKSEARCH">
                                    <?php echo $cell; ?></a></td>
                                    <?php
                        } else {
                            echo '<td>'.$cell.'</td>';
                        }
                        $ij++;
                    }
                    echo '</tr>';
                }
                ?>
            </table>
        <?php } ?>
    </body>
</html> 
