<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

use app\PdoClass;
$pdoc = new PdoClass();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');

function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);

    return date("M", $timestamp);
}
if (!empty($go)) {
    $cliente    = filter_input(INPUT_GET, 'cliente');
    $clientestr = '';
    if ($cliente != 'todos') {
        $clientestr = " and cliente=:cliente ";
    }
    $querymain = "SELECT numero_de_cuenta,
if((tel_1 in (select c_tele from livelines))*(1-(tel_1 in (select c_tele from deadlines))),concat('',tel_1),'') as 'tel_1',
if((tel_2 in (select c_tele from livelines))*(1-(tel_2 in (select c_tele from deadlines))),concat('',tel_2),'') as 'tel_2',
if((tel_3 in (select c_tele from livelines))*(1-(tel_3 in (select c_tele from deadlines))),concat('',tel_3),'') as 'tel_3',
if((tel_4 in (select c_tele from livelines))*(1-(tel_4 in (select c_tele from deadlines))),concat('',tel_4),'') as 'tel_4',
if((tel_1_verif in (select c_tele from livelines))*(1-(tel_1_verif in (select c_tele from deadlines))),concat('',tel_1_verif),'') as 'tel_1_verif',
if((tel_2_verif in (select c_tele from livelines))*(1-(tel_2_verif in (select c_tele from deadlines))),concat('',tel_2_verif),'') as 'tel_2_verif',
if((tel_1_ref_1 in (select c_tele from livelines))*(1-(tel_1_ref_1 in (select c_tele from deadlines))),concat('',tel_1_ref_1),'') as 'tel_referencia_1',
if((tel_1_ref_2 in (select c_tele from livelines))*(1-(tel_1_ref_2 in (select c_tele from deadlines))),concat('',tel_1_ref_2),'') as 'tel_referencia_2',
if((tel_1_verif in (select c_tele from livelines))*(1-(tel_1_verif in (select c_tele from deadlines))),concat('',tel_1_verif),'') as 'tel_1_actualizado',
if((tel_2_verif in (select c_tele from livelines))*(1-(tel_2_verif in (select c_tele from deadlines))),concat('',tel_2_verif),'') as 'tel_2_actualizado',
if((tel_3_verif in (select c_tele from livelines))*(1-(tel_3_verif in (select c_tele from deadlines))),concat('',tel_3_verif),'') as 'tel_3_actualizado',
if((tel_4_verif in (select c_tele from livelines))*(1-(tel_4_verif in (select c_tele from deadlines))),concat('',tel_4_verif),'') as 'tel_4_actualizado'
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
where 1=1 
".$clientestr." 
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
    ;";
    $stm       = $pdo->prepare($querymain);
    if ($cliente != 'todos') {
        $stm->bindParam(':cliente', $cliente);
    }
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $filename = "Telefonos_efectivos_".date('ymd')."xls";
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
            <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
            <form action="efectivos.xls.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>Cliente:
                    <select name="cliente">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <?php
                        $queryc  = "SELECT cliente FROM clientes
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
                <input type='submit' name='go' value='Tel&eacute;fonos Efectivos'>
            </form>
        </body>
    </html>
    <?php
} 
