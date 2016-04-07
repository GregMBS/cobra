<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$querymain="select id_cuenta from resumen where status_de_credito not like '%o' 
and status_aarsa='ILOCALIZABLE TELEFONICO';";
$resultmain=mysql_query($querymain) or die(mysql_error());
$queryupd='';
while ($row=mysql_fetch_row($resultmain)) {
$querynew="select c_cvst from historia,dictamenes where dictamen=c_cvst
and c_msge is null and c_cvge<>'Milt' and c_cniv is null
and c_cont=".$row[0]." 
order by v_cc limit 1;";
$resultnew=mysql_query($querynew) or die(mysql_error());
while ($rownew=mysql_fetch_row($resultnew)) {
$queryupd=$queryupd."update resumen set status_aarsa='".$rownew[0]."' where id_cuenta='".$row[0]."';<br>";
}
}
die($queryupd);
