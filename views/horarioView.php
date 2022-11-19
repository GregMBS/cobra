<!DOCTYPE html>
<html lang="es">
<?php
require_once __DIR__ . '/timesheetHead.php';
$month = array_pop($sheet);
$monthSum = array_pop($sum);
?>
<body>
<h2>HORARIOS</h2>
<div>
    <form action='/horarios_single.php' method='get'>
        <label for="selectGestor">Gestor: </label>
        <select name='gestor' id="selectGestor">
            <?php
            $day_esp = ['DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
            foreach ($gestores as $answerNombre) {
                $nombre = $answerNombre['c_cvge'];
                ?>
                <option value='<?php echo $nombre; ?>'><?php echo $nombre; ?></option>
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
<?php

$go = filter_input(INPUT_GET, 'go');
if ($go == 'gestor') { ?>
<div>
    <table class="ui-widget">
        <thead class="ui-widget-header">
        <tr>
            <?php
            if (isset($gestor)) {
                ?>
                <th>
                    <a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $gestor . '&c_cvge=' . $gestor); ?>'><?php echo $gestor; ?></a>
                </th>
                <?php
            }
            $month = $hc->prepareSheet($gestor, $dhoy);
            for ($i = 1; $i < $dhoy; $i++) {
                $day = $month[$i];
                $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
                ?>
                <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
            <?php } ?>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody class="ui-widget-content">
        <?php
        require __DIR__ . '/timesheetTable.php';
        ?>
        </tbody>
    </table>
    <?php } ?>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>