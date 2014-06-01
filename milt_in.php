<?php 
$host = "localhost";
$user = "root";
$pswd = "4sale";
$db = "robot";
$mysqli = new mysqli($host,$user,$pswd,$db);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$q0 = "SELECT distinct auto,msg, lineas FROM msglist;";
// WHERE hour(now())>5;

$i=0;

if ($sth = $mysqli->query($q0)) {

    /* fetch object array */
    while ($row0 = $sth->fetch_row()) {
        $msg=$row0[1];
        $lim=$row0[2];
        $q1 = "SELECT auto,id,tel,turno FROM calllist " .
            "WHERE msg = '".$msg."' AND turno=0 ORDER BY turno LIMIT ".$lim.";";
        $sth1 = $mysqli->query($q1);
}

        while ($row = $sth1->fetch_row()) {
            $hash[$i]['msg'] = $msg;
            $hash[$i]['tt'] = $row[2];
            $hash[$i]['cta'] = $row[1];
             $qu = "UPDATE calllist SET turno=turno+1 WHERE auto=?;";
            $sthu = $mysqli->prepare($qu);
            $sthu->bind_param("i", $auto);
            $sthu->execute(); 
$i++;
}
}
/* close connection */
$mysqli->close();

$json = json_encode($hash);
print $json;

