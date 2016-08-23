<?php
require_once 'classes/PdoClass.php'; // returns $pdo
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$querysub = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id_cuenta) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
$sts = $pdo->prepare($querysub);
$sts->bindParam(':id_cuenta', $ID_CUENTA);
$sts->execute();
$rowsub = $sts->fetchAll(PDO::FETCH_ASSOC);
$fields = array("c_cvst", "fh", "gestor", "short", "Gestion");
$fieldnames = array("Status", "Fecha/Hora", "Visitador", "Gestion", "Gestion");
$fieldsize = array("status", "timestamp", "chico", "gestion", "hidebox");
require_once 'views/realvisitlistView.php';