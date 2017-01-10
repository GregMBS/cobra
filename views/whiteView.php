<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo  = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
require_once 'views/whiteView.php';