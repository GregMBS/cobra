const captura = document.getElementById('capturaForm');
const capturaForm = document.forms['capturaForm'];
captura.onsubmit = function (evt) {
    //initialize
    const np = parseFloat(capturaForm['N_PROMv'].value);
    const minProm = parseFloat(capturaForm['minprom'].value);
    let alertTxt = ' ', flag = 0, npa = 0, n1 = 0, cvt = "", cnt = "", co2 = "";
    let dp1 = "0000-00-00";
    let dPago = "0000-00-00";
        
    /*
    if (typeof (capturaForm['N_PAGOv']) !== "undefined") {
        npa = parseFloat(capturaForm['N_PAGOv'].value);
    }
    */
    if (typeof (capturaForm['N_PROMv']) !== "undefined") {
        n1 = parseFloat(capturaForm['N_PROMv'].value);
    }
    if (typeof (capturaForm['C_CVST']) !== "undefined") {
        cvt = trim(capturaForm['C_CVST'].value);
    }
    if (typeof (capturaForm['C_NTEL']) !== "undefined") {
        cnt = trim(capturaForm['C_NTEL'].value);
    }
    if (typeof (capturaForm['C_OBSE2']) !== "undefined") {
        co2 = capturaForm['C_OBSE2'].value;
    }
    if (typeof (capturaForm['D_PROMv'].value) !== "undefined") {
        dp1 = capturaForm['D_PROMv'].value;
    }
    if (typeof (capturaForm['D_PAGOv'].value) !== "undefined") {
        dPago = capturaForm['D_PAGOv'].value;
    }
    alert('Checando validad de gestion:\nCUENTA - ' + capturaForm['CUENTA'].value + '\nStatus - ' + cvt);
    if ((validate_date(capturaForm['C_VD'])) === false) {
        capturaForm['C_VD'].style.backgroundColor = "yellow";
        flag = 1;
        alertTxt = alertTxt + 'No hay fecha de gestion.';
    }
//Promise date-amount checks - promise 1
    if ((n1 > 0)) {
//alert(n1+":"+dp1+"\n"+n2+":"+dp2);
//amount but no date	
        if ((validate_date(capturaForm['D_PROMv'])) === false) {
            capturaForm['D_PROMv'].style.backgroundColor = "yellow";
            flag = 1;
            alertTxt = alertTxt + 'No hay fecha de promesa 1.' + dp1;
        }
        if (dp1 === '0000-00-00') {
            capturaForm['D_PROMv'].style.backgroundColor = "yellow";
            flag = 1;
            alertTxt = alertTxt + 'No hay fecha de promesa 1.' + dp1;
        }
    }

//GESTIONES necesitan a lo menos 2 palabras
    if (capturaForm['C_OBSE1'].value.indexOf(" ") === -1) {
        alertTxt = alertTxt + 'GESTION no está completada' + '\n' + capturaForm['C_OBSE1'].value;
        capturaForm['C_OBSE1'].style.backgroundColor = "yellow";
        flag = 1;
    }
//Picky gringo language rules
    if (capturaForm['C_OBSE1'].value.indexOf(" K ") !== -1) {
        alertTxt = alertTxt + 'Usa QUE en lugar de K' + '\n';
        capturaForm['C_OBSE1'].style.backgroundColor = "yellow";
        flag = 1;
    }
    if (capturaForm['C_OBSE1'].value.indexOf("CHING") !== -1) {
        alertTxt = alertTxt + 'Moderar su lenguaje' + '\n';
        capturaForm['C_OBSE1'].style.backgroundColor = "yellow";
        flag = 1;
    }
    if (capturaForm['C_OBSE1'].value.indexOf(" CTA") !== -1) {
        alertTxt = alertTxt + '¿Significa CTA CUENTA o CONTESTA?' + '\n';
        capturaForm['C_OBSE1'].style.backgroundColor = "yellow";
        flag = 1;
    }
//Must have visitador
    if (validate_required(capturaForm['C_VISIT']) === false) {
        alertTxt = alertTxt + 'VISITADOR es necesario\n';
        capturaForm['C_VISIT'].style.backgroundColor = "yellow";
        flag = 1;
    }
//Must Have status
    if (validate_required(capturaForm['C_CVST']) === false) {
        alertTxt = alertTxt + 'STATUS es necesario\n';
        capturaForm['C_CVST'].style.backgroundColor = "yellow";
        flag = 1;
    }
//Must have accion
    if (validate_required(capturaForm['ACCION']) === false) {
        alertTxt = alertTxt + 'ACCION es necesario\n';
        capturaForm['ACCION'].style.backgroundColor = "yellow";
        flag = 1;
    }
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
        if (validate_required(capturaForm['C_CNP']) === false) {
            alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
            capturaForm['C_CNP'].style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//Debtor must give causa no pago
    if (capturaForm['C_CARG'].value === 'Deudor') {
        if (validate_required(capturaForm['C_CNP']) === false) {
            alertTxt = alertTxt + 'CAUSA NO PAGO es necesario\n';
            capturaForm['C_CNP'].style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//GESTION too long
    if (capturaForm['C_OBSE1'].length > 250) {
        alertTxt = alertTxt + 'GESTION demasiado largo\n';
        capturaForm['C_OBSE1'].style.backgroundColor = "yellow";
        flag = 1;
    }
    if (cvt !== '') {
//CLIENTE NEGOCIANDO requires cargo/parentesco        
        if (cvt === "CLIENTE NEGOCIANDO") {
            if (validate_required(capturaForm['C_CARG']) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                capturaForm['C_CNP'].style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minprom
        if (cvt === "PROMESA DE PAGO TOTAL") {
            if (validate_required(capturaForm['C_CARG']) === false) {
                alertTxt = alertTxt + 'Carga/Parentesco es necesario\n';
                capturaForm['C_CNP'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (np < minProm) {
                capturaForm['C_CVST'].style.backgroundColor = "yellow";
                flag = 1;
                alertTxt = alertTxt + 'Monto de promesa ' + np + ' está menor que monto mínimo ' + minProm;
            }
        }
//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom
        if (cvt === "PROMESA DE PAGO PARCIAL") {
            if (validate_required(capturaForm['C_CARG']) === false) {
                alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
                capturaForm['C_CNP'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (n1 < 10) {
                alertTxt = alertTxt + "MONTO DE PROMESA es necesario" + '\n';
                capturaForm['C_CVST'].style.backgroundColor = "yellow";
                capturaForm['N_PROMv'].style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
        if (cvt.substr(0, 12) === "PROPUESTA DE") {
            if (n1 < 10) {
                alertTxt = alertTxt + "MONTO DE PROMESA es necesario" + '\n';
                capturaForm['N_PROMv'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(capturaForm['C_CARG']) === false) {
                alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
                capturaForm['C_CNP'].style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO require monto de pago y fecha hoy o en pasado 
        if (cvt.substr(0, 3) === "PAG") {
            document.getElementById("pagocaptv").style.display = "table-row";
            if (validate_required(capturaForm['N_PAGOv']) === false) {
                alertTxt = alertTxt + 'Monto de pago es necesario\n';
                capturaForm['N_PAGOv'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (npa < 10) {
                alertTxt = alertTxt + 'Monto de pago es necesario\n';
                capturaForm['N_PAGOv'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_date(capturaForm['D_PAGOv']) === false) {
                alertTxt = alertTxt + 'Fecha de pago es necesario\n';
                capturaForm['D_PAGOv'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (dPago === '0000-00-00') {
                alertTxt = alertTxt + 'Fecha de pago es necesario\n';
                capturaForm['D_PAGOv'].style.backgroundColor = "yellow";
                flag = 1;
            }
            if (dPago > capturaForm['C_VD'].value) {
                alertTxt = alertTxt + 'Fecha de pago en el porvenir\nPAGO=' + capturaForm['D_PAGOv'].value + '\nHOY=' + capturaForm['C_VD'].value + '\n';
                capturaForm['D_PAGOv'].style.backgroundColor = "orange";
                flag = 1;
            }
        }
        if ((cvt === "PAGO TOTAL") && (npa < minProm)) {
            alertTxt = alertTxt + 'Monto de pago no es suficiente para PAGO TOTAL\n';
            capturaForm['N_PAGOv'].style.backgroundColor = "yellow";
            flag = 1;
        }
        //ACLARACIONES need cargo/parentesco
        if (cvt === "ACLARACION") {
            if (validate_required(capturaForm['C_CARG']) === false) {
                alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
                capturaForm['C_CNP'].style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//NEGATIVAS DE PAGO need cargo/parentesco
        if (cvt === "NEGATIVA DE PAGO") {
            if (validate_required(capturaForm['C_CARG']) === false) {
                alertTxt = alertTxt + "Carga/Parentesco es necesario" + '\n';
                capturaForm['C_CNP'].style.backgroundColor = "yellow";
                flag = 1;
            }
        }
    }
//monto de promesa can only have numbers and one decimal point.
    if (!((n1.toString()).match(/[0-9.]/))) {
        alertTxt = alertTxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        capturaForm['N_PROMv'].style.backgroundColor = "yellow";
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    if (!((npa.toString()).match(/[0-9.]/))) {
        alertTxt = alertTxt + 'No puede usarse un separador de miles' + '\n';
        capturaForm['N_PAGOv'].style.backgroundColor = "yellow";
        flag = 1;
    }
//new telephones can only have numbers
    if (cnt !== '') {
        if (!((cnt.toString()).match(/[0-9]/))) {
            alertTxt = alertTxt + 'No puede usarse un separador o letras en telefonos' + '\n';
            capturaForm['C_NTEL'].style.backgroundColor = "yellow";
            flag = 1;
        }
        if ((cnt.length !== 0) && (cnt.length !== 8) && (cnt.length !== 10) && (cnt.length !== 13)) {
            alertTxt = alertTxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            capturaForm['C_NTEL'].style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    if (co2 !== '') {
//if ((co2.toString()).match(/[0-9]/))  {flag=flag;}
// else
//	{alertTxt=alertTxt+'No puede usarse un separador o letras en telefonos'+'\n';
//	capturaForm['C_OBSE2'].style.backgroundColor="yellow";
//	flag=1;}
        if ((co2.length !== 0) && (co2.length !== 8) && (co2.length !== 10) && (co2.length !== 13)) {
            alertTxt = alertTxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            capturaForm['C_OBSE2'].style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//date checks on promises

//monto de pago needs fecha de pago
    if (npa > 0.0) {
        if (validate_date(capturaForm['D_PAGOv']) === false) {
            alertTxt = alertTxt + 'Fecha de pago es necesario\n';
            capturaForm['D_PAGOv'].style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//promises need schedule
    if (np > 0) {
        if (validate_required(capturaForm['C_PROM']) === false) {
            alertTxt = alertTxt + "Frecuencia de pago es necesario\n";
            capturaForm['C_PROM'].style.backgroundColor = "yellow";
            flag = 1;
        }
    }
    let alertStr = 'Gestion de cuenta ' + capturaForm['CUENTA'].value + ' guardado con status ' + cvt + ".\n";
    if (n1 > 0) {
        alertStr = alertStr + " Fecha de promesa 1: " + dp1 + " ";
    }
    if (n1 > 0) {
        alertStr = alertStr + " Monto de promesa 1: $" + n1 + "\n";
    }
    if (npa > 0) {
        alertStr = alertStr + " Fecha de promesa total: " + dPago;
    }
    if (npa > 0) {
        alertStr = alertStr + " Monto de promesa total: $" + npa;
    }
    if (flag === 0) {
        alert(alertStr);
        capturaForm['error'].value = 0;
        return true;
    } else {
//  stopEvent(evt); // DOM style
        alert('ERROR EA2 - ' + alertTxt + '\nGestion no se guardó.');
        stopEvent(evt); // DOM style
        return false; // IE style
    }
}
