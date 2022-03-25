<?php

use cobra_salsa\CheckClass;

require_once 'checkCommon.php';
/**
 * @var string $go
 * @var string $tipo
 * @var CheckClass $cc
 */
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $cc->updateVasign($tipo, $CUENTA);
    }
}
$file = basename(__FILE__);
$label = 'RECIBIR';
require_once 'views/checkView.php';