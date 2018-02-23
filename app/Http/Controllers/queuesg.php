<?php

$go   = filter_input(INPUT_GET, 'go');
$msg  = "";
if ($go == 'INTRO') {
    $cliente     = filter_input(INPUT_GET, 'cliente');
    $sdc         = filter_input(INPUT_GET, 'sdc');
    $queue       = filter_input(INPUT_GET, 'queue');
    $queryqueue  = "select camp from queuelist
where cliente=:cliente
and status_aarsa=:queue
and sdc=:sdc
and gestor=:capt
and bloqueado=0 limit 1
";
    $stq         = $pdo->prepare($queryqueue);
    $stq->bindParam(':cliente', $cliente);
    $stq->bindParam(':queue', $queue);
    $stq->bindParam(':sdc', $sdc);
    $stq->bindParam(':capt', $capt);
    $stq->execute();
    $resultqueue = $stq->fetch(PDO::FETCH_ASSOC);
    if ($resultqueue) {
        $camp = $resultqueue['camp'];
    } else {
        $camp = -1;
    }
    if ($camp >= 0) {
        $queryupd = "UPDATE nombres SET camp=:camp "
            . "where iniciales=:capt;";
        $stu = $pdo->prepare($queryupd);
        $stu->bindParam(':camp', $camp);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
        $msg      = "<h2>Se elige queue ".$cliente." ".$sdc." ".$queue."</h2>";
    }
} else {
    $msg = "<h2>Se elige queue bloqueado o equivocado.</h2>";
}

$arrayc  = '[';
$arrays  = '[';
$arrayq  = '[';
$queryc  = "SELECT distinct cliente
FROM queuelist where cliente<>''
ORDER BY cliente;";
$resultc = $pdo->query($queryc);
foreach ($resultc as $rowc) {
    $arrayc = $arrayc.'"';
    $arrayc = $arrayc.$rowc['cliente'].'",';
}
$arrayc  = $arrayc.']';
$querys  = "SELECT distinct sdc,cliente
FROM queuelist WHERE gestor = :capt and bloqueado=0 and cliente<>''
ORDER BY cliente,sdc,status_aarsa;";
        $sts = $pdo->prepare($querys);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        $results=$sts->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $rows) {
    $arrays = $arrays.'["';
    $arrays = $arrays.$rows['sdc'].'","'.$rows['cliente'].'"],';
}
$arrays  = rtrim($arrays, ',').']';
$querysa  = "SELECT distinct status_aarsa,sdc,cliente
FROM queuelist WHERE gestor = :capt and bloqueado=0
ORDER BY cliente,sdc,status_aarsa;";
        $stsa = $pdo->prepare($querysa);
        $stsa->bindParam(':capt', $capt);
        $stsa->execute();
        $resultsa=$stsa->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultsa as $rowsa) {
    $arrayq = $arrayq.'["';
    $arrayq = $arrayq
        . $rowsa['status_aarsa'].'","'
        . $rowsa['sdc'].'","'
        . $rowsa['cliente'].'"],';
}
$arrayq = rtrim($arrayq, ',').']';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sus queues</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <script>
            $(function () {
                $("button").button();
                $("#intro").button();
                $("#cliente").empty();
                $("#segmento").empty();
                $("#queue").empty();
                $("body").css("font-size", "10pt");
                $("body").css("text-align", "center");
                $("#cliente").css("text-align", "left");
                $("div").css("float", "left");
                $(".introb").css("clear", "left");
                $.each(<?php echo $arrayc; ?>, function (index, value) {
                    var data = '<div class="column"><input class="columnc" type="radio" name="cliente" value="' + value + '" />' + value + '</div>';
                    $('#cliente').append(data);
                });
                $("#cliente").change(function () {
                    $("#segmento").empty();
                    $("#queue").empty();
                    var data2 = $('input[name=cliente]:checked').val();
                    $.each(<?php echo $arrays; ?>, function (index, sdc) {
                        if (sdc[1] === data2) {
                            var st = sdc[0];
                            if (st === '') {
                                st = 'TODOS';
                            }
                            data3 = '<div class="column"><input class="columns" type="radio" name="segmento" value="' + sdc[0] + '" />' + st + '</div>';
                            $('#segmento').append(data3);
                        }
                    });
                    $("#segmento").css("text-align", "left");
                });
                $("#segmento").change(function () {
                    $("#queue").empty();
                    var data2 = $('input[name=cliente]:checked').val();
                    var data4 = $('input[name=segmento]:checked').val();
                    $.each(<?php echo $arrayq; ?>, function (index, que) {
                        if ((que[1] + que[2]) === (data4 + data2)) {
                            var qt = que[0];
                            if (qt === '') {
                                qt = 'TODOS';
                            }
                            data5 = '<div class="column"><input class="columnq" type="radio" name="queue" value="' + que[0] + '" />' + qt + '</div>';
                            $('#queue').append(data5);
                        }
                    });
                    $("#queue").css("text-align", "left");
                });
            });
        </script>
        <?php echo $msg; ?>
        <div>
            <form method='get' action='#' name='queueform'>
                <div>
                    <input name='gestor' type='text' readonly='readonly' value='<?php echo $capt; ?>'>
                </div>
                <div>
                    <br>
                    <div>CLIENTE<br>
                        <div id='cliente'>
                        </div>
                    </div>
                    <div>SEGMENTO<BR>
                        <div id='segmento'>
                        </div>
                    </div>
                    <div>QUEUE<BR>
                        <div id='queue'>
                        </div>
                    </div>
                    <div class='introb'>
                        <input type="submit" name="go" id="intro" value="INTRO">
                    </div>
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    </form>
                </div>
        </div>
        <div class='introb'>
            <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Cuentas</button>
        </div>
    </body>
</html> 
