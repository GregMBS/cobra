<?php  
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (!empty($_REQUEST['field'])) {
$field=mysql_real_escape_string($_REQUEST['field']);
$qfield="'".$field."'";
$find=mysql_real_escape_string($_REQUEST['find']);

$query="SELECT distinct ".$field." FROM robot.calllist 
JOIN cobra.resumen on id=numero_de_cuenta
WHERE  ".$field." LIKE '".$find."%' LIMIT 10;";
$result=mysql_query($query);
echo "<xml>";
while ($row=mysql_fetch_row($result)) {
    $qfind="'".$row[0]."'";
    echo "<field>".$row[0]."</field>";
    }
echo "</xml>";
}
}
}
mysql_close()
?>
