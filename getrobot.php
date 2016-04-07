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
JOIN cobra4.rlook on id=numero_de_cuenta
WHERE  ".$field." REGEXP '".$find."' ORDER BY ".$field." LIMIT 10;";
$result=mysql_query($query);
while ($row=mysql_fetch_row($result)) {
    $qfind=htmlentities($row[0]);
    echo '<a href="callfileedit.php?'.$field.'='.$qfind.'&capt='.$capt.'">'.$row[0].'</a><br>';
    }
}
}
}
mysql_close()
?>
