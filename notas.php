<?php
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
$CUENTA = filter_input(INPUT_GET, 'CUENTA');
$C_CONT = (int) filter_input(INPUT_GET, 'C_CONT', FILTER_VALIDATE_INT);
$go = filter_input(INPUT_GET, 'go');
$HORA = (int) filter_input(INPUT_GET, 'HORA', FILTER_VALIDATE_INT);
$MIN = (int) filter_input(INPUT_GET, 'MIN', FILTER_VALIDATE_INT);
$NOTA = filter_input(INPUT_GET, 'NOTA');
$FECHA = filter_input(INPUT_GET, 'FECHA');
if ($go == 'GUARDAR') {
    $D_FECH = date('Y-m-d');
    $C_HORA = date('H:i:s');
    if ($HORA != '00') {
        $HORA = str_pad($HORA, 2, "0", STR_PAD_LEFT) . ':'
                . str_pad($MIN, 2, "0", STR_PAD_LEFT) . ':00';
    }
    $querybor = "UPDATE cobra.notas SET borrado=1
WHERE c_cvge=:capt and c_cont=:C_CONT";
    $stb = $pdo->prepare($querybor);
    $stb->bindParam(':capt', $capt);
    $stb->bindParam(':C_CONT', $C_CONT);
    $stb->execute();
    $queryins = "INSERT INTO cobra.notas
        (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT)
VALUES (:capt, :capt, date(:D_FECH), :C_HORA, :FECHA, :HORA, :NOTA,
:CUENTA, :C_CONT)";
    $sti = $pdo->prepare($queryins);
    $sti->bindParam(':capt', $capt);
    $sti->bindParam(':D_FECH', $D_FECH);
    $sti->bindParam(':C_HORA', $C_HORA);
    $sti->bindParam(':FECHA', $FECHA);
    $sti->bindParam(':HORA', $HORA);
    $sti->bindParam(':NOTA', $NOTA);
    $sti->bindParam(':CUENTA', $CUENTA);
    $sti->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
    $sti->execute();
    $redirector = "Location: notas.php?capt='" . $capt . "'&go=FROMGUARDAR";
    header($redirector);
}
if ($go == 'BORRAR') {
    $AUTO = (int) filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
    $querybins = "UPDATE cobra.notas set borrado=1 "
            . "where AUTO=:AUTO and C_CVGE=:capt";
    $stbi = $pdo->prepare($querybins);
    $stbi->bindParam(':capt', $capt);
    $stbi->bindParam(':AUTO', $AUTO, PDO::PARAM_INT);
    $stbi->execute();
    $redirector = "Location: notas.php?capt=" . $capt . "&go=FROMBORRAR";
    header($redirector);
}
$querysub = "SELECT auto,fecha,hora,nota,c_cvge,cuenta "
        . "FROM cobra.notas "
        . "WHERE c_cvge IN (:capt, 'todos') "
        . "AND borrado=0 ORDER BY fecha desc,hora desc";
$sts = $pdo->prepare($querysub);
$sts->bindParam(':capt', $capt);
$sts->execute();
$result = $sts->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/notasView.php';