function validate_form2(tf, evt, minprom, authorized, at)
{
//initialize 
    var alertstr = ' ';
    var alerttxt = ' ';
    var flag = 0;
    var aflag = 0;
    var npa = 0;
    var n1 = 0;
    var n2 = 0;
    var np = 0;
    var npo = 0;
    np = parseFloat(tf.N_PROM.value);
    var cvt = "";
    var ccn = " ";
    var cnt = "";
    var co2 = "";
    var dp1 = "0000-00-00";
    var dp2 = "0000-00-00";
    var dpo = "0000-00-00";
    var dpago = "0000-00-00";
    var minprom2 = minprom * 0.95;
//actual sum de promesa
    if (typeof (tf.N_PAGO) !== "undefined")
    {
        npa = parseFloat(tf.N_PAGO.value);
    }
    if (typeof (tf.N_PROM) !== "undefined")
    {
        n1 = parseFloat(tf.N_PROM.value);
    }
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
    if (typeof (tf.D_PROM.value) !== "undefined")
    {
        dp1 = tf.D_PROM.value;
    }
    if (typeof (tf.D_PAGO.value) !== "undefined")
    {
        dpago = tf.D_PAGO.value;
    }
    alert('Checando validad de gestion:\nCUENTA - ' + tf.CUENTA.value + '\nStatus - ' + cvt);
    if ((validate_date(tf.C_VD)) === false)
    {
        tf.C_VD.style.backgroundColor = "yellow";
        flag = 1;
        alerttxt = alerttxt + 'No hay fecha de gestion.';
    }
//Promise date-amount checks - promise 1
    if ((n1 > 0)) {
//alert(n1+":"+dp1+"\n"+n2+":"+dp2);
//amount but no date	
        if ((validate_date(tf.D_PROM)) === false)
        {
            tf.D_PROM.style.backgroundColor = "yellow";
            flag = 1;
            alerttxt = alerttxt + 'No hay fecha de promesa 1.' + dp1;
        }
        if (dp1 === '0000-00-00')
        {
            tf.D_PROM.style.backgroundColor = "yellow";
            flag = 1;
            alerttxt = alerttxt + 'No hay fecha de promesa 1.' + dp1;
        }
    }

//GESTIONES necesitan a lo menos 2 palbras
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
//Must have visitador
    if (validate_required(tf.C_VISIT) === false)
    {
        alerttxt = alerttxt + 'VISITADOR es necesario\n';
        tf.C_VISIT.style.backgroundColor = "yellow";
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
//Amount of promise requires cargo/parentesco
    if (n1 > 0) {
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
// greater than or equal to minprom      
        if (cvt === "PROMESA DE PAGO TOTAL")
        {
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + 'Carga/Parentesco es necesario\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (np < minprom)
            {
                tf.C_CVST.style.backgroundColor = "yellow";
                flag = 1;
                alerttxt = alerttxt + 'Monto de promesa ' + np + ' está menor que monto minimo ' + minprom;
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
                tf.N_PROM.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
        if (cvt.substr(0, 12) === "PROPUESTA DE")
        {
            if (n1 < 10)
            {
                alerttxt = alerttxt + "MONTO DE PROMESA es necesario" + '\n';
                tf.N_PROM.style.backgroundColor = "yellow";
                flag = 1;
            }
            if (validate_required(tf.C_CARG) === false)
            {
                alerttxt = alerttxt + "Carga/Parentesco es necesario" + '\n';
                tf.C_CNP.style.backgroundColor = "yellow";
                flag = 1;
            }
        }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO require monto de pago y fecha hoy o en pasado 
        if (cvt.substr(0, 3) === "PAG")
        {
            document.getElementById("pagocaptv").style.display = "table-row";
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
            if (dpago > tf.C_VD.value)
            {
                alerttxt = alerttxt + 'Fecha de pago en el porvenir\nPAGO=' + tf.D_PAGO.value + '\nHOY=' + tf.C_VD.value + '\n';
                tf.D_PAGO.style.backgroundColor = "orange";
                flag = 1;
            }
        }
        if ((cvt === "PAGO TOTAL") && (npa < minprom))
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
    }
//monto de promesa can only have numbers and one decimal point.
    if ((n1.toString()).match(/[0-9\.]/)) {
        flag = flag;
    } else
    {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n' + 'No puede dejar campo blanco. Usa 0.' + '\n';
        tf.N_PROM.style.backgroundColor = "yellow";
        flag = 1;
    }
//monto de pago can only have numbers and one decimal point.
    if ((npa.toString()).match(/[0-9\.]/)) {
        flag = flag;
    } else
    {
        alerttxt = alerttxt + 'No puede usarse un separador de miles' + '\n';
        tf.N_PAGO.style.backgroundColor = "yellow";
        flag = 1;
    }
//new telephones can only have numbers
    if (cnt !== null) {
        if ((cnt.toString()).match(/[0-9]/)) {
            flag = flag;
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
            flag = flag;
        }
// else
//	{alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
//	tf.C_OBSE2.style.backgroundColor="yellow";
//	flag=1;}
        if ((co2.length !== 0) && (co2.length !== 8) && (co2.length !== 10) && (co2.length !== 13))
        {
            alerttxt = alerttxt + 'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
            tf.C_OBSE2.style.backgroundColor = "yellow";
            flag = 1;
        }
    }
//date checks on promises

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
    } else {
//  stopEvent(evt); // DOM style
        alert('ERROR EA2 - ' + alerttxt + '\nGestion no se guardó.');
        stopEvent(evt); // DOM style
        return false; // IE style
    }
}
