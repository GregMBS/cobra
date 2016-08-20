<!DOCTYPE html>
<html>
    <head>
        <title>Sus queues</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="public/https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
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
