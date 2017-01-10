<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$capt = $pdoc->capt;
require_once 'views/cargaPicView.php';