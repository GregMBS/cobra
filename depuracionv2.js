function validate_form2(tf,evt,minprom,authorized,at)
{
//initialize 
var alertstr=' ';
var alerttxt=' ';
var flag=0;
var aflag=0;
var npa=0;
var n1=0;
var np=0;
var npo=0;
np=parseFloat(tf.N_PROMv.value);
var cvt="";
var ccn=" ";
var cnt="";
var co2="";
var dp="0000-00-00";
var dpo="0000-00-00";
var dpago="0000-00-00";
//actual sum de promesa
if(typeof(tf.N_PAGOv) !== "undefined")
{npa=parseFloat(tf.N_PAGO.value);}
if(typeof(tf.N_PROMv) !== "undefined")
{n1=parseFloat(tf.N_PROMv.value);}
if(typeof(tf.N_PROM_OLDv) !== "undefined")
{npo=parseFloat(tf.N_PROM_OLDv.value);}
if(typeof(tf.C_CVSTv) !== "undefined")
{cvt=trim(tf.C_CVSTv.value);}
if(typeof(tf.C_CONTANv) !== "undefined")
{ccn=trim(tf.C_CONTANv.value);}
if(typeof(tf.C_NTELv) !== "undefined")
{cnt=trim(tf.C_NTELv.value);}
if(typeof(tf.C_OBSE2v) !== "undefined")
{co2=tf.C_OBSE2v.value;}
if(typeof(tf.D_PROMv.value) !== "undefined")
{dp=tf.D_PROMv.value;}
if(typeof(tf.D_PROM_OLDv.value) !== "undefined")
{dpo=tf.D_PROM_OLDv.value;}
if(typeof(tf.D_PAGOv.value) !== "undefined")
{dpago=tf.D_PAGOv.value;}
alert('Checando validad de gestion:\nCUENTA - '+tf.CUENTAv.value+'\nStatus - '+cvt);
	if ((validate_date(tf.C_VDv))===false)
		{tf.C_VDv.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de gestion.';}
//Promise date-amount checks - promise 1
if ((n1>0)) {
//amount but no date	
	if ((validate_date(tf.D_PROMv))===false)
		{tf.D_PROMv.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de promesa 1.'+dp;}
	if (dp==='0000-00-00')
		{tf.D_PROMv.style.backgroundColor="yellow";
		flag=1;
		alerttxt=alerttxt+'No hay fecha de promesa 1.'+dp;}
}
//Credito Si gestion rules = no punctuation, no accents
var badpunct="[.,#!¡¿-]";
var badaccent="[ñÑáéíóúÁÉÍÓÚ]";
if ((tf.C_CVBAv.value==='Credito Si')&&(tf.C_OBSE1v.value.match(badpunct)))
{alerttxt=alerttxt+'GESTION no puede usar puntuacion'+'\n';
tf.C_OBSE1v.style.backgroundColor="yellow";
flag=1;}
if ((tf.C_CVBAv.value==='Credito Si')&&(tf.C_OBSE1v.value.match(badaccent))) 
{alerttxt=alerttxt+'GESTION no puede usar accentos'+'\n';
tf.C_OBSE1v.style.backgroundColor="yellow";
flag=1;}
//GESTIONES necesitan a lo menos 2 palbras
if (tf.C_OBSE1v.value.indexOf(" ")===-1)
	{alerttxt=alerttxt+'GESTION no está completada'+'\n'+tf.C_OBSE1v.value;
	tf.C_OBSE1v.style.backgroundColor="yellow";
	flag=1;}
//Picky gringo language rules
if (tf.C_OBSE1v.value.indexOf(" K ")!==-1)
	{alerttxt=alerttxt+'Usa QUE en lugar de K'+'\n';
	tf.C_OBSE1v.style.backgroundColor="yellow";flag=1;}
if (tf.C_OBSE1v.value.indexOf("CHING")!==-1)
	{alerttxt=alerttxt+'Moderar su lenguaje'+'\n';
	tf.C_OBSE1v.style.backgroundColor="yellow";flag=1;}
if (tf.C_OBSE1v.value.indexOf(" CTA")!==-1)
	{alerttxt=alerttxt+'¿Significa CTA CUENTA o CONTESTA?'+'\n';
	tf.C_OBSE1v.style.backgroundColor="yellow";flag=1;}
//Must have visitador
if (validate_required(tf.C_VISITv)===false)
  {alerttxt=alerttxt+'VISITADOR es necesario\n';
  tf.C_VISITv.style.backgroundColor="yellow";flag=1;}
//Must Have status
if (validate_required(tf.C_CVSTv)===false)
  {alerttxt=alerttxt+'STATUS es necesario\n';
  tf.C_CVSTv.style.backgroundColor="yellow";
  flag=1;}
//Must have accion
if (validate_required(tf.ACCIONv)===false)
  {alerttxt=alerttxt+'ACCION es necesario\n';
  tf.ACCIONv.style.backgroundColor="yellow";flag=1;}
//Amount of promise requires cargo/parentesco
if (n1>0) {
        if (validate_required(tf.C_CNPv)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNPv.style.backgroundColor="yellow";flag=1;}
          }
//Debtor must give causa no pago
if (tf.C_CARGv.value==='Deudor') {
        if (validate_required(tf.C_CNPv)===false)
          {alerttxt=alerttxt+'CAUSA NO PAGO es necesario\n';
          tf.C_CNPv.style.backgroundColor="yellow";flag=1;}
          }
//GESTION too long
if (tf.C_OBSE1v.length>250) {alerttxt=alerttxt+'GESTION demasiado largo\n';
tf.C_OBSE1v.style.backgroundColor="yellow";flag=1;}
if (cvt!==null) {
//CONFIRMA PROMESA requires PROMESA and cargo/parentesco
if (cvt.substr(0,8)==="CONFIRMA") 
   {if (validate_required(tf.N_PROM_OLDv)===false)
        {alerttxt=alerttxt+'Promesa primera, confirma despues\n';
        tf.C_CVSTv.style.backgroundColor="yellow";flag=1;}
        if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNPv.style.backgroundColor="yellow";flag=1;}
        }
//CLIENTE NEGOCIANDO requires cargo/parentesco        
if (cvt==="CLIENTE NEGOCIANDO") 
   {
	if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNPv.style.backgroundColor="yellow";flag=1;}
        }
//PROMESA DE PAGO TOTAL requires cargo/parentesco and monto de promesa 
// greater than or equal to minprom      
if (cvt==="PROMESA DE PAGO TOTAL") 
   {
	if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+'Carga/Parentesco es necesario\n';
          tf.C_CNPv.style.backgroundColor="yellow";flag=1;}
	if (np < minprom)
		{tf.C_CVSTv.style.backgroundColor="yellow";flag=1;
		alerttxt=alerttxt+'Monto de promesa '+np+' está menor que monto minimo '+minprom;}
        }
//PROMESA DE PAGO PARCIAL requires cargo/parentesco and monto de promesa 
// less than minprom      
if (cvt==="PROMESA DE PAGO PARCIAL")
    {	
	if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNPv.style.backgroundColor="yellow";
          flag=1;}
	if (n1<10)
			{alerttxt=alerttxt+"MONTO DE PROMESA es necesario"+'\n';
			tf.C_CVSTv.style.backgroundColor="yellow";
			tf.N_PROMv.style.backgroundColor="yellow";
			flag=1;}
	}
//PROPUESTA DE PAGO requires cargo/parentesco and monto de promesa 
if (cvt.substr(0,12)==="PROPUESTA DE") 
   {
	if (n1<10)
        {alerttxt=alerttxt+"MONTO DE PROMESA es necesario"+'\n';
        tf.N_PROMv.style.backgroundColor="yellow";
        tf.N_PROM2.style.backgroundColor="yellow";
        flag=1;}
	if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNPv.style.backgroundColor="yellow";flag=1;}
        }
//PAGO TOTAL and PAGO PARCIAL and PAGANDO CONVENIO require monto de pago y fecha hoy o en pasado 
if (cvt.substr(0,3)==="PAG") 
   {
    document.getElementById("pagocapt").style.display="table-row";
    document.getElementById("pagocapt2").style.display="table-row";
	if (validate_required(tf.N_PAGOv)===false)
        {alerttxt=alerttxt+'Monto de pago es necesario\n';
        tf.N_PAGOv.style.backgroundColor="yellow";flag=1;}
	if (npa<10)
        {alerttxt=alerttxt+'Monto de pago es necesario\n';
        tf.N_PAGOv.style.backgroundColor="yellow";flag=1;}
    if (validate_date(tf.D_PAGOv)===false)
        {alerttxt=alerttxt+'Fecha de pago es necesario\n';
        tf.D_PAGOv.style.backgroundColor="yellow";flag=1;}
    if (dpago==='0000-00-00')
        {alerttxt=alerttxt+'Fecha de pago es necesario\n';
        tf.D_PAGOv.style.backgroundColor="yellow";flag=1;}
    if (dpago>tf.C_VDv.value)
        {alerttxt=alerttxt+'Fecha de pago en el porvenir\nPAGO='+tf.D_PAGOv.value+'\nHOY='+tf.C_VDv.value+'\n';
        tf.D_PAGOv.style.backgroundColor="orange";
        flag=1;}
    }
//ACLARACIONS need cargo/parentesco
if (cvt==="ACLARACION")
    {
		if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNPv.style.backgroundColor="yellow";
          flag=1;}
	}
//NEGATIVAS DE PAGO need cargo/parentesco
if (cvt==="NEGATIVA DE PAGO")
    {
		if (validate_required(tf.C_CARGv)===false)
          {alerttxt=alerttxt+"Carga/Parentesco es necesario"+'\n';
          tf.C_CNPv.style.backgroundColor="yellow";
          flag=1;}
   }
}
//monto de promesa can only have numbers and one decimal point.
if ((n1.toString()).match(/[0-9\.]/)) {flag=flag;} else 
	{alerttxt=alerttxt+'No puede usarse un separador de miles'+'\n'+'No puede dejar campo blanco. Usa 0.'+'\n';
	tf.N_PROMv.style.backgroundColor="yellow";
	flag=1;}
//monto de pago can only have numbers and one decimal point.
if ((npa.toString()).match(/[0-9\.]/)) {flag=flag;} else
	{alerttxt=alerttxt+'No puede usarse un separador de miles'+'\n';
	tf.N_PAGOv.style.backgroundColor="yellow";
	flag=1;}
//new telephones can only have numbers
if (cnt!==null) {
if ((cnt.toString()).match(/[0-9]/)) {flag=flag;} else
	{alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
	tf.C_NTELv.style.backgroundColor="yellow";
	flag=1;}
if ((cnt.length!==0)&&(cnt.length!==10)&&(cnt.length!==13))
	{alerttxt=alerttxt+'Nuevo teléfono tiene que tener 10 (tierra) o 13 (cel) digitos';
	tf.C_NTELv.style.backgroundColor="yellow";flag=1;}
}
if (co2!==null) {
if ((co2.toString()).match(/[0-9]/))  {flag=flag;}
// else
//	{alerttxt=alerttxt+'No puede usarse un separador o letras en telefonos'+'\n';
//	tf.C_OBSE2v.style.backgroundColor="yellow";
//	flag=1;}
if ((co2.length!==0)&&(co2.length!==8)&&(co2.length!==10)&&(co2.length!==13))
	{alerttxt=alerttxt+'Nuevo teléfono tiene que tener 8, 10, o 13 digitos';
	tf.C_OBSE2v.style.backgroundColor="yellow";flag=1;}
}
//date checks on promises
//monto de pago needs fecha de pago
if (npa>0.0)
{
	if (validate_date(tf.D_PAGOv)===false)
        {
			alerttxt=alerttxt+'Fecha de pago es necesario\n';
			tf.D_PAGOv.style.backgroundColor="yellow";
			flag=1;
			}
}
//promises need schedule
if (np>0)
    {if (validate_required(tf.C_FREQv)===false)
			{alerttxt=alerttxt+"Frecuencia de pago es necesario\n";
			tf.C_FREQv.style.backgroundColor="yellow";
			flag=1;}
	}
alertstr='Gestion de cuenta '+tf.CUENTAv.value+' guardado con status ' + cvt + ".\n";
if (n1>0) {alertstr=alertstr+" Fecha de promisa 1: "+dp+" ";}
if (n1>0) {alertstr=alertstr+" Monto de promisa 1: $"+n1+"\n";}
if (npa>0) {alertstr=alertstr+" Fecha de promisa total: "+dpago;}
if (npa>0) {alertstr=alertstr+" Monto de promisa total: $"+npa;}
if (flag===0) {
	alert(alertstr);
	tf.CAPTURADO.disabled=true;
	tf.error.value=0;
	return true;
	} 
else {
//  stopEvent(evt); // DOM style
  alert('ERROR EA2 - '+alerttxt+'\nGestion no se guardó.');
  stopEvent(evt); // DOM style
  return false; // IE style
  }
}