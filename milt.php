<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "DeathSta1";
$dbname = "robotcsi";
$output = array();
try {
    $dbh = new PDO("mysql:" . $dbname . ":" . $dbhost, $dbuser, $dbpass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die(json_encode(''));
}

$q0 = "SELECT distinct auto, msg, lineas FROM msglist";
try {
    $sth = $dbh->prepare($q0);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
try {
    $sth->execute();
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
try {
    $result0 = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    die();
}
var_dump($result0);die();
if ($result0) {
    foreach ($result0 as $row0) {
        $msg = $row0['msg'];
        $lim = $row0['lineas'];
        if ($lim > 100) {
            $lim = 100;
        }

        $q1 = "SELECT auto,id,tel,turno FROM calllist " .
                "WHERE msg = :msg " .
                "AND id <> '' AND tel <> '' " .
                "AND turno = 0 " .
                "ORDER BY turno LIMIT " . $lim . ";";
        try {
            $sth1 = $dbh->prepare($q1);
        } catch (PDOException $e) {
            echo 'Prepare failed: ' . $e->getMessage();
        }
        $sth1->bindParam(':msg', $msg);
        $sth1->execute();
        $result = $sth1->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $tt = $row['tel'];
            $auto = $row['auto'];
            $cta = $row['id'];
            $output[] = array('id' => $auto, 'cuenta' => $cta, 'tel' => $tt, 'msg' => $msg);
        }
    }
    echo json_encode($output);
}
