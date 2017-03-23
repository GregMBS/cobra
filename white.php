<?php

use gregmbs\cobra\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc    = new PdoClass();
$pdo     = $pdoc->dbConnectUser();
$capt = $pdoc->capt;
require_once 'views/whiteView.php';