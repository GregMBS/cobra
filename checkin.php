<?php
require_once 'checkCommon.php';
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $cc->updateVasign($tipo, $CUENTA);
    }
}
$file = __FILE__;
$label = 'RECIBIR';
require_once 'views/checkView.php';