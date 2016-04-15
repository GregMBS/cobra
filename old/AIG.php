<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
function PAGO ($ir, $np, $pv ) {
 /*
 ir - interest rate per month
 np - number of periods (months)
 pv - present value
 fv - future value (residual value)
 */
 $pmt = round(($pv * $ir * pow(($ir+1), $np)) / (pow(($ir+1), $np) - 1 ));
 return $pmt;
}
$querymain="SELECT numero_de_cuenta,nombre_deudor,saldo_cuota,saldo_descuento_1,saldo_total
FROM resumen WHERE saldo_cuota>0;";
$result=mysql_query($querymain);
while ($answer=mysql_fetch_row($result)) {
$CUENTA=$answer[0];
$NOMBRE=$answer[1];
$SC=$answer[2];
$SD1=$answer[3];
$ST=$answer[4];
$mao=$SD1;
$mado=$ST;
$cuoo=$SC;
$cuon=round($cuoo*0.75);
$vds=round($mao*0.02981);
$mns=round($mao*1.02981+1);
$i=0;
$tst=99999999;
while (($tst>$cuoo*0.75)&&($i<49)) {
$i++;
if ($i<12) {$tst=round(PAGO(1e-9,$i,$mns));}
if (($i>11) && ($i<18)) {$tst=round(PAGO(0.01*(1+0.15),$i,$mns));}
if (($i>17) && ($i<24)) {$tst=round(PAGO(0.03*(1+0.15),$i,$mns));}
if (($i>23) && ($i<49)) {$tst=round(PAGO(0.04*(1+0.15),$i,$mns));}
}
$cci=$i-1;
if ($cci<12) {$cint=0.00;$cfp=round(PAGO(1e-9,$cci,$mns));}
if (($cci>11) && ($cci<18)) {$cint=0.01;$cfp=round(PAGO(0.01*(1+0.15),$cci,$mns));}
if (($cci>17) && ($cci<24)) {$cint=0.03;$cfp=round(PAGO(0.03*(1+0.15),$cci,$mns));}
if (($cci>23) && ($cci<49)) {$cint=0.04;$cfp=round(PAGO(0.04*(1+0.15),$cci,$mns));}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>AIG Calculadora</title>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<META NAME="GENERATOR" CONTENT="OpenOffice.org 2.4  (Linux)">
	<META NAME="AUTHOR" CONTENT="AIG_UNIVERSAL">
	<META NAME="CREATED" CONTENT="20050826;11255800">
	<META NAME="CHANGEDBY" CONTENT="JOCAMPO">
	<META NAME="CHANGED" CONTENT="20081027;15053500">
	
	<STYLE type='text/css'>
		<!-- 
		BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Tahoma",Arial,sans; font-size:small;}
		.bgcolor1 {background-color:#C0C0C0;}
		TABLE {background-color:#000000;}
		TD {color:#ffffff;border-collapse: collapse;}
		#Vds1,#Vds2,#Vds3,#Vds4 {background-color:transparent; color:white; border:0;}
		#Mns1,#Mns2,#Mns3,#Mns4 {background-color:transparent; color:white; border:0;}
		#Cfp1,#Cfp2,#Cfp3,#Cfp4 {background-color:transparent; color:white; border:0;font-weight:bold;}
		
		 -->
	</STYLE>
</head>
<body onload='init()'>
<p>CUENTA: <?php echo $CUENTA; ?><br>
NOMBRE: <?php echo $NOMBRE; ?></p>
<TABLE FRAME=VOID CELLSPACING=0 COLS=8 RULES=NONE BORDER=0>
	<TBODY>
		<TR>
			<TD COLSPAN=3 HEIGHT=27 ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#993366"><B><FONT>Cuotas final del préstamo personal</FONT></B></TD>
		</TR>
		<TR>
			<TD HEIGHT=24 VALIGN=MIDDLE BGCOLOR="#993366"><B><FONT>Interés</FONT></B></TD>
			<TD VALIGN=MIDDLE BGCOLOR="#993366"></TD>
			<TD ALIGN=right VALIGN=MIDDLE BGCOLOR="#993366"><B><FONT><?php echo $cint; ?></FONT></B></TD>
		</TR>
		<TR>
			<TD HEIGHT=17 BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080">Mensualidades</FONT></B></TD>
			<TD BGCOLOR="#FFFFFF"><B><FONT><BR></FONT></B></TD>
			<TD ALIGN=right BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080"><?php echo $cci; ?></FONT></B></TD>
		</TR>
		<TR>
			<TD HEIGHT=17 BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080">Monto a otorgar</FONT></B></TD>
			<TD BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080"><BR></FONT></B></TD>
			<TD ALIGN=right BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080">
        			<?php echo $mao; ?>
			        </FONT></B></TD>
		</TR>
		<TR>
			<TD HEIGHT=17 BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080">Monto adeudado</FONT></B></TD>
			<TD BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080"><BR></FONT></B></TD>
			<TD ALIGN=right BGCOLOR="#FFFFFF"><B><FONT COLOR="#000080">
        			<?php echo $mado; ?>
			        </FONT></B></TD>
		</TR>
		<TR>
			<TD HEIGHT=17 BGCOLOR="#993366"><B><FONT>Valor del Seguro  </FONT></B></TD>
			<TD BGCOLOR="#993366"><B><FONT><BR></FONT></B></TD>
			<TD ALIGN=right BGCOLOR="#993366"><?php echo $vds; ?></TD>
		</TR>
		<TR>
			<TD HEIGHT=17 BGCOLOR="#993366"><B><FONT>Monto +Seguros</FONT></B></TD>
			<TD BGCOLOR="#993366"><B><FONT><BR></FONT></B></TD>
			<TD ALIGN=right BGCOLOR="#993366"><?php echo $mns; ?></TD>
		</TR>
		<TR>
			<TD HEIGHT=24 ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#993366"><B><FONT>Cuota final a pagar en chequera</FONT></B></TD>
			<TD ALIGN=CENTER BGCOLOR="#993366"><B><FONT COLOR="#000080"><BR></FONT></B></TD>
			<TD ALIGN=right VALIGN=MIDDLE BGCOLOR="#993366" SDVAL="1779.29364609091"><?php echo $cfp; ?></TD>
		</TR>
		<TR>
			<TD HEIGHT=24 ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#993366"><B><FONT>Cuota anterior</FONT></B></TD>
			<TD ALIGN=CENTER BGCOLOR="#993366"><B><FONT COLOR="#000080"><BR></FONT></B></TD>
			<TD ALIGN=right VALIGN=MIDDLE BGCOLOR="#993366" SDVAL="1779.29364609091"><?php echo $cuoo; ?></TD>
		</TR>
		<TR>
			<TD HEIGHT=24 ALIGN=CENTER VALIGN=MIDDLE BGCOLOR="#993366"><B><FONT>Cuota anterior - 25%</FONT></B></TD>
			<TD ALIGN=CENTER BGCOLOR="#993366"><B><FONT COLOR="#000080"><BR></FONT></B></TD>
			<TD ALIGN=right VALIGN=MIDDLE BGCOLOR="#993366" SDVAL="1779.29364609091"><?php echo $cuon; ?></TD>
		</TR>
	</TBODY>
</TABLE>
<table style='page-break-after:always;'>
<tr><td colspan=2 align=center>Datos hay que tener:</td></tr>
<tr><td>IFE o Pasaporte o Carteo Militar</td><td>Copia</td></tr>
<tr><td>Recibo de Luz</td><td>Original</td></tr>
<tr><td>Predial o Agua</td><td>Original</td></tr>
<tr><td>4 Referencias</td><td>Copia</td></tr>
<tr><td>Firma de Carta de Refinanciamiento</td><td>Original</td></tr>
<tr><td>Comprobante de Ingresos (3 ultimos pagos)</td><td>Original</td></tr>
</table>
</body>
</html> 
<?php   
}
mysql_close($con);
?>

