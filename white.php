<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pd    = new PdoClass();
$pdo     = $pd->dbConnectUser();
$capt = $pd->capt;
require_once 'views/whiteView.php';