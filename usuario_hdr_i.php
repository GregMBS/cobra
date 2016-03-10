<?php
$day_esp = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
$host    = "localhost";
$user    = "root";
$pwd     = "4sale";
$db      = "cobra";
$con     = new mysqli($host, $user, $pwd, $db) or die("ERROR UHM1 - ".mysqli_error($con));
set_time_limit(300);
$cookie  = filter_input_array(INPUT_COOKIE);
$get  = filter_input_array(INPUT_GET);
$icapt = filter_input(INPUT_GET, 'capt');
if (isset($cookie['auth'])) {
    $ticket = mysqli_real_escape_string($con, $cookie['auth']);
    $mytipo = '';
    $capt = mysqli_real_escape_string($con, $icapt);
    $queryg  = "SELECT usuaria,tipo FROM nombres join grupos on tipo=grupo WHERE iniciales = '".$capt."';";
    $resultg = mysqli_query($con, $queryg) or die("ERROR UHM2 - ".mysqli_error($con));
    while ($answerg = mysqli_fetch_row($resultg)) {
        $mynombre = $answerg[0];
        $mytipo   = $answerg[1];
    }
    if ($mytipo == '') {
        $page = "Location: index.php";
        header($page);
    }
} else {
    $page = "Location: index.php";
    header($page);
}
