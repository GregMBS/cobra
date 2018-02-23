<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;



$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$get  = filter_input_array(INPUT_GET);

function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);

    return date("M", $timestamp);
}
if (isset($get['fecha1'])) {
    $go     = $get['go'];
    $gestor = $get['gestor'];
    $fecha1 = $get['fecha1'];
    $fecha2 = $get['fecha2'];
    if (isset($get['tipo'])) {
        $tipo = $get['tipo'];
    } else {
        $tipo = '';
    }
    if ($fecha2 < $fecha1) {
        list($fecha1, $fecha2) = array($fecha2, $fecha1);
    }
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
    $gestorstr  = '';
    $clientestr = '';
    if (isset($get['cliente'])) {
        $cliente_array = $get['cliente'];
        $clientes      = filter_var_array($cliente_array,
            FILTER_SANITIZE_ENCODED);
        $clientestr    = " AND resumen.cliente IN ('".urldecode(implode("','",
                    $clientes))."') ";
    }
    if ($gestor != 'todos') {
        $gestorstr = " and c_cvge=:gestor ";
    }
    if ($tipo == 'visits') {
        $gestorstr .= " and c_visit <> '' and c_msge is null ";
    }
    if ($tipo == 'telef') {
        $gestorstr .= " and c_visit IS NULL and c_msge is null ";
    }
    if ($tipo == 'admin') {
        $gestorstr .= " and c_msge <> '' ";
    }
    if ($tipo == 'noadmin') {
        $gestorstr .= " and c_msge IS NULL ";
    }
    if ($tipo == 'todos') {
        $gestorstr .= " ";
    }

    $querymain = "SELECT numero_de_cuenta as 'cuenta',nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento', subproducto,
    saldo_total,saldo_descuento_1,saldo_descuento_2,d1.queue,h1.*,d2.v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,pagos.fecha as 'fecha pago',
    pagos.monto as 'monto pago', fecha_de_asignacion as 'fecha de asignacion'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between :fecha1 and :fecha2
".$gestorstr.$clientestr."
ORDER BY d_fech,c_hrin
    ;";
    $stm       = $pdo->prepare($querymain);
    $stm->bindParam(':fecha1', $fecha1);
    $stm->bindParam(':fecha2', $fecha2);
    if ($gestor != 'todos') {
        $stm->bindParam(':gestor', $gestor);
    }
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $filename = "Query_de_gestiones_".$fecha1.'_'.$fecha2.".csv";
    $output   = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $row['saldo_total'] = (float) $row['saldo_total'];
        $row['saldo_descuento_1'] = (float) $row['saldo_descuento_1'];
        $row['saldo_descuento_2'] = (float) $row['saldo_descuento_2'];
        $row['n_prom'] = (float) $row['n_prom'];
        $row['n_prom1'] = (float) $row['n_prom1'];
        $row['n_prom2'] = (float) $row['n_prom2'];
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::CSV);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Query de las Promesas/Propuestas</title>
            <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
        </head>
        <body>
            <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
            <form action="bigquery2.xls.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>Gestor: <?php
                    if (isset($gestor)) {
                        echo $gestor;
                    }
                    ?>
                    <select name="gestor">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <?php
                        $queryg  = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        and c_cvge <> ''
        order by c_cvge
        limit 1000
	";
                        $resultg = $pdo->query($queryg);
                        foreach ($resultg as $answerg) {
                            ?>
                            <option value="<?php echo $answerg['c_cvge']; ?>" style="font-size:120%;">
                                <?php echo $answerg['c_cvge']; ?></option>
                        <?php }
                        ?>
                    </select>
                </p>
                <h2>Cliente:</h2>
                <p><?php
                    if (isset($cliente)) {
                        echo $cliente;
                    }
                    ?>
                    <?php
                    $queryc  = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvba
        limit 100
	";
                    $resultc = $pdo->query($queryc);
                    foreach ($resultc as $answerc) {
                        ?>
                        <input type="checkbox" name="cliente[]" value="<?php echo $answerc['c_cvba']; ?>" />
                        <?php echo $answerc['c_cvba']; ?><br>
                    <?php }
                    ?>
                </p>
                <p>HECHO de:
                    <?php
                    if (isset($fecha1)) {
                        echo $fecha1;
                    }
                    ?>
                    <select name="fecha1">
                        <?php
                        $queryf1  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 6 month)
        ORDER BY d_fech limit 360";
                        $resultf1 = $pdo->query($queryf1);
                        foreach ($resultf1 as $answerf1) {
                            ?>
                            <option value="<?php echo $answerf1[0]; ?>" style="font-size:120%;">
                                <?php echo $answerf1[0]; ?></option>
                        <?php } ?>
                    </select>
                    a:
                    <?php
                    if (isset($fecha2)) {
                        echo $fecha2;
                    }
                    ?>
                    <select name="fecha2">
                        <?php
                        $queryf2  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 6 month)
        ORDER BY d_fech desc limit 60";
                        $resultf2 = $pdo->query($queryf2);
                        foreach ($resultf2 as $answerf2) {
                            ?>
                            <option value="<?php echo $answerf2[0]; ?>" style="font-size:120%;">
                                <?php echo $answerf2[0]; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <label for='visits'>Visitas</label>
                <input type='radio' name='tipo' id='visits' value='visits' /><br>
                <label for='telef'>Telefonica</label>
                <input type='radio' name='tipo' id='telef' value='telef' /><br>
                <label for='admin'>Visitas y Telefonica</label>
                <input type='radio' name='tipo' id='noadmin' value='noadmin' /><br>
                <label for='admin'>ROBOT/Carteo</label>
                <input type='radio' name='tipo' id='admin' value='admin' /><br>
                <label for='todos'>Todos</label>
                <input type='radio' name='tipo' id='todos' value='todos' /><br>
                <input type='submit' name='go' value='Query Gestiones'>
            </form>
        </body>
    </html>
    <?php
}
