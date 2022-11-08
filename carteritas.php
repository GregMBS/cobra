<?php

use cobra_salsa\CarteritasClass;
use cobra_salsa\InputClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/InputClass.php';
require_once 'classes/CarteritasClass.php';

$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$capt = $pc->capt;
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);
$ic = new InputClass();
$cc = new CarteritasClass($pdo);
$go = '';
$count = 0;
if (!empty($post)) {
    if (array_key_exists('go', $post)) {
        $go = $post['go'];
    }
}
if ($go == 'cargar') {
    if ($_FILES["file"]["error"] > 0) {
        echo "<p>Error: " . $_FILES["file"]["error"] . "</p>";
    }
    if ($_FILES["file"]["error"] == 0) {
        $filename = $cc->moveLoadedFile();
        try {
            $data = $ic->readXLSXFile($filename);
            $loadVisitas = $cc->loadVisitas($data);
            $fixVisitas = $cc->fix_visitas;
            $fixTels = $cc->fix_tels;
            $fixProms = $cc->fix_proms;
            $sql = $pdo->prepare($loadVisitas);
            $sql->execute();
            $count = $sql->rowCount();
            $sqv = $pdo->prepare($fixVisitas);
            $sqv->execute();
            $sqt = $pdo->prepare($fixTels);
            $sqt->execute();
            $sqp = $pdo->prepare($fixProms);
            $sqp->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
    ?>
    <!DOCTYPE HTML>

    <html lang="es">
    <head>
        <title>COBRA Carga de Gestiones</title>
    </head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa
</button>
<br>
<h1>COBRA Carga de Gestiones</h1>
<form action="carteritas.php" method="post" enctype="multipart/form-data" name="cargar">
    <p>Filename:
        <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>"/>
        <input type="file" name="file" id="file"><br>
        <button type="submit" name="go" value="cargar">Elegir archivo</button>
    </p>
</form>
<?php
if ($count > 0) {
?>
    <h2><?php echo $count; ?> gestiones cargadas</h2>
<?php
}
?>
</body>
</html>