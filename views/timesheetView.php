<!DOCTYPE html>
<html lang="es">
<?php
require_once __DIR__ . '/timesheetHead.php';
?>
<body>
<h2>HORARIOS</h2>
<div>
    <?php
    $day_esp = ['DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
    foreach ($gestores as $answerNombre) {
        $gestor = $answerNombre['c_cvge'];
        $month = $sheet[$gestor];
        $monthSum = $sum[$gestor];
        ?>
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
            require_once __DIR__ . '/timesheetTable.php';
            ?>
            </tbody>
            </table>
            <?php
        }
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>