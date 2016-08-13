<?php
set_time_limit(300);
require_once 'classes/pdoConnect.php';
$pdoc    = new pdoConnect();
$pdo     = $pdoc->dbConnectAdmin();
$capt    = filter_input(INPUT_GET, 'capt');
$go      = filter_input(INPUT_GET, 'go');
$cliente = filter_input(INPUT_GET, 'cliente');

/**
 *  outputCSV creates a line of CSV and outputs it to browser    
 */
function outputCSV($array)
{
    $fp = fopen('php://output', 'w'); // this file actual writes to php output
    fputcsv($fp, $array);
    fclose($fp);
}

/**
 *  getCSV creates a line of CSV and returns it. 
 */
function getCSV($array)
{
    ob_start(); // buffer the output ...
    outputCSV($array);
    return ob_get_clean(); // ... then return it as a string!
}

//require_once 'Spreadsheet/Excel/Writer.php';
function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);

    return date("M", $timestamp);
}
if (!empty($go)) {
    //$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
    $gestorstr  = '';
    $clientestr = '';
    if ($cliente != 'todos') {
        $clientestr = " and cliente=:cliente ";
    }
    $querymain = "SELECT id_cuenta,numero_de_cuenta,nombre_deudor,resumen.cliente,
    substring_index(status_de_credito,'-',1) as segmento,
    if (status_de_credito regexp '-',substring_index(status_de_credito,'-',-1),'') as disposicion,
    producto,subproducto,
    saldo_total,d1.queue,saldo_descuento_1,saldo_descuento_2,
    domicilio_deudor,colonia_deudor,ciudad_deudor, estado_deudor,cp_deudor,
    ejecutivo_asignado_call_center, ejecutivo_asignado_domiciliario,
count(historia.auto) as gestiones, sum(c_carg<>'') as contactos, fecha_de_asignacion
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
left join historia on id_cuenta=c_cont
and d_fech>curdate() - interval 6 month
where status_de_credito not like '%inactivo' 
".$clientestr." 
group by id_cuenta
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
    ;";
    $stm       = $pdo->prepare($querymain);
    if ($cliente != 'todos') {
        $stm->bindParam(':cliente', $cliente);
    }
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();

    $filename = "Query_de_inventario_".trim(date('ymd')).".csv";
// sending HTTP headers
//$workbook->send($filename);
    header('Content-type: application/xls');
    header('Content-Disposition: attachment; filename="'.$filename.'"');

// Creating a worksheet
//$worksheet =& $workbook->addWorksheet('Reporte CS');
//$worksheet->setInputEncoding('ISO-8859-1');


    $afield       = array();
    $i = 0;
    foreach ($result[0] as $var => $value) {
        if ($var == 'numero_de_cuenta') {
            $nccol = $i;
        }
//	$worksheet->write(0, $i, $var);
        $afield[] = $var;
        $i++;
    }
    echo getcsv($afield);
    if (substr(getcsv($afield), -1) != "\n") {
        echo "\n";
    }


    foreach ($result as $row) {
        echo getcsv($row);
        if (substr(getcsv($row), -1) != "\n") {
            echo "\n";
        }
    }
//$workbook->close();
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Query de las Promesas/Propuestas</title>

            <style type="text/css">
                body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
                table {border: 1pt solid #000000;background-color: #c0c0c0;}
                tr:hover {background-color: #ff0000;}
                th {border: 1pt solid #000000;background-color: #c0c0c0;}
                .loud {text-align:center; font-weight:bold; color:red;}
                .num {text-align:right;}
            </style>
        </head>
        <body>
            <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
            <form action="inventario-rapid.xls.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>
                    <select name="cliente">
                        <option value="todos" style="font-size:120%;">todos</option>
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
