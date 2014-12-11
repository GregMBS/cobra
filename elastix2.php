<?php
require_once 'pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectAdmin();
$capt      = filter_input(INPUT_GET, 'capt');
$go        = filter_input(INPUT_GET, 'go');
$cliente   = filter_input(INPUT_GET, 'cliente');
$querymain = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_4+0)=8,tel_4+0,
    if(length(tel_4)=10 and left(tel_4,2)=81,right(tel_4,8),if(length(tel_4)=10,
    concat('01',tel_4),if(length(tel_4+0)=7,concat('01844',tel_4+0),
    if(left(tel_4,4)='0181',right(tel_4,8),tel_4))))) as t4,
    if(length(tel_1+0)=8,tel_1+0,
    if(length(tel_1)=10 and left(tel_1,2)=81,right(tel_1,8),if(length(tel_1)=10,
    concat('01',tel_1),if(length(tel_1+0)=7,concat('01844',tel_1+0),
    if(left(tel_1,4)='0181',right(tel_1,8),tel_1))))) as t1,
    if(length(tel_3+0)=8,tel_3+0,
    if(length(tel_3)=10 and left(tel_3,2)=81,right(tel_3,8),if(length(tel_3)=10,
    concat('01',tel_3),if(length(tel_3+0)=7,concat('01844',tel_3+0),
    if(left(tel_3,4)='0181',right(tel_3,8),tel_3))))) as t3,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    if(left(tel_1_ref_1,4)='0181',right(tel_1_ref_1,8),tel_1_ref_1))))) as t1_ref_1,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    if(left(tel_1_ref_2,4)='0181',right(tel_1_ref_2,8),tel_1_ref_2))))) as t1_ref_2,
    if(length(tel_2_ref_1+0)=8,tel_2_ref_1+0,
    if(length(tel_2_ref_1)=10 and left(tel_2_ref_1,2)=81,right(tel_2_ref_1,8),if(length(tel_2_ref_1)=10,
    concat('01',tel_2_ref_1),if(length(tel_2_ref_1+0)=7,concat('01844',tel_2_ref_1+0),
    if(left(tel_1_laboral,4)='0181',right(tel_1_laboral,8),tel_1_laboral))))) as t1_laboral,
    if(length(tel_2_ref_2+0)=8,tel_2_ref_2+0,
    if(length(tel_2_ref_2)=10 and left(tel_2_ref_2,2)=81,right(tel_2_ref_2,8),if(length(tel_2_ref_2)=10,
    concat('01',tel_2_ref_2),if(length(tel_2_ref_2+0)=7,concat('01844',tel_2_ref_2+0),
    if(left(tel_2_ref_2,4)='0181',right(tel_2_ref_2,8),tel_2_ref_2))))) as t2_ref_2,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,subproducto
 from resumen use index (queuesort)
where status_aarsa='' and cliente=:cliente
and status_de_credito not like '%o'
    ;";
$stm       = $pdo->prepare($querymain);
$stm->bindParam(':cliente', $cliente);
$stm->execute();
$result    = $stm->fetchAll();
$queryc    = "select count(1) as ct from resumen
where cliente=:cliente
and status_de_credito not like '%o'
and fecha_ultima_gestion<=last_day(curdate()-interval 1 month)
";
$stc       = $pdo->prepare($queryc);
$stc->bindParam(':cliente', $cliente);
$stc->execute();
$resultc   = $stc->fetch();
if ($resultc) {
    $numc = $resultc['ct'];
}
$queryactual = "select distinct nombre_deudor,numero_de_cuenta,cliente,
    if(length(tel_1+0)=8,tel_1+0,
    if(length(tel_1)=10 and left(tel_1,2)=81,right(tel_1,8),if(length(tel_1)=10,
    concat('01',tel_1),if(length(tel_1+0)=7,concat('01844',tel_1+0),
    if(left(tel_1,4)='0181',right(tel_1,8),tel_1))))) as t1,
    if(length(tel_3+0)=8,tel_3+0,
    if(length(tel_3)=10 and left(tel_3,2)=81,right(tel_3,8),if(length(tel_3)=10,
    concat('01',tel_3),if(length(tel_3+0)=7,concat('01844',tel_3+0),
    if(left(tel_3,4)='0181',right(tel_3,8),tel_3))))) as t3,
    if(length(tel_4+0)=8,tel_4+0,
    if(length(tel_4)=10 and left(tel_4,2)=81,right(tel_4,8),if(length(tel_4)=10,
    concat('01',tel_4),if(length(tel_4+0)=7,concat('01844',tel_4+0),
    if(left(tel_4,4)='0181',right(tel_4,8),tel_4))))) as t4,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    if(left(tel_1_ref_1,4)='0181',right(tel_1_ref_1,8),tel_1_ref_1))))) as t1_ref_1,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    if(left(tel_1_ref_2,4)='0181',right(tel_1_ref_2,8),tel_1_ref_2))))) as t1_ref_2,
    if(length(tel_1_laboral+0)=8,tel_1_laboral+0,
    if(length(tel_1_laboral)=10 and left(tel_1_laboral,2)=81,right(tel_1_laboral,8),if(length(tel_1_laboral)=10,
    concat('01',tel_1_laboral),if(length(tel_1_laboral+0)=7,concat('01844',tel_1_laboral+0),
    if(left(tel_1_laboral,4)='0181',right(tel_1_laboral,8),tel_1_laboral))))) as t1_laboral,
    if(length(tel_2_ref_2+0)=8,tel_2_ref_2+0,
    if(length(tel_2_ref_2)=10 and left(tel_2_ref_2,2)=81,right(tel_2_ref_2,8),if(length(tel_2_ref_2)=10,
    concat('01',tel_2_ref_2),if(length(tel_2_ref_2+0)=7,concat('01844',tel_2_ref_2+0),
    if(left(tel_2_ref_2,4)='0181',right(tel_2_ref_2,8),tel_2_ref_2))))) as t2_ref_2,
    saldo_total,id_cuenta,'XX',status_de_credito,status_aarsa,dias_vencidos,fecha_ultima_gestion
 from resumen 
where cliente=:cliente
and status_de_credito not like '%o' 
and fecha_ultima_gestion<=last_day(curdate()-interval 1 month)+interval 1 day
limit ".$numc.";";
$sta         = $pdo->prepare($queryactual);
$sta->bindParam(':cliente', $cliente);
$sta->execute();
$resulta     = $sta->fetchAll();
$querycs     = "SELECT distinct cliente FROM resumen
        where fecha_de_actualizacion>last_day(curdate()-interval 1 month)
        or fecha_ultima_gestion>last_day(curdate()-interval 1 month) limit 50";
$resultcs    = $pdo->query($querycs);
$querydc     = "select c_tele from deadlines "
    ."where c_tele=right(:tt,8);";
$std         = $pdo->prepare($querydc);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Query para Elastix</title>
        <link rel="Stylesheet" href="css/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="vendor/components/jquery/jquery,js"></script>
        <script type="text/javascript" charset="utf8" src="vendor/components/jqueryui/jquery-ui,js"></script>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="elastix2.php" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>Cliente:
                <select name="cliente">
                    <?php
                    foreach ($resultcs as $answercs) {
                        ?>
                        <option value="<?php echo $answercs['cliente']; ?>" style="font-size:120%;">
                            <?php echo $answercs['cliente']; ?></option>
                    <?php }
                    ?>
                </select>
                <input type='submit' name='go' value='ELIGIR'>
        </form>
        <p>SIN GESTION</p>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>nombre_deudor</th>
                    <th>numero_de_cuenta</th>
                    <th>cliente</th>
                    <th>tt</th>
                    <th>saldo_total</th>
                    <th>id_cuenta</th>
                    <th>enlace</th>
                    <th>status_de_credito</th>
                    <th>status_aarsa</th>
                    <th>subproducto</th>
                    <th>i</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($result as $row) {
                    $nombre_deudor     = $row[0];
                    $numero_de_cuenta  = $row[1];
                    $cliente           = $row[2];
                    $t1                = $row[3];
                    $t3                = $row[4];
                    $t4                = $row[5];
                    $t1r1              = $row[6];
                    $t1r2              = $row[7];
                    $t2r1              = $row[8];
                    $t2r2              = $row[9];
                    $saldo_total       = $row[10];
                    $id_cuenta         = $row[11];
                    $enlace            = "&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
                    $status_de_credito = $row[13];
                    $status_aarsa      = $row[14];
                    $subproducto       = $row[15];
                    $told              = 0;
                    $tt                = $t1;
                    for ($i = 3; $i < 10; $i++) {
                        while ((strlen($tt) != 8) && (strlen($tt) != 12) && ($i < 9)) {
                            $i++;
                            $tt = $row2[$i];
                        }
                        while ((strlen($tt) == 12) && (stripos($tt, '4') < 3)) {
                            $i++;
                            $tt = $row2[$i];
                        }
                        $std->bindParam(':tt', $tt);
                        $std->execute();
                        $resultdc = $std->fetchAll();
                        foreach ($resultdc as $answerdc) {
                            $i++;
                            $tt = $row2[$i];
                        }
                        if ($tt == $told) {
                            $tt = '';
                        } else {
                            $told = $tt;
                        }
                        ?>
                        <tr>
                            <td><?php echo $nombre_deudor; ?></td>
                            <td><?php echo $numero_de_cuenta; ?></td>
                            <td><?php echo $cliente; ?></td>
                            <td><?php echo $tt; ?></td>
                            <td><?php echo $saldo_total; ?></td>
                            <td><?php echo $id_cuenta; ?></td>
                            <td><?php echo $enlace; ?></td>
                            <td><?php echo $status_de_credito; ?></td>
                            <td><?php echo $status_aarsa; ?></td>
                            <td><?php echo $subproducto; ?></td>
                            <td><?php echo $i; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <p>SIN GESTI&Oacute;N ESTE MES</p>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>nombre_deudor</th>
                    <th>numero_de_cuenta</th>
                    <th>cliente</th>
                    <th>tt</th>
                    <th>saldo_total</th>
                    <th>id_cuenta</th>
                    <th>enlace</th>
                    <th>status_de_credito</th>
                    <th>status_aarsa</th>
                    <th>subproducto</th>
                    <th>fecha_ultima_gestion</th>
                    <th>i</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($resulta as $row2) {
                    $nombre_deudor        = $row2[0];
                    $numero_de_cuenta     = $row2[1];
                    $cliente              = $row2[2];
                    $t1                   = $row2[3];
                    $t3                   = $row2[4];
                    $t4                   = $row2[5];
                    $t1r1                 = $row2[6];
                    $t1r2                 = $row2[7];
                    $t2r1                 = $row2[8];
                    $t2r2                 = $row2[9];
                    $saldo_total          = $row2[10];
                    $id_cuenta            = $row2[11];
                    $enlace               = "&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
                    $status_de_credito    = $row2[13];
                    $status_aarsa         = $row2[14];
                    $subproducto          = $row2[15];
                    $fecha_ultima_gestion = $row2[16];
                    $tt                   = $t1;
                    $i                    = 3;
                    while ((strlen($tt) != 8) && (strlen($tt) != 12) && ($i < 9)) {
                        $i++;
                        $tt = $row2[$i];
                    }
                    while ((strlen($tt) == 12) && (stripos($tt, '4') < 3)) {
                        $i++;
                        $tt = $row2[$i];
                    }
                    $std->bindParam(':tt', $tt);
                    $std->execute();
                    $resultdc = $std->fetchAll();
                    foreach ($resultdc as $answerdc) {
                        $i++;
                        $tt = $row2[$i];
                    }
                    if ($i > 9) {
                        $tt = 0;
                    }
                    ?>
                    <tr>
                        <td><?php echo $nombre_deudor; ?></td>
                        <td><?php echo $numero_de_cuenta; ?></td>
                        <td><?php echo $cliente; ?></td>
                        <td><?php echo $tt; ?></td>
                        <td><?php echo $saldo_total; ?></td>
                        <td><?php echo $id_cuenta; ?></td>
                        <td><?php echo $enlace; ?></td>
                        <td><?php echo $status_de_credito; ?></td>
                        <td><?php echo $status_aarsa; ?></td>
                        <td><?php echo $subproducto; ?></td>
                        <td><?php echo $fecha_ultima_gestion; ?></td>
                        <td><?php echo $i; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html> 
