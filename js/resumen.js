/**
 *
 * @param {string} pageId
 * @param {number} flag
 * @param {string} flagMsg
 * @param {string} cuenta
 */
function paging(pageId, flag = 0, flagMsg = '', cuenta = '') {
    document.getElementById("TELEFONOS").style.display = "none";
    document.getElementById("REFERENCIAS").style.display = "none";
    document.getElementById("LABORAL").style.display = "none";
    document.getElementById("CONTABLES").style.display = "none";
    document.getElementById("MISCELANEA").style.display = "none";
    document.getElementById("VISITA").style.display = "none";
    document.getElementById("HISTORIA").style.display = "none";
    document.getElementById("EXTRAS").style.display = "none";
    document.getElementById(pageid).style.display = "block";
    if (document.getElementById("GESTION")) {
        document.getElementById("GESTION").style.display = "block";
    }
    if (pageId === "VISITA") {
        document.getElementById("GESTION").style.display = "none";
    }
    if (flag > 0) {
        alert(flagMsg + ">\nBuscar para checar que gestion de cuenta " + cuenta + " está guardado correctamente.");
    }
}

function npromChange(thisform) {
    thisform.elements['N_PROM'].value = (
        thisform.elements['N_PROM1'].value * 1) +
        (thisform.elements['N_PROM2'].value * 1) +
        (thisform.elements['N_PROM3'].value * 1) +
        (thisform.elements['N_PROM4'].value * 1);
}

function statusChange(thisform) {
    if (thisform.elements['C_CVST'].substr(0, 3) === "PAG") {
        document.getElementById("pagocapt").style.backgroundColor = "yellow";
        document.getElementById("pagocapt2").style.backgroundColor = "yellow";
        document.getElementById("pagocaptv").style.backgroundColor = "yellow";
    }
}

// function clock() {
//     var d = new Date();
//     var tn = d.getTime();
//     var tll = new Date('<?php echo $tl; ?>');
//     var tl = tll.getTime();
//     document.getElementById("timer").value = tn - tl;
//     document.getElementById("timers").value = parseInt(parseInt(document.getElementById("timer").value) / 1000) % 60;
//     document.getElementById("timerm").value = parseInt(parseInt(document.getElementById("timer").value) / 1000 / 60);
//     if (document.getElementById("timerm").value > 2) {
//         document.getElementById("clock").style.backgroundColor = "yellow";
//     }
//     if (document.getElementById("timerm").value > 4) {
//         document.getElementById("clock").style.backgroundColor = "red";
//     }
//     if (document.getElementById("timer").value % 2 === 0) {
//         document.getElementById("clock").style.backgroundColor = "green";
//     }
// }

const r = {
    'special': /[\W]/g,
    'quotes': /['"]/g,
    'notNumbers': /[^\d]/g
};

function valid(o, w) {
    o.value = o.value.replace(r[w], ' ');
}

/**
 *
 * @param campo
 * @returns {boolean}
 */
function tooLong(campo) {
    if (window.document.getElementById(campo).value.length > 250) {
        window.document.getElementById(campo).value = window.document.getElementById(campo).value.replace('  ', ' ');
        window.document.getElementById(campo).value = window.document.getElementById(campo).value.substr(0, 200);
        confirm('GESTION demasiado largo');
        window.document.getElementById(campo).style.backgroundColor = "yellow";
        return false;
    }
}

function showsearch() {
    document.getElementById('searchbox').style.display = "block";
    document.getElementById('find').focus();
}

function cancelbox(boxname) {
    document.getElementById(boxname).style.display = "none";
    searching = "";
}

function addToTels(pos, tel) {
    document.getElementById("C_TELE").options[pos] = new Option(tel.value, tel.value, true, true);
    document.getElementById("C_TELE").options[pos].style.fontWeight = "bold";
    document.getElementById("C_TELE").options[pos].style.backgroundColor = "#00FF00";
}
