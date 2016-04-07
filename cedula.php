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
$capt=mysql_real_escape_string($_REQUEST['capt']);
$id_cuenta=mysql_real_escape_string($_REQUEST['C_CONT']);
$tcapt=$capt;
$C_CVGE=$capt;
$querymain = "SELECT numero_de_cuenta,nombre_deudor,ejecutivo_asignado_domiciliario,pagos_vencidos,
saldo_total,saldo_vencido,saldo_cuota,
domicilio_deudor,colonia_deudor,ciudad_deudor,estado_deudor,cp_deudor,tel_1,queue,status_de_credito,productos 
FROM resumen
left join infextras on cuenta=numero_de_cuenta
left join dictamenes on dictamen=status_aarsa 
WHERE id_cuenta=".$id_cuenta.";";
$rowmain = mysql_query($querymain);
while($answer = mysql_fetch_row($rowmain)) {
$numero_de_cuenta=$answer[0];
$nombre_deudor=$answer[1];
$ejecutivo_asignado_domiciliario=$answer[2];
$pagos_vencidos=$answer[3];
$saldo_total=$answer[4];
$saldo_vencido=$answer[5];
$saldo_cuota=$answer[6];
$domicilio_deudor=$answer[7];
$colonia_deudor=$answer[8];
$ciudad_deudor=$answer[9];
$estado_deudor=$answer[10];
$cp_deudor=$answer[11];
$tel_1=$answer[12];
$queue=$answer[13];
$sdc=$answer[14];
$productos=$answer[15];
}
$querysub1 = "SELECT c_cvst FROM historia,dictamenes 
WHERE id_cuenta=".$id_cuenta." and c_visit is not null
and c_cvst=dictamen order by v_cc limit 1
;";
$rowsub1 = mysql_query($querysub1);
$querysub2 = "SELECT c_cvst FROM historia,dictamenes 
WHERE id_cuenta=".$id_cuenta." and c_visit is null
and c_cvst=dictamen order by v_cc limit 1
;";
$rowsub2 = mysql_query($querysub2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="OpenOffice.org 3.2  (Linux)">
	<META NAME="AUTHOR" CONTENT="Juridica2">
	<META NAME="CREATED" CONTENT="20110301;23110000">
	<META NAME="CHANGEDBY" CONTENT="Asesor5">
	<META NAME="CHANGED" CONTENT="20110301;23110000">
	<META NAME="AppVersion" CONTENT="12.0000">
	<META NAME="DocSecurity" CONTENT="0">
	<META NAME="HyperlinksChanged" CONTENT="false">
	<META NAME="LinksUpToDate" CONTENT="false">
	<META NAME="ScaleCrop" CONTENT="false">
	<META NAME="ShareDoc" CONTENT="false">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-left: 3cm; margin-right: 3cm; margin-top: 0.5cm; margin-bottom: 0.25cm }
		body { font-family:Verdana,Helvetica,Sans }
		P { margin-bottom: 0.21cm; direction: ltr; color: #000000; widows: 2; orphans: 2 }
	-->
	</STYLE>
</HEAD>
<BODY LANG="es-MX" TEXT="#000000" DIR="LTR">
<CENTER>
	<TABLE WIDTH=1 CELLPADDING=0 CELLSPACING=0 STYLE="page-break-before: always">
		<COL WIDTH=1>
		<TR>
			<TD WIDTH=1 STYLE="; border: none; padding: 0cm">
				<P></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=120>
		<COL WIDTH=649>
		<TR VALIGN=TOP>
			<TD WIDTH=120 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER>
<IMG SRC="cliente_logo.jpg" NAME="Imagen 2" ALIGN=BOTTOM WIDTH=104 HEIGHT=102 BORDER=0></P>
			</TD>
			<TD WIDTH=649 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=4 STYLE="font-size: 14pt"><B>CASA
				Juárez</B></FONT></FONT></FONT></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=256>
		<COL WIDTH=256>
		<COL WIDTH=256>
		<TR>
			<TD WIDTH=256 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 5pt"><B>VISITADOR:</B></FONT></FONT></FONT><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 5pt">
				<?php echo $executivo_asignado_domiciliario;?></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=256 STYLE="; border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 7pt"><B>Datos
				del cliente</B></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=256 STYLE="; border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#000000">&nbsp;</FONT></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=384>
		<COL WIDTH=385>
		<TR VALIGN=TOP>
			<TD WIDTH=384 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><img
 src="barcode_img.php?num=<?php echo(str_pad($id_cuenta,13,"0",STR_PAD_LEFT)) ?>&type=ean13&imgtype=png"
 alt="PNG: <?php echo($num) ?>" title="PNG: <?php echo($num) ?>">

</P>
			</TD>
			<TD WIDTH=385 STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=649 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=130>
						<COL WIDTH=102>
						<COL WIDTH=28>
						<COL WIDTH=64>
						<COL WIDTH=65>
						<COL WIDTH=43>
						<COL WIDTH=108>
						<COL WIDTH=109>
						<TR>
							<TD WIDTH=130 STYLE="border: none; padding: 0cm">
								<P STYLE="margin-bottom: 0cm"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 7pt"><B><?php echo $nombre_deudor;?></B></FONT></FONT></FONT></P>
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Teléfono:
								</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $tel_1; ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD COLSPAN=2 WIDTH=130 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">No.
								crédito: <BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $numero_de_cuenta; ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD COLSPAN=2 WIDTH=130 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Prioridad:
								<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $productos;?></B></FONT></FONT></FONT></P>
							</TD>
							<TD COLSPAN=3 WIDTH=260 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Pagos
								vencidos:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $pagos_vencidos;?></B></FONT></FONT></FONT></P>
							</TD>
						</TR>
						<TR>
							<TD COLSPAN=2 WIDTH=231 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 4" ALIGN=BOTTOM WIDTH=1 HEIGHT=8 BORDER=0></P>
							</TD>
							<TD COLSPAN=2 WIDTH=92 STYLE="border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
							<TD COLSPAN=2 WIDTH=108 STYLE="border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
							<TD WIDTH=108 STYLE="border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
							<TD WIDTH=109 STYLE="border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P ALIGN=CENTER STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
				<CENTER>
					<TABLE WIDTH=649 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=100>
						<COL WIDTH=100>
						<COL WIDTH=100>
						<COL WIDTH=117>
						<COL WIDTH=116>
						<COL WIDTH=116>
						<TR>
							<TD WIDTH=100 STYLE="border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Saldo
								total:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>$
								<?php echo number_format($saldo_total,2); ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=100 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Saldo
								vencido:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>$
								<?php echo number_format($saldo_vencido,2); ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=100 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Min.
								Pagar:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo number_format($saldo_cuota,0); ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=117 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Cliente:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=116 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Estatus:
								<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $queue;?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=116 STYLE="; border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Subproducto:
								<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $sdc;?></B></FONT></FONT></FONT></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P ALIGN=CENTER STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0cm; line-height: 100%"><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 7pt"><B>Datos
demográficos del cliente</B></FONT></FONT></FONT></P>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=128>
		<COL WIDTH=128>
		<COL WIDTH=128>
		<COL WIDTH=75>
		<COL WIDTH=53>
		<COL WIDTH=97>
		<COL WIDTH=140>
		<COL WIDTH=10>
		<COL WIDTH=2>
		<COL WIDTH=8>
		<TR>
			<TD COLSPAN=10 WIDTH=769 VALIGN=TOP STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 5" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Calle:
				</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">
<B><?php echo $domicilio_deudor; ?></B></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Plano:
				</FONT></FONT></FONT>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Cuadrante:
				</FONT></FONT></FONT>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=385 STYLE="; border: none; padding: 0cm">
				<P>&nbsp;</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 6" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
			</TD>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=385 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=459 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=80>
						<COL WIDTH=379>
						<TR>
							<TD WIDTH=80 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Entre
								Calles: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=379 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=9 WIDTH=641 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=300 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=300>
						<TR>
							<TD WIDTH=300 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Colonia:
								</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $colonia_deudor; ?></B></FONT></FONT></FONT></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 7" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=256 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=761 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=759 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=200>
						<COL WIDTH=110>
						<COL WIDTH=80>
						<COL WIDTH=75>
						<COL WIDTH=120>
						<COL WIDTH=75>
						<COL WIDTH=90>
						<COL WIDTH=9>
						<TR>
							<TD WIDTH=200 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Municipio:
								</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $ciudad_deudor; ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=110 STYLE="; border: none; padding: 0cm">
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Entidad:
								</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $estado_deudor; ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=80 STYLE="; border: none; padding: 0cm">
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">C.
								P.: </FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B><?php echo $cp_deudor; ?></B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=75 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 8" ALIGN=BOTTOM WIDTH=75 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=120 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Localización
								fecha: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=75 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 9" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0><FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>/</B></FONT></FONT><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 10" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0><FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>/</B></FONT></FONT><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 11" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=0 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Hora:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=90 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 12" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0><FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>:</B></FONT></FONT><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 13" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=9 STYLE="border: none; padding: 0cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=8 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=460 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 14" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD COLSPAN=2 WIDTH=150 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=140 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=9 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=769>
		<TR>
			<TD WIDTH=769 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 7pt"><B>Datos
				demográficos del domicilio laboral o alterno</B></FONT></FONT></FONT></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=128>
		<COL WIDTH=128>
		<COL WIDTH=128>
		<COL WIDTH=75>
		<COL WIDTH=53>
		<COL WIDTH=97>
		<COL WIDTH=140>
		<COL WIDTH=10>
		<COL WIDTH=2>
		<COL WIDTH=8>
		<TR>
			<TD COLSPAN=10 WIDTH=769 VALIGN=TOP STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 15" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Calle:
				</FONT></FONT></FONT>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Plano:
				</FONT></FONT></FONT>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Cuadrante:
				</FONT></FONT></FONT>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=385 STYLE="; border: none; padding: 0cm">
				<P>&nbsp;</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 16" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
			</TD>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=385 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=459 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=80>
						<COL WIDTH=379>
						<TR>
							<TD WIDTH=80 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Entre
								Calles: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=379 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=9 WIDTH=641 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=300 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=300>
						<TR>
							<TD WIDTH=300 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Colonia:
								</FONT></FONT></FONT>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 17" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=128 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=256 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=761 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=759 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=200>
						<COL WIDTH=110>
						<COL WIDTH=80>
						<COL WIDTH=75>
						<COL WIDTH=120>
						<COL WIDTH=75>
						<COL WIDTH=90>
						<COL WIDTH=9>
						<TR>
							<TD WIDTH=200 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Municipio:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=110 STYLE="; border: none; padding: 0cm">
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Entidad:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=80 STYLE="; border: none; padding: 0cm">
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">C.
								P.: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=75 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 18" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=75 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=120 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Localización
								fecha: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=75 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 19" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0><FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>/</B></FONT></FONT><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 20" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0><FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>/</B></FONT></FONT><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 21" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=0 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Hora:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=90 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 22" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0><FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>:</B></FONT></FONT><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 23" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=20 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=9 STYLE="border: none; padding: 0cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=8 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=460 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 24" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD COLSPAN=2 WIDTH=150 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=140 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=9 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=769>
		<TR>
			<TD WIDTH=769 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 7pt"><B>Datos
				visita mes anterior del cliente</B></FONT></FONT></FONT></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=250>
		<COL WIDTH=250>
		<COL WIDTH=130>
		<COL WIDTH=130>
		<COL WIDTH=10>
		<TR>
			<TD COLSPAN=5 WIDTH=769 VALIGN=TOP STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 25" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=250 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Cod/Result/Visita:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>NOTIFICACION
				BAJO PUERTA</B></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=250 STYLE="; border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Cod/Result/Telefonía:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>NO
				CONTESTAN</B></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=130 STYLE="; border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Promesa
				rota:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>NO</B></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=130 STYLE="; border: none; padding: 0cm">
				<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Importe
				P/Rota:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>$
				0.00</B></FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
				<P>&nbsp;</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=250 STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 26" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=250 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD WIDTH=130 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD WIDTH=130 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
			<TD WIDTH=10 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=769>
		<TR>
			<TD WIDTH=769 STYLE="border: none; padding: 0cm">
				<P ALIGN=CENTER><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 27" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=14 BORDER=0></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=770 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=758>
		<COL WIDTH=11>
		<TR>
			<TD COLSPAN=2 WIDTH=770 VALIGN=TOP STYLE="border: none; padding: 0cm">
				<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 28" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=RHS RULES=GROUPS>
						<COLGROUP>
							<COL WIDTH=135>
							<COL WIDTH=31>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=30>
							<COL WIDTH=36>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=70>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=35>
							<COL WIDTH=46>
							<COL WIDTH=46>
							<COL WIDTH=44>
							<COL WIDTH=78>
							<COL WIDTH=64>
							<COL WIDTH=86>
							<COL WIDTH=56>
						</COLGROUP>
						<TR>
							<TD WIDTH=135 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Nivel
								socioeconómico: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=0 STYLE="; border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Bajo</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=31 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 29" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=30 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Alto</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 30" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=36 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Medio</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=70 STYLE="; border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Vive
								en:&nbsp;</FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=35 STYLE="; border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Casa</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 31" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=46 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Depto</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 32" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=46 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Propio</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 33" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=44 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Renta</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 34" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=78 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Invasión</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 35" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=64 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Abandonada</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 36" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=86 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Vive
								con FAM</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 37" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=56 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Traspaso</B></FONT></FONT></FONT></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 38" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=10 HEIGHT=1 BORDER=0></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 39" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=131>
						<COL WIDTH=81>
						<COL WIDTH=111>
						<COL WIDTH=101>
						<COL WIDTH=333>
						<TR>
							<TD WIDTH=131 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>CARACTERÍSTICAS:
								</B></FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=81 STYLE="; border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Pta.
								Color: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=111 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P>&nbsp;</P>
							</TD>
							<TD WIDTH=101 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Característica:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=333 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 40" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=GROUPS>
						<COLGROUP>
							<COL WIDTH=150>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=90>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=10>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=90>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=100>
							<COL WIDTH=128>
							<COL WIDTH=72>
							<COL WIDTH=117>
						</COLGROUP>
						<TR>
							<TD WIDTH=150 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 41" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=150 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=90 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Planta
								Baja</FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 42" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=10 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=90 STYLE="border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Planta
								Alta</FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=100 STYLE="; border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Piso
								Número: </FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=128 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 43" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=72 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Color:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=117 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 44" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 45" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=GROUPS>
						<COLGROUP>
							<COL WIDTH=100>
							<COL WIDTH=50>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=150>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=50>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=150>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=68>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=132>
						</COLGROUP>
						<COLGROUP>
							<COL WIDTH=57>
						</COLGROUP>
						<TR>
							<TD WIDTH=100 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>MEDIDORES:</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=50 STYLE="; border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Luz:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=150 STYLE="; border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 46" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=15 BORDER=0></P>
							</TD>
							<TD WIDTH=50 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Agua:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=150 STYLE="; border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 47" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=15 BORDER=0></P>
							</TD>
							<TD WIDTH=68 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Gas:
								</FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=132 STYLE="; border: 1px solid #000001; padding: 0cm">
								<P ALIGN=CENTER><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 48" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=15 BORDER=0></P>
							</TD>
							<TD WIDTH=57 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 49" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 50" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=110>
						<COL WIDTH=647>
						<TR>
							<TD WIDTH=110 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Motivo
								de atraso: </B></FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=647 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 51" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=15 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 52" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=600>
						<COL WIDTH=157>
						<TR>
							<TD WIDTH=600 STYLE="border: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>RESULTADO
								DE LA VISITA Y DATOS ALTERNOS: </B></FONT></FONT></FONT>
								</P>
							</TD>
							<TD WIDTH=157 STYLE="; border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 53" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=1 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 54" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=5 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=752 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 55" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 56" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=5 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=752 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 57" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 58" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=5 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=752 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 59" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 60" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=5 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=752 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 61" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 62" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=5 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=752 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 63" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 64" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=5 HEIGHT=1 BORDER=0></P>
							</TD>
							<TD WIDTH=752 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 65" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 66" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=200>
						<COL WIDTH=557>
						<TR>
							<TD WIDTH=200 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Presenta
								comprobante de pago: &nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 67" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 68" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=200>
						<COL WIDTH=557>
						<TR>
							<TD WIDTH=200 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Nuevo
								domicilio del deudor: &nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 69" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 70" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=200>
						<COL WIDTH=557>
						<TR>
							<TD WIDTH=200 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>NOTIFICACIÓN
								CON: &nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 71" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 72" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=200>
						<COL WIDTH=557>
						<TR>
							<TD WIDTH=200 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>TELÉFONOS
								ALTERNOS: &nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 73" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=13 BORDER=0></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 74" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=11 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 75" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=10 BORDER=0></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0cm; line-height: 100%"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>CROQUIS:
</B></FONT></FONT></FONT>
</P>
<CENTER>
	<TABLE WIDTH=399 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=199>
		<COL WIDTH=200>
		<TR>
			<TD COLSPAN=2 WIDTH=399 STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=366 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=125>
						<COL WIDTH=100>
						<COL WIDTH=60>
						<COL WIDTH=80>
						<COL WIDTH=1>
						<TR>
							<TD WIDTH=125 STYLE="border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>GESTIÓN
								FECHA: &nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=100 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 8pt"><B>/
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=60 STYLE="; border: none; padding: 0cm">
								<P ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>HORA:
								&nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=80 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><FONT COLOR="#262626">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 8pt"><B>:
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=1 STYLE="; border: none; padding: 0cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" NAME="Imagen 76" ALT="mhtml:file://C:\Documents%20and%20Settings\Juridica2\Escritorio\CEDULA.mht!http://173.193.78.140/~gutierre/TableEditor/TEditorSkins/Light/space.gif" ALIGN=BOTTOM WIDTH=1 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD WIDTH=200 STYLE="border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Casa
				abandonada</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Casa
				deshabitada</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Notificación
				personal</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Mensaje
				con familiar</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Mensaje
				con empleado</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Mensaje
				con tercero</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Notificación
				sin contacto</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Cliente
				no vive en domicilio</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Domicilio
				no existe</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Núm.
				incorrecto o inexistente</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Promesa
				de pago</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Fecha
				promesa de pago</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=150 CELLPADDING=0 CELLSPACING=0 FRAME=BELOW>
						<COL WIDTH=150>
						<TR>
							<TD WIDTH=150 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 8pt">$
								</FONT></FONT></FONT>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<TABLE WIDTH=150 CELLPADDING=0 CELLSPACING=0 FRAME=BELOW>
					<COL WIDTH=150>
					<TR>
						<TD WIDTH=150 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
							<P><FONT COLOR="#262626">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 8pt">/
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT></FONT></FONT></P>
						</TD>
					</TR>
				</TABLE>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><IMG SRC="CEDULA_html_ma390a6f.gif" ALIGN=LEFT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Presenta
				pago</FONT></FONT></FONT></P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">Fecha
				de pago</FONT></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=150 CELLPADDING=0 CELLSPACING=0 FRAME=BELOW>
						<COL WIDTH=150>
						<TR>
							<TD WIDTH=150 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
								<P><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 8pt">$
								</FONT></FONT></FONT>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<TABLE WIDTH=150 CELLPADDING=0 CELLSPACING=0 FRAME=BELOW>
					<COL WIDTH=150>
					<TR>
						<TD WIDTH=150 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
							<P><FONT COLOR="#262626">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 8pt">/
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT></FONT></FONT></P>
						</TD>
					</TR>
				</TABLE>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=199 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=200 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=2 WIDTH=399 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=399 CELLPADDING=5 CELLSPACING=0 FRAME=VOID RULES=NONE>
						<COL WIDTH=169>
						<COL WIDTH=12>
						<COL WIDTH=189>
						<TR>
							<TD WIDTH=169 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding-top: 0cm; padding-bottom: 0.13cm; padding-left: 0cm; padding-right: 0cm">
								<P>&nbsp;</P>
							</TD>
							<TD WIDTH=12 STYLE="border: none; padding: 0cm">
								<P>&nbsp;</P>
							</TD>
							<TD WIDTH=189 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding-top: 0cm; padding-bottom: 0.13cm; padding-left: 0cm; padding-right: 0cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
						<TR>
							<TD WIDTH=169 VALIGN=TOP STYLE="border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Firma
								de gestor</B></FONT></FONT></FONT></P>
							</TD>
							<TD WIDTH=12 STYLE="; border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
							<TD WIDTH=189 VALIGN=TOP STYLE="border: none; padding: 0cm">
								<P ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Nombre
								/Firma de quién recibe</B></FONT></FONT></FONT></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=369 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=369>
		<TR>
			<TD WIDTH=369 VALIGN=TOP STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=366 CELLPADDING=15 CELLSPACING=0>
						<COL WIDTH=91>
						<COL WIDTH=0>
						<COL WIDTH=87>
						<COL WIDTH=0>
						<COL WIDTH=91>
						<TR>
							<TD WIDTH=91 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
							<TD COLSPAN=3 WIDTH=92 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
							<TD WIDTH=91 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
						<TR>
							<TD COLSPAN=2 WIDTH=93 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
							<TD WIDTH=87 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
							<TD COLSPAN=2 WIDTH=94 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
						<TR>
							<TD COLSPAN=2 WIDTH=93 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
							<TD WIDTH=87 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
							<TD COLSPAN=2 WIDTH=94 STYLE="border: 1px solid #000001; padding: 0.4cm">
								<P>&nbsp;</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</P>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
		<COL WIDTH=759>
		<COL WIDTH=10>
		<TR>
			<TD COLSPAN=2 WIDTH=769 STYLE="border: none; padding: 0cm">
				<P><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=759 STYLE="border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
							<TD WIDTH=752 STYLE="border: none; padding: 0cm">
								<P STYLE="margin-top: 0.05cm"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt"><B>Domicilio:
								Av. Juarez cruz con Av. Las Torres, Centro Comercial Sun Mall
								VIP, Juarez, Nuevo León. <BR>Teléfono(s): (81) 47372200 de
								Lunes a Viernes de 09:00 a 19:00 horas; Sábado de 09:00 a
								15:00 horas. <BR>01 800 227 26 73 Horario: 07:00 a 22:00
								horas de Lunes a Viernes; Sábado: 08:00 a 20:00 horas;
								Domingo: 08:00 a 15:00 horas</B></FONT></FONT></FONT></P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=759 STYLE="; border: none; padding: 0cm">
				<CENTER>
					<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0>
						<COL WIDTH=5>
						<COL WIDTH=752>
						<TR>
							<TD WIDTH=5 STYLE="border: none; padding: 0cm">
								<P><BR>
								</P>
							</TD>
							<TD WIDTH=752 STYLE="border: none; padding: 0cm">
								<P ALIGN=JUSTIFY STYLE="margin-top: 0.05cm"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=1 STYLE="font-size: 6pt">El
								portador de esta notificación no esta autorizado a recibir
								pagos en efectivo ó en especie alguna, propinas, dadivas, ó
								regalos ya que sus servicios son totalmente gratuitos. </FONT></FONT></FONT>
								</P>
							</TD>
						</TR>
					</TABLE>
				</CENTER>
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
			<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
				<P STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
				</P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<P STYLE="margin-bottom: 0.35cm"><BR><BR>
</P>
</BODY>
</HTML>
<?php
mysql_close();
?>
