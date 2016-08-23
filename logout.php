<?php
require_once 'classes/PdoClass.php'; // returns $pdo
$pdoc		 = new PdoClass();
$pdo		 = $pdoc->dbConnectUser();
$capt		 = filter_input(INPUT_GET, 'capt');
$go		 = filter_input(INPUT_GET, 'gone');
$queryunlock	 = "UPDATE resumen "
    ."SET timelock = NULL, locker = NULL "
    ."WHERE locker = :capt";
$stu		 = $pdo->prepare($queryunlock);
$stu->bindParam(':capt', $capt);
$stu->execute();
if ($go != "") {
	$date		 = date('Y-m-d');
	$time		 = date('H:i:s');
	$queryins	 = "INSERT INTO historia
		(C_CVGE, C_CVBA, C_CONT, CUENTA, C_CVST, D_FECH, C_HRIN, C_HRFI)
		VALUES
		(:capt,'', 0, 0, :go, :date, :timein, :timeout)";
	if ($go == 'forgot') {
		$go		 = 'salir';
		$queryldt	 = "select d_fech,c_hrfi from historia "
		    ."where c_cvge = :capt"
		    ."order by d_fech desc,c_hrin desc "
		    ."limit 1";
		$stl		 = $pdo->prepare($queryldt);
		$stl->bindParam(':capt', $capt);
		$stl->execute();
		$resultldt	 = $stl->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultldt as $answerldt) {
			$date	 = $answerldt['d_fech'];
			$time	 = $answerldt['c_hrin'];
		}
	}
	$sti		 = $pdo->prepare($queryins);
	$sti->bindParam(':capt', $capt);
	$sti->bindParam(':go', $go);
	$sti->bindParam(':date', $date);
	$sti->bindParam(':timein', $time);
	$sti->bindParam(':timeout', $time);
	$sti->execute();
	$queryclr	 = "UPDATE resumen SET locker=NULL, timelock=NULL"
	    ."WHERE locker = :capt";
	$stc		 = $pdo->prepare($queryclr);
	$stc->bindParam(':capt', $capt);
	$stc->execute();
	$querydel	 = "DELETE from rslice "
	    ."WHERE user = :capt";
	$std		 = $pdo->prepare($querydel);
	$std->bindParam(':capt', $capt);
	$std->execute();
	$querynom	 = "update nombres set ticket = NULL "
	    ."where iniciales=:capt";
	$stn		 = $pdo->prepare($querynom);
	$stn->bindParam(':capt', $capt);
	$stn->execute();
	$page		 = "Location: index.php";
	if (($go != "salir") && ($go != "error")) {
		$page = "Location: breaks.php?capt=".$capt;
	}
	header($page);
}
require_once 'views/logoutView.php';