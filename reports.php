<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
require_once 'views/reportsView.php';