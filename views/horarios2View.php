<!DOCTYPE html>
<html lang='es'>
<head>
    <title>Horarios</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    <style type="text/css">
        tr:hover {
            background-color: #ffff00;
        }

        .heavy {
            font-weight: bold;
            font-size: 10pt;
        }
    </style>
</head>
<body>
<h2>HORARIOS</h2>
<div>
    <form action='/horarios_clean2.php' method='get'>
        <select name='gestor'>
            <?php
            foreach ($resultnom as $answernom) {
                $nombre = $answernom['c_cvge'];
                ?>
                <option value='<?php echo $nombre; ?>'><?php echo $nombre; ?></option>
            <?php } ?>
            <option value='total'>total</option>
        </select>
        <input type='hidden' name='capt' value='<?php echo $capt; ?>'>'
        <input type='submit' name='go' value='gestor'>'
    </form>
</div>
<?php /**
 * @param int $today
 * @param array $item
 * @param float $sum
 * @param array $total
 * @return array
 */
function horariosRow($today, array $item, $sum, array $total)
{
    for ($i = 1; $i <= $today; $i++) {
        echo '<td class="light';
        if ($item[$i] == 0) {
            echo ' zeros';
        }
        echo '">';
        echo $item[$i];
        echo '</td>';
        $sum = $sum + $item[$i];
        $total[$i] = $total[$i] + $item[$i];
    }
    return [$sum, $total];
}

if ($go == 'gestor') { ?>
<div>
    <table class="ui-widget">
        <?php
        for ($i = 1; $i <= $dhoy; $i++) {
            $tsumt[$i] = 0;
            $tsumb[$i] = 0;
            $tsumbn[$i] = 0;
            $tsumg[$i] = 0;
            $tsumgt[$i] = 0;
            $tsumct[$i] = 0;
            $tsumnct[$i] = 0;
            $tsumpp[$i] = 0;
            $tsump[$i] = 0;
        }
        ?>
        <thead class="ui-widget-header">
        <tr>
            <?php
            require_once 'horariosHead.php';
            ?>
        </tr>
        </thead>
        <tbody class="ui-widget-content">
        <?php
        require_once 'horariosBody.php';
        ?>
        <tr>
            <td class="heavy">NO CONTACTOS</td>
            <?php
            list($sumnct, $tsumnct) = horariosRow($dhoy, $nct, 0, $tsumnct);
            ?>
            <td class="heavy"><?php echo $sumnct; ?></td>
        </tr>
        <tr>
            <td class="heavy">PROMESAS</td>
            <?php
            list($sumpp, $tsumpp) = horariosRow($dhoy, $prom, 0, $tsumpp);
            ?>
            <td class="heavy"><?php echo $sumpp; ?></td>
        </tr>
        <tr>
            <td class="heavy">PAGOS</td>
            <?php
            list($sump, $tsump) = horariosRow($dhoy, $pag, 0, $tsump);
            ?>
            <td class="heavy"><?php echo $sump; ?></td>
        </tr>
        <tr style="height:2em"></tr>
        </tbody>
    </table>
    <?php } ?>
</div>
</body>
</html>

