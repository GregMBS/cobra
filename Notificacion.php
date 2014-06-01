<?php  
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$C_CONT = mysql_real_escape_string($_GET['C_CONT']);
   $field = mysql_real_escape_string($_GET['field']);
   $find = mysql_real_escape_string($_GET['find']);
   $i = mysql_real_escape_string($_GET['i']);
if (empty($i)) {$i=0;};
   $capt =mysql_real_escape_string($_GET['capt']);
if (isset($C_CONT)) {
$querymain = "SELECT cliente,id_cuenta,numero_de_cuenta,
nombre_deudor,domicilio_deudor,colonia_deudor,ciudad_deudor,estado_deudor,
cp_deudor,saldo_total,saldo_vencido,saldo_descuento_1,saldo_descuento_2,status_de_credito
FROM resumen WHERE id_cuenta='$C_CONT'";
$result = mysql_query($querymain) or die(mysql_error());
while ($row = mysql_fetch_row($result)) {
$CLIENTE=$row[0];
$ID_CUENTA=$row[1];
$CUENTA=$row[2];
$NOMBRE=$row[3];
$DOMI=$row[4];
$COLONIA=$row[5];
$CIUDAD=$row[6];   
$CP=$row[7];
$ESTADO=$row[8];
$ST=$row[9];
$SV=$row[10];
$SD1=$row[11];
$SD2=$row[12];
$SDC=$row[13];
$MONTODESC=min($SD1,$SD2);
if ($MONTODESC==0) {$MONTODESC=max($SD1,$SD2);}
};
};
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE>NOTIFICACION</TITLE>
	<META NAME="GENERATOR" CONTENT="OpenOffice.org 2.4  (Linux)">
	<META NAME="AUTHOR" CONTENT="Claudia Melendez">
	<META NAME="CREATED" CONTENT="20090330;11120000">
	<META NAME="CHANGEDBY" CONTENT="USUARIO">
	<META NAME="CHANGED" CONTENT="20090330;11220000">
	<STYLE TYPE="text/css">
	<!--
		P { margin-bottom: 0.21cm; direction: ltr; color: #000000; text-align: left; widows: 2; orphans: 2 }
		P.western { font-family: "Times New Roman", serif; font-size: 12pt; }
		P.cjk { font-family: "Times New Roman", serif; font-size: 12pt; }
		P.ctl { font-family: "Times New Roman", serif; font-size: 12pt; }
		H1 { text-align:center;color:#cccccc; padding-bottom:0.3em; }
		.shadow {
                        line-height: 0em;
                        white-space: nowrap;
                        }
		.shadow:before {
                        display: block;
                        margin: 0 0 -2px 2px;
                        padding: 0;
                        color: #000000; 
                        }
                #sublogo:before { content: 'ADMINISTRACIÓN AVANZADA'; }
                #sublogo2:before { content: 'Y RECUPERACIÓN'; }
                #sublogo3:before { content: 'ADMINISTRACIÓN AVANZADA Y RECUPERACIÓN'; }
                TABLE {margin-left:4cm;}
	-->
	</STYLE>
</HEAD>
<BODY LANG="es-MX" TEXT="#000000" DIR="LTR">
<DIV TYPE=HEADER>
	<P LANG="" STYLE="margin-bottom: 1.5cm">
	<IMG SRC="logo.png" NAME="ADARSA" ALIGN=BOTTOM WIDTH=72 HEIGHT=69 BORDER=0>
	<IMG SRC="barcode.php?bctext=<?php echo $CUENTA.' '.date('Ymd');?>" NAME="ADARSA">
	</P>
</DIV>
<P LANG="es-ES" CLASS="western" STYLE="margin-bottom: 0cm; text-align:right;">
<FONT SIZE=7 STYLE="font-size: 48pt"><B>Aviso 3</B></FONT></P>
<P LANG="es-ES" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0cm">
<FONT SIZE=4><B><?php echo $NOMBRE ?></B></FONT><br>
<?php echo $DOMI ?><br>
<?php echo $COLONIA ?><br>
<?php echo $CIUDAD ?><br>
<?php echo $ESTADO ?>  		C.P. <?php echo $CP ?></P>
<P LANG="es-ES" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0cm">
Señor (a) <FONT SIZE=4><B><?php echo $NOMBRE ?></B></FONT>, le
insistimos que por incumplir en sus pagos, con la empresa denominada
<B><?php echo $CLIENTE ?></B>, se le ha encomendado al staff de despachostyle="text-align:center;color:gray;text-shadow: black 2px -2px 0;"s de
cobranza su cuenta, con la finalidad de que usted liquidara sus
adeudos por la vía del dialogo, por lo que en esta ocasión ya se
turnó a este <B>despacho jurídico</B> su expediente completo, con
la consigna de llegar hasta las ultimas consecuencias por el
incumplimiento a la liquidación del pagare, el cual usted suscribió
ante esta institución.</P>
<P LANG="es-ES" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0cm">
Es <FONT SIZE=3 STYLE="font-size: 13pt"><B>importante y urgente</B></FONT>
informarle que liquide sus cuotas pendientes con <B>Crédito Si</B>.
Estamos consientes de la situación económica del país, pero es
necesario que usted cumpla con sus compromisos mercantiles, ya que en
caso de no aceptar esta notificación con el objetivo de negociar, le
aseguramos que usted corre el riesgo de sufrir un estado de gravedad
económica por las consecuencias que este pagare traerá a su
patrimonio.</P>
<P LANG="es-ES" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0cm">
No esta por demás enterarlo de que tiene la posibilidad de liquidar
sus cuotas pendientes con <B><?php echo $CLIENTE ?></B> obteniendo el siguiente
descuento único para usted</P>
<hr>
<h1 class='shadow' id='sublogo'>ADMINISTRACI&Oacute;N AVANZADA</h1>
<h1 class='shadow' id='sublogo2'>Y RECUPERACI&Oacute;N</h1>
<TABLE WIDTH=541 BORDER=1 BORDERCOLOR="#000000" CELLPADDING=5 CELLSPACING=0>
		<COL WIDTH=124>
		<COL WIDTH=125>
		<COL WIDTH=125>
		<COL WIDTH=126>
		<TR>
			<TD WIDTH=124 HEIGHT=21>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Numero
				de Crédito</B></FONT></FONT></P>
			</TD>
			<TD WIDTH=125>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Saldo
				Adeudado</B></FONT></FONT></P>
			</TD>
			<TD WIDTH=125>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Descuento</B></FONT></FONT></P>
			</TD>
			<TD WIDTH=126>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Saldo
				a pagar</B></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=124 HEIGHT=64>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>C<?php echo $CUENTA ?></B></FONT></FONT></P>
			</TD>
			<TD WIDTH=125>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>$<?php echo number_format($ST,2); ?></B></FONT></FONT></P>
			</TD>
			<TD WIDTH=125>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>$<?php echo number_format($ST-$MONTODESC,2); ?></B></FONT></FONT></P>
			</TD>
			<TD WIDTH=126>
				<P LANG="es-ES" CLASS="western" ALIGN=CENTER><FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>$<?php echo number_format($MONTODESC,2); ?></B></FONT></FONT></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P LANG="es-ES" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0cm">
<FONT FACE="Arial, sans-serif"><FONT SIZE=2><B>Descuento Valido solo
para el mes de Marzo de 2009 y previa firma  de la cancelación de su
crédito, presentando su credencial de elector</B></FONT></FONT></P>
<P LANG="es-ES" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0cm">
<FONT FACE="Arial, sans-serif"><FONT SIZE=2><U><B>Esta puede ser su
ultima oportunidad; acuda rápidamente a firmar la cancelación de su
crédito en Avenida Gozalitos 280 sur piso 3 despacho 301 Colonia San
Jerónimo en MTY o llame a los teléfonos   83334560, 83335558,
83335405, 83334728, lada sin costo 01800 001 24 24, y 01800 832 55 15
ya que de lo contrario nuestros abogados se encuentra tramitando la
recuperación forzosa de sus adeudos en el domicilio de</B></U></FONT></FONT>
<?php echo $DOMI ?></P>
<P LANG="es-ES" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0cm">
<BR>
</P>
<DIV TYPE=FOOTER>
	<h1 class='shadow' id='sublogo3'>ADMINISTRACI&Oacute;N AVANZADA Y RECUPERACI&Oacute;N</h1>
</DIV>
</BODY>
</HTML>
<?php 
}
}
mysql_close($con);
?>
