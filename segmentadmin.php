<?php
include('pdoConnect.php');
$pc   = new pdoConnect();
$pdo  = $pc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$go   = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == "BORRAR") {
        $cliente     = filter_input(INPUT_GET, 'cliente');
        $segmento    = filter_input(INPUT_GET, 'segmento');
        $queryborrar = "DELETE FROM queuelist
            WHERE cliente=:cliente
            AND sdc=:segmento;";
        $stb         = $pdo->prepare($queryborrar);
        $stb->bindParam(':cliente', $cliente);
        $stb->bindParam(':segmento', $segmento);
        $stb->execute();
    }

    if ($go == "AGREGAR") {
        $cliseg          = filter_input(INPUT_GET, 'cliseg');
        $clientesegmento = explode(';', $cliseg);
        $cliente         = $clientesegmento[0];
        $segmento        = $clientesegmento[1];
        $querylistin     = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist;";
        $stl             = $pdo->prepare($querylistin);
        $stl->bindParam(':cliente', $cliente);
        $stl->bindParam(':segmento', $segmento);
        $stl->execute();
        $querylistcamp   = "update queuelist
            set camp=auto where camp=9999999;";
        $pdo->query($querylistcamp);
        header("Location: segmentadmin.php?capt=".$capt);
    }
    if ($go == "AGREGARALL") {
        $querycliseg = "SELECT DISTINCT cliente, status_de_credito "
            ."FROM resumen "
            ."WHERE status_de_credito NOT REGEXP '-'";
        $result      = $pdo->query($querycliseg);
        $querylistin = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist";
        $stl         = $pdo->prepare($querylistin);
        foreach ($result as $row) {
            $stl->bindParam(':cliente', $row['cliente']);
            $stl->bindParam(':segmento', $row['status_de_credito']);
            $stl->execute();
        }
        $querylistcamp = "update queuelist
            set camp=auto where camp=9999999;";
        $pdo->query($querylistcamp);
        header("Location: segmentadmin.php?capt=".$capt);
    }
}
$querytempr = "create temporary table csdcr
select cliente, status_de_credito, count(id_cuenta) as cnt from resumen
where status_de_credito not regexp '-'
group by cliente, status_de_credito";
$pdo->query($querytempr);
$querymain  = "SELECT q.cliente as 'cliente', sdc, cnt
    FROM queuelist q
    LEFT JOIN csdcr r
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    group by q.cliente,sdc
    ";
$result     = $pdo->query($querymain);
$querytemp  = "create temporary table csdc
select distinct cliente,sdc from queuelist";
$pdo->query($querytemp);
$querymain2 = "SELECT r.cliente as 'cliente',status_de_credito as 'sdc',
    count(1)
    FROM resumen r
    LEFT JOIN csdc q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc is null
    AND r.cliente <> ''
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    ";
$result2    = $pdo->query($querymain2);
require_once 'views/segmentadminView.php';