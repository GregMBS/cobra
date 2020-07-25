<?php

use cobra_salsa\PdoClass;
use cobra_salsa\MigoClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$capt = $pd->capt;
$tipo = $pd->tipo;
require_once 'views/migoView.php';
