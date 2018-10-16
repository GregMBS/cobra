$(function() {
    // $('.fecha').datepicker();
    // $('#tabs').tabs();
    $('#history').dataTable({
        "bJQueryUI": true,
        "order": [[ 1, "desc" ]]
    });
    if (flag > 0) {
        alert(flagmsg +
            "\nBuscar para checar que gestion de cuenta " + cuenta +
            " está guardado corectamente.");
    }
    if (notalert > 0) {
        $('#notasq input').css('backgroundColor', 'red');
    }
    if ('visitador' === tipo) {
        $('#databox').hide();
        $('#prombox').hide();
        $('#nuevoboxt').hide();
        $('#combox').hide();
        $('#guardbox').hide();
        $('#dtelboxt').hide();
        $('#clock').hide();
        $('#visitboxt').show();
        $('#visitbox').show();
    }
    var inactivo = new RegExp('-');
    var isAdmin = ('admin' !== tipo);
    if (inactivo.test(sdc) && isAdmin) {
        $('#GUARDbutt').hide();
    }
});

function tooLong(e) {
    var obse = $("#C_OBSE1");
    if (obse.val().length > 250) {
        obse.val(obse.val().replace(' 	', ' '));
        obse.val(obse.val().substr(0, 200));
        confirm('GESTION demasiado largo');
        obse.css('backgroundColor',"yellow");
        return false;
    }
}

function cancelbox(boxname) {
	var boxId = '#' + boxname;
    $(boxId).hide();
}

function statusChange() {
    const cvst = $('#C_CVST').val();
    if (cvst.substr(0, 3) === "PAG") {
            $("#pagocapt").css('backgroundColor', "yellow");
            $("#pagocapt2").css('backgroundColor', "yellow");
            $("#pagocaptv").css('backgroundColor', "yellow");
    }
}

function addToTels(pos, tel) {
    var tele = $("#C_TELE");
    tele.options[pos] = new Option(tel.value, tel.value, true, true);
    tele.options[pos].css('fontWeight', "bold");
    tele.options[pos].css('backgroundColor', "green");
}

function npromChange(thisform) {
    thisform.N_PROM.value = (thisform.N_PROM1.value * 1)
        + (thisform.N_PROM2.value * 1)
        + (thisform.N_PROM3.value * 1)
        + (thisform.N_PROM4.value * 1);
}


function valid(o, w) {
    var regex = /r[w]/gi;
    o.value = o.value.replace(regex, ' ');
}

function logout() {
    window.location = "logout";
}
