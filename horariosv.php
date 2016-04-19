<?php
$day_esp = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
require_once 'adminClass.php';
$login   = new Admin();
$con     = $login->getCon();
$capt    = $login->getCapt();
$queryld = "select year(max(d_fech)),month(max(d_fech)),day(max(d_fech)) from historia
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
";
$stl     = $con->prepare($queryld);
$stl->execute();
$stl->store_result();
$stl->bind_result($yr, $mes, $dhoy);
$stl->fetch();

$querywd  = "select sum(fs),sum(ss) from
(select distinct d_fech,dayofweek(d_fech)>1 and day(d_fech)<16 as fs,
dayofweek(d_fech)>1 and day(d_fech)>15 as ss from historia 
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())) as tmp";
$stw      = $con->prepare($querywd) or die($con->error);
$stw->execute();
$stw->store_result();
$stw->bind_result($nosun1, $nosun2);
$stw->fetch();
$expw1    = $nosun1 * 15;
$expw2    = $nosun2 * 15;
$querynom = 'select distinct usuaria,iniciales
from nombres join historia on iniciales=c_visit
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
order by usuaria';
$stn      = $con->prepare($querynom);

$queryss = "select
sum(distinct c_carg<>'') as contact, sum(n_prom>0) as proms, count(1) as gest
from historia where c_visit=?
and c_msge is null and c_cont>0
and c_cniv is not null and year(D_FECH)=year(curdate()-interval 1 month)
and d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
and day(D_FECH)=?  group by D_FECH";
$sts     = $con->prepare($queryss);
$queryp  = "select count(1) from pagos join historia using (cuenta)
where c_visit=?
and fecha>last_day(curdate()-interval 1 month)
and fecha<=last_day(curdate())
and day(fecha)=?";
$stp     = $con->prepare($queryp);
$queryco = "select count(fechaout)
from vasign
where gestor=?
and fechaout>last_day(curdate()-interval 1 month)
and fechaout<last_day(curdate())+interval 1 day
and day(fechaout)=?";
$sto     = $con->prepare($queryco);
$queryci = "select count(fechain)
from vasign
where gestor=?
and fechaout>last_day(curdate()-interval 1 month)
and fechaout<last_day(curdate())+interval 1 day
and day(fechaout)=?";
$sti     = $con->prepare($queryco);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Visitas del Mes Actual</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style type="text/css">
            tr:hover {background-color: #ffff00;}
            .heavy {font-weight:bold;font-size:10pt;}
            .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
            .light {text-align:right;}
            .zeros {color:red;}
        </style>
    </head>
    <body>
        <h2>VISITAS DEL MES ACTUAL</h2>
        <table class="ui-widget">
            <?php
            for ($i = 1; $i <= $dhoy; $i++) {
                $tsumt[$i]   = 0;
                $tsumb[$i]   = 0;
                $tsumg[$i]   = 0;
                $tsumgt[$i]  = 0;
                $tsumgt1[$i] = 0;
                $tsumgt2[$i] = 0;
                $tsumco[$i]  = 0;
                $tsumci[$i]  = 0;
                $tsumpp[$i]  = 0;
                $tsump[$i]   = 0;
                $tsumw[$i]   = 0;
            }
            $stn->execute();
            $stn->store_result();
            $stn->bind_result($visitador, $c_visit);
            while ($stn->fetch()) {
                ?>
            <thead class="ui-widget-header">
                    <tr>
                        <th><?php echo $visitador; ?></th>
                        <?php
                        for ($i = 1; $i <= $dhoy; $i++) {
                            $lla[$i]  = 0;
                            $tlla[$i] = 0;
                            $prom[$i] = 0;
                            $pag[$i]  = 0;
//$lph[$i]=0;
                            $sts->bind_param('si', $visitador, $i);
                            $sts->execute();
                            $sts->bind_result($contact, $proms, $gest);
                            while ($stn->fetch()) {
                                $lla[$i]  = $contact;
                                $tlla[$i] = $gest;
                                $prom[$i] = $proms;
//$lph[$i]=$lla[$i]/($diff[$i]+1/3600);
                                $sumg     = 0;
                                $sumgt    = 0;
                                $sumgt1   = 0;
                                $sumgt2   = 0;
                                $sumt     = 0;
                                $sumb     = 0;
                                $sumpp    = 0;
                                $sump     = 0;
                                $sumw     = 0;
                                $stp->bind_param('si', $c_visit, $i);
                                $stp->execute();
                                $stp->bind_result($pagos);
                                $stp->fetch();
                                $pag[$i]  = $pagos;
                            }
                            $sto->bind_param('si', $c_visit, $i);
                            $sto->execute();
                            $sto->store_result();
                            $sto->bind_result($fout);
                            $sto->fetch();
                            $co[$i] = $fout;

                            $sti->bind_param('si', $c_visit, $i);
                            $sti->execute();
                            $sti->store_result();
                            $sti->bind_result($fin);
                            $sti->fetch();
                            $ci[$i] = $fin;

                            $dow = date("w", strtotime($yr."-".$mes."-".$i));
                            ?>
                            <th><?php echo $day_esp[$dow]." ".$i; ?></th>
                        <?php } ?>
                        <th>TOTAL</th>
                        <th>QUIN.1</th>
                        <th>QUIN.2</th>
                    </tr>
            </thead>
            <tbody class="ui-widget-content">
                    <tr><td class="heavy">SALIDOS</td>
                        <?php
                        $sumco = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php
                                if ($co[$i] != 0) {
                                    echo $co[$i];
                                }
                                ?></td>
                            <?php
                            $sumco      = $sumco + $co[$i];
                            $tsumco[$i] = $tsumco[$i] + $co[$i];
                            ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumco; ?></td>
                    <tr><td class="heavy">RECIBIDOS</td>
                        <?php
                        $sumci = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light"><?php
                                if ($ci[$i] != 0) {
                                    echo $ci[$i];
                                }
                                ?></td>
                            <?php
                            $sumci      = $sumci + $ci[$i];
                            $tsumci[$i] = $tsumci[$i] + $ci[$i];
                            ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumci; ?></td>
                    </tr>
                    <tr><td class="heavy">VISITAS</td>
                        <?php
                        $sumgt = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light<?php
                            if ($tlla[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>">
                                <?php echo $tlla[$i]; ?></td>
                            <?php
                            $sumgt      = $sumgt + $tlla[$i];
                            $tsumgt[$i] = $tsumgt[$i] + $tlla[$i];
                            if ($i < 16) {
                                $sumgt1      = $sumgt1 + $tlla[$i];
                                $tsumgt1[$i] = $tsumgt1[$i] + $tlla[$i];
                            }
                            if ($i > 15) {
                                $sumgt2      = $sumgt2 + $tlla[$i];
                                $tsumgt2[$i] = $tsumgt2[$i] + $tlla[$i];
                            }
                            ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumgt; ?></td>
                        <td class="heavy"><?php echo $sumgt1; ?></td>
                        <td class="heavy"><?php echo $sumgt2; ?></td>
                    </tr>
                    <tr><td class="heavy">CONTACTOS</td>
                        <?php
                        $sumg = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light<?php
                            if ($lla[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>">
                                <?php echo $lla[$i]; ?></td>
                            <?php
                            $sumg      = $sumg + $lla[$i];
                            $tsumg[$i] = $tsumg[$i] + $lla[$i];
                            ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumg; ?></td>
                    </tr>
                    <tr><td class="heavy">PROMESAS</td>
                        <?php
                        $sumpp = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light<?php
                            if ($prom[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>">
                                <a href='<?php echo strtolower('pdh.php?capt='.$capt.'&i='.$prom[$i].'&gestor='.$c_visit.'&fecha='.$yr.'-'.$mes.'-'.$i); ?>'>
                                    <?php echo $prom[$i]; ?></a></td>
                            <?php
                            $sumpp      = $sumpp + $prom[$i];
                            $tsumpp[$i] = $tsumpp[$i] + $prom[$i];
                            ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumpp; ?></td>
                    </tr>
                    <tr><td class="heavy">PAGOS</td>
                        <?php
                        $sump = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            ?>
                            <td class="light<?php
                            if ($pag[$i] == 0) {
                                echo ' zeros';
                            }
                            ?>"><?php echo $pag[$i]; ?></td>
                                <?php
                                $sump      = $sump + $pag[$i];
                                $tsump[$i] = $tsump[$i] + $pag[$i];
                                ?>
                            <?php }
                            ?>
                        <td class="heavy"><?php echo $sumw; ?></td>
                    </tr>
                    <tr><td class="heavy">D&Iacute;AS LABORADOS</td>
                        <?php
                        $sumw = 0;
                        for ($i = 1; $i <= $dhoy; $i++) {
                            $work = 0;
                            if ($tlla[$i] > 5) {
                                $work = 0.5;
                            }
                            if ($tlla[$i] > 9) {
                                $work = 1;
                            }
                            ?>
                            <td class="light"><?php echo $work; ?></td>
                            <?php
                            $sumw      = $sumw + $work;
                            $tsumw[$i] = $tsumw[$i] + $work;
                            ?>
                        <?php }
                        ?>
                        <td class="heavy"><?php echo $sumw; ?></td>
                        <td class="heavy"><?php
                            echo number_format($sumgt1 / ($expw1 + 0.0001) * 100,
                                0).'%';
                            ?></td>
                        <td class="heavy"><?php
                            echo number_format($sumgt2 / ($expw2 + 0.0001) * 100,
                                0).'%';
                            ?></td>
                    </tr>
                    <tr style="height:2em"></tr>
                    <?php
                }
                $stn->close();
                ?>
            </tbody>
        </table>
        <table class="ui-widget">
            <thead class="ui-widget-header">
            <tr>
                    <th>TOTAL</th>
                    <?php
                    $ttsumt  = 0;
                    $ttsumb  = 0;
                    $ttsumg  = 0;
                    $ttsumco = 0;
                    $ttsumci = 0;
                    $ttsumgt = 0;
                    $ttsumpp = 0;
                    $ttsump  = 0;
                    $ttsumw  = 0;
                    for ($i = 1; $i <= $dhoy; $i++) {
                        $dow = date("w", strtotime($yr."-".$mes."-".$i));
                        ?>
                        <th><?php echo $day_esp[$dow]." ".$i; ?></th>
                    <?php } ?>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <tr><td class="heavy">ENVIADOS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsumco[$i]; ?></td>
                        <?php
                        $ttsumco = $ttsumco + $tsumco[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsumco; ?></td>
                </tr>
                <tr><td class="heavy">RECIBIDOS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsumci[$i]; ?></td>
                        <?php
                        $ttsumci = $ttsumci + $tsumci[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsumci; ?></td>
                </tr>
                <tr><td class="heavy">VISITAS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsumgt[$i]; ?></td>
                        <?php
                        $ttsumgt = $ttsumgt + $tsumgt[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsumgt; ?></td>
                </tr>
                <tr><td class="heavy">CONTACTOS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsumg[$i]; ?></td>
                        <?php
                        $ttsumg = $ttsumg + $tsumg[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsumg; ?></td>
                </tr>
                <tr><td class="heavy">PROMESAS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsumpp[$i]; ?></td>
                        <?php
                        $ttsumpp = $ttsumpp + $tsumpp[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsumpp; ?></td>
                </tr>
                <tr><td class="heavy">PAGOS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsump[$i]; ?></td>
                        <?php
                        $ttsump = $ttsump + $tsump[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsump; ?></td>
                </tr>
                <tr><td class="heavy">D&Iacute;AS TRABAJADOS</td>
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        ?>
                        <td class="light"><?php echo $tsumw[$i]; ?></td>
                        <?php
                        $ttsumw = $ttsumw + $tsumw[$i];
                        ?>
                    <?php }
                    ?>
                    <td class="heavy"><?php echo $ttsumw; ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
