<?php
$dbhost	 = "localhost";
$dbuser	 = "root";
$dbpass	 = "DeathSta1";
$dbname	 = "robot";
$output	 = array();
try {
	$dbh = new PDO("mysql:".$dbname.":".$dbhost, $dbuser, $dbpass);
} catch (PDOException $e) {
	echo 'Connection failed: '.$e->getMessage();
	die(json_encode(''));
}

$q0 = "SELECT distinct auto, msg, tipo, lineas FROM robot.msglist
WHERE lineas > 0
and concat(fecha_start,' ',hour_start,':00:00')>now()
and concat(fecha_end,' ',hour_end,':00:00')<now()
;";
try {
	$sth = $dbh->query($q0);
} catch (PDOException $e) {
	echo 'Query failed: '.$e->getMessage();
}
if ($sth) {
	$result0 = $sth->fetchAll();
	foreach ($result0 as $row0) {

		$msg	 = $row0['msg'].'_'.$row0['tipo'];
		$lim	 = $row0['lineas'];

		$q1 = "SELECT auto,id,tel,turno FROM robot.calllist ".
		    "WHERE msg = :msg ".
		    "AND id <> '' AND tel <> '' ".
		    "ORDER BY turno LIMIT ".$lim.";";
		try {
			$sth1 = $dbh->prepare($q1);
		} catch (PDOException $e) {
			echo 'Prepare failed: '.$e->getMessage();
		}
		$sth1->bindParam(':msg', $msg);
		$sth1->execute();
		$result = $sth1->fetchAll();
		foreach ($result as $row) {
			$tt	 = $row[2];
			$auto	 = $row[0];
			$cta	 = $row[1];
//$output[] = array('id' => $auto, 'cuenta' => $cta, 'tel' => $tt, 'msg' => $msg);
		}
	}
}
$output[] = array('id' => 0, 'cuenta' => 0, 'tel' => '18716578', 'msg' => '');
echo json_encode($output);

