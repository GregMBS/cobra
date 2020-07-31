<!DOCTYPE html>
<html lang="es">
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

        .heavytot {
            font-weight: bold;
            font-size: 10pt;
            text-align: right;
        }

        .light {
            text-align: right;
        }

        .zeros {
            color: red;
        }
    </style>
</head>
<body>
<h2>HORARIOS</h2>
<div>
    <form action='/horarios_clean2.php' method='get'>
        <label for="selectGestor">Gestor: </label>
        <select name='gestor' id="selectGestor">
            <?php

            if (!empty($gestores)) {
                foreach ($gestores as $nombres) {
                    $nombre = $nombres['c_cvge'];
                    ?>
                    <option value='<?php echo $nombre; ?>'><?php echo $nombre; ?></option>
                <?php }
            } ?>
            <option value='total'>total</option>
        </select>
        <input type='hidden' name='capt' value='<?php if (isset($capt)) {
            echo $capt;
        } ?>'>'
        <input type='submit' name='go' value='gestor'>'
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
            $day_esp = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
            $month = $hc->prepareSheet($hc, $gestor, $dhoy);
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
        echo $tv->timeRow('LOGIN', $day->start);
        echo $tv->timeRow('LOGOUT', $day->stop);
        ?>

        <tr>
            <td class="heavy">TOTA HORAS</td>
            <?php
            $sumt = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($day->diff == 0) {
                    echo ' zeros';
                }
                ?>"><?php
                    $hrs = floor($day->diff / 3600);
                    $mins = round(($day->diff - $hrs * 3600) / 60);
                    echo $hrs . ':' . sprintf("%02s", $mins);
                    ?></td>
                <?php
                $sumt = $sumt + $day->diff;
                $hours_all[$i] = $hours_all[$i] + $day->diff;
            }
            ?>
            <td class="heavy"><?php
                $hrst = floor($sumt / 3600);
                $minst = round(($sumt - $hrs * 3600) / 60);
                echo $hrst . ':' . sprintf("%02s", $minst);
                ?></td>
        </tr>
        <tr>
            <td class="heavy">TIEMPO BREAK</td>
            <?php
            $sumb = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($day->break == 0) {
                    echo ' zeros';
                }
                ?>"><?php
                    $hrs = floor($day->break / 3600);
                    $mins = round(($day->break - $hrs * 3600) / 60);
                    echo $hrs . ':' . sprintf("%02s", $mins);
                    ?></td>
                <?php
                $sumb = $sumb + $day->break;
                $breaks_all[$i] += $day->break;
            }
            ?>
            <td class="heavy"><?php
                $hrsb = floor($sumb / 3600);
                $minsb = round(($sumb - $hrs * 3600) / 60);
                echo $hrsb . ':' . sprintf("%02s", $minsb);
                ?></td>
        </tr>
        <tr>
            <td class="heavy">TIEMPO BAÑO</td>
            <?php
            $sumbn = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($day->bano == 0) {
                    echo ' zeros';
                }
                ?>"><?php
                    $hrs = floor($day->bano / 3600);
                    $mins = round(($day->bano - $hrs * 3600) / 60);
                    echo $hrs . ':' . sprintf("%02s", $mins);
                    ?></td>
                <?php
                $sumbn = $sumbn + $day->bano;
                $bano_all[$i] += $day->bano;
            }
            ?>
            <td class="heavy"><?php
                $hrs = floor($sumbn / 3600);
                $mins = round(($sumbn - $hrs * 3600) / 60);
                echo $hrs . ':' . sprintf("%02s", $mins);
                ?></td>
        </tr>
        <?php
        echo $tv->countRow('TOTAL GESTIONES', $day->tlla, $capt, $gestor, $gestiones_all, 'ddh');
        ?>
        <tr>
            <td class="heavy">TOTAL CUENTAS</td>
            <?php
            $sumg = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($day->lla == 0) {
                    echo ' zeros';
                }
                ?>">
                    <a href='<?php echo strtolower('ddh.php?capt=' . $capt . '&i=' . $day->lla . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                        <?php echo $day->lla; ?></a></td>
                <?php
            }
            $resultsumg = $hc->countAccounts($gestor);
            foreach ($resultsumg as $answersumg) {
                $sumg = $answersumg['ct'];
            }
            ?>
            <td class="heavy"><?php echo $sumg; ?></td>
        </tr>
        <?php
        echo $tv->countRow('CONTACTOS', $day->ct, $capt, $gestor, $contactos_all, 'ddh');
        echo $tv->countRow('NO CONTACTOS', $day->nct, $capt, $gestor, $nocontactos_all, 'ddh');
        ?>
        <tr>
            <td class="heavy">PROMESAS</td>
            <?php
            $sumpp = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($day->prom == 0) {
                    echo ' zeros';
                }
                ?>">
                    <a href='<?php echo strtolower('pdh.php?capt=' . $capt . '&i=' . $day->prom . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                        <?php echo $day->prom; ?></a></td>
                <?php
                $sumpp = $sumpp + $day->prom;
                $promesas_all[$i] += $day->prom;
                ?>
            <?php }
            ?>
            <td class="heavy"><?php echo $sumpp; ?></td>
        </tr>
        <tr>
            <td class="heavy">PAGOS</td>
            <?php
            $sump = 0;
            for ($i = 1; $i <= $dhoy; $i++) {
                ?>
                <td class="light<?php
                if ($day->pag == 0) {
                    echo ' zeros';
                }
                ?>"><?php echo $day->pag; ?></td>
                <?php
                $sump = $sump + $day->pag;
                $pagos_all[$i] += $day->pag;
                ?>
            <?php }
            ?>
            <td class="heavy"><?php echo $sump; ?></td>
        </tr>
        <tr style="height:2em"></tr>
        </tbody>
    </table>
    <?php } ?>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</body>
</html>

