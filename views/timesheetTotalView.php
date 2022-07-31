<!DOCTYPE html>
<html lang="es">
<?php

require_once __DIR__ . '/timesheetHead.php';

?>
<body>
<h2>HORARIOS</h2>
<div>
    <form action='/horarios_single.php' method='get'>
        <label for="selectGestor">Gestor: </label>
        <select name='gestor' id="selectGestor">
            <?php
            $day_esp = ['DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
            /** @var array $gestores */
            foreach ($gestores as $answerNombre) {
            $gestor = $answerNombre['c_cvge'];
                ?>
                <option value='<?php echo $gestor; ?>'><?php echo $gestor; ?></option>
                <?php
            } ?>
            <option value='total'>total</option>
        </select>
        <input type='hidden' name='capt' value='<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>'>
        <input type='submit' name='go' value='gestor'>
    </form>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>