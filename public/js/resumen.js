$(function() {
    $('.fecha').datepicker();
    $('#tabs').tabs();
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
    openSearch();
});

function clock() {
    var d = new Date();
    var tn = d.getTime();
    var tll = new Date(tlp);
    var tl = tll.getTime();
    var timer = $("#timer");
    var timers = $("#timers");
    var timerm = $("#timerm");
    var clock = $("#clock");
    timer.val(tn - tl);
    var timenow = timer.val();
    timers.val(parseInt(parseInt(timenow) / 1000) % 60);
    timerm.val(parseInt(parseInt(timenow) / 1000 / 60));
    var timemin = timerm.val();
    if (timemin > 2) {
        clock.css('backgroundColor', 'yellow');
    }
    if (timemin > 4) {
        clock.css('backgroundColor', 'red');
    }
    var evenodd = parseInt(timenow) % 2;
    if (0 === evenodd) {
        clock.css('backgroundColor', 'green');
    }
}

function openSearch() {
    setInterval('clock()', 1000);
}

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

function showsearch() {
	$("#searchbox").show();
    $('#find').focus();
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
    thisform.N_PROM.value = (thisform.N_PROM1.value * 1) + (thisform.N_PROM2.value * 1);
}


function valid(o, w) {
    var regex = /r[w]/gi;
    o.value = o.value.replace(regex, ' ');
}

function logout() {
    window.location = "logout";
}
