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
    $nombre = 'total';
    /** @var TimesheetDayObject[] $month */
    $month = $sheet[$nombre];
    /** @var TimesheetDayObject $monthSum */
    $monthSum = $sum[$nombre];
    ?>
    <table class="ui-widget">
        <thead class="ui-widget-header">
        <tr>
            <th>TOTAL</th>
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
        require __DIR__ . '/timesheetTableCounts.php';
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>