<?php
include('usuario_hdr_i.php');
$go     = filter_input(INPUT_GET, 'go');
$GESTOR = mysqli_real_escape_string($con, filter_input(INPUT_GET, 'capt'));
if (empty($GESTOR)) {
    $GESTOR = '';
}
$msg = "";
if ($go == 'INTRO') {
    $camp    = -1;
    $cliente = mysqli_real_escape_string($con,
        filter_input(INPUT_GET, 'cliente'));
    $sdc     = mysqli_real_escape_string($con,
        filter_input(INPUT_GET, 'segmento'));
    if (empty($sdc)) {
        $sdc = '';
    }
    $queue      = mysqli_real_escape_string($con,
        filter_input(INPUT_GET, 'queue'));
    $queryqueue = "select camp from queuelist
where cliente=?
and status_aarsa=?
and sdc=?
and gestor=?
and bloqueado=0 limit 1
";
    if ($stq        = $con->prepare($queryqueue)) {
        $stq->bind_param('ssss', $cliente, $queue, $sdc, $GESTOR);
        $stq->execute();
        $stq->bind_result($camp);
        $stq->fetch();
    } else {
        die($con->error);
    }
    $stq->close();
    if ($camp >= 0) {
        $queryupd = "UPDATE nombres SET camp=? "
            ."where iniciales=?;";
        if ($stu      = $con->prepare($queryupd)) {
            $stu->bind_param('is', $camp, $GESTOR);
            $stu->execute();
        } else {
            die($con->error);
        }
        $stu->close();
        $msg = "<h2>Se elige queue ".$cliente." ".$sdc." ".$queue."</h2>";
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
$resultc = $con->query($queryc);
while ($rowc    = mysqli_fetch_assoc($resultc)) {
    $arrayc = $arrayc.'"';
    $arrayc = $arrayc.$rowc['cliente'].'",';
}
$arrayc  = $arrayc.']';
$querys  = "SELECT distinct sdc,cliente
FROM queuelist WHERE gestor = '".$GESTOR."' and bloqueado=0 and cliente<>''
ORDER BY cliente,sdc,status_aarsa;";
$results = mysqli_query($con, $querys) or die(mysqli_error($con));
while ($rows    = mysqli_fetch_assoc($results)) {
    $arrays = $arrays.'["';
    $arrays = $arrays.$rows['sdc'].'","'.$rows['cliente'].'"],';
}
$arrays  = rtrim($arrays, ',').']';
$queryq  = "SELECT distinct status_aarsa,sdc,cliente
FROM queuelist WHERE gestor = '".$GESTOR."' and bloqueado=0
ORDER BY cliente,sdc,status_aarsa;";
$resultq = $con->query($queryq) or die($con->error());
while ($rowq    = $resultq->fetch_row()) {
    $arrayq = $arrayq.'["';
    $arrayq = $arrayq.$rowq[0].'","'.$rowq[1].'","'.$rowq[2].'"],';
}
$arrayq = rtrim($arrayq, ',').']';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sus queues</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="vendor/components/jquery/jquery,js" type="text/javascript"></script>
        <script src="vendor/components/jqueryui/jquery-ui,js" type="text/javascript"></script>
        <script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    </head>
    <body>
        <script>
            $(function() {
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
                $.each(<?php echo $arrayc; ?>, function(index, value) {
                    var data = '<div class="column"><input class="columnc" type="radio" name="cliente" value="' + value + '" />' + value + '</div>';
                    $('#cliente').append(data);
                });
                $("#cliente").change(function() {
                    $("#segmento").empty();
                    $("#queue").empty();
                    var data2 = $('input[name=cliente]:checked').val();
                    $.each(<?php echo $arrays; ?>, function(index, sdc) {
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
                $("#segmento").change(function() {
                    $("#queue").empty();
                    var data2 = $('input[name=cliente]:checked').val();
                    var data4 = $('input[name=segmento]:checked').val();
                    $.each(<?php echo $arrayq; ?>, function(index, que) {
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
            <form method='get' action='#' name='<?php echo $GESTOR; ?>'>
                <div>
                    <input name='gestor' type='text' readonly='readonly' value='<?php echo $GESTOR; ?>'>
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
