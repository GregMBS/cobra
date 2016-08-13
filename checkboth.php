<?php
require_once 'classes/pdoConnect.php';
$pdoc     = new pdoConnect();
$pdo      = $pdoc->dbConnectAdmin();
$capt     = filter_input(INPUT_GET, 'capt');
$tipo     = filter_input(INPUT_GET, 'tipo');
$get      = filter_input_array(INPUT_GET);
$gestor   = filter_input(INPUT_GET, 'gestor');
$CUENTA   = trim(filter_input(INPUT_GET, 'CUENTA'));
$message  = '';
$go       = $get['go'];
$fechaout = filter_input(INPUT_GET, 'fechaout');
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $querycc = "select id_cuenta from resumen
where ((numero_de_cuenta=:cuenta and cliente<>'Prestamo Relampago')
or (numero_de_credito=:cuenta and cliente='Prestamo Relampago'))
and status_de_credito=who(status_de_credito);";
        $stcc    = $pdo->prepare($querycc);
        $stcc->bindParam(':cuenta', $CUENTA);
        $stcc->execute();

        $resultcc = $stcc->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultcc as $answercc) {
            $ID_CUENTA = $answercc['id_cuenta'];
        }
        $queryins = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain,c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc);";
        $sti      = $pdo->prepare($queryins);
        if ($C_CONT > 0) {
            $sti->bindParam(':cuenta', $CUENTA);
            $sti->bindParam(':gestor', $gestor);
            $sti->bindParam(':fechaout', $fechaout);
            $sti->bindParam(':id_cuenta', $ID_CUENTA);
            $sti->execute();
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CobraMas Visitador Asignaciones y Recepciones</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="bower_components/jquery/jquery.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body onLoad="<?php if (!empty($gestor)) { ?>
    		document.getElementById('CUENTA').focus()
    <?php } else { ?>
    		document.getElementById('CUENTA').disabled = true
    <?php } ?>
          ">
        <div id="vtable">
            <h1><?php echo $message; ?></h1>
            <form id='asigform' action='checkboth.php' method='get'>
                <span class="formcap">Visitador:</span>
                <select name="gestor" onChange="document.getElementById('asigform').submit()">
                    <option value='' <?php if ($gestor == '') { ?> selected='selected'<?php } ?>></option>
                    <?php
                    $query  = "SELECT usuaria,completo FROM nombres where completo<>''
and (tipo='visitador' or tipo='admin')";
                    $result = $pdo->query($query);
                    foreach ($result as $answer) {
                        ?>
                        <option value="<?php echo $answer[0]; ?>" <?php
                        if ($gestor == $answer[0]) {
                            ?> selected='selected'<?php } ?>><?php echo htmlentities($answer[1]); ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <select name="fechaout">
                    <option value='' <?php if ($fechaout == '') { ?> selected='selected'<?php } ?>></option>
                    <?php
                    $queryd  = "SELECT distinct concat_ws('-',year(d_fech),month(d_fech),day(d_fech)) FROM historia
where d_fech between (curdate()-interval 1 month) AND curdate()
order by d_fech
";
                    $resultd = $pdo->query($queryd);
                    foreach ($resultd as $answerd) {
                        ?>
                        <option value="<?php echo $answerd[0]; ?>" <?php
                        if ($fechaout == $answerd[0]) {
                            ?> selected='selected'<?php } ?>><?php echo $answerd[0]; ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <input type="text" id="CUENTA" name="CUENTA" value="">
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <input type="submit" name="go" value="RECIBIR">
            </form>
            <?php
            $querycount  = "select sum(fechaout>curdate()),sum(fechain>curdate()) from vasign
where gestor=:gestor";
            $stc         = $pdo->query($querycount);
            $stc->bindParam(':gestor', $gestor);
            $stc->execute();
            $resultcount = $stc->fetchAll();
            foreach ($resultcount as $answercount) {
                $ASIG  = $answercount[0];
                $RECIB = $answercount[1];
            }
            ?>
            <p>Asignado: <?php echo $ASIG; ?><br>
                Recibido: <?php echo $RECIB; ?></p>
            <table>
                <tr>
                    <th>ID_CUENTA</th>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SALDO TOTAL</th>
                    <th>QUEUE</th>
                    <th>GESTOR</th>
                    <th>ASIG.</th>
                    <th>RECIB.</th>
                </tr>
                <?php
                $gstring = '';
                if (!empty($gestor)) {
                    $gstring = " where gestor = :gestor order by fechain desc";
                }
                $querymain = "select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total,
q(status_aarsa),completo, fechaout, fechain
from resumen join vasign on id_cuenta=c_cont join nombres on iniciales=gestor ".$gstring;
                $stm       = $pdo->query($querymain);
                if (!empty($gestor)) {
                    $stm->bindParam(':gestor', $gestor);
                }
                $stm->execute();
                $resultmain = $stm->fetchAll();
                foreach ($resultmain as $answermain) {
                    $ID_CUENTA = $answermain[0];
                    $CUENTA    = $answermain[1];
                    $NOMBRE    = $answermain[2];
                    $CLIENTE   = $answermain[3];
                    $ST        = $answermain[4];
                    $QUEUE     = $answermain[5];
                    $GESTOR    = $answermain[6];
                    $FECHAOUT  = $answermain[7];
                    $FECHAIN   = $answermain[8];
                    ?>
                    <tr>
                        <td><?php echo $ID_CUENTA; ?></td>
                        <td><?php echo $CUENTA; ?></td>
                        <td><?php echo $NOMBRE; ?></td>
                        <td><?php echo $CLIENTE; ?></td>
                        <td><?php echo number_format($ST, 0); ?></td>
                        <td><?php echo $QUEUE; ?></td>
                        <td><?php echo $GESTOR; ?></td>
                        <td><?php echo $FECHAOUT; ?></td>
                        <td><?php echo $FECHAIN; ?></td>
                    </tr>
<?php } ?>
            </table>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
    </body>
</html>
