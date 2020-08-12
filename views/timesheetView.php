<!DOCTYPE html>
<html lang="es">
<?php

use cobra_salsa\TimesheetDayObject;

require_once __DIR__ . '/timesheetHead.php';
require_once __DIR__ . '/../classes/TimesheetDayObject.php';
?>
<body>
<h2>HORARIOS</h2>
<div>
    <?php
    $day_esp = ['DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
    foreach ($gestores as $gestor) {
        $nombre = $gestor['c_cvge'];
        /** @var TimesheetDayObject[] $month */
        $month = $sheet[$nombre];
        /** @var TimesheetDayObject $monthSum */
        $monthSum = $sum[$nombre];
        ?>
        <table class="ui-widget">
            <thead class="ui-widget-header">
            <tr>
                <th>
                    <a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $nombre . '&c_cvge=' . $nombre); ?>'><?php echo $nombre; ?></a>
                </th>
                <?php
                for ($i = 1; $i <= $dhoy; $i++) {
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
        <?php
    }
    $nombre = 'TOTAL';
    /** @var TimesheetDayObject[] $month */
    $month = $sheet[$nombre];
    /** @var TimesheetDayObject $monthSum */
    $monthSum = $sum[$nombre];
    ?>
    <table class="ui-widget">
        <thead class="ui-widget-header">
        <tr>
            <th>
                <?php echo $nombre; ?>
            </th>
            <?php
            for ($i = 1; $i <= $dhoy; $i++) {
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
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>