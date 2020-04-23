/**
 *
 * @property {HTMLFormElement} thisForm
 */
function npromChange(thisForm) {
    thisForm.N_PROM.value = thisForm.N_PROM1.value + thisForm.N_PROM2.value
        + thisForm.N_PROM3.value + thisForm.N_PROM4.value;
}

/**
 *
 * @property {HTMLFormElement} thisForm
 */
function statusChange(thisForm) {
    if (thisForm.C_CVST.substr(0, 3) === "PAG") {
        document.getElementById("pagocapt").style.backgroundColor = "yellow";
        document.getElementById("pagocapt2").style.backgroundColor = "yellow";
        document.getElementById("pagocaptv").style.backgroundColor = "yellow";
    }
}

/**
 *
 * @param {string} boxName
 */
function cancelbox(boxName) {
    document.getElementById(boxName).style.display = "none";
}

/**
 *
 * @param {number} pos
 * @param {HTMLOptionElement} tel
 */
function addToTels(pos, tel) {
    document.getElementById("C_TELE").options[pos] = new Option(tel.value, tel.value, true, true);
    document.getElementById("C_TELE").options[pos].style.fontWeight = "bold";
    document.getElementById("C_TELE").options[pos].style.backgroundColor = "#00FF00";
}
