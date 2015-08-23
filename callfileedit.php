<?php
require_once 'pdoConnect.php';
$pdoc          = new pdoConnect();
$pdo           = $pdoc->dbConnectAdmin();
$capt          = filter_input(INPUT_GET, 'capt');
$cliente       = filter_input(INPUT_GET, 'cliente');
$nombre_deudor = filter_input(INPUT_GET, 'nombre_deudor');
$id            = filter_input(INPUT_GET, 'id');
$tel           = filter_input(INPUT_GET, 'tel');
if (filter_has_var(INPUT_GET, 'go')) {
    $wherestring = " WHERE cliente <> '' ";
    if (!empty($cliente)) {
        $cliente .= ' AND id=:cliente ';
    }
    if (!empty($nombre_deudor)) {
        $wherestring .= ' AND id IN (select numero_de_cuenta from cobra.resumen where nombre_deudor=:nombre_deudor) ';
    }
    if (!empty($id)) {
        $wherestring .= ' AND id IN (select numero_de_cuenta from cobra.resumen where numero_de_cuenta=:id) ';
    }
    if (!empty($tel)) {
        $wherestring .= ' AND tel=:tel ';
    }
    $querydel = "DELETE FROM robot.calllist WHERE ".$wherestring;
    $std      = $pdo->prepare($querydel);
    if (!empty($cliente)) {
        $std->bindParam(':cliente', $cliente);
    }
    if (!empty($nombre_deudor)) {
        $std->bindParam(':nombre_deudor', $nombre_deudor);
    }
    if (!empty($id)) {
        $std->bindParam(':id', $id);
    }
    if (!empty($tel)) {
        $std->bindParam(':tel', $tel);
    }
    $std->execute();
}
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>ROBOT Edit</title>
    </head>
    <body>
        <?php if (filter_has_var(INPUT_GET, 'go')) { ?>
            <p>Llamadas est&aacute;n quitado</p>
        <?php } ?>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form id="quitar" name="quitar" action="callfileedit.php" method="get">
            <p>Cliente <input type='text' name='cliente' id='cliente' value='<?php echo $cliente; ?>' onkeyup="lookup('cliente');">
            </p>
            <p>Nombre <input type='text' name='nombre_deudor' id='nombre_deudor' value='<?php echo $nombre_deudor; ?>' onkeyup="lookup('nombre_deudor');">
            </p>
            <p>Cuenta <input type='text' name='id' id='id' value='<?php echo $id; ?>' onkeyup="lookup('id');">
            </p>
            <p>Tel&eacute;fono <input type='text' name='tel' id='tel' value='<?php echo $tel; ?>' onkeyup="lookup('tel');">
            </p>
            <p id='list'>
            </p>
            <input type="hidden" name="capt" value="<?php echo $capt ?>" />
            <input type="submit" name="go" value="quitar" />
        </form>
    </body>
</html>
