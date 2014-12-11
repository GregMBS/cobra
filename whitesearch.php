<?php
require_once 'pdoConnect.php';
$pdoc  = new pdoConnect();
$pdo   = $pdoc->dbConnectUser();
$capt  = filter_input(INPUT_GET, 'capt');
$searchstr = '';
$tel       = filter_input(INPUT_GET, 'tel');
$nombre    = filter_input(INPUT_GET, 'nombre');
$calle     = filter_input(INPUT_GET, 'calle');
$colonia   = filter_input(INPUT_GET, 'colonia');
$ciudad    = filter_input(INPUT_GET, 'ciudad');
$estado    = filter_input(INPUT_GET, 'estado');
$cp        = filter_input(INPUT_GET, 'cp');
if (!empty($tel)) {
    $searchstr.=' AND tel regexp :tel ';
}
if (!empty($nombre)) {
    $searchstr.=' AND nombre_deudor regexp :nombre';
}
if (!empty($calle)) {
    $searchstr.=' AND domicilio_deudor regexp :calle';
}
if (!empty($colonia)) {
    $searchstr.=' AND colonia_deudor regexp :colonia';
}
if (!empty($ciudad)) {
    $searchstr.=' AND ciudad_deudor regexp :ciudad';
}
if (!empty($estado)) {
    $searchstr.=' AND estado_deudor regexp :estado';
}
if (!empty($cp)) {
    $searchstr.=' AND cp_deudor regexp :cp';
}
$querymain = "SELECT SQL_NO_CACHE * FROM dnt.gray WHERE tel IS NOT NULL".$searchstr;
try {
    $stm = $pdo->prepare($querymain);
} catch (PDOException $e) {
    die($e->getMessage());
}
if (!empty($tel)) {
    $stm->bindParam(':tel', $tel);
}
if (!empty($nombre)) {
    $stm->bindParam(':nombre', $nombre);
}
if (!empty($calle)) {
    $stm->bindParam(':calle', $calle);
}
if (!empty($colonia)) {
    $stm->bindParam(':colonia', $colonia);
}
if (!empty($ciudad)) {
    $stm->bindParam(':ciudad', $ciudad);
}
if (!empty($estado)) {
    $stm->bindParam(':estado', $estado);
}
if (!empty($cp)) {
    $stm->bindParam(':cp', $cp);
}
try {
    $stm->execute();
} catch (PDOException $e) {
    die($e->getMessage());
}
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Directorio - Buscar</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
        <script src="vendor/components/jquery/jquery.js" type="text/javascript"></script>
        <script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>BUSCAR</h1>
        <table id="dirtable">
            <thead>
                <tr>
                    <th>TELÉFONO</th>
                    <th>NOMBRE</th>
                    <th>CALLE</th>
                    <th>COLONIA</th>
                    <th>CIUDAD</th>
                    <th>ESTADO</th>
                    <th>CP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $row) {
                    $tel     = $row['tel'];
                    $nombre  = $row['nombre_deudor'];
                    $cp      = $row['cp_deudor'];
                    $calle   = $row['domicilio_deudor'];
                    $colonia = $row['colonia_deudor'];
                    $ciudad  = $row['ciudad_deudor'];
                    $estado  = $row['estado_deudor'];
                    ?>
                    <tr>
                        <td><?php echo $tel; ?></td>
                        <td><?php echo utf8_decode($nombre); ?></td>
                        <td><?php echo utf8_decode($calle); ?></td>
                        <td><?php echo utf8_decode($colonia); ?></td>
                        <td><?php echo utf8_decode($ciudad); ?></td>
                        <td><?php echo utf8_decode($estado); ?></td>
                        <td><?php echo $cp; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="button" value="white" onclick=
                "window.location = 'white.php?capt=<?php echo $capt ?>';"><-</button>
        <script>
            $(function() {
                $('#dirtable').dataTable({"bJQueryUI": true});
            });
        </script>
    </body>
</html> 
