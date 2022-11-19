<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reporte de los queues por cliente</title>
    <meta http-equiv="refresh" content="60"/>
    <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    <style>
        body {
            font-size: 75%;
        }

        tr.odd {
            background-color: #dddddd
        }

        td {
            text-align: center
        }

        .alert {
            background-color: red
        }

        .good {
            background-color: #00ff00;
        }

        .fair {
            background-color: #ffff00;
        }

        .bad {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa
</button>
<br>
<h2>Queues Normales</h2>
<table class="ui-widget" id="normales">
    <thead class="ui-widget-header">
    <tr>
        <th>Cliente</th>
        <th>Campa&ntilde;a</th>
        <th>Asignados</th>
        <th>Queue</th>
        <th>#/$ cuentas</th>
        <th>% campa&ntilde;a</th>
        <th>#/$ diario</th>
        <th>% diario</th>
        <th>#/$ semanal</th>
        <th>% semanal</th>
        <th>#/$ mensual</th>
        <th>% mensual</th>
    </tr>
    </thead>
    <tbody class="ui-widget-content">
    <?php
    foreach ($queues as $answer) {
        $CLIENTE = $answer->cliente;
        $QUEUE = $answer->status_aarsa;
        $QUEUES = str_replace('+', '%2B', $QUEUE);
        $SDC = $answer->sdc;
        $SDCs = str_replace('+', '%2B', $SDC);
        $counts = $qc->getSegmentoCount($CLIENTE, $SDC);
        foreach ($counts as $answerC) {
            $ASIGNADOS = $answerC['ct'];
            $DINERO = $answerC['sst'];
        }
        $sub = $qc->getReportSub($CLIENTE, $SDC, $QUEUE);
        $pcc = number_format($sub->ctt / ($ASIGNADOS + 0.001) * 100);
        $pcd = number_format($sub->ctd / ($sub->ctt + 0.001) * 100);
        $empD = "class='good'";
        if ($pcd < 80) {
            $empD = "class='fair'";
        }
        if ($pcd < 40) {
            $empD = "class='bad'";
        }
        $pcs = number_format($sub->ctw / ($sub->ctt + 0.001) * 100);
        $empS = "class='good'";
        if ($pcs < 80) {
            $empS = "class='fair'";
        }
        if ($pcs < 40) {
            $empS = "class='bad'";
        }
        $pcm = number_format($sub->ctm / ($sub->ctt + 0.001) * 100);
        $empM = "class='good'";
        if ($pcm < 80) {
            $empM = "class='fair'";
        }
        if ($pcm < 40) {
            $empM = "class='bad'";
        }
        $pcmC = number_format($sub->mtt / ($DINERO + 0.001) * 100);
        $pcmD = number_format($sub->mtd / ($sub->mtt + 0.001) * 100);
        $pcmS = number_format($sub->mtw / ($sub->mtt + 0.001) * 100);
        $pcmM = number_format($sub->mtm / ($sub->mtt + 0.001) * 100);
        ?>
        <tr>
            <td>
                <?php echo $CLIENTE; ?>
            </td>
            <td>
                <?php echo $SDC; ?>
            </td>
            <td>
                <?php echo $ASIGNADOS; ?><br>
                <?php echo number_format($DINERO); ?>
            </td>
            <td>
                <?php echo $QUEUE; ?>
            </td>
            <td class='legibility'><a href="/speclistqc.php?capt=<?php
                echo $capt;
                ?>&cliente=<?php
                echo $CLIENTE;
                ?>&queue=<?php
                echo $QUEUES;
                ?>&status_de_credito=<?php
                echo $SDCs;
                ?>&rato=total"><?php
                    echo $sub->ctt
                        . '<br>' . number_format($sub->mtt);
                    ?></a>
            </td>
            <td><?php echo $pcc . '%<br>' . number_format($pcmC) . "%"; ?>
            </td>
            <td <?php echo $empD ?>><a href="/speclistqc.php?capt=<?php
                echo $capt; ?>&cliente=<?php
                echo $CLIENTE; ?>&queue=<?php
                echo $QUEUES; ?>&status_de_credito=<?php
                echo $SDCs; ?>&rato=diario"><?php
                    echo $sub->ctd . '<br>' . number_format($sub->mtd);
                    ?></a>
            </td>
            <td <?php echo $empD ?>><?php echo $pcd . '%<br>' . number_format($pcmD) . "%";
                ?>
            </td>
            <td <?php echo $empS ?>><a href="/speclistqc.php?capt=<?php
                echo $capt; ?>&cliente=<?php
                echo $CLIENTE; ?>&queue=<?php
                echo $QUEUES; ?>&status_de_credito=<?php
                echo $SDCs; ?>&rato=semanal"><?php
                    echo $sub->ctw . '<br>' . number_format($sub->mtw);
                    ?></a>
            </td>
            <td <?php echo $empS ?>><?php echo $pcs . '%<br>' . number_format($pcmS) . "%";
                ?>
            </td>
            <td <?php echo $empM ?>><a href="/speclistqc.php?capt=<?php
                echo $capt ?>&cliente=<?php
                echo $CLIENTE ?>&queue=<?php
                echo $QUEUES ?>&status_de_credito=<?php
                echo $SDCs ?>&rato=mensual"><?php
                    echo $sub->ctm . '<br>' . number_format($sub->mtm);
                    ?></a>
            </td>
            <td <?php echo $empM ?>><?php echo $pcm . '%<br>' . number_format($pcmM) . "%";
                ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<h2>Queues Especiales</h2>
<table class="ui-widget" id="especiales">
    <thead class="ui-widget-header">
    <tr>
        <th>Cliente</th>
        <th>Campa&ntilde;a</th>
        <th>Asignados</th>
        <th>#/$ cuentas</th>
        <th>% campa&ntilde;a</th>
    </tr>
    </thead>
    <tbody class="ui-widget-content">
    <?php
    foreach ($main as $answer) {
        $CLIENTE = $answer->cliente;
        $SDC = $answer->status_de_credito;
        $COUNT = $answer->cnt;
        $MOUNT = $answer->mnt;
        $ECount = $answer->ecount;
        $EMount = $answer->emount;
        $PCount = round($ECount / $COUNT * 100);
        $PMount = round($EMount / ($MOUNT + 0.001) * 100);
        ?>
        <tr>
            <td>
                <?php echo $CLIENTE; ?>
            </td>
            <td>
                <?php echo $SDC; ?>
            </td>
            <td>
                <?php echo $COUNT; ?><br>
                <?php echo number_format($MOUNT); ?>
            </td>
            <td>
                <?php echo $ECount; ?><br>
                <?php echo number_format($EMount); ?>
            </td>
            <td>
                <?php echo $PCount; ?><br>
                <?php echo number_format($PMount); ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    $("tr:odd").addClass("odd");
    $('th').parent("tr:odd").removeClass('odd');
    $('#normales').dataTable({
        'bPaginate': false
    });
    $('#especiales').dataTable({
        'bPaginate': false
    });
</script>
</body>
</html>
