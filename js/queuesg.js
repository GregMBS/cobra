$(function () {
    const cliente = $("#cliente");
    const sdc = $("#sdc");
    const queue = $("#queue");
    const body = $("body");
    $("button").button();
    $("#intro").button();
    cliente.empty();
    sdc.empty();
    queue.empty();
    body.css("font-size", "10pt");
    body.css("text-align", "center");
    cliente.css("text-align", "left");
    $("div").css("float", "left");
    $(".introb").css("clear", "left");
    $.each(arrayC, function (index, value) {
        let data = '<div class="column"><input class="columnc" '
            + 'type="radio" name="cliente" value="' + value
            + '" />' + value + '</div>';
        cliente.append(data);
    });
    cliente.change(function () {
        sdc.empty();
        queue.empty();
        let data2 = $('input[name=cliente]:checked').val();
        $.each(arrayS, function (index, sdc) {
            if (sdc[1] === data2) {
                let st = sdc[0];
                if (st === '') {
                    st = 'TODOS';
                }
                let data3 = '<div class="column"><input class="columns" '
                    + 'type="radio" name="sdc" value="'
                    + sdc[0] + '" />' + st + '</div>';
                sdc.append(data3);
            }
        });
        sdc.css("text-align", "left");
    });
    sdc.change(function () {
        queue.empty();
        let data2 = $('input[name=cliente]:checked').val();
        let data4 = $('input[name=sdc]:checked').val();
        $.each(arrayQ, function (index, que) {
            if ((que[1] + que[2]) === (data4 + data2)) {
                let qt = que[0];
                if (qt === '') {
                    qt = 'TODOS';
                }
                let data5 = '<div class="column"><input class="columnq" '
                    + 'type="radio" name="queue" value="'
                    + que[0] + '" />' + qt + '</div>';
                queue.append(data5);
            }
        });
        queue.css("text-align", "left");
    });
});
