function trim(str) {
    if (!str || typeof str !== 'string') {
        return null;
    }

    return str.replace(/^[\s]+/, '').replace(/[\s]+$/, '').replace(/[\s]{2,}/, ' ');
}

function stopEvent(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    } else {
        e.cancelBubble = true;
    }

    if (e.preventDefault) {
        e.preventDefault();
    } else {
        e.returnValue = false;
    }
}

function validate_required(f) {
    if ((f.value === null) || (f.value === "") || (f.value === " ") || (f.value === '0') || (f.value === "0000-00-00") || (typeof f === 'undefined')) {
        return false;
    }
}

function validate_date(f) {
    if ((f.value === null) || (f.value === "") || (f.value === " ") || (f.value === "0000-00-00")) {
        return false;
    }
}

/**
 * @property {object} gestion form
 * @property {float} gestion.minprom Pago mínimo
 * @property {boolean} gestion.authorized Is admin?
 * @property {float} gestion.saldo_total
 * @property {float} gestion.N_PAGO
 * @property {string} gestion.C_PROM
 * @property {float} gestion.N_PROM
 * @property {float} gestion.N_PROM_OLD
 * @property {float} gestion.N_PROM1
 * @property {float} gestion.N_PROM2
 * @property {float} gestion.N_PROM3
 * @property {float} gestion.N_PROM4
 * @property {string} gestion.D_FECH
 * @property {string} gestion.D_PAGO
 * @property {string} gestion.D_PROM
 * @property {string} gestion.D_PROM1
 * @property {string} gestion.D_PROM2
 * @property {string} gestion.D_PROM3
 * @property {string} gestion.D_PROM4
 * @property {string} gestion.C_OBSE1
 * @property {string} gestion.C_OBSE2
 * @property {string} gestion.C_CVST
 * @property {string} gestion.C_CARG
 * @property {string} gestion.C_TELE
 * @property {string} gestion.C_NTEL
 * @property {string} gestion.C_CNP
 * @property {string} gestion.C_CONTAN
 * @property {string} gestion.CUANDO
 * @property {string} gestion.CUENTA
 * @property {string} gestion.ACCION
 * @property {string} gestion.C_CVGE
 * @property {string} gestion.C_MOTIV
 */
const gestion = document.forms['gestionForm'];
gestion.onsubmit = function (evt) {
    let alertTxt = ' ', flag = 0, npa = 0, n1 = 0, n2 = 0, n3 = 0, n4 = 0,
        st = 1000000, ccn = " ", cnt = "", co2 = "", cuando = "", dp1 = "0000-00-00",
        dp2 = "0000-00-00", dPago = "0000-00-00";
    const minprom = parseFloat(gestion.minprom);
    const authorized = parseFloat(gestion.authorized);

//actual sum de promesa
    if (typeof (gestion.saldo_total) !== "undefined") {
        st = parseFloat(gestion.saldo_total.value);
    }
    if (typeof (gestion.N_PAGO) !== "undefined") {
        npa = parseFloat(gestion.N_PAGO.value);
    }
    if (typeof (gestion.N_PROM1) !== "undefined") {
        n1 = parseFloat(gestion.N_PROM1.value);
    }
    if (typeof (gestion.N_PROM2) !== "undefined") {
        n2 = parseFloat(gestion.N_PROM2.value);
    }
    if (typeof (gestion.N_PROM3) !== "undefined") {
        n3 = parseFloat(gestion.N_PROM3.value);
    }
    if (typeof (gestion.N_PROM4) !== "undefined") {
        n4 = parseFloat(gestion.N_PROM4.value);
    }
    const np = n1 + n2 + n3 + n4;
    /*
    if (typeof (gestion.N_PROM_OLD) !== "undefined")
    {
        npo = parseFloat(gestion.N_PROM_OLD.value);
    }
    */
    let cvt = '';
    if (typeof (gestion.C_CVST) !== "undefined") {
        cvt = trim(gestion.C_CVST.value);
    }

    if (typeof (gestion.C_CONTAN) !== "undefined") {
        ccn = trim(gestion.C_CONTAN.value);
    }
    if (typeof (gestion.C_NTEL) !== "undefined") {
        cnt = trim(gestion.C_NTEL.value);
    }
    if (typeof (gestion.C_OBSE2) !== "undefined") {
        co2 = gestion.C_OBSE2.value;
    }
    if (typeof (gestion.CUANDO.value) !== "undefined") {
        cuando = gestion.CUANDO.value;
    }
    /*
    if (typeof (gestion.C_CARG.value) !== "undefined")
    {
        cargo = gestion.C_CARG.value;
    }
    */
    if (typeof (gestion.D_PROM1.value) !== "undefined") {
        dp1 = gestion.D_PROM1.value;
    }
    if (typeof (gestion.D_PROM2.value) !== "undefined") {
        dp2 = gestion.D_PROM2.value;
    }
    /*
    if (typeof (gestion.D_PROM3.value) !== "undefined")
    {
        dp3 = gestion.D_PROM3.value;
    }
    if (typeof (gestion.D_PROM4.value) !== "undefined")
    {
        dp4 = gestion.D_PROM4.value;
    }
    if (typeof (gestion.D_PROM1_OLD.value) !== "undefined")
    {
        dpo = gestion.D_PROM1_OLD.value;
    }

     */
    if (typeof (gestion.D_PAGO.value) !== "undefined") {
        dPago = gestion.D_PAGO.value;
    }
    alert('Checando validad de gestion:\nCUENTA - ' + gestion.CUENTA.value + '\nStatus - ' + cvt);

    try {
//Promise date-amount checks - promise 1
        if (cvt === '') {
            gestion.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
            alertTxt = alertTxt + 'Tiene que elegir el estatus de la gestion.';
        }
        if ((n1 > 0)) {
//wrong status for promise
            const promStat = ["PROMESA DE PAGO PARCIAL", "PROMESA DE PAGO TOTAL", "CONFIRMA PROMESA"];
            if (promStat.indexOf(cvt) === -1) {
                gestion.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'Este status no permite promesa';
            }

//amount but no date	
            if ((validate_date(gestion.D_PROM1)) === false) {
                gestion.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'No hay fecha de promesa 1.' + dp1;
            }
            if (dp1 === '0000-00-00') {
                gestion.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'No hay fecha de promesa 1.' + dp1;
            }
// promise in past
            if (dp1 < gestion.D_FECH.value) {
                gestion.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'Fecha de promesa es en pasada.';
            }
        }
    } catch (err) {
        const n1txt = "Error en primera promesa";
        alert(n1txt);
        flag = 1;
    }
    try {
//Promise date-amount checks - promise 2
        if ((n2 > 0)) {
//amount but no date	
            if ((validate_date(gestion.D_PROM2)) === false) {
                gestion.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'No hay fecha de promesa 2.';
            }
            if (dp2 === '0000-00-00') {
                gestion.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'No hay fecha de promesa 2.' + dp1;
            }
// promise in past
            if (dp2 < gestion.D_FECH.value) {
                gestion.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'Fecha de promesa es en pasada.';
            }
// 2 promises same date			
            if (dp2 === dp1) {
                gestion.D_PROM1.style.backgroundColor = "yellow";
                gestion.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'Hay dos pagos en mismo dia.';
            }
        }
// promise in wrong box
        if ((n1 === 0) && (n2 > 0)) {
            gestion.N_PROM1.style.backgroundColor = "yellow";
            gestion.N_PROM2.style.backgroundColor = "yellow";
            flag = 1;
            alertTxt = alertTxt + 'Si hay solo un pago, va al primero campo.';
        }
        if ((dp1 > dp2) && (dp2 > gestion.D_FECH.value)) {
            gestion.D_PROM1.style.backgroundColor = "yellow";
            gestion.D_PROM2.style.backgroundColor = "yellow";
            flag = 1;
            alertTxt = alertTxt + 'Si hay solo un pago, va al primero campo.';
        }
    } catch (err) {
        const n2txt = "Error en nprom2";
        alert(n2txt);
        flag = 1;
    }
    try {
//GESTIONES necesitan a lo menos 2 palabras
        if (gestion.C_OBSE1.value.indexOf(" ") === -1) {
            alertTxt = alertTxt + 'GESTION no está completada' + '\n' + gestion.C_OBSE1.value;
            gestion.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
//Picky gringo language rules
        if (gestion.C_OBSE1.value.indexOf(" K ") !== -1) {
            alertTxt = alertTxt + 'Usa QUE en lugar de K' + '\n';
            gestion.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (gestion.C_OBSE1.value.indexOf("CHING") !== -1) {
            alertTxt = alertTxt + 'Moderar su lenguaje' + '\n';
            gestion.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (gestion.C_OBSE1.value.indexOf(" CTA") !== -1) {
            alertTxt = alertTxt + '¿Significa CTA CUENTA o CONTESTA?' + '\n';
            gestion.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have gestor
        if (validate_required(gestion.C_CVGE) === false) {
            alertTxt = alertTxt + 'GESTOR es necesario\n';
            gestion.C_CVGE.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have telephone
        if (validate_required(gestion.C_TELE) === false) {
            alertTxt = alertTxt + 'TELEFONO es necesario\n';
            gestion.C_TELE.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must Have status
        if (validate_required(gestion.C_CVST) === false) {
            alertTxt = alertTxt + 'STATUS es necesario\n';
            gestion.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have accion
        if (validate_required(gestion.ACCION) === false) {
            alertTxt = alertTxt + 'ACCION es necesario\n';
            gestion.ACCION.style.backgroundColor = "yellow";
            flag = 1;
        }
    } catch (err) {
        const basictxt = "Error en basics";
        alert(basictxt);
        flag = 1;
    }
//Inbounds need motivation and carga/parentesco
    if (gestion.C_TELE.value === 'Entrante') {
        if (validate_required(gestion.C_MOTIV) === false) {
            alertTxt = alertTxt + 'MOTIVACION es necesario\n';
            gestion.C_MOTIV.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_required(gestion.C_CNP) === false) {
            alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
        if (validate_required(gestion.C_CNP) === false) {
            alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (n2 > 0) {
        if (validate_required(gestion.C_CNP) === false) {
            alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//Debtor must give causa no pago
    if (gestion.C_CARG.value === 'Deudor') {
        if (validate_required(gestion.C_CNP) === false) {
            alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//GESTION too long
    if (gestion.C_OBSE1.length > 250) {
        alertTxt = alertTxt + 'GESTION demasiado largo\n';
        gestion.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if (cvt !== '') {
//CONFIRMA PROMESA requires PROMESA and cargo/parentesco
        if (cvt.substr(0, 8) === "CONFIRMA") {
            if (validate_required(gestion.N_PROM_OLD) === false) {
                alertTxt = alertTxt + 'Promesa primera, confirma después\n';
                gestion.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(gestion.C_CARG) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                gestion.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//MENSAJE CON FAMILIAR requires causa no pago and cargo/parentesco        
        if (cvt === "MENSAJE CON FAMILIAR") {
            if (validate_required(gestion.C_CARG) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                gestion.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(gestion.C_CNP) === false) {
                alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
                gestion.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (gestion.C_CARG.value === 'Deudor') {
                alertTxt = alertTxt + 'El deudor no es un familiar\n';
                gestion.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//MENSAJE CON TERCERO requires cargo/parentesco
        if (cvt === "MENSAJE CON TERCERO") {
            if (validate_required(gestion.C_CARG) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                gestion.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (gestion.C_CARG.value === 'Deudor') {
                alertTxt = alertTxt + 'El deudor no es un tercero\n';
                gestion.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//CLIENTE NEGOCIANDO requires cargo/parentesco
        if (cvt === "CLIENTE NEGOCIANDO") {
            if (validate_required(gestion.C_CARG) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                gestion.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minprom and less than or equal to saldo total      
        if (cvt === "PROMESA DE PAGO TOTAL") {
            if (validate_required(gestion.C_CARG) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                gestion.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if ((np < minprom) && (authorized < 1)) {
                gestion.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'Monto de promesa ' + np + ' está menor que monto minimo ' + minprom;
            }
        }
        if (np > (st * 1.25)) {
            gestion.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
            alertTxt = alertTxt + 'Monto de promesa ' + np + ' está más que saldo total ' + st;
        }
    }

//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom      
    if (cvt === "PROMESA DE PAGO PARCIAL") {
        if (validate_required(gestion.C_CARG) === false) {
            alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (n1 < 10) {
            alertTxt = alertTxt + "MONTO DE PROMESA es necesario" + '\n';
            gestion.C_CVST.style.backgroundColor = "yellow";
            gestion.N_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
    if (cvt.substr(0, 12) === "PROPUESTA DE") {
        if (n1 < 10) {
            alertTxt = alertTxt + "MONTO DE PROMESA es necesario" + '\n';
            gestion.N_PROM1.style.backgroundColor = "yellow";
            gestion.N_PROM2.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_required(gestion.C_CARG) === false) {
            alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO and REGULARIZADA and REESTRUCTURADA 
//require monto de pago y fecha hoy o en pasado 
    if (dPago > gestion.D_FECH.value) {
        alertTxt = alertTxt + 'Fecha de pago en el porvenir\nPAGO=' + gestion.D_PAGO.value + '\nHOY=' + gestion.D_FECH.value + '\n';
        gestion.D_PAGO.style.backgroundColor = "orange";
        flag = 1;
    }
    if ((cvt.substr(0, 3) === "PAG") || ((cvt.substr(0, 2) === "RE") && (authorized < 1))) {
        document.getElementById("pagocapt").style.display = "table-row";
        document.getElementById("pagocapt2").style.display = "table-row";
        if (validate_required(gestion.N_PAGO) === false) {
            alertTxt = alertTxt + 'Monto de pago es necesario\n';
            gestion.N_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (npa < 10) {
            alertTxt = alertTxt + 'Monto de pago es necesario\n';
            gestion.N_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_date(gestion.D_PAGO) === false) {
            alertTxt = alertTxt + 'Fecha de pago es necesario\n';
            gestion.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (dPago === '0000-00-00') {
            alertTxt = alertTxt + 'Fecha de pago es necesario\n';
            gestion.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (dPago > gestion.D_FECH.value) {
            alertTxt = alertTxt + 'Fecha de pago en el porvenir\nPAGO=' + gestion.D_PAGO.value + '\nHOY=' + gestion.D_FECH.value + '\n';
            gestion.D_PAGO.style.backgroundColor = "orange";
            flag = 1;
        }
    }
    if ((cvt === "PAGO TOTAL") && (npa < minprom) && (authorized < 1)) {
        alertTxt = alertTxt + 'Monto de pago no es suficiente para PAGO TOTAL\n';
        gestion.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
//ACLARACIONS need cargo/parentesco
    if (cvt === "ACLARACION") {
        if (validate_required(gestion.C_CARG) === false) {
            alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//NEGATIVAS DE PAGO need cargo/parentesco
    if (cvt === "NEGATIVA DE PAGO") {
        if (validate_required(gestion.C_CARG) === false) {
            alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
            gestion.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//NO CONTACTO means NO CONTACTO!	
    if (cvt.substr(0, 4) === "TEL ") {
        if (gestion.C_CARG.value.length !== 0) {
            alertTxt = alertTxt + 'Cargo del contacto no es necesario cuando STATUS es ' + cvt;
            gestion.C_CARG.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (cvt.substr(0, 11) === "MENSAJE EN ") {
        if (gestion.C_CARG.value.length !== 0) {
            alertTxt = alertTxt + 'Cargo del contacto no es necesario cuando STATUS es ' + cvt;
            gestion.C_CARG.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
// If you have contact, need best time
    const cuandoMatchListStr = "CONFIRMA PROMESA|" +
        'MENSAJE CON FAMILIAR|PAGANDO CONVENIO|MENSAJE CON TERCERO|CLIENTE NEGOCIANDO|' +
        'PROMESA DE PAGO TOTAL|' +
        'PROMESA DE PAGO PARCIAL|' +
        'PROPUESTA DE PAGO|' +
        'NEGATIVA DE PAGO|' +
        'MENSAJE CON EMPLEADO';
    const cargoMatchList = new RegExp(cuandoMatchListStr);
    try {
        if (cvt.match(cargoMatchList)) {
            if (cuando.length === 0) {
                alertTxt = alertTxt + 'Contacto requiere LOCALIZABLE';
                gestion.CUANDO.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
    } catch (err) {
        alert(cvt + ' ' + cargoMatchList);
        flag = 1;
    }

//monto de promesa can only have numbers and one decimal point.
    if (!((n1.toString()).match(/[0-9.]/))) {
        alertTxt = alertTxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        gestion.N_PROM1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if (!((n2.toString()).match(/[0-9.]/))) {
        alertTxt = alertTxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        gestion.N_PROM2.style.backgroundColor = "yellow";
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    if (!((npa.toString()).match(/[0-9.]/))) {
        alertTxt = alertTxt + 'No puede usarse un separador de miles' + '\n';
        gestion.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
//new telephones can only have numbers
    if (cnt !== '') {
        if (!((cnt.toString()).match(/[0-9]/))) {
            alertTxt = alertTxt + 'No puede usarse un separador o letras en telefonos' + '\n';
            gestion.C_NTEL.style.backgroundColor = "yellow";
            flag = 1;
        }
        if ((cnt.length !== 0) && (cnt.length !== 8) && (cnt.length !== 10) && (cnt.length !== 13)) {
            alertTxt = alertTxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            gestion.C_NTEL.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (co2 !== '') {
        if ((co2.length !== 0) && (co2.length !== 8) && (co2.length !== 10) && (co2.length !== 13)) {
            alertTxt = alertTxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            gestion.C_OBSE2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//date checks on promises
    if (n1 > 0) {
//date must be today or in future
        if (dp1 < gestion.D_FECH.value) {
            alertTxt = alertTxt + 'Fecha de promesa en pasado' + '\nPROM=' + dp1 + '\nHOY=' + gestion.D_FECH.value + '\n';
            gestion.D_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (authorized < 1) {
            //aflag = flag + 0;
            if (ccn === "PROMESA DE PAGO TOTAL") {
                alertTxt = alertTxt + "Solamente un supervisor puede sobreescribido una promesa activa.";
                flag = 1;
            }
        }
    }
    if (n2 > 0) {
//date must be today or in future
        if (dp2 < gestion.D_FECH.value) {
            alertTxt = alertTxt + 'Fecha de promesa en pasado' + '\nPROM=' + dp2 + '\nHOY=' + gestion.D_FECH.value + '\n';
            gestion.D_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (authorized < 1) {
            if (dp2.substr(0, 7) !== gestion.D_FECH.value.substr(0, 7)) {
                alert("Promesas en el mes siguiente necesita autorización");
                flag = 1;
            }
        }
//date needs amount
        if (validate_required(gestion.D_PROM2) === false) {
            alertTxt = alertTxt + "Fecha de promesa es necesario\n";
            gestion.D_PROM2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//monto de pago needs fecha de pago
    if (npa > 0.0) {
        if (validate_date(gestion.D_PAGO) === false) {
            alertTxt = alertTxt + 'Fecha de pago es necesario\n';
            gestion.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//promises need schedule
    if (np > 0) {
        if (validate_required(gestion.C_PROM) === false) {
            alertTxt = alertTxt + "Frecuencia de pago es necesario\n";
            gestion.C_PROM.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    let alertString = 'Gestion de cuenta ' + gestion.CUENTA.value + ' guardado con status ' + cvt + ".\n";
    if (n1 > 0) {
        alertString = alertString + " Fecha de promesa 1: " + dp1 + " ";
    }
    if (n1 > 0) {
        alertString = alertString + " Monto de promesa 1: $" + n1 + "\n";
    }
    if (n2 > 0) {
        alertString = alertString + " Fecha de promesa 2: " + dp2 + " ";
    }
    if (n2 > 0) {
        alertString = alertString + " Monto de promesa 2: $" + n2 + "\n";
    }
    if (npa > 0) {
        alertString = alertString + " Fecha de promesa total: " + dPago;
    }
    if (npa > 0) {
        alertString = alertString + " Monto de promesa total: $" + npa;
    }

    if (flag === 0) {
        alert(alertString);
        gestion.error.value = 0;
        return true;
    } else {
        alert('ERROR EA2 - ' + alertTxt + '\nGestion no se guardó.');
        stopEvent(evt);
    }
}

