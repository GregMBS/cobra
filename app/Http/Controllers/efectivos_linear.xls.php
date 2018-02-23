<?php

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

$go = filter_input(INPUT_GET, 'go');

function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    
    return date("M", $timestamp);
}
    if (!empty($go)) 
    {
        $cliente = filter_input(INPUT_GET, 'cliente');

        $clientestr='';
if ($cliente!='todos') {$clientestr=" and cliente=:cliente ";}
    $querymain = "select distinct numero_de_cuenta as cuenta,trim(c_tele) as tel
from resumen
join historia on c_cont=id_cuenta
join dictamenes on dictamen=c_cvst
join livelines using (c_tele)
left join deadlines using (c_tele)
where status_de_credito not regexp '-'
and length(trim(c_tele)) in (8,10,12,13)
and queue <>'ilocalizables'
and queue <>'sin contactos'
and deadlines.c_tele is null
".$clientestr." 
order by numero_de_cuenta,c_tele 
    ;";
    $stm       = $pdo->prepare($querymain);
    if ($cliente != 'todos') {
        $stm->bindParam(':cliente', $cliente);
   }
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $filename = "Telefonos_efectivos_".date('ymd')."xls";
    $output   = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
?>
    <!DOCTYPE html>
<html>
<head>
<title>Query de las Promesas/Propuestas</title>
            <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="efectivos_linear.xls.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>Cliente:
<select name="cliente">
<option value="todos" style="font-size:120%;">todos</option>
<?php
                        $queryc  = "SELECT cliente FROM clientes
        order by cliente
	";
                        $resultc = $pdo->query($queryc);
                        foreach ($resultc as $answerc) {
                            ?>
                            <option value="<?php echo $answerc['cliente']; ?>" style="font-size:120%;">
                                <?php echo $answerc['cliente']; ?></option>
                            <?php }
                            ?>
</select>
</p>
<input type='submit' name='go' value='Tel&eacute;fonos Efectivos'>
</form>
</body>
</html> 
    <?php
}
