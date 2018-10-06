function validate_form_visit(tf, evt, minProm) {
//initialize 
    const N_PROMv = $('#N_PROMv');
    const N_PAGOv = $('#N_PAGOv');
    const D_PROMv = $('#D_PROMv');
    const D_PAGOv = $('#D_PAGOv');
    const C_CVSTv = $('#C_CVSTv');
    const C_PROMv = $('#C_PROMv');
    const C_OBSE1v = $('#C_OBSE1v');
    const C_OBSE2v = $('#C_OBSE2v');
    const C_VISIT = $('#C_VISIT');
    const C_VD = $('#C_VD');
    const CUENTAv = $('#CUENTAv');
    const C_CNPv = $('#C_CNPv');
    const C_ACCIONv = $('#C_ACCIONv');
    const C_CARGv = $('#C_CARGv');
    const C_NTELv = $('#C_NTELv');
    const errorV = $('#errorV');
    let alerttxt = ' ';
    let flag = 0;
    let npa = 0;
    let n1 = 0;
    let np = parseFloat(N_PROMv);
    /**
     * 
     * @type {string}
     */
    let cvt = "";
    let cnt = "";
    let co2 = "";
    let dp1 = "0000-00-00";
    let dPago = "0000-00-00";
//actual sum de promesa
    if (typeof(N_PAGOv) !== "undefined") {
        npa = parseFloat(N_PAGOv.val());
    }
    if (typeof(N_PROMv) !== "undefined") {
        n1 = parseFloat(N_PROMv.val());
    }
    if (typeof(C_CVSTv) !== "undefined") {
        cvt = trim(C_CVSTv.val());
    }
    if (typeof(C_NTELv) !== "undefined") {
        cnt = trim(C_NTELv.val());
    }
    if (typeof(C_OBSE2v) !== "undefined") {
        co2 = C_OBSE2v.val();
    }
    if (typeof(D_PROMv.val()) !== "undefined") {
        dp1 = D_PROMv.val();
    }
    if (typeof(D_PAGOv.val()) !== "undefined") {
        dPago = D_PAGOv.val();
    }
    alert('Checando validad de gestion:\nCUENTA - ' + CUENTAv.val() + '\nStatus - ' + cvt);
    if (C_CVSTv.val() === '') {
        C_CVSTv.css('backgroundColor', 'yellow');
        flag = 1;
        alerttxt = alerttxt + 'No hay estatus de gestion.\n';
    }
    if (C_ACCIONv.val() === '') {
        C_ACCIONv.css('backgroundColor', 'yellow');
        flag = 1;
        alerttxt = alerttxt + 'No hay código de accion.\n';
    }
    if ((validate_date(C_VD)) === false) {
        C_VD.css('backgroundColor', 'yellow');
        flag = 1;
        alerttxt = alerttxt + 'No hay fecha de gestion.\n';
    }
//Promise date-amount checks - promise 1
    if ((n1 > 0)) {
//alert(n1+":"+dp1+"\n"+n2+":"+dp2);
//amount but no date	
        if ((validate_date(D_PROMv)) === false) {
            D_PROMv.css('backgroundColor', 'yellow');
            flag = 1;
            alerttxt = alerttxt + 'No hay fecha de promesa 1.' + dp1;
        }
        if (dp1 === '0000-00-00') {
            D_PROMv.css('backgroundColor', 'yellow');
            flag = 1;
            alerttxt = alerttxt + 'No hay fecha de promesa 1.' + dp1;
        }
    }

//GESTIONES necesitan a lo menos 2 palabras
    if (C_OBSE1v.val().indexOf(" ") === -1) {
        alerttxt = alerttxt + 'GESTION no está completada' + '\n' + C_OBSE1v.val();
        C_OBSE1v.css('backgroundColor', 'yellow');
        flag = 1;
    }
//Picky gringo language rules
    if (C_OBSE1v.val().indexOf(" K ") !== -1) {
        alerttxt = alerttxt + 'Usa QUE en lugar de K' + '\n';
        C_OBSE1v.css('backgroundColor', 'yellow');
        flag = 1;
    }
    if (C_OBSE1v.val().indexOf("CHING") !== -1) {
        alerttxt = alerttxt + 'Moderar su lenguaje' + '\n';
        C_OBSE1v.css('backgroundColor', 'yellow');
        flag = 1;
    }
    if (C_OBSE1v.val().indexOf(" CTA") !== -1) {
        alerttxt = alerttxt + '¿Significa CTA CUENTA o CONTESTA?' + '\n';
        C_OBSE1v.css('backgroundColor', 'yellow');
        flag = 1;
    }
//Must have visitador
    if (validate_required(C_VISIT) === false) {
        alerttxt = alerttxt + 'VISITADOR es necesario\n';
        C_VISIT.css('backgroundColor', 'yellow');
        flag = 1;
    }
//Must Have status
    if (validate_required(C_CVSTv) === false) {
        alerttxt = alerttxt + 'STATUS es necesario\n';
        C_CVSTv.css('backgroundColor', 'yellow');
        flag = 1;
    }
//Must have accion
    if (validate_required(C_ACCIONv) === false) {
        alerttxt = alerttxt + 'ACCION es necesario\n';
        C_ACCIONv.css('backgroundColor', 'yellow');
        flag = 1;
    }
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
        if (validate_required(C_CNPv) === false) {
            alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
            C_CNPv.css('backgroundColor', 'yellow');
            flag = 1;
        }
    }
//Debtor must give causa no pago
    if (C_CARGv.val() === 'Deudor') {
        if (validate_required(C_CNPv) === false) {
            alerttxt = alerttxt + 'CAUSA NO PAGO es necesario\n';
            C_CNPv.css('backgroundColor', 'yellow');
            flag = 1;
        }
    }
//GESTION too long
    if (C_OBSE1v.val().length > 250) {
        alerttxt = alerttxt + 'GESTION demasiado largo\n';
        C_OBSE1v.css('backgroundColor', 'yellow');
        flag = 1;
    }
    if (cvt) {
//CLIENTE NEGOCIANDO requires cargo/parentesco        
        if (cvt === "CLIENTE NEGOCIANDO") {
            if (validate_required(C_CARGv) === false) {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                C_CNPv.css('backgroundColor', 'yellow');
                flag = 1;
            }
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minProm      
        if (cvt === "PROMESA DE PAGO TOTAL") {
            if (validate_required(C_CARGv) === false) {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                C_CNPv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (np < minProm) {
                C_CVSTv.css('backgroundColor', 'yellow');
                flag = 1;
                alerttxt = alerttxt + 'Monto de promesa ' + np + ' está menor que monto m&iacute;nimo ' + minProm;
            }
        }
//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minProm      
        if (cvt === "PROMESA DE PAGO PARCIAL") {
            if (validate_required(C_CARGv) === false) {
                alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
                C_CNPv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (n1 < 10) {
                alerttxt = alerttxt + "MONTO DE PROMESA es necesario" + '\n';
                C_CVSTv.css('backgroundColor', 'yellow');
                N_PROMv.css('backgroundColor', "yellow");
                flag = 1;
            }
        }
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
        if (cvt.substr(0, 12) === "PROPUESTA DE") {
            if (n1 < 10) {
                alerttxt = alerttxt + "MONTO DE PROMESA es necesario" + '\n';
                N_PROMv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (validate_required(C_CARGv) === false) {
                alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
                C_CNPv.css('backgroundColor', 'yellow');
                flag = 1;
            }
        }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO require monto de pago y fecha hoy o en pasado 
        if (cvt.substr(0, 3) === "PAG") {
            document.getElementById("pagocaptv").style.display = "table-row";
            if (validate_required(N_PAGOv) === false) {
                alerttxt = alerttxt + 'Monto de pago es necesario\n';
                N_PAGOv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (npa < 10) {
                alerttxt = alerttxt + 'Monto de pago es necesario\n';
                N_PAGOv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (validate_date(D_PAGOv) === false) {
                alerttxt = alerttxt + 'Fecha de pago es necesario\n';
                D_PAGOv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (dPago === '0000-00-00') {
                alerttxt = alerttxt + 'Fecha de pago es necesario\n';
                D_PAGOv.css('backgroundColor', 'yellow');
                flag = 1;
            }
            if (dPago > C_VD.val()) {
                alerttxt = alerttxt + 'Fecha de pago en el porvenir\nPAGO=' + D_PAGOv.val() + '\nHOY=' + C_VD.val() + '\n';
                D_PAGOv.css('backgroundColor', 'orange');
                flag = 1;
            }
        }
        if ((cvt === "PAGO TOTAL") && (npa < minProm)) {
            alerttxt = alerttxt + 'Monto de pago no es suficiente para PAGO TOTAL\n';
            N_PAGOv.css('backgroundColor', 'yellow');
            flag = 1;
        }
        //ACLARACIONES need cargo/parentesco
        if (cvt === "ACLARACION") {
            if (validate_required(C_CARGv) === false) {
                alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
                C_CNPv.css('backgroundColor', 'yellow');
                flag = 1;
            }
        }
//NEGATIVAS DE PAGO need cargo/parentesco
        if (cvt === "NEGATIVA DE PAGO") {
            if (validate_required(C_CARGv) === false) {
                alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
                C_CNPv.css('backgroundColor', 'yellow');
                flag = 1;
            }
        }
    }
//monto de promesa can only have numbers and one decimal point.
    if ((n1.toString()).match(/[0-9.]/)) {
        //flag=flag;
    } else {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        N_PROMv.css('backgroundColor', 'yellow');
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    if ((npa.toString()).match(/[0-9.]/)) {
        //flag=flag;
    } else {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n';
        N_PAGOv.css('backgroundColor', 'yellow');
        flag = 1;
    }
//new telephones can only have numbers
    if (cnt) {
        if ((cnt.toString()).match(/[0-9]/)) {
            //flag=flag;
        } else {
            alerttxt = alerttxt + 'No puede usarse un separador o letras en telefonos' + '\n';
            C_NTELv.css('backgroundColor', 'yellow');
            flag = 1;
        }
        if ((cnt.length !== 0) && (cnt.length !== 8) && (cnt.length !== 10) && (cnt.length !== 13)) {
            alerttxt = alerttxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            C_NTELv.css('backgroundColor', 'yellow');
            flag = 1;
        }
    }
    if (co2) {
        if ((co2.toString()).match(/[0-9]/)) {
            //flag=flag;
        }
// else
//	{alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
//	tf.C_OBSE2.style.backgroundColor="yellow";
//	flag=1;}
        if ((co2.length !== 0) && (co2.length !== 8) && (co2.length !== 10) && (co2.length !== 13)) {
            alerttxt = alerttxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            C_OBSE2v.css('backgroundColor', 'yellow');
            flag = 1;
        }
    }
//date checks on promises

//monto de pago needs fecha de pago
    if (npa > 0.0) {
        if (validate_date(D_PAGOv) === false) {
            alerttxt = alerttxt + 'Fecha de pago es necesario\n';
            D_PAGOv.css('backgroundColor', 'yellow');
            flag = 1;
        }
    }
//promises need schedule
    if (np > 0) {
        if (validate_required(C_PROMv) === false) {
            alerttxt = alerttxt + "Frecuencia de pago es necesario\n";
            C_PROMv.css('backgroundColor', 'yellow');
            flag = 1;
        }
    }
    let alertstr = 'Gestion de cuenta ' + CUENTAv.val() + ' guardado con status ' + cvt + ".\n";
    if (n1 > 0) {
        alertstr = alertstr + " Fecha de promesa 1: " + dp1 + " ";
    }
    if (n1 > 0) {
        alertstr = alertstr + " Monto de promesa 1: $" + n1 + "\n";
    }
    if (npa > 0) {
        alertstr = alertstr + " Fecha de promesa total: " + dPago;
    }
    if (npa > 0) {
        alertstr = alertstr + " Monto de promesa total: $" + npa;
    }
    if (flag === 0) {
        alert(alertstr);
        errorV.val(0);
        return true;
    }
    else {
//  stopEvent(evt); // DOM style
        alert('ERROR EA2 - ' + alerttxt + '\nGestion no se guardó.');
        stopEvent(evt); // DOM style
        return false; // IE style
    }
}
