<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$tcapt=$capt;
$C_CVGE=$capt;
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
@page { margin-left: 3cm; margin-right: 3cm; margin-top: 2cm; margin-bottom: 0.25cm }
body { font-family:Verdana,Helvetica,Sans; margin: 0; padding: 0 }
.breakhere {page-break-before: always}
TABLE { border: 1pt black solid }
.squeeze TR TD { font-size:75%; }
.barcode { width:110%; }
	-->
	</STYLE>
</HEAD>
<BODY LANG="es-MX" TEXT="#000000" DIR="LTR" onLoad="window.print();">
<p>&nbsp;</p>
<?php
$querylist="select id_cuenta from cedulas,resumen 
where numero_de_cuenta=id;";
$rowlist=mysql_query($querylist);
while($answerlist = mysql_fetch_row($rowlist)) {
$id_cuenta=$answerlist[0];
$querymain = "SELECT numero_de_cuenta,nombre_deudor,ejecutivo_asignado_domiciliario,pagos_vencidos,
saldo_total,saldo_vencido,saldo_cuota,
domicilio_deudor,colonia_deudor,ciudad_deudor,estado_deudor,cp_deudor,tel_1,queue,status_de_credito,productos,
domicilio_laboral,colonia_laboral,ciudad_laboral,estado_laboral,cp_laboral 
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
$domicilio_laboral=$answer[16];
$colonia_laboral=$answer[17];
$ciudad_laboral=$answer[18];
$estado_laboral=$answer[19];
$cp_laboral=$answer[20];
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
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=120>
<COL WIDTH=649>
<TR VALIGN=TOP>
	<TD WIDTH=120 STYLE="border: none; padding: 0cm">
<DIV ALIGN=CENTER>
<IMG SRC="cliente_logo.jpg" NAME="Imagen 2" ALIGN=BOTTOM WIDTH=76 HEIGHT=76 BORDER=0></DIV>
	</TD>
	<TD WIDTH=649 STYLE="border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=4 STYLE="font-size: 14pt"><B>CASA
Juárez</B></FONT></FONT></FONT></DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
<DIV style="text-align:center"><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 5pt"><B>VISITADOR:</B></FONT></FONT></FONT><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 5pt"><?php echo $executivo_asignado_domiciliario;?></FONT></FONT></FONT>
	</div>
	<div style="text-align:CENTER"><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 7pt"><B>Datos del cliente</B></FONT></FONT></FONT></DIV>
	</div>
</CENTER>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=384>
<COL WIDTH=385>
<TR VALIGN=TOP>
	<TD WIDTH=499 STYLE="border: none; padding: 0cm">
<DIV ALIGN=CENTER><img class='barcode'
 src="barcode_img.php?num=<?php echo(str_pad($id_cuenta,12,"0",STR_PAD_LEFT)) ?>&type=code128&imgtype=png"
 alt="PNG: <?php echo($num) ?>" title="PNG: <?php echo($num) ?>" width=187 height=80>

</DIV>
	</TD>
	<TD WIDTH=320 STYLE="border: none; padding: 0cm">
<CENTER>
	<TABLE WIDTH=599 CELLPADDING=0 CELLSPACING=0>
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
								<P STYLE="margin-bottom: 0cm"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 7pt"><B><?php echo $nombre_deudor;?></B></FONT></FONT></FONT></P>
								<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Teléfono:
</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $tel_1; ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD COLSPAN=2 WIDTH=130 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">No.
crédito: <BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $numero_de_cuenta; ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD COLSPAN=2 WIDTH=130 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Prioridad:
<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $productos;?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD COLSPAN=3 WIDTH=260 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Pagos
vencidos:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $pagos_vencidos;?></B></FONT></FONT></FONT></DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
<DIV ALIGN=CENTER STYLE="margin-bottom: 0cm; line-height: 100%"><BR>
</DIV>
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
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Saldo
total:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>$
<?php echo number_format($saldo_total,2); ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=100 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Saldo
vencido:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>$
<?php echo number_format($saldo_vencido,2); ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=100 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Min.
Pagar:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo number_format($saldo_cuota,0); ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=117 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Cliente:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=116 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Estatus:
<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $queue;?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=116 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Subproducto:
<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $sdc;?></B></FONT></FONT></FONT></DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
</TR>
	</TABLE>
</CENTER>
<CENTER>
<FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">
<table summary="sdh extras">
<tr>
<th>Producto</th>
<th>ROA</th>
<th>MONTO ROA</th>
<th>REA</th>
<th>MONTO REA</th>
</tr>
<?php
$numprod=0;
$queryextra="SELECT cuenta,productos,
prod1,roa1,rea1,
prod2,roa2,rea2,
prod3,roa3,rea3,
prod4,roa4,rea4,
prod5,roa5,rea5,
prod6,roa6,rea6,
prod7,roa7,rea7,
prod8,roa8,rea8,
prod9,roa9,rea9,
prod10,roa10,rea10
 FROM infextras 
where cuenta='".$numero_de_cuenta."';";
$resultextra=mysql_query($queryextra);
while ($answerextra=mysql_fetch_row($resultextra))
{
$numprod=$answerextra[1];
for ($ex=0;$ex<$numprod;$ex++) {
	$a=$ex*3+2;
	$b=$ex*3+3;
	$c=$ex*3+4;
	?>
<tr>
<td><?php echo $answerextra[$a];?></td>
<td><?php echo $answerextra[$b];?></td>
<td><?php echo number_format($answerextra[$b]*59.83,2);?></td>
<td><?php echo $answerextra[$c];?></td>
<td><?php echo number_format($answerextra[$c]*59.83,2);?></td>
</tr>
<?php
}};
$prods=trim($prods," ,");
?>
</table>
</font></font></font>
</CENTER>
<DIV ALIGN=CENTER STYLE="margin-bottom: 0cm; line-height: 100%"><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 7pt"><B>Datos demográficos del cliente</B></FONT></FONT></FONT></DIV>
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
<TR VALIGN=TOP>
	<TD WIDTH=128 STYLE="border: none; padding: 0cm">
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Calle:
</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">
<B><?php echo $domicilio_deudor; ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Plano:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Cuadrante:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD COLSPAN=7 WIDTH=385 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Entre
Calles: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=379 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV><BR>
</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD COLSPAN=9 WIDTH=641 STYLE="; border: none; padding: 0cm">
<CENTER>
	<TABLE WIDTH=300 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=300>
<TR>
	<TD WIDTH=300 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Colonia:
</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $colonia_deudor; ?></B></FONT></FONT></FONT></DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Municipio:
</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $ciudad_deudor; ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=110 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Entidad:
</FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $estado_deudor; ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=80 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">C.
P.: </FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B><?php echo $cp_deudor; ?></B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=75 STYLE="; border: none; padding: 0cm">
	
	</TD>
	<TD WIDTH=120 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Localización
fecha: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=75 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
	</TD>
	<TD WIDTH=0 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Hora:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=90 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm"></TD>
	<TD WIDTH=9 STYLE="border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=8 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
<CENTER>
<DIV style="text-align:center"><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 7pt"><B>Datos demográficos del domicilio laboral o alterno</B></FONT></FONT></FONT></DIV>
</CENTER>
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
<DIV>&nbsp;</DIV>
	</TD>
</TR>
<TR VALIGN=TOP>
	<TD WIDTH=128 STYLE="border: none; padding: 0cm">
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Calle:
</FONT></FONT></FONT><?php echo $domicilio_laboral;?>
</DIV>
	</TD>
	<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Plano:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=128 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Cuadrante:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD COLSPAN=7 WIDTH=385 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Entre
Calles: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=379 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV><BR>
</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD COLSPAN=9 WIDTH=641 STYLE="; border: none; padding: 0cm">
<CENTER>
	<TABLE WIDTH=300 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=300>
<TR>
	<TD WIDTH=300 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Colonia:
</FONT></FONT></FONT><?php echo $colonia_laboral;?>
</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Municipio:
</FONT></FONT></FONT><?php echo $ciudad_laboral;?>
</DIV>
	</TD>
	<TD WIDTH=110 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Entidad:
</FONT></FONT></FONT><?php echo $estado_laboral;?>
</DIV>
	</TD>
	<TD WIDTH=80 STYLE="; border: none; padding: 0cm">
<DIV><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">C.P.: </FONT></FONT></FONT><?php echo $cp_laboral;?>
</DIV>
	</TD>
	<TD WIDTH=75 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=120 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Localización fecha: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=75 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;<FONT FACE="Times New Roman, sans"><FONT SIZE=2 STYLE="font-size: 10pt"><B>/</B></FONT></FONT>&nbsp;</DIV>
	</TD>
	<TD WIDTH=0 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Hora:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=90 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=9 STYLE="border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=8 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
<CENTER>
<DIV ALIGN=CENTER><FONT COLOR="#000000"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 7pt"><B>Datos visita mes anterior del cliente</B></FONT></FONT></FONT></DIV>
</CENTER>
<CENTER>
	<TABLE WIDTH=769 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=250>
<COL WIDTH=250>
<COL WIDTH=130>
<COL WIDTH=130>
<COL WIDTH=10>
<TR VALIGN=TOP>
	<TD WIDTH=250 STYLE="border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Cod/Result/Visita:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>NOTIFICACION
BAJO PUERTA</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=250 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Cod/Result/Telefonía:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>NO
CONTESTAN</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=130 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Promesa rota:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>NO</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=130 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Importe P/Rota:<BR></FONT></FONT></FONT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>$
0.00</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
<CENTER>
	<TABLE WIDTH=770 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=758>
<COL WIDTH=11>
<TR>
	<TD COLSPAN=2 WIDTH=770 VALIGN=TOP STYLE="border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Nivel socioeconómico: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Bajo</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=31 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=30 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Alto</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=36 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Medio</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=70 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Vive
en:&nbsp;</FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=35 STYLE="; border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Casa</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=46 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Depto</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=46 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Propio</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=44 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Renta</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=78 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Invasión</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</div>	</TD>
	<TD WIDTH=64 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Abandonada</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=86 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Vive
con FAM</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=0 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=56 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Traspaso</B></FONT></FONT></FONT></DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>CARACTERÍSTICAS:
</B></FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=81 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Pta.
Color: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=111 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=101 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Característica:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=333 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
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
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=90 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Planta
Baja</FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=90 STYLE="border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Planta
Alta</FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=100 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Piso
Número: </FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=128 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
	<TD WIDTH=72 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Color:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=117 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>MEDIDORES:</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=50 STYLE="; border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Luz:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=150 STYLE="; border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER>&nbsp;</DIV>
	</TD>
	<TD WIDTH=50 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Agua:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=150 STYLE="; border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER>&nbsp;</DIV>
	</TD>
	<TD WIDTH=68 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">Gas:
</FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=132 STYLE="; border: 1px solid #000001; padding: 0cm">
<DIV ALIGN=CENTER>&nbsp;</DIV>
	</TD>
	<TD WIDTH=57 STYLE="border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
	</TD>
</TR>
<TR VALIGN=TOP>
	<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
	<TD WIDTH=11 STYLE="border: none; padding: 0cm">
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Motivo
de atraso: </B></FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=647 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
	</TD>
</TR>
<TR VALIGN=TOP>
	<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
	<TD WIDTH=11 STYLE="border: none; padding: 0cm">
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
<DIV><FONT COLOR="#262626">&nbsp;<FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>RESULTADO
DE LA VISITA Y DATOS ALTERNOS: </B></FONT></FONT></FONT>
</DIV>
	</TD>
	<TD WIDTH=157 STYLE="; border: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
<tr><td colspan=2><DIV>&nbsp;</DIV></td></tr>
<tr><td colspan=2><DIV>&nbsp;</DIV></td></tr>
<tr style="border-top:1pt solid black"><td colspan=2 style="border-top:1pt solid black"><DIV>&nbsp;</DIV></td></tr>
<tr><td colspan=2><DIV>&nbsp;</DIV></td></tr>
<tr><td colspan=2><DIV>&nbsp;</DIV></td></tr>
<tr style="border-top:1pt solid black"><td colspan=2 style="border-top:1pt solid black"><DIV>&nbsp;</DIV></td></tr>
<tr><td colspan=2><DIV>&nbsp;</DIV></td></tr>
<tr><td colspan=2><DIV>&nbsp;</DIV></td></tr>
	</TABLE>
</CENTER>
<CENTER>
	<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
<COL WIDTH=200>
<COL WIDTH=557>
<TR>
	<TD WIDTH=200 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Presenta
comprobante de pago: &nbsp;</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
<CENTER>
	<TABLE WIDTH=757 CELLPADDING=0 CELLSPACING=0 FRAME=VOID RULES=NONE>
<COL WIDTH=200>
<COL WIDTH=557>
<TR>
	<TD WIDTH=200 STYLE="border: none; padding: 0cm">
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>Nuevo
domicilio del deudor: &nbsp;</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
	</TD>
</TR>
<TR VALIGN=TOP>
	<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
	<TD WIDTH=11 STYLE="border: none; padding: 0cm">
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
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>NOTIFICACIÓN
CON: &nbsp;</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
	</TD>
</TR>
<TR VALIGN=TOP>
	<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
	<TD WIDTH=11 STYLE="border: none; padding: 0cm">
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
<DIV ALIGN=RIGHT><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt"><B>TELÉFONOS
ALTERNOS: &nbsp;</B></FONT></FONT></FONT></DIV>
	</TD>
	<TD WIDTH=557 STYLE="; border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0cm">
<DIV>&nbsp;</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=11 STYLE="; border: none; padding: 0cm">
	</TD>
</TR>
<TR VALIGN=TOP>
	<TD WIDTH=758 STYLE="; border: none; padding: 0cm">
<DIV STYLE="margin-bottom: 0cm; line-height: 100%">&nbsp;</DIV>
	</TD>
	<TD WIDTH=11 STYLE="border: none; padding: 0cm">
	</TD>
</TR>
	</TABLE>
</CENTER>
<TABLE class='squeeze' FRAME=VOID CELLSPACING=0 COLS=15 RULES=NONE BORDER=0>
	<COLGROUP><COL WIDTH=15><COL WIDTH=127><COL WIDTH=86><COL WIDTH=12><COL WIDTH=86><COL WIDTH=39><COL WIDTH=86><COL WIDTH=31><COL WIDTH=86><COL WIDTH=31><COL WIDTH=86><COL WIDTH=28><COL WIDTH=86><COL WIDTH=86><COL WIDTH=86></COLGROUP>
	<TBODY>
		<TR>
			<TD COLSPAN=2 WIDTH=142 HEIGHT=17 ALIGN=LEFT><B><FONT FACE="Verdana,sans" COLOR="#262626">CROQUIS: </FONT></B></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=12 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=39 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=31 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=31 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=28 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
			<TD WIDTH=86 ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=2 HEIGHT=17 ALIGN=LEFT><B><FONT FACE="Verdana,sans" COLOR="#262626">GESTIÓN FECHA: &nbsp; </FONT></B></TD>
			<TD ALIGN=CENTER><FONT FACE="Liberation Serif" COLOR="#262626">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </FONT></TD>
			<TD COLSPAN=3 ALIGN=CENTER><B><FONT FACE="Verdana,sans" COLOR="#262626">HORA: &nbsp;  ____:____</FONT></B></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000" ALIGN=CENTER><FONT FACE="Liberation Serif" COLOR="#262626"><BR></FONT></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=CENTER><FONT FACE="Liberation Serif" COLOR="#262626">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </FONT></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=CENTER><FONT FACE="Liberation Serif">&nbsp; </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Casa abandonada </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626"><BR></FONT></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Casa deshabitada </FONT></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Notificación personal </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Mensaje con familiar </FONT></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=17 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Mensaje con empleado </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Mensaje con tercero </FONT></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=22 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Notificación sin contacto </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Cliente no vive en domicilio </FONT></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" HEIGHT=22 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Domicilio no existe </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Núm. incorrecto o inexistente </FONT></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=2 HEIGHT=22 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Promesa de pago </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Fecha promesa de pago </FONT></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=2 HEIGHT=32 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">$____________</FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Liberation Serif" COLOR="#262626">____/____/____</FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=2 HEIGHT=17 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Presenta pago </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">Fecha de pago </FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-left: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD STYLE="border-right: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=2 HEIGHT=17 ALIGN=LEFT><FONT FACE="Verdana,sans" COLOR="#262626">$____________</FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=LEFT><FONT FACE="Liberation Serif" COLOR="#262626">____/____/____</FONT></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD STYLE="border-top: 1px solid #000000" ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=3 HEIGHT=17 ALIGN=LEFT><FONT FACE="Liberation Serif">_______________</FONT></TD>
			<TD ALIGN=CENTER><FONT FACE="Liberation Serif">&nbsp; </FONT></TD>
			<TD COLSPAN=3 ALIGN=CENTER><FONT FACE="Liberation Serif">_______________</FONT></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD COLSPAN=3 HEIGHT=17 ALIGN=LEFT VALIGN=TOP><B><FONT FACE="Verdana,sans" COLOR="#262626">Firma de gestor </FONT></B></TD>
			<TD ALIGN=CENTER><FONT FACE="Liberation Serif"><BR></FONT></TD>
			<TD COLSPAN=3 ALIGN=CENTER VALIGN=TOP><B><FONT FACE="Verdana,sans" COLOR="#262626">Nombre /Firma de quién recibe </FONT></B></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD HEIGHT=17 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD COLSPAN=2 ALIGN=CENTER><FONT FACE="Liberation Serif">&nbsp; </FONT></TD>
			<TD COLSPAN=4 ALIGN=CENTER><FONT FACE="Liberation Serif">&nbsp; </FONT></TD>
			<TD ALIGN=CENTER><FONT FACE="Liberation Serif">&nbsp; </FONT></TD>
		</TR>
	</TBODY>
</TABLE>

	<TD WIDTH=752 STYLE="border: none; padding: 0cm">
<DIV ALIGN=JUSTIFY STYLE="margin-top: 0.05cm"><FONT COLOR="#262626"><FONT FACE="Verdana, sans"><FONT SIZE=2 STYLE="font-size: 6pt">El
portador de esta notificación no esta autorizado a recibir
pagos en efectivo ó en especie alguna, propinas, dadivas, ó
regalos ya que sus servicios son totalmente gratuitos. </FONT></FONT></FONT>
</DIV>
	</TD>
</TR>
	</TABLE>
</CENTER>
	</TD>
	<TD WIDTH=10 STYLE="; border: none; padding: 0cm">
	</TD>
</TR>
	</TABLE>
</CENTER>
<DIV class="breakhere" STYLE="margin-bottom: 0.35cm"><BR><BR>
</DIV>
<?php
}
mysql_close();
?>
</BODY>
</HTML>

