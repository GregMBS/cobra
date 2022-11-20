<?php 
/**
 * @var string $flagMsg
 * @var string $capt
 * @var int|null $C_CONT
 */
?>
<!DOCTYPE html>
<html lang="es">
    <HEAD>
        <TITLE>Error de capturar gestion</TITLE>
    </HEAD>
    <BODY>
        <h2><?php echo $flagMsg; ?></h2>
        <?php
        if (isset($C_CONT)) {
            ?>
            <a href="../resumen.php?capt=<?php echo $capt; ?>&field=id_cuenta&find=<?php echo $C_CONT; ?>">Regresa para arreglarlo</a>
            <?php
        } else {
            ?>
            <a href="../index.php">Favor de LOGIN.</a>
            <?php
        }
        ?>
    </BODY>
</HTML>
