$(function() {
	openSearch();
	$('.fecha').datepicker();
	if (flag > 0) {
		alert(flagmsg + 
				"\nBuscar para checar que gestion de cuenta " + cuenta + 
				" está guardado corectamente.");
	}
	if (notalert > 0) {
		$('#notasq input').css('backgroundColor','red');
	}
	if (tipo == 'visitador') {
		$('#databox').hide();
		$('#prombox').hide();
		$('#nuevoboxt').hide();
		$('#combox').hide();
		$('#guardbox').hide();
		$('#dtelboxt').hide();
		$('#clock').hide();
		$('#visitboxt').show();
		$('#visitbox').show(); 
	}
	var inactivo = new RegExp('-');
	if (inactivo.test(sdc) && (tipo != 'admin')) {
		$('#GUARTbutt').hide();
	}
	function clock () {
		var d = new Date();
		var tn = d.getTime();
		var tll = new Date(tlp);
		var tl = tll.getTime();
		$("#timer").val(tn-tl);
		var timenow = $("#timer").val();
	    $("#timers").val(parseInt(parseInt(timenow)/1000)%60);
	    $("#timerm").val(parseInt(parseInt(timenow)/1000/60));
	    var timemin = $("#timerm").val();
	    if (timemin > 2) {
	    	$("#clock").css('backgroundColor', 'yellow');
	    } 
	    if (timemin > 4) {
	    	$("#clock").css('backgroundColor', 'red');
	    } 
	    if (timenow % 2 == 0) {
	    	$("#clock").css('backgroundColor', 'green');
		} 
	} 
	function openSearch () { 
		setInterval('clock()', 1000);
	}
});

function npromChange (thisform ) {with (thisform) { 	N_PROM.value=(N_PROM1.value*1)+(N_PROM2.value*1);
 	 }} 
function statusChange (thisform ) {with (thisform) { if 	(C_CVST.substr(0,3)==="PAG") { 	document.getElementById("pagocapt").style.backgroundColor="yellow";
document 	.getElementById("pagocapt2").style.backgroundColor="yellow";
document 	.getElementById("pagocaptv").style.backgroundColor="yellow";
 	 }} } 
 {% if qcount> 1 %} alert (" ERROR RA3 - Hay <? php echo $ qcount ;
 ?> cuentas con este número	 .");
 { % endif %} {% if notalert == 1 %} var goalert = confirm ( "Tiene alerta pendiente { { nota .fechahora 	 }} " + " para cuenta { { nota .cuenta 	 }} Quiere verlo ?");
 if (goalert ==true) {window .location="resumen?find={{ 	nota.cuenta 	 }} " + "& field = numero_de_cuenta " + "& go = FROMALERT &go1=FROMALERT";
                 } {% endif %} {% if r .status_de_credito matches '/-/' %} alert (" Esta cuenta está <? php echo $ status_de_credito ?>");
 {% endif %} {% if lockflag == 0 %} {% set nn = 0 %} {# redo highlighting code # } {% endif %} {% if lockflag == 1 %} alert (" ERROR RA4 - Esta record está en uso de <? php echo $ locker ?>");
 {% endif %} var r ={ ' special ' : / [ \W ] /g , ' quotes ' : / [ ' \' '&'\"' ] /g , ' notnumbers ' : / [ ^ \d ] /g } ;
 
function valid ( o , w ){ o .value = o .value .replace (r [ w ] , ' ');
 } 
function tooLong (e ) {if 	(window.document.getElementById("C_OBSE1").value.length>250) { 	window.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.replace(' 	',' ');
window 	.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.substr(0,200);
confirm 	('GESTION demasiado largo');
window 	.document.getElementById("C_OBSE1").style.backgroundColor="yellow";
return 	false;
 	 }} 
function logout() {
	window.location = "logout";
} 
function showsearch () { document	 .getElementById ('searchbox') .style .display ="block";
document	 .getElementById ('find') .focus ();
	} 
function showbox (boxname ) {document 	.getElementById(boxname).style.display="block";
 	 }
function cancelbox (boxname ) {document 	.getElementById(boxname).style.display="none";
searching ="";
 	 }
function addToTels ( pos , tel ) { document	 .getElementById ("C_TELE") .options [ pos ] =new Option (tel .value , tel .value , true , true );
document	 .getElementById ("C_TELE") .options [ pos ] .style .fontWeight ="bold";
document	 .getElementById ("C_TELE") .options [ pos ] .style .backgroundColor =" #00FF00 ";
	} 
