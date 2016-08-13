<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');

function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);

    return date("M", $timestamp);
}
if (!empty(filter_input(INPUT_GET, 'go'))) {
    $cliente    = filter_input(INPUT_GET, 'cliente');
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
    $gestorstr  = '';
    $clientestr = '';
    if ($cliente != 'todos') {
        $clientestr = " and cliente=:cliente ";
    }
    if ($cliente == 'actives') {
        $clientestr = " and status_de_credito not regexp '-' ";
    }
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,d1.queue,
    domicilio_deudor,direccion_nueva,email_deudor,
tel_1,(tel_1 in (select c_tele from livelines))*(1-(tel_1 in (select c_tele from deadlines))) as 't1 efectivo',
tel_2,(tel_2 in (select c_tele from livelines))*(1-(tel_2 in (select c_tele from deadlines))) as 't2 efectivo',
tel_3,(tel_3 in (select c_tele from livelines))*(1-(tel_3 in (select c_tele from deadlines))) as 't3 efectivo',
tel_4,(tel_4 in (select c_tele from livelines))*(1-(tel_4 in (select c_tele from deadlines))) as 't4 efectivo',
tel_1_verif,(tel_1_verif in (select c_tele from livelines))*(1-(tel_1_verif in (select c_tele from deadlines))) as 't1v efectivo',
tel_2_verif,(tel_2_verif in (select c_tele from livelines))*(1-(tel_2_verif in (select c_tele from deadlines))) as 't2v efectivo',
tel_3_verif,(tel_3_verif in (select c_tele from livelines))*(1-(tel_3_verif in (select c_tele from deadlines))) as 't3v efectivo',
tel_4_verif,(tel_4_verif in (select c_tele from livelines))*(1-(tel_4_verif in (select c_tele from deadlines))) as 't4v efectivo',
tel_1_laboral,(tel_1_laboral in (select c_tele from livelines))*(1-(tel_1_laboral in (select c_tele from deadlines))) as 't1l efectivo',
tel_2_laboral,(tel_2_laboral in (select c_tele from livelines))*(1-(tel_2_laboral in (select c_tele from deadlines))) as 't2l efectivo',
tel_1_ref_1,(tel_1_ref_1 in (select c_tele from livelines))*(1-(tel_1_ref_1 in (select c_tele from deadlines))) as 't1r1 efectivo',
tel_1_ref_2,(tel_1_ref_2 in (select c_tele from livelines))*(1-(tel_1_ref_2 in (select c_tele from deadlines))) as 't1r2 efectivo'
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
where 1=1
".$clientestr." 
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
    ;";
    $std       = $pdo->prepare($querymain);
    if ($cliente != 'todos') {
        $std->bindParam(':cliente', $cliente);
    }
    $std->execute();
    $result = $std->fetchAll(PDO::FETCH_ASSOC);
// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();

    $filename = "Query_de_inventario_".date('ymd').".xlsx";

    $output   = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $row['saldo_total'] = (float) $row['saldo_total'];
        $output[]           = $row;
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
            <title>Query del Inventario</title>

            <style type="text/css">
                body {font-family: arial, helvetica, sans-serif; font-size: 8pt; }
                table {border: 1pt solid #000000;background-color: #c0c0c0;}
                tr:hover {background-color: #ff0000;}
                th {border: 1pt solid #000000;background-color: #c0c0c0;}
                .loud {text-align:center; font-weight:bold; color:red;}
                .num {text-align:right;}
            </style>
        </head>
        <body>
            <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
            <form action="inventario.xls.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>Cliente: 
                    <select name="cliente">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <option value="actives" style="font-size:120%;">todos activos</option>
                        <?php
                        $queryc  = "SELECT distinct cliente FROM clientes
        order by cliente
	";
                        $resultc = $pdo->query($queryc);
                        foreach ($resultc as $answerc) {
                            ?>
                            <option value="<?php echo $answerc['cliente']; ?>" style="font-size:120%;">
                                <?php echo $answerc['cliente']; ?></option>
                            <?php }
                            ?>
                    </select>
                </p>
                <input type='submit' name='go' value='Query Inventario'>
            </form>
        </body>
    </html>
    <?php
}
