<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "DeathSta1";
$dbname = "robot";

try {
    $dbh = new PDO("mysql:".$dbname.":".$dbhost,$dbuser,$dbpass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$id = $_GET['id'];

$botup = "UPDATE robot.calllist SET turno=turno+1 WHERE auto = :id;";
try {
    $sth = $dbh -> prepare($botup);
} catch (PDOException $e) {
    echo 'Prepare failed: ' . $e->getMessage();
}
$sth->bindParam(':id', $id, PDO::PARAM_INT);
$sth -> execute();
