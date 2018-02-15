<?php
use cobra_salsa\PdoClass;
$pdoc   = new PdoClass();
$pdo    = $pdoc->dbConnectUser();
$capt   = filter_input(INPUT_GET, 'capt');
$CUENTA = filter_input(INPUT_GET, 'CUENTA');
$C_CONT = (int) filter_input(INPUT_GET, 'C_CONT', FILTER_VALIDATE_INT);
$go     = filter_input(INPUT_GET, 'go');
$HORA   = (int) filter_input(INPUT_GET, 'HORA', FILTER_VALIDATE_INT);
$MIN    = (int) filter_input(INPUT_GET, 'MIN', FILTER_VALIDATE_INT);
$NOTA   = filter_input(INPUT_GET, 'NOTA');
$FECHA  = filter_input(INPUT_GET, 'FECHA');
if ($go == 'GUARDAR') {
    $D_FECH = date('Y-m-d');
    $C_HORA = date('H:i:s');
    if ($HORA != '00') {
        $HORA = str_pad($HORA, 2, "0", STR_PAD_LEFT).':'
            .str_pad($MIN, 2, "0", STR_PAD_LEFT).':00';
    }
    $querybor   = "UPDATE notas SET borrado=1
WHERE c_cvge=:capt and c_cont=:C_CONT";
    $stb        = $pdo->prepare($querybor);
    $stb->bindParam(':capt', $capt);
    $stb->bindParam(':C_CONT', $C_CONT);
    $stb->execute();
    $queryins   = "INSERT INTO notas
        (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT)
VALUES (:capt, :capt, date(:D_FECH), :C_HORA, :FECHA, :HORA, :NOTA,
:CUENTA, :C_CONT)";
    $sti        = $pdo->prepare($queryins);
    $sti->bindParam(':capt', $capt);
    $sti->bindParam(':D_FECH', $D_FECH);
    $sti->bindParam(':C_HORA', $C_HORA);
    $sti->bindParam(':FECHA', $FECHA);
    $sti->bindParam(':HORA', $HORA);
    $sti->bindParam(':NOTA', $NOTA);
    $sti->bindParam(':CUENTA', $CUENTA);
    $sti->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
    $sti->execute();
    $redirector = "Location: notas.php?capt='".$capt."'&go=FROMGUARDAR";
    header($redirector);
}
if ($go == 'BORRAR') {
    $AUTO       = (int) filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
    $querybins  = "UPDATE notas set borrado=1 "
        ."where AUTO=:AUTO and C_CVGE=:capt";
    $stbi       = $pdo->prepare($querybins);
    $stbi->bindParam(':capt', $capt);
    $stbi->bindParam(':AUTO', $AUTO, PDO::PARAM_INT);
    $stbi->execute();
    $redirector = "Location: notas.php?capt=".$capt."&go=FROMBORRAR";
    header($redirector);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>COBRA Notas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="notabox">
            <table id="notahead" class='ui-widget'>
                <thead class='ui-widget-header'>
                    <tr>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>CUENTA</th>
                        <th colspan=5>NOTA</th>
                        <th>BORRAR</th>
                    </tr>
                </thead>
                <?php
                $querysub = "SELECT auto,fecha,hora,nota,c_cvge,cuenta "
                    ."FROM notas "
                    ."WHERE c_cvge IN (:capt, 'todos') "
                    ."AND borrado=0 ORDER BY fecha desc,hora desc";
                $sts      = $pdo->prepare($querysub);
                $sts->bindParam(':capt', $capt);
                $sts->execute();
                $result   = $sts->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    ?>
                    <tbody class="ui-widget-content">
                        <?php foreach ($result as $answer) { ?>
                            <tr>
                                <td><?php echo $answer['fecha']; ?></td>
                                <td><?php echo $answer['hora']; ?></td>
                                <td><?php echo $answer['cuenta']; ?></td>
                                <td colspan=5><?php echo $answer['nota']; ?></td>
                                <td><?php if ($answer['c_cvge'] == $capt) { ?>
                                        <form action="notas.php" method="get" name="lista<?echo $answer['auto'];?>">
                                            <input type="hidden" name="which" readonly="readonly" value=<?php echo $answer['auto']; ?> />
                                            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> />
                                            <input type="submit" name="go" value="BORRAR">
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        <form action="notas.php" method="get" name="notas">
            <label for='FECHA'>Fecha</label>
            <INPUT TYPE="text" NAME="FECHA" ID="FECHA" VALUE="" SIZE=15 /><br>
            <label for='HORA'>Hora</label>
            <INPUT TYPE="text" NAME="HORA" ID="HORA" VALUE="" />
            <label for='MIN'>Min</label>
            <INPUT TYPE="text" NAME="MIN" ID="MIN" VALUE="" /><br>
            <label for='CUENTA'>Cuenta</label>
            <input type="text" name="CUENTA" readonly="readonly" value=<?php echo $CUENTA; ?>></input><br>
            <label for='NOTA'>Nota</label>
            <textarea rows="2" cols="40" name="NOTA" id="NOTA"></textarea><br>
            <input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $C_CONT; ?> /><br>
            <input type="hidden" name="D_FECH" readonly="readonly" value=<?php echo date('Y-m-d'); ?> /><br>
            <input type="hidden" name="C_HORA" readonly="readonly" value=<?php echo date('H:i:s'); ?> /><br>
            <input type="hidden" name="AUTO" readonly="readonly" value="" /><br>
            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="submit" name="go" value="GUARDAR">
        </form>
        <button onClick='window.close()'>CIERRA</button>
        <script>
            $(function() {
                $('#HORA').spinner({
                    min: 0,
                    max: 23
                });
                $('#MIN').spinner({
                    min: 0,
                    max: 55,
                    step: 5
                });
                $('#FECHA').datepicker();
            });
        </script>
    </body>
</html> 

