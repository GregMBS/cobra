function trim(str)
{
    if (!str || typeof str !== 'string')
    {
        return null;
    }

    return str.replace(/^[\s]+/, '').replace(/[\s]+$/, '').replace(/[\s]{2,}/, ' ');
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

function validate_form(tf, evt, minprom, authorized, at)
{

//initialize 
    var alertstr = ' ';
    var alerttxt = ' ';
    var flag = 0;
    var aflag = 0;
    var npa = 0;
    var n1 = 0;
    var n2 = 0;
    var n3 = 0;
    var n4 = 0;
    var np = 0;
    var npo = 0;
    var st = 1000000;
    np = parseFloat(tf.N_PROM1.value) + parseFloat(tf.N_PROM2.value);
    var cvt = "";
    var ccn = " ";
    var cnt = "";
    var co2 = "";
    var cargo = "";
    var cuando = "";
    var dp1 = "0000-00-00";
    var dp2 = "0000-00-00";
    var dp3 = "0000-00-00";
    var dp4 = "0000-00-00";
    var dpo = "0000-00-00";
    var dpago = "0000-00-00";
    var minprom2 = minprom * 0.95;

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
    np = n1 + n2 + n3 + n4;
    if (typeof (tf.N_PROM_OLD) !== "undefined")
    {
        npo = parseFloat(tf.N_PROM_OLD.value);
    }
    if (typeof (tf.C_CVST) !== "undefined")
    {
        cvt = trim(tf.C_CVST.value);
    } else {
        cvt = '';
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
    if (typeof (tf.C_CARG.value) !== "undefined")
    {
        cargo = tf.C_CARG.value;
    }
    if (typeof (tf.D_PROM1.value) !== "undefined")
    {
        dp1 = tf.D_PROM1.value;
    }
    if (typeof (tf.D_PROM2.value) !== "undefined")
    {
        dp2 = tf.D_PROM2.value;
    }
    if (typeof (tf.D_PROM3.value) !== "undefined")
    {
        dp3 = tf.D_PROM3.value;
    }
    if (typeof (tf.D_PROM4.value) !== "undefined")
    {
        dp4 = tf.D_PROM4.value;
    }
    if (typeof (tf.D_PROM1_OLD.value) !== "undefined")
    {
        dpo = tf.D_PROM1_OLD.value;
    }
    if (typeof (tf.D_PAGO.value) !== "undefined")
    {
        dpago = tf.D_PAGO.value;
    }
    alert('Checando validad de gestion:\nCUENTA - ' + tf.CUENTA.value + '\nStatus - ' + cvt);

    try {
//Promise date-amount checks - promise 1
        if (cvt === '') {
            tf.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
            alerttxt = alerttxt + 'Tiene que elegir el estatus de la gestion.';
        }
        if ((n1 > 0)) {
//wrong status for promise
            var promStat = ["PROMESA DE PAGO PARCIAL", "PROMESA DE PAGO TOTAL", "CONFIRMA PROMESA"];
            if (promStat.indexOf(cvt) === -1)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'Este status no permite promesa';
            }

//amount but no date	
            if ((validate_date(tf.D_PROM1)) === false)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'No hay fecha de promesa 1.' + dp1;
            }
            if (dp1 === '0000-00-00')
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'No hay fecha de promesa 1.' + dp1;
            }
// promise in past
            if (dp1 < tf.D_FECH.value)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'Fecha de promesa es en pasada.';
            }
        }
    }
    catch (err) {
        var n1txt = "Error en nprom1";
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
                alerttxt = alerttxt + 'No hay fecha de promesa 2.';
            }
            if (dp2 === '0000-00-00')
            {
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'No hay fecha de promesa 2.' + dp1;
            }
// promise in past
            if (dp2 < tf.D_FECH.value)
            {
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'Fecha de promesa es en pasada.';
            }
// 2 promises same date			
            if (dp2 === dp1)
            {
                tf.D_PROM1.style.backgroundColor = "yellow";
                tf.D_PROM2.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'Hay dos pagos en mismo dia.';
            }
        }
// promise in wrong box
        if ((n1 === 0) && (n2 > 0))
        {
            tf.N_PROM1.style.backgroundColor = "yellow";
            tf.N_PROM2.style.backgroundColor = "yellow";
            flag = 1;
            alerttxt = alerttxt + 'Si hay solo un pago, va al primero campo.';
        }
        if ((dp1 > dp2) && (dp2 > tf.D_FECH.value))
        {
            tf.D_PROM1.style.backgroundColor = "yellow";
            tf.D_PROM2.style.backgroundColor = "yellow";
            flag = 1;
            alerttxt = alerttxt + 'Si hay solo un pago, va al primero campo.';
        }
    }
    catch (err) {
        var n2txt = "Error en nprom2";
        alert(n2txt);
        flag = 1;
    }
    try {
//GESTIONES necesitan a lo menos 2 palabras
        if (tf.C_OBSE1.value.indexOf(" ") === -1)
        {
            alerttxt = alerttxt + 'GESTION no está completada' + '\n' + tf.C_OBSE1.value;
            tf.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
//Picky gringo language rules
        if (tf.C_OBSE1.value.indexOf(" K ") !== -1)
        {
            alerttxt = alerttxt + 'Usa QUE en lugar de K' + '\n';
            tf.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (tf.C_OBSE1.value.indexOf("CHING") !== -1)
        {
            alerttxt = alerttxt + 'Moderar su lenguaje' + '\n';
            tf.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (tf.C_OBSE1.value.indexOf(" CTA") !== -1)
        {
            alerttxt = alerttxt + '¿Significa CTA CUENTA o CONTESTA?' + '\n';
            tf.C_OBSE1.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have gestor
        if (validate_required(tf.C_CVGE) === false)
        {
            alerttxt = alerttxt + 'GESTOR es necesario\n';
            tf.C_CVGE.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have telephone
        if (validate_required(tf.C_TELE) === false)
        {
            alerttxt = alerttxt + 'TELEFONO es necesario\n';
            tf.C_TELE.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must Have status
        if (validate_required(tf.C_CVST) === false)
        {
            alerttxt = alerttxt + 'STATUS es necesario\n';
            tf.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
        }
//Must have accion
        if (validate_required(tf.ACCION) === false)
        {
            alerttxt = alerttxt + 'ACCION es necesario\n';
            tf.ACCION.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    catch (err) {
        var basictxt = "Error en basics";
        alert(basictxt);
        flag = 1;
    }
//Inbounds need motivation and carga/parentesco
    if (tf.C_TELE.value === 'Entrante') {
        if (validate_required(tf.C_MOTIV) === false)
        {
            alerttxt = alerttxt + 'MOTIVACION es necesario\n';
            tf.C_MOTIV.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_required(tf.C_CNP) === false)
        {
            alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
        if (validate_required(tf.C_CNP) === false)
        {
            alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (n2 > 0) {
        if (validate_required(tf.C_CNP) === false)
        {
            alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//Debtor must give causa no pago
    if (tf.C_CARG.value === 'Deudor') {
        if (validate_required(tf.C_CNP) === false)
        {
            alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//GESTION too long
    if (tf.C_OBSE1.length > 250) {
        alerttxt = alerttxt + 'GESTION demasiado largo\n';
        tf.C_OBSE1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if (cvt !== null) {
//CONFIRMA PROMESA requires PROMESA and cargo/parentesco
        if (cvt.substr(0, 8) === "CONFIRMA")
        {
            if (validate_required(tf.N_PROM_OLD) === false)
            {
                alerttxt = alerttxt + 'Promesa primera, confirma despues\n';
                tf.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//MENSAJE CON FAMILIAR requires causa no pago and cargo/parentesco        
        if (cvt === "MENSAJE CON FAMILIAR")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CNP) === false)
            {
                alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (tf.C_CARG.value === 'Deudor')
            {
                alerttxt = alerttxt + 'El deudor no es un familiar\n';
                tf.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//QUIERE Y NO PUEDE requires causa no pago and cargo/parentesco        
        if (cvt === "QUIERE Y NO PUEDE")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CNP) === false)
            {
                alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//MENSAJE CON TERCERO requires cargo/parentesco        
        if (cvt === "MENSAJE CON TERCERO")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (tf.C_CARG.value === 'Deudor')
            {
                alerttxt = alerttxt + 'El deudor no es un tercero\n';
                tf.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//MENSAJE CON EMPLEADO requires cargo/parentesco        
        if (cvt === "MENSAJE CON EMPLEADO")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (tf.C_CARG.value === 'Deudor')
            {
                alerttxt = alerttxt + 'El deudor no es un empleado\n';
                tf.C_CARG.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//CLIENTE NEGOCIANDO requires cargo/parentesco        
        if (cvt === "CLIENTE NEGOCIANDO")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
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
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if ((np < minprom) && (authorized < 1))
            {
                tf.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'Monto de promesa ' + np + ' está menor que monto minimo ' + minprom;
            }
        }
        if (np > (st * 1.25))
        {
            tf.C_CVST.style.backgroundColor = "yellow";
            flag = 1;
            alerttxt = alerttxt + 'Monto de promesa ' + np + ' está más que saldo total ' + st;
        }
    }

//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom      
    if (cvt === "PROMESA DE PAGO PARCIAL")
    {
        if (validate_required(tf.C_CARG) === false)
        {
            alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (n1 < 10)
        {
            alerttxt = alerttxt + "MONTO DE PROMESA es necesario" + '\n';
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
            alerttxt = alerttxt + "MONTO DE PROMESA es necesario" + '\n';
            tf.N_PROM1.style.backgroundColor = "yellow";
            tf.N_PROM2.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_required(tf.C_CARG) === false)
        {
            alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO and REGULARIZADA and REESTRUCTURADA 
//require monto de pago y fecha hoy o en pasado 
    if (dpago > tf.D_FECH.value)
    {
        alerttxt = alerttxt + 'Fecha de pago en el porvenir\nPAGO=' + tf.D_PAGO.value + '\nHOY=' + tf.D_FECH.value + '\n';
        tf.D_PAGO.style.backgroundColor = "orange";
        flag = 1;
    }
    if ((cvt.substr(0, 3) === "PAG") || ((cvt.substr(0, 2) === "RE") && (authorized < 1)))
    {
        document.getElementById("pagocapt").style.display = "table-row";
        document.getElementById("pagocapt2").style.display = "table-row";
        if (validate_required(tf.N_PAGO) === false)
        {
            alerttxt = alerttxt + 'Monto de pago es necesario\n';
            tf.N_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (npa < 10)
        {
            alerttxt = alerttxt + 'Monto de pago es necesario\n';
            tf.N_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (validate_date(tf.D_PAGO) === false)
        {
            alerttxt = alerttxt + 'Fecha de pago es necesario\n';
            tf.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (dpago === '0000-00-00')
        {
            alerttxt = alerttxt + 'Fecha de pago es necesario\n';
            tf.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (dpago > tf.D_FECH.value)
        {
            alerttxt = alerttxt + 'Fecha de pago en el porvenir\nPAGO=' + tf.D_PAGO.value + '\nHOY=' + tf.D_FECH.value + '\n';
            tf.D_PAGO.style.backgroundColor = "orange";
            flag = 1;
        }
    }
    if ((cvt === "PAGO TOTAL") && (npa < minprom) && (authorized < 1))
    {
        alerttxt = alerttxt + 'Monto de pago no es sufficiente para PAGO TOTAL\n';
        tf.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
//ACLARACIONS need cargo/parentesco
    if (cvt === "ACLARACION")
    {
        if (validate_required(tf.C_CARG) === false)
        {
            alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//NEGATIVAS DE PAGO need cargo/parentesco
    if (cvt === "NEGATIVA DE PAGO")
    {
        if (validate_required(tf.C_CARG) === false)
        {
            alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//NO CONTACTO means NO CONTACTO!	
    if (cvt.substr(0, 4) === "TEL ")
    {
        if (tf.C_CARG.value.length !== 0)
        {
            alerttxt = alerttxt + 'Cargo del contacto no es necesario cuando STATUS es ' + cvt;
            tf.C_CARG.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (cvt.substr(0, 11) === "MENSAJE EN ") {
        if (tf.C_CARG.value.length !== 0) {
            alerttxt = alerttxt + 'Cargo del contacto no es necesario cuando STATUS es ' + cvt;
            tf.C_CARG.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    try {
// If you have contact, need best time
        var cuandoMatchListStr = "CONFIRMA PROMESA|" +
                'MENSAJE CON FAMILIAR|PAGANDO CONVENIO|MENSAJE CON TERCERO|CLIENTE NEGOCIANDO|' +
                'PROMESA DE PAGO TOTAL|' +
                'PROMESA DE PAGO PARCIAL|' +
                'PROPUESTA DE PAGO|' +
                'NEGATIVA DE PAGO|' +
                'MENSAJE CON EMPLEADO';
        var cargoMatchList = new RegExp(cuandoMatchListStr);
        if (cvt.match(cargoMatchList)) {
            if (cuando.length === 0) {
                alerttxt = alerttxt + 'Contacto requiere LOCALIZABLE';
                tf.CUANDO.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
    } catch (err) {
        alert(cvt + ' ' + cargoMatchList);
        flag = 1;
    }

//monto de promesa can only have numbers and one decimal point.
    if ((n1.toString()).match(/[0-9\.]/)) {
        flag = flag + 0;
    } else
    {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        tf.N_PROM1.style.backgroundColor = "yellow";
        flag = 1;
    }
    if ((n2.toString()).match(/[0-9\.]/)) {
        flag = flag + 0;
    } else
    {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        tf.N_PROM2.style.backgroundColor = "yellow";
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    if ((npa.toString()).match(/[0-9\.]/)) {
        flag = flag + 0;
    } else
    {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n';
        tf.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
//new telephones can only have numbers
    if (cnt !== null) {
        if ((cnt.toString()).match(/[0-9]/)) {
            flag = flag + 0;
        } else
        {
            alerttxt = alerttxt + 'No puede usarse un separador o letras en telefonos' + '\n';
            tf.C_NTEL.style.backgroundColor = "yellow";
            flag = 1;
        }
        if ((cnt.length !== 0) && (cnt.length !== 8) && (cnt.length !== 10) && (cnt.length !== 13))
        {
            alerttxt = alerttxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            tf.C_NTEL.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (co2 !== null) {
        if ((co2.toString()).match(/[0-9]/)) {
            flag = flag + 0;
        }
// else
//  {alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
//  tf.C_OBSE2.style.backgroundColor="yellow";
//  flag=1;}
        if ((co2.length !== 0) && (co2.length !== 8) && (co2.length !== 10) && (co2.length !== 13))
        {
            alerttxt = alerttxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            tf.C_OBSE2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//date checks on promises
    if (n1 > 0) {
//date must be today or in future
        if (dp1 < tf.D_FECH.value)
        {
            alerttxt = alerttxt + 'Fecha de promesa en pasado' + '\nPROM=' + dp1 + '\nHOY=' + tf.D_FECH.value + '\n';
            tf.D_PROM1.style.backgroundColor = "yellow";
            flag = 1;
        }
        if (authorized < 1) {
            aflag = flag + 0;
            if (ccn === "PROMESA DE PAGO TOTAL")
            {
                alerttxt = alerttxt + "Solamente un supervisor puede sobreescribido una promesa activa.";
                flag = 1;
            }
        }
    }
    if (n2 > 0) {
//date must be today or in future
        if (dp2 < tf.D_FECH.value)
        {
            alerttxt = alerttxt + 'Fecha de promesa en pasado' + '\nPROM=' + dp2 + '\nHOY=' + tf.D_FECH.value + '\n';
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
            alerttxt = alerttxt + "Fecha de promesa es necesario\n";
            tf.D_PROM2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//monto de pago needs fecha de pago
    if (npa > 0.0)
    {
        if (validate_date(tf.D_PAGO) === false)
        {
            alerttxt = alerttxt + 'Fecha de pago es necesario\n';
            tf.D_PAGO.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//promises need schedule
    if (np > 0)
    {
        if (validate_required(tf.C_PROM) === false)
        {
            alerttxt = alerttxt + "Frecuencia de pago es necesario\n";
            tf.C_PROM.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    alertstr = 'Gestion de cuenta ' + tf.CUENTA.value + ' guardado con status ' + cvt + ".\n";
    if (n1 > 0) {
        alertstr = alertstr + " Fecha de promisa 1: " + dp1 + " ";
    }
    if (n1 > 0) {
        alertstr = alertstr + " Monto de promisa 1: $" + n1 + "\n";
    }
    if (n2 > 0) {
        alertstr = alertstr + " Fecha de promisa 2: " + dp2 + " ";
    }
    if (n2 > 0) {
        alertstr = alertstr + " Monto de promisa 2: $" + n2 + "\n";
    }
    if (npa > 0) {
        alertstr = alertstr + " Fecha de promisa total: " + dpago;
    }
    if (npa > 0) {
        alertstr = alertstr + " Monto de promisa total: $" + npa;
    }

    if (flag === 0) {
        alert(alertstr);
        tf.error.value = 0;
        return true;
    }
    else {
//  stopEvent(evt); // DOM style
        alert('ERROR EA2 - ' + alerttxt + '\nGestion no se guardó.');
//  stopEvent(evt); // DOM style
        return false; // IE style
    }
}
