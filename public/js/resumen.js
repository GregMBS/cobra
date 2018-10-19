$(function() {
    // $('.fecha').datepicker();
    // $('#tabs').tabs();
    $('#history').dataTable({
        "bJQueryUI": true,
        "order": [[ 1, "desc" ]]
    });
    if (resumen.flag > 0) {
        alert(resumen.flagmsg +
            "\nBuscar para checar que gestion de cuenta " + resumen.cuenta +
            " está guardado corectamente.");
    }
    if (resumen.notalert > 0) {
        $('#notasq input').css('backgroundColor', 'red');
    }
    if ('visitador' === resumen.tipo) {
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
    const inactivo = new RegExp('-');
    const isAdmin = ('admin' !== resumen.tipo);
    if (inactivo.test(resumen.sdc) && isAdmin) {
        $('#GUARDbutt').hide();
    }
});

function tooLong() {
    let obse = $("#C_OBSE1");
    if (obse.val().length > 250) {
        obse.val(obse.val().replace(' 	', ' '));
        obse.val(obse.val().substr(0, 200));
        confirm('GESTION demasiado largo');
        obse.css('backgroundColor',"yellow");
        return false;
    }
}

function tooLongV() {
    let obse = $("#C_OBSE1v");
    if (obse.val().length > 250) {
        obse.val(obse.val().replace(' 	', ' '));
        obse.val(obse.val().substr(0, 200));
        confirm('GESTION demasiado largo');
        obse.css('backgroundColor',"yellow");
        return false;
    }
}

function cancelbox(boxname) {
	const boxId = '#' + boxname;
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
    let tele = $("#C_TELE");
    tele.options[pos] = new Option(tel.value, tel.value, true, true);
    tele.options[pos].css('fontWeight', "bold");
    tele.options[pos].css('backgroundColor', "green");
}

function npromChange(thisform) {
    thisform.elements['N_PROM'].value = (thisform.elements['N_PROM1'].value * 1)
        + (thisform.elements['N_PROM2'].value * 1)
        + (thisform.elements['N_PROM3'].value * 1)
        + (thisform.elements['N_PROM4'].value * 1);
}

const r = {
    'special': '\\w',
    'quotes': '\'\"',
    'notnumbers': '^\\d'
};

function valid(o, w) {
    const regex = new RegExp(r[w],'gi');
    o.value = o.value.replace(regex, ' ');
}

function logout() {
    window.location = "logout";
}
