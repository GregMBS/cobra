function validate_form2(tf, evt, minprom) {
//initialize
    let alertText = ' ';
    let flag = 0;
    let np = 0;
    let npa = 0;
    let n1 = 0;
    let cvt = "";
    // let cnt = "";
    // let co2 = "";
    let dp1 = "0000-00-00";
    let dPago = "0000-00-00";
    /**
     * @var {object} tf
     * @property {string} N_PAGOv
     * @property {string} N_PROMv
     * @property {string} D_PAGOv
     * @property {string} D_PROMv
     * @property {string} C_VD
     * @property {string} C_VISIT
     */
    if (typeof (tf.N_PAGOv) !== "undefined") {
        npa = parseFloat(tf.N_PAGOv.value);
    }
    if (typeof (tf.N_PROMv) !== "undefined") {
        n1 = parseFloat(tf.N_PROMv.value);
    }
    if (typeof (tf.C_CVST) !== "undefined") {
        cvt = trim(tf.C_CVST.value);
    }
    // if (typeof (tf.C_NTEL) !== "undefined") {
    //     cnt = trim(tf.C_NTEL.value);
    // }
    // if (typeof (tf.C_OBSE2) !== "undefined") {
    //     co2 = tf.C_OBSE2.value;
    // }
    if (typeof (tf.D_PROMv.value) !== "undefined") {
        dp1 = tf.D_PROMv.value;
    }
    if (typeof (tf.D_PAGOv.value) !== "undefined") {
        dPago = tf.D_PAGOv.value;
    }
    alert('Checando validad de gestion:\nCUENTA - ' + tf.CUENTA.value + '\nStatus - ' + cvt);
    if ((validate_date(tf.C_VD)) === false) {
        tf.C_VD.style.backgroundColor = "yellow";
        flag = 1;
        alertText = alertText + 'No hay fecha de gestion.';
    }
//Promise date-amount checks - promise 1
    if ((n1 > 0)) {
//alert(n1+":"+dp1+"\n"+n2+":"+dp2);
//amount but no date	
        if ((validate_date(tf.D_PROMv)) === false) {
            tf.D_PROMv.style.backgroundColor = "yellow";
            flag = 1;
            alertText = alertText + 'No hay fecha de promesa 1.' + dp1;
        }
        if (dp1 === '0000-00-00') {
            tf.D_PROMv.style.backgroundColor = "yellow";
            flag = 1;
            alertText = alertText + 'No hay fecha de promesa 1.' + dp1;
        }
    }

    const __ret = picky(tf, alertText, flag);
    alertText = __ret.alertText;
    flag = __ret.flag;

    //Must have visitador
    if (validate_required(tf.C_VISIT) === false) {
        alertText = alertText + 'VISITADOR es necesario\n';
        tf.C_VISIT.style.backgroundColor = "yellow";
        flag = 1;
    }
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
        if (validate_required(tf.C_CNP) === false) {
            alertText = alertText + 'CAUSA NO PAGO es necesario\n';
            tf.C_CNP.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (cvt !== 'null') {
//CLIENTE NEGOCIANDO requires cargo/parentesco        
        if (cvt === "CLIENTE NEGOCIANDO") {
            if (validate_required(tf.C_CARG) === false) {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minprom      
        if (cvt === "PROMESA DE PAGO TOTAL") {
            if (validate_required(tf.C_CARG) === false) {
                alertText = alertText + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (np < minprom) {
                tf.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
                alertText = alertText + 'Monto de promesa ' + np + ' está menor que monto minimo ' + minprom;
            }
        }
//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom      
        if ((cvt === "PROMESA DE PAGO PARCIAL") ||(cvt === "PROMESA DE PAGO RECURRENTE")) {
            if (validate_required(tf.C_CARG) === false) {
                alertText = alertText + "Carga/Parentesco es necesario" + '\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (n1 < 10) {
                alertText = alertText + "MONTO DE PROMESA es necesario" + '\n';
                tf.C_CVST.style.backgroundColor = "yellow";
                tf.N_PROMv.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
        if (cvt.substr(0, 12) === "PROPUESTA DE") {
            if (n1 < 10) {
                alertText = alertText + "MONTO DE PROMESA es necesario" + '\n';
                tf.N_PROMv.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CARG) === false) {
                alertText = alertText + "Carga/Parentesco es necesario" + '\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO require monto de pago y fecha hoy o en pasado 
        if (cvt.substr(0, 3) === "PAG") {
            document.getElementById("pagocaptv").style.display = "table-row";
            if (validate_required(tf.N_PAGOv) === false) {
                alertText = alertText + 'Monto de pago es necesario\n';
                tf.N_PAGOv.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (npa < 10) {
                alertText = alertText + 'Monto de pago es necesario\n';
                tf.N_PAGOv.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_date(tf.D_PAGOv) === false) {
                alertText = alertText + 'Fecha de pago es necesario\n';
                tf.D_PAGOv.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (dPago === '0000-00-00') {
                alertText = alertText + 'Fecha de pago es necesario\n';
                tf.D_PAGOv.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (dPago > tf.C_VD.value) {
                alertText = alertText + 'Fecha de pago en el porvenir\nPAGO=' + tf.D_PAGOv.value + '\nHOY=' + tf.C_VD.value + '\n';
                tf.D_PAGOv.style.backgroundColor = "orange";
                flag = 1;
            }
        }
        if ((cvt === "PAGO TOTAL") && (npa < minprom)) {
            alertText = alertText + 'Monto de pago no es sufficiente para PAGO TOTAL\n';
            tf.N_PAGOv.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//monto de promesa can only have numbers and one decimal point.
    const testMontoPromesa = (n1.toString()).match(/[0-9.]/);
    if (!testMontoPromesa) {
        alertText = alertText + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        tf.N_PROMv.style.backgroundColor = "yellow";
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    const testMontoPago = (npa.toString()).match(/[0-9.]/);
    if (!testMontoPago) {
        alertText = alertText + 'No puede usarse un separador de miles' + '\n';
        tf.N_PAGOv.style.backgroundColor = "yellow";
        flag = 1;
    }
    // const __retTel = telCheck(cnt, alertText, tf, flag, co2);
    // alertText = __retTel.alertText;
    // flag = __retTel.flag;
//date checks on promises

//monto de pago needs fecha de pago
    if (npa > 0.0) {
        if (validate_date(tf.D_PAGOv) === false) {
            alertText = alertText + 'Fecha de pago es necesario\n';
            tf.D_PAGOv.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//promises need schedule
    if (np > 0) {
        if (validate_required(tf.C_PROM) === false) {
            alertText = alertText + "Frecuencia de pago es necesario\n";
            tf.C_PROM.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    let alertstr = 'Gestion de cuenta ' + tf.CUENTA.value + ' guardado con status ' + cvt + ".\n";
    if (n1 > 0) {
        alertstr = alertstr + " Fecha de promisa 1: " + dp1 + " ";
    }
    if (n1 > 0) {
        alertstr = alertstr + " Monto de promisa 1: $" + n1 + "\n";
    }
    if (npa > 0) {
        alertstr = alertstr + " Fecha de promisa total: " + dPago;
    }
    if (npa > 0) {
        alertstr = alertstr + " Monto de promisa total: $" + npa;
    }
    if (flag === 0) {
        alert(alertstr);
        tf.error.value = 0;
        return true;
    } else {
//  stopEvent(evt); // DOM style
        alert('ERROR EA2 - ' + alertText + '\nGestion no se guardó.');
        stopEvent(evt); // DOM style
        return false; // IE style
    }
}
