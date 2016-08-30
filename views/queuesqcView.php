<!DOCTYPE html>
<html>
    <head>
        <title>Reporte de los queues por cliente</title>
        <meta http-equiv="refresh" content="60"/>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style>
            body { font-size: 75%; }
            tr.odd { background-color: #dddddd }
            td { text-align: center }
            .alert { background-color: red }
            .good {background-color: #00ff00;}
            .fair {background-color: #ffff00;}
            .bad {background-color: #ff0000;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <h2>Queues Normales</>
            <table class="ui-widget" id="normales">
                <thead class="ui-widget-header">
                    <tr>
                        <th>Cliente</a></th>
                        <th>Campa&ntilde;a</a></th>
                        <th>Asignados</a></th>
                        <th>Queue</a></th>
                        <th>#/$ cuentas</a></th>
                        <th>% campa&ntilde;a</a></th>
                        <th>#/$ diario</a></th>
                        <th>% diario</a></th>
                        <th>#/$ semanal</a></th>
                        <th>% semanal</a></th>
                        <th>#/$ mensual</a></th>
                        <th>% mensual</a></th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    foreach ($resultq as $answer) {
                        $CLIENTE = $answer['cliente'];
                        $QUEUE = $answer['status_aarsa'];
                        $QUEUES = str_replace('+', '%2B', $QUEUE);
                        $SDC = $answer['sdc'];
                        $SDCS = str_replace('+', '%2B', $SDC);
                        $resultc = $qc->getSegmentoCount($CLIENTE, $SDC);
                        foreach ($resultc as $answerc) {
                            $ASIGNADOS = $answerc['ct'];
                            $DINERO = $answerc['sst'];
                        }
                        $resultsub = $qc->getReportSub($CLIENTE, $SDC, $QUEUE);
                        var_dump($resultsub);die();
                        foreach ($resultsub as $answersub) {
                            $count = $answersub['ctt'];
                            $countd = $answersub['ctd'];
                            $counts = $answersub['ctw'];
                            $countm = $answersub['ctm'];
                            $monto = $answersub['stt'];
                            $montod = $answersub['std'];
                            $montos = $answersub['stw'];
                            $montom = $answersub['stm'];
                        }
                        $pcc = number_format($count / ($ASIGNADOS + 0.001) * 100, 0);
                        $pcd = number_format($countd / ($count + 0.001) * 100, 0);
                        $empd = "class='good'";
                        if ($pcd < 80) {
                            $empd = "class='fair'";
                        }
                        if ($pcd < 40) {
                            $empd = "class='bad'";
                        }
                        $pcs = number_format($counts / ($count + 0.001) * 100, 0);
                        $emps = "class='good'";
                        if ($pcs < 80) {
                            $emps = "class='fair'";
                        }
                        if ($pcs < 40) {
                            $emps = "class='bad'";
                        }
                        $pcm = number_format($countm / ($count + 0.001) * 100, 0);
                        $empm = "class='good'";
                        if ($pcm < 80) {
                            $empm = "class='fair'";
                        }
                        if ($pcm < 40) {
                            $empm = "class='bad'";
                        }
                        $pcmc = number_format($monto / ($DINERO + 0.001) * 100, 0);
                        $pcmd = number_format($montod / ($monto + 0.001) * 100, 0);
                        $pcms = number_format($montos / ($monto + 0.001) * 100, 0);
                        $pcmm = number_format($montom / ($monto + 0.001) * 100, 0);
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
                                <?php echo number_format($DINERO, 0); ?>
                            </td>
                            <td>
                                <?php echo $QUEUE; ?>
                            </td>
                            <td class='legibility'><a href="speclistqc.php?capt=<?php
                                echo $capt
                                ?>&cliente=<?php
                                                      echo $CLIENTE
                                                      ?>&queue=<?php
                                                      echo $QUEUES
                                                      ?>&status_de_credito=<?php
                                                      echo $SDCS
                                                      ?>&rato=total"><?php
                                                          echo $count
                                                          . '<br>' . number_format($monto, 0);
                                                          ?></a>
                            </td>
                            <td><?php echo $pcc . '%<br>' . number_format($pcmc, 0) . "%"; ?>
                            </td>
                            <td <?php echo $empd ?>><a href="speclistqc.php?capt=<?php echo $capt ?>
                                                       &cliente=<?php echo $CLIENTE ?>
                                                       &queue=<?php echo $QUEUES ?>
                                                       &status_de_credito=<?php echo $SDCS ?>
                                                       &rato=diario
                                                       "><?php echo $countd . '<br>' . number_format($montod, 0);
                                                          ?></a>
                            </td>
                            <td <?php echo $empd ?>><?php echo $pcd . '%<br>' . number_format($pcmd, 0) . "%";
                                                          ?>
                            </td>
                            <td <?php echo $emps ?>><a href="speclistqc.php?capt=<?php echo $capt ?>
                                                       &cliente=<?php echo $CLIENTE ?>
                                                       &queue=<?php echo $QUEUES ?>
                                                       &status_de_credito=<?php echo $SDCS ?>
                                                       &rato=semanal
                                                       "><?php echo $counts . '<br>' . number_format($montos, 0);
                                                          ?></a>
                            </td>
                            <td <?php echo $emps ?>><?php echo $pcs . '%<br>' . number_format($pcms, 0) . "%";
                                                          ?>
                            </td>
                            <td <?php echo $empm ?>><a href="speclistqc.php?capt=<?php echo $capt ?>
                                                       &cliente=<?php echo $CLIENTE ?>
                                                       &queue=<?php echo $QUEUES ?>
                                                       &status_de_credito=<?php echo $SDCS ?>
                                                       &rato=mensual
                                                       "><?php echo $countm . '<br>' . number_format($montom, 0);
                                                          ?></a>
                            </td>
                            <td <?php echo $empm ?>><?php echo $pcm . '%<br>' . number_format($pcmm, 0) . "%";
                                                          ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h2>Queus Especiales</h2>
            <table class="ui-widget" id="especiales">
                <thead class="ui-widget-header">
                    <tr>
                        <th>Cliente</a></th>
                        <th>Campa&ntilde;a</a></th>
                        <th>Asignados</a></th>
                        <th>#/$ cuentas</a></th>
                        <th>% campa&ntilde;a</a></th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    foreach ($result as $answer) {
                        $CLIENTE = $answer[0];
                        $SDC = $answer[1];
                        $COUNT = $answer[2];
                        $MOUNT = $answer[3];
                        $ECOUNT = $answer[4];
                        $EMOUNT = $answer[5];
                        $PCOUNT = round($ECOUNT / $COUNT * 100);
                        $PMOUNT = round($EMOUNT / ($MOUNT + 0.001) * 100);
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
                                <?php echo number_format($MOUNT, 0); ?>
                            </td>
                            <td>
                                <?php echo $ECOUNT; ?><br>
                                <?php echo number_format($EMOUNT, 0); ?>
                            </td>
                            <td>
                                <?php echo $PCOUNT; ?><br>
                                <?php echo number_format($PMOUNT, 0); ?>
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
