function aviso() {}
function npromChange(thisform)
{
    thisform.N_PROM.value = (thisform.N_PROM1.value * 1) + (thisform.N_PROM2.value * 1);
}
function statusChange(thisform)
{
    if (thisform.C_CVST.substr(0, 3) === "PAG") {
        document.getElementById("pagocapt").style.backgroundColor = "yellow";
        document.getElementById("pagocapt2").style.backgroundColor = "yellow";
        document.getElementById("pagocaptv").style.backgroundColor = "yellow";
    }
}

var r = {
    'special': /[\W]/g,
    'quotes': /['\''&'\"']/g,
    'notnumbers': /[^\d]/g
};

function valid(o, w) {
    o.value = o.value.replace(r[w], ' ');
}

function tooLong(e)
{
    if (window.document.getElementById("C_OBSE1").value.length > 250) {
        window.document.getElementById("C_OBSE1").value = window.document.getElementById("C_OBSE1").value.replace('  ', ' ');
        window.document.getElementById("C_OBSE1").value = window.document.getElementById("C_OBSE1").value.substr(0, 200);
        confirm('GESTION demasiado largo');
        window.document.getElementById("C_OBSE1").style.backgroundColor = "yellow";
        return false;
    }
}
function showsearch()
{
    document.getElementById('searchbox').style.display = "block";
    document.getElementById('find').focus();
}
function showbox(boxname)
{
    document.getElementById(boxname).style.display = "block";
}
function cancelbox(boxname)
{
    document.getElementById(boxname).style.display = "none";
    searching = "";
}
function addToTels(pos, tel) {
    document.getElementById("C_TELE").options[pos] = new Option(tel.value, tel.value, true, true);
    document.getElementById("C_TELE").options[pos].style.fontWeight = "bold";
    document.getElementById("C_TELE").options[pos].style.backgroundColor = "#00FF00";
}
function clock(ptl) {
    var d = new Date();
    var tn = d.getTime();
    var tll = new Date(ptl);
    var tl = tll.getTime();
    document.getElementById("timer").value = tn - tl;
    document.getElementById("timers").value = parseInt(parseInt(document.getElementById("timer").value) / 1000) % 60;
    document.getElementById("timerm").value = parseInt(parseInt(document.getElementById("timer").value) / 1000 / 60);
    if (document.getElementById("timerm").value > 2) {
        document.getElementById("clock").style.backgroundColor = "yellow";
    }
    if (document.getElementById("timerm").value > 4) {
        document.getElementById("clock").style.backgroundColor = "red";
    }
    if (document.getElementById("timer").value % 2 === 0) {
        document.getElementById("clock").style.backgroundColor = "green";
    }
}
$(document).ready(function () {
    $('#histable').DataTable({
                    "bPaginate": false,
                    "bJQueryUI": true
                });
    $('#tabs').tabs({
        active: 6
    });
    $.datepicker.setDefaults(getMx());
    $('#C_VD').datepicker({
        maxDate: 0
    });
    $('#D_PROMv').datepicker();
    $('#D_PAGOv').datepicker();
    $('#D_PAGOi').datepicker();
    $('#D_PROM1').datepicker({
        minDate: 0,
        maxDate: '+15d'
    });
    $('#D_PROM2').datepicker({
        minDate: 0,
        maxDate: '+30d'
    });
    $('#D_PROM3').datepicker({
        minDate: 0,
        maxDate: '+30d'
    });
    $('#D_PROM4').datepicker({
        minDate: 0,
        maxDate: '+30d'
    });
    openSearch();
});