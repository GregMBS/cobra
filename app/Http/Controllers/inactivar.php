<?php
use App\PdoClass;
$pdoc = new PdoClass();
$pdo  = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
if (empty($capt)) {
    $capt = filter_input(INPUT_POST, 'capt');
}
$go   = filter_input(INPUT_POST, 'go');
$data = filter_input(INPUT_POST, 'data');
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>Desactivar Cuentas</title>
        <style>
            .num {text-align:right}
            textarea,select,option {background-color:white;}
            form {margin-left:auto;margin-right:auto;}
            p {background-color:gray;}
        </style>
    </head>
    <body>
        <form action="inactivar.php" method="post" name="cargar">
            <p>Usa numero de cuenta</p>
            <textarea name='data' rows='20' cols='50'></textarea>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>
        </p>
    </form>
    <?php
    if (!empty($go)) {

        if ($go == 'cargar') {

            $sql  = "update resumen
set status_de_credito=concat(trim(status_de_credito),'-inactivo')
where numero_de_cuenta = :nc";
            $sts = $pdo->prepare($sql);
            $string = preg_replace('/\s/', ',', $data);
            $dat = explode(',', $string);
            foreach ($dat as $d) {
                $sts->bindParam(':nc', $d);
                $sts->execute();
            }
            ?>
            <p>Cuentas están inactivadas</p>
            <?php
        }
    }
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la plantilla administrativa</button><br>
</body>
</html>
