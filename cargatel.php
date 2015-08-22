<?php
require_once 'pdoConnect.php';
$pdoc     = new pdoConnect();
$pdo      = $pdoc->dbConnectAdmin();
$capt     = filter_input(INPUT_GET, 'capt');
$go       = filter_input(INPUT_POST, 'go');
$dataP    = filter_input(INPUT_POST, 'data');
$msgtag   = filter_input(INPUT_POST, 'msgtag');
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>ROBOT Carga</title>
        <style>
            body {background-color:blue;}
            .num {text-align:right}
            textarea,select,option {background-color:white;}
            form {margin-left:auto;margin-right:auto;}
            p {background-color:gray;}
        </style>
    </head>
    <body>
        <form action="cargatel.php?capt=<?php echo $capt; ?>" method="post" name="cargar">
            <p>Usa formato CUENTA,TELE</p>
            <textarea name='data' rows='20' cols='50'></textarea>
            <p>Mensaje <select name="msgtag">
                    <?php
                    $querycl  = "SELECT client,tipo FROM robot.msglist;";
                    $resultcl = $pdo->query($querycl);

                    foreach ($resultcl as $answercl) {
                        ?>
                        <option value="<?php echo $answercl['client'].','.$answercl['tipo']; ?>" style="font-size:120%;">
                            <?php echo $answercl['client'].','.$answercl['tipo']; ?></option>
                        <?php }
                        ?>
                </select>
            </p>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>
        </p>
    </form>
    <?php
    if (!empty($go)) {

        if ($go == 'cargar') {

            $querytemp1 = 'DROP TABLE IF EXISTS robot.tempc';
            $pdo->query($querytemp1) or die($pdo->error);
            $querytemp2 = 'CREATE TABLE robot.tempc (
  `id` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `turno` varchar(50)
)';
            $pdo->query($querytemp2) or die($pdo->error);
            $data0      = preg_replace('/[^0-9a-zA-Z]/', ',', $dataP);
            $data1      = preg_replace('/\,\,/', ',', $data0);
            $data       = explode(',', $data1);
            $max        = ceil(count($data) / 2);
            $queryload  = 'INSERT INTO robot.tempc (id,tel) VALUES (:id, :tel)';
            $stl        = $pdo->prepare($queryload);
            for ($i = 0; $i < $max; $i++) {
                $a = $i * 2;
                $b = $i * 2 + 1;
                $stl->bindParam(':id', $data[$a]);
                $stl->bindParam(':tel', $data[$b]);
                $stl->execute();
            }
            $queryput = "INSERT IGNORE INTO robot.calllist (id,tel,msg,turno)
SELECT id,tel,msg,0 FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)=:msgtag) as tmp on 1=1
;";
            $stp=$pdo->prepare($queryput);
            $stp->bindParam(':msgtag', $msgtag);
            $stp->execute();
            ?>
        <p>Llamadas est&aacute;n guardados</p>
        <?php }
    }
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
</body>
</html>
