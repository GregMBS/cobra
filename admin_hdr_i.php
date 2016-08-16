<?php 
$host    = "localhost";
$user    = "root";
$pwd     = "DeathSta1";
$db      = "cobramas_cobra";
$con     = new mysqli($host, $user, $pwd, $db) or die("ERROR UHM1 - ".mysqli_error($con));
$ticket	 = $con->real_escape_string(filter_input(INPUT_COOKIE, 'auth'));
$capt	 = $con->real_escape_string(filter_input(INPUT_GET, 'capt'));
if (empty($capt)) {
	$capt	 = $con->real_escape_string(filter_input(INPUT_POST, 'capt'));
}
if (empty($capt)) {
	print_r(filter_input_array(INPUT_GET));
	die();
}
$querycheck	 = "SELECT count(1) FROM nombres WHERE ticket=? "
    ."AND iniciales=? AND tipo='admin';";
$stc		 = $con->stmt_init();
$stc->prepare($querycheck);
$stc->bind_param('ss', $ticket, $capt);
$stc->execute();
$stc->bind_result($count);
while ($stc->fetch()) {
	if ($count != 1) {
		$redirector = 'Location: index.php';
		header($redirector);
	}
}
$mytipo='admin';
