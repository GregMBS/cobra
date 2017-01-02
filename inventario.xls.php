<?php

use cobra_salsa\OutputClass;

require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
require_once 'vendor/autoload.php';
$oc   = new OutputClass();
set_time_limit(180);

$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    $cliente    = filter_input(INPUT_GET, 'cliente');
    $inactivo   = filter_input(INPUT_GET, 'inactivos');
    if ($inactivo == '1') {
        $sdctext = " 1 = 1 ";
    } else {
        $sdctext = " status_de_credito not regexp '-' ";
    }
    $gestorstr  = '';
    $clientestr = '';
    if ($cliente != 'todos') {
        $clientestr = " and cliente=:cliente ";
    }
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,d1.queue,saldo_descuento_2,
    domicilio_deudor,colonia_deudor,ciudad_deudor, estado_deudor,cp_deudor,
    ejecutivo_asignado_call_center as usuario,fecha_de_asignacion, fecha_ultima_gestion, 
tel_1	,	((exists (select 1 from livelines where livelines.c_tele = tel_1))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_1)))		as		't1 efectivo',
tel_2	,	((exists (select 1 from livelines where livelines.c_tele = tel_2))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_2)))		as		't2 efectivo',
tel_3	,	((exists (select 1 from livelines where livelines.c_tele = tel_3))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_3)))		as		't3 efectivo',
tel_4	,	((exists (select 1 from livelines where livelines.c_tele = tel_4))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_4)))		as		't4 efectivo',
tel_1_verif	,	((exists (select 1 from livelines where livelines.c_tele = tel_1_verif))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_1_verif)))		as		't1v efectivo',
tel_2_verif	,	((exists (select 1 from livelines where livelines.c_tele = tel_2_verif))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_2_verif)))		as		't2v efectivo',
tel_3_verif	,	((exists (select 1 from livelines where livelines.c_tele = tel_3_verif))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_3_verif)))		as		't3v efectivo',
tel_4_verif	,	((exists (select 1 from livelines where livelines.c_tele = tel_4_verif))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_4_verif)))		as		't4v efectivo',
tel_1_laboral	,	((exists (select 1 from livelines where livelines.c_tele = tel_1_laboral))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_1_laboral)))		as		't1l efectivo',
tel_2_laboral	,	((exists (select 1 from livelines where livelines.c_tele = tel_2_laboral))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_2_laboral)))		as		't2l efectivo',
tel_1_ref_1	,	((exists (select 1 from livelines where livelines.c_tele = tel_1_ref_1))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_1_ref_1)))		as		't1r1 efectivo',
tel_1_ref_2	,	((exists (select 1 from livelines where livelines.c_tele = tel_1_ref_2))	* (not exists (select 1 from deadlines where deadlines.c_tele = tel_1_ref_2)))		as		't1r2 efectivo'
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
where ".$sdctext." ".$clientestr."
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
";
    $std       = $pdo->prepare($querymain);
    if ($cliente != 'todos') {
        $std->bindParam(':cliente', $cliente);
    }
    $std->execute();
    $result = $std->fetchAll(PDO::FETCH_ASSOC);
    $filename = "Query_de_inventario_".date('ymd').".xlsx";
    $headers  = array_keys($result);
    $oc->writeXLSXFile($filename, $result, $headers);
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
                        <?php
                        $queryc  = "SELECT distinct cliente
                                FROM clientes
                                order by cliente";
                        $resultc = $pdo->query($queryc);
                        foreach ($resultc as $answerc) {
                            ?>
                            <option value="<?php echo $answerc['cliente']; ?>" style="font-size:120%;">
                                <?php echo $answerc['cliente']; ?></option>
                            <?php }
                            ?>
                    </select>
                </p>
                <input type="checkbox" name="inactivos" id="inactivos" value="1" />
                <label for="inactivos">Incluir cuentas inactivas</label>
                    <br>
                <input type='submit' name='go' value='Query Inventario'>
            </form>
        </body>
    </html>
    <?php
}
