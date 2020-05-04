<tr>
    <td class="heavy">LOGIN</td>
<?php
for ($i = 1; $i <= $dhoy; $i++) {
    ?>
    <td class="light<?php
    if ($start[$i] == '00:00') {
        echo ' zeros';
    }
    ?>"><?php echo $start[$i]; ?></td>
<?php } ?>
</tr>
<tr>
    <td class="heavy">LOGOUT</td>
    <?php
    for ($i = 1; $i <= $dhoy; $i++) {
        ?>
        <td class="light<?php
        if ($stop[$i] == '00:00') {
            echo ' zeros';
        }
        ?>"><?php echo $stop[$i]; ?></td>
        <?php
    }
    ?>
</tr>
<tr>
    <td class="heavy">TOTA HORAS</td>
    <?php
    $sumt = 0;
    for ($i = 1; $i <= $dhoy; $i++) {
        ?>
        <td class="light<?php
        if ($diff[$i] == 0) {
            echo ' zeros';
        }
        ?>"><?php
            $hrs = floor($diff[$i] / 3600);
            $mins = round(($diff[$i] - $hrs * 3600) / 60);
            echo $hrs . ':' . sprintf("%02s", $mins);
            ?></td>
        <?php
        $sumt = $sumt + $diff[$i];
        $tsumt[$i] = $tsumt[$i] + $diff[$i];
        $hours_all[$i] = $hours_all[$i] + $diff[$i];
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
        if ($break[$i] == 0) {
            echo ' zeros';
        }
        ?>"><?php
            $hrs = floor($break[$i] / 3600);
            $mins = round(($break[$i] - $hrs * 3600) / 60);
            echo $hrs . ':' . sprintf("%02s", $mins);
            ?></td>
        <?php
        $sumb = $sumb + $break[$i];
        $tsumb[$i] = $tsumb[$i] + $break[$i];
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
        if ($bano[$i] == 0) {
            echo ' zeros';
        }
        ?>"><?php
            $hrs = floor($bano[$i] / 3600);
            $mins = round(($bano[$i] - $hrs * 3600) / 60);
            echo $hrs . ':' . sprintf("%02s", $mins);
            ?></td>
        <?php
        $sumbn = $sumbn + $bano[$i];
        $tsumbn[$i] = $tsumbn[$i] + $bano[$i];
    }
    ?>
    <td class="heavy"><?php
        $hrs = floor($sumbn / 3600);
        $mins = round(($sumbn - $hrs * 3600) / 60);
        echo $hrs . ':' . sprintf("%02s", $mins);
        ?></td>
</tr>
<tr>
    <td class="heavy">TOTAL GESTIONES</td>
    <?php
    $sumgt = 0;
    for ($i = 1; $i <= $dhoy; $i++) {
        ?>
        <td class="light<?php
        if ($tlla[$i] == 0) {
            echo ' zeros';
        }
        ?>">
            <a href='<?php echo strtolower('ddh.php?capt=' . $capt . '&i=' . $tlla[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                <?php echo $tlla[$i]; ?></a></td>
        <?php
        $sumgt = $sumgt + $tlla[$i];
        $tsumgt[$i] = $tsumgt[$i] + $tlla[$i];
        ?>
    <?php }
    ?>
    <td class="heavy"><?php echo $sumgt; ?></td>
</tr>
<tr>
    <td class="heavy">TOTAL CUENTAS</td>
    <?php
    $sumg = 0;
    for ($i = 1; $i <= $dhoy; $i++) {
        ?>
        <td class="light<?php
        if ($lla[$i] == 0) {
            echo ' zeros';
        }
        ?>">
            <a href='<?php echo strtolower('ddh.php?capt=' . $capt . '&i=' . $lla[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                <?php echo $lla[$i]; ?></a></td>
        <?php
    }
    $resultsumg = $hc->countAccounts($gestor);
    foreach ($resultsumg as $answersumg) {
        $sumg = $answersumg['ct'];
    }
    ?>
    <td class="heavy"><?php echo $sumg; ?></td>
</tr>
<tr>
    <td class="heavy">CONTACTOS</td>
    <?php
    $sumct = 0;
    for ($i = 1;
    $i <= $dhoy;
    $i++) {
    ?>
    <td class="light<?php
    if ($ct[$i] == 0) {
        echo ' zeros';
    }
    ?>"><?php echo $ct[$i]; ?></td>
<?php
$sumct = $sumct + $ct[$i];
$tsumct[$i] = $tsumct[$i] + $ct[$i];
$contactos_all[$i] += $ct[$i];
}
    ?>
    <td class="heavy"><?php echo $sumct; ?></td>
</tr>

