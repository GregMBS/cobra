<?php
use App\PdoClass;
use App\BigClass;

$pc             = new PdoClass();
$pdo            = $pc->dbConnectAdmin();
$bc             = new BigClass($pdo);
$resultGestores = $bc->getPromesasGestores();
$resultClientes = $bc->getPromesasClientes();
$datesAsc       = $bc->getGestionDates('asc');
$datesDesc      = $bc->getGestionDates('desc');
$promDatesAsc       = $bc->getPromesasDates('asc');
$promDatesDesc      = $bc->getPromesasDates('desc');

$get  = filter_input_array(INPUT_GET);
$capt = $get['capt'];
if (!empty($get['go'])) {
    if ($get['fecha2'] < $get['fecha1']) {
        list($get['fecha1'], $get['fecha2']) = array($get['fecha2'], $get['fecha1']);
    }

    $result = $bc->getAllGestiones(
        $get['fecha1'], $get['fecha2'], $get['gestor'], $get['cliente']
    );
}
?>
<!DOCTYPE html">
<html>
    <head>
        <title>Query de las Gestiones</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="bigquery2.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>Gestor: 
                <select name="gestor">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
                    foreach ($resultGestores as $gestores) {
                        ?>
                        <option value="<?php echo $gestores[0]; ?>" style="font-size:120%;">
                            <?php echo $gestores[0]; ?></option>
                    <?php }
                    ?>
                </select>
            </p>
            <p>Cliente: 
                <select name="cliente">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <?php
                    foreach ($resultClientes as $clientes) {
                        ?>
                        <option value="<?php echo $clientes[0]; ?>" style="font-size:120%;">
                            <?php echo $clientes[0]; ?></option>
                    <?php }
                    ?>
                </select>
            </p>
            <p>HECHO de:
                <select name="fecha1">
                    <?php
                    foreach ($datesAsc as $date) {
                        ?>
                        <option value="<?php echo $date[0]; ?>" style="font-size:120%;">
                            <?php echo $date[0]; ?></option>
                    <?php } ?>
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
            <input type='submit' name='go' value='Query Gestiones'>
        </form>
        <?php
        if (!empty($get['go'])) {
            ?>
            <table>
                <tr>
                    <?php
                    $cuentaPos = 0;
                    $i         = 0;
                    foreach ($result as $key => $value) {
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
                                <a href="resumen.php?find=<?php echo $cell; ?>&field=numero_de_cuenta&qs=qs&capt=<?php echo $capt; ?>&go=QUICKSEARCH&from=%2Fbigpromsv.php&go1=QUICKSEARCH">
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
