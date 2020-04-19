<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Sus queues</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet"
              href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"
              type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"
        type="text/javascript"></script>
    </head>
    <body>
        <script>
            $(function () {
                const clienteId = $("#cliente");
                const queueId = $("#queue");
                const sdcId = $("#sdc");
                const bodyId = $("body");
                $("button").button();
                $("#intro").button();
                clienteId.empty();
                sdcId.empty();
                queueId.empty();
                bodyId.css("font-size", "10pt");
                bodyId.css("text-align", "center");
                clienteId.css("text-align", "left");
                $("div").css("float", "left");
                $(".introb").css("clear", "left");
                $.each(<?php echo $arrayc; ?>, function (index, value) {
                    const data = '<div class="column"><input class="columnc" '
                            +'type="radio" name="cliente" value="' + value 
                            + '" />' + value + '</div>';
                    $('#cliente').append(data);
                });
                clienteId.change(function () {
                    sdcId.empty();
                    queueId.empty();
                    const data2 = $('input[name=cliente]:checked').val();
                    $.each(<?php echo $arrays; ?>, function (index, sdc) {
                        if (sdc[1] === data2) {
                            let st = sdc[0];
                            if (st === '') {
                                st = 'TODOS';
                            }
                            const data3 = '<div class="column"><input class="columns" '
                                    +'type="radio" name="sdc" value="' 
                                    + sdc[0] + '" />' + st + '</div>';
                            sdcId.append(data3);
                        }
                    });
                    sdcId.css("text-align", "left");
                });
                sdcId.change(function () {
                    queueId.empty();
                    const data2 = $('input[name=cliente]:checked').val();
                    const data4 = $('input[name=sdc]:checked').val();
                    $.each(<?php echo $arrayq; ?>, function (index, que) {
                        if ((que[1] + que[2]) === (data4 + data2)) {
                            let qt = que[0];
                            if (qt === '') {
                                qt = 'TODOS';
                            }
                            const data5 = '<div class="column"><input class="columnq" '
                                    +'type="radio" name="queue" value="' 
                                    + que[0] + '" />' + qt + '</div>';
                            queueId.append(data5);
                        }
                    });
                    queueId.css("text-align", "left");
                });
            });
        </script>
        <?php echo $msg; ?>
        <div>
            <form method='get' action='#' name='queueForm'>
                <div>
                    <label for="gestor">Gestor:</label><br>
                    <input name='gestor' id="gestor" type='text' readonly='readonly' value='<?php echo $capt; ?>'>
                </div>
                <div>
                    <br>
                    <div>CLIENTE<br>
                        <div id='cliente'>
                        </div>
                    </div>
                    <div>SEGMENTO<BR>
                        <div id='sdc'>
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
                </div>
            </form>
        </div>
        <div class='introb'>
            <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Cuentas</button>
        </div>
    </body>
</html> 
