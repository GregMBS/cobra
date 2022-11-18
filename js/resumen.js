/**
 *
 * @param {string} timelock
 */
function openSearch(timelock) {
    setInterval(function() { clock(timelock); }, 1000);

    const pagable = document.getElementsByClassName("pagable");

    document.getElementById('gestionForm').C_CVST.onchange = function() {
        let estatus = this.value;
        for (let i = 0; i < pagable.length; i++) {
            pagable[i].style.backgroundColor = "";
        }
        if (estatus.substring(0, 2) === "PAG") {
            for (let i = 0; i < pagable.length; i++) {
                pagable[i].style.backgroundColor = "yellow";
            }
        }
    }
}

/**
 *
 * @param {string} pageId
 * @param {number} flag
 * @param {string} flagMsg
 * @param {string} cuenta
 */
function paging(pageId, flag = 0, flagMsg = '', cuenta = '') {
    const tels = document.getElementById("TELEFONOS");
    if (tels) {
        tels.style.display = "none";
    }
    document.getElementById("REFERENCIAS").style.display = "none";
    document.getElementById("LABORAL").style.display = "none";
    document.getElementById("CONTABLES").style.display = "none";
    document.getElementById("MISCELANEA").style.display = "none";
    document.getElementById("VISITA").style.display = "none";
    document.getElementById("HISTORIA").style.display = "none";
    document.getElementById(pageId).style.display = "block";
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


/**
 *
 * @param {string} timelock
 */
function clock(timelock) {
    const d = new Date();
    const tn = d.getTime();
    const tll = new Date(timelock);
    const tl = tll.getTime();
    const timer = document.getElementById("timer");
    const timers = document.getElementById("timers");
    const timerm = document.getElementById("timerm");
    const clock = document.getElementById("clock");
    timer.value = tn - tl;
    timers.value = Math.floor((timer.value) / 1000) % 60;
    timerm.value = Math.floor(timer.value / 1000 / 60);
    if (timerm.value > 2) {
        clock.style.backgroundColor = "yellow";
    }
    if (timerm.value > 4) {
        clock.style.backgroundColor = "red";
    }
    if (timer.value % 2 === 0) {
        clock.style.backgroundColor = "green";
    }
}

const r = {
    'special': /\W/g,
    'quotes': /['"]/g,
    'notNumbers': /\D/g
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
        window.document.getElementById(campo).value = window.document.getElementById(campo).value.substring(0, 199);
        confirm('GESTION demasiado largo');
        window.document.getElementById(campo).style.backgroundColor = "yellow";
        return false;
    }
}

function showSearch() {
    document.getElementById('SearchBox').style.display = "block";
    document.getElementById('find').focus();
}

function cancelBox(boxname) {
    document.getElementById(boxname).style.display = "none";
}

function addToTels(pos, tel) {
    document.getElementById("C_TELE").options[pos] = new Option(tel.value, tel.value, true, true);
    document.getElementById("C_TELE").options[pos].style.fontWeight = "bold";
    document.getElementById("C_TELE").options[pos].style.backgroundColor = "#00FF00";
}
