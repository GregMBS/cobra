<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

$get  = filter_input_array(INPUT_GET);

function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);

    return date("M", $timestamp);
}
if (!empty($get['go'])) {
    $gestor = $get['gestor'];
    $cliente = $get['cliente'];
    $fecha1 = $get['fecha1'];
    $fecha2 = $get['fecha2'];
    if ($fecha2 < $fecha1) {
        list($fecha1, $fecha2) = array($fecha2, $fecha1);
    }
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
    $gestorstr  = '';
    $clientestr = '';
    if ($gestor != 'todos') {
        $gestorstr = " and c_cvge=:gestor ";
    }
    if ($cliente != 'todos') {
        $clientestr = " and c_cvba=:cliente ";
    }
    $querymain = "SELECT numero_de_cuenta as 'cuenta',nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento',
    saldo_total,d1.queue,h1.*,d2.v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,pagos.fecha as 'fecha pago', 
    pagos.monto as 'monto pago'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between :fecha1 and :fecha2
".$gestorstr.$clientestr." 
and not exists 
(select h2.auto from historia h2, dictamenes d3 
where h2.c_cvst=d3.dictamen and h1.c_cont=h2.c_cont and d3.v_cc<d2.v_cc 
and h2.d_fech between :fecha1 and :fecha2 ".$gestorstr.$clientestr.")
ORDER BY d_fech,c_hrin
    ;";
    $stm       = $pdo->prepare($querymain);
    $stm->bindParam(':fecha1', $fecha1);
    $stm->bindParam(':fecha2', $fecha2);
    if ($gestor != 'todos') {
        $stm->bindParam(':gestor', $gestor);
    }
    if ($cliente != 'todos') {
        $stm->bindParam(':cliente', $cliente);
    }
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $filename = "Query_de_gestiones_".date('ymd', strtotime($fecha1))."_".date('ymd',
            strtotime($fecha2)).".xlsx";
    $output   = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::XLSX);
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
        <body>
            <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
            <form action="bigbest.xls.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>Gestor:
                    <select name="gestor">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <?php
                        $querygestor  = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000
	";
                        $resultgestor = $pdo->query($querygestor);
                        foreach ($resultgestor as $answerc) {
                            ?>
                            <option value="<?php echo $answerc[0]; ?>" style="font-size:120%;">
                                <?php echo $answerc[0]; ?></option>
                            <?php }
                            ?>
                    </select>
                </p>
                <p>Cliente:
                    <select name="cliente">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <?php
                        $queryc  = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month) 
        order by c_cvba
        limit 100
	";
                        $resultc = $pdo->query($queryc);
                        foreach ($resultc as $answerc) {
                            ?>
                            <option value="<?php echo $answerc[0]; ?>" style="font-size:120%;">
                                <?php echo $answerc[0]; ?></option>
                            <?php }
                            ?>
                    </select>
                </p>
                <p>HECHO de:

                    <select name="fecha1">
                        <?php
                        $queryfechastart  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech limit 360";
                        $resultfechastart = $pdo->query($queryfechastart);
                        foreach ($resultfechastart as $answerma) {
                            ?>
                            <option value="<?php echo $answerma[0]; ?>" style="font-size:120%;">
                                <?php echo $answerma[0]; ?></option>
                            <?php } ?>
                    </select>
                    a:

                    <select name="fecha2">
                        <?php
                        $queryma  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech desc limit 60";
                        $resultma = $pdo->query($queryma);
                        foreach ($resultma as $answerma) {
                            ?>
                            <option value="<?php echo $answerma[0]; ?>" style="font-size:120%;">
                                <?php echo $answerma[0]; ?></option>
                            <?php } ?>
                    </select>
                </p>
                <input type='submit' name='go' value='Query Gestiones'>
            </form>
        </body>
    </html>
    <?php
}

