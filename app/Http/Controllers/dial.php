<?php
use app\PdoClass;
$pdoc  = new PdoClass();
$pdo   = $pdoc->dbConnectUser();
$local = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
$capt   = filter_input(INPUT_GET, 'capt');
$tel   = filter_input(INPUT_GET, 'tel');
$cta   = filter_input(INPUT_GET, 'cta');

$querydel = "update callme "
    ."set completado=1 "
    ."where ext=:local;";
$std      = $pdo->prepare($querydel);
$std->bindParam(':local', $local);
$std->execute();

$querymain = "insert into callme (gestor,cuenta,tel,ext,tiempo)
    values (:capt, :cta, :tel, :local, now())";
$sti       = $pdo->prepare($queryins);
$sti->bindParam(':capt', $capt);
$sti->bindParam(':cta', $cta);
$sti->bindParam(':tel', $tel);
$sti->bindParam(':local', $local);
$sti->execute();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Marcar</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body onLoad='window.close()'>
        <button onClick='window.close()'>CIERRA</button>
    </body>
</html> 