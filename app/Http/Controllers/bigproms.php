<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

use app\PdoClass;
$pdoc = new PdoClass();
$pdo  = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$get  = filter_input_array(INPUT_GET);

function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);

    return date("M", $timestamp);
}
if (isset($get['fecha1'])) {
    $go      = $get['go'];
    $gestor  = $get['gestor'];
    $cliente = $get['cliente'];
    $fecha1  = $get['fecha1'];
    $fecha2  = $get['fecha2'];
    $fecha3  = $get['fecha3'];
    $fecha4  = $get['fecha4'];
    if (isset($get['tipo'])) {
        $tipo = $get['tipo'];
    } else {
        $tipo = '';
    }
    if ($fecha2 < $fecha1) {
        list($fecha1, $fecha2) = array($fecha2, $fecha1);
    }
    if ($fecha4 < $fecha3) {
        list($fecha3, $fecha4) = array($fecha4, $fecha3);
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
    $querymain = "select Status_aarsa AS 'STATUS',c_cvge AS 'GESTOR',
    numero_de_cuenta as 'CUENTA',nombre_deudor as 'NOMBRE',
    saldo_descuento_1 as 'SALDO CAPITAL s/i',saldo_total as 'SALDO TOTAL',
    pagos_vencidos*30 as 'MORA',n_prom as 'TOTAL PROMESA',
    d_prom1 as 'FECHA PROMESA 1',n_prom1 as 'MONTO PROMESA 1',
    d_prom2 as 'FECHA PROMESA 2',n_prom2 as 'MONTO PROMESA 2',
    max(folio) AS 'FOLIO',c_motiv AS 'MOTIVADOR',c_cnp AS 'CAUSA NO PAGO',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'CAMPANA',d_fech AS 'FECHA GESTION',
    max(pagos.fecha) AS 'FECHA PAGO',sum(monto) AS 'MONTO PAGO',max(confirmado) as 'CONFIRMADO'
from resumen join historia h1 on c_cont=id_cuenta
left join folios on id=id_cuenta and fecha>=d_fech
left join pagos using (id_cuenta)
where n_prom>0
and d_fech between :fecha1 and :fecha2
and d_prom between :fecha3 and :fecha4
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
".$gestorstr.$clientestr."
and status_de_credito not like '%tivo' and c_cniv is null
group by id_cuenta ORDER BY d_fech,c_hrin
    ;";
    $stm       = $pdo->prepare($querymain);
    $stm->bindParam(':fecha1', $fecha1);
    $stm->bindParam(':fecha2', $fecha2);
    $stm->bindParam(':fecha3', $fecha3);
    $stm->bindParam(':fecha4', $fecha4);
    if ($gestor != 'todos') {
        $stm->bindParam(':gestor', $gestor);
    }
    if ($cliente != 'todos') {
        $stm->bindParam(':cliente', $cliente);
    }
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $filename = "Query_de_promesas_".$fecha3.'_'.$fecha4.".xlsx";
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
    $queryg   = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000
	";
    $resultg  = $pdo->query($queryg);
    $queryc   = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvba
        limit 100
	";
    $resultc  = $pdo->query($queryc);
    $querydf  = "SELECT distinct d_fech
                        FROM historia
                        where n_prom>0
                        ORDER BY d_fech";
    $resultdf = $pdo->query($querydf);
    $querydp  = "SELECT distinct d_prom
                        FROM historia
                        where n_prom>0
                        ORDER BY d_prom";
    $resultdp = $pdo->query($querydp);
    $queryfd  = "SELECT distinct d_fech
                        FROM historia
                        where n_prom>0
                        ORDER BY d_fech DESC";
    $resultfd = $pdo->query($queryfd);
    $querypd  = "SELECT distinct d_prom
                        FROM historia
                        where n_prom>0
                        ORDER BY d_prom DESC";
    $resultpd = $pdo->query($querypd);
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
            <form action="bigproms.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>Gestor: <?php
                    if (isset($gestor)) {
                        echo $gestor;
                    }
                    ?>
                    <select name="gestor">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <?php
                        foreach ($resultg as $answerg) {
                            ?>
                            <option value="<?php echo $answerg[0]; ?>" style="font-size:120%;">
                                <?php echo $answerg[0]; ?></option>
                        <?php }
                        ?>
                    </select>
                </p>
                <p>Cliente:
                    <select name="cliente">
                        <option value="todos" style="font-size:120%;">todos</option>
                        <?php
                        foreach ($resultc as $answerc) {
                            ?>
                            <option value="<?php echo $answerc[0]; ?>" style="font-size:120%;">
                                <?php echo $answerc[0]; ?></option>
                        <?php }
                        ?>
                    </select>
                </p>
                <p>HECHO de:
                    <?php
                    if (isset($fecha1)) {
                        echo $fecha1;
                    }
                    ?>
                    <select name="fecha1">
                        <?php
                        foreach ($resultdf as $answerdf) {
                            ?>
                            <option value="<?php echo $answerdf[0]; ?>" style="font-size:120%;">
                                <?php echo $answerdf[0]; ?></option>
                        <?php } ?>
                    </select>
                    a:
                    <select name="fecha2">
                        <?php
                        foreach ($resultfd as $answerfd) {
                            ?>
                            <option value="<?php echo $answerfd[0]; ?>" style="font-size:120%;">
                                <?php echo $answerfd[0]; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>VENCIDO de:
                    <select name="fecha3">
                        <?php
                        foreach ($resultdp as $answerdp) {
                            ?>
                            <option value="<?php echo $answerdp[0]; ?>" style="font-size:120%;">
                                <?php echo $answerdp[0]; ?></option>
                        <?php } ?>
                    </select>
                    a:
                    <select name="fecha4">
                        <?php
                        foreach ($resultpd as $answerpd) {
                            ?>
                            <option value="<?php echo $answerpd[0]; ?>" style="font-size:120%;">
                                <?php echo $answerpd[0]; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <label for='visits'>Visitas</label>
                <input type='radio' name='tipo' id='visits' value='visits' /><br>
                <label for='telef'>Telefonica</label>
                <input type='radio' name='tipo' id='telef' value='telef' /><br>
                <label for='todos'>Todos</label>
                <input type='radio' name='tipo' id='todos' value='todos' /><br>
                <input type='submit' name='go' value='Query Prom'>
            </form>
        </body>
    </html>
    <?php
}