<SCRIPT TYPE="text/JavaScript">
function validate_form2(tf,evt)
{
//initialize 
var flag=0;
var npa=0;
var n1=0;
var n2=0;
var np=0;
var npo=0;
np=parseFloat(tf.N_PROM1.value)+parseFloat(tf.N_PROM2.value)+0;
var cvt="";
var ccn=" ";
var cnt="";
var co2="";
var dp1="0000-00-00";
var dp2="0000-00-00";
var dpo="0000-00-00";
var dpago="0000-00-00";
//actual sum de promesa
if(typeof(tf.N_PAGO) !== "undefined")
{npa=parseFloat(tf.N_PAGO.value);}
if(typeof(tf.N_PROM1) !== "undefined")
{n1=parseFloat(tf.N_PROM1.value);}
if(typeof(tf.N_PROM2) !== "undefined")
{n2=parseFloat(tf.N_PROM2.value);}
if(typeof(tf.N_PROM_OLD) !== "undefined")
{npo=parseFloat(tf.N_PROM_OLD.value);}
if(typeof(tf.C_CVST) !== "undefined")
{cvt=trim(tf.C_CVST.value);}
if(typeof(tf.C_CONTAN) !== "undefined")
{ccn=trim(tf.C_CONTAN.value);}
if(typeof(tf.C_NTEL) !== "undefined")
{cnt=trim(tf.C_NTEL.value);}
if(typeof(tf.C_OBSE2) !== "undefined")
{co2=tf.C_OBSE2.value;}
if(typeof(tf.D_PROM1.value) !== "undefined")
{dp1=tf.D_PROM1.value;}
if(typeof(tf.D_PROM2.value) !== "undefined")
{dp2=tf.D_PROM2.value;}
if(typeof(tf.D_PROM_OLD.value) !== "undefined")
{dpo=tf.D_PROM_OLD.value;}
if(typeof(tf.D_PAGO.value) !== "undefined")
{dpago=tf.D_PAGO.value;}
//Promise date-amount checks - promise 1
if ((n1>0)) {
//alert(n1+":"+dp1+"\n"+n2+":"+dp2);
//amount but no date	
	if ((validate_date(tf.D_PROM1))===false)
		{tf.D_PROM1.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de promesa 1.'+dp1;}
	if (dp1==='0000-00-00')
		{tf.D_PROM1.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de promesa 1.'+dp1;}
// promise in past
	if (dp1<tf.D_FECH.value)
		{tf.D_PROM1.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'Fecha de promesa es en pasada.';}
}
//Promise date-amount checks - promise 2
if ((n2>0)) {
//amount but no date	
	if ((validate_date(tf.D_PROM2))===false)
		{tf.D_PROM2.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de promesa 2.';}
	if (dp2==='0000-00-00')
		{tf.D_PROM2.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de promesa 2.'+dp1;}
// promise in past
        if (dp2<tf.D_FECH.value)
			{tf.D_PROM2.style.backgroundColor="yellow";
			flag=1;
			alerttxt=alerttxt+'Fecha de promesa es en pasada.';}
// 2 promises same date			
        if (dp2===dp1)
          {tf.D_PROM1.style.backgroundColor="yellow";
          tf.D_PROM2.style.backgroundColor="yellow";
          flag=1;
			alerttxt=alerttxt+'Hay dos pagos en mismo dia.';}
}
// promise in wrong box
if ((n1===0)&&(n2>0)) 
          {tf.N_PROM1.style.backgroundColor="yellow";
          tf.N_PROM2.style.backgroundColor="yellow";
          flag=1;
			alerttxt=alerttxt+'Si hay solo un pago, va al primero campo.';}
if ((dp1>dp2)&&(dp2>tf.D_FECH.value)) 
          {tf.D_PROM1.style.backgroundColor="yellow";
          tf.D_PROM2.style.backgroundColor="yellow";
          flag=1;
			alerttxt=alerttxt+'Si hay solo un pago, va al primero campo.';}
//GESTIONES necesitan a lo menos 2 palbras
if (tf.C_OBSE1.value.indexOf(" ")===-1)
	{alerttxt=alerttxt+'GESTION no está completada'+'\n'+tf.C_OBSE1.value;
	tf.C_OBSE1.style.backgroundColor="yellow";
	flag=1;}
//Picky gringo language rules
if (tf.C_OBSE1.value.indexOf(" K ")!==-1)
	{alerttxt=alerttxt+'Usa QUE en lugar de K'+'\n';
	tf.C_OBSE1.style.backgroundColor="yellow";flag=1;}
if (tf.C_OBSE1.value.indexOf("CHING")!==-1)
	{alerttxt=alerttxt+'Moderar su lenguaje'+'\n';
	tf.C_OBSE1.style.backgroundColor="yellow";flag=1;}
if (tf.C_OBSE1.value.indexOf(" CTA")!==-1)
	{alerttxt=alerttxt+'¿Significa CTA CUENTA o CONTESTA?'+'\n';
	tf.C_OBSE1.style.backgroundColor="yellow";flag=1;}
//Must have visitador
if (validate_required(tf.C_VISIT)===false)
  {alerttxt=alerttxt+'VISITADOR es necesario\n';
  tf.C_VISIT.style.backgroundColor="yellow";flag=1;}
//Must have date
if (validate_required(tf.C_VD)===false)
  {alerttxt=alerttxt+'FECHA DE GESTION es necesario\n';
  tf.C_VD.style.backgroundColor="yellow";flag=1;}
//Must Have status
if (validate_required(tf.C_CVST)===false)
  {alerttxt=alerttxt+'STATUS es necesario\n';
  tf.C_CVST.style.backgroundColor="yellow";
  flag=1;}
//Must have accion
if (validate_required(tf.ACCION)===false)
  {alerttxt=alerttxt+'ACCION es necesario\n';
  tf.ACCION.style.backgroundColor="yellow";flag=1;}
//Inbounds need motivation and carga/parentesco
if (tf.C_TELE.value==='Entrante') {
        if (validate_required(tf.C_MOTIV)===false)
          {alerttxt=alerttxt+'MOTIVACION es necesario\n';
          tf.C_MOTIV.style.backgroundColor="yellow";flag=1;}
        if (validate_required(tf.C_CNP)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
          }
//Amount of promise requires cargo/parentesco
if (n1>0) {
        if (validate_required(tf.C_CNP)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
          }
if (n2>0) {
        if (validate_required(tf.C_CNP)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
          }
//Debtor must give causa no pago
if (tf.C_CARG.value==='Deudor') {
        if (validate_required(tf.C_CNP)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
          }
//GESTION too long
if (tf.C_OBSE1.length>250) {alerttxt=alerttxt+'GESTION demasiado largo\n';
tf.C_OBSE1.style.backgroundColor="yellow";flag=1;}
if (cvt!==null) {
//CONFIRMA PROMESA requires PROMESA and cargo/parentesco
if (cvt.substr(0,8)==="CONFIRMA") 
   {if (validate_required(tf.N_PROM_OLD)===false)
        {alerttxt=alerttxt+'Promesa primera, confirma despues\n';
        tf.C_CVST.style.backgroundColor="yellow";flag=1;}
        if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
        }
//MENSAJE CON FAMILIAR requires causa no pago and cargo/parentesco        
if (cvt==="MENSAJE CON FAMILIAR") 
   {        
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
    if (validate_required(tf.C_CNP)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
    if (tf.C_CARG.value==='Deudor')
		{alerttxt=alerttxt+'El deudor no es un familiar\n';
		tf.C_CARG.style.backgroundColor="yellow";flag=1;}
        }
//MENSAJE CON TERCERO requires cargo/parentesco        
if (cvt==="MENSAJE CON TERCERO") 
   {
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
    if (tf.C_CARG.value==='Deudor')
		{alerttxt=alerttxt+'El deudor no es un tercero\n';
		tf.C_CARG.style.backgroundColor="yellow";flag=1;}
        }
//MENSAJE CON EMPLEADO requires cargo/parentesco        
if (cvt==="MENSAJE CON EMPLEADO") 
   {
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
    if (tf.C_CARG.value==='Deudor')
		{alerttxt=alerttxt+'El deudor no es un empleado\n';
		tf.C_CARG.style.backgroundColor="yellow";flag=1;}
        }
//CLIENTE NEGOCIANDO requires cargo/parentesco        
if (cvt==="CLIENTE NEGOCIANDO") 
   {
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minprom      
if (cvt==="PROMESA DE PAGO TOTAL") 
   {
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
//	if (np < <?php echo $saldo_descuento_2+0; ?>)
//		{tf.C_CVST.style.backgroundColor="yellow";flag=1;
//		alerttxt=alerttxt+'Monto de promesa '+np+' está menor que monto minimo <?php echo $saldo_descuento_2+0; ?>';}
        }
	if (n1 < 10)
		{
		tf.C_CVST.style.backgroundColor="yellow";
		tf.N_PROM1.style.backgroundColor="yellow";
		tf.N_PROM2.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'Monto de promesa es necesario\n';}
        }
//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom      
if (cvt==="PROMESA DE PAGO PARCIAL")
    {	
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNP.style.backgroundColor="yellow";
          flag=1;}
	if (n1<10)
			{alerttxt=alerttxt+"MONTO DE PROMESA es necesario"+'\n';
			tf.C_CVST.style.backgroundColor="yellow";
			tf.N_PROM1.style.backgroundColor="yellow";
			tf.N_PROM2.style.backgroundColor="yellow";
			flag=1;}
	}
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
if (cvt.substr(0,12)==="PROPUESTA DE") 
   {
	if (n1<10)
			{alerttxt=alerttxt+"MONTO DE PROMESA es necesario"+'\n';
			tf.C_CVST.style.backgroundColor="yellow";
			tf.N_PROM1.style.backgroundColor="yellow";
			tf.N_PROM2.style.backgroundColor="yellow";
			flag=1;}
	}
	if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNP.style.backgroundColor="yellow";flag=1;}
        }
//PAGO TOTAL and PAGO PARCIAL require monto de pago y fecha hoy o en pasado 
if (cvt.substr(0,3)==="PAG") 
   {
	if (validate_required(tf.N_PAGO)===false)
        {alerttxt=alerttxt+'Monto de pago es necesario\n';
        tf.N_PAGO.style.backgroundColor="yellow";flag=1;}
	if (npa===0)
        {alerttxt=alerttxt+'Monto de pago es necesario\n';
        tf.N_PAGO.style.backgroundColor="yellow";flag=1;}
    if (validate_date(tf.D_PAGO)===false)
        {alerttxt=alerttxt+'Fecha de pago es necesario\n';
        tf.D_PAGO.style.backgroundColor="yellow";flag=1;}
    if (dpago==='0000-00-00')
        {alerttxt=alerttxt+'Fecha de pago es necesario\n';
        tf.D_PAGO.style.backgroundColor="yellow";flag=1;}
    if (dpago>tf.D_FECH.value)
        {alerttxt=alerttxt+'Fecha de pago en el porvenir\nPAGO='+tf.D_PAGO.value+'\nHOY='+tf.D_FECH.value+'\n';
        tf.D_PAGO.style.backgroundColor="orange";
        flag=1;}
    }
//ACLARACIONS need cargo/parentesco
if (cvt==="ACLARACION")
    {
		if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNP.style.backgroundColor="yellow";
          flag=1;}
	}
//NEGATIVAS DE PAGO need cargo/parentesco
if (cvt==="NEGATIVA DE PAGO")
    {
		if (validate_required(tf.C_CARG)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNP.style.backgroundColor="yellow";
          flag=1;}
   }
//NO CONTACTO means NO CONTACTO!	
if (cvt.substr(0,4)==="TEL ")
    {if (tf.C_CARG.value.length!==0)
    {
    alerttxt=alerttxt+'Cargo del contacto no es necesario cuando STATUS es '+cvt;
    tf.C_CARG.style.backgroundColor="yellow";
    flag=1;
    }
	}
if (cvt.substr(0,11)==="MENSAJE EN ")
    {if (tf.C_CARG.value.length!==0)
    {alerttxt=alerttxt+'Cargo del contacto no es necesario cuando STATUS es '+cvt;
    tf.C_CARG.style.backgroundColor="yellow";
    flag=1;}
	}
}
//monto de promesa can only have numbers and one decimal point.
if ((n1.toString()).match(/[^0-9.]/))
	{alerttxt=alerttxt+'No puede usarse un separador de miles'+'\n'+'No puede dejar campo blanco. Usa 0.'+'\n';
	tf.N_PROM1.style.backgroundColor="yellow";
	flag=1;}
if ((n2.toString()).match(/[^0-9.]/))
	{alerttxt=alerttxt+'No puede usarse un separador de miles'+'\n'+'No puede dejar campo blanco. Usa 0.'+'\n';N_PROM2.style.backgroundColor="yellow";flag=1;}
//monto de pago can only have numbers and one decimal point.
if ((npa.toString()).match(/[^0-9.]/))
	{alerttxt=alerttxt+'No puede usarse un separador de miles'+'\n';
	tf.N_PAGO.style.backgroundColor="yellow";
	flag=1;}
//new telephones can only have numbers
if (cnt!==null) {
if ((cnt.toString()).match(/[^0-9]/))
	{alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
	tf.C_NTEL.style.backgroundColor="yellow";
	flag=1;}
if ((cnt.length!==0)&&(cnt.length!==8)&&(cnt.length!==10)&&(cnt.length!==13))
	{alerttxt=alerttxt+'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
	tf.C_NTEL.style.backgroundColor="yellow";flag=1;}
}
if (co2!==null) {
if ((co2.toString()).match(/[^0-9]/))
	{alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
	tf.C_OBSE2.style.backgroundColor="yellow";
	flag=1;}
if ((co2.length!==0)&&(co2.length!==8)&&(co2.length!==10)&&(co2.length!==13))
	{alerttxt=alerttxt+'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
	tf.C_OBSE2.style.backgroundColor="yellow";flag=1;}
}
//date checks on promises
if (n1>0){
//date must be today or in future
		if (dp1<tf.D_FECH.value)
			{alerttxt=alerttxt+'Fecha de promesa en pasado'+'\nPROM='+dp1+'\nHOY='+tf.D_FECH.value+'\n';
			tf.D_PROM1.style.backgroundColor="yellow";
			flag=1;}
<?php if (($mytipo!=='admin')&&($AUTHTIPO!=='admin')) {?>
var aflag=flag;
		if (dp1.substr(0,7)!==tf.D_FECH.value.substr(0,7))
			{alert("Promesas en el mes siguiente necesita autorización");flag=1;}
//date must be before the 16th (admins exempt)
		if ((parseInt(dp1.substr(8))>15) && (parseInt(tf.D_FECH.value.substr(8))<15))
			{alert("Promesas despues 15 del mes necesita autorización");flag=1;}
//only admins can change active promises
		if ((dpo!==tf.D_PROM1.value) && (dpo>=tf.D_FECH.value))
			{alert("Para sobreescribir promesa vigente lo necesita autorización");flag=1;}
		if ((npo>np) && (dpo>=tf.D_FECH.value))
			{alert("Para sobreescribir promesa vigente lo necesita autorización");flag=1;}
//prevent overwriting active promises
if (ccn==="PROMESA DE PAGO TOTAL")
    {alerttxt=alerttxt+"Solamente un supervisor puede sobreescribido una promesa activa.";
    tf.N_PROM_OLD1.style.backgroundColor="yellow";
    tf.N_PROM_OLD2.style.backgroundColor="yellow";
    tf.D_PROM_OLD1.style.backgroundColor="yellow";
    tf.D_PROM_OLD2.style.backgroundColor="yellow";
    flag=1;
    }
<?php } ?>
}
if (n2>0){
//date must be today or in future
		if (dp2<tf.D_FECH.value)
			{alerttxt=alerttxt+'Fecha de promesa en pasado'+'\nPROM='+dp2+'\nHOY='+tf.D_FECH.value+'\n';
			tf.D_PROM1.style.backgroundColor="yellow";
			flag=1;}
<?php if (($mytipo!=='admin')&&($AUTHTIPO!=='admin')) {?>
//activate authbox if these trip
if (aflag!==flag) {
	document.getElementById('authbox').style.display='block';
	}
<?php } ?>
//date needs amount
	if (validate_required(tf.D_PROM2)===false)
        {alerttxt=alerttxt+"Fecha de promesa es necesario\n";
        tf.D_PROM2.style.backgroundColor="yellow";flag=1;}
	}
//monto de pago needs fecha de pago
if (npa>0.0)
{
	if (validate_date(tf.D_PAGO)===false)
        {
			alerttxt=alerttxt+'Fecha de pago es necesario\n';
			tf.D_PAGO.style.backgroundColor="yellow";
			flag=1;
			}
}
//promises need schedule
if (np>0)
    {if (validate_required(tf.C_PROM)===false)
			{alerttxt=alerttxt+"Frecuencia de pago es necesario\n";
			tf.C_PROM.style.backgroundColor="yellow";
			flag=1;}
	}
alertstr="Gestion de cuenta capturado con status " + cvt + ".\n";
if (np>0) {alertstr=alertstr+" Fecha de promisa 1: "+tf.D_PROM1.value+" ";}
if (np>0) {alertstr=alertstr+" Monto de promisa 1: $"+tf.N_PROM1.value+"\n";}
if (np>0) {alertstr=alertstr+" Fecha de promisa 2: "+tf.D_PROM2.value+" ";}
if (np>0) {alertstr=alertstr+" Monto de promisa 2: $"+tf.N_PROM2.value+"\n";}
if (np>0) {alertstr=alertstr+" Monto de promisa total: $"+np;}
if (flag===0) {
	alert(alertstr);
	tf.GUARDAR.disabled=true;
	tf.error.value=0;
	return true;
	} 
else {
//  stopEvent(evt); // DOM style
  alert("ERROR EA2 - "+alerttxt);
//  stopEvent(evt); // DOM style
  return false; // IE style
  }
}
</script>
