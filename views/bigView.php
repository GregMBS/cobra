<?php
/**
 * @var string $title
 * @var string[] $gestores
 * @var string[] $clientes
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $title; ?></title>
    <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"/>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php
if (isset($capt)) {
    echo $capt;
}
?>'">Regresar a la pagina administrativa
</button>
<br>
<form action="/bigproms.php" method="get" name="queryParams">
    <input type="hidden" name="capt" value="<?php if (isset($capt)) {
        echo $capt;
    } ?>">
    <p>
        <label>Gestor: <?php
            if (isset($gestor)) {
                echo $gestor;
            }
            ?>
            <select name="gestor">
                <option value="todos" style="font-size:120%;">todos</option>
                <?php
                foreach ($gestores as $gestor) {
                    ?>
                    <option value="<?php echo $gestor[0]; ?>" style="font-size:120%;">
                        <?php echo $gestor[0]; ?></option>
                    <?php
                }
                ?>
            </select>
        </label>
    </p>
    <p>
        <label>Cliente:
            <select name="cliente">
                <option value="todos" style="font-size:120%;">todos</option>
                <?php
                foreach ($clientes as $cliente) {
                    ?>
                    <option value="<?php echo $cliente[0]; ?>" style="font-size:120%;">
                        <?php echo $cliente[0]; ?></option>
                    <?php
                }
                ?>
            </select>
        </label>
    </p>
    <p>
        <label>HECHO de:
            <input name="fecha1" id="fecha1" readonly="readonly"/>
            a:
            <input name="fecha2" id="fecha2" readonly="readonly"/>
        </label>
    </p>
    <p>
        <?php
        if (!empty($flag)) {
            if ($flag == 'prom') {
                ?>
                <label>VENCIDO de:
                    <input name="fecha3" id="fecha3" readonly="readonly"/>
                    a:
                    <input name="fecha4" id="fecha4" readonly="readonly"/>
                </label>
                <?php
            }
        }
        ?>
    </p>
    <label for='visits'>Visitas</label>
    <input type='radio' name='tipo' id='visits' value='visits'/><br>
    <label for='telef'>Telefónica</label>
    <input type='radio' name='tipo' id='telef' value='telef'/><br>
    <label for='todos'>Todos</label>
    <input type='radio' name='tipo' id='todos' value='todos'/><br>
    <input type='submit' name='go' value='Query'>
</form>
<script src="/js/datepicker_mx.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $.datepicker.setDefaults(getMx());
        $('#fecha1').datepicker();
        $('#fecha2').datepicker();
        $('#fecha3').datepicker();
        $('#fecha4').datepicker();
    });
</script>
</body>
</html>
