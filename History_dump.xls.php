<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT * from historia where d_fech > last_day(curdate() - interval 31 day);";
$result=mysql_query($querymain) or die(mysql_error);
$count=mysql_num_fields($result);
$names=mysql_field_name($result);
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$filename="History_dump_".date('ymd',strtotime($ayer)).".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Historia');
$worksheet->setInputEncoding('UTF-8');

// The actual data
for ($i=0;$i<$count;$i++) {
$worksheet->write(0, $i, $names[$i]);
}
$j=1;
while ($answer=mysql_fetch_row($result)) {
for ($i=0;$i<$count;$i++) {
$worksheet->write($j, $i, $answer[$i]);
}
$j++;
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
