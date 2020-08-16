function trim(str)
{
    if (!str || typeof str !== 'string')
    {
        return null;
    }

    return str.replace(/^[\s]+/, '').replace(/[\s]+$/, '').replace(/[\s]{2,}/, ' ');
}

/**
 *
 * @param value
 * @returns {boolean}
 */
function notJustNumbers(value)
{
    const test = (value.toString()).match(/[0-9.]/);
    return !test;
}

function stopEvent(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    else {
        e.cancelBubble = true;
    }

    if (e.preventDefault) {
        e.preventDefault();
    }
    else {
        e.returnValue = false;
    }
}

function validate_required(f)
{
    if ((f.value === null) || (f.value === "") || (f.value === " ") || (f.value === '0') || (f.value === "0000-00-00") || (typeof f === 'undefined'))
    {
        return false;
    }
}

function validate_date(f)
{
    if ((f.value === null) || (f.value === "") || (f.value === " ") || (f.value === "0000-00-00"))
    {
        return false;
    }
}

function picky(tf, alertText, flag) {
    if (tf.C_OBSE1.value.indexOf(" ") === -1) {
        alertText = alertText + 'GESTION no está completada' + '\n' + tf.C_OBSE1.value;
        tf.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
//Picky gringo language rules
    if (tf.C_OBSE1.value.indexOf(" K ") !== -1) {
        alertText = alertText + 'Usa QUE en lugar de K' + '\n';
        tf.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if (tf.C_OBSE1.value.indexOf("CHING") !== -1) {
        alertText = alertText + 'Moderar su lenguaje' + '\n';
        tf.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if (tf.C_OBSE1.value.indexOf(" CTA") !== -1) {
        alertText = alertText + '¿Significa CTA CUENTA o CONTESTA?' + '\n';
        tf.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
//Must Have status
    if (validate_required(tf.C_CVST) === false)
    {
        alertText = alertText + 'STATUS es necesario\n';
        tf.C_CVST.style.backgroundColor = "yellow";
        flag = 1;
    }
//Must have accion
    if (validate_required(tf.ACCION) === false)
    {
        alertText = alertText + 'ACCION es necesario\n';
        tf.ACCION.style.backgroundColor = "yellow";
        flag = 1;
    }
//Debtor must give causa no pago
    if (tf.C_CARG.value === 'Deudor') {
        if (validate_required(tf.C_CNP) === false)
        {
            alertText = alertText + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//GESTION too long
    if (tf.C_OBSE1.length > 250) {
        alertText = alertText + 'GESTION demasiado largo\n';
        tf.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
//ACLARACIONS need cargo/parentesco
    if (tf.C_CVST.value === "ACLARACION")
    {
        if (validate_required(tf.C_CARG) === false)
        {
            alertText = alertText + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//NEGATIVAS DE PAGO need cargo/parentesco
    if (tf.C_CVST.value === "NEGATIVA DE PAGO")
    {
        if (validate_required(tf.C_CARG) === false)
        {
            alertText = alertText + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    return {alertText, flag};
}

function telCheck(cnt, alertText, tf, flag, co2) {
//new telephones can only have numbers
    if (cnt !== 'null') {
        if (notJustNumbers(cnt)) {
            alertText = alertText + 'No puede usarse un separador o letras en telefonos' + '\n';
            tf.C_NTEL.style.backgroundColor = "yellow";
            flag = 1;
        }
        if ((cnt.length !== 0) && (cnt.length !== 8) && (cnt.length !== 10) && (cnt.length !== 13)) {
            alertText = alertText + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            tf.C_NTEL.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (co2 !== 'null') {
        if ((co2.length !== 0) && (co2.length !== 8) && (co2.length !== 10) && (co2.length !== 13)) {
            alertText = alertText + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            tf.C_OBSE2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    return {alertText, flag};
}

function validate_form(tf, evt, minprom, authorized)
{

//initialize 
    let flag = 0;
    let npa = 0;
    let n1 = 0;
    let n2 = 0;
    let n3 = 0;
    let n4 = 0;
    let st = 1000000;
    let ccn = " ";
    let cnt = "";
    let co2 = "";
    let cuando = "";
    let dp1 = "0000-00-00";
    let dp2 = "0000-00-00";
    let dPago = "0000-00-00";
    let alertText = '';
    /**
     * @var {object} tf
     * @property {string} saldo_total
     * @property {string} N_PAGO
     * @property {string} N_PROM1
     * @property {string} N_PROM2
     * @property {string} N_PROM3
     * @property {string} N_PROM4
     * @property {string} D_FECH
     * @property {string} D_PAGO
     * @property {string} D_PROM1
     * @property {string} D_PROM2
     * @property {string} D_PROM3
     * @property {string} D_PROM4
     * @property {string} C_CVGE
     * @property {string} C_CVST
     * @property {string} C_CONTAN
     * @property {string} C_TELE
     * @property {string} C_NTEL
     * @property {string} C_OBSE1
     * @property {string} C_OBSE2
     * @property {string} C_PROM
     * @property {string} CUANDO
     * @property {string} CUENTA
     * @property {string} ACCION
     * @property {string} C_MOTIV
     * @property {string} C_CNP
     * @property {string} C_CARG
     */
//actual sum de promesa
    if (typeof (tf.saldo_total) !== "undefined")
    {
        st = parseFloat(tf.saldo_total.value);
    }
    if (typeof (tf.N_PAGO) !== "undefined")
    {
        npa = parseFloat(tf.N_PAGO.value);
    }
    if (typeof (tf.N_PROM1) !== "undefined")
    {
        n1 = parseFloat(tf.N_PROM1.value);
    }
    if (typeof (tf.N_PROM2) !== "undefined")
    {
        n2 = parseFloat(tf.N_PROM2.value);
    }
    if (typeof (tf.N_PROM3) !== "undefined")
    {
        n3 = parseFloat(tf.N_PROM3.value);
    }
    if (typeof (tf.N_PROM4) !== "undefined")
    {
        n4 = parseFloat(tf.N_PROM4.value);
    }
    const np = n1 + n2 + n3 + n4;
    let cvt = '';
    if (typeof (tf.C_CVST) !== "undefined")
    {
        cvt = trim(tf.C_CVST.value);
    }
    if (typeof (tf.C_CONTAN) !== "undefined")
    {
        ccn = trim(tf.C_CONTAN.value);
    }
    if (typeof (tf.C_NTEL) !== "undefined")
    {
        cnt = trim(tf.C_NTEL.value);
    }
    if (typeof (tf.C_OBSE2) !== "undefined")
    {
        co2 = tf.C_OBSE2.value;
    }
    if (typeof (tf.CUANDO.value) !== "undefined")
    {
        cuando = tf.CUANDO.value;
    }
    if (typeof (tf.D_PROM1.value) !== "undefined")
    {
        dp1 = tf.D_PROM1.value;
    }
    if (typeof (tf.D_PROM2.value) !== "undefined")
    {
        dp2 = tf.D_PROM2.value;
    }
    if (typeof (tf.D_PAGO.value) !== "undefined")
    {
        dPago = tf.D_PAGO.value;
    }
    alert('Checando validad de gestion:\nCUENTA - ' + tf.CUENTA.value + '\nStatus - ' + cvt);

    try {
//Promise date-amount checks - promise 1
        if (cvt === '') {
            tf.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
            alertText = alertText + 'Tiene que elegir el estatus de la gestion.';
        }
        if ((n1 > 0)) {
//wrong status for promise
            let promStat = ["PROMESA DE PAGO PARCIAL", "PROMESA DE PAGO TOTAL", "CONFIRMA PROMESA"];
            if (promStat.indexOf(cvt) === -1)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'Este status no permite promesa';
            }

//amount but no date	
            if ((validate_date(tf.D_PROM1)) === false)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'No hay fecha de promesa 1.' + dp1;
            }
            if (dp1 === '0000-00-00')
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'No hay fecha de promesa 1.' + dp1;
            }
// promise in past
            if (dp1 < tf.D_FECH.value)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'Fecha de promesa es en pasada.';
            }
        }
    }
    catch (err) {
        let n1txt = "Error en nprom1";
        alert(n1txt);
        flag = 1;
    }
    try {
//Promise date-amount checks - promise 2
        if ((n2 > 0)) {
//amount but no date	
            if ((validate_date(tf.D_PROM2)) === false)
            {
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'No hay fecha de promesa 2.';
            }
            if (dp2 === '0000-00-00')
            {
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'No hay fecha de promesa 2.' + dp1;
            }
// promise in past
            if (dp2 < tf.D_FECH.value)
            {
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'Fecha de promesa es en pasada.';
            }
// 2 promises same date			
            if (dp2 === dp1)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'Hay dos pagos en mismo dia.';
            }
        }
// promise in wrong box
        if ((n1 === 0) && (n2 > 0))
        {
            tf.N_PROM1.style.backgroundColor = "yellow";
            tf.N_PROM2.style.backgroundColor = "yellow";
            flag = 1;
            alertText = alertText + 'Si hay solo un pago, va al primero campo.';
        }
        if ((dp1 > dp2) && (dp2 > tf.D_FECH.value))
        {
            tf.D_PROM1.style.backgroundColor = "yellow";
            tf.D_PROM2.style.backgroundColor = "yellow";
            flag = 1;
            alertText = alertText + 'Si hay solo un pago, va al primero campo.';
        }
    }
    catch (err) {
        let n2txt = "Error en nprom2";
        alert(n2txt);
        flag = 1;
    }
    try {
        const __ret = picky(tf, alertText, flag);
        alertText = __ret.alertText;
        flag = __ret.flag;
//Must have gestor
        if (validate_required(tf.C_CVGE) === false)
        {
            alertText = alertText + 'GESTOR es necesario\n';
            tf.C_CVGE.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have telephone
        if (validate_required(tf.C_TELE) === false)
        {
            alertText = alertText + 'TELEFONO es necesario\n';
            tf.C_TELE.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    catch (err) {
        let basictxt = "Error en basics";
        alert(basictxt + '\n' + alertText);
        flag = 1;
    }
//Inbounds need motivation and carga/parentesco
    if (tf.C_TELE.value === 'Entrante') {
        if (validate_required(tf.C_MOTIV) === false)
        {
            alertText = alertText + 'MOTIVACION es necesario\n';
            tf.C_MOTIV.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_required(tf.C_CNP) === false)
        {
            alertText = alertText + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
        if (validate_required(tf.C_CNP) === false)
        {
            alertText = alertText + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (n2 > 0) {
        if (validate_required(tf.C_CNP) === false)
        {
            alertText = alertText + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (cvt !== 'null') {
//CONFIRMA PROMESA requires PROMESA and cargo/parentesco
        if (cvt.substr(0, 8) === "CONFIRMA")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//MENSAJE CON FAMILIAR requires causa no pago and cargo/parentesco        
        if (cvt === "MENSAJE CON FAMILIAR")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CNP) === false)
            {
                alertText = alertText + 'CAUSA NO PAGO es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (tf.C_CARG.value === 'Deudor')
            {
                alertText = alertText + 'El deudor no es un familiar\n';
                tf.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
        const needsCargo = ["MENSAJE CON TERCERO", "MENSAJE CON EMPLEADO"];
//MENSAJE CON TERCERO requires cargo/parentesco
        if (needsCargo.includes(cvt))
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (tf.C_CARG.value === 'Deudor')
            {
                alertText = alertText + 'El deudor no es un tercero\n';
                tf.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//CLIENTE NEGOCIANDO requires cargo/parentesco
        if (cvt === "CLIENTE NEGOCIANDO")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minprom and less than or equal to saldo total      
        if (cvt === "PROMESA DE PAGO TOTAL")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if ((np < minprom) && (authorized < 1))
            {
                tf.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'Monto de promesa ' + np + ' está menor que monto minimo ' + minprom;
            }
        }
        if (np > (st * 1.25))
        {
            tf.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
            alertText = alertText + 'Monto de promesa ' + np + ' está más que saldo total ' + st;
        }
    }

//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom      
    if (cvt === "PROMESA DE PAGO PARCIAL")
    {
        if (validate_required(tf.C_CARG) === false)
        {
            alertText = alertText + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (n1 < 10)
        {
            alertText = alertText + "MONTO DE PROMESA es necesario" + '\n';
            tf.C_CVST.style.backgroundColor = "yellow";
            tf.N_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
    if (cvt.substr(0, 12) === "PROPUESTA DE")
    {
        if (n1 < 10)
        {
            alertText = alertText + "MONTO DE PROMESA es necesario" + '\n';
            tf.N_PROM1.style.backgroundColor = "yellow";
            tf.N_PROM2.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_required(tf.C_CARG) === false)
        {
            alertText = alertText + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO and REGULARIZADA and REESTRUCTURADA 
//require monto de pago y fecha hoy o en pasado 
    if (dPago > tf.D_FECH.value)
    {
        alertText = alertText + 'Fecha de pago en el porvenir\nPAGO=' + tf.D_PAGO.value + '\nHOY=' + tf.D_FECH.value + '\n';
        tf.D_PAGO.style.backgroundColor = "orange";
        flag = 1;
    }
    if ((cvt.substr(0, 3) === "PAG") || ((cvt.substr(0, 2) === "RE") && (authorized < 1)))
    {
        document.getElementById("pagocapt").style.display = "table-row";
        document.getElementById("pagocapt2").style.display = "table-row";
        if (validate_required(tf.N_PAGO) === false)
        {
            alertText = alertText + 'Monto de pago es necesario\n';
            tf.N_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (npa < 10)
        {
            alertText = alertText + 'Monto de pago es necesario\n';
            tf.N_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_date(tf.D_PAGO) === false)
        {
            alertText = alertText + 'Fecha de pago es necesario\n';
            tf.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (dPago === '0000-00-00')
        {
            alertText = alertText + 'Fecha de pago es necesario\n';
            tf.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (dPago > tf.D_FECH.value)
        {
            alertText = alertText + 'Fecha de pago en el porvenir\nPAGO=' + tf.D_PAGO.value + '\nHOY=' + tf.D_FECH.value + '\n';
            tf.D_PAGO.style.backgroundColor = "orange";
            flag = 1;
        }
    }
    if ((cvt === "PAGO TOTAL") && (npa < minprom) && (authorized < 1))
    {
        alertText = alertText + 'Monto de pago no es sufficiente para PAGO TOTAL\n';
        tf.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
//NO CONTACTO means NO CONTACTO!
    if (cvt.substr(0, 4) === "TEL ")
    {
        if (tf.C_CARG.value.length !== 0)
        {
            alertText = alertText + 'Cargo del contacto no es necesario cuando STATUS es ' + cvt;
            tf.C_CARG.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (cvt.substr(0, 11) === "MENSAJE EN ") {
        if (tf.C_CARG.value.length !== 0) {
            alertText = alertText + 'Cargo del contacto no es necesario cuando STATUS es ' + cvt;
            tf.C_CARG.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    let cargoMatchList = '';
    try {
// If you have contact, need best time
        let cuandoMatchListStr = "CONFIRMA PROMESA|" +
                'MENSAJE CON FAMILIAR|PAGANDO CONVENIO|MENSAJE CON TERCERO|CLIENTE NEGOCIANDO|' +
                'PROMESA DE PAGO TOTAL|' +
                'PROMESA DE PAGO PARCIAL|' +
                'PROPUESTA DE PAGO|' +
                'NEGATIVA DE PAGO|' +
                'MENSAJE CON EMPLEADO';
        cargoMatchList = new RegExp(cuandoMatchListStr);
        if (cvt.match(cargoMatchList)) {
            if (cuando.length === 0) {
                alertText = alertText + 'Contacto requiere LOCALIZABLE';
                tf.CUANDO.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
    } catch (err) {
        alert(cvt + ' ' + cargoMatchList);
        flag = 1;
    }

//monto de promesa can only have numbers and one decimal point.
    if (notJustNumbers(n1)) {
        alertText = alertText + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        tf.N_PROM1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if (notJustNumbers(n2)) {
        alertText = alertText + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        tf.N_PROM2.style.backgroundColor = "yellow";
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    if (notJustNumbers(npa)) {
        alertText = alertText + 'No puede usarse un separador de miles' + '\n';
        tf.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
    const __ret = telCheck(cnt, alertText, tf, flag, co2);
    alertText = __ret.alertText;
    flag = __ret.flag;
//date checks on promises
    if (n1 > 0) {
//date must be today or in future
        if (dp1 < tf.D_FECH.value)
        {
            alertText = alertText + 'Fecha de promesa en pasado' + '\nPROM=' + dp1 + '\nHOY=' + tf.D_FECH.value + '\n';
            tf.D_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (authorized < 1) {
            if (ccn === "PROMESA DE PAGO TOTAL")
            {
                alertText = alertText + "Solamente un supervisor puede sobreescribido una promesa activa.";
                flag = 1;
            }
        }
    }
    if (n2 > 0) {
//date must be today or in future
        if (dp2 < tf.D_FECH.value)
        {
            alertText = alertText + 'Fecha de promesa en pasado' + '\nPROM=' + dp2 + '\nHOY=' + tf.D_FECH.value + '\n';
            tf.D_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (authorized < 1) {
            if (dp2.substr(0, 7) !== tf.D_FECH.value.substr(0, 7))
            {
                alert("Promesas en el mes siguiente necesita autorización");
                flag = 1;
            }
        }
//date needs amount
        if (validate_required(tf.D_PROM2) === false)
        {
            alertText = alertText + "Fecha de promesa es necesario\n";
            tf.D_PROM2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//monto de pago needs fecha de pago
    if (npa > 0.0)
    {
        if (validate_date(tf.D_PAGO) === false)
        {
            alertText = alertText + 'Fecha de pago es necesario\n';
            tf.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//promises need schedule
    if (np > 0)
    {
        if (validate_required(tf.C_PROM) === false)
        {
            alertText = alertText + "Frecuencia de pago es necesario\n";
            tf.C_PROM.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    let alertString = 'Gestion de cuenta ' + tf.CUENTA.value + ' guardado con status ' + cvt + ".\n";
    if (n1 > 0) {
        alertString = alertString + " Fecha de promisa 1: " + dp1 + " ";
    }
    if (n1 > 0) {
        alertString = alertString + " Monto de promisa 1: $" + n1 + "\n";
    }
    if (n2 > 0) {
        alertString = alertString + " Fecha de promisa 2: " + dp2 + " ";
    }
    if (n2 > 0) {
        alertString = alertString + " Monto de promisa 2: $" + n2 + "\n";
    }
    if (npa > 0) {
        alertString = alertString + " Fecha de promisa total: " + dPago;
    }
    if (npa > 0) {
        alertString = alertString + " Monto de promisa total: $" + npa;
    }

    if (flag === 0) {
        alert(alertString);
        tf.error.value = 0;
        return true;
    }
    else {
//  stopEvent(evt); // DOM style
        alert('ERROR EA2 - ' + alertText + '\nGestion no se guardó.');
//  stopEvent(evt); // DOM style
        return false; // IE style
    }
}

