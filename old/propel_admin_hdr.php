<?php
include 'propel-connect.php';
$ticket=filter_input(INPUT_COOKIE,'auth',FILTER_SANITIZE_STRING);
$capt=filter_input(INPUT_GET,'capt',FILTER_SANITIZE_STRING);
if (empty($capt)) {
    $capt=filter_input(INPUT_POST,'capt',FILTER_SANITIZE_STRING);
}
if (empty($capt)) {
    $capt=filter_input(INPUT_COOKIE,'capt',FILTER_SANITIZE_STRING);
}
if (empty($capt)) {
    $page="Location: index.php";
            header($page);
    }
$nombrecheck = NombresQuery::create()
                ->filterByTicket($ticket)
                ->filterByIniciales($capt)
                ->filterByTipo('admin')
                ->count();
if ($nombrecheck!=1) {
    $page="Location: index.php";
            header($page);
    }

