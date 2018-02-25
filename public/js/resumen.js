$(function() {
    $('.fecha').datepicker();
    $('#tabs').tabs();
    $('#history').datatable();
    if (flag > 0) {
        alert(flagmsg +
            "\nBuscar para checar que gestion de cuenta " + cuenta +
            " está guardado corectamente.");
    }
    if (notalert > 0) {
        $('#notasq input').css('backgroundColor', 'red');
    }
    if (tipo == 'visitador') {
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
    if (inactivo.test(sdc) && (tipo != 'admin')) {
        $('#GUARTbutt').hide();
    }
    openSearch();
});

function clock() {
    var d = new Date();
    var tn = d.getTime();
    var tll = new Date(tlp);
    var tl = tll.getTime();
    $("#timer").val(tn - tl);
    var timenow = $("#timer").val();
    $("#timers").val(parseInt(parseInt(timenow) / 1000) % 60);
    $("#timerm").val(parseInt(parseInt(timenow) / 1000 / 60));
    var timemin = $("#timerm").val();
    if (timemin > 2) {
        $("#clock").css('backgroundColor', 'yellow');
    }
    if (timemin > 4) {
        $("#clock").css('backgroundColor', 'red');
    }
    if (timenow % 2 == 0) {
        $("#clock").css('backgroundColor', 'green');
    }
}

function openSearch() {
    setInterval('clock()', 1000);
}

function tooLong(e) {
    if ($("#C_OBSE1").val().length > 250) {
    	$("#C_OBSE1").val($("#C_OBSE1").val().replace(' 	', ' '));
    	$("#C_OBSE1").val($("#C_OBSE1").val().substr(0, 200));
        confirm('GESTION demasiado largo');
        $("#C_OBSE1").css('backgroundColor',"yellow");
        return false;
    }
}

function showsearch() {
	$("#searchbox").show();
    $('#find').focus();
}

function showbox(boxname) {
	var boxId = '#' + boxname;
    $(boxId).show();
}

function cancelbox(boxname) {
	var boxId = '#' + boxname;
    $(boxId).hide();
}

function statusChange(thisform) {
    with(thisform) {
        if (C_CVST.substr(0, 3) === "PAG") {
            $("#pagocapt").css('backgroundColor', "yellow");
            $("#pagocapt2").css('backgroundColor', "yellow");
            $("#pagocaptv").css('backgroundColor', "yellow");
        }
    }
}

function addToTels(pos, tel) {
	$("#C_TELE").options[pos] = new Option(tel.value, tel.value, true, true);
	$("#C_TELE").options[pos].css('fontWeight', "bold");
	$("#C_TELE").options[pos].css('backgroundColor', "green");
}

function npromChange(thisform) {
    with(thisform) {
        N_PROM.value = (N_PROM1.value * 1) + (N_PROM2.value * 1);
    }
}


function valid(o, w) {
    o.value = o.value.replace(r[w], ' ');
}

function logout() {
    window.location = "logout";
}
