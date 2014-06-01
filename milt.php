<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "4sale";
$dbname = "robot";
$output = array();
try {
    $dbh = new PDO("mysql:".$dbname.":".$dbhost,$dbuser,$dbpass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die(json_encode(''));
}

$q0 = "SELECT distinct auto, msg, lineas FROM robot.msglist;";
try {
    $sth = $dbh->query($q0);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
}
$result0 = $sth->fetchAll();
foreach ($result0 as $row0) {

$msg=$row0['msg'];
$lim=$row0['lineas'];
if ($lim>4) {$lim=4;}

$q1 = "SELECT auto,id,tel,turno FROM robot.calllist " .
"WHERE msg = :msg ".
"AND id <> '' AND tel <> '' ".
"ORDER BY turno LIMIT ".$lim.";";
try {
    $sth1 = $dbh->prepare($q1);
} catch (PDOException $e) {
    echo 'Prepare failed: ' . $e->getMessage();
}
$sth1->bindParam(':msg', $msg);
$sth1->execute(); 
$result = $sth1->fetchAll();
foreach ($result as $row) {
$tt = $row[2];
$auto=$row[0];
$cta=$row[1];
$output[] = array('id' => $auto, 'cuenta' => $cta, 'tel' => $tt, 'msg' => $msg);
}
}
echo json_encode($output);

