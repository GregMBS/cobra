<th><a href='<?php echo strtolower('gestor.php?capt=' . $capt . '&gestor=' . $gestor . '&c_cvge=' . $c_cvge); ?>'><?php echo $gestor; ?></a></th>
<?php
for ($i = 1; $i <= $dhoy; $i++) {
    $start[$i] = ' ';
    $stop[$i] = ' ';
    $diff[$i] = 0;
    $break[$i] = 0;
    $bano[$i] = 0;
    $lla[$i] = 0;
    $tlla[$i] = 0;
    $prom[$i] = 0;
    $pag[$i] = 0;
    $lph[$i] = 0;
    $ct[$i] = 0;
    $nct[$i] = 0;
    $resultssd = $hc->getStartStopDiff($gestor, $i);
    foreach ($resultssd as $answerssd) {
        $start[$i] = substr($answerssd['start'], 0, 5);
        $stop[$i] = substr($answerssd['stop'], 0, 5);
        $diff[$i] = $answerssd['diff'];
    }
    $resultss = $hc->getCurrentMain($gestor, $i);
    foreach ($resultss as $answerss) {
        $break[$i] = 0;
        $resultbreak = $hc->getTiempoDiff($gestor, $i, 'break');
        foreach ($resultbreak as $answerpi) {
            $TIEMPO = $answerpi['tiempo'];
            $DIFF = $answerpi['diff'];
            $resultq = $hc->getNTPDiff($gestor, $i, $TIEMPO);
            if ($resultq) {
                foreach ($resultq as $answerq) {
                    $DIFF = $answerq['diff'];
                    $NTP = $answerq['ntp'];
                    $break[$i]+=$DIFF;
                }
            }
        }
        $bano[$i] = 0;
        $resultpo = $hc->getTiempoDiff($gestor, $i, 'bano');
        foreach ($resultpo as $answerpo) {
            $TIEMPO = $answerpo['tiempo'];
            $DIFF = $answerpo['diff'];
            $resultq = $hc->getNTPDiff($gestor, $i, $TIEMPO);
            if ($resultq) {
                foreach ($resultq as $answerq) {
                    $DIFF = $answerq['diff'];
                    $NTP = $answerq['ntp'];
                    $bano[$i]+=$DIFF;
                }
            }
        }
        $lla[$i] = $answerss['cuentas'];
        $tlla[$i] = $answerss['gestiones'];
        $ct[$i] = $answerss['nocontactos'];
        $nct[$i] = $answerss['contactos'];
        $prom[$i] = $answerss['promesas'];
        $lph[$i] = $lla[$i] / ($diff[$i] + 1 / 3600);
        $sumg = 0;
        $sumgt = 0;
        $sumt = 0;
        $sumb = 0;
        $sumbn = 0;
        $sumct = 0;
        $sumnct = 0;
        $sumpp = 0;
        $sump = 0;
        $resultp = $hc->getPagos($gestor, $i);
        foreach ($resultp as $answerp) {
            $pag[$i] = $answerp['ct'];
        }
    }
    $dow = date("w", strtotime($yr . "-" . $mes . "-" . $i));
    ?>
    <th><?php echo $day_esp[$dow] . " " . $i; ?></th>
<?php } ?>
<th>TOTAL</th>
</tr>
</thead>
<tbody class="ui-widget-content">
    <tr><td class="heavy">LOGIN</td>
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
    <tr><td class="heavy">LOGOUT</td>
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
    <tr><td class="heavy">TOTA HORAS</td>
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
        }
        ?>
        <td class="heavy"><?php
            $hrst = floor($sumt / 3600);
            $minst = round(($sumt - $hrs * 3600) / 60);
            echo $hrst . ':' . sprintf("%02s", $minst);
            ?></td>
    </tr>
    <tr><td class="heavy">TIEMPO BREAK</td>
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
    <tr><td class="heavy">TIEMPO BAÑO</td>
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
    <tr><td class="heavy">TOTAL GESTIONES</td>
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
    <tr><td class="heavy">TOTAL CUENTAS</td>
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
    <tr><td class="heavy">CONTACTOS</td>
        <?php
        $sumct = 0;
        for ($i = 1; $i <= $dhoy; $i++) {
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
