<?php
require_once 'pdoConnect.php';
$pdoc       = new pdoConnect();
$pdo        = $pdoc->dbConnectAdmin();
$capt       = filter_input(INPUT_GET, 'capt');
$go         = filter_input(INPUT_GET, 'go');
$querycell  = "select gestor,tel,ext,tiempo from callme
where completado=0
order by tiempo limit 1";
$resultcell = $pdo->query($querycell);
$fectchcell = $resultcell->fetchAll();
foreach ($fetchcell as $answercell) {
    $gestor  = $answercell[0];
    $cel     = $answercell[1];
    $extn    = split("\.", $answercell[2]);
    $extl    = 1000 + $extn[3];
    $celular = $cel;
    if (strlen($cel) == 13) {
        $celular = $cel;
    }
    if ((strlen($cel) == 12) && (substr($cel, 0, 2) == '44')) {
        $celular = '0'.$cel;
    }
    if ((strlen($cel) == 12) && (substr($cel, 0, 2) == '45')) {
        $celular = '0'.$cel;
    }
    if ((strlen($cel) == 10) && (substr($cel, 0, 2) == '81')) {
        $celular = '044'.$cel;
    }
    if ((strlen($cel) == 10) && (substr($cel, 0, 2) != '81')) {
        $celular = '045'.$cel;
    }
}
$output = "";
if (!empty($go)) {
    require "AsteriskManager.php";
    $params = array('server' => 'localhost', 'port' => '5038');
    $ast    = new Net_AsteriskManager($params);
    try {
        $ast->connect();
    } catch (PEAR_Exception $e) {
        echo $e;
    }
    try {
        $ast->login('admin', 'amp111');
    } catch (PEAR_Exception $e) {
        echo $e;
    }
    if ($go == 'BORRAR') {
        $querydelall = "update callme set completado=1;";
        $pdo->query($querydelall);
    } else {
        $tele      = filter_input(INPUT_GET, 'tele');
        $cid       = filter_input(INPUT_GET, 'ext');
        $extension = '9'.$tele;
        $querydel  = "update callme set completado=1 where right(tel,8)=right(:tele,8)";
        $std       = $pdo->prepare($querydel);
        $std->bindParam(':tele', $tele);
        $std->execute();
        $channel   = 'SIP/'.$cid;
        $context   = 'from-internal';
        try {
            $output    = $ast->originateCall($extension, $channel, $context,
                $cid, $priority  = 1, $timeout   = 30000, $variables = null,
                $action_id = null);
        } catch (PEAR_Exception $e) {
            echo $e;
        }
    }
}
?>
<!DOCTYPE html">
<html>
    <head>
        <title>Celulares</title>
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <style type="text/css">
            pre {border: 1pt solid #000000;background-color: #ffffff;font-size:7pt}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <div>
            <form name="cell" method="get" action="cellcall2.php" id="cell">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <input type="text" name="tele" value="<?php echo $celular ?>">
                <select name="ext">
                    <?php
                    $queryext  = "select substring_index(usuario,'.',-1)+1000,gestor from userlog
where substring_index(usuario,'.',-1)+1000<1030
order by substring_index(usuario,'.',-1)+1000";
                    $resultext = $pdo->query($queryext);
                    $fetchext  = $resultext->fetchAll();
                    foreach ($fetchext as $rowext) {
                        ?>
                        <option value='<?php echo $rowext[0]; ?>'<?php
                        if ($extl == '1001') {
                            echo ' selected=selected';
                        }
                        ?>><?php
                                    echo
                                    $rowext[0].'-'.$rowext[1];
                                    ?></option>
                    <?php } ?>
                </select>
                <?php if (!empty($gestor)) { ?>
                    para <input type="text" name="para" value="<?php echo $gestor ?>">
                    en <input type="text" name="extl" value="<?php echo $extl ?>">
                <?php } ?>
                <input type="submit" name="go" value="MARCAR"></form></div>
        <button onclick="window.location = 'cellcall2.php?capt=<?php echo $capt; ?>'">RECARGAR</button>
        <table summary='call queue' class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>GESTOR</th>
                    <th>TELEFONO</th>
                    <th>CUENTA</th>
                    <th>TIEMPO</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $queryq  = "select gestor,tel,cuenta,min(tiempo) as mt from callme
where completado=0
group by gestor,tel,cuenta
order by mt;";
                $resultq = $pdo->query($queryq);
                $fetchq  = $resultq->fetchAll();
                foreach ($fetchq as $answerq) {
                    $gs = $answerq[0];
                    $cl = $answerq[1];
                    $ct = $answerq[2];
                    $tp = $answerq[3];
                    ?>
                    <tr>
                        <td><?php echo $gs; ?></td>
                        <td><?php echo $cl; ?></td>
                        <td><?php echo $ct; ?></td>
                        <td><?php echo $tp; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button onclick="window.location = 'cellcall2.php?capt=<?php echo $capt; ?>&go=BORRAR'">BORRAR</button>
    </body>
</html>
<